<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    /**
     * Afficher le dashboard de maintenance
     */
    public function index()
    {
        return view('maintenance.index');
    }

    /**
     * Afficher la liste des véhicules
     */
    public function vehicules()
    {
        return view('maintenance.vehicules.index');
    }

    /**
     * Afficher la liste des interventions
     */
    public function interventions()
    {
        return view('maintenance.interventions.index');
    }

    /**
     * Afficher la liste des pièces détachées
     */
    public function pieces()
    {
        return view('maintenance.pieces.index');
    }

    /**
     * Afficher le planning de maintenance
     */
    public function planning()
    {
        return view('maintenance.planning.index');
    }
}
