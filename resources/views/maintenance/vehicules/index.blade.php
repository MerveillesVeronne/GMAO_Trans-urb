@extends('layouts.app')
@section('title', "GMAO Trans'urb - Véhicules")
@section('content')
    <header class="bg-green-900 shadow-xl mb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center gap-4">
            <div class="h-10 w-10 bg-white rounded-full flex items-center justify-center shadow">
                <i class="fas fa-bus text-green-800 text-xl"></i>
                    </div>
            <span class="text-2xl font-bold tracking-wide text-white">Trans'urb GMAO - Véhicules</span>
        </div>
    </header>
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center border-l-4 border-green-700">
            <span class="text-green-900 font-bold text-2xl">{{ $stats['en_service'] ?? 0 }}</span>
            <span class="text-green-800 mt-2">En Service</span>
        </div>
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center border-l-4 border-green-500">
            <span class="text-green-900 font-bold text-2xl">{{ $stats['au_garage'] ?? 0 }}</span>
            <span class="text-green-800 mt-2">Au Garage</span>
        </div>
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center border-l-4 border-green-400">
            <span class="text-green-900 font-bold text-2xl">{{ $stats['en_reparation'] ?? 0 }}</span>
            <span class="text-green-800 mt-2">En Réparation</span>
        </div>
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center border-l-4 border-green-300">
            <span class="text-green-900 font-bold text-2xl">{{ $stats['maintenance'] ?? 0 }}</span>
            <span class="text-green-800 mt-2">Maintenance</span>
        </div>
    </div>
    <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-green-900">
                <i class="fas fa-list text-green-700 mr-2"></i>
                    Inventaire des Véhicules
                </h3>
            <div class="flex gap-3">
                <a href="{{ route('maintenance.vehicules.export.pdf') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200">
                    <i class="fas fa-file-pdf"></i>
                    Exporter PDF
                </a>
                @if(!isset($isLogistique) || !$isLogistique)
                <button onclick="openModal()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200">
                    <i class="fas fa-plus"></i>
                    Ajouter un véhicule
                </button>
                @endif
            </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-green-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Véhicule</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Type/Marque</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Ligne</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Statut</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Kilométrage</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Dernière Intervention</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                <tbody class="bg-white divide-y divide-green-100">
                    @forelse($vehicules as $vehicule)
                        <tr class="hover:bg-green-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center">
                                        <i class="fas fa-bus text-white"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-green-900">{{ $vehicule->numero }}</div>
                                        <div class="text-sm text-green-700">Immat: {{ $vehicule->immatriculation }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="space-y-1">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">{{ $vehicule->type_vehicule ?? 'Non spécifié' }}</span>
                                    <br>
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">{{ $vehicule->marque }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900">{{ $vehicule->ligne ?? 'Non assigné' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $statusColors = [
                                        'En Service' => 'bg-green-200 text-green-900',
                                        'Au Garage' => 'bg-yellow-200 text-yellow-900',
                                        'En Réparation' => 'bg-red-200 text-red-900',
                                        'Maintenance' => 'bg-blue-200 text-blue-900'
                                    ];
                                    $statusColor = $statusColors[$vehicule->statut] ?? 'bg-gray-200 text-gray-900';
                                @endphp
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $statusColor }}">
                                    <i class="fas fa-circle text-green-500 mr-1"></i>{{ $vehicule->statut }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-700">
                                @if($vehicule->kilometrage)
                                    {{ number_format($vehicule->kilometrage, 0, ',', ' ') }} km
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-700">{{ $vehicule->updated_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('maintenance.vehicules.show', $vehicule->id) }}" class="text-green-700 hover:text-green-900 mr-3">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if(!isset($isLogistique) || !$isLogistique)
                                <a href="{{ route('maintenance.vehicules.edit', $vehicule->id) }}" class="text-green-600 hover:text-green-900 mr-3">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="deleteVehicule({{ $vehicule->id }})" class="text-red-500 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                Aucun véhicule enregistré
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
                                    </div>
                                </div>

    @if(!isset($isLogistique) || !$isLogistique)
    <!-- Modal Ajouter un véhicule -->
    <div id="vehiculeModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        
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
                        Ajouter un nouveau véhicule
                    </h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                                </button>
                </div>
                
                <form id="vehiculeForm" class="space-y-4" action="{{ route('maintenance.vehicules.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="numero" class="block text-sm font-medium text-green-900 mb-1">Numéro du véhicule</label>
                            <input type="text" id="numero" name="numero" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   placeholder="Ex: BUS-001">
                        </div>
                        <div>
                            <label for="immatriculation" class="block text-sm font-medium text-green-900 mb-1">Immatriculation</label>
                            <input type="text" id="immatriculation" name="immatriculation" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   placeholder="Ex: AB-123-CD">
                        </div>
                        <div>
                            <label for="type_vehicule" class="block text-sm font-medium text-green-900 mb-1">Type de véhicule</label>
                            <select id="type_vehicule" name="type_vehicule" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="">Sélectionner un type</option>
                                <option value="GRAND BUS">GRAND BUS</option>
                                <option value="PETIT BUS">PETIT BUS</option>
                                <option value="AUTRES">AUTRES</option>
                            </select>
                        </div>
                        <div>
                            <label for="marque" class="block text-sm font-medium text-green-900 mb-1">Marque</label>
                            <select id="marque" name="marque" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="">Sélectionner une marque</option>
                                <option value="GOLDEN D.">GOLDEN D.</option>
                                <option value="MERCEDES MCV">MERCEDES MCV</option>
                                <option value="TOYOTA COASTER">TOYOTA COASTER</option>
                            </select>
                        </div>
                        <div>
                            <label for="modele" class="block text-sm font-medium text-green-900 mb-1">Modèle</label>
                            <input type="text" id="modele" name="modele" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   placeholder="Ex: Citaro">
                        </div>
                        <div>
                            <label for="annee" class="block text-sm font-medium text-green-900 mb-1">Année</label>
                            <input type="number" id="annee" name="annee" min="2000" max="2024" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   placeholder="2020">
                        </div>
                        <div>
                            <label for="affectation" class="block text-sm font-medium text-green-900 mb-1">Type d'affectation</label>
                            <select id="affectation" name="affectation" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                    onchange="toggleEntiteLocation()">
                                <option value="">Sélectionner une affectation</option>
                                <option value="Location">Location</option>
                                <option value="Urbain">Urbain</option>
                                <option value="Inter-urbain">Inter-urbain</option>
                            </select>
                        </div>
                        <div id="entite_location_div" style="display: none;">
                            <label for="entite_location" class="block text-sm font-medium text-green-900 mb-1">Entité de location</label>
                            <input type="text" id="entite_location" name="entite_location" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   placeholder="Ex: CNSS, ANINF, etc.">
                        </div>
                        <div>
                            <label for="ligne_transport_id" class="block text-sm font-medium text-green-900 mb-1">Ligne de transport</label>
                            <div class="flex space-x-2">
                                <select id="ligne_transport_id" name="ligne_transport_id" 
                                        class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                    <option value="">Sélectionner une ligne</option>
                                </select>
                                <button type="button" onclick="openLigneModal()" 
                                        class="px-3 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-200">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <div>
                            <label for="statut" class="block text-sm font-medium text-green-900 mb-1">Statut</label>
                            <select id="statut" name="statut" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="">Sélectionner un statut</option>
                                <option value="En Service">En Service</option>
                                <option value="Au Garage">Au Garage</option>
                                <option value="En Réparation">En Réparation</option>
                                <option value="Maintenance">Maintenance</option>
                            </select>
                                    </div>
                        <div>
                            <label for="capacite" class="block text-sm font-medium text-green-900 mb-1">Capacité (passagers)</label>
                            <input type="number" id="capacite" name="capacite" min="1" max="200" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   placeholder="80">
                        </div>
                        <div>
                            <label for="kilometrage" class="block text-sm font-medium text-green-900 mb-1">Kilométrage (km)</label>
                            <input type="number" id="kilometrage" name="kilometrage" min="0" step="1000" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   placeholder="50000">
                        </div>
                    </div>
                    

                    
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

        <!-- Modal pour créer une ligne de transport -->
        <div id="ligneModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <div class="mt-3">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900">
                            <i class="fas fa-plus text-blue-700 mr-2"></i>
                            Créer une nouvelle ligne
                        </h3>
                        <button onclick="closeLigneModal()" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    
                    <form id="ligneForm" class="space-y-4">
                        @csrf
                        <div>
                            <label for="nom_ligne" class="block text-sm font-medium text-gray-900 mb-1">Nom de la ligne</label>
                            <input type="text" id="nom_ligne" name="nom" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="Ex: Rio-Charbonnage, Libreville-Ntoum">
                        </div>
                        <div>
                            <label for="type_affectation_ligne" class="block text-sm font-medium text-gray-900 mb-1">Type d'affectation</label>
                            <select id="type_affectation_ligne" name="type_affectation" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Sélectionner un type</option>
                                <option value="Location">Location</option>
                                <option value="Urbain">Urbain</option>
                                <option value="Inter-urbain">Inter-urbain</option>
                            </select>
                        </div>

                        
                        <div class="flex justify-end space-x-3 pt-4">
                            <button type="button" onclick="closeLigneModal()" 
                                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors duration-200">
                                Annuler
                            </button>
                            <button type="submit" 
                                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-200">
                                <i class="fas fa-save mr-2"></i>Créer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <script>
        function openModal() {
            document.getElementById('vehiculeModal').classList.remove('hidden');
        }
        
        function closeModal() {
            document.getElementById('vehiculeModal').classList.add('hidden');
        }
        
        // Fermer le modal en cliquant à l'extérieur
        document.getElementById('vehiculeModal').addEventListener('click', function(e) {
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
        document.getElementById('vehiculeForm').addEventListener('submit', function(e) {
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
                        showErrorModal('Erreur', data.message || 'Erreur lors de l\'ajout du véhicule');
                    }
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                showErrorModal('Erreur', 'Erreur lors de l\'ajout du véhicule');
            });
        });

        // Fonction pour supprimer un véhicule
        function deleteVehicule(id) {
            if (confirm('Êtes-vous sûr de vouloir supprimer ce véhicule ?')) {
                fetch(`/maintenance/vehicules/${id}`, {
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
                });
            }
        }

        // Fonctions pour le modal des lignes de transport
        function openLigneModal() {
            document.getElementById('ligneModal').classList.remove('hidden');
        }
        
        function closeLigneModal() {
            document.getElementById('ligneModal').classList.add('hidden');
            document.getElementById('ligneForm').reset();
        }
        
        // Fermer le modal des lignes en cliquant à l'extérieur
        document.getElementById('ligneModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeLigneModal();
            }
        });

        // Gestion du formulaire de ligne de transport
        document.getElementById('ligneForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('{{ route("maintenance.lignes-transport.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    closeLigneModal();
                    showSuccessModal('Succès !', data.message);
                    // Recharger les lignes dans le select
                    loadLignesTransport();
                    setTimeout(() => {
                        closeSuccessModal();
                    }, 2000);
                } else {
                    if (data.errors) {
                        let errorMessage = 'Erreurs de validation:\n';
                        Object.keys(data.errors).forEach(field => {
                            errorMessage += `- ${data.errors[field][0]}\n`;
                        });
                        showErrorModal('Erreur de validation', errorMessage);
                    } else {
                        showErrorModal('Erreur', data.message || 'Erreur lors de la création de la ligne');
                    }
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                showErrorModal('Erreur', 'Erreur lors de la création de la ligne');
            });
        });

        // Fonction pour charger les lignes de transport
        function loadLignesTransport() {
            fetch('{{ route("maintenance.lignes-transport.select") }}')
            .then(response => response.json())
            .then(lignes => {
                const select = document.getElementById('ligne_transport_id');
                select.innerHTML = '<option value="">Sélectionner une ligne</option>';
                
                lignes.forEach(ligne => {
                    const option = document.createElement('option');
                    option.value = ligne.id;
                    option.textContent = `${ligne.nom} (${ligne.type_affectation})`;
                    select.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Erreur lors du chargement des lignes:', error);
            });
        }

        // Fonction pour afficher/masquer le champ entité de location
        function toggleEntiteLocation() {
            const affectation = document.getElementById('affectation').value;
            const entiteDiv = document.getElementById('entite_location_div');
            
            if (affectation === 'Location') {
                entiteDiv.style.display = 'block';
                document.getElementById('entite_location').required = true;
            } else {
                entiteDiv.style.display = 'none';
                document.getElementById('entite_location').required = false;
                document.getElementById('entite_location').value = '';
            }
        }

        // Charger les lignes au chargement de la page
        document.addEventListener('DOMContentLoaded', function() {
            loadLignesTransport();
        });
    </script>
    @endif
@endsection
