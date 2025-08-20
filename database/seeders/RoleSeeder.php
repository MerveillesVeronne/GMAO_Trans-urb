<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            // Rôles DFC
            [
                'nom_role' => 'Directeur DFC',
                'code_role' => 'DIR_DFC',
                'description' => 'Directeur de la Direction Financière et Comptable',
                'permissions' => [
                    'dfc.full_access',
                    'amg.full_access',
                    'budget.manage',
                    'fonds.manage',
                    'contrats.approve',
                    'commandes.approve',
                    'reporting.view_all'
                ],
                'niveau_hierarchique' => 100,
                'active' => true
            ],
            [
                'nom_role' => 'Chef Service AMG',
                'code_role' => 'CHEF_AMG',
                'description' => 'Chef du Service Achats et Moyens Généraux',
                'permissions' => [
                    'amg.manage',
                    'fournisseurs.manage',
                    'contrats.manage',
                    'commandes.manage',
                    'materiaux.manage',
                    'besoins.validate',
                    'reporting.amg'
                ],
                'niveau_hierarchique' => 80,
                'active' => true
            ],
            [
                'nom_role' => 'Agent AMG',
                'code_role' => 'AGENT_AMG',
                'description' => 'Agent du Service Achats et Moyens Généraux',
                'permissions' => [
                    'amg.view',
                    'fournisseurs.view',
                    'contrats.view',
                    'commandes.create',
                    'materiaux.view',
                    'besoins.process'
                ],
                'niveau_hierarchique' => 50,
                'active' => true
            ],

            // Rôles DEX
            [
                'nom_role' => 'Directeur DEX',
                'code_role' => 'DIR_DEX',
                'description' => 'Directeur de la Direction d\'Exploitation',
                'permissions' => [
                    'dex.full_access',
                    'maintenance.full_access',
                    'logistique.full_access',
                    'besoins.create',
                    'reporting.dex'
                ],
                'niveau_hierarchique' => 100,
                'active' => true
            ],
            [
                'nom_role' => 'Chef Service Maintenance',
                'code_role' => 'CHEF_MAINT',
                'description' => 'Chef du Service Maintenance',
                'permissions' => [
                    'maintenance.manage',
                    'fdt.manage',
                    'bdc.create',
                    'vehicules.manage',
                    'besoins.create',
                    'reporting.maintenance'
                ],
                'niveau_hierarchique' => 80,
                'active' => true
            ],
            [
                'nom_role' => 'Chef Service Logistique',
                'code_role' => 'CHEF_LOGI',
                'description' => 'Chef du Service Logistique',
                'permissions' => [
                    'logistique.manage',
                    'stocks.validate',
                    'bdc.sign',
                    'livraisons.manage',
                    'besoins.create',
                    'reporting.logistique'
                ],
                'niveau_hierarchique' => 80,
                'active' => true
            ],

            // Rôles Techniques
            [
                'nom_role' => 'Mécanicien',
                'code_role' => 'MECANICIEN',
                'description' => 'Technicien mécanicien',
                'permissions' => [
                    'maintenance.view',
                    'fdt.view',
                    'interventions.mechanical',
                    'bdc.request'
                ],
                'niveau_hierarchique' => 40,
                'active' => true
            ],
            [
                'nom_role' => 'Électricien',
                'code_role' => 'ELECTRICIEN',
                'description' => 'Technicien électricien',
                'permissions' => [
                    'maintenance.view',
                    'fdt.view',
                    'interventions.electrical',
                    'bdc.request'
                ],
                'niveau_hierarchique' => 40,
                'active' => true
            ],
            [
                'nom_role' => 'Vulcanisateur',
                'code_role' => 'VULCANISATEUR',
                'description' => 'Technicien vulcanisateur',
                'permissions' => [
                    'maintenance.view',
                    'fdt.view',
                    'interventions.tires',
                    'bdc.request'
                ],
                'niveau_hierarchique' => 40,
                'active' => true
            ],

            // Rôles Génériques
            [
                'nom_role' => 'Chauffeur',
                'code_role' => 'CHAUFFEUR',
                'description' => 'Chauffeur de véhicule',
                'permissions' => [
                    'fdt.create',
                    'vehicules.view_assigned'
                ],
                'niveau_hierarchique' => 30,
                'active' => true
            ],
            [
                'nom_role' => 'Utilisateur Direction',
                'code_role' => 'USER_DIR',
                'description' => 'Utilisateur standard d\'une direction',
                'permissions' => [
                    'besoins.create',
                    'profil.manage'
                ],
                'niveau_hierarchique' => 20,
                'active' => true
            ]
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
