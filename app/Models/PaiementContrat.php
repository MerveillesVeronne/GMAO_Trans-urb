<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaiementContrat extends Model
{
    use HasFactory;

    protected $fillable = [
        'contrat_id',
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

    // Relations
    public function contrat(): BelongsTo
    {
        return $this->belongsTo(Contrat::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Accesseurs pour les labels
    public function getModePaiementLabelAttribute()
    {
        $labels = [
            'especes' => '💵 Espèces',
            'cheque' => '🏦 Chèque',
            'virement' => '💳 Virement',
            'carte' => '💳 Carte bancaire'
        ];
        return $labels[$this->mode_paiement] ?? $this->mode_paiement;
    }

    public function getModePaiementColorAttribute()
    {
        $colors = [
            'especes' => 'green',
            'cheque' => 'blue',
            'virement' => 'purple',
            'carte' => 'orange'
        ];
        return $colors[$this->mode_paiement] ?? 'gray';
    }
}
