<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fournisseur;
use Illuminate\Support\Facades\Validator;

class FournisseurController extends Controller
{
    public function index(Request $request)
    {
        $query = Fournisseur::with(['commandes' => function($q) {
            $q->with(['lignes.livraisons']);
        }]);

        // Filtres
        if ($request->filled('type')) {
            $query->byType($request->type);
        }

        if ($request->filled('tri')) {
            switch ($request->tri) {
                case 'commandes':
                    $query->withCount('commandes')->orderBy('commandes_count', 'desc');
                    break;
                case 'montant':
                    $query->withSum('commandes', 'montant_total')->orderBy('commandes_sum_montant_total', 'desc');
                    break;
                case 'ponctualite':
                    // Tri par taux de ponctualité (calculé côté client pour l'instant)
                    break;
                case 'score':
                    // Tri par score global (calculé côté client pour l'instant)
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $fournisseurs = $query->get();

        // Calculer les statistiques pour chaque fournisseur
        foreach ($fournisseurs as $fournisseur) {
            // Les attributs sont calculés automatiquement via les accesseurs
        }

        // Statistiques globales
        $stats = [
            'total_fournisseurs' => $fournisseurs->count(),
            'fournisseurs_avec_commandes' => $fournisseurs->filter(fn($f) => $f->nombre_commandes > 0)->count(),
            'montant_total' => $fournisseurs->sum('montant_total_commandes'),
            'moyenne_ponctualite' => $fournisseurs->filter(fn($f) => $f->nombre_commandes_livrees > 0)->avg('taux_ponctualite') ?? 0,
        ];

        return view('lists.fournisseurs', compact('fournisseurs', 'stats'));
    }

    public function create()
    {
        return view('fournisseurs.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:50',
            'adresse' => 'nullable|string|max:255',
            'ville' => 'nullable|string|max:100',
            'pays' => 'nullable|string|max:100',
            'type' => 'nullable|string|max:100',
            'responsable' => 'nullable|string|max:255',
        ]);
        Fournisseur::create($validated);
        return redirect()->route('liste.fournisseurs')->with('success', 'Fournisseur ajouté avec succès.');
    }

    public function show(Fournisseur $fournisseur)
    {
        // Charger les commandes avec leurs lignes et livraisons
        $fournisseur->load(['commandes' => function($query) {
            $query->with(['lignes.livraisons', 'bonCommande']);
        }]);

        // Statistiques détaillées
        $stats = [
            'total_commandes' => $fournisseur->nombre_commandes,
            'commandes_livrees' => $fournisseur->nombre_commandes_livrees,
            'livraisons_a_temps' => $fournisseur->nombre_livraisons_a_temps,
            'taux_ponctualite' => $fournisseur->taux_ponctualite,
            'montant_total' => $fournisseur->montant_total_commandes,
            'score_global' => $fournisseur->score_global,
            'score_label' => $fournisseur->score_label,
            'score_color' => $fournisseur->score_color,
        ];

        // Commandes récentes (5 dernières)
        $commandes_recentes = $fournisseur->commandes()
            ->with(['lignes.livraisons', 'bonCommande'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Évolution des commandes par mois (6 derniers mois)
        $evolution_mensuelle = $fournisseur->commandes()
            ->selectRaw('MONTH(created_at) as mois, YEAR(created_at) as annee, COUNT(*) as nombre, SUM(montant_total) as montant')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('mois', 'annee')
            ->orderBy('annee')
            ->orderBy('mois')
            ->get();

        return view('fournisseurs.show', compact('fournisseur', 'stats', 'commandes_recentes', 'evolution_mensuelle'));
    }

    public function exportPdf(Fournisseur $fournisseur)
    {
        // Charger les données du fournisseur avec ses commandes
        $fournisseur->load(['commandes' => function($query) {
            $query->with(['lignes.livraisons', 'bonCommande']);
        }]);

        // Statistiques détaillées
        $stats = [
            'total_commandes' => $fournisseur->nombre_commandes,
            'commandes_livrees' => $fournisseur->nombre_commandes_livrees,
            'livraisons_a_temps' => $fournisseur->nombre_livraisons_a_temps,
            'taux_ponctualite' => $fournisseur->taux_ponctualite,
            'montant_total' => $fournisseur->montant_total_commandes,
            'score_global' => $fournisseur->score_global,
            'score_label' => $fournisseur->score_label,
            'score_color' => $fournisseur->score_color,
        ];

        // Commandes récentes (5 dernières)
        $commandes_recentes = $fournisseur->commandes()
            ->with(['lignes.livraisons', 'bonCommande'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Évolution des commandes par mois (6 derniers mois)
        $evolution_mensuelle = $fournisseur->commandes()
            ->selectRaw('MONTH(created_at) as mois, YEAR(created_at) as annee, COUNT(*) as nombre, SUM(montant_total) as montant')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('mois', 'annee')
            ->orderBy('annee')
            ->orderBy('mois')
            ->get();

        $pdf = \PDF::loadView('fournisseurs.pdf', compact('fournisseur', 'stats', 'commandes_recentes', 'evolution_mensuelle'));
        
        return $pdf->download('fournisseur-' . $fournisseur->nom . '.pdf');
    }

    public function exportListPdf(Request $request)
    {
        $query = Fournisseur::with(['commandes' => function($q) {
            $q->with(['lignes.livraisons']);
        }]);

        // Appliquer les mêmes filtres que dans index()
        if ($request->filled('type')) {
            $query->byType($request->type);
        }

        if ($request->filled('tri')) {
            switch ($request->tri) {
                case 'commandes':
                    $query->withCount('commandes')->orderBy('commandes_count', 'desc');
                    break;
                case 'montant':
                    $query->withSum('commandes', 'montant_total')->orderBy('commandes_sum_montant_total', 'desc');
                    break;
                case 'ponctualite':
                    // Tri par taux de ponctualité (calculé côté client pour l'instant)
                    break;
                case 'score':
                    // Tri par score global (calculé côté client pour l'instant)
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $fournisseurs = $query->get();

        // Calculer les statistiques pour chaque fournisseur
        foreach ($fournisseurs as $fournisseur) {
            // Les attributs sont calculés automatiquement via les accesseurs
        }

        // Statistiques globales
        $stats = [
            'total_fournisseurs' => $fournisseurs->count(),
            'fournisseurs_avec_commandes' => $fournisseurs->filter(fn($f) => $f->nombre_commandes > 0)->count(),
            'montant_total' => $fournisseurs->sum('montant_total_commandes'),
            'moyenne_ponctualite' => $fournisseurs->filter(fn($f) => $f->nombre_commandes_livrees > 0)->avg('taux_ponctualite') ?? 0,
        ];

        $pdf = \PDF::loadView('fournisseurs.list-pdf', compact('fournisseurs', 'stats'));
        
        return $pdf->download('liste-fournisseurs-' . date('Y-m-d') . '.pdf');
    }
}
