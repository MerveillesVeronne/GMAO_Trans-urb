<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicule_id',
        'type_intervention',
        'nature_intervention',
        'priorite',
        'statut',
        'date_debut',
        'date_fin_prevue',
        'date_fin_reelle',
        'technicien',
        'description',
        'pieces_necessaires',
        'quantite_pieces',
        'progression',
        'notes_avancement',
        'delai_supplementaire',
        'raison_delai',
        'signature_maintenance',
        'signature_maintenance_user_id',
        'signature_maintenance_date',
        'signature_logistique',
        'signature_logistique_user_id',
        'signature_logistique_date'
    ];

    protected $casts = [
        'date_debut' => 'datetime',
        'date_fin_prevue' => 'datetime',
        'date_fin_reelle' => 'datetime',
        'progression' => 'integer',
        'delai_supplementaire' => 'integer', // en heures
        'signature_maintenance' => 'boolean',
        'signature_maintenance_date' => 'datetime',
        'signature_logistique' => 'boolean',
        'signature_logistique_date' => 'datetime',
    ];

    // Relations
    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }

    public function bonCommande()
    {
        return $this->hasOne(BonCommandeMaintenance::class);
    }

    public function signatureMaintenanceUser()
    {
        return $this->belongsTo(User::class, 'signature_maintenance_user_id');
    }

    public function signatureLogistiqueUser()
    {
        return $this->belongsTo(User::class, 'signature_logistique_user_id');
    }

    // Scopes
    public function scopeEnCours($query)
    {
        return $query->where('statut', 'En Cours');
    }

    public function scopeTerminees($query)
    {
        return $query->where('statut', 'Terminee');
    }

    public function scopeEnAttente($query)
    {
        return $query->where('statut', 'En Attente');
    }

    public function scopeUrgentes($query)
    {
        return $query->where('priorite', 'Urgente');
    }

    public function scopeEnRetard($query)
    {
        return $query->where('date_fin_prevue', '<', now())
                    ->where('statut', '!=', 'Terminee');
    }

    // Accesseurs
    public function getStatutLabelAttribute()
    {
        return match($this->statut) {
            'En Attente' => 'En attente',
            'En Cours' => 'En cours',
            'Terminee' => 'Terminée',
            'Annulee' => 'Annulée',
            default => 'Inconnu'
        };
    }

    public function getStatutColorAttribute()
    {
        return match($this->statut) {
            'En Attente' => 'yellow',
            'En Cours' => 'blue',
            'Terminee' => 'green',
            'Annulee' => 'red',
            'Livré' => 'purple',
            default => 'gray'
        };
    }

    public function getPrioriteColorAttribute()
    {
        return match($this->priorite) {
            'Normal' => 'blue',
            'À prévoir' => 'yellow',
            'Urgent' => 'red',
            default => 'gray'
        };
    }

    // Méthodes utilitaires
    public function estEnRetard()
    {
        return $this->date_fin_prevue && $this->date_fin_prevue < now() && $this->statut !== 'Terminee';
    }

    public function getDureeEstimee()
    {
        if ($this->date_debut && $this->date_fin_prevue) {
            return $this->date_debut->diffInHours($this->date_fin_prevue);
        }
        return 0;
    }

    public function getDureeReelle()
    {
        if ($this->date_debut && $this->date_fin_reelle) {
            return $this->date_debut->diffInHours($this->date_fin_reelle);
        }
        return 0;
    }

    public function getDelaiSupplementaire()
    {
        if ($this->estEnRetard()) {
            return now()->diffInHours($this->date_fin_prevue);
        }
        return 0;
    }

    public function getProgressionPourcentage()
    {
        return $this->progression ?? 0;
    }

    public function peutDemarrer()
    {
        return $this->statut === 'En Attente' && $this->bonCommande && $this->bonCommande->estValide();
    }

    public function peutTerminer()
    {
        return $this->statut === 'En Cours' && $this->progression >= 100;
    }

    public function demarrer()
    {
        if ($this->peutDemarrer()) {
            $this->update([
                'statut' => 'En Cours',
                'date_debut' => now(),
                'progression' => 0
            ]);
            return true;
        }
        return false;
    }

    public function terminer()
    {
        if ($this->peutTerminer()) {
            $this->update([
                'statut' => 'Terminee',
                'date_fin_reelle' => now(),
                'progression' => 100
            ]);
            return true;
        }
        return false;
    }

    public function mettreAJourProgression($progression, $notes = null)
    {
        $this->update([
            'progression' => max(0, min(100, $progression)),
            'notes_avancement' => $notes
        ]);

        // Si la progression atteint 100%, on peut terminer
        if ($this->progression >= 100) {
            $this->terminer();
        }
    }

    public function ajouterDelaiSupplementaire($heures, $raison)
    {
        $this->update([
            'date_fin_prevue' => $this->date_fin_prevue->addHours($heures),
            'delai_supplementaire' => ($this->delai_supplementaire ?? 0) + $heures,
            'raison_delai' => $raison
        ]);
    }

    public function creerBonCommande()
    {
        if (!$this->bonCommande) {
            return BonCommandeMaintenance::create([
                'intervention_id' => $this->id,
                'vehicule_id' => $this->vehicule_id,
                'motif_intervention' => $this->description,
                'pieces_necessaires' => $this->pieces_necessaires,
                'date_besoin' => $this->date_debut ?? now(),
                'date_debut_prevue' => $this->date_debut,
                'date_fin_prevue' => $this->date_fin_prevue,
            ]);
        }
        return $this->bonCommande;
    }
}
