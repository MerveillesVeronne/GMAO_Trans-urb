<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GMAO Trans'urb - Gestion des Stocks</title>
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
        .btn-success {
            background: #10b981;
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-success:hover {
            background: #059669;
        }
        .btn-warning {
            background: #f59e0b;
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-warning:hover {
            background: #d97706;
        }
        .btn-danger {
            background: #ef4444;
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-danger:hover {
            background: #dc2626;
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
        .form-select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            background-color: white;
            transition: border-color 0.2s;
        }
        .form-select:focus {
            outline: none;
            border-color: #1e5c4a;
            box-shadow: 0 0 0 3px rgba(30, 92, 74, 0.1);
        }
        .stock-card {
            background: #f9fafb;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .stock-card:hover {
            border-color: #1e5c4a;
            box-shadow: 0 4px 12px rgba(30, 92, 74, 0.1);
        }
        .stock-card.en-alerte {
            border-color: #ef4444;
            background: #fef2f2;
        }
        .stock-card.en-alerte:hover {
            border-color: #dc2626;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.1);
        }
        .alert-badge {
            background: #ef4444;
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .progress-bar {
            width: 100%;
            height: 8px;
            background: #e5e7eb;
            border-radius: 4px;
            overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            background: #10b981;
            transition: width 0.3s ease;
        }
        .progress-fill.warning {
            background: #f59e0b;
        }
        .progress-fill.danger {
            background: #ef4444;
        }
        
        /* Styles pour l'affichage en liste */
        .view-toggle {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }
        .view-toggle-btn {
            padding: 0.5rem 1rem;
            border: 2px solid #e5e7eb;
            background: white;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .view-toggle-btn.active {
            background: #1e5c4a;
            color: white;
            border-color: #1e5c4a;
        }
        .view-toggle-btn:hover:not(.active) {
            border-color: #1e5c4a;
            color: #1e5c4a;
        }
        
        /* Style pour l'affichage en liste */
        .stock-list {
            display: none;
        }
        .stock-list.active {
            display: block;
        }
        .stock-list-item {
            background: #f9fafb;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .stock-list-item:hover {
            border-color: #1e5c4a;
            box-shadow: 0 4px 12px rgba(30, 92, 74, 0.1);
        }
        .stock-list-item.en-alerte {
            border-color: #ef4444;
            background: #fef2f2;
        }
        .stock-list-item.en-alerte:hover {
            border-color: #dc2626;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.1);
        }
        .stock-list-header {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr 1fr 1fr auto;
            gap: 1rem;
            align-items: center;
            padding: 1rem 1.5rem;
            background: #f3f4f6;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-weight: 600;
            color: #374151;
        }
        .stock-list-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr 1fr 1fr auto;
            gap: 1rem;
            align-items: center;
            padding: 1rem 1.5rem;
        }
        .stock-list-row:hover {
            background: #f9fafb;
        }
        .stock-list-actions {
            display: flex;
            gap: 0.5rem;
        }
        .stock-list-actions .btn {
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
        }
        
        /* Style pour l'affichage en grille */
        .stock-grid {
            display: none;
        }
        .stock-grid.active {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 1.5rem;
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
                <div class="greeting">Gestion des Stocks</div>
                <div class="subtitle">Suivi des produits en stock</div>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-boxes" style="font-size: 2.5rem; color: #ffe082;"></i>
            </div>
        </div>
    </div>

    <!-- Menu secondaire harmonisé -->
    <div class="main-content">
        <div class="menu-bar" style="background: #fff; border-radius: 16px; box-shadow: 0 2px 12px rgba(23,66,59,0.08); padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
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
            <!-- Fournisseurs -->
            <div class="menu-dropdown" style="position: relative;">
                <button class="menu-btn">
                    <i class="fas fa-truck mr-2 text-yellow-600"></i>Fournisseurs <i class="fas fa-chevron-down ml-1"></i>
                </button>
                <ul class="dropdown-content">
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('fournisseurs.create') }}'"><i class="fas fa-plus mr-2"></i>Nouveau Fournisseur</button></li>
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('liste.fournisseurs') }}'"><i class="fas fa-list mr-2"></i>Liste Fournisseurs</button></li>
                    <li><button class="dropdown-item" onclick="window.location.href='#'"><i class="fas fa-star mr-2"></i>Évaluations</button></li>
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
        </div>

        <!-- Messages de succès/erreur -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- En-tête avec actions -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Gestion des Stocks</h2>
                <p class="text-gray-600">Suivi des produits et alertes de stock</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('stocks.dashboard') }}" class="btn-secondary">
                    <i class="fas fa-chart-bar mr-2"></i>Tableau de bord
                </a>
                <a href="{{ route('stocks.create') }}" class="btn-primary">
                    <i class="fas fa-plus mr-2"></i>Nouveau Produit
                </a>
            </div>
        </div>

        <!-- Filtres -->
        <div class="content-card">
            <h3 class="text-xl font-bold text-gray-900 mb-6">Filtres</h3>
            
            <form method="GET" action="{{ route('stocks.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Recherche</label>
                    <input type="text" name="recherche" value="{{ request('recherche') }}" 
                           class="form-input" placeholder="Nom du produit...">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catégorie</label>
                    <select name="categorie" class="form-select">
                        <option value="">Toutes les catégories</option>
                        @foreach($categories as $categorie)
                            <option value="{{ $categorie }}" {{ request('categorie') == $categorie ? 'selected' : '' }}>
                                {{ $categorie }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Statut</label>
                    <select name="en_alerte" class="form-select">
                        <option value="">Tous les produits</option>
                        <option value="1" {{ request('en_alerte') == '1' ? 'selected' : '' }}>En alerte</option>
                        <option value="0" {{ request('en_alerte') == '0' ? 'selected' : '' }}>Stock suffisant</option>
                    </select>
                </div>
                
                <div class="flex items-end">
                    <button type="submit" class="btn-primary w-full">
                        <i class="fas fa-search mr-2"></i>Filtrer
                    </button>
                </div>
            </form>
        </div>

        <!-- Liste des stocks -->
        <div class="content-card">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-900">Produits en stock ({{ $stocks->total() }})</h3>
                
                <!-- Boutons de basculement d'affichage -->
                <div class="view-toggle">
                    <button type="button" class="view-toggle-btn active" data-view="grid" onclick="switchView('grid')">
                        <i class="fas fa-th-large"></i>
                        Grille
                    </button>
                    <button type="button" class="view-toggle-btn" data-view="list" onclick="switchView('list')">
                        <i class="fas fa-list"></i>
                        Liste
                    </button>
                </div>
            </div>
            
            @if($stocks->count() > 0)
                <!-- Affichage en grille -->
                <div class="stock-grid active">
                    @foreach($stocks as $stock)
                        <div class="stock-card {{ $stock->isEnAlerte() ? 'en-alerte' : '' }}">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900">{{ $stock->produit }}</h4>
                                    @if($stock->categorie)
                                        <p class="text-sm text-gray-600">{{ $stock->categorie }}</p>
                                    @endif
                                </div>
                                @if($stock->isEnAlerte())
                                    <span class="alert-badge">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>Alerte
                                    </span>
                                @endif
                            </div>

                            @if($stock->description)
                                <p class="text-gray-600 text-sm mb-4">{{ Str::limit($stock->description, 100) }}</p>
                            @endif

                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <span class="text-sm text-gray-600">Stock actuel:</span>
                                    <p class="font-semibold text-lg {{ $stock->isEnAlerte() ? 'text-red-600' : 'text-green-600' }}">
                                        {{ $stock->quantite_disponible }} {{ $stock->unite }}
                                    </p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-600">Seuil d'alerte:</span>
                                    <p class="font-semibold">{{ $stock->quantite_minimale }} {{ $stock->unite }}</p>
                                </div>
                            </div>

                            <!-- Barre de progression -->
                            <div class="mb-4">
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-sm text-gray-600">Niveau de stock</span>
                                    <span class="text-sm text-gray-600">
                                        @if($stock->quantite_minimale > 0)
                                            {{ round(($stock->quantite_disponible / $stock->quantite_minimale) * 100) }}%
                                        @else
                                            100%
                                        @endif
                                    </span>
                                </div>
                                <div class="progress-bar">
                                    @php
                                        $percentage = $stock->quantite_minimale > 0 
                                            ? min(100, ($stock->quantite_disponible / $stock->quantite_minimale) * 100)
                                            : 100;
                                        $colorClass = $percentage <= 50 ? 'danger' : ($percentage <= 75 ? 'warning' : '');
                                    @endphp
                                    <div class="progress-fill {{ $colorClass }}" style="width: {{ $percentage }}%"></div>
                                </div>
                            </div>

                            @if($stock->cout_unitaire)
                                <div class="mb-4">
                                    <span class="text-sm text-gray-600">Coût unitaire:</span>
                                    <p class="font-semibold">{{ number_format($stock->cout_unitaire, 0, ',', ' ') }} FCFA</p>
                                </div>
                            @endif

                            @if($stock->emplacement)
                                <div class="mb-4">
                                    <span class="text-sm text-gray-600">Emplacement:</span>
                                    <p class="font-semibold">{{ $stock->emplacement }}</p>
                                </div>
                            @endif

                            <!-- Actions -->
                            <div class="flex gap-2">
                                <a href="{{ route('stocks.show', $stock) }}" class="btn-secondary text-sm flex-1">
                                    <i class="fas fa-eye mr-1"></i>Voir
                                </a>
                                <a href="{{ route('stocks.edit', $stock) }}" class="btn-primary text-sm flex-1">
                                    <i class="fas fa-edit mr-1"></i>Modifier
                                </a>
                                <form method="POST" action="{{ route('stocks.destroy', $stock) }}" class="flex-1" 
                                      onsubmit="return confirm('Supprimer ce produit ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger text-sm w-full">
                                        <i class="fas fa-trash mr-1"></i>Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Affichage en liste -->
                <div class="stock-list">
                    <!-- En-tête de la liste -->
                    <div class="stock-list-header">
                        <div>Produit</div>
                        <div>Catégorie</div>
                        <div>Stock actuel</div>
                        <div>Seuil d'alerte</div>
                        <div>Coût unitaire</div>
                        <div>Emplacement</div>
                        <div>Actions</div>
                    </div>
                    
                    <!-- Lignes de la liste -->
                    @foreach($stocks as $stock)
                        <div class="stock-list-item {{ $stock->isEnAlerte() ? 'en-alerte' : '' }}">
                            <div class="stock-list-row">
                                <div>
                                    <div class="font-semibold text-gray-900">{{ $stock->produit }}</div>
                                    @if($stock->description)
                                        <div class="text-sm text-gray-600">{{ Str::limit($stock->description, 50) }}</div>
                                    @endif
                                    @if($stock->isEnAlerte())
                                        <span class="alert-badge inline-block mt-1">
                                            <i class="fas fa-exclamation-triangle mr-1"></i>Alerte
                                        </span>
                                    @endif
                                </div>
                                <div class="text-gray-700">{{ $stock->categorie ?: '-' }}</div>
                                <div>
                                    <span class="font-semibold {{ $stock->isEnAlerte() ? 'text-red-600' : 'text-green-600' }}">
                                        {{ $stock->quantite_disponible }}
                                    </span>
                                    <span class="text-sm text-gray-600">{{ $stock->unite }}</span>
                                </div>
                                <div class="text-gray-700">{{ $stock->quantite_minimale }} {{ $stock->unite }}</div>
                                <div class="text-gray-700">
                                    @if($stock->cout_unitaire)
                                        {{ number_format($stock->cout_unitaire, 0, ',', ' ') }} FCFA
                                    @else
                                        -
                                    @endif
                                </div>
                                <div class="text-gray-700">{{ $stock->emplacement ?: '-' }}</div>
                                <div class="stock-list-actions">
                                    <a href="{{ route('stocks.show', $stock) }}" class="btn-secondary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('stocks.edit', $stock) }}" class="btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('stocks.destroy', $stock) }}" class="inline" 
                                          onsubmit="return confirm('Supprimer ce produit ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $stocks->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-boxes text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Aucun produit en stock</h3>
                    <p class="text-gray-500 mb-6">Commencez par ajouter des produits à votre inventaire.</p>
                    <a href="{{ route('stocks.create') }}" class="btn-primary">
                        <i class="fas fa-plus mr-2"></i>Ajouter un produit
                    </a>
                </div>
            @endif
        </div>
    </div>

    <script>
        function switchView(viewType) {
            // Mettre à jour les boutons
            document.querySelectorAll('.view-toggle-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            document.querySelector(`[data-view="${viewType}"]`).classList.add('active');
            
            // Mettre à jour l'affichage
            if (viewType === 'grid') {
                document.querySelector('.stock-grid').classList.add('active');
                document.querySelector('.stock-list').classList.remove('active');
            } else {
                document.querySelector('.stock-grid').classList.remove('active');
                document.querySelector('.stock-list').classList.add('active');
            }
            
            // Sauvegarder la préférence dans le localStorage
            localStorage.setItem('stockViewPreference', viewType);
        }
        
        // Restaurer la préférence au chargement de la page
        document.addEventListener('DOMContentLoaded', function() {
            const savedView = localStorage.getItem('stockViewPreference');
            if (savedView && savedView !== 'grid') {
                switchView(savedView);
            }
        });
    </script>
</body>
</html> 