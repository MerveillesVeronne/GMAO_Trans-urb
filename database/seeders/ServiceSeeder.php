<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Direction;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupération des directions
        $dfc = Direction::where('code_direction', 'DFC')->first();
        $dex = Direction::where('code_direction', 'DEX')->first();
        $drh = Direction::where('code_direction', 'DRH')->first();
        $di = Direction::where('code_direction', 'DI')->first();
        $dcom = Direction::where('code_direction', 'DCOM')->first();

        $services = [
            // Services sous DFC
            [
                'direction_id' => $dfc->id,
                'nom_service' => 'Achats et Moyens Généraux',
                'code_service' => 'AMG',
                'chef_service' => null,
                'description' => 'Service responsable des achats, contrats et moyens généraux',
                'active' => true,
                'ordre_affichage' => 1
            ],
            [
                'direction_id' => $dfc->id,
                'nom_service' => 'Comptabilité',
                'code_service' => 'COMPTA',
                'chef_service' => null,
                'description' => 'Service responsable de la comptabilité générale',
                'active' => true,
                'ordre_affichage' => 2
            ],

            // Services sous DEX
            [
                'direction_id' => $dex->id,
                'nom_service' => 'Maintenance',
                'code_service' => 'MAINT',
                'chef_service' => null,
                'description' => 'Service responsable de la maintenance du parc véhicules',
                'active' => true,
                'ordre_affichage' => 1
            ],
            [
                'direction_id' => $dex->id,
                'nom_service' => 'Logistique',
                'code_service' => 'LOGI',
                'chef_service' => null,
                'description' => 'Service responsable de la logistique et gestion des stocks',
                'active' => true,
                'ordre_affichage' => 2
            ],

            // Services sous DRH
            [
                'direction_id' => $drh->id,
                'nom_service' => 'Gestion du Personnel',
                'code_service' => 'GP',
                'chef_service' => null,
                'description' => 'Service responsable de la gestion du personnel',
                'active' => true,
                'ordre_affichage' => 1
            ],

            // Services sous DI
            [
                'direction_id' => $di->id,
                'nom_service' => 'Support Informatique',
                'code_service' => 'SI',
                'chef_service' => null,
                'description' => 'Service responsable du support et infrastructure IT',
                'active' => true,
                'ordre_affichage' => 1
            ],

            // Services sous DCOM
            [
                'direction_id' => $dcom->id,
                'nom_service' => 'Communication Externe',
                'code_service' => 'COMEXT',
                'chef_service' => null,
                'description' => 'Service responsable de la communication externe',
                'active' => true,
                'ordre_affichage' => 1
            ]
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
