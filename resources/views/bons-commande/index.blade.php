<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GMAO Trans'urb - Bons de commande</title>
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
            padding: 0.8rem 1.2rem;
            border: none;
            background: none;
            text-align: left;
            cursor: pointer;
            font-size: 0.95rem;
            color: #374151;
            transition: background 0.2s;
        }
        .dropdown-item:hover {
            background: #f3f4f6;
        }
        .btn-primary {
            background: #1e5c4a;
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
        }
        .btn-primary:hover {
            background: #17423b;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(30,92,74,0.3);
        }
        .btn-secondary {
            background: white;
            color: #1e5c4a;
            padding: 0.8rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.2s;
            border: 2px solid #1e5c4a;
            cursor: pointer;
        }
        .btn-secondary:hover {
            background: #1e5c4a;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(30,92,74,0.3);
        }
        .content-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(23,66,59,0.13);
            margin-bottom: 2rem;
        }
        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 8px 32px rgba(23,66,59,0.13);
            border-left: 4px solid #1e5c4a;
        }
        .table-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(23,66,59,0.13);
            overflow: hidden;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table thead {
            background: linear-gradient(135deg, #1e5c4a 0%, #17423b 100%);
            color: white;
        }
        .table thead th {
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .table tbody tr {
            transition: all 0.2s;
        }
        .table tbody tr:hover {
            background: #f8f9fa;
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .table tbody td {
            padding: 1rem;
            border-bottom: 1px solid #e5e7eb;
        }
        .status-badge {
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }
        .status-en_attente {
            background: #fef3c7;
            color: #92400e;
        }
        .status-en_cours {
            background: #dbeafe;
            color: #1e40af;
        }
        .status-valide {
            background: #d1fae5;
            color: #065f46;
        }
        .status-annule {
            background: #fee2e2;
            color: #991b1b;
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
                <div class="greeting">Bons de commande</div>
                <div class="subtitle">Gestion des besoins en matériel</div>
                </div>
            <div class="hidden md:block">
                <i class="fas fa-clipboard-list" style="font-size: 2.5rem; color: #ffe082;"></i>
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

        <!-- En-tête -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Liste des Bons de commande</h2>
            <div class="flex space-x-3">
                <a href="{{ route('bons-commande.export') }}" class="btn-secondary">
                    <i class="fas fa-file-pdf mr-2"></i>Export PDF
                </a>
                <a href="{{ route('bons-commande.create') }}" class="btn-primary">
                    <i class="fas fa-plus mr-2"></i>Nouveau Bon de commande
                </a>
        </div>
    </div>

            <!-- Messages de succès/erreur -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="stat-card">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                        <i class="fas fa-clipboard-list text-2xl text-green-600"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total bons de commande</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $bonsCommande->total() }}</dd>
                            </dl>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                        <i class="fas fa-clock text-2xl text-yellow-600"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">En attente</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $bonsCommande->where('statut', 'en_attente')->count() }}</dd>
                            </dl>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                        <i class="fas fa-spinner text-2xl text-blue-600"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">En cours</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $bonsCommande->where('statut', 'en_cours')->count() }}</dd>
                            </dl>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-2xl text-green-600"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Validés</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $bonsCommande->where('statut', 'valide')->count() }}</dd>
                            </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau des bons de commande -->
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Référence</th>
                        <th>Titre</th>
                        <th>Produit Principal</th>
                        <th>Budget (FCFA)</th>
                        <th>Date Création</th>
                        <th>Date Besoin</th>
                        <th>Statut</th>
                        <th>Actions</th>
                        </tr>
                    </thead>
                <tbody>
                    @forelse($bonsCommande as $bon)
                        <tr>
                            <td>
                                <div class="font-semibold">{{ $bon->reference }}</div>
                            </td>
                            <td>
                                <div class="font-semibold">{{ $bon->titre }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit($bon->description, 50) }}</div>
                            </td>
                            <td>
                                <div class="font-semibold">{{ $bon->produit_principal }}</div>
                                <div class="text-sm text-gray-500">{{ $bon->quantite_totale_souhaitee }} {{ $bon->unite_produit }}</div>
                                </td>
                            <td>
                                <div class="font-semibold text-green-600">{{ number_format($bon->budget_total, 0, ',', ' ') }}</div>
                                </td>
                            <td>
                                <div class="font-semibold">{{ $bon->date_creation ? $bon->date_creation->format('d/m/Y') : '-' }}</div>
                                <div class="text-sm text-gray-500">{{ $bon->date_creation ? $bon->date_creation->format('H:i') : '-' }}</div>
                                </td>
                            <td>
                                <div class="font-semibold">{{ $bon->date_besoin ? $bon->date_besoin->format('d/m/Y') : '-' }}</div>
                                </td>
                            <td>
                                <span class="status-badge status-{{ $bon->statut }}">
                                    {{ ucfirst(str_replace('_', ' ', $bon->statut)) }}
                                    </span>
                                </td>
                            <td>
                                    <div class="flex space-x-2">
                                    <a href="{{ route('bons-commande.show', $bon) }}" class="text-blue-600 hover:text-blue-800" title="Voir les détails">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($bon->statut === 'en_attente')
                                        <a href="{{ route('bons-commande.edit', $bon) }}" class="text-green-600 hover:text-green-800" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('bons-commande.destroy', $bon) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce bon de commande ?')">
                                                @csrf
                                                @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                            <td colspan="8" class="text-center py-8 text-gray-500">
                                <i class="fas fa-clipboard-list text-4xl mb-4"></i>
                                <p>Aucun bon de commande trouvé</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($bonsCommande->hasPages())
            <div class="mt-6">
                    {{ $bonsCommande->links() }}
                </div>
            @endif

        </div>
    </body>
</html> 