@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-green-100">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b border-green-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-tools text-3xl text-green-600"></i>
                    </div>
                    <div class="ml-4">
                        <h1 class="text-2xl font-bold text-green-900">Nouvelle Intervention</h1>
                        <p class="text-green-600">Créer une nouvelle intervention de maintenance</p>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('maintenance.interventions.index') }}" class="inline-flex items-center px-4 py-2 border border-green-300 rounded-md shadow-sm text-sm font-medium text-green-700 bg-white hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Retour
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-green-600 to-green-700">
                <h2 class="text-xl font-semibold text-white">Informations de l'intervention</h2>
            </div>
            
            <form id="interventionForm" action="{{ route('maintenance.interventions.store') }}" method="POST" class="p-6 space-y-6">
                @csrf
                
                <!-- Véhicule -->
                <div>
                    <label for="vehicule_id" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-bus mr-2"></i>Véhicule concerné
                    </label>
                    <select id="vehicule_id" name="vehicule_id" required class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        <option value="">Sélectionner un véhicule</option>
                        @foreach($vehicules as $vehicule)
                            <option value="{{ $vehicule->id }}">{{ $vehicule->numero }} - {{ $vehicule->marque }} {{ $vehicule->modele }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Type d'intervention -->
                <div>
                    <label for="type_intervention" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-wrench mr-2"></i>Type d'intervention
                    </label>
                    <select id="type_intervention" name="type_intervention" required class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        <option value="">Sélectionner le type</option>
                        <option value="Maintenance">Maintenance</option>
                        <option value="Reparation">Réparation</option>
                        <option value="Revision">Révision</option>
                        <option value="Urgence">Urgence</option>
                        <option value="Inspection">Inspection</option>
                    </select>
                </div>

                <!-- Nature d'intervention -->
                <div>
                    <label for="nature_intervention" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-cog mr-2"></i>Nature d'intervention (optionnel)
                    </label>
                    <select id="nature_intervention" name="nature_intervention" class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        <option value="">Sélectionner la nature</option>
                        <option value="Mecanique">Mécanique</option>
                        <option value="Electrique">Électrique</option>
                        <option value="Vulcanique">Vulcanique</option>
                        <option value="Tolerie">Tôlerie</option>
                        <option value="Peinture">Peinture</option>
                        <option value="Carrosserie">Carrosserie</option>
                        <option value="Chauffage">Chauffage</option>
                        <option value="Climatisation">Climatisation</option>
                        <option value="Freinage">Freinage</option>
                        <option value="Suspension">Suspension</option>
                        <option value="Transmission">Transmission</option>
                        <option value="Autre">Autre</option>
                    </select>
                </div>

                <!-- Priorité -->
                <div>
                    <label for="priorite" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-exclamation-triangle mr-2"></i>Priorité
                    </label>
                    <select id="priorite" name="priorite" required class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        <option value="Normal">Normal</option>
                        <option value="À prévoir">À prévoir</option>
                        <option value="Urgent">Urgent</option>
                    </select>
                </div>

                <!-- Statut -->
                <div>
                    <label for="statut" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-clock mr-2"></i>Statut
                    </label>
                    <select id="statut" name="statut" required class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        <option value="En Attente">En Attente</option>
                        <option value="En Cours">En Cours</option>
                        <option value="Terminee">Terminée</option>
                        <option value="Annulee">Annulée</option>
                        <option value="Livré">Livré</option>
                    </select>
                </div>

                <!-- Date de début -->
                <div>
                    <label for="date_debut" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-calendar mr-2"></i>Date de début
                    </label>
                    <input type="datetime-local" id="date_debut" name="date_debut" required class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>

                <!-- Date de fin prévue -->
                <div>
                    <label for="date_fin_prevue" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-calendar-check mr-2"></i>Date de fin prévue (optionnel)
                    </label>
                    <input type="datetime-local" id="date_fin_prevue" name="date_fin_prevue" class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>

                <!-- Technicien -->
                <div>
                    <label for="technicien" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-user-cog mr-2"></i>Technicien responsable
                    </label>
                    <select id="technicien" name="technicien" required class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        <option value="">Sélectionner un technicien</option>
                        @foreach($techniciens as $technicien)
                            <option value="{{ $technicien->nom_complet }}">{{ $technicien->nom_complet }} - {{ $technicien->fonction_technique }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-file-alt mr-2"></i>Description de l'intervention
                    </label>
                    <textarea id="description" name="description" rows="4" required placeholder="Décrivez en détail l'intervention à effectuer..." class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"></textarea>
                </div>

                <!-- Pièces nécessaires -->
                <div>
                    <label for="pieces_necessaires" class="block text-sm font-medium text-green-700 mb-2">
                        <i class="fas fa-cogs mr-2"></i>Pièces nécessaires (optionnel)
                    </label>
                    <div id="piecesContainer" class="space-y-3">
                        <div class="flex space-x-3">
                            <select name="pieces_ids[]" class="flex-1 px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                <option value="">Sélectionner une pièce</option>
                                @foreach($pieces as $piece)
                                    <option value="{{ $piece->id }}" data-stock="{{ $piece->quantite_stock }}">
                                        {{ $piece->designation }} - Stock: {{ $piece->quantite_stock }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="number" name="quantites[]" min="1" placeholder="Qté" 
                                   class="w-20 px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            <button type="button" onclick="removePiece(this)" class="px-3 py-2 text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <button type="button" onclick="addPiece()" class="mt-2 px-4 py-2 text-sm text-green-600 hover:text-green-800 border border-green-300 rounded-md hover:bg-green-50">
                        <i class="fas fa-plus mr-2"></i>Ajouter une pièce
                    </button>
                </div>

                <!-- Champ caché pour les pièces nécessaires (format texte) -->
                <input type="hidden" id="pieces_necessaires" name="pieces_necessaires">
                <input type="hidden" id="quantite_pieces" name="quantite_pieces">

                <!-- Boutons d'action -->
                <div class="flex justify-end space-x-3 pt-6 border-t border-green-200">
                    <a href="{{ route('maintenance.interventions.index') }}" class="inline-flex items-center px-4 py-2 border border-green-300 rounded-md shadow-sm text-sm font-medium text-green-700 bg-white hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <i class="fas fa-times mr-2"></i>
                        Annuler
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <i class="fas fa-save mr-2"></i>
                        Créer l'intervention
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
    document.getElementById('interventionForm').addEventListener('submit', function(e) {
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
                    window.location.href = '{{ route("maintenance.interventions.index") }}';
                }, 2000);
            } else {
                // Afficher les erreurs de validation
                if (data.errors) {
                    let errorMessage = 'Erreurs de validation:\n';
                    Object.keys(data.errors).forEach(field => {
                        errorMessage += `- ${data.errors[field][0]}\n`;
                    });
                    showErrorModal('Erreur de validation', errorMessage);
                } else {
                    showErrorModal('Erreur', data.message || 'Erreur lors de la création de l\'intervention');
                }
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            showErrorModal('Erreur', 'Erreur lors de la création de l\'intervention');
        });
    });

    // Validation en temps réel
    document.getElementById('date_fin_prevue').addEventListener('change', function() {
        const dateDebut = document.getElementById('date_debut').value;
        const dateFin = this.value;
        
        if (dateDebut && dateFin && dateFin < dateFin) {
            showErrorModal('Erreur de validation', 'La date de fin ne peut pas être antérieure à la date de début');
            this.value = '';
        }
    });

    // Fonctions pour la gestion des pièces
    function addPiece() {
        const container = document.getElementById('piecesContainer');
        const pieceDiv = document.createElement('div');
        pieceDiv.className = 'flex space-x-3';
        pieceDiv.innerHTML = `
            <select name="pieces_ids[]" class="flex-1 px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                <option value="">Sélectionner une pièce</option>
                @foreach($pieces as $piece)
                    <option value="{{ $piece->id }}" data-stock="{{ $piece->quantite_stock }}">
                        {{ $piece->designation }} - Stock: {{ $piece->quantite_stock }}
                    </option>
                @endforeach
            </select>
            <input type="number" name="quantites[]" min="1" placeholder="Qté" 
                   class="w-20 px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
            <button type="button" onclick="removePiece(this)" class="px-3 py-2 text-red-600 hover:text-red-800">
                <i class="fas fa-trash"></i>
            </button>
        `;
        container.appendChild(pieceDiv);
        updateHiddenFields();
    }

    function removePiece(button) {
        button.parentElement.remove();
        updateHiddenFields();
    }

    function updateHiddenFields() {
        const piecesSelects = document.querySelectorAll('select[name="pieces_ids[]"]');
        const quantitesInputs = document.querySelectorAll('input[name="quantites[]"]');
        const piecesNecessaires = [];
        const quantitePieces = [];

        piecesSelects.forEach((select, index) => {
            if (select.value && quantitesInputs[index] && quantitesInputs[index].value) {
                const selectedOption = select.options[select.selectedIndex];
                const pieceName = selectedOption.text.split(' - Stock:')[0];
                const quantite = quantitesInputs[index].value;
                
                piecesNecessaires.push(pieceName);
                quantitePieces.push(`${quantite} ${pieceName}`);
            }
        });

        document.getElementById('pieces_necessaires').value = piecesNecessaires.join(', ');
        document.getElementById('quantite_pieces').value = quantitePieces.join(', ');
    }

    // Mettre à jour les champs cachés quand les sélections changent
    document.addEventListener('change', function(e) {
        if (e.target.name === 'pieces_ids[]' || e.target.name === 'quantites[]') {
            updateHiddenFields();
            checkStockAvailability(e.target);
        }
    });

    // Vérifier la disponibilité du stock
    function checkStockAvailability(element) {
        if (element.name === 'pieces_ids[]') {
            const select = element;
            const quantiteInput = select.parentElement.querySelector('input[name="quantites[]"]');
            
            if (select.value && quantiteInput && quantiteInput.value) {
                const selectedOption = select.options[select.selectedIndex];
                const stockDisponible = parseInt(selectedOption.dataset.stock);
                const quantiteDemandee = parseInt(quantiteInput.value);
                
                if (quantiteDemandee > stockDisponible) {
                    quantiteInput.style.borderColor = '#ef4444';
                    quantiteInput.title = `Stock insuffisant ! Disponible: ${stockDisponible}`;
                } else {
                    quantiteInput.style.borderColor = '#10b981';
                    quantiteInput.title = '';
                }
            }
        }
    }
</script>
@endsection
