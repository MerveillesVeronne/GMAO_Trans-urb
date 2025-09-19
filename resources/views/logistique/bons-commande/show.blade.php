@extends('layouts.app')

@section('title', "GMAO Trans'urb - Détails Bon de Commande")

@section('content')
    <header class="bg-green-900 shadow-xl mb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center gap-4">
            <div class="h-10 w-10 bg-white rounded-full flex items-center justify-center shadow">
                <i class="fas fa-file-invoice text-green-800 text-xl"></i>
            </div>
            <span class="text-2xl font-bold tracking-wide text-white">Trans'urb GMAO - Détails Bon de Commande</span>
        </div>
    </header>

    <div class="max-w-7xl mx-auto">
        <!-- Bouton retour -->
        <div class="mb-6">
            <a href="{{ route('logistique.bons-commande.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>
                Retour à la liste
            </a>
        </div>

        <!-- Informations du bon de commande -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-green-900">
                    <i class="fas fa-info-circle text-green-700 mr-2"></i>
                    Informations Générales
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-2">Bon de Commande</h4>
                        <p class="text-gray-600">{{ $bon->reference }}</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-2">Statut</h4>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-{{ $bon->statut_color }}-100 text-{{ $bon->statut_color }}-800">
                            {{ $bon->statut_label }}
                        </span>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-2">Date de création</h4>
                        <p class="text-gray-600">{{ $bon->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-2">Chauffeur</h4>
                        <p class="text-gray-600">{{ $bon->chauffeur ?: 'Non spécifié' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informations du véhicule -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-green-900">
                    <i class="fas fa-bus text-green-700 mr-2"></i>
                    Véhicule Concerné
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-2">Numéro</h4>
                        <p class="text-gray-600">{{ $bon->vehicule->numero ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-2">Marque/Modèle</h4>
                        <p class="text-gray-600">{{ $bon->vehicule->marque ?? '' }} {{ $bon->vehicule->modele ?? '' }}</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-2">Ligne</h4>
                        <p class="text-gray-600">{{ $bon->vehicule->ligne ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informations de l'intervention -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-green-900">
                    <i class="fas fa-tools text-green-700 mr-2"></i>
                    Intervention
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-2">Type d'intervention</h4>
                        <p class="text-gray-600">{{ $bon->intervention->type_intervention ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-2">Priorité</h4>
                        <p class="text-gray-600">{{ $bon->intervention->priorite ?? 'N/A' }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <h4 class="font-semibold text-gray-900 mb-2">Description</h4>
                        <p class="text-gray-600">{{ $bon->intervention->description ?? 'Aucune description' }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <h4 class="font-semibold text-gray-900 mb-2">Pièces nécessaires</h4>
                        <p class="text-gray-600">{{ $bon->intervention->pieces_necessaires ?? 'Aucune pièce spécifiée' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Signatures -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-green-900">
                    <i class="fas fa-signature text-green-700 mr-2"></i>
                    Signatures
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Signature Maintenance -->
                    <div class="border rounded-lg p-4">
                        <h4 class="font-semibold text-gray-900 mb-2">Signature Maintenance</h4>
                        @if($bon->signataire_1_id)
                            <div class="space-y-2">
                                <p class="text-sm text-gray-600"><strong>Signataire:</strong> {{ $bon->signataire1->nom_complet ?? 'N/A' }}</p>
                                <p class="text-sm text-gray-600"><strong>Fonction:</strong> {{ $bon->signature_1_fonction ?? 'N/A' }}</p>
                                <p class="text-sm text-gray-600"><strong>Date:</strong> {{ $bon->signature_1_date ? $bon->signature_1_date->format('d/m/Y H:i') : 'N/A' }}</p>
                                <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    <i class="fas fa-check mr-1"></i>Signé
                                </span>
                            </div>
                        @else
                            <p class="text-sm text-gray-500">En attente de signature</p>
                        @endif
                    </div>

                    <!-- Signature Logistique -->
                    <div class="border rounded-lg p-4">
                        <h4 class="font-semibold text-gray-900 mb-2">Signature Logistique</h4>
                        @if($bon->signataire_2_id)
                            <div class="space-y-2">
                                <p class="text-sm text-gray-600"><strong>Signataire:</strong> {{ $bon->signataire2->nom_complet ?? 'N/A' }}</p>
                                <p class="text-sm text-gray-600"><strong>Fonction:</strong> {{ $bon->signature_2_fonction ?? 'N/A' }}</p>
                                <p class="text-sm text-gray-600"><strong>Date:</strong> {{ $bon->signature_2_date ? $bon->signature_2_date->format('d/m/Y H:i') : 'N/A' }}</p>
                                <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    <i class="fas fa-check mr-1"></i>Signé
                                </span>
                            </div>
                        @else
                            <p class="text-sm text-gray-500">En attente de signature</p>
                            @if($bon->signataire_1_id && !$bon->signataire_2_id)
                                <button onclick="openSignatureModal()" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                    <i class="fas fa-signature mr-2"></i>Signer
                                </button>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Notes -->
        @if($bon->notes)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-green-900">
                        <i class="fas fa-sticky-note text-green-700 mr-2"></i>
                        Notes
                    </h3>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 whitespace-pre-line">{{ $bon->notes }}</p>
                </div>
            </div>
        @endif
    </div>

    <!-- Modal de signature -->
    <div id="signatureModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Confirmation de Signature</h3>
                </div>
                <div class="px-6 py-4">
                    <div class="mb-4">
                        <div class="flex items-center mb-3">
                            <i class="fas fa-user-circle text-blue-500 text-2xl mr-3"></i>
                            <div>
                                <p class="font-medium text-gray-900">{{ auth()->user()->nom }} {{ auth()->user()->prenom }}</p>
                                <p class="text-sm text-gray-600">Chef de Service Logistique</p>
                            </div>
                        </div>
                        <p class="text-gray-700 mb-4">
                            Êtes-vous sûr de vouloir signer ce bon de commande ? 
                            Cette action validera définitivement la demande et déclenchera le retrait automatique des pièces du stock.
                        </p>
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 mb-4">
                            <div class="flex">
                                <i class="fas fa-exclamation-triangle text-yellow-600 mt-1 mr-2"></i>
                                <p class="text-sm text-yellow-800">
                                    <strong>Attention :</strong> Une fois signé, les pièces seront automatiquement retirées du stock selon les quantités demandées.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="commentaires" class="block text-sm font-medium text-gray-700 mb-2">
                            Commentaires (optionnel)
                        </label>
                        <textarea id="commentaires" name="commentaires" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                                  placeholder="Commentaires sur la validation..."></textarea>
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                    <button type="button" onclick="closeSignatureModal()" 
                            class="px-4 py-2 text-gray-600 hover:text-gray-800 transition-colors">
                        Annuler
                    </button>
                    <button onclick="submitSignature()" 
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                        <i class="fas fa-signature mr-2"></i>Confirmer la signature
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openSignatureModal() {
            document.getElementById('signatureModal').classList.remove('hidden');
        }

        function closeSignatureModal() {
            document.getElementById('signatureModal').classList.add('hidden');
        }

        function submitSignature() {
            const commentaires = document.getElementById('commentaires').value;
            
            fetch('{{ route("logistique.bons-commande.signer", $bon) }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    signature_fonction: 'Chef de Service Logistique',
                    commentaires: commentaires
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Bon de commande signé avec succès !');
                    window.location.reload();
                } else {
                    alert('Erreur lors de la signature : ' + (data.message || 'Erreur inconnue'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Erreur lors de la signature');
            });
        }
    </script>
@endsection
