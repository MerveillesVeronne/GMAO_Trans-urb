<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GMAO Trans'urb - Détails Sortie de Stock</title>
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
        .content-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(23,66,59,0.13);
            padding: 2.5rem;
            margin-bottom: 2rem;
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
            display: inline-block;
        }
        .btn-primary:hover {
            background: #17423b;
        }
        .btn-secondary {
            background: #6b7280;
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-secondary:hover {
            background: #4b5563;
        }
        .btn-danger {
            background: #ef4444;
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-danger:hover {
            background: #dc2626;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: 600;
            color: #374151;
        }
        .detail-value {
            color: #1f2937;
        }
        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.875rem;
        }
        .status-validee {
            background: #d1fae5;
            color: #065f46;
        }
        .status-annulee {
            background: #fee2e2;
            color: #991b1b;
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
                <div class="greeting">Détails Sortie de Stock</div>
                <div class="subtitle">Informations détaillées de la sortie</div>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-file-alt" style="font-size: 2.5rem; color: #ffe082;"></i>
            </div>
        </div>
    </div>

    <div class="main-content">
        <div class="content-card">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Sortie #{{ $sortie->id }}</h2>
                <div class="flex gap-3">
                    <a href="{{ route('stocks.sorties.index') }}" class="btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i>Retour à l'historique
                    </a>
                    @if($sortie->peutEtreAnnulee())
                        <form action="{{ route('stocks.sorties.annuler', $sortie) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette sortie ? Le stock sera remis à jour.')">
                            @csrf
                            <button type="submit" class="btn-danger">
                                <i class="fas fa-undo mr-2"></i>Annuler la sortie
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <!-- Informations de la sortie -->
            <div class="space-y-4">
                <div class="detail-row">
                    <span class="detail-label">Produit :</span>
                    <span class="detail-value font-semibold">{{ $sortie->reference_produit }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Quantité sortie :</span>
                    <span class="detail-value font-semibold">{{ $sortie->quantite_sortie }} {{ $sortie->unite }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Coût unitaire :</span>
                    <span class="detail-value">{{ number_format($sortie->cout_unitaire, 0, ',', ' ') }} FCFA</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Coût total :</span>
                    <span class="detail-value font-semibold text-lg">{{ number_format($sortie->cout_total, 0, ',', ' ') }} FCFA</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Service destinataire :</span>
                    <span class="detail-value">{{ $sortie->service_destinataire }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Personne destinataire :</span>
                    <span class="detail-value font-semibold">{{ $sortie->personne_destinataire }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Poste :</span>
                    <span class="detail-value">{{ $sortie->poste_destinataire }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Motif de sortie :</span>
                    <span class="detail-value">{{ $sortie->motif_sortie }}</span>
                </div>

                @if($sortie->commentaires)
                    <div class="detail-row">
                        <span class="detail-label">Commentaires :</span>
                        <span class="detail-value">{{ $sortie->commentaires }}</span>
                    </div>
                @endif

                <div class="detail-row">
                    <span class="detail-label">Statut :</span>
                    <span class="status-badge status-{{ $sortie->statut }}">
                        {{ $sortie->statut_label }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Validé par :</span>
                    <span class="detail-value">{{ $sortie->validePar->nom_complet ?? 'Utilisateur' }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Date de validation :</span>
                    <span class="detail-value">{{ $sortie->valide_le ? $sortie->valide_le->format('d/m/Y H:i') : 'N/A' }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Date de création :</span>
                    <span class="detail-value">{{ $sortie->created_at->format('d/m/Y H:i') }}</span>
                </div>

                @if($sortie->updated_at != $sortie->created_at)
                    <div class="detail-row">
                        <span class="detail-label">Dernière modification :</span>
                        <span class="detail-value">{{ $sortie->updated_at->format('d/m/Y H:i') }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html> 