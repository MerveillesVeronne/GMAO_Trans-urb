@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-green-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-3xl font-bold text-white">Créer un Bon de Commande</h1>
                    <p class="text-green-100 mt-1">Générer un bon de commande pour une intervention</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('maintenance.bons-commande.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>Retour
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <form id="bonCommandeForm" class="space-y-6">
                @csrf
                
                <!-- Sélection de l'intervention -->
                <div>
                    <label for="intervention_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Intervention *
                    </label>
                    <select id="intervention_id" name="intervention_id" required 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                        <option value="">Sélectionner une intervention</option>
                        @foreach($interventions as $intervention)
                            <option value="{{ $intervention->id }}" 
                                    {{ request('intervention_id') == $intervention->id ? 'selected' : '' }}>
                                Intervention #{{ $intervention->id }} - {{ $intervention->vehicule->nom_complet }} 
                                ({{ $intervention->type_intervention }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Informations de l'intervention (remplies automatiquement) -->
                <div id="interventionDetails" class="hidden bg-gray-50 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Détails de l'intervention</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Véhicule</label>
                            <p id="vehiculeInfo" class="text-sm text-gray-900"></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Type d'intervention</label>
                            <p id="typeIntervention" class="text-sm text-gray-900"></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Technicien</label>
                            <p id="technicien" class="text-sm text-gray-900"></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Priorité</label>
                            <p id="priorite" class="text-sm text-gray-900"></p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-500">Description</label>
                            <p id="description" class="text-sm text-gray-900"></p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-500">Pièces nécessaires</label>
                            <p id="piecesNecessaires" class="text-sm text-gray-900"></p>
                        </div>
                    </div>
                </div>

                <!-- Date de besoin -->
                <div>
                    <label for="date_besoin" class="block text-sm font-medium text-gray-700 mb-2">
                        Date de besoin
                    </label>
                    <input type="datetime-local" id="date_besoin" name="date_besoin" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500"
                           value="{{ now()->format('Y-m-d\TH:i') }}">
                </div>

                <!-- Boutons d'action -->
                <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                    <button type="button" onclick="window.location.href='{{ route('maintenance.bons-commande.index') }}'"
                            class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Annuler
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <i class="fas fa-save mr-2"></i>Créer le bon de commande
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modals de notification -->
<div id="successModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg p-6 max-w-sm w-full mx-4">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-500 text-2xl"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-lg font-medium text-gray-900">Succès</h3>
                    <p id="successMessage" class="text-sm text-gray-500"></p>
                </div>
            </div>
            <div class="mt-4">
                <button onclick="closeSuccessModal()" class="w-full bg-green-600 text-white rounded-lg px-4 py-2 hover:bg-green-700">
                    Fermer
                </button>
            </div>
        </div>
    </div>
</div>

<div id="errorModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg p-6 max-w-sm w-full mx-4">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-500 text-2xl"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-lg font-medium text-gray-900">Erreur</h3>
                    <p id="errorMessage" class="text-sm text-gray-500"></p>
                </div>
            </div>
            <div class="mt-4">
                <button onclick="closeErrorModal()" class="w-full bg-red-600 text-white rounded-lg px-4 py-2 hover:bg-red-700">
                    Fermer
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Données des interventions pour l'affichage dynamique
const interventions = @json($interventions);

document.getElementById('intervention_id').addEventListener('change', function() {
    const interventionId = this.value;
    const detailsDiv = document.getElementById('interventionDetails');
    
    if (interventionId) {
        const intervention = interventions.find(i => i.id == interventionId);
        if (intervention) {
            // Remplir les détails
            document.getElementById('vehiculeInfo').textContent = intervention.vehicule.nom_complet;
            document.getElementById('typeIntervention').textContent = intervention.type_intervention;
            document.getElementById('technicien').textContent = intervention.technicien;
            document.getElementById('priorite').textContent = intervention.priorite;
            document.getElementById('description').textContent = intervention.description || 'Aucune description';
            document.getElementById('piecesNecessaires').textContent = intervention.pieces_necessaires || 'Aucune pièce spécifiée';
            
            detailsDiv.classList.remove('hidden');
        }
    } else {
        detailsDiv.classList.add('hidden');
    }
});

document.getElementById('bonCommandeForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch('{{ route("maintenance.bons-commande.store") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(Object.fromEntries(formData))
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showSuccessModal(data.message);
            setTimeout(() => {
                window.location.href = '{{ route("maintenance.bons-commande.index") }}';
            }, 1500);
        } else {
            if (data.errors) {
                const errorMessages = Object.values(data.errors).flat().join(', ');
                showErrorModal(errorMessages);
            } else {
                showErrorModal(data.message);
            }
        }
    })
    .catch(error => {
        showErrorModal('Erreur lors de la création du bon de commande');
    });
});

function showSuccessModal(message) {
    document.getElementById('successMessage').textContent = message;
    document.getElementById('successModal').classList.remove('hidden');
}

function showErrorModal(message) {
    document.getElementById('errorMessage').textContent = message;
    document.getElementById('errorModal').classList.remove('hidden');
}

function closeSuccessModal() {
    document.getElementById('successModal').classList.add('hidden');
}

function closeErrorModal() {
    document.getElementById('errorModal').classList.add('hidden');
}

// Déclencher l'événement change si une intervention est présélectionnée
if (document.getElementById('intervention_id').value) {
    document.getElementById('intervention_id').dispatchEvent(new Event('change'));
}
</script>
@endsection

