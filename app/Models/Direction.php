<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_direction',
        'code_direction',
        'responsable',
        'description',
        'active',
        'ordre_affichage'
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * Relation avec les services
     */
    public function services()
    {
        return $this->hasMany(Service::class);
    }

    /**
     * Relation avec les utilisateurs
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Scope pour les directions actives
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
}
