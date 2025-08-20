<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouveau Fournisseur</title>
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
                <div class="greeting">Nouveau Fournisseur</div>
                <div class="subtitle" style="color: #ffe082;">Ajouter un nouveau partenaire</div>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-building" style="font-size: 2.5rem; color: #ffe082;"></i>
            </div>
        </div>
    </div>
    
    <div class="container">
        <a href="{{ route('liste.fournisseurs') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i>Retour à la liste
        </a>
        
        <form method="POST" action="{{ route('ajouter.fournisseur') }}">
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
                        <label for="nom" class="form-label required">Nom du fournisseur</label>
                        <input type="text" id="nom" name="nom" class="form-input" required value="{{ old('nom') }}" placeholder="Ex: Entreprise ABC">
                        @error('nom')<div class="error-message">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="email" class="form-label required">Email</label>
                        <input type="email" id="email" name="email" class="form-input" required value="{{ old('email') }}" placeholder="contact@entreprise.com">
                        @error('email')<div class="error-message">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="telephone" class="form-label required">Téléphone</label>
                        <input type="text" id="telephone" name="telephone" class="form-input" required value="{{ old('telephone') }}" placeholder="+225 0123456789">
                        @error('telephone')<div class="error-message">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="type" class="form-label">Type de fournisseur</label>
                        <select id="type" name="type" class="form-select">
                            <option value="">Sélectionner un type</option>
                            <option value="equipement" {{ old('type') == 'equipement' ? 'selected' : '' }}>Équipement</option>
                            <option value="service" {{ old('type') == 'service' ? 'selected' : '' }}>Service</option>
                            <option value="materiel" {{ old('type') == 'materiel' ? 'selected' : '' }}>Matériel</option>
                            <option value="logiciel" {{ old('type') == 'logiciel' ? 'selected' : '' }}>Logiciel</option>
                            <option value="autre" {{ old('type') == 'autre' ? 'selected' : '' }}>Autre</option>
                        </select>
                        @error('type')<div class="error-message">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
            
            <!-- Adresse -->
            <div class="form-section">
                <div class="form-section-title">
                    <div class="form-section-icon" style="background: #3b82f6;">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <span>Adresse</span>
                </div>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="adresse" class="form-label">Adresse</label>
                        <input type="text" id="adresse" name="adresse" class="form-input" value="{{ old('adresse') }}" placeholder="123 Rue de la Paix">
                        @error('adresse')<div class="error-message">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="ville" class="form-label">Ville</label>
                        <input type="text" id="ville" name="ville" class="form-input" value="{{ old('ville') }}" placeholder="Abidjan">
                        @error('ville')<div class="error-message">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="pays" class="form-label">Pays</label>
                        <input type="text" id="pays" name="pays" class="form-input" value="{{ old('pays') }}" placeholder="Côte d'Ivoire">
                        @error('pays')<div class="error-message">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="responsable" class="form-label">Responsable</label>
                        <input type="text" id="responsable" name="responsable" class="form-input" value="{{ old('responsable') }}" placeholder="Nom du responsable">
                        @error('responsable')<div class="error-message">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
            
            <!-- Actions -->
            <div class="form-actions">
                <a href="{{ route('liste.fournisseurs') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i>
                    Annuler
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Enregistrer le fournisseur
                </button>
            </div>
        </form>
    </div>
</body>
</html> 