@extends('layouts.app')
@section('title', "GMAO Trans'urb - Nouvelle Carburation")
@section('content')
    <header class="bg-green-900 shadow-xl mb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center gap-4">
            <div class="h-10 w-10 bg-white rounded-full flex items-center justify-center shadow">
                <i class="fas fa-gas-pump text-green-800 text-xl"></i>
            </div>
            <span class="text-2xl font-bold tracking-wide text-white">Trans'urb GMAO - Nouvelle Carburation</span>
        </div>
    </header>

    <div class="max-w-4xl mx-auto">
        <!-- Bouton retour -->
        <div class="mb-6">
            <a href="{{ route('maintenance.carburations.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>
                Retour à la liste
            </a>
        </div>

        <!-- Formulaire de création -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-green-900">
                    <i class="fas fa-plus text-green-700 mr-2"></i>
                    Créer une nouvelle carburation
                </h3>
            </div>
            <div class="p-6">
                <form id="carburationForm" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="vehicule_id" class="block text-sm font-medium text-green-900 mb-1">Véhicule *</label>
                            <select id="vehicule_id" name="vehicule_id" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="">Sélectionner un véhicule</option>
                                @foreach($vehicules as $vehicule)
                                    <option value="{{ $vehicule->id }}">{{ $vehicule->numero }} - {{ $vehicule->immatriculation }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label for="chauffeur_id" class="block text-sm font-medium text-green-900 mb-1">Chauffeur *</label>
                            <select id="chauffeur_id" name="chauffeur_id" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="">Sélectionner un chauffeur</option>
                                @foreach($chauffeurs as $chauffeur)
                                    <option value="{{ $chauffeur->id }}">{{ $chauffeur->nom }} {{ $chauffeur->prenom }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label for="date_carburation" class="block text-sm font-medium text-green-900 mb-1">Date de carburation *</label>
                            <input type="date" id="date_carburation" name="date_carburation" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   value="{{ date('Y-m-d') }}">
                        </div>
                        
                        <div>
                            <label for="heure_carburation" class="block text-sm font-medium text-green-900 mb-1">Heure de carburation *</label>
                            <input type="time" id="heure_carburation" name="heure_carburation" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   value="{{ date('H:i') }}">
                        </div>
                        
                        <div>
                            <label for="quantite_litres" class="block text-sm font-medium text-green-900 mb-1">Quantité (litres) *</label>
                            <input type="number" id="quantite_litres" name="quantite_litres" step="0.01" min="0.01" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   placeholder="50.00">
                        </div>
                        
                        <div>
                            <label for="prix_litre" class="block text-sm font-medium text-green-900 mb-1">Prix par litre (FCFA) *</label>
                            <input type="number" id="prix_litre" name="prix_litre" step="0.01" min="0.01" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   placeholder="650.00">
                        </div>
                        
                        <div>
                            <label for="type_carburation" class="block text-sm font-medium text-green-900 mb-1">Type de carburant *</label>
                            <select id="type_carburation" name="type_carburation" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="">Sélectionner un type</option>
                                <option value="Diesel">Diesel</option>
                                <option value="Essence">Essence</option>
                                <option value="GPL">GPL</option>
                                <option value="Électrique">Électrique</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="etat" class="block text-sm font-medium text-green-900 mb-1">État *</label>
                            <select id="etat" name="etat" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="">Sélectionner un état</option>
                                <option value="Planifiée">Planifiée</option>
                                <option value="Effectuée">Effectuée</option>
                                <option value="Annulée">Annulée</option>
                            </select>
                        </div>
                    </div>
                    
                    <div>
                        <label for="notes" class="block text-sm font-medium text-green-900 mb-1">Notes</label>
                        <textarea id="notes" name="notes" rows="3" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                  placeholder="Informations supplémentaires..."></textarea>
                    </div>
                    
                    <div class="flex justify-end space-x-3 pt-6">
                        <a href="{{ route('maintenance.carburations.index') }}" 
                           class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors duration-200">
                            Annuler
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors duration-200">
                            <i class="fas fa-save mr-2"></i>Créer
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
        document.getElementById('carburationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('{{ route("maintenance.carburations.store") }}', {
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
                        window.location.href = '{{ route("maintenance.carburations.index") }}';
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
                        showErrorModal('Erreur', data.message || 'Erreur lors de la création de la carburation');
                    }
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                showErrorModal('Erreur', 'Erreur lors de la création de la carburation');
            });
        });
    </script>
@endsection
