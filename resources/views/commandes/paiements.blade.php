<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GMAO Trans'urb - Paiements des Bons de commande</title>
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
            padding: 0.8rem 1.5rem;
            text-align: left;
            cursor: pointer;
            display: flex;
            align-items: center;
            color: #17423b;
            font-weight: 500;
            transition: background 0.2s;
        }
        .dropdown-item:hover {
            background: #eafaf4;
        }
        .btn-primary {
            background: #1e5c4a;
            color: #fff;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: background 0.2s;
        }
        .btn-primary:hover {
            background: #17423b;
        }
        .btn-secondary {
            background: #6b7280;
            color: #fff;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: background 0.2s;
        }
        .btn-secondary:hover {
            background: #4b5563;
        }
        .btn-success {
            background: #10b981;
            color: #fff;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.875rem;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            transition: background 0.2s;
        }
        .btn-success:hover {
            background: #059669;
        }
        .content-card {
            background: #fff;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 2px 12px rgba(23,66,59,0.08);
            margin-bottom: 2rem;
        }
        .stat-card {
            background: #fff;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 2px 12px rgba(23,66,59,0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .stat-label {
            font-size: 0.875rem;
            color: #6b7280;
            font-weight: 500;
        }
        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #17423b;
            margin-top: 0.25rem;
        }
        .icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }
        .icon.blue { background: #dbeafe; color: #1d4ed8; }
        .icon.green { background: #dcfce7; color: #16a34a; }
        .icon.yellow { background: #fef3c7; color: #d97706; }
        .icon.red { background: #fee2e2; color: #dc2626; }
        .icon.purple { background: #f3e8ff; color: #7c3aed; }
        .icon.indigo { background: #e0e7ff; color: #4338ca; }
        .table-container {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(23,66,59,0.08);
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th {
            background: #f8fafc;
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: #374151;
            border-bottom: 1px solid #e5e7eb;
        }
        .table td {
            padding: 1rem;
            border-bottom: 1px solid #f3f4f6;
            color: #374151;
        }
        .table tr:hover {
            background: #f9fafb;
        }
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }
        .status-impaye {
            background: #fee2e2;
            color: #dc2626;
        }
        .status-redevance {
            background: #fef3c7;
            color: #d97706;
        }
        .status-echu {
            background: #dcfce7;
            color: #16a34a;
        }
        .filters {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }
        .filter-btn {
            padding: 0.5rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background: #fff;
            color: #374151;
            cursor: pointer;
            transition: all 0.2s;
        }
        .filter-btn.active {
            background: #1e5c4a;
            color: #fff;
            border-color: #1e5c4a;
        }
        .filter-btn:hover {
            background: #eafaf4;
        }
        .filter-btn.active:hover {
            background: #17423b;
        }
        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }
        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
    </style>
</head>
<body>
    <div class="header-bg">
        <nav class="main-navbar">
            <span class="text-xl font-bold tracking-wide">Trans'urb GMAO</span>
            <div class="profile-box">
                <i class="fas fa-user-circle text-lg"></i>
                <span>Admin</span>
            </div>
        </nav>
        <div class="welcome-banner">
            <div>
                <div class="greeting">Paiements des Bons de commande</div>
                <div class="subtitle">Gestion des paiements et facturation</div>
            </div>
            <div class="flex gap-4">
                <a href="{{ route('dashboard.moyens-generaux') }}" class="nav-link">
                    <i class="fas fa-home mr-2"></i>Accueil
                </a>
                <a href="{{ route('liste.commandes') }}" class="nav-link">
                    <i class="fas fa-arrow-left mr-2"></i>Retour
                </a>
            </div>
        </div>
    </div>

    <div class="main-content">
        <!-- Menu secondaire harmonisé -->
        <div class="menu-bar" style="background: #fff; border-radius: 16px; box-shadow: 0 2px 12px rgba(23,66,59,0.08); padding: 0.7rem 2.5rem; display: flex; justify-content: center; gap: 2.5rem; margin-bottom: 2rem;">
            <!-- Bons de commande -->
            <div class="menu-dropdown" style="position: relative;">
                <button class="menu-btn">
                    <i class="fas fa-shopping-cart mr-2 text-blue-600"></i>Bons de commande <i class="fas fa-chevron-down ml-1"></i>
                </button>
                <ul class="dropdown-content">
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('nouvelle.commande') }}'"><i class="fas fa-plus mr-2"></i>Nouveau Bon de commande</button></li>
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('liste.commandes') }}'"><i class="fas fa-list mr-2"></i>Liste Bons de commande</button></li>
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
                    <li><button class="dropdown-item" onclick="window.location.href='# '"><i class="fas fa-star mr-2"></i>Évaluations</button></li>
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

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
            </div>
        @endif

        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="stat-card">
                <div>
                    <div class="stat-label">Total à payer</div>
                    <div class="stat-value">{{ number_format($commandes->sum('montant_a_payer'), 0, ',', ' ') }} FCFA</div>
                </div>
                <div class="icon blue"><i class="fas fa-euro-sign"></i></div>
            </div>
            <div class="stat-card">
                <div>
                    <div class="stat-label">Avances versées</div>
                    <div class="stat-value">{{ number_format($commandes->sum('avance'), 0, ',', ' ') }} FCFA</div>
                </div>
                <div class="icon green"><i class="fas fa-credit-card"></i></div>
            </div>
            <div class="stat-card">
                <div>
                    <div class="stat-label">Reste à payer</div>
                    <div class="stat-value">{{ number_format($commandes->sum('reste_a_payer'), 0, ',', ' ') }} FCFA</div>
                </div>
                <div class="icon yellow"><i class="fas fa-clock"></i></div>
            </div>
            <div class="stat-card">
                <div>
                    <div class="stat-label">Commandes payées</div>
                    <div class="stat-value">{{ $commandes->where('statut_paiement', 'echu')->count() }}</div>
                </div>
                <div class="icon purple"><i class="fas fa-check-circle"></i></div>
            </div>
        </div>

        <!-- Filtres -->
        <div class="filters">
            <button class="filter-btn active" onclick="filterByStatus('all')">Toutes</button>
            <button class="filter-btn" onclick="filterByStatus('impaye')">Impayées</button>
            <button class="filter-btn" onclick="filterByStatus('redevance')">Redevances</button>
            <button class="filter-btn" onclick="filterByStatus('echu')">Échues</button>
        </div>

        <!-- Tableau des paiements -->
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Référence</th>
                        <th>Fournisseur</th>
                        <th>Date Commande</th>
                        <th>Montant à payer</th>
                        <th>Avance</th>
                        <th>Reste</th>
                        <th>Statut Paiement</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($commandes as $commande)
                        <tr class="commande-row" data-status="{{ $commande->statut_paiement }}">
                            <td>
                                <strong>{{ $commande->reference }}</strong>
                                <div class="text-sm text-gray-500">{{ $commande->statut_label }}</div>
                            </td>
                            <td>{{ $commande->fournisseur->nom ?? 'N/A' }}</td>
                            <td>{{ $commande->date_commande->format('d/m/Y') }}</td>
                            <td>
                                <strong>{{ number_format($commande->montant_a_payer, 0, ',', ' ') }} FCFA</strong>
                            </td>
                            <td>
                                @if($commande->avance > 0)
                                    <span class="text-green-600">{{ number_format($commande->avance, 0, ',', ' ') }} FCFA</span>
                                @else
                                    <span class="text-gray-400">0 FCFA</span>
                                @endif
                            </td>
                            <td>
                                @if($commande->reste_a_payer > 0)
                                    <span class="text-red-600 font-semibold">{{ number_format($commande->reste_a_payer, 0, ',', ' ') }} FCFA</span>
                                @else
                                    <span class="text-green-600 font-semibold">0 FCFA</span>
                                @endif
                            </td>
                            <td>
                                <span class="status-badge status-{{ $commande->statut_paiement }}">
                                    {{ $commande->statut_paiement_label }}
                                </span>
                            </td>
                            <td>
                                <div class="flex gap-2">
                                    <a href="{{ route('commande.paiement', $commande) }}" class="text-green-600 hover:text-green-800" title="Effectuer un paiement">
                                        <i class="fas fa-credit-card"></i>
                                    </a>
                                    <a href="{{ route('commande.details', $commande) }}" class="text-blue-600 hover:text-blue-800" title="Voir les détails">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-8 text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-4"></i>
                                <div>Aucune commande payable trouvée</div>
                                <div class="text-sm mt-2">Les commandes doivent être approuvées ou livrées pour apparaître ici</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function filterByStatus(status) {
            // Mettre à jour les boutons de filtre
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');

            // Filtrer les lignes
            const rows = document.querySelectorAll('.commande-row');
            rows.forEach(row => {
                if (status === 'all' || row.dataset.status === status) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html> 