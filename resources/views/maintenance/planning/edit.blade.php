@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-green-100">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b border-green-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-calendar-alt text-3xl text-green-600"></i>
                    </div>
                    <div class="ml-4">
                        <h1 class="text-2xl font-bold text-green-900">Modifier le Planning</h1>
                        <p class="text-green-600">Modifier les informations du planning de maintenance</p>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('maintenance.planning.index') }}" class="inline-flex items-center px-4 py-2 border border-green-300 rounded-md shadow-sm text-sm font-medium text-green-700 bg-white hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
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
                <h2 class="text-xl font-semibold text-white">Informations du planning</h2>
            </div>
            
            <form id="planningForm" action="{{ route('maintenance.planning.update', $planningMaintenance->id) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Véhicule -->
                <div>
                    <label for="vehicule_id" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-bus mr-2"></i>Véhicule concerné
                    </label>
                    <select id="vehicule_id" name="vehicule_id" required class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        <option value="">Sélectionner un véhicule</option>
                        @foreach($vehicules as $vehicule)
                            <option value="{{ $vehicule->id }}" {{ $planningMaintenance->vehicule_id == $vehicule->id ? 'selected' : '' }}>
                                {{ $vehicule->numero }} - {{ $vehicule->marque }} {{ $vehicule->modele }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Type de maintenance -->
                <div>
                    <label for="type_maintenance" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-wrench mr-2"></i>Type de maintenance
                    </label>
                    <select id="type_maintenance" name="type_maintenance" required class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        <option value="">Sélectionner le type</option>
                        <option value="Preventive" {{ $planningMaintenance->type_maintenance == 'Preventive' ? 'selected' : '' }}>Préventive</option>
                        <option value="Corrective" {{ $planningMaintenance->type_maintenance == 'Corrective' ? 'selected' : '' }}>Corrective</option>
                        <option value="Revision" {{ $planningMaintenance->type_maintenance == 'Revision' ? 'selected' : '' }}>Révision</option>
                        <option value="Inspection" {{ $planningMaintenance->type_maintenance == 'Inspection' ? 'selected' : '' }}>Inspection</option>
                        <option value="Reparation" {{ $planningMaintenance->type_maintenance == 'Reparation' ? 'selected' : '' }}>Réparation</option>
                    </select>
                </div>

                <!-- Date planifiée -->
                <div>
                    <label for="date_planifiee" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-calendar mr-2"></i>Date planifiée
                    </label>
                    <input type="date" id="date_planifiee" name="date_planifiee" required value="{{ $planningMaintenance->date_planifiee->format('Y-m-d') }}" class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>

                <!-- Heure de début -->
                <div>
                    <label for="heure_debut" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-clock mr-2"></i>Heure de début
                    </label>
                    <input type="time" id="heure_debut" name="heure_debut" required value="{{ $planningMaintenance->heure_debut }}" class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>

                <!-- Durée estimée -->
                <div>
                    <label for="duree_estimee" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-hourglass-half mr-2"></i>Durée estimée (heures)
                    </label>
                    <input type="number" id="duree_estimee" name="duree_estimee" required step="0.5" min="0.5" max="24" value="{{ $planningMaintenance->duree_estimee }}" class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>

                <!-- Priorité -->
                <div>
                    <label for="priorite" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-exclamation-triangle mr-2"></i>Priorité
                    </label>
                    <select id="priorite" name="priorite" required class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        <option value="Normale" {{ $planningMaintenance->priorite == 'Normale' ? 'selected' : '' }}>Normale</option>
                        <option value="Basse" {{ $planningMaintenance->priorite == 'Basse' ? 'selected' : '' }}>Basse</option>
                        <option value="Haute" {{ $planningMaintenance->priorite == 'Haute' ? 'selected' : '' }}>Haute</option>
                        <option value="Urgente" {{ $planningMaintenance->priorite == 'Urgente' ? 'selected' : '' }}>Urgente</option>
                    </select>
                </div>

                <!-- Technicien -->
                <div>
                    <label for="technicien" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-user-cog mr-2"></i>Technicien responsable
                    </label>
                    <input type="text" id="technicien" name="technicien" required value="{{ $planningMaintenance->technicien }}" class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>

                <!-- Atelier -->
                <div>
                    <label for="atelier" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-tools mr-2"></i>Atelier
                    </label>
                    <input type="text" id="atelier" name="atelier" required value="{{ $planningMaintenance->atelier }}" class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>

                <!-- Description des travaux -->
                <div>
                    <label for="description_travaux" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-file-alt mr-2"></i>Description des travaux
                    </label>
                    <textarea id="description_travaux" name="description_travaux" rows="4" required class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">{{ $planningMaintenance->description_travaux }}</textarea>
                </div>

                <!-- Pièces nécessaires -->
                <div>
                    <label for="pieces_necessaires" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-cogs mr-2"></i>Pièces nécessaires (optionnel)
                    </label>
                    <textarea id="pieces_necessaires" name="pieces_necessaires" rows="3" class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">{{ $planningMaintenance->pieces_necessaires }}</textarea>
                </div>

                <!-- Notes -->
                <div>
                    <label for="notes" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-sticky-note mr-2"></i>Notes (optionnel)
                    </label>
                    <textarea id="notes" name="notes" rows="3" class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">{{ $planningMaintenance->notes }}</textarea>
                </div>

                <!-- Statut -->
                <div>
                    <label for="statut" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-info-circle mr-2"></i>Statut
                    </label>
                    <select id="statut" name="statut" required class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        <option value="Planifiee" {{ $planningMaintenance->statut == 'Planifiee' ? 'selected' : '' }}>Planifiée</option>
                        <option value="En Cours" {{ $planningMaintenance->statut == 'En Cours' ? 'selected' : '' }}>En Cours</option>
                        <option value="Terminee" {{ $planningMaintenance->statut == 'Terminee' ? 'selected' : '' }}>Terminée</option>
                        <option value="Annulee" {{ $planningMaintenance->statut == 'Annulee' ? 'selected' : '' }}>Annulée</option>
                    </select>
                </div>

                <!-- Boutons d'action -->
                <div class="flex justify-end space-x-3 pt-6 border-t border-green-200">
                    <a href="{{ route('maintenance.planning.index') }}" class="inline-flex items-center px-4 py-2 border border-green-300 rounded-md shadow-sm text-sm font-medium text-green-700 bg-white hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <i class="fas fa-times mr-2"></i>
                        Annuler
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <i class="fas fa-save mr-2"></i>
                        Mettre à jour
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
                showSuccessModal('Succès !', data.message);
                setTimeout(() => {
                    closeSuccessModal();
                    window.location.href = '{{ route("maintenance.planning.index") }}';
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
                    showErrorModal('Erreur', data.message || 'Erreur lors de la mise à jour');
                }
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            showErrorModal('Erreur', 'Erreur lors de la mise à jour');
        });
    });

    // Validation en temps réel
    document.getElementById('duree_estimee').addEventListener('input', function() {
        const duree = parseFloat(this.value);
        
        if (duree < 0.5 || duree > 24) {
            this.setCustomValidity('La durée doit être comprise entre 0.5 et 24 heures');
        } else {
            this.setCustomValidity('');
        }
    });
</script>
@endsection
