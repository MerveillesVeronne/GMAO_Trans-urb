<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GMAO Trans'urb - Moyens Généraux</title>
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
            max-width: 1400px;
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
            padding: 0.8rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            color: #17423b;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: background 0.2s, color 0.2s;
            white-space: nowrap;
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
            min-width: 240px;
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
            font-size: 0.95rem;
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
        .stat-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(23,66,59,0.13);
            padding: 2.2rem 2.8rem;
            min-width: 270px;
            max-width: 320px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            transition: box-shadow 0.2s, transform 0.2s;
        }
        .stat-card:hover {
            box-shadow: 0 12px 36px rgba(23,66,59,0.18);
            transform: translateY(-4px) scale(1.04);
        }
        .stat-card .icon {
            background: #e6f4ee;
            border-radius: 50%;
            padding: 0.8rem;
            font-size: 1.5rem;
            color: #17423b;
        }
        .stat-card .stat-label {
            color: #6b7c7a;
            font-size: 1rem;
            font-weight: 500;
        }
        .stat-card .stat-value {
            font-size: 2.7rem;
            font-weight: 700;
            color: #17423b;
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
                <div class="greeting">Moyens Généraux</div>
                <div class="subtitle">Gestion des commandes, fournisseurs, contrats et stocks</div>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-cogs" style="font-size: 2.5rem; color: #ffe082;"></i>
            </div>
        </div>
    </div>

    <!-- Menu secondaire harmonisé -->
    <div class="main-content">
        <div class="menu-bar" style="background: #fff; border-radius: 16px; box-shadow: 0 2px 12px rgba(23,66,59,0.08); padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
            <!-- Bons de commande -->
            <div class="menu-dropdown" style="position: relative;">
                <button class="menu-btn">
                    <i class="fas fa-clipboard-list mr-2 text-green-600"></i>Bons de commande <i class="fas fa-chevron-down ml-1"></i>
                </button>
                <ul class="dropdown-content">
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('bons-commande.create') }}'"><i class="fas fa-plus mr-2"></i>Nouveau Bon de commande</button></li>
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('bons-commande.index') }}'"><i class="fas fa-list mr-2"></i>Liste Bons de commande</button></li>
                </ul>
            </div>
            <!-- Commandes -->
            <div class="menu-dropdown" style="position: relative;">
                <button class="menu-btn">
                    <i class="fas fa-shopping-cart mr-2 text-blue-600"></i>Commandes <i class="fas fa-chevron-down ml-1"></i>
                </button>
                <ul class="dropdown-content">
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('nouvelle.commande') }}'"><i class="fas fa-plus mr-2"></i>Nouvelle Commande</button></li>
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('liste.commandes') }}'"><i class="fas fa-list mr-2"></i>Liste des Commandes</button></li>
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('commandes.paiements') }}'"><i class="fas fa-credit-card mr-2"></i>Paiements</button></li>
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
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('stocks.sorties.create') }}'"><i class="fas fa-sign-out-alt mr-2"></i>Sortie de Stock</button></li>
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('stocks.sorties.index') }}'"><i class="fas fa-history mr-2"></i>Historique Sorties</button></li>
                                                <li><button class="dropdown-item" onclick="window.location.href='{{ route('stocks.sorties.tracabilite') }}'"><i class="fas fa-search mr-2"></i>Traçabilité</button></li>
                            <li><button class="dropdown-item" onclick="window.location.href='{{ route('alertes.index') }}'"><i class="fas fa-exclamation-triangle mr-2"></i>Alertes</button></li>
                </ul>
            </div>
            <!-- Fournisseurs -->
            <div class="menu-dropdown" style="position: relative;">
                <button class="menu-btn">
                    <i class="fas fa-truck mr-2 text-yellow-600"></i>Fournisseurs <i class="fas fa-chevron-down ml-1"></i>
                </button>
                <ul class="dropdown-content">
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('liste.fournisseurs') }}?action=nouveau'"><i class="fas fa-plus mr-2"></i>Nouveau Fournisseur</button></li>
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('liste.fournisseurs') }}'"><i class="fas fa-list mr-2"></i>Liste Fournisseurs</button></li>
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
            <!-- Paiements -->
            <div class="menu-dropdown" style="position: relative;">
                <button class="menu-btn">
                    <i class="fas fa-money-bill-wave mr-2 text-green-600"></i>Paiements <i class="fas fa-chevron-down ml-1"></i>
                </button>
                <ul class="dropdown-content">
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('transactions.index') }}'"><i class="fas fa-history mr-2"></i>Historique des Transactions</button></li>
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('paiements.index') }}'"><i class="fas fa-credit-card mr-2"></i>Paiements Commandes</button></li>
                </ul>
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="content-card">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Tableau de bord - Moyens Généraux</h2>
            
            <!-- Statistiques principales -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <a href="{{ route('liste.contrats') }}" class="block">
                    <div class="stat-card">
                        <div>
                            <div class="stat-label">Contrats Actifs</div>
                            <div class="stat-value">{{ $stats['contrats_actifs'] }}</div>
                        </div>
                        <div class="icon"><i class="fas fa-file-contract"></i></div>
                    </div>
                </a>
                <a href="{{ route('stocks.index') }}" class="block">
                    <div class="stat-card">
                        <div>
                            <div class="stat-label">Produits en Stock</div>
                            <div class="stat-value">{{ $stats['total_produits'] }}</div>
                        </div>
                        <div class="icon"><i class="fas fa-boxes"></i></div>
                    </div>
                </a>
                <a href="{{ route('liste.fournisseurs') }}" class="block">
                    <div class="stat-card">
                        <div>
                            <div class="stat-label">Fournisseurs</div>
                            <div class="stat-value">{{ $stats['total_fournisseurs'] }}</div>
                        </div>
                        <div class="icon"><i class="fas fa-truck"></i></div>
                    </div>
                </a>
                <div class="stat-card">
                    <div>
                        <div class="stat-label">Budget Mensuel</div>
                        <div class="stat-value">{{ $stats['budget_formatted'] }} FCFA</div>
                    </div>
                    <div class="icon"><i class="fas fa-money-bill-wave"></i></div>
                </div>
            </div>

            <!-- Alertes et notifications importantes -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Alertes Expiration Contrats -->
                <div class="content-card">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">
                        <i class="fas fa-bell mr-2 text-red-500"></i>Alertes Expiration Contrats
                    </h3>
                    <div class="space-y-3">
                        @forelse($alertesExpiration as $alerte)
                            <a href="{{ route('contrat.details', $alerte['id']) }}" class="block">
                                <div class="flex items-center justify-between p-3 rounded-lg border hover:shadow-md transition-shadow
                                    @if($alerte['urgence'] === 'critique') bg-red-50 border-red-200
                                    @elseif($alerte['urgence'] === 'moderee') bg-yellow-50 border-yellow-200
                                    @else bg-blue-50 border-blue-200 @endif">
                                    <div>
                                        <div class="font-medium text-gray-900">{{ $alerte['intitule'] }}</div>
                                        <div class="text-sm text-gray-600">Fournisseur: {{ $alerte['fournisseur'] }}</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-sm font-medium 
                                            @if($alerte['urgence'] === 'critique') text-red-600
                                            @elseif($alerte['urgence'] === 'moderee') text-yellow-600
                                            @else text-blue-600 @endif">
                                            @if($alerte['jours_restants'] == 0)
                                                Expire aujourd'hui
                                            @elseif($alerte['jours_restants'] == 1)
                                                Expire demain
                                            @else
                                                Expire dans {{ $alerte['jours_restants'] }} jours
                                            @endif
                                        </div>
                                        <div class="text-sm text-gray-500">{{ $alerte['date_fin'] }}</div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="text-center py-8 text-gray-500">
                                <i class="fas fa-check-circle text-4xl mb-4 text-green-500"></i>
                                <p>Aucune alerte d'expiration</p>
                                <p class="text-sm">Tous les contrats sont à jour</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Commandes Récentes -->
                <div class="content-card">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">
                        <i class="fas fa-shopping-bag mr-2 text-blue-500"></i>Commandes Récentes
                    </h3>
                    <div class="space-y-3">
                        @forelse($commandesRecentes as $commande)
                            <a href="{{ route('commande.details', $commande['id']) }}" class="block">
                                <div class="flex items-center justify-between p-3 rounded-lg border hover:shadow-md transition-shadow
                                    @if($commande['statut'] === 'livree') bg-green-50 border-green-200
                                    @elseif($commande['statut'] === 'approuvee') bg-blue-50 border-blue-200
                                    @elseif($commande['statut'] === 'en_attente') bg-yellow-50 border-yellow-200
                                    @else bg-gray-50 border-gray-200 @endif">
                                    <div>
                                        <div class="font-medium text-gray-900">{{ $commande['reference'] }}</div>
                                        <div class="text-sm text-gray-600">{{ $commande['fournisseur'] }}</div>
                                        <div class="text-sm text-gray-500">{{ number_format($commande['montant'], 0, ',', ' ') }} FCFA</div>
                                    </div>
                                    <div class="text-right">
                                        <span class="px-2 py-1 text-xs rounded-full 
                                            @if($commande['statut'] === 'livree') bg-green-100 text-green-800
                                            @elseif($commande['statut'] === 'approuvee') bg-blue-100 text-blue-800
                                            @elseif($commande['statut'] === 'en_attente') bg-yellow-100 text-yellow-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ $commande['statut_label'] }}
                                        </span>
                                        <div class="text-sm text-gray-500 mt-1">{{ $commande['date_commande'] }}</div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="text-center py-8 text-gray-500">
                                <i class="fas fa-shopping-cart text-4xl mb-4 text-gray-400"></i>
                                <p>Aucune commande récente</p>
                                <p class="text-sm">Les nouvelles commandes apparaîtront ici</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 