@extends('layouts.app')

@section('title', "GMAO Trans'urb - Bons de Commande Logistique")

@section('content')
    <header class="bg-green-900 shadow-xl mb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center gap-4">
            <div class="h-10 w-10 bg-white rounded-full flex items-center justify-center shadow">
                <i class="fas fa-file-invoice text-green-800 text-xl"></i>
            </div>
            <span class="text-2xl font-bold tracking-wide text-white">Trans'urb GMAO - Bons de Commande</span>
        </div>
    </header>

    <!-- Statistiques -->
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center border-l-4 border-green-700">
            <span class="text-green-900 font-bold text-2xl">{{ $stats['total'] }}</span>
            <span class="text-green-800 mt-2">Total</span>
        </div>
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center border-l-4 border-yellow-500">
            <span class="text-green-900 font-bold text-2xl">{{ $stats['en_attente'] }}</span>
            <span class="text-green-800 mt-2">En Attente</span>
        </div>
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center border-l-4 border-blue-500">
            <span class="text-green-900 font-bold text-2xl">{{ $stats['signe'] }}</span>
            <span class="text-green-800 mt-2">Signés</span>
        </div>
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center border-l-4 border-green-500">
            <span class="text-green-900 font-bold text-2xl">{{ $stats['approuve'] }}</span>
            <span class="text-green-800 mt-2">Approuvés</span>
        </div>
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center border-l-4 border-orange-500">
            <span class="text-green-900 font-bold text-2xl">{{ $stats['en_cours'] }}</span>
            <span class="text-green-800 mt-2">En Cours</span>
        </div>
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center border-l-4 border-gray-500">
            <span class="text-green-900 font-bold text-2xl">{{ $stats['termine'] }}</span>
            <span class="text-green-800 mt-2">Terminés</span>
        </div>
    </div>

    <!-- Liste des bons de commande -->
    <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-green-900">
                <i class="fas fa-list text-green-700 mr-2"></i>
                Bons de Commande de Maintenance
            </h3>
            <a href="{{ route('logistique.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200">
                <i class="fas fa-arrow-left"></i>
                Retour
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-green-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Référence</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Véhicule</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Intervention</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Statut</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-green-100">
                    @forelse($bons_commande as $bon)
                        <tr class="hover:bg-green-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $bon->reference }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $bon->vehicule->numero ?? 'N/A' }}</div>
                                <div class="text-sm text-gray-500">{{ $bon->vehicule->marque ?? '' }} {{ $bon->vehicule->modele ?? '' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $bon->intervention->type_intervention ?? 'N/A' }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit($bon->intervention->description ?? '', 50) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $bon->created_at->format('d/m/Y') }}</div>
                                <div class="text-sm text-gray-500">{{ $bon->created_at->format('H:i') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-{{ $bon->statut_color }}-100 text-{{ $bon->statut_color }}-800">
                                    {{ $bon->statut_label }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('logistique.bons-commande.show', $bon) }}" 
                                   class="text-green-600 hover:text-green-900 mr-3">
                                    <i class="fas fa-eye"></i> Voir
                                </a>
                                @if($bon->signataire_1_id && !$bon->signataire_2_id)
                                    <button onclick="openSignatureModal({{ $bon->id }})" 
                                            class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-signature"></i> Signer
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <i class="fas fa-file-invoice text-4xl mb-4 text-gray-400"></i>
                                <p>Aucun bon de commande trouvé</p>
                                <p class="text-sm">Les bons de commande créés par la maintenance apparaîtront ici</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal de signature -->
    <div id="signatureModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Signature du Bon de Commande</h3>
                </div>
                <form id="signatureForm" method="POST">
                    @csrf
                    <div class="px-6 py-4">
                        <div class="mb-4">
                            <label for="signature_fonction" class="block text-sm font-medium text-gray-700 mb-2">
                                Fonction du signataire
                            </label>
                            <input type="text" id="signature_fonction" name="signature_fonction" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                                   placeholder="Chef de Service Logistique" required>
                        </div>
                        <div class="mb-4">
                            <label for="commentaires" class="block text-sm font-medium text-gray-700 mb-2">
                                Commentaires (optionnel)
                            </label>
                            <textarea id="commentaires" name="commentaires" rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                                      placeholder="Commentaires sur la validation..."></textarea>
                        </div>
                    </div>
                    <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                        <button type="button" onclick="closeSignatureModal()" 
                                class="px-4 py-2 text-gray-600 hover:text-gray-800 transition-colors">
                            Annuler
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                            <i class="fas fa-signature mr-2"></i>Signer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openSignatureModal(bonId) {
            document.getElementById('signatureForm').action = `/logistique/bons-commande/${bonId}/signer-logistique`;
            document.getElementById('signatureModal').classList.remove('hidden');
        }

        function closeSignatureModal() {
            document.getElementById('signatureModal').classList.add('hidden');
        }
    </script>
@endsection
