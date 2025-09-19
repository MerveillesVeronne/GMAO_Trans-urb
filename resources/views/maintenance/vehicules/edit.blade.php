@extends('layouts.app')
@section('title', "GMAO Trans'urb - Modifier Véhicule")
@section('content')
    <header class="bg-green-900 shadow-xl mb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center gap-4">
            <div class="h-10 w-10 bg-white rounded-full flex items-center justify-center shadow">
                <i class="fas fa-bus text-green-800 text-xl"></i>
            </div>
            <span class="text-2xl font-bold tracking-wide text-white">Trans'urb GMAO - Modifier Véhicule</span>
        </div>
    </header>

    <div class="max-w-4xl mx-auto">
        <!-- Bouton retour -->
        <div class="mb-6">
            <a href="{{ route('maintenance.vehicules.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>
                Retour à la liste
            </a>
        </div>

        <!-- Formulaire de modification -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-green-900">
                    <i class="fas fa-edit text-green-700 mr-2"></i>
                    Modifier le Véhicule
                </h3>
            </div>
            <div class="p-6">
                <form action="{{ route('maintenance.vehicules.update', $vehicule->id) }}" method="POST" id="editVehiculeForm">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="numero" class="block text-sm font-medium text-green-900 mb-1">Numéro du véhicule *</label>
                            <input type="text" id="numero" name="numero" value="{{ $vehicule->numero }}" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   placeholder="Ex: BUS-001">
                        </div>
                        <div>
                            <label for="immatriculation" class="block text-sm font-medium text-green-900 mb-1">Immatriculation *</label>
                            <input type="text" id="immatriculation" name="immatriculation" value="{{ $vehicule->immatriculation }}" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   placeholder="Ex: AB-123-CD">
                        </div>
                        <div>
                            <label for="type_vehicule" class="block text-sm font-medium text-green-900 mb-1">Type de véhicule *</label>
                            <select id="type_vehicule" name="type_vehicule" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="">Sélectionner un type</option>
                                <option value="GRAND BUS" {{ $vehicule->type_vehicule == 'GRAND BUS' ? 'selected' : '' }}>GRAND BUS</option>
                                <option value="PETIT BUS" {{ $vehicule->type_vehicule == 'PETIT BUS' ? 'selected' : '' }}>PETIT BUS</option>
                                <option value="AUTRES" {{ $vehicule->type_vehicule == 'AUTRES' ? 'selected' : '' }}>AUTRES</option>
                            </select>
                        </div>
                        <div>
                            <label for="marque" class="block text-sm font-medium text-green-900 mb-1">Marque *</label>
                            <select id="marque" name="marque" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="">Sélectionner une marque</option>
                                <option value="GOLDEN D." {{ $vehicule->marque == 'GOLDEN D.' ? 'selected' : '' }}>GOLDEN D.</option>
                                <option value="MERCEDES MCV" {{ $vehicule->marque == 'MERCEDES MCV' ? 'selected' : '' }}>MERCEDES MCV</option>
                                <option value="TOYOTA COASTER" {{ $vehicule->marque == 'TOYOTA COASTER' ? 'selected' : '' }}>TOYOTA COASTER</option>
                            </select>
                        </div>
                        <div>
                            <label for="modele" class="block text-sm font-medium text-green-900 mb-1">Modèle *</label>
                            <input type="text" id="modele" name="modele" value="{{ $vehicule->modele }}" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   placeholder="Ex: Citaro">
                        </div>
                        <div>
                            <label for="annee" class="block text-sm font-medium text-green-900 mb-1">Année *</label>
                            <input type="number" id="annee" name="annee" value="{{ $vehicule->annee }}" min="2000" max="2024" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   placeholder="2020">
                        </div>
                        <div>
                            <label for="ligne" class="block text-sm font-medium text-green-900 mb-1">Ligne assignée</label>
                            <input type="text" id="ligne" name="ligne" value="{{ $vehicule->ligne }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   placeholder="Ex: Ligne 12">
                        </div>
                        <div>
                            <label for="statut" class="block text-sm font-medium text-green-900 mb-1">Statut *</label>
                            <select id="statut" name="statut" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="">Sélectionner un statut</option>
                                <option value="En Service" {{ $vehicule->statut == 'En Service' ? 'selected' : '' }}>En Service</option>
                                <option value="Au Garage" {{ $vehicule->statut == 'Au Garage' ? 'selected' : '' }}>Au Garage</option>
                                <option value="En Réparation" {{ $vehicule->statut == 'En Réparation' ? 'selected' : '' }}>En Réparation</option>
                                <option value="Maintenance" {{ $vehicule->statut == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                            </select>
                        </div>
                        <div>
                            <label for="capacite" class="block text-sm font-medium text-green-900 mb-1">Capacité (passagers)</label>
                            <input type="number" id="capacite" name="capacite" value="{{ $vehicule->capacite }}" min="1" max="200" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   placeholder="80">
                        </div>
                        <div>
                            <label for="kilometrage" class="block text-sm font-medium text-green-900 mb-1">Kilométrage (km)</label>
                            <input type="number" id="kilometrage" name="kilometrage" min="0" step="1000" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   placeholder="50000" value="{{ $vehicule->kilometrage }}">
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <label for="notes" class="block text-sm font-medium text-green-900 mb-1">Notes</label>
                        <textarea id="notes" name="notes" rows="3" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                  placeholder="Informations supplémentaires...">{{ $vehicule->notes }}</textarea>
                    </div>
                    
                    <div class="flex justify-end space-x-3 pt-6">
                        <a href="{{ route('maintenance.vehicules.index') }}" 
                           class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors duration-200">
                            Annuler
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors duration-200">
                            <i class="fas fa-save mr-2"></i>Mettre à jour
                        </button>
                    </div>
                </form>
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

        // Gestion du formulaire
        document.getElementById('editVehiculeForm').addEventListener('submit', function(e) {
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
                    showSuccessModal('Succès !', data.message);
                    setTimeout(() => {
                        closeSuccessModal();
                        window.location.href = '{{ route("maintenance.vehicules.index") }}';
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
                        showErrorModal('Erreur', data.message || 'Erreur lors de la mise à jour du véhicule');
                    }
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                showErrorModal('Erreur', 'Erreur lors de la mise à jour du véhicule');
            });
        });
    </script>
@endsection
