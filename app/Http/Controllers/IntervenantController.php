<?php

namespace App\Http\Controllers;

use App\Models\Intervenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IntervenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $techniciens = Intervenant::orderBy('nom')->get();
        
        $stats = [
            'total' => Intervenant::count(),
            'actifs' => Intervenant::where('statut', 'Actif')->count(),
            'experts' => Intervenant::where('niveau_competence', 'Expert')->count(),
            'en_formation' => Intervenant::where('statut', 'En Formation')->count(),
        ];

        return view('maintenance.techniciens.index', compact('techniciens', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('maintenance.techniciens.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'matricule' => 'required|string|max:50|unique:intervenants',
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'fonction_technique' => 'required|string|max:200',
            'specialite' => 'nullable|string|max:200',
            'niveau_competence' => 'required|in:Débutant,Intermédiaire,Expert',
            'telephone' => 'required|string|max:20',
            'email' => 'nullable|email|max:100',
            'atelier' => 'nullable|string|max:200',
            'date_embauche' => 'required|date|before_or_equal:today',
            'statut' => 'required|in:Actif,Inactif,En Formation,En Congé',
            'competences' => 'nullable|string|max:1000',
            'formations_suivies' => 'nullable|string|max:1000',
            'notes' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $technicien = Intervenant::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Technicien ajouté avec succès !',
                'technicien' => $technicien
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'ajout du technicien : ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Intervenant $technicien)
    {
        $technicien->load(['interventions', 'planningMaintenances']);
        
        // Statistiques du technicien
        $stats = [
            'total_interventions' => $technicien->interventions->count(),
            'interventions_en_cours' => $technicien->interventions->where('statut', 'En Cours')->count(),
            'interventions_terminees' => $technicien->interventions->where('statut', 'Terminee')->count(),
            'planning_en_cours' => $technicien->planningMaintenances->where('statut', 'En Cours')->count(),
            'planning_termines' => $technicien->planningMaintenances->where('statut', 'Terminee')->count(),
        ];

        return view('maintenance.techniciens.show', compact('technicien', 'stats'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Intervenant $technicien)
    {
        return view('maintenance.techniciens.edit', compact('technicien'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Intervenant $technicien)
    {
        $validator = Validator::make($request->all(), [
            'matricule' => 'required|string|max:50|unique:intervenants,matricule,' . $technicien->id,
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'fonction_technique' => 'required|string|max:200',
            'specialite' => 'nullable|string|max:200',
            'niveau_competence' => 'required|in:Débutant,Intermédiaire,Expert',
            'telephone' => 'required|string|max:20',
            'email' => 'nullable|email|max:100',
            'atelier' => 'nullable|string|max:200',
            'date_embauche' => 'required|date',
            'statut' => 'required|in:Actif,Inactif,En Formation,En Congé',
            'competences' => 'nullable|string|max:1000',
            'formations_suivies' => 'nullable|string|max:1000',
            'notes' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $technicien->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Technicien mis à jour avec succès !',
                'technicien' => $technicien
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
    public function destroy(Intervenant $technicien)
    {
        try {
            $technicien->delete();

            return response()->json([
                'success' => true,
                'message' => 'Technicien supprimé avec succès !'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression : ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get techniciens for dropdown
     */
    public function getTechniciens()
    {
        $techniciens = Intervenant::where('statut', 'Actif')
            ->orderBy('nom')
            ->get(['id', 'matricule', 'nom', 'prenom', 'fonction_technique']);

        return response()->json($techniciens);
    }

    /**
     * Get techniciens by function
     */
    public function getByFunction($fonction)
    {
        $techniciens = Intervenant::where('fonction_technique', $fonction)
            ->where('statut', 'Actif')
            ->orderBy('nom')
            ->get();

        return response()->json($techniciens);
    }

    /**
     * Get experts
     */
    public function getExperts()
    {
        $experts = Intervenant::where('niveau_competence', 'Expert')
            ->where('statut', 'Actif')
            ->orderBy('nom')
            ->get();

        return response()->json($experts);
    }
}
