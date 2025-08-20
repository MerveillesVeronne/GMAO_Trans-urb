<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails du Contrat - Résilié</title>
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
        .contract-header { background: #f8d7da; padding: 2rem; border-radius: 12px; margin-bottom: 2rem; border-left: 4px solid #dc3545; }
        .contract-title { font-size: 1.8rem; font-weight: 700; color: #721c24; margin-bottom: 0.5rem; }
        .contract-subtitle { color: #721c24; font-size: 1.1rem; }
        .info-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-bottom: 2rem; }
        .info-card { background: #f8f9fa; padding: 1.5rem; border-radius: 10px; border-left: 4px solid #dc3545; }
        .info-card h3 { color: #721c24; font-size: 1.1rem; font-weight: 600; margin-bottom: 1rem; }
        .info-item { display: flex; justify-content: space-between; margin-bottom: 0.8rem; }
        .info-label { font-weight: 500; color: #666; }
        .info-value { font-weight: 600; color: #721c24; }
        .status-badge { padding: 0.4rem 1rem; border-radius: 20px; font-size: 0.9rem; font-weight: 600; }
        .status-resilie { background: #f8d7da; color: #721c24; }
        .history-section { margin-top: 2rem; }
        .history-title { font-size: 1.4rem; font-weight: 600; color: #721c24; margin-bottom: 1.5rem; }
        .timeline { position: relative; padding-left: 2rem; }
        .timeline::before { content: ''; position: absolute; left: 0.5rem; top: 0; bottom: 0; width: 2px; background: #dc3545; }
        .timeline-item { position: relative; margin-bottom: 2rem; padding-left: 2rem; }
        .timeline-item::before { content: ''; position: absolute; left: -0.5rem; top: 0.5rem; width: 1rem; height: 1rem; background: #dc3545; border-radius: 50%; }
        .timeline-date { font-size: 0.9rem; color: #666; margin-bottom: 0.5rem; }
        .timeline-content { background: #f8f9fa; padding: 1rem; border-radius: 8px; }
        .timeline-title { font-weight: 600; color: #721c24; margin-bottom: 0.5rem; }
        .timeline-desc { color: #666; }
        .actions-section { margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #eee; }
        .action-buttons { display: flex; gap: 1rem; flex-wrap: wrap; }
        .btn { padding: 0.8rem 1.5rem; border-radius: 8px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.2s; }
        .btn-disabled { background: #6c757d; color: #fff; cursor: not-allowed; opacity: 0.6; }
        .resiliation-notice { background: #f8d7da; border: 1px solid #f5c6cb; border-radius: 8px; padding: 1.5rem; margin-bottom: 2rem; }
        .resiliation-notice h3 { color: #721c24; margin-bottom: 1rem; }
        .resiliation-notice p { color: #721c24; line-height: 1.6; }
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
                <div class="greeting">Détails du Contrat - Résilié</div>
                <div class="subtitle" style="color: #ffe082;">Contrat interrompu définitivement</div>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-times-circle" style="font-size: 2.5rem; color: #dc3545;"></i>
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
        <a href="{{ route('liste.contrats') }}" class="back-btn"><i class="fas fa-arrow-left"></i>Retour à la liste des contrats</a>
        
        <!-- Notice de résiliation -->
        <div class="resiliation-notice">
            <h3><i class="fas fa-exclamation-triangle mr-2"></i>Contrat Résilié</h3>
            <p>Ce contrat a été résilié le <strong>15/11/2023</strong> et ne peut plus être modifié. Toutes les actions sont désactivées.</p>
        </div>
        
        <!-- En-tête du contrat -->
        <div class="contract-header">
            <div class="contract-title">Contrat Nettoyage</div>
            <div class="contract-subtitle">Services de nettoyage des locaux et véhicules</div>
        </div>

        <!-- Informations principales -->
        <div class="info-grid">
            <div class="info-card">
                <h3><i class="fas fa-info-circle mr-2"></i>Informations générales</h3>
                <div class="info-item">
                    <span class="info-label">Référence :</span>
                    <span class="info-value">CTR-2023-004</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Fournisseur :</span>
                    <span class="info-value">CleanPro Services</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Type :</span>
                    <span class="info-value">Service</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Statut actuel :</span>
                    <span class="status-badge status-resilie">Résilié</span>
                </div>
            </div>

            <div class="info-card">
                <h3><i class="fas fa-calendar-alt mr-2"></i>Dates importantes</h3>
                <div class="info-item">
                    <span class="info-label">Date de création :</span>
                    <span class="info-value">01/01/2023</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Date de début initiale :</span>
                    <span class="info-value">01/01/2023</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Date de fin initiale :</span>
                    <span class="info-value">31/12/2023</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Date de résiliation :</span>
                    <span class="info-value">15/11/2023</span>
                </div>
            </div>

            <div class="info-card">
                <h3><i class="fas fa-euro-sign mr-2"></i>Informations financières</h3>
                <div class="info-item">
                    <span class="info-label">Montant initial :</span>
                    <span class="info-value">25 000 F CFA</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Montant final :</span>
                    <span class="info-value">25 000 F CFA</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Jours de suspension :</span>
                    <span class="info-value">Aucune suspension</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Nombre de renouvellements :</span>
                    <span class="info-value">0</span>
                </div>
            </div>
        </div>

        <!-- Description -->
        <div class="info-card" style="grid-column: 1 / -1;">
            <h3><i class="fas fa-align-left mr-2"></i>Description</h3>
            <p style="color: #666; line-height: 1.6;">
                Contrat de services de nettoyage pour les locaux administratifs et la flotte de véhicules de Trans'urb. 
                Le service incluait le nettoyage quotidien des bureaux, le lavage des véhicules, et l'entretien des espaces communs.
            </p>
        </div>

        <!-- Historique des modifications -->
        <div class="history-section">
            <div class="history-title"><i class="fas fa-history mr-2"></i>Historique des modifications</div>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-date">01/01/2023 - 09:00</div>
                    <div class="timeline-content">
                        <div class="timeline-title">Création du contrat</div>
                        <div class="timeline-desc">Contrat créé avec CleanPro Services pour une durée d'un an</div>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-date">15/11/2023 - 14:30</div>
                    <div class="timeline-content">
                        <div class="timeline-title">Résiliation du contrat</div>
                        <div class="timeline-desc">Contrat résilié pour cause de non-respect des conditions de qualité par le fournisseur</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions (toutes désactivées) -->
        <div class="actions-section">
            <h3 style="color: #721c24; margin-bottom: 1rem;"><i class="fas fa-ban mr-2"></i>Actions non disponibles</h3>
            <div class="action-buttons">
                <span class="btn btn-disabled">
                    <i class="fas fa-edit"></i>Modifier le contrat
                </span>
                <span class="btn btn-disabled">
                    <i class="fas fa-pause"></i>Suspendre
                </span>
                <span class="btn btn-disabled">
                    <i class="fas fa-redo"></i>Renouveler
                </span>
                <span class="btn btn-disabled">
                    <i class="fas fa-times"></i>Résilier
                </span>
            </div>
            <p style="color: #721c24; margin-top: 1rem; font-style: italic;">
                <i class="fas fa-info-circle mr-2"></i>
                Ce contrat étant résilié, aucune action n'est plus possible.
            </p>
        </div>
    </div>
</body>
</html> 