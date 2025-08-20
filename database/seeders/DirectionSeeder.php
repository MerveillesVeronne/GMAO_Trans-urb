<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Direction;

class DirectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $directions = [
            [
                'nom_direction' => 'Direction Financière et Comptable',
                'code_direction' => 'DFC',
                'responsable' => null,
                'description' => 'Direction responsable de la gestion financière, comptable et des achats',
                'active' => true,
                'ordre_affichage' => 1
            ],
            [
                'nom_direction' => 'Direction d\'Exploitation',
                'code_direction' => 'DEX',
                'responsable' => null,
                'description' => 'Direction responsable de l\'exploitation, maintenance et logistique',
                'active' => true,
                'ordre_affichage' => 2
            ],
            [
                'nom_direction' => 'Direction des Ressources Humaines',
                'code_direction' => 'DRH',
                'responsable' => null,
                'description' => 'Direction responsable de la gestion des ressources humaines',
                'active' => true,
                'ordre_affichage' => 3
            ],
            [
                'nom_direction' => 'Direction Informatique',
                'code_direction' => 'DI',
                'responsable' => null,
                'description' => 'Direction responsable du système d\'information',
                'active' => true,
                'ordre_affichage' => 4
            ],
            [
                'nom_direction' => 'Direction Communication',
                'code_direction' => 'DCOM',
                'responsable' => null,
                'description' => 'Direction responsable de la communication interne et externe',
                'active' => true,
                'ordre_affichage' => 5
            ]
        ];

        foreach ($directions as $direction) {
            Direction::create($direction);
        }
    }
}
