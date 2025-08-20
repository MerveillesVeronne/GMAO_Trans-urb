<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commandes - GMAO Trans'urb</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background: #fff;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #1e5c4a;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #1e5c4a;
            font-size: 24px;
            margin: 0;
            font-weight: bold;
        }
        .header p {
            color: #666;
            margin: 5px 0 0 0;
            font-size: 14px;
        }
        .info-section {
            margin-bottom: 20px;
        }
        .info-section h2 {
            color: #1e5c4a;
            font-size: 18px;
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th {
            background: #1e5c4a;
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: bold;
            font-size: 12px;
        }
        .table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            font-size: 11px;
        }
        .table tr:nth-child(even) {
            background: #f9f9f9;
        }
        .status-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-en_attente {
            background: #fff3cd;
            color: #856404;
        }
        .status-approuvee {
            background: #d1ecf1;
            color: #0c5460;
        }
        .status-livree {
            background: #d4edda;
            color: #155724;
        }
        .status-annulee {
            background: #f8d7da;
            color: #721c24;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        .page-break {
            page-break-before: always;
        }
        .summary {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .summary h3 {
            color: #1e5c4a;
            margin: 0 0 10px 0;
            font-size: 16px;
        }
        .summary p {
            margin: 5px 0;
            font-size: 12px;
        }
        .amount {
            font-weight: bold;
            color: #1e5c4a;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>GMAO Trans'urb</h1>
        <p>Liste des Commandes</p>
        <p>Généré le {{ date('d/m/Y à H:i') }}</p>
    </div>

    <div class="summary">
        <h3>Résumé</h3>
        <p><strong>Total des commandes :</strong> {{ $commandes->count() }}</p>
        <p><strong>En attente :</strong> {{ $commandes->where('statut', 'en_attente')->count() }}</p>
        <p><strong>Approuvées :</strong> {{ $commandes->where('statut', 'approuvee')->count() }}</p>
        <p><strong>Livrées :</strong> {{ $commandes->where('statut', 'livree')->count() }}</p>
        <p><strong>Annulées :</strong> {{ $commandes->where('statut', 'annulee')->count() }}</p>
        <p><strong>Montant total :</strong> <span class="amount">{{ number_format($commandes->sum('montant_total'), 0, ',', ' ') }} FCFA</span></p>
    </div>

    <div class="info-section">
        <h2>Détail des Commandes</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Référence</th>
                    <th>Fournisseur</th>
                    <th>Date Commande</th>
                    <th>Date Livraison</th>
                    <th>Montant (FCFA)</th>
                    <th>Statut</th>
                    <th>Créé par</th>
                    <th>Bon de Commande</th>
                </tr>
            </thead>
            <tbody>
                @forelse($commandes as $commande)
                    <tr>
                        <td><strong>{{ $commande->reference }}</strong></td>
                        <td>{{ $commande->fournisseur ? $commande->fournisseur->nom : '-' }}</td>
                        <td>{{ $commande->date_commande ? $commande->date_commande->format('d/m/Y') : '-' }}</td>
                        <td>{{ $commande->date_livraison ? $commande->date_livraison->format('d/m/Y') : '-' }}</td>
                        <td class="amount">{{ number_format($commande->montant_total ?? 0, 0, ',', ' ') }}</td>
                        <td>
                            <span class="status-badge status-{{ $commande->statut }}">
                                {{ ucfirst(str_replace('_', ' ', $commande->statut)) }}
                            </span>
                        </td>
                        <td>{{ $commande->user ? $commande->user->name : '-' }}</td>
                        <td>{{ $commande->bonCommande ? $commande->bonCommande->reference : '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 20px; color: #666;">
                            Aucune commande trouvée
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>Document généré automatiquement par GMAO Trans'urb</p>
        <p>© {{ date('Y') }} GMAO Trans'urb - Tous droits réservés</p>
    </div>
</body>
</html> 