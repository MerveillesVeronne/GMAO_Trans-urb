@extends('layouts.app')
@section('title', "GMAO Trans'urb - Logistique")

@section('content')
    <!-- Header -->
    <header class="bg-gradient-to-r from-green-600 via-emerald-500 to-yellow-500 shadow-xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo et titre -->
                <div class="flex items-center space-x-4">
                    <div class="h-10 w-10 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-full flex items-center justify-center shadow-lg">
                        <i class="fas fa-bus text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-white text-xl font-bold">Trans'urb GMAO</h1>
                        <p class="text-green-100 text-sm">Logistique</p>
                    </div>
                </div>
                <!-- Navigation -->
                <nav class="hidden md:flex space-x-4">
                    <a href="{{ route('dashboard.moyens-generaux') }}" class="text-green-100 hover:text-white hover:bg-white hover:bg-opacity-10 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200">
                        <i class="fas fa-cogs mr-2"></i>Moyens Généraux
                    </a>
                    <a href="{{ route('dashboard.maintenance') }}" class="text-green-100 hover:text-white hover:bg-white hover:bg-opacity-10 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200">
                        <i class="fas fa-wrench mr-2"></i>Maintenance
                    </a>
                    <a href="{{ route('dashboard.logistique') }}" class="bg-white bg-opacity-20 text-white px-4 py-2 rounded-lg text-sm font-medium shadow-md">
                        <i class="fas fa-clipboard-list mr-2"></i>Logistique
                    </a>
                    <a href="{{ route('chauffeur.fdt') }}" class="text-green-100 hover:text-white hover:bg-white hover:bg-opacity-10 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200">
                        <i class="fas fa-clipboard-check mr-2"></i>Chauffeurs
                    </a>
                </nav>
                <!-- Utilisateur -->
                <div class="flex items-center space-x-4">
                    <div class="text-white text-sm">
                        <p class="font-medium">{{ Auth::user()->nom_complet }}</p>
                        <p class="text-green-100">{{ Auth::user()->role->nom_role ?? 'Utilisateur' }}</p>
                        <p class="text-green-100 text-xs">{{ Auth::user()->direction->nom_direction ?? '' }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-green-100 hover:text-white transition-colors p-2 rounded-lg hover:bg-white hover:bg-opacity-10" title="Se déconnecter">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Dashboard Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Stocks en attente -->
            <div class="glass-effect rounded-xl shadow-lg p-6 border-l-4 border-orange-500 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Stocks en Attente</p>
                        <p class="text-3xl font-bold bg-gradient-to-r from-orange-500 to-orange-600 bg-clip-text text-transparent opacity-90">7</p>
                    </div>
                    <div class="bg-gradient-to-br from-orange-300 to-orange-400 p-3 rounded-full shadow-lg opacity-80">
                        <i class="fas fa-hourglass-half text-white text-xl"></i>
                    </div>
                </div>
            </div>
            <!-- BDC à valider -->
            <div class="glass-effect rounded-xl shadow-lg p-6 border-l-4 border-red-500 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">BDC à Valider</p>
                        <p class="text-3xl font-bold bg-gradient-to-r from-red-500 to-red-600 bg-clip-text text-transparent opacity-90">5</p>
                    </div>
                    <div class="bg-gradient-to-br from-red-300 to-red-400 p-3 rounded-full shadow-lg opacity-80">
                        <i class="fas fa-file-signature text-white text-xl"></i>
                    </div>
                </div>
            </div>
            <!-- Documents signés -->
            <div class="glass-effect rounded-xl shadow-lg p-6 border-l-4 border-green-500 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Documents Signés</p>
                        <p class="text-3xl font-bold bg-gradient-to-r from-green-600 to-green-700 bg-clip-text text-transparent">28</p>
                    </div>
                    <div class="bg-gradient-to-br from-green-400 to-green-500 p-3 rounded-full shadow-lg">
                        <i class="fas fa-check-circle text-white text-xl"></i>
                    </div>
                </div>
            </div>
            <!-- Stock total -->
            <div class="glass-effect rounded-xl shadow-lg p-6 border-l-4 border-blue-500 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Valeur Stock Total</p>
                        <p class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-blue-700 bg-clip-text text-transparent">€125K</p>
                    </div>
                    <div class="bg-gradient-to-br from-blue-400 to-blue-500 p-3 rounded-full shadow-lg">
                        <i class="fas fa-boxes text-white text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- Actions rapides -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Validation Stocks -->
            <div class="glass-effect rounded-xl shadow-lg p-6 card-hover">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Validation Stocks</h3>
                    <i class="fas fa-clipboard-check text-orange-600 text-xl"></i>
                </div>
                <div class="space-y-3">
                    <button class="w-full bg-gradient-to-r from-orange-400 to-orange-500 hover:from-orange-500 hover:to-orange-600 text-white py-3 px-4 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-105 opacity-90 hover:opacity-100">
                        <i class="fas fa-eye mr-2"></i>Stocks en Attente
                    </button>
                    <button class="w-full bg-white hover:bg-gray-50 text-gray-700 py-2 px-4 rounded-lg transition-colors shadow-sm border">
                        <i class="fas fa-history mr-2"></i>Historique
                    </button>
                </div>
            </div>
            <!-- Signature Documents -->
            <div class="glass-effect rounded-xl shadow-lg p-6 card-hover">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Signature Documents</h3>
                    <i class="fas fa-file-signature text-red-600 text-xl"></i>
                </div>
                <div class="space-y-3">
                    <button class="w-full bg-gradient-to-r from-red-400 to-red-500 hover:from-red-500 hover:to-red-600 text-white py-3 px-4 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-105 opacity-90 hover:opacity-100">
                        <i class="fas fa-pen mr-2"></i>BDC à Signer
                    </button>
                    <button class="w-full bg-white hover:bg-gray-50 text-gray-700 py-2 px-4 rounded-lg transition-colors shadow-sm border">
                        <i class="fas fa-certificate mr-2"></i>Certificats
                    </button>
                </div>
            </div>
            <!-- Gestion Stocks -->
            <div class="glass-effect rounded-xl shadow-lg p-6 card-hover">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Gestion Stocks</h3>
                    <i class="fas fa-boxes text-green-600 text-xl"></i>
                </div>
                <div class="space-y-3">
                    <button class="w-full bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white py-3 px-4 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-105">
                        <i class="fas fa-chart-bar mr-2"></i>Vue d'ensemble
                    </button>
                    <button class="w-full bg-white hover:bg-gray-50 text-gray-700 py-2 px-4 rounded-lg transition-colors shadow-sm border">
                        <i class="fas fa-search mr-2"></i>Rechercher
                    </button>
                </div>
            </div>
        </div>
        <!-- Stocks en attente de validation -->
        <div class="glass-effect rounded-xl shadow-lg mb-8 card-hover">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-hourglass-half text-orange-500 mr-2"></i>
                    Stocks en Attente de Validation
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gradient-to-r from-orange-50 to-orange-100 rounded-lg border border-orange-200 shadow-sm">
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <h4 class="font-medium text-gray-900">Huile Moteur 15W40</h4>
                                <span class="text-sm text-gray-600">Saisi par: Jean DUBOIS</span>
                            </div>
                            <p class="text-sm text-gray-600 mt-1">Quantité ajoutée: +200L</p>
                            <p class="text-xs text-gray-500">Date: 12/02/2024 - 14:30</p>
                        </div>
                        <div class="flex space-x-2 ml-4">
                            <button class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">
                                <i class="fas fa-check mr-1"></i>Accepter
                            </button>
                            <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                                <i class="fas fa-times mr-1"></i>Refuser
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gradient-to-r from-orange-50 to-orange-100 rounded-lg border border-orange-200 shadow-sm">
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <h4 class="font-medium text-gray-900">Filtres à Air</h4>
                                <span class="text-sm text-gray-600">Saisi par: Jean DUBOIS</span>
                            </div>
                            <p class="text-sm text-gray-600 mt-1">Quantité ajoutée: +50 unités</p>
                            <p class="text-xs text-gray-500">Date: 12/02/2024 - 15:45</p>
                        </div>
                        <div class="flex space-x-2 ml-4">
                            <button class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">
                                <i class="fas fa-check mr-1"></i>Accepter
                            </button>
                            <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                                <i class="fas fa-times mr-1"></i>Refuser
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- BDC à valider -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- BDC en attente -->
            <div class="glass-effect rounded-xl shadow-lg card-hover">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-file-signature text-red-500 mr-2"></i>
                        BDC à Valider et Signer
                    </h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="p-4 bg-gradient-to-r from-red-50 to-red-100 rounded-lg border border-red-200 shadow-sm">
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="font-medium text-gray-900">BDC-2024-015</h4>
                                <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded-full">🔴 Urgent</span>
                            </div>
                            <p class="text-sm text-gray-600">Plaquettes de frein pour BUS-002</p>
                            <p class="text-xs text-gray-500 mb-3">Demandé par: Marie MARTIN - 10/02/2024</p>
                            <div class="flex space-x-2">
                                <button class="flex-1 px-3 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors text-sm">
                                    <i class="fas fa-eye mr-1"></i>Voir PDF
                                </button>
                                <button class="flex-1 px-3 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors text-sm">
                                    <i class="fas fa-signature mr-1"></i>Signer
                                </button>
                            </div>
                        </div>
                        <div class="p-4 bg-gradient-to-r from-yellow-50 to-yellow-100 rounded-lg border border-yellow-200 shadow-sm">
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="font-medium text-gray-900">BDC-2024-016</h4>
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">⏳ Normal</span>
                            </div>
                            <p class="text-sm text-gray-600">Ampoules LED pour BUS-006</p>
                            <p class="text-xs text-gray-500 mb-3">Demandé par: Marie MARTIN - 11/02/2024</p>
                            <div class="flex space-x-2">
                                <button class="flex-1 px-3 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors text-sm">
                                    <i class="fas fa-eye mr-1"></i>Voir PDF
                                </button>
                                <button class="flex-1 px-3 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors text-sm">
                                    <i class="fas fa-signature mr-1"></i>Signer
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Documents récemment signés -->
            <div class="glass-effect rounded-xl shadow-lg card-hover">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                        Documents Récemment Signés
                    </h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-gradient-to-r from-green-50 to-green-100 rounded-lg border border-green-200 shadow-sm">
                            <div>
                                <p class="font-medium text-gray-900">BDC-2024-013</p>
                                <p class="text-sm text-gray-600">Huile Moteur (100L)</p>
                                <p class="text-xs text-gray-500">Stock mis à jour automatiquement</p>
                            </div>
                            <div class="text-right">
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">✅ Signé</span>
                                <p class="text-xs text-gray-500 mt-1">09/02/2024</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gradient-to-r from-green-50 to-green-100 rounded-lg border border-green-200 shadow-sm">
                            <div>
                                <p class="font-medium text-gray-900">BDC-2024-014</p>
                                <p class="text-sm text-gray-600">Pneus Michelin (4 unités)</p>
                                <p class="text-xs text-gray-500">Stock mis à jour automatiquement</p>
                            </div>
                            <div class="text-right">
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">✅ Signé</span>
                                <p class="text-xs text-gray-500 mt-1">09/02/2024</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gradient-to-r from-green-50 to-green-100 rounded-lg border border-green-200 shadow-sm">
                            <div>
                                <p class="font-medium text-gray-900">BDC-2024-012</p>
                                <p class="text-sm text-gray-600">Filtres à carburant</p>
                                <p class="text-xs text-gray-500">Stock mis à jour automatiquement</p>
                            </div>
                            <div class="text-right">
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">✅ Signé</span>
                                <p class="text-xs text-gray-500 mt-1">08/02/2024</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Footer -->
    <footer class="glass-effect border-t border-gray-200 mt-12">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-gray-500 text-sm">
                © 2024 Trans'urb - Direction d'Exploitation (DEX) - Module Logistique
            </p>
        </div>
    </footer>
    <!-- Bouton flottant retour accueil -->
    <a href="/" class="fixed bottom-4 right-4 bg-gradient-to-r from-green-600 to-yellow-500 hover:from-green-700 hover:to-yellow-600 text-white p-3 rounded-full shadow-lg transition-all duration-200 hover:scale-110 z-50">
        <i class="fas fa-home text-lg"></i>
    </a>
@endsection 