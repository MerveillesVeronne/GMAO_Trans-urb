<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GMAO Trans'urb - Liste des Bons de commande</title>
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
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 0.8rem 1rem;
            font-size: 1rem;
            transition: border-color 0.2s;
        }
        .form-input:focus {
            outline: none;
            border-color: #1e5c4a;
        }
        .form-label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }
        .status-badge {
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 600;
        }
        .status-en-attente {
            background: #fef3c7;
            color: #92400e;
        }
        .status-approuvee {
            background: #dbeafe;
            color: #1e40af;
        }
        .status-livree {
            background: #d1fae5;
            color: #065f46;
        }
        .status-annulee {
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
                <div class="greeting">Liste des Bons de commande</div>
                <div class="subtitle">Gestion des commandes et achats</div>
                </div>
            <div class="hidden md:block">
                <i class="fas fa-shopping-cart" style="font-size: 2.5rem; color: #ffe082;"></i>
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

        <!-- En-tête -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Liste des Bons de commande</h2>
            <div class="flex space-x-3">
                <a href="{{ route('commandes.export') }}" class="btn-secondary">
                    <i class="fas fa-file-pdf mr-2"></i>Export PDF
                </a>
                <a href="{{ route('nouvelle.commande') }}" class="btn-primary">
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

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Filtres -->
        <div class="content-card">
            <form method="GET" action="{{ route('liste.commandes') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="form-label">Statut</label>
                    <select name="statut" class="form-input">
                        <option value="">Tous les statuts</option>
                        <option value="en_attente" {{ request('statut') == 'en_attente' ? 'selected' : '' }}>En Attente</option>
                        <option value="approuvee" {{ request('statut') == 'approuvee' ? 'selected' : '' }}>Approuvée</option>
                        <option value="livree" {{ request('statut') == 'livree' ? 'selected' : '' }}>Livrée</option>
                        <option value="annulee" {{ request('statut') == 'annulee' ? 'selected' : '' }}>Annulée</option>
                    </select>
                </div>
                <div>
                    <label class="form-label">Fournisseur</label>
                    <select name="fournisseur_id" class="form-input">
                        <option value="">Tous les fournisseurs</option>
                        @foreach($fournisseurs as $fournisseur)
                            <option value="{{ $fournisseur->id }}" {{ request('fournisseur_id') == $fournisseur->id ? 'selected' : '' }}>
                                {{ $fournisseur->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label">Date début</label>
                    <input type="date" name="date_debut" value="{{ request('date_debut') }}" class="form-input">
                </div>
                    <div>
                    <label class="form-label">Date fin</label>
                    <input type="date" name="date_fin" value="{{ request('date_fin') }}" class="form-input">
                    </div>
                <div class="md:col-span-4 flex gap-2">
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-search mr-2"></i>Filtrer
                    </button>
                    <a href="{{ route('liste.commandes') }}" class="btn-secondary">
                        <i class="fas fa-times mr-2"></i>Réinitialiser
                    </a>
                </div>
            </form>
            </div>

        <!-- Tableau des commandes -->
        <div class="content-card">
            @if($commandes->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Référence</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bon de commande</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fournisseur</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Commande</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Livraison</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Livraison</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($commandes as $commande)
                        <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $commande->reference }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        @if($commande->bonCommande)
                                            <a href="{{ route('bons-commande.show', $commande->bonCommande) }}" class="text-blue-600 hover:text-blue-900 font-medium">
                                                {{ $commande->bonCommande->reference }}
                                            </a>
                                            <div class="text-xs text-gray-500">{{ $commande->bonCommande->titre }}</div>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $commande->fournisseur->nom }}
                            </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $commande->date_commande->format('d/m/Y') }}
                            </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $commande->date_livraison ? $commande->date_livraison->format('d/m/Y') : '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        @if($commande->isLivraisonComplete())
                                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">
                                                <i class="fas fa-check mr-1"></i>100%
                                            </span>
                                        @elseif($commande->isLivraisonPartielle())
                                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">
                                                <i class="fas fa-clock mr-1"></i>{{ round($commande->getPourcentageLivraison()) }}%
                                            </span>
                                        @else
                                            <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs rounded-full">
                                                <i class="fas fa-times mr-1"></i>0%
                                            </span>
                                        @endif
                            </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        @if($commande->statut === 'approuvee' && $commande->calculerMontantReel() != $commande->montant_total)
                                            <div class="text-red-600 line-through">{{ number_format($commande->montant_total, 0, ',', ' ') }} FCFA</div>
                                            <div class="font-semibold text-green-600">{{ number_format($commande->calculerMontantReel(), 0, ',', ' ') }} FCFA</div>
                                            <div class="text-xs text-gray-500">Ajusté selon livraisons</div>
                                        @else
                                            {{ number_format($commande->montant_total, 0, ',', ' ') }} FCFA
                                        @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="status-badge status-{{ $commande->statut }}">
                                            {{ $commande->statut_label }}
                                        </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('commande.details', $commande) }}" class="text-blue-600 hover:text-blue-900">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('commande.edit', $commande) }}" class="text-green-600 hover:text-green-900">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @if($commande->statut == 'en_attente')
                                                <form method="POST" action="{{ route('commande.approuver', $commande) }}" class="inline">
                                                    @csrf
                                                    <button type="submit" class="text-blue-600 hover:text-blue-900" onclick="return confirm('Approuver cette commande ?')">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            @if($commande->statut == 'approuvee')
                                                <form method="POST" action="{{ route('commande.livrer', $commande) }}" class="inline">
                                                    @csrf
                                                    <button type="submit" class="text-green-600 hover:text-green-900" onclick="return confirm('Marquer comme livrée ?')">
                                                        <i class="fas fa-truck"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            @if($commande->statut != 'livree')
                                                <form method="POST" action="{{ route('commande.annuler', $commande) }}" class="inline">
                                                    @csrf
                                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Annuler cette commande ?')">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                            </td>
                        </tr>
                            @endforeach
                    </tbody>
                </table>
                </div>
                
                <!-- Pagination -->
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $commandes->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-shopping-cart text-4xl text-gray-400 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Aucune commande trouvée</h3>
                    <p class="text-gray-500 mb-4">Commencez par créer votre première commande.</p>
                    <a href="{{ route('nouvelle.commande') }}" class="btn-primary">
                        <i class="fas fa-plus mr-2"></i>Créer une commande
                    </a>
                </div>
            @endif
        </div>
    </div>
</body>
</html> 