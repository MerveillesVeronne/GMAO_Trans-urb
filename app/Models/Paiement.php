<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'commande_id',
        'user_id',
        'montant',
        'mode_paiement',
        'reference_paiement',
        'commentaire',
        'date_paiement'
    ];

    protected $casts = [
        'montant' => 'decimal:2',
        'date_paiement' => 'date'
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getModePaiementLabelAttribute()
    {
        return match($this->mode_paiement) {
            'especes' => 'Espèces',
            'cheque' => 'Chèque',
            'virement' => 'Virement',
            'carte' => 'Carte bancaire',
            default => 'Inconnu'
        };
    }

    public function getModePaiementColorAttribute()
    {
        return match($this->mode_paiement) {
            'especes' => 'green',
            'cheque' => 'blue',
            'virement' => 'purple',
            'carte' => 'orange',
            default => 'gray'
        };
    }
}
