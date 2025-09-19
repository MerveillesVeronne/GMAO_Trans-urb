<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonCommandeMaintenance extends Model
{
    use HasFactory;

    protected $table = 'bon_commande_maintenances';

    protected $fillable = [
        'reference', 'intervention_id', 'vehicule_id', 'chauffeur', 'motif_intervention',
        'pieces_necessaires', 'statut', 'date_creation', 'date_besoin', 'date_debut_prevue',
        'date_fin_prevue', 'notes', 'signataire_1_id', 'signature_1_date', 'signature_1_fonction',
        'signataire_2_id', 'signature_2_date', 'signature_2_fonction', 'valide', 'valide_par_id', 'valide_le'
    ];

    protected $casts = [
        'date_creation' => 'datetime',
        'date_besoin' => 'datetime',
        'date_debut_prevue' => 'datetime',
        'date_fin_prevue' => 'datetime',
        'signature_1_date' => 'datetime',
        'signature_2_date' => 'datetime',
        'valide' => 'boolean',
        'valide_le' => 'datetime',
    ];

    /**
     * Relations
     */
    public function intervention()
    {
        return $this->belongsTo(Intervention::class);
    }

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }

    public function signataire1()
    {
        return $this->belongsTo(User::class, 'signataire_1_id');
    }

    public function signataire2()
    {
        return $this->belongsTo(User::class, 'signataire_2_id');
    }

    public function validePar()
    {
        return $this->belongsTo(User::class, 'valide_par_id');
    }

    /**
     * Accesseurs
     */
    public function getStatutLabelAttribute()
    {
        return match($this->statut) {
            'En Attente' => 'En attente',
            'Signé' => 'Signé',
            'Approuvé' => 'Approuvé',
            'En Cours' => 'En cours',
            'Terminé' => 'Terminé',
            'Annulé' => 'Annulé',
            default => 'Inconnu'
        };
    }

    public function getStatutColorAttribute()
    {
        return match($this->statut) {
            'En Attente' => 'yellow',
            'Signé' => 'blue',
            'Approuvé' => 'green',
            'En Cours' => 'orange',
            'Terminé' => 'green',
            'Annulé' => 'red',
            default => 'gray'
        };
    }

    /**
     * Méthodes utilitaires
     */
    public function estSigne()
    {
        // Seule la signature du Chef de la Logistique est obligatoire
        return $this->signataire_2_id;
    }

    public function peutEtreValide()
    {
        return $this->estSigne() && $this->statut === 'Signé';
    }

    public function estValide()
    {
        return $this->valide && $this->statut === 'Approuvé';
    }

    public function peutDemarrer()
    {
        return $this->estValide() && $this->verifierDisponibilitePieces();
    }

    /**
     * Vérifier la disponibilité des pièces
     */
    public function verifierDisponibilitePieces()
    {
        // Cette méthode sera implémentée pour vérifier le stock
        // Pour l'instant, on retourne true
        return true;
    }

    /**
     * Signer le bon de commande
     */
    public function signer($signataireId, $fonction, $numeroSignature = 1)
    {
        if ($numeroSignature === 1) {
            $this->update([
                'signataire_1_id' => $signataireId,
                'signature_1_date' => now(),
                'signature_1_fonction' => $fonction
            ]);
        } elseif ($numeroSignature === 2) {
            $this->update([
                'signataire_2_id' => $signataireId,
                'signature_2_date' => now(),
                'signature_2_fonction' => $fonction
            ]);
        }

        // Si la signature du Chef de la Logistique est présente, passer au statut "Signé"
        if ($this->signataire_2_id) {
            $this->update(['statut' => 'Signé']);
        }
    }

    /**
     * Valider le bon de commande
     */
    public function valider($valideurId)
    {
        if ($this->peutEtreValide()) {
            $this->update([
                'valide' => true,
                'valide_par_id' => $valideurId,
                'valide_le' => now(),
                'statut' => 'Approuvé'
            ]);
            
            // Soustraire les pièces du stock lors de la validation
            $this->soustrairePiecesDuStock();
            
            return true;
        }
        return false;
    }

    /**
     * Démarrer l'intervention
     */
    public function demarrerIntervention()
    {
        if ($this->peutDemarrer()) {
            $this->update(['statut' => 'En Cours']);
            $this->intervention->update(['statut' => 'En Cours']);
            return true;
        }
        return false;
    }

    /**
     * Terminer l'intervention
     */
    public function terminerIntervention()
    {
        $this->update(['statut' => 'Terminé']);
        $this->intervention->update(['statut' => 'Terminee']);
    }

    /**
     * Soustraire les pièces utilisées du stock lors de la validation du bon de commande
     */
    public function soustrairePiecesDuStock()
    {
        if (!$this->pieces_necessaires || !$this->intervention->quantite_pieces) {
            return;
        }

        $piecesArray = explode(', ', $this->pieces_necessaires);
        $quantitesArray = explode(', ', $this->intervention->quantite_pieces);

        foreach ($piecesArray as $index => $pieceName) {
            if (isset($quantitesArray[$index])) {
                $quantite = (int) preg_replace('/[^0-9]/', '', $quantitesArray[$index]);
                
                // Trouver la pièce par sa désignation
                $piece = \App\Models\Piece::where('designation', trim($pieceName))->first();
                
                if ($piece && $piece->quantite_stock >= $quantite) {
                    $piece->decrement('quantite_stock', $quantite);
                    
                    // Enregistrer la sortie de stock
                    \App\Models\SortieStock::create([
                        'piece_id' => $piece->id,
                        'quantite' => $quantite,
                        'motif' => "Intervention maintenance - {$this->reference}",
                        'date_sortie' => now(),
                        'utilisateur_id' => auth()->id(),
                        'bon_commande_id' => $this->id,
                        'type_sortie' => 'Maintenance'
                    ]);
                }
            }
        }
    }

    /**
     * Générer une référence unique
     */
    public static function genererReference()
    {
        $count = static::count();
        $year = date('Y');
        return "BCM-{$year}-" . str_pad($count + 1, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Scopes
     */
    public function scopeEnAttente($query)
    {
        return $query->where('statut', 'En Attente');
    }

    public function scopeSigne($query)
    {
        return $query->where('statut', 'Signé');
    }

    public function scopeApprouve($query)
    {
        return $query->where('statut', 'Approuvé');
    }

    public function scopeEnCours($query)
    {
        return $query->where('statut', 'En Cours');
    }

    public function scopeTermine($query)
    {
        return $query->where('statut', 'Terminé');
    }

    /**
     * Boot method pour générer automatiquement la référence
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($bonCommande) {
            if (empty($bonCommande->reference)) {
                $bonCommande->reference = static::genererReference();
            }
            if (empty($bonCommande->date_creation)) {
                $bonCommande->date_creation = now();
            }
        });
    }
}
