<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LigneCommande extends Model
{
    use HasFactory;

    protected $fillable = [
        'commande_id', 'produit', 'description', 'quantite', 'cout_unitaire',
        'total_ligne', 'incidents', 'commentaires', 'statut_ligne',
        'quantite_livree', 'date_derniere_livraison', 'livraison_complete'
    ];

    protected $casts = [
        'cout_unitaire' => 'decimal:2',
        'total_ligne' => 'decimal:2',
        'quantite_livree' => 'integer',
        'date_derniere_livraison' => 'date',
        'livraison_complete' => 'boolean'
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function livraisons()
    {
        return $this->hasMany(Livraison::class);
    }

    public function getStatutLigneLabelAttribute()
    {
        return match($this->statut_ligne) {
            'en_attente' => 'En Attente',
            'approuvee' => 'Approuvée',
            'livree' => 'Livrée',
            'annulee' => 'Annulée',
            default => 'Inconnu'
        };
    }

    public function getStatutLigneColorAttribute()
    {
        return match($this->statut_ligne) {
            'en_attente' => 'yellow',
            'approuvee' => 'blue',
            'livree' => 'green',
            'annulee' => 'red',
            default => 'gray'
        };
    }

    public function calculerTotalLigne()
    {
        $this->total_ligne = $this->quantite * ($this->cout_unitaire ?? 0);
        return $this->total_ligne;
    }

    /**
     * Vérifier si la ligne est complètement livrée
     */
    public function isLivraisonComplete()
    {
        return $this->quantite_livree >= $this->quantite;
    }

    /**
     * Obtenir la quantité restante à livrer
     */
    public function getQuantiteRestante()
    {
        return max(0, $this->quantite - $this->quantite_livree);
    }

    /**
     * Obtenir le pourcentage de livraison
     */
    public function getPourcentageLivraison()
    {
        if ($this->quantite == 0) return 0;
        return min(100, ($this->quantite_livree / $this->quantite) * 100);
    }

    /**
     * Mettre à jour le statut de la ligne
     */
    public function mettreAJourStatut()
    {
        if ($this->isLivraisonComplete()) {
            $this->statut_ligne = 'livree';
        } elseif ($this->quantite_livree > 0) {
            $this->statut_ligne = 'approuvee';
        } else {
            $this->statut_ligne = 'en_attente';
        }
        
        $this->save();
    }

    protected static function booted()
    {
        static::saving(function ($ligne) {
            $ligne->calculerTotalLigne();
        });

        static::saved(function ($ligne) {
            // Mettre à jour le total de la commande
            $ligne->commande->calculerMontantTotal();
        });
    }

    protected static function boot()
    {
        parent::boot();

        // Mettre à jour la quantité satisfaite du bon de commande quand une ligne est mise à jour
        static::updated(function ($ligne) {
            if ($ligne->commande && $ligne->commande->bonCommande) {
                $ligne->commande->bonCommande->mettreAJourQuantiteSatisfaite();
            }
        });

        // Mettre à jour la quantité satisfaite du bon de commande quand une ligne est créée
        static::created(function ($ligne) {
            if ($ligne->commande && $ligne->commande->bonCommande) {
                $ligne->commande->bonCommande->mettreAJourQuantiteSatisfaite();
            }
        });
    }
}
