<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonCommande extends Model
{
    use HasFactory;

    protected $table = 'bons_commande';

    protected $fillable = [
        'reference', 'titre', 'description', 'budget_total', 'date_creation',
        'date_besoin', 'statut', 'user_id', 'commentaires',
        'valide_globalement', 'valide_par', 'valide_le', 'montant_final_valide', 'commentaires_validation',
        'produit_principal', 'description_produit', 'quantite_totale_souhaitee', 'unite_produit',
        'cout_unitaire_estime', 'cout_total_estime', 'quantite_satisfaite'
    ];

    protected $casts = [
        'budget_total' => 'decimal:2',
        'date_creation' => 'date',
        'date_besoin' => 'date',
        'valide_globalement' => 'boolean',
        'valide_le' => 'datetime',
        'montant_final_valide' => 'decimal:2',
        'quantite_totale_souhaitee' => 'integer',
        'quantite_satisfaite' => 'integer',
        'cout_unitaire_estime' => 'decimal:2',
        'cout_total_estime' => 'decimal:2'
    ];

    /**
     * Relation avec l'utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec l'utilisateur qui a validé
     */
    public function validePar()
    {
        return $this->belongsTo(User::class, 'valide_par');
    }

    /**
     * Relation avec les lignes
     */
    public function lignes()
    {
        return $this->hasMany(LigneBonCommande::class);
    }

    /**
     * Relation avec les commandes
     */
    public function commandes()
    {
        return $this->hasMany(Commande::class);
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
            'annule' => 'Annulé',
            default => 'Inconnu'
        };
    }

    public function getStatutColorAttribute()
    {
        return match($this->statut) {
            'en_attente' => 'yellow',
            'partiellement_satisfait' => 'orange',
            'satisfait' => 'green',
            'annule' => 'red',
            default => 'gray'
        };
    }

    /**
     * Scopes
     */
    public function scopeEnAttente($query)
    {
        return $query->where('statut', 'en_attente');
    }

    public function scopePartiellementSatisfait($query)
    {
        return $query->where('statut', 'partiellement_satisfait');
    }

    public function scopeSatisfait($query)
    {
        return $query->where('statut', 'satisfait');
    }

    /**
     * Méthodes utilitaires
     */
    public function estSatisfait()
    {
        return $this->statut === 'satisfait';
    }

    public function peutEtreSatisfait()
    {
        return $this->statut !== 'annule';
    }

    /**
     * Vérifier si le bon de commande est satisfait
     */
    public function verifierSatisfaction()
    {
        $lignesSatisfaites = $this->lignes()->where('statut', 'satisfait')->count();
        $totalLignes = $this->lignes()->count();

        if ($totalLignes === 0) {
            return;
        }

        if ($lignesSatisfaites === $totalLignes) {
            $this->update(['statut' => 'satisfait']);
        } elseif ($lignesSatisfaites > 0) {
            $this->update(['statut' => 'partiellement_satisfait']);
        }
    }

    /**
     * Calculer le budget utilisé
     */
    public function getBudgetUtilise()
    {
        return $this->commandes()->sum('montant_total');
    }

    /**
     * Calculer le budget restant
     */
    public function getBudgetRestant()
    {
        return $this->budget_total - $this->getBudgetUtilise();
    }

    /**
     * Générer une référence unique
     */
    public static function genererReference()
    {
        $count = static::count();
        $year = date('Y');
        return "BC-{$year}-" . str_pad($count + 1, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Vérifier si toutes les commandes du bon de commande sont validées
     */
    public function toutesCommandesValidees()
    {
        $commandesValidees = $this->commandes()->where('statut', 'livree')->count();
        $totalCommandes = $this->commandes()->count();
        
        return $totalCommandes > 0 && $commandesValidees === $totalCommandes;
    }

    /**
     * Valider le bon de commande globalement
     */
    public function validerGlobalement()
    {
        if ($this->toutesCommandesValidees()) {
            $this->update([
                'statut' => 'satisfait',
                'valide_globalement' => true,
                'valide_par' => auth()->id(),
                'valide_le' => now(),
                'montant_final_valide' => $this->getMontantCommandesValidees()
            ]);
            return true;
        }
        return false;
    }

    /**
     * Calculer le montant total des commandes validées
     */
    public function getMontantCommandesValidees()
    {
        return $this->commandes()
            ->where('statut', 'livree')
            ->get()
            ->sum(function ($commande) {
                return $commande->calculerMontantReel();
            });
    }

    /**
     * Calculer le budget restant après déduction des commandes validées
     */
    public function getBudgetRestantApresValidation()
    {
        return $this->budget_total - $this->getMontantCommandesValidees();
    }

    /**
     * Vérifier si le bon de commande peut être validé globalement
     */
    public function peutEtreValideGlobalement()
    {
        return $this->statut !== 'annule' && $this->toutesCommandesValidees();
    }

    /**
     * Obtenir le pourcentage de satisfaction du budget
     */
    public function getPourcentageBudgetUtilise()
    {
        if ($this->budget_total <= 0) {
            return 0;
        }
        
        $montantUtilise = $this->getMontantCommandesValidees();
        return round(($montantUtilise / $this->budget_total) * 100, 2);
    }

    /**
     * Obtenir la quantité restante à satisfaire
     */
    public function getQuantiteRestante()
    {
        return max(0, $this->quantite_totale_souhaitee - $this->quantite_satisfaite);
    }

    /**
     * Obtenir le pourcentage de satisfaction de la quantité
     */
    public function getPourcentageSatisfaction()
    {
        if ($this->quantite_totale_souhaitee <= 0) {
            return 0;
        }
        return round(($this->quantite_satisfaite / $this->quantite_totale_souhaitee) * 100, 2);
    }

    /**
     * Vérifier si le besoin est complètement satisfait
     */
    public function estCompletementSatisfait()
    {
        return $this->quantite_satisfaite >= $this->quantite_totale_souhaitee;
    }

    /**
     * Mettre à jour la quantité satisfaite
     */
    public function mettreAJourQuantiteSatisfaite()
    {
        $quantiteSatisfaite = $this->commandes()
            ->where('statut', 'livree')
            ->get()
            ->sum(function ($commande) {
                return $commande->lignes->sum('quantite_livree');
            });

        // S'assurer que la quantité satisfaite ne dépasse pas la quantité totale souhaitée
        $quantiteSatisfaite = min($quantiteSatisfaite, $this->quantite_totale_souhaitee);

        $this->update(['quantite_satisfaite' => $quantiteSatisfaite]);
        
        // Mettre à jour le statut si nécessaire
        if ($quantiteSatisfaite >= $this->quantite_totale_souhaitee && $this->statut === 'en_attente') {
            $this->update(['statut' => 'partiellement_satisfait']);
        }
        
        return $quantiteSatisfaite;
    }

    /**
     * Calculer le coût total estimé automatiquement
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($bonCommande) {
            if ($bonCommande->quantite_totale_souhaitee && $bonCommande->cout_unitaire_estime) {
                $bonCommande->cout_total_estime = $bonCommande->quantite_totale_souhaitee * $bonCommande->cout_unitaire_estime;
            }
        });

        static::updating(function ($bonCommande) {
            if ($bonCommande->isDirty(['quantite_totale_souhaitee', 'cout_unitaire_estime'])) {
                if ($bonCommande->quantite_totale_souhaitee && $bonCommande->cout_unitaire_estime) {
                    $bonCommande->cout_total_estime = $bonCommande->quantite_totale_souhaitee * $bonCommande->cout_unitaire_estime;
                }
            }
        });
    }
}
