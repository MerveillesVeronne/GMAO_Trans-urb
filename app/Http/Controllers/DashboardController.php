<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contrat;
use App\Models\Commande;
use App\Models\BonCommande;
use App\Models\Fournisseur;
use App\Models\Stock;
use App\Models\AlerteStock;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Afficher le dashboard des moyens généraux avec les vraies données
     */
    public function moyensGeneraux()
    {
        // Statistiques des contrats
        $contratsActifs = Contrat::where('statut', 'actif')->count();
        
        // Statistiques des fournisseurs
        $totalFournisseurs = Fournisseur::count();
        
        // Statistiques des stocks
        $totalProduits = Stock::where('actif', true)->count();
        
        // Budget mensuel (somme des montants des contrats actifs)
        $budgetMensuel = Contrat::where('statut', 'actif')
            ->sum('montant') ?? 0;
        
        // Alertes d'expiration de contrats (prochains 30 jours)
        $alertesExpiration = Contrat::where('statut', 'actif')
            ->where('date_fin', '<=', Carbon::now()->addDays(30))
            ->where('date_fin', '>', Carbon::now())
            ->with('fournisseur')
            ->orderBy('date_fin', 'asc')
            ->limit(5)
            ->get()
            ->map(function ($contrat) {
                $joursRestants = Carbon::now()->diffInDays($contrat->date_fin, false);
                return [
                    'id' => $contrat->id,
                    'intitule' => $contrat->intitule,
                    'fournisseur' => $contrat->fournisseur->nom ?? 'N/A',
                    'date_fin' => $contrat->date_fin->format('d/m/Y'),
                    'jours_restants' => $joursRestants,
                    'urgence' => $joursRestants <= 7 ? 'critique' : ($joursRestants <= 15 ? 'moderee' : 'normale')
                ];
            });
        
        // Commandes récentes (5 dernières)
        $commandesRecentes = Commande::with(['fournisseur', 'bonCommande'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($commande) {
                return [
                    'id' => $commande->id,
                    'reference' => $commande->reference,
                    'fournisseur' => $commande->fournisseur->nom ?? 'N/A',
                    'montant' => $commande->montant_total,
                    'statut' => $commande->statut,
                    'statut_label' => $commande->statut_label,
                    'date_commande' => $commande->date_commande->format('d/m/Y'),
                    'bon_commande' => $commande->bonCommande->reference ?? 'N/A'
                ];
            });
        
        // Statistiques principales
        $stats = [
            'contrats_actifs' => $contratsActifs,
            'total_fournisseurs' => $totalFournisseurs,
            'total_produits' => $totalProduits,
            'budget_mensuel' => $budgetMensuel,
            'budget_formatted' => $budgetMensuel >= 1000000 ? 
                number_format($budgetMensuel / 1000000, 1, ',', ' ') . 'M' : 
                number_format($budgetMensuel / 1000, 0, ',', ' ') . 'k'
        ];
        
        return view('dashboards.moyens-generaux', compact(
            'stats',
            'alertesExpiration',
            'commandesRecentes'
        ));
    }
    
    /**
     * Afficher le dashboard de maintenance
     */
    public function maintenance()
    {
        return view('dashboards.maintenance');
    }
    
    /**
     * Afficher le dashboard de logistique
     */
    public function logistique()
    {
        return view('dashboards.logistique');
    }
} 