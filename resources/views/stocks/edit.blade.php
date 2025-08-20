<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GMAO Trans'urb - Modifier Produit</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #eafaf4;
            min-height: 100vh;
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
        .main-navbar .nav-link:hover {
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
        .welcome-banner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 2.2rem 2.5rem 1.2rem 2.5rem;
        }
        .greeting {
            font-size: 1.6rem;
            font-weight: 600;
        }
        .subtitle {
            font-size: 1rem;
            color: #ffe082;
        }
        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            margin-top: -60px;
            margin-bottom: 2.5rem;
            z-index: 20;
            position: relative;
        }
        .menu-btn {
            background: none;
            border: none;
            border-radius: 12px;
            padding: 0.7rem 1.7rem;
            font-size: 1.1rem;
            font-weight: 600;
            color: #17423b;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: background 0.2s, color 0.2s;
        }
        .menu-btn:hover {
            background: #eafaf4;
            color: #1e5c4a;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            left: 0;
            top: 110%;
            min-width: 220px;
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 8px 32px rgba(23,66,59,0.13);
            z-index: 20;
            padding: 0.5rem 0;
        }
        .menu-dropdown:hover .dropdown-content {
            display: block;
        }
        .dropdown-item {
            width: 100%;
            background: none;
            border: none;
            text-align: left;
            padding: 0.8rem 1.5rem;
            font-size: 1rem;
            color: #17423b;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.18s, color 0.18s;
            display: flex;
            align-items: center;
            gap: 0.7rem;
        }
        .dropdown-item:hover {
            background: #eafaf4;
            color: #1e5c4a;
        }
        .content-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(23,66,59,0.13);
            padding: 2.5rem;
            margin-bottom: 2rem;
        }
        .btn-primary {
            background: #1e5c4a;
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-primary:hover {
            background: #17423b;
        }
        .btn-secondary {
            background: #6b7280;
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-secondary:hover {
            background: #4b5563;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }
        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.2s;
        }
        .form-input:focus {
            outline: none;
            border-color: #1e5c4a;
            box-shadow: 0 0 0 3px rgba(30, 92, 74, 0.1);
        }
        .form-textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            min-height: 100px;
            resize: vertical;
            transition: border-color 0.2s;
        }
        .form-textarea:focus {
            outline: none;
            border-color: #1e5c4a;
            box-shadow: 0 0 0 3px rgba(30, 92, 74, 0.1);
        }
        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .help-text {
            color: #6b7280;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .stock-info {
            background: #f3f4f6;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }
        .stock-info h4 {
            color: #1e5c4a;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .stock-info p {
            color: #6b7280;
            font-size: 0.875rem;
            margin: 0.25rem 0;
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
                <div class="greeting">Modifier le Produit</div>
                <div class="subtitle">Mise à jour des informations du stock</div>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-edit" style="font-size: 2.5rem; color: #ffe082;"></i>
            </div>
        </div>
    </div>

    <!-- Menu secondaire harmonisé -->
    <div class="main-content">
        <div class="menu-bar" style="background: #fff; border-radius: 16px; box-shadow: 0 2px 12px rgba(23,66,59,0.08); padding: 0.7rem 2.5rem; display: flex; justify-content: center; gap: 2.5rem; margin-bottom: 2rem;">
            <!-- Commandes -->
            <div class="menu-dropdown" style="position: relative;">
                <button class="menu-btn">
                    <i class="fas fa-shopping-cart mr-2 text-blue-600"></i>Commandes <i class="fas fa-chevron-down ml-1"></i>
                </button>
                <ul class="dropdown-content">
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('nouvelle.commande') }}'"><i class="fas fa-plus mr-2"></i>Nouvelle Commande</button></li>
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('liste.commandes') }}'"><i class="fas fa-list mr-2"></i>Liste Commandes</button></li>
                </ul>
            </div>
            <!-- Stocks -->
            <div class="menu-dropdown" style="position: relative;">
                <button class="menu-btn">
                    <i class="fas fa-boxes mr-2 text-indigo-600"></i>Stocks <i class="fas fa-chevron-down ml-1"></i>
                </button>
                <ul class="dropdown-content">
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('stocks.create') }}'"><i class="fas fa-plus mr-2"></i>Nouveau Produit</button></li>
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('stocks.index') }}'"><i class="fas fa-list mr-2"></i>Liste Stocks</button></li>
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('stocks.dashboard') }}'"><i class="fas fa-chart-bar mr-2"></i>Tableau de bord</button></li>
                </ul>
            </div>
            <!-- Loyers & Charges -->
            <div class="menu-dropdown" style="position: relative;">
                <button class="menu-btn">
                    <i class="fas fa-building mr-2 text-purple-600"></i>Loyers & Charges <i class="fas fa-chevron-down ml-1"></i>
                </button>
                <ul class="dropdown-content">
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('nouveau.loyer') }}'"><i class="fas fa-plus mr-2"></i>Nouveau Loyer/Charge</button></li>
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('liste.loyers') }}'"><i class="fas fa-list mr-2"></i>Liste Loyers/Charges</button></li>
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('loyers.echeances') }}'"><i class="fas fa-calendar mr-2"></i>Échéances</button></li>
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('loyers.paiements') }}'"><i class="fas fa-credit-card mr-2"></i>Paiements</button></li>
                </ul>
            </div>
            <!-- Contrats -->
            <div class="menu-dropdown" style="position: relative;">
                <button class="menu-btn">
                    <i class="fas fa-file-contract mr-2 text-green-600"></i>Contrats <i class="fas fa-chevron-down ml-1"></i>
                </button>
                <ul class="dropdown-content">
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('contrats.create') }}'"><i class="fas fa-plus mr-2"></i>Nouveau Contrat</button></li>
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('liste.contrats') }}'"><i class="fas fa-list mr-2"></i>Liste Contrats</button></li>
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('contrats.echeances') }}'"><i class="fas fa-calendar mr-2"></i>Échéances</button></li>
                </ul>
            </div>
            <!-- Fournisseurs -->
            <div class="menu-dropdown" style="position: relative;">
                <button class="menu-btn">
                    <i class="fas fa-truck mr-2 text-orange-600"></i>Fournisseurs <i class="fas fa-chevron-down ml-1"></i>
                </button>
                <ul class="dropdown-content">
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('fournisseurs.create') }}'"><i class="fas fa-plus mr-2"></i>Nouveau Fournisseur</button></li>
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('liste.fournisseurs') }}'"><i class="fas fa-list mr-2"></i>Liste Fournisseurs</button></li>
                    <li><button class="dropdown-item" onclick="window.location.href='#'"><i class="fas fa-star mr-2"></i>Évaluations</button></li>
                </ul>
            </div>
        </div>

        <!-- Messages d'erreur -->
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Informations du produit -->
        <div class="content-card">
            <div class="stock-info">
                <h4><i class="fas fa-info-circle mr-2"></i>Informations actuelles</h4>
                <p><strong>Référence:</strong> {{ $stock->reference_unique }}</p>
                <p><strong>Produit:</strong> {{ $stock->produit }}</p>
                <p><strong>Stock actuel:</strong> {{ $stock->quantite_disponible }} {{ $stock->unite }}</p>
                <p><strong>Statut:</strong> 
                    @if($stock->isEnAlerte())
                        <span style="color: #ef4444; font-weight: 600;">En alerte</span>
                    @else
                        <span style="color: #10b981; font-weight: 600;">Stock suffisant</span>
                    @endif
                </p>
            </div>

            <h3 class="text-xl font-bold text-gray-900 mb-6">Modifier les informations</h3>
            
            <form method="POST" action="{{ route('stocks.update', $stock) }}">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-group">
                        <label class="form-label">Nom du produit *</label>
                        <input type="text" name="produit" value="{{ old('produit', $stock->produit) }}" 
                               class="form-input" placeholder="Ex: Huile moteur 5W30" required>
                        @error('produit')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Catégorie</label>
                        <input type="text" name="categorie" value="{{ old('categorie', $stock->categorie) }}" 
                               class="form-input" placeholder="Ex: Lubrifiants, Pièces détachées...">
                        @error('categorie')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Quantité disponible *</label>
                        <input type="number" name="quantite_disponible" value="{{ old('quantite_disponible', $stock->quantite_disponible) }}" 
                               class="form-input" min="0" required>
                        @error('quantite_disponible')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Quantité minimale (seuil d'alerte) *</label>
                        <input type="number" name="quantite_minimale" value="{{ old('quantite_minimale', $stock->quantite_minimale) }}" 
                               class="form-input" min="0" required>
                        <div class="help-text">Le système vous alertera quand le stock atteindra ce niveau</div>
                        @error('quantite_minimale')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Unité de mesure *</label>
                        <input type="text" name="unite" value="{{ old('unite', $stock->unite) }}" 
                               class="form-input" placeholder="Ex: litres, pièces, kg..." required>
                        @error('unite')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Coût unitaire (FCFA)</label>
                        <input type="number" name="cout_unitaire" value="{{ old('cout_unitaire', $stock->cout_unitaire) }}" 
                               class="form-input" step="0.01" min="0" placeholder="0.00">
                        @error('cout_unitaire')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group md:col-span-2">
                        <label class="form-label">Emplacement</label>
                        <input type="text" name="emplacement" value="{{ old('emplacement', $stock->emplacement) }}" 
                               class="form-input" placeholder="Ex: Rayon A, Étagère 3, Boîte 12...">
                        @error('emplacement')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group md:col-span-2">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-textarea" 
                                  placeholder="Description détaillée du produit...">{{ old('description', $stock->description) }}</textarea>
                        @error('description')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group md:col-span-2">
                        <label class="form-label">
                            <input type="checkbox" name="actif" value="1" {{ old('actif', $stock->actif) ? 'checked' : '' }} 
                                   style="margin-right: 0.5rem;">
                            Produit actif
                        </label>
                        <div class="help-text">Décochez pour désactiver temporairement ce produit</div>
                    </div>
                </div>

                <div class="flex justify-end gap-4 mt-8">
                    <a href="{{ route('stocks.index') }}" class="btn-secondary">
                        <i class="fas fa-times mr-2"></i>Annuler
                    </a>
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-save mr-2"></i>Mettre à jour
                    </button>
                </div>
            </form>
        </div>

        <!-- Catégories existantes -->
        @if($categories->count() > 0)
            <div class="content-card">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Catégories existantes</h3>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($categories as $categorie)
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-center">
                            <i class="fas fa-tag text-gray-400 text-2xl mb-2"></i>
                            <p class="font-medium text-gray-700">{{ $categorie }}</p>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-4 text-center">
                    <p class="text-sm text-gray-600">
                        Vous pouvez réutiliser une catégorie existante ou créer une nouvelle
                    </p>
                </div>
            </div>
        @endif
    </div>
</body>
</html> 