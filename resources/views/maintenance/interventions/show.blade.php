@extends('layouts.app')
@section('title', "GMAO Trans'urb - Détails Intervention")
@section('content')
    <header class="bg-green-900 shadow-xl mb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center gap-4">
            <div class="h-10 w-10 bg-white rounded-full flex items-center justify-center shadow">
                <i class="fas fa-tools text-green-800 text-xl"></i>
            </div>
            <span class="text-2xl font-bold tracking-wide text-white">Trans'urb GMAO - Détails Intervention</span>
        </div>
    </header>

    <div class="max-w-7xl mx-auto">
        <!-- Bouton retour -->
        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('maintenance.interventions.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>
                Retour à la liste
            </a>
        </div>

        <!-- Informations de l'intervention -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-green-900">
                    <i class="fas fa-info-circle text-green-700 mr-2"></i>
                    Informations de l'Intervention
                </h3>
                <div class="flex space-x-2">
                    <a href="{{ route('maintenance.interventions.export.pdf', $intervention->id) }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200">
                        <i class="fas fa-file-pdf"></i>
                        Exporter PDF
                    </a>
                    <a href="{{ route('maintenance.interventions.edit', $intervention->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200">
                        <i class="fas fa-edit"></i>
                        Modifier
                    </a>
                </div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Véhicule</label>
                        <p class="text-lg font-semibold text-green-900">{{ $intervention->vehicule->nom_complet }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Type d'intervention</label>
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                            {{ $intervention->type_intervention }}
                        </span>
                    </div>
                    @if($intervention->nature_intervention)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nature d'intervention</label>
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                            {{ $intervention->nature_intervention }}
                        </span>
                    </div>
                    @endif
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Priorité</label>
                        @php
                            $priorityColors = [
                                'Normal' => 'bg-blue-200 text-blue-900',
                                'À prévoir' => 'bg-yellow-200 text-yellow-900',
                                'Urgent' => 'bg-red-200 text-red-900'
                            ];
                            $priorityColor = $priorityColors[$intervention->priorite] ?? 'bg-gray-200 text-gray-900';
                        @endphp
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full {{ $priorityColor }}">
                            {{ $intervention->priorite }}
                        </span>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
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
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full {{ $statusColor }}">
                            {{ $intervention->statut }}
                        </span>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date de début</label>
                        <p class="text-lg font-semibold text-green-900">{{ $intervention->date_debut->format('d/m/Y H:i') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date de fin prévue</label>
                        <p class="text-lg font-semibold text-green-900">{{ $intervention->date_fin_prevue ? $intervention->date_fin_prevue->format('d/m/Y H:i') : 'Non définie' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Technicien</label>
                        <p class="text-lg font-semibold text-green-900">{{ $intervention->technicien }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <p class="text-gray-900">{{ $intervention->description }}</p>
                    </div>
                    @if($intervention->pieces_necessaires)
                        <div class="md:col-span-2 lg:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pièces nécessaires</label>
                            <p class="text-gray-900">{{ $intervention->pieces_necessaires }}</p>
                        </div>
                    @endif
                    @if($intervention->quantite_pieces)
                        <div class="md:col-span-2 lg:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Quantité de pièces</label>
                            <p class="text-gray-900">{{ $intervention->quantite_pieces }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Validation des signatures -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-green-900">
                    <i class="fas fa-signature text-green-700 mr-2"></i>
                    Validation des Signatures
                </h3>
                <p class="text-sm text-gray-600 mt-1">Les signatures sont obligatoires pour démarrer l'intervention</p>
            </div>
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Responsable
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Fonction
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Statut
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Chef de service maintenance -->
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">Chef de Service Maintenance</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">Validation technique</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($intervention->signature_maintenance)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check mr-1"></i>Signé
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-clock mr-1"></i>En attente
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if($intervention->signature_maintenance)
                                        {{ $intervention->signature_maintenance_date->format('d/m/Y H:i') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    @if($intervention->signature_maintenance)
                                        <span class="text-green-600">
                                            <i class="fas fa-check-circle"></i> Signé
                                        </span>
                                    @else
                                        @if(auth()->user()->canSignMaintenance())
                                            <button onclick="signerIntervention('maintenance')" 
                                                    class="text-blue-600 hover:text-blue-900">
                                                <i class="fas fa-signature mr-1"></i>Imposer signature
                                            </button>
                                        @else
                                            <span class="text-gray-400">
                                                <i class="fas fa-lock mr-1"></i>Non autorisé
                                            </span>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            
                            <!-- Chef de service logistique -->
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">Chef de Service Logistique</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">Validation pièces</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($intervention->signature_logistique)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check mr-1"></i>Signé
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-clock mr-1"></i>En attente
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if($intervention->signature_logistique)
                                        {{ $intervention->signature_logistique_date->format('d/m/Y H:i') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    @if($intervention->signature_logistique)
                                        <span class="text-green-600">
                                            <i class="fas fa-check-circle"></i> Signé
                                        </span>
                                    @else
                                        @if(auth()->user()->canSignLogistique())
                                            <button onclick="signerIntervention('logistique')" 
                                                    class="text-blue-600 hover:text-blue-900">
                                                <i class="fas fa-signature mr-1"></i>Imposer signature
                                            </button>
                                        @else
                                            <span class="text-gray-400">
                                                <i class="fas fa-lock mr-1"></i>Non autorisé
                                            </span>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <!-- Résumé des signatures -->
                <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="text-sm font-medium text-gray-900">État des signatures</h4>
                            <p class="text-sm text-gray-500">
                                @if($intervention->signature_maintenance && $intervention->signature_logistique)
                                    <span class="text-green-600">
                                        <i class="fas fa-check-circle mr-1"></i>Toutes les signatures sont validées
                                    </span>
                                @else
                                    <span class="text-yellow-600">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>Signatures manquantes
                                    </span>
                                @endif
                            </p>
                        </div>
                        <div class="text-right">
                            <div class="text-sm text-gray-500">
                                Signatures validées : 
                                <span class="font-medium">
                                    {{ ($intervention->signature_maintenance ? 1 : 0) + ($intervention->signature_logistique ? 1 : 0) }}/2
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bon de commande associé -->
        @if($intervention->bonCommande)
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-green-900">
                    <i class="fas fa-file-invoice text-green-700 mr-2"></i>
                    Bon de Commande Associé
                </h3>
            </div>
            <div class="p-6">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="font-semibold text-blue-900">{{ $intervention->bonCommande->reference }}</h4>
                            <p class="text-sm text-blue-700">Statut: 
                                <span class="font-medium">{{ $intervention->bonCommande->statut }}</span>
                            </p>
                            <p class="text-sm text-blue-600">Créé le {{ $intervention->bonCommande->date_creation->format('d/m/Y à H:i') }}</p>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('maintenance.bons-commande.show', $intervention->bonCommande->id) }}" 
                               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200">
                                <i class="fas fa-eye"></i>
                                Voir le bon de commande
                            </a>
                            @if($intervention->bonCommande->statut === 'En Attente')
                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                En attente de signature
                            </span>
                            @elseif($intervention->bonCommande->statut === 'Signé')
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                <i class="fas fa-check-circle mr-1"></i>
                                Signé et validé
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Actions rapides -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-green-900">
                    <i class="fas fa-cogs text-green-700 mr-2"></i>
                    Actions Rapides
                </h3>
            </div>
            <div class="p-6">
                <div class="flex flex-wrap gap-4">
                                         @if($intervention->statut == 'En Attente')
                         @if($intervention->bonCommande && $intervention->bonCommande->statut === 'Signé')
                             <button onclick="changeStatus('En Cours')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200">
                                 <i class="fas fa-play"></i>
                                 Démarrer l'intervention
                             </button>
                         @elseif($intervention->bonCommande && $intervention->bonCommande->statut === 'En Attente')
                             <button disabled class="bg-gray-400 text-white px-4 py-2 rounded-lg flex items-center gap-2 cursor-not-allowed" title="Bon de commande en attente de signature">
                                 <i class="fas fa-lock"></i>
                                 Démarrer l'intervention
                             </button>
                             <a href="{{ route('maintenance.bons-commande.show', $intervention->bonCommande->id) }}" 
                                class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200">
                                 <i class="fas fa-signature"></i>
                                 Signer le bon de commande
                             </a>
                         @elseif(!$intervention->bonCommande)
                             <button onclick="changeStatus('En Cours')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200">
                                 <i class="fas fa-play"></i>
                                 Démarrer l'intervention
                             </button>
                         @endif
                     @endif
                    
                    @if($intervention->statut == 'En Cours')
                        <button onclick="changeStatus('Terminee')" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200">
                            <i class="fas fa-check"></i>
                            Terminer l'intervention
                        </button>
                    @endif
                    
                    @if(in_array($intervention->statut, ['En Attente', 'En Cours']))
                        <button onclick="changeStatus('Annulee')" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200">
                            <i class="fas fa-times"></i>
                            Annuler l'intervention
                        </button>
                    @endif
                    
                                         <a href="{{ route('maintenance.planning.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200">
                         <i class="fas fa-calendar-plus"></i>
                         Planifier une maintenance
                     </a>
                </div>
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

     <!-- Modal de confirmation de signature -->
     <div id="confirmSignatureModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
         <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
             <div class="mt-3 text-center">
                 <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100">
                     <i class="fas fa-signature text-blue-600 text-xl"></i>
                 </div>
                 <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Confirmation de signature</h3>
                 <div class="mt-2 px-7 py-3">
                     <p class="text-sm text-gray-500" id="confirmSignatureMessage"></p>
                 </div>
                 <div class="items-center px-4 py-3 flex gap-3">
                     <button id="cancelSignature" class="flex-1 px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300">
                         Annuler
                     </button>
                     <button id="confirmSignature" class="flex-1 px-4 py-2 bg-blue-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">
                         Confirmer
                     </button>
                 </div>
             </div>
         </div>
     </div>

     <!-- Modal de confirmation de changement de statut -->
     <div id="confirmStatusModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
         <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
             <div class="mt-3 text-center">
                 <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-orange-100">
                     <i class="fas fa-cogs text-orange-600 text-xl"></i>
                 </div>
                 <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Confirmation de changement de statut</h3>
                 <div class="mt-2 px-7 py-3">
                     <p class="text-sm text-gray-500" id="confirmStatusMessage"></p>
                 </div>
                 <div class="items-center px-4 py-3 flex gap-3">
                     <button id="cancelStatus" class="flex-1 px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300">
                         Annuler
                     </button>
                     <button id="confirmStatus" class="flex-1 px-4 py-2 bg-orange-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-300">
                         Confirmer
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

         // Event listeners pour le modal de confirmation de signature
         document.getElementById('confirmSignature').addEventListener('click', confirmSignature);
         document.getElementById('cancelSignature').addEventListener('click', cancelSignature);

         // Event listeners pour le modal de confirmation de changement de statut
         document.getElementById('confirmStatus').addEventListener('click', confirmStatus);
         document.getElementById('cancelStatus').addEventListener('click', cancelStatus);

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

         document.getElementById('confirmSignatureModal').addEventListener('click', function(e) {
             if (e.target === this) {
                 cancelSignature();
             }
         });

         document.getElementById('confirmStatusModal').addEventListener('click', function(e) {
             if (e.target === this) {
                 cancelStatus();
             }
         });

                 // Variables globales pour la signature
         let currentSignatureType = null;

         // Fonction pour signer une intervention
         function signerIntervention(type) {
             currentSignatureType = type;
             const serviceName = type === 'maintenance' ? 'maintenance' : 'logistique';
             
             // Afficher le modal de confirmation
             document.getElementById('confirmSignatureMessage').textContent = 
                 `Êtes-vous sûr de vouloir signer cette intervention en tant que chef de service ${serviceName} ?`;
             document.getElementById('confirmSignatureModal').classList.remove('hidden');
         }

         // Fonction pour confirmer la signature
         function confirmSignature() {
             if (!currentSignatureType) return;
             
             // Masquer le modal de confirmation
             document.getElementById('confirmSignatureModal').classList.add('hidden');
             
             // Effectuer la signature
             fetch(`{{ route('maintenance.interventions.signature', $intervention->id) }}`, {
                 method: 'POST',
                 headers: {
                     'Content-Type': 'application/json',
                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                 },
                 body: JSON.stringify({
                     type: currentSignatureType
                 })
             })
             .then(response => response.json())
             .then(data => {
                 if (data.success) {
                     showSuccessModal('Succès !', data.message);
                     
                     // Recharger la page pour mettre à jour les signatures
                     setTimeout(() => {
                         closeSuccessModal();
                         location.reload();
                     }, 1500);
                 } else {
                     showErrorModal('Erreur', data.message || 'Erreur lors de la signature');
                 }
             })
             .catch(error => {
                 console.error('Erreur:', error);
                 showErrorModal('Erreur', 'Erreur lors de la signature');
             });
             
             currentSignatureType = null;
         }

         // Fonction pour annuler la signature
         function cancelSignature() {
             document.getElementById('confirmSignatureModal').classList.add('hidden');
             currentSignatureType = null;
         }

                  // Variables globales pour le changement de statut
         let currentNewStatus = null;

         // Fonction pour changer le statut
         function changeStatus(newStatus) {
             currentNewStatus = newStatus;
             
             // Afficher le modal de confirmation
             document.getElementById('confirmStatusMessage').textContent = 
                 `Êtes-vous sûr de vouloir changer le statut à "${newStatus}" ?`;
             document.getElementById('confirmStatusModal').classList.remove('hidden');
         }

         // Fonction pour confirmer le changement de statut
         function confirmStatus() {
             if (!currentNewStatus) return;
             
             // Masquer le modal de confirmation
             document.getElementById('confirmStatusModal').classList.add('hidden');
             
             // Effectuer le changement de statut
             fetch(`{{ route('maintenance.interventions.status', $intervention->id) }}`, {
                 method: 'POST',
                 headers: {
                     'Content-Type': 'application/json',
                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                 },
                 body: JSON.stringify({
                     statut: currentNewStatus
                 })
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
                     showErrorModal('Erreur', data.message || 'Erreur lors du changement de statut');
                 }
             })
             .catch(error => {
                 console.error('Erreur:', error);
                 showErrorModal('Erreur', 'Erreur lors du changement de statut');
             });
             
             currentNewStatus = null;
         }

         // Fonction pour annuler le changement de statut
         function cancelStatus() {
             document.getElementById('confirmStatusModal').classList.add('hidden');
             currentNewStatus = null;
         }
    </script>
@endsection
