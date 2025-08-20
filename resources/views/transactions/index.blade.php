<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Historique des Transactions</title>
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
        
        /* Styles pour les statistiques */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
        .stat-card { background: linear-gradient(135deg, #f8f9fa, #e9ecef); padding: 1.5rem; border-radius: 12px; text-align: center; border-left: 4px solid #28a745; }
        .stat-value { font-size: 2rem; font-weight: 700; color: #17423b; margin-bottom: 0.5rem; }
        .stat-label { color: #666; font-size: 0.9rem; font-weight: 500; }
        
        /* Styles pour les filtres */
        .filters-section { background: #f8f9fa; padding: 1.5rem; border-radius: 12px; margin-bottom: 2rem; }
        .filters-title { font-size: 1.2rem; font-weight: 600; color: #17423b; margin-bottom: 1rem; }
        .filters-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; }
        .form-group { margin-bottom: 1rem; }
        .form-label { display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333; }
        .form-select, .form-input { width: 100%; padding: 0.75rem; border: 2px solid #e1e5e9; border-radius: 8px; font-size: 1rem; transition: border-color 0.3s; }
        .form-select:focus, .form-input:focus { outline: none; border-color: #28a745; }
        .btn { padding: 0.75rem 1.5rem; border-radius: 8px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.2s; border: none; cursor: pointer; }
        .btn-primary { background: linear-gradient(135deg, #28a745, #20c997); color: white; }
        .btn-primary:hover { background: linear-gradient(135deg, #218838, #1ea085); }
        .btn-secondary { background: #6c757d; color: white; }
        .btn-secondary:hover { background: #5a6268; }
        
        /* Styles pour le tableau */
        .table-container { background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .table { width: 100%; border-collapse: collapse; }
        .table th { background: #f8f9fa; padding: 1rem; text-align: left; font-weight: 600; color: #17423b; border-bottom: 2px solid #e9ecef; }
        .table td { padding: 1rem; border-bottom: 1px solid #e9ecef; }
        .table tr:hover { background: #f8f9fa; }
        
        /* Badges et étiquettes */
        .badge { padding: 0.4rem 0.8rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600; display: inline-block; }
        .badge-primary { background: #e3f2fd; color: #1976d2; }
        .badge-success { background: #d4edda; color: #155724; }
        .badge-light { background: #f8f9fa; color: #6c757d; }
        
        /* Liens */
        .link { color: #28a745; text-decoration: none; font-weight: 500; }
        .link:hover { text-decoration: underline; }
        
        /* Message vide */
        .empty-state { text-align: center; padding: 3rem; color: #666; }
        .empty-state i { font-size: 3rem; margin-bottom: 1rem; color: #ccc; }
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
                <div class="greeting">Historique des Transactions</div>
                <div class="subtitle" style="color: #ffe082;">Toutes les transactions de paiements</div>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-money-bill-wave" style="font-size: 2.5rem; color: #ffe082;"></i>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Statistiques -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-value">{{ number_format($stats['total_transactions'], 0, ',', ' ') }}</div>
                <div class="stat-label">Total Transactions</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ number_format($stats['total_montant'], 0, ',', ' ') }} F CFA</div>
                <div class="stat-label">Montant Total</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ $stats['par_type']['commande'] ?? 0 }}</div>
                <div class="stat-label">Paiements Commandes</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ $stats['par_type']['contrat'] ?? 0 }}</div>
                <div class="stat-label">Paiements Contrats</div>
            </div>
        </div>

        <!-- Filtres -->
        <div class="filters-section">
            <div class="filters-title"><i class="fas fa-filter mr-2"></i>Filtres et Tri</div>
            <form method="GET" action="{{ route('transactions.index') }}">
                <div class="filters-grid">
                    <div class="form-group">
                        <label for="type" class="form-label">Type</label>
                        <select name="type" id="type" class="form-select">
                            <option value="">Tous les types</option>
                            <option value="commande" {{ request('type') == 'commande' ? 'selected' : '' }}>Commandes</option>
                            <option value="contrat" {{ request('type') == 'contrat' ? 'selected' : '' }}>Contrats</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="mode_paiement" class="form-label">Mode de paiement</label>
                        <select name="mode_paiement" id="mode_paiement" class="form-select">
                            <option value="">Tous les modes</option>
                            <option value="especes" {{ request('mode_paiement') == 'especes' ? 'selected' : '' }}>Espèces</option>
                            <option value="cheque" {{ request('mode_paiement') == 'cheque' ? 'selected' : '' }}>Chèque</option>
                            <option value="virement" {{ request('mode_paiement') == 'virement' ? 'selected' : '' }}>Virement</option>
                            <option value="carte" {{ request('mode_paiement') == 'carte' ? 'selected' : '' }}>Carte</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tri" class="form-label">Tri</label>
                        <select name="tri" id="tri" class="form-select">
                            <option value="recent" {{ request('tri') == 'recent' ? 'selected' : '' }}>Plus récent</option>
                            <option value="ancien" {{ request('tri') == 'ancien' ? 'selected' : '' }}>Plus ancien</option>
                            <option value="montant" {{ request('tri') == 'montant' ? 'selected' : '' }}>Montant décroissant</option>
                            <option value="mode" {{ request('tri') == 'mode' ? 'selected' : '' }}>Mode de paiement</option>
                        </select>
                    </div>
                    <div class="form-group d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-search mr-1"></i>Filtrer
                        </button>
                        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times mr-1"></i>Réinitialiser
                        </a>
                        <a href="{{ route('transactions.export') }}?{{ http_build_query(request()->all()) }}" class="btn btn-secondary">
                            <i class="fas fa-file-pdf mr-1"></i>Exporter PDF
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Liste des Transactions -->
        @if($transactions->count() > 0)
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th><i class="fas fa-calendar mr-2"></i>Date</th>
                            <th><i class="fas fa-tag mr-2"></i>Type</th>
                            <th><i class="fas fa-hashtag mr-2"></i>Référence</th>
                            <th><i class="fas fa-money-bill mr-2"></i>Montant</th>
                            <th><i class="fas fa-credit-card mr-2"></i>Mode de paiement</th>
                            <th><i class="fas fa-user mr-2"></i>Utilisateur</th>
                            <th><i class="fas fa-cogs mr-2"></i>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>
                                    <div style="display: flex; flex-direction: column;">
                                        <span style="font-weight: 600; color: #17423b;">{{ \Carbon\Carbon::parse($transaction->date_paiement)->format('d/m/Y') }}</span>
                                        <small style="color: #666;">{{ \Carbon\Carbon::parse($transaction->date_paiement)->format('H:i') }}</small>
                                    </div>
                                </td>
                                <td>
                                    @if($transaction->type == 'commande')
                                        <span class="badge badge-primary">
                                            <i class="fas fa-shopping-cart mr-1"></i>Commande
                                        </span>
                                        @if($transaction->commande && $transaction->commande->bonCommande)
                                            <br><small style="color: #666;">{{ $transaction->commande->bonCommande->reference ?? 'N/A' }}</small>
                                        @endif
                                    @else
                                        <span class="badge badge-success">
                                            <i class="fas fa-file-contract mr-1"></i>Contrat
                                        </span>
                                        @if($transaction->contrat)
                                            <br><small style="color: #666;">{{ $transaction->contrat->reference ?? 'N/A' }}</small>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    @if($transaction->type == 'commande')
                                        @if($transaction->commande)
                                            <a href="{{ route('commande.details', $transaction->commande) }}" class="link">
                                                {{ $transaction->commande->reference ?? 'N/A' }}
                                            </a>
                                        @else
                                            N/A
                                        @endif
                                    @else
                                        @if($transaction->contrat)
                                            <a href="{{ route('contrat.details', $transaction->contrat) }}" class="link">
                                                {{ $transaction->contrat->reference ?? 'N/A' }}
                                            </a>
                                        @else
                                            N/A
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    <span style="font-weight: 600; color: #28a745; font-size: 1.1rem;">
                                        {{ number_format($transaction->montant, 0, ',', ' ') }} F CFA
                                    </span>
                                </td>
                                <td>
                                    @php
                                        $modeLabels = [
                                            'especes' => '💵 Espèces',
                                            'cheque' => '🏦 Chèque',
                                            'virement' => '💳 Virement',
                                            'carte' => '💳 Carte'
                                        ];
                                    @endphp
                                    <span class="badge badge-light">
                                        {{ $modeLabels[$transaction->mode_paiement] ?? $transaction->mode_paiement }}
                                    </span>
                                    @if($transaction->reference_paiement)
                                        <br><small style="color: #666;">{{ $transaction->reference_paiement }}</small>
                                    @endif
                                </td>
                                <td>
                                    <span style="color: #666;">{{ $transaction->user->nom_complet ?? 'Utilisateur' }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('transactions.show', [$transaction->id, $transaction->type]) }}" class="btn btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.9rem;">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h3>Aucune transaction trouvée</h3>
                <p>Aucune transaction ne correspond aux critères de recherche.</p>
            </div>
        @endif
    </div>


</body>
</html> 