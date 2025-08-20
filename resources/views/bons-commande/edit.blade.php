@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header avec menu harmonisé -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                <i class="fas fa-edit mr-2 text-green-600"></i>Modifier le Bon de commande
            </h1>
            <div class="flex space-x-2">
                <a href="{{ route('bons-commande.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>Retour
                </a>
                <a href="{{ route('bons-commande.show', $bonCommande) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200">
                    <i class="fas fa-eye mr-2"></i>Voir détails
                </a>
            </div>
        </div>

        <!-- Menu secondaire harmonisé -->
        <div class="bg-gray-50 rounded-lg p-4 mb-6">
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('bons-commande.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded-md text-sm transition duration-200">
                    <i class="fas fa-plus mr-1"></i>Nouveau Bon de commande
                </a>
                <a href="{{ route('bons-commande.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-md text-sm transition duration-200">
                    <i class="fas fa-list mr-1"></i>Liste Bons de commande
                </a>
                <a href="{{ route('nouvelle.commande') }}" class="bg-indigo-500 hover:bg-indigo-600 text-white px-3 py-2 rounded-md text-sm transition duration-200">
                    <i class="fas fa-shopping-cart mr-1"></i>Nouvelle Commande
                </a>
                <a href="{{ route('liste.commandes') }}" class="bg-purple-500 hover:bg-purple-600 text-white px-3 py-2 rounded-md text-sm transition duration-200">
                    <i class="fas fa-list-alt mr-1"></i>Liste des Commandes
                </a>
                <a href="{{ route('commandes.paiements') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-md text-sm transition duration-200">
                    <i class="fas fa-credit-card mr-1"></i>Paiements
                </a>
            </div>
        </div>
    </div>

    <!-- Formulaire d'édition -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('bons-commande.update', $bonCommande) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Informations générales -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="titre" class="block text-sm font-medium text-gray-700 mb-2">Titre du bon de commande *</label>
                    <input type="text" id="titre" name="titre" value="{{ old('titre', $bonCommande->titre) }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    @error('titre')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="budget_total" class="block text-sm font-medium text-gray-700 mb-2">Budget total (FCFA) *</label>
                    <input type="number" id="budget_total" name="budget_total" step="0.01" value="{{ old('budget_total', $bonCommande->budget_total) }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    @error('budget_total')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="date_besoin" class="block text-sm font-medium text-gray-700 mb-2">Date de besoin *</label>
                    <input type="date" id="date_besoin" name="date_besoin" value="{{ old('date_besoin', $bonCommande->date_besoin) }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    @error('date_besoin')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="statut" class="block text-sm font-medium text-gray-700 mb-2">Statut</label>
                    <select id="statut" name="statut" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="en_attente" {{ $bonCommande->statut == 'en_attente' ? 'selected' : '' }}>En attente</option>
                        <option value="partiellement_satisfait" {{ $bonCommande->statut == 'partiellement_satisfait' ? 'selected' : '' }}>Partiellement satisfait</option>
                        <option value="satisfait" {{ $bonCommande->statut == 'satisfait' ? 'selected' : '' }}>Satisfait</option>
                        <option value="annule" {{ $bonCommande->statut == 'annule' ? 'selected' : '' }}>Annulé</option>
                    </select>
                    @error('statut')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                <textarea id="description" name="description" rows="3" 
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>{{ old('description', $bonCommande->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="commentaires" class="block text-sm font-medium text-gray-700 mb-2">Commentaires</label>
                <textarea id="commentaires" name="commentaires" rows="2" 
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('commentaires', $bonCommande->commentaires) }}</textarea>
                @error('commentaires')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Lignes du bon de commande -->
            <div class="mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">
                        <i class="fas fa-list mr-2 text-blue-600"></i>Lignes du bon de commande
                    </h3>
                    <button type="button" id="ajouterLigne" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md transition duration-200">
                        <i class="fas fa-plus mr-2"></i>Ajouter une ligne
                    </button>
                </div>

                <div id="lignesContainer">
                    @foreach($bonCommande->lignes as $index => $ligne)
                    <div class="ligne-item bg-gray-50 rounded-lg p-4 mb-4 border border-gray-200">
                        <div class="flex justify-between items-center mb-3">
                            <h4 class="font-medium text-gray-700">Ligne {{ $index + 1 }}</h4>
                            <button type="button" class="supprimerLigne bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-sm transition duration-200">
                                <i class="fas fa-trash mr-1"></i>Supprimer
                            </button>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Produit *</label>
                                <input type="text" name="lignes[{{ $index }}][produit]" value="{{ $ligne->produit }}" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Quantité demandée *</label>
                                <input type="number" name="lignes[{{ $index }}][quantite_demandee]" value="{{ $ligne->quantite_demandee }}" min="1"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Coût unitaire estimé (FCFA) *</label>
                                <input type="number" name="lignes[{{ $index }}][cout_unitaire_estime]" value="{{ $ligne->cout_unitaire_estime }}" step="0.01" min="0"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Unité *</label>
                                <input type="text" name="lignes[{{ $index }}][unite]" value="{{ $ligne->unite }}" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
                            </div>
                        </div>
                        
                        <div class="mt-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea name="lignes[{{ $index }}][description]" rows="2" 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">{{ $ligne->description }}</textarea>
                        </div>
                        
                        <input type="hidden" name="lignes[{{ $index }}][id]" value="{{ $ligne->id }}">
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('bons-commande.show', $bonCommande) }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition duration-200">
                    Annuler
                </a>
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg transition duration-200">
                    <i class="fas fa-save mr-2"></i>Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let ligneIndex = {{ count($bonCommande->lignes) }};
    
    // Ajouter une nouvelle ligne
    document.getElementById('ajouterLigne').addEventListener('click', function() {
        const container = document.getElementById('lignesContainer');
        const nouvelleLigne = document.createElement('div');
        nouvelleLigne.className = 'ligne-item bg-gray-50 rounded-lg p-4 mb-4 border border-gray-200';
        nouvelleLigne.innerHTML = `
            <div class="flex justify-between items-center mb-3">
                <h4 class="font-medium text-gray-700">Ligne ${ligneIndex + 1}</h4>
                <button type="button" class="supprimerLigne bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-sm transition duration-200">
                    <i class="fas fa-trash mr-1"></i>Supprimer
                </button>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Produit *</label>
                    <input type="text" name="lignes[${ligneIndex}][produit]" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Quantité demandée *</label>
                    <input type="number" name="lignes[${ligneIndex}][quantite_demandee]" min="1"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Coût unitaire estimé (FCFA) *</label>
                    <input type="number" name="lignes[${ligneIndex}][cout_unitaire_estime]" step="0.01" min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Unité *</label>
                    <input type="text" name="lignes[${ligneIndex}][unite]" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
                </div>
            </div>
            
            <div class="mt-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="lignes[${ligneIndex}][description]" rows="2" 
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
            </div>
        `;
        
        container.appendChild(nouvelleLigne);
        ligneIndex++;
        
        // Ajouter l'événement de suppression à la nouvelle ligne
        nouvelleLigne.querySelector('.supprimerLigne').addEventListener('click', function() {
            nouvelleLigne.remove();
        });
    });
    
    // Supprimer une ligne existante
    document.querySelectorAll('.supprimerLigne').forEach(function(button) {
        button.addEventListener('click', function() {
            this.closest('.ligne-item').remove();
        });
    });
});
</script>
@endsection 