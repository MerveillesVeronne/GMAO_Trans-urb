<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlerteStock extends Model
{
    use HasFactory;

    protected $table = 'alertes_stock';

    protected $fillable = [
        'stock_id',
        'type_alerte',
        'message',
        'statut',
        'date_alerte',
        'date_resolution',
        'resolu_par'
    ];

    protected $casts = [
        'date_alerte' => 'datetime',
        'date_resolution' => 'datetime'
    ];

    /**
     * Relation avec le stock
     */
    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    /**
     * Relation avec l'utilisateur qui a résolu l'alerte
     */
    public function resoluPar()
    {
        return $this->belongsTo(User::class, 'resolu_par');
    }

    /**
     * Scopes
     */
    public function scopeActives($query)
    {
        return $query->where('statut', 'active');
    }

    public function scopeParType($query, $type)
    {
        return $query->where('type_alerte', $type);
    }

    /**
     * Méthodes utilitaires
     */
    public function estActive()
    {
        return $this->statut === 'active';
    }

    public function peutEtreResolue()
    {
        return $this->statut === 'active';
    }

    /**
     * Résoudre une alerte
     */
    public function resoudre($userId = null)
    {
        $this->update([
            'statut' => 'resolue',
            'date_resolution' => now(),
            'resolu_par' => $userId ?? auth()->id()
        ]);
    }

    /**
     * Ignorer une alerte
     */
    public function ignorer($userId = null)
    {
        $this->update([
            'statut' => 'ignoree',
            'date_resolution' => now(),
            'resolu_par' => $userId ?? auth()->id()
        ]);
    }
}
