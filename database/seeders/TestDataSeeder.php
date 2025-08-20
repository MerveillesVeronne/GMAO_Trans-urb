<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stock;
use App\Models\Commande;
use App\Models\LigneCommande;
use App\Models\Livraison;
use App\Models\Fournisseur;
use App\Models\User;

class TestDataSeeder extends Seeder
{
    public function run()
    {
        // Créer des produits en stock
        $huile = Stock::create([
            'produit' => 'Huile moteur 5W30',
            'description' => 'Huile moteur synthétique haute performance',
            'quantite_disponible' => 50,
            'quantite_minimale' => 10,
            'unite' => 'L',
            'cout_unitaire' => 2500,
            'categorie' => 'Lubrifiants',
            'emplacement' => 'Rayon A1'
        ]);

        $filtres = Stock::create([
            'produit' => 'Filtres à air',
            'description' => 'Filtres à air pour moteurs diesel',
            'quantite_disponible' => 25,
            'quantite_minimale' => 5,
            'unite' => 'unité',
            'cout_unitaire' => 1500,
            'categorie' => 'Filtres',
            'emplacement' => 'Rayon B2'
        ]);

        $plaquettes = Stock::create([
            'produit' => 'Plaquettes de frein',
            'description' => 'Plaquettes avant et arrière haute qualité',
            'quantite_disponible' => 15,
            'quantite_minimale' => 8,
            'unite' => 'paire',
            'cout_unitaire' => 8000,
            'categorie' => 'Freinage',
            'emplacement' => 'Rayon C3'
        ]);

        // Récupérer un fournisseur existant ou en créer un
        $fournisseur = Fournisseur::first() ?? Fournisseur::create([
            'nom' => 'AutoParts Plus',
            'email' => 'contact@autoparts.com',
            'telephone' => '+225 0123456789',
            'adresse' => '123 Rue du Commerce, Abidjan',
            'ville' => 'Abidjan',
            'pays' => 'Côte d\'Ivoire',
            'type' => 'pièces'
        ]);

        // Récupérer un utilisateur existant
        $user = User::first();

        // Créer une commande avec livraisons partielles
        $commande = Commande::create([
            'reference' => 'CMD-2024-001',
            'date_commande' => now()->subDays(5),
            'date_livraison' => now()->addDays(2),
            'fournisseur_id' => $fournisseur->id,
            'statut' => 'en_attente',
            'commentaires' => 'Commande de maintenance préventive',
            'user_id' => $user->id
        ]);

        // Créer les lignes de commande
        $ligne1 = LigneCommande::create([
            'commande_id' => $commande->id,
            'produit' => 'Huile moteur 5W30',
            'description' => 'Huile moteur synthétique',
            'quantite' => 20,
            'cout_unitaire' => 2500,
            'total_ligne' => 50000,
            'statut_ligne' => 'en_attente'
        ]);

        $ligne2 = LigneCommande::create([
            'commande_id' => $commande->id,
            'produit' => 'Filtres à air',
            'description' => 'Filtres à air pour moteurs',
            'quantite' => 10,
            'cout_unitaire' => 1500,
            'total_ligne' => 15000,
            'statut_ligne' => 'en_attente'
        ]);

        $ligne3 = LigneCommande::create([
            'commande_id' => $commande->id,
            'produit' => 'Plaquettes de frein',
            'description' => 'Plaquettes avant et arrière',
            'quantite' => 5,
            'cout_unitaire' => 8000,
            'total_ligne' => 40000,
            'statut_ligne' => 'en_attente'
        ]);

        // Créer des livraisons partielles
        // Livraison 1 : Huile moteur - livraison complète
        Livraison::create([
            'commande_id' => $commande->id,
            'ligne_commande_id' => $ligne1->id,
            'date_livraison' => now()->subDays(2),
            'quantite_livree' => 20,
            'quantite_commandee' => 20,
            'commentaires' => 'Livraison complète',
            'statut' => 'complete',
            'valide_par' => $user->id,
            'valide_le' => now()->subDays(2)
        ]);

        // Livraison 2 : Filtres à air - livraison partielle
        Livraison::create([
            'commande_id' => $commande->id,
            'ligne_commande_id' => $ligne2->id,
            'date_livraison' => now()->subDays(1),
            'quantite_livree' => 7,
            'quantite_commandee' => 10,
            'commentaires' => 'Livraison partielle - 3 unités en rupture',
            'statut' => 'partielle',
            'valide_par' => $user->id,
            'valide_le' => now()->subDays(1)
        ]);

        // Livraison 3 : Plaquettes de frein - pas encore livré
        // (pas de livraison pour tester le cas où un produit n'est pas livré)

        // Mettre à jour les lignes avec les quantités livrées
        $ligne1->update([
            'quantite_livree' => 20,
            'date_derniere_livraison' => now()->subDays(2),
            'livraison_complete' => true
        ]);

        $ligne2->update([
            'quantite_livree' => 7,
            'date_derniere_livraison' => now()->subDays(1),
            'livraison_complete' => false
        ]);

        $ligne3->update([
            'quantite_livree' => 0,
            'livraison_complete' => false
        ]);

        // Mettre à jour les stocks
        $huile->ajouterStock(20, 2500);
        $filtres->ajouterStock(7, 1500);

        echo "Données de test créées avec succès!\n";
        echo "Commande CMD-2024-001 créée avec:\n";
        echo "- Huile moteur: 20/20 livrés (100%)\n";
        echo "- Filtres à air: 7/10 livrés (70%)\n";
        echo "- Plaquettes de frein: 0/5 livrés (0%)\n";
        echo "Montant commandé: " . number_format($commande->calculerMontantTotal(), 2) . " FCFA\n";
        echo "Montant à payer: " . number_format($commande->calculerMontantReel(), 2) . " FCFA\n";
    }
} 