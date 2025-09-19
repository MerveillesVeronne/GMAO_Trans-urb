<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vehicule;

class UpdateVehiculesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mettre à jour les véhicules existants avec des valeurs par défaut
        $vehicules = Vehicule::all();
        
        foreach ($vehicules as $vehicule) {
            // Définir le type de véhicule par défaut basé sur la marque existante
            $typeVehicule = 'GRAND BUS'; // Par défaut
            
            // Mettre à jour la marque vers les nouvelles valeurs
            $nouvelleMarque = 'MERCEDES MCV'; // Par défaut
            
            // Mise à jour du véhicule
            $vehicule->update([
                'type_vehicule' => $typeVehicule,
                'marque' => $nouvelleMarque
            ]);
        }
        
        $this->command->info('Véhicules mis à jour avec les nouvelles valeurs par défaut.');
    }
}
