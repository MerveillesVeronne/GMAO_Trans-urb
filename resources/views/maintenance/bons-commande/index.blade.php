@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-green-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-3xl font-bold text-white">Bons de Commande</h1>
                    <p class="text-green-100 mt-1">Gestion des bons de commande de maintenance</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('maintenance.bons-commande.create') }}" 
                       class="inline-flex items-center px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 transition-colors duration-200">
                        <i class="fas fa-plus mr-2"></i>Nouveau bon de commande
                    </a>
                    <a href="{{ route('maintenance.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>Retour
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-file-invoice text-2xl text-green-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-clock text-2xl text-yellow-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">En attente</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['en_attente'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-signature text-2xl text-blue-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Signés</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['signe'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-2xl text-green-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Approuvés</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['approuve'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-tools text-2xl text-orange-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">En cours</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['en_cours'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-flag-checkered text-2xl text-green-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Terminés</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['termine'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau des bons de commande -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Liste des bons de commande</h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Référence
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Intervention
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Véhicule
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Statut
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date création
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($bons_commande as $bonCommande)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $bonCommande->reference }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    <a href="{{ route('maintenance.interventions.show', $bonCommande->intervention->id) }}" 
                                       class="text-green-600 hover:text-green-900">
                                        Intervention #{{ $bonCommande->intervention->id }}
                                    </a>
                                </div>
                                <div class="text-sm text-gray-500">{{ $bonCommande->intervention->type_intervention }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    <a href="{{ route('maintenance.vehicules.show', $bonCommande->vehicule->id) }}" 
                                       class="text-green-600 hover:text-green-900">
                                        {{ $bonCommande->vehicule->nom_complet }}
                                    </a>
                                </div>
                                <div class="text-sm text-gray-500">{{ $bonCommande->vehicule->immatriculation }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $bonCommande->statut === 'En Attente' ? 'bg-yellow-100 text-yellow-800' : 
                                       ($bonCommande->statut === 'Signé' ? 'bg-blue-100 text-blue-800' : 
                                       ($bonCommande->statut === 'Approuvé' ? 'bg-green-100 text-green-800' : 
                                       ($bonCommande->statut === 'En Cours' ? 'bg-orange-100 text-orange-800' : 
                                       'bg-gray-100 text-gray-800'))) }}">
                                    {{ $bonCommande->statut }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $bonCommande->date_creation->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('maintenance.bons-commande.show', $bonCommande) }}" 
                                       class="text-green-700 hover:text-green-900">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('maintenance.bons-commande.edit', $bonCommande) }}" 
                                       class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('maintenance.bons-commande.pdf', $bonCommande) }}?mode=view" 
                                       class="text-orange-600 hover:text-orange-900" target="_blank">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                    <button onclick="deleteBonCommande({{ $bonCommande->id }})" 
                                            class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                Aucun bon de commande trouvé
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
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
function deleteBonCommande(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce bon de commande ?')) {
        fetch(`/maintenance/bons-commande/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showSuccessModal(data.message);
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } else {
                showErrorModal(data.message);
            }
        })
        .catch(error => {
            showErrorModal('Erreur lors de la suppression du bon de commande');
        });
    }
}

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
</script>
@endsection
