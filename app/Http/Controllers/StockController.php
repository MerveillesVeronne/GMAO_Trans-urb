<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    /**
     * Afficher la liste des stocks
     */
    public function index(Request $request)
    {
        $query = Stock::query();

        // Filtres
        if ($request->filled('categorie')) {
            $query->where('categorie', $request->categorie);
        }

        if ($request->filled('en_alerte')) {
            if ($request->en_alerte == '1') {
                $query->enAlerte();
            }
        }

        if ($request->filled('recherche')) {
            $query->where('produit', 'like', '%' . $request->recherche . '%')
                  ->orWhere('description', 'like', '%' . $request->recherche . '%');
        }

        $stocks = $query->orderBy('produit')->paginate(20);
        $categories = Stock::distinct()->pluck('categorie')->filter();

        return view('stocks.index', compact('stocks', 'categories'));
    }

    /**
     * Afficher le formulaire de création d'un stock
     */
    public function create()
    {
        $categories = Stock::distinct()->pluck('categorie')->filter();
        
        return view('stocks.create', compact('categories'));
    }

    /**
     * Enregistrer un nouveau stock
     */
    public function store(Request $request)
    {
        $request->validate([
            'produit' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantite_disponible' => 'required|integer|min:0',
            'quantite_minimale' => 'required|integer|min:0',
            'unite' => 'required|string|max:50',
            'emplacement' => 'nullable|string|max:255',
            'cout_unitaire' => 'nullable|numeric|min:0',
            'categorie' => 'nullable|string|max:100'
        ]);

        // Générer la référence unique
        $reference_unique = Stock::genererReferenceUnique($request->produit);
        
        // Créer le stock avec la référence unique
        $stock = Stock::create(array_merge($request->all(), [
            'reference_unique' => $reference_unique,
            'actif' => true
        ]));

        // Vérifier les alertes après création
        $stock->verifierAlertes();

        return redirect()->route('stocks.index')
                       ->with('success', 'Stock créé avec succès');
    }

    /**
     * Afficher les détails d'un stock
     */
    public function show(Stock $stock)
    {
        return view('stocks.show', compact('stock'));
    }

    /**
     * Afficher le formulaire d'édition d'un stock
     */
    public function edit(Stock $stock)
    {
        $categories = Stock::distinct()->pluck('categorie')->filter();
        
        return view('stocks.edit', compact('stock', 'categories'));
    }

    /**
     * Mettre à jour un stock
     */
    public function update(Request $request, Stock $stock)
    {
        $request->validate([
            'produit' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantite_disponible' => 'required|integer|min:0',
            'quantite_minimale' => 'required|integer|min:0',
            'unite' => 'required|string|max:50',
            'emplacement' => 'nullable|string|max:255',
            'cout_unitaire' => 'nullable|numeric|min:0',
            'categorie' => 'nullable|string|max:100',
            'actif' => 'boolean'
        ]);

        $stock->update($request->all());

        // Vérifier les alertes après mise à jour
        $stock->verifierAlertes();

        return redirect()->route('stocks.index')
                       ->with('success', 'Stock mis à jour avec succès');
    }

    /**
     * Supprimer un stock
     */
    public function destroy(Stock $stock)
    {
        $stock->delete();

        return redirect()->route('stocks.index')
                       ->with('success', 'Stock supprimé avec succès');
    }

    /**
     * Afficher le tableau de bord des stocks
     */
    public function dashboard()
    {
        $totalProduits = Stock::count();
        $produitsEnAlerte = Stock::enAlerte()->count();
        $produitsActifs = Stock::actifs()->count();
        $valeurTotale = Stock::sum(DB::raw('quantite_disponible * cout_unitaire'));

        $produitsEnAlerteList = Stock::enAlerte()->orderBy('quantite_disponible')->limit(10)->get();
        $produitsRecents = Stock::orderBy('created_at', 'desc')->limit(10)->get();
        
        // Variables supplémentaires pour la vue
        $stocksEnAlerte = Stock::enAlerte()->orderBy('quantite_disponible')->limit(10)->get();
        $categories = Stock::distinct()->pluck('categorie')->filter();
        $stocks = Stock::all();

        return view('stocks.dashboard', compact(
            'totalProduits', 
            'produitsEnAlerte', 
            'produitsActifs', 
            'valeurTotale', 
            'produitsEnAlerteList', 
            'produitsRecents',
            'stocksEnAlerte',
            'categories',
            'stocks'
        ));
    }

    /**
     * Ajuster le stock (ajouter/retirer)
     */
    public function ajuster(Request $request, Stock $stock)
    {
        $request->validate([
            'type' => 'required|in:ajouter,retirer',
            'quantite' => 'required|integer|min:1',
            'raison' => 'required|string|max:255'
        ]);

        if ($request->type === 'ajouter') {
            $stock->ajouterStock($request->quantite);
            $message = "Stock augmenté de {$request->quantite} {$stock->unite}";
        } else {
            if (!$stock->retirerStock($request->quantite)) {
                return back()->withErrors(['quantite' => 'Stock insuffisant']);
            }
            $message = "Stock diminué de {$request->quantite} {$stock->unite}";
        }

        // Ici on pourrait enregistrer l'historique des mouvements de stock

        return back()->with('success', $message);
    }
}
