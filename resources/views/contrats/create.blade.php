<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouveau Contrat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700&display=swap" rel="stylesheet" />
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            background: #f5f5f5; 
            margin: 0; 
        }
        .header-bg { 
            background: #17423b; 
            color: #fff; 
            padding-bottom: 90px; 
            position: relative; 
            box-shadow: 0 2px 8px rgba(23,66,59,0.08); 
        }
        .main-navbar { 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            padding: 0 2.5rem; 
            height: 64px; 
        }
        .main-navbar .nav-link { 
            color: #e6f4ee; 
            font-weight: 500; 
            border-radius: 8px; 
            padding: 0.5rem 1.2rem; 
            transition: background 0.2s, color 0.2s; 
        }
        .main-navbar .nav-link.active, .main-navbar .nav-link:hover { 
            background: #1e5c4a; 
            color: #fff; 
        }
        .main-navbar .profile-box { 
            background: #1e5c4a; 
            border-radius: 12px; 
            padding: 0.5rem 1rem; 
            display: flex; 
            align-items: center; 
            gap: 0.7rem; 
        }
        .main-navbar .profile-box .fa-user-circle { 
            font-size: 1.7rem; 
            color: #ffe082; 
        }
        .welcome-banner { 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            padding: 2.2rem 2.5rem 1.2rem 2.5rem; 
        }
        .welcome-banner .greeting { 
            font-size: 1.5rem; 
            font-weight: 600; 
        }
        .welcome-banner .subtitle { 
            font-size: 1rem; 
            color: #c8e6d6; 
        }
        .container { 
            max-width: 1400px; 
            margin: 40px auto; 
            background: #fff; 
            border-radius: 18px; 
            box-shadow: 0 2px 12px rgba(0,0,0,0.1); 
            padding: 2.5rem; 
            position: relative; 
            z-index: 10; 
        }
        .back-btn { 
            display: inline-block; 
            margin-bottom: 1.5rem; 
            color: #219150; 
            text-decoration: none; 
            font-weight: 600; 
        }
        .back-btn i { 
            margin-right: 6px; 
        }
        
        /* Styles pour le formulaire */
        .form-section {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid #e9ecef;
        }
        
        .form-section-title {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
            color: #17423b;
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        .form-section-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.9rem;
        }
        
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }
        
        .form-group {
            display: flex;
            flex-direction: column;
        }
        
        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }
        
        .form-label.required::after {
            content: " *";
            color: #ef4444;
        }
        
        .form-input {
            padding: 0.75rem 1rem;
            border: 2px solid #d1d5db;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.2s;
            background: white;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #219150;
            box-shadow: 0 0 0 3px rgba(33, 145, 80, 0.1);
        }
        
        .form-select {
            padding: 0.75rem 1rem;
            border: 2px solid #d1d5db;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.2s;
            background: white;
            cursor: pointer;
        }
        
        .form-select:focus {
            outline: none;
            border-color: #219150;
            box-shadow: 0 0 0 3px rgba(33, 145, 80, 0.1);
        }
        
        .form-textarea {
            padding: 0.75rem 1rem;
            border: 2px solid #d1d5db;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.2s;
            background: white;
            resize: vertical;
            min-height: 100px;
        }
        
        .form-textarea:focus {
            outline: none;
            border-color: #219150;
            box-shadow: 0 0 0 3px rgba(33, 145, 80, 0.1);
        }
        
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e5e7eb;
            margin-top: 1.5rem;
        }
        
        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }
        
        .btn-secondary {
            background: #f3f4f6;
            color: #374151;
            border: 1px solid #d1d5db;
        }
        
        .btn-secondary:hover {
            background: #e5e7eb;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #219150 0%, #1e5c4a 100%);
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(33, 145, 80, 0.3);
        }
        
        .error-message {
            color: #ef4444;
            font-size: 0.8rem;
            margin-top: 0.25rem;
        }
        
        .info-message {
            color: #3b82f6;
            font-size: 0.8rem;
            margin-top: 0.25rem;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="header-bg">
        <nav class="main-navbar">
            <div class="flex items-center gap-4">
                <div class="h-10 w-10 bg-white rounded-full flex items-center justify-center shadow">
                    <i class="fas fa-bus text-green-800 text-xl"></i>
                </div>
                <span class="text-xl font-bold tracking-wide">Trans'urb GMAO</span>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('dashboard.moyens-generaux') }}" class="nav-link"><i class="fas fa-cogs mr-2"></i>Moyens Généraux</a>
                <a href="{{ route('dashboard.maintenance') }}" class="nav-link"><i class="fas fa-wrench mr-2"></i>Maintenance</a>
                <a href="{{ route('dashboard.logistique') }}" class="nav-link"><i class="fas fa-clipboard-list mr-2"></i>Logistique</a>
                <a href="{{ route('chauffeur.fdt') }}" class="nav-link"><i class="fas fa-clipboard-check mr-2"></i>Chauffeurs</a>
            </div>
            <div class="profile-box">
                <i class="fas fa-user-circle"></i>
                <div>
                    <div class="font-semibold">{{ Auth::user()->nom_complet ?? 'Utilisateur' }}</div>
                    <div class="text-xs text-green-100">{{ Auth::user()->role->nom_role ?? '' }}</div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="inline ml-2">
                    @csrf
                    <button type="submit" class="text-white hover:text-yellow-400 transition-colors p-1 rounded-lg" title="Se déconnecter">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </nav>
        <div class="welcome-banner">
            <div>
                <div class="greeting">Nouveau Contrat</div>
                <div class="subtitle" style="color: #ffe082;">Créer un nouveau partenariat</div>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-file-contract" style="font-size: 2.5rem; color: #ffe082;"></i>
            </div>
        </div>
    </div>
    
    <div class="container">
        <a href="{{ route('liste.contrats') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i>Retour à la liste
        </a>
        
        <form method="POST" action="{{ route('contrats.store') }}">
            @csrf
            
            <!-- Informations principales -->
            <div class="form-section">
                <div class="form-section-title">
                    <div class="form-section-icon" style="background: #219150;">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <span>Informations principales</span>
                </div>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="intitule" class="form-label required">Intitulé du contrat</label>
                        <input type="text" id="intitule" name="intitule" class="form-input" required value="{{ old('intitule') }}" placeholder="Ex: Contrat de maintenance informatique">
                        @error('intitule')<div class="error-message">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="fournisseur_id" class="form-label required">Fournisseur</label>
                        <select id="fournisseur_id" name="fournisseur_id" class="form-select" required>
                            <option value="">Sélectionner un fournisseur</option>
                            @foreach($fournisseurs ?? [] as $fournisseur)
                                <option value="{{ $fournisseur->id }}" {{ old('fournisseur_id') == $fournisseur->id ? 'selected' : '' }}>
                                    {{ $fournisseur->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('fournisseur_id')<div class="error-message">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="categorie" class="form-label required">Catégorie</label>
                        <select id="categorie" name="categorie" class="form-select" required>
                            <option value="">Sélectionner une catégorie</option>
                            @foreach(App\Models\Contrat::getCategories() as $key => $label)
                                <option value="{{ $key }}" {{ old('categorie') == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('categorie')<div class="error-message">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="statut" class="form-label required">Statut</label>
                        <select id="statut" name="statut" class="form-select" required>
                            <option value="">Sélectionner un statut</option>
                            <option value="actif" {{ old('statut') == 'actif' ? 'selected' : '' }}>✅ Actif</option>
                            <option value="suspendu" {{ old('statut') == 'suspendu' ? 'selected' : '' }}>⏸️ Suspendu</option>
                            <option value="renouvele" {{ old('statut') == 'renouvele' ? 'selected' : '' }}>🔄 Renouvelé</option>
                            <option value="resilie" {{ old('statut') == 'resilie' ? 'selected' : '' }}>❌ Résilié</option>
                            <option value="expire" {{ old('statut') == 'expire' ? 'selected' : '' }}>⏰ Expiré</option>
                        </select>
                        @error('statut')<div class="error-message">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
            
            <!-- Dates et montant -->
            <div class="form-section">
                <div class="form-section-title">
                    <div class="form-section-icon" style="background: #3b82f6;">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <span>Dates et montant</span>
                </div>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="date_debut" class="form-label required">Date de début</label>
                        <input type="date" id="date_debut" name="date_debut" class="form-input" required value="{{ old('date_debut') }}">
                        @error('date_debut')<div class="error-message">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="form-group" id="periodicite-section" style="display: none;">
                        <label for="periodicite" class="form-label required">Périodicité</label>
                        <select id="periodicite" name="periodicite" class="form-select" required>
                            <option value="">Sélectionner une périodicité</option>
                            @foreach(App\Models\Contrat::getPeriodicites() as $key => $label)
                                <option value="{{ $key }}" {{ old('periodicite') == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('periodicite')<div class="error-message">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="form-group" id="duree-group">
                        <label for="duree" id="duree-label" class="form-label required">Durée (en mois)</label>
                        <input type="number" id="duree" name="duree" class="form-input" value="{{ old('duree') }}" min="1" placeholder="12">
                        @error('duree')<div class="error-message">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="montant" id="montant-label" class="form-label required">Montant (FCFA)</label>
                        <input type="number" id="montant" name="montant" class="form-input" required value="{{ old('montant') }}" min="0" step="0.01" placeholder="500000">
                        @error('montant')<div class="error-message">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
            
            <!-- Description -->
            <div class="form-section">
                <div class="form-section-title">
                    <div class="form-section-icon" style="background: #8b5cf6;">
                        <i class="fas fa-align-left"></i>
                    </div>
                    <span>Description</span>
                </div>
                
                <div class="form-group">
                    <label for="description" class="form-label">Description du contrat</label>
                    <textarea id="description" name="description" class="form-textarea" placeholder="Décrivez les détails du contrat, les conditions, les obligations...">{{ old('description') }}</textarea>
                    @error('description')<div class="error-message">{{ $message }}</div>@enderror
                </div>
            </div>
            
            <!-- Actions -->
            <div class="form-actions">
                <a href="{{ route('liste.contrats') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i>
                    Annuler
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Enregistrer le contrat
                </button>
            </div>
        </form>
    </div>

    <script>
        // Données des catégories avec périodicité
        const categoriesAvecPeriodicite = @json(App\Models\Contrat::getCategoriesAvecPeriodicite());
         
        // Catégories non-suspendables (doivent être automatiquement actives)
        const categoriesNonSuspendables = @json(App\Models\Contrat::getCategoriesNonSuspendables());
        
        function updatePeriodicite() {
            const categorieSelect = document.getElementById('categorie');
            const periodiciteSection = document.getElementById('periodicite-section');
            const dureeGroup = document.getElementById('duree-group');
            const dureeInput = document.getElementById('duree');
            const montantLabel = document.getElementById('montant-label');
            const selectedCategorie = categorieSelect.value;
            
            // Pour les catégories avec périodicité, masquer le champ durée (contrats à durée indéterminée)
            if (selectedCategorie && categoriesAvecPeriodicite.includes(selectedCategorie)) {
                periodiciteSection.style.display = 'block';
                dureeGroup.style.display = 'none'; // Masquer la durée pour les contrats à durée indéterminée
                dureeInput.disabled = true; // Désactiver le champ pour qu'il ne soit pas envoyé
                dureeInput.value = ''; // Vider la valeur
                
                // Changer le label du montant pour indiquer que c'est par période
                montantLabel.textContent = 'Montant par période (FCFA)';
            } else {
                periodiciteSection.style.display = 'none';
                dureeGroup.style.display = 'block'; // Afficher la durée pour les autres contrats
                dureeInput.disabled = false; // Réactiver le champ
                
                // Remettre le label du montant pour indiquer que c'est le montant total
                montantLabel.textContent = 'Montant total (FCFA)';
            }
        }
        
        function updateStatutAutomatique() {
            const categorieSelect = document.getElementById('categorie');
            const statutSelect = document.getElementById('statut');
            const selectedCategorie = categorieSelect.value;
            
            // Si la catégorie est non-suspendable, masquer l'option "Suspendu"
            if (selectedCategorie && categoriesNonSuspendables.includes(selectedCategorie)) {
                // Masquer l'option "Suspendu" pour les contrats non-suspendables
                const suspenduOption = statutSelect.querySelector('option[value="suspendu"]');
                if (suspenduOption) {
                    suspenduOption.style.display = 'none';
                    suspenduOption.disabled = true;
                }
                
                // Si le statut actuel est "suspendu", le changer à "actif"
                if (statutSelect.value === 'suspendu') {
                    statutSelect.value = 'actif';
                }
                
                // Ajouter une classe visuelle pour indiquer que c'est un contrat non-suspendable
                statutSelect.style.backgroundColor = '#fef3c7';
                statutSelect.style.borderColor = '#f59e0b';
                
                // Ajouter un message d'information
                let infoMessage = document.getElementById('statut-info');
                if (!infoMessage) {
                    infoMessage = document.createElement('div');
                    infoMessage.id = 'statut-info';
                    infoMessage.className = 'info-message';
                    infoMessage.style.color = '#92400e';
                    infoMessage.style.fontSize = '0.875rem';
                    infoMessage.style.marginTop = '0.5rem';
                    statutSelect.parentNode.appendChild(infoMessage);
                }
                infoMessage.textContent = 'ℹ️ Ce type de contrat ne peut pas être suspendu (option masquée)';
                
            } else {
                // Réactiver l'option "Suspendu" pour les contrats normaux
                const suspenduOption = statutSelect.querySelector('option[value="suspendu"]');
                if (suspenduOption) {
                    suspenduOption.style.display = '';
                    suspenduOption.disabled = false;
                }
                
                // Réactiver le select et retirer les styles
                statutSelect.style.backgroundColor = '';
                statutSelect.style.borderColor = '';
                
                // Supprimer le message d'information
                const infoMessage = document.getElementById('statut-info');
                if (infoMessage) {
                    infoMessage.remove();
                }
            }
        }
        
        function updateDuree() {
            const periodiciteSelect = document.getElementById('periodicite');
            const dureeInput = document.getElementById('duree');
            const dureeLabel = document.getElementById('duree-label');
            const selectedPeriodicite = periodiciteSelect.value;
            
            // Mettre à jour le label et le placeholder selon la périodicité
            switch(selectedPeriodicite) {
                case 'journaliere':
                    dureeLabel.textContent = 'Durée (en jours)';
                    dureeInput.placeholder = '30';
                    dureeInput.min = '1';
                    break;
                case 'hebdomadaire':
                    dureeLabel.textContent = 'Durée (en semaines)';
                    dureeInput.placeholder = '4';
                    dureeInput.min = '1';
                    break;
                case 'mensuelle':
                    dureeLabel.textContent = 'Durée (en mois)';
                    dureeInput.placeholder = '12';
                    dureeInput.min = '1';
                    break;
                case 'trimestrielle':
                    dureeLabel.textContent = 'Durée (en trimestres)';
                    dureeInput.placeholder = '4';
                    dureeInput.min = '1';
                    break;
                case 'semestrielle':
                    dureeLabel.textContent = 'Durée (en semestres)';
                    dureeInput.placeholder = '2';
                    dureeInput.min = '1';
                    break;
                case 'annuelle':
                    dureeLabel.textContent = 'Durée (en années)';
                    dureeInput.placeholder = '1';
                    dureeInput.min = '1';
                    break;
                default:
                    dureeLabel.textContent = 'Durée (en mois)';
                    dureeInput.placeholder = '12';
                    dureeInput.min = '1';
            }
        }
        
        // Initialiser au chargement de la page
        document.addEventListener('DOMContentLoaded', function() {
            updatePeriodicite();
            updateStatutAutomatique();
            
            // Ajouter les event listeners
            document.getElementById('categorie').addEventListener('change', function() {
                updatePeriodicite();
                updateStatutAutomatique();
            });
            
            const periodiciteSelect = document.getElementById('periodicite');
            if (periodiciteSelect) {
                periodiciteSelect.addEventListener('change', updateDuree);
            }
            
            // Gérer la soumission du formulaire
            document.querySelector('form').addEventListener('submit', function(e) {
                const categorie = document.getElementById('categorie').value;
                const categoriesAvecPeriodicite = @json(App\Models\Contrat::getCategoriesAvecPeriodicite());
                
                // Si c'est un contrat avec périodicité, s'assurer que la durée n'est pas requise
                if (categoriesAvecPeriodicite.includes(categorie)) {
                    const dureeInput = document.getElementById('duree');
                    dureeInput.removeAttribute('required');
                    dureeInput.disabled = true;
                }
            });
        });
    </script>
</body>
</html> 