<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BonCommande;

class UpdateBonCommandeQuantites extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bons-commande:update-quantites';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mettre à jour les quantités satisfaites de tous les bons de commande';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mise à jour des quantités satisfaites des bons de commande...');

        $bonsCommande = BonCommande::all();
        $updated = 0;

        foreach ($bonsCommande as $bonCommande) {
            $ancienneQuantite = $bonCommande->quantite_satisfaite;
            $bonCommande->mettreAJourQuantiteSatisfaite();
            
            if ($bonCommande->quantite_satisfaite !== $ancienneQuantite) {
                $this->line("Bon de commande {$bonCommande->reference}: {$ancienneQuantite} → {$bonCommande->quantite_satisfaite} unités satisfaites");
                $updated++;
            }
        }

        $this->info("Mise à jour terminée. {$updated} bons de commande mis à jour.");
    }
}
