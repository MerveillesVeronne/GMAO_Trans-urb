@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">
                        <i class="fas fa-tools mr-3 text-blue-600"></i>
                        Détails de l'Intervention
                    </h1>
                    <p class="mt-2 text-gray-600">Module Logistique - Consultation en lecture seule</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('logistique.planning.index') }}" class="btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Retour au Planning
                    </a>
                    @if(!$intervention->signatureLogistiqueUser && $intervention->signatureMaintenanceUser)
                    <button onclick="signerIntervention({{ $intervention->id }})" class="btn-success">
                        <i class="fas fa-signature mr-2"></i>
                        Signer l'Intervention
                    </button>
                    @endif
                </div>
            </div>
        </div>

        <!-- Informations principales -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
            <!-- Informations de l'intervention -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-info-circle mr-2 text-blue-600"></i>
                        Informations Générales
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">ID Intervention</label>
                            <p class="text-lg font-semibold text-gray-900">#{{ $intervention->id }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Type d'Intervention</label>
                            <p class="text-lg font-semibold text-gray-900">{{ $intervention->type_intervention ?? 'Non défini' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nature</label>
                            <p class="text-lg font-semibold text-gray-900">{{ $intervention->nature_intervention ?? 'Non définie' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Priorité</label>
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full
                                @if($intervention->priorite === 'Urgent') bg-red-100 text-red-800
                                @elseif($intervention->priorite === 'À prévoir') bg-yellow-100 text-yellow-800
                                @else bg-green-100 text-green-800 @endif">
                                {{ $intervention->priorite ?? 'Normal' }}
                            </span>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full
                                @if($intervention->statut === 'En Attente') bg-yellow-100 text-yellow-800
                                @elseif($intervention->statut === 'En Cours') bg-blue-100 text-blue-800
                                @elseif($intervention->statut === 'Terminee') bg-green-100 text-green-800
                                @elseif($intervention->statut === 'Livré') bg-green-100 text-green-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ $intervention->statut ?? 'En Attente' }}
                            </span>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Technicien</label>
                            <p class="text-lg font-semibold text-gray-900">{{ $intervention->technicien ?? 'Non assigné' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-clipboard-list mr-2 text-blue-600"></i>
                        Description de l'Intervention
                    </h3>
                    <div class="prose max-w-none">
                        <p class="text-gray-700 leading-relaxed">{{ $intervention->description ?? 'Aucune description fournie' }}</p>
                    </div>
                </div>

                <!-- Pièces nécessaires -->
                @if($intervention->pieces_necessaires)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-cogs mr-2 text-blue-600"></i>
                        Pièces Nécessaires
                    </h3>
                    <div class="prose max-w-none">
                        <p class="text-gray-700 leading-relaxed">{{ $intervention->pieces_necessaires }}</p>
                    </div>
                </div>
                @endif
            </div>

            <!-- Informations du véhicule -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-bus mr-2 text-green-600"></i>
                        Véhicule Concerné
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <div class="h-12 w-12 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center">
                                <i class="fas fa-bus text-white text-lg"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-lg font-semibold text-gray-900">{{ $intervention->vehicule->numero ?? 'N/A' }}</p>
                                <p class="text-sm text-gray-600">{{ $intervention->vehicule->immatriculation ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Marque:</span>
                                <span class="font-semibold text-gray-900">{{ $intervention->vehicule->marque ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Modèle:</span>
                                <span class="font-semibold text-gray-900">{{ $intervention->vehicule->modele ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Type:</span>
                                <span class="font-semibold text-gray-900">{{ $intervention->vehicule->type_vehicule ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Année:</span>
                                <span class="font-semibold text-gray-900">{{ $intervention->vehicule->annee ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dates -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-calendar mr-2 text-purple-600"></i>
                        Planning
                    </h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Date de début:</span>
                            <span class="font-semibold text-gray-900">
                                {{ $intervention->date_debut ? $intervention->date_debut->format('d/m/Y H:i') : 'Non définie' }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Date fin prévue:</span>
                            <span class="font-semibold text-gray-900">
                                {{ $intervention->date_fin_prevue ? $intervention->date_fin_prevue->format('d/m/Y H:i') : 'Non définie' }}
                            </span>
                        </div>
                        @if($intervention->date_fin_reelle)
                        <div class="flex justify-between">
                            <span class="text-gray-600">Date fin réelle:</span>
                            <span class="font-semibold text-gray-900">
                                {{ $intervention->date_fin_reelle->format('d/m/Y H:i') }}
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Signatures -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">
                <i class="fas fa-signature mr-2 text-purple-600"></i>
                Signatures
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Signature Maintenance -->
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-wrench text-blue-600 mr-3 text-xl"></i>
                        <div>
                            <div class="font-semibold text-gray-900">Maintenance</div>
                            <div class="text-sm text-gray-600">
                                @if($intervention->signatureMaintenanceUser)
                                    Signé par {{ $intervention->signatureMaintenanceUser->nom_complet ?? $intervention->signatureMaintenanceUser->nom }}
                                    <br>
                                    <span class="text-xs text-gray-500">{{ $intervention->signature_maintenance_date ? $intervention->signature_maintenance_date->format('d/m/Y H:i') : '' }}</span>
                                @else
                                    Non signé
                                @endif
                            </div>
                        </div>
                    </div>
                    @if($intervention->signatureMaintenanceUser)
                        <span class="text-green-600">
                            <i class="fas fa-check-circle text-xl"></i>
                        </span>
                    @else
                        <span class="text-gray-400">
                            <i class="fas fa-circle text-xl"></i>
                        </span>
                    @endif
                </div>

                <!-- Signature Logistique -->
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-clipboard-list text-purple-600 mr-3 text-xl"></i>
                        <div>
                            <div class="font-semibold text-gray-900">Logistique</div>
                            <div class="text-sm text-gray-600">
                                @if($intervention->signatureLogistiqueUser)
                                    Signé par {{ $intervention->signatureLogistiqueUser->nom_complet ?? $intervention->signatureLogistiqueUser->nom }}
                                    <br>
                                    <span class="text-xs text-gray-500">{{ $intervention->signature_logistique_date ? $intervention->signature_logistique_date->format('d/m/Y H:i') : '' }}</span>
                                @else
                                    Non signé
                                @endif
                            </div>
                        </div>
                    </div>
                    @if($intervention->signatureLogistiqueUser)
                        <span class="text-green-600">
                            <i class="fas fa-check-circle text-xl"></i>
                        </span>
                    @else
                        <span class="text-gray-400">
                            <i class="fas fa-circle text-xl"></i>
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Note importante -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-center">
                <i class="fas fa-info-circle text-blue-600 mr-3"></i>
                <div>
                    <h4 class="font-semibold text-blue-900">Module Logistique</h4>
                    <p class="text-sm text-blue-800 mt-1">
                        Vous consultez cette intervention en mode lecture seule. Vous pouvez uniquement signer l'intervention si elle a été préalablement signée par la maintenance.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de notification -->
<div id="notificationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-4">
                <i class="fas fa-check text-green-600 text-xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2" id="notificationTitle">Succès</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500" id="notificationMessage">Action effectuée avec succès</p>
            </div>
            <div class="flex justify-center space-x-3 mt-4">
                <button onclick="closeNotification()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                    OK
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function signerIntervention(id) {
    fetch(`/logistique/interventions/${id}/signer`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('Succès', data.message, function() {
                window.location.reload();
            });
        } else {
            showNotification('Erreur', data.message);
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        showNotification('Erreur', 'Erreur lors de la signature');
    });
}

function showNotification(title, message, callback = null) {
    document.getElementById('notificationTitle').textContent = title;
    document.getElementById('notificationMessage').textContent = message;
    document.getElementById('notificationModal').classList.remove('hidden');
    
    if (callback) {
        window.notificationCallback = callback;
    }
}

function closeNotification() {
    document.getElementById('notificationModal').classList.add('hidden');
    if (window.notificationCallback) {
        window.notificationCallback();
        window.notificationCallback = null;
    }
}
</script>
@endsection
