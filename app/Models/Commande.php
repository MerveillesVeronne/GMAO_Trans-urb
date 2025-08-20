<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference', 'date_commande', 'date_livraison', 'delai',
        'fournisseur_id', 'statut', 'commentaires', 'montant_total', 'user_id', 'bon_commande_id',
        'montant_a_payer', 'avance', 'reste_a_payer', 'statut_paiement',
        'modalite_paiement', 'date_dernier_paiement', 'commentaires_paiement'
    ];

    protected $casts = [
        'date_commande' => 'date',
        'date_livraison' => 'date',
        'montant_total' => 'decimal:2',
        'montant_a_payer' => 'decimal:2',
        'avance' => 'decimal:2',
        'reste_a_payer' => 'decimal:2',
        'date_dernier_paiement' => 'date'
    ];

    protected static function boot()
    {
        parent::boot();

        // Mettre à jour la quantité satisfaite du bon de commande quand une commande est mise à jour
        static::updated(function ($commande) {
            if ($commande->bonCommande) {
                $commande->bonCommande->mettreAJourQuantiteSatisfaite();
            }
        });

        // Mettre à jour la quantité satisfaite du bon de commande quand une commande est créée
        static::created(function ($commande) {
            if ($commande->bonCommande) {
                $commande->bonCommande->mettreAJourQuantiteSatisfaite();
            }
        });
    }

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec le bon de commande
     */
    public function bonCommande()
    {
        return $this->belongsTo(BonCommande::class);
    }

    public function lignes()
    {
        return $this->hasMany(LigneCommande::class);
    }

    public function livraisons()
    {
        return $this->hasMany(Livraison::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

    public function getStatutLabelAttribute()
    {
        return match($this->statut) {
            'en_attente' => 'En Attente',
            'approuvee' => 'Approuvée',
            'livree' => 'Livrée',
            'annulee' => 'Annulée',
            default => 'Inconnu'
        };
    }

    public function getStatutColorAttribute()
    {
        return match($this->statut) {
            'en_attente' => 'yellow',
            'approuvee' => 'blue',
            'livree' => 'green',
            'annulee' => 'red',
            default => 'gray'
        };
    }

    public function calculerMontantTotal()
    {
        $total = $this->lignes->sum('total_ligne');
        $this->update(['montant_total' => $total]);
        return $total;
    }

    public function calculerDelai()
    {
        if ($this->date_livraison && $this->date_commande) {
            return $this->date_commande->diffInDays($this->date_livraison);
        }
        return null;
    }

    /**
     * Vérifier si la commande est complètement livrée
     */
    public function isLivraisonComplete()
    {
        return $this->lignes->every(function ($ligne) {
            return $ligne->isLivraisonComplete();
        });
    }

    /**
     * Vérifier si la commande est partiellement livrée
     */
    public function isLivraisonPartielle()
    {
        $lignesLivrees = $this->lignes->filter(function ($ligne) {
            return $ligne->quantite_livree > 0;
        });
        
        return $lignesLivrees->count() > 0 && !$this->isLivraisonComplete();
    }

    /**
     * Obtenir le pourcentage de livraison global
     */
    public function getPourcentageLivraison()
    {
        if ($this->lignes->count() == 0) return 0;
        
        $totalCommandee = $this->lignes->sum('quantite');
        $totalLivree = $this->lignes->sum('quantite_livree');
        
        if ($totalCommandee == 0) return 0;
        
        return min(100, ($totalLivree / $totalCommandee) * 100);
    }

    /**
     * Vérifier et mettre à jour le statut de livraison
     */
    public function verifierLivraisonComplete()
    {
        // Toujours recalculer le montant réel selon les quantités livrées
        $montantReel = $this->calculerMontantReel();
        $this->montant_total = $montantReel;

        if ($this->isLivraisonComplete()) {
            $this->statut = 'livree';
        } elseif ($this->isLivraisonPartielle()) {
            $this->statut = 'approuvee';
        }
        $this->save();
    }

    /**
     * Obtenir les lignes en attente de livraison
     */
    public function getLignesEnAttente()
    {
        return $this->lignes->filter(function ($ligne) {
            return !$ligne->isLivraisonComplete();
        });
    }

    /**
     * Obtenir les lignes partiellement livrées
     */
    public function getLignesPartiellementLivrees()
    {
        return $this->lignes->filter(function ($ligne) {
            return $ligne->quantite_livree > 0 && !$ligne->isLivraisonComplete();
        });
    }

    public function scopeEnAttente($query)
    {
        return $query->where('statut', 'en_attente');
    }

    public function scopeApprouvees($query)
    {
        return $query->where('statut', 'approuvee');
    }

    public function scopeLivrees($query)
    {
        return $query->where('statut', 'livree');
    }

    public function scopeAnnulees($query)
    {
        return $query->where('statut', 'annulee');
    }

    /**
     * Scope pour les commandes avec livraisons en retard
     */
    public function scopeEnRetard($query)
    {
        return $query->where('date_livraison', '<', now()->toDateString())
                    ->where('statut', '!=', 'livree');
    }

    /**
     * Calculer le montant total basé sur les quantités réellement livrées
     */
    public function calculerMontantReel()
    {
        $montantReel = 0;
        
        foreach ($this->lignes as $ligne) {
            // Si la ligne a des livraisons validées, on calcule sur la quantité livrée
            if ($ligne->quantite_livree > 0) {
                $montantReel += $ligne->quantite_livree * ($ligne->cout_unitaire ?? 0);
            }
        }
        
        return $montantReel;
    }

    /**
     * Vérifier si la commande peut être approuvée
     */
    public function peutEtreApprouvee()
    {
        // Vérifier qu'il y a au moins une livraison validée
        $lignesAvecLivraisons = $this->lignes->filter(function ($ligne) {
            return $ligne->quantite_livree > 0;
        });

        return $lignesAvecLivraisons->count() > 0;
    }

    /**
     * Obtenir le résumé des livraisons pour l'approbation
     */
    public function getResumeLivraisons()
    {
        $resume = [];
        
        foreach ($this->lignes as $ligne) {
            $resume[] = [
                'produit' => $ligne->produit,
                'quantite_commandee' => $ligne->quantite,
                'quantite_livree' => $ligne->quantite_livree,
                'quantite_manquante' => $ligne->quantite - $ligne->quantite_livree,
                'cout_unitaire' => $ligne->cout_unitaire,
                'montant_ligne_commandee' => $ligne->total_ligne,
                'montant_ligne_livree' => $ligne->quantite_livree * ($ligne->cout_unitaire ?? 0),
                'pourcentage_livraison' => $ligne->getPourcentageLivraison(),
                'statut' => $ligne->isLivraisonComplete() ? 'Complète' : 'Partielle'
            ];
        }
        
        return $resume;
    }

    /**
     * Approuver la commande avec les quantités réellement livrées
     */
    public function approuverAvecLivraisons()
    {
        if (!$this->peutEtreApprouvee()) {
            throw new \Exception('Impossible d\'approuver : aucune livraison validée');
        }

        // Calculer le montant réel basé sur les livraisons
        $montantReel = $this->calculerMontantReel();
        
        // Mettre à jour la commande
        $this->update([
            'statut' => 'approuvee',
            'montant_total' => $montantReel,
            'commentaires' => $this->commentaires . "\n\nAPPROUVÉE le " . now()->format('d/m/Y H:i') . 
                            " - Montant ajusté à " . number_format($montantReel, 2) . " FCFA " .
                            "basé sur les livraisons effectives."
        ]);

        return $this;
    }

    /**
     * Méthodes pour la gestion des paiements
     */
    public function getStatutPaiementLabelAttribute()
    {
        return match($this->statut_paiement) {
            'impaye' => 'Impayé',
            'redevance' => 'Redevance',
            'echu' => 'Échu',
            default => 'Inconnu'
        };
    }

    public function getStatutPaiementColorAttribute()
    {
        return match($this->statut_paiement) {
            'impaye' => 'red',
            'redevance' => 'yellow',
            'echu' => 'green',
            default => 'gray'
        };
    }

    public function getModalitePaiementLabelAttribute()
    {
        return match($this->modalite_paiement) {
            'mensuelle' => 'Mensuelle',
            'annuelle' => 'Annuelle',
            'unique' => 'Paiement unique',
            default => 'Inconnu'
        };
    }

    /**
     * Initialiser les montants de paiement
     */
    public function initialiserPaiement()
    {
        $this->update([
            'montant_a_payer' => $this->montant_total,
            'reste_a_payer' => $this->montant_total,
            'avance' => 0,
            'statut_paiement' => 'impaye'
        ]);
    }

    /**
     * Enregistrer un paiement
     */
    public function enregistrerPaiement($montant, $modePaiement = 'especes', $referencePaiement = null, $commentaire = null)
    {
        // Créer l'enregistrement de paiement
        $this->paiements()->create([
            'user_id' => auth()->id(),
            'montant' => $montant,
            'mode_paiement' => $modePaiement,
            'reference_paiement' => $referencePaiement,
            'commentaire' => $commentaire,
            'date_paiement' => now()
        ]);

        // Mettre à jour les montants de la commande
        $nouvelleAvance = $this->avance + $montant;
        $nouveauReste = $this->montant_a_payer - $nouvelleAvance;
        
        // Déterminer le nouveau statut
        $nouveauStatut = 'impaye';
        if ($nouveauReste <= 0) {
            $nouveauStatut = 'echu';
        } elseif ($nouvelleAvance > 0) {
            $nouveauStatut = 'redevance';
        }

        $this->update([
            'avance' => $nouvelleAvance,
            'reste_a_payer' => max(0, $nouveauReste),
            'statut_paiement' => $nouveauStatut,
            'date_dernier_paiement' => now()
        ]);

        return $this;
    }

    /**
     * Obtenir le total des paiements effectués
     */
    public function getTotalPaiementsAttribute()
    {
        return $this->paiements->sum('montant');
    }

    /**
     * Obtenir l'historique des paiements formaté
     */
    public function getHistoriquePaiementsAttribute()
    {
        return $this->paiements()->orderBy('date_paiement', 'desc')->get();
    }

    /**
     * Vérifier si la commande peut être payée (doit être livrée)
     */
    public function peutEtrePayee()
    {
        return in_array($this->statut, ['approuvee', 'livree']);
    }

    /**
     * Scope pour les commandes payables
     */
    public function scopePayables($query)
    {
        return $query->whereIn('statut', ['approuvee', 'livree']);
    }

    /**
     * Scope pour les commandes par statut de paiement
     */
    public function scopeParStatutPaiement($query, $statut)
    {
        return $query->where('statut_paiement', $statut);
    }
}
