<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LigneTransport;

class LigneTransportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lignes = [
            [
                'nom' => 'CNSS',
                'type_affectation' => 'Location',
                'actif' => true,
            ],
            [
                'nom' => 'ANINF',
                'type_affectation' => 'Location',
                'actif' => true,
            ],
            [
                'nom' => 'Ligne 1',
                'type_affectation' => 'Urbain',
                'actif' => true,
            ],
            [
                'nom' => 'Ligne 2',
                'type_affectation' => 'Urbain',
                'actif' => true,
            ],
            [
                'nom' => 'Rio-Charbonnage',
                'type_affectation' => 'Inter-urbain',
                'actif' => true,
            ],
            [
                'nom' => 'Libreville-Ntoum',
                'type_affectation' => 'Inter-urbain',
                'actif' => true,
            ],
        ];

        foreach ($lignes as $ligne) {
            LigneTransport::create($ligne);
        }
    }
}
