<?php

namespace App\Http\Controllers;

use App\Models\LigneTransport;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class LigneTransportController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'type_affectation' => 'required|in:Location,Urbain,Inter-urbain',
        ]);

        $ligneTransport = LigneTransport::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Ligne de transport créée avec succès',
            'data' => $ligneTransport
        ]);
    }

    /**
     * Get all active transport lines for select options
     */
    public function getForSelect(): JsonResponse
    {
        $lignes = LigneTransport::actives()
            ->orderBy('type_affectation')
            ->orderBy('nom')
            ->get(['id', 'nom', 'type_affectation']);

        return response()->json($lignes);
    }
}
