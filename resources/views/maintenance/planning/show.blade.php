@extends('layouts.app')
@section('title', "GMAO Trans'urb - Détails Planning Maintenance")
@section('content')
    <header class="bg-green-900 shadow-xl mb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center gap-4">
            <div class="h-10 w-10 bg-white rounded-full flex items-center justify-center shadow">
                <i class="fas fa-calendar-alt text-green-800 text-xl"></i>
            </div>
            <span class="text-2xl font-bold tracking-wide text-white">Trans'urb GMAO - Détails Planning Maintenance</span>
        </div>
    </header>

    <div class="max-w-7xl mx-auto">
        <!-- Bouton retour -->
        <div class="mb-6">
            <a href="{{ route('maintenance.planning.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>
                Retour à la liste
            </a>
        </div>

        <!-- Informations du planning -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-green-900">
                    <i class="fas fa-info-circle text-green-700 mr-2"></i>
                    Informations du Planning
                </h3>
                <div class="flex space-x-2">
                    <a href="{{ route('maintenance.planning.edit', $planningMaintenance->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200">
                        <i class="fas fa-edit"></i>
                        Modifier
                    </a>
                </div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Véhicule</label>
                        <p class="text-lg font-semibold text-green-900">{{ $planningMaintenance->vehicule->nom_complet }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Type de maintenance</label>
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                            {{ $planningMaintenance->type_maintenance }}
                        </span>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date planifiée</label>
                        <p class="text-lg font-semibold text-green-900">{{ $planningMaintenance->date_planifiee->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Heure de début</label>
                        <p class="text-lg font-semibold text-green-900">{{ $planningMaintenance->heure_debut }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Durée estimée</label>
                        <p class="text-lg font-semibold text-green-900">{{ $planningMaintenance->duree_estimee }} heures</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Priorité</label>
                        @php
                            $priorityColors = [
                                'Basse' => 'bg-gray-200 text-gray-900',
                                'Normale' => 'bg-blue-200 text-blue-900',
                                'Haute' => 'bg-orange-200 text-orange-900',
                                'Urgente' => 'bg-red-200 text-red-900'
                            ];
                            $priorityColor = $priorityColors[$planningMaintenance->priorite] ?? 'bg-gray-200 text-gray-900';
                        @endphp
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full {{ $priorityColor }}">
                            {{ $planningMaintenance->priorite }}
                        </span>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                        @php
                            $statusColors = [
                                'Planifiee' => 'bg-blue-200 text-blue-900',
                                'En Cours' => 'bg-yellow-200 text-yellow-900',
                                'Terminee' => 'bg-green-200 text-green-900',
                                'Annulee' => 'bg-red-200 text-red-900'
                            ];
                            $statusColor = $statusColors[$planningMaintenance->statut] ?? 'bg-gray-200 text-gray-900';
                        @endphp
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full {{ $statusColor }}">
                            {{ $planningMaintenance->statut }}
                        </span>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Technicien</label>
                        <p class="text-lg font-semibold text-green-900">{{ $planningMaintenance->technicien }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Atelier</label>
                        <p class="text-lg font-semibold text-green-900">{{ $planningMaintenance->atelier }}</p>
                    </div>
                    <div class="md:col-span-2 lg:col-span-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description des travaux</label>
                        <p class="text-gray-900">{{ $planningMaintenance->description_travaux }}</p>
                    </div>
                    @if($planningMaintenance->pieces_necessaires)
                        <div class="md:col-span-2 lg:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pièces nécessaires</label>
                            <p class="text-gray-900">{{ $planningMaintenance->pieces_necessaires }}</p>
                        </div>
                    @endif
                    @if($planningMaintenance->notes)
                        <div class="md:col-span-2 lg:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                            <p class="text-gray-900">{{ $planningMaintenance->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-green-900">
                    <i class="fas fa-cogs text-green-700 mr-2"></i>
                    Actions Rapides
                </h3>
            </div>
            <div class="p-6">
                <div class="flex flex-wrap gap-4">
                    @if($planningMaintenance->statut == 'Planifiee')
                        <button onclick="changeStatus('En Cours')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200">
                            <i class="fas fa-play"></i>
                            Démarrer la maintenance
                        </button>
                    @endif
                    
                    @if($planningMaintenance->statut == 'En Cours')
                        <button onclick="changeStatus('Terminee')" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200">
                            <i class="fas fa-check"></i>
                            Terminer la maintenance
                        </button>
                    @endif
                    
                    @if(in_array($planningMaintenance->statut, ['Planifiee', 'En Cours']))
                        <button onclick="changeStatus('Annulee')" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200">
                            <i class="fas fa-times"></i>
                            Annuler la maintenance
                        </button>
                    @endif
                    
                    <a href="{{ route('maintenance.interventions.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200">
                        <i class="fas fa-tools"></i>
                        Créer une intervention
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de notification de succès -->
    <div id="successModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                    <i class="fas fa-check text-green-600 text-xl"></i>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4" id="successTitle">Succès !</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500" id="successMessage"></p>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="closeSuccessModal" class="px-4 py-2 bg-green-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de notification d'erreur -->
    <div id="errorModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                    <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4" id="errorTitle">Erreur !</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500" id="errorMessage"></p>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="closeErrorModal" class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fonctions pour les modals de notification
        function showSuccessModal(title, message) {
            document.getElementById('successTitle').textContent = title;
            document.getElementById('successMessage').textContent = message;
            document.getElementById('successModal').classList.remove('hidden');
        }

        function showErrorModal(title, message) {
            document.getElementById('errorTitle').textContent = title;
            document.getElementById('errorMessage').textContent = message;
            document.getElementById('errorModal').classList.remove('hidden');
        }

        function closeSuccessModal() {
            document.getElementById('successModal').classList.add('hidden');
        }

        function closeErrorModal() {
            document.getElementById('errorModal').classList.add('hidden');
        }

        // Event listeners pour les modals de notification
        document.getElementById('closeSuccessModal').addEventListener('click', closeSuccessModal);
        document.getElementById('closeErrorModal').addEventListener('click', closeErrorModal);

        // Fermer les modals en cliquant à l'extérieur
        document.getElementById('successModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeSuccessModal();
            }
        });

        document.getElementById('errorModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeErrorModal();
            }
        });

        // Fonction pour changer le statut
        function changeStatus(newStatus) {
            if (confirm(`Êtes-vous sûr de vouloir changer le statut à "${newStatus}" ?`)) {
                fetch(`{{ route('maintenance.planning.status', $planningMaintenance->id) }}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        statut: newStatus
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showSuccessModal('Succès !', data.message);
                        setTimeout(() => {
                            closeSuccessModal();
                            location.reload();
                        }, 2000);
                    } else {
                        showErrorModal('Erreur', data.message || 'Erreur lors du changement de statut');
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    showErrorModal('Erreur', 'Erreur lors du changement de statut');
                });
            }
        }
    </script>
@endsection
