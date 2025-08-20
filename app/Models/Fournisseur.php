<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fournisseur extends Model
{
    protected $fillable = [
        'nom', 'email', 'telephone', 'adresse', 'ville', 'pays', 'type', 'responsable'
    ];

    /**
     * Relation avec les commandes
     */
    public function commandes(): HasMany
    {
        return $this->hasMany(Commande::class);
    }

    /**
     * Obtenir le nombre total de commandes
     */
    public function getNombreCommandesAttribute()
    {
        return $this->commandes()->count();
    }

    /**
     * Obtenir le montant total des commandes
     */
    public function getMontantTotalCommandesAttribute()
    {
        return $this->commandes()->sum('montant_total');
    }

    /**
     * Obtenir le nombre de commandes livrées
     */
    public function getNombreCommandesLivreesAttribute()
    {
        return $this->commandes()->where('statut', 'livree')->count();
    }

    /**
     * Obtenir le nombre de commandes livrées à temps
     */
    public function getNombreLivraisonsATempsAttribute()
    {
        return $this->commandes()
            ->where('statut', 'livree')
            ->whereHas('lignes.livraisons', function($query) {
                $query->where('date_livraison', '<=', 'date_prevue');
            })
            ->count();
    }

    /**
     * Calculer le taux de ponctualité (livraisons à temps / total livraisons)
     */
    public function getTauxPonctualiteAttribute()
    {
        $livraisonsTotal = $this->getNombreCommandesLivreesAttribute();
        if ($livraisonsTotal == 0) return 0;
        
        return round(($this->getNombreLivraisonsATempsAttribute() / $livraisonsTotal) * 100, 1);
    }

    /**
     * Calculer le score global du fournisseur (0-100)
     */
    public function getScoreGlobalAttribute()
    {
        $score = 0;
        
        // Score basé sur le nombre de commandes (max 30 points)
        $nbCommandes = $this->getNombreCommandesAttribute();
        if ($nbCommandes > 0) {
            $score += min(30, $nbCommandes * 3); // 3 points par commande, max 30
        }
        
        // Score basé sur le taux de ponctualité (max 40 points)
        $tauxPonctualite = $this->getTauxPonctualiteAttribute();
        $score += ($tauxPonctualite * 0.4); // 40% du taux de ponctualité
        
        // Score basé sur le montant total (max 30 points)
        $montantTotal = $this->getMontantTotalCommandesAttribute();
        if ($montantTotal > 0) {
            $score += min(30, $montantTotal / 1000000); // 1 point par million, max 30
        }
        
        return round($score, 1);
    }

    /**
     * Obtenir la classe CSS pour le score (couleur)
     */
    public function getScoreColorAttribute()
    {
        $score = $this->getScoreGlobalAttribute();
        
        if ($score >= 80) return 'green';
        if ($score >= 60) return 'yellow';
        if ($score >= 40) return 'orange';
        return 'red';
    }

    /**
     * Obtenir le label du score
     */
    public function getScoreLabelAttribute()
    {
        $score = $this->getScoreGlobalAttribute();
        
        if ($score >= 80) return 'Excellent';
        if ($score >= 60) return 'Bon';
        if ($score >= 40) return 'Moyen';
        return 'Faible';
    }

    /**
     * Scope pour trier par score
     */
    public function scopeOrderByScore($query, $direction = 'desc')
    {
        return $query->withCount('commandes')
            ->withSum('commandes', 'montant_total')
            ->orderBy('commandes_count', $direction);
    }

    /**
     * Scope pour filtrer par type
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope pour les fournisseurs avec commandes
     */
    public function scopeAvecCommandes($query)
    {
        return $query->has('commandes');
    }
}
