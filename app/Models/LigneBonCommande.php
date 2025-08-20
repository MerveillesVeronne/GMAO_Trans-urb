<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LigneBonCommande extends Model
{
    use HasFactory;

    protected $table = 'lignes_bons_commande';

    protected $fillable = [
        'bon_commande_id', 'produit', 'description', 'quantite_demandee',
        'quantite_satisfaite', 'cout_unitaire_estime', 'cout_total_estime',
        'unite', 'statut', 'commentaires'
    ];

    protected $casts = [
        'quantite_demandee' => 'integer',
        'quantite_satisfaite' => 'integer',
        'cout_unitaire_estime' => 'decimal:2',
        'cout_total_estime' => 'decimal:2'
    ];

    /**
     * Relation avec le bon de commande
     */
    public function bonCommande()
    {
        return $this->belongsTo(BonCommande::class);
    }

    /**
     * Accesseurs pour les labels
     */
    public function getStatutLabelAttribute()
    {
        return match($this->statut) {
            'en_attente' => 'En attente',
            'partiellement_satisfait' => 'Partiellement satisfait',
            'satisfait' => 'Satisfait',
            default => 'Inconnu'
        };
    }

    public function getStatutColorAttribute()
    {
        return match($this->statut) {
            'en_attente' => 'yellow',
            'partiellement_satisfait' => 'orange',
            'satisfait' => 'green',
            default => 'gray'
        };
    }

    /**
     * Méthodes utilitaires
     */
    public function estSatisfait()
    {
        return $this->statut === 'satisfait';
    }

    public function getQuantiteRestante()
    {
        return $this->quantite_demandee - $this->quantite_satisfaite;
    }

    public function getPourcentageSatisfaction()
    {
        if ($this->quantite_demandee === 0) {
            return 0;
        }
        return round(($this->quantite_satisfaite / $this->quantite_demandee) * 100, 2);
    }

    /**
     * Mettre à jour la satisfaction
     */
    public function mettreAJourSatisfaction($quantiteAjoutee)
    {
        $this->quantite_satisfaite += $quantiteAjoutee;
        
        if ($this->quantite_satisfaite >= $this->quantite_demandee) {
            $this->statut = 'satisfait';
        } elseif ($this->quantite_satisfaite > 0) {
            $this->statut = 'partiellement_satisfait';
        }
        
        $this->save();
        
        // Vérifier la satisfaction du bon de commande
        $this->bonCommande->verifierSatisfaction();
    }

    /**
     * Calculer le coût total estimé automatiquement
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($ligne) {
            $ligne->cout_total_estime = $ligne->quantite_demandee * $ligne->cout_unitaire_estime;
        });

        static::updating(function ($ligne) {
            if ($ligne->isDirty(['quantite_demandee', 'cout_unitaire_estime'])) {
                $ligne->cout_total_estime = $ligne->quantite_demandee * $ligne->cout_unitaire_estime;
            }
        });
    }
}
