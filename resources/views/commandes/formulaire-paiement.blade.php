<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GMAO Trans'urb - Paiement {{ $commande->reference }}</title>
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
            max-width: 800px;
            margin: 0 auto;
            margin-top: -60px;
            margin-bottom: 2.5rem;
            z-index: 20;
            position: relative;
        }
        .btn-primary {
            background: #1e5c4a;
            color: #fff;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: background 0.2s;
            border: none;
            cursor: pointer;
        }
        .btn-primary:hover {
            background: #17423b;
        }
        .btn-secondary {
            background: #6b7280;
            color: #fff;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: background 0.2s;
        }
        .btn-secondary:hover {
            background: #4b5563;
        }
        .content-card {
            background: #fff;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 2px 12px rgba(23,66,59,0.08);
            margin-bottom: 2rem;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }
        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.2s;
        }
        .form-input:focus {
            outline: none;
            border-color: #1e5c4a;
            box-shadow: 0 0 0 3px rgba(30, 92, 74, 0.1);
        }
        .form-textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 1rem;
            min-height: 100px;
            resize: vertical;
            transition: border-color 0.2s;
        }
        .form-textarea:focus {
            outline: none;
            border-color: #1e5c4a;
            box-shadow: 0 0 0 3px rgba(30, 92, 74, 0.1);
        }
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        .info-item {
            background: #f8fafc;
            padding: 1rem;
            border-radius: 8px;
            border-left: 4px solid #1e5c4a;
        }
        .info-label {
            font-size: 0.875rem;
            color: #6b7280;
            font-weight: 500;
        }
        .info-value {
            font-size: 1.125rem;
            font-weight: 600;
            color: #17423b;
            margin-top: 0.25rem;
        }
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }
        .status-impaye {
            background: #fee2e2;
            color: #dc2626;
        }
        .status-redevance {
            background: #fef3c7;
            color: #d97706;
        }
        .status-echu {
            background: #dcfce7;
            color: #16a34a;
        }
        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
        .alert-warning {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fed7aa;
        }
    </style>
</head>
<body>
    <div class="header-bg">
        <nav class="main-navbar">
            <span class="text-xl font-bold tracking-wide">Trans'urb GMAO</span>
            <div class="profile-box">
                <i class="fas fa-user-circle text-lg"></i>
                <span>Admin</span>
            </div>
        </nav>
        <div class="welcome-banner">
            <div>
                <div class="greeting">Paiement - {{ $commande->reference }}</div>
                <div class="subtitle">Enregistrement d'un paiement</div>
            </div>
            <div class="flex gap-4">
                <a href="{{ route('commandes.paiements') }}" class="nav-link">
                    <i class="fas fa-arrow-left mr-2"></i>Retour
                </a>
            </div>
        </div>
    </div>

    <div class="main-content">
        @if($errors->any())
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Informations de la commande -->
        <div class="content-card">
            <h2 class="text-xl font-bold text-gray-900 mb-6">
                <i class="fas fa-info-circle mr-2 text-blue-600"></i>Informations de la commande
            </h2>
            
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Référence</div>
                    <div class="info-value">{{ $commande->reference }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Fournisseur</div>
                    <div class="info-value">{{ $commande->fournisseur->nom ?? 'N/A' }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Date de commande</div>
                    <div class="info-value">{{ $commande->date_commande->format('d/m/Y') }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Statut</div>
                    <div class="info-value">
                        <span class="status-badge status-{{ $commande->statut }}">
                            {{ $commande->statut_label }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Montant total</div>
                    <div class="info-value">{{ number_format($commande->montant_total, 0, ',', ' ') }} FCFA</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Montant à payer</div>
                    <div class="info-value">{{ number_format($commande->montant_a_payer, 0, ',', ' ') }} FCFA</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Avance déjà versée</div>
                    <div class="info-value">{{ number_format($commande->avance, 0, ',', ' ') }} FCFA</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Reste à payer</div>
                    <div class="info-value">{{ number_format($commande->reste_a_payer, 0, ',', ' ') }} FCFA</div>
                </div>
            </div>

            <div class="info-item">
                <div class="info-label">Statut de paiement actuel</div>
                <div class="info-value">
                    <span class="status-badge status-{{ $commande->statut_paiement }}">
                        {{ $commande->statut_paiement_label }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Formulaire de paiement -->
        <div class="content-card">
            <h2 class="text-xl font-bold text-gray-900 mb-6">
                <i class="fas fa-credit-card mr-2 text-green-600"></i>Nouveau paiement
            </h2>

            @if($commande->reste_a_payer <= 0)
                <div class="alert alert-warning">
                    <i class="fas fa-check-circle mr-2"></i>
                    Cette commande est entièrement payée. Aucun paiement supplémentaire n'est nécessaire.
                </div>
            @else
                <form action="{{ route('commande.traiterPaiement', $commande) }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label for="montant" class="form-label">
                            Montant du paiement <span class="text-red-500">*</span>
                        </label>
                        <input type="number" 
                               id="montant" 
                               name="montant" 
                               class="form-input" 
                               step="0.01" 
                               min="0.01" 
                               max="{{ $commande->reste_a_payer }}"
                               value="{{ old('montant') }}"
                               required>
                        <div class="text-sm text-gray-500 mt-1">
                            Montant maximum autorisé : {{ number_format($commande->reste_a_payer, 0, ',', ' ') }} FCFA
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="commentaire" class="form-label">Commentaire (optionnel)</label>
                        <textarea id="commentaire" 
                                  name="commentaire" 
                                  class="form-textarea" 
                                  placeholder="Ex: Paiement partiel, acompte, etc.">{{ old('commentaire') }}</textarea>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="btn-primary">
                            <i class="fas fa-save mr-2"></i>Enregistrer le paiement
                        </button>
                        <a href="{{ route('commandes.paiements') }}" class="btn-secondary">
                            <i class="fas fa-times mr-2"></i>Annuler
                        </a>
                    </div>
                </form>
            @endif
        </div>

        <!-- Historique des paiements -->
        @if($commande->commentaires_paiement)
            <div class="content-card">
                <h2 class="text-xl font-bold text-gray-900 mb-6">
                    <i class="fas fa-history mr-2 text-purple-600"></i>Historique des paiements
                </h2>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <pre class="whitespace-pre-wrap text-sm text-gray-700">{{ $commande->commentaires_paiement }}</pre>
                </div>
            </div>
        @endif
    </div>
</body>
</html> 