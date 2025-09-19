@extends('layouts.app')

@section('title', "GMAO Trans'urb - Gestion Magasin")

@section('content')
    <header class="bg-green-900 shadow-xl mb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center gap-4">
            <div class="h-10 w-10 bg-white rounded-full flex items-center justify-center shadow">
                <i class="fas fa-warehouse text-green-800 text-xl"></i>
            </div>
            <span class="text-2xl font-bold tracking-wide text-white">Trans'urb GMAO - Gestion du Magasin</span>
        </div>
    </header>

    <!-- Statistiques -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white rounded-lg shadow p-4 flex flex-col items-center border-l-4 border-green-700">
                <span class="text-green-900 font-bold text-xl">{{ $stats['total'] }}</span>
                <span class="text-green-800 mt-1 text-sm">Total</span>
            </div>
            <div class="bg-white rounded-lg shadow p-4 flex flex-col items-center border-l-4 border-green-500">
                <span class="text-green-900 font-bold text-xl">{{ $stats['en_stock'] }}</span>
                <span class="text-green-800 mt-1 text-sm">En Stock</span>
            </div>
            <div class="bg-white rounded-lg shadow p-4 flex flex-col items-center border-l-4 border-green-400">
                <span class="text-green-900 font-bold text-xl">{{ $stats['stock_faible'] }}</span>
                <span class="text-green-800 mt-1 text-sm">Stock Faible</span>
            </div>
            <div class="bg-white rounded-lg shadow p-4 flex flex-col items-center border-l-4 border-green-300">
                <span class="text-green-900 font-bold text-xl">{{ $stats['en_rupture'] }}</span>
                <span class="text-green-800 mt-1 text-sm">En Rupture</span>
            </div>
        </div>
    </div>

    <!-- Liste des pièces -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-green-900">
                <i class="fas fa-list text-green-700 mr-2"></i>
                Gestion des Articles du Magasin
            </h3>
            <div class="flex gap-2">
                <a href="{{ route('logistique.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200 text-sm">
                    <i class="fas fa-arrow-left"></i>
                    Retour
                </a>
                <button onclick="openAddModal()" class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200 text-sm">
                    <i class="fas fa-plus"></i>
                    Ajouter un article
                </button>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-green-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Article</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Catégorie</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Stock</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Prix</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Localisation</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-green-100">
                    @forelse($pieces as $piece)
                        <tr class="hover:bg-green-50">
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center">
                                        <i class="fas fa-cog text-white text-sm"></i>
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-green-900">{{ $piece->designation }}</div>
                                        <div class="text-xs text-green-700">{{ $piece->reference }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $piece->categorie }}
                                </span>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                @if($piece->en_rupture)
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                        En rupture
                                    </span>
                                @elseif($piece->stock_faible)
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        {{ $piece->quantite_stock }}
                                    </span>
                                @else
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $piece->quantite_stock }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-green-700">
                                {{ number_format($piece->prix_unitaire, 0, ',', ' ') }} FCFA
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-green-700">
                                {{ $piece->localisation ?: 'Non définie' }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('logistique.magasin.show', $piece->id) }}" class="text-green-700 hover:text-green-900 mr-3">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('logistique.magasin.edit', $piece->id) }}" class="text-green-600 hover:text-green-900 mr-3">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="deletePiece({{ $piece->id }})" class="text-red-500 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-3 text-center text-gray-500">
                                Aucun article trouvé
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal d'ajout d'article -->
    <div id="addModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-screen overflow-y-auto">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-plus text-green-700 mr-2"></i>
                        Nouvel Article
                    </h3>
                </div>
                <form action="{{ route('logistique.magasin.store') }}" method="POST" class="p-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="reference" class="block text-sm font-medium text-gray-700 mb-2">Référence *</label>
                            <input type="text" id="reference" name="reference" value="{{ old('reference') }}" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   placeholder="Référence de l'article">
                        </div>
                        
                        <div>
                            <label for="designation" class="block text-sm font-medium text-gray-700 mb-2">Désignation *</label>
                            <input type="text" id="designation" name="designation" value="{{ old('designation') }}" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   placeholder="Nom de l'article">
                        </div>
                        
                        <div>
                            <label for="categorie" class="block text-sm font-medium text-gray-700 mb-2">Catégorie *</label>
                            <select id="categorie" name="categorie" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="">Sélectionner une catégorie</option>
                                <option value="Pièces mécaniques">Pièces mécaniques</option>
                                <option value="Pièces électriques">Pièces électriques</option>
                                <option value="Huiles et lubrifiants">Huiles et lubrifiants</option>
                                <option value="Filtres">Filtres</option>
                                <option value="Outillage">Outillage</option>
                                <option value="Consommables">Consommables</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="marque_compatible" class="block text-sm font-medium text-gray-700 mb-2">Marque compatible</label>
                            <input type="text" id="marque_compatible" name="marque_compatible" value="{{ old('marque_compatible') }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   placeholder="Marques compatibles">
                        </div>
                        
                        <div>
                            <label for="quantite_stock" class="block text-sm font-medium text-gray-700 mb-2">Quantité en stock *</label>
                            <input type="number" id="quantite_stock" name="quantite_stock" value="{{ old('quantite_stock', 0) }}" required min="0" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   placeholder="0">
                        </div>
                        
                        <div>
                            <label for="seuil_alerte" class="block text-sm font-medium text-gray-700 mb-2">Seuil d'alerte *</label>
                            <input type="number" id="seuil_alerte" name="seuil_alerte" value="{{ old('seuil_alerte', 5) }}" required min="0" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   placeholder="5">
                        </div>
                        
                        <div>
                            <label for="prix_unitaire" class="block text-sm font-medium text-gray-700 mb-2">Prix unitaire (FCFA) *</label>
                            <input type="number" id="prix_unitaire" name="prix_unitaire" value="{{ old('prix_unitaire') }}" required min="0" step="100" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   placeholder="0">
                        </div>
                        
                        <div>
                            <label for="fournisseur" class="block text-sm font-medium text-gray-700 mb-2">Fournisseur</label>
                            <input type="text" id="fournisseur" name="fournisseur" value="{{ old('fournisseur') }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   placeholder="Nom du fournisseur">
                        </div>
                        
                        <div>
                            <label for="numero_fournisseur" class="block text-sm font-medium text-gray-700 mb-2">N° Fournisseur</label>
                            <input type="text" id="numero_fournisseur" name="numero_fournisseur" value="{{ old('numero_fournisseur') }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   placeholder="Numéro de référence fournisseur">
                        </div>
                        
                        <div>
                            <label for="localisation" class="block text-sm font-medium text-gray-700 mb-2">Localisation</label>
                            <input type="text" id="localisation" name="localisation" value="{{ old('localisation') }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   placeholder="Emplacement dans le magasin">
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea id="description" name="description" rows="3" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                  placeholder="Description de l'article...">{{ old('description') }}</textarea>
                    </div>
                    
                    <div class="mt-4">
                        <label for="specifications" class="block text-sm font-medium text-gray-700 mb-2">Spécifications</label>
                        <textarea id="specifications" name="specifications" rows="3" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                  placeholder="Spécifications techniques...">{{ old('specifications') }}</textarea>
                    </div>
                    
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" onclick="closeAddModal()" 
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors duration-200">
                            Annuler
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors duration-200">
                            <i class="fas fa-save mr-2"></i>Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function deletePiece(pieceId) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cet article ?')) {
                fetch(`/logistique/magasin/${pieceId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Erreur lors de la suppression');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Erreur lors de la suppression');
                });
            }
        }

        function openAddModal() {
            document.getElementById('addModal').classList.remove('hidden');
        }

        function closeAddModal() {
            document.getElementById('addModal').classList.add('hidden');
        }
    </script>
@endsection
