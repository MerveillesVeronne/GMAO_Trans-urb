<?php

namespace App\Http\Controllers;

use App\Models\AlerteStock;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlerteStockController extends Controller
{
    /**
     * Afficher la liste des alertes
     */
    public function index(Request $request)
    {
        $query = AlerteStock::with(['stock', 'resoluPar']);

        // Filtres
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('type')) {
            $query->where('type_alerte', $request->type);
        }

        if ($request->filled('date_debut')) {
            $query->whereDate('date_alerte', '>=', $request->date_debut);
        }

        if ($request->filled('date_fin')) {
            $query->whereDate('date_alerte', '<=', $request->date_fin);
        }

        $alertes = $query->orderBy('date_alerte', 'desc')->paginate(20);

        // Statistiques
        $stats = [
            'total' => AlerteStock::count(),
            'actives' => AlerteStock::where('statut', 'active')->count(),
            'resolues' => AlerteStock::where('statut', 'resolue')->count(),
            'ignorees' => AlerteStock::where('statut', 'ignoree')->count(),
        ];

        return view('alertes.index', compact('alertes', 'stats'));
    }

    /**
     * Afficher les détails d'une alerte
     */
    public function show(AlerteStock $alerte)
    {
        $alerte->load(['stock', 'resoluPar']);
        return view('alertes.show', compact('alerte'));
    }

    /**
     * Résoudre une alerte
     */
    public function resoudre(AlerteStock $alerte)
    {
        if (!$alerte->peutEtreResolue()) {
            return redirect()->back()->with('error', 'Cette alerte ne peut pas être résolue.');
        }

        $alerte->resoudre();

        return redirect()->back()->with('success', 'Alerte résolue avec succès.');
    }

    /**
     * Ignorer une alerte
     */
    public function ignorer(AlerteStock $alerte)
    {
        if (!$alerte->peutEtreResolue()) {
            return redirect()->back()->with('error', 'Cette alerte ne peut pas être ignorée.');
        }

        $alerte->ignorer();

        return redirect()->back()->with('success', 'Alerte ignorée avec succès.');
    }

    /**
     * Résoudre toutes les alertes actives
     */
    public function resoudreToutes()
    {
        $alertesActives = AlerteStock::where('statut', 'active')->get();
        
        foreach ($alertesActives as $alerte) {
            $alerte->resoudre();
        }

        return redirect()->back()->with('success', $alertesActives->count() . ' alertes résolues avec succès.');
    }

    /**
     * Vérifier et créer des alertes pour tous les stocks
     */
    public function verifierAlertes()
    {
        $stocks = Stock::where('actif', true)->get();
        $alertesCreees = 0;

        foreach ($stocks as $stock) {
            $stock->verifierAlertes();
            $alertesCreees += $stock->alertes()->where('statut', 'active')->count();
        }

        return redirect()->back()->with('success', 'Vérification terminée. ' . $alertesCreees . ' nouvelles alertes créées.');
    }

    /**
     * Afficher le tableau de bord des alertes
     */
    public function dashboard()
    {
        // Alertes par type
        $alertesParType = AlerteStock::selectRaw('type_alerte, COUNT(*) as total')
            ->groupBy('type_alerte')
            ->get();

        // Alertes par statut
        $alertesParStatut = AlerteStock::selectRaw('statut, COUNT(*) as total')
            ->groupBy('statut')
            ->get();

        // Alertes récentes
        $alertesRecentes = AlerteStock::with(['stock'])
            ->where('statut', 'active')
            ->orderBy('date_alerte', 'desc')
            ->limit(10)
            ->get();

        // Stocks en alerte
        $stocksEnAlerte = Stock::whereHas('alertes', function($query) {
            $query->where('statut', 'active');
        })->with(['alertes' => function($query) {
            $query->where('statut', 'active');
        }])->get();

        return view('alertes.dashboard', compact(
            'alertesParType',
            'alertesParStatut',
            'alertesRecentes',
            'stocksEnAlerte'
        ));
    }

    /**
     * Exporter les alertes en CSV
     */
    public function export(Request $request)
    {
        $query = AlerteStock::with(['stock', 'resoluPar']);

        // Appliquer les mêmes filtres que l'index
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('type')) {
            $query->where('type_alerte', $request->type);
        }

        if ($request->filled('date_debut')) {
            $query->whereDate('date_alerte', '>=', $request->date_debut);
        }

        if ($request->filled('date_fin')) {
            $query->whereDate('date_alerte', '<=', $request->date_fin);
        }

        $alertes = $query->orderBy('date_alerte', 'desc')->get();

        $filename = 'alertes_stock_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($alertes) {
            $file = fopen('php://output', 'w');
            
            // En-têtes
            fputcsv($file, [
                'ID',
                'Produit',
                'Type d\'alerte',
                'Message',
                'Statut',
                'Date d\'alerte',
                'Date de résolution',
                'Résolu par'
            ]);

            // Données
            foreach ($alertes as $alerte) {
                fputcsv($file, [
                    $alerte->id,
                    $alerte->stock->produit,
                    $alerte->type_alerte,
                    $alerte->message,
                    $alerte->statut,
                    $alerte->date_alerte->format('d/m/Y H:i'),
                    $alerte->date_resolution ? $alerte->date_resolution->format('d/m/Y H:i') : '',
                    $alerte->resoluPar ? $alerte->resoluPar->name : ''
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Supprimer une alerte
     */
    public function destroy(AlerteStock $alerte)
    {
        $alerte->delete();

        return redirect()->route('alertes.index')->with('success', 'Alerte supprimée avec succès.');
    }

    /**
     * Afficher les alertes pour un stock spécifique
     */
    public function parStock(Stock $stock)
    {
        $alertes = $stock->alertes()
            ->with(['resoluPar'])
            ->orderBy('date_alerte', 'desc')
            ->paginate(15);

        return view('alertes.par-stock', compact('stock', 'alertes'));
    }
}
