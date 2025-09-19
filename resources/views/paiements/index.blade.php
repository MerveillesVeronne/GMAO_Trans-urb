<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gestion des Paiements</title>
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
        .btn-blue { background: linear-gradient(135deg, #007bff, #0056b3); color: white; }
        .btn-blue:hover { background: linear-gradient(135deg, #0056b3, #004085); }
        
        /* Styles pour le tableau */
        .table-container { background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .table { width: 100%; border-collapse: collapse; }
        .table th { background: #f8f9fa; padding: 1rem; text-align: left; font-weight: 600; color: #17423b; border-bottom: 2px solid #e9ecef; }
        .table td { padding: 1rem; border-bottom: 1px solid #e9ecef; }
        .table tr:hover { background: #f8f9fa; }
        
        /* Badges et étiquettes */
        .badge { padding: 0.4rem 0.8rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600; display: inline-block; }
        .badge-success { background: #d4edda; color: #155724; }
        .badge-warning { background: #fff3cd; color: #856404; }
        .badge-danger { background: #f8d7da; color: #721c24; }
        .badge-info { background: #d1ecf1; color: #0c5460; }
        
        /* Liens */
        .link { color: #28a745; text-decoration: none; font-weight: 500; }
        .link:hover { text-decoration: underline; }
        
        /* Message vide */
        .empty-state { text-align: center; padding: 3rem; color: #666; }
        .empty-state i { font-size: 3rem; margin-bottom: 1rem; color: #ccc; }
        
        /* Modal styles */
        .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); }
        .modal-content { 
            background: white; 
            margin: 0; 
            padding: 0; 
            border-radius: 15px; 
            width: 90%; 
            max-width: 500px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.3); 
            transform: scale(0.7); 
            opacity: 0; 
            transition: all 0.3s ease;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.7);
        }
        .modal.show .modal-content { 
            transform: translate(-50%, -50%) scale(1); 
            opacity: 1; 
        }
        .modal-header { background: linear-gradient(135deg, #28a745, #20c997); color: white; padding: 1.5rem; border-radius: 15px 15px 0 0; display: flex; justify-content: space-between; align-items: center; }
        .modal-header h3 { margin: 0; font-size: 1.3rem; font-weight: 600; }
        .modal-close { background: none; border: none; color: white; font-size: 1.5rem; cursor: pointer; padding: 0; }
        .modal-body { padding: 2rem; }
        .form-group { margin-bottom: 1.5rem; }
        .form-label { display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333; }
        .form-input, .form-select { width: 100%; padding: 0.75rem; border: 2px solid #e1e5e9; border-radius: 8px; font-size: 1rem; transition: border-color 0.3s; }
        .form-input:focus, .form-select:focus { outline: none; border-color: #28a745; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .btn-submit { background: linear-gradient(135deg, #28a745, #20c997); color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; width: 100%; font-size: 1rem; }
        .btn-submit:hover { background: linear-gradient(135deg, #218838, #1ea085); }
        .btn-cancel { background: #6c757d; color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; width: 100%; font-size: 1rem; margin-top: 0.5rem; }
        .btn-cancel:hover { background: #5a6268; }
        
        /* Historique modal */
        .history-modal .modal-header { background: linear-gradient(135deg, #6c757d, #495057); }
        .history-item { background: #f8f9fa; padding: 1rem; border-radius: 8px; margin-bottom: 1rem; border-left: 4px solid #28a745; }
        .history-item-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem; }
        .history-amount { font-weight: 600; color: #28a745; font-size: 1.1rem; }
        .history-date { color: #666; font-size: 0.9rem; }
        .history-details { color: #333; }
        .history-mode { display: inline-block; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.8rem; font-weight: 600; }
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
                <div class="greeting">Gestion des Paiements</div>
                <div class="subtitle" style="color: #ffe082;">Suivi et gestion des paiements des commandes</div>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-credit-card" style="font-size: 2.5rem; color: #ffe082;"></i>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Statistiques -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-value">{{ number_format($stats['total_commandes']) }}</div>
                <div class="stat-label">Commandes à payer</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ number_format($stats['total_montant'], 0, ',', ' ') }} F CFA</div>
                <div class="stat-label">Total à payer</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ number_format($stats['total_paye'], 0, ',', ' ') }} F CFA</div>
                <div class="stat-label">Déjà payé</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ number_format($stats['total_reste'], 0, ',', ' ') }} F CFA</div>
                <div class="stat-label">Reste à payer</div>
            </div>
        </div>

        <!-- Filtres -->
        <div class="filters-section">
            <div class="filters-title"><i class="fas fa-filter mr-2"></i>Filtres et Tri</div>
            <form method="GET" action="{{ route('paiements.index') }}">
                <div class="filters-grid">
                    <div class="form-group">
                        <label for="statut_paiement" class="form-label">Statut</label>
                        <select name="statut_paiement" id="statut_paiement" class="form-select">
                            <option value="">Tous les statuts</option>
                            <option value="impaye" {{ request('statut_paiement') == 'impaye' ? 'selected' : '' }}>Impayé</option>
                            <option value="redevance" {{ request('statut_paiement') == 'redevance' ? 'selected' : '' }}>Redevance</option>
                            <option value="echu" {{ request('statut_paiement') == 'echu' ? 'selected' : '' }}>Payé</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fournisseur" class="form-label">Fournisseur</label>
                        <input type="text" name="fournisseur" id="fournisseur" class="form-input" value="{{ request('fournisseur') }}" placeholder="Nom du fournisseur">
                    </div>
                    <div class="form-group">
                        <label for="date_debut" class="form-label">Date début</label>
                        <input type="date" name="date_debut" id="date_debut" class="form-input" value="{{ request('date_debut') }}">
                    </div>
                    <div class="form-group">
                        <label for="date_fin" class="form-label">Date fin</label>
                        <input type="date" name="date_fin" id="date_fin" class="form-input" value="{{ request('date_fin') }}">
                    </div>
                    <div class="form-group d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-search mr-1"></i>Filtrer
                        </button>
                        <a href="{{ route('paiements.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times mr-1"></i>Réinitialiser
                        </a>
                        <a href="{{ route('paiements.export') }}?{{ http_build_query(request()->all()) }}" class="btn btn-secondary">
                            <i class="fas fa-file-pdf mr-1"></i>Exporter PDF
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Liste des commandes -->
        @if($commandes->count() > 0)
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th><i class="fas fa-hashtag mr-2"></i>Référence</th>
                            <th><i class="fas fa-building mr-2"></i>Fournisseur</th>
                            <th><i class="fas fa-calendar mr-2"></i>Date Commande</th>
                            <th><i class="fas fa-money-bill mr-2"></i>Montant Total</th>
                            <th><i class="fas fa-credit-card mr-2"></i>Avance</th>
                            <th><i class="fas fa-clock mr-2"></i>Reste à payer</th>
                            <th><i class="fas fa-tag mr-2"></i>Statut</th>
                            <th><i class="fas fa-cogs mr-2"></i>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($commandes as $commande)
                            <tr>
                                <td>
                                    <a href="{{ route('commande.details', $commande) }}" class="link">
                                        {{ $commande->reference }}
                                    </a>
                                </td>
                                <td>
                                    <span style="color: #666;">{{ $commande->fournisseur->nom }}</span>
                                </td>
                                <td>
                                    <div style="display: flex; flex-direction: column;">
                                        <span style="font-weight: 600; color: #17423b;">{{ $commande->date_commande->format('d/m/Y') }}</span>
                                        <small style="color: #666;">{{ $commande->date_commande->format('H:i') }}</small>
                                    </div>
                                </td>
                                <td>
                                    <span style="font-weight: 600; color: #17423b; font-size: 1.1rem;">
                                        {{ number_format($commande->montant_total, 0, ',', ' ') }} F CFA
                                    </span>
                                </td>
                                <td>
                                    <span style="font-weight: 600; color: #28a745;">
                                        {{ number_format($commande->avance, 0, ',', ' ') }} F CFA
                                    </span>
                                </td>
                                <td>
                                    <span style="font-weight: 600; color: #dc3545;">
                                        {{ number_format($commande->reste_a_payer, 0, ',', ' ') }} F CFA
                                    </span>
                                </td>
                                <td>
                                    @if($commande->statut_paiement == 'echu')
                                        <span class="badge badge-success">Payé</span>
                                    @elseif($commande->statut_paiement == 'redevance')
                                        <span class="badge badge-warning">Redevance</span>
                                    @else
                                        <span class="badge badge-danger">Impayé</span>
                                    @endif
                                </td>
                                <td>
                                    <div style="display: flex; gap: 0.5rem;">
                                        <button class="btn btn-blue" style="padding: 0.5rem 1rem; font-size: 0.9rem;" onclick="ouvrirModalPaiement({{ $commande->id }})">
                                            <i class="fas fa-credit-card"></i>
                                        </button>
                                        <button class="btn btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.9rem;" onclick="voirHistorique({{ $commande->id }})">
                                            <i class="fas fa-history"></i>
                                        </button>
                                        <a href="{{ route('paiements.show', $commande) }}" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.9rem;">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h3>Aucune commande trouvée</h3>
                <p>Aucune commande ne correspond aux critères de recherche.</p>
            </div>
        @endif

        <!-- Pagination -->
        @if($commandes->hasPages())
            <div style="margin-top: 2rem; text-align: center;">
                {{ $commandes->links() }}
            </div>
        @endif
    </div>

    <!-- Modal de paiement -->
    <div id="modalPaiement" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-credit-card mr-2"></i>Effectuer un paiement</h3>
                <button class="modal-close" onclick="fermerModalPaiement()">&times;</button>
            </div>
            <div class="modal-body">
                <form id="formPaiement">
                    <div class="form-group">
                        <label for="montant" class="form-label">Montant à payer *</label>
                        <input type="number" id="montant" name="montant" class="form-input" step="0.01" min="0.01" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="mode_paiement" class="form-label">Mode de paiement *</label>
                        <select id="mode_paiement" name="mode_paiement" class="form-select" required onchange="gererChampReference()">
                            <option value="">Sélectionner un mode</option>
                            <option value="especes">💵 Espèces</option>
                            <option value="cheque">🏦 Chèque</option>
                            <option value="virement">💳 Virement</option>
                            <option value="carte">💳 Carte bancaire</option>
                        </select>
                    </div>
                    
                    <div class="form-group" id="reference-group" style="display: none;">
                        <label for="reference_paiement" class="form-label">Référence du paiement</label>
                        <input type="text" id="reference_paiement" name="reference_paiement" class="form-input" placeholder="Numéro de chèque, référence virement...">
                    </div>
                    
                    <div class="form-group">
                        <label for="commentaire" class="form-label">Commentaire (optionnel)</label>
                        <textarea id="commentaire" name="commentaire" class="form-input" rows="3" placeholder="Commentaire sur ce paiement..."></textarea>
                    </div>
                    
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-save mr-2"></i>Enregistrer le paiement
                    </button>
                    <button type="button" class="btn-cancel" onclick="fermerModalPaiement()">
                        <i class="fas fa-times mr-2"></i>Annuler
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Historique -->
    <div id="modalHistorique" class="modal history-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-history mr-2"></i>Historique des Paiements</h3>
                <button class="modal-close" onclick="fermerModalHistorique()">&times;</button>
            </div>
            <div class="modal-body">
                <div id="historique-content">
                    <p style="text-align: center; color: #666;">Chargement de l'historique...</p>
                </div>
                <button type="button" class="btn-cancel" onclick="fermerModalHistorique()">
                    <i class="fas fa-times mr-2"></i>Fermer
                </button>
            </div>
        </div>
    </div>

    <script>
        // Variables globales
        let commandeActuelle = null;
        
        // Fonctions pour les modals de paiement
        function ouvrirModalPaiement(commandeId) {
            fetch(`/paiements/modal/${commandeId}`)
                .then(response => response.json())
                .then(data => {
                    commandeActuelle = data.commande;
                    
                    // Mettre à jour les champs du formulaire
                    document.getElementById('montant').max = commandeActuelle.reste_a_payer;
                    document.getElementById('montant').placeholder = `Montant maximum: ${commandeActuelle.reste_a_payer.toLocaleString()} F CFA`;
                    
                    // Afficher le modal
                    const modal = document.getElementById('modalPaiement');
                    modal.style.display = 'block';
                    setTimeout(() => modal.classList.add('show'), 10);
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    showErrorModal('notificationModal', 'Erreur', 'Erreur lors du chargement des données de la commande');
                });
        }
        
        function fermerModalPaiement() {
            const modal = document.getElementById('modalPaiement');
            modal.classList.remove('show');
            setTimeout(() => modal.style.display = 'none', 300);
            
            // Réinitialiser le formulaire
            document.getElementById('formPaiement').reset();
            document.getElementById('reference-group').style.display = 'none';
        }
        
        function voirHistorique(commandeId) {
            fetch(`/paiements/historique/${commandeId}`)
                .then(response => response.json())
                .then(data => {
                    const content = document.getElementById('historique-content');
                    
                    if (data.paiements.length === 0) {
                        content.innerHTML = '<p style="text-align: center; color: #666;">Aucun paiement enregistré pour cette commande.</p>';
                    } else {
                        let html = '';
                        data.paiements.forEach(paiement => {
                            html += `
                                <div class="history-item">
                                    <div class="history-item-header">
                                        <span class="history-amount">${paiement.montant.toLocaleString()} F CFA</span>
                                        <span class="history-date">${paiement.date_paiement}</span>
                                    </div>
                                    <div class="history-details">
                                        <span class="history-mode mode-${paiement.mode_paiement.split(' ')[1].toLowerCase()}">${paiement.mode_paiement}</span>
                                        ${paiement.reference_paiement ? `<br><strong>Référence:</strong> ${paiement.reference_paiement}` : ''}
                                        ${paiement.commentaire ? `<br><strong>Commentaire:</strong> ${paiement.commentaire}` : ''}
                                        <br><strong>Par:</strong> ${paiement.user}
                                    </div>
                                </div>
                            `;
                        });
                        content.innerHTML = html;
                    }
                    
                    // Afficher le modal
                    const modal = document.getElementById('modalHistorique');
                    modal.style.display = 'block';
                    setTimeout(() => modal.classList.add('show'), 10);
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    showErrorModal('notificationModal', 'Erreur', 'Erreur lors du chargement de l\'historique');
                });
        }
        
        function fermerModalHistorique() {
            const modal = document.getElementById('modalHistorique');
            modal.classList.remove('show');
            setTimeout(() => modal.style.display = 'none', 300);
        }
        
        function gererChampReference() {
            const modePaiement = document.getElementById('mode_paiement').value;
            const referenceGroup = document.getElementById('reference-group');
            const referenceInput = document.getElementById('reference_paiement');
            
            if (modePaiement === 'especes') {
                referenceGroup.style.display = 'none';
                referenceInput.value = '';
                referenceInput.removeAttribute('required');
            } else {
                referenceGroup.style.display = 'block';
                referenceInput.setAttribute('required', 'required');
                
                // Définir le placeholder approprié
                switch(modePaiement) {
                    case 'cheque':
                        referenceInput.placeholder = 'Numéro de chèque';
                        break;
                    case 'virement':
                        referenceInput.placeholder = 'Référence du virement';
                        break;
                    case 'carte':
                        referenceInput.placeholder = 'Numéro de transaction';
                        break;
                    default:
                        referenceInput.placeholder = 'Référence du paiement';
                }
            }
        }
        
        // Gestion du formulaire de paiement
        document.getElementById('formPaiement').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const commandeId = commandeActuelle.id;
            
            // Convertir FormData en objet pour l'envoi
            const data = {};
            formData.forEach((value, key) => {
                data[key] = value;
            });
            
            fetch(`/paiements/${commandeId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showSuccessModal('notificationModal', 'Succès', 'Paiement enregistré avec succès !', function() {
                        fermerModalPaiement();
                        location.reload();
                    });
                } else {
                    if (data.errors) {
                        let errorMessage = 'Erreurs de validation:\n';
                        Object.keys(data.errors).forEach(key => {
                            errorMessage += `- ${data.errors[key].join(', ')}\n`;
                        });
                        showErrorModal('notificationModal', 'Erreur de validation', errorMessage);
                    } else {
                        showErrorModal('notificationModal', 'Erreur', data.message || 'Erreur lors de l\'enregistrement');
                    }
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                showErrorModal('notificationModal', 'Erreur', 'Erreur lors de l\'enregistrement du paiement');
            });
        });
    </script>

    <!-- Modal de notification -->
    <x-modal id="notificationModal" title="Notification" type="info">
        Message de notification
    </x-modal>
</body>
</html> 