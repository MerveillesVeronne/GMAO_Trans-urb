<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rapport des Paiements - {{ date('d/m/Y') }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #28a745;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #17423b;
            margin: 0;
            font-size: 24px;
        }
        .header p {
            color: #666;
            margin: 5px 0;
        }
        .stats {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        .stat-card {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 15px;
            margin: 5px;
            text-align: center;
            min-width: 150px;
        }
        .stat-value {
            font-size: 18px;
            font-weight: bold;
            color: #17423b;
        }
        .stat-label {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th {
            background: #17423b;
            color: white;
            padding: 12px;
            text-align: left;
            font-size: 12px;
        }
        .table td {
            padding: 10px;
            border-bottom: 1px solid #e9ecef;
            font-size: 11px;
        }
        .table tr:nth-child(even) {
            background: #f8f9fa;
        }
        .badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
        }
        .badge-success {
            background: #d4edda;
            color: #155724;
        }
        .badge-warning {
            background: #fff3cd;
            color: #856404;
        }
        .badge-danger {
            background: #f8d7da;
            color: #721c24;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #e9ecef;
            padding-top: 20px;
        }
        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Rapport des Paiements</h1>
        <p>Trans'urb GMAO</p>
        <p>Généré le {{ date('d/m/Y à H:i') }}</p>
    </div>

    <div class="stats">
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

    <table class="table">
        <thead>
            <tr>
                <th>Référence</th>
                <th>Fournisseur</th>
                <th>Date Commande</th>
                <th>Montant Total</th>
                <th>Avance</th>
                <th>Reste à payer</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commandes as $commande)
                <tr>
                    <td>{{ $commande->reference }}</td>
                    <td>{{ $commande->fournisseur->nom }}</td>
                    <td>{{ $commande->date_commande->format('d/m/Y') }}</td>
                    <td>{{ number_format($commande->montant_total, 0, ',', ' ') }} F CFA</td>
                    <td>{{ number_format($commande->avance, 0, ',', ' ') }} F CFA</td>
                    <td>{{ number_format($commande->reste_a_payer, 0, ',', ' ') }} F CFA</td>
                    <td>
                        @if($commande->statut_paiement == 'echu')
                            <span class="badge badge-success">Payé</span>
                        @elseif($commande->statut_paiement == 'redevance')
                            <span class="badge badge-warning">Redevance</span>
                        @else
                            <span class="badge badge-danger">Impayé</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Document généré automatiquement par le système Trans'urb GMAO</p>
        <p>Total des commandes : {{ $commandes->count() }} | Montant total : {{ number_format($commandes->sum('montant_total'), 0, ',', ' ') }} F CFA</p>
    </div>
</body>
</html> 