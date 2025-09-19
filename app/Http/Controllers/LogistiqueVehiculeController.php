<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LogistiqueVehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicules = Vehicule::orderBy('numero')->get();
        
        // Statistiques pour les cartes
        $stats = [
            'en_service' => Vehicule::enService()->count(),
            'au_garage' => Vehicule::auGarage()->count(),
            'en_reparation' => Vehicule::enReparation()->count(),
            'maintenance' => Vehicule::enMaintenance()->count(),
        ];

        return view('logistique.vehicules.index', compact('vehicules', 'stats'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vehicule = Vehicule::findOrFail($id);
        return view('logistique.vehicules.show', compact('vehicule'));
    }

    /**
     * Export PDF of vehicles list
     */
    public function exportPdf()
    {
        $vehicules = Vehicule::orderBy('numero')->get();
        
        $stats = [
            'en_service' => Vehicule::enService()->count(),
            'au_garage' => Vehicule::auGarage()->count(),
            'en_reparation' => Vehicule::enReparation()->count(),
            'maintenance' => Vehicule::enMaintenance()->count(),
        ];

        $pdf = Pdf::loadView('logistique.vehicules.pdf.index', compact('vehicules', 'stats'));
        return $pdf->download('vehicules-logistique-' . date('Y-m-d') . '.pdf');
    }
}


