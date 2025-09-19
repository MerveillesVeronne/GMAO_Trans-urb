<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GMAO Trans'urb - Logistique</title>
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
        .main-navbar .nav-link.active {
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
        .quick-action-btn {
            background: #1e5c4a;
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .quick-action-btn:hover {
            background: #17423b;
            color: white;
        }
        .quick-action-btn.secondary {
            background: #6b7280;
        }
        .quick-action-btn.secondary:hover {
            background: #4b5563;
        }
        .quick-action-btn.success {
            background: #10b981;
        }
        .quick-action-btn.success:hover {
            background: #059669;
        }
        .quick-action-btn.warning {
            background: #f59e0b;
        }
        .quick-action-btn.warning:hover {
            background: #d97706;
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
                <a href="{{ route('dashboard.logistique') }}" class="nav-link active"><i class="fas fa-clipboard-list mr-2"></i>Logistique</a>
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
                <div class="greeting">Logistique</div>
                <div class="subtitle">Gestion du magasin, validation des bons de commande et suivi des véhicules</div>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-clipboard-list" style="font-size: 2.5rem; color: #ffe082;"></i>
            </div>
        </div>
    </div>

    <!-- Menu principal harmonisé -->
    <div class="main-content">
        <div class="menu-bar" style="background: #fff; border-radius: 16px; box-shadow: 0 2px 12px rgba(23,66,59,0.08); padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
            <!-- Magasin - CRUD complet -->
            <div class="menu-dropdown" style="position: relative;">
                <button class="menu-btn">
                    <i class="fas fa-warehouse mr-2 text-blue-600"></i>Magasin <i class="fas fa-chevron-down ml-1"></i>
                </button>
                <ul class="dropdown-content">
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('logistique.magasin.index') }}'"><i class="fas fa-list mr-2"></i>Liste du Magasin</button></li>
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('logistique.magasin.create') }}'"><i class="fas fa-plus mr-2"></i>Ajouter une Pièce</button></li>
                </ul>
            </div>

            <!-- Véhicules - Lecture seule -->
            <div class="menu-dropdown" style="position: relative;">
                <button class="menu-btn">
                    <i class="fas fa-bus mr-2 text-purple-600"></i>Véhicules <i class="fas fa-chevron-down ml-1"></i>
                </button>
                <ul class="dropdown-content">
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('logistique.vehicules.index') }}'"><i class="fas fa-list mr-2"></i>Liste des Véhicules</button></li>
                </ul>
            </div>

            <!-- Planning - Lecture seule avec signature -->
            <div class="menu-dropdown" style="position: relative;">
                <button class="menu-btn">
                    <i class="fas fa-calendar-alt mr-2 text-green-600"></i>Planning <i class="fas fa-chevron-down ml-1"></i>
                </button>
                <ul class="dropdown-content">
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('logistique.planning.index') }}'"><i class="fas fa-calendar mr-2"></i>Planning Maintenance</button></li>
                </ul>
            </div>

            <!-- Bons de Commande - Lecture + Signature -->
            <div class="menu-dropdown" style="position: relative;">
                <button class="menu-btn">
                    <i class="fas fa-file-invoice mr-2 text-red-600"></i>Bons de Commande <i class="fas fa-chevron-down ml-1"></i>
                </button>
                <ul class="dropdown-content">
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('logistique.bons-commande.index') }}'"><i class="fas fa-list mr-2"></i>Liste des Bons de Commande</button></li>
                </ul>
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="content-card">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Tableau de bord - Logistique</h2>
                <div class="flex gap-3">
                    <a href="{{ route('logistique.magasin.create') }}" class="quick-action-btn success">
                        <i class="fas fa-plus"></i>
                        Nouvelle Pièce
                    </a>
                    <a href="{{ route('logistique.bons-commande.index') }}" class="quick-action-btn warning">
                        <i class="fas fa-signature"></i>
                        Signer BC
                    </a>
                </div>
            </div>
            
            <!-- Statistiques principales -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <a href="{{ route('logistique.magasin.index') }}" class="block">
                    <div class="stat-card">
                        <div>
                            <div class="stat-label">Total Pièces</div>
                            <div class="stat-value">{{ $stats['total_pieces'] }}</div>
                        </div>
                        <div class="icon"><i class="fas fa-cogs"></i></div>
                    </div>
                </a>
                <a href="{{ route('logistique.magasin.index') }}?filter=stock" class="block">
                    <div class="stat-card">
                        <div>
                            <div class="stat-label">En Stock</div>
                            <div class="stat-value">{{ $stats['pieces_en_stock'] }}</div>
                        </div>
                        <div class="icon"><i class="fas fa-boxes"></i></div>
                    </div>
                </a>
                <a href="{{ route('logistique.magasin.index') }}?filter=low-stock" class="block">
                    <div class="stat-card">
                        <div>
                            <div class="stat-label">Stock Faible</div>
                            <div class="stat-value">{{ $stats['pieces_stock_faible'] }}</div>
                        </div>
                        <div class="icon"><i class="fas fa-exclamation-triangle"></i></div>
                    </div>
                </a>
                <a href="{{ route('logistique.magasin.index') }}?filter=rupture" class="block">
                    <div class="stat-card">
                        <div>
                            <div class="stat-label">En Rupture</div>
                            <div class="stat-value">{{ $stats['pieces_en_rupture'] }}</div>
                        </div>
                        <div class="icon"><i class="fas fa-times-circle"></i></div>
                    </div>
                </a>
                <a href="{{ route('logistique.bons-commande.index') }}?filter=en-attente" class="block">
                    <div class="stat-card">
                        <div>
                            <div class="stat-label">BC en Attente</div>
                            <div class="stat-value">{{ $stats['bons_commande_en_attente'] }}</div>
                        </div>
                        <div class="icon"><i class="fas fa-clock"></i></div>
                    </div>
                </a>
                <a href="{{ route('logistique.bons-commande.index') }}?filter=a-signer" class="block">
                    <div class="stat-card">
                        <div>
                            <div class="stat-label">BC à Signer</div>
                            <div class="stat-value">{{ $stats['bons_commande_a_signer'] }}</div>
                        </div>
                        <div class="icon"><i class="fas fa-signature"></i></div>
                    </div>
                </a>
            </div>

            <!-- Sections principales -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Bons de commande récents -->
                <div class="content-card">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-900">
                            <i class="fas fa-file-invoice mr-2 text-red-500"></i>Bons de Commande Récents
                        </h3>
                        <a href="{{ route('logistique.bons-commande.index') }}" class="quick-action-btn secondary">
                            <i class="fas fa-eye"></i>
                            Voir tout
                        </a>
                    </div>
                    <div class="space-y-3">
                        @if($bonsCommandeRecents->count() > 0)
                            @foreach($bonsCommandeRecents as $bc)
                                <a href="{{ route('logistique.bons-commande.show', $bc->id) }}" class="block">
                                    <div class="bg-gray-50 rounded-lg p-4 border-l-4 border-{{ $bc->statut_color }}-500 hover:shadow-md transition-shadow">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <div class="font-semibold text-gray-900">{{ $bc->reference }}</div>
                                                <div class="text-sm text-gray-600">{{ $bc->vehicule->numero ?? 'N/A' }} - {{ $bc->vehicule->marque ?? '' }}</div>
                                                <div class="text-xs text-gray-500">{{ $bc->created_at->format('d/m/Y H:i') }}</div>
                                            </div>
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-{{ $bc->statut_color }}-100 text-{{ $bc->statut_color }}-800">
                                                {{ $bc->statut_label }}
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <div class="text-center py-8 text-gray-500">
                                <i class="fas fa-file-invoice text-4xl mb-4 text-gray-400"></i>
                                <p>Aucun bon de commande récent</p>
                                <p class="text-sm">Les nouveaux bons de commande apparaîtront ici</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Pièces en stock faible -->
                <div class="content-card">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-900">
                            <i class="fas fa-exclamation-triangle mr-2 text-yellow-500"></i>Alertes Stock Faible
                        </h3>
                        <a href="{{ route('logistique.magasin.index') }}?filter=low-stock" class="quick-action-btn warning">
                            <i class="fas fa-eye"></i>
                            Voir tout
                        </a>
                    </div>
                    <div class="space-y-3">
                        @if($piecesStockFaible->count() > 0)
                            @foreach($piecesStockFaible as $piece)
                                <a href="{{ route('logistique.magasin.show', $piece->id) }}" class="block">
                                    <div class="bg-yellow-50 rounded-lg p-4 border-l-4 border-yellow-500 hover:shadow-md transition-shadow">
                                        <div class="flex justify-between items-center">
                                            <div>
                                                <div class="font-semibold text-gray-900">{{ $piece->designation }}</div>
                                                <div class="text-sm text-gray-600">{{ $piece->reference }}</div>
                                                <div class="text-xs text-yellow-600">Stock: {{ $piece->quantite_stock }} (Seuil: {{ $piece->seuil_alerte }})</div>
                                            </div>
                                            <i class="fas fa-exclamation-triangle text-yellow-500"></i>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <div class="text-center py-8 text-gray-500">
                                <i class="fas fa-check-circle text-4xl mb-4 text-green-500"></i>
                                <p>Aucune alerte de stock</p>
                                <p class="text-sm">Tous les stocks sont suffisants</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Actions rapides -->
            <div class="content-card mt-6">
                <h3 class="text-xl font-bold text-gray-900 mb-6">
                    <i class="fas fa-bolt mr-2 text-blue-500"></i>Actions Rapides
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <a href="{{ route('logistique.magasin.create') }}" class="quick-action-btn success">
                        <i class="fas fa-plus"></i>
                        Ajouter Pièce
                    </a>
                    <a href="{{ route('logistique.bons-commande.index') }}" class="quick-action-btn">
                        <i class="fas fa-file-invoice"></i>
                        Voir BC
                    </a>
                    <a href="{{ route('logistique.vehicules.index') }}" class="quick-action-btn secondary">
                        <i class="fas fa-bus"></i>
                        Véhicules
                    </a>
                    <a href="{{ route('logistique.planning.index') }}" class="quick-action-btn">
                        <i class="fas fa-calendar"></i>
                        Planning
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>