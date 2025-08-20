<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GMAO Trans'urb - Sortie de Stock</title>
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
            max-width: 800px;
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
            border: none;
            cursor: pointer;
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
        .content-card {
            background: #fff;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 2px 12px rgba(23,66,59,0.08);
            margin-bottom: 2rem;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }
        .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.2s;
        }
        .form-input:focus, .form-select:focus, .form-textarea:focus {
            outline: none;
            border-color: #1e5c4a;
            box-shadow: 0 0 0 3px rgba(30, 92, 74, 0.1);
        }
        .form-textarea {
            min-height: 100px;
            resize: vertical;
        }
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        .info-item {
            background: #f8fafc;
            padding: 1rem;
            border-radius: 8px;
            border-left: 4px solid #1e5c4a;
        }
        .info-label {
            font-size: 0.875rem;
            color: #6b7280;
            font-weight: 500;
        }
        .info-value {
            font-size: 1.125rem;
            font-weight: 600;
            color: #17423b;
            margin-top: 0.25rem;
        }
        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
        .alert-warning {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fed7aa;
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
                <div class="greeting">Sortie de Stock</div>
                <div class="subtitle">Distribution de matériel avec traçabilité</div>
            </div>
            <div class="flex gap-4">
                <a href="{{ route('stocks.index') }}" class="nav-link">
                    <i class="fas fa-arrow-left mr-2"></i>Retour
                </a>
            </div>
        </div>
    </div>

    <div class="main-content">
        <!-- Menu secondaire harmonisé -->
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

        @if($errors->any())
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulaire de sortie de stock -->
        <div class="content-card">
            <h2 class="text-xl font-bold text-gray-900 mb-6">
                <i class="fas fa-sign-out-alt mr-2 text-red-600"></i>Nouvelle Sortie de Stock
            </h2>

            <form action="{{ route('stocks.sorties.store') }}" method="POST">
                @csrf
                
                <!-- Sélection du produit -->
                <div class="form-group">
                    <label for="stock_id" class="form-label">
                        Produit à sortir <span class="text-red-500">*</span>
                    </label>
                    <select id="stock_id" name="stock_id" class="form-select" required onchange="loadStockInfo()">
                        <option value="">Sélectionner un produit</option>
                        @foreach($stocks as $stock)
                            <option value="{{ $stock->id }}" 
                                    data-quantite="{{ $stock->quantite_disponible }}"
                                    data-unite="{{ $stock->unite }}"
                                    data-cout="{{ $stock->cout_unitaire }}">
                                {{ $stock->produit }} - {{ $stock->quantite_disponible }} {{ $stock->unite }} disponible
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Informations du produit sélectionné -->
                <div id="stock-info" class="info-grid" style="display: none;">
                    <div class="info-item">
                        <div class="info-label">Produit</div>
                        <div class="info-value" id="produit-info">-</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Quantité disponible</div>
                        <div class="info-value" id="quantite-info">-</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Unité</div>
                        <div class="info-value" id="unite-info">-</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Coût unitaire</div>
                        <div class="info-value" id="cout-info">-</div>
                    </div>
                </div>

                <!-- Quantité à sortir -->
                <div class="form-group">
                    <label for="quantite_sortie" class="form-label">
                        Quantité à sortir <span class="text-red-500">*</span>
                    </label>
                    <input type="number" 
                           id="quantite_sortie" 
                           name="quantite_sortie" 
                           class="form-input" 
                           min="1" 
                           required>
                </div>

                <!-- Service destinataire -->
                <div class="form-group">
                    <label for="service_destinataire" class="form-label">
                        Service destinataire <span class="text-red-500">*</span>
                    </label>
                    <select id="service_destinataire" name="service_destinataire" class="form-select" required>
                        <option value="">Sélectionner un service</option>
                        @foreach($services as $service)
                            <option value="{{ $service }}">{{ $service }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Personne destinataire -->
                <div class="form-group">
                    <label for="personne_destinataire" class="form-label">
                        Nom de la personne <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="personne_destinataire" 
                           name="personne_destinataire" 
                           class="form-input" 
                           required 
                           placeholder="Ex: M. Dupont">
                </div>

                <!-- Poste de la personne -->
                <div class="form-group">
                    <label for="poste_destinataire" class="form-label">
                        Poste/Fonction <span class="text-red-500">*</span>
                    </label>
                    <select id="poste_destinataire" name="poste_destinataire" class="form-select" required>
                        <option value="">Sélectionner un poste</option>
                        @foreach($postes as $poste)
                            <option value="{{ $poste }}">{{ $poste }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Motif de la sortie -->
                <div class="form-group">
                    <label for="motif_sortie" class="form-label">
                        Motif de la sortie <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="motif_sortie" 
                           name="motif_sortie" 
                           class="form-input" 
                           required 
                           placeholder="Ex: Maintenance préventive, Réparation urgente, etc.">
                </div>

                <!-- Commentaires -->
                <div class="form-group">
                    <label for="commentaires" class="form-label">Commentaires (optionnel)</label>
                    <textarea id="commentaires" 
                              name="commentaires" 
                              class="form-textarea" 
                              placeholder="Informations supplémentaires..."></textarea>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-save mr-2"></i>Enregistrer la sortie
                    </button>
                    <a href="{{ route('stocks.index') }}" class="btn-secondary">
                        <i class="fas fa-times mr-2"></i>Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function loadStockInfo() {
            const select = document.getElementById('stock_id');
            const stockInfo = document.getElementById('stock-info');
            
            if (select.value) {
                const option = select.options[select.selectedIndex];
                const quantite = option.dataset.quantite;
                const unite = option.dataset.unite;
                const cout = option.dataset.cout;
                
                document.getElementById('produit-info').textContent = option.text.split(' - ')[0];
                document.getElementById('quantite-info').textContent = quantite + ' ' + unite;
                document.getElementById('unite-info').textContent = unite;
                document.getElementById('cout-info').textContent = parseFloat(cout).toLocaleString() + ' FCFA';
                
                // Mettre à jour la quantité maximale
                document.getElementById('quantite_sortie').max = quantite;
                
                stockInfo.style.display = 'grid';
            } else {
                stockInfo.style.display = 'none';
            }
        }

        // Validation en temps réel
        document.getElementById('quantite_sortie').addEventListener('input', function() {
            const select = document.getElementById('stock_id');
            if (select.value) {
                const option = select.options[select.selectedIndex];
                const maxQuantite = parseInt(option.dataset.quantite);
                const quantite = parseInt(this.value);
                
                if (quantite > maxQuantite) {
                    this.setCustomValidity('Quantité supérieure au stock disponible');
                } else {
                    this.setCustomValidity('');
                }
            }
        });
    </script>
</body>
</html> 