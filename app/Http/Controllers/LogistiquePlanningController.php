<?php

namespace App\Http\Controllers;

use App\Models\PlanningMaintenance;
use App\Models\Intervention;
use App\Models\Carburation;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LogistiquePlanningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer les vraies données de la base (même logique que maintenance)
        $planningMaintenances = PlanningMaintenance::with('vehicule')
            ->orderBy('date_planifiee')
            ->get();
            
        $interventions = Intervention::with(['vehicule', 'signatureMaintenanceUser', 'signatureLogistiqueUser'])
            ->orderBy('date_debut')
            ->get();
            
        $carburations = Carburation::with(['vehicule', 'chauffeur'])
            ->orderBy('date_carburation')
            ->get();
        
        // Calculer les vraies statistiques (même logique que maintenance)
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

        return view('logistique.planning.index', compact(
            'planningMaintenances', 
            'interventions',
            'carburations', 
            'stats',
            'planningCalendrier',
            'interventionsCalendrier',
            'carburationsCalendrier'
        ));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $planning = PlanningMaintenance::with(['vehicule'])->findOrFail($id);
        return view('logistique.planning.show', compact('planning'));
    }

    /**
     * Display the specified intervention.
     */
    public function showIntervention(string $id)
    {
        $intervention = Intervention::with(['vehicule', 'signatureMaintenanceUser', 'signatureLogistiqueUser'])->findOrFail($id);
        return view('logistique.interventions.show', compact('intervention'));
    }

    /**
     * Signer une intervention (logistique)
     */
    public function signerIntervention(Request $request, string $id)
    {
        $intervention = Intervention::findOrFail($id);
        
        $intervention->update([
            'signature_logistique_user_id' => auth()->id(),
            'signature_logistique_date' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Intervention signée avec succès par la logistique !'
        ]);
    }

    /**
     * Export PDF of planning
     */
    public function exportPdf(Request $request)
    {
        $type = $request->get('type', 'all'); // all, interventions, carburations, planning
        
        $planningMaintenances = PlanningMaintenance::with('vehicule')->orderBy('date_planifiee')->get();
        $interventions = Intervention::with(['vehicule', 'signatureMaintenanceUser', 'signatureLogistiqueUser'])->orderBy('date_debut')->get();
        $carburations = Carburation::with(['vehicule', 'chauffeur'])->orderBy('date_carburation')->get();
        
        // Filtrer selon le type demandé
        if ($type === 'interventions') {
            $planningMaintenances = collect();
            $carburations = collect();
        } elseif ($type === 'carburations') {
            $planningMaintenances = collect();
            $interventions = collect();
        } elseif ($type === 'planning') {
            $interventions = collect();
            $carburations = collect();
        }
        
        $pdf = Pdf::loadView('logistique.planning.pdf.index', compact('planningMaintenances', 'interventions', 'carburations', 'type'));
        
        return $pdf->download('planning-logistique-' . $type . '-' . now()->format('Y-m-d') . '.pdf');
    }
}
