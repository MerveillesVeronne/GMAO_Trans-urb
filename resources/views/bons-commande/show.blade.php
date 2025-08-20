@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <!-- Header -->
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Bon de commande {{ $bonCommande->reference }}</h1>
                    <p class="mt-1 text-sm text-gray-500">{{ $bonCommande->titre }}</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('bons-commande.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Retour
                    </a>
                    @if($bonCommande->statut === 'en_attente')
                        <a href="{{ route('bons-commande.edit', $bonCommande) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Modifier
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Secondary Menu -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex space-x-8">
                <a href="{{ route('dashboard.moyens-generaux') }}" class="text-gray-500 hover:text-gray-700 px-3 py-4 text-sm font-medium">Dashboard</a>
                <div class="relative group">
                    <button class="text-gray-500 hover:text-gray-700 px-3 py-4 text-sm font-medium flex items-center">
                        Bons de commande
                        <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-10">
                        <div class="py-1">
                            <a href="{{ route('bons-commande.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Liste des bons de commande</a>
                            <a href="{{ route('bons-commande.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Nouveau bon de commande</a>
                        </div>
                    </div>
                </div>
                <div class="relative group">
                    <button class="text-gray-500 hover:text-gray-700 px-3 py-4 text-sm font-medium flex items-center">
                        Commandes
                        <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-10">
                        <div class="py-1">
                            <a href="{{ route('liste.commandes') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Liste des commandes</a>
                            <a href="{{ route('nouvelle.commande') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Nouvelle commande</a>
                            <a href="{{ route('commandes.paiements') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Paiements</a>
                        </div>
                    </div>
                </div>
                <div class="relative group">
                    <button class="text-gray-500 hover:text-gray-700 px-3 py-4 text-sm font-medium flex items-center">
                        Stocks
                        <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-10">
                        <div class="py-1">
                            <a href="{{ route('stocks.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Gestion des stocks</a>
                            <a href="{{ route('stocks.sorties.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sorties de stock</a>
                            <a href="{{ route('stocks.sorties.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Nouvelle sortie</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Alerts -->
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Informations principales -->
            <div class="lg:col-span-2">
                <!-- Statut et informations -->
                <div class="bg-white shadow rounded-lg mb-6">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Informations générales</h3>
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-{{ $bonCommande->statut_color }}-100 text-{{ $bonCommande->statut_color }}-800">
                                {{ $bonCommande->statut_label }}
                            </span>
                        </div>
                        
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Référence</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $bonCommande->reference }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Date de création</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $bonCommande->date_creation->format('d/m/Y') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Date de besoin</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $bonCommande->date_besoin->format('d/m/Y') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Budget total</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ number_format($bonCommande->budget_total, 0, ',', ' ') }} FCFA</dd>
                            </div>
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500">Description</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $bonCommande->description }}</dd>
                            </div>
                            @if($bonCommande->commentaires)
                                <div class="sm:col-span-2">
                                    <dt class="text-sm font-medium text-gray-500">Commentaires</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $bonCommande->commentaires }}</dd>
                                </div>
                            @endif
                        </dl>
                    </div>
                </div>

                <!-- Informations du produit -->
                <div class="bg-white shadow rounded-lg mb-6">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Informations du produit</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">Produit principal</h4>
                                <p class="mt-1 text-sm text-gray-900">{{ $bonCommande->produit_principal }}</p>
                            </div>
                            
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">Description du produit</h4>
                                <p class="mt-1 text-sm text-gray-900">{{ $bonCommande->description_produit }}</p>
                            </div>
                            
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">Quantité totale souhaitée</h4>
                                <p class="mt-1 text-sm text-gray-900">{{ $bonCommande->quantite_totale_souhaitee }} {{ $bonCommande->unite_produit }}</p>
                            </div>
                            
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">Quantité satisfaite</h4>
                                <p class="mt-1 text-sm text-gray-900">{{ $bonCommande->quantite_satisfaite }} {{ $bonCommande->unite_produit }}</p>
                            </div>
                            
                                                <div>
                                <h4 class="text-sm font-medium text-gray-500">Quantité restante</h4>
                                <p class="mt-1 text-sm font-medium text-orange-600">{{ $bonCommande->getQuantiteRestante() }} {{ $bonCommande->unite_produit }}</p>
                                                </div>
                            
                                                <div>
                                <h4 class="text-sm font-medium text-gray-500">Pourcentage de satisfaction</h4>
                                <div class="mt-1 flex items-center">
                                    <div class="w-full bg-gray-200 rounded-full h-2 mr-2">
                                        <div class="bg-green-600 h-2 rounded-full" style="width: {{ $bonCommande->getPourcentageSatisfaction() }}%"></div>
                                    </div>
                                    <span class="text-sm text-gray-600">{{ $bonCommande->getPourcentageSatisfaction() }}%</span>
                                </div>
                                                        </div>
                            
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">Coût unitaire estimé</h4>
                                <p class="mt-1 text-sm text-gray-900">{{ number_format($bonCommande->cout_unitaire_estime, 0, ',', ' ') }} FCFA</p>
                                                        </div>
                            
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">Coût total estimé</h4>
                                <p class="mt-1 text-sm text-gray-900">{{ number_format($bonCommande->cout_total_estime, 0, ',', ' ') }} FCFA</p>
                                                </div>
                        </div>
                    </div>
                </div>

                <!-- Commandes associées -->
                @if($bonCommande->commandes->count() > 0)
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Commandes associées</h3>
                            
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Référence</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fournisseur</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($bonCommande->commandes as $commande)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ $commande->reference }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $commande->fournisseur->nom }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ number_format($commande->montant_total, 0, ',', ' ') }} FCFA
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-{{ $commande->statut_color }}-100 text-{{ $commande->statut_color }}-800">
                                                        {{ $commande->statut_label }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                    <a href="{{ route('commande.details', $commande) }}" class="text-blue-600 hover:text-blue-900" title="Voir les détails">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Section Paiements - Positionnée horizontalement -->
                @if($bonCommande->commandes->count() > 0)
                    <div class="bg-white shadow rounded-lg mt-6">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                                <i class="fas fa-credit-card text-blue-600 mr-2"></i>
                                Paiements des commandes
                            </h3>
                            
                            @php
                                $commandesPayables = $bonCommande->commandes->filter(function($commande) {
                                    return $commande->peutEtrePayee();
                                });
                                $totalAPayer = $commandesPayables->sum('reste_a_payer');
                                $totalPaye = $commandesPayables->sum('avance');
                            @endphp
                            
                            @if($commandesPayables->count() > 0)
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                                    <div class="flex items-start">
                                        <i class="fas fa-info-circle text-blue-600 mt-1 mr-3"></i>
                                        <div class="flex-1">
                                            <h4 class="font-semibold text-blue-900 mb-2">Commandes à payer</h4>
                                            <p class="text-sm text-blue-800 mb-3">
                                                {{ $commandesPayables->count() }} commande(s) nécessitent un paiement.
                                            </p>
                                            
                                            <div class="grid grid-cols-2 gap-4 text-sm">
                                                <div>
                                                    <span class="font-medium text-blue-700">Total à payer:</span>
                                                    <div class="font-bold text-blue-900">{{ number_format($totalAPayer, 0, ',', ' ') }} FCFA</div>
                                                </div>
                                                <div>
                                                    <span class="font-medium text-blue-700">Déjà payé:</span>
                                                    <div class="font-bold text-blue-900">{{ number_format($totalPaye, 0, ',', ' ') }} FCFA</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="space-y-3">
                                    @foreach($commandesPayables as $commande)
                                        <div class="border border-gray-200 rounded-lg p-4">
                                            <div class="flex items-center justify-between">
                                                <div class="flex-1">
                                                    <div class="flex items-center space-x-4">
                                                        <div>
                                                            <h4 class="font-medium text-gray-900">{{ $commande->reference }}</h4>
                                                            <p class="text-sm text-gray-500">{{ $commande->fournisseur->nom }}</p>
                                                        </div>
                                                        <div class="text-sm">
                                                            <span class="font-medium text-gray-700">Montant total:</span>
                                                            <span class="font-bold text-gray-900">{{ number_format($commande->montant_total, 0, ',', ' ') }} FCFA</span>
                                                        </div>
                                                        <div class="text-sm">
                                                            <span class="font-medium text-gray-700">Reste à payer:</span>
                                                            <span class="font-bold text-red-600">{{ number_format($commande->reste_a_payer, 0, ',', ' ') }} FCFA</span>
                                                        </div>
                                                        <div class="text-sm">
                                                            <span class="font-medium text-gray-700">Statut:</span>
                                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-{{ $commande->statut_paiement_color }}-100 text-{{ $commande->statut_paiement_color }}-800">
                                                                {{ $commande->statut_paiement_label }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex space-x-2">
                                                    <button onclick="ouvrirModalPaiement({{ $commande->id }})" 
                                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                        <i class="fas fa-credit-card mr-2"></i>
                                                        Payer
                                                    </button>
                                                    <button onclick="voirHistorique({{ $commande->id }})" 
                                                            class="inline-flex items-center px-3 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                        <i class="fas fa-history mr-2"></i>
                                                        Historique
                                                    </button>
                                                    <a href="{{ route('commande.details', $commande) }}" 
                                                       class="inline-flex items-center px-3 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                        <i class="fas fa-eye mr-2"></i>
                                                        Détails
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <i class="fas fa-check-circle text-green-500 text-4xl mb-4"></i>
                                    <h4 class="text-lg font-medium text-gray-900 mb-2">Aucun paiement en attente</h4>
                                    <p class="text-gray-500">Toutes les commandes de ce bon de commande ont été payées.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Statistiques -->
                <div class="bg-white shadow rounded-lg mb-6">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Statistiques</h3>
                        
                        <dl class="space-y-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Budget utilisé</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">{{ number_format($bonCommande->getBudgetUtilise(), 0, ',', ' ') }} FCFA</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Budget restant</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">{{ number_format($bonCommande->getBudgetRestant(), 0, ',', ' ') }} FCFA</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Commandes créées</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $bonCommande->commandes->count() }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Satisfaction du besoin</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $bonCommande->getPourcentageSatisfaction() }}%</dd>
                            </div>
                            @if($bonCommande->valide_globalement)
                                <div class="border-t pt-4">
                                    <dt class="text-sm font-medium text-green-600">Montant final validé</dt>
                                    <dd class="mt-1 text-lg font-semibold text-green-900">{{ number_format($bonCommande->montant_final_valide, 0, ',', ' ') }} FCFA</dd>
                                </div>
                            @endif
                        </dl>
                    </div>
                </div>

                <!-- Actions -->
                @if($bonCommande->statut === 'en_attente')
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Actions</h3>
                            
                            <div class="space-y-3">
                                @if($bonCommande->getQuantiteRestante() > 0)
                                <button type="button" onclick="ouvrirModalCreerCommande()" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                        Créer une commande
                                </button>
                                @else
                                    <div class="text-center p-3 bg-gray-100 rounded-md">
                                        <span class="text-sm text-gray-500">Besoin complètement satisfait</span>
                                    </div>
                                @endif
                                
                                <form action="{{ route('bons-commande.destroy', $bonCommande) }}" method="POST" class="inline w-full">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce bon de commande ?')" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Validation globale du bon de commande -->
                @if($bonCommande->peutEtreValideGlobalement())
                    <div class="bg-white shadow rounded-lg mt-6">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                                <i class="fas fa-check-circle text-green-600 mr-2"></i>
                                Validation globale
                            </h3>
                            
                            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                                <div class="flex items-start">
                                    <i class="fas fa-info-circle text-green-600 mt-1 mr-3"></i>
                                    <div>
                                        <h4 class="font-semibold text-green-900 mb-2">Toutes les commandes sont validées !</h4>
                                        <p class="text-sm text-green-800 mb-3">
                                            Toutes les commandes de ce bon de commande ont été livrées et validées. 
                                            Vous pouvez maintenant valider globalement le bon de commande.
                                        </p>
                                        
                                        <div class="grid grid-cols-2 gap-4 text-sm">
                                            <div>
                                                <span class="font-medium text-green-700">Budget initial:</span>
                                                <div class="font-bold text-green-900">{{ number_format($bonCommande->budget_total, 0, ',', ' ') }} FCFA</div>
                                            </div>
                                            <div>
                                                <span class="font-medium text-green-700">Montant validé:</span>
                                                <div class="font-bold text-green-900">{{ number_format($bonCommande->getMontantCommandesValidees(), 0, ',', ' ') }} FCFA</div>
                                            </div>
                                            <div>
                                                <span class="font-medium text-green-700">Budget restant:</span>
                                                <div class="font-bold text-green-900">{{ number_format($bonCommande->getBudgetRestantApresValidation(), 0, ',', ' ') }} FCFA</div>
                                            </div>
                                            <div>
                                                <span class="font-medium text-green-700">Utilisation:</span>
                                                <div class="font-bold text-green-900">{{ $bonCommande->getPourcentageBudgetUtilise() }}%</div>
                                            </div>
            </div>
        </div>
    </div>
</div>

                            <form action="{{ route('bons-commande.valider', $bonCommande) }}" method="POST" class="w-full">
                @csrf
                
                <div class="mb-4">
                                    <label for="commentaires_validation" class="block text-sm font-medium text-gray-700 mb-2">
                                        Commentaires de validation (optionnel)
                                    </label>
                                    <textarea name="commentaires_validation" id="commentaires_validation" rows="3" 
                                              class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-green-500 focus:border-green-500"
                                              placeholder="Commentaires sur la validation de ce bon de commande..."></textarea>
                </div>
                
                                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir valider globalement ce bon de commande ? Cette action est irréversible.')" 
                                        class="w-full inline-flex justify-center items-center px-4 py-3 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Valider le bon de commande
                                </button>
                            </form>
                        </div>
                    </div>
                @elseif($bonCommande->commandes->count() > 0 && !$bonCommande->toutesCommandesValidees())
                    <div class="bg-white shadow rounded-lg mt-6">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                                <i class="fas fa-clock text-yellow-600 mr-2"></i>
                                En attente de validation
                            </h3>
                            
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                <div class="flex items-start">
                                    <i class="fas fa-info-circle text-yellow-600 mt-1 mr-3"></i>
                                    <div>
                                        <h4 class="font-semibold text-yellow-900 mb-2">Validation en cours</h4>
                                        <p class="text-sm text-yellow-800">
                                            Certaines commandes ne sont pas encore validées. 
                                            Vous pourrez valider le bon de commande une fois toutes les commandes livrées et validées.
                                        </p>
                                        
                                        <div class="mt-3 text-sm">
                                            <div class="flex justify-between items-center">
                                                <span class="font-medium text-yellow-700">Commandes validées:</span>
                                                <span class="font-bold text-yellow-900">{{ $bonCommande->commandes->where('statut', 'livree')->count() }}/{{ $bonCommande->commandes->count() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                @endif

                <!-- Informations de validation globale -->
                @if($bonCommande->valide_globalement)
                    <div class="bg-white shadow rounded-lg mt-6">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                                <i class="fas fa-check-circle text-green-600 mr-2"></i>
                                Validation globale effectuée
                            </h3>
                            
                            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <span class="font-medium text-green-700">Validé par:</span>
                                        <div class="font-bold text-green-900">{{ $bonCommande->validePar->nom_complet ?? 'Utilisateur' }}</div>
                                    </div>
                                    <div>
                                        <span class="font-medium text-green-700">Date de validation:</span>
                                        <div class="font-bold text-green-900">{{ $bonCommande->valide_le->format('d/m/Y à H:i') }}</div>
                                    </div>
                                    <div>
                                        <span class="font-medium text-green-700">Budget initial:</span>
                                        <div class="font-bold text-green-900">{{ number_format($bonCommande->budget_total, 0, ',', ' ') }} FCFA</div>
                                    </div>
                                    <div>
                                        <span class="font-medium text-green-700">Montant final validé:</span>
                                        <div class="font-bold text-green-900">{{ number_format($bonCommande->montant_final_valide, 0, ',', ' ') }} FCFA</div>
                                    </div>
                                    <div>
                                        <span class="font-medium text-green-700">Économies réalisées:</span>
                                        <div class="font-bold text-green-900">{{ number_format($bonCommande->budget_total - $bonCommande->montant_final_valide, 0, ',', ' ') }} FCFA</div>
                                    </div>
                                    <div>
                                        <span class="font-medium text-green-700">Taux d'utilisation:</span>
                                        <div class="font-bold text-green-900">{{ round(($bonCommande->montant_final_valide / $bonCommande->budget_total) * 100, 1) }}%</div>
                                    </div>
                </div>
                
                                @if($bonCommande->commentaires_validation)
                                    <div class="mt-4 pt-4 border-t border-green-200">
                                        <span class="font-medium text-green-700">Commentaires de validation:</span>
                                        <div class="text-green-900 mt-1">{{ $bonCommande->commentaires_validation }}</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif


                </div>
        </div>
    </div>
</div>



<!-- Modal pour créer une commande -->
<div id="modalCreerCommande" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900">Créer une commande pour {{ $bonCommande->produit_principal }}</h3>
                <button onclick="fermerModalCreerCommande()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <form action="{{ route('bons-commande.creer-commande', $bonCommande) }}" method="POST" id="formCreerCommande">
                @csrf
                
                <div class="mb-4">
                    <label for="fournisseur_id" class="block text-sm font-medium text-gray-700">Fournisseur *</label>
                    <select name="fournisseur_id" id="fournisseur_id" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                        <option value="">Sélectionner un fournisseur</option>
                        @foreach(\App\Models\Fournisseur::all() as $fournisseur)
                            <option value="{{ $fournisseur->id }}">{{ $fournisseur->nom }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-4">
                    <label for="quantite" class="block text-sm font-medium text-gray-700">Quantité à commander *</label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <input type="number" name="quantite" id="quantite" min="1" max="{{ $bonCommande->getQuantiteRestante() }}" value="{{ $bonCommande->getQuantiteRestante() }}" required
                               class="flex-1 min-w-0 block w-full px-3 py-2 rounded-md border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                        <span class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                            {{ $bonCommande->unite_produit }}
                        </span>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">Quantité restante à satisfaire: {{ $bonCommande->getQuantiteRestante() }} {{ $bonCommande->unite_produit }}</p>
                </div>
                
                <div class="mb-4">
                    <label for="cout_unitaire" class="block text-sm font-medium text-gray-700">Coût unitaire (FCFA) *</label>
                    <input type="number" name="cout_unitaire" id="cout_unitaire" min="0" step="100" value="{{ $bonCommande->cout_unitaire_estime }}" required
                           class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                
                <div class="mb-4">
                    <label for="commentaires" class="block text-sm font-medium text-gray-700">Commentaires</label>
                    <textarea name="commentaires" id="commentaires" rows="3" 
                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                              placeholder="Commentaires sur cette commande..."></textarea>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="fermerModalCreerCommande()" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Annuler
                    </button>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Créer la commande
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function ouvrirModalCreerCommande() {
    document.getElementById('modalCreerCommande').classList.remove('hidden');
}

function fermerModalCreerCommande() {
    document.getElementById('modalCreerCommande').classList.add('hidden');
}

// Fermer les modals en cliquant à l'extérieur
document.getElementById('modalCreerCommande').addEventListener('click', function(e) {
    if (e.target === this) {
        fermerModalCreerCommande();
    }
});

// Fonctions pour les paiements
function ouvrirModalPaiement(commandeId) {
    fetch(`/paiements/modal/${commandeId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const commande = data.commande;
                const html = `
                    <form onsubmit="traiterPaiement(event, ${commandeId})" class="space-y-6">
                        <!-- Informations de la commande -->
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-200">
                            <div class="flex items-center mb-4">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                                        <i class="fas fa-info-circle text-white text-sm"></i>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <h4 class="text-lg font-semibold text-gray-900">Informations de la commande</h4>
                                    <p class="text-sm text-gray-600">Détails de la commande à payer</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="bg-white rounded-lg p-4 border border-blue-100">
                                    <span class="text-sm font-medium text-gray-500">Référence</span>
                                    <div class="text-lg font-bold text-gray-900">${commande.reference}</div>
                                </div>
                                <div class="bg-white rounded-lg p-4 border border-blue-100">
                                    <span class="text-sm font-medium text-gray-500">Fournisseur</span>
                                    <div class="text-lg font-bold text-gray-900">${commande.fournisseur}</div>
                                </div>
                                <div class="bg-white rounded-lg p-4 border border-blue-100">
                                    <span class="text-sm font-medium text-gray-500">Montant total</span>
                                    <div class="text-lg font-bold text-gray-900">${new Intl.NumberFormat('fr-FR').format(commande.montant_total)} FCFA</div>
                                </div>
                                <div class="bg-white rounded-lg p-4 border border-red-100 bg-red-50">
                                    <span class="text-sm font-medium text-gray-500">Reste à payer</span>
                                    <div class="text-lg font-bold text-red-600">${new Intl.NumberFormat('fr-FR').format(commande.reste_a_payer)} FCFA</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Formulaire de paiement -->
                        <div class="space-y-6">
                            <div>
                                <label for="montant" class="block text-sm font-semibold text-gray-700 mb-3">Montant à payer</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 text-lg">₦</span>
                                    </div>
                                                                    <input type="number" id="montant" name="montant" step="0.01" min="0.01" max="${commande.montant_total}" required
                                       class="w-full pl-10 pr-12 py-4 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 text-lg font-medium"
                                       placeholder="0,00">
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <span class="text-gray-500 font-medium">FCFA</span>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mt-2 flex items-center">
                                <i class="fas fa-info-circle mr-1"></i>
                                Montant maximum: <span class="font-semibold text-blue-600">${new Intl.NumberFormat('fr-FR').format(commande.montant_total)} FCFA</span>
                                <span class="ml-2 text-xs text-gray-400">(Montant total de la commande)</span>
                            </p>
                            </div>
                            
                            <div>
                                <label for="mode_paiement" class="block text-sm font-semibold text-gray-700 mb-3">Mode de paiement</label>
                                <select id="mode_paiement" name="mode_paiement" required onchange="gererChampReference()"
                                        class="w-full px-4 py-4 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 text-lg">
                                    <option value="">Sélectionner un mode de paiement</option>
                                    <option value="especes">💵 Espèces</option>
                                    <option value="cheque">🏦 Chèque</option>
                                    <option value="virement">💳 Virement bancaire</option>
                                    <option value="carte">💳 Carte bancaire</option>
                                </select>
                            </div>
                            
                            <div id="div_reference_paiement" style="display: none;" class="transition-all duration-300">
                                <label for="reference_paiement" class="block text-sm font-semibold text-gray-700 mb-3">Référence du paiement</label>
                                <input type="text" id="reference_paiement" name="reference_paiement"
                                       class="w-full px-4 py-4 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 text-lg"
                                       placeholder="Référence du paiement">
                            </div>
                            
                            <div>
                                <label for="commentaire" class="block text-sm font-semibold text-gray-700 mb-3">Commentaire (optionnel)</label>
                                <textarea id="commentaire" name="commentaire" rows="3"
                                          class="w-full px-4 py-4 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 resize-none"
                                          placeholder="Ajouter un commentaire sur ce paiement..."></textarea>
                            </div>
                        </div>
                        
                        <!-- Actions -->
                        <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                            <button type="button" onclick="fermerModalPaiement()" 
                                    class="px-8 py-3 border-2 border-gray-300 text-gray-700 bg-white rounded-xl hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-200 font-medium">
                                <i class="fas fa-times mr-2"></i>
                                Annuler
                            </button>
                            <button type="submit" 
                                    class="px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 font-medium shadow-lg">
                                <i class="fas fa-credit-card mr-2"></i>
                                Enregistrer le paiement
                            </button>
                        </div>
                    </form>
                `;
                document.getElementById('modalPaiementForm').innerHTML = html;
                
                // Animation d'ouverture
                const modal = document.getElementById('modalPaiement');
                const content = document.getElementById('modalPaiementContent');
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modal.classList.add('bg-opacity-50');
                    content.classList.remove('scale-95', 'opacity-0');
                    content.classList.add('scale-100', 'opacity-100');
                }, 10);
            } else {
                alert(data.message);
            }
        });
}

function traiterPaiement(event, commandeId) {
    event.preventDefault();
    console.log('Traitement du paiement pour la commande:', commandeId);
    
    const form = event.target;
    const formData = new FormData(form);
    
    // Afficher les données du formulaire pour debug
    for (let [key, value] of formData.entries()) {
        console.log(key + ': ' + value);
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    console.log('CSRF Token:', csrfToken);

    fetch(`/paiements/${commandeId}`, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    })
    .then(response => {
        console.log('Response status:', response.status);
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data);
        if (data.success) {
            alert(data.message);
            fermerModalPaiement();
            location.reload(); // Recharger pour voir les mises à jour
        } else {
            alert('Erreur: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Erreur lors du traitement:', error);
        alert('Erreur lors du traitement du paiement. Vérifiez la console pour plus de détails.');
    });
}

function voirHistorique(commandeId) {
    fetch(`/paiements/historique/${commandeId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                let html = '<div class="space-y-4">';
                if (data.paiements.length > 0) {
                    data.paiements.forEach(paiement => {
                        html += `
                            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow duration-200">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <div class="flex items-center mb-3">
                                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                                <i class="fas fa-credit-card text-green-600"></i>
                                            </div>
                                            <div>
                                                <div class="text-xl font-bold text-gray-900">${new Intl.NumberFormat('fr-FR').format(paiement.montant)} FCFA</div>
                                                <div class="text-sm font-medium text-gray-600">${paiement.mode_paiement}</div>
                                            </div>
                                        </div>
                                        ${paiement.reference_paiement ? `
                                            <div class="bg-blue-50 rounded-lg p-3 mb-3">
                                                <span class="text-sm font-medium text-blue-700">Référence:</span>
                                                <div class="text-sm text-blue-900 font-semibold">${paiement.reference_paiement}</div>
                                            </div>
                                        ` : ''}
                                        ${paiement.commentaire ? `
                                            <div class="bg-gray-50 rounded-lg p-3">
                                                <span class="text-sm font-medium text-gray-700">Commentaire:</span>
                                                <div class="text-sm text-gray-900 mt-1">${paiement.commentaire}</div>
                                            </div>
                                        ` : ''}
                                    </div>
                                    <div class="text-right ml-4">
                                        <div class="bg-green-100 rounded-lg p-3">
                                            <div class="text-sm font-medium text-green-700">Date</div>
                                            <div class="text-sm text-green-900 font-semibold">${paiement.date_paiement}</div>
                                        </div>
                                        <div class="mt-2 text-sm text-gray-500">
                                            Par <span class="font-medium">${paiement.user}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                } else {
                    html += `
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-history text-gray-400 text-2xl"></i>
                            </div>
                            <h4 class="text-lg font-medium text-gray-900 mb-2">Aucun paiement enregistré</h4>
                            <p class="text-gray-500">Aucun paiement n'a été effectué pour cette commande.</p>
                        </div>
                    `;
                }
                html += '</div>';
                
                document.getElementById('modalHistoriqueForm').innerHTML = html;
                
                // Animation d'ouverture
                const modal = document.getElementById('modalHistorique');
                const content = document.getElementById('modalHistoriqueContent');
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modal.classList.add('bg-opacity-50');
                    content.classList.remove('scale-95', 'opacity-0');
                    content.classList.add('scale-100', 'opacity-100');
                }, 10);
            }
        });
}

function fermerModalPaiement() {
    const modal = document.getElementById('modalPaiement');
    const content = document.getElementById('modalPaiementContent');
    
    // Animation de fermeture
    content.classList.remove('scale-100', 'opacity-100');
    content.classList.add('scale-95', 'opacity-0');
    modal.classList.remove('bg-opacity-50');
    
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

function fermerModalHistorique() {
    const modal = document.getElementById('modalHistorique');
    const content = document.getElementById('modalHistoriqueContent');
    
    // Animation de fermeture
    content.classList.remove('scale-100', 'opacity-100');
    content.classList.add('scale-95', 'opacity-0');
    modal.classList.remove('bg-opacity-50');
    
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

function gererChampReference() {
    const modePaiement = document.getElementById('mode_paiement').value;
    const divReference = document.getElementById('div_reference_paiement');
    const inputReference = document.getElementById('reference_paiement');
    
    if (modePaiement === 'especes') {
        // Masquer le champ référence pour les espèces
        divReference.style.display = 'none';
        inputReference.value = ''; // Vider le champ
        inputReference.removeAttribute('required');
    } else {
        // Afficher le champ référence pour les autres modes
        divReference.style.display = 'block';
        
        // Adapter le placeholder selon le mode
        switch(modePaiement) {
            case 'cheque':
                inputReference.placeholder = 'Numéro de chèque';
                break;
            case 'virement':
                inputReference.placeholder = 'Référence du virement';
                break;
            case 'carte':
                inputReference.placeholder = 'Numéro de transaction';
                break;
            default:
                inputReference.placeholder = 'Référence du paiement';
        }
        
        // Rendre obligatoire pour les modes autres que espèces
        inputReference.setAttribute('required', 'required');
    }
}
</script>

<!-- Modal de paiement -->
<div id="modalPaiement" class="fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full hidden z-50 transition-opacity duration-300">
    <div class="relative top-20 mx-auto p-0 w-11/12 md:w-2/3 lg:w-1/2 max-w-2xl">
        <div class="bg-white rounded-xl shadow-2xl transform transition-all duration-300 scale-95 opacity-0" id="modalPaiementContent">
            <!-- Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200 bg-gradient-to-r from-blue-600 to-blue-700 rounded-t-xl">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <i class="fas fa-credit-card text-white text-lg"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-semibold text-white">Effectuer un paiement</h3>
                        <p class="text-blue-100 text-sm">Gestion des paiements de commande</p>
                    </div>
                </div>
                <button onclick="fermerModalPaiement()" class="text-white hover:text-blue-200 transition-colors duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Content -->
            <div class="p-6" id="modalPaiementForm">
                <!-- Le contenu sera chargé dynamiquement -->
            </div>
        </div>
    </div>
</div>

<!-- Modal historique -->
<div id="modalHistorique" class="fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full hidden z-50 transition-opacity duration-300">
    <div class="relative top-20 mx-auto p-0 w-11/12 md:w-2/3 lg:w-1/2 max-w-2xl">
        <div class="bg-white rounded-xl shadow-2xl transform transition-all duration-300 scale-95 opacity-0" id="modalHistoriqueContent">
            <!-- Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200 bg-gradient-to-r from-green-600 to-green-700 rounded-t-xl">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <i class="fas fa-history text-white text-lg"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-semibold text-white">Historique des paiements</h3>
                        <p class="text-green-100 text-sm">Suivi des transactions effectuées</p>
                    </div>
                </div>
                <button onclick="fermerModalHistorique()" class="text-white hover:text-green-200 transition-colors duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Content -->
            <div class="p-6" id="modalHistoriqueForm">
                <!-- Le contenu sera chargé dynamiquement -->
            </div>
        </div>
    </div>
</div>
@endsection 