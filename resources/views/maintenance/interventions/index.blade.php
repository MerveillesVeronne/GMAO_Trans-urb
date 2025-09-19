@extends('layouts.app')
@section('title', "GMAO Trans'urb - Interventions")
@section('content')
    <header class="bg-green-900 shadow-xl mb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center gap-4">
            <div class="h-10 w-10 bg-white rounded-full flex items-center justify-center shadow">
                <i class="fas fa-tools text-green-800 text-xl"></i>
                    </div>
            <span class="text-2xl font-bold tracking-wide text-white">Trans'urb GMAO - Interventions</span>
        </div>
    </header>
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center border-l-4 border-green-700">
            <span class="text-green-900 font-bold text-2xl">{{ $stats['en_cours'] ?? 0 }}</span>
            <span class="text-green-800 mt-2">En Cours</span>
                    </div>
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center border-l-4 border-green-500">
            <span class="text-green-900 font-bold text-2xl">{{ $stats['terminees'] ?? 0 }}</span>
            <span class="text-green-800 mt-2">Terminées</span>
            </div>
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center border-l-4 border-green-400">
            <span class="text-green-900 font-bold text-2xl">{{ $stats['en_attente'] ?? 0 }}</span>
            <span class="text-green-800 mt-2">En Attente</span>
            </div>
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center border-l-4 border-green-300">
            <span class="text-green-900 font-bold text-2xl">{{ $stats['urgentes'] ?? 0 }}</span>
            <span class="text-green-800 mt-2">Urgentes</span>
                    </div>
                </div>
    <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-green-900">
                <i class="fas fa-list text-green-700 mr-2"></i>
                    Interventions Récentes
                </h3>
            <button onclick="openModal()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200">
                <i class="fas fa-plus"></i>
                Ajouter une intervention
            </button>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-green-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Véhicule</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Nature</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Priorité</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Statut</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Technicien</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Quantité</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                <tbody class="bg-white divide-y divide-green-100">
                    @forelse($interventions as $intervention)
                        <tr class="hover:bg-green-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center">
                                        <i class="fas fa-bus text-white"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-green-900">{{ $intervention->vehicule->numero ?? 'N/A' }}</div>
                                        <div class="text-sm text-green-700">{{ Str::limit($intervention->description, 30) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">{{ $intervention->type_intervention }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($intervention->nature_intervention)
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $intervention->nature_intervention }}
                                    </span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $priorityColors = [
                                        'Normal' => 'bg-blue-200 text-blue-900',
                                        'À prévoir' => 'bg-yellow-200 text-yellow-900',
                                        'Urgent' => 'bg-red-200 text-red-900'
                                    ];
                                    $priorityColor = $priorityColors[$intervention->priorite] ?? 'bg-gray-200 text-gray-900';
                                @endphp
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $priorityColor }}">
                                    {{ $intervention->priorite }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $statusColors = [
                                        'En Attente' => 'bg-yellow-200 text-yellow-900',
                                        'En Cours' => 'bg-blue-200 text-blue-900',
                                        'Terminee' => 'bg-green-200 text-green-900',
                                        'Annulee' => 'bg-red-200 text-red-900',
                                        'Livré' => 'bg-purple-200 text-purple-900'
                                    ];
                                    $statusColor = $statusColors[$intervention->statut] ?? 'bg-gray-200 text-gray-900';
                                @endphp
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $statusColor }}">
                                    <i class="fas fa-circle text-green-500 mr-1"></i>{{ $intervention->statut }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-700">{{ $intervention->date_debut->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900">{{ $intervention->technicien }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-700">
                                @if($intervention->quantite_pieces)
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ Str::limit($intervention->quantite_pieces, 20) }}
                                    </span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('maintenance.interventions.show', $intervention->id) }}" class="text-green-700 hover:text-green-900 mr-3">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('maintenance.interventions.edit', $intervention->id) }}" class="text-green-600 hover:text-green-900 mr-3">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="deleteIntervention({{ $intervention->id }})" class="text-red-500 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-4 text-center text-gray-500">
                                Aucune intervention enregistrée
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    <!-- Modal Ajouter une intervention -->
    <div id="interventionModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        
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
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-green-900">
                        <i class="fas fa-plus text-green-700 mr-2"></i>
                        Ajouter une nouvelle intervention
                    </h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <form id="interventionForm" class="space-y-4" action="{{ route('maintenance.interventions.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="vehicule_id" class="block text-sm font-medium text-green-900 mb-1">Véhicule</label>
                            <select id="vehicule_id" name="vehicule_id" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="">Sélectionner un véhicule</option>
                                <option value="1">BUS-001 - Mercedes Citaro</option>
                                <option value="2">BUS-002 - Iveco Daily</option>
                                <option value="3">BUS-003 - Volvo 7900</option>
                                <option value="4">BUS-004 - Scania Citywide</option>
                            </select>
                        </div>
                        <!-- Type d'intervention -->
                        <div>
                            <label for="type_intervention" class="block text-sm font-medium text-green-700 mb-2">
                                <i class="fas fa-wrench mr-2"></i>Type d'intervention
                            </label>
                            <select id="type_intervention" name="type_intervention" required class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
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
                            <label for="nature_intervention" class="block text-sm font-medium text-green-700 mb-2">
                                <i class="fas fa-cog mr-2"></i>Nature d'intervention (optionnel)
                            </label>
                            <select id="nature_intervention" name="nature_intervention" class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
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
                        <div>
                            <label for="priorite" class="block text-sm font-medium text-green-900 mb-1">Priorité</label>
                            <select id="priorite" name="priorite" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="">Sélectionner une priorité</option>
                                <option value="Normal">Normal</option>
                                <option value="À prévoir">À prévoir</option>
                                <option value="Urgent">Urgent</option>
                            </select>
                        </div>
                        <div>
                            <label for="statut" class="block text-sm font-medium text-green-900 mb-1">Statut</label>
                            <select id="statut" name="statut" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="">Sélectionner un statut</option>
                                <option value="En Attente">En Attente</option>
                                <option value="En Cours">En Cours</option>
                                <option value="Terminee">Terminée</option>
                                <option value="Annulee">Annulée</option>
                            </select>
                        </div>
                        <div>
                            <label for="date_debut" class="block text-sm font-medium text-green-900 mb-1">Date de début</label>
                            <input type="datetime-local" id="date_debut" name="date_debut" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        </div>
                        <div>
                            <label for="date_fin_prevue" class="block text-sm font-medium text-green-900 mb-1">Date de fin prévue</label>
                            <input type="datetime-local" id="date_fin_prevue" name="date_fin_prevue" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        </div>
                        <div>
                            <label for="technicien" class="block text-sm font-medium text-green-900 mb-1">Technicien *</label>
                            <select id="technicien" name="technicien" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="">Sélectionner un technicien</option>
                                @foreach($techniciens ?? [] as $technicien)
                                    <option value="{{ $technicien->nom_complet }}">{{ $technicien->nom_complet }} - {{ $technicien->fonction_technique }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    
                    <div>
                        <label for="description" class="block text-sm font-medium text-green-900 mb-1">Description</label>
                        <textarea id="description" name="description" rows="3" required 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                  placeholder="Description détaillée de l'intervention..."></textarea>
                    </div>
                    
                    <div>
                        <label for="pieces_necessaires" class="block text-sm font-medium text-green-900 mb-1">Pièces nécessaires</label>
                        <div id="piecesContainer" class="space-y-3">
                            <div class="flex space-x-3">
                                <select name="pieces_ids[]" class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                    <option value="">Sélectionner une pièce</option>
                                    @foreach($pieces as $piece)
                                        <option value="{{ $piece->id }}" data-stock="{{ $piece->quantite_stock }}">
                                            {{ $piece->designation }} - Stock: {{ $piece->quantite_stock }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="number" name="quantites[]" min="1" placeholder="Qté" 
                                       class="w-20 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <button type="button" onclick="removePiece(this)" class="px-3 py-2 text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" onclick="addPiece()" class="mt-2 px-4 py-2 text-sm text-green-600 hover:text-green-800 border border-green-300 rounded-md hover:bg-green-50">
                            <i class="fas fa-plus mr-2"></i>Ajouter une pièce
                        </button>
                    </div>

                    <!-- Champ caché pour les pièces nécessaires (format texte) -->
                    <input type="hidden" id="pieces_necessaires" name="pieces_necessaires">
                    <input type="hidden" id="quantite_pieces" name="quantite_pieces">
                    
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" onclick="closeModal()" 
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors duration-200">
                            Annuler
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors duration-200">
                            <i class="fas fa-save mr-2"></i>Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
        </div>

    <script>
        function openModal() {
            document.getElementById('interventionModal').classList.remove('hidden');
        }
        
        function closeModal() {
            document.getElementById('interventionModal').classList.add('hidden');
        }
        
        // Fermer le modal en cliquant à l'extérieur
        document.getElementById('interventionModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
        
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

        // Gestion du formulaire
        document.getElementById('interventionForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Mettre à jour les champs cachés avant l'envoi
            updateHiddenFields();
            
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
                    closeModal();
                    showSuccessModal('Succès !', data.message);
                    setTimeout(() => {
                        closeSuccessModal();
                        location.reload(); // Recharger la page pour afficher les nouvelles données
                    }, 2000);
                } else {
                    // Afficher les erreurs de validation
                    if (data.errors) {
                        let errorMessage = 'Erreurs de validation:\n';
                        Object.keys(data.errors).forEach(field => {
                            errorMessage += `- ${data.errors[field][0]}\n`;
                        });
                        showErrorModal('Erreur de validation', errorMessage);
                    } else {
                        showErrorModal('Erreur', data.message || 'Erreur lors de l\'ajout de l\'intervention');
                    }
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                showErrorModal('Erreur', 'Erreur lors de l\'ajout de l\'intervention');
            });
        });

        // Fonctions pour la gestion des pièces
        function addPiece() {
            const container = document.getElementById('piecesContainer');
            const pieceDiv = document.createElement('div');
            pieceDiv.className = 'flex space-x-3';
            pieceDiv.innerHTML = `
                <select name="pieces_ids[]" class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    <option value="">Sélectionner une pièce</option>
                    @foreach($pieces as $piece)
                        <option value="{{ $piece->id }}" data-stock="{{ $piece->quantite_stock }}">
                            {{ $piece->designation }} - Stock: {{ $piece->quantite_stock }}
                        </option>
                    @endforeach
                </select>
                <input type="number" name="quantites[]" min="1" placeholder="Qté" 
                       class="w-20 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
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

            document.getElementById('pieces_necessaires').value = piecesNecessaires.join(', ');
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

        // Variables globales pour la suppression
        let currentDeleteId = null;

        // Fonction pour supprimer une intervention
        function deleteIntervention(id) {
            currentDeleteId = id;
            document.getElementById('deleteConfirmMessage').textContent = 'Êtes-vous sûr de vouloir supprimer cette intervention ? Cette action est irréversible.';
            document.getElementById('deleteConfirmModal').classList.remove('hidden');
        }

        // Fonction pour confirmer la suppression
        function confirmDelete() {
            if (!currentDeleteId) return;

            fetch(`/maintenance/interventions/${currentDeleteId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
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
                    showErrorModal('Erreur', data.message || 'Erreur lors de la suppression');
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                showErrorModal('Erreur', 'Erreur lors de la suppression');
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
                        Êtes-vous sûr de vouloir supprimer cette intervention ? Cette action est irréversible.
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
