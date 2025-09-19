@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-green-100">
    <!-- Header -->
    <header class="bg-gradient-to-r from-green-600 to-green-700 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center">
                <div class="h-10 w-10 bg-white rounded-full flex items-center justify-center shadow">
                    <i class="fas fa-user-cog text-green-800 text-xl"></i>
                </div>
                <span class="text-2xl font-bold tracking-wide text-white ml-4">Trans'urb GMAO - Techniciens</span>
            </div>
        </div>
    </header>

    <!-- Statistiques -->
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-6 mb-8 mt-8">
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center border-l-4 border-green-700">
            <span class="text-green-900 font-bold text-2xl">{{ $stats['total'] ?? 0 }}</span>
            <span class="text-green-800 mt-2">Total</span>
        </div>
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center border-l-4 border-green-500">
            <span class="text-green-900 font-bold text-2xl">{{ $stats['actifs'] ?? 0 }}</span>
            <span class="text-green-800 mt-2">Actifs</span>
        </div>
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center border-l-4 border-green-400">
            <span class="text-green-900 font-bold text-2xl">{{ $stats['experts'] ?? 0 }}</span>
            <span class="text-green-800 mt-2">Experts</span>
        </div>
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center border-l-4 border-green-300">
            <span class="text-green-900 font-bold text-2xl">{{ $stats['en_formation'] ?? 0 }}</span>
            <span class="text-green-800 mt-2">En Formation</span>
        </div>
    </div>

    <!-- Liste des techniciens -->
    <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-green-900">
                <i class="fas fa-list text-green-700 mr-2"></i>
                Liste des Techniciens
            </h3>
            <button onclick="openModal()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200">
                <i class="fas fa-plus"></i>
                Ajouter un technicien
            </button>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-green-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Technicien</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Fonction</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Niveau</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Statut</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Contact</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-green-100">
                    @forelse($techniciens as $technicien)
                        <tr class="hover:bg-green-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-green-900">{{ $technicien->nom_complet }}</div>
                                        <div class="text-sm text-green-700">{{ $technicien->matricule }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $technicien->fonction_technique }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $niveauColors = [
                                        'Débutant' => 'bg-yellow-100 text-yellow-800',
                                        'Intermédiaire' => 'bg-orange-100 text-orange-800',
                                        'Expert' => 'bg-green-100 text-green-800'
                                    ];
                                    $niveauColor = $niveauColors[$technicien->niveau_competence] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $niveauColor }}">
                                    {{ $technicien->niveau_competence }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $statusColors = [
                                        'Actif' => 'bg-green-100 text-green-800',
                                        'Inactif' => 'bg-red-100 text-red-800',
                                        'En Formation' => 'bg-blue-100 text-blue-800',
                                        'En Congé' => 'bg-yellow-100 text-yellow-800'
                                    ];
                                    $statusColor = $statusColors[$technicien->statut] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $statusColor }}">
                                    {{ $technicien->statut }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-700">
                                <div>{{ $technicien->telephone }}</div>
                                @if($technicien->email)
                                    <div class="text-xs text-green-600">{{ $technicien->email }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('maintenance.techniciens.show', $technicien->id) }}" class="text-green-700 hover:text-green-900 mr-3">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('maintenance.techniciens.edit', $technicien->id) }}" class="text-green-600 hover:text-green-900 mr-3">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="deleteTechnicien({{ $technicien->id }})" class="text-red-500 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                Aucun technicien trouvé
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Ajouter un technicien -->
<div id="technicienModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-green-900">Ajouter un technicien</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form id="technicienForm" action="{{ route('maintenance.techniciens.store') }}" method="POST" class="space-y-4">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="matricule" class="block text-sm font-medium text-green-900 mb-1">Matricule *</label>
                        <input type="text" id="matricule" name="matricule" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                               placeholder="Ex: TECH001">
                    </div>
                    <div>
                        <label for="nom" class="block text-sm font-medium text-green-900 mb-1">Nom *</label>
                        <input type="text" id="nom" name="nom" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                               placeholder="Nom du technicien">
                    </div>
                    <div>
                        <label for="prenom" class="block text-sm font-medium text-green-900 mb-1">Prénom *</label>
                        <input type="text" id="prenom" name="prenom" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                               placeholder="Prénom du technicien">
                    </div>
                    <div>
                        <label for="fonction_technique" class="block text-sm font-medium text-green-900 mb-1">Fonction technique *</label>
                        <input type="text" id="fonction_technique" name="fonction_technique" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                               placeholder="Ex: Mécanicien, Électricien">
                    </div>
                    <div>
                        <label for="niveau_competence" class="block text-sm font-medium text-green-900 mb-1">Niveau de compétence *</label>
                        <select id="niveau_competence" name="niveau_competence" required 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <option value="">Sélectionner un niveau</option>
                            <option value="Débutant">Débutant</option>
                            <option value="Intermédiaire">Intermédiaire</option>
                            <option value="Expert">Expert</option>
                        </select>
                    </div>
                    <div>
                        <label for="statut" class="block text-sm font-medium text-green-900 mb-1">Statut *</label>
                        <select id="statut" name="statut" required 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <option value="">Sélectionner un statut</option>
                            <option value="Actif">Actif</option>
                            <option value="Inactif">Inactif</option>
                            <option value="En Formation">En Formation</option>
                            <option value="En Congé">En Congé</option>
                        </select>
                    </div>
                    <div>
                        <label for="telephone" class="block text-sm font-medium text-green-900 mb-1">Téléphone *</label>
                        <input type="text" id="telephone" name="telephone" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                               placeholder="Numéro de téléphone">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-green-900 mb-1">Email</label>
                        <input type="email" id="email" name="email" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                               placeholder="Email du technicien">
                    </div>
                    <div>
                        <label for="date_embauche" class="block text-sm font-medium text-green-900 mb-1">Date d'embauche *</label>
                        <input type="date" id="date_embauche" name="date_embauche" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>
                    <div>
                        <label for="atelier" class="block text-sm font-medium text-green-900 mb-1">Atelier</label>
                        <input type="text" id="atelier" name="atelier" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                               placeholder="Atelier d'affectation">
                    </div>
                </div>
                
                <div>
                    <label for="specialite" class="block text-sm font-medium text-green-900 mb-1">Spécialité</label>
                    <input type="text" id="specialite" name="specialite" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                           placeholder="Spécialité technique">
                </div>
                
                <div>
                    <label for="competences" class="block text-sm font-medium text-green-900 mb-1">Compétences</label>
                    <textarea id="competences" name="competences" rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                              placeholder="Liste des compétences..."></textarea>
                </div>
                
                <div>
                    <label for="formations_suivies" class="block text-sm font-medium text-green-900 mb-1">Formations suivies</label>
                    <textarea id="formations_suivies" name="formations_suivies" rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                              placeholder="Formations suivies..."></textarea>
                </div>
                
                <div>
                    <label for="notes" class="block text-sm font-medium text-green-900 mb-1">Notes</label>
                    <textarea id="notes" name="notes" rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                              placeholder="Notes supplémentaires..."></textarea>
                </div>
                
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" onclick="closeModal()" 
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
    function openModal() {
        document.getElementById('technicienModal').classList.remove('hidden');
    }
    
    function closeModal() {
        document.getElementById('technicienModal').classList.add('hidden');
    }
    
    // Fermer le modal en cliquant à l'extérieur
    document.getElementById('technicienModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
    
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
                    window.location.reload();
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

    function deleteTechnicien(id) {
        if (confirm('Êtes-vous sûr de vouloir supprimer ce technicien ?')) {
            fetch(`/maintenance/techniciens/${id}`, {
                method: 'DELETE',
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
                        window.location.reload();
                    }, 2000);
                } else {
                    showErrorModal('Erreur', data.message || 'Erreur lors de la suppression');
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                showErrorModal('Erreur', 'Erreur lors de la suppression');
            });
        }
    }
</script>
@endsection
