<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Historique des Transactions - {{ date('d/m/Y') }}</title>
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
            font-size: 11px;
        }
        .table td {
            padding: 8px;
            border-bottom: 1px solid #e9ecef;
            font-size: 10px;
        }
        .table tr:nth-child(even) {
            background: #f8f9fa;
        }
        .badge {
            padding: 3px 6px;
            border-radius: 10px;
            font-size: 9px;
            font-weight: bold;
        }
        .badge-commande {
            background: #d1ecf1;
            color: #0c5460;
        }
        .badge-contrat {
            background: #d4edda;
            color: #155724;
        }
        .mode-badge {
            padding: 3px 6px;
            border-radius: 10px;
            font-size: 9px;
            font-weight: bold;
        }
        .mode-especes {
            background: #d4edda;
            color: #155724;
        }
        .mode-cheque {
            background: #d1ecf1;
            color: #0c5460;
        }
        .mode-virement {
            background: #e2d9f3;
            color: #6f42c1;
        }
        .mode-carte {
            background: #fff3cd;
            color: #856404;
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
        .summary {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .summary h3 {
            margin: 0 0 10px 0;
            color: #17423b;
            font-size: 14px;
        }
        .summary-grid {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .summary-item {
            margin: 5px;
            font-size: 11px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Historique des Transactions</h1>
        <p>Trans'urb GMAO</p>
        <p>Généré le {{ date('d/m/Y à H:i') }}</p>
    </div>

    <div class="stats">
        <div class="stat-card">
            <div class="stat-value">{{ number_format($stats['total_transactions']) }}</div>
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

    <div class="summary">
        <h3>Répartition par Mode de Paiement</h3>
        <div class="summary-grid">
            @foreach($stats['par_mode'] as $mode => $count)
                <div class="summary-item">
                    <strong>{{ ucfirst($mode) }}:</strong> {{ $count }} transaction(s)
                </div>
            @endforeach
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Référence</th>
                <th>Fournisseur</th>
                <th>Montant</th>
                <th>Mode</th>
                <th>Utilisateur</th>
                <th>Référence Paiement</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->date_paiement->format('d/m/Y H:i') }}</td>
                    <td>
                        @if($transaction->type == 'commande')
                            <span class="badge badge-commande">Commande</span>
                        @else
                            <span class="badge badge-contrat">Contrat</span>
                        @endif
                    </td>
                    <td>
                        @if($transaction->type == 'commande')
                            {{ $transaction->commande->reference ?? 'N/A' }}
                        @else
                            {{ $transaction->contrat->reference ?? 'N/A' }}
                        @endif
                    </td>
                    <td>
                        @if($transaction->type == 'commande')
                            {{ $transaction->commande->fournisseur->nom ?? 'N/A' }}
                        @else
                            {{ $transaction->contrat->fournisseur->nom ?? 'N/A' }}
                        @endif
                    </td>
                    <td>{{ number_format($transaction->montant, 0, ',', ' ') }} F CFA</td>
                    <td>
                        <span class="mode-badge mode-{{ $transaction->mode_paiement }}">
                            {{ $transaction->mode_paiement_label }}
                        </span>
                    </td>
                    <td>{{ $transaction->user->nom_complet ?? 'Utilisateur' }}</td>
                    <td>{{ $transaction->reference_paiement ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Document généré automatiquement par le système Trans'urb GMAO</p>
        <p>Total des transactions : {{ $transactions->count() }} | Montant total : {{ number_format($transactions->sum('montant'), 0, ',', ' ') }} F CFA</p>
        <p>Période : {{ $transactions->first()?->date_paiement->format('d/m/Y') ?? 'N/A' }} - {{ $transactions->last()?->date_paiement->format('d/m/Y') ?? 'N/A' }}</p>
    </div>
</body>
</html> 