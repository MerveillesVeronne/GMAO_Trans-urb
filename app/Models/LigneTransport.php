<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LigneTransport extends Model
{
    use HasFactory;

    protected $table = 'lignes_transports';

    protected $fillable = [
        'nom',
        'type_affectation',
        'actif'
    ];

    protected $casts = [
        'actif' => 'boolean',
    ];

    // Relations
    public function vehicules()
    {
        return $this->hasMany(Vehicule::class, 'ligne_transport_id');
    }

    // Scopes
    public function scopeActives($query)
    {
        return $query->where('actif', true);
    }

    public function scopeParType($query, $type)
    {
        return $query->where('type_affectation', $type);
    }

    // Accesseurs
    public function getNomCompletAttribute()
    {
        return "{$this->nom} ({$this->type_affectation})";
    }
}
