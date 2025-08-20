<?php

namespace App\Console\Commands;

use App\Models\Contrat;
use Illuminate\Console\Command;

class InitialiserPaiementsContrats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contrats:initialiser-paiements';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialiser les champs de paiement pour tous les contrats existants';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Initialisation des champs de paiement pour les contrats...');
        
        $contrats = Contrat::all();
        $count = 0;
        
        foreach ($contrats as $contrat) {
            if (empty($contrat->montant_a_payer)) {
                $contrat->update([
                    'montant_a_payer' => $contrat->montant,
                    'reste_a_payer' => $contrat->montant,
                    'avance' => 0,
                    'statut_paiement' => 'en_attente',
                    'modalite_paiement' => 'unique'
                ]);
                $count++;
            }
        }
        
        $this->info("✅ {$count} contrats initialisés avec succès !");
    }
}
