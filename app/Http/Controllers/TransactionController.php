<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\PaiementContrat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        // Récupérer tous les paiements (commandes et contrats)
        $paiementsCommandes = Paiement::with(['commande.bonCommande', 'user'])
            ->get()
            ->map(function($paiement) {
                $paiement->type = 'commande';
                return $paiement;
            });

        $paiementsContrats = PaiementContrat::with(['contrat.fournisseur', 'user'])
            ->get()
            ->map(function($paiement) {
                $paiement->type = 'contrat';
                return $paiement;
            });

        // Combiner et trier par date
        $transactions = $paiementsCommandes->concat($paiementsContrats)
            ->sortByDesc('date_paiement');

        // Appliquer les filtres
        if ($request->filled('type')) {
            $transactions = $transactions->where('type', $request->type);
        }

        if ($request->filled('mode_paiement')) {
            $transactions = $transactions->where('mode_paiement', $request->mode_paiement);
        }

        // Tri
        $tri = $request->get('tri', 'recent');
        switch ($tri) {
            case 'ancien':
                $transactions = $transactions->sortBy('date_paiement');
                break;
            case 'montant':
                $transactions = $transactions->sortByDesc('montant');
                break;
            case 'mode':
                $transactions = $transactions->sortBy('mode_paiement');
                break;
            default:
                $transactions = $transactions->sortByDesc('date_paiement');
        }

        // Statistiques
        $stats = [
            'total_transactions' => $transactions->count(),
            'total_montant' => $transactions->sum('montant'),
            'par_type' => $transactions->groupBy('type')->map->count(),
            'par_mode' => $transactions->groupBy('mode_paiement')->map->count()
        ];

        return view('transactions.index', compact('transactions', 'stats'));
    }

    /**
     * Afficher les détails d'une transaction
     */
    public function show($id, $type)
    {
        if ($type === 'commande') {
            $transaction = Paiement::with(['commande.fournisseur', 'commande.bonCommande', 'user'])->findOrFail($id);
        } else {
            $transaction = PaiementContrat::with(['contrat.fournisseur', 'user'])->findOrFail($id);
        }

        return view('transactions.show', compact('transaction', 'type'));
    }

    /**
     * Exporter la liste des transactions en PDF
     */
    public function exportPdf(Request $request)
    {
        // Récupérer tous les paiements (commandes et contrats)
        $paiementsCommandes = Paiement::with(['commande.bonCommande', 'user'])
            ->get()
            ->map(function($paiement) {
                $paiement->type = 'commande';
                return $paiement;
            });

        $paiementsContrats = PaiementContrat::with(['contrat.fournisseur', 'user'])
            ->get()
            ->map(function($paiement) {
                $paiement->type = 'contrat';
                return $paiement;
            });

        // Combiner et trier par date
        $transactions = $paiementsCommandes->concat($paiementsContrats)
            ->sortByDesc('date_paiement');

        // Appliquer les filtres
        if ($request->filled('type')) {
            $transactions = $transactions->where('type', $request->type);
        }

        if ($request->filled('mode_paiement')) {
            $transactions = $transactions->where('mode_paiement', $request->mode_paiement);
        }

        // Tri
        $tri = $request->get('tri', 'recent');
        switch ($tri) {
            case 'ancien':
                $transactions = $transactions->sortBy('date_paiement');
                break;
            case 'montant':
                $transactions = $transactions->sortByDesc('montant');
                break;
            case 'mode':
                $transactions = $transactions->sortBy('mode_paiement');
                break;
            default:
                $transactions = $transactions->sortByDesc('date_paiement');
        }

        // Statistiques
        $stats = [
            'total_transactions' => $transactions->count(),
            'total_montant' => $transactions->sum('montant'),
            'par_type' => $transactions->groupBy('type')->map->count(),
            'par_mode' => $transactions->groupBy('mode_paiement')->map->count()
        ];

        $pdf = PDF::loadView('transactions.pdf', compact('transactions', 'stats'));
        
        return $pdf->download('historique-transactions-' . date('Y-m-d') . '.pdf');
    }
}
