<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'fournisseur_id',
        'intitule',
        'date_debut',
        'date_fin',
        'montant',
        'statut',
        'description',
        'type',
        'categorie',
        'periodicite',
        'montant_a_payer',
        'avance',
        'reste_a_payer',
        'statut_paiement',
        'modalite_paiement',
        'date_dernier_paiement',
        'date_debut_initiale',
        'date_fin_initiale',
        'montant_initial',
        'jours_suspension',
        'raison_suspension',
        'date_debut_suspension',
        'nombre_renouvellements',
        'date_resiliation',
        'raison_resiliation'
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'date_debut_initiale' => 'date',
        'date_fin_initiale' => 'date',
        'date_debut_suspension' => 'datetime',
        'date_resiliation' => 'date',
        'date_dernier_paiement' => 'date',
        'montant' => 'decimal:2',
        'montant_initial' => 'decimal:2',
        'montant_a_payer' => 'decimal:2',
        'avance' => 'decimal:2',
        'reste_a_payer' => 'decimal:2'
    ];

    // Relations
    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    public function paiements()
    {
        return $this->hasMany(PaiementContrat::class);
    }

    // Générer une référence automatique
    public static function generateReference()
    {
        $lastContrat = self::orderBy('id', 'desc')->first();
        $lastNumber = $lastContrat ? intval(substr($lastContrat->reference, -3)) : 0;
        $newNumber = $lastNumber + 1;
        return 'CTR-' . date('Y') . '-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    // Boot method pour définir les valeurs par défaut
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($contrat) {
            if (empty($contrat->reference)) {
                $contrat->reference = self::generateReference();
            }
            
            // Définir les valeurs initiales pour la traçabilité
            if (empty($contrat->date_debut_initiale)) {
                $contrat->date_debut_initiale = $contrat->date_debut;
            }
            if (empty($contrat->date_fin_initiale)) {
                $contrat->date_fin_initiale = $contrat->date_fin;
            }
            if (empty($contrat->montant_initial)) {
                $contrat->montant_initial = $contrat->montant;
            }
        });
        
        static::created(function ($contrat) {
            // Initialiser les champs de paiement lors de la création
            $contrat->initialiserPaiement();
        });
    }

    // Constantes pour les catégories
    public static function getCategories()
    {
        return [
            'assurance' => '🛡️ Assurance',
            'inspecteur' => '🔍 Inspecteur',
            'visite_technique' => '🔧 Visite Technique',
            'tiers' => '👥 Tiers',
            'informatique' => '💻 Informatique',
            'internet' => '🌐 Internet',
            'flotte' => '🚗 Flotte',
            'loyer' => '🏢 Loyer',
            'electricite' => '⚡ Électricité',
            'eau' => '💧 Eau',
            'carburant' => '⛽ Carburant',
            'pieces' => '🔧 Pièces',
            'autre' => '📦 Autre'
        ];
    }

    // Catégories non-suspendables
    public static function getCategoriesNonSuspendables()
    {
        return [
            'inspecteur',
            'visite_technique',
            'loyer',
            'electricite',
            'eau',
            'internet',
            'flotte'
        ];
    }

    // Vérifier si le contrat peut être suspendu
    public function peutEtreSuspendu()
    {
        return !in_array($this->categorie, self::getCategoriesNonSuspendables());
    }

    // Vérifier si le contrat a une périodicité de paiement
    public function aPeriodicitePaiement()
    {
        return in_array($this->categorie, self::getCategoriesAvecPeriodicite());
    }

    public static function getPeriodicites()
    {
        return [
            'journaliere' => '📅 Journalière',
            'hebdomadaire' => '📅 Hebdomadaire',
            'mensuelle' => '📅 Mensuelle',
            'trimestrielle' => '📅 Trimestrielle',
            'semestrielle' => '📅 Semestrielle',
            'annuelle' => '📅 Annuelle'
        ];
    }

    public static function getCategoriesAvecPeriodicite()
    {
        return [
            'internet',
            'flotte',
            'loyer',
            'electricite',
            'eau'
        ];
    }

    // Calculer la prochaine échéance de paiement
    public function getProchaineEcheance()
    {
        if (!$this->aPeriodicitePaiement()) {
            return null;
        }

        $derniereEcheance = $this->date_dernier_paiement ?? $this->date_debut;
        
        switch ($this->periodicite) {
            case 'mensuelle':
                return $derniereEcheance->addMonth();
            case 'trimestrielle':
                return $derniereEcheance->addMonths(3);
            case 'semestrielle':
                return $derniereEcheance->addMonths(6);
            case 'annuelle':
                return $derniereEcheance->addYear();
            default:
                return null;
        }
    }

    // Vérifier si une échéance est dépassée
    public function echeanceDepassee()
    {
        if (!$this->aPeriodicitePaiement()) {
            return false;
        }

        $prochaineEcheance = $this->getProchaineEcheance();
        return $prochaineEcheance && $prochaineEcheance->isPast();
    }

    // Calculer le nombre d'échéances en retard
    public function getEcheancesEnRetard()
    {
        if (!$this->aPeriodicitePaiement()) {
            return 0;
        }

        $derniereEcheance = $this->date_dernier_paiement ?? $this->date_debut;
        $aujourdhui = now();
        
        if ($derniereEcheance->isFuture()) {
            return 0;
        }

        switch ($this->periodicite) {
            case 'mensuelle':
                return $derniereEcheance->diffInMonths($aujourdhui);
            case 'trimestrielle':
                return floor($derniereEcheance->diffInMonths($aujourdhui) / 3);
            case 'semestrielle':
                return floor($derniereEcheance->diffInMonths($aujourdhui) / 6);
            case 'annuelle':
                return $derniereEcheance->diffInYears($aujourdhui);
            default:
                return 0;
        }
    }

    // Calculer le montant total des redevances
    public function getMontantRedevances()
    {
        if (!$this->aPeriodicitePaiement()) {
            return 0;
        }

        $echeancesEnRetard = $this->getEcheancesEnRetard();
        return $echeancesEnRetard * $this->montant;
    }

    // Méthode pour traiter un paiement périodique
    public function traiterPaiementPeriodique($montantPaye, $modePaiement = 'virement', $reference = null, $commentaire = null)
    {
        if (!$this->aPeriodicitePaiement()) {
            return $this->enregistrerPaiement($montantPaye, $modePaiement, $reference, $commentaire ?? 'Paiement unique');
        }

        $redevances = $this->getMontantRedevances();
        $montantRestant = $montantPaye;

        // D'abord éponger les redevances
        if ($redevances > 0) {
            $montantPourRedevances = min($montantRestant, $redevances);
            $montantRestant -= $montantPourRedevances;
            
            // Enregistrer le paiement des redevances
            $this->paiements()->create([
                'user_id' => auth()->id(),
                'montant' => $montantPourRedevances,
                'mode_paiement' => $modePaiement,
                'reference_paiement' => $reference,
                'commentaire' => $commentaire ?? "Paiement redevances ({$this->getEcheancesEnRetard()} échéances)",
                'date_paiement' => now()
            ]);
        }

        // Si il reste de l'argent, l'appliquer aux échéances futures
        if ($montantRestant > 0) {
            $this->paiements()->create([
                'user_id' => auth()->id(),
                'montant' => $montantRestant,
                'mode_paiement' => $modePaiement,
                'reference_paiement' => $reference,
                'commentaire' => $commentaire ?? "Avance pour échéances futures",
                'date_paiement' => now()
            ]);
        }

        // Mettre à jour les champs du contrat
        $this->mettreAJourStatutPaiement();

        return true;
    }

    // Méthode pour mettre à jour le statut de paiement
    public function mettreAJourStatutPaiement()
    {
        $totalPaiements = $this->paiements()->sum('montant');
        $echeancesEnRetard = $this->getEcheancesEnRetard();
        $montantRedevances = $this->getMontantRedevances();
        
        // Déterminer le statut de paiement
        $statutPaiement = 'en_attente';
        
        if ($totalPaiements > 0) {
            if ($echeancesEnRetard > 0) {
                $statutPaiement = 'en_retard';
            } elseif ($montantRedevances > 0) {
                $statutPaiement = 'partiel';
            } else {
                $statutPaiement = 'a_jour';
            }
        }

        $this->update([
            'avance' => $totalPaiements,
            'date_dernier_paiement' => now(),
            'statut_paiement' => $statutPaiement
        ]);
    }

    // Méthode pour obtenir le détail des échéances
    public function getDetailEcheances()
    {
        if (!$this->aPeriodicitePaiement()) {
            return null;
        }

        $echeances = [];
        $dateDebut = $this->date_debut;
        $aujourdhui = now();
        $echeanceActuelle = $dateDebut->copy();

        // Générer les échéances jusqu'à aujourd'hui
        while ($echeanceActuelle <= $aujourdhui) {
            $echeances[] = [
                'date' => $echeanceActuelle->format('d/m/Y'),
                'montant' => $this->montant,
                'statut' => $this->getStatutEcheance($echeanceActuelle)
            ];

            // Passer à la prochaine échéance
            switch ($this->periodicite) {
                case 'mensuelle':
                    $echeanceActuelle->addMonth();
                    break;
                case 'trimestrielle':
                    $echeanceActuelle->addMonths(3);
                    break;
                case 'semestrielle':
                    $echeanceActuelle->addMonths(6);
                    break;
                case 'annuelle':
                    $echeanceActuelle->addYear();
                    break;
            }
        }

        return $echeances;
    }

    // Méthode pour déterminer le statut d'une échéance
    private function getStatutEcheance($dateEcheance)
    {
        $paiementsPourEcheance = $this->paiements()
            ->where('date_paiement', '>=', $dateEcheance)
            ->where('date_paiement', '<', $dateEcheance->copy()->addDay())
            ->sum('montant');

        if ($paiementsPourEcheance >= $this->montant) {
            return 'payee';
        } elseif ($paiementsPourEcheance > 0) {
            return 'partielle';
        } else {
            return 'impayee';
        }
    }

    // Accesseurs pour les labels
    public function getCategorieLabelAttribute()
    {
        $categories = self::getCategories();
        return $categories[$this->categorie] ?? $this->categorie;
    }

    public function getPeriodiciteLabelAttribute()
    {
        $periodicites = self::getPeriodicites();
        return $periodicites[$this->periodicite] ?? $this->periodicite;
    }

    // Accesseur pour le statut de paiement
    public function getStatutPaiementLabelAttribute()
    {
        $statuts = [
            'en_attente' => '⏳ En attente',
            'a_jour' => '✅ À jour',
            'en_retard' => '⚠️ En retard',
            'partiel' => '💰 Partiel',
            'paye' => '✅ Payé'
        ];
        
        return $statuts[$this->statut_paiement] ?? $this->statut_paiement;
    }

    // Scopes pour le filtrage
    public function scopeByCategorie($query, $categorie)
    {
        return $query->where('categorie', $categorie);
    }

    public function scopeByPeriodicite($query, $periodicite)
    {
        return $query->where('periodicite', $periodicite);
    }

    public function scopeByStatut($query, $statut)
    {
        return $query->where('statut', $statut);
    }

    // Méthodes pour la gestion des paiements
    public function initialiserPaiement()
    {
        if (empty($this->montant_a_payer)) {
            $this->update([
                'montant_a_payer' => $this->montant,
                'reste_a_payer' => $this->montant,
                'avance' => 0,
                'statut_paiement' => 'en_attente',
                'modalite_paiement' => 'unique'
            ]);
        }
    }

    public function enregistrerPaiement($montant, $modePaiement, $reference = null, $commentaire = null)
    {
        // Créer l'enregistrement de paiement
        $paiement = $this->paiements()->create([
            'user_id' => auth()->id(),
            'montant' => $montant,
            'mode_paiement' => $modePaiement,
            'reference_paiement' => $reference,
            'commentaire' => $commentaire,
            'date_paiement' => now()
        ]);

        // Mettre à jour les champs de paiement du contrat
        $nouvelleAvance = $this->avance + $montant;
        $nouveauReste = $this->montant_a_payer - $nouvelleAvance;
        
        $this->update([
            'avance' => $nouvelleAvance,
            'reste_a_payer' => max(0, $nouveauReste),
            'date_dernier_paiement' => now(),
            'statut_paiement' => $nouveauReste <= 0 ? 'paye' : 'partiel'
        ]);

        return $paiement;
    }

    // Accesseurs pour les paiements
    public function getTotalPaiementsAttribute()
    {
        return $this->paiements()->sum('montant');
    }

    public function getHistoriquePaiementsAttribute()
    {
        return $this->paiements()->with('user')->orderBy('date_paiement', 'desc')->get();
    }
}
