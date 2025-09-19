<?php

namespace App\Http\Controllers;

use App\Models\PlanningMaintenance;
use App\Models\Vehicule;
use App\Models\Carburation;
use App\Models\Intervention;
use App\Models\Intervenant;
use App\Models\Piece;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlanningMaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer les vraies données de la base
        $planningMaintenances = PlanningMaintenance::with('vehicule')
            ->orderBy('date_planifiee')
            ->get();
            
        $interventions = Intervention::with('vehicule')
            ->orderBy('date_debut')
            ->get();
            
        $carburations = Carburation::with('vehicule')
            ->orderBy('date_carburation')
            ->get();
        
        // Calculer les vraies statistiques
        $stats = [
            'planifiees' => $planningMaintenances->where('statut', 'Planifiee')->count() + 
                           $interventions->where('statut', 'En Attente')->count() +
                           $carburations->where('etat', 'Planifiée')->count(),
            'en_cours' => $planningMaintenances->where('statut', 'En Cours')->count() + 
                         $interventions->where('statut', 'En Cours')->count() +
                         $carburations->where('etat', 'Effectuée')->count(),
            'en_retard' => $planningMaintenances->where('statut', 'En Retard')->count() +
                          $interventions->where('statut', 'En Retard')->count(),
            'terminees' => $planningMaintenances->where('statut', 'Terminee')->count() +
                          $interventions->where('statut', 'Terminee')->count() +
                          $interventions->where('statut', 'Livré')->count(),
        ];

        // Récupérer les données pour le calendrier (prochaines 4 semaines)
        $dateDebut = now();
        $dateFin = now()->addWeeks(4);
        
        $planningCalendrier = $planningMaintenances
            ->where('date_planifiee', '>=', $dateDebut->format('Y-m-d'))
            ->where('date_planifiee', '<=', $dateFin->format('Y-m-d'))
            ->groupBy(function($item) {
                return \Carbon\Carbon::parse($item->date_planifiee)->format('Y-W');
            });
            
        $interventionsCalendrier = $interventions
            ->where('date_debut', '>=', $dateDebut->format('Y-m-d'))
            ->where('date_debut', '<=', $dateFin->format('Y-m-d'))
            ->groupBy(function($item) {
                return \Carbon\Carbon::parse($item->date_debut)->format('Y-W');
            });
            
        $carburationsCalendrier = $carburations
            ->where('date_carburation', '>=', $dateDebut->format('Y-m-d'))
            ->where('date_carburation', '<=', $dateFin->format('Y-m-d'))
            ->groupBy(function($item) {
                return \Carbon\Carbon::parse($item->date_carburation)->format('Y-W');
            });

        // Récupérer les données pour le modal
        $vehicules = Vehicule::orderBy('numero')->get();
        $techniciens = Intervenant::where('fonction_technique', '!=', null)->orderBy('prenom')->orderBy('nom')->get();
        $chauffeurs = User::whereHas('role', function($query) {
            $query->where('code_role', 'CHAUFFEUR');
        })->orderBy('nom')->get();
        $pieces = Piece::orderBy('designation')->get();

        return view('maintenance.planning.index', compact(
            'planningMaintenances', 
            'interventions',
            'carburations', 
            'stats',
            'planningCalendrier',
            'interventionsCalendrier',
            'carburationsCalendrier',
            'vehicules',
            'techniciens',
            'chauffeurs',
            'pieces'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicules = Vehicule::orderBy('numero')->get();
        $techniciens = Intervenant::where('fonction_technique', '!=', null)->orderBy('prenom')->orderBy('nom')->get();
        $chauffeurs = User::whereHas('role', function($query) {
            $query->where('code_role', 'CHAUFFEUR');
        })->orderBy('nom')->get();
        $pieces = Piece::orderBy('designation')->get();
        
        return view('maintenance.planning.create', compact('vehicules', 'techniciens', 'chauffeurs', 'pieces'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $typePlanning = $request->input('type_planning');
        
        // Validation de base commune
        $baseRules = [
            'type_planning' => 'required|in:intervention,carburation',
            'vehicule_id' => 'required|exists:vehicules,id',
        ];
        
        // Règles spécifiques selon le type
        if ($typePlanning === 'intervention') {
            $specificRules = [
                'type_intervention' => 'required|string|max:100',
                'nature_intervention' => 'nullable|string|max:100',
                'priorite_intervention' => 'required|in:Normal,À prévoir,Urgent',
                'statut_intervention' => 'required|in:En Attente,En Cours,Terminee,Annulee,Livré',
                'date_debut' => 'required|date',
                'date_fin_prevue' => 'nullable|date|after:date_debut',
                'technicien' => 'required|string|max:100',
                'description' => 'required|string|max:1000',
                'pieces_necessaires_text' => 'nullable|string|max:500',
                'quantite_pieces' => 'nullable|string|max:500',
            ];
        } else { // carburation
            $specificRules = [
                'chauffeur_id' => 'required|exists:users,id',
                'date_carburation' => 'required|date|after_or_equal:today',
                'heure_carburation' => 'required|date_format:H:i',
                'quantite_litres' => 'required|numeric|min:0.01',
                'prix_litre' => 'required|numeric|min:0.01',
                'type_carburation' => 'required|in:Diesel,Essence,GPL,Électrique',
                'etat' => 'required|in:Planifiée,Effectuée,Annulée',
                'notes_carburation' => 'nullable|string|max:500',
            ];
        }
        
        $validator = Validator::make($request->all(), array_merge($baseRules, $specificRules));

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            if ($typePlanning === 'intervention') {
                // Créer une intervention planifiée
                $interventionData = [
                    'vehicule_id' => $request->vehicule_id,
                    'type_intervention' => $request->type_intervention,
                    'nature_intervention' => $request->nature_intervention,
                    'priorite' => $request->priorite_intervention,
                    'statut' => $request->statut_intervention,
                    'date_debut' => $request->date_debut,
                    'date_fin_prevue' => $request->date_fin_prevue,
                    'technicien' => $request->technicien,
                    'description' => $request->description,
                    'pieces_necessaires' => $request->pieces_necessaires_text,
                    'quantite_pieces' => $request->quantite_pieces,
                ];
                
                // Créer l'intervention via le modèle Intervention
                $intervention = Intervention::create($interventionData);
                
                $message = 'Intervention planifiée avec succès !';
                $data = $intervention->load('vehicule');
                
            } else { // carburation
                // Créer une carburation planifiée
                $carburationData = [
                    'vehicule_id' => $request->vehicule_id,
                    'chauffeur_id' => $request->chauffeur_id,
                    'date_carburation' => $request->date_carburation,
                    'heure_carburation' => $request->heure_carburation,
                    'quantite_litres' => $request->quantite_litres,
                    'prix_litre' => $request->prix_litre,
                    'type_carburation' => $request->type_carburation,
                    'etat' => $request->etat,
                    'notes' => $request->notes_carburation,
                ];
                
                // Créer la carburation via le modèle Carburation
                $carburation = Carburation::create($carburationData);
                
                $message = 'Carburation planifiée avec succès !';
                $data = $carburation->load('vehicule');
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la planification : ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $planningMaintenance = PlanningMaintenance::with('vehicule')->findOrFail($id);
        return view('maintenance.planning.show', compact('planningMaintenance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $planningMaintenance = PlanningMaintenance::findOrFail($id);
        $vehicules = Vehicule::orderBy('numero')->get();
        return view('maintenance.planning.edit', compact('planningMaintenance', 'vehicules'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $planningMaintenance = PlanningMaintenance::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'vehicule_id' => 'required|exists:vehicules,id',
            'type_maintenance' => 'required|in:Preventive,Corrective,Revision,Inspection,Reparation',
            'date_planifiee' => 'required|date',
            'heure_debut' => 'required|date_format:H:i',
            'duree_estimee' => 'required|numeric|min:0.5|max:24',
            'priorite' => 'required|in:Basse,Normale,Haute,Urgente',
            'technicien' => 'required|string|max:100',
            'atelier' => 'required|string|max:200',
            'description_travaux' => 'required|string|max:1000',
            'pieces_necessaires' => 'nullable|string|max:500',
            'notes' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $planningMaintenance->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Planning mis à jour avec succès !',
                'planningMaintenance' => $planningMaintenance->load('vehicule')
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
            $planningMaintenance = PlanningMaintenance::findOrFail($id);
            $planningMaintenance->delete();

            return response()->json([
                'success' => true,
                'message' => 'Planning supprimé avec succès !'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression : ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Change status of planning
     */
    public function changeStatus(Request $request, string $id)
    {
        $planningMaintenance = PlanningMaintenance::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'statut' => 'required|in:Planifiee,En Cours,Terminee,Annulee'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $planningMaintenance->update(['statut' => $request->statut]);

            return response()->json([
                'success' => true,
                'message' => 'Statut mis à jour avec succès !',
                'planningMaintenance' => $planningMaintenance
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour du statut : ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get planning by date
     */
    public function getByDate($date)
    {
        $planningMaintenances = PlanningMaintenance::parDate($date)->with('vehicule')->get();
        return response()->json($planningMaintenances);
    }

    /**
     * Get planning by technician
     */
    public function getByTechnician($technicien)
    {
        $planningMaintenances = PlanningMaintenance::parTechnicien($technicien)->with('vehicule')->get();
        return response()->json($planningMaintenances);
    }

    /**
     * Export PDF du planning
     */
    public function exportPdf(Request $request)
    {
        $type = $request->get('type', 'all'); // all, interventions, carburations
        
        $planningMaintenances = PlanningMaintenance::with('vehicule')->orderBy('date_planifiee')->get();
        $carburations = Carburation::with('vehicule')->orderBy('date_carburation')->get();
        
        // Filtrer selon le type demandé
        if ($type === 'interventions') {
            $carburations = collect();
        } elseif ($type === 'carburations') {
            $planningMaintenances = collect();
        }
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('maintenance.planning.pdf.planning', compact('planningMaintenances', 'carburations', 'type'));
        
        return $pdf->download('planning-maintenance-' . $type . '-' . now()->format('Y-m-d') . '.pdf');
    }
}
