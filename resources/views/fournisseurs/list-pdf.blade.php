<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Fournisseurs - Trans'urb GMAO</title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #219150;
            padding-bottom: 20px;
        }
        
        .header h1 {
            color: #17423b;
            margin: 0;
            font-size: 24px;
        }
        
        .header p {
            color: #666;
            margin: 5px 0 0 0;
            font-size: 14px;
        }
        
        .stats {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 25px;
        }
        
        .stats h3 {
            color: #17423b;
            margin: 0 0 15px 0;
            font-size: 16px;
        }
        
        .stats-grid {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        
        .stat-item {
            text-align: center;
            flex: 1;
            min-width: 120px;
            margin: 5px;
        }
        
        .stat-value {
            font-size: 20px;
            font-weight: bold;
            color: #219150;
        }
        
        .stat-label {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 12px;
        }
        
        th {
            background: #219150;
            color: white;
            padding: 10px;
            text-align: left;
            font-weight: bold;
        }
        
        td {
            padding: 8px 10px;
            border-bottom: 1px solid #ddd;
        }
        
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        
        .score-badge {
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
            text-align: center;
            min-width: 60px;
        }
        
        .score-excellent { background: #d4edda; color: #155724; }
        .score-bon { background: #d1ecf1; color: #0c5460; }
        .score-moyen { background: #fff3cd; color: #856404; }
        .score-faible { background: #f8d7da; color: #721c24; }
        
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }
        
        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>📋 Liste des Fournisseurs</h1>
        <p>Trans'urb GMAO - Généré le {{ date('d/m/Y à H:i') }}</p>
    </div>

    <div class="stats">
        <h3>📊 Statistiques Globales</h3>
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-value">{{ $stats['total_fournisseurs'] }}</div>
                <div class="stat-label">Total fournisseurs</div>
            </div>
            <div class="stat-item">
                <div class="stat-value">{{ $stats['fournisseurs_avec_commandes'] }}</div>
                <div class="stat-label">Avec commandes</div>
            </div>
            <div class="stat-item">
                <div class="stat-value">{{ number_format($stats['montant_total'], 0, ',', ' ') }} FCFA</div>
                <div class="stat-label">Montant total</div>
            </div>
            <div class="stat-item">
                <div class="stat-value">{{ number_format($stats['moyenne_ponctualite'], 1) }}%</div>
                <div class="stat-label">Ponctualité moyenne</div>
            </div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Fournisseur</th>
                <th>Contact</th>
                <th>📦 Commandes</th>
                <th>💰 Montant total</th>
                <th>⏰ Ponctualité</th>
                <th>⭐ Score</th>
            </tr>
        </thead>
        <tbody>
            @forelse($fournisseurs as $fournisseur)
                <tr>
                    <td>
                        <strong>{{ $fournisseur->nom }}</strong><br>
                        <small style="color: #666;">{{ $fournisseur->type ?? 'Non spécifié' }}</small>
                    </td>
                    <td>
                        {{ $fournisseur->email }}<br>
                        <small style="color: #666;">{{ $fournisseur->telephone }}</small>
                    </td>
                    <td>
                        <strong>{{ $fournisseur->nombre_commandes }}</strong><br>
                        <small style="color: #666;">{{ $fournisseur->nombre_commandes_livrees }} livrées</small>
                    </td>
                    <td>
                        <strong>{{ number_format($fournisseur->montant_total_commandes, 0, ',', ' ') }} FCFA</strong>
                    </td>
                    <td>
                        <strong>{{ number_format($fournisseur->taux_ponctualite, 1) }}%</strong><br>
                        <small style="color: #666;">{{ $fournisseur->nombre_livraisons_a_temps }}/{{ $fournisseur->nombre_commandes_livrees }} à temps</small>
                    </td>
                    <td>
                        <div class="score-badge score-{{ strtolower($fournisseur->score_label) }}">
                            {{ $fournisseur->score_label }}
                        </div>
                        <small style="color: #666;">{{ $fournisseur->score_global }}/100</small>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #aaa; padding: 20px;">
                        Aucun fournisseur enregistré.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Document généré automatiquement par le système GMAO Trans'urb</p>
        <p>Page 1 sur 1</p>
    </div>
</body>
</html> 