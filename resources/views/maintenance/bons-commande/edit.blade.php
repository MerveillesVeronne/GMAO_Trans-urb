@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-green-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-3xl font-bold text-white">Modifier le Bon de Commande</h1>
                    <p class="text-green-100 mt-1">Édition du bon de commande {{ $bons_commande->reference }}</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('maintenance.bons-commande.show', $bons_commande) }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>Retour
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('maintenance.bons-commande.update', $bons_commande) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Informations de base -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-900 border-b pb-2">Informations de base</h3>
                        
                        <div>
                            <label for="reference" class="block text-sm font-medium text-gray-700 mb-1">Référence</label>
                            <input type="text" id="reference" name="reference" value="{{ $bons_commande->reference }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" readonly>
                        </div>

                        <div>
                            <label for="chauffeur" class="block text-sm font-medium text-gray-700 mb-1">Chauffeur</label>
                            <input type="text" id="chauffeur" name="chauffeur" value="{{ $bons_commande->chauffeur }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        </div>

                        <div>
                            <label for="date_besoin" class="block text-sm font-medium text-gray-700 mb-1">Date de besoin</label>
                            <input type="datetime-local" id="date_besoin" name="date_besoin" 
                                   value="{{ $bons_commande->date_besoin ? $bons_commande->date_besoin->format('Y-m-d\TH:i') : '' }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        </div>

                        <div>
                            <label for="date_debut_prevue" class="block text-sm font-medium text-gray-700 mb-1">Date de début prévue</label>
                            <input type="datetime-local" id="date_debut_prevue" name="date_debut_prevue" 
                                   value="{{ $bons_commande->date_debut_prevue ? $bons_commande->date_debut_prevue->format('Y-m-d\TH:i') : '' }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        </div>

                        <div>
                            <label for="date_fin_prevue" class="block text-sm font-medium text-gray-700 mb-1">Date de fin prévue</label>
                            <input type="datetime-local" id="date_fin_prevue" name="date_fin_prevue" 
                                   value="{{ $bons_commande->date_fin_prevue ? $bons_commande->date_fin_prevue->format('Y-m-d\TH:i') : '' }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        </div>
                    </div>

                    <!-- Informations de l'intervention -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-900 border-b pb-2">Informations de l'intervention</h3>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Intervention</label>
                            <div class="px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg">
                                <a href="{{ route('maintenance.interventions.show', $bons_commande->intervention->id) }}" 
                                   class="text-green-600 hover:text-green-900">
                                    Intervention #{{ $bons_commande->intervention->id }}
                                </a>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Véhicule</label>
                            <div class="px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg">
                                <a href="{{ route('maintenance.vehicules.show', $bons_commande->vehicule->id) }}" 
                                   class="text-green-600 hover:text-green-900">
                                    {{ $bons_commande->vehicule->nom_complet }}
                                </a>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Type d'intervention</label>
                            <div class="px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg">
                                {{ $bons_commande->intervention->type_intervention }}
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Technicien</label>
                            <div class="px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg">
                                {{ $bons_commande->intervention->technicien }}
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Priorité</label>
                            <div class="px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg">
                                {{ $bons_commande->intervention->priorite }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Motif et pièces -->
                <div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <label for="motif_intervention" class="block text-sm font-medium text-gray-700 mb-1">Motif de l'intervention</label>
                        <textarea id="motif_intervention" name="motif_intervention" rows="4" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">{{ $bons_commande->motif_intervention }}</textarea>
                    </div>

                    <div>
                        <label for="pieces_necessaires" class="block text-sm font-medium text-gray-700 mb-1">Pièces nécessaires</label>
                        <textarea id="pieces_necessaires" name="pieces_necessaires" rows="4" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">{{ $bons_commande->pieces_necessaires }}</textarea>
                    </div>
                </div>

                <!-- Notes -->
                <div class="mt-6">
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Notes supplémentaires</label>
                    <textarea id="notes" name="notes" rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">{{ $bons_commande->notes }}</textarea>
                </div>

                <!-- Statut actuel (lecture seule) -->
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Statut actuel</label>
                    <div class="px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                            {{ $bons_commande->statut === 'En Attente' ? 'bg-yellow-100 text-yellow-800' : 
                               ($bons_commande->statut === 'Signé' ? 'bg-blue-100 text-blue-800' : 
                               ($bons_commande->statut === 'Approuvé' ? 'bg-green-100 text-green-800' : 
                               ($bons_commande->statut === 'En Cours' ? 'bg-orange-100 text-orange-800' : 
                               'bg-gray-100 text-gray-800'))) }}">
                            {{ $bons_commande->statut }}
                        </span>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="mt-8 flex justify-end space-x-3">
                    <a href="{{ route('maintenance.bons-commande.show', $bons_commande) }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors duration-200">
                        <i class="fas fa-times mr-2"></i>Annuler
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                        <i class="fas fa-save mr-2"></i>Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

