<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Détails de la Transaction</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700&display=swap" rel="stylesheet" />
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f5f5f5; margin: 0; }
        .header-bg { background: #17423b; color: #fff; padding-bottom: 90px; position: relative; box-shadow: 0 2px 8px rgba(23,66,59,0.08); }
        .main-navbar { display: flex; align-items: center; justify-content: space-between; padding: 0 2.5rem; height: 64px; }
        .main-navbar .nav-link { color: #e6f4ee; font-weight: 500; border-radius: 8px; padding: 0.5rem 1.2rem; transition: background 0.2s, color 0.2s; }
        .main-navbar .nav-link.active, .main-navbar .nav-link:hover { background: #1e5c4a; color: #fff; }
        .main-navbar .profile-box { background: #1e5c4a; border-radius: 12px; padding: 0.5rem 1rem; display: flex; align-items: center; gap: 0.7rem; }
        .main-navbar .profile-box .fa-user-circle { font-size: 1.7rem; color: #ffe082; }
        .welcome-banner { display: flex; align-items: center; justify-content: space-between; padding: 2.2rem 2.5rem 1.2rem 2.5rem; }
        .welcome-banner .greeting { font-size: 1.5rem; font-weight: 600; }
        .welcome-banner .subtitle { font-size: 1rem; color: #c8e6d6; }
        .container { max-width: 1400px; margin: 40px auto; background: #fff; border-radius: 18px; box-shadow: 0 2px 12px rgba(0,0,0,0.1); padding: 2.5rem; position: relative; z-index: 10; }
        
        /* Styles pour les cartes d'information */
        .info-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
        .info-card { background: linear-gradient(135deg, #f8f9fa, #e9ecef); padding: 1.5rem; border-radius: 12px; border-left: 4px solid #28a745; }
        .info-label { color: #666; font-size: 0.9rem; font-weight: 500; margin-bottom: 0.5rem; }
        .info-value { font-size: 1.2rem; font-weight: 700; color: #17423b; }
        
        /* Styles pour les sections */
        .section { margin-bottom: 2rem; }
        .section-title { font-size: 1.3rem; font-weight: 600; color: #17423b; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem; }
        
        /* Badges et étiquettes */
        .badge { padding: 0.4rem 0.8rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600; display: inline-block; }
        .badge-success { background: #d4edda; color: #155724; }
        .badge-warning { background: #fff3cd; color: #856404; }
        .badge-danger { background: #f8d7da; color: #721c24; }
        .badge-info { background: #d1ecf1; color: #0c5460; }
        
        /* Boutons */
        .btn { padding: 0.75rem 1.5rem; border-radius: 8px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.2s; border: none; cursor: pointer; }
        .btn-primary { background: linear-gradient(135deg, #28a745, #20c997); color: white; }
        .btn-primary:hover { background: linear-gradient(135deg, #218838, #1ea085); }
        .btn-secondary { background: #6c757d; color: white; }
        .btn-secondary:hover { background: #5a6268; }
        
        /* Actions */
        .actions { display: flex; gap: 1rem; margin-bottom: 2rem; }
        
        /* Mode de paiement */
        .mode-badge { display: inline-block; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.8rem; font-weight: 600; }
        .mode-especes { background: #d4edda; color: #155724; }
        .mode-cheque { background: #d1ecf1; color: #0c5460; }
        .mode-virement { background: #e2d9f3; color: #6f42c1; }
        .mode-carte { background: #fff3cd; color: #856404; }
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
                <div class="greeting">Détails de la Transaction</div>
                <div class="subtitle" style="color: #ffe082;">{{ $type == 'commande' ? 'Paiement de Commande' : 'Paiement de Contrat' }}</div>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-receipt" style="font-size: 2.5rem; color: #ffe082;"></i>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Actions -->
        <div class="actions">
            <a href="{{ route('transactions.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>Retour aux Transactions
            </a>
            @if($type == 'commande')
                <a href="{{ route('commande.details', $transaction->commande) }}" class="btn btn-primary">
                    <i class="fas fa-eye mr-2"></i>Voir la Commande
                </a>
            @else
                <a href="{{ route('contrat.details', $transaction->contrat) }}" class="btn btn-primary">
                    <i class="fas fa-eye mr-2"></i>Voir le Contrat
                </a>
            @endif
        </div>

        <!-- Informations de la transaction -->
        <div class="section">
            <div class="section-title">
                <i class="fas fa-info-circle"></i>
                Informations de la Transaction
            </div>
            <div class="info-grid">
                <div class="info-card">
                    <div class="info-label">Type de Transaction</div>
                    <div class="info-value">
                        @if($type == 'commande')
                            <span class="badge badge-info">Paiement de Commande</span>
                        @else
                            <span class="badge badge-success">Paiement de Contrat</span>
                        @endif
                    </div>
                </div>
                <div class="info-card">
                    <div class="info-label">Montant</div>
                    <div class="info-value" style="color: #28a745; font-size: 1.5rem;">
                        {{ number_format($transaction->montant, 0, ',', ' ') }} F CFA
                    </div>
                </div>
                <div class="info-card">
                    <div class="info-label">Mode de Paiement</div>
                    <div class="info-value">
                        <span class="mode-badge mode-{{ $transaction->mode_paiement }}">
                            {{ $transaction->mode_paiement_label }}
                        </span>
                    </div>
                </div>
                <div class="info-card">
                    <div class="info-label">Date de Paiement</div>
                    <div class="info-value">{{ $transaction->date_paiement->format('d/m/Y H:i') }}</div>
                </div>
            </div>
        </div>

        <!-- Détails du paiement -->
        <div class="section">
            <div class="section-title">
                <i class="fas fa-credit-card"></i>
                Détails du Paiement
            </div>
            <div class="info-grid">
                @if($transaction->reference_paiement)
                    <div class="info-card">
                        <div class="info-label">Référence du Paiement</div>
                        <div class="info-value">{{ $transaction->reference_paiement }}</div>
                    </div>
                @endif
                <div class="info-card">
                    <div class="info-label">Utilisateur</div>
                    <div class="info-value">{{ $transaction->user->nom_complet ?? 'Utilisateur' }}</div>
                </div>
                @if($transaction->commentaire)
                    <div class="info-card" style="grid-column: span 2;">
                        <div class="info-label">Commentaire</div>
                        <div class="info-value">{{ $transaction->commentaire }}</div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Informations liées -->
        <div class="section">
            <div class="section-title">
                <i class="fas fa-link"></i>
                Informations Liées
            </div>
            @if($type == 'commande')
                <div class="info-grid">
                    <div class="info-card">
                        <div class="info-label">Référence de la Commande</div>
                        <div class="info-value">{{ $transaction->commande->reference }}</div>
                    </div>
                    <div class="info-card">
                        <div class="info-label">Fournisseur</div>
                        <div class="info-value">{{ $transaction->commande->fournisseur->nom }}</div>
                    </div>
                    <div class="info-card">
                        <div class="info-label">Date de la Commande</div>
                        <div class="info-value">{{ $transaction->commande->date_commande->format('d/m/Y') }}</div>
                    </div>
                    <div class="info-card">
                        <div class="info-label">Montant Total de la Commande</div>
                        <div class="info-value">{{ number_format($transaction->commande->montant_total, 0, ',', ' ') }} F CFA</div>
                    </div>
                </div>
            @else
                <div class="info-grid">
                    <div class="info-card">
                        <div class="info-label">Référence du Contrat</div>
                        <div class="info-value">{{ $transaction->contrat->reference }}</div>
                    </div>
                    <div class="info-card">
                        <div class="info-label">Fournisseur</div>
                        <div class="info-value">{{ $transaction->contrat->fournisseur->nom }}</div>
                    </div>
                    <div class="info-card">
                        <div class="info-label">Date de Début</div>
                        <div class="info-value">{{ $transaction->contrat->date_debut->format('d/m/Y') }}</div>
                    </div>
                    <div class="info-card">
                        <div class="info-label">Date de Fin</div>
                        <div class="info-value">{{ $transaction->contrat->date_fin->format('d/m/Y') }}</div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Statistiques du paiement -->
        <div class="section">
            <div class="section-title">
                <i class="fas fa-chart-bar"></i>
                Impact du Paiement
            </div>
            @if($type == 'commande')
                @php
                    $commande = $transaction->commande;
                    $pourcentagePaye = $commande->montant_total > 0 ? ($commande->avance / $commande->montant_total) * 100 : 0;
                @endphp
                <div class="info-grid">
                    <div class="info-card">
                        <div class="info-label">Montant Total de la Commande</div>
                        <div class="info-value">{{ number_format($commande->montant_total, 0, ',', ' ') }} F CFA</div>
                    </div>
                    <div class="info-card">
                        <div class="info-label">Total Payé</div>
                        <div class="info-value" style="color: #28a745;">{{ number_format($commande->avance, 0, ',', ' ') }} F CFA</div>
                    </div>
                    <div class="info-card">
                        <div class="info-label">Reste à Payer</div>
                        <div class="info-value" style="color: #dc3545;">{{ number_format($commande->reste_a_payer, 0, ',', ' ') }} F CFA</div>
                    </div>
                    <div class="info-card">
                        <div class="info-label">Pourcentage Payé</div>
                        <div class="info-value">{{ number_format($pourcentagePaye, 1) }}%</div>
                    </div>
                </div>
            @else
                @php
                    $contrat = $transaction->contrat;
                    $totalPaye = $contrat->paiements->sum('montant');
                    $pourcentagePaye = $contrat->montant_total > 0 ? ($totalPaye / $contrat->montant_total) * 100 : 0;
                @endphp
                <div class="info-grid">
                    <div class="info-card">
                        <div class="info-label">Montant Total du Contrat</div>
                        <div class="info-value">{{ number_format($contrat->montant_total, 0, ',', ' ') }} F CFA</div>
                    </div>
                    <div class="info-card">
                        <div class="info-label">Total Payé</div>
                        <div class="info-value" style="color: #28a745;">{{ number_format($totalPaye, 0, ',', ' ') }} F CFA</div>
                    </div>
                    <div class="info-card">
                        <div class="info-label">Reste à Payer</div>
                        <div class="info-value" style="color: #dc3545;">{{ number_format($contrat->montant_total - $totalPaye, 0, ',', ' ') }} F CFA</div>
                    </div>
                    <div class="info-card">
                        <div class="info-label">Pourcentage Payé</div>
                        <div class="info-value">{{ number_format($pourcentagePaye, 1) }}%</div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</body>
</html> 