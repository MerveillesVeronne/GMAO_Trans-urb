<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Fournisseurs</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700&display=swap" rel="stylesheet" />
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f5f5f5; margin: 0; }
        .header-bg { background: #17423b; color: #fff; padding-bottom: 90px; position: relative; box-shadow: 0 2px 8px rgba(23,66,59,0.08); }
        .main-navbar { display: flex; align-items: center; justify-content: space-between; padding: 0 2.5rem; height: 64px; }
        .main-navbar .nav-link { color: #e6f4ee; font-weight: 500; border-radius: 8px; padding: 0.5rem 1.2rem; transition: background 0.2s, color 0.2s; }
        .main-navbar .nav-link.active, .main-navbar .nav-link:hover { background: #1e5c4a; color: #fff; }
        .main-navbar .profile-box { background: #1e5c4a; border-radius: 12px; padding: 0.5rem 1rem; display: flex; align-items: center; gap: 0.7rem; }
        .main-navbar .profile-box .fa-user-circle { font-size: 1.7rem; color: #ffe082; }
        .welcome-banner { display: flex; align-items: center; justify-content: space-between; padding: 2.2rem 2.5rem 1.2rem 2.5rem; }
        .welcome-banner .greeting { font-size: 1.5rem; font-weight: 600; }
        .welcome-banner .subtitle { font-size: 1rem; color: #c8e6d6; }
        .container { max-width: 1400px; margin: 40px auto; background: #fff; border-radius: 18px; box-shadow: 0 2px 12px rgba(0,0,0,0.1); padding: 2.5rem; position: relative; z-index: 10; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 1.5rem; }
        th, td { padding: 0.9rem 1rem; text-align: left; }
        th { background: #eafaf4; color: #219150; font-weight: 600; }
        tr:nth-child(even) { background: #f6fcf9; }
        tr:hover { background: #e0f7ec; }
        .back-btn { display: inline-block; margin-bottom: 1.5rem; color: #219150; text-decoration: none; font-weight: 600; }
        .back-btn i { margin-right: 6px; }
        
        /* Styles pour le modal */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1000;
            display: none;
            opacity: 0;
            transition: opacity 0.3s ease;
            align-items: center;
            justify-content: center;
        }
        
        .modal-overlay.show {
            display: flex;
            opacity: 1;
        }
        
        .modal-content {
            background: white;
            width: 90%;
            max-width: 700px;
            max-height: 90vh;
            border-radius: 16px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow-y: auto;
            transform: scale(0.9);
            transition: transform 0.3s ease;
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE and Edge */
        }
        
        .modal-content::-webkit-scrollbar {
            display: none; /* Chrome, Safari and Opera */
        }
        
        .modal-header {
            background: linear-gradient(135deg, #219150 0%, #1e5c4a 100%);
            color: white;
            padding: 1.5rem 2rem;
            border-radius: 16px 16px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        
        .modal-body {
            padding: 2rem;
        }
        
        .modal-close {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 50%;
            transition: all 0.2s;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .modal-close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }
        
        /* Styles pour le formulaire dans le modal */
        .form-section {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid #e9ecef;
        }
        
        .form-section-title {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
            color: #17423b;
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        .form-section-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.9rem;
        }
        
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }
        
        .form-group {
            display: flex;
            flex-direction: column;
        }
        
        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }
        
        .form-label.required::after {
            content: " *";
            color: #ef4444;
        }
        
        .form-input {
            padding: 0.75rem 1rem;
            border: 2px solid #d1d5db;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.2s;
            background: white;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #219150;
            box-shadow: 0 0 0 3px rgba(33, 145, 80, 0.1);
        }
        
        .form-select {
            padding: 0.75rem 1rem;
            border: 2px solid #d1d5db;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.2s;
            background: white;
            cursor: pointer;
        }
        
        .form-select:focus {
            outline: none;
            border-color: #219150;
            box-shadow: 0 0 0 3px rgba(33, 145, 80, 0.1);
        }
        
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e5e7eb;
            margin-top: 1.5rem;
        }
        
        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }
        
        .btn-secondary {
            background: #f3f4f6;
            color: #374151;
            border: 1px solid #d1d5db;
        }
        
        .btn-secondary:hover {
            background: #e5e7eb;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #219150 0%, #1e5c4a 100%);
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(33, 145, 80, 0.3);
        }
        
        .error-message {
            color: #ef4444;
            font-size: 0.8rem;
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
                <div class="greeting">Liste des Fournisseurs</div>
                <div class="subtitle" style="color: #ffe082;">Gestion complète des partenaires</div>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-truck" style="font-size: 2.5rem; color: #ffe082;"></i>
            </div>
        </div>
    </div>
    <div class="main-menu-bar" style="max-width: 1400px; margin: 0 auto; margin-top: -60px; margin-bottom: 2.5rem; z-index:20; position:relative;">
        <ul style="display: flex; justify-content: center; gap: 2.5rem; list-style: none; padding: 0; margin: 0;">
            <!-- Fournisseurs -->
            <li class="menu-dropdown" style="position: relative;">
                <button class="menu-btn">
                    <i class="fas fa-truck mr-2 text-green-700"></i>Fournisseurs <i class="fas fa-chevron-down ml-1"></i>
                </button>
                <ul class="dropdown-content">
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('liste.fournisseurs') }}?action=nouveau'"><i class="fas fa-plus mr-2"></i>Nouveau Fournisseur</button></li>
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('liste.fournisseurs') }}'"><i class="fas fa-list mr-2"></i>Liste Fournisseurs</button></li>
                </ul>
            </li>
            <!-- Contrats -->
            <li class="menu-dropdown" style="position: relative;">
                <button class="menu-btn">
                    <i class="fas fa-file-contract mr-2 text-yellow-600"></i>Contrats <i class="fas fa-chevron-down ml-1"></i>
                </button>
                <ul class="dropdown-content">
                    <li><button class="dropdown-item"><i class="fas fa-plus mr-2"></i>Nouveau Contrat</button></li>
                    <li><button class="dropdown-item"><i class="fas fa-calendar mr-2"></i>Échéances</button></li>
                    <li><button class="dropdown-item"><i class="fas fa-sync mr-2"></i>Renouvellements</button></li>
                </ul>
            </li>
            <!-- Commandes -->
            <li class="menu-dropdown" style="position: relative;">
                <button class="menu-btn">
                    <i class="fas fa-shopping-cart mr-2 text-blue-600"></i>Commandes <i class="fas fa-chevron-down ml-1"></i>
                </button>
                <ul class="dropdown-content">
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('nouvelle.commande') }}'"><i class="fas fa-plus mr-2"></i>Nouvelle Commande</button></li>
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('liste.commandes') }}'"><i class="fas fa-list mr-2"></i>Liste Commandes</button></li>
                </ul>
            </li>
            <!-- Loyers & Charges -->
            <li class="menu-dropdown" style="position: relative;">
                <button class="menu-btn">
                    <i class="fas fa-building mr-2 text-purple-600"></i>Loyers & Charges <i class="fas fa-chevron-down ml-1"></i>
                </button>
                <ul class="dropdown-content">
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('nouveau.loyer') }}'"><i class="fas fa-plus mr-2"></i>Nouveau Loyer/Charge</button></li>
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('liste.loyers') }}'"><i class="fas fa-list mr-2"></i>Liste Loyers/Charges</button></li>
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('loyers.echeances') }}'"><i class="fas fa-calendar mr-2"></i>Échéances</button></li>
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('loyers.paiements') }}'"><i class="fas fa-credit-card mr-2"></i>Paiements</button></li>
                </ul>
            </li>
        </ul>
        <style>
            .menu-btn {
                background: #fff;
                border: none;
                border-radius: 12px;
                box-shadow: 0 2px 12px rgba(23,66,59,0.08);
                padding: 0.9rem 2.2rem;
                font-size: 1.1rem;
                font-weight: 600;
                color: #17423b;
                cursor: pointer;
                display: flex;
                align-items: center;
                gap: 0.5rem;
                transition: box-shadow 0.2s, background 0.2s;
            }
            .menu-btn:hover, .menu-dropdown:hover .menu-btn {
                background: #eafaf4;
                box-shadow: 0 6px 24px rgba(23,66,59,0.13);
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
        </style>
    </div>
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <a href="{{ route('dashboard.moyens-generaux') }}" class="back-btn"><i class="fas fa-arrow-left"></i>Retour au dashboard</a>
            <button onclick="openModal('modal-fournisseur')" style="background: #219150; color: #fff; padding: 12px 24px; border: none; border-radius: 8px; font-weight: 600; font-size: 1rem; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                <i class="fas fa-plus" style="color: #ffe082;"></i>Ajouter un fournisseur
            </button>
        </div>

        @if(session('success'))
            <div style="background:#eafaf4;color:#219150;padding:10px 18px;border-radius:8px;margin-bottom:18px;">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div style="background:#fff3cd;color:#856404;padding:10px 18px;border-radius:8px;margin-bottom:18px;">
                <ul style="margin:0;padding-left:18px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Statistiques globales -->
        <div style="background: #fff; border-radius: 12px; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <h3 style="font-size: 1.2rem; font-weight: 600; color: #17423b; margin-bottom: 1rem;">📊 Statistiques des fournisseurs</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                <div style="background: #eafaf4; padding: 1rem; border-radius: 8px; text-align: center;">
                    <div style="font-size: 2rem; font-weight: bold; color: #219150;">{{ $stats['total_fournisseurs'] }}</div>
                    <div style="color: #666; font-size: 0.9rem;">Total fournisseurs</div>
                </div>
                <div style="background: #eafaf4; padding: 1rem; border-radius: 8px; text-align: center;">
                    <div style="font-size: 2rem; font-weight: bold; color: #219150;">{{ $stats['fournisseurs_avec_commandes'] }}</div>
                    <div style="color: #666; font-size: 0.9rem;">Avec commandes</div>
                </div>
                <div style="background: #eafaf4; padding: 1rem; border-radius: 8px; text-align: center;">
                    <div style="font-size: 2rem; font-weight: bold; color: #219150;">{{ number_format($stats['montant_total'], 0, ',', ' ') }} FCFA</div>
                    <div style="color: #666; font-size: 0.9rem;">Montant total</div>
                </div>
                <div style="background: #eafaf4; padding: 1rem; border-radius: 8px; text-align: center;">
                    <div style="font-size: 2rem; font-weight: bold; color: #219150;">{{ number_format($stats['moyenne_ponctualite'], 1) }}%</div>
                    <div style="color: #666; font-size: 0.9rem;">Ponctualité moyenne</div>
                </div>
            </div>
        </div>

        <!-- Filtres et tri -->
        <div style="background: #fff; border-radius: 12px; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                <h3 style="font-size: 1.2rem; font-weight: 600; color: #17423b; margin: 0;">🔍 Filtres et tri</h3>
                <a href="{{ route('fournisseurs.export') }}?{{ http_build_query(request()->all()) }}" style="background: #dc3545; color: #fff; padding: 0.5rem 1rem; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fas fa-file-pdf"></i>Exporter PDF
                </a>
            </div>
            <form method="GET" action="{{ route('liste.fournisseurs') }}" style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; color: #666; font-size: 0.9rem;">Type de fournisseur</label>
                    <select name="type" style="padding: 0.5rem; border: 1px solid #ddd; border-radius: 6px; min-width: 150px;">
                        <option value="">Tous les types</option>
                        <option value="pièces" {{ request('type') == 'pièces' ? 'selected' : '' }}>🔧 Pièces automobiles</option>
                        <option value="services" {{ request('type') == 'services' ? 'selected' : '' }}>🛠️ Services</option>
                        <option value="carburant" {{ request('type') == 'carburant' ? 'selected' : '' }}>⛽ Carburant</option>
                        <option value="informatique" {{ request('type') == 'informatique' ? 'selected' : '' }}>💻 Informatique</option>
                        <option value="autre" {{ request('type') == 'autre' ? 'selected' : '' }}>📦 Autre</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; color: #666; font-size: 0.9rem;">Trier par</label>
                    <select name="tri" style="padding: 0.5rem; border: 1px solid #ddd; border-radius: 6px; min-width: 150px;">
                        <option value="">Date d'ajout</option>
                        <option value="commandes" {{ request('tri') == 'commandes' ? 'selected' : '' }}>📦 Nombre de commandes</option>
                        <option value="montant" {{ request('tri') == 'montant' ? 'selected' : '' }}>💰 Montant total</option>
                        <option value="ponctualite" {{ request('tri') == 'ponctualite' ? 'selected' : '' }}>⏰ Ponctualité</option>
                        <option value="score" {{ request('tri') == 'score' ? 'selected' : '' }}>⭐ Score global</option>
                    </select>
                </div>
                <div style="align-self: end;">
                    <button type="submit" style="background: #219150; color: #fff; padding: 0.5rem 1rem; border: none; border-radius: 6px; font-weight: 600; cursor: pointer;">
                        <i class="fas fa-filter mr-1"></i>Filtrer
                    </button>
                </div>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Fournisseur</th>
                    <th>Contact</th>
                    <th>📦 Commandes</th>
                    <th>💰 Montant total</th>
                    <th>⏰ Ponctualité</th>
                    <th>⭐ Score</th>
                    <th>📊 Détails</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fournisseurs as $fournisseur)
                    <tr>
                        <td>
                            <div style="font-weight: 600; color: #17423b;">{{ $fournisseur->nom }}</div>
                            <div style="font-size: 0.9rem; color: #666;">{{ $fournisseur->type ?: 'Non spécifié' }}</div>
                        </td>
                        <td>
                            <div style="font-size: 0.9rem;">{{ $fournisseur->email }}</div>
                            <div style="font-size: 0.9rem; color: #666;">{{ $fournisseur->telephone }}</div>
                        </td>
                        <td style="text-align: center;">
                            <div style="font-weight: 600; color: #219150;">{{ $fournisseur->nombre_commandes }}</div>
                            <div style="font-size: 0.8rem; color: #666;">commandes</div>
                        </td>
                        <td style="text-align: center;">
                            <div style="font-weight: 600; color: #219150;">{{ number_format($fournisseur->montant_total_commandes, 0, ',', ' ') }} FCFA</div>
                        </td>
                        <td style="text-align: center;">
                            @if($fournisseur->nombre_commandes_livrees > 0)
                                <div style="font-weight: 600; color: #219150;">{{ $fournisseur->taux_ponctualite }}%</div>
                                <div style="font-size: 0.8rem; color: #666;">{{ $fournisseur->nombre_livraisons_a_temps }}/{{ $fournisseur->nombre_commandes_livrees }}</div>
                            @else
                                <div style="color: #999;">-</div>
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <div style="font-weight: 600; color: {{ $fournisseur->score_color == 'green' ? '#219150' : ($fournisseur->score_color == 'yellow' ? '#f59e0b' : ($fournisseur->score_color == 'orange' ? '#f97316' : '#ef4444')) }};">
                                {{ $fournisseur->score_global }}/100
                            </div>
                            <div style="font-size: 0.8rem; color: #666;">{{ $fournisseur->score_label }}</div>
                        </td>
                        <td style="text-align: center;">
                            <a href="{{ route('fournisseur.details', $fournisseur) }}" style="color: #219150; text-decoration: none; font-weight: 600;">
                                <i class="fas fa-chart-bar mr-1"></i>Voir détails
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" style="text-align:center;color:#aaa;">Aucun fournisseur enregistré.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal pour ajouter un fournisseur -->
    <div id="modal-fournisseur" class="modal-overlay">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 40px; height: 40px; background: rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-truck text-white"></i>
                    </div>
                    <div>
                        <h3 style="font-size: 1.5rem; font-weight: 600; margin: 0;">Ajouter un fournisseur</h3>
                        <p style="margin: 0; opacity: 0.9; font-size: 0.9rem;">Nouveau partenaire commercial</p>
                    </div>
                </div>
                <button onclick="closeModal('modal-fournisseur')" class="modal-close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
                
                <!-- Content -->
                <div class="modal-body">
                    <form id="form-fournisseur" method="POST" action="{{ route('ajouter.fournisseur') }}">
                        @csrf
                        
                        <!-- Informations principales -->
                        <div class="form-section">
                            <div class="form-section-title">
                                <div class="form-section-icon" style="background: #219150;">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <span>Informations principales</span>
                            </div>
                            
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="nom" class="form-label required">Nom du fournisseur</label>
                                    <input type="text" id="nom" name="nom" required class="form-input" placeholder="Nom de l'entreprise...">
                                </div>
                                
                                <div class="form-group">
                                    <label for="email" class="form-label required">Email</label>
                                    <input type="email" id="email" name="email" required class="form-input" placeholder="contact@entreprise.com">
                                </div>
                                
                                <div class="form-group">
                                    <label for="telephone" class="form-label required">Téléphone</label>
                                    <input type="text" id="telephone" name="telephone" required class="form-input" placeholder="+225 0123456789">
                                </div>
                                
                                <div class="form-group">
                                    <label for="type" class="form-label">Type de fournisseur</label>
                                    <select id="type" name="type" class="form-select">
                                        <option value="">Sélectionner un type</option>
                                        <option value="pièces">🔧 Pièces automobiles</option>
                                        <option value="services">🛠️ Services</option>
                                        <option value="carburant">⛽ Carburant</option>
                                        <option value="informatique">💻 Informatique</option>
                                        <option value="autre">📦 Autre</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Adresse et contact -->
                        <div class="form-section">
                            <div class="form-section-title">
                                <div class="form-section-icon" style="background: #3b82f6;">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <span>Adresse et contact</span>
                            </div>
                            
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="adresse" class="form-label">Adresse</label>
                                    <input type="text" id="adresse" name="adresse" class="form-input" placeholder="Adresse complète...">
                                </div>
                                
                                <div class="form-group">
                                    <label for="ville" class="form-label">Ville</label>
                                    <input type="text" id="ville" name="ville" class="form-input" placeholder="Ville...">
                                </div>
                                
                                <div class="form-group">
                                    <label for="pays" class="form-label">Pays</label>
                                    <input type="text" id="pays" name="pays" class="form-input" placeholder="Pays..." value="Côte d'Ivoire">
                                </div>
                                
                                <div class="form-group">
                                    <label for="responsable" class="form-label">Responsable</label>
                                    <input type="text" id="responsable" name="responsable" class="form-input" placeholder="Nom du contact principal...">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Actions -->
                        <div class="form-actions">
                            <button type="button" onclick="closeModal('modal-fournisseur')" class="btn btn-secondary">
                                <i class="fas fa-times"></i>
                                Annuler
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i>
                                Enregistrer le fournisseur
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    function openModal(id) {
        console.log('Opening modal:', id);
        const modal = document.getElementById(id);
        
        if (!modal) {
            console.error('Modal not found:', id);
            return;
        }
        
        const content = modal.querySelector('.modal-content');
        
        // Afficher le modal
        modal.classList.add('show'); // Add the show class
        
        // Animation d'ouverture
        setTimeout(() => {
            modal.style.opacity = '1';
            content.style.transform = 'scale(1)';
        }, 10);
        
        console.log('Modal opened successfully');
    }
    
    function closeModal(id) {
        console.log('Closing modal:', id);
        const modal = document.getElementById(id);
        const content = modal.querySelector('.modal-content');
        
        // Animation de fermeture
        modal.style.opacity = '0';
        content.style.transform = 'scale(0.9)';
        
        setTimeout(() => {
            modal.classList.remove('show'); // Remove the show class
        }, 300);
    }
    
    // Fermer le modal en cliquant sur l'overlay
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('modal-overlay')) {
            const modalId = e.target.id;
            closeModal(modalId);
        }
    });
    
    // Fermer le modal avec la touche Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const openModal = document.querySelector('.modal-overlay.show');
            if (openModal) {
                closeModal(openModal.id);
            }
        }
    });
    
    window.addEventListener('DOMContentLoaded', function() {
        console.log('DOM loaded, setting up modal handlers');
        
        // Gestion soumission du formulaire modal
        const form = document.querySelector('#form-fournisseur');
        if (form) {
            form.addEventListener('submit', function(e) {
                console.log('Form submitted');
                // Laisser le formulaire se soumettre normalement
                setTimeout(() => {
                    closeModal('modal-fournisseur');
                }, 100);
            });
        }
        
        // Ouvrir automatiquement le modal si on vient du menu "Nouveau Fournisseur"
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('action') === 'nouveau') {
            setTimeout(() => {
                openModal('modal-fournisseur');
            }, 100);
        }
        
        // Test du bouton
        const addButton = document.querySelector('button[onclick*="openModal"]');
        if (addButton) {
            console.log('Add button found:', addButton);
            addButton.addEventListener('click', function(e) {
                console.log('Add button clicked');
            });
        }
    });
    </script>
</body>
</html> 