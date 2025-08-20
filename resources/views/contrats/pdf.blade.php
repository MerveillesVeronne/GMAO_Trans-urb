<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Liste des Contrats - {{ now()->format('d/m/Y') }}</title>
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
        .stats {
            display: table;
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
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
        .contrats-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .contrats-table th {
            background: #f5f5f5;
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
            font-weight: bold;
            color: #17423b;
        }
        .contrats-table td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        .contrats-table tr:nth-child(even) {
            background: #f9f9f9;
        }
        .status-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: bold;
        }
        .status-actif {
            background: #eafaf4;
            color: #219150;
        }
        .status-suspendu {
            background: #fff3cd;
            color: #856404;
        }
        .status-resilie {
            background: #f8d7da;
            color: #721c24;
        }
        .status-expire {
            background: #f8d7da;
            color: #721c24;
        }
        .status-renouvele {
            background: #d1ecf1;
            color: #0c5460;
        }
        .categories-section {
            margin-top: 30px;
            page-break-inside: avoid;
        }
        .category-title {
            color: #17423b;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
            border-bottom: 2px solid #e0e0e0;
            padding-bottom: 5px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #e0e0e0;
            padding-top: 20px;
        }
        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <!-- En-tête -->
    <div class="header">
        <h1>📋 Liste des Contrats</h1>
        <div class="date">Généré le {{ now()->format('d/m/Y à H:i') }}</div>
    </div>

    <!-- Statistiques -->
    <div class="stats">
        <div class="stat-box">
            <div class="stat-value">{{ $stats['total_contrats'] }}</div>
            <div class="stat-label">Total contrats</div>
        </div>
        <div class="stat-box">
            <div class="stat-value">{{ $stats['contrats_actifs'] }}</div>
            <div class="stat-label">Contrats actifs</div>
        </div>
        <div class="stat-box">
            <div class="stat-value">{{ number_format($stats['montant_total'], 0, ',', ' ') }} FCFA</div>
            <div class="stat-label">Montant total</div>
        </div>
        <div class="stat-box">
            <div class="stat-value">{{ count($stats['categories']) }}</div>
            <div class="stat-label">Catégories</div>
        </div>
    </div>

    <!-- Liste des contrats -->
    @if($contrats->count() > 0)
        <table class="contrats-table">
            <thead>
                <tr>
                    <th>Référence</th>
                    <th>Intitulé</th>
                    <th>Fournisseur</th>
                    <th>Catégorie</th>
                    <th>Montant</th>
                    <th>Statut</th>
                    <th>Date fin</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contrats as $contrat)
                    <tr>
                        <td>{{ $contrat->reference }}</td>
                        <td>{{ $contrat->intitule }}</td>
                        <td>{{ $contrat->fournisseur ? $contrat->fournisseur->nom : 'N/A' }}</td>
                        <td>{{ $contrat->categorie_label }}</td>
                        <td>{{ number_format($contrat->montant, 0, ',', ' ') }} FCFA</td>
                        <td>
                            <span class="status-badge status-{{ $contrat->statut }}">
                                {{ ucfirst($contrat->statut) }}
                            </span>
                        </td>
                        <td>{{ $contrat->date_fin ? $contrat->date_fin->format('d/m/Y') : 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="text-align: center; color: #999; font-style: italic;">Aucun contrat trouvé</p>
    @endif

    <!-- Répartition par catégories -->
    @if($stats['categories']->count() > 0)
        <div class="categories-section">
            <div class="category-title">📊 Répartition par catégories</div>
            <table class="contrats-table">
                <thead>
                    <tr>
                        <th>Catégorie</th>
                        <th>Nombre de contrats</th>
                        <th>Montant total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stats['categories'] as $categorie => $count)
                        @php
                            $contratsCategorie = $contrats->where('categorie', $categorie);
                            $montantTotal = $contratsCategorie->sum('montant');
                        @endphp
                        <tr>
                            <td>{{ App\Models\Contrat::getCategories()[$categorie] ?? $categorie }}</td>
                            <td>{{ $count }}</td>
                            <td>{{ number_format($montantTotal, 0, ',', ' ') }} FCFA</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <!-- Pied de page -->
    <div class="footer">
        <p>Document généré automatiquement par GMAO Trans'urb</p>
        <p>Date : {{ now()->format('d/m/Y H:i') }}</p>
    </div>
</body>
</html> 