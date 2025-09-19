<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Liste des Contrats</title>
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
                <div class="greeting">Liste des Contrats</div>
                <div class="subtitle" style="color: #ffe082;">Gestion des engagements contractuels</div>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-file-contract" style="font-size: 2.5rem; color: #ffe082;"></i>
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
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('dashboard.moyens-generaux') }}'"><i class="fas fa-plus mr-2"></i>Nouveau Fournisseur</button></li>
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('liste.fournisseurs') }}'"><i class="fas fa-list mr-2"></i>Liste Fournisseurs</button></li>
                    <li><button class="dropdown-item"><i class="fas fa-star mr-2"></i>Évaluations</button></li>
                </ul>
            </li>
            <!-- Contrats -->
            <li class="menu-dropdown" style="position: relative;">
                <button class="menu-btn">
                    <i class="fas fa-file-contract mr-2 text-yellow-600"></i>Contrats <i class="fas fa-chevron-down ml-1"></i>
                </button>
                <ul class="dropdown-content">
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('dashboard.moyens-generaux') }}'"><i class="fas fa-plus mr-2"></i>Nouveau Contrat</button></li>
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('liste.contrats') }}'"><i class="fas fa-list mr-2"></i>Liste Contrats</button></li>
                    <li><button class="dropdown-item"><i class="fas fa-calendar mr-2"></i>Échéances</button></li>
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
        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid #c3e6cb;">
                {{ session('success') }}
            </div>
        @endif
        
        @if($errors->any())
            <div style="background: #f8d7da; color: #721c24; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid #f5c6cb;">
                <ul style="margin: 0; padding-left: 1.5rem;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        

        
        <!-- Filtres et actions -->
        <div style="background: #f8f9fa; border-radius: 12px; padding: 1.5rem; margin-bottom: 2rem; border: 1px solid #e9ecef;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                <h3 style="color: #17423b; font-size: 1.2rem; font-weight: 600;">🔍 Filtres</h3>
                <div style="display: flex; gap: 1rem;">
                    <a href="{{ route('contrats.export', request()->query()) }}" style="background: #6c757d; color: #fff; padding: 0.6rem 1rem; border-radius: 6px; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem;" onmouseover="this.style.background='#5a6268'" onmouseout="this.style.background='#6c757d'">
                        <i class="fas fa-file-pdf"></i>Exporter PDF
                    </a>
                    <a href="{{ route('contrats.create') }}" style="background: #219150; color: #fff; padding: 0.6rem 1rem; border-radius: 6px; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem;" onmouseover="this.style.background='#1e5c4a'" onmouseout="this.style.background='#219150'">
                        <i class="fas fa-plus"></i>Nouveau Contrat
                    </a>
                </div>
            </div>
            
            <form method="GET" action="{{ route('liste.contrats') }}" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                <div>
                    <label style="display: block; font-weight: 600; color: #374151; margin-bottom: 0.5rem; font-size: 0.9rem;">Catégorie</label>
                    <select name="categorie" style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.9rem;">
                        <option value="">Toutes les catégories</option>
                        @foreach(App\Models\Contrat::getCategories() as $key => $label)
                            <option value="{{ $key }}" {{ request('categorie') == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label style="display: block; font-weight: 600; color: #374151; margin-bottom: 0.5rem; font-size: 0.9rem;">Statut</label>
                    <select name="statut" style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.9rem;">
                        <option value="">Tous les statuts</option>
                        <option value="actif" {{ request('statut') == 'actif' ? 'selected' : '' }}>✅ Actif</option>
                        <option value="suspendu" {{ request('statut') == 'suspendu' ? 'selected' : '' }}>⏸️ Suspendu</option>
                        <option value="renouvele" {{ request('statut') == 'renouvele' ? 'selected' : '' }}>🔄 Renouvelé</option>
                        <option value="resilie" {{ request('statut') == 'resilie' ? 'selected' : '' }}>❌ Résilié</option>
                        <option value="expire" {{ request('statut') == 'expire' ? 'selected' : '' }}>⏰ Expiré</option>
                    </select>
                </div>
                
                <div>
                    <label style="display: block; font-weight: 600; color: #374151; margin-bottom: 0.5rem; font-size: 0.9rem;">Fournisseur</label>
                    <select name="fournisseur" style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.9rem;">
                        <option value="">Tous les fournisseurs</option>
                        @foreach($fournisseurs as $fournisseur)
                            <option value="{{ $fournisseur->id }}" {{ request('fournisseur') == $fournisseur->id ? 'selected' : '' }}>{{ $fournisseur->nom }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label style="display: block; font-weight: 600; color: #374151; margin-bottom: 0.5rem; font-size: 0.9rem;">Tri</label>
                    <select name="tri" style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.9rem;">
                        <option value="recent" {{ request('tri') == 'recent' ? 'selected' : '' }}>Plus récents</option>
                        <option value="ancien" {{ request('tri') == 'ancien' ? 'selected' : '' }}>Plus anciens</option>
                        <option value="montant" {{ request('tri') == 'montant' ? 'selected' : '' }}>Montant décroissant</option>
                        <option value="date_fin" {{ request('tri') == 'date_fin' ? 'selected' : '' }}>Date de fin</option>
                        <option value="categorie" {{ request('tri') == 'categorie' ? 'selected' : '' }}>Par catégorie</option>
                    </select>
                </div>
                
                <div style="display: flex; align-items: end; gap: 0.5rem;">
                    <button type="submit" style="background: #219150; color: #fff; padding: 0.5rem 1rem; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 0.9rem;" onmouseover="this.style.background='#1e5c4a'" onmouseout="this.style.background='#219150'">
                        <i class="fas fa-search"></i> Filtrer
                    </button>
                    <a href="{{ route('liste.contrats') }}" style="background: #6c757d; color: #fff; padding: 0.5rem 1rem; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 0.9rem;" onmouseover="this.style.background='#5a6268'" onmouseout="this.style.background='#6c757d'">
                        <i class="fas fa-times"></i> Réinitialiser
                    </a>
                </div>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Référence</th>
                    <th>Intitulé</th>
                    <th>Fournisseur</th>
                    <th>Catégorie</th>
                    <th>Date début</th>
                    <th>Date fin</th>
                    <th>Montant</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contrats as $contrat)
                    <tr>
                        <td style="font-weight: 600; color: #219150;">{{ $contrat->reference }}</td>
                        <td>{{ $contrat->intitule }}</td>
                        <td>{{ $contrat->fournisseur->nom ?? 'N/A' }}</td>
                        <td>
                            <span style="background: #f0f8f0; color: #17423b; padding: 4px 8px; border-radius: 4px; font-size: 0.8rem; font-weight: 600;">
                                {{ $contrat->categorie_label }}
                            </span>
                            @if($contrat->periodicite)
                                <br><small style="color: #666; font-size: 0.8rem;">{{ $contrat->periodicite_label }}</small>
                            @endif
                        </td>
                        <td>{{ $contrat->date_debut->format('d/m/Y') }}</td>
                        <td>{{ $contrat->date_fin->format('d/m/Y') }}</td>
                        <td style="font-weight: 600;">{{ number_format($contrat->montant, 0, ',', ' ') }} FCFA</td>
                        <td>
                            @if($contrat->statut === 'actif')
                                <span style="background:#e3f2fd;color:#1976d2;padding:4px 8px;border-radius:4px;font-size:0.9rem;">✅ Actif</span>
                            @elseif($contrat->statut === 'suspendu')
                                <span style="background:#fff3cd;color:#856404;padding:4px 8px;border-radius:4px;font-size:0.9rem;">⏸️ Suspendu</span>
                            @elseif($contrat->statut === 'renouvele')
                                <span style="background:#d1ecf1;color:#0c5460;padding:4px 8px;border-radius:4px;font-size:0.9rem;">🔄 Renouvelé</span>
                            @elseif($contrat->statut === 'resilie')
                                <span style="background:#f8d7da;color:#721c24;padding:4px 8px;border-radius:4px;font-size:0.9rem;">❌ Résilié</span>
                            @else
                                <span style="background:#f8d7da;color:#721c24;padding:4px 8px;border-radius:4px;font-size:0.9rem;">⏰ Expiré</span>
                            @endif
                        </td>
                        <td>
                            <i class="fas fa-eye" style="color:{{ $contrat->statut === 'resilie' ? '#6c757d' : '#219150' }};cursor:pointer;margin-right:10px;" title="Voir les détails" onclick="window.location.href='{{ route('contrat.details', $contrat->id) }}'"></i>
                            @if($contrat->statut !== 'resilie')
                                <i class="fas fa-edit" style="color:#219150;cursor:pointer;" title="Modifier"></i>
                            @else
                                <i class="fas fa-edit" style="color:#6c757d;cursor:not-allowed;" title="Non modifiable"></i>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" style="text-align: center; padding: 2rem; color: #666;">
                            <i class="fas fa-inbox" style="font-size: 2rem; margin-bottom: 1rem; display: block;"></i>
                            Aucun contrat enregistré
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal de notification -->
    <div id="notification-modal" class="modal-bg" style="display:none;">
        <div class="modal-content" style="max-width: 400px; text-align: center;">
            <div id="notification-icon" style="font-size: 3rem; margin-bottom: 1rem;"></div>
            <h3 id="notification-title" style="margin-bottom: 1rem;"></h3>
            <p id="notification-message" style="color: #666; margin-bottom: 2rem;"></p>
            <button onclick="closeNotification()" class="modal-btn" style="background: #e6b800; color: #fff; width: auto; padding: 0.8rem 2rem;">
                OK
            </button>
        </div>
    </div>

    <!-- Modal pour ajouter un contrat -->
    <div id="modal-contrat" class="modal-bg" style="display:none;">
        <div class="modal-content modal-jaune">
            <button class="modal-close" onclick="closeModal('modal-contrat')">&times;</button>
            <h2>Ajouter un Contrat</h2>
            <form id="form-contrat" method="POST" action="{{ route('contrats.store') }}" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                @csrf
                <div>
                    <label>Intitulé du contrat <span style="color:red">*</span></label>
                    <input type="text" name="intitule" class="modal-input" placeholder="Intitulé..." required />
                </div>
                <div>
                    <label>Fournisseur <span style="color:red">*</span></label>
                    <select name="fournisseur" class="modal-input" required>
                        <option value="">-- Sélectionner --</option>
                        @foreach($fournisseurs as $fournisseur)
                            <option value="{{ $fournisseur->id }}">{{ $fournisseur->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Date de début <span style="color:red">*</span></label>
                    <input type="date" name="date_debut" id="date_debut" class="modal-input" required onchange="calculerDateFin()" />
                </div>
                <div>
                    <label>Durée du contrat <span style="color:red">*</span></label>
                    <select name="duree" id="duree" class="modal-input" required onchange="calculerDateFin()">
                        <option value="">-- Sélectionner --</option>
                        <option value="1">1 mois</option>
                        <option value="3">3 mois</option>
                        <option value="6">6 mois</option>
                        <option value="12">1 an</option>
                        <option value="18">18 mois</option>
                        <option value="24">2 ans</option>
                        <option value="36">3 ans</option>
                    </select>
                </div>
                <div>
                    <label>Date de fin (calculée automatiquement)</label>
                    <input type="date" name="date_fin" id="date_fin" class="modal-input" readonly style="background: #f5f5f5;" />
                </div>
                <div>
                    <label>Montant (F CFA) <span style="color:red">*</span></label>
                    <input type="number" name="montant" class="modal-input" placeholder="Montant..." step="0.01" required />
                </div>
                <div>
                    <label>Type de contrat</label>
                    <select name="type" class="modal-input">
                        <option value="">-- Sélectionner --</option>
                        <option value="assurance">Assurance</option>
                        <option value="fourniture">Fourniture</option>
                        <option value="service">Service</option>
                        <option value="maintenance">Maintenance</option>
                    </select>
                </div>
                <div>
                    <label>Statut (déterminé automatiquement)</label>
                    <input type="text" id="statut_affichage" class="modal-input" readonly style="background: #f5f5f5;" />
                    <input type="hidden" name="statut" id="statut_valeur" value="actif" />
                </div>
                <div style="grid-column: 1 / -1;">
                    <label>Description</label>
                    <textarea name="description" class="modal-input" placeholder="Description du contrat..." rows="3" style="resize: vertical;"></textarea>
                </div>
                <div style="grid-column: 1 / -1; text-align: center; margin-top: 1rem;">
                    <button type="submit" class="modal-btn modal-btn-jaune" style="width: auto; padding: 0.8rem 2rem;">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <style>
    .modal-bg {
        position: fixed; left: 0; top: 0; width: 100vw; height: 100vh;
        background: rgba(30, 60, 60, 0.35); z-index: 1000;
        display: flex; align-items: center; justify-content: center;
        padding: 20px;
        box-sizing: border-box;
    }
    .modal-content {
        background: #fff; border-radius: 18px; box-shadow: 0 8px 32px rgba(23,66,59,0.18);
        padding: 2.5rem 2.5rem 2rem 2.5rem; min-width: 340px; max-width: 90vw;
        position: relative;
        width: 100%; max-width: 1200px;
        margin: 20px;
        height: 80vh;
        overflow-y: auto;
    }
    .modal-content h2 { margin-bottom: 1.5rem; font-size: 1.3rem; font-weight: 700; }
    .modal-input {
        width: 100%; padding: 0.7rem 1rem; border-radius: 8px; border: 1px solid #e0e0e0;
        margin-bottom: 1.1rem; font-size: 1rem;
    }
    .modal-btn {
        width: 100%; padding: 0.8rem 0; border-radius: 8px; font-size: 1.1rem; font-weight: 600; border: none; color: #fff; margin-top: 0.5rem;
    }
    .modal-btn-jaune { background: #e6b800; }
    .modal-jaune h2 { color: #e6b800; }
    .modal-close {
        position: absolute; top: 18px; right: 22px; background: none; border: none; font-size: 2rem; color: #aaa; cursor: pointer;
        transition: color 0.2s;
    }
    .modal-close:hover { color: #e6b800; }
    </style>

    <script>
    function openModal(id) {
        document.getElementById(id).style.display = 'flex';
    }
    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
    }
    // Fonction pour calculer la date de fin et déterminer le statut
    function calculerDateFin() {
        const dateDebut = document.getElementById('date_debut').value;
        const duree = document.getElementById('duree').value;
        const dateFinInput = document.getElementById('date_fin');
        const statutAffichage = document.getElementById('statut_affichage');
        const statutValeur = document.getElementById('statut_valeur');
        
        if (dateDebut && duree) {
            const dateDebutObj = new Date(dateDebut);
            const dateFinObj = new Date(dateDebutObj);
            dateFinObj.setMonth(dateFinObj.getMonth() + parseInt(duree));
            
            // Formater la date pour l'input
            const jour = dateFinObj.getDate().toString().padStart(2, '0');
            const mois = (dateFinObj.getMonth() + 1).toString().padStart(2, '0');
            const annee = dateFinObj.getFullYear();
            const dateFinFormatee = `${annee}-${mois}-${jour}`;
            
            dateFinInput.value = dateFinFormatee;
            
            // Déterminer le statut automatiquement
            const aujourdhui = new Date();
            const dateFin = new Date(dateFinFormatee);
            
            if (dateFin < aujourdhui) {
                statutAffichage.value = 'Expiré';
                statutValeur.value = 'expire';
                statutAffichage.style.color = '#721c24';
                statutAffichage.style.backgroundColor = '#f8d7da';
            } else {
                statutAffichage.value = 'Actif';
                statutValeur.value = 'actif';
                statutAffichage.style.color = '#219150';
                statutAffichage.style.backgroundColor = '#eafaf4';
            }
        } else {
            dateFinInput.value = '';
            statutAffichage.value = '';
            statutValeur.value = 'actif';
        }
    }
    
    // Fonction pour afficher les notifications stylées
    function showNotification(type, title, message) {
        const modal = document.getElementById('notification-modal');
        const icon = document.getElementById('notification-icon');
        const titleEl = document.getElementById('notification-title');
        const messageEl = document.getElementById('notification-message');
        
        // Configurer l'apparence selon le type
        if (type === 'success') {
            icon.innerHTML = '<i class="fas fa-check-circle" style="color: #28a745;"></i>';
            titleEl.style.color = '#28a745';
        } else if (type === 'error') {
            icon.innerHTML = '<i class="fas fa-exclamation-circle" style="color: #dc3545;"></i>';
            titleEl.style.color = '#dc3545';
        } else if (type === 'warning') {
            icon.innerHTML = '<i class="fas fa-exclamation-triangle" style="color: #ffc107;"></i>';
            titleEl.style.color = '#ffc107';
        }
        
        titleEl.textContent = title;
        messageEl.textContent = message;
        modal.style.display = 'flex';
    }
    
    function closeNotification() {
        document.getElementById('notification-modal').style.display = 'none';
    }
    
    window.addEventListener('DOMContentLoaded', function() {
        // Gestion soumission du formulaire modal
        const form = document.querySelector('#modal-contrat form');
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Validation côté client
                const dateDebut = document.getElementById('date_debut').value;
                const duree = document.getElementById('duree').value;
                const montant = document.querySelector('input[name="montant"]').value;
                
                if (!dateDebut || !duree || !montant) {
                    showErrorModal('notificationModal', 'Erreur de validation', 'Veuillez remplir tous les champs obligatoires.');
                    return;
                }
                
                // Soumission simple du formulaire
                this.submit();
            });
        }
        
        // Fermer les modals en cliquant à l'extérieur
        document.querySelectorAll('.modal-bg').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.style.display = 'none';
                }
            });
        });
    });
    </script>

    <!-- Modal de notification -->
    <x-modal id="notificationModal" title="Notification" type="info">
        Message de notification
    </x-modal>
</body>
</html> 