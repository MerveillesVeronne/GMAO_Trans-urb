<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BonCommande;
use App\Models\LigneBonCommande;
use App\Models\Commande;
use App\Models\LigneCommande;
use App\Models\Fournisseur;
use App\Models\User;
use App\Models\Livraison;

class TestBonCommandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $fournisseurs = Fournisseur::all();

        if ($fournisseurs->isEmpty()) {
            $this->command->error('Aucun fournisseur trouvé. Veuillez d\'abord créer des fournisseurs.');
            return;
        }

        $bonsCommande = [
            [
                'titre' => 'Équipements informatiques - Q1 2025',
                'description' => 'Acquisition d\'équipements informatiques pour renouveler le parc informatique du service logistique',
                'budget_total' => 2500000,
                'date_besoin' => '2025-03-31',
                'lignes' => [
                    [
                        'produit' => 'Ordinateurs de bureau',
                        'description' => 'Ordinateurs de bureau HP ProDesk 400 G7',
                        'quantite_demandee' => 15,
                        'cout_unitaire_estime' => 450000,
                        'unite' => 'unité'
                    ],
                    [
                        'produit' => 'Écrans 24"',
                        'description' => 'Écrans HP 24" Full HD',
                        'quantite_demandee' => 15,
                        'cout_unitaire_estime' => 85000,
                        'unite' => 'unité'
                    ],
                    [
                        'produit' => 'Imprimantes laser',
                        'description' => 'Imprimantes HP LaserJet Pro M404n',
                        'quantite_demandee' => 5,
                        'cout_unitaire_estime' => 180000,
                        'unite' => 'unité'
                    ]
                ]
            ],
            [
                'titre' => 'Fournitures de bureau - Février 2025',
                'description' => 'Commandes de fournitures de bureau pour tous les services',
                'budget_total' => 850000,
                'date_besoin' => '2025-02-28',
                'lignes' => [
                    [
                        'produit' => 'Papier A4',
                        'description' => 'Ramettes de papier A4 80g',
                        'quantite_demandee' => 100,
                        'cout_unitaire_estime' => 2500,
                        'unite' => 'ramette'
                    ],
                    [
                        'produit' => 'Stylos bille',
                        'description' => 'Stylos bille bleus BIC',
                        'quantite_demandee' => 500,
                        'cout_unitaire_estime' => 150,
                        'unite' => 'unité'
                    ],
                    [
                        'produit' => 'Cahiers A4',
                        'description' => 'Cahiers A4 96 pages',
                        'quantite_demandee' => 200,
                        'cout_unitaire_estime' => 1200,
                        'unite' => 'unité'
                    ]
                ]
            ]
        ];

        foreach ($bonsCommande as $bonCommandeData) {
            $lignes = $bonCommandeData['lignes'];
            unset($bonCommandeData['lignes']);

            $bonCommande = BonCommande::create([
                'reference' => BonCommande::genererReference(),
                'titre' => $bonCommandeData['titre'],
                'description' => $bonCommandeData['description'],
                'budget_total' => $bonCommandeData['budget_total'],
                'date_creation' => now(),
                'date_besoin' => $bonCommandeData['date_besoin'],
                'statut' => 'en_attente',
                'user_id' => $user->id
            ]);

            foreach ($lignes as $ligne) {
                LigneBonCommande::create([
                    'bon_commande_id' => $bonCommande->id,
                    'produit' => $ligne['produit'],
                    'description' => $ligne['description'],
                    'quantite_demandee' => $ligne['quantite_demandee'],
                    'cout_unitaire_estime' => $ligne['cout_unitaire_estime'],
                    'unite' => $ligne['unite'],
                    'statut' => 'en_attente'
                ]);
            }

            // Créer des commandes pour le premier bon de commande (pour tester la validation)
            if ($bonCommande->titre === 'Équipements informatiques - Q1 2025') {
                $this->creerCommandesTest($bonCommande, $fournisseurs);
            }
        }

        $this->command->info('Bons de commande de test créés avec succès !');
    }

    private function creerCommandesTest($bonCommande, $fournisseurs)
    {
        // Commande 1 - Ordinateurs
        $commande1 = Commande::create([
            'reference' => 'CMD-' . date('Y') . '-' . str_pad(Commande::count() + 1, 4, '0', STR_PAD_LEFT),
            'date_commande' => now(),
            'fournisseur_id' => $fournisseurs->first()->id,
            'statut' => 'livree',
            'user_id' => auth()->id() ?? 1,
            'bon_commande_id' => $bonCommande->id,
            'commentaires' => 'Commande test - ordinateurs livrés'
        ]);

        $ligne1 = $commande1->lignes()->create([
            'produit' => 'Ordinateurs de bureau',
            'description' => 'Ordinateurs de bureau HP ProDesk 400 G7',
            'quantite' => 10,
            'cout_unitaire' => 450000,
            'statut_ligne' => 'livree',
            'quantite_livree' => 10
        ]);

        // Commande 2 - Écrans
        $commande2 = Commande::create([
            'reference' => 'CMD-' . date('Y') . '-' . str_pad(Commande::count() + 1, 4, '0', STR_PAD_LEFT),
            'date_commande' => now(),
            'fournisseur_id' => $fournisseurs->first()->id,
            'statut' => 'livree',
            'user_id' => auth()->id() ?? 1,
            'bon_commande_id' => $bonCommande->id,
            'commentaires' => 'Commande test - écrans livrés'
        ]);

        $ligne2 = $commande2->lignes()->create([
            'produit' => 'Écrans 24"',
            'description' => 'Écrans HP 24" Full HD',
            'quantite' => 10,
            'cout_unitaire' => 85000,
            'statut_ligne' => 'livree',
            'quantite_livree' => 10
        ]);

        // Créer des livraisons validées
        Livraison::create([
            'commande_id' => $commande1->id,
            'ligne_commande_id' => $ligne1->id,
            'date_livraison' => now(),
            'quantite_livree' => 10,
            'quantite_commandee' => 10,
            'statut' => 'complete',
            'valide_par' => auth()->id() ?? 1,
            'valide_le' => now(),
            'commentaires' => 'Livraison complète validée'
        ]);

        Livraison::create([
            'commande_id' => $commande2->id,
            'ligne_commande_id' => $ligne2->id,
            'date_livraison' => now(),
            'quantite_livree' => 10,
            'quantite_commandee' => 10,
            'statut' => 'complete',
            'valide_par' => auth()->id() ?? 1,
            'valide_le' => now(),
            'commentaires' => 'Livraison complète validée'
        ]);

        $this->command->info('Commandes de test créées pour le bon de commande ' . $bonCommande->reference);
    }
}
