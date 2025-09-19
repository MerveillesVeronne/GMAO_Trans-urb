@extends('layouts.app')
@section('title', "GMAO Trans'urb - Détails Carburation")
@section('content')
    <header class="bg-green-900 shadow-xl mb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center gap-4">
            <div class="h-10 w-10 bg-white rounded-full flex items-center justify-center shadow">
                <i class="fas fa-gas-pump text-green-800 text-xl"></i>
            </div>
            <span class="text-2xl font-bold tracking-wide text-white">Trans'urb GMAO - Détails Carburation</span>
        </div>
    </header>

    <div class="max-w-7xl mx-auto">
        <!-- Bouton retour -->
        <div class="mb-6">
            <a href="{{ route('maintenance.carburations.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>
                Retour à la liste
            </a>
        </div>

        <!-- Informations de la carburation -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-green-900">
                    <i class="fas fa-info-circle text-green-700 mr-2"></i>
                    Détails de la Carburation
                </h3>
                <div class="flex space-x-2">
                    <a href="{{ route('maintenance.carburations.export.pdf', $carburation->id) }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200">
                        <i class="fas fa-file-pdf"></i>
                        Exporter PDF
                    </a>
                    <a href="{{ route('maintenance.carburations.edit', $carburation->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200">
                        <i class="fas fa-edit"></i>
                        Modifier
                    </a>
                </div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Véhicule</label>
                        <div class="flex items-center">
                            <div class="h-8 w-8 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-bus text-white text-sm"></i>
                            </div>
                            <div>
                                <p class="text-lg font-semibold text-green-900">{{ $carburation->vehicule->numero }}</p>
                                <p class="text-sm text-green-700">{{ $carburation->vehicule->immatriculation }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Chauffeur</label>
                        <p class="text-lg font-semibold text-green-900">{{ $carburation->chauffeur->nom }} {{ $carburation->chauffeur->prenom }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date de carburation</label>
                        <p class="text-lg font-semibold text-green-900">{{ $carburation->date_carburation->format('d/m/Y') }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Heure de carburation</label>
                        <p class="text-lg font-semibold text-green-900">{{ $carburation->heure_carburation->format('H:i') }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Type de carburant</label>
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full 
                            @if($carburation->type_carburation === 'Diesel') bg-blue-100 text-blue-800
                            @elseif($carburation->type_carburation === 'Essence') bg-yellow-100 text-yellow-800
                            @elseif($carburation->type_carburation === 'GPL') bg-purple-100 text-purple-800
                            @else bg-green-100 text-green-800
                            @endif">
                            {{ $carburation->type_carburation }}
                        </span>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">État</label>
                        @php
                            $statusColors = [
                                'Planifiée' => 'bg-yellow-200 text-yellow-900',
                                'Effectuée' => 'bg-green-200 text-green-900',
                                'Annulée' => 'bg-red-200 text-red-900'
                            ];
                            $statusColor = $statusColors[$carburation->etat] ?? 'bg-gray-200 text-gray-900';
                        @endphp
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full {{ $statusColor }}">
                            {{ $carburation->etat }}
                        </span>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Quantité (litres)</label>
                        <p class="text-lg font-semibold text-green-900">{{ number_format($carburation->quantite_litres, 2, ',', ' ') }} L</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Prix par litre</label>
                        <p class="text-lg font-semibold text-green-900">{{ number_format($carburation->prix_litre, 0, ',', ' ') }} FCFA</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Coût total</label>
                        <p class="text-2xl font-bold text-green-600">{{ number_format($carburation->cout_total, 0, ',', ' ') }} FCFA</p>
                    </div>
                </div>
                
                @if($carburation->notes)
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                        <p class="text-gray-900 bg-gray-50 p-4 rounded-lg">{{ $carburation->notes }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Actions -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-green-900">
                    <i class="fas fa-cogs text-green-700 mr-2"></i>
                    Actions
                </h3>
            </div>
            <div class="p-6">
                <div class="flex gap-3">
                    <a href="{{ route('maintenance.carburations.edit', $carburation->id) }}" 
                       class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200">
                        <i class="fas fa-edit"></i>
                        Modifier
                    </a>
                    
                    <a href="{{ route('maintenance.vehicules.show', $carburation->vehicule->id) }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200">
                        <i class="fas fa-bus"></i>
                        Voir le véhicule
                    </a>
                    
                    <button onclick="deleteCarburation({{ $carburation->id }})" 
                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200">
                        <i class="fas fa-trash"></i>
                        Supprimer
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteCarburation(id) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cette carburation ?')) {
                fetch(`/maintenance/carburations/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = '{{ route("maintenance.carburations.index") }}';
                    } else {
                        alert('Erreur lors de la suppression');
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    alert('Erreur lors de la suppression');
                });
            }
        }
    </script>
@endsection
