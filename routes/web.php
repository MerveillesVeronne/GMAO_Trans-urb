<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ContratController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\LivraisonController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\BonCommandeController;
use App\Http\Controllers\AlerteStockController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\PaiementContratController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\SortieStockController;
use App\Http\Controllers\MaintenanceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route d'accueil
Route::get('/', function () {
    return view('welcome');
});

// Routes d'authentification
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Routes protégées par authentification
Route::middleware('auth')->group(function () {
    
    // Dashboards n
    Route::get('/dashboard/moyens-generaux', [DashboardController::class, 'moyensGeneraux'])->middleware(['auth', 'module:moyens-generaux'])->name('dashboard.moyens-generaux');

    Route::get('/dashboard/maintenance', [DashboardController::class, 'maintenance'])->middleware(['auth', 'module:maintenance'])->name('dashboard.maintenance');

    Route::get('/dashboard/logistique', [DashboardController::class, 'logistique'])->middleware(['auth', 'module:logistique'])->name('dashboard.logistique');

    // Routes pour la maintenance
    Route::middleware(['auth', 'module:maintenance'])->group(function () {
        Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance.index');
        Route::get('/maintenance/vehicules', [MaintenanceController::class, 'vehicules'])->name('maintenance.vehicules');
        Route::get('/maintenance/interventions', [MaintenanceController::class, 'interventions'])->name('maintenance.interventions');
        Route::get('/maintenance/pieces', [MaintenanceController::class, 'pieces'])->name('maintenance.pieces');
        Route::get('/maintenance/planning', [MaintenanceController::class, 'planning'])->name('maintenance.planning');
    });

    // Routes pour les fournisseurs (Moyens Généraux)
    Route::middleware(['auth', 'module:moyens-generaux'])->group(function () {
        Route::get('/fournisseurs', [FournisseurController::class, 'index'])->name('liste.fournisseurs');
        Route::get('/fournisseurs/create', [FournisseurController::class, 'create'])->name('fournisseurs.create');
        Route::post('/fournisseurs', [FournisseurController::class, 'store'])->name('ajouter.fournisseur');
        Route::get('/fournisseurs/export/pdf', [FournisseurController::class, 'exportListPdf'])->name('fournisseurs.export');
        Route::get('/fournisseurs/{fournisseur}', [FournisseurController::class, 'show'])->name('fournisseur.details');
        Route::get('/fournisseurs/{fournisseur}/pdf', [FournisseurController::class, 'exportPdf'])->name('fournisseur.pdf');
        Route::get('/fournisseurs/{fournisseur}/edit', [FournisseurController::class, 'edit'])->name('fournisseur.edit');
        Route::put('/fournisseurs/{fournisseur}', [FournisseurController::class, 'update'])->name('fournisseur.update');
        Route::delete('/fournisseurs/{fournisseur}', [FournisseurController::class, 'destroy'])->name('fournisseur.destroy');
    });

    // Routes pour les contrats (Moyens Généraux)
    Route::middleware(['auth', 'module:moyens-generaux'])->group(function () {
        Route::get('/contrats', [ContratController::class, 'index'])->name('liste.contrats');
        Route::get('/contrats/create', [ContratController::class, 'create'])->name('contrats.create');
        Route::post('/contrats', [ContratController::class, 'store'])->name('contrats.store');
        Route::get('/contrats/{id}', [ContratController::class, 'show'])->name('contrat.details');
        Route::get('/contrats/{id}/edit', [ContratController::class, 'edit'])->name('contrat.edit');
        Route::put('/contrats/{id}', [ContratController::class, 'update'])->name('contrats.update');
        Route::delete('/contrats/{id}', [ContratController::class, 'destroy'])->name('contrat.destroy');
        Route::post('/contrats/{id}/renouveler', [ContratController::class, 'renouveler'])->name('contrats.renouveler');
        Route::post('/contrats/{id}/resilier', [ContratController::class, 'resilier'])->name('contrats.resilier');
        Route::post('/contrats/{id}/suspendre', [ContratController::class, 'suspendre'])->name('contrats.suspendre');
        Route::post('/contrats/{id}/reactiver', [ContratController::class, 'reactiver'])->name('contrats.reactiver');
        Route::get('/contrats/export/pdf', [ContratController::class, 'exportPdf'])->name('contrats.export');
    });
    
    // Routes pour les paiements de contrats
    Route::get('/contrats/{contrat}/paiement/modal', [PaiementContratController::class, 'showModal'])->middleware('auth')->name('contrats.paiement.modal');
    Route::post('/contrats/{contrat}/paiement', [PaiementContratController::class, 'store'])->middleware('auth')->name('contrats.paiement.store');
    Route::get('/contrats/{contrat}/paiement/historique', [PaiementContratController::class, 'historique'])->middleware('auth')->name('contrats.paiement.historique');
    
    // Nouvelles routes pour les paiements périodiques
    Route::post('/contrats/{id}/traiter-paiement', [ContratController::class, 'traiterPaiement'])->middleware('auth')->name('contrats.traiter-paiement');
    Route::get('/contrats/{id}/infos-paiement', [ContratController::class, 'getInfosPaiement'])->middleware('auth')->name('contrats.infos-paiement');
    Route::get('/contrats/{id}/echeances', [ContratController::class, 'getEcheances'])->middleware('auth')->name('contrats.echeances');
    
    // Routes pour les transactions
    Route::get('/transactions', [TransactionController::class, 'index'])->middleware('auth')->name('transactions.index');
    Route::get('/transactions/{id}/{type}', [TransactionController::class, 'show'])->middleware('auth')->name('transactions.show');
    Route::get('/transactions/export/pdf', [TransactionController::class, 'exportPdf'])->middleware('auth')->name('transactions.export');

    // Routes pour les bons de commande
    Route::get('/bons-commande', [BonCommandeController::class, 'index'])->middleware('auth')->name('bons-commande.index');
    Route::get('/bons-commande/create', [BonCommandeController::class, 'create'])->middleware('auth')->name('bons-commande.create');
    Route::post('/bons-commande', [BonCommandeController::class, 'store'])->middleware('auth')->name('bons-commande.store');
    Route::get('/bons-commande/{bonCommande}', [BonCommandeController::class, 'show'])->middleware('auth')->name('bons-commande.show');
    Route::get('/bons-commande/{bonCommande}/edit', [BonCommandeController::class, 'edit'])->middleware('auth')->name('bons-commande.edit');
    Route::put('/bons-commande/{bonCommande}', [BonCommandeController::class, 'update'])->middleware('auth')->name('bons-commande.update');
    Route::delete('/bons-commande/{bonCommande}', [BonCommandeController::class, 'destroy'])->middleware('auth')->name('bons-commande.destroy');
    Route::post('/bons-commande/{bonCommande}/creer-commande', [BonCommandeController::class, 'creerCommande'])->middleware('auth')->name('bons-commande.creer-commande');

    Route::post('/bons-commande/{bonCommande}/valider', [BonCommandeController::class, 'validerGlobalement'])->middleware('auth')->name('bons-commande.valider');
    Route::get('/bons-commande/export/pdf', [BonCommandeController::class, 'exportPdf'])->middleware('auth')->name('bons-commande.export');

    // Routes pour les commandes
    Route::get('/commandes', [CommandeController::class, 'index'])->middleware('auth')->name('liste.commandes');
    Route::get('/commandes/nouvelle', [CommandeController::class, 'create'])->middleware('auth')->name('nouvelle.commande');
    Route::post('/commandes', [CommandeController::class, 'store'])->middleware('auth')->name('commandes.store');
    Route::get('/commandes/{commande}', [CommandeController::class, 'show'])->middleware('auth')->name('commande.details');
    Route::get('/commandes/{commande}/edit', [CommandeController::class, 'edit'])->middleware('auth')->name('commande.edit');
    Route::put('/commandes/{commande}', [CommandeController::class, 'update'])->middleware('auth')->name('commande.update');
    Route::delete('/commandes/{commande}', [CommandeController::class, 'destroy'])->middleware('auth')->name('commande.destroy');

    // Actions sur les commandes
    Route::post('/commandes/{commande}/approuver', [CommandeController::class, 'approuver'])->middleware('auth')->name('commande.approuver');
    Route::post('/commandes/{commande}/livrer', [CommandeController::class, 'livrer'])->middleware('auth')->name('commande.livrer');
    Route::post('/commandes/{commande}/annuler', [CommandeController::class, 'annuler'])->middleware('auth')->name('commande.annuler');

    // Routes pour les paiements
    Route::get('/commandes/paiements', [CommandeController::class, 'paiements'])->name('commandes.paiements');
    Route::get('/commandes/{commande}/paiement', [CommandeController::class, 'formulairePaiement'])->name('commande.paiement');
    Route::post('/commandes/{commande}/paiement', [CommandeController::class, 'traiterPaiement'])->name('commande.traiterPaiement');

    // Nouvelles routes pour le système de paiement complet
    Route::get('/paiements', [PaiementController::class, 'index'])->middleware('auth')->name('paiements.index');
    Route::get('/paiements/{commande}', [PaiementController::class, 'show'])->middleware('auth')->name('paiements.show');
    Route::get('/paiements/modal/{commande}', [PaiementController::class, 'showModal'])->middleware('auth')->name('paiements.modal');
    Route::post('/paiements/{commande}', [PaiementController::class, 'store'])->middleware('auth')->name('paiements.store');
    Route::get('/paiements/historique/{commande}', [PaiementController::class, 'historique'])->middleware('auth')->name('paiements.historique');
    Route::get('/paiements/export/pdf', [PaiementController::class, 'exportPdf'])->middleware('auth')->name('paiements.export');

    // Routes pour les commandes
    Route::post('/commandes/initialiser-paiements', [CommandeController::class, 'initialiserPaiements'])->middleware('auth')->name('commandes.initialiserPaiements');

    // Actions sur les lignes de commande
    Route::put('/lignes-commande/{ligne}', [CommandeController::class, 'updateLigne'])->middleware('auth')->name('ligne.update');
    Route::get('/commandes/export/pdf', [CommandeController::class, 'exportPdf'])->middleware('auth')->name('commandes.export');

    // Routes pour les livraisons
    Route::get('/livraisons', [LivraisonController::class, 'index'])->name('livraisons.index');
    Route::get('/livraisons/create/{commande}', [LivraisonController::class, 'create'])->name('livraisons.create');
    Route::post('/livraisons/{commande}', [LivraisonController::class, 'store'])->name('livraisons.store');
    Route::get('/livraisons/{livraison}', [LivraisonController::class, 'show'])->name('livraisons.show');
    Route::get('/livraisons/{livraison}/edit', [LivraisonController::class, 'edit'])->name('livraisons.edit');
    Route::put('/livraisons/{livraison}', [LivraisonController::class, 'update'])->name('livraisons.update');
    Route::delete('/livraisons/{livraison}', [LivraisonController::class, 'destroy'])->name('livraisons.destroy');
    Route::post('/livraisons/{livraison}/valider', [LivraisonController::class, 'valider'])->name('livraisons.valider');

    // Validation manuelle d'une livraison par ligne de commande
    Route::post('/livraisons/valider-ligne/{ligne}', [App\Http\Controllers\LivraisonController::class, 'validerLigne'])->name('livraisons.validerLigne');

    // Routes pour les stocks
    Route::get('/stocks', [StockController::class, 'index'])->name('stocks.index');
    Route::get('/stocks/dashboard', [StockController::class, 'dashboard'])->name('stocks.dashboard');
    Route::get('/stocks/create', [StockController::class, 'create'])->name('stocks.create');
    Route::post('/stocks', [StockController::class, 'store'])->name('stocks.store');
    Route::get('/stocks/{stock}', [StockController::class, 'show'])->name('stocks.show');
    Route::get('/stocks/{stock}/edit', [StockController::class, 'edit'])->name('stocks.edit');
    Route::put('/stocks/{stock}', [StockController::class, 'update'])->name('stocks.update');
    Route::delete('/stocks/{stock}', [StockController::class, 'destroy'])->name('stocks.destroy');
    Route::post('/stocks/{stock}/ajuster', [StockController::class, 'ajuster'])->name('stocks.ajuster');

    // Routes pour les sorties de stock
    Route::get('/stocks/sorties', [SortieStockController::class, 'index'])->name('stocks.sorties.index');
    Route::get('/stocks/sorties/create', [SortieStockController::class, 'create'])->middleware('auth')->name('stocks.sorties.create');
    Route::post('/stocks/sorties', [SortieStockController::class, 'store'])->middleware('auth')->name('stocks.sorties.store');
    Route::get('/stocks/sorties/tracabilite', [SortieStockController::class, 'tracabilite'])->middleware('auth')->name('stocks.sorties.tracabilite');
    Route::get('/stocks/sorties/historique/{stock}', [SortieStockController::class, 'historique'])->middleware('auth')->name('stocks.sorties.historique');
    Route::get('/stocks/sorties/stock-info/{stock}', [SortieStockController::class, 'getStockInfo'])->middleware('auth')->name('stocks.sorties.stockInfo');
    Route::get('/stocks/sorties/{sortieStock}', [SortieStockController::class, 'show'])->middleware('auth')->name('stocks.sorties.show');
    Route::post('/stocks/sorties/{sortieStock}/annuler', [SortieStockController::class, 'annuler'])->middleware('auth')->name('stocks.sorties.annuler');

    // Routes pour les alertes de stock
    Route::get('/alertes', [AlerteStockController::class, 'index'])->middleware('auth')->name('alertes.index');
    Route::get('/alertes/dashboard', [AlerteStockController::class, 'dashboard'])->middleware('auth')->name('alertes.dashboard');
    Route::get('/alertes/{alerte}', [AlerteStockController::class, 'show'])->middleware('auth')->name('alertes.show');
    Route::post('/alertes/{alerte}/resoudre', [AlerteStockController::class, 'resoudre'])->middleware('auth')->name('alertes.resoudre');
    Route::post('/alertes/{alerte}/ignorer', [AlerteStockController::class, 'ignorer'])->middleware('auth')->name('alertes.ignorer');
    Route::post('/alertes/resoudre-toutes', [AlerteStockController::class, 'resoudreToutes'])->middleware('auth')->name('alertes.resoudre-toutes');
    Route::post('/alertes/verifier', [AlerteStockController::class, 'verifierAlertes'])->middleware('auth')->name('alertes.verifier');
    Route::get('/alertes/export', [AlerteStockController::class, 'export'])->middleware('auth')->name('alertes.export');
    Route::delete('/alertes/{alerte}', [AlerteStockController::class, 'destroy'])->middleware('auth')->name('alertes.destroy');
    Route::get('/stocks/{stock}/alertes', [AlerteStockController::class, 'parStock'])->middleware('auth')->name('alertes.par-stock');

    // Routes pour les loyers et charges
    Route::get('/loyers', function () {
        return view('lists.loyers');
    })->middleware('auth')->name('liste.loyers');

    Route::get('/loyers/nouveau', function () {
        return view('loyers.nouveau');
    })->middleware('auth')->name('nouveau.loyer');

    Route::get('/loyers/echeances', function () {
        return view('loyers.echeances');
    })->middleware('auth')->name('loyers.echeances');

    Route::get('/loyers/paiements', function () {
        return view('loyers.paiements');
    })->middleware('auth')->name('loyers.paiements');

    Route::get('/contrats/echeances', function () {
        return view('contrats.echeances');
    })->middleware('auth')->name('contrats.echeances');

    // Route pour les chauffeurs
    Route::get('/chauffeur/fdt', function () {
        return view('chauffeur.fdt');
    })->name('chauffeur.fdt');
});

// Routes placeholders pour le module maintenance
Route::get('/maintenance/vehicules', function () {
    return view('maintenance.vehicules.index');
})->name('maintenance.vehicules.index');

Route::get('/maintenance/interventions', function () {
    return view('maintenance.interventions.index');
})->name('maintenance.interventions.index');

Route::get('/maintenance/pieces', function () {
    return view('maintenance.pieces.index');
})->name('maintenance.pieces.index');

Route::get('/maintenance/planning', function () {
    return view('maintenance.planning.index');
})->name('maintenance.planning.index');
