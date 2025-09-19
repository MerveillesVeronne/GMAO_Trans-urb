@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-green-100">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b border-green-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-bus text-3xl text-green-600"></i>
                    </div>
                    <div class="ml-4">
                        <h1 class="text-2xl font-bold text-green-900">Nouveau Véhicule</h1>
                        <p class="text-green-600">Ajouter un nouveau véhicule à la flotte</p>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('maintenance.vehicules.index') }}" class="inline-flex items-center px-4 py-2 border border-green-300 rounded-md shadow-sm text-sm font-medium text-green-700 bg-white hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Retour
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-green-600 to-green-700">
                <h2 class="text-xl font-semibold text-white">Informations du véhicule</h2>
            </div>
            
            <form id="vehiculeForm" action="{{ route('maintenance.vehicules.store') }}" method="POST" class="p-6 space-y-6">
                @csrf
                
                <!-- Numéro du véhicule -->
                <div>
                    <label for="numero" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-hashtag mr-2"></i>Numéro du véhicule
                    </label>
                    <input type="text" id="numero" name="numero" required placeholder="Ex: V001" class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>

                <!-- Immatriculation -->
                <div>
                    <label for="immatriculation" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-car mr-2"></i>Immatriculation
                    </label>
                    <input type="text" id="immatriculation" name="immatriculation" required placeholder="Ex: AB-123-CD" class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>

                <!-- Type de véhicule -->
                <div>
                    <label for="type_vehicule" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-bus mr-2"></i>Type de véhicule
                    </label>
                    <select id="type_vehicule" name="type_vehicule" required class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        <option value="">Sélectionner un type</option>
                        <option value="GRAND BUS">GRAND BUS</option>
                        <option value="PETIT BUS">PETIT BUS</option>
                        <option value="AUTRES">AUTRES</option>
                    </select>
                </div>

                <!-- Marque -->
                <div>
                    <label for="marque" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-industry mr-2"></i>Marque
                    </label>
                    <select id="marque" name="marque" required class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        <option value="">Sélectionner une marque</option>
                        <option value="GOLDEN D.">GOLDEN D.</option>
                        <option value="MERCEDES MCV">MERCEDES MCV</option>
                        <option value="TOYOTA COASTER">TOYOTA COASTER</option>
                    </select>
                </div>

                <!-- Modèle -->
                <div>
                    <label for="modele" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-tag mr-2"></i>Modèle
                    </label>
                    <input type="text" id="modele" name="modele" required placeholder="Ex: Sprinter, Citaro, etc." class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>

                <!-- Année -->
                <div>
                    <label for="annee" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-calendar-alt mr-2"></i>Année de fabrication
                    </label>
                    <input type="number" id="annee" name="annee" required min="1900" max="{{ date('Y') + 1 }}" placeholder="Ex: 2020" class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>

                <!-- Ligne -->
                <div>
                    <label for="ligne" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-route mr-2"></i>Ligne assignée (optionnel)
                    </label>
                    <input type="text" id="ligne" name="ligne" placeholder="Ex: Ligne 1, Ligne 2, etc." class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>

                <!-- Statut -->
                <div>
                    <label for="statut" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-info-circle mr-2"></i>Statut
                    </label>
                    <select id="statut" name="statut" required class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        <option value="En Service">En Service</option>
                        <option value="Au Garage">Au Garage</option>
                        <option value="En Réparation">En Réparation</option>
                        <option value="Maintenance">Maintenance</option>
                    </select>
                </div>

                <!-- Capacité -->
                <div>
                    <label for="capacite" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-users mr-2"></i>Capacité (nombre de places)
                    </label>
                    <input type="number" id="capacite" name="capacite" min="1" max="200" placeholder="Ex: 50" class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>

                <!-- Notes -->
                <div>
                    <label for="notes" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-sticky-note mr-2"></i>Notes (optionnel)
                    </label>
                    <textarea id="notes" name="notes" rows="4" placeholder="Informations supplémentaires sur le véhicule..." class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"></textarea>
                </div>

                <!-- Boutons d'action -->
                <div class="flex justify-end space-x-3 pt-6 border-t border-green-200">
                    <a href="{{ route('maintenance.vehicules.index') }}" class="inline-flex items-center px-4 py-2 border border-green-300 rounded-md shadow-sm text-sm font-medium text-green-700 bg-white hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <i class="fas fa-times mr-2"></i>
                        Annuler
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <i class="fas fa-save mr-2"></i>
                        Créer le véhicule
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de succès -->
<div id="successModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                <i class="fas fa-check text-green-600 text-xl"></i>
            </div>
            <h3 id="successTitle" class="text-lg font-medium text-gray-900 mt-4">Succès !</h3>
            <div class="mt-2 px-7 py-3">
                <p id="successMessage" class="text-sm text-gray-500"></p>
            </div>
            <div class="items-center px-4 py-3">
                <button id="closeSuccessModal" class="px-4 py-2 bg-green-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
                    OK
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal d'erreur -->
<div id="errorModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
            </div>
            <h3 id="errorTitle" class="text-lg font-medium text-gray-900 mt-4">Erreur</h3>
            <div class="mt-2 px-7 py-3">
                <p id="errorMessage" class="text-sm text-gray-500"></p>
            </div>
            <div class="items-center px-4 py-3">
                <button id="closeErrorModal" class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                    Fermer
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
                    showErrorModal('Erreur', data.message || 'Erreur lors de la création du véhicule');
                }
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            showErrorModal('Erreur', 'Erreur lors de la création du véhicule');
        });
    });

    // Validation en temps réel
    document.getElementById('annee').addEventListener('input', function() {
        const annee = parseInt(this.value);
        const currentYear = new Date().getFullYear();
        
        if (annee < 1900 || annee > currentYear + 1) {
            this.setCustomValidity(`L'année doit être comprise entre 1900 et ${currentYear + 1}`);
        } else {
            this.setCustomValidity('');
        }
    });

    document.getElementById('capacite').addEventListener('input', function() {
        const capacite = parseInt(this.value);
        
        if (capacite < 1 || capacite > 200) {
            this.setCustomValidity('La capacité doit être comprise entre 1 et 200');
        } else {
            this.setCustomValidity('');
        }
    });
</script>
@endsection
