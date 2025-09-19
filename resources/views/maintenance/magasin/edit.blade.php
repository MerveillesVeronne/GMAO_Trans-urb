@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-green-100">
    <!-- Header -->
    <header class="bg-gradient-to-r from-green-600 to-green-700 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="h-10 w-10 bg-white rounded-full flex items-center justify-center shadow">
                        <i class="fas fa-warehouse text-green-800 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h1 class="text-2xl font-bold tracking-wide text-white">Modifier l'article</h1>
                        <p class="text-green-100">{{ $piece->designation }}</p>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('maintenance.magasin.index') }}" class="inline-flex items-center px-4 py-2 border border-white rounded-md shadow-sm text-sm font-medium text-white bg-transparent hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Retour
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Formulaire -->
    <div class="max-w-4xl mx-auto mt-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-green-600 to-green-700">
                <h2 class="text-xl font-semibold text-white">
                    <i class="fas fa-edit mr-2"></i>Modifier l'article
                </h2>
            </div>
            
            <form id="pieceForm" action="{{ route('maintenance.magasin.update', $piece->id) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="reference" class="block text-sm font-medium text-green-700 mb-2">
                            <i class="fas fa-barcode mr-2"></i>Référence *
                        </label>
                        <input type="text" id="reference" name="reference" required 
                               value="{{ $piece->reference }}"
                               class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                               placeholder="Référence de l'article">
                    </div>
                    
                    <div>
                        <label for="designation" class="block text-sm font-medium text-green-700 mb-2">
                            <i class="fas fa-tag mr-2"></i>Désignation *
                        </label>
                        <input type="text" id="designation" name="designation" required 
                               value="{{ $piece->designation }}"
                               class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                               placeholder="Nom de l'article">
                    </div>
                    
                    <div>
                        <label for="categorie" class="block text-sm font-medium text-green-700 mb-2">
                            <i class="fas fa-folder mr-2"></i>Catégorie *
                        </label>
                        <select id="categorie" name="categorie" required 
                                class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            <option value="">Sélectionner une catégorie</option>
                            <option value="Pièces mécaniques" {{ $piece->categorie == 'Pièces mécaniques' ? 'selected' : '' }}>Pièces mécaniques</option>
                            <option value="Pièces électriques" {{ $piece->categorie == 'Pièces électriques' ? 'selected' : '' }}>Pièces électriques</option>
                            <option value="Huiles et lubrifiants" {{ $piece->categorie == 'Huiles et lubrifiants' ? 'selected' : '' }}>Huiles et lubrifiants</option>
                            <option value="Filtres" {{ $piece->categorie == 'Filtres' ? 'selected' : '' }}>Filtres</option>
                            <option value="Outillage" {{ $piece->categorie == 'Outillage' ? 'selected' : '' }}>Outillage</option>
                            <option value="Consommables" {{ $piece->categorie == 'Consommables' ? 'selected' : '' }}>Consommables</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="marque_compatible" class="block text-sm font-medium text-green-700 mb-2">
                            <i class="fas fa-cogs mr-2"></i>Marque compatible
                        </label>
                        <input type="text" id="marque_compatible" name="marque_compatible" 
                               value="{{ $piece->marque_compatible }}"
                               class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                               placeholder="Marques compatibles">
                    </div>
                    
                    <div>
                        <label for="quantite_stock" class="block text-sm font-medium text-green-700 mb-2">
                            <i class="fas fa-boxes mr-2"></i>Quantité en stock *
                        </label>
                        <input type="number" id="quantite_stock" name="quantite_stock" required min="0" 
                               value="{{ $piece->quantite_stock }}"
                               class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                               placeholder="0">
                    </div>
                    
                    <div>
                        <label for="seuil_alerte" class="block text-sm font-medium text-green-700 mb-2">
                            <i class="fas fa-exclamation-triangle mr-2"></i>Seuil d'alerte *
                        </label>
                        <input type="number" id="seuil_alerte" name="seuil_alerte" required min="0" 
                               value="{{ $piece->seuil_alerte }}"
                               class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                               placeholder="0">
                    </div>
                    
                    <div>
                        <label for="prix_unitaire" class="block text-sm font-medium text-green-700 mb-2">
                            <i class="fas fa-money-bill mr-2"></i>Prix unitaire (FCFA) *
                        </label>
                        <input type="number" id="prix_unitaire" name="prix_unitaire" required min="0" step="100" 
                               value="{{ $piece->prix_unitaire }}"
                               class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                               placeholder="0">
                    </div>
                    
                    <div>
                        <label for="fournisseur" class="block text-sm font-medium text-green-700 mb-2">
                            <i class="fas fa-truck mr-2"></i>Fournisseur
                        </label>
                        <input type="text" id="fournisseur" name="fournisseur" 
                               value="{{ $piece->fournisseur }}"
                               class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                               placeholder="Nom du fournisseur">
                    </div>
                    
                    <div>
                        <label for="numero_fournisseur" class="block text-sm font-medium text-green-700 mb-2">
                            <i class="fas fa-hashtag mr-2"></i>N° Fournisseur
                        </label>
                        <input type="text" id="numero_fournisseur" name="numero_fournisseur" 
                               value="{{ $piece->numero_fournisseur }}"
                               class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                               placeholder="Numéro de référence fournisseur">
                    </div>
                    
                    <div>
                        <label for="localisation" class="block text-sm font-medium text-green-700 mb-2">
                            <i class="fas fa-map-marker-alt mr-2"></i>Localisation
                        </label>
                        <input type="text" id="localisation" name="localisation" 
                               value="{{ $piece->localisation }}"
                               class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                               placeholder="Emplacement dans le magasin">
                    </div>
                </div>
                
                <div>
                    <label for="description" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-file-alt mr-2"></i>Description
                    </label>
                    <textarea id="description" name="description" rows="3" 
                              class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                              placeholder="Description de l'article...">{{ $piece->description }}</textarea>
                </div>
                
                <div>
                    <label for="specifications" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-cogs mr-2"></i>Spécifications
                    </label>
                    <textarea id="specifications" name="specifications" rows="3" 
                              class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                              placeholder="Spécifications techniques...">{{ $piece->specifications }}</textarea>
                </div>
                
                <div class="flex justify-end space-x-3 pt-6">
                    <a href="{{ route('maintenance.magasin.index') }}" 
                       class="px-4 py-2 border border-green-300 rounded-md shadow-sm text-sm font-medium text-green-700 bg-white hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Annuler
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <i class="fas fa-save mr-2"></i>Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de succès -->
<div id="successModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                <i class="fas fa-check text-green-600 text-xl"></i>
            </div>
            <h3 id="successTitle" class="text-lg font-medium text-gray-900 mt-4">Succès !</h3>
            <div class="mt-2 px-7 py-3">
                <p id="successMessage" class="text-sm text-gray-500"></p>
            </div>
            <div class="items-center px-4 py-3">
                <button id="closeSuccessModal" class="px-4 py-2 bg-green-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
                    OK
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal d'erreur -->
<div id="errorModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
            </div>
            <h3 id="errorTitle" class="text-lg font-medium text-gray-900 mt-4">Erreur</h3>
            <div class="mt-2 px-7 py-3">
                <p id="errorMessage" class="text-sm text-gray-500"></p>
            </div>
            <div class="items-center px-4 py-3">
                <button id="closeErrorModal" class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                    Fermer
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

    // Gestion du formulaire
    document.getElementById('pieceForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);

        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showSuccessModal('Succès !', data.message);
                setTimeout(() => {
                    closeSuccessModal();
                    window.location.href = '{{ route("maintenance.magasin.index") }}';
                }, 2000);
            } else {
                if (data.errors) {
                    let errorMessage = 'Erreurs de validation:\n';
                    Object.keys(data.errors).forEach(field => {
                        errorMessage += `- ${data.errors[field][0]}\n`;
                    });
                    showErrorModal('Erreur de validation', errorMessage);
                } else {
                    showErrorModal('Erreur', data.message || 'Erreur lors de la mise à jour de l\'article');
                }
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            showErrorModal('Erreur', 'Erreur lors de la mise à jour de l\'article');
        });
    });
</script>
@endsection
