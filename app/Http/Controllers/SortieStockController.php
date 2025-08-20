<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\SortieStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SortieStockController extends Controller
{
    /**
     * Afficher la liste des sorties de stock
     */
    public function index()
    {
        $sorties = SortieStock::with(['stock', 'validePar'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('stocks.sorties.index', compact('sorties'));
    }

    /**
     * Afficher le formulaire de sortie de stock
     */
    public function create()
    {
        $stocks = Stock::actifs()->get();
        $services = [
            'DIRECTION RESSOURCE HUMAINE ET JURIDIQUE',
            'DIRECTION GENERALE',
            'SERVICE RESSOURCE HUMAINE',
            'SERVICE JURIDIQUE ET CONTENTIEUX',
            'CHEFS DE SERVICES R.H ET R.S.J',
            'SERVICE COURRIERS ET ARCHIVES',
            'ACCUEIL-COULOIR',
            'DIRECTEUR GENERAL ADJOINT',
            'SECRETARIAT DIRECTEUR GENERALE',
            'MAINTENANCE',
            'LOGISTIQUE',
            'CHAUFFEURS'
        ];

        $postes = [
            'Directeur',
            'Directeur Adjoint',
            'Chef de Service',
            'Chargé d\'étude',
            'Contrôleur',
            'Agent',
            'Secrétaire',
            'Réceptionniste',
            'Technicien',
            'Chauffeur',
            'Mécanicien'
        ];

        return view('stocks.sorties.create', compact('stocks', 'services', 'postes'));
    }

    /**
     * Enregistrer une nouvelle sortie de stock
     */
    public function store(Request $request)
    {
        $request->validate([
            'stock_id' => 'required|exists:stocks,id',
            'quantite_sortie' => 'required|integer|min:1',
            'service_destinataire' => 'required|string|max:255',
            'personne_destinataire' => 'required|string|max:255',
            'poste_destinataire' => 'required|string|max:255',
            'motif_sortie' => 'required|string|max:255',
            'commentaires' => 'nullable|string|max:1000'
        ]);

        try {
            DB::beginTransaction();

            $stock = Stock::findOrFail($request->stock_id);

            // Vérifier si on a assez de stock
            if (!$stock->peutRetirer($request->quantite_sortie)) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Stock insuffisant. Quantité disponible : ' . $stock->quantite_disponible . ' ' . $stock->unite);
            }

            // Calculer le coût total
            $cout_total = $request->quantite_sortie * ($stock->cout_unitaire ?? 0);
            
            // Créer la sortie
            $sortie = SortieStock::create([
                'stock_id' => $stock->id,
                'reference_produit' => $stock->produit,
                'quantite_sortie' => $request->quantite_sortie,
                'unite' => $stock->unite,
                'cout_unitaire' => $stock->cout_unitaire,
                'cout_total' => $cout_total,
                'service_destinataire' => $request->service_destinataire,
                'personne_destinataire' => $request->personne_destinataire,
                'poste_destinataire' => $request->poste_destinataire,
                'motif_sortie' => $request->motif_sortie,
                'valide_par' => auth()->id(),
                'valide_le' => now(),
                'commentaires' => $request->commentaires,
                'statut' => 'validee'
            ]);

            // Retirer du stock
            $stock->retirerStock($request->quantite_sortie);

            // Vérifier les alertes après sortie
            $stock->verifierAlertes();

            DB::commit();

            return redirect()->route('stocks.sorties.index')
                ->with('success', 'Sortie de stock enregistrée avec succès. ' . 
                      $request->quantite_sortie . ' ' . $stock->unite . ' de ' . $stock->produit . 
                      ' remis à ' . $request->personne_destinataire . ' (' . $request->poste_destinataire . ')');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors de l\'enregistrement : ' . $e->getMessage());
        }
    }

    /**
     * Afficher les détails d'une sortie
     */
    public function show(SortieStock $sortie)
    {
        $sortie->load(['stock', 'validePar']);
        return view('stocks.sorties.show', compact('sortie'));
    }

    /**
     * Annuler une sortie
     */
    public function annuler(SortieStock $sortie)
    {
        try {
            $sortie->annuler();
            return redirect()->route('stocks.sorties.index')
                ->with('success', 'Sortie annulée avec succès. Le stock a été remis à jour.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erreur lors de l\'annulation : ' . $e->getMessage());
        }
    }

    /**
     * Afficher l'historique des sorties pour un stock
     */
    public function historique(Stock $stock)
    {
        $sorties = $stock->getHistoriqueSorties();
        return view('stocks.sorties.historique', compact('stock', 'sorties'));
    }

    /**
     * Afficher le rapport de traçabilité
     */
    public function tracabilite(Request $request)
    {
        $query = SortieStock::with(['stock', 'validePar']);

        // Filtres
        if ($request->filled('service')) {
            $query->where('service_destinataire', $request->service);
        }

        if ($request->filled('personne')) {
            $query->where('personne_destinataire', 'like', '%' . $request->personne . '%');
        }

        if ($request->filled('date_debut')) {
            $query->whereDate('created_at', '>=', $request->date_debut);
        }

        if ($request->filled('date_fin')) {
            $query->whereDate('created_at', '<=', $request->date_fin);
        }

        $sorties = $query->orderBy('created_at', 'desc')->paginate(50);

        // Statistiques
        $stats = [
            'total_sorties' => $query->count(),
            'total_valeur' => $query->sum('cout_total'),
            'services' => SortieStock::select('service_destinataire')
                ->distinct()
                ->pluck('service_destinataire')
        ];

        return view('stocks.sorties.tracabilite', compact('sorties', 'stats'));
    }

    /**
     * Obtenir les informations d'un stock pour le formulaire AJAX
     */
    public function getStockInfo($stockId)
    {
        $stock = Stock::findOrFail($stockId);
        return response()->json([
            'produit' => $stock->produit,
            'quantite_disponible' => $stock->quantite_disponible,
            'unite' => $stock->unite,
            'cout_unitaire' => $stock->cout_unitaire,
            'emplacement' => $stock->emplacement
        ]);
    }
}
