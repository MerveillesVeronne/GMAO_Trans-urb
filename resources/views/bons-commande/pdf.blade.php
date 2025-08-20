<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bons de commande - GMAO Trans'urb</title>
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
        .status-en_cours {
            background: #d1ecf1;
            color: #0c5460;
        }
        .status-valide {
            background: #d4edda;
            color: #155724;
        }
        .status-annule {
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
    </style>
</head>
<body>
    <div class="header">
        <h1>GMAO Trans'urb</h1>
        <p>Liste des Bons de Commande</p>
        <p>Généré le {{ date('d/m/Y à H:i') }}</p>
    </div>

    <div class="summary">
        <h3>Résumé</h3>
        <p><strong>Total des bons de commande :</strong> {{ $bonsCommande->count() }}</p>
        <p><strong>En attente :</strong> {{ $bonsCommande->where('statut', 'en_attente')->count() }}</p>
        <p><strong>En cours :</strong> {{ $bonsCommande->where('statut', 'en_cours')->count() }}</p>
        <p><strong>Validés :</strong> {{ $bonsCommande->where('statut', 'valide')->count() }}</p>
        <p><strong>Annulés :</strong> {{ $bonsCommande->where('statut', 'annule')->count() }}</p>
    </div>

    <div class="info-section">
        <h2>Détail des Bons de Commande</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Référence</th>
                    <th>Titre</th>
                    <th>Produit Principal</th>
                    <th>Budget (FCFA)</th>
                    <th>Date Création</th>
                    <th>Date Besoin</th>
                    <th>Statut</th>
                    <th>Créé par</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bonsCommande as $bon)
                    <tr>
                        <td><strong>{{ $bon->reference }}</strong></td>
                        <td>{{ $bon->titre }}</td>
                        <td>{{ $bon->produit_principal }}</td>
                        <td>{{ number_format($bon->budget_total, 0, ',', ' ') }}</td>
                        <td>{{ $bon->date_creation ? $bon->date_creation->format('d/m/Y') : '-' }}</td>
                        <td>{{ $bon->date_besoin ? $bon->date_besoin->format('d/m/Y') : '-' }}</td>
                        <td>
                            <span class="status-badge status-{{ $bon->statut }}">
                                {{ ucfirst(str_replace('_', ' ', $bon->statut)) }}
                            </span>
                        </td>
                        <td>{{ $bon->user ? $bon->user->name : '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 20px; color: #666;">
                            Aucun bon de commande trouvé
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