<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class VehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $vehicules = Vehicule::orderBy('numero')->get();
        
        // Statistiques pour les cartes
        $stats = [
            'en_service' => Vehicule::enService()->count(),
            'au_garage' => Vehicule::auGarage()->count(),
            'en_reparation' => Vehicule::enReparation()->count(),
            'maintenance' => Vehicule::enMaintenance()->count(),
        ];

        // Détecter si on est dans le contexte logistique
        $isLogistique = $request->route()->getPrefix() === 'logistique';

        return view('maintenance.vehicules.index', compact('vehicules', 'stats', 'isLogistique'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('maintenance.vehicules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'numero' => 'required|string|max:50|unique:vehicules',
            'immatriculation' => 'required|string|max:20|unique:vehicules',
            'type_vehicule' => 'required|in:GRAND BUS,PETIT BUS,AUTRES',
            'marque' => 'required|in:GOLDEN D.,MERCEDES MCV,TOYOTA COASTER',
            'modele' => 'required|string|max:100',
            'annee' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'affectation' => 'required|in:Location,Urbain,Inter-urbain',
            'entite_location' => 'nullable|string|max:255',
            'ligne_transport_id' => 'nullable|exists:lignes_transports,id',
            'statut' => 'required|in:En Service,Au Garage,En Réparation,Maintenance',
            'capacite' => 'nullable|integer|min:1|max:200',
            'kilometrage' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $vehicule = Vehicule::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Véhicule ajouté avec succès !',
                'vehicule' => $vehicule
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'ajout du véhicule : ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vehicule = Vehicule::with(['interventions', 'planningMaintenances'])->findOrFail($id);
        return view('maintenance.vehicules.show', compact('vehicule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $vehicule = Vehicule::findOrFail($id);
        return view('maintenance.vehicules.edit', compact('vehicule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vehicule = Vehicule::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'numero' => 'required|string|max:50|unique:vehicules,numero,' . $id,
            'immatriculation' => 'required|string|max:20|unique:vehicules,immatriculation,' . $id,
            'type_vehicule' => 'required|in:GRAND BUS,PETIT BUS,AUTRES',
            'marque' => 'required|string|max:100',
            'modele' => 'required|string|max:100',
            'annee' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'affectation' => 'required|in:Location,Urbain,Inter-urbain',
            'entite_location' => 'nullable|string|max:255',
            'ligne_transport_id' => 'nullable|exists:lignes_transports,id',
            'statut' => 'required|in:En Service,Au Garage,En Réparation,Maintenance',
            'capacite' => 'nullable|integer|min:1|max:200',
            'kilometrage' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $vehicule->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Véhicule mis à jour avec succès !',
                'vehicule' => $vehicule
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
            $vehicule = Vehicule::findOrFail($id);
            $vehicule->delete();

            return response()->json([
                'success' => true,
                'message' => 'Véhicule supprimé avec succès !'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression : ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get vehicles for select dropdown
     */
    public function getVehicules()
    {
        $vehicules = Vehicule::select('id', 'numero', 'marque', 'modele')
                            ->orderBy('numero')
                            ->get()
                            ->map(function($vehicule) {
                                return [
                                    'id' => $vehicule->id,
                                    'text' => $vehicule->nom_complet
                                ];
                            });

        return response()->json($vehicules);
    }

    /**
     * Export la liste des véhicules en PDF
     */
    public function exportPdf()
    {
        $vehicules = Vehicule::with(['ligneTransport'])
            ->orderBy('numero')
            ->get();

        $pdf = Pdf::loadView('maintenance.vehicules.pdf.liste', compact('vehicules'));
        
        return $pdf->download('liste-vehicules-' . date('Y-m-d') . '.pdf');
    }

    /**
     * Export les interventions d'un véhicule en PDF
     */
    public function exportInterventionsPdf(string $id)
    {
        $vehicule = Vehicule::with(['interventions.user', 'interventions.intervenant', 'ligneTransport', 'carburations.chauffeur'])
            ->findOrFail($id);

        $pdf = Pdf::loadView('maintenance.vehicules.pdf.interventions', compact('vehicule'));
        
        return $pdf->download('interventions-' . $vehicule->numero . '-' . date('Y-m-d') . '.pdf');
    }
}
