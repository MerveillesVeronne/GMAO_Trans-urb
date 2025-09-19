@extends('layouts.app')

@section('title', "GMAO Trans'urb - Détails Article")

@section('content')
    <header class="bg-green-900 shadow-xl mb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center gap-4">
            <div class="h-10 w-10 bg-white rounded-full flex items-center justify-center shadow">
                <i class="fas fa-eye text-green-800 text-xl"></i>
            </div>
            <span class="text-2xl font-bold tracking-wide text-white">Trans'urb GMAO - Détails Article</span>
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

        <!-- Informations de l'article -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Informations générales -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="px-4 py-3 bg-gradient-to-r from-green-600 to-green-700">
                    <h2 class="text-lg font-semibold text-white">
                        <i class="fas fa-info-circle mr-2"></i>Informations générales
                    </h2>
                </div>
                <div class="p-4 space-y-3">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-green-700 mb-1">Référence</label>
                            <p class="text-lg font-semibold text-green-900">{{ $piece->reference }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-green-700 mb-1">Désignation</label>
                            <p class="text-lg font-semibold text-green-900">{{ $piece->designation }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-green-700 mb-1">Catégorie</label>
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $piece->categorie }}
                            </span>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-green-700 mb-1">Marque compatible</label>
                            <p class="text-green-900">{{ $piece->marque_compatible ?: 'Non spécifiée' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-green-700 mb-1">Prix unitaire</label>
                            <p class="text-lg font-semibold text-green-900">{{ number_format($piece->prix_unitaire, 0, ',', ' ') }} FCFA</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-green-700 mb-1">Localisation</label>
                            <p class="text-green-900">{{ $piece->localisation ?: 'Non définie' }}</p>
                        </div>
                    </div>
                    
                    @if($piece->description)
                    <div class="border-t border-green-200 pt-3">
                        <label class="block text-sm font-medium text-green-700 mb-1">Description</label>
                        <p class="text-green-900">{{ $piece->description }}</p>
                    </div>
                    @endif

                    @if($piece->specifications)
                    <div class="border-t border-green-200 pt-3">
                        <label class="block text-sm font-medium text-green-700 mb-1">Spécifications</label>
                        <p class="text-green-900">{{ $piece->specifications }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Informations de stock -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="px-4 py-3 bg-gradient-to-r from-green-600 to-green-700">
                    <h2 class="text-lg font-semibold text-white">
                        <i class="fas fa-boxes mr-2"></i>Informations de stock
                    </h2>
                </div>
                <div class="p-4 space-y-3">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-green-700 mb-1">Quantité en stock</label>
                            <p class="text-2xl font-bold text-green-900">{{ $piece->quantite_stock }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-green-700 mb-1">Seuil d'alerte</label>
                            <p class="text-lg font-semibold text-green-900">{{ $piece->seuil_alerte }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-green-700 mb-1">Statut du stock</label>
                            @if($piece->en_rupture)
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                    En rupture
                                </span>
                            @elseif($piece->stock_faible)
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Stock faible
                                </span>
                            @else
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    En stock
                                </span>
                            @endif
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-green-700 mb-1">Valeur du stock</label>
                            <p class="text-lg font-semibold text-green-900">{{ number_format($piece->valeur_stock, 0, ',', ' ') }} FCFA</p>
                        </div>
                    </div>
                    
                    <div class="border-t border-green-200 pt-3">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-green-700 mb-1">Fournisseur</label>
                                <p class="text-green-900">{{ $piece->fournisseur ?: 'Non spécifié' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-green-700 mb-1">N° Fournisseur</label>
                                <p class="text-green-900">{{ $piece->numero_fournisseur ?: 'Non spécifié' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="border-t border-green-200 pt-3">
                        <h3 class="text-lg font-medium text-green-900 mb-2">Actions</h3>
                        <div class="flex space-x-2">
                            <a href="{{ route('logistique.magasin.edit', $piece->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200 text-sm">
                                <i class="fas fa-edit"></i>
                                Modifier
                            </a>
                            <button onclick="deletePiece({{ $piece->id }})" class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200 text-sm">
                                <i class="fas fa-trash"></i>
                                Supprimer
                            </button>
                            <a href="{{ route('logistique.magasin.index') }}" class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200 text-sm">
                                <i class="fas fa-list"></i>
                                Voir tous les articles
                            </a>
                        </div>
                    </div>
                </div>
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
                        alert('Article supprimé avec succès !');
                        window.location.href = '{{ route("logistique.magasin.index") }}';
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
    </script>
@endsection
