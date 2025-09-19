<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'matricule',
        'nom',
        'prenom',
        'fonction_technique',
        'specialite',
        'niveau_competence',
        'telephone',
        'email',
        'atelier',
        'date_embauche',
        'statut',
        'competences',
        'formations_suivies',
        'notes'
    ];

    protected $casts = [
        'date_embauche' => 'date',
        'competences' => 'array',
    ];

    // Accesseurs
    public function getNomCompletAttribute()
    {
        return "{$this->prenom} {$this->nom}";
    }

    public function getAncienneteAttribute()
    {
        return $this->date_embauche->diffInYears(now());
    }

    // Scopes
    public function scopeActifs($query)
    {
        return $query->where('statut', 'Actif');
    }

    public function scopeParFonction($query, $fonction)
    {
        return $query->where('fonction_technique', $fonction);
    }

    public function scopeParNiveau($query, $niveau)
    {
        return $query->where('niveau_competence', $niveau);
    }

    public function scopeParAtelier($query, $atelier)
    {
        return $query->where('atelier', $atelier);
    }

    public function scopeExperts($query)
    {
        return $query->where('niveau_competence', 'Expert');
    }

    public function scopeParSpecialite($query, $specialite)
    {
        return $query->where('specialite', $specialite);
    }

    // Relations
    public function interventions()
    {
        return $this->hasMany(Intervention::class, 'technicien', 'nom_complet');
    }

    public function planningMaintenances()
    {
        return $this->hasMany(PlanningMaintenance::class, 'technicien', 'nom_complet');
    }
}
