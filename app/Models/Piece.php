<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piece extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'designation',
        'categorie',
        'marque_compatible',
        'quantite_stock',
        'seuil_alerte',
        'prix_unitaire',
        'fournisseur',
        'numero_fournisseur',
        'localisation',
        'description',
        'specifications'
    ];

    protected $casts = [
        'quantite_stock' => 'integer',
        'seuil_alerte' => 'integer',
        'prix_unitaire' => 'decimal:2',
    ];

    // Accesseurs
    public function getValeurStockAttribute()
    {
        return $this->quantite_stock * $this->prix_unitaire;
    }

    public function getStockFaibleAttribute()
    {
        return $this->quantite_stock <= $this->seuil_alerte;
    }

    public function getEnRuptureAttribute()
    {
        return $this->quantite_stock == 0;
    }

    // Scopes
    public function scopeEnStock($query)
    {
        return $query->where('quantite_stock', '>', 0);
    }

    public function scopeEnRupture($query)
    {
        return $query->where('quantite_stock', 0);
    }

    public function scopeStockFaible($query)
    {
        return $query->whereRaw('quantite_stock <= seuil_alerte AND quantite_stock > 0');
    }

    public function scopeParCategorie($query, $categorie)
    {
        return $query->where('categorie', $categorie);
    }
}
