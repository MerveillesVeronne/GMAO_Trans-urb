@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <!-- Header -->
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Alertes de stock</h1>
                    <p class="mt-1 text-sm text-gray-500">Gestion des alertes et notifications</p>
                </div>
                <div class="flex space-x-3">
                    <form action="{{ route('alertes.verifier') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Vérifier les alertes
                        </button>
                    </form>
                    <a href="{{ route('alertes.export') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Exporter
                    </a>
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

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total alertes</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $stats['total'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Alertes actives</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $stats['actives'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Résolues</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $stats['resolues'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Ignorées</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $stats['ignorees'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white shadow rounded-lg mb-6">
            <div class="px-4 py-5 sm:p-6">
                <form method="GET" class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <div>
                        <label for="statut" class="block text-sm font-medium text-gray-700">Statut</label>
                        <select name="statut" id="statut" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                            <option value="">Tous les statuts</option>
                            <option value="active" {{ request('statut') === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="resolue" {{ request('statut') === 'resolue' ? 'selected' : '' }}>Résolue</option>
                            <option value="ignoree" {{ request('statut') === 'ignoree' ? 'selected' : '' }}>Ignorée</option>
                        </select>
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Type d'alerte</label>
                        <select name="type" id="type" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                            <option value="">Tous les types</option>
                            <option value="seuil_bas" {{ request('type') === 'seuil_bas' ? 'selected' : '' }}>Seuil bas</option>
                            <option value="rupture" {{ request('type') === 'rupture' ? 'selected' : '' }}>Rupture</option>
                            <option value="expiration" {{ request('type') === 'expiration' ? 'selected' : '' }}>Expiration</option>
                        </select>
                    </div>

                    <div>
                        <label for="date_debut" class="block text-sm font-medium text-gray-700">Date début</label>
                        <input type="date" name="date_debut" id="date_debut" value="{{ request('date_debut') }}" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <div>
                        <label for="date_fin" class="block text-sm font-medium text-gray-700">Date fin</label>
                        <input type="date" name="date_fin" id="date_fin" value="{{ request('date_fin') }}" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <div class="sm:col-span-2 lg:col-span-4 flex justify-end space-x-3">
                        <a href="{{ route('alertes.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Réinitialiser
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Filtrer
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Actions -->
        @if($alertes->where('statut', 'active')->count() > 0)
            <div class="bg-white shadow rounded-lg mb-6">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Actions rapides</h3>
                        <form action="{{ route('alertes.resoudre-toutes') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Résoudre toutes les alertes actives
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endif

        <!-- Table -->
        <div class="bg-white shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Liste des alertes</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produit</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Message</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($alertes as $alerte)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                                <svg class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $alerte->stock->produit }}</div>
                                            <div class="text-sm text-gray-500">{{ $alerte->stock->reference_unique }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                        @if($alerte->type_alerte === 'rupture') bg-red-100 text-red-800
                                        @elseif($alerte->type_alerte === 'seuil_bas') bg-yellow-100 text-yellow-800
                                        @else bg-blue-100 text-blue-800 @endif">
                                        {{ ucfirst(str_replace('_', ' ', $alerte->type_alerte)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ $alerte->message }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                        @if($alerte->statut === 'active') bg-yellow-100 text-yellow-800
                                        @elseif($alerte->statut === 'resolue') bg-green-100 text-green-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($alerte->statut) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $alerte->date_alerte->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        @if($alerte->statut === 'active')
                                            <form action="{{ route('alertes.resoudre', $alerte) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="text-green-600 hover:text-green-900" title="Résoudre l'alerte">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('alertes.ignorer', $alerte) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="text-gray-600 hover:text-gray-900" title="Ignorer l'alerte">
                                                    <i class="fas fa-eye-slash"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('alertes.show', $alerte) }}" class="text-blue-600 hover:text-blue-900" title="Voir les détails">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                    Aucune alerte trouvée
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($alertes->hasPages())
                <div class="px-4 py-3 border-t border-gray-200">
                    {{ $alertes->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 