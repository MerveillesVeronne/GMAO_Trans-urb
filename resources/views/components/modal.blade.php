@props(['id', 'title', 'type' => 'info'])

@php
    $colors = [
        'success' => [
            'bg' => 'bg-green-50',
            'border' => 'border-green-200',
            'icon' => 'fas fa-check-circle text-green-500',
            'title' => 'text-green-900',
            'button' => 'bg-green-600 hover:bg-green-700 focus:ring-green-300'
        ],
        'error' => [
            'bg' => 'bg-red-50',
            'border' => 'border-red-200',
            'icon' => 'fas fa-exclamation-circle text-red-500',
            'title' => 'text-red-900',
            'button' => 'bg-red-600 hover:bg-red-700 focus:ring-red-300'
        ],
        'warning' => [
            'bg' => 'bg-yellow-50',
            'border' => 'border-yellow-200',
            'icon' => 'fas fa-exclamation-triangle text-yellow-500',
            'title' => 'text-yellow-900',
            'button' => 'bg-yellow-600 hover:bg-yellow-700 focus:ring-yellow-300'
        ],
        'info' => [
            'bg' => 'bg-blue-50',
            'border' => 'border-blue-200',
            'icon' => 'fas fa-info-circle text-blue-500',
            'title' => 'text-blue-900',
            'button' => 'bg-blue-600 hover:bg-blue-700 focus:ring-blue-300'
        ],
        'confirm' => [
            'bg' => 'bg-orange-50',
            'border' => 'border-orange-200',
            'icon' => 'fas fa-question-circle text-orange-500',
            'title' => 'text-orange-900',
            'button' => 'bg-orange-600 hover:bg-orange-700 focus:ring-orange-300'
        ]
    ];
    
    $colorScheme = $colors[$type] ?? $colors['info'];
@endphp

<div id="{{ $id }}" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 {{ $colorScheme['border'] }} border-2">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="flex-shrink-0">
                        <i class="{{ $colorScheme['icon'] }} text-2xl"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-lg font-medium {{ $colorScheme['title'] }}">{{ $title }}</h3>
                    </div>
                </div>
                <div class="mb-6">
                    <p class="text-sm text-gray-600" id="{{ $id }}-message">{{ $slot }}</p>
                </div>
                <div class="flex justify-end space-x-3">
                    @if($type === 'confirm')
                        <button id="{{ $id }}-cancel" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors duration-200">
                            Annuler
                        </button>
                    @endif
                    <button id="{{ $id }}-confirm" class="px-4 py-2 {{ $colorScheme['button'] }} text-white rounded-md focus:outline-none focus:ring-2 transition-colors duration-200">
                        {{ $type === 'confirm' ? 'Confirmer' : 'OK' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showModal(id, title, message, type = 'info', onConfirm = null, onCancel = null) {
    const modal = document.getElementById(id);
    const titleElement = modal.querySelector('h3');
    const messageElement = document.getElementById(id + '-message');
    const confirmButton = document.getElementById(id + '-confirm');
    const cancelButton = document.getElementById(id + '-cancel');
    
    titleElement.textContent = title;
    messageElement.textContent = message;
    
    // Gérer les événements
    confirmButton.onclick = function() {
        hideModal(id);
        if (onConfirm) onConfirm();
    };
    
    if (cancelButton) {
        cancelButton.onclick = function() {
            hideModal(id);
            if (onCancel) onCancel();
        };
    }
    
    // Fermer en cliquant à l'extérieur
    modal.onclick = function(e) {
        if (e.target === modal) {
            hideModal(id);
            if (onCancel) onCancel();
        }
    };
    
    modal.classList.remove('hidden');
}

function hideModal(id) {
    document.getElementById(id).classList.add('hidden');
}

// Fonctions utilitaires
function showSuccessModal(id, title, message, onConfirm = null) {
    showModal(id, title, message, 'success', onConfirm);
}

function showErrorModal(id, title, message, onConfirm = null) {
    showModal(id, title, message, 'error', onConfirm);
}

function showWarningModal(id, title, message, onConfirm = null) {
    showModal(id, title, message, 'warning', onConfirm);
}

function showInfoModal(id, title, message, onConfirm = null) {
    showModal(id, title, message, 'info', onConfirm);
}

function showConfirmModal(id, title, message, onConfirm = null, onCancel = null) {
    showModal(id, title, message, 'confirm', onConfirm, onCancel);
}
</script>







