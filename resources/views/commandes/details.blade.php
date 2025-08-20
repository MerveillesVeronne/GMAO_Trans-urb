<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GMAO Trans'urb - Détails Commande</title>
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
        .dropdown-item:first-child {
            border-radius: 8px 8px 0 0;
        }
        .dropdown-item:last-child {
            border-radius: 0 0 8px 8px;
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
        .ligne-produit {
            background: #f9fafb;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1rem;
        }
        .livraison-item {
            background: #f0f9ff;
            border: 1px solid #0ea5e9;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 0.5rem;
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
                <div class="greeting">Détails de la Commande</div>
                <div class="subtitle">Référence: {{ $commande->reference }}</div>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-shopping-cart" style="font-size: 2.5rem; color: #ffe082;"></i>
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
                <h2 class="text-2xl font-bold text-gray-900">{{ $commande->reference }}</h2>
                <p class="text-gray-600">{{ $commande->fournisseur->nom }}</p>
                @if($commande->bonCommande)
                    <div class="mt-2">
                        <span class="text-sm text-gray-500">Bon de commande:</span>
                        <a href="{{ route('bons-commande.show', $commande->bonCommande) }}" class="text-blue-600 hover:text-blue-900 font-medium ml-1">
                            {{ $commande->bonCommande->reference }}
                        </a>
                        <span class="text-sm text-gray-500 ml-2">- {{ $commande->bonCommande->titre }}</span>
                    </div>
                @endif
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('liste.commandes') }}" class="btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i>Retour
                </a>
                <a href="{{ route('commande.edit', $commande) }}" class="btn-primary">
                    <i class="fas fa-edit mr-2"></i>Modifier
                </a>
                <a href="{{ route('livraisons.create', $commande) }}" class="btn-success">
                    <i class="fas fa-truck mr-2"></i>Nouvelle Livraison
                </a>
            </div>
        </div>

        <!-- Informations générales -->
        <div class="content-card">
            <div class="flex justify-between items-start mb-6">
                <h3 class="text-xl font-bold text-gray-900">Informations générales</h3>
                <span class="status-badge status-{{ $commande->statut }}">
                    {{ $commande->statut_label }}
                </span>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <h4 class="font-semibold text-gray-700 mb-2">Fournisseur</h4>
                    <p class="text-gray-900">{{ $commande->fournisseur->nom }}</p>
                    <p class="text-sm text-gray-600">{{ $commande->fournisseur->adresse }}</p>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-700 mb-2">Dates</h4>
                    <p class="text-gray-900">Commande: {{ $commande->date_commande->format('d/m/Y') }}</p>
                    @if($commande->date_livraison)
                        <p class="text-gray-900">Livraison prévue: {{ $commande->date_livraison->format('d/m/Y') }}</p>
                    @endif
                </div>
                <div>
                    <h4 class="font-semibold text-gray-700 mb-2">Montant total</h4>
                    <p class="text-2xl font-bold text-green-600">{{ number_format($commande->montant_total, 0, ',', ' ') }} FCFA</p>
                    
                    @if($commande->montant_a_payer)
                        <div class="mt-2">
                            <h5 class="font-semibold text-gray-600 mb-1">Informations de paiement</h5>
                            <div class="grid grid-cols-1 gap-1 text-sm">
                                <div class="flex justify-between">
                                    <span>Montant à payer:</span>
                                    <span class="font-semibold">{{ number_format($commande->montant_a_payer, 0, ',', ' ') }} FCFA</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Avance versée:</span>
                                    <span class="font-semibold text-green-600">{{ number_format($commande->avance, 0, ',', ' ') }} FCFA</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Reste à payer:</span>
                                    <span class="font-semibold text-red-600">{{ number_format($commande->reste_a_payer, 0, ',', ' ') }} FCFA</span>
                                </div>
                                <div class="flex justify-between items-center mt-1">
                                    <span>Statut:</span>
                                    <span class="status-badge status-{{ $commande->statut_paiement }}">
                                        {{ $commande->statut_paiement_label }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            @if($commande->commentaires)
                <div class="mt-6">
                    <h4 class="font-semibold text-gray-700 mb-2">Commentaires</h4>
                    <p class="text-gray-900">{{ $commande->commentaires }}</p>
                </div>
            @endif

            <!-- Informations du bon de commande associé -->
            @if($commande->bonCommande)
                <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <h4 class="font-semibold text-blue-900 mb-3">
                        <i class="fas fa-file-alt mr-2"></i>Bon de commande associé
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        <div>
                            <span class="font-medium text-blue-700">Référence:</span>
                            <div class="font-bold text-blue-900">{{ $commande->bonCommande->reference }}</div>
                        </div>
                        <div>
                            <span class="font-medium text-blue-700">Titre:</span>
                            <div class="font-bold text-blue-900">{{ $commande->bonCommande->titre }}</div>
                        </div>
                        <div>
                            <span class="font-medium text-blue-700">Budget total:</span>
                            <div class="font-bold text-blue-900">{{ number_format($commande->bonCommande->budget_total, 0, ',', ' ') }} FCFA</div>
                        </div>
                        <div>
                            <span class="font-medium text-blue-700">Budget utilisé:</span>
                            <div class="font-bold text-blue-900">{{ number_format($commande->bonCommande->getMontantCommandesValidees(), 0, ',', ' ') }} FCFA</div>
                        </div>
                        <div>
                            <span class="font-medium text-blue-700">Budget restant:</span>
                            <div class="font-bold text-blue-900">{{ number_format($commande->bonCommande->getBudgetRestantApresValidation(), 0, ',', ' ') }} FCFA</div>
                        </div>
                        <div>
                            <span class="font-medium text-blue-700">Utilisation:</span>
                            <div class="font-bold text-blue-900">{{ $commande->bonCommande->getPourcentageBudgetUtilise() }}%</div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('bons-commande.show', $commande->bonCommande) }}" class="text-blue-600 hover:text-blue-900 font-medium text-sm">
                            <i class="fas fa-external-link-alt mr-1"></i>Voir les détails du bon de commande
                        </a>
                    </div>
                </div>
            @endif

            <!-- Progression de livraison -->
            <div class="mt-6">
                <div class="flex justify-between items-center mb-2">
                    <h4 class="font-semibold text-gray-700">Progression de livraison</h4>
                    <span class="text-sm text-gray-600">{{ round($commande->getPourcentageLivraison(), 1) }}%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: {{ $commande->getPourcentageLivraison() }}%"></div>
                </div>
            </div>
        </div>

        <!-- Produits commandés -->
        <div class="content-card">
            <h3 class="text-xl font-bold text-gray-900 mb-6">Produits commandés</h3>
            
            @foreach($commande->lignes as $ligne)
                <div class="ligne-produit">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900">{{ $ligne->produit }}</h4>
                            @if($ligne->description)
                                <p class="text-gray-600 text-sm">{{ $ligne->description }}</p>
                            @endif
                        </div>
                        <span class="status-badge status-{{ $ligne->statut_ligne }}">
                            {{ $ligne->statut_ligne_label }}
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                        <div>
                            <span class="text-sm text-gray-600">Quantité commandée:</span>
                            <p class="font-semibold">{{ $ligne->quantite }} {{ $ligne->unite ?? 'unité' }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-600">Quantité livrée:</span>
                            <p class="font-semibold text-green-600">{{ $ligne->quantite_livree }} {{ $ligne->unite ?? 'unité' }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-600">Reste à livrer:</span>
                            <p class="font-semibold text-orange-600">{{ $ligne->getQuantiteRestante() }} {{ $ligne->unite ?? 'unité' }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-600">Coût unitaire:</span>
                            <p class="font-semibold">{{ number_format($ligne->cout_unitaire, 0, ',', ' ') }} FCFA</p>
                        </div>
                    </div>

                    <!-- Progression de cette ligne -->
                    <div class="mb-4">
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-sm text-gray-600">Progression</span>
                            <span class="text-sm text-gray-600">{{ round($ligne->getPourcentageLivraison(), 1) }}%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: {{ $ligne->getPourcentageLivraison() }}%"></div>
                        </div>
                    </div>

                    <!-- Historique des livraisons pour cette ligne -->
                    @if($ligne->livraisons->count() > 0)
                        <div class="mt-4">
                            <h5 class="font-semibold text-gray-700 mb-2">Historique des livraisons</h5>
                            @foreach($ligne->livraisons as $livraison)
                                <div class="livraison-item">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <span class="font-medium">{{ $livraison->quantite_livree }} {{ $ligne->unite ?? 'unité' }}</span>
                                            <span class="text-sm text-gray-600 ml-2">le {{ $livraison->date_livraison->format('d/m/Y') }}</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="status-badge status-{{ $livraison->statut }}">
                                                {{ $livraison->statut_label }}
                                            </span>
                                            @if($livraison->valide_par)
                                                <span class="text-xs text-gray-500">
                                                    <i class="fas fa-check text-green-500"></i> Validée
                                                </span>
                                            @else
                                                <form method="POST" action="{{ route('livraisons.valider', $livraison) }}" class="inline">
                                                    @csrf
                                                    <button type="submit" class="btn-success text-xs">
                                                        <i class="fas fa-check mr-1"></i>Valider
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                    @if($livraison->commentaires)
                                        <p class="text-sm text-gray-600 mt-1">{{ $livraison->commentaires }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Actions pour cette ligne -->
                    @if(!$ligne->isLivraisonComplete())
                        <div class="mt-4 flex gap-2">
                            <button class="btn-success text-sm" onclick="ouvrirModalLivraison({{ $ligne->id }}, '{{ $ligne->produit }}', {{ $ligne->getQuantiteRestante() }}, '{{ $ligne->unite ?? 'unité' }}')">
                                <i class="fas fa-check mr-1"></i>Valider la livraison
                            </button>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- Actions sur la commande -->
        <div class="content-card">
            <h3 class="text-xl font-bold text-gray-900 mb-6">Actions</h3>
            
            <div class="flex flex-wrap gap-4">
                @if($commande->statut == 'en_attente')
                    @if($commande->peutEtreApprouvee())
                        <button type="button" class="btn-success" onclick="afficherModalApprobation()">
                            <i class="fas fa-check mr-2"></i>Approuver la Commande
                        </button>
                    @else
                        <button type="button" class="btn-secondary" disabled title="Aucune livraison validée">
                            <i class="fas fa-clock mr-2"></i>En attente de livraisons
                        </button>
                    @endif
                @endif

                @if($commande->statut == 'approuvee')
                    <form method="POST" action="{{ route('commande.livrer', $commande) }}" class="inline">
                        @csrf
                        <button type="submit" class="btn-success" onclick="return confirm('Marquer comme livrée ?')">
                            <i class="fas fa-truck mr-2"></i>Marquer comme livrée
                        </button>
                    </form>
                @endif

                @if($commande->statut != 'livree')
                    <form method="POST" action="{{ route('commande.annuler', $commande) }}" class="inline">
                        @csrf
                        <button type="submit" class="btn-danger" onclick="return confirm('Annuler cette commande ?')">
                            <i class="fas fa-times mr-2"></i>Annuler
                        </button>
                    </form>
                @endif

                <a href="{{ route('livraisons.create', $commande) }}" class="btn-primary">
                    <i class="fas fa-truck mr-2"></i>Nouvelle Livraison
                </a>
            </div>
        </div>
    </div>

    <!-- Modal pour modifier une ligne -->
    <div id="editLigneModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg p-6 w-full max-w-md">
                <h3 class="text-lg font-bold mb-4">Modifier la ligne</h3>
                <form id="editLigneForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Quantité</label>
                        <input type="number" name="quantite" id="editQuantite" class="w-full border border-gray-300 rounded-md px-3 py-2" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Coût unitaire</label>
                        <input type="number" name="cout_unitaire" id="editCoutUnitaire" step="0.01" class="w-full border border-gray-300 rounded-md px-3 py-2">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Commentaires</label>
                        <textarea name="commentaires" id="editCommentaires" rows="3" class="w-full border border-gray-300 rounded-md px-3 py-2"></textarea>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeEditModal()" class="btn-secondary">Annuler</button>
                        <button type="submit" class="btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal d'approbation avec résumé des livraisons -->
    <div id="approbationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg p-6 w-full max-w-4xl max-h-[90vh] overflow-y-auto">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-900">
                        <i class="fas fa-check-circle text-green-600 mr-2"></i>
                        Approuver la Commande
                    </h3>
                    <button type="button" onclick="closeApprobationModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <div class="mb-6">
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                        <h4 class="font-semibold text-blue-900 mb-2">Résumé de la commande</h4>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="font-medium">Référence:</span> {{ $commande->reference }}
                            </div>
                            <div>
                                <span class="font-medium">Fournisseur:</span> {{ $commande->fournisseur->nom }}
                            </div>
                            <div>
                                <span class="font-medium">Montant commandé:</span> {{ number_format($commande->calculerMontantTotal(), 2) }} FCFA
                            </div>
                            <div>
                                <span class="font-medium">Montant à payer:</span> <span class="font-bold text-green-600">{{ number_format($commande->calculerMontantReel(), 2) }} FCFA</span>
                            </div>
                        </div>
                    </div>

                    <h4 class="font-semibold text-gray-900 mb-3">Détail des livraisons par produit</h4>
                    <div class="overflow-x-auto">
                        <table class="w-full border border-gray-200 rounded-lg">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Produit</th>
                                    <th class="px-4 py-2 text-center text-sm font-medium text-gray-700">Commandé</th>
                                    <th class="px-4 py-2 text-center text-sm font-medium text-gray-700">Livré</th>
                                    <th class="px-4 py-2 text-center text-sm font-medium text-gray-700">Manquant</th>
                                    <th class="px-4 py-2 text-center text-sm font-medium text-gray-700">Coût unit.</th>
                                    <th class="px-4 py-2 text-center text-sm font-medium text-gray-700">Montant ligne</th>
                                    <th class="px-4 py-2 text-center text-sm font-medium text-gray-700">Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($commande->getResumeLivraisons() as $resume)
                                    <tr class="border-t border-gray-200">
                                        <td class="px-4 py-3 text-sm">{{ $resume['produit'] }}</td>
                                        <td class="px-4 py-3 text-sm text-center">{{ $resume['quantite_commandee'] }}</td>
                                        <td class="px-4 py-3 text-sm text-center font-medium text-green-600">{{ $resume['quantite_livree'] }}</td>
                                        <td class="px-4 py-3 text-sm text-center">
                                            @if($resume['quantite_manquante'] > 0)
                                                <span class="text-red-600 font-medium">{{ $resume['quantite_manquante'] }}</span>
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-sm text-center">{{ number_format($resume['cout_unitaire'], 2) }} FCFA</td>
                                        <td class="px-4 py-3 text-sm text-center font-medium">{{ number_format($resume['montant_ligne_livree'], 2) }} FCFA</td>
                                        <td class="px-4 py-3 text-sm text-center">
                                            @if($resume['statut'] === 'Complète')
                                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Complète</span>
                                            @else
                                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">Partielle</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-triangle text-yellow-600 mt-1 mr-3"></i>
                        <div>
                            <h4 class="font-semibold text-yellow-900 mb-2">Important</h4>
                            <p class="text-sm text-yellow-800">
                                En approuvant cette commande, vous confirmez que le montant à payer sera ajusté selon les quantités réellement livrées et validées. 
                                Les produits non livrés ou partiellement livrés ne seront pas facturés.
                            </p>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('commande.approuver', $commande) }}" class="flex justify-end gap-3">
                    @csrf
                    <button type="button" onclick="closeApprobationModal()" class="btn-secondary">
                        <i class="fas fa-times mr-2"></i>Annuler
                    </button>
                    <button type="submit" class="btn-success">
                        <i class="fas fa-check mr-2"></i>Confirmer l'approbation
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de validation de livraison -->
    <div id="modalLivraison" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg p-6 w-full max-w-md">
                <h3 class="text-lg font-bold mb-4">Valider la livraison <span id="modalProduit"></span></h3>
                <form id="formLivraison" method="POST" action="">
                    @csrf
                    <input type="hidden" name="ligne_commande_id" id="modalLigneId">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Date de livraison effective</label>
                        <input type="date" name="date_livraison" id="modalDate" class="w-full border border-gray-300 rounded-md px-3 py-2" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Quantité livrée</label>
                        <input type="number" name="quantite_livree" id="modalQuantite" min="1" class="w-full border border-gray-300 rounded-md px-3 py-2" required>
                        <div class="text-xs text-gray-500 mt-1">Reste à livrer : <span id="modalReste"></span></div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Commentaire (optionnel)</label>
                        <textarea name="commentaires" id="modalCommentaires" rows="2" class="w-full border border-gray-300 rounded-md px-3 py-2"></textarea>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="fermerModalLivraison()" class="btn-secondary">Annuler</button>
                        <button type="submit" class="btn-success">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openEditModal(ligneId, quantite, coutUnitaire, commentaires) {
            document.getElementById('editQuantite').value = quantite;
            document.getElementById('editCoutUnitaire').value = coutUnitaire;
            document.getElementById('editCommentaires').value = commentaires;
            document.getElementById('editLigneForm').action = `/lignes-commande/${ligneId}`;
            document.getElementById('editLigneModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editLigneModal').classList.add('hidden');
        }

        // Fonctions pour le modal d'approbation
        function afficherModalApprobation() {
            document.getElementById('approbationModal').classList.remove('hidden');
        }

        function closeApprobationModal() {
            document.getElementById('approbationModal').classList.add('hidden');
        }

        // Fermer les modals en cliquant à l'extérieur
        document.getElementById('editLigneModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });

        document.getElementById('approbationModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeApprobationModal();
            }
        });

        // Fermer les modals avec la touche Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeEditModal();
                closeApprobationModal();
            }
        });

        function ouvrirModalLivraison(ligneId, produit, reste, unite) {
            document.getElementById('modalLivraison').classList.remove('hidden');
            document.getElementById('modalProduit').innerText = produit;
            document.getElementById('modalLigneId').value = ligneId;
            document.getElementById('modalQuantite').value = '';
            document.getElementById('modalQuantite').max = reste;
            document.getElementById('modalReste').innerText = reste + ' ' + unite;
            document.getElementById('modalDate').value = '';
            document.getElementById('modalCommentaires').value = '';
            document.getElementById('formLivraison').action = '/livraisons/valider-ligne/' + ligneId;
        }
        function fermerModalLivraison() {
            document.getElementById('modalLivraison').classList.add('hidden');
        }
        document.getElementById('modalLivraison').addEventListener('click', function(e) {
            if (e.target === this) fermerModalLivraison();
        });
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') fermerModalLivraison();
        });
    </script>
</body>
</html> 