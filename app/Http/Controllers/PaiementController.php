<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PaiementController extends Controller
{
    /**
     * Afficher la liste des paiements avec filtres
     */
    public function index(Request $request)
    {
        $query = Commande::with(['fournisseur', 'paiements'])
            ->where('montant_a_payer', '>', 0);

        // Filtres
        if ($request->filled('statut_paiement')) {
            $query->where('statut_paiement', $request->statut_paiement);
        }

        if ($request->filled('fournisseur')) {
            $query->whereHas('fournisseur', function($q) use ($request) {
                $q->where('nom', 'like', '%' . $request->fournisseur . '%');
            });
        }

        if ($request->filled('date_debut')) {
            $query->where('date_commande', '>=', $request->date_debut);
        }

        if ($request->filled('date_fin')) {
            $query->where('date_commande', '<=', $request->date_fin);
        }

        $commandes = $query->orderBy('date_commande', 'desc')->paginate(20);

        // Statistiques
        $stats = [
            'total_commandes' => Commande::where('montant_a_payer', '>', 0)->count(),
            'total_montant' => Commande::where('montant_a_payer', '>', 0)->sum('montant_a_payer'),
            'total_paye' => Commande::where('montant_a_payer', '>', 0)->sum('avance'),
            'total_reste' => Commande::where('montant_a_payer', '>', 0)->sum('reste_a_payer'),
        ];

        return view('paiements.index', compact('commandes', 'stats'));
    }

    /**
     * Afficher les détails d'une commande
     */
    public function show(Commande $commande)
    {
        $commande->load(['fournisseur', 'paiements.user', 'lignes']);
        
        return view('paiements.show', compact('commande'));
    }

    /**
     * Afficher le formulaire de paiement modal
     */
    public function showModal(Commande $commande)
    {
        if (!$commande->peutEtrePayee()) {
            return response()->json([
                'success' => false,
                'message' => 'Cette commande ne peut pas être payée.'
            ]);
        }

        return response()->json([
            'success' => true,
            'commande' => [
                'id' => $commande->id,
                'reference' => $commande->reference,
                'fournisseur' => $commande->fournisseur->nom,
                'montant_total' => $commande->montant_total,
                'montant_a_payer' => $commande->montant_a_payer,
                'avance' => $commande->avance,
                'reste_a_payer' => $commande->reste_a_payer,
                'statut_paiement' => $commande->statut_paiement_label
            ]
        ]);
    }

    /**
     * Traiter le paiement
     */
    public function store(Request $request, Commande $commande)
    {
        // S'assurer que les montants sont initialisés
        if ($commande->montant_a_payer == 0 || $commande->reste_a_payer == 0) {
            $commande->initialiserPaiement();
        }

        $request->validate([
            'montant' => 'required|numeric|min:0.01|max:' . $commande->montant_total,
            'mode_paiement' => 'required|in:especes,cheque,virement,carte',
            'reference_paiement' => 'nullable|string|max:100',
            'commentaire' => 'nullable|string|max:500'
        ]);

        try {
            $commande->enregistrerPaiement(
                $request->montant,
                $request->mode_paiement,
                $request->reference_paiement,
                $request->commentaire
            );

            return response()->json([
                'success' => true,
                'message' => 'Paiement enregistré avec succès.',
                'commande' => [
                    'avance' => $commande->fresh()->avance,
                    'reste_a_payer' => $commande->fresh()->reste_a_payer,
                    'statut_paiement' => $commande->fresh()->statut_paiement_label
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'enregistrement du paiement: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Afficher l'historique des paiements d'une commande
     */
    public function historique(Commande $commande)
    {
        $paiements = $commande->paiements()->with('user')->orderBy('date_paiement', 'desc')->get();
        
        return response()->json([
            'success' => true,
            'paiements' => $paiements->map(function($paiement) {
                return [
                    'id' => $paiement->id,
                    'montant' => $paiement->montant,
                    'mode_paiement' => $paiement->mode_paiement_label,
                    'reference_paiement' => $paiement->reference_paiement,
                    'commentaire' => $paiement->commentaire,
                    'date_paiement' => $paiement->date_paiement->format('d/m/Y H:i'),
                    'user' => $paiement->user->nom_complet ?? 'Utilisateur'
                ];
            })
        ]);
    }

    /**
     * Exporter la liste des paiements en PDF
     */
    public function exportPdf(Request $request)
    {
        try {
            // Test simple d'abord
            $commandes = Commande::with(['fournisseur'])->limit(5)->get();
            
            $stats = [
                'total_commandes' => $commandes->count(),
                'total_montant' => $commandes->sum('montant_a_payer'),
                'total_paye' => $commandes->sum('avance'),
                'total_reste' => $commandes->sum('reste_a_payer'),
            ];

            // Utiliser la façade PDF standard
            $pdf = Pdf::loadView('paiements.pdf', compact('commandes', 'stats'));
            
            return $pdf->download('paiements-commandes-' . date('Y-m-d') . '.pdf');
            
        } catch (\Exception $e) {
            // Log l'erreur pour le débogage
            \Log::error('Erreur export PDF paiements: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'error' => 'Erreur lors de la génération du PDF: ' . $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ], 500);
        }
    }
}
