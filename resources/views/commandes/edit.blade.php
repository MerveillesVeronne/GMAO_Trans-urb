<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GMAO Trans'urb - Modifier Commande</title>
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
        .form-card {
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
        .ligne-produit {
            background: #f9fafb;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1rem;
        }
        .total-section {
            background: #e6f4ee;
            border-radius: 12px;
            padding: 1.5rem;
            border: 2px solid #1e5c4a;
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
                <div class="greeting">Modifier Commande</div>
                <div class="subtitle">Modifier les informations de la commande</div>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-edit" style="font-size: 2.5rem; color: #ffe082;"></i>
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

        <!-- Messages d'erreur -->
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Informations de la commande -->
        <div class="form-card">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-900">Informations de la commande</h3>
                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-600">Référence: <strong>{{ $commande->reference }}</strong></span>
                    <span class="status-badge status-{{ $commande->statut }}">
                        {{ $commande->statut_label }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Formulaire -->
        <form method="POST" action="{{ route('commande.update', $commande) }}" class="space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Informations générales -->
            <div class="form-card">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Informations générales</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="fournisseur_id" class="form-label">Fournisseur *</label>
                        <select id="fournisseur_id" name="fournisseur_id" required class="form-input">
                            <option value="">Sélectionner un fournisseur</option>
                            @foreach($fournisseurs as $fournisseur)
                                <option value="{{ $fournisseur->id }}" {{ old('fournisseur_id', $commande->fournisseur_id) == $fournisseur->id ? 'selected' : '' }}>
                                    {{ $fournisseur->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label for="date_commande" class="form-label">Date de commande *</label>
                        <input type="date" id="date_commande" name="date_commande" value="{{ old('date_commande', $commande->date_commande->format('Y-m-d')) }}" required class="form-input">
                    </div>
                    
                    <div>
                        <label for="date_livraison" class="form-label">Date de livraison prévue</label>
                        <input type="date" id="date_livraison" name="date_livraison" value="{{ old('date_livraison', $commande->date_livraison ? $commande->date_livraison->format('Y-m-d') : '') }}" class="form-input">
                    </div>
                    
                    <div>
                        <label for="commentaires" class="form-label">Commentaires généraux</label>
                        <textarea id="commentaires" name="commentaires" rows="3" class="form-input">{{ old('commentaires', $commande->commentaires) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Produits commandés -->
            <div class="form-card">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-900">Produits commandés</h3>
                    <button type="button" onclick="ajouterLigne()" class="btn-success">
                        <i class="fas fa-plus mr-2"></i>Ajouter un produit
                    </button>
                </div>

                <div id="lignes-produits" class="space-y-4">
                    @foreach($commande->lignes as $index => $ligne)
                        <div class="ligne-produit" data-index="{{ $index }}">
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="text-lg font-semibold text-gray-900">Produit #{{ $index + 1 }}</h4>
                                <button type="button" onclick="supprimerLigne({{ $index }})" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                <div>
                                    <label class="form-label">Produit *</label>
                                    <input type="text" name="produits[{{ $index }}][produit]" value="{{ $ligne->produit }}" required class="form-input" placeholder="Nom du produit">
                                </div>
                                <div>
                                    <label class="form-label">Quantité *</label>
                                    <input type="number" name="produits[{{ $index }}][quantite]" value="{{ $ligne->quantite }}" required min="1" class="form-input" placeholder="1" onchange="calculerTotalLigne({{ $index }})">
                                </div>
                                <div>
                                    <label class="form-label">Coût unitaire (FCFA)</label>
                                    <input type="number" name="produits[{{ $index }}][cout_unitaire]" value="{{ $ligne->cout_unitaire }}" min="0" step="0.01" class="form-input" placeholder="0" onchange="calculerTotalLigne({{ $index }})">
                                </div>
                                <div>
                                    <label class="form-label">Total ligne</label>
                                    <input type="text" class="total-ligne form-input bg-gray-50" readonly value="{{ number_format($ligne->total_ligne, 0, ',', ' ') }} FCFA">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label class="form-label">Description</label>
                                    <textarea name="produits[{{ $index }}][description]" rows="2" class="form-input" placeholder="Description détaillée du produit">{{ $ligne->description }}</textarea>
                                </div>
                                <div>
                                    <label class="form-label">Commentaires</label>
                                    <textarea name="produits[{{ $index }}][commentaires]" rows="2" class="form-input" placeholder="Commentaires spécifiques">{{ $ligne->commentaires }}</textarea>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="total-section">
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-bold text-gray-900">Total de la commande:</span>
                        <span id="total-commande" class="text-2xl font-bold text-green-600">{{ number_format($commande->montant_total, 0, ',', ' ') }} FCFA</span>
                    </div>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('commande.details', $commande) }}" class="btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i>Annuler
                </a>
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save mr-2"></i>Mettre à jour
                </button>
            </div>
        </form>
    </div>

    <script>
        let ligneIndex = {{ $commande->lignes->count() }};

        function ajouterLigne() {
            const container = document.getElementById('lignes-produits');
            const ligneHtml = `
                <div class="ligne-produit" data-index="${ligneIndex}">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-lg font-semibold text-gray-900">Produit #${ligneIndex + 1}</h4>
                        <button type="button" onclick="supprimerLigne(${ligneIndex})" class="text-red-600 hover:text-red-800">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div>
                            <label class="form-label">Produit *</label>
                            <input type="text" name="produits[${ligneIndex}][produit]" required class="form-input" placeholder="Nom du produit">
                        </div>
                        <div>
                            <label class="form-label">Quantité *</label>
                            <input type="number" name="produits[${ligneIndex}][quantite]" required min="1" class="form-input" placeholder="1" onchange="calculerTotalLigne(${ligneIndex})">
                        </div>
                        <div>
                            <label class="form-label">Coût unitaire (FCFA)</label>
                            <input type="number" name="produits[${ligneIndex}][cout_unitaire]" min="0" step="0.01" class="form-input" placeholder="0" onchange="calculerTotalLigne(${ligneIndex})">
                        </div>
                        <div>
                            <label class="form-label">Total ligne</label>
                            <input type="text" class="total-ligne form-input bg-gray-50" readonly value="0 FCFA">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="form-label">Description</label>
                            <textarea name="produits[${ligneIndex}][description]" rows="2" class="form-input" placeholder="Description détaillée du produit"></textarea>
                        </div>
                        <div>
                            <label class="form-label">Commentaires</label>
                            <textarea name="produits[${ligneIndex}][commentaires]" rows="2" class="form-input" placeholder="Commentaires spécifiques"></textarea>
                        </div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', ligneHtml);
            ligneIndex++;
        }

        function supprimerLigne(index) {
            const ligne = document.querySelector(`[data-index="${index}"]`);
            if (ligne) {
                ligne.remove();
                calculerTotalCommande();
            }
        }

        function calculerTotalLigne(index) {
            const ligne = document.querySelector(`[data-index="${index}"]`);
            const quantite = parseFloat(ligne.querySelector('input[name*="[quantite]"]').value) || 0;
            const coutUnitaire = parseFloat(ligne.querySelector('input[name*="[cout_unitaire]"]').value) || 0;
            const total = quantite * coutUnitaire;
            
            ligne.querySelector('.total-ligne').value = total.toLocaleString('fr-FR') + ' FCFA';
            calculerTotalCommande();
        }

        function calculerTotalCommande() {
            let total = 0;
            document.querySelectorAll('.ligne-produit').forEach(ligne => {
                const quantite = parseFloat(ligne.querySelector('input[name*="[quantite]"]').value) || 0;
                const coutUnitaire = parseFloat(ligne.querySelector('input[name*="[cout_unitaire]"]').value) || 0;
                total += quantite * coutUnitaire;
            });
            
            document.getElementById('total-commande').textContent = total.toLocaleString('fr-FR') + ' FCFA';
        }

        // Initialiser les calculs au chargement
        document.addEventListener('DOMContentLoaded', function() {
            calculerTotalCommande();
        });
    </script>
</body>
</html> 