<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    use HasFactory;

    protected $fillable = [
        'commande_id', 'ligne_commande_id', 'date_livraison', 'quantite_livree',
        'quantite_commandee', 'commentaires', 'statut', 'valide_par', 'valide_le'
    ];

    protected $casts = [
        'date_livraison' => 'date',
        'quantite_livree' => 'integer',
        'quantite_commandee' => 'integer',
        'valide_le' => 'datetime'
    ];

    protected static function boot()
    {
        parent::boot();

        // Mettre à jour la quantité satisfaite du bon de commande quand une livraison est validée
        static::updated(function ($livraison) {
            if ($livraison->ligneCommande && $livraison->ligneCommande->commande && $livraison->ligneCommande->commande->bonCommande) {
                $livraison->ligneCommande->commande->bonCommande->mettreAJourQuantiteSatisfaite();
            }
        });

        // Mettre à jour la quantité satisfaite du bon de commande quand une livraison est créée
        static::created(function ($livraison) {
            if ($livraison->ligneCommande && $livraison->ligneCommande->commande && $livraison->ligneCommande->commande->bonCommande) {
                $livraison->ligneCommande->commande->bonCommande->mettreAJourQuantiteSatisfaite();
            }
        });
    }

    /**
     * Relations
     */
    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function ligneCommande()
    {
        return $this->belongsTo(LigneCommande::class);
    }

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
            'complete' => 'Complète',
            'partielle' => 'Partielle',
            'retard' => 'En retard',
            default => 'Inconnu'
        };
    }

    public function getStatutColorAttribute()
    {
        return match($this->statut) {
            'complete' => 'green',
            'partielle' => 'yellow',
            'retard' => 'red',
            default => 'gray'
        };
    }

    /**
     * Vérifier si la livraison est complète
     */
    public function isComplete()
    {
        return $this->quantite_livree >= $this->quantite_commandee;
    }

    /**
     * Vérifier si la livraison est partielle
     */
    public function isPartielle()
    {
        return $this->quantite_livree > 0 && $this->quantite_livree < $this->quantite_commandee;
    }

    /**
     * Valider une livraison
     */
    public function valider($userId)
    {
        $this->valide_par = $userId;
        $this->valide_le = now();
        $this->save();

        // Mettre à jour la ligne de commande
        $this->ligneCommande->quantite_livree += $this->quantite_livree;
        $this->ligneCommande->date_derniere_livraison = $this->date_livraison;
        
        if ($this->ligneCommande->quantite_livree >= $this->ligneCommande->quantite) {
            $this->ligneCommande->livraison_complete = true;
        }
        
        $this->ligneCommande->save();

        // Mettre à jour le stock
        $stock = Stock::trouverOuCreer(
            $this->ligneCommande->produit,
            $this->ligneCommande->description
        );
        
        $stock->ajouterStock($this->quantite_livree, $this->ligneCommande->cout_unitaire);

        // Vérifier si toute la commande est livrée
        $this->commande->verifierLivraisonComplete();
    }

    /**
     * Scopes
     */
    public function scopeValidees($query)
    {
        return $query->whereNotNull('valide_par');
    }

    public function scopeEnAttente($query)
    {
        return $query->whereNull('valide_par');
    }

    public function scopeParDate($query, $date)
    {
        return $query->whereDate('date_livraison', $date);
    }
}
