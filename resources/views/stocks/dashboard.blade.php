<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GMAO Trans'urb - Tableau de bord Stocks</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        .stat-card {
            background: #fff;
            color: #1e5c4a;
            border: 2px solid #e5e7eb;
            border-radius: 16px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 4px 12px rgba(30, 92, 74, 0.1);
            transition: all 0.2s;
        }
        .stat-card:hover {
            border-color: #1e5c4a;
            box-shadow: 0 6px 16px rgba(30, 92, 74, 0.15);
        }
        .stat-card.success {
            border-left: 4px solid #10b981;
        }
        .stat-card.warning {
            border-left: 4px solid #f59e0b;
        }
        .stat-card.danger {
            border-left: 4px solid #ef4444;
        }
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #1e5c4a;
        }
        .stat-label {
            font-size: 0.9rem;
            color: #6b7280;
            font-weight: 500;
            line-height: 1.2;
        }
        .alert-item {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 0.5rem;
        }
        .alert-item.warning {
            background: #fffbeb;
            border-color: #fed7aa;
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
                <div class="greeting">Tableau de bord - Stocks</div>
                <div class="subtitle">Vue d'ensemble de l'inventaire</div>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-chart-bar" style="font-size: 2.5rem; color: #ffe082;"></i>
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
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('stocks.sorties.create') }}'"><i class="fas fa-sign-out-alt mr-2"></i>Sortie de Stock</button></li>
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('stocks.sorties.tracabilite') }}'"><i class="fas fa-search mr-2"></i>Traçabilité</button></li>
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

        <!-- Statistiques principales -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="stat-card success">
                <div class="stat-number">{{ $totalProduits }}</div>
                <div class="stat-label">Produits en stock</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number">{{ $produitsEnAlerte }}</div>
                <div class="stat-label">En alerte</div>
            </div>
            
            <div class="stat-card warning">
                <div class="stat-number">{{ number_format($valeurTotale / 1000, 0, ',', ' ') }}</div>
                <div class="stat-label">Valeur totale (kFCFA)</div>
            </div>
            
            <div class="stat-card danger">
                <div class="stat-number">{{ $categories->count() }}</div>
                <div class="stat-label">Catégories</div>
            </div>
        </div>



        <!-- Répartition par catégorie -->
        <div class="content-card">
            <h3 class="text-xl font-bold text-gray-900 mb-6">Répartition par catégorie</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($categories as $categorie)
                    @php
                        $produitsCategorie = $stocks->where('categorie', $categorie);
                        $totalCategorie = $produitsCategorie->sum('quantite_disponible');
                        $valeurCategorie = $produitsCategorie->sum(function($stock) {
                            return $stock->quantite_disponible * ($stock->cout_unitaire ?? 0);
                        });
                    @endphp
                    
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="font-semibold text-gray-900">{{ $categorie }}</h4>
                            <span class="text-sm text-gray-600">{{ $produitsCategorie->count() }} produits</span>
                        </div>
                        
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Quantité totale:</span>
                                <span class="font-semibold">{{ $totalCategorie }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Valeur:</span>
                                <span class="font-semibold">{{ number_format($valeurCategorie, 0, ',', ' ') }} FCFA</span>
                            </div>
                        </div>
                        
                        <a href="{{ route('stocks.index', ['categorie' => $categorie]) }}" 
                           class="block w-full bg-blue-600 text-white text-center py-2 rounded-lg hover:bg-blue-700 transition-colors text-sm">
                            <i class="fas fa-eye mr-1"></i>Voir les produits
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Graphiques et analyses -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Répartition par catégorie (Camembert) -->
            <div class="content-card">
                <h3 class="text-xl font-bold text-gray-900 mb-6">
                    <i class="fas fa-chart-pie mr-2 text-blue-600"></i>
                    Répartition par catégorie
                </h3>
                <div class="chart-container" style="height: 300px;">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>

            <!-- État des stocks (Barres) -->
            <div class="content-card">
                <h3 class="text-xl font-bold text-gray-900 mb-6">
                    <i class="fas fa-chart-bar mr-2 text-green-600"></i>
                    État des stocks
                </h3>
                <div class="chart-container" style="height: 300px;">
                    <canvas id="stockStatusChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Top 10 des produits -->
        <div class="content-card">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-900">
                    <i class="fas fa-trophy mr-2 text-yellow-600"></i>
                    Top 10 des produits
                </h3>
                <div class="flex items-center gap-3">
                    <label for="topCriteria" class="text-sm font-medium text-gray-700">Critère :</label>
                    <select id="topCriteria" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        <option value="valeur">Par valeur (FCFA)</option>
                        <option value="quantite">Par quantité</option>
                        <option value="cout_unitaire">Par coût unitaire</option>
                        <option value="seuil_alerte">Par seuil d'alerte</option>
                    </select>
                </div>
            </div>
            <div class="chart-container" style="height: 400px;">
                <canvas id="topProductsChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        // Données pour les graphiques
        const categories = @json($categories);
        const stocks = @json($stocks);
        
        // Préparer les données pour le graphique camembert (répartition par catégorie)
        const categoryData = {};
        categories.forEach(category => {
            const categoryStocks = stocks.filter(stock => stock.categorie === category);
            const totalValue = categoryStocks.reduce((sum, stock) => {
                return sum + (stock.quantite_disponible * (stock.cout_unitaire || 0));
            }, 0);
            categoryData[category] = totalValue;
        });

        // Graphique camembert - Répartition par catégorie
        const categoryCtx = document.getElementById('categoryChart').getContext('2d');
        new Chart(categoryCtx, {
            type: 'doughnut',
            data: {
                labels: Object.keys(categoryData),
                datasets: [{
                    data: Object.values(categoryData),
                    backgroundColor: [
                        '#1e5c4a',
                        '#10b981',
                        '#f59e0b',
                        '#ef4444',
                        '#8b5cf6',
                        '#06b6d4',
                        '#84cc16',
                        '#f97316',
                        '#ec4899',
                        '#6366f1'
                    ],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const value = context.parsed;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = ((value / total) * 100).toFixed(1);
                                return `${context.label}: ${value.toLocaleString()} FCFA (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });

        // Graphique barres - État des stocks
        const stockStatusCtx = document.getElementById('stockStatusChart').getContext('2d');
        
        // Calculer les statistiques d'état
        const totalProducts = stocks.length;
        const productsInAlert = stocks.filter(stock => stock.quantite_disponible <= stock.quantite_minimale).length;
        const productsSufficient = totalProducts - productsInAlert;
        const activeProducts = stocks.filter(stock => stock.actif).length;
        const inactiveProducts = totalProducts - activeProducts;

        new Chart(stockStatusCtx, {
            type: 'bar',
            data: {
                labels: ['En alerte', 'Stock suffisant', 'Actifs', 'Inactifs'],
                datasets: [{
                    label: 'Nombre de produits',
                    data: [productsInAlert, productsSufficient, activeProducts, inactiveProducts],
                    backgroundColor: [
                        '#ef4444',
                        '#10b981',
                        '#1e5c4a',
                        '#6b7280'
                    ],
                    borderColor: [
                        '#dc2626',
                        '#059669',
                        '#17423b',
                        '#4b5563'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.label}: ${context.parsed.y} produits`;
                            }
                        }
                    }
                }
            }
        });

        // Graphique barres horizontales - Top 10 des produits
        const topProductsCtx = document.getElementById('topProductsChart').getContext('2d');
        let topProductsChart;
        
        // Fonction pour obtenir les données selon le critère
        function getTopProductsData(criteria) {
            const productsData = stocks.map(stock => {
                let value, label, unit;
                
                switch(criteria) {
                    case 'valeur':
                        value = stock.quantite_disponible * (stock.cout_unitaire || 0);
                        label = 'Valeur en stock (FCFA)';
                        unit = 'FCFA';
                        break;
                    case 'quantite':
                        value = stock.quantite_disponible;
                        label = 'Quantité disponible';
                        unit = stock.unite;
                        break;
                    case 'cout_unitaire':
                        value = stock.cout_unitaire || 0;
                        label = 'Coût unitaire (FCFA)';
                        unit = 'FCFA';
                        break;
                    case 'seuil_alerte':
                        value = stock.quantite_minimale;
                        label = 'Seuil d\'alerte';
                        unit = stock.unite;
                        break;
                    default:
                        value = stock.quantite_disponible * (stock.cout_unitaire || 0);
                        label = 'Valeur en stock (FCFA)';
                        unit = 'FCFA';
                }
                
                return {
                    name: stock.produit,
                    value: value,
                    category: stock.categorie,
                    label: label,
                    unit: unit,
                    quantite_disponible: stock.quantite_disponible,
                    cout_unitaire: stock.cout_unitaire,
                    unite: stock.unite,
                    quantite_minimale: stock.quantite_minimale
                };
            }).sort((a, b) => b.value - a.value).slice(0, 10);
            
            return productsData;
        }
        
        // Fonction pour créer/mettre à jour le graphique
        function updateTopProductsChart(criteria) {
            const productsData = getTopProductsData(criteria);
            
            if (topProductsChart) {
                topProductsChart.destroy();
            }
            
            topProductsChart = new Chart(topProductsCtx, {
                type: 'bar',
                data: {
                    labels: productsData.map(p => p.name.length > 20 ? p.name.substring(0, 20) + '...' : p.name),
                    datasets: [{
                        label: productsData[0]?.label || 'Valeur en stock (FCFA)',
                        data: productsData.map(p => p.value),
                        backgroundColor: '#1e5c4a',
                        borderColor: '#17423b',
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    const unit = productsData[0]?.unit || 'FCFA';
                                    if (unit === 'FCFA') {
                                        return value.toLocaleString() + ' ' + unit;
                                    }
                                    return value.toLocaleString() + ' ' + unit;
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const product = productsData[context.dataIndex];
                                    const unit = product.unit;
                                    let valueDisplay;
                                    
                                    if (unit === 'FCFA') {
                                        valueDisplay = context.parsed.x.toLocaleString() + ' ' + unit;
                                    } else {
                                        valueDisplay = context.parsed.x.toLocaleString() + ' ' + unit;
                                    }
                                    
                                    return [
                                        `Produit: ${product.name}`,
                                        `Catégorie: ${product.category}`,
                                        `${product.label}: ${valueDisplay}`,
                                        `Quantité disponible: ${product.quantite_disponible} ${product.unite}`,
                                        `Coût unitaire: ${product.cout_unitaire?.toLocaleString() || 0} FCFA`
                                    ];
                                }
                            }
                        }
                    }
                }
            });
        }
        
        // Initialiser le graphique avec le critère par défaut
        updateTopProductsChart('valeur');
        
        // Écouter les changements du sélecteur
        document.getElementById('topCriteria').addEventListener('change', function() {
            updateTopProductsChart(this.value);
        });
    </script>
</body>
</html> 