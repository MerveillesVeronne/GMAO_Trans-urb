<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class InterventionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $interventions = Intervention::with('vehicule')->orderBy('created_at', 'desc')->get();
        $techniciens = \App\Models\Intervenant::where('statut', 'Actif')->orderBy('nom')->get();
        $pieces = \App\Models\Piece::enStock()->orderBy('designation')->get();
        
        $stats = [
            'en_cours' => Intervention::where('statut', 'En Cours')->count(),
            'terminees' => Intervention::where('statut', 'Terminee')->count(),
            'en_attente' => Intervention::where('statut', 'En Attente')->count(),
            'urgentes' => Intervention::where('priorite', 'Urgente')->count(),
        ];

        return view('maintenance.interventions.index', compact('interventions', 'stats', 'techniciens', 'pieces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicules = \App\Models\Vehicule::orderBy('numero')->get();
        $techniciens = \App\Models\Intervenant::where('statut', 'Actif')->orderBy('nom')->get();
        $pieces = \App\Models\Piece::enStock()->orderBy('designation')->get();
        
        return view('maintenance.interventions.create', compact('vehicules', 'techniciens', 'pieces'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vehicule_id' => 'required|exists:vehicules,id',
            'type_intervention' => 'required|in:Maintenance,Reparation,Revision,Urgence,Inspection',
            'nature_intervention' => 'nullable|in:Mecanique,Electrique,Vulcanique,Tolerie,Peinture,Carrosserie,Chauffage,Climatisation,Freinage,Suspension,Transmission,Autre',
            'priorite' => 'required|in:Normal,À prévoir,Urgent',
            'statut' => 'required|in:En Attente,En Cours,Terminee,Annulee,Livré',
            'date_debut' => 'required|date',
            'date_fin_prevue' => 'nullable|date|after_or_equal:date_debut',
            'technicien' => 'required|string|max:100',
            'description' => 'required|string|max:1000',
            'pieces_necessaires' => 'nullable|string|max:500',
            'quantite_pieces' => 'nullable|string|max:200',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $intervention = Intervention::create($request->all());

            // Si des pièces sont nécessaires, créer automatiquement un bon de commande
            if (!empty($request->pieces_necessaires) || !empty($request->quantite_pieces)) {
                $bonCommande = \App\Models\BonCommandeMaintenance::create([
                    'intervention_id' => $intervention->id,
                    'vehicule_id' => $intervention->vehicule_id,
                    'motif_intervention' => $intervention->description,
                    'pieces_necessaires' => $intervention->pieces_necessaires,
                    'date_besoin' => $intervention->date_debut,
                    'date_debut_prevue' => $intervention->date_debut,
                    'date_fin_prevue' => $intervention->date_fin_prevue,
                    'statut' => 'En Attente',
                    'date_creation' => now(),
                    'notes' => 'Bon de commande généré automatiquement lors de la création de l\'intervention'
                ]);

                $message = 'Intervention créée avec succès ! Un bon de commande a été automatiquement généré pour les pièces nécessaires.';
            } else {
                $message = 'Intervention créée avec succès !';
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'intervention' => $intervention->load('vehicule'),
                'bon_commande_created' => isset($bonCommande) ? true : false
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'ajout de l\'intervention : ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $intervention = Intervention::with(['vehicule', 'signatureMaintenanceUser', 'signatureLogistiqueUser', 'bonCommande'])->findOrFail($id);
        return view('maintenance.interventions.show', compact('intervention'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Intervention $intervention)
    {
        $vehicules = \App\Models\Vehicule::orderBy('numero')->get();
        $techniciens = \App\Models\Intervenant::where('statut', 'Actif')->orderBy('nom')->get();
        $pieces = \App\Models\Piece::enStock()->orderBy('designation')->get();
        
        return view('maintenance.interventions.edit', compact('intervention', 'vehicules', 'techniciens', 'pieces'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Intervention $intervention)
    {
        $validator = Validator::make($request->all(), [
            'vehicule_id' => 'required|exists:vehicules,id',
            'type_intervention' => 'required|in:Maintenance,Reparation,Revision,Urgence,Inspection',
            'nature_intervention' => 'nullable|in:Mecanique,Electrique,Vulcanique,Tolerie,Peinture,Carrosserie,Chauffage,Climatisation,Freinage,Suspension,Transmission,Autre',
            'priorite' => 'required|in:Normal,À prévoir,Urgent',
            'statut' => 'required|in:En Attente,En Cours,Terminee,Annulee,Livré',
            'date_debut' => 'required|date',
            'date_fin_prevue' => 'nullable|date|after_or_equal:date_debut',
            'technicien' => 'required|string|max:100',
            'description' => 'required|string|max:1000',
            'pieces_necessaires' => 'nullable|string|max:500',
            'quantite_pieces' => 'nullable|string|max:200',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $intervention->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Intervention mise à jour avec succès !',
                'intervention' => $intervention->load('vehicule')
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
            $intervention = Intervention::findOrFail($id);
            $intervention->delete();

            return response()->json([
                'success' => true,
                'message' => 'Intervention supprimée avec succès !'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression : ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Change status of intervention
     */
    public function changeStatus(Request $request, string $id)
    {
        $intervention = Intervention::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'statut' => 'required|in:En Attente,En Cours,Terminee,Annulee'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $intervention->update(['statut' => $request->statut]);

            return response()->json([
                'success' => true,
                'message' => 'Statut mis à jour avec succès !',
                'intervention' => $intervention
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour du statut : ' . $e->getMessage()
            ], 500);
        }
    }



    /**
     * Signer une intervention
     */
    public function signer(Request $request, Intervention $intervention)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:maintenance,logistique'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $user = auth()->user();
        $type = $request->type;

        try {
            // Vérifier les permissions
            if ($type === 'maintenance' && !$user->canSignMaintenance()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vous n\'êtes pas autorisé à signer pour la maintenance'
                ], 403);
            }

            if ($type === 'logistique' && !$user->canSignLogistique()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vous n\'êtes pas autorisé à signer pour la logistique'
                ], 403);
            }

            // Vérifier si déjà signé
            if ($type === 'maintenance' && $intervention->signature_maintenance) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cette intervention a déjà été signée par le chef de service maintenance'
                ], 400);
            }

            if ($type === 'logistique' && $intervention->signature_logistique) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cette intervention a déjà été signée par le chef de service logistique'
                ], 400);
            }

            // Appliquer la signature
            if ($type === 'maintenance') {
                $intervention->update([
                    'signature_maintenance' => true,
                    'signature_maintenance_user_id' => $user->id,
                    'signature_maintenance_date' => now()
                ]);
            } else {
                $intervention->update([
                    'signature_logistique' => true,
                    'signature_logistique_user_id' => $user->id,
                    'signature_logistique_date' => now()
                ]);
            }

            $fonction = $type === 'maintenance' ? 'maintenance' : 'logistique';
            
            return response()->json([
                'success' => true,
                'message' => "Intervention signée avec succès en tant que chef de service {$fonction} !",
                'intervention' => $intervention->fresh()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la signature : ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Export PDF d'une intervention individuelle
     */
    public function exportPdf(string $id)
    {
        $intervention = Intervention::with(['vehicule', 'signatureMaintenanceUser', 'signatureLogistiqueUser'])
            ->findOrFail($id);

        $pdf = Pdf::loadView('maintenance.interventions.pdf.intervention', compact('intervention'));
        
        return $pdf->download('intervention-' . $intervention->vehicule->numero . '-' . date('Y-m-d') . '.pdf');
    }
}
