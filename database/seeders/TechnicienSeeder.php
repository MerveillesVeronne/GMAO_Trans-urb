<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Intervenant;

class TechnicienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $techniciens = [
            [
                'matricule' => 'TECH001',
                'nom' => 'Dupont',
                'prenom' => 'Jean',
                'fonction_technique' => 'Mécanicien',
                'specialite' => 'Moteurs diesel',
                'niveau_competence' => 'Expert',
                'telephone' => '0123456789',
                'email' => 'jean.dupont@transurb.com',
                'atelier' => 'Atelier Central',
                'date_embauche' => '2020-01-15',
                'statut' => 'Actif',
                'competences' => 'Diagnostic moteur, Réparation transmission, Maintenance préventive',
                'formations_suivies' => 'Formation Mercedes, Formation diagnostic électronique',
                'notes' => 'Technicien expérimenté, spécialiste des moteurs diesel'
            ],
            [
                'matricule' => 'TECH002',
                'nom' => 'Martin',
                'prenom' => 'Marie',
                'fonction_technique' => 'Électricienne',
                'specialite' => 'Systèmes électriques',
                'niveau_competence' => 'Expert',
                'telephone' => '0123456790',
                'email' => 'marie.martin@transurb.com',
                'atelier' => 'Atelier Électrique',
                'date_embauche' => '2019-03-20',
                'statut' => 'Actif',
                'competences' => 'Diagnostic électrique, Réparation circuits, Installation équipements',
                'formations_suivies' => 'Formation électricité automobile, Formation systèmes embarqués',
                'notes' => 'Spécialiste en électricité automobile'
            ],
            [
                'matricule' => 'TECH003',
                'nom' => 'Durand',
                'prenom' => 'Pierre',
                'fonction_technique' => 'Mécanicien',
                'specialite' => 'Suspension et freinage',
                'niveau_competence' => 'Intermédiaire',
                'telephone' => '0123456791',
                'email' => 'pierre.durand@transurb.com',
                'atelier' => 'Atelier Central',
                'date_embauche' => '2021-06-10',
                'statut' => 'Actif',
                'competences' => 'Réparation suspension, Maintenance freinage, Diagnostic châssis',
                'formations_suivies' => 'Formation freinage, Formation suspension',
                'notes' => 'Bon technicien en suspension et freinage'
            ],
            [
                'matricule' => 'TECH004',
                'nom' => 'Bernard',
                'prenom' => 'Sophie',
                'fonction_technique' => 'Mécanicienne',
                'specialite' => 'Climatisation',
                'niveau_competence' => 'Intermédiaire',
                'telephone' => '0123456792',
                'email' => 'sophie.bernard@transurb.com',
                'atelier' => 'Atelier Climatisation',
                'date_embauche' => '2022-01-15',
                'statut' => 'Actif',
                'competences' => 'Réparation climatisation, Maintenance systèmes de refroidissement',
                'formations_suivies' => 'Formation climatisation automobile',
                'notes' => 'Spécialiste en climatisation'
            ],
            [
                'matricule' => 'TECH005',
                'nom' => 'Leroy',
                'prenom' => 'Thomas',
                'fonction_technique' => 'Mécanicien',
                'specialite' => 'Transmission',
                'niveau_competence' => 'Débutant',
                'telephone' => '0123456793',
                'email' => 'thomas.leroy@transurb.com',
                'atelier' => 'Atelier Central',
                'date_embauche' => '2023-09-01',
                'statut' => 'En Formation',
                'competences' => 'Maintenance basique, Changement d\'huile, Filtres',
                'formations_suivies' => 'Formation mécanique de base',
                'notes' => 'Nouveau technicien en formation'
            ]
        ];

        foreach ($techniciens as $technicien) {
            Intervenant::create($technicien);
        }
    }
}
