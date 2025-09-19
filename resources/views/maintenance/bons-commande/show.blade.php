@extends('layouts.app')

@section('content')
@if(!$bons_commande)
    <div class="min-h-screen bg-gray-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <i class="fas fa-exclamation-triangle text-red-500 text-4xl mb-4"></i>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Bon de commande non trouvé</h2>
            <p class="text-gray-600 mb-4">Le bon de commande que vous recherchez n'existe pas ou a été supprimé.</p>
            <a href="{{ route('maintenance.bons-commande.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Retour à la liste
            </a>
        </div>
    </div>
@else
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-green-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                                         <h1 class="text-3xl font-bold text-white">Bon de Commande {{ $bons_commande->reference }}</h1>
                    <p class="text-green-100 mt-1">Détails du bon de commande de maintenance</p>
                </div>
                                     <div class="flex space-x-3">
                         @if($bons_commande)
                             <a href="{{ route('maintenance.bons-commande.pdf', $bons_commande) }}?mode=view" 
                                class="inline-flex items-center px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors duration-200" target="_blank">
                                 <i class="fas fa-eye mr-2"></i>Visualiser PDF
                             </a>
                             <a href="{{ route('maintenance.bons-commande.pdf', $bons_commande) }}" 
                                class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                                 <i class="fas fa-download mr-2"></i>Télécharger PDF
                             </a>
                         @endif
                     @if($bons_commande)
                         <a href="{{ route('maintenance.bons-commande.edit', $bons_commande) }}" 
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                             <i class="fas fa-edit mr-2"></i>Modifier
                         </a>
                     @endif
                    <a href="{{ route('maintenance.bons-commande.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>Retour
                    </a>
                </div>
            </div>
        </div>
    </div>

         <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
         <!-- Messages de succès/erreur -->
         @if(session('success'))
             <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                 <div class="flex items-center">
                     <i class="fas fa-check-circle mr-2"></i>
                     {{ session('success') }}
                 </div>
             </div>
         @endif

         @if($errors->any())
             <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                 <div class="flex items-center mb-2">
                     <i class="fas fa-exclamation-circle mr-2"></i>
                     <strong>Erreurs de validation :</strong>
                 </div>
                 <ul class="list-disc list-inside">
                     @foreach($errors->all() as $error)
                         <li>{{ $error }}</li>
                     @endforeach
                 </ul>
             </div>
         @endif

         <!-- Informations principales -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">
                                                 Bon de Commande {{ $bons_commande->reference }}
                    </h2>
                    <div class="flex items-center space-x-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                                         {{ $bons_commande->statut === 'En Attente' ? 'bg-yellow-100 text-yellow-800' : 
                                ($bons_commande->statut === 'Signé' ? 'bg-blue-100 text-blue-800' : 
                                ($bons_commande->statut === 'Approuvé' ? 'bg-green-100 text-green-800' : 
                                ($bons_commande->statut === 'En Cours' ? 'bg-orange-100 text-orange-800' : 
                                'bg-gray-100 text-gray-800'))) }}">
                             {{ $bons_commande->statut }}
                        </span>
                        <span class="text-sm text-gray-500">
                                                         Créé le {{ $bons_commande->date_creation->format('d/m/Y à H:i') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Grille d'informations -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Intervention</h3>
                    <dl class="space-y-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Intervention</dt>
                            <dd class="text-sm text-gray-900">
                                                                 <a href="{{ route('maintenance.interventions.show', $bons_commande->intervention->id) }}" 
                                    class="text-green-600 hover:text-green-900">
                                     Intervention #{{ $bons_commande->intervention->id }}
                                 </a>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Type d'intervention</dt>
                                                         <dd class="text-sm text-gray-900">{{ $bons_commande->intervention->type_intervention }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Technicien</dt>
                                                         <dd class="text-sm text-gray-900">{{ $bons_commande->intervention->technicien }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Priorité</dt>
                                                         <dd class="text-sm text-gray-900">{{ $bons_commande->intervention->priorite }}</dd>
                        </div>
                    </dl>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Véhicule</h3>
                    <dl class="space-y-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Véhicule</dt>
                            <dd class="text-sm text-gray-900">
                                                                 <a href="{{ route('maintenance.vehicules.show', $bons_commande->vehicule->id) }}" 
                                    class="text-green-600 hover:text-green-900">
                                     {{ $bons_commande->vehicule->nom_complet }}
                                 </a>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Immatriculation</dt>
                                                         <dd class="text-sm text-gray-900">{{ $bons_commande->vehicule->immatriculation }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Marque/Modèle</dt>
                                                         <dd class="text-sm text-gray-900">{{ $bons_commande->vehicule->marque }} {{ $bons_commande->vehicule->modele }}</dd>
                        </div>
                                                 @if($bons_commande->chauffeur)
                         <div>
                             <dt class="text-sm font-medium text-gray-500">Chauffeur</dt>
                             <dd class="text-sm text-gray-900">{{ $bons_commande->chauffeur }}</dd>
                         </div>
                         @endif
                    </dl>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Dates</h3>
                    <dl class="space-y-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Date de besoin</dt>
                                                         <dd class="text-sm text-gray-900">{{ $bons_commande->date_besoin->format('d/m/Y H:i') }}</dd>
                        </div>
                                                 @if($bons_commande->date_debut_prevue)
                         <div>
                             <dt class="text-sm font-medium text-gray-500">Début prévu</dt>
                             <dd class="text-sm text-gray-900">{{ $bons_commande->date_debut_prevue->format('d/m/Y H:i') }}</dd>
                         </div>
                         @endif
                                                   @if($bons_commande->date_fin_prevue)
                          <div>
                              <dt class="text-sm font-medium text-gray-500">Fin prévue</dt>
                              <dd class="text-sm text-gray-900">{{ $bons_commande->date_fin_prevue->format('d/m/Y H:i') }}</dd>
                          </div>
                          @endif
                    </dl>
                </div>
            </div>
        </div>

        <!-- Motif et pièces nécessaires -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Motif de l'intervention</h3>
                                 <div class="text-gray-700 whitespace-pre-wrap">{{ $bons_commande->motif_intervention }}</div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Pièces nécessaires</h3>
                                 <div class="text-gray-700 whitespace-pre-wrap">{{ $bons_commande->pieces_necessaires }}</div>
            </div>
        </div>

        <!-- Signatures -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Signatures</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="border rounded-lg p-4">
                    <h4 class="font-medium text-gray-900 mb-2">Signature 1</h4>
                                         @if($bons_commande->signataire1)
                         <div class="space-y-2">
                             <p class="text-sm text-gray-600">
                                 <strong>Signataire :</strong> {{ $bons_commande->signataire1->nom }} {{ $bons_commande->signataire1->prenom }}
                             </p>
                             <p class="text-sm text-gray-600">
                                 <strong>Fonction :</strong> {{ $bons_commande->signature_1_fonction }}
                             </p>
                             <p class="text-sm text-gray-600">
                                 <strong>Date :</strong> {{ $bons_commande->signature_1_date->format('d/m/Y H:i') }}
                             </p>
                         </div>
                     @else
                        <p class="text-sm text-gray-500 italic">En attente de signature</p>
                    @endif
                </div>

                <div class="border rounded-lg p-4">
                    <h4 class="font-medium text-gray-900 mb-2">Signature 2</h4>
                                         @if($bons_commande->signataire2)
                         <div class="space-y-2">
                             <p class="text-sm text-gray-600">
                                 <strong>Signataire :</strong> {{ $bons_commande->signataire2->nom }} {{ $bons_commande->signataire2->prenom }}
                             </p>
                             <p class="text-sm text-gray-600">
                                 <strong>Fonction :</strong> {{ $bons_commande->signature_2_fonction }}
                             </p>
                             <p class="text-sm text-gray-600">
                                 <strong>Date :</strong> {{ $bons_commande->signature_2_date->format('d/m/Y H:i') }}
                             </p>
                         </div>
                     @else
                        <p class="text-sm text-gray-500 italic">En attente de signature</p>
                    @endif
                </div>
            </div>

                         @if($bons_commande->valide)
             <div class="mt-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                 <h4 class="font-medium text-green-900 mb-2">Validation</h4>
                 <div class="space-y-1">
                     <p class="text-sm text-green-700">
                         <strong>Validé par :</strong> {{ $bons_commande->validePar->nom }} {{ $bons_commande->validePar->prenom }}
                     </p>
                     <p class="text-sm text-green-700">
                         <strong>Date :</strong> {{ $bons_commande->valide_le->format('d/m/Y H:i') }}
                     </p>
                 </div>
             </div>
             @endif
        </div>

                 @if($bons_commande->notes)
         <div class="bg-white rounded-lg shadow-md p-6 mb-6">
             <h3 class="text-lg font-semibold text-gray-900 mb-4">Notes</h3>
             <div class="text-gray-700 whitespace-pre-wrap">{{ $bons_commande->notes }}</div>
         </div>
         @endif

                 <!-- Actions rapides -->
         <div class="bg-white rounded-lg shadow-md p-6">
             <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions</h3>
             <div class="flex flex-wrap gap-3">
                 @if($bons_commande->statut === 'En Attente')
                     <!-- Chef de Service Maintenance -->
                     @if(auth()->user()->canSignMaintenance())
                         @if(!$bons_commande->signataire1_id)
                             <button onclick="signerBonCommande(1, 'Chef de Service Maintenance')" 
                                     class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                 <i class="fas fa-signature mr-2"></i>Signer (Chef Maintenance)
                             </button>
                         @else
                             <button disabled 
                                     class="inline-flex items-center px-4 py-2 bg-gray-400 text-white rounded-lg cursor-not-allowed">
                                 <i class="fas fa-check mr-2"></i>Signé (Chef Maintenance)
                             </button>
                         @endif
                     @else
                         <button disabled 
                                 class="inline-flex items-center px-4 py-2 bg-gray-400 text-white rounded-lg cursor-not-allowed">
                             <i class="fas fa-user mr-2"></i>Chef Maintenance
                             @if($bons_commande->signataire1_id)
                                 <i class="fas fa-check ml-2"></i>
                             @else
                                 <i class="fas fa-clock ml-2"></i>
                             @endif
                         </button>
                     @endif
                     
                     <!-- Chef de Service Logistique -->
                     @if(auth()->user()->canSignLogistique())
                         @if(!$bons_commande->signataire2_id)
                             <button onclick="signerBonCommande(2, 'Chef de Service Logistique')" 
                                     class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                 <i class="fas fa-signature mr-2"></i>Signer (Chef Logistique)
                             </button>
                         @else
                             <button disabled 
                                     class="inline-flex items-center px-4 py-2 bg-gray-400 text-white rounded-lg cursor-not-allowed">
                                 <i class="fas fa-check mr-2"></i>Signé (Chef Logistique)
                             </button>
                         @endif
                     @else
                         <button disabled 
                                 class="inline-flex items-center px-4 py-2 bg-gray-400 text-white rounded-lg cursor-not-allowed">
                             <i class="fas fa-user mr-2"></i>Chef Logistique
                             @if($bons_commande->signataire2_id)
                                 <i class="fas fa-check ml-2"></i>
                             @else
                                 <i class="fas fa-clock ml-2"></i>
                             @endif
                         </button>
                     @endif
                 @endif
                
                                                  @if($bons_commande->statut === 'Signé' && !$bons_commande->valide && auth()->user()->canSignLogistique())
                     <button onclick="validerBonCommande()" 
                             class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                         <i class="fas fa-check mr-2"></i>Approuver
                     </button>
                 @endif
                
                                 @if($bons_commande->statut === 'Approuvé')
                    <button onclick="demarrerIntervention()" 
                            class="inline-flex items-center px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors duration-200">
                        <i class="fas fa-play mr-2"></i>Démarrer l'intervention
                    </button>
                @endif
                
                                 @if($bons_commande->statut === 'En Cours')
                    <button onclick="terminerIntervention()" 
                            class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                        <i class="fas fa-flag-checkered mr-2"></i>Terminer l'intervention
                    </button>
                @endif
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

 <!-- Modal de confirmation pour signature -->
 <div id="confirmSignatureModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
     <div class="flex items-center justify-center min-h-screen">
         <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
             <div class="flex items-center mb-4">
                 <div class="flex-shrink-0">
                     <i class="fas fa-signature text-blue-500 text-2xl"></i>
                 </div>
                 <div class="ml-3">
                     <h3 class="text-lg font-medium text-gray-900">Confirmation de signature</h3>
                 </div>
             </div>
             <p class="text-sm text-gray-600 mb-6">
                 Êtes-vous sûr de vouloir signer ce bon de commande ? Cette action ne peut pas être annulée.
             </p>
             <div class="flex space-x-3">
                 <button onclick="confirmSignature()" class="flex-1 bg-blue-600 text-white rounded-lg px-4 py-2 hover:bg-blue-700 transition-colors duration-200">
                     <i class="fas fa-check mr-2"></i>Confirmer
                 </button>
                 <button onclick="cancelSignature()" class="flex-1 bg-gray-300 text-gray-700 rounded-lg px-4 py-2 hover:bg-gray-400 transition-colors duration-200">
                     <i class="fas fa-times mr-2"></i>Annuler
                 </button>
             </div>
         </div>
     </div>
 </div>

 <!-- Modal de confirmation pour validation -->
 <div id="confirmValidationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
     <div class="flex items-center justify-center min-h-screen">
         <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
             <div class="flex items-center mb-4">
                 <div class="flex-shrink-0">
                     <i class="fas fa-check-circle text-green-500 text-2xl"></i>
                 </div>
                 <div class="ml-3">
                     <h3 class="text-lg font-medium text-gray-900">Confirmation d'approbation</h3>
                 </div>
             </div>
             <p class="text-sm text-gray-600 mb-6">
                 Êtes-vous sûr de vouloir approuver ce bon de commande ? Cette action autorisera le démarrage de l'intervention.
             </p>
             <div class="flex space-x-3">
                 <button onclick="confirmValidation()" class="flex-1 bg-green-600 text-white rounded-lg px-4 py-2 hover:bg-green-700 transition-colors duration-200">
                     <i class="fas fa-check mr-2"></i>Approuver
                 </button>
                 <button onclick="cancelValidation()" class="flex-1 bg-gray-300 text-gray-700 rounded-lg px-4 py-2 hover:bg-gray-400 transition-colors duration-200">
                     <i class="fas fa-times mr-2"></i>Annuler
                 </button>
             </div>
         </div>
     </div>
 </div>

 <!-- Modal de confirmation pour démarrage -->
 <div id="confirmStartModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
     <div class="flex items-center justify-center min-h-screen">
         <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
             <div class="flex items-center mb-4">
                 <div class="flex-shrink-0">
                     <i class="fas fa-play text-orange-500 text-2xl"></i>
                 </div>
                 <div class="ml-3">
                     <h3 class="text-lg font-medium text-gray-900">Confirmation de démarrage</h3>
                 </div>
             </div>
             <p class="text-sm text-gray-600 mb-6">
                 Êtes-vous sûr de vouloir démarrer l'intervention ? Cette action changera le statut du bon de commande.
             </p>
             <div class="flex space-x-3">
                 <button onclick="confirmStart()" class="flex-1 bg-orange-600 text-white rounded-lg px-4 py-2 hover:bg-orange-700 transition-colors duration-200">
                     <i class="fas fa-play mr-2"></i>Démarrer
                 </button>
                 <button onclick="cancelStart()" class="flex-1 bg-gray-300 text-gray-700 rounded-lg px-4 py-2 hover:bg-gray-400 transition-colors duration-200">
                     <i class="fas fa-times mr-2"></i>Annuler
                 </button>
             </div>
         </div>
     </div>
 </div>

 <!-- Modal de confirmation pour finalisation -->
 <div id="confirmFinishModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
     <div class="flex items-center justify-center min-h-screen">
         <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
             <div class="flex items-center mb-4">
                 <div class="flex-shrink-0">
                     <i class="fas fa-flag-checkered text-green-500 text-2xl"></i>
                 </div>
                 <div class="ml-3">
                     <h3 class="text-lg font-medium text-gray-900">Confirmation de finalisation</h3>
                 </div>
             </div>
             <p class="text-sm text-gray-600 mb-6">
                 Êtes-vous sûr de vouloir terminer l'intervention ? Cette action marquera l'intervention comme terminée.
             </p>
             <div class="flex space-x-3">
                 <button onclick="confirmFinish()" class="flex-1 bg-green-600 text-white rounded-lg px-4 py-2 hover:bg-green-700 transition-colors duration-200">
                     <i class="fas fa-flag-checkered mr-2"></i>Terminer
                 </button>
                 <button onclick="cancelFinish()" class="flex-1 bg-gray-300 text-gray-700 rounded-lg px-4 py-2 hover:bg-gray-400 transition-colors duration-200">
                     <i class="fas fa-times mr-2"></i>Annuler
                 </button>
             </div>
         </div>
     </div>
 </div>

 <script>
  let currentSignatureData = {};
  
  function signerBonCommande(numeroSignature, fonction) {
      currentSignatureData = {
          numero_signature: numeroSignature,
          fonction: fonction,
          signataire_id: {{ auth()->id() }}
      };
      document.getElementById('confirmSignatureModal').classList.remove('hidden');
  }

  function validerBonCommande() {
      document.getElementById('confirmValidationModal').classList.remove('hidden');
  }

  function demarrerIntervention() {
      document.getElementById('confirmStartModal').classList.remove('hidden');
  }

  function terminerIntervention() {
      document.getElementById('confirmFinishModal').classList.remove('hidden');
  }

  // Fonctions de confirmation
  function confirmSignature() {
      document.getElementById('confirmSignatureModal').classList.add('hidden');
      fetch(`/maintenance/bons-commande/{{ $bons_commande ? $bons_commande->id : '' }}/signer`, {
          method: 'POST',
          headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
              'Content-Type': 'application/json',
          },
          body: JSON.stringify(currentSignatureData)
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
          showErrorModal('Erreur lors de la signature');
      });
  }

  function confirmValidation() {
      document.getElementById('confirmValidationModal').classList.add('hidden');
      fetch(`/maintenance/bons-commande/{{ $bons_commande ? $bons_commande->id : '' }}/valider`, {
          method: 'POST',
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
          showErrorModal('Erreur lors de la validation');
      });
  }

  function confirmStart() {
      document.getElementById('confirmStartModal').classList.add('hidden');
      fetch(`/maintenance/bons-commande/{{ $bons_commande ? $bons_commande->id : '' }}/demarrer`, {
          method: 'POST',
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
          showErrorModal('Erreur lors du démarrage');
      });
  }

  function confirmFinish() {
      document.getElementById('confirmFinishModal').classList.add('hidden');
      fetch(`/maintenance/bons-commande/{{ $bons_commande ? $bons_commande->id : '' }}/terminer`, {
          method: 'POST',
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
          showErrorModal('Erreur lors de la finalisation');
      });
  }

  // Fonctions d'annulation
  function cancelSignature() {
      document.getElementById('confirmSignatureModal').classList.add('hidden');
  }

  function cancelValidation() {
      document.getElementById('confirmValidationModal').classList.add('hidden');
  }

  function cancelStart() {
      document.getElementById('confirmStartModal').classList.add('hidden');
  }

  function cancelFinish() {
      document.getElementById('confirmFinishModal').classList.add('hidden');
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

 // Fermer les modals en cliquant à l'extérieur
 document.addEventListener('DOMContentLoaded', function() {
     const modals = [
         'confirmSignatureModal',
         'confirmValidationModal', 
         'confirmStartModal',
         'confirmFinishModal',
         'successModal',
         'errorModal'
     ];

     modals.forEach(modalId => {
         const modal = document.getElementById(modalId);
         if (modal) {
             modal.addEventListener('click', function(e) {
                 if (e.target === modal) {
                     modal.classList.add('hidden');
                 }
             });
         }
     });
 });
 </script>
@endif
@endsection
