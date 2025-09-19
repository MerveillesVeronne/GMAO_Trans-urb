@extends('layouts.app')
@section('title', "GMAO Trans'urb - Détails Véhicule")
@section('content')
    <header class="bg-green-900 shadow-xl mb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center gap-4">
            <div class="h-10 w-10 bg-white rounded-full flex items-center justify-center shadow">
                <i class="fas fa-bus text-green-800 text-xl"></i>
            </div>
            <span class="text-2xl font-bold tracking-wide text-white">Trans'urb GMAO - Détails Véhicule</span>
        </div>
    </header>

    <div class="max-w-7xl mx-auto">
        <!-- Bouton retour -->
        <div class="mb-6">
            <a href="{{ route('maintenance.vehicules.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>
                Retour à la liste
            </a>
        </div>

        <!-- Informations du véhicule -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-green-900">
                    <i class="fas fa-info-circle text-green-700 mr-2"></i>
                    Informations du Véhicule
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Numéro</label>
                        <p class="text-lg font-semibold text-green-900">{{ $vehicule->numero }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Immatriculation</label>
                        <p class="text-lg font-semibold text-green-900">{{ $vehicule->immatriculation }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Type de véhicule</label>
                        <p class="text-lg font-semibold text-green-900">{{ $vehicule->type_vehicule ?? 'Non spécifié' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Marque</label>
                        <p class="text-lg font-semibold text-green-900">{{ $vehicule->marque }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Modèle</label>
                        <p class="text-lg font-semibold text-green-900">{{ $vehicule->modele }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Année</label>
                        <p class="text-lg font-semibold text-green-900">{{ $vehicule->annee }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ligne assignée</label>
                        <p class="text-lg font-semibold text-green-900">{{ $vehicule->ligne ?? 'Non assigné' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                        @php
                            $statusColors = [
                                'En Service' => 'bg-green-200 text-green-900',
                                'Au Garage' => 'bg-yellow-200 text-yellow-900',
                                'En Réparation' => 'bg-red-200 text-red-900',
                                'Maintenance' => 'bg-blue-200 text-blue-900'
                            ];
                            $statusColor = $statusColors[$vehicule->statut] ?? 'bg-gray-200 text-gray-900';
                        @endphp
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full {{ $statusColor }}">
                            {{ $vehicule->statut }}
                        </span>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Capacité</label>
                        <p class="text-lg font-semibold text-green-900">{{ $vehicule->capacite ?? 'Non spécifiée' }} passagers</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kilométrage</label>
                        <p class="text-lg font-semibold text-green-900">{{ $vehicule->kilometrage ? number_format($vehicule->kilometrage, 0, ',', ' ') . ' km' : 'Non spécifié' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Interventions récentes -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-green-900">
                    <i class="fas fa-tools text-green-700 mr-2"></i>
                    Interventions Récentes
                </h3>
                <div class="flex gap-3">
                    <a href="{{ route('maintenance.vehicules.interventions.export.pdf', $vehicule->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200">
                        <i class="fas fa-file-pdf"></i>
                        Exporter interventions
                    </a>
                    <a href="{{ route('maintenance.interventions.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200">
                        <i class="fas fa-plus"></i>
                        Nouvelle intervention
                    </a>
                </div>
            </div>
            <div class="overflow-x-auto">
                @if($vehicule->interventions->count() > 0)
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-green-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Statut</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Technicien</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-green-100">
                            @foreach($vehicule->interventions->take(5) as $intervention)
                                <tr class="hover:bg-green-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ $intervention->type_intervention }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusColors = [
                                                'En Attente' => 'bg-yellow-200 text-yellow-900',
                                                'En Cours' => 'bg-blue-200 text-blue-900',
                                                'Terminee' => 'bg-green-200 text-green-900',
                                                'Annulee' => 'bg-red-200 text-red-900'
                                            ];
                                            $statusColor = $statusColors[$intervention->statut] ?? 'bg-gray-200 text-gray-900';
                                        @endphp
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $statusColor }}">
                                            {{ $intervention->statut }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-green-700">
                                        {{ $intervention->date_debut->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900">
                                        {{ $intervention->technicien }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('maintenance.interventions.show', $intervention->id) }}" class="text-green-700 hover:text-green-900 mr-3">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="p-6 text-center text-gray-500">
                        Aucune intervention enregistrée pour ce véhicule
                    </div>
                @endif
            </div>
        </div>

        <!-- Carburations récentes -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-green-900">
                    <i class="fas fa-gas-pump text-green-700 mr-2"></i>
                    Carburations Récentes
                </h3>
                <div class="flex gap-3">
                    <a href="{{ route('maintenance.carburations.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200">
                        <i class="fas fa-plus"></i>
                        Nouvelle carburation
                    </a>
                </div>
            </div>
            <div class="overflow-x-auto">
                @if($vehicule->carburations->count() > 0)
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-green-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Date & Heure</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Chauffeur</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Quantité</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Coût</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">État</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-green-100">
                            @foreach($vehicule->carburations->take(5) as $carburation)
                                <tr class="hover:bg-green-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-green-700">
                                        <div>{{ $carburation->date_carburation->format('d/m/Y') }}</div>
                                        <div class="text-xs text-gray-500">{{ $carburation->heure_carburation->format('H:i') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900">
                                        @if($carburation->chauffeur)
                                            {{ $carburation->chauffeur->nom }} {{ $carburation->chauffeur->prenom }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                            @if($carburation->type_carburation === 'Diesel') bg-blue-100 text-blue-800
                                            @elseif($carburation->type_carburation === 'Essence') bg-yellow-100 text-yellow-800
                                            @elseif($carburation->type_carburation === 'GPL') bg-purple-100 text-purple-800
                                            @else bg-green-100 text-green-800
                                            @endif">
                                            {{ $carburation->type_carburation }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900">
                                        {{ number_format($carburation->quantite_litres, 2, ',', ' ') }} L
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900 font-semibold">
                                        {{ number_format($carburation->cout_total, 0, ',', ' ') }} FCFA
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusColors = [
                                                'Planifiée' => 'bg-yellow-200 text-yellow-900',
                                                'Effectuée' => 'bg-green-200 text-green-900',
                                                'Annulée' => 'bg-red-200 text-red-900'
                                            ];
                                            $statusColor = $statusColors[$carburation->etat] ?? 'bg-gray-200 text-gray-900';
                                        @endphp
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $statusColor }}">
                                            {{ $carburation->etat }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('maintenance.carburations.show', $carburation->id) }}" class="text-green-700 hover:text-green-900 mr-3">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('maintenance.carburations.edit', $carburation->id) }}" class="text-green-600 hover:text-green-900 mr-3">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="p-6 text-center text-gray-500">
                        Aucune carburation enregistrée pour ce véhicule
                    </div>
                @endif
            </div>
        </div>

        <!-- Planning de maintenance -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-green-900">
                    <i class="fas fa-calendar-alt text-green-700 mr-2"></i>
                    Planning de Maintenance
                </h3>
                <a href="{{ route('maintenance.planning.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200">
                    <i class="fas fa-plus"></i>
                    Planifier maintenance
                </a>
            </div>
            <div class="overflow-x-auto">
                @if($vehicule->planningMaintenances->count() > 0)
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-green-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Statut</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Technicien</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-green-100">
                            @foreach($vehicule->planningMaintenances->take(5) as $planning)
                                <tr class="hover:bg-green-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ $planning->type_maintenance }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-green-700">
                                        {{ $planning->date_planifiee->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusColors = [
                                                'Planifiee' => 'bg-blue-200 text-blue-900',
                                                'En Cours' => 'bg-yellow-200 text-yellow-900',
                                                'Terminee' => 'bg-green-200 text-green-900',
                                                'Annulee' => 'bg-red-200 text-red-900'
                                            ];
                                            $statusColor = $statusColors[$planning->statut] ?? 'bg-gray-200 text-gray-900';
                                        @endphp
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $statusColor }}">
                                            {{ $planning->statut }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900">
                                        {{ $planning->technicien }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('maintenance.planning.show', $planning->id) }}" class="text-green-700 hover:text-green-900 mr-3">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="p-6 text-center text-gray-500">
                        Aucun planning de maintenance pour ce véhicule
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
