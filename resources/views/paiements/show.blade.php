<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Détails de la Commande - {{ $commande->reference }}</title>
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
        
        /* Boutons */
        .btn { padding: 0.75rem 1.5rem; border-radius: 8px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.2s; border: none; cursor: pointer; }
        .btn-primary { background: linear-gradient(135deg, #28a745, #20c997); color: white; }
        .btn-primary:hover { background: linear-gradient(135deg, #218838, #1ea085); }
        .btn-secondary { background: #6c757d; color: white; }
        .btn-secondary:hover { background: #5a6268; }
        .btn-blue { background: linear-gradient(135deg, #007bff, #0056b3); color: white; }
        .btn-blue:hover { background: linear-gradient(135deg, #0056b3, #004085); }
        
        /* Historique des paiements */
        .history-item { background: #f8f9fa; padding: 1rem; border-radius: 8px; margin-bottom: 1rem; border-left: 4px solid #28a745; }
        .history-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem; }
        .history-amount { font-weight: 600; color: #28a745; font-size: 1.1rem; }
        .history-date { color: #666; font-size: 0.9rem; }
        .history-details { color: #333; }
        .history-mode { display: inline-block; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.8rem; font-weight: 600; }
        .mode-especes { background: #d4edda; color: #155724; }
        .mode-cheque { background: #d1ecf1; color: #0c5460; }
        .mode-virement { background: #e2d9f3; color: #6f42c1; }
        .mode-carte { background: #fff3cd; color: #856404; }
        
        /* Actions */
        .actions { display: flex; gap: 1rem; margin-bottom: 2rem; }
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
                <div class="greeting">Détails de la Commande</div>
                <div class="subtitle" style="color: #ffe082;">{{ $commande->reference }} - {{ $commande->fournisseur->nom }}</div>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-file-invoice" style="font-size: 2.5rem; color: #ffe082;"></i>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Actions -->
        <div class="actions">
            <a href="{{ route('paiements.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>Retour aux Paiements
            </a>
            <button onclick="ouvrirModalPaiement({{ $commande->id }})" class="btn btn-blue">
                <i class="fas fa-credit-card mr-2"></i>Effectuer un Paiement
            </button>
            <a href="{{ route('commande.details', $commande) }}" class="btn btn-primary">
                <i class="fas fa-eye mr-2"></i>Voir la Commande
            </a>
        </div>

        <!-- Informations de la commande -->
        <div class="section">
            <div class="section-title">
                <i class="fas fa-info-circle"></i>
                Informations de la Commande
            </div>
            <div class="info-grid">
                <div class="info-card">
                    <div class="info-label">Référence</div>
                    <div class="info-value">{{ $commande->reference }}</div>
                </div>
                <div class="info-card">
                    <div class="info-label">Fournisseur</div>
                    <div class="info-value">{{ $commande->fournisseur->nom }}</div>
                </div>
                <div class="info-card">
                    <div class="info-label">Date de Commande</div>
                    <div class="info-value">{{ $commande->date_commande->format('d/m/Y H:i') }}</div>
                </div>
                <div class="info-card">
                    <div class="info-label">Statut</div>
                    <div class="info-value">
                        @if($commande->statut_paiement == 'echu')
                            <span class="badge badge-success">Payé</span>
                        @elseif($commande->statut_paiement == 'redevance')
                            <span class="badge badge-warning">Redevance</span>
                        @else
                            <span class="badge badge-danger">Impayé</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Informations financières -->
        <div class="section">
            <div class="section-title">
                <i class="fas fa-money-bill-wave"></i>
                Informations Financières
            </div>
            <div class="info-grid">
                <div class="info-card">
                    <div class="info-label">Montant Total</div>
                    <div class="info-value">{{ number_format($commande->montant_total, 0, ',', ' ') }} F CFA</div>
                </div>
                <div class="info-card">
                    <div class="info-label">Avance Payée</div>
                    <div class="info-value" style="color: #28a745;">{{ number_format($commande->avance, 0, ',', ' ') }} F CFA</div>
                </div>
                <div class="info-card">
                    <div class="info-label">Reste à Payer</div>
                    <div class="info-value" style="color: #dc3545;">{{ number_format($commande->reste_a_payer, 0, ',', ' ') }} F CFA</div>
                </div>
                <div class="info-card">
                    <div class="info-label">Pourcentage Payé</div>
                    <div class="info-value">
                        @php
                            $pourcentage = $commande->montant_total > 0 ? ($commande->avance / $commande->montant_total) * 100 : 0;
                        @endphp
                        {{ number_format($pourcentage, 1) }}%
                    </div>
                </div>
            </div>
        </div>

        <!-- Historique des paiements -->
        <div class="section">
            <div class="section-title">
                <i class="fas fa-history"></i>
                Historique des Paiements
            </div>
            @if($commande->paiements->count() > 0)
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th><i class="fas fa-calendar mr-2"></i>Date</th>
                                <th><i class="fas fa-money-bill mr-2"></i>Montant</th>
                                <th><i class="fas fa-credit-card mr-2"></i>Mode de Paiement</th>
                                <th><i class="fas fa-hashtag mr-2"></i>Référence</th>
                                <th><i class="fas fa-user mr-2"></i>Utilisateur</th>
                                <th><i class="fas fa-comment mr-2"></i>Commentaire</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($commande->paiements as $paiement)
                                <tr>
                                    <td>
                                        <div style="display: flex; flex-direction: column;">
                                            <span style="font-weight: 600; color: #17423b;">{{ $paiement->date_paiement->format('d/m/Y') }}</span>
                                            <small style="color: #666;">{{ $paiement->date_paiement->format('H:i') }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <span style="font-weight: 600; color: #28a745; font-size: 1.1rem;">
                                            {{ number_format($paiement->montant, 0, ',', ' ') }} F CFA
                                        </span>
                                    </td>
                                    <td>
                                        <span class="history-mode mode-{{ $paiement->mode_paiement }}">
                                            {{ $paiement->mode_paiement_label }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($paiement->reference_paiement)
                                            <span style="color: #666;">{{ $paiement->reference_paiement }}</span>
                                        @else
                                            <span style="color: #ccc;">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span style="color: #666;">{{ $paiement->user->nom_complet ?? 'Utilisateur' }}</span>
                                    </td>
                                    <td>
                                        @if($paiement->commentaire)
                                            <span style="color: #666;">{{ $paiement->commentaire }}</span>
                                        @else
                                            <span style="color: #ccc;">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div style="text-align: center; padding: 3rem; color: #666;">
                    <i class="fas fa-inbox" style="font-size: 3rem; margin-bottom: 1rem; color: #ccc;"></i>
                    <h3>Aucun paiement enregistré</h3>
                    <p>Aucun paiement n'a encore été effectué pour cette commande.</p>
                </div>
            @endif
        </div>

        <!-- Lignes de commande -->
        <div class="section">
            <div class="section-title">
                <i class="fas fa-list"></i>
                Détail des Articles
            </div>
            @if($commande->lignes->count() > 0)
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th><i class="fas fa-box mr-2"></i>Produit</th>
                                <th><i class="fas fa-sort-numeric-up mr-2"></i>Quantité</th>
                                <th><i class="fas fa-money-bill mr-2"></i>Prix Unitaire</th>
                                <th><i class="fas fa-calculator mr-2"></i>Total</th>
                                <th><i class="fas fa-tag mr-2"></i>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($commande->lignes as $ligne)
                                <tr>
                                    <td>
                                        <span style="font-weight: 600; color: #17423b;">{{ $ligne->produit ?? 'Produit' }}</span>
                                    </td>
                                    <td>
                                        <span style="color: #666;">{{ $ligne->quantite }}</span>
                                    </td>
                                    <td>
                                        <span style="color: #666;">{{ number_format($ligne->prix_unitaire, 0, ',', ' ') }} F CFA</span>
                                    </td>
                                    <td>
                                        <span style="font-weight: 600; color: #17423b;">
                                            {{ number_format($ligne->montant_total, 0, ',', ' ') }} F CFA
                                        </span>
                                    </td>
                                    <td>
                                        @if($ligne->statut_ligne == 'livree')
                                            <span class="badge badge-success">Livrée</span>
                                        @elseif($ligne->statut_ligne == 'approuvee')
                                            <span class="badge badge-info">Approuvée</span>
                                        @else
                                            <span class="badge badge-warning">En attente</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div style="text-align: center; padding: 3rem; color: #666;">
                    <i class="fas fa-box-open" style="font-size: 3rem; margin-bottom: 1rem; color: #ccc;"></i>
                    <h3>Aucun article</h3>
                    <p>Aucun article n'a été ajouté à cette commande.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal de paiement -->
    <div id="modalPaiement" class="modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5);">
        <div class="modal-content" style="background: white; margin: 0; padding: 0; border-radius: 15px; width: 90%; max-width: 500px; box-shadow: 0 10px 30px rgba(0,0,0,0.3); position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
            <div class="modal-header" style="background: linear-gradient(135deg, #28a745, #20c997); color: white; padding: 1.5rem; border-radius: 15px 15px 0 0; display: flex; justify-content: space-between; align-items: center;">
                <h3 style="margin: 0; font-size: 1.3rem; font-weight: 600;"><i class="fas fa-credit-card mr-2"></i>Effectuer un paiement</h3>
                <button onclick="fermerModalPaiement()" style="background: none; border: none; color: white; font-size: 1.5rem; cursor: pointer; padding: 0;">&times;</button>
            </div>
            <div class="modal-body" style="padding: 2rem;">
                <form id="formPaiement">
                    <div class="form-group" style="margin-bottom: 1.5rem;">
                        <label for="montant" class="form-label" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">Montant à payer *</label>
                        <input type="number" id="montant" name="montant" class="form-input" style="width: 100%; padding: 0.75rem; border: 2px solid #e1e5e9; border-radius: 8px; font-size: 1rem; transition: border-color 0.3s;" step="0.01" min="0.01" required>
                    </div>
                    
                    <div class="form-group" style="margin-bottom: 1.5rem;">
                        <label for="mode_paiement" class="form-label" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">Mode de paiement *</label>
                        <select id="mode_paiement" name="mode_paiement" class="form-select" style="width: 100%; padding: 0.75rem; border: 2px solid #e1e5e9; border-radius: 8px; font-size: 1rem; transition: border-color 0.3s;" required onchange="gererChampReference()">
                            <option value="">Sélectionner un mode</option>
                            <option value="especes">💵 Espèces</option>
                            <option value="cheque">🏦 Chèque</option>
                            <option value="virement">💳 Virement</option>
                            <option value="carte">💳 Carte bancaire</option>
                        </select>
                    </div>
                    
                    <div class="form-group" id="reference-group" style="display: none; margin-bottom: 1.5rem;">
                        <label for="reference_paiement" class="form-label" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">Référence du paiement</label>
                        <input type="text" id="reference_paiement" name="reference_paiement" class="form-input" style="width: 100%; padding: 0.75rem; border: 2px solid #e1e5e9; border-radius: 8px; font-size: 1rem; transition: border-color 0.3s;" placeholder="Numéro de chèque, référence virement...">
                    </div>
                    
                    <div class="form-group" style="margin-bottom: 1.5rem;">
                        <label for="commentaire" class="form-label" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">Commentaire (optionnel)</label>
                        <textarea id="commentaire" name="commentaire" class="form-input" style="width: 100%; padding: 0.75rem; border: 2px solid #e1e5e9; border-radius: 8px; font-size: 1rem; transition: border-color 0.3s;" rows="3" placeholder="Commentaire sur ce paiement..."></textarea>
                    </div>
                    
                    <button type="submit" class="btn-submit" style="background: linear-gradient(135deg, #28a745, #20c997); color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; width: 100%; font-size: 1rem;">
                        <i class="fas fa-save mr-2"></i>Enregistrer le paiement
                    </button>
                    <button type="button" class="btn-cancel" onclick="fermerModalPaiement()" style="background: #6c757d; color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; width: 100%; font-size: 1rem; margin-top: 0.5rem;">
                        <i class="fas fa-times mr-2"></i>Annuler
                    </button>
                </form>
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
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    alert('Erreur lors du chargement des données de la commande');
                });
        }
        
        function fermerModalPaiement() {
            const modal = document.getElementById('modalPaiement');
            modal.style.display = 'none';
            
            // Réinitialiser le formulaire
            document.getElementById('formPaiement').reset();
            document.getElementById('reference-group').style.display = 'none';
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
                    alert('Paiement enregistré avec succès !');
                    fermerModalPaiement();
                    // Recharger la page pour mettre à jour les informations
                    location.reload();
                } else {
                    if (data.errors) {
                        let errorMessage = 'Erreurs de validation:\n';
                        Object.keys(data.errors).forEach(key => {
                            errorMessage += `- ${data.errors[key].join(', ')}\n`;
                        });
                        alert(errorMessage);
                    } else {
                        alert('Erreur: ' + (data.message || 'Erreur lors de l\'enregistrement'));
                    }
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Erreur lors de l\'enregistrement du paiement');
            });
        });
    </script>
</body>
</html> 