<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'immatriculation',
        'type_vehicule',
        'marque',
        'modele',
        'annee',
        'affectation',
        'entite_location',
        'ligne_transport_id',
        'statut',
        'capacite',
        'kilometrage'
    ];

    protected $casts = [
        'annee' => 'integer',
        'capacite' => 'integer',
        'kilometrage' => 'integer',
    ];

    // Relations
    public function interventions()
    {
        return $this->hasMany(Intervention::class);
    }

    public function planningMaintenances()
    {
        return $this->hasMany(PlanningMaintenance::class);
    }

    public function ligneTransport()
    {
        return $this->belongsTo(LigneTransport::class);
    }

    public function carburations()
    {
        return $this->hasMany(Carburation::class);
    }

    // Accesseurs
    public function getNomCompletAttribute()
    {
        return "{$this->numero} - {$this->marque} {$this->modele}";
    }

    // Scopes
    public function scopeEnService($query)
    {
        return $query->where('statut', 'En Service');
    }

    public function scopeAuGarage($query)
    {
        return $query->where('statut', 'Au Garage');
    }

    public function scopeEnReparation($query)
    {
        return $query->where('statut', 'En Réparation');
    }

    public function scopeEnMaintenance($query)
    {
        return $query->where('statut', 'Maintenance');
    }
}
