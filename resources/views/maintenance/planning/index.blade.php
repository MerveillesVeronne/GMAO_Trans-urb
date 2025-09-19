@extends('layouts.app')
@section('title', "GMAO Trans'urb - Planning Maintenance")
@section('content')
    <header class="bg-green-900 shadow-xl mb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center gap-4">
            <div class="h-10 w-10 bg-white rounded-full flex items-center justify-center shadow">
                <i class="fas fa-calendar-alt text-green-800 text-xl"></i>
                    </div>
            <span class="text-2xl font-bold tracking-wide text-white">Trans'urb GMAO - Planning Maintenance</span>
        </div>
    </header>
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center border-l-4 border-green-700">
            <span class="text-green-900 font-bold text-2xl">28</span>
            <span class="text-green-800 mt-2">Planifiées</span>
                    </div>
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center border-l-4 border-green-500">
            <span class="text-green-900 font-bold text-2xl">5</span>
            <span class="text-green-800 mt-2">En Cours</span>
            </div>
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center border-l-4 border-green-400">
            <span class="text-green-900 font-bold text-2xl">3</span>
            <span class="text-green-800 mt-2">En Retard</span>
            </div>
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center border-l-4 border-green-300">
            <span class="text-green-900 font-bold text-2xl">156</span>
            <span class="text-green-800 mt-2">Terminées</span>
                    </div>
                </div>
    @if($planningMaintenances->count() > 0 || $carburations->count() > 0)
    <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden mb-8">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-green-900">
                <i class="fas fa-calendar text-green-700 mr-2"></i>
                    Planning des Prochaines Semaines
            </h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $semaines = [];
                    for ($i = 0; $i < 4; $i++) {
                        $date = now()->addWeeks($i);
                        $semaines[] = [
                            'debut' => $date->copy()->startOfWeek()->format('d/m'),
                            'fin' => $date->copy()->endOfWeek()->format('d/m'),
                            'semaine' => $date->format('W'),
                            'annee' => $date->format('Y')
                        ];
                    }
                @endphp
                
                @foreach($semaines as $semaine)
                <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-4 border border-green-200">
                    <h4 class="font-semibold text-green-900 mb-3">
                        Semaine {{ $semaine['semaine'] }} ({{ $semaine['debut'] }}-{{ $semaine['fin'] }})
                    </h4>
                    <div class="space-y-2">
                        @php
                            $dateDebutSemaine = \Carbon\Carbon::parse(now()->addWeeks($loop->index)->startOfWeek());
                            $dateFinSemaine = \Carbon\Carbon::parse(now()->addWeeks($loop->index)->endOfWeek());
                            
                            // Interventions de la semaine
                            $interventionsSemaine = $planningMaintenances->filter(function($planning) use ($dateDebutSemaine, $dateFinSemaine) {
                                $datePlanning = \Carbon\Carbon::parse($planning->date_planifiee);
                                return $datePlanning->between($dateDebutSemaine, $dateFinSemaine);
                            });
                            
                            // Carburations de la semaine
                            $carburationsSemaine = $carburations->filter(function($carburation) use ($dateDebutSemaine, $dateFinSemaine) {
                                $dateCarburation = \Carbon\Carbon::parse($carburation->date_carburation);
                                return $dateCarburation->between($dateDebutSemaine, $dateFinSemaine);
                            });
                        @endphp
                        
                        @if($interventionsSemaine->count() > 0 || $carburationsSemaine->count() > 0)
                            @foreach($interventionsSemaine as $planning)
                            <div class="bg-white rounded p-2 text-sm border-l-4 border-blue-500">
                                <span class="font-medium">{{ $planning->vehicule->numero ?? 'N/A' }}</span> - 
                                <span class="text-blue-600">{{ $planning->type_maintenance ?? 'Maintenance' }}</span>
                                <div class="text-xs text-gray-600">{{ \Carbon\Carbon::parse($planning->date_planifiee)->format('d/m') }}</div>
                            </div>
                            @endforeach
                            
                            @foreach($carburationsSemaine as $carburation)
                            <div class="bg-white rounded p-2 text-sm border-l-4 border-yellow-500">
                                <span class="font-medium">{{ $carburation->vehicule->numero ?? 'N/A' }}</span> - 
                                <span class="text-yellow-600">Carburation {{ $carburation->type_carburation ?? 'Diesel' }}</span>
                                <div class="text-xs text-gray-600">{{ \Carbon\Carbon::parse($carburation->date_carburation)->format('d/m') }}</div>
                            </div>
                            @endforeach
                        @else
                            <div class="text-center py-4 text-gray-500 text-sm">
                                Aucune planification
                            </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
        <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-green-900">
                    <i class="fas fa-list text-green-700 mr-2"></i>
                        Planifications
                </h3>
                <button onclick="openModal()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200">
                    <i class="fas fa-plus"></i>
                    Ajouter au planning
                </button>
            </div>
            
            <!-- Filtres et boutons d'export -->
            <div class="flex items-center justify-between">
                <!-- Filtres de tri -->
                <div class="flex items-center gap-2">
                    <label class="text-sm font-medium text-green-900">Filtrer par type :</label>
                    <select id="typeFilter" onchange="filterByType()" class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="all">Toutes les planifications</option>
                        <option value="interventions">Interventions uniquement</option>
                        <option value="carburations">Carburations uniquement</option>
                    </select>
                </div>
                
                <!-- Boutons d'export -->
                <div class="flex items-center gap-2">
                    <button onclick="exportPdf('all')" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200 text-sm">
                        <i class="fas fa-file-pdf"></i>
                        Export PDF
                    </button>
                    <button onclick="exportPdf('interventions')" class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200 text-sm">
                        <i class="fas fa-tools"></i>
                        Interventions
                    </button>
                    <button onclick="exportPdf('carburations')" class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200 text-sm">
                        <i class="fas fa-gas-pump"></i>
                        Carburations
                    </button>
                </div>
            </div>
        </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-green-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Véhicule</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Heure</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Statut/État</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Responsable</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-green-100" id="planningTableBody">
                    <!-- Interventions -->
                    @foreach($planningMaintenances as $planning)
                    <tr class="hover:bg-green-50 planning-row" data-type="intervention">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                <i class="fas fa-tools mr-1"></i>Intervention
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-10 w-10 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-bus text-white"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-green-900">{{ $planning->vehicule->numero ?? 'N/A' }}</div>
                                    <div class="text-sm text-green-700">{{ $planning->vehicule->immatriculation ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900">
                            {{ \Carbon\Carbon::parse($planning->date_planifiee)->format('d/m/Y') ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900">
                            {{ $planning->heure_debut ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $statusColors = [
                                    'Planifiee' => 'bg-yellow-200 text-yellow-900',
                                    'En Cours' => 'bg-blue-200 text-blue-900',
                                    'Terminee' => 'bg-green-200 text-green-900',
                                    'Annulee' => 'bg-red-200 text-red-900'
                                ];
                                $statusColor = $statusColors[$planning->statut ?? 'Planifiee'] ?? 'bg-gray-200 text-gray-900';
                            @endphp
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $statusColor }}">
                                {{ $planning->statut ?? 'Planifiée' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900">
                            {{ $planning->technicien ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('maintenance.planning.show', $planning->id) }}" class="text-green-700 hover:text-green-900 mr-3" title="Voir les détails">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('maintenance.planning.edit', $planning->id) }}" class="text-green-600 hover:text-green-900 mr-3" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button onclick="changeStatus({{ $planning->id }})" class="text-green-500 hover:text-green-900 mr-3" title="Changer le statut">
                                <i class="fas fa-play"></i>
                            </button>
                            <button onclick="deletePlanning({{ $planning->id }})" class="text-red-600 hover:text-red-900" title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach

                    <!-- Interventions -->
                    @foreach($interventions as $intervention)
                    <tr class="hover:bg-green-50 planning-row" data-type="intervention">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                <i class="fas fa-tools mr-1"></i>Intervention
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-10 w-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-bus text-white"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-green-900">{{ $intervention->vehicule->numero ?? 'N/A' }}</div>
                                    <div class="text-sm text-green-700">{{ $intervention->vehicule->immatriculation ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900">
                            {{ \Carbon\Carbon::parse($intervention->date_debut)->format('d/m/Y') ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900">
                            {{ \Carbon\Carbon::parse($intervention->date_debut)->format('H:i') ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $statusColors = [
                                    'En Attente' => 'bg-yellow-200 text-yellow-900',
                                    'En Cours' => 'bg-blue-200 text-blue-900',
                                    'Terminee' => 'bg-green-200 text-green-900',
                                    'Annulee' => 'bg-red-200 text-red-900',
                                    'Livré' => 'bg-green-200 text-green-900'
                                ];
                                $statusColor = $statusColors[$intervention->statut ?? 'En Attente'] ?? 'bg-gray-200 text-gray-900';
                            @endphp
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $statusColor }}">
                                {{ $intervention->statut ?? 'En Attente' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900">
                            {{ $intervention->technicien ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('maintenance.interventions.show', $intervention->id) }}" class="text-green-700 hover:text-green-900 mr-3" title="Voir les détails">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('maintenance.interventions.edit', $intervention->id) }}" class="text-green-600 hover:text-green-900 mr-3" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button onclick="changeInterventionStatus({{ $intervention->id }})" class="text-green-500 hover:text-green-900 mr-3" title="Changer le statut">
                                <i class="fas fa-play"></i>
                            </button>
                            <button onclick="deleteIntervention({{ $intervention->id }})" class="text-red-600 hover:text-red-900" title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach

                    <!-- Carburations -->
                    @foreach($carburations as $carburation)
                    <tr class="hover:bg-green-50 planning-row" data-type="carburation">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                <i class="fas fa-gas-pump mr-1"></i>Carburation
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-10 w-10 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-bus text-white"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-green-900">{{ $carburation->vehicule->numero ?? 'N/A' }}</div>
                                    <div class="text-sm text-green-700">{{ $carburation->vehicule->immatriculation ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900">
                            {{ \Carbon\Carbon::parse($carburation->date_carburation)->format('d/m/Y') ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900">
                            {{ \Carbon\Carbon::parse($carburation->heure_carburation)->format('H:i') ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $statusColors = [
                                    'Planifiée' => 'bg-yellow-200 text-yellow-900',
                                    'Effectuée' => 'bg-green-200 text-green-900',
                                    'Annulée' => 'bg-red-200 text-red-900'
                                ];
                                $statusColor = $statusColors[$carburation->etat ?? 'Planifiée'] ?? 'bg-gray-200 text-gray-900';
                            @endphp
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $statusColor }}">
                                {{ $carburation->etat ?? 'Planifiée' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900">
                            {{ ($carburation->chauffeur->nom ?? 'N/A') . ' ' . ($carburation->chauffeur->prenom ?? '') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('maintenance.carburations.show', $carburation->id) }}" class="text-green-700 hover:text-green-900 mr-3" title="Voir les détails">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('maintenance.carburations.edit', $carburation->id) }}" class="text-green-600 hover:text-green-900 mr-3" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button onclick="changeCarburationStatus({{ $carburation->id }})" class="text-green-500 hover:text-green-900 mr-3" title="Changer le statut">
                                <i class="fas fa-play"></i>
                            </button>
                            <button onclick="deleteCarburation({{ $carburation->id }})" class="text-red-600 hover:text-red-900" title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>

    <!-- Modal Ajouter au planning -->
    <div id="planningModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-10 mx-auto p-5 border w-11/12 md:w-4/5 lg:w-3/4 shadow-lg rounded-md bg-white max-h-screen overflow-y-auto">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-green-900">
                        <i class="fas fa-plus text-green-700 mr-2"></i>
                        Ajouter au planning
                    </h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <form id="planningForm" action="{{ route('maintenance.planning.store') }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <!-- Type de planning -->
                    <div>
                        <label for="type_planning" class="block text-sm font-medium text-green-900 mb-1">
                            <i class="fas fa-tasks mr-2"></i>Type de planning
                        </label>
                        <select id="type_planning" name="type_planning" required 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <option value="">Sélectionner le type de planning</option>
                            <option value="intervention">Intervention</option>
                            <option value="carburation">Carburation</option>
                        </select>
                    </div>

                    <!-- Véhicule -->
                    <div>
                        <label for="vehicule_id" class="block text-sm font-medium text-green-900 mb-1">
                            <i class="fas fa-bus mr-2"></i>Véhicule concerné
                        </label>
                        <select id="vehicule_id" name="vehicule_id" required 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <option value="">Sélectionner un véhicule</option>
                            @foreach($vehicules as $vehicule)
                                <option value="{{ $vehicule->id }}">{{ $vehicule->numero }} - {{ $vehicule->marque }} {{ $vehicule->modele }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Section Intervention -->
                    <div id="intervention-section" class="hidden space-y-4">
                        <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                            <h4 class="text-md font-semibold text-blue-800 mb-3">
                                <i class="fas fa-tools mr-2"></i>Paramètres d'intervention
                            </h4>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Type d'intervention -->
                                <div>
                                    <label for="type_intervention" class="block text-sm font-medium text-blue-700 mb-1">
                                        <i class="fas fa-wrench mr-2"></i>Type d'intervention
                                    </label>
                                    <select id="type_intervention" name="type_intervention" 
                                            class="w-full px-3 py-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Sélectionner le type</option>
                                        <option value="Maintenance">Maintenance</option>
                                        <option value="Reparation">Réparation</option>
                                        <option value="Revision">Révision</option>
                                        <option value="Urgence">Urgence</option>
                                        <option value="Inspection">Inspection</option>
                                    </select>
                                </div>

                                <!-- Nature d'intervention -->
                                <div>
                                    <label for="nature_intervention" class="block text-sm font-medium text-blue-700 mb-1">
                                        <i class="fas fa-cog mr-2"></i>Nature d'intervention (optionnel)
                                    </label>
                                    <select id="nature_intervention" name="nature_intervention" 
                                            class="w-full px-3 py-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Sélectionner la nature</option>
                                        <option value="Mecanique">Mécanique</option>
                                        <option value="Electrique">Électrique</option>
                                        <option value="Vulcanique">Vulcanique</option>
                                        <option value="Tolerie">Tôlerie</option>
                                        <option value="Peinture">Peinture</option>
                                        <option value="Carrosserie">Carrosserie</option>
                                        <option value="Chauffage">Chauffage</option>
                                        <option value="Climatisation">Climatisation</option>
                                        <option value="Freinage">Freinage</option>
                                        <option value="Suspension">Suspension</option>
                                        <option value="Transmission">Transmission</option>
                                        <option value="Autre">Autre</option>
                                    </select>
                                </div>

                                <!-- Priorité -->
                                <div>
                                    <label for="priorite_intervention" class="block text-sm font-medium text-blue-700 mb-1">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>Priorité
                                    </label>
                                    <select id="priorite_intervention" name="priorite_intervention" 
                                            class="w-full px-3 py-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        <option value="Normal">Normal</option>
                                        <option value="À prévoir">À prévoir</option>
                                        <option value="Urgent">Urgent</option>
                                    </select>
                                </div>

                                <!-- Statut -->
                                <div>
                                    <label for="statut_intervention" class="block text-sm font-medium text-blue-700 mb-1">
                                        <i class="fas fa-clock mr-2"></i>Statut
                                    </label>
                                    <select id="statut_intervention" name="statut_intervention" 
                                            class="w-full px-3 py-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        <option value="En Attente">En Attente</option>
                                        <option value="En Cours">En Cours</option>
                                        <option value="Terminee">Terminée</option>
                                        <option value="Annulee">Annulée</option>
                                        <option value="Livré">Livré</option>
                                    </select>
                                </div>

                                <!-- Date de début -->
                                <div>
                                    <label for="date_debut" class="block text-sm font-medium text-blue-700 mb-1">
                                        <i class="fas fa-calendar mr-2"></i>Date de début
                                    </label>
                                    <input type="datetime-local" id="date_debut" name="date_debut" 
                                           class="w-full px-3 py-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Date de fin prévue -->
                                <div>
                                    <label for="date_fin_prevue" class="block text-sm font-medium text-blue-700 mb-1">
                                        <i class="fas fa-calendar-check mr-2"></i>Date de fin prévue (optionnel)
                                    </label>
                                    <input type="datetime-local" id="date_fin_prevue" name="date_fin_prevue" 
                                           class="w-full px-3 py-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Technicien -->
                                <div>
                                    <label for="technicien" class="block text-sm font-medium text-blue-700 mb-1">
                                        <i class="fas fa-user-cog mr-2"></i>Technicien responsable
                                    </label>
                                    <select id="technicien" name="technicien" 
                                            class="w-full px-3 py-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Sélectionner un technicien</option>
                                        @if(isset($techniciens))
                                            @foreach($techniciens as $technicien)
                                                <option value="{{ $technicien->nom_complet }}">{{ $technicien->nom_complet }} - {{ $technicien->fonction_technique }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="mt-4">
                                <label for="description" class="block text-sm font-medium text-blue-700 mb-1">
                                    <i class="fas fa-file-alt mr-2"></i>Description de l'intervention
                                </label>
                                <textarea id="description" name="description" rows="3" 
                                          placeholder="Décrivez en détail l'intervention à effectuer..." 
                                          class="w-full px-3 py-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                            </div>

                            <!-- Pièces nécessaires -->
                            <div class="mt-4">
                                <label for="pieces_necessaires" class="block text-sm font-medium text-blue-700 mb-1">
                                    <i class="fas fa-cogs mr-2"></i>Pièces nécessaires (optionnel)
                                </label>
                                <div id="piecesContainer" class="space-y-3">
                                    <div class="flex space-x-3">
                                        <select name="pieces_ids[]" class="flex-1 px-3 py-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Sélectionner une pièce</option>
                                            @if(isset($pieces))
                                                @foreach($pieces as $piece)
                                                    <option value="{{ $piece->id }}" data-stock="{{ $piece->quantite_stock }}">
                                                        {{ $piece->designation }} - Stock: {{ $piece->quantite_stock }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <input type="number" name="quantites[]" min="1" placeholder="Qté" 
                                               class="w-20 px-3 py-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        <button type="button" onclick="removePiece(this)" class="px-3 py-2 text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <button type="button" onclick="addPiece()" class="mt-2 px-4 py-2 text-sm text-blue-600 hover:text-blue-800 border border-blue-300 rounded-md hover:bg-blue-50">
                                    <i class="fas fa-plus mr-2"></i>Ajouter une pièce
                                </button>
                            </div>

                            <!-- Champ caché pour les pièces nécessaires (format texte) -->
                            <input type="hidden" id="pieces_necessaires_text" name="pieces_necessaires_text">
                            <input type="hidden" id="quantite_pieces" name="quantite_pieces">
                        </div>
                    </div>

                    <!-- Section Carburation -->
                    <div id="carburation-section" class="hidden space-y-4">
                        <div class="bg-orange-50 p-4 rounded-lg border border-orange-200">
                            <h4 class="text-md font-semibold text-orange-800 mb-3">
                                <i class="fas fa-gas-pump mr-2"></i>Paramètres de carburation
                            </h4>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Chauffeur -->
                                <div>
                                    <label for="chauffeur_id" class="block text-sm font-medium text-orange-700 mb-1">
                                        <i class="fas fa-user mr-2"></i>Chauffeur
                                    </label>
                                    <select id="chauffeur_id" name="chauffeur_id" 
                                            class="w-full px-3 py-2 border border-orange-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                        <option value="">Sélectionner un chauffeur</option>
                                        @if(isset($chauffeurs))
                                            @foreach($chauffeurs as $chauffeur)
                                                <option value="{{ $chauffeur->id }}">{{ $chauffeur->nom }} {{ $chauffeur->prenom }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <!-- Date de carburation -->
                                <div>
                                    <label for="date_carburation" class="block text-sm font-medium text-orange-700 mb-1">
                                        <i class="fas fa-calendar mr-2"></i>Date de carburation
                                    </label>
                                    <input type="date" id="date_carburation" name="date_carburation" min="{{ date('Y-m-d') }}" 
                                           class="w-full px-3 py-2 border border-orange-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500" 
                                           value="{{ date('Y-m-d') }}">
                                </div>

                                <!-- Heure de carburation -->
                                <div>
                                    <label for="heure_carburation" class="block text-sm font-medium text-orange-700 mb-1">
                                        <i class="fas fa-clock mr-2"></i>Heure de carburation
                                    </label>
                                    <input type="time" id="heure_carburation" name="heure_carburation" 
                                           class="w-full px-3 py-2 border border-orange-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500" 
                                           value="{{ date('H:i') }}">
                                </div>

                                <!-- Quantité (litres) -->
                                <div>
                                    <label for="quantite_litres" class="block text-sm font-medium text-orange-700 mb-1">
                                        <i class="fas fa-tint mr-2"></i>Quantité (litres)
                                    </label>
                                    <input type="number" id="quantite_litres" name="quantite_litres" step="0.01" min="0.01" 
                                           placeholder="50.00" 
                                           class="w-full px-3 py-2 border border-orange-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                </div>

                                <!-- Prix par litre -->
                                <div>
                                    <label for="prix_litre" class="block text-sm font-medium text-orange-700 mb-1">
                                        <i class="fas fa-money-bill-wave mr-2"></i>Prix par litre (FCFA)
                                    </label>
                                    <input type="number" id="prix_litre" name="prix_litre" step="0.01" min="0.01" 
                                           placeholder="650.00" 
                                           class="w-full px-3 py-2 border border-orange-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                </div>

                                <!-- Type de carburant -->
                                <div>
                                    <label for="type_carburation" class="block text-sm font-medium text-orange-700 mb-1">
                                        <i class="fas fa-gas-pump mr-2"></i>Type de carburant
                                    </label>
                                    <select id="type_carburation" name="type_carburation" 
                                            class="w-full px-3 py-2 border border-orange-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                        <option value="">Sélectionner un type</option>
                                        <option value="Diesel">Diesel</option>
                                        <option value="Essence">Essence</option>
                                        <option value="GPL">GPL</option>
                                        <option value="Électrique">Électrique</option>
                                    </select>
                                </div>

                                <!-- État -->
                                <div>
                                    <label for="etat" class="block text-sm font-medium text-orange-700 mb-1">
                                        <i class="fas fa-info-circle mr-2"></i>État
                                    </label>
                                    <select id="etat" name="etat" 
                                            class="w-full px-3 py-2 border border-orange-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                        <option value="">Sélectionner un état</option>
                                        <option value="Planifiée">Planifiée</option>
                                        <option value="Effectuée">Effectuée</option>
                                        <option value="Annulée">Annulée</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Notes -->
                            <div class="mt-4">
                                <label for="notes_carburation" class="block text-sm font-medium text-orange-700 mb-1">
                                    <i class="fas fa-sticky-note mr-2"></i>Notes
                                </label>
                                <textarea id="notes_carburation" name="notes_carburation" rows="3" 
                                          placeholder="Informations supplémentaires..." 
                                          class="w-full px-3 py-2 border border-orange-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" onclick="closeModal()" 
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors duration-200">
                            Annuler
                        </button>
                        <button type="submit" id="submitButton"
                                class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors duration-200">
                            <i class="fas fa-save mr-2"></i><span id="submitText">Planifier</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('planningModal').classList.remove('hidden');
        }
        
        function closeModal() {
            document.getElementById('planningModal').classList.add('hidden');
            // Réinitialiser le formulaire
            document.getElementById('planningForm').reset();
            // Masquer toutes les sections
            document.getElementById('intervention-section').classList.add('hidden');
            document.getElementById('carburation-section').classList.add('hidden');
            document.getElementById('submitText').textContent = 'Planifier';
        }
        
        // Fermer le modal en cliquant à l'extérieur
        document.getElementById('planningModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
        
        // Gestion de l'affichage des sections selon le type de planning
        document.getElementById('type_planning').addEventListener('change', function() {
            const typePlanning = this.value;
            const interventionSection = document.getElementById('intervention-section');
            const carburationSection = document.getElementById('carburation-section');
            const submitText = document.getElementById('submitText');
            
            // Masquer toutes les sections
            interventionSection.classList.add('hidden');
            carburationSection.classList.add('hidden');
            
            // Afficher la section appropriée et mettre à jour le texte du bouton
            if (typePlanning === 'intervention') {
                interventionSection.classList.remove('hidden');
                submitText.textContent = 'Planifier l\'intervention';
            } else if (typePlanning === 'carburation') {
                carburationSection.classList.remove('hidden');
                submitText.textContent = 'Planifier la carburation';
            } else {
                submitText.textContent = 'Planifier';
            }
        });
        
        // Gestion du formulaire
        document.getElementById('planningForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showInfoModal('notificationModal', 'Succès !', data.message, function() {
                        closeModal();
                        // Recharger la page pour afficher les nouvelles données
                        window.location.reload();
                    });
                } else {
                    // Afficher les erreurs de validation
                    if (data.errors) {
                        let errorMessage = 'Erreurs de validation:\n';
                        Object.keys(data.errors).forEach(field => {
                            errorMessage += `- ${data.errors[field][0]}\n`;
                        });
                        showInfoModal('notificationModal', 'Erreur de validation', errorMessage, function() {
                            // Ne pas fermer le modal en cas d'erreur
                        });
                    } else {
                        showInfoModal('notificationModal', 'Erreur', data.message || 'Erreur lors de la planification', function() {
                            // Ne pas fermer le modal en cas d'erreur
                        });
                    }
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                showInfoModal('notificationModal', 'Erreur', 'Erreur lors de la planification', function() {
                    // Ne pas fermer le modal en cas d'erreur
                });
            });
        });

        // Validation en temps réel pour les dates de carburation
        document.getElementById('date_carburation').addEventListener('change', function() {
            const selectedDate = new Date(this.value);
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            
            if (selectedDate < today) {
                showInfoModal('notificationModal', 'Erreur de validation', 'La date de carburation ne peut pas être dans le passé', function() {
                    document.getElementById('date_carburation').value = '';
                });
            }
        });

        // Validation des dates d'intervention
        document.getElementById('date_fin_prevue').addEventListener('change', function() {
            const dateDebut = document.getElementById('date_debut').value;
            const dateFin = this.value;
            
            if (dateDebut && dateFin && dateFin < dateDebut) {
                showInfoModal('notificationModal', 'Erreur de validation', 'La date de fin ne peut pas être antérieure à la date de début', function() {
                    document.getElementById('date_fin_prevue').value = '';
                });
            }
        });

        // Fonctions pour la gestion des pièces
        function addPiece() {
            const container = document.getElementById('piecesContainer');
            const pieceDiv = document.createElement('div');
            pieceDiv.className = 'flex space-x-3';
            pieceDiv.innerHTML = `
                <select name="pieces_ids[]" class="flex-1 px-3 py-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Sélectionner une pièce</option>
                    @if(isset($pieces))
                        @foreach($pieces as $piece)
                            <option value="{{ $piece->id }}" data-stock="{{ $piece->quantite_stock }}">
                                {{ $piece->designation }} - Stock: {{ $piece->quantite_stock }}
                            </option>
                        @endforeach
                    @endif
                </select>
                <input type="number" name="quantites[]" min="1" placeholder="Qté" 
                       class="w-20 px-3 py-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <button type="button" onclick="removePiece(this)" class="px-3 py-2 text-red-600 hover:text-red-800">
                    <i class="fas fa-trash"></i>
                </button>
            `;
            container.appendChild(pieceDiv);
            updateHiddenFields();
        }

        function removePiece(button) {
            button.parentElement.remove();
            updateHiddenFields();
        }

        function updateHiddenFields() {
            const piecesSelects = document.querySelectorAll('select[name="pieces_ids[]"]');
            const quantitesInputs = document.querySelectorAll('input[name="quantites[]"]');
            const piecesNecessaires = [];
            const quantitePieces = [];

            piecesSelects.forEach((select, index) => {
                if (select.value && quantitesInputs[index] && quantitesInputs[index].value) {
                    const selectedOption = select.options[select.selectedIndex];
                    const pieceName = selectedOption.text.split(' - Stock:')[0];
                    const quantite = quantitesInputs[index].value;
                    
                    piecesNecessaires.push(pieceName);
                    quantitePieces.push(`${quantite} ${pieceName}`);
                }
            });

            document.getElementById('pieces_necessaires_text').value = piecesNecessaires.join(', ');
            document.getElementById('quantite_pieces').value = quantitePieces.join(', ');
        }

        // Mettre à jour les champs cachés quand les sélections changent
        document.addEventListener('change', function(e) {
            if (e.target.name === 'pieces_ids[]' || e.target.name === 'quantites[]') {
                updateHiddenFields();
                checkStockAvailability(e.target);
            }
        });

        // Vérifier la disponibilité du stock
        function checkStockAvailability(element) {
            if (element.name === 'pieces_ids[]') {
                const select = element;
                const quantiteInput = select.parentElement.querySelector('input[name="quantites[]"]');
                
                if (select.value && quantiteInput && quantiteInput.value) {
                    const selectedOption = select.options[select.selectedIndex];
                    const stockDisponible = parseInt(selectedOption.dataset.stock);
                    const quantiteDemandee = parseInt(quantiteInput.value);
                    
                    if (quantiteDemandee > stockDisponible) {
                        quantiteInput.style.borderColor = '#ef4444';
                        quantiteInput.title = `Stock insuffisant ! Disponible: ${stockDisponible}`;
                    } else {
                        quantiteInput.style.borderColor = '#10b981';
                        quantiteInput.title = '';
                    }
                }
            }
        }

        // Fonction de filtrage par type
        function filterByType() {
            const filterValue = document.getElementById('typeFilter').value;
            const rows = document.querySelectorAll('.planning-row');
            
            rows.forEach(row => {
                const type = row.getAttribute('data-type');
                if (filterValue === 'all' || type === filterValue) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Fonction d'export PDF
        function exportPdf(type) {
            const url = `{{ route('maintenance.planning.export.pdf') }}?type=${type}`;
            window.open(url, '_blank');
        }

        // Fonction pour changer le statut d'une intervention
        function changeStatus(id) {
            // Implémenter la logique de changement de statut
            alert('Fonctionnalité de changement de statut à implémenter pour l\'intervention ' + id);
        }

        // Fonction pour changer le statut d'une carburation
        function changeCarburationStatus(id) {
            // Implémenter la logique de changement de statut
            alert('Fonctionnalité de changement de statut à implémenter pour la carburation ' + id);
        }

        // Variables globales pour la suppression
        let currentDeleteId = null;
        let currentDeleteType = null;

        // Fonction pour supprimer une intervention
        function deleteIntervention(id) {
            currentDeleteId = id;
            currentDeleteType = 'intervention';
            document.getElementById('deleteConfirmMessage').textContent = 'Êtes-vous sûr de vouloir supprimer cette intervention ? Cette action est irréversible.';
            document.getElementById('deleteConfirmModal').classList.remove('hidden');
        }

        // Fonction pour supprimer une planification (alias pour deletePlanning)
        function deletePlanning(id) {
            currentDeleteId = id;
            currentDeleteType = 'planning';
            document.getElementById('deleteConfirmMessage').textContent = 'Êtes-vous sûr de vouloir supprimer cette planification ? Cette action est irréversible.';
            document.getElementById('deleteConfirmModal').classList.remove('hidden');
        }

        // Fonction pour supprimer une carburation
        function deleteCarburation(id) {
            currentDeleteId = id;
            currentDeleteType = 'carburation';
            document.getElementById('deleteConfirmMessage').textContent = 'Êtes-vous sûr de vouloir supprimer cette carburation ? Cette action est irréversible.';
            document.getElementById('deleteConfirmModal').classList.remove('hidden');
        }

        // Fonction pour confirmer la suppression
        function confirmDelete() {
            if (!currentDeleteId || !currentDeleteType) return;

            let url = '';
            if (currentDeleteType === 'intervention' || currentDeleteType === 'planning') {
                url = `{{ route('maintenance.interventions.index') }}/${currentDeleteId}`;
            } else if (currentDeleteType === 'carburation') {
                url = `{{ route('maintenance.carburations.index') }}/${currentDeleteId}`;
            }

            fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showInfoModal('notificationModal', 'Succès', data.message, function() {
                        window.location.reload();
                    });
                } else {
                    showInfoModal('notificationModal', 'Erreur', data.message);
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                showInfoModal('notificationModal', 'Erreur', 'Erreur lors de la suppression');
            })
            .finally(() => {
                cancelDelete();
            });
        }

        // Fonction pour annuler la suppression
        function cancelDelete() {
            currentDeleteId = null;
            currentDeleteType = null;
            document.getElementById('deleteConfirmModal').classList.add('hidden');
        }

        // Attacher l'événement au bouton de confirmation après le chargement du DOM
        document.addEventListener('DOMContentLoaded', function() {
            const confirmBtn = document.getElementById('confirmDeleteBtn');
            if (confirmBtn) {
                confirmBtn.addEventListener('click', confirmDelete);
            }
        });
    </script>

    <!-- Modal de notification -->
    <x-modal id="notificationModal" title="Notification" type="info">
        Message de notification
    </x-modal>

    <!-- Modal de confirmation de suppression -->
    <div id="deleteConfirmModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Confirmer la suppression</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500" id="deleteConfirmMessage">
                        Êtes-vous sûr de vouloir supprimer cet élément ? Cette action est irréversible.
                    </p>
                </div>
                <div class="flex justify-center space-x-3 mt-4">
                    <button id="confirmDeleteBtn" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200">
                        <i class="fas fa-trash"></i>
                        Supprimer
                    </button>
                    <button onclick="cancelDelete()" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg transition-colors duration-200">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
