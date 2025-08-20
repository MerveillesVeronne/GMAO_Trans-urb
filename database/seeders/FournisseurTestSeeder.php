<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fournisseur;

class FournisseurTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fournisseurs = [
            [
                'nom' => 'Bailleur Principal',
                'adresse' => '123 Rue Principale',
                'telephone' => '0123456789',
                'email' => 'bailleur@test.com'
            ],
            [
                'nom' => 'EDG',
                'adresse' => '456 Avenue Électricité',
                'telephone' => '0987654321',
                'email' => 'edg@test.com'
            ],
            [
                'nom' => 'SONEB',
                'adresse' => '789 Boulevard Eau',
                'telephone' => '0555666777',
                'email' => 'soneb@test.com'
            ],
            [
                'nom' => 'Orange Bénin',
                'adresse' => '321 Rue Internet',
                'telephone' => '0888999000',
                'email' => 'orange@test.com'
            ],
            [
                'nom' => 'MTN Bénin',
                'adresse' => '654 Avenue Télécom',
                'telephone' => '0777888999',
                'email' => 'mtn@test.com'
            ]
        ];

        foreach ($fournisseurs as $fournisseur) {
            Fournisseur::create($fournisseur);
        }
    }
}
