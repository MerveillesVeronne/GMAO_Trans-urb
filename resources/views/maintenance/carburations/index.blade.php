@extends('layouts.app')
@section('title', "GMAO Trans'urb - Carburations")
@section('content')
    <header class="bg-green-900 shadow-xl mb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center gap-4">
            <div class="h-10 w-10 bg-white rounded-full flex items-center justify-center shadow">
                <i class="fas fa-gas-pump text-green-800 text-xl"></i>
            </div>
            <span class="text-2xl font-bold tracking-wide text-white">Trans'urb GMAO - Gestion des Carburations</span>
        </div>
    </header>

    <div class="max-w-7xl mx-auto">
        <!-- Actions -->
        <div class="mb-6 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <h2 class="text-xl font-semibold text-gray-900">
                    <i class="fas fa-list text-green-700 mr-2"></i>
                    Liste des Carburations
                </h2>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('maintenance.carburations.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200">
                    <i class="fas fa-plus"></i>
                    Nouvelle Carburation
                </a>
            </div>
        </div>

        <!-- Tableau des carburations -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-green-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Véhicule</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Chauffeur</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Date & Heure</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Quantité</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Coût</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">État</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-green-100">
                        @forelse($carburations as $carburation)
                            <tr class="hover:bg-green-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center">
                                            <i class="fas fa-bus text-white"></i>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-green-900">{{ $carburation->vehicule->numero }}</div>
                                            <div class="text-sm text-green-700">{{ $carburation->vehicule->immatriculation }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900">
                                    {{ $carburation->chauffeur->nom }} {{ $carburation->chauffeur->prenom }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-green-700">
                                    <div>{{ $carburation->date_carburation->format('d/m/Y') }}</div>
                                    <div class="text-xs text-gray-500">{{ $carburation->heure_carburation->format('H:i') }}</div>
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
                                    <button onclick="deleteCarburation({{ $carburation->id }})" class="text-red-500 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                    Aucune carburation enregistrée
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($carburations->hasPages())
                <div class="px-6 py-3 border-t border-gray-200">
                    {{ $carburations->links() }}
                </div>
            @endif
        </div>
    </div>

    <script>
        // Variables globales pour la suppression
        let currentDeleteId = null;

        function deleteCarburation(id) {
            currentDeleteId = id;
            document.getElementById('deleteConfirmMessage').textContent = 'Êtes-vous sûr de vouloir supprimer cette carburation ? Cette action est irréversible.';
            document.getElementById('deleteConfirmModal').classList.remove('hidden');
        }

        // Fonction pour confirmer la suppression
        function confirmDelete() {
            if (!currentDeleteId) return;

            fetch(`/maintenance/carburations/${currentDeleteId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Erreur lors de la suppression');
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Erreur lors de la suppression');
            })
            .finally(() => {
                cancelDelete();
            });
        }

        // Fonction pour annuler la suppression
        function cancelDelete() {
            currentDeleteId = null;
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
                        Êtes-vous sûr de vouloir supprimer cette carburation ? Cette action est irréversible.
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
