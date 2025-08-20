<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GMAO Trans'urb - Nouvelle Livraison</title>
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
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }
        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.2s;
        }
        .form-input:focus {
            outline: none;
            border-color: #1e5c4a;
            box-shadow: 0 0 0 3px rgba(30, 92, 74, 0.1);
        }
        .form-select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            background-color: white;
            transition: border-color 0.2s;
        }
        .form-select:focus {
            outline: none;
            border-color: #1e5c4a;
            box-shadow: 0 0 0 3px rgba(30, 92, 74, 0.1);
        }
        .form-textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            resize: vertical;
            min-height: 100px;
            transition: border-color 0.2s;
        }
        .form-textarea:focus {
            outline: none;
            border-color: #1e5c4a;
            box-shadow: 0 0 0 3px rgba(30, 92, 74, 0.1);
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
        .ligne-info {
            background: #f9fafb;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1rem;
        }
        .error-message {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
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
                <div class="greeting">Nouvelle Livraison</div>
                <div class="subtitle">Commande: {{ $commande->reference }}</div>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-truck" style="font-size: 2.5rem; color: #ffe082;"></i>
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
        <div class="content-card">
            <h3 class="text-xl font-bold text-gray-900 mb-6">Informations de la commande</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <h4 class="font-semibold text-gray-700 mb-2">Référence</h4>
                    <p class="text-gray-900">{{ $commande->reference }}</p>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-700 mb-2">Fournisseur</h4>
                    <p class="text-gray-900">{{ $commande->fournisseur->nom }}</p>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-700 mb-2">Date de commande</h4>
                    <p class="text-gray-900">{{ $commande->date_commande->format('d/m/Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Formulaire de livraison -->
        <div class="content-card">
            <h3 class="text-xl font-bold text-gray-900 mb-6">Détails de la livraison</h3>
            
            <form method="POST" action="{{ route('livraisons.store', $commande) }}">
                @csrf
                
                <div class="form-group">
                    <label class="form-label">Ligne de commande *</label>
                    <select name="ligne_commande_id" class="form-select" required>
                        <option value="">Sélectionner une ligne</option>
                        @foreach($commande->lignes as $ligne)
                            @if(!$ligne->isLivraisonComplete())
                                <option value="{{ $ligne->id }}" 
                                    {{ request('ligne') == $ligne->id ? 'selected' : '' }}>
                                    {{ $ligne->produit }} - 
                                    Commandé: {{ $ligne->quantite }} 
                                    (Livré: {{ $ligne->quantite_livree }}, 
                                    Reste: {{ $ligne->getQuantiteRestante() }})
                                </option>
                            @endif
                        @endforeach
                    </select>
                    @error('ligne_commande_id')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Date de livraison *</label>
                    <input type="date" name="date_livraison" class="form-input" 
                           value="{{ old('date_livraison', now()->format('Y-m-d')) }}" required>
                    @error('date_livraison')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Quantité livrée *</label>
                    <input type="number" name="quantite_livree" class="form-input" 
                           value="{{ old('quantite_livree') }}" min="1" required>
                    @error('quantite_livree')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Statut de la livraison *</label>
                    <select name="statut" class="form-select" required>
                        <option value="complete" {{ old('statut') == 'complete' ? 'selected' : '' }}>Complète</option>
                        <option value="partielle" {{ old('statut') == 'partielle' ? 'selected' : '' }}>Partielle</option>
                        <option value="retard" {{ old('statut') == 'retard' ? 'selected' : '' }}>En retard</option>
                    </select>
                    @error('statut')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Commentaires</label>
                    <textarea name="commentaires" class="form-textarea" 
                              placeholder="Commentaires sur la livraison...">{{ old('commentaires') }}</textarea>
                    @error('commentaires')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex justify-end gap-4">
                    <a href="{{ route('commande.details', $commande) }}" class="btn-secondary">
                        <i class="fas fa-times mr-2"></i>Annuler
                    </a>
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-save mr-2"></i>Enregistrer la livraison
                    </button>
                </div>
            </form>
        </div>

        <!-- Lignes de commande disponibles -->
        <div class="content-card">
            <h3 class="text-xl font-bold text-gray-900 mb-6">Lignes de commande disponibles</h3>
            
            @foreach($commande->lignes as $ligne)
                <div class="ligne-info">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900">{{ $ligne->produit }}</h4>
                            @if($ligne->description)
                                <p class="text-gray-600 text-sm">{{ $ligne->description }}</p>
                            @endif
                        </div>
                        <span class="px-3 py-1 rounded-full text-sm font-semibold
                            @if($ligne->isLivraisonComplete()) bg-green-100 text-green-800
                            @elseif($ligne->quantite_livree > 0) bg-yellow-100 text-yellow-800
                            @else bg-gray-100 text-gray-800 @endif">
                            @if($ligne->isLivraisonComplete())
                                Livraison complète
                            @elseif($ligne->quantite_livree > 0)
                                Partiellement livrée
                            @else
                                En attente
                            @endif
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <span class="text-sm text-gray-600">Quantité commandée:</span>
                            <p class="font-semibold">{{ $ligne->quantite }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-600">Quantité livrée:</span>
                            <p class="font-semibold text-green-600">{{ $ligne->quantite_livree }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-600">Reste à livrer:</span>
                            <p class="font-semibold text-orange-600">{{ $ligne->getQuantiteRestante() }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-600">Coût unitaire:</span>
                            <p class="font-semibold">{{ number_format($ligne->cout_unitaire, 0, ',', ' ') }} FCFA</p>
                        </div>
                    </div>

                    @if(!$ligne->isLivraisonComplete())
                        <div class="mt-4">
                            <a href="{{ route('livraisons.create', $commande) }}?ligne={{ $ligne->id }}" 
                               class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-plus mr-2"></i>Ajouter livraison pour cette ligne
                            </a>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <script>
        // Mise à jour automatique de la quantité maximale selon la ligne sélectionnée
        document.querySelector('select[name="ligne_commande_id"]').addEventListener('change', function() {
            const ligneId = this.value;
            if (ligneId) {
                // Ici on pourrait faire une requête AJAX pour récupérer les détails de la ligne
                // et mettre à jour le champ quantité maximale
                console.log('Ligne sélectionnée:', ligneId);
            }
        });
    </script>
</body>
</html> 