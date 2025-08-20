<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GMAO Trans'urb - Historique des Sorties de Stock</title>
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
        .btn-danger {
            background: #dc2626;
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
            border: none;
            cursor: pointer;
        }
        .btn-danger:hover {
            background: #b91c1c;
        }
        .btn-secondary {
            background: #6b7280;
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
        .btn-secondary:hover {
            background: #4b5563;
        }
        .content-card {
            background: #fff;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 2px 12px rgba(23,66,59,0.08);
            margin-bottom: 2rem;
        }
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
        .status-validee {
            background: #dcfce7;
            color: #16a34a;
        }
        .status-annulee {
            background: #fee2e2;
            color: #dc2626;
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
        
        /* Styles pour le tableau coloré */
        .table-container {
            background: #fff;
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
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #0f2e26;
        }
        
        .table thead th:first-child {
            border-top-left-radius: 16px;
        }
        
        .table thead th:last-child {
            border-top-right-radius: 16px;
        }
        
        .table tbody tr {
            transition: all 0.2s ease;
            border-bottom: 1px solid #f3f4f6;
        }
        
        .table tbody tr:hover {
            background: #f8fafc;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(23,66,59,0.1);
        }
        
        .table tbody tr:last-child {
            border-bottom: none;
        }
        
        .table tbody td {
            padding: 1rem;
            vertical-align: top;
        }
        
        .table tbody tr:nth-child(even) {
            background: #f9fafb;
        }
        
        .table tbody tr:nth-child(even):hover {
            background: #f1f5f9;
        }
        
        /* Badges de statut colorés */
        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .status-validee {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
        }
        
        .status-annulee {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
        }
        
        /* Boutons d'action stylisés */
        .btn-secondary {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 2px 8px rgba(107, 114, 128, 0.3);
        }
        
        .btn-secondary:hover {
            background: linear-gradient(135deg, #4b5563 0%, #374151 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(107, 114, 128, 0.4);
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
        }
        
        .btn-danger:hover {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
        }
        
        /* Mise en valeur des données importantes */
        .cost-highlight {
            color: #1e5c4a;
            font-weight: 700;
        }
        
        .quantity-highlight {
            color: #059669;
            font-weight: 700;
        }
        
        .date-highlight {
            color: #6366f1;
            font-weight: 600;
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
                <div class="greeting">Historique des Sorties de Stock</div>
                <div class="subtitle">Traçabilité complète des distributions</div>
            </div>
            <div class="flex gap-4">
                <a href="{{ route('stocks.sorties.create') }}" class="nav-link">
                    <i class="fas fa-plus mr-2"></i>Nouvelle Sortie
                </a>
                <a href="{{ route('stocks.index') }}" class="nav-link">
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

        <!-- Tableau des sorties -->
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th>Service</th>
                        <th>Personne</th>
                        <th>Poste</th>
                        <th>Motif</th>
                        <th>Coût Total</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sorties as $sortie)
                        <tr>
                            <td>
                                <div class="font-semibold date-highlight">{{ $sortie->created_at->format('d/m/Y') }}</div>
                                <div class="text-sm text-gray-500">{{ $sortie->created_at->format('H:i') }}</div>
                            </td>
                            <td>
                                <div class="font-semibold">{{ $sortie->reference_produit }}</div>
                                <div class="text-sm text-gray-500">{{ $sortie->stock->description ?? '' }}</div>
                            </td>
                            <td>
                                <strong class="quantity-highlight">{{ $sortie->quantite_sortie }} {{ $sortie->unite }}</strong>
                            </td>
                            <td>
                                <div class="text-sm">{{ $sortie->service_destinataire }}</div>
                            </td>
                            <td>
                                <div class="font-semibold">{{ $sortie->personne_destinataire }}</div>
                            </td>
                            <td>
                                <div class="text-sm">{{ $sortie->poste_destinataire }}</div>
                            </td>
                            <td>
                                <div class="text-sm">{{ $sortie->motif_sortie }}</div>
                            </td>
                            <td>
                                <strong class="cost-highlight">{{ number_format($sortie->cout_total, 0, ',', ' ') }} FCFA</strong>
                            </td>
                            <td>
                                <span class="status-badge status-{{ $sortie->statut }}">
                                    {{ $sortie->statut_label }}
                                </span>
                            </td>
                            <td>
                                <div class="flex gap-2">
                                    <a href="{{ route('stocks.sorties.show', $sortie) }}" class="text-blue-600 hover:text-blue-800" title="Voir les détails">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($sortie->peutEtreAnnulee())
                                        <form action="{{ route('stocks.sorties.annuler', $sortie) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette sortie ? Le stock sera remis à jour.')">
                                            @csrf
                                            <button type="submit" class="text-red-600 hover:text-red-800" title="Annuler la sortie">
                                                <i class="fas fa-undo"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center py-8 text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-4"></i>
                                <div>Aucune sortie de stock enregistrée</div>
                                <div class="text-sm mt-2">Les sorties apparaîtront ici après enregistrement</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($sorties->hasPages())
            <div class="mt-6">
                {{ $sorties->links() }}
            </div>
        @endif
    </div>
</body>
</html> 