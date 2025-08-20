<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Commande;

class InitialiserPaiementsCommandes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'commandes:initialiser-paiements';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialiser les montants de paiement pour les commandes existantes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Initialisation des montants de paiement des commandes...');

        $commandes = Commande::whereNull('montant_a_payer')
            ->orWhere('montant_a_payer', 0)
            ->orWhereNull('reste_a_payer')
            ->orWhere('reste_a_payer', 0)
            ->get();

        $updated = 0;

        foreach ($commandes as $commande) {
            // Calculer le montant total si nécessaire
            if ($commande->montant_total == 0) {
                $montantTotal = $commande->calculerMontantTotal();
                $commande->update(['montant_total' => $montantTotal]);
            }

            // Initialiser les montants de paiement
            $commande->initialiserPaiement();
            
            $this->line("Commande {$commande->reference}: montant_total = {$commande->montant_total}, montant_a_payer = {$commande->montant_a_payer}, reste_a_payer = {$commande->reste_a_payer}");
            $updated++;
        }

        $this->info("Initialisation terminée. {$updated} commandes mises à jour.");
    }
}
