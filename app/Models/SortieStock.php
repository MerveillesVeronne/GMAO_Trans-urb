<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SortieStock extends Model
{
    use HasFactory;

    protected $table = 'sorties_stock';

    protected $fillable = [
        'stock_id',
        'reference_produit',
        'quantite_sortie',
        'unite',
        'cout_unitaire',
        'cout_total',
        'service_destinataire',
        'personne_destinataire',
        'poste_destinataire',
        'motif_sortie',
        'valide_par',
        'valide_le',
        'commentaires',
        'statut'
    ];

    protected $casts = [
        'quantite_sortie' => 'integer',
        'cout_unitaire' => 'decimal:2',
        'cout_total' => 'decimal:2',
        'valide_le' => 'datetime'
    ];

    /**
     * Relation avec le stock
     */
    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    /**
     * Relation avec l'utilisateur qui a validé
     */
    public function validePar()
    {
        return $this->belongsTo(User::class, 'valide_par');
    }

    /**
     * Accesseurs pour les labels
     */
    public function getStatutLabelAttribute()
    {
        return match($this->statut) {
            'validee' => 'Validée',
            'annulee' => 'Annulée',
            default => 'Inconnu'
        };
    }

    public function getStatutColorAttribute()
    {
        return match($this->statut) {
            'validee' => 'green',
            'annulee' => 'red',
            default => 'gray'
        };
    }

    /**
     * Scopes pour filtrer les sorties
     */
    public function scopeValidees($query)
    {
        return $query->where('statut', 'validee');
    }

    public function scopeAnnulees($query)
    {
        return $query->where('statut', 'annulee');
    }

    public function scopeParService($query, $service)
    {
        return $query->where('service_destinataire', $service);
    }

    public function scopeParPersonne($query, $personne)
    {
        return $query->where('personne_destinataire', $personne);
    }

    public function scopeParDate($query, $date)
    {
        return $query->whereDate('created_at', $date);
    }

    /**
     * Méthodes utilitaires
     */
    public function estValidee()
    {
        return $this->statut === 'validee';
    }

    public function peutEtreAnnulee()
    {
        return $this->statut === 'validee';
    }

    /**
     * Annuler une sortie et remettre en stock
     */
    public function annuler()
    {
        if (!$this->peutEtreAnnulee()) {
            throw new \Exception('Cette sortie ne peut pas être annulée.');
        }

        // Remettre en stock
        $this->stock->ajouterStock($this->quantite_sortie, $this->cout_unitaire);

        // Marquer comme annulée
        $this->update([
            'statut' => 'annulee',
            'commentaires' => $this->commentaires . "\n\nANNULÉE le " . now()->format('d/m/Y H:i') . 
                            " par " . auth()->user()->nom_complet
        ]);

        return $this;
    }

    /**
     * Calculer le coût total automatiquement
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($sortie) {
            $sortie->cout_total = $sortie->quantite_sortie * $sortie->cout_unitaire;
        });

        static::updating(function ($sortie) {
            if ($sortie->isDirty(['quantite_sortie', 'cout_unitaire'])) {
                $sortie->cout_total = $sortie->quantite_sortie * $sortie->cout_unitaire;
            }
        });
    }
}
