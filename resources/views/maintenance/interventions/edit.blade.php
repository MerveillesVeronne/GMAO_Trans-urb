@extends('layouts.app')
@section('title', "GMAO Trans'urb - Modifier Intervention")
@section('content')
    <header class="bg-green-900 shadow-xl mb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center gap-4">
            <div class="h-10 w-10 bg-white rounded-full flex items-center justify-center shadow">
                <i class="fas fa-tools text-green-800 text-xl"></i>
            </div>
            <span class="text-2xl font-bold tracking-wide text-white">Trans'urb GMAO - Modifier Intervention</span>
        </div>
    </header>

    <div class="max-w-4xl mx-auto">
        <!-- Bouton retour -->
        <div class="mb-6">
            <a href="{{ route('maintenance.interventions.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>
                Retour à la liste
            </a>
        </div>

        <!-- Formulaire de modification -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-green-900">
                    <i class="fas fa-edit text-green-700 mr-2"></i>
                    Modifier l'Intervention
                </h3>
            </div>
            <div class="p-6">
                <form action="{{ route('maintenance.interventions.update', $intervention->id) }}" method="POST" id="editInterventionForm">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="vehicule_id" class="block text-sm font-medium text-green-900 mb-1">Véhicule *</label>
                            <select id="vehicule_id" name="vehicule_id" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="">Sélectionner un véhicule</option>
                                @foreach($vehicules as $vehicule)
                                    <option value="{{ $vehicule->id }}" {{ $intervention->vehicule_id == $vehicule->id ? 'selected' : '' }}>
                                        {{ $vehicule->nom_complet }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="type_intervention" class="block text-sm font-medium text-green-900 mb-1">Type d'intervention *</label>
                            <select id="type_intervention" name="type_intervention" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="">Sélectionner un type</option>
                                <option value="Maintenance" {{ $intervention->type_intervention == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                                <option value="Reparation" {{ $intervention->type_intervention == 'Reparation' ? 'selected' : '' }}>Réparation</option>
                                <option value="Revision" {{ $intervention->type_intervention == 'Revision' ? 'selected' : '' }}>Révision</option>
                                <option value="Urgence" {{ $intervention->type_intervention == 'Urgence' ? 'selected' : '' }}>Urgence</option>
                                <option value="Inspection" {{ $intervention->type_intervention == 'Inspection' ? 'selected' : '' }}>Inspection</option>
                            </select>
                        </div>
                        <div>
                            <label for="nature_intervention" class="block text-sm font-medium text-green-900 mb-1">Nature d'intervention</label>
                            <select id="nature_intervention" name="nature_intervention" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="">Sélectionner la nature</option>
                                <option value="Mecanique" {{ $intervention->nature_intervention == 'Mecanique' ? 'selected' : '' }}>Mécanique</option>
                                <option value="Electrique" {{ $intervention->nature_intervention == 'Electrique' ? 'selected' : '' }}>Électrique</option>
                                <option value="Vulcanique" {{ $intervention->nature_intervention == 'Vulcanique' ? 'selected' : '' }}>Vulcanique</option>
                                <option value="Tolerie" {{ $intervention->nature_intervention == 'Tolerie' ? 'selected' : '' }}>Tôlerie</option>
                                <option value="Peinture" {{ $intervention->nature_intervention == 'Peinture' ? 'selected' : '' }}>Peinture</option>
                                <option value="Carrosserie" {{ $intervention->nature_intervention == 'Carrosserie' ? 'selected' : '' }}>Carrosserie</option>
                                <option value="Chauffage" {{ $intervention->nature_intervention == 'Chauffage' ? 'selected' : '' }}>Chauffage</option>
                                <option value="Climatisation" {{ $intervention->nature_intervention == 'Climatisation' ? 'selected' : '' }}>Climatisation</option>
                                <option value="Freinage" {{ $intervention->nature_intervention == 'Freinage' ? 'selected' : '' }}>Freinage</option>
                                <option value="Suspension" {{ $intervention->nature_intervention == 'Suspension' ? 'selected' : '' }}>Suspension</option>
                                <option value="Transmission" {{ $intervention->nature_intervention == 'Transmission' ? 'selected' : '' }}>Transmission</option>
                                <option value="Autre" {{ $intervention->nature_intervention == 'Autre' ? 'selected' : '' }}>Autre</option>
                            </select>
                        </div>
                        <div>
                            <label for="priorite" class="block text-sm font-medium text-green-900 mb-1">Priorité *</label>
                            <select id="priorite" name="priorite" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="">Sélectionner une priorité</option>
                                <option value="Normal" {{ $intervention->priorite == 'Normal' ? 'selected' : '' }}>Normal</option>
                                <option value="À prévoir" {{ $intervention->priorite == 'À prévoir' ? 'selected' : '' }}>À prévoir</option>
                                <option value="Urgent" {{ $intervention->priorite == 'Urgent' ? 'selected' : '' }}>Urgent</option>
                            </select>
                        </div>
                        <div>
                            <label for="statut" class="block text-sm font-medium text-green-900 mb-1">Statut *</label>
                            <select id="statut" name="statut" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="">Sélectionner un statut</option>
                                <option value="En Attente" {{ $intervention->statut == 'En Attente' ? 'selected' : '' }}>En Attente</option>
                                <option value="En Cours" {{ $intervention->statut == 'En Cours' ? 'selected' : '' }}>En Cours</option>
                                <option value="Terminee" {{ $intervention->statut == 'Terminee' ? 'selected' : '' }}>Terminée</option>
                                <option value="Annulee" {{ $intervention->statut == 'Annulee' ? 'selected' : '' }}>Annulée</option>
                                <option value="Livré" {{ $intervention->statut == 'Livré' ? 'selected' : '' }}>Livré</option>
                            </select>
                        </div>
                        <div>
                            <label for="date_debut" class="block text-sm font-medium text-green-900 mb-1">Date de début *</label>
                            <input type="datetime-local" id="date_debut" name="date_debut" 
                                   value="{{ $intervention->date_debut->format('Y-m-d\TH:i') }}" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        </div>
                        <div>
                            <label for="date_fin_prevue" class="block text-sm font-medium text-green-900 mb-1">Date de fin prévue</label>
                            <input type="datetime-local" id="date_fin_prevue" name="date_fin_prevue" 
                                   value="{{ $intervention->date_fin_prevue ? $intervention->date_fin_prevue->format('Y-m-d\TH:i') : '' }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        </div>
                        <!-- Technicien -->
                        <div>
                            <label for="technicien" class="block text-sm font-medium text-green-700 mb-2">
                                <i class="fas fa-user-cog mr-2"></i>Technicien responsable
                            </label>
                            <select id="technicien" name="technicien" required class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                <option value="">Sélectionner un technicien</option>
                                @foreach($techniciens as $technicien)
                                    <option value="{{ $technicien->nom_complet }}" {{ $intervention->technicien == $technicien->nom_complet ? 'selected' : '' }}>
                                        {{ $technicien->nom_complet }} - {{ $technicien->fonction_technique }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-green-700 mb-2">
                                <i class="fas fa-file-alt mr-2"></i>Description de l'intervention
                            </label>
                            <textarea id="description" name="description" rows="4" required class="w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">{{ $intervention->description }}</textarea>
                        </div>
                    
                    <div class="mt-6">
                        <label for="pieces_necessaires" class="block text-sm font-medium text-green-900 mb-1">Pièces nécessaires</label>
                        <div id="piecesContainer" class="space-y-3">
                            @if($intervention->pieces_necessaires)
                                @php
                                    $piecesArray = explode(', ', $intervention->pieces_necessaires);
                                    $quantitesArray = $intervention->quantite_pieces ? explode(', ', $intervention->quantite_pieces) : [];
                                @endphp
                                @foreach($piecesArray as $index => $pieceName)
                                    <div class="flex space-x-3">
                                        <select name="pieces_ids[]" class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                            <option value="">Sélectionner une pièce</option>
                                            @foreach($pieces as $piece)
                                                <option value="{{ $piece->id }}" data-stock="{{ $piece->quantite_stock }}" {{ trim($pieceName) === $piece->designation ? 'selected' : '' }}>
                                                    {{ $piece->designation }} - Stock: {{ $piece->quantite_stock }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="number" name="quantites[]" min="1" placeholder="Qté" 
                                               class="w-20 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                               value="{{ isset($quantitesArray[$index]) ? preg_replace('/[^0-9]/', '', $quantitesArray[$index]) : '' }}">
                                        <button type="button" onclick="removePiece(this)" class="px-3 py-2 text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                @endforeach
                            @else
                                <div class="flex space-x-3">
                                    <select name="pieces_ids[]" class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                        <option value="">Sélectionner une pièce</option>
                                        @foreach($pieces as $piece)
                                            <option value="{{ $piece->id }}" data-stock="{{ $piece->quantite_stock }}">
                                                {{ $piece->designation }} - Stock: {{ $piece->quantite_stock }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="number" name="quantites[]" min="1" placeholder="Qté" 
                                           class="w-20 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                    <button type="button" onclick="removePiece(this)" class="px-3 py-2 text-red-600 hover:text-red-800">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <button type="button" onclick="addPiece()" class="mt-2 px-4 py-2 text-sm text-green-600 hover:text-green-800 border border-green-300 rounded-md hover:bg-green-50">
                            <i class="fas fa-plus mr-2"></i>Ajouter une pièce
                        </button>
                    </div>

                    <!-- Champ caché pour les pièces nécessaires (format texte) -->
                    <input type="hidden" id="pieces_necessaires" name="pieces_necessaires" value="{{ $intervention->pieces_necessaires }}">
                    <input type="hidden" id="quantite_pieces" name="quantite_pieces" value="{{ $intervention->quantite_pieces }}">
                    
                    <div class="flex justify-end space-x-3 pt-6">
                        <a href="{{ route('maintenance.interventions.index') }}" 
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
    </div>

    <!-- Modal de notification de succès -->
    <div id="successModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                    <i class="fas fa-check text-green-600 text-xl"></i>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4" id="successTitle">Succès !</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500" id="successMessage"></p>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="closeSuccessModal" class="px-4 py-2 bg-green-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de notification d'erreur -->
    <div id="errorModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                    <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4" id="errorTitle">Erreur !</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500" id="errorMessage"></p>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="closeErrorModal" class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                        OK
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
        document.getElementById('editInterventionForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Mettre à jour les champs cachés avant l'envoi
            updateHiddenFields();
            
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
                        showErrorModal('Erreur', data.message || 'Erreur lors de la mise à jour de l\'intervention');
                    }
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                showErrorModal('Erreur', 'Erreur lors de la mise à jour de l\'intervention');
            });
        });

        // Fonctions pour la gestion des pièces
        function addPiece() {
            const container = document.getElementById('piecesContainer');
            const pieceDiv = document.createElement('div');
            pieceDiv.className = 'flex space-x-3';
            pieceDiv.innerHTML = `
                <select name="pieces_ids[]" class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    <option value="">Sélectionner une pièce</option>
                    @foreach($pieces as $piece)
                        <option value="{{ $piece->id }}" data-stock="{{ $piece->quantite_stock }}">
                            {{ $piece->designation }} - Stock: {{ $piece->quantite_stock }}
                        </option>
                    @endforeach
                </select>
                <input type="number" name="quantites[]" min="1" placeholder="Qté" 
                       class="w-20 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
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
