<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Détails du Contrat</title>
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
        .back-btn { display: inline-block; margin-bottom: 1.5rem; color: #219150; text-decoration: none; font-weight: 600; }
        .back-btn i { margin-right: 6px; }
        .contract-header { background: #eafaf4; padding: 2rem; border-radius: 12px; margin-bottom: 2rem; }
        .contract-title { font-size: 1.8rem; font-weight: 700; color: #17423b; margin-bottom: 0.5rem; }
        .contract-subtitle { color: #666; font-size: 1.1rem; }
        .info-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-bottom: 2rem; }
        .info-card { background: #f8f9fa; padding: 1.5rem; border-radius: 10px; border-left: 4px solid #e6b800; }
        .info-card h3 { color: #17423b; font-size: 1.1rem; font-weight: 600; margin-bottom: 1rem; }
        .info-item { display: flex; justify-content: space-between; margin-bottom: 0.8rem; }
        .info-label { font-weight: 500; color: #666; }
        .info-value { font-weight: 600; color: #17423b; }
        .status-badge { padding: 0.4rem 1rem; border-radius: 20px; font-size: 0.9rem; font-weight: 600; }
        .status-actif { background: #e3f2fd; color: #1976d2; }
        .status-suspendu { background: #fff3cd; color: #856404; }
        .status-renouvele { background: #d1ecf1; color: #0c5460; }
        .status-resilie { background: #f8d7da; color: #721c24; }
        .history-section { margin-top: 2rem; }
        .history-title { font-size: 1.4rem; font-weight: 600; color: #17423b; margin-bottom: 1.5rem; }
        .timeline { position: relative; padding-left: 2rem; }
        .timeline::before { content: ''; position: absolute; left: 0.5rem; top: 0; bottom: 0; width: 2px; background: #e6b800; }
        .timeline-item { position: relative; margin-bottom: 2rem; padding-left: 2rem; }
        .timeline-item::before { content: ''; position: absolute; left: -0.5rem; top: 0.5rem; width: 1rem; height: 1rem; background: #e6b800; border-radius: 50%; }
        .timeline-date { font-size: 0.9rem; color: #666; margin-bottom: 0.5rem; }
        .timeline-content { background: #f8f9fa; padding: 1rem; border-radius: 8px; }
        .timeline-title { font-weight: 600; color: #17423b; margin-bottom: 0.5rem; }
        .timeline-desc { color: #666; }
        .actions-section { margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #eee; }
        .action-buttons { display: flex; gap: 1rem; flex-wrap: wrap; }
        .btn { padding: 0.8rem 1.5rem; border-radius: 8px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.2s; }
        .btn-primary { background: #e6b800; color: #fff; }
        .btn-primary:hover { background: #d4a800; }
        .btn-secondary { background: #6c757d; color: #fff; }
        .btn-secondary:hover { background: #5a6268; }
        .btn-danger { background: #dc3545; color: #fff; }
        .btn-danger:hover { background: #c82333; }
        
        /* Styles pour la section paiements */
        .payment-section { margin-top: 2rem; }
        .payment-title { font-size: 1.4rem; font-weight: 600; color: #17423b; margin-bottom: 1.5rem; }
        .payment-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
        .payment-card { background: #f8f9fa; padding: 1.5rem; border-radius: 10px; border-left: 4px solid #28a745; }
        .payment-card h4 { color: #17423b; font-size: 1rem; font-weight: 600; margin-bottom: 1rem; }
        .payment-item { display: flex; justify-content: space-between; margin-bottom: 0.8rem; }
        .payment-label { font-weight: 500; color: #666; }
        .payment-value { font-weight: 600; color: #17423b; }
        .payment-buttons { display: flex; gap: 1rem; flex-wrap: wrap; }
        .btn-payment { background: #28a745; color: #fff; padding: 0.6rem 1rem; border-radius: 6px; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem; border: none; cursor: pointer; }
        .btn-payment:hover { background: #218838; }
        .btn-history { background: #6c757d; color: #fff; padding: 0.6rem 1rem; border-radius: 6px; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem; border: none; cursor: pointer; }
        .btn-history:hover { background: #5a6268; }
        
        /* Modal styles */
        .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); }
        .modal-content { 
            background: white; 
            margin: 0; 
            padding: 0; 
            border-radius: 15px; 
            width: 90%; 
            max-width: 500px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.3); 
            transform: scale(0.7); 
            opacity: 0; 
            transition: all 0.3s ease;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.7);
        }
        .modal.show .modal-content { 
            transform: translate(-50%, -50%) scale(1); 
            opacity: 1; 
        }
        
        /* Masquer la barre de défilement */
        .modal-content {
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* Internet Explorer 10+ */
        }
        .modal-content::-webkit-scrollbar {
            display: none; /* Chrome, Safari, Opera */
        }
        .modal-header { background: linear-gradient(135deg, #28a745, #20c997); color: white; padding: 1.5rem; border-radius: 15px 15px 0 0; display: flex; justify-content: space-between; align-items: center; }
        .modal-header h3 { margin: 0; font-size: 1.3rem; font-weight: 600; }
        .modal-close { background: none; border: none; color: white; font-size: 1.5rem; cursor: pointer; padding: 0; }
        .modal-body { padding: 2rem; }
        .form-group { margin-bottom: 1.5rem; }
        .form-label { display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333; }
        .form-input, .form-select { width: 100%; padding: 0.75rem; border: 2px solid #e1e5e9; border-radius: 8px; font-size: 1rem; transition: border-color 0.3s; }
        .form-input:focus, .form-select:focus { outline: none; border-color: #28a745; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .btn-submit { background: linear-gradient(135deg, #28a745, #20c997); color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; width: 100%; font-size: 1rem; }
        .btn-submit:hover { background: linear-gradient(135deg, #218838, #1ea085); }
        .btn-cancel { background: #6c757d; color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; width: 100%; font-size: 1rem; margin-top: 0.5rem; }
        .btn-cancel:hover { background: #5a6268; }
        
        /* Historique modal */
        .history-modal .modal-header { background: linear-gradient(135deg, #6c757d, #495057); }
        .history-item { background: #f8f9fa; padding: 1rem; border-radius: 8px; margin-bottom: 1rem; border-left: 4px solid #28a745; }
        .history-item-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem; }
        .history-amount { font-weight: 600; color: #28a745; font-size: 1.1rem; }
        .history-date { color: #666; font-size: 0.9rem; }
        .history-details { color: #333; }
        .history-mode { display: inline-block; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.8rem; font-weight: 600; }
        .mode-especes { background: #d4edda; color: #155724; }
        .mode-cheque { background: #d1ecf1; color: #0c5460; }
        .mode-virement { background: #e2d9f3; color: #6f42c1; }
        .mode-carte { background: #fff3cd; color: #856404; }
        
        /* Modal de notification */
        .notification-modal { display: none; position: fixed; z-index: 2000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); }
        .notification-content { 
            background: white; 
            margin: 0; 
            padding: 0; 
            border-radius: 15px; 
            width: 90%; 
            max-width: 400px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.3); 
            transform: scale(0.7); 
            opacity: 0; 
            transition: all 0.3s ease;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.7);
        }
        .notification-modal.show .notification-content { 
            transform: translate(-50%, -50%) scale(1); 
            opacity: 1; 
        }
        .notification-header { background: linear-gradient(135deg, #28a745, #20c997); color: white; padding: 1.5rem; border-radius: 15px 15px 0 0; display: flex; justify-content: space-between; align-items: center; }
        .notification-header h3 { margin: 0; font-size: 1.3rem; font-weight: 600; }
        .notification-body { padding: 2rem; text-align: center; }
        .notification-icon { font-size: 3rem; color: #28a745; margin-bottom: 1rem; }
        .notification-message { font-size: 1.1rem; color: #333; margin-bottom: 1.5rem; }
        .notification-btn { background: linear-gradient(135deg, #28a745, #20c997); color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 1rem; }
        .notification-btn:hover { background: linear-gradient(135deg, #218838, #1ea085); }
        
        /* Modal d'erreur */
        .error-modal .notification-header { background: linear-gradient(135deg, #dc3545, #c82333); }
        .error-modal .notification-icon { color: #dc3545; }
        .error-modal .notification-btn { background: linear-gradient(135deg, #dc3545, #c82333); }
        .error-modal .notification-btn:hover { background: linear-gradient(135deg, #c82333, #bd2130); }
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
                <div class="greeting">Détails du Contrat</div>
                <div class="subtitle" style="color: #ffe082;">Informations complètes et historique</div>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-file-contract" style="font-size: 2.5rem; color: #ffe082;"></i>
            </div>
        </div>
    </div>

    <!-- Menu secondaire harmonisé -->
    <div class="main-content" style="max-width: 1200px; margin: 0 auto; margin-top: -60px; margin-bottom: 2.5rem; z-index:20; position:relative;">
        <div class="menu-bar" style="background: #fff; border-radius: 16px; box-shadow: 0 2px 12px rgba(23,66,59,0.08); padding: 0.7rem 2.5rem; display: flex; justify-content: center; gap: 2.5rem;">
            <!-- Fournisseurs -->
            <div class="menu-dropdown" style="position: relative;">
                <button class="menu-btn">
                    <i class="fas fa-truck mr-2 text-green-700"></i>Fournisseurs <i class="fas fa-chevron-down ml-1"></i>
                </button>
                <ul class="dropdown-content">
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('dashboard.moyens-generaux') }}'"><i class="fas fa-plus mr-2"></i>Nouveau Fournisseur</button></li>
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('liste.fournisseurs') }}'"><i class="fas fa-list mr-2"></i>Liste Fournisseurs</button></li>
                    <li><button class="dropdown-item"><i class="fas fa-star mr-2"></i>Évaluations</button></li>
                </ul>
            </div>
            <!-- Contrats -->
            <div class="menu-dropdown" style="position: relative;">
                <button class="menu-btn">
                    <i class="fas fa-file-contract mr-2 text-yellow-600"></i>Contrats <i class="fas fa-chevron-down ml-1"></i>
                </button>
                <ul class="dropdown-content">
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('dashboard.moyens-generaux') }}'"><i class="fas fa-plus mr-2"></i>Nouveau Contrat</button></li>
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('liste.contrats') }}'"><i class="fas fa-list mr-2"></i>Liste Contrats</button></li>
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('contrats.echeances') }}'"><i class="fas fa-calendar mr-2"></i>Échéances</button></li>
                    <li><button class="dropdown-item"><i class="fas fa-sync mr-2"></i>Renouvellements</button></li>
                </ul>
            </div>
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
        </div>
        <style>
            .menu-btn { background: none; border: none; border-radius: 12px; padding: 0.7rem 1.7rem; font-size: 1.1rem; font-weight: 600; color: #17423b; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; transition: background 0.2s, color 0.2s; }
            .menu-btn:hover { background: #eafaf4; color: #1e5c4a; }
            .dropdown-content { display: none; position: absolute; left: 0; top: 110%; min-width: 220px; background: #fff; border-radius: 14px; box-shadow: 0 8px 32px rgba(23,66,59,0.13); z-index: 20; padding: 0.5rem 0; }
            .menu-dropdown:hover .dropdown-content { display: block; }
            .dropdown-item { width: 100%; background: none; border: none; text-align: left; padding: 0.8rem 1.5rem; font-size: 1rem; color: #17423b; border-radius: 8px; cursor: pointer; transition: background 0.18s, color 0.18s; display: flex; align-items: center; gap: 0.7rem; }
            .dropdown-item:hover { background: #eafaf4; color: #1e5c4a; }
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
        
        <a href="{{ route('liste.contrats') }}" class="back-btn"><i class="fas fa-arrow-left"></i>Retour à la liste des contrats</a>
        
        <!-- En-tête du contrat -->
        <div class="contract-header">
            <div class="contract-title">{{ $contrat->intitule }}</div>
            <div class="contract-subtitle">{{ $contrat->description ?: 'Aucune description disponible' }}</div>
        </div>

        <!-- Informations principales -->
        <div class="info-grid">
            <div class="info-card">
                <h3><i class="fas fa-info-circle mr-2"></i>Informations générales</h3>
                <div class="info-item">
                    <span class="info-label">Référence :</span>
                    <span class="info-value" data-field="reference">{{ $contrat->reference ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Fournisseur :</span>
                    <span class="info-value" data-field="fournisseur">{{ $contrat->fournisseur->nom ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Type :</span>
                    <span class="info-value" data-field="type">{{ ucfirst($contrat->type ?? 'N/A') }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Statut actuel :</span>
                    <span class="info-value" data-field="statut">
                        @if($contrat->statut === 'actif')
                            <span class="status-badge status-actif">Actif</span>
                        @elseif($contrat->statut === 'suspendu')
                            <span class="status-badge status-suspendu">Suspendu</span>
                        @elseif($contrat->statut === 'renouvele')
                            <span class="status-badge status-renouvele">Renouvelé</span>
                        @elseif($contrat->statut === 'resilie')
                            <span class="status-badge status-resilie">Résilié</span>
                        @else
                            <span class="status-badge status-resilie">Expiré</span>
                        @endif
                    </span>
                </div>
            </div>

            <div class="info-card">
                <h3><i class="fas fa-calendar-alt mr-2"></i>Dates importantes</h3>
                <div class="info-item">
                    <span class="info-label">Date de création :</span>
                    <span class="info-value">{{ $contrat->created_at->format('d/m/Y') }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Date de début :</span>
                    <span class="info-value" data-field="date_debut">{{ $contrat->date_debut->format('d/m/Y') }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Date de fin :</span>
                    <span class="info-value" data-field="date_fin">{{ $contrat->date_fin->format('d/m/Y') }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Dernière modification :</span>
                    <span class="info-value">{{ $contrat->updated_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>

            <div class="info-card">
                <h3><i class="fas fa-euro-sign mr-2"></i>Informations financières</h3>
                <div class="info-item">
                    <span class="info-label">Montant :</span>
                    <span class="info-value" data-field="montant">{{ number_format($contrat->montant, 0, ',', ' ') }} F CFA</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Jours de suspension :</span>
                    <span class="info-value" data-field="suspension">
                        @if($contrat->statut === 'suspendu' && $contrat->date_debut_suspension)
                            @php
                                $debutSuspension = \Carbon\Carbon::parse($contrat->date_debut_suspension);
                                $aujourdhui = \Carbon\Carbon::now();
                                $joursSuspension = (int) $debutSuspension->diffInDays($aujourdhui);
                            @endphp
                            {{ $joursSuspension }} jours (depuis le {{ $debutSuspension->format('d/m/Y') }})
                        @elseif($contrat->jours_suspension && $contrat->jours_suspension > 0)
                            {{ (int) $contrat->jours_suspension }} jours (total cumulé)
                        @else
                            Aucune suspension
                        @endif
                    </span>
                </div>
                <div class="info-item">
                    <span class="info-label">Nombre de renouvellements :</span>
                    <span class="info-value">{{ $contrat->nombre_renouvellements ?? 0 }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Durée restante :</span>
                    <span class="info-value" data-field="duree_restante">
                        @php
                            $aujourdhui = \Carbon\Carbon::now();
                            $dateFin = \Carbon\Carbon::parse($contrat->date_fin);
                            
                            if ($contrat->statut === 'suspendu' && $contrat->date_debut_suspension) {
                                // Pendant la suspension, on calcule les jours restants au moment de la suspension
                                $debutSuspension = \Carbon\Carbon::parse($contrat->date_debut_suspension);
                                $joursRestants = (int) $debutSuspension->diffInDays($dateFin, false);
                            } else {
                                // Calcul normal pour les contrats actifs
                                $joursRestants = (int) $aujourdhui->diffInDays($dateFin, false);
                            }
                        @endphp
                        @if($contrat->statut === 'suspendu' && $contrat->date_debut_suspension)
                            @if($joursRestants > 0)
                                <span style="color: #856404;">{{ $joursRestants }} jours (gelé pendant suspension)</span>
                            @else
                                <span style="color: #856404;">Expiré (gelé pendant suspension)</span>
                            @endif
                        @elseif($joursRestants > 0)
                            {{ $joursRestants }} jours
                        @elseif($joursRestants == 0)
                            Expire aujourd'hui
                        @else
                            Expiré depuis {{ abs($joursRestants) }} jours
                        @endif
                    </span>
                </div>
            </div>
        </div>

        <!-- Description -->
        <div class="info-card" style="grid-column: 1 / -1;">
            <h3><i class="fas fa-align-left mr-2"></i>Description</h3>
            <p style="color: #666; line-height: 1.6;" data-field="description">
                {{ $contrat->description ?: 'Aucune description' }}
            </p>
        </div>

        <!-- Historique des modifications -->
        <div class="history-section">
            <div class="history-title"><i class="fas fa-history mr-2"></i>Historique des modifications</div>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-date">{{ $contrat->created_at->format('d/m/Y - H:i') }}</div>
                    <div class="timeline-content">
                        <div class="timeline-title">Création du contrat</div>
                        <div class="timeline-desc">
                            Contrat créé avec {{ $contrat->fournisseur->nom ?? 'N/A' }} pour un montant de {{ number_format($contrat->montant, 0, ',', ' ') }} F CFA
                            @if($contrat->type)
                                <br>Type : {{ ucfirst($contrat->type) }}
                            @endif
                        </div>
                    </div>
                </div>
                
                @if($contrat->statut === 'suspendu' && $contrat->date_debut_suspension)
                <div class="timeline-item">
                    <div class="timeline-date">{{ \Carbon\Carbon::parse($contrat->date_debut_suspension)->format('d/m/Y - H:i') }}</div>
                    <div class="timeline-content">
                        <div class="timeline-title">Suspension du contrat</div>
                        <div class="timeline-desc">
                            Contrat suspendu (en cours)
                            @if($contrat->raison_suspension)
                                <br>Raison : {{ $contrat->raison_suspension }}
                            @endif
                        </div>
                    </div>
                </div>
                @elseif($contrat->jours_suspension && $contrat->jours_suspension > 0)
                <div class="timeline-item">
                    <div class="timeline-date">{{ $contrat->updated_at->format('d/m/Y - H:i') }}</div>
                    <div class="timeline-content">
                        <div class="timeline-title">Suspension terminée</div>
                        <div class="timeline-desc">
                            Contrat suspendu pendant {{ $contrat->jours_suspension }} jours au total
                            @if($contrat->raison_suspension)
                                <br>Raison : {{ $contrat->raison_suspension }}
                            @endif
                        </div>
                    </div>
                </div>
                @endif
                
                @if($contrat->nombre_renouvellements && $contrat->nombre_renouvellements > 0)
                <div class="timeline-item">
                    <div class="timeline-date">{{ $contrat->updated_at->format('d/m/Y - H:i') }}</div>
                    <div class="timeline-content">
                        <div class="timeline-title">Renouvellement du contrat</div>
                        <div class="timeline-desc">
                            Contrat renouvelé {{ $contrat->nombre_renouvellements }} fois
                            @if($contrat->raison_renouvellement)
                                <br>Raison : {{ $contrat->raison_renouvellement }}
                            @endif
                        </div>
                    </div>
                </div>
                @endif
                
                @if($contrat->statut === 'resilie' && $contrat->date_resiliation)
                <div class="timeline-item">
                    <div class="timeline-date">{{ \Carbon\Carbon::parse($contrat->date_resiliation)->format('d/m/Y - H:i') }}</div>
                    <div class="timeline-content">
                        <div class="timeline-title">Résiliation du contrat</div>
                        <div class="timeline-desc">
                            Contrat résilié
                            @if($contrat->raison_resiliation)
                                <br>Raison : {{ $contrat->raison_resiliation }}
                            @endif
                        </div>
                    </div>
                </div>
                @endif
                
                @if($contrat->updated_at != $contrat->created_at)
                <div class="timeline-item">
                    <div class="timeline-date">{{ $contrat->updated_at->format('d/m/Y - H:i') }}</div>
                    <div class="timeline-content">
                        <div class="timeline-title">Dernière modification</div>
                        <div class="timeline-desc">Informations du contrat mises à jour</div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Section Paiements -->
        <div class="payment-section">
            <div class="payment-title"><i class="fas fa-credit-card mr-2"></i>Gestion des Paiements</div>
            
            <div class="payment-grid">
                <div class="payment-card">
                    <h4><i class="fas fa-money-bill-wave mr-2"></i>Informations de Paiement</h4>
                    <div class="payment-item">
                        <span class="payment-label">
                            @if($contrat->aPeriodicitePaiement())
                                Montant par période :
                            @else
                                Montant total :
                            @endif
                        </span>
                        <span class="payment-value">{{ number_format($contrat->montant, 0, ',', ' ') }} F CFA</span>
                    </div>
                    <div class="payment-item">
                        <span class="payment-label">Avance :</span>
                        <span class="payment-value">{{ number_format($contrat->avance ?? 0, 0, ',', ' ') }} F CFA</span>
                    </div>
                    <div class="payment-item">
                        <span class="payment-label">Reste à payer :</span>
                        <span class="payment-value">{{ number_format($contrat->reste_a_payer ?? $contrat->montant, 0, ',', ' ') }} F CFA</span>
                    </div>
                    <div class="payment-item">
                        <span class="payment-label">Statut :</span>
                        <span class="payment-value">
                            @if(($contrat->statut_paiement ?? 'en_attente') === 'paye')
                                <span style="color: #28a745;">✅ Payé</span>
                            @elseif(($contrat->statut_paiement ?? 'en_attente') === 'partiel')
                                <span style="color: #ffc107;">⚠️ Partiel</span>
                            @elseif(($contrat->statut_paiement ?? 'en_attente') === 'en_retard')
                                <span style="color: #dc3545;">⚠️ En retard</span>
                            @elseif(($contrat->statut_paiement ?? 'en_attente') === 'a_jour')
                                <span style="color: #28a745;">✅ À jour</span>
                            @else
                                <span style="color: #6c757d;">⏳ En attente</span>
                            @endif
                        </span>
                    </div>
                </div>
                
                @if($contrat->aPeriodicitePaiement())
                <div class="payment-card">
                    <h4><i class="fas fa-calendar-alt mr-2"></i>Informations Périodiques</h4>
                    <div class="payment-item">
                        <span class="payment-label">Périodicité :</span>
                        <span class="payment-value">{{ $contrat->periodicite_label }}</span>
                    </div>
                    <div class="payment-item">
                        <span class="payment-label">Échéances en retard :</span>
                        <span class="payment-value">
                            @if($contrat->getEcheancesEnRetard() > 0)
                                <span style="color: #dc3545;">{{ $contrat->getEcheancesEnRetard() }} échéance(s)</span>
                            @else
                                <span style="color: #28a745;">Aucune</span>
                            @endif
                        </span>
                    </div>
                    <div class="payment-item">
                        <span class="payment-label">Redevances :</span>
                        <span class="payment-value">
                            @if($contrat->getMontantRedevances() > 0)
                                <span style="color: #dc3545;">{{ number_format($contrat->getMontantRedevances(), 0, ',', ' ') }} F CFA</span>
                            @else
                                <span style="color: #28a745;">Aucune</span>
                            @endif
                        </span>
                    </div>
                    <div class="payment-item">
                        <span class="payment-label">Prochaine échéance :</span>
                        <span class="payment-value">
                            @if($contrat->getProchaineEcheance())
                                <span style="color: #17423b;">{{ $contrat->getProchaineEcheance()->format('d/m/Y') }}</span>
                            @else
                                <span style="color: #6c757d;">Non définie</span>
                            @endif
                        </span>
                    </div>
                </div>
                @endif
                
                <div class="payment-card">
                    <h4><i class="fas fa-cogs mr-2"></i>Actions</h4>
                    <div class="payment-buttons">
                        <button onclick="ouvrirModalPaiement({{ $contrat->id }})" class="btn-payment">
                            <i class="fas fa-plus"></i>Payer
                        </button>
                        <button onclick="voirHistorique({{ $contrat->id }})" class="btn-history">
                            <i class="fas fa-history"></i>Historique
                        </button>
                        @if($contrat->aPeriodicitePaiement())
                        <button onclick="voirEcheances({{ $contrat->id }})" class="btn-history">
                            <i class="fas fa-calendar-check"></i>Échéances
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="actions-section">
            <h3 style="color: #17423b; margin-bottom: 1rem;"><i class="fas fa-cogs mr-2"></i>Actions disponibles</h3>
            <div class="action-buttons">
                @if($contrat->statut !== 'resilie')
                    @if($contrat->statut === 'actif')
                        <button onclick="openModal('modal-suspension')" class="action-btn suspend-btn">
                            <i class="fas fa-pause"></i> Suspendre
                        </button>
                    @elseif($contrat->statut === 'suspendu')
                        <button onclick="reactiverContrat({{ $contrat->id }})" class="action-btn reactivate-btn">
                            <i class="fas fa-play"></i> Réactiver
                        </button>
                    @endif
                    
                    <button onclick="openModal('modal-renouvellement')" class="action-btn renew-btn">
                        <i class="fas fa-redo"></i> Renouveler
                    </button>
                    
                    <button onclick="openModal('modal-resiliation')" class="action-btn cancel-btn">
                        <i class="fas fa-times"></i> Résilier
                    </button>
                    
                    <button onclick="openModal('modal-edit')" class="action-btn edit-btn">
                        <i class="fas fa-edit"></i> Modifier
                    </button>
                @else
                    <div class="notice-resilie">
                        <i class="fas fa-info-circle"></i>
                        Ce contrat est résilié et ne peut plus être modifié
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Renouvellement -->
    <div id="modal-renouvellement" class="modal-bg" style="display:none;">
        <div class="modal-content modal-jaune">
            <button class="modal-close" onclick="closeModal('modal-renouvellement')">&times;</button>
            <h2>Renouveler le Contrat</h2>
            <form id="form-renouvellement" method="POST" action="#" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                @csrf
                <div>
                    <label>Durée du renouvellement <span style="color:red">*</span></label>
                    <select name="duree" class="modal-input" required onchange="calculerNouvelleDate()">
                        <option value="">-- Sélectionner --</option>
                        <option value="6">6 mois</option>
                        <option value="12">1 an</option>
                        <option value="18">18 mois</option>
                        <option value="24">2 ans</option>
                        <option value="36">3 ans</option>
                    </select>
                </div>
                <div>
                    <label>Nouveau montant (F CFA) <span style="color:red">*</span></label>
                    <input type="number" name="nouveau_montant" class="modal-input" placeholder="Montant..." required />
                </div>
                <div>
                    <label>Date de fin actuelle</label>
                    <input type="text" id="date_fin_actuelle" class="modal-input" value="31/12/2024" readonly style="background: #f5f5f5;" />
                </div>
                <div>
                    <label>Nouvelle date de fin</label>
                    <input type="text" id="nouvelle_date_fin" class="modal-input" readonly style="background: #f5f5f5;" />
                </div>
                <div style="grid-column: 1 / -1;">
                    <label>Raison du renouvellement</label>
                    <textarea name="raison" class="modal-input" placeholder="Précisez la raison du renouvellement..." rows="3" style="resize: vertical;"></textarea>
                </div>
                <div style="grid-column: 1 / -1; text-align: center; margin-top: 1rem;">
                    <button type="submit" class="modal-btn modal-btn-jaune" style="width: auto; padding: 0.8rem 2rem;">Confirmer le renouvellement</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Suspension -->
    <div id="modal-suspension" class="modal-bg" style="display:none;">
        <div class="modal-content" style="max-width: 500px; max-height: 70vh; overflow-y: auto;">
            <button class="modal-close" onclick="closeModal('modal-suspension')">&times;</button>
            <h2 style="color: #ffc107;"><i class="fas fa-pause-circle mr-2"></i>Suspendre le Contrat</h2>
            
            <div style="background: #fff3cd; border: 1px solid #ffeaa7; border-radius: 8px; padding: 1rem; margin-bottom: 1.5rem;">
                <h3 style="color: #856404; margin-bottom: 0.5rem; font-size: 1rem;"><i class="fas fa-info-circle mr-2"></i>Information</h3>
                <p style="color: #856404; line-height: 1.4; margin-bottom: 0.5rem; font-size: 0.9rem;">
                    <strong>Conséquences de la suspension :</strong>
                </p>
                <ul style="color: #856404; line-height: 1.4; margin-left: 1rem; font-size: 0.9rem;">
                    <li>Le contrat sera temporairement suspendu</li>
                    <li>Les services seront interrompus</li>
                    <li>La suspension sera comptabilisée automatiquement par jour</li>
                    <li>Le contrat pourra être réactivé à tout moment</li>
                </ul>
            </div>

            <form id="form-suspension" method="POST" action="{{ route('contrats.suspendre', $contrat->id) }}">
                @csrf
                <div style="margin-bottom: 1.5rem;">
                    <label>Raison de la suspension <span style="color:red">*</span></label>
                    <textarea name="raison_suspension" class="modal-input" placeholder="Précisez la raison de la suspension..." rows="3" required style="resize: vertical;"></textarea>
                </div>
                
                <div style="display: flex; gap: 1rem; justify-content: center;">
                    <button type="button" onclick="closeModal('modal-suspension')" class="modal-btn" style="background: #6c757d; color: #fff; width: auto; padding: 0.8rem 2rem;">
                        Annuler
                    </button>
                    <button type="submit" class="modal-btn" style="background: #ffc107; color: #000; width: auto; padding: 0.8rem 2rem;">
                        <i class="fas fa-pause mr-2"></i>Confirmer la suspension
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Résiliation -->
    <div id="modal-resiliation" class="modal-bg" style="display:none;">
        <div class="modal-content" style="max-width: 600px;">
            <button class="modal-close" onclick="closeModal('modal-resiliation')">&times;</button>
            <h2 style="color: #dc3545;"><i class="fas fa-exclamation-triangle mr-2"></i>Résilier le Contrat</h2>
            
            <div style="background: #f8d7da; border: 1px solid #f5c6cb; border-radius: 8px; padding: 1.5rem; margin-bottom: 2rem;">
                <h3 style="color: #721c24; margin-bottom: 1rem;"><i class="fas fa-warning mr-2"></i>Attention !</h3>
                <p style="color: #721c24; line-height: 1.6; margin-bottom: 1rem;">
                    <strong>Conséquences de la résiliation :</strong>
                </p>
                <ul style="color: #721c24; line-height: 1.6; margin-left: 1.5rem;">
                    <li>Le contrat sera immédiatement interrompu</li>
                    <li>Tous les services associés seront suspendus</li>
                    <li>Cette action est irréversible</li>
                    <li>Le statut passera à "Résilié" définitivement</li>
                    <li>Aucune action ne sera plus possible sur ce contrat</li>
                </ul>
            </div>

            <form id="form-resiliation" method="POST" action="{{ route('contrats.resilier', $contrat->id) }}">
                @csrf
                <div style="margin-bottom: 1.5rem;">
                    <label>Raison de la résiliation <span style="color:red">*</span></label>
                    <textarea name="raison_resiliation" class="modal-input" placeholder="Précisez la raison de la résiliation..." rows="4" required style="resize: vertical;"></textarea>
                </div>
                
                <div style="display: flex; gap: 1rem; justify-content: center;">
                    <button type="button" onclick="closeModal('modal-resiliation')" class="modal-btn" style="background: #6c757d; color: #fff; width: auto; padding: 0.8rem 2rem;">
                        Annuler
                    </button>
                    <button type="submit" class="modal-btn" style="background: #dc3545; color: #fff; width: auto; padding: 0.8rem 2rem;">
                        <i class="fas fa-times mr-2"></i>Confirmer la résiliation
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Modifier -->
    <div id="modal-edit" class="modal-bg" style="display:none;">
        <div class="modal-content modal-edit-content">
            <button class="modal-close" onclick="closeModal('modal-edit')">&times;</button>
            <h2>Modifier le Contrat</h2>
            
            <!-- Navigation des slides -->
            <div class="slide-nav">
                <button class="slide-nav-btn active" onclick="showSlide(1)">Informations</button>
                <button class="slide-nav-btn" onclick="showSlide(2)">Dates & Statut</button>
                <button class="slide-nav-btn" onclick="showSlide(3)">Suspension</button>
                <button class="slide-nav-btn" onclick="showSlide(4)">Autres</button>
            </div>
            
            <form id="form-edit" method="POST" action="{{ route('contrats.update', $contrat->id) }}">
                @csrf
                @method('PUT')
                
                <!-- Slide 1: Informations de base -->
                <div class="slide active" id="slide-1">
                    <div class="form-group">
                        <label>Intitulé du contrat <span style="color:red">*</span></label>
                        <input type="text" name="intitule" class="modal-input" value="{{ $contrat->intitule }}" required />
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="modal-input" rows="3">{{ $contrat->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Référence</label>
                        <input type="text" name="reference" class="modal-input" value="{{ $contrat->reference }}" />
                    </div>
                    <div class="form-group">
                        <label>Type de contrat</label>
                        <select name="type" class="modal-input">
                            <option value="">-- Sélectionner --</option>
                            <option value="maintenance" {{ $contrat->type === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                            <option value="logistique" {{ $contrat->type === 'logistique' ? 'selected' : '' }}>Logistique</option>
                            <option value="autre" {{ $contrat->type === 'autre' ? 'selected' : '' }}>Autre</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Montant (F CFA) <span style="color:red">*</span></label>
                        <input type="number" name="montant" class="modal-input" value="{{ $contrat->montant }}" required />
                    </div>
                    <div class="form-group">
                        <label>Fournisseur <span style="color:red">*</span></label>
                        <select name="fournisseur_id" class="modal-input" required>
                            <option value="">-- Sélectionner --</option>
                            @foreach($fournisseurs as $fournisseur)
                                <option value="{{ $fournisseur->id }}" {{ $contrat->fournisseur_id == $fournisseur->id ? 'selected' : '' }}>
                                    {{ $fournisseur->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <!-- Slide 2: Dates et Statut -->
                <div class="slide" id="slide-2">
                    <div class="form-group">
                        <label>Date de début <span style="color:red">*</span></label>
                        <input type="date" name="date_debut" class="modal-input" value="{{ $contrat->date_debut->format('Y-m-d') }}" required />
                    </div>
                    <div class="form-group">
                        <label>Date de fin <span style="color:red">*</span></label>
                        <input type="date" name="date_fin" class="modal-input" value="{{ $contrat->date_fin->format('Y-m-d') }}" required />
                    </div>
                    <div class="form-group">
                        <label>Statut actuel <span style="color:red">*</span></label>
                        <select name="statut" class="modal-input" required>
                            <option value="actif" {{ $contrat->statut === 'actif' ? 'selected' : '' }}>Actif</option>
                            <option value="suspendu" {{ $contrat->statut === 'suspendu' ? 'selected' : '' }}>Suspendu</option>
                            <option value="renouvele" {{ $contrat->statut === 'renouvele' ? 'selected' : '' }}>Renouvelé</option>
                            <option value="resilie" {{ $contrat->statut === 'resilie' ? 'selected' : '' }}>Résilié</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nombre de renouvellements</label>
                        <input type="number" name="nombre_renouvellements" class="modal-input" value="{{ $contrat->nombre_renouvellements }}" />
                    </div>
                    <div class="form-group">
                        <label>Raison du renouvellement</label>
                        <textarea name="raison_renouvellement" class="modal-input" rows="3">{{ $contrat->raison_renouvellement }}</textarea>
                    </div>
                </div>
                
                <!-- Slide 3: Suspension -->
                <div class="slide" id="slide-3">
                    <div class="form-group">
                        <label>Jours de suspension</label>
                        <input type="number" name="jours_suspension" class="modal-input" value="{{ $contrat->jours_suspension }}" />
                    </div>
                    <div class="form-group">
                        <label>Date de début de suspension</label>
                        <input type="date" name="date_debut_suspension" class="modal-input" value="{{ $contrat->date_debut_suspension ? $contrat->date_debut_suspension->format('Y-m-d') : '' }}" />
                    </div>
                    <div class="form-group">
                        <label>Date de fin de suspension</label>
                        <input type="date" name="date_fin_suspension" class="modal-input" value="{{ $contrat->date_fin_suspension ? $contrat->date_fin_suspension->format('Y-m-d') : '' }}" />
                    </div>
                    <div class="form-group">
                        <label>Raison de la suspension</label>
                        <textarea name="raison_suspension" class="modal-input" rows="4">{{ $contrat->raison_suspension }}</textarea>
                    </div>
                </div>
                
                <!-- Slide 4: Autres informations -->
                <div class="slide" id="slide-4">
                    <div class="form-group">
                        <label>Date de résiliation</label>
                        <input type="date" name="date_resiliation" class="modal-input" value="{{ $contrat->date_resiliation ? $contrat->date_resiliation->format('Y-m-d') : '' }}" />
                    </div>
                    <div class="form-group">
                        <label>Raison de la résiliation</label>
                        <textarea name="raison_resiliation" class="modal-input" rows="4">{{ $contrat->raison_resiliation }}</textarea>
                    </div>
                </div>
                
                <!-- Navigation des slides -->
                <div class="slide-controls">
                    <button type="button" class="slide-btn prev-btn" onclick="prevSlide()" style="display:none;">
                        <i class="fas fa-chevron-left"></i> Précédent
                    </button>
                    <button type="button" class="slide-btn next-btn" onclick="nextSlide()">
                        Suivant <i class="fas fa-chevron-right"></i>
                    </button>
                    <button type="submit" class="slide-btn submit-btn" style="display:none;">
                        <i class="fas fa-check"></i> Confirmer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal de confirmation -->
    <div id="confirm-modal" class="modal-bg" style="display:none;">
        <div class="modal-content" style="max-width: 400px; text-align: center;">
            <div style="font-size: 3rem; margin-bottom: 1rem; color: #e6b800;">
                <i class="fas fa-question-circle"></i>
            </div>
            <h3 id="confirm-title" style="margin-bottom: 1rem; color: #17423b;"></h3>
            <p id="confirm-message" style="color: #666; margin-bottom: 2rem;"></p>
            <div style="display: flex; gap: 1rem; justify-content: center;">
                <button onclick="closeConfirmModal()" class="modal-btn" style="background: #6c757d; color: #fff; width: auto; padding: 0.8rem 1.5rem;">
                    Annuler
                </button>
                <button id="confirm-ok-btn" class="modal-btn" style="background: #e6b800; color: #fff; width: auto; padding: 0.8rem 1.5rem;">
                    Confirmer
                </button>
            </div>
        </div>
    </div>

    <!-- Modal de chargement -->
    <div id="loading-modal" class="modal-bg" style="display:none;">
        <div class="modal-content" style="max-width: 300px; text-align: center;">
            <div style="font-size: 3rem; margin-bottom: 1rem; color: #e6b800;">
                <i class="fas fa-spinner fa-spin"></i>
            </div>
            <h3 id="loading-message" style="margin-bottom: 1rem; color: #17423b;"></h3>
        </div>
    </div>

    <!-- Modal de succès -->
    <div id="success-modal" class="modal-bg" style="display:none;">
        <div class="modal-content" style="max-width: 400px; text-align: center;">
            <div style="font-size: 3rem; margin-bottom: 1rem; color: #219150;">
                <i class="fas fa-check-circle"></i>
            </div>
            <h3 style="margin-bottom: 1rem; color: #17423b;">Succès !</h3>
            <p id="success-message" style="color: #666; margin-bottom: 2rem;"></p>
            <button onclick="closeSuccessModal()" class="modal-btn" style="background: #219150; color: #fff; width: auto; padding: 0.8rem 2rem;">
                OK
            </button>
        </div>
    </div>

    <!-- Modal d'erreur -->
    <div id="error-modal" class="modal-bg" style="display:none;">
        <div class="modal-content" style="max-width: 400px; text-align: center;">
            <div style="font-size: 3rem; margin-bottom: 1rem; color: #dc3545;">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h3 id="error-title" style="margin-bottom: 1rem; color: #17423b;"></h3>
            <p id="error-message" style="color: #666; margin-bottom: 2rem;"></p>
            <button onclick="closeErrorModal()" class="modal-btn" style="background: #dc3545; color: #fff; width: auto; padding: 0.8rem 2rem;">
                OK
            </button>
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
        padding: 2.5rem 2.5rem 2rem 2.5rem; min-width: 340px; max-width: 95vw;
        position: relative;
        width: 100%; max-width: 1000px;
        margin: 20px;
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
    .action-btn {
        padding: 0.8rem 1.5rem; border-radius: 8px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.2s;
        border: none; cursor: pointer;
    }
    .suspend-btn { background: #ffc107; color: #000; }
    .suspend-btn:hover { background: #e6a700; }
    .reactivate-btn { background: #1e5c4a; color: #fff; }
    .reactivate-btn:hover { background: #17423b; }
    .renew-btn { background: #e6b800; color: #fff; }
    .renew-btn:hover { background: #d4a800; }
    .cancel-btn { background: #dc3545; color: #fff; }
    .cancel-btn:hover { background: #c82333; }
    .edit-btn { background: #219150; color: #fff; }
    .edit-btn:hover { background: #1e5c4a; }
    .notice-resilie {
        background: #f8d7da; border: 1px solid #f5c6cb; border-radius: 8px; padding: 1.5rem; text-align: center;
        color: #721c24; font-weight: 600;
    }
    .notice-resilie i { margin-right: 0.5rem; }
    
    /* Styles pour le modal d'édition avec slides */
    .modal-edit-content {
        max-height: 80vh;
        overflow-y: auto;
        width: 90%;
        max-width: 600px;
    }
    
    .slide-nav {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin-bottom: 2rem;
        border-bottom: 2px solid #e9ecef;
        padding-bottom: 1rem;
    }
    
    .slide-nav-btn {
        background: none;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        cursor: pointer;
        font-weight: 600;
        color: #6c757d;
        transition: all 0.3s;
    }
    
    .slide-nav-btn.active {
        background: #e6b800;
        color: #fff;
    }
    
    .slide-nav-btn:hover:not(.active) {
        background: #f8f9fa;
        color: #17423b;
    }
    
    .slide {
        display: none;
        animation: slideIn 0.3s ease-in-out;
    }
    
    .slide.active {
        display: block;
    }
    
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .slide-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 2rem;
        padding-top: 1rem;
        border-top: 1px solid #e9ecef;
    }
    
    .slide-btn {
        padding: 0.8rem 1.5rem;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s;
    }
    
    .prev-btn {
        background: #6c757d;
        color: #fff;
    }
    
    .prev-btn:hover {
        background: #5a6268;
    }
    
    .next-btn {
        background: #e6b800;
        color: #fff;
    }
    
    .next-btn:hover {
        background: #d4a800;
    }
    
    .submit-btn {
        background: #219150;
        color: #fff;
    }
    
    .submit-btn:hover {
        background: #1e5c4a;
    }
    </style>

    <script>
    function openModal(id) {
        document.getElementById(id).style.display = 'flex';
    }
    
    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
    }
    
    function reactiverContrat(contratId) {
        showConfirmModal('notificationModal', 'Confirmation', 'Êtes-vous sûr de vouloir réactiver ce contrat ?', function() {
            fetch(`/contrats/${contratId}/reactiver`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showSuccessModal('notificationModal', 'Succès', 'Contrat réactivé avec succès !', function() {
                        window.location.reload();
                    });
                } else {
                    showErrorModal('notificationModal', 'Erreur', 'Erreur lors de la réactivation : ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showErrorModal('notificationModal', 'Erreur', 'Erreur lors de la réactivation du contrat');
            });
        });
    }
    
    function calculerNouvelleDate() {
        const duree = document.querySelector('select[name="duree"]').value;
        const dateFinActuelle = new Date('2024-12-31'); // Date de fin actuelle
        
        if (duree) {
            const nouvelleDate = new Date(dateFinActuelle);
            nouvelleDate.setMonth(nouvelleDate.getMonth() + parseInt(duree));
            
            const jour = nouvelleDate.getDate().toString().padStart(2, '0');
            const mois = (nouvelleDate.getMonth() + 1).toString().padStart(2, '0');
            const annee = nouvelleDate.getFullYear();
            
            document.getElementById('nouvelle_date_fin').value = `${jour}/${mois}/${annee}`;
        } else {
            document.getElementById('nouvelle_date_fin').value = '';
        }
    }
    
    // Fermer les modals en cliquant à l'extérieur
    document.querySelectorAll('.modal-bg').forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.style.display = 'none';
            }
        });
    });
    
    // Gestion des formulaires
    document.getElementById('form-renouvellement').addEventListener('submit', function(e) {
        e.preventDefault();
        showSuccessModal('notificationModal', 'Succès', 'Renouvellement confirmé ! Le contrat sera mis à jour.', function() {
            closeModal('modal-renouvellement');
        });
    });
    
    document.getElementById('form-resiliation').addEventListener('submit', function(e) {
        e.preventDefault();
        showConfirmModal('notificationModal', 'Confirmation', 'Êtes-vous absolument sûr de vouloir résilier ce contrat ? Cette action est irréversible.', function() {
            showSuccessModal('notificationModal', 'Succès', 'Contrat résilié avec succès.', function() {
                closeModal('modal-resiliation');
            });
        });
    });

    // Variables pour la navigation des slides
    let currentSlide = 1;
    const totalSlides = 4;
    
    function showSlide(slideNumber) {
        // Masquer tous les slides
        document.querySelectorAll('.slide').forEach(slide => {
            slide.classList.remove('active');
        });
        
        // Masquer tous les boutons de navigation
        document.querySelectorAll('.slide-nav-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        
        // Afficher le slide demandé
        document.getElementById('slide-' + slideNumber).classList.add('active');
        document.querySelectorAll('.slide-nav-btn')[slideNumber - 1].classList.add('active');
        
        // Mettre à jour les boutons de navigation
        updateSlideControls(slideNumber);
        
        currentSlide = slideNumber;
    }
    
    function nextSlide() {
        if (currentSlide < totalSlides) {
            showSlide(currentSlide + 1);
        }
    }
    
    function prevSlide() {
        if (currentSlide > 1) {
            showSlide(currentSlide - 1);
        }
    }
    
    function updateSlideControls(slideNumber) {
        const prevBtn = document.querySelector('.prev-btn');
        const nextBtn = document.querySelector('.next-btn');
        const submitBtn = document.querySelector('.submit-btn');
        
        // Afficher/masquer le bouton précédent
        if (slideNumber === 1) {
            prevBtn.style.display = 'none';
        } else {
            prevBtn.style.display = 'flex';
        }
        
        // Afficher/masquer le bouton suivant et soumettre
        if (slideNumber === totalSlides) {
            nextBtn.style.display = 'none';
            submitBtn.style.display = 'flex';
        } else {
            nextBtn.style.display = 'flex';
            submitBtn.style.display = 'none';
        }
    }
    
    // Fonctions pour les modals de confirmation, chargement, succès et erreur
    function showConfirmModal(title, message, onConfirm) {
        document.getElementById('confirm-title').textContent = title;
        document.getElementById('confirm-message').textContent = message;
        document.getElementById('confirm-modal').style.display = 'flex';
        
        // Supprimer les anciens event listeners
        const confirmBtn = document.getElementById('confirm-ok-btn');
        const newConfirmBtn = confirmBtn.cloneNode(true);
        confirmBtn.parentNode.replaceChild(newConfirmBtn, confirmBtn);
        
        // Ajouter le nouveau event listener
        newConfirmBtn.addEventListener('click', function() {
            closeConfirmModal();
            onConfirm();
        });
    }
    
    function closeConfirmModal() {
        document.getElementById('confirm-modal').style.display = 'none';
    }
    
    function showLoadingModal(message) {
        document.getElementById('loading-message').textContent = message;
        document.getElementById('loading-modal').style.display = 'flex';
    }
    
    function closeLoadingModal() {
        document.getElementById('loading-modal').style.display = 'none';
    }
    
    function showSuccessModal(message, onClose) {
        document.getElementById('success-message').textContent = message;
        document.getElementById('success-modal').style.display = 'flex';
        
        if (onClose) {
            // Supprimer les anciens event listeners
            const closeBtn = document.querySelector('#success-modal .modal-btn');
            const newCloseBtn = closeBtn.cloneNode(true);
            closeBtn.parentNode.replaceChild(newCloseBtn, closeBtn);
            
            // Ajouter le nouveau event listener
            newCloseBtn.addEventListener('click', function() {
                closeSuccessModal();
                onClose();
            });
        }
    }
    
    function closeSuccessModal() {
        document.getElementById('success-modal').style.display = 'none';
    }
    
    function showErrorModal(title, message) {
        document.getElementById('error-title').textContent = title;
        document.getElementById('error-message').textContent = message;
        document.getElementById('error-modal').style.display = 'flex';
    }
    
    function closeErrorModal() {
        document.getElementById('error-modal').style.display = 'none';
    }
    
    // Fonction pour mettre à jour l'affichage du contrat sans recharger la page
    function updateContractDisplay(contrat) {
        // Mettre à jour les informations principales
        document.querySelector('.contract-title').textContent = contrat.intitule;
        document.querySelector('.contract-reference').textContent = contrat.reference || 'N/A';
        
        // Mettre à jour les informations du contrat
        document.querySelector('.info-value[data-field="fournisseur"]').textContent = contrat.fournisseur ? contrat.fournisseur.nom : 'N/A';
        document.querySelector('.info-value[data-field="date_debut"]').textContent = new Date(contrat.date_debut).toLocaleDateString('fr-FR');
        document.querySelector('.info-value[data-field="date_fin"]').textContent = new Date(contrat.date_fin).toLocaleDateString('fr-FR');
        document.querySelector('.info-value[data-field="montant"]').textContent = new Intl.NumberFormat('fr-FR').format(contrat.montant) + ' F CFA';
        document.querySelector('.info-value[data-field="type"]').textContent = contrat.type ? contrat.type.charAt(0).toUpperCase() + contrat.type.slice(1) : 'N/A';
        document.querySelector('.info-value[data-field="statut"]').innerHTML = getStatusBadge(contrat.statut);
        
        // Mettre à jour la description
        const descriptionElement = document.querySelector('.info-value[data-field="description"]');
        if (descriptionElement) {
            descriptionElement.textContent = contrat.description || 'Aucune description';
        }
        
        // Mettre à jour les jours de suspension
        updateSuspensionDisplay(contrat);
        
        // Mettre à jour la durée restante
        updateRemainingDays(contrat);
        
        // Mettre à jour les boutons d'action selon le statut
        updateActionButtons(contrat.statut);
        
        // Mettre à jour l'historique si nécessaire
        updateHistory(contrat);
    }
    
    function getStatusBadge(statut) {
        const badges = {
            'actif': '<span style="background:#e3f2fd;color:#1976d2;padding:4px 8px;border-radius:4px;font-size:0.9rem;">Actif</span>',
            'suspendu': '<span style="background:#fff3cd;color:#856404;padding:4px 8px;border-radius:4px;font-size:0.9rem;">Suspendu</span>',
            'renouvele': '<span style="background:#d1ecf1;color:#0c5460;padding:4px 8px;border-radius:4px;font-size:0.9rem;">Renouvelé</span>',
            'resilie': '<span style="background:#f8d7da;color:#721c24;padding:4px 8px;border-radius:4px;font-size:0.9rem;">Résilié</span>',
            'expire': '<span style="background:#f8d7da;color:#721c24;padding:4px 8px;border-radius:4px;font-size:0.9rem;">Expiré</span>'
        };
        return badges[statut] || badges['actif'];
    }
    
    function updateSuspensionDisplay(contrat) {
        const suspensionElement = document.querySelector('.info-value[data-field="suspension"]');
        if (suspensionElement) {
            if (contrat.statut === 'suspendu' && contrat.date_debut_suspension) {
                const debutSuspension = new Date(contrat.date_debut_suspension);
                const aujourdhui = new Date();
                const joursSuspension = Math.floor((aujourdhui - debutSuspension) / (1000 * 60 * 60 * 24));
                suspensionElement.innerHTML = `${joursSuspension} jours (depuis le ${debutSuspension.toLocaleDateString('fr-FR')})`;
            } else if (contrat.jours_suspension && contrat.jours_suspension > 0) {
                suspensionElement.innerHTML = `${contrat.jours_suspension} jours (total cumulé)`;
            } else {
                suspensionElement.innerHTML = 'Aucune suspension';
            }
        }
    }
    
    function updateRemainingDays(contrat) {
        const remainingElement = document.querySelector('.info-value[data-field="duree_restante"]');
        if (remainingElement) {
            const aujourdhui = new Date();
            const dateFin = new Date(contrat.date_fin);
            
            if (contrat.statut === 'suspendu' && contrat.date_debut_suspension) {
                const debutSuspension = new Date(contrat.date_debut_suspension);
                const joursRestants = Math.floor((debutSuspension - dateFin) / (1000 * 60 * 60 * 24));
                if (joursRestants > 0) {
                    remainingElement.innerHTML = `<span style="color: #856404;">${joursRestants} jours (gelé pendant suspension)</span>`;
                } else {
                    remainingElement.innerHTML = `<span style="color: #856404;">Expiré (gelé pendant suspension)</span>`;
                }
            } else {
                const joursRestants = Math.floor((dateFin - aujourdhui) / (1000 * 60 * 60 * 24));
                if (joursRestants > 0) {
                    remainingElement.innerHTML = `${joursRestants} jours`;
                } else if (joursRestants === 0) {
                    remainingElement.innerHTML = 'Expire aujourd\'hui';
                } else {
                    remainingElement.innerHTML = `Expiré depuis ${Math.abs(joursRestants)} jours`;
                }
            }
        }
    }
    
    function updateActionButtons(statut) {
        const actionButtons = document.querySelector('.action-buttons');
        if (actionButtons) {
            // Masquer tous les boutons
            actionButtons.innerHTML = '';
            
            if (statut !== 'resilie') {
                if (statut === 'actif') {
                    actionButtons.innerHTML += `
                        <button onclick="openModal('modal-suspension')" class="action-btn suspend-btn">
                            <i class="fas fa-pause"></i> Suspendre
                        </button>
                    `;
                } else if (statut === 'suspendu') {
                    actionButtons.innerHTML += `
                        <button onclick="reactiverContrat({{ $contrat->id }})" class="action-btn reactivate-btn">
                            <i class="fas fa-play"></i> Réactiver
                        </button>
                    `;
                }
                
                actionButtons.innerHTML += `
                    <button onclick="openModal('modal-renouvellement')" class="action-btn renew-btn">
                        <i class="fas fa-redo"></i> Renouveler
                    </button>
                    <button onclick="openModal('modal-resiliation')" class="action-btn cancel-btn">
                        <i class="fas fa-times"></i> Résilier
                    </button>
                    <button onclick="openModal('modal-edit')" class="action-btn edit-btn">
                        <i class="fas fa-edit"></i> Modifier
                    </button>
                `;
            } else {
                actionButtons.innerHTML = `
                    <div class="notice-resilie">
                        <i class="fas fa-info-circle"></i>
                        Ce contrat est résilié et ne peut plus être modifié
                    </div>
                `;
            }
        }
    }
    
    function updateHistory(contrat) {
        // Mettre à jour l'historique si nécessaire
        const historyElement = document.querySelector('.contract-history');
        if (historyElement) {
            let historyHTML = '<h3>Historique du Contrat</h3>';
            
            if (contrat.nombre_renouvellements > 0) {
                historyHTML += `<p><strong>Renouvellements :</strong> ${contrat.nombre_renouvellements} fois</p>`;
            }
            
            if (contrat.jours_suspension > 0) {
                historyHTML += `<p><strong>Suspensions :</strong> ${contrat.jours_suspension} jours au total</p>`;
            }
            
            if (contrat.date_resiliation) {
                historyHTML += `<p><strong>Résilié le :</strong> ${new Date(contrat.date_resiliation).toLocaleDateString('fr-FR')}</p>`;
            }
            
            historyElement.innerHTML = historyHTML;
        }
    }
    
    document.getElementById('form-edit').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Afficher le modal de chargement
        showLoadingModal('Modification en cours...');
        
        // Soumettre le formulaire normalement
        this.submit();
    });
    </script>

    <!-- Modal de Notification -->
    <div id="notificationModal" class="notification-modal">
        <div class="notification-content">
            <div class="notification-header">
                <h3><i class="fas fa-check-circle mr-2"></i>Succès</h3>
                <button class="modal-close" onclick="fermerNotification()">&times;</button>
            </div>
            <div class="notification-body">
                <div class="notification-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="notification-message" id="notificationMessage">
                    Paiement enregistré avec succès !
                </div>
                <button class="notification-btn" onclick="fermerNotification()">
                    <i class="fas fa-check mr-2"></i>OK
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Paiement -->
    <div id="modalPaiement" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-credit-card mr-2"></i>Nouveau Paiement</h3>
                <button class="modal-close" onclick="fermerModalPaiement()">&times;</button>
            </div>
            <div class="modal-body">
                <form id="formPaiement">
                    <div class="form-group">
                        <label for="montant" class="form-label">Montant à payer *</label>
                        <input type="number" id="montant" name="montant" class="form-input" step="0.01" min="0.01" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="mode_paiement" class="form-label">Mode de paiement *</label>
                        <select id="mode_paiement" name="mode_paiement" class="form-select" required onchange="gererChampReference()">
                            <option value="">Sélectionner un mode</option>
                            <option value="especes">💵 Espèces</option>
                            <option value="cheque">🏦 Chèque</option>
                            <option value="virement">💳 Virement</option>
                            <option value="carte">💳 Carte bancaire</option>
                        </select>
                    </div>
                    
                    <div class="form-group" id="reference-group" style="display: none;">
                        <label for="reference_paiement" class="form-label">Référence du paiement</label>
                        <input type="text" id="reference_paiement" name="reference_paiement" class="form-input" placeholder="Numéro de chèque, référence virement...">
                    </div>
                    
                    <div class="form-group">
                        <label for="commentaire" class="form-label">Commentaire (optionnel)</label>
                        <textarea id="commentaire" name="commentaire" class="form-input" rows="3" placeholder="Commentaire sur ce paiement..."></textarea>
                    </div>
                    
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-save mr-2"></i>Enregistrer le paiement
                    </button>
                    <button type="button" class="btn-cancel" onclick="fermerModalPaiement()">
                        <i class="fas fa-times mr-2"></i>Annuler
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Historique -->
    <div id="modalHistorique" class="modal history-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-history mr-2"></i>Historique des Paiements</h3>
                <button class="modal-close" onclick="fermerModalHistorique()">&times;</button>
            </div>
            <div class="modal-body">
                <div id="historique-content">
                    <p style="text-align: center; color: #666;">Chargement de l'historique...</p>
                </div>
                <button type="button" class="btn-cancel" onclick="fermerModalHistorique()">
                    <i class="fas fa-times mr-2"></i>Fermer
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Échéances -->
    <div id="modalEcheances" class="modal history-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-calendar-check mr-2"></i>Détail des Échéances</h3>
                <button class="modal-close" onclick="fermerModalEcheances()">&times;</button>
            </div>
            <div class="modal-body">
                <div id="echeances-content">
                    <p style="text-align: center; color: #666;">Chargement des échéances...</p>
                </div>
                <button type="button" class="btn-cancel" onclick="fermerModalEcheances()">
                    <i class="fas fa-times mr-2"></i>Fermer
                </button>
            </div>
        </div>
    </div>

    <script>
        // Variables globales
        let contratActuel = null;
        
        // Fonctions pour les modals de paiement
        function ouvrirModalPaiement(contratId) {
            console.log('Ouverture du modal de paiement pour le contrat:', contratId);
            
            fetch(`/contrats/${contratId}/paiement/modal`)
                .then(response => {
                    console.log('Réponse reçue:', response);
                    return response.json();
                })
                .then(data => {
                    console.log('Données reçues:', data);
                    contratActuel = data.contrat;
                    
                    // Mettre à jour les champs du formulaire
                    document.getElementById('montant').max = contratActuel.montant_a_payer;
                    document.getElementById('montant').placeholder = `Montant maximum: ${contratActuel.montant_a_payer.toLocaleString()} F CFA`;
                    
                    // Afficher le modal
                    const modal = document.getElementById('modalPaiement');
                    modal.style.display = 'block';
                    setTimeout(() => modal.classList.add('show'), 10);
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    showErrorModal('notificationModal', 'Erreur', 'Erreur lors du chargement des données du contrat');
                });
        }
        
        function fermerModalPaiement() {
            const modal = document.getElementById('modalPaiement');
            modal.classList.remove('show');
            setTimeout(() => modal.style.display = 'none', 300);
            
            // Réinitialiser le formulaire
            document.getElementById('formPaiement').reset();
            document.getElementById('reference-group').style.display = 'none';
        }
        
        function voirHistorique(contratId) {
            console.log('Ouverture de l\'historique pour le contrat:', contratId);
            
            fetch(`/contrats/${contratId}/paiement/historique`)
                .then(response => {
                    console.log('Réponse historique reçue:', response);
                    return response.json();
                })
                .then(data => {
                    console.log('Données historique reçues:', data);
                    const content = document.getElementById('historique-content');
                    
                    if (data.paiements.length === 0) {
                        content.innerHTML = '<p style="text-align: center; color: #666;">Aucun paiement enregistré pour ce contrat.</p>';
                    } else {
                        let html = '';
                        data.paiements.forEach(paiement => {
                            html += `
                                <div class="history-item">
                                    <div class="history-item-header">
                                        <span class="history-amount">${paiement.montant.toLocaleString()} F CFA</span>
                                        <span class="history-date">${paiement.date_paiement}</span>
                                    </div>
                                    <div class="history-details">
                                        <span class="history-mode mode-${paiement.mode_paiement.split(' ')[1].toLowerCase()}">${paiement.mode_paiement}</span>
                                        ${paiement.reference_paiement ? `<br><strong>Référence:</strong> ${paiement.reference_paiement}` : ''}
                                        ${paiement.commentaire ? `<br><strong>Commentaire:</strong> ${paiement.commentaire}` : ''}
                                        <br><strong>Par:</strong> ${paiement.user}
                                    </div>
                                </div>
                            `;
                        });
                        content.innerHTML = html;
                    }
                    
                    // Afficher le modal
                    const modal = document.getElementById('modalHistorique');
                    modal.style.display = 'block';
                    setTimeout(() => modal.classList.add('show'), 10);
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    showErrorModal('notificationModal', 'Erreur', 'Erreur lors du chargement de l\'historique');
                });
        }
        
        function fermerModalHistorique() {
            const modal = document.getElementById('modalHistorique');
            modal.classList.remove('show');
            setTimeout(() => modal.style.display = 'none', 300);
        }
        
        function voirEcheances(contratId) {
            console.log('Ouverture des échéances pour le contrat:', contratId);
            
            fetch(`/contrats/${contratId}/echeances`)
                .then(response => response.json())
                .then(data => {
                    console.log('Données échéances reçues:', data);
                    const content = document.getElementById('echeances-content');
                    
                    if (!data.echeances || data.echeances.length === 0) {
                        content.innerHTML = '<p style="text-align: center; color: #666;">Aucune échéance trouvée pour ce contrat.</p>';
                    } else {
                        let html = '';
                        data.echeances.forEach(echeance => {
                            const statutClass = echeance.statut === 'payee' ? 'success' : 
                                               echeance.statut === 'partielle' ? 'warning' : 'danger';
                            const statutIcon = echeance.statut === 'payee' ? '✅' : 
                                              echeance.statut === 'partielle' ? '⚠️' : '❌';
                            const statutText = echeance.statut === 'payee' ? 'Payée' : 
                                              echeance.statut === 'partielle' ? 'Partielle' : 'Impayée';
                            
                            html += `
                                <div class="history-item">
                                    <div class="history-item-header">
                                        <span class="history-amount">${echeance.montant.toLocaleString()} F CFA</span>
                                        <span class="history-date">${echeance.date}</span>
                                    </div>
                                    <div class="history-details">
                                        <span class="history-mode mode-${statutClass}">${statutIcon} ${statutText}</span>
                                    </div>
                                </div>
                            `;
                        });
                        content.innerHTML = html;
                    }
                    
                    // Afficher le modal
                    const modal = document.getElementById('modalEcheances');
                    modal.style.display = 'block';
                    setTimeout(() => modal.classList.add('show'), 10);
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    showErrorModal('notificationModal', 'Erreur', 'Erreur lors du chargement des échéances');
                });
        }
        
        function fermerModalEcheances() {
            const modal = document.getElementById('modalEcheances');
            modal.classList.remove('show');
            setTimeout(() => modal.style.display = 'none', 300);
        }
        
        // Fonctions pour le modal de notification
        function afficherNotification(message, isError = false) {
            const modal = document.getElementById('notificationModal');
            const header = modal.querySelector('.notification-header h3');
            const icon = modal.querySelector('.notification-icon i');
            const messageEl = document.getElementById('notificationMessage');
            
            // Configurer le contenu selon le type
            if (isError) {
                modal.classList.add('error-modal');
                header.innerHTML = '<i class="fas fa-exclamation-triangle mr-2"></i>Erreur';
                icon.className = 'fas fa-exclamation-triangle';
            } else {
                modal.classList.remove('error-modal');
                header.innerHTML = '<i class="fas fa-check-circle mr-2"></i>Succès';
                icon.className = 'fas fa-check-circle';
            }
            
            messageEl.textContent = message;
            modal.style.display = 'block';
            setTimeout(() => modal.classList.add('show'), 10);
            
            // Fermer automatiquement après 3 secondes pour les succès
            if (!isError) {
                setTimeout(() => fermerNotification(), 3000);
            }
        }
        
        function fermerNotification() {
            const modal = document.getElementById('notificationModal');
            modal.classList.remove('show');
            setTimeout(() => modal.style.display = 'none', 300);
        }
        
        function gererChampReference() {
            const modePaiement = document.getElementById('mode_paiement').value;
            const referenceGroup = document.getElementById('reference-group');
            const referenceInput = document.getElementById('reference_paiement');
            
            if (modePaiement === 'especes') {
                referenceGroup.style.display = 'none';
                referenceInput.value = '';
                referenceInput.removeAttribute('required');
            } else {
                referenceGroup.style.display = 'block';
                referenceInput.setAttribute('required', 'required');
                
                // Définir le placeholder approprié
                switch(modePaiement) {
                    case 'cheque':
                        referenceInput.placeholder = 'Numéro de chèque';
                        break;
                    case 'virement':
                        referenceInput.placeholder = 'Référence du virement';
                        break;
                    case 'carte':
                        referenceInput.placeholder = 'Numéro de transaction';
                        break;
                    default:
                        referenceInput.placeholder = 'Référence du paiement';
                }
            }
        }
        
        // Gestion du formulaire de paiement
        document.getElementById('formPaiement').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const contratId = contratActuel.id;
            
            // Convertir FormData en objet pour l'envoi
            const data = {};
            formData.forEach((value, key) => {
                data[key] = value;
            });
            
            fetch(`/contrats/${contratId}/paiement`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    fermerModalPaiement();
                    afficherNotification('Paiement enregistré avec succès !');
                    // Recharger la page après un délai pour laisser voir la notification
                    setTimeout(() => location.reload(), 2000);
                } else {
                    if (data.errors) {
                        let errorMessage = 'Erreurs de validation:\n';
                        Object.keys(data.errors).forEach(key => {
                            errorMessage += `- ${data.errors[key].join(', ')}\n`;
                        });
                        afficherNotification(errorMessage, true);
                    } else {
                        afficherNotification('Erreur: ' + (data.message || 'Erreur lors de l\'enregistrement'), true);
                    }
                }
            })
                            .catch(error => {
                    console.error('Erreur:', error);
                    showErrorModal('notificationModal', 'Erreur', 'Erreur lors de l\'enregistrement du paiement');
                });
        });
    </script>

    <!-- Modal de notification -->
    <x-modal id="notificationModal" title="Notification" type="info">
        Message de notification
    </x-modal>
</body>
</html> 