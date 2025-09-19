<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GMAO Trans'urb - Planning (Logistique)</title>
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
        .btn-success {
            background: #10b981;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            font-size: 0.875rem;
        }
        .btn-success:hover {
            background: #059669;
        }
        .btn-success:disabled {
            background: #6b7280;
            cursor: not-allowed;
        }
        .calendar-week {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 1px;
            background: #e5e7eb;
            border-radius: 8px;
            overflow: hidden;
        }
        .calendar-day {
            background: white;
            padding: 1rem;
            min-height: 120px;
            border: 1px solid #e5e7eb;
        }
        .calendar-day-header {
            background: #17423b;
            color: white;
            padding: 0.5rem;
            text-align: center;
            font-weight: 600;
            font-size: 0.875rem;
        }
        .calendar-day.today {
            background: #f0f9ff;
            border-color: #0ea5e9;
        }
        .event-item {
            background: #f3f4f6;
            border-radius: 4px;
            padding: 0.25rem 0.5rem;
            margin: 0.25rem 0;
            font-size: 0.75rem;
            cursor: pointer;
            transition: background 0.2s;
        }
        .event-item:hover {
            background: #e5e7eb;
        }
        .event-intervention {
            background: #dbeafe;
            border-left: 3px solid #3b82f6;
        }
        .event-carburation {
            background: #fef3c7;
            border-left: 3px solid #f59e0b;
        }
        .event-planning {
            background: #d1fae5;
            border-left: 3px solid #10b981;
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
                <div class="greeting">Planning - Logistique</div>
                <div class="subtitle">Consultation du planning et signature des interventions</div>
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

        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="stat-card">
                <div>
                    <div class="stat-label">Planifiées</div>
                    <div class="stat-value">{{ $stats['planifiees'] }}</div>
                </div>
                <div class="icon"><i class="fas fa-calendar-check"></i></div>
            </div>
            <div class="stat-card">
                <div>
                    <div class="stat-label">En Cours</div>
                    <div class="stat-value">{{ $stats['en_cours'] }}</div>
                </div>
                <div class="icon"><i class="fas fa-play"></i></div>
            </div>
            <div class="stat-card">
                <div>
                    <div class="stat-label">En Retard</div>
                    <div class="stat-value">{{ $stats['en_retard'] }}</div>
                </div>
                <div class="icon"><i class="fas fa-exclamation-triangle"></i></div>
            </div>
            <div class="stat-card">
                <div>
                    <div class="stat-label">Terminées</div>
                    <div class="stat-value">{{ $stats['terminees'] }}</div>
                </div>
                <div class="icon"><i class="fas fa-check"></i></div>
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="content-card">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900">
                    <i class="fas fa-calendar-alt mr-2 text-green-600"></i>Planning Maintenance - Logistique
                </h2>
                <div class="flex gap-3">
                    <a href="{{ route('logistique.planning.export.pdf') }}" class="btn-primary">
                        <i class="fas fa-file-pdf"></i>
                        Exporter PDF
                    </a>
                </div>
            </div>
            
            <!-- Debug des données -->
            <div class="mb-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                <h4 class="font-semibold text-yellow-800 mb-2">Debug des données :</h4>
                <p class="text-sm text-yellow-700">
                    Interventions: {{ $interventions->count() }} | 
                    Carburations: {{ $carburations->count() }} | 
                    Semaine courante: {{ now()->startOfWeek()->format('d/m/Y') }} à {{ now()->endOfWeek()->format('d/m/Y') }}
                </p>
                @if($interventions->count() > 0)
                <p class="text-sm text-yellow-700 mt-1">
                    Première intervention: {{ $interventions->first()->date_debut ? $interventions->first()->date_debut->format('d/m/Y') : 'Pas de date' }}
                </p>
                @endif
                @if($carburations->count() > 0)
                <p class="text-sm text-yellow-700 mt-1">
                    Première carburation: {{ $carburations->first()->date_carburation ? $carburations->first()->date_carburation->format('d/m/Y') : 'Pas de date' }}
                </p>
                @endif
            </div>

            <!-- Calendrier hebdomadaire -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Calendrier Hebdomadaire</h3>
                <div class="calendar-week">
                    <div class="calendar-day-header">Lun</div>
                    <div class="calendar-day-header">Mar</div>
                    <div class="calendar-day-header">Mer</div>
                    <div class="calendar-day-header">Jeu</div>
                    <div class="calendar-day-header">Ven</div>
                    <div class="calendar-day-header">Sam</div>
                    <div class="calendar-day-header">Dim</div>
                    
                    @for($i = 0; $i < 7; $i++)
                        <div class="calendar-day {{ now()->startOfWeek()->addDays($i)->isToday() ? 'today' : '' }}">
                            <div class="font-semibold mb-2">{{ now()->startOfWeek()->addDays($i)->format('d/m') }}</div>
                            @php
                                $currentDay = now()->startOfWeek()->addDays($i);
                                $dayInterventions = $interventions->filter(function($intervention) use ($currentDay) {
                                    return $intervention->date_debut && $intervention->date_debut->isSameDay($currentDay);
                                });
                                $dayCarburations = $carburations->filter(function($carburation) use ($currentDay) {
                                    return $carburation->date_carburation && $carburation->date_carburation->isSameDay($currentDay);
                                });
                            @endphp
                            
                            @foreach($dayInterventions as $intervention)
                                <div class="event-item event-intervention" onclick="showInterventionDetails({{ $intervention->id }})">
                                    <i class="fas fa-tools mr-1"></i>{{ $intervention->vehicule->numero }}
                                </div>
                            @endforeach
                            
                            @foreach($dayCarburations as $carburation)
                                <div class="event-item event-carburation" onclick="showCarburationDetails({{ $carburation->id }})">
                                    <i class="fas fa-gas-pump mr-1"></i>{{ $carburation->vehicule->numero }}
                                </div>
                            @endforeach
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Liste des interventions récentes -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-tools mr-2 text-blue-500"></i>Interventions Récentes
                </h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-blue-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">Véhicule</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">Description</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">Statut</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">Signatures</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-blue-100">
                            @forelse($interventions->take(10) as $intervention)
                                <tr class="hover:bg-blue-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-8 w-8 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center">
                                                <i class="fas fa-bus text-white text-xs"></i>
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-blue-900">{{ $intervention->vehicule->numero }}</div>
                                                <div class="text-sm text-blue-700">{{ $intervention->vehicule->marque }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">{{ Str::limit($intervention->description, 50) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $intervention->date_debut ? $intervention->date_debut->format('d/m/Y') : '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                            @if($intervention->statut === 'En Attente') bg-yellow-100 text-yellow-800
                                            @elseif($intervention->statut === 'En Cours') bg-blue-100 text-blue-800
                                            @elseif($intervention->statut === 'Terminée') bg-green-100 text-green-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ $intervention->statut }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex items-center space-x-2">
                                            @if($intervention->signatureMaintenanceUser)
                                                <span class="text-green-600" title="Signé par Maintenance">
                                                    <i class="fas fa-check-circle"></i>
                                                </span>
                                            @else
                                                <span class="text-gray-400" title="Non signé par Maintenance">
                                                    <i class="fas fa-circle"></i>
                                                </span>
                                            @endif
                                            @if($intervention->signatureLogistiqueUser)
                                                <span class="text-green-600" title="Signé par Logistique">
                                                    <i class="fas fa-check-circle"></i>
                                                </span>
                                            @else
                                                <span class="text-gray-400" title="Non signé par Logistique">
                                                    <i class="fas fa-circle"></i>
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('logistique.interventions.show', $intervention->id) }}" class="text-blue-700 hover:text-blue-900 mr-3" title="Voir les détails">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if(!$intervention->signatureLogistiqueUser && $intervention->signatureMaintenanceUser)
                                            <button onclick="signerIntervention({{ $intervention->id }})" class="btn-success" title="Signer l'intervention">
                                                <i class="fas fa-signature"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                        <div class="py-8">
                                            <i class="fas fa-tools text-4xl mb-4 text-gray-400"></i>
                                            <p>Aucune intervention récente</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>


            <!-- Liste des carburations -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-gas-pump mr-2 text-yellow-500"></i>Carburations
                </h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-yellow-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-yellow-800 uppercase tracking-wider">Véhicule</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-yellow-800 uppercase tracking-wider">Chauffeur</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-yellow-800 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-yellow-800 uppercase tracking-wider">Heure</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-yellow-800 uppercase tracking-wider">Quantité</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-yellow-800 uppercase tracking-wider">État</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-yellow-800 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-yellow-100">
                            @forelse($carburations->take(10) as $carburation)
                                <tr class="hover:bg-yellow-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-8 w-8 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-full flex items-center justify-center">
                                                <i class="fas fa-bus text-white text-xs"></i>
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-yellow-900">{{ $carburation->vehicule->numero }}</div>
                                                <div class="text-sm text-yellow-700">{{ $carburation->vehicule->marque }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $carburation->chauffeur->nom ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $carburation->date_carburation ? $carburation->date_carburation->format('d/m/Y') : '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $carburation->heure_carburation ? $carburation->heure_carburation->format('H:i') : '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $carburation->quantite_litres }}L
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                            @if($carburation->etat === 'Planifiée') bg-yellow-100 text-yellow-800
                                            @elseif($carburation->etat === 'Effectuée') bg-green-100 text-green-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ $carburation->etat }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('maintenance.carburations.show', $carburation->id) }}" class="text-yellow-700 hover:text-yellow-900 mr-3" title="Voir les détails">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                        <div class="py-8">
                                            <i class="fas fa-gas-pump text-4xl mb-4 text-gray-400"></i>
                                            <p>Aucune carburation</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de notification -->
    <div id="notificationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-4">
                    <i class="fas fa-check text-green-600 text-xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2" id="notificationTitle">Succès</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500" id="notificationMessage">Action effectuée avec succès</p>
                </div>
                <div class="flex justify-center space-x-3 mt-4">
                    <button onclick="closeNotification()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                        OK
                    </button>
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

    <script>
        function signerIntervention(id) {
            if (confirm('Êtes-vous sûr de vouloir signer cette intervention ?')) {
                fetch(`/logistique/interventions/${id}/signer`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification('Succès', data.message, function() {
                            window.location.reload();
                        });
                    } else {
                        showNotification('Erreur', data.message);
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    showNotification('Erreur', 'Erreur lors de la signature');
                });
            }
        }

        function showInterventionDetails(id) {
            window.location.href = `/logistique/interventions/${id}`;
        }

        function showCarburationDetails(id) {
            window.location.href = `/logistique/carburations/${id}`;
        }

        function showNotification(title, message, callback = null) {
            document.getElementById('notificationTitle').textContent = title;
            document.getElementById('notificationMessage').textContent = message;
            document.getElementById('notificationModal').classList.remove('hidden');
            
            if (callback) {
                window.notificationCallback = callback;
            }
        }

        function closeNotification() {
            document.getElementById('notificationModal').classList.add('hidden');
            if (window.notificationCallback) {
                window.notificationCallback();
                window.notificationCallback = null;
            }
        }
    </script>
</body>
</html>
