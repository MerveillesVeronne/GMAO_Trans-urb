<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Fiche Fournisseur - {{ $fournisseur->nom }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #219150;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #17423b;
            font-size: 28px;
            margin: 0;
        }
        .header .date {
            color: #666;
            font-size: 14px;
            margin-top: 10px;
        }
        .section {
            margin-bottom: 30px;
            page-break-inside: avoid;
        }
        .section h2 {
            color: #17423b;
            font-size: 20px;
            border-bottom: 2px solid #e0e0e0;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .info-grid {
            display: table;
            width: 100%;
            border-collapse: collapse;
        }
        .info-row {
            display: table-row;
        }
        .info-cell {
            display: table-cell;
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        .info-label {
            font-weight: bold;
            color: #666;
            width: 30%;
        }
        .info-value {
            color: #333;
        }
        .stats-grid {
            display: table;
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .stat-box {
            display: table-cell;
            width: 25%;
            text-align: center;
            padding: 15px;
            border: 1px solid #e0e0e0;
            background: #f9f9f9;
        }
        .stat-value {
            font-size: 24px;
            font-weight: bold;
            color: #219150;
            margin-bottom: 5px;
        }
        .stat-label {
            font-size: 12px;
            color: #666;
        }
        .score-box {
            text-align: center;
            padding: 20px;
            border: 2px solid #219150;
            background: #f0f8f0;
            margin: 20px 0;
        }
        .score-value {
            font-size: 36px;
            font-weight: bold;
            color: #219150;
            margin-bottom: 10px;
        }
        .score-label {
            font-size: 18px;
            color: #17423b;
            font-weight: bold;
        }
        .commandes-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .commandes-table th {
            background: #f5f5f5;
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
            font-weight: bold;
            color: #17423b;
        }
        .commandes-table td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        .commandes-table tr:nth-child(even) {
            background: #f9f9f9;
        }
        .status-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: bold;
        }
        .status-livree {
            background: #eafaf4;
            color: #219150;
        }
        .status-en_cours {
            background: #fff3cd;
            color: #856404;
        }
        .status-en_attente {
            background: #f8d7da;
            color: #721c24;
        }
        .evolution-grid {
            display: table;
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .evolution-box {
            display: table-cell;
            width: 16.66%;
            text-align: center;
            padding: 10px;
            border: 1px solid #e0e0e0;
            background: #f9f9f9;
        }
        .evolution-month {
            font-weight: bold;
            color: #17423b;
            font-size: 12px;
        }
        .evolution-count {
            font-size: 18px;
            font-weight: bold;
            color: #219150;
            margin: 5px 0;
        }
        .evolution-amount {
            font-size: 10px;
            color: #666;
        }
        .page-break {
            page-break-before: always;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #e0e0e0;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <!-- En-tête -->
    <div class="header">
        <h1>📊 Fiche Fournisseur</h1>
        <div class="date">Généré le {{ now()->format('d/m/Y à H:i') }}</div>
    </div>

    <!-- Informations générales -->
    <div class="section">
        <h2>👤 Informations générales</h2>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-cell info-label">Nom du fournisseur :</div>
                <div class="info-cell info-value">{{ $fournisseur->nom }}</div>
            </div>
            <div class="info-row">
                <div class="info-cell info-label">Email :</div>
                <div class="info-cell info-value">{{ $fournisseur->email }}</div>
            </div>
            <div class="info-row">
                <div class="info-cell info-label">Téléphone :</div>
                <div class="info-cell info-value">{{ $fournisseur->telephone }}</div>
            </div>
            <div class="info-row">
                <div class="info-cell info-label">Type :</div>
                <div class="info-cell info-value">{{ $fournisseur->type ?: 'Non spécifié' }}</div>
            </div>
            <div class="info-row">
                <div class="info-cell info-label">Responsable :</div>
                <div class="info-cell info-value">{{ $fournisseur->responsable ?: 'Non spécifié' }}</div>
            </div>
        </div>
    </div>

    <!-- Adresse -->
    <div class="section">
        <h2>📍 Adresse</h2>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-cell info-label">Adresse :</div>
                <div class="info-cell info-value">{{ $fournisseur->adresse ?: 'Non spécifiée' }}</div>
            </div>
            <div class="info-row">
                <div class="info-cell info-label">Ville :</div>
                <div class="info-cell info-value">{{ $fournisseur->ville ?: 'Non spécifiée' }}</div>
            </div>
            <div class="info-row">
                <div class="info-cell info-label">Pays :</div>
                <div class="info-cell info-value">{{ $fournisseur->pays ?: 'Non spécifié' }}</div>
            </div>
        </div>
    </div>

    <!-- Score et performance -->
    <div class="section">
        <h2>📈 Score et performance</h2>
        
        <!-- Score principal -->
        <div class="score-box">
            <div class="score-value">{{ $stats['score_global'] }}/100</div>
            <div class="score-label">{{ $stats['score_label'] }}</div>
        </div>

        <!-- Statistiques détaillées -->
        <div class="stats-grid">
            <div class="stat-box">
                <div class="stat-value">{{ $stats['total_commandes'] }}</div>
                <div class="stat-label">Total commandes</div>
            </div>
            <div class="stat-box">
                <div class="stat-value">{{ number_format($stats['montant_total'], 0, ',', ' ') }} FCFA</div>
                <div class="stat-label">Montant total</div>
            </div>
            <div class="stat-box">
                <div class="stat-value">{{ $stats['taux_ponctualite'] }}%</div>
                <div class="stat-label">Ponctualité</div>
                <div style="font-size: 10px; color: #999;">{{ $stats['livraisons_a_temps'] }}/{{ $stats['commandes_livrees'] }} livraisons</div>
            </div>
            <div class="stat-box">
                <div class="stat-value">{{ $stats['commandes_livrees'] }}</div>
                <div class="stat-label">Commandes livrées</div>
            </div>
        </div>
    </div>

    <!-- Commandes récentes -->
    <div class="section">
        <h2>📦 Commandes récentes</h2>
        @if($commandes_recentes->count() > 0)
            <table class="commandes-table">
                <thead>
                    <tr>
                        <th>Référence</th>
                        <th>Bon de commande</th>
                        <th>Montant</th>
                        <th>Statut</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($commandes_recentes as $commande)
                        <tr>
                            <td>{{ $commande->reference }}</td>
                            <td>{{ $commande->bonCommande ? $commande->bonCommande->reference : '-' }}</td>
                            <td>{{ number_format($commande->montant_total, 0, ',', ' ') }} FCFA</td>
                            <td>
                                <span class="status-badge status-{{ $commande->statut }}">
                                    {{ ucfirst($commande->statut) }}
                                </span>
                            </td>
                            <td>{{ $commande->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="text-align: center; color: #999; font-style: italic;">Aucune commande pour ce fournisseur</p>
        @endif
    </div>

    <!-- Évolution mensuelle -->
    @if($evolution_mensuelle->count() > 0)
        <div class="section">
            <h2>📊 Évolution des commandes (6 derniers mois)</h2>
            <div class="evolution-grid">
                @foreach($evolution_mensuelle as $evolution)
                    <div class="evolution-box">
                        <div class="evolution-month">
                            {{ \Carbon\Carbon::createFromDate($evolution->annee, $evolution->mois, 1)->format('M Y') }}
                        </div>
                        <div class="evolution-count">{{ $evolution->nombre }}</div>
                        <div class="evolution-amount">{{ number_format($evolution->montant, 0, ',', ' ') }} FCFA</div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Pied de page -->
    <div class="footer">
        <p>Document généré automatiquement par GMAO Trans'urb</p>
        <p>Fournisseur : {{ $fournisseur->nom }} | Date : {{ now()->format('d/m/Y H:i') }}</p>
    </div>
</body>
</html> 