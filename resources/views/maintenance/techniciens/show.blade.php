@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-green-100">
    <!-- Header -->
    <header class="bg-gradient-to-r from-green-600 to-green-700 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="h-10 w-10 bg-white rounded-full flex items-center justify-center shadow">
                        <i class="fas fa-user-cog text-green-800 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h1 class="text-2xl font-bold tracking-wide text-white">{{ $technicien->nom_complet }}</h1>
                        <p class="text-green-100">{{ $technicien->fonction_technique }}</p>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('maintenance.techniciens.edit', $technicien->id) }}" class="inline-flex items-center px-4 py-2 border border-white rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <i class="fas fa-edit mr-2"></i>
                        Modifier
                    </a>
                    <a href="{{ route('maintenance.techniciens.index') }}" class="inline-flex items-center px-4 py-2 border border-white rounded-md shadow-sm text-sm font-medium text-white bg-transparent hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Retour
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Statistiques du technicien -->
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-6 mb-8 mt-8">
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center border-l-4 border-green-700">
            <span class="text-green-900 font-bold text-2xl">{{ $stats['total_interventions'] ?? 0 }}</span>
            <span class="text-green-800 mt-2">Total Interventions</span>
        </div>
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center border-l-4 border-green-500">
            <span class="text-green-900 font-bold text-2xl">{{ $stats['interventions_en_cours'] ?? 0 }}</span>
            <span class="text-green-800 mt-2">En Cours</span>
        </div>
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center border-l-4 border-green-400">
            <span class="text-green-900 font-bold text-2xl">{{ $stats['interventions_terminees'] ?? 0 }}</span>
            <span class="text-green-800 mt-2">Terminées</span>
        </div>
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center border-l-4 border-green-300">
            <span class="text-green-900 font-bold text-2xl">{{ $stats['planning_en_cours'] ?? 0 }}</span>
            <span class="text-green-800 mt-2">Planning En Cours</span>
        </div>
    </div>

    <!-- Informations du technicien -->
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Informations personnelles -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-green-600 to-green-700">
                <h2 class="text-xl font-semibold text-white">
                    <i class="fas fa-user mr-2"></i>Informations personnelles
                </h2>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-green-700 mb-1">Matricule</label>
                        <p class="text-lg font-semibold text-green-900">{{ $technicien->matricule }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-green-700 mb-1">Nom complet</label>
                        <p class="text-lg font-semibold text-green-900">{{ $technicien->nom_complet }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-green-700 mb-1">Fonction</label>
                        <p class="text-lg font-semibold text-green-900">{{ $technicien->fonction_technique }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-green-700 mb-1">Niveau</label>
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                            @if($technicien->niveau_competence == 'Expert') bg-green-100 text-green-800
                            @elseif($technicien->niveau_competence == 'Intermédiaire') bg-orange-100 text-orange-800
                            @else bg-yellow-100 text-yellow-800 @endif">
                            {{ $technicien->niveau_competence }}
                        </span>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-green-700 mb-1">Statut</label>
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                            @if($technicien->statut == 'Actif') bg-green-100 text-green-800
                            @elseif($technicien->statut == 'Inactif') bg-red-100 text-red-800
                            @elseif($technicien->statut == 'En Formation') bg-blue-100 text-blue-800
                            @else bg-yellow-100 text-yellow-800 @endif">
                            {{ $technicien->statut }}
                        </span>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-green-700 mb-1">Ancienneté</label>
                        <p class="text-lg font-semibold text-green-900">{{ $technicien->anciennete }} ans</p>
                    </div>
                </div>
                
                <div class="border-t border-green-200 pt-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-green-700 mb-1">Téléphone</label>
                            <p class="text-green-900">{{ $technicien->telephone }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-green-700 mb-1">Email</label>
                            <p class="text-green-900">{{ $technicien->email ?: 'Non renseigné' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-green-700 mb-1">Atelier</label>
                            <p class="text-green-900">{{ $technicien->atelier ?: 'Non renseigné' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-green-700 mb-1">Date d'embauche</label>
                            <p class="text-green-900">{{ $technicien->date_embauche->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>

                @if($technicien->specialite)
                <div class="border-t border-green-200 pt-4">
                    <label class="block text-sm font-medium text-green-700 mb-1">Spécialité</label>
                    <p class="text-green-900">{{ $technicien->specialite }}</p>
                </div>
                @endif

                @if($technicien->competences)
                <div class="border-t border-green-200 pt-4">
                    <label class="block text-sm font-medium text-green-700 mb-1">Compétences</label>
                    <p class="text-green-900">{{ $technicien->competences }}</p>
                </div>
                @endif

                @if($technicien->formations_suivies)
                <div class="border-t border-green-200 pt-4">
                    <label class="block text-sm font-medium text-green-700 mb-1">Formations suivies</label>
                    <p class="text-green-900">{{ $technicien->formations_suivies }}</p>
                </div>
                @endif

                @if($technicien->notes)
                <div class="border-t border-green-200 pt-4">
                    <label class="block text-sm font-medium text-green-700 mb-1">Notes</label>
                    <p class="text-green-900">{{ $technicien->notes }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Interventions récentes -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-green-600 to-green-700">
                <h2 class="text-xl font-semibold text-white">
                    <i class="fas fa-tools mr-2"></i>Interventions récentes
                </h2>
            </div>
            <div class="p-6">
                @if($technicien->interventions->count() > 0)
                    <div class="space-y-4">
                        @foreach($technicien->interventions->take(5) as $intervention)
                            <div class="border border-green-200 rounded-lg p-4 hover:bg-green-50">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-green-900">{{ $intervention->vehicule->numero ?? 'N/A' }} - {{ $intervention->type_intervention }}</h3>
                                        <p class="text-sm text-green-700 mt-1">{{ Str::limit($intervention->description, 100) }}</p>
                                        <div class="flex items-center mt-2 space-x-4">
                                            <span class="text-xs text-green-600">{{ $intervention->date_debut->format('d/m/Y') }}</span>
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                                @if($intervention->statut == 'En Cours') bg-blue-100 text-blue-800
                                                @elseif($intervention->statut == 'Terminee') bg-green-100 text-green-800
                                                @elseif($intervention->statut == 'En Attente') bg-yellow-100 text-yellow-800
                                                @else bg-red-100 text-red-800 @endif">
                                                {{ $intervention->statut }}
                                            </span>
                                        </div>
                                    </div>
                                    <a href="{{ route('maintenance.interventions.show', $intervention->id) }}" class="text-green-600 hover:text-green-900">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if($technicien->interventions->count() > 5)
                        <div class="mt-4 text-center">
                            <a href="#" class="text-green-600 hover:text-green-900 text-sm">
                                Voir toutes les interventions ({{ $technicien->interventions->count() }})
                            </a>
                        </div>
                    @endif
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-tools text-gray-400 text-4xl mb-4"></i>
                        <p class="text-gray-500">Aucune intervention pour ce technicien</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Planning de maintenance -->
    @if($technicien->planningMaintenances->count() > 0)
    <div class="max-w-7xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden mb-8">
        <div class="px-6 py-4 bg-gradient-to-r from-green-600 to-green-700">
            <h2 class="text-xl font-semibold text-white">
                <i class="fas fa-calendar-alt mr-2"></i>Planning de maintenance
            </h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-green-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Véhicule</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Statut</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-green-100">
                    @foreach($technicien->planningMaintenances->take(10) as $planning)
                        <tr class="hover:bg-green-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900">
                                {{ $planning->vehicule->numero ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $planning->type_maintenance }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-700">
                                {{ $planning->date_planifiee->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                    @if($planning->statut == 'En Cours') bg-blue-100 text-blue-800
                                    @elseif($planning->statut == 'Terminee') bg-green-100 text-green-800
                                    @elseif($planning->statut == 'Planifiee') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ $planning->statut }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('maintenance.planning.show', $planning->id) }}" class="text-green-700 hover:text-green-900">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection
