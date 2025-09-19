<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GMAO Trans'urb - Détails Planning (Logistique)</title>
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
        .main-navbar .nav-link.active {
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
            max-width: 1400px;
            margin: 0 auto;
            margin-top: -60px;
            margin-bottom: 2.5rem;
            z-index: 20;
            position: relative;
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
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-primary:hover {
            background: #17423b;
            color: white;
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
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-secondary:hover {
            background: #4b5563;
            color: white;
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
                <a href="{{ route('dashboard.logistique') }}" class="nav-link active"><i class="fas fa-clipboard-list mr-2"></i>Logistique</a>
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
                <div class="greeting">Détails Planning - Logistique</div>
                <div class="subtitle">Consultation des détails de la planification</div>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-calendar-alt" style="font-size: 2.5rem; color: #ffe082;"></i>
            </div>
        </div>
    </div>

    <!-- Menu principal harmonisé -->
    <div class="main-content">
        <div class="menu-bar" style="background: #fff; border-radius: 16px; box-shadow: 0 2px 12px rgba(23,66,59,0.08); padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
            <!-- Magasin - CRUD complet -->
            <div class="menu-dropdown" style="position: relative;">
                <button class="menu-btn">
                    <i class="fas fa-warehouse mr-2 text-blue-600"></i>Magasin <i class="fas fa-chevron-down ml-1"></i>
                </button>
                <ul class="dropdown-content">
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('logistique.magasin.index') }}'"><i class="fas fa-list mr-2"></i>Liste du Magasin</button></li>
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('logistique.magasin.create') }}'"><i class="fas fa-plus mr-2"></i>Ajouter une Pièce</button></li>
                </ul>
            </div>

            <!-- Véhicules - Lecture seule -->
            <div class="menu-dropdown" style="position: relative;">
                <button class="menu-btn">
                    <i class="fas fa-bus mr-2 text-purple-600"></i>Véhicules <i class="fas fa-chevron-down ml-1"></i>
                </button>
                <ul class="dropdown-content">
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('logistique.vehicules.index') }}'"><i class="fas fa-list mr-2"></i>Liste des Véhicules</button></li>
                </ul>
            </div>

            <!-- Planning - Lecture seule avec signature -->
            <div class="menu-dropdown" style="position: relative;">
                <button class="menu-btn">
                    <i class="fas fa-calendar-alt mr-2 text-green-600"></i>Planning <i class="fas fa-chevron-down ml-1"></i>
                </button>
                <ul class="dropdown-content">
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('logistique.planning.index') }}'"><i class="fas fa-calendar mr-2"></i>Planning Maintenance</button></li>
                </ul>
            </div>

            <!-- Bons de Commande - Lecture + Signature -->
            <div class="menu-dropdown" style="position: relative;">
                <button class="menu-btn">
                    <i class="fas fa-file-invoice mr-2 text-red-600"></i>Bons de Commande <i class="fas fa-chevron-down ml-1"></i>
                </button>
                <ul class="dropdown-content">
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('logistique.bons-commande.index') }}'"><i class="fas fa-list mr-2"></i>Liste des Bons de Commande</button></li>
                </ul>
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="content-card">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900">
                    <i class="fas fa-calendar-alt mr-2 text-green-600"></i>Détails de la Planification
                </h2>
                <div class="flex gap-3">
                    <a href="{{ route('logistique.planning.index') }}" class="btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        Retour au planning
                    </a>
                </div>
            </div>
            
            <!-- Informations générales -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <div class="bg-green-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-green-900 mb-4">
                        <i class="fas fa-info-circle mr-2"></i>Informations Générales
                    </h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">ID Planification:</span>
                            <span class="font-semibold text-green-900">#{{ $planning->id }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Date de planification:</span>
                            <span class="font-semibold text-green-900">{{ $planning->date_planifiee ? $planning->date_planifiee->format('d/m/Y') : 'Non définie' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Véhicule:</span>
                            <span class="font-semibold text-green-900">{{ $planning->vehicule->numero ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Type de véhicule:</span>
                            <span class="font-semibold text-green-900">{{ $planning->vehicule->type_vehicule ?? 'Non spécifié' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Marque:</span>
                            <span class="font-semibold text-green-900">{{ $planning->vehicule->marque ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-blue-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-blue-900 mb-4">
                        <i class="fas fa-cogs mr-2"></i>Détails de la Planification
                    </h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Type de maintenance:</span>
                            <span class="font-semibold text-blue-900">{{ $planning->type_maintenance ?? 'Non défini' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Statut:</span>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                @if($planning->statut === 'Planifiee') bg-yellow-100 text-yellow-800
                                @elseif($planning->statut === 'En Cours') bg-blue-100 text-blue-800
                                @elseif($planning->statut === 'Terminee') bg-green-100 text-green-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ $planning->statut }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Heure de début:</span>
                            <span class="font-semibold text-blue-900">{{ $planning->heure_debut ? $planning->heure_debut->format('H:i') : 'Non définie' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Durée estimée:</span>
                            <span class="font-semibold text-blue-900">{{ $planning->duree_estimee ?? 'Non définie' }} heures</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Technicien:</span>
                            <span class="font-semibold text-blue-900">{{ $planning->technicien ?? 'Non assigné' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Atelier:</span>
                            <span class="font-semibold text-blue-900">{{ $planning->atelier ?? 'Non défini' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description des travaux -->
            <div class="bg-purple-50 rounded-lg p-6 mb-8">
                <h3 class="text-lg font-semibold text-purple-900 mb-4">
                    <i class="fas fa-tools mr-2"></i>Description des Travaux
                </h3>
                <div class="bg-white rounded-lg p-4">
                    <p class="text-gray-700">{{ $planning->description_travaux ?? 'Aucune description fournie' }}</p>
                </div>
                @if($planning->pieces_necessaires)
                <div class="mt-4">
                    <h4 class="font-semibold text-purple-900 mb-2">Pièces nécessaires :</h4>
                    <div class="bg-white rounded-lg p-4">
                        <p class="text-gray-700">{{ $planning->pieces_necessaires }}</p>
                    </div>
                </div>
                @endif
                @if($planning->notes)
                <div class="mt-4">
                    <h4 class="font-semibold text-purple-900 mb-2">Notes :</h4>
                    <div class="bg-white rounded-lg p-4">
                        <p class="text-gray-700">{{ $planning->notes }}</p>
                    </div>
                </div>
                @endif
            </div>

            <!-- Note importante -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-center">
                    <i class="fas fa-info-circle text-blue-600 mr-3"></i>
                    <div>
                        <h4 class="font-semibold text-blue-900">Mode Consultation</h4>
                        <p class="text-sm text-blue-700">Vous consultez les détails de la planification en mode lecture seule. Les modifications doivent être effectuées depuis le module Maintenance.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .menu-btn {
            background: none;
            border: none;
            border-radius: 12px;
            padding: 0.8rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            color: #17423b;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: background 0.2s, color 0.2s;
            white-space: nowrap;
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
            min-width: 240px;
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
            font-size: 0.95rem;
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
</body>
</html>
