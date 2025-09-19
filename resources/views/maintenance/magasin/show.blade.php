@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-green-100">
    <!-- Header -->
    <header class="bg-gradient-to-r from-green-600 to-green-700 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="h-10 w-10 bg-white rounded-full flex items-center justify-center shadow">
                        <i class="fas fa-warehouse text-green-800 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h1 class="text-2xl font-bold tracking-wide text-white">{{ $piece->designation }}</h1>
                        <p class="text-green-100">{{ $piece->reference }}</p>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <div class="inline-flex items-center px-4 py-2 border border-white rounded-md shadow-sm text-sm font-medium text-white bg-transparent">
                        <i class="fas fa-eye mr-2"></i>
                        Lecture seule
                    </div>
                    <a href="{{ route('maintenance.magasin.index') }}" class="inline-flex items-center px-4 py-2 border border-white rounded-md shadow-sm text-sm font-medium text-white bg-transparent hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Retour
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Informations de l'article -->
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8 mt-8">
        <!-- Informations générales -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-green-600 to-green-700">
                <h2 class="text-xl font-semibold text-white">
                    <i class="fas fa-info-circle mr-2"></i>Informations générales
                </h2>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-green-700 mb-1">Référence</label>
                        <p class="text-lg font-semibold text-green-900">{{ $piece->reference }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-green-700 mb-1">Désignation</label>
                        <p class="text-lg font-semibold text-green-900">{{ $piece->designation }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-green-700 mb-1">Catégorie</label>
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                            {{ $piece->categorie }}
                        </span>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-green-700 mb-1">Marque compatible</label>
                        <p class="text-green-900">{{ $piece->marque_compatible ?: 'Non spécifiée' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-green-700 mb-1">Prix unitaire</label>
                        <p class="text-lg font-semibold text-green-900">{{ number_format($piece->prix_unitaire, 0, ',', ' ') }} FCFA</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-green-700 mb-1">Localisation</label>
                        <p class="text-green-900">{{ $piece->localisation ?: 'Non définie' }}</p>
                    </div>
                </div>
                
                @if($piece->description)
                <div class="border-t border-green-200 pt-4">
                    <label class="block text-sm font-medium text-green-700 mb-1">Description</label>
                    <p class="text-green-900">{{ $piece->description }}</p>
                </div>
                @endif

                @if($piece->specifications)
                <div class="border-t border-green-200 pt-4">
                    <label class="block text-sm font-medium text-green-700 mb-1">Spécifications</label>
                    <p class="text-green-900">{{ $piece->specifications }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Informations de stock -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-green-600 to-green-700">
                <h2 class="text-xl font-semibold text-white">
                    <i class="fas fa-boxes mr-2"></i>Informations de stock
                </h2>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-green-700 mb-1">Quantité en stock</label>
                        <p class="text-2xl font-bold text-green-900">{{ $piece->quantite_stock }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-green-700 mb-1">Seuil d'alerte</label>
                        <p class="text-lg font-semibold text-green-900">{{ $piece->seuil_alerte }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-green-700 mb-1">Statut du stock</label>
                        @if($piece->en_rupture)
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                En rupture
                            </span>
                        @elseif($piece->stock_faible)
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Stock faible
                            </span>
                        @else
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                En stock
                            </span>
                        @endif
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-green-700 mb-1">Valeur du stock</label>
                        <p class="text-lg font-semibold text-green-900">{{ number_format($piece->valeur_stock, 0, ',', ' ') }} FCFA</p>
                    </div>
                </div>
                
                <div class="border-t border-green-200 pt-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-green-700 mb-1">Fournisseur</label>
                            <p class="text-green-900">{{ $piece->fournisseur ?: 'Non spécifié' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-green-700 mb-1">N° Fournisseur</label>
                            <p class="text-green-900">{{ $piece->numero_fournisseur ?: 'Non spécifié' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Note de lecture seule -->
                <div class="border-t border-green-200 pt-4">
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex items-center">
                            <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                            <p class="text-blue-800 text-sm">
                                <strong>Lecture seule :</strong> La gestion du magasin est effectuée par le service Logistique.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
