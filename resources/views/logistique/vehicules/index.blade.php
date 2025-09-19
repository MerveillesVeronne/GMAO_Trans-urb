<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GMAO Trans'urb - Véhicules (Logistique)</title>
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
        .stat-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(23,66,59,0.13);
            padding: 2.2rem 2.8rem;
            min-width: 270px;
            max-width: 320px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            transition: box-shadow 0.2s, transform 0.2s;
        }
        .stat-card:hover {
            box-shadow: 0 12px 36px rgba(23,66,59,0.18);
            transform: translateY(-4px) scale(1.04);
        }
        .stat-card .icon {
            background: #e6f4ee;
            border-radius: 50%;
            padding: 0.8rem;
            font-size: 1.5rem;
            color: #17423b;
        }
        .stat-card .stat-label {
            color: #6b7c7a;
            font-size: 1rem;
            font-weight: 500;
        }
        .stat-card .stat-value {
            font-size: 2.7rem;
            font-weight: 700;
            color: #17423b;
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
                <div class="greeting">Véhicules - Logistique</div>
                <div class="subtitle">Consultation des véhicules (lecture seule)</div>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-bus" style="font-size: 2.5rem; color: #ffe082;"></i>
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

        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="stat-card">
                <div>
                    <div class="stat-label">En Service</div>
                    <div class="stat-value">{{ $stats['en_service'] ?? 0 }}</div>
                </div>
                <div class="icon"><i class="fas fa-check-circle"></i></div>
            </div>
            <div class="stat-card">
                <div>
                    <div class="stat-label">Au Garage</div>
                    <div class="stat-value">{{ $stats['au_garage'] ?? 0 }}</div>
                </div>
                <div class="icon"><i class="fas fa-wrench"></i></div>
            </div>
            <div class="stat-card">
                <div>
                    <div class="stat-label">En Réparation</div>
                    <div class="stat-value">{{ $stats['en_reparation'] ?? 0 }}</div>
                </div>
                <div class="icon"><i class="fas fa-tools"></i></div>
            </div>
            <div class="stat-card">
                <div>
                    <div class="stat-label">Maintenance</div>
                    <div class="stat-value">{{ $stats['maintenance'] ?? 0 }}</div>
                </div>
                <div class="icon"><i class="fas fa-cog"></i></div>
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="content-card">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900">
                    <i class="fas fa-bus mr-2 text-purple-600"></i>Inventaire des Véhicules
                </h2>
                <div class="flex gap-3">
                    <a href="{{ route('logistique.vehicules.export.pdf') }}" class="btn-primary">
                        <i class="fas fa-file-pdf"></i>
                        Exporter PDF
                    </a>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-purple-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-purple-800 uppercase tracking-wider">Véhicule</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-purple-800 uppercase tracking-wider">Type/Marque</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-purple-800 uppercase tracking-wider">Ligne</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-purple-800 uppercase tracking-wider">Statut</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-purple-800 uppercase tracking-wider">Kilométrage</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-purple-800 uppercase tracking-wider">Dernière Intervention</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-purple-800 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-purple-100">
                        @forelse($vehicules as $vehicule)
                            <tr class="hover:bg-purple-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 bg-gradient-to-br from-purple-400 to-purple-600 rounded-full flex items-center justify-center">
                                            <i class="fas fa-bus text-white"></i>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-purple-900">{{ $vehicule->numero }}</div>
                                            <div class="text-sm text-purple-700">Immat: {{ $vehicule->immatriculation }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="space-y-1">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">{{ $vehicule->type_vehicule ?? 'Non spécifié' }}</span>
                                        <br>
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">{{ $vehicule->marque }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-900">{{ $vehicule->ligne ?? 'Non assigné' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusColors = [
                                            'En Service' => 'bg-green-200 text-green-900',
                                            'Au Garage' => 'bg-yellow-200 text-yellow-900',
                                            'En Réparation' => 'bg-red-200 text-red-900',
                                            'Maintenance' => 'bg-blue-200 text-blue-900'
                                        ];
                                        $statusColor = $statusColors[$vehicule->statut] ?? 'bg-gray-200 text-gray-900';
                                    @endphp
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $statusColor }}">
                                        <i class="fas fa-circle text-green-500 mr-1"></i>{{ $vehicule->statut }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-700">
                                    @if($vehicule->kilometrage)
                                        {{ number_format($vehicule->kilometrage, 0, ',', ' ') }} km
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-700">{{ $vehicule->updated_at->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('logistique.vehicules.show', $vehicule->id) }}" class="text-purple-700 hover:text-purple-900 mr-3" title="Voir les détails">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                    <div class="py-8">
                                        <i class="fas fa-bus text-4xl mb-4 text-gray-400"></i>
                                        <p>Aucun véhicule enregistré</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
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


