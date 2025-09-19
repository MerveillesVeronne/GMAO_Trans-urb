<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanningMaintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicule_id',
        'type_maintenance',
        'date_planifiee',
        'heure_debut',
        'duree_estimee',
        'priorite',
        'technicien',
        'atelier',
        'description_travaux',
        'pieces_necessaires',
        'notes',
        'statut'
    ];

    protected $casts = [
        'date_planifiee' => 'date',
        'heure_debut' => 'datetime:H:i',
        'duree_estimee' => 'decimal:1',
    ];

    // Relations
    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }

    // Scopes
    public function scopePlanifiees($query)
    {
        return $query->where('statut', 'Planifiee');
    }

    public function scopeEnCours($query)
    {
        return $query->where('statut', 'En Cours');
    }

    public function scopeTerminees($query)
    {
        return $query->where('statut', 'Terminee');
    }

    public function scopeEnRetard($query)
    {
        return $query->where('date_planifiee', '<', now()->toDateString())
                    ->where('statut', 'Planifiee');
    }

    public function scopeParDate($query, $date)
    {
        return $query->where('date_planifiee', $date);
    }

    public function scopeParTechnicien($query, $technicien)
    {
        return $query->where('technicien', $technicien);
    }
}
