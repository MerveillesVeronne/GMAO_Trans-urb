<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carburation extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicule_id',
        'chauffeur_id',
        'date_carburation',
        'heure_carburation',
        'quantite_litres',
        'prix_litre',
        'cout_total',
        'etat',
        'notes',
        'type_carburation'
    ];

    protected $casts = [
        'date_carburation' => 'date',
        'heure_carburation' => 'datetime',
        'quantite_litres' => 'decimal:2',
        'prix_litre' => 'decimal:2',
        'cout_total' => 'decimal:2',
    ];

    // Relations
    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }

    public function chauffeur()
    {
        return $this->belongsTo(User::class, 'chauffeur_id');
    }

    // Scopes
    public function scopeParVehicule($query, $vehiculeId)
    {
        return $query->where('vehicule_id', $vehiculeId);
    }

    public function scopeParDate($query, $date)
    {
        return $query->whereDate('date_carburation', $date);
    }

    public function scopeParEtat($query, $etat)
    {
        return $query->where('etat', $etat);
    }

    // Accesseurs
    public function getDateHeureCompleteAttribute()
    {
        return $this->date_carburation->format('d/m/Y') . ' à ' . $this->heure_carburation->format('H:i');
    }

    public function getCoutTotalFormateAttribute()
    {
        return number_format($this->cout_total, 0, ',', ' ') . ' FCFA';
    }
}
