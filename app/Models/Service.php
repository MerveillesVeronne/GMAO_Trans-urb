<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'direction_id',
        'nom_service',
        'code_service',
        'chef_service',
        'description',
        'active',
        'ordre_affichage'
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * Relation avec la direction parente
     */
    public function direction()
    {
        return $this->belongsTo(Direction::class);
    }

    /**
     * Relation avec les utilisateurs
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Scope pour les services actifs
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * Scope pour l'ordre d'affichage
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('ordre_affichage');
    }

    /**
     * Nom complet du service (Direction + Service)
     */
    public function getNomCompletAttribute()
    {
        return $this->direction->nom_direction . ' - ' . $this->nom_service;
    }
}
