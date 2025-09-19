@extends('layouts.app')

@section('title', "GMAO Trans'urb - Modifier un Article")

@section('content')
    <header class="bg-green-900 shadow-xl mb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center gap-4">
            <div class="h-10 w-10 bg-white rounded-full flex items-center justify-center shadow">
                <i class="fas fa-edit text-green-800 text-xl"></i>
            </div>
            <span class="text-2xl font-bold tracking-wide text-white">Trans'urb GMAO - Modifier un Article</span>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Bouton retour -->
        <div class="mb-4">
            <a href="{{ route('logistique.magasin.index') }}" class="inline-flex items-center px-3 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200 text-sm">
                <i class="fas fa-arrow-left mr-2"></i>
                Retour à la liste
            </a>
        </div>

        <!-- Formulaire -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-green-900">
                    <i class="fas fa-edit text-green-700 mr-2"></i>
                    Modifier l'Article : {{ $piece->designation }}
                </h3>
            </div>
            
            <form action="{{ route('logistique.magasin.update', $piece->id) }}" method="POST" class="p-4">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="reference" class="block text-sm font-medium text-gray-700 mb-2">Référence *</label>
                        <input type="text" id="reference" name="reference" value="{{ old('reference', $piece->reference) }}" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                               placeholder="Référence de l'article">
                        @error('reference')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="designation" class="block text-sm font-medium text-gray-700 mb-2">Désignation *</label>
                        <input type="text" id="designation" name="designation" value="{{ old('designation', $piece->designation) }}" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                               placeholder="Nom de l'article">
                        @error('designation')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="categorie" class="block text-sm font-medium text-gray-700 mb-2">Catégorie *</label>
                        <select id="categorie" name="categorie" required 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <option value="">Sélectionner une catégorie</option>
                            <option value="Pièces mécaniques" {{ old('categorie', $piece->categorie) == 'Pièces mécaniques' ? 'selected' : '' }}>Pièces mécaniques</option>
                            <option value="Pièces électriques" {{ old('categorie', $piece->categorie) == 'Pièces électriques' ? 'selected' : '' }}>Pièces électriques</option>
                            <option value="Huiles et lubrifiants" {{ old('categorie', $piece->categorie) == 'Huiles et lubrifiants' ? 'selected' : '' }}>Huiles et lubrifiants</option>
                            <option value="Filtres" {{ old('categorie', $piece->categorie) == 'Filtres' ? 'selected' : '' }}>Filtres</option>
                            <option value="Outillage" {{ old('categorie', $piece->categorie) == 'Outillage' ? 'selected' : '' }}>Outillage</option>
                            <option value="Consommables" {{ old('categorie', $piece->categorie) == 'Consommables' ? 'selected' : '' }}>Consommables</option>
                        </select>
                        @error('categorie')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="marque_compatible" class="block text-sm font-medium text-gray-700 mb-2">Marque compatible</label>
                        <input type="text" id="marque_compatible" name="marque_compatible" value="{{ old('marque_compatible', $piece->marque_compatible) }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                               placeholder="Marques compatibles">
                        @error('marque_compatible')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="quantite_stock" class="block text-sm font-medium text-gray-700 mb-2">Quantité en stock *</label>
                        <input type="number" id="quantite_stock" name="quantite_stock" value="{{ old('quantite_stock', $piece->quantite_stock) }}" required min="0" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                               placeholder="0">
                        @error('quantite_stock')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="seuil_alerte" class="block text-sm font-medium text-gray-700 mb-2">Seuil d'alerte *</label>
                        <input type="number" id="seuil_alerte" name="seuil_alerte" value="{{ old('seuil_alerte', $piece->seuil_alerte) }}" required min="0" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                               placeholder="5">
                        @error('seuil_alerte')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="prix_unitaire" class="block text-sm font-medium text-gray-700 mb-2">Prix unitaire (FCFA) *</label>
                        <input type="number" id="prix_unitaire" name="prix_unitaire" value="{{ old('prix_unitaire', $piece->prix_unitaire) }}" required min="0" step="100" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                               placeholder="0">
                        @error('prix_unitaire')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="fournisseur" class="block text-sm font-medium text-gray-700 mb-2">Fournisseur</label>
                        <input type="text" id="fournisseur" name="fournisseur" value="{{ old('fournisseur', $piece->fournisseur) }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                               placeholder="Nom du fournisseur">
                        @error('fournisseur')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="numero_fournisseur" class="block text-sm font-medium text-gray-700 mb-2">N° Fournisseur</label>
                        <input type="text" id="numero_fournisseur" name="numero_fournisseur" value="{{ old('numero_fournisseur', $piece->numero_fournisseur) }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                               placeholder="Numéro de référence fournisseur">
                        @error('numero_fournisseur')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="localisation" class="block text-sm font-medium text-gray-700 mb-2">Localisation</label>
                        <input type="text" id="localisation" name="localisation" value="{{ old('localisation', $piece->localisation) }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                               placeholder="Emplacement dans le magasin">
                        @error('localisation')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="mt-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea id="description" name="description" rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                              placeholder="Description de l'article...">{{ old('description', $piece->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mt-4">
                    <label for="specifications" class="block text-sm font-medium text-gray-700 mb-2">Spécifications</label>
                    <textarea id="specifications" name="specifications" rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                              placeholder="Spécifications techniques...">{{ old('specifications', $piece->specifications) }}</textarea>
                    @error('specifications')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex justify-end space-x-3 pt-4">
                    <a href="{{ route('logistique.magasin.index') }}" 
                       class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors duration-200">
                        Annuler
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors duration-200">
                        <i class="fas fa-save mr-2"></i>Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
