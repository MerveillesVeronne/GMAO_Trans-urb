<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_role',
        'code_role',
        'description',
        'permissions',
        'niveau_hierarchique',
        'active'
    ];

    protected $casts = [
        'permissions' => 'array',
        'active' => 'boolean',
    ];

    /**
     * Relation avec les utilisateurs
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Scope pour les rôles actifs
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * Scope pour ordonner par niveau hiérarchique
     */
    public function scopeByHierarchy($query)
    {
        return $query->orderBy('niveau_hierarchique', 'desc');
    }

    /**
     * Vérifier si le rôle a une permission spécifique
     */
    public function hasPermission($permission)
    {
        return in_array($permission, $this->permissions ?? []);
    }

    /**
     * Ajouter une permission
     */
    public function addPermission($permission)
    {
        $permissions = $this->permissions ?? [];
        if (!in_array($permission, $permissions)) {
            $permissions[] = $permission;
            $this->permissions = $permissions;
        }
        return $this;
    }

    /**
     * Supprimer une permission
     */
    public function removePermission($permission)
    {
        $permissions = $this->permissions ?? [];
        $permissions = array_diff($permissions, [$permission]);
        $this->permissions = array_values($permissions);
        return $this;
    }
}
