<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Direction;
use App\Models\Service;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupération des entités
        $dfc = Direction::where('code_direction', 'DFC')->first();
        $dex = Direction::where('code_direction', 'DEX')->first();
        $drh = Direction::where('code_direction', 'DRH')->first();
        
        $amg = Service::where('code_service', 'AMG')->first();
        $maintenance = Service::where('code_service', 'MAINT')->first();
        $logistique = Service::where('code_service', 'LOGI')->first();
        
        $dirDfc = Role::where('code_role', 'DIR_DFC')->first();
        $chefAmg = Role::where('code_role', 'CHEF_AMG')->first();
        $agentAmg = Role::where('code_role', 'AGENT_AMG')->first();
        $dirDex = Role::where('code_role', 'DIR_DEX')->first();
        $chefMaint = Role::where('code_role', 'CHEF_MAINT')->first();
        $chefLogi = Role::where('code_role', 'CHEF_LOGI')->first();
        $mecanicien = Role::where('code_role', 'MECANICIEN')->first();
        $chauffeur = Role::where('code_role', 'CHAUFFEUR')->first();
        $userDir = Role::where('code_role', 'USER_DIR')->first();

        $users = [
            // Utilisateurs DFC/AMG
            [
                'name' => 'Jean BERNARD',
                'prenom' => 'Jean',
                'nom' => 'BERNARD',
                'matricule' => 'DFC001',
                'email' => 'j.bernard@transurb.com',
                'telephone' => '01 23 45 67 89',
                'password' => Hash::make('password'),
                'direction_id' => $dfc->id,
                'service_id' => null,
                'role_id' => $dirDfc->id,
                'statut' => 'actif',
                'date_embauche' => '2020-01-15',
                'commentaire' => 'Directeur DFC - Accès complet module AMG'
            ],
            [
                'name' => 'Marie DUBOIS',
                'prenom' => 'Marie',
                'nom' => 'DUBOIS',
                'matricule' => 'AMG001',
                'email' => 'm.dubois@transurb.com',
                'telephone' => '01 23 45 67 90',
                'password' => Hash::make('password'),
                'direction_id' => $dfc->id,
                'service_id' => $amg->id,
                'role_id' => $chefAmg->id,
                'statut' => 'actif',
                'date_embauche' => '2021-03-10',
                'commentaire' => 'Chef Service AMG - Gestion complète achats et moyens généraux'
            ],
            [
                'name' => 'Pierre MARTIN',
                'prenom' => 'Pierre',
                'nom' => 'MARTIN',
                'matricule' => 'AMG002',
                'email' => 'p.martin@transurb.com',
                'telephone' => '01 23 45 67 91',
                'password' => Hash::make('password'),
                'direction_id' => $dfc->id,
                'service_id' => $amg->id,
                'role_id' => $agentAmg->id,
                'statut' => 'actif',
                'date_embauche' => '2022-06-01',
                'commentaire' => 'Agent AMG - Traitement des commandes et fournisseurs'
            ],

            // Utilisateurs DEX
            [
                'name' => 'Claude ROUSSEAU',
                'prenom' => 'Claude',
                'nom' => 'ROUSSEAU',
                'matricule' => 'DEX001',
                'email' => 'c.rousseau@transurb.com',
                'telephone' => '01 23 45 67 92',
                'password' => Hash::make('password'),
                'direction_id' => $dex->id,
                'service_id' => null,
                'role_id' => $dirDex->id,
                'statut' => 'actif',
                'date_embauche' => '2019-09-15',
                'commentaire' => 'Directeur DEX - Supervision maintenance et logistique'
            ],
            [
                'name' => 'Alain MOREAU',
                'prenom' => 'Alain',
                'nom' => 'MOREAU',
                'matricule' => 'MAINT001',
                'email' => 'a.moreau@transurb.com',
                'telephone' => '01 23 45 67 93',
                'password' => Hash::make('password'),
                'direction_id' => $dex->id,
                'service_id' => $maintenance->id,
                'role_id' => $chefMaint->id,
                'statut' => 'actif',
                'date_embauche' => '2020-11-20',
                'commentaire' => 'Chef Service Maintenance - Gestion parc véhicules'
            ],
            [
                'name' => 'Sophie LEROY',
                'prenom' => 'Sophie',
                'nom' => 'LEROY',
                'matricule' => 'LOGI001',
                'email' => 's.leroy@transurb.com',
                'telephone' => '01 23 45 67 94',
                'password' => Hash::make('password'),
                'direction_id' => $dex->id,
                'service_id' => $logistique->id,
                'role_id' => $chefLogi->id,
                'statut' => 'actif',
                'date_embauche' => '2021-02-12',
                'commentaire' => 'Chef Service Logistique - Validation stocks et BDC'
            ],

            // Utilisateurs techniques
            [
                'name' => 'Ahmed HASSAN',
                'prenom' => 'Ahmed',
                'nom' => 'HASSAN',
                'matricule' => 'MECA001',
                'email' => 'a.hassan@transurb.com',
                'telephone' => '01 23 45 67 95',
                'password' => Hash::make('password'),
                'direction_id' => $dex->id,
                'service_id' => $maintenance->id,
                'role_id' => $mecanicien->id,
                'statut' => 'actif',
                'date_embauche' => '2022-01-08',
                'commentaire' => 'Mécanicien senior - Interventions techniques'
            ],
            [
                'name' => 'Mohamed BENALI',
                'prenom' => 'Mohamed',
                'nom' => 'BENALI',
                'matricule' => 'CHAUF001',
                'email' => 'm.benali@transurb.com',
                'telephone' => '01 23 45 67 96',
                'password' => Hash::make('password'),
                'direction_id' => $dex->id,
                'service_id' => null,
                'role_id' => $chauffeur->id,
                'statut' => 'actif',
                'date_embauche' => '2021-05-17',
                'commentaire' => 'Chauffeur ligne 12 - Saisie FDT'
            ],

            // Utilisateur direction externe
            [
                'name' => 'Fatou DIOP',
                'prenom' => 'Fatou',
                'nom' => 'DIOP',
                'matricule' => 'DRH001',
                'email' => 'f.diop@transurb.com',
                'telephone' => '01 23 45 67 97',
                'password' => Hash::make('password'),
                'direction_id' => $drh->id,
                'service_id' => null,
                'role_id' => $userDir->id,
                'statut' => 'actif',
                'date_embauche' => '2020-07-03',
                'commentaire' => 'DRH - Expression de besoins bureaux et matériel'
            ]
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}
