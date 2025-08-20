<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'produit', 'reference_unique', 'description', 'quantite_disponible', 'quantite_minimale',
        'unite', 'emplacement', 'cout_unitaire', 'categorie', 'actif'
    ];

    protected $casts = [
        'quantite_disponible' => 'integer',
        'quantite_minimale' => 'integer',
        'cout_unitaire' => 'decimal:2',
        'actif' => 'boolean'
    ];

    /**
     * Vérifier si le stock est en alerte (quantité inférieure au seuil)
     */
    public function isEnAlerte()
    {
        return $this->quantite_disponible <= $this->quantite_minimale;
    }

    /**
     * Ajouter du stock
     */
    public function ajouterStock($quantite, $cout_unitaire = null)
    {
        $this->quantite_disponible += $quantite;
        
        // Mettre à jour le coût unitaire moyen si fourni
        if ($cout_unitaire) {
            $total_cout = ($this->cout_unitaire * ($this->quantite_disponible - $quantite)) + ($cout_unitaire * $quantite);
            $this->cout_unitaire = $total_cout / $this->quantite_disponible;
        }
        
        $this->save();
    }

    /**
     * Retirer du stock
     */
    public function retirerStock($quantite)
    {
        if ($this->quantite_disponible >= $quantite) {
            $this->quantite_disponible -= $quantite;
            $this->save();
            return true;
        }
        return false;
    }

    /**
     * Trouver ou créer un stock pour un produit
     */
    public static function trouverOuCreer($produit, $description = null, $categorie = null)
    {
        $reference_unique = static::genererReferenceUnique($produit);
        
        return static::firstOrCreate(
            ['produit' => $produit],
            [
                'reference_unique' => $reference_unique,
                'description' => $description,
                'categorie' => $categorie,
                'quantite_disponible' => 0,
                'quantite_minimale' => 0,
                'unite' => 'unité',
                'actif' => true
            ]
        );
    }

    /**
     * Générer une référence unique pour un produit
     */
    public static function genererReferenceUnique($produit)
    {
        $prefix = strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $produit), 0, 3));
        $count = static::where('reference_unique', 'like', $prefix . '%')->count();
        $suffix = str_pad($count + 1, 4, '0', STR_PAD_LEFT);
        
        return $prefix . $suffix;
    }

    /**
     * Scope pour les produits en alerte
     */
    public function scopeEnAlerte($query)
    {
        return $query->whereRaw('quantite_disponible <= quantite_minimale');
    }

    /**
     * Scope pour les produits actifs
     */
    public function scopeActifs($query)
    {
        return $query->where('actif', true);
    }

    /**
     * Relation avec les sorties de stock
     */
    public function sorties()
    {
        return $this->hasMany(SortieStock::class);
    }

    /**
     * Vérifier si on peut retirer une quantité
     */
    public function peutRetirer($quantite)
    {
        return $this->quantite_disponible >= $quantite;
    }

    /**
     * Obtenir l'historique des sorties
     */
    public function getHistoriqueSorties()
    {
        return $this->sorties()
            ->with('validePar')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Calculer la valeur totale du stock
     */
    public function getValeurTotale()
    {
        return $this->quantite_disponible * $this->cout_unitaire;
    }

    /**
     * Relation avec les alertes
     */
    public function alertes()
    {
        return $this->hasMany(AlerteStock::class);
    }

    /**
     * Vérifier et créer des alertes si nécessaire
     */
    public function verifierAlertes()
    {
        // Alerte seuil bas
        if ($this->quantite_disponible <= $this->quantite_minimale && $this->quantite_disponible > 0) {
            $this->creerAlerte('seuil_bas', "Stock faible pour {$this->produit} ({$this->quantite_disponible} {$this->unite} restant)");
        }

        // Alerte rupture
        if ($this->quantite_disponible == 0) {
            $this->creerAlerte('rupture', "Rupture de stock pour {$this->produit}");
        }
    }

    /**
     * Créer une alerte
     */
    public function creerAlerte($type, $message)
    {
        // Vérifier si une alerte active existe déjà
        $alerteExistante = $this->alertes()
            ->where('type_alerte', $type)
            ->where('statut', 'active')
            ->first();

        if (!$alerteExistante) {
            $this->alertes()->create([
                'type_alerte' => $type,
                'message' => $message,
                'date_alerte' => now(),
                'statut' => 'active'
            ]);
        }
    }

    /**
     * Résoudre les alertes actives
     */
    public function resoudreAlertes()
    {
        $this->alertes()
            ->where('statut', 'active')
            ->update([
                'statut' => 'resolue',
                'date_resolution' => now(),
                'resolu_par' => auth()->id()
            ]);
    }
}
