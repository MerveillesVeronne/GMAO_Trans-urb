@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Historique des sorties - {{ $stock->produit }}</h1>
        <p class="text-gray-600">Référence: {{ $stock->reference_unique }}</p>
    </div>

    <!-- Informations du stock -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Informations du stock</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Produit</label>
                <p class="mt-1 text-sm text-gray-900">{{ $stock->produit }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Quantité actuelle</label>
                <p class="mt-1 text-sm text-gray-900">{{ $stock->quantite }} {{ $stock->unite }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Seuil d'alerte</label>
                <p class="mt-1 text-sm text-gray-900">{{ $stock->seuil_alerte }} {{ $stock->unite }}</p>
            </div>
        </div>
    </div>

    <!-- Historique des sorties -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Historique des sorties</h2>
        </div>

        @if($sorties->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date de sortie
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Quantité sortie
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Service destinataire
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Personne destinataire
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Poste
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Coût total
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Statut
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($sorties as $sortie)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $sortie->date_sortie->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $sortie->quantite_sortie }} {{ $stock->unite }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $sortie->service_destinataire }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $sortie->personne_destinataire }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $sortie->poste_destinataire }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ number_format($sortie->cout_total, 0, ',', ' ') }} FCFA
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                        {{ $sortie->statut === 'validee' ? 'bg-green-100 text-green-800' : 
                                           ($sortie->statut === 'annulee' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        {{ ucfirst($sortie->statut) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    @if($sortie->statut === 'validee')
                                        <button onclick="annulerSortie({{ $sortie->id }})" 
                                                class="text-red-600 hover:text-red-900">
                                            Annuler
                                        </button>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $sorties->links() }}
            </div>
        @else
            <div class="px-6 py-8 text-center">
                <p class="text-gray-500">Aucune sortie enregistrée pour ce produit.</p>
            </div>
        @endif
    </div>

    <!-- Boutons d'action -->
    <div class="mt-6 flex space-x-4">
        <a href="{{ route('stocks.sorties.create') }}" 
           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
            <i class="fas fa-plus mr-2"></i>
            Nouvelle sortie
        </a>
        <a href="{{ route('stocks.sorties.index') }}" 
           class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
            <i class="fas fa-list mr-2"></i>
            Toutes les sorties
        </a>
        <a href="{{ route('stocks.index') }}" 
           class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
            <i class="fas fa-arrow-left mr-2"></i>
            Retour aux stocks
        </a>
    </div>
</div>

<!-- Modal de confirmation d'annulation -->
<div id="modalAnnulation" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <i class="fas fa-exclamation-triangle text-red-600"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mt-4">Confirmer l'annulation</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">
                    Êtes-vous sûr de vouloir annuler cette sortie ? Cette action ne peut pas être annulée.
                </p>
            </div>
            <div class="flex justify-center space-x-4 mt-4">
                <button onclick="fermerModalAnnulation()" 
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                    Annuler
                </button>
                <button onclick="confirmerAnnulation()" 
                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                    Confirmer
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let sortieIdAAAnnuler = null;

function annulerSortie(sortieId) {
    sortieIdAAAnnuler = sortieId;
    document.getElementById('modalAnnulation').classList.remove('hidden');
}

function fermerModalAnnulation() {
    document.getElementById('modalAnnulation').classList.add('hidden');
    sortieIdAAAnnuler = null;
}

function confirmerAnnulation() {
    if (sortieIdAAAnnuler) {
        fetch(`/stocks/sorties/${sortieIdAAAnnuler}/annuler`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Erreur lors de l\'annulation : ' + data.message);
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Erreur lors de l\'annulation');
        });
    }
    fermerModalAnnulation();
}

// Fermer le modal en cliquant à l'extérieur
document.getElementById('modalAnnulation').addEventListener('click', function(e) {
    if (e.target === this) {
        fermerModalAnnulation();
    }
});
</script>
@endsection 