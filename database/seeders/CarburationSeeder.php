<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Carburation;
use App\Models\Vehicule;
use App\Models\User;

class CarburationSeeder extends Seeder
{
    public function run(): void
    {
        // Récupérer quelques véhicules et chauffeurs pour les tests
        $vehicules = Vehicule::take(3)->get();
        $chauffeurs = User::where('role_id', 3)->take(2)->get(); // Supposons que 3 est l'ID du rôle chauffeur

        if ($vehicules->isEmpty() || $chauffeurs->isEmpty()) {
            $this->command->warn('Aucun véhicule ou chauffeur trouvé. Création des carburations annulée.');
            return;
        }

        $carburations = [
            [
                'vehicule_id' => $vehicules->first()->id,
                'chauffeur_id' => $chauffeurs->first()->id,
                'date_carburation' => now()->subDays(2),
                'heure_carburation' => '08:30:00',
                'quantite_litres' => 45.50,
                'prix_litre' => 650.00,
                'etat' => 'Effectuée',
                'type_carburation' => 'Diesel',
                'notes' => 'Carburation matinale avant départ'
            ],
            [
                'vehicule_id' => $vehicules->first()->id,
                'chauffeur_id' => $chauffeurs->last()->id,
                'date_carburation' => now()->subDay(),
                'heure_carburation' => '16:45:00',
                'quantite_litres' => 38.75,
                'prix_litre' => 650.00,
                'etat' => 'Effectuée',
                'type_carburation' => 'Diesel',
                'notes' => 'Carburation de retour'
            ],
            [
                'vehicule_id' => $vehicules->last()->id,
                'chauffeur_id' => $chauffeurs->first()->id,
                'date_carburation' => now(),
                'heure_carburation' => '10:15:00',
                'quantite_litres' => 52.00,
                'prix_litre' => 650.00,
                'etat' => 'Planifiée',
                'type_carburation' => 'Diesel',
                'notes' => 'Carburation préventive'
            ]
        ];

        foreach ($carburations as $carburation) {
            // Calculer le coût total
            $carburation['cout_total'] = $carburation['quantite_litres'] * $carburation['prix_litre'];
            
            Carburation::create($carburation);
        }

        $this->command->info('Carburations de test créées avec succès !');
    }
}
