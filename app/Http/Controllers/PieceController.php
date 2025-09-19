<?php

namespace App\Http\Controllers;

use App\Models\Piece;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PieceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pieces = Piece::orderBy('reference')->get();
        
        // Statistiques pour les cartes
        $stats = [
            'total' => $pieces->count(),
            'en_stock' => Piece::enStock()->count(),
            'en_rupture' => Piece::enRupture()->count(),
            'stock_faible' => Piece::stockFaible()->count(),
        ];

        return view('maintenance.magasin.index', compact('pieces', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('maintenance.magasin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reference' => 'required|string|max:50|unique:pieces',
            'designation' => 'required|string|max:200',
            'categorie' => 'required|in:Pièces mécaniques,Pièces électriques,Huiles et lubrifiants,Filtres,Outillage,Consommables',
            'marque_compatible' => 'nullable|string|max:200',
            'quantite_stock' => 'required|integer|min:0',
            'seuil_alerte' => 'required|integer|min:0',
            'prix_unitaire' => 'required|numeric|min:0',
            'fournisseur' => 'nullable|string|max:200',
            'numero_fournisseur' => 'nullable|string|max:100',
            'localisation' => 'nullable|string|max:200',
            'description' => 'nullable|string|max:1000',
            'specifications' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $piece = Piece::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Article ajouté avec succès !',
                'piece' => $piece
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'ajout de l\'article : ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $piece = Piece::findOrFail($id);
        return view('maintenance.magasin.show', compact('piece'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $piece = Piece::findOrFail($id);
        return view('maintenance.magasin.edit', compact('piece'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $piece = Piece::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'reference' => 'required|string|max:50|unique:pieces,reference,' . $id,
            'designation' => 'required|string|max:200',
            'categorie' => 'required|in:Pièces mécaniques,Pièces électriques,Huiles et lubrifiants,Filtres,Outillage,Consommables',
            'marque_compatible' => 'nullable|string|max:200',
            'quantite_stock' => 'required|integer|min:0',
            'seuil_alerte' => 'required|integer|min:0',
            'prix_unitaire' => 'required|numeric|min:0',
            'fournisseur' => 'nullable|string|max:200',
            'numero_fournisseur' => 'nullable|string|max:100',
            'localisation' => 'nullable|string|max:200',
            'description' => 'nullable|string|max:1000',
            'specifications' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $piece->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Article mis à jour avec succès !',
                'piece' => $piece
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour : ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $piece = Piece::findOrFail($id);
            $piece->delete();

            return response()->json([
                'success' => true,
                'message' => 'Article supprimé avec succès !'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression : ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update stock quantity
     */
    public function updateStock(Request $request, string $id)
    {
        $piece = Piece::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'quantite_stock' => 'required|integer|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $piece->update(['quantite_stock' => $request->quantite_stock]);

            return response()->json([
                'success' => true,
                'message' => 'Stock mis à jour avec succès !',
                'piece' => $piece
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour du stock : ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get pieces by category
     */
    public function getByCategory($categorie)
    {
        $pieces = Piece::parCategorie($categorie)->get();
        return response()->json($pieces);
    }

    /**
     * Get pieces in low stock
     */
    public function getLowStock()
    {
        $pieces = Piece::stockFaible()->get();
        return response()->json($pieces);
    }
}
