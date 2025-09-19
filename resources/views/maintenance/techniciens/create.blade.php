@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-green-100">
    <!-- Header -->
    <header class="bg-gradient-to-r from-green-600 to-green-700 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="h-10 w-10 bg-white rounded-full flex items-center justify-center shadow">
                        <i class="fas fa-user-plus text-green-800 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h1 class="text-2xl font-bold tracking-wide text-white">Ajouter un technicien</h1>
                        <p class="text-green-100">Nouveau technicien de maintenance</p>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('maintenance.techniciens.index') }}" class="inline-flex items-center px-4 py-2 border border-white rounded-md shadow-sm text-sm font-medium text-white bg-transparent hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
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
                    <i class="fas fa-plus mr-2"></i>Nouveau technicien
                </h2>
            </div>
            
            <form id="technicienForm" action="{{ route('maintenance.techniciens.store') }}" method="POST" class="p-6 space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="matricule" class="block text-sm font-medium text-green-700 mb-2">
                            <i class="fas fa-id-card mr-2"></i>Matricule *
                        </label>
                        <input type="text" id="matricule" name="matricule" required 
                               class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                               placeholder="Matricule du technicien">
                    </div>
                    
                    <div>
                        <label for="nom" class="block text-sm font-medium text-green-700 mb-2">
                            <i class="fas fa-user mr-2"></i>Nom *
                        </label>
                        <input type="text" id="nom" name="nom" required 
                               class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                               placeholder="Nom du technicien">
                    </div>
                    
                    <div>
                        <label for="prenom" class="block text-sm font-medium text-green-700 mb-2">
                            <i class="fas fa-user mr-2"></i>Prénom *
                        </label>
                        <input type="text" id="prenom" name="prenom" required 
                               class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                               placeholder="Prénom du technicien">
                    </div>
                    
                    <div>
                        <label for="fonction_technique" class="block text-sm font-medium text-green-700 mb-2">
                            <i class="fas fa-tools mr-2"></i>Fonction technique *
                        </label>
                        <input type="text" id="fonction_technique" name="fonction_technique" required 
                               class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                               placeholder="Fonction technique">
                    </div>
                    
                    <div>
                        <label for="specialite" class="block text-sm font-medium text-green-700 mb-2">
                            <i class="fas fa-star mr-2"></i>Spécialité
                        </label>
                        <input type="text" id="specialite" name="specialite" 
                               class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                               placeholder="Spécialité du technicien">
                    </div>
                    
                    <div>
                        <label for="niveau_competence" class="block text-sm font-medium text-green-700 mb-2">
                            <i class="fas fa-chart-line mr-2"></i>Niveau de compétence *
                        </label>
                        <select id="niveau_competence" name="niveau_competence" required 
                                class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            <option value="">Sélectionner un niveau</option>
                            <option value="Débutant">Débutant</option>
                            <option value="Intermédiaire">Intermédiaire</option>
                            <option value="Expert">Expert</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="telephone" class="block text-sm font-medium text-green-700 mb-2">
                            <i class="fas fa-phone mr-2"></i>Téléphone *
                        </label>
                        <input type="text" id="telephone" name="telephone" required 
                               class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                               placeholder="Numéro de téléphone">
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-green-700 mb-2">
                            <i class="fas fa-envelope mr-2"></i>Email
                        </label>
                        <input type="email" id="email" name="email" 
                               class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                               placeholder="Adresse email">
                    </div>
                    
                    <div>
                        <label for="atelier" class="block text-sm font-medium text-green-700 mb-2">
                            <i class="fas fa-warehouse mr-2"></i>Atelier
                        </label>
                        <input type="text" id="atelier" name="atelier" 
                               class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                               placeholder="Atelier d'affectation">
                    </div>
                    
                    <div>
                        <label for="date_embauche" class="block text-sm font-medium text-green-700 mb-2">
                            <i class="fas fa-calendar mr-2"></i>Date d'embauche *
                        </label>
                        <input type="date" id="date_embauche" name="date_embauche" required 
                               max="{{ date('Y-m-d') }}"
                               class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    </div>
                    
                    <div>
                        <label for="statut" class="block text-sm font-medium text-green-700 mb-2">
                            <i class="fas fa-toggle-on mr-2"></i>Statut *
                        </label>
                        <select id="statut" name="statut" required 
                                class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            <option value="">Sélectionner un statut</option>
                            <option value="Actif">Actif</option>
                            <option value="Inactif">Inactif</option>
                            <option value="En Formation">En Formation</option>
                            <option value="En Congé">En Congé</option>
                        </select>
                    </div>
                </div>
                
                <div>
                    <label for="competences" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-cogs mr-2"></i>Compétences
                    </label>
                    <textarea id="competences" name="competences" rows="3" 
                              class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                              placeholder="Compétences techniques..."></textarea>
                </div>
                
                <div>
                    <label for="formations_suivies" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-graduation-cap mr-2"></i>Formations suivies
                    </label>
                    <textarea id="formations_suivies" name="formations_suivies" rows="3" 
                              class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                              placeholder="Formations et certifications..."></textarea>
                </div>
                
                <div>
                    <label for="notes" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-sticky-note mr-2"></i>Notes
                    </label>
                    <textarea id="notes" name="notes" rows="3" 
                              class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                              placeholder="Notes et observations..."></textarea>
                </div>
                
                <div class="flex justify-end space-x-3 pt-6">
                    <a href="{{ route('maintenance.techniciens.index') }}" 
                       class="px-4 py-2 border border-green-300 rounded-md shadow-sm text-sm font-medium text-green-700 bg-white hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Annuler
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <i class="fas fa-save mr-2"></i>Enregistrer
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
    document.getElementById('technicienForm').addEventListener('submit', function(e) {
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
                    window.location.href = '{{ route("maintenance.techniciens.index") }}';
                }, 2000);
            } else {
                if (data.errors) {
                    let errorMessage = 'Erreurs de validation:\n';
                    Object.keys(data.errors).forEach(field => {
                        errorMessage += `- ${data.errors[field][0]}\n`;
                    });
                    showErrorModal('Erreur de validation', errorMessage);
                } else {
                    showErrorModal('Erreur', data.message || 'Erreur lors de l\'ajout du technicien');
                }
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            showErrorModal('Erreur', 'Erreur lors de l\'ajout du technicien');
        });
    });
</script>
@endsection
