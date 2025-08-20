<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GMAO Trans'urb - Nouveau Bon de commande</title>
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
            padding: 0.7rem 1rem;
            font-size: 0.9rem;
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
            padding: 0.75rem 1rem;
            border: none;
            background: none;
            text-align: left;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #374151;
            font-size: 0.875rem;
            transition: background 0.2s;
        }
        .dropdown-item:hover {
            background: #f3f4f6;
        }
        .content-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(23,66,59,0.08);
            padding: 2rem;
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
            font-size: 0.875rem;
        }
        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 0.875rem;
            transition: border-color 0.2s, box-shadow 0.2s;
            background: #fff;
        }
        .form-input:focus {
            outline: none;
            border-color: #17423b;
            box-shadow: 0 0 0 3px rgba(23,66,59,0.1);
        }
        .form-textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 0.875rem;
            transition: border-color 0.2s, box-shadow 0.2s;
            background: #fff;
            resize: vertical;
            min-height: 100px;
        }
        .form-textarea:focus {
            outline: none;
            border-color: #17423b;
            box-shadow: 0 0 0 3px rgba(23,66,59,0.1);
        }
        .form-select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 0.875rem;
            transition: border-color 0.2s, box-shadow 0.2s;
            background: #fff;
            cursor: pointer;
        }
        .form-select:focus {
            outline: none;
            border-color: #17423b;
            box-shadow: 0 0 0 3px rgba(23,66,59,0.1);
        }
        .btn-primary {
            background: #17423b;
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }
        .btn-primary:hover {
            background: #1e5c4a;
        }
        .btn-secondary {
            background: #f3f4f6;
            color: #374151;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }
        .btn-secondary:hover {
            background: #e5e7eb;
            border-color: #d1d5db;
        }
        .section-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #17423b;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid #e5e7eb;
        }
        .grid-2 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }
        .error-message {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }
        .readonly-input {
            background: #f9fafb;
            color: #6b7280;
        }
        .help-text {
            color: #6b7280;
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header-bg">
        <nav class="main-navbar">
            <!-- Logo et nom de la société -->
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center">
                    <i class="fas fa-bus text-green-600 text-lg"></i>
                </div>
                <span class="text-white font-semibold text-lg">Trans'urb GMAO</span>
            </div>
            
            <!-- Menu principal centré -->
            <div class="flex items-center space-x-8">
                <a href="{{ route('dashboard.moyens-generaux') }}" class="nav-link">
                    <i class="fas fa-cogs mr-2"></i>Moyens Généraux
                </a>
                <a href="{{ route('dashboard.maintenance') }}" class="nav-link">
                    <i class="fas fa-wrench mr-2"></i>Maintenance
                </a>
                <a href="{{ route('dashboard.logistique') }}" class="nav-link">
                    <i class="fas fa-clipboard-check mr-2"></i>Logistique
                </a>
                <a href="{{ route('chauffeur.fdt') }}" class="nav-link">
                    <i class="fas fa-user-check mr-2"></i>Chauffeurs
                </a>
            </div>
            
            <!-- Profil utilisateur -->
            <div class="profile-box">
                <i class="fas fa-user-circle text-xl"></i>
                <div class="flex flex-col">
                    <span class="font-semibold">{{ auth()->user()->name ?? 'Jean BERNARD' }}</span>
                    <span class="text-xs opacity-80">{{ auth()->user()->role->nom_role ?? 'Directeur DFC' }}</span>
                </div>
                <i class="fas fa-sign-out-alt ml-2"></i>
            </div>
        </nav>

        <div class="welcome-banner">
                <div>
                <div class="greeting">Nouveau Bon de commande</div>
                <div class="subtitle">Créer un nouvel état de besoin</div>
                </div>
                <div class="flex space-x-3">
                <a href="{{ route('bons-commande.index') }}" class="btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i>Retour à la liste
                </a>
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

        <!-- Formulaire -->
        <div class="content-card">
                <form action="{{ route('bons-commande.store') }}" method="POST" id="bonCommandeForm">
                    @csrf
                    
                    <!-- Informations générales -->
                <h3 class="section-title">
                    <i class="fas fa-info-circle mr-2 text-green-600"></i>
                    Informations générales
                </h3>
                
                <div class="grid-2">
                    <div class="form-group">
                        <label for="titre" class="form-label">Titre du bon de commande *</label>
                            <input type="text" name="titre" id="titre" value="{{ old('titre') }}" required
                            class="form-input" placeholder="Ex: Besoin de 10 ordinateurs pour le service IT">
                            @error('titre')
                            <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>

                    <div class="form-group">
                        <label for="budget_total" class="form-label">Budget total (FCFA) *</label>
                            <input type="number" name="budget_total" id="budget_total" value="{{ old('budget_total') }}" min="0" step="100" required
                            class="form-input" placeholder="5000000">
                            @error('budget_total')
                            <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>

                    <div class="form-group">
                        <label for="date_besoin" class="form-label">Date de besoin *</label>
                            <input type="date" name="date_besoin" id="date_besoin" value="{{ old('date_besoin') }}" required
                            class="form-input">
                            @error('date_besoin')
                            <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>

                    <div class="form-group">
                        <label for="unite_produit" class="form-label">Unité du produit *</label>
                        <select name="unite_produit" id="unite_produit" class="form-select">
                                <option value="unité">Unité</option>
                                <option value="kg">Kilogramme</option>
                                <option value="l">Litre</option>
                                <option value="m">Mètre</option>
                                <option value="m²">Mètre carré</option>
                                <option value="m³">Mètre cube</option>
                                <option value="paquet">Paquet</option>
                                <option value="carton">Carton</option>
                                <option value="rouleau">Rouleau</option>
                                <option value="ramette">Ramette</option>
                            </select>
                        </div>
                    </div>

                <div class="form-group">
                    <label for="description" class="form-label">Description du besoin *</label>
                    <textarea name="description" id="description" required
                        class="form-textarea" placeholder="Décrivez le besoin global...">{{ old('description') }}</textarea>
                        @error('description')
                        <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Informations du produit -->
                <h3 class="section-title">
                    <i class="fas fa-box mr-2 text-blue-600"></i>
                    Informations du produit
                </h3>
                
                <div class="grid-2">
                    <div class="form-group">
                        <label for="produit_principal" class="form-label">Produit principal *</label>
                                <input type="text" name="produit_principal" id="produit_principal" value="{{ old('produit_principal') }}" required
                            class="form-input" placeholder="Ex: Ordinateurs de bureau HP">
                                @error('produit_principal')
                            <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>

                    <div class="form-group">
                        <label for="quantite_totale_souhaitee" class="form-label">Quantité totale souhaitée *</label>
                                <input type="number" name="quantite_totale_souhaitee" id="quantite_totale_souhaitee" value="{{ old('quantite_totale_souhaitee') }}" min="1" required
                            class="form-input" placeholder="10">
                                @error('quantite_totale_souhaitee')
                            <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>

                    <div class="form-group">
                        <label for="cout_unitaire_estime" class="form-label">Coût unitaire estimé (FCFA) *</label>
                                <input type="number" name="cout_unitaire_estime" id="cout_unitaire_estime" value="{{ old('cout_unitaire_estime') }}" min="0" step="100" required
                            class="form-input" placeholder="450000">
                                @error('cout_unitaire_estime')
                            <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>

                    <div class="form-group">
                        <label for="cout_total_estime" class="form-label">Coût total estimé (FCFA)</label>
                                <input type="text" id="cout_total_estime" readonly
                            class="form-input readonly-input">
                        <p class="help-text">Calculé automatiquement</p>
                            </div>
                        </div>

                <div class="form-group">
                    <label for="description_produit" class="form-label">Description détaillée du produit *</label>
                    <textarea name="description_produit" id="description_produit" required
                        class="form-textarea" placeholder="Décrivez les spécifications du produit...">{{ old('description_produit') }}</textarea>
                            @error('description_produit')
                        <p class="error-message">{{ $message }}</p>
                            @enderror
                    </div>

                <div class="form-group">
                    <label for="commentaires" class="form-label">Commentaires</label>
                    <textarea name="commentaires" id="commentaires"
                        class="form-textarea" placeholder="Commentaires additionnels...">{{ old('commentaires') }}</textarea>
                        @error('commentaires')
                        <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('bons-commande.index') }}" class="btn-secondary">
                        <i class="fas fa-times mr-2"></i>Annuler
                    </a>
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-check mr-2"></i>Créer le bon de commande
                        </button>
                    </div>
                </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const quantiteInput = document.getElementById('quantite_totale_souhaitee');
    const coutUnitaireInput = document.getElementById('cout_unitaire_estime');
    const coutTotalInput = document.getElementById('cout_total_estime');

    function calculerCoutTotal() {
        const quantite = parseInt(quantiteInput.value) || 0;
        const coutUnitaire = parseFloat(coutUnitaireInput.value) || 0;
        const coutTotal = quantite * coutUnitaire;
        
        coutTotalInput.value = coutTotal.toLocaleString('fr-FR') + ' FCFA';
    }

    quantiteInput.addEventListener('input', calculerCoutTotal);
    coutUnitaireInput.addEventListener('input', calculerCoutTotal);

    // Calculer le coût total au chargement
    calculerCoutTotal();
});
</script>
</body>
</html> 