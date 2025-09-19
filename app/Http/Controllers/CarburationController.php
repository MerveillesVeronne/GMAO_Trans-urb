<?php

namespace App\Http\Controllers;

use App\Models\Carburation;
use App\Models\Vehicule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class CarburationController extends Controller
{
    public function index()
    {
        $carburations = Carburation::with(['vehicule', 'chauffeur'])
            ->orderBy('date_carburation', 'desc')
            ->orderBy('heure_carburation', 'desc')
            ->paginate(15);

        return view('maintenance.carburations.index', compact('carburations'));
    }

    public function create()
    {
        $vehicules = Vehicule::orderBy('numero')->get();
        // Récupérer les utilisateurs avec le rôle chauffeur via la relation
        $chauffeurs = User::whereHas('role', function($query) {
            $query->where('nom_role', 'chauffeur');
        })->orderBy('nom')->get();

        return view('maintenance.carburations.create', compact('vehicules', 'chauffeurs'));
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'vehicule_id' => 'required|exists:vehicules,id',
            'chauffeur_id' => 'required|exists:users,id',
            'date_carburation' => 'required|date',
            'heure_carburation' => 'required',
            'quantite_litres' => 'required|numeric|min:0.01',
            'prix_litre' => 'required|numeric|min:0.01',
            'etat' => 'required|in:Planifiée,Effectuée,Annulée',
            'type_carburation' => 'required|in:Essence,Diesel,GPL,Électrique',
            'notes' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Calculer le coût total
        $coutTotal = $request->quantite_litres * $request->prix_litre;

        $carburation = Carburation::create([
            'vehicule_id' => $request->vehicule_id,
            'chauffeur_id' => $request->chauffeur_id,
            'date_carburation' => $request->date_carburation,
            'heure_carburation' => $request->heure_carburation,
            'quantite_litres' => $request->quantite_litres,
            'prix_litre' => $request->prix_litre,
            'cout_total' => $coutTotal,
            'etat' => $request->etat,
            'type_carburation' => $request->type_carburation,
            'notes' => $request->notes,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Carburation créée avec succès',
            'data' => $carburation
        ]);
    }

    public function show(Carburation $carburation)
    {
        $carburation->load(['vehicule', 'chauffeur']);
        return view('maintenance.carburations.show', compact('carburation'));
    }

    public function edit(Carburation $carburation)
    {
        $vehicules = Vehicule::orderBy('numero')->get();
        // Récupérer les utilisateurs avec le rôle chauffeur via la relation
        $chauffeurs = User::whereHas('role', function($query) {
            $query->where('nom_role', 'chauffeur');
        })->orderBy('nom')->get();

        return view('maintenance.carburations.edit', compact('carburation', 'vehicules', 'chauffeurs'));
    }

    public function update(Request $request, Carburation $carburation): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'vehicule_id' => 'required|exists:vehicules,id',
            'chauffeur_id' => 'required|exists:users,id',
            'date_carburation' => 'required|date',
            'heure_carburation' => 'required',
            'quantite_litres' => 'required|numeric|min:0.01',
            'prix_litre' => 'required|numeric|min:0.01',
            'etat' => 'required|in:Planifiée,Effectuée,Annulée',
            'type_carburation' => 'required|in:Essence,Diesel,GPL,Électrique',
            'notes' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Calculer le coût total
        $coutTotal = $request->quantite_litres * $request->prix_litre;

        $carburation->update([
            'vehicule_id' => $request->vehicule_id,
            'chauffeur_id' => $request->chauffeur_id,
            'date_carburation' => $request->date_carburation,
            'heure_carburation' => $request->heure_carburation,
            'quantite_litres' => $request->quantite_litres,
            'prix_litre' => $request->prix_litre,
            'cout_total' => $coutTotal,
            'etat' => $request->etat,
            'type_carburation' => $request->type_carburation,
            'notes' => $request->notes,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Carburation mise à jour avec succès',
            'data' => $carburation
        ]);
    }

    public function destroy(Carburation $carburation): JsonResponse
    {
        $carburation->delete();

        return response()->json([
            'success' => true,
            'message' => 'Carburation supprimée avec succès'
        ]);
    }

    public function getForVehicule($vehiculeId): JsonResponse
    {
        $carburations = Carburation::where('vehicule_id', $vehiculeId)
            ->with(['chauffeur'])
            ->orderBy('date_carburation', 'desc')
            ->orderBy('heure_carburation', 'desc')
            ->get();

        return response()->json($carburations);
    }

    /**
     * Export PDF d'une carburation individuelle
     */
    public function exportPdf(string $id)
    {
        $carburation = Carburation::with(['vehicule', 'chauffeur'])
            ->findOrFail($id);

        $pdf = Pdf::loadView('maintenance.carburations.pdf.carburation', compact('carburation'));
        
        return $pdf->download('carburation-' . $carburation->vehicule->numero . '-' . date('Y-m-d') . '.pdf');
    }
}
