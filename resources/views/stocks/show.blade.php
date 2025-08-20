<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GMAO Trans'urb - Détails Stock</title>
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
        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.875rem;
        }
        .status-en-alerte {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }
        .status-normal {
            background: #f0fdf4;
            color: #16a34a;
            border: 1px solid #bbf7d0;
        }
        .progress-bar {
            width: 100%;
            height: 12px;
            background: #e5e7eb;
            border-radius: 6px;
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
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }
        .info-item {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 1.5rem;
        }
        .info-label {
            font-size: 0.875rem;
            color: #6b7280;
            margin-bottom: 0.5rem;
        }
        .info-value {
            font-size: 1.125rem;
            font-weight: 600;
            color: #111827;
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
                <div class="greeting">{{ $stock->produit }}</div>
                <div class="subtitle">Détails du produit en stock</div>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-box" style="font-size: 2.5rem; color: #ffe082;"></i>
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

        <!-- En-tête avec actions -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">{{ $stock->produit }}</h2>
                <p class="text-gray-600">{{ $stock->categorie ?? 'Aucune catégorie' }}</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('stocks.index') }}" class="btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i>Retour
                </a>
                <a href="{{ route('stocks.edit', $stock) }}" class="btn-primary">
                    <i class="fas fa-edit mr-2"></i>Modifier
                </a>
            </div>
        </div>

        <!-- Statut et niveau de stock -->
        <div class="content-card">
            <div class="flex justify-between items-start mb-6">
                <h3 class="text-xl font-bold text-gray-900">État du stock</h3>
                <span class="status-badge {{ $stock->isEnAlerte() ? 'status-en-alerte' : 'status-normal' }}">
                    @if($stock->isEnAlerte())
                        <i class="fas fa-exclamation-triangle mr-1"></i>En alerte
                    @else
                        <i class="fas fa-check-circle mr-1"></i>Stock normal
                    @endif
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="text-center">
                    <div class="text-3xl font-bold text-blue-600">{{ $stock->quantite_disponible }}</div>
                    <div class="text-gray-600">{{ $stock->unite }} disponibles</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-orange-600">{{ $stock->quantite_minimale }}</div>
                    <div class="text-gray-600">Seuil d'alerte</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-green-600">
                        @if($stock->cout_unitaire)
                            {{ number_format($stock->quantite_disponible * $stock->cout_unitaire, 0, ',', ' ') }}
                        @else
                            -
                        @endif
                    </div>
                    <div class="text-gray-600">Valeur totale (FCFA)</div>
                </div>
            </div>

            <!-- Barre de progression -->
            <div class="mb-4">
                <div class="flex justify-between items-center mb-2">
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
        </div>

        <!-- Informations détaillées -->
        <div class="content-card">
            <h3 class="text-xl font-bold text-gray-900 mb-6">Informations du produit</h3>
            
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Nom du produit</div>
                    <div class="info-value">{{ $stock->produit }}</div>
                </div>
                
                @if($stock->categorie)
                <div class="info-item">
                    <div class="info-label">Catégorie</div>
                    <div class="info-value">{{ $stock->categorie }}</div>
                </div>
                @endif
                
                <div class="info-item">
                    <div class="info-label">Unité de mesure</div>
                    <div class="info-value">{{ $stock->unite }}</div>
                </div>
                
                @if($stock->cout_unitaire)
                <div class="info-item">
                    <div class="info-label">Coût unitaire</div>
                    <div class="info-value">{{ number_format($stock->cout_unitaire, 0, ',', ' ') }} FCFA</div>
                </div>
                @endif
                
                @if($stock->emplacement)
                <div class="info-item">
                    <div class="info-label">Emplacement</div>
                    <div class="info-value">{{ $stock->emplacement }}</div>
                </div>
                @endif
                
                <div class="info-item">
                    <div class="info-label">Date de création</div>
                    <div class="info-value">{{ $stock->created_at->format('d/m/Y H:i') }}</div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">Dernière modification</div>
                    <div class="info-value">{{ $stock->updated_at->format('d/m/Y H:i') }}</div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">Statut</div>
                    <div class="info-value">
                        @if($stock->actif)
                            <span class="text-green-600 font-semibold">Actif</span>
                        @else
                            <span class="text-red-600 font-semibold">Inactif</span>
                        @endif
                    </div>
                </div>
            </div>

            @if($stock->description)
            <div class="mt-6">
                <div class="info-label">Description</div>
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                    <p class="text-gray-700">{{ $stock->description }}</p>
                </div>
            </div>
            @endif
        </div>

        <!-- Actions -->
        <div class="content-card">
            <h3 class="text-xl font-bold text-gray-900 mb-6">Actions</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('stocks.edit', $stock) }}" class="btn-primary text-center">
                    <i class="fas fa-edit mr-2"></i>Modifier le produit
                </a>
                
                <a href="{{ route('stocks.ajuster', $stock) }}" class="btn-warning text-center">
                    <i class="fas fa-plus-minus mr-2"></i>Ajuster le stock
                </a>
                
                <form method="POST" action="{{ route('stocks.destroy', $stock) }}" 
                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger w-full">
                        <i class="fas fa-trash mr-2"></i>Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html> 