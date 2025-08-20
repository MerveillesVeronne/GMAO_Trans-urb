@extends('layouts.app')

@section('title', "GMAO Trans'urb - Maintenance")

@section('content')
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
                <a href="{{ route('dashboard.maintenance') }}" class="nav-link active"><i class="fas fa-wrench mr-2"></i>Maintenance</a>
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
                <div class="greeting">Maintenance</div>
                <div class="subtitle">Gestion du parc véhicules, interventions et pièces détachées</div>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-wrench" style="font-size: 2.5rem; color: #ffe082;"></i>
            </div>
        </div>
    </div>

    <div class="main-content">
        <div class="menu-bar" style="background: #fff; border-radius: 16px; box-shadow: 0 2px 12px rgba(23,66,59,0.08); padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
            <div class="menu-dropdown" style="position: relative;">
                <button class="menu-btn">
                    <i class="fas fa-bus mr-2 text-blue-600"></i>Véhicules <i class="fas fa-chevron-down ml-1"></i>
                </button>
                <ul class="dropdown-content">
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('maintenance.vehicules') }}'"><i class="fas fa-list mr-2"></i>Liste des Véhicules</button></li>
                </ul>
            </div>
            <div class="menu-dropdown" style="position: relative;">
                <button class="menu-btn">
                    <i class="fas fa-tools mr-2 text-green-600"></i>Interventions <i class="fas fa-chevron-down ml-1"></i>
                </button>
                <ul class="dropdown-content">
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('maintenance.interventions') }}'"><i class="fas fa-list mr-2"></i>Liste des Interventions</button></li>
                </ul>
            </div>
            <div class="menu-dropdown" style="position: relative;">
                <button class="menu-btn">
                    <i class="fas fa-cogs mr-2 text-purple-600"></i>Pièces détachées <i class="fas fa-chevron-down ml-1"></i>
                </button>
                <ul class="dropdown-content">
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('maintenance.pieces') }}'"><i class="fas fa-list mr-2"></i>Liste des Pièces</button></li>
                </ul>
            </div>
            <div class="menu-dropdown" style="position: relative;">
                <button class="menu-btn">
                    <i class="fas fa-calendar-alt mr-2 text-orange-600"></i>Planning <i class="fas fa-chevron-down ml-1"></i>
                </button>
                <ul class="dropdown-content">
                    <li><button class="dropdown-item" onclick="window.location.href='{{ route('maintenance.planning') }}'"><i class="fas fa-calendar mr-2"></i>Planning</button></li>
                </ul>
            </div>
        </div>

        <div class="content-card">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Tableau de bord - Maintenance</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="stat-card">
                    <div>
                        <div class="stat-label">Véhicules en Service</div>
                        <div class="stat-value">42</div>
                    </div>
                    <div class="icon"><i class="fas fa-bus"></i></div>
                </div>
                <div class="stat-card">
                    <div>
                        <div class="stat-label">Au Garage</div>
                        <div class="stat-value">8</div>
                    </div>
                    <div class="icon"><i class="fas fa-tools"></i></div>
                </div>
                <div class="stat-card">
                    <div>
                        <div class="stat-label">Interventions en Cours</div>
                        <div class="stat-value">12</div>
                    </div>
                    <div class="icon"><i class="fas fa-wrench"></i></div>
                </div>
                <div class="stat-card">
                    <div>
                        <div class="stat-label">Pièces en Rupture</div>
                        <div class="stat-value">3</div>
                    </div>
                    <div class="icon"><i class="fas fa-exclamation-triangle"></i></div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="content-card">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">
                        <i class="fas fa-bell mr-2 text-red-500"></i>Alertes Maintenance
                    </h3>
                    <div class="space-y-3">
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-check-circle text-4xl mb-4 text-green-500"></i>
                            <p>Aucune alerte de maintenance</p>
                            <p class="text-sm">Tout est à jour</p>
                        </div>
                    </div>
                </div>
                <div class="content-card">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">
                        <i class="fas fa-tools mr-2 text-blue-500"></i>Interventions Récentes
                    </h3>
                    <div class="space-y-3">
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-wrench text-4xl mb-4 text-gray-400"></i>
                            <p>Aucune intervention récente</p>
                            <p class="text-sm">Les nouvelles interventions apparaîtront ici</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
