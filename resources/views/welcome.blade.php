<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trans'urb - GMAO - Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gradient-to-br from-green-50 to-yellow-50">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="max-w-md w-full">
            <!-- Logo et Titre -->
            <div class="text-center mb-8">
                <div
                    class="mx-auto h-20 w-20 bg-gradient-to-br from-green-600 to-yellow-500 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-bus text-white text-2xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Trans'urb</h1>
                <p class="text-gray-600">GMAO - Système de Gestion Intégrée</p>
                <p class="text-sm text-gray-500 mt-1">Direction Financière & Comptable / Direction d'Exploitation</p>
            </div>

            <!-- Formulaire de Connexion -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="space-y-6">
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-envelope mr-2 text-green-600"></i>Adresse email
                            </label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                autocomplete="email" autofocus
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors @error('email') border-red-500 @enderror"
                                placeholder="votre.email@transurb.com">
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Mot de passe -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-lock mr-2 text-green-600"></i>Mot de passe
                            </label>
                            <input type="password" id="password" name="password" required
                                autocomplete="current-password"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors @error('password') border-red-500 @enderror"
                                placeholder="••••••••">
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Se souvenir de moi -->
                        <div class="flex items-center">
                            <input type="checkbox" id="remember" name="remember"
                                class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                            <label for="remember" class="ml-2 block text-sm text-gray-900">
                                Se souvenir de moi
                            </label>
                        </div>
                    </div>

                    <!-- Bouton de connexion -->
                    <div class="mt-8">
                        <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-green-600 to-yellow-500 hover:from-green-700 hover:to-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Se connecter
                        </button>
                    </div>
                </form>

                <!-- Comptes de test -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <p class="text-center text-sm text-gray-600 mb-4">Comptes de test disponibles :</p>
                    <div class="grid grid-cols-1 gap-2 text-xs">
                        <div class="p-3 bg-green-50 rounded-lg">
                            <p class="font-medium text-green-800">DFC/AMG :</p>
                            <p class="text-green-700">j.bernard@transurb.com (Directeur DFC)</p>
                            <p class="text-green-700">m.dubois@transurb.com (Chef AMG)</p>
                            <p class="text-green-700">p.martin@transurb.com (Agent AMG)</p>
                        </div>
                        <div class="p-3 bg-yellow-50 rounded-lg">
                            <p class="font-medium text-yellow-800">DEX :</p>
                            <p class="text-yellow-700">c.rousseau@transurb.com (Directeur DEX)</p>
                            <p class="text-yellow-700">a.moreau@transurb.com (Chef Maintenance)</p>
                            <p class="text-yellow-700">s.leroy@transurb.com (Chef Logistique)</p>
                        </div>
                        <div class="p-3 bg-orange-50 rounded-lg">
                            <p class="font-medium text-orange-800">Terrain :</p>
                            <p class="text-orange-700">a.hassan@transurb.com (Mécanicien)</p>
                            <p class="text-orange-700">m.benali@transurb.com (Chauffeur)</p>
                        </div>
                        <p class="text-center text-gray-500 mt-2">Mot de passe : <strong>password</strong></p>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center mt-8">
                <p class="text-sm text-gray-500">
                    © 2024 Trans'urb - Société de Transport en Commun
                </p>
            </div>
        </div>
    </div>
</body>

</html>
