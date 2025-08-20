<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GMAO Trans'urb - Fiche Demande Travaux</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fef3c7 0%, #fed7aa 100%);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-gradient-to-r from-amber-500 to-orange-500 shadow-lg">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo et titre -->
                <div class="flex items-center space-x-4">
                    <div class="h-10 w-10 bg-green-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-bus text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-white text-xl font-bold">Trans'urb GMAO</h1>
                        <p class="text-amber-100 text-sm">Interface Chauffeurs</p>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="hidden md:flex space-x-4">
                    <a href="{{ route('dashboard.moyens-generaux') }}" class="text-amber-100 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">
                        <i class="fas fa-cogs mr-2"></i>Moyens Généraux
                    </a>
                    <a href="{{ route('dashboard.maintenance') }}" class="text-amber-100 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">
                        <i class="fas fa-wrench mr-2"></i>Maintenance
                    </a>
                    <a href="{{ route('dashboard.logistique') }}" class="text-amber-100 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">
                        <i class="fas fa-clipboard-list mr-2"></i>Logistique
                    </a>
                    <a href="{{ route('chauffeur.fdt') }}" class="bg-orange-600 text-white px-3 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-clipboard-check mr-2"></i>Chauffeurs
                    </a>
                </nav>

                <!-- Utilisateur -->
                <div class="flex items-center space-x-4">
                    <div class="text-white text-sm">
                        <p class="font-medium">{{ Auth::user()->nom_complet }}</p>
                        <p class="text-amber-100">{{ Auth::user()->role->nom_role ?? 'Utilisateur' }}</p>
                        <p class="text-amber-100 text-xs">{{ Auth::user()->direction->nom_direction ?? '' }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-amber-100 hover:text-white transition-colors" title="Se déconnecter">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Instructions -->
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-8">
            <h2 class="text-lg font-semibold text-blue-900 mb-2">
                <i class="fas fa-info-circle mr-2"></i>
                Fiche de Demande de Travaux (FDT)
            </h2>
            <p class="text-blue-700">
                Signalez ici tous les problèmes techniques ou pannes constatés sur votre véhicule. 
                Soyez précis dans votre description pour faciliter le diagnostic par l'équipe maintenance.
            </p>
        </div>

        <!-- Formulaire FDT -->
        <div class="bg-white rounded-xl shadow-md">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900">
                    <i class="fas fa-clipboard-list text-amber-500 mr-2"></i>
                    Nouvelle Demande d'Intervention
                </h3>
            </div>
            
            <form class="p-6 space-y-6">
                <!-- Informations Véhicule -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h4 class="text-lg font-medium text-gray-900 mb-4">
                        <i class="fas fa-bus text-blue-600 mr-2"></i>
                        Informations Véhicule
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Immatriculation</label>
                            <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                                <option value="">Sélectionnez votre bus</option>
                                <option value="BUS-001">BUS-001 - Mercedes (Ligne 12)</option>
                                <option value="BUS-002">BUS-002 - Coaster (Ligne 5)</option>
                                <option value="BUS-003">BUS-003 - Gros Porteur (Ligne 8)</option>
                                <option value="BUS-004">BUS-004 - Petit Porteur (Ligne 3)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kilométrage Actuel</label>
                            <input type="number" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500" placeholder="ex: 125000">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Ligne Affectée</label>
                            <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100" value="Ligne 12" readonly>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date du Constat</label>
                            <input type="date" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500" value="2024-02-12">
                        </div>
                    </div>
                </div>

                <!-- Informations Chauffeur -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h4 class="text-lg font-medium text-gray-900 mb-4">
                        <i class="fas fa-user text-green-600 mr-2"></i>
                        Informations Chauffeur
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nom Complet</label>
                            <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100" value="Pierre DURAND" readonly>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Matricule</label>
                            <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100" value="CH-2024-012" readonly>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Téléphone</label>
                            <input type="tel" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500" placeholder="Votre numéro de téléphone">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Heure du Constat</label>
                            <input type="time" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                        </div>
                    </div>
                </div>

                <!-- Description de la Panne -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h4 class="text-lg font-medium text-gray-900 mb-4">
                        <i class="fas fa-exclamation-triangle text-red-600 mr-2"></i>
                        Description de la Panne
                    </h4>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Catégorie de Panne</label>
                            <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                                <option value="">Sélectionnez une catégorie</option>
                                <option value="mecanique">🔧 Mécanique (Moteur, Transmission, Freinage)</option>
                                <option value="electrique">⚡ Électrique (Éclairage, Signalisation, Batterie)</option>
                                <option value="carrosserie">🚗 Carrosserie (Portes, Vitres, Sièges)</option>
                                <option value="pneumatique">🛞 Pneumatique (Pneus, Jantes)</option>
                                <option value="climatisation">❄️ Climatisation/Chauffage</option>
                                <option value="autre">📋 Autre</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Niveau de Priorité</label>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <label class="flex items-center p-3 border border-green-300 rounded-lg cursor-pointer hover:bg-green-50">
                                    <input type="radio" name="priorite" value="faible" class="mr-3 text-green-600">
                                    <div>
                                        <div class="font-medium text-green-700">🟢 Faible</div>
                                        <div class="text-sm text-gray-600">Pas d'urgence</div>
                                    </div>
                                </label>
                                <label class="flex items-center p-3 border border-yellow-300 rounded-lg cursor-pointer hover:bg-yellow-50">
                                    <input type="radio" name="priorite" value="normale" class="mr-3 text-yellow-600">
                                    <div>
                                        <div class="font-medium text-yellow-700">🟡 Normal</div>
                                        <div class="text-sm text-gray-600">Dans la semaine</div>
                                    </div>
                                </label>
                                <label class="flex items-center p-3 border border-red-300 rounded-lg cursor-pointer hover:bg-red-50">
                                    <input type="radio" name="priorite" value="urgent" class="mr-3 text-red-600">
                                    <div>
                                        <div class="font-medium text-red-700">🔴 Urgent</div>
                                        <div class="text-sm text-gray-600">Immédiat</div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description Détaillée</label>
                            <textarea rows="6" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500" placeholder="Décrivez précisément le problème constaté :
- Quand cela se produit-il ?
- Quel bruit entendez-vous ?
- Y a-t-il des témoins lumineux allumés ?
- Le problème affecte-t-il la conduite ?
- Autres observations..."></textarea>
                        </div>

                        <!-- Ajout d'images -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Photos (optionnel)</label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-amber-400 transition-colors">
                                <div class="space-y-2">
                                    <div class="mx-auto h-12 w-12 text-gray-400">
                                        <i class="fas fa-camera text-4xl"></i>
                                    </div>
                                    <div class="text-gray-600">
                                        <label for="file-upload" class="cursor-pointer text-amber-600 hover:text-amber-500">
                                            Cliquez pour ajouter des photos
                                        </label>
                                        <p class="text-sm">PNG, JPG jusqu'à 10MB</p>
                                    </div>
                                    <input id="file-upload" name="file-upload" type="file" class="sr-only" multiple accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button type="submit" class="flex-1 bg-gradient-to-r from-amber-500 to-orange-500 text-white py-3 px-6 rounded-lg font-medium hover:from-amber-600 hover:to-orange-600 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transform hover:scale-105 transition-all duration-200 shadow-lg">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Envoyer la Demande
                        </button>
                        <button type="button" class="flex-1 sm:flex-none px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            <i class="fas fa-save mr-2"></i>
                            Sauvegarder Brouillon
                        </button>
                        <button type="button" class="flex-1 sm:flex-none px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            <i class="fas fa-times mr-2"></i>
                            Annuler
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Mes FDT récentes -->
        <div class="mt-8 bg-white rounded-xl shadow-md">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-history text-blue-500 mr-2"></i>
                    Mes Demandes Récentes
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-green-50 rounded-lg border border-green-200">
                        <div>
                            <p class="font-medium text-gray-900">FDT-2024-045</p>
                            <p class="text-sm text-gray-600">BUS-001 - Problème éclairage arrière</p>
                            <p class="text-xs text-gray-500">Catégorie: Électrique</p>
                        </div>
                        <div class="text-right">
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">✅ Traité</span>
                            <p class="text-xs text-gray-500 mt-1">08/02/2024</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                        <div>
                            <p class="font-medium text-gray-900">FDT-2024-046</p>
                            <p class="text-sm text-gray-600">BUS-001 - Bruit anormal freinage</p>
                            <p class="text-xs text-gray-500">Catégorie: Mécanique</p>
                        </div>
                        <div class="text-right">
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">⏳ En Cours</span>
                            <p class="text-xs text-gray-500 mt-1">10/02/2024</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-12">
        <div class="max-w-4xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-gray-500 text-sm">
                © 2024 Trans'urb - Direction d'Exploitation (
                    .DEX) - Interface Chauffeurs
            </p>
        </div>
    </footer>

    <!-- Bouton flottant retour accueil -->
    <a href="/" class="fixed bottom-4 right-4 bg-orange-500 hover:bg-orange-600 text-white p-3 rounded-full shadow-lg transition-all duration-200 hover:scale-110 z-50">
        <i class="fas fa-home text-lg"></i>
    </a>
</body>
</html> 