<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'prenom',
        'nom',
        'matricule',
        'telephone',
        'email',
        'password',
        'direction_id',
        'service_id',
        'role_id',
        'statut',
        'date_embauche',
        'commentaire'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_embauche' => 'date',
        ];
    }

    // Relations organisationnelles

    /**
     * Relation avec la direction
     */
    public function direction()
    {
        return $this->belongsTo(Direction::class);
    }

    /**
     * Relation avec le service
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Relation avec le rôle
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Méthodes de permissions

    /**
     * Vérifier si l'utilisateur a une permission
     */
    public function hasPermission($permission)
    {
        return $this->role && $this->role->hasPermission($permission);
    }

    /**
     * Vérifier si l'utilisateur appartient à une direction
     */
    public function belongsToDirection($directionCode)
    {
        return $this->direction && $this->direction->code_direction === $directionCode;
    }

    /**
     * Vérifier si l'utilisateur appartient à un service
     */
    public function belongsToService($serviceCode)
    {
        return $this->service && $this->service->code_service === $serviceCode;
    }

    /**
     * Nom complet de l'utilisateur
     */
    public function getNomCompletAttribute()
    {
        return $this->prenom . ' ' . $this->nom;
    }

    /**
     * Scopes
     */
    public function scopeActif($query)
    {
        return $query->where('statut', 'actif');
    }

    public function scopeByDirection($query, $directionId)
    {
        return $query->where('direction_id', $directionId);
    }

    public function scopeByService($query, $serviceId)
    {
        return $query->where('service_id', $serviceId);
    }
}
