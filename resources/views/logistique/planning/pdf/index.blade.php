<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planning - Logistique</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #17423b;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #17423b;
            font-size: 24px;
            margin: 0;
        }
        .header p {
            color: #666;
            margin: 5px 0 0 0;
        }
        .stats {
            display: flex;
            justify-content: space-around;
            margin-bottom: 30px;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
        }
        .stat-item {
            text-align: center;
        }
        .stat-value {
            font-size: 18px;
            font-weight: bold;
            color: #17423b;
        }
        .stat-label {
            font-size: 10px;
            color: #666;
            margin-top: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #17423b;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .status-badge {
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }
        .status-en-attente { background-color: #fff3cd; color: #856404; }
        .status-en-cours { background-color: #d1ecf1; color: #0c5460; }
        .status-terminee { background-color: #d4edda; color: #155724; }
        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #17423b;
            margin: 20px 0 10px 0;
            border-bottom: 1px solid #17423b;
            padding-bottom: 5px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Planning Maintenance - Logistique</h1>
        <p>GMAO Trans'urb - Généré le {{ date('d/m/Y à H:i') }}</p>
    </div>

    <div class="stats">
        <div class="stat-item">
            <div class="stat-value">{{ $planningMaintenances->count() }}</div>
            <div class="stat-label">Planifications</div>
        </div>
        <div class="stat-item">
            <div class="stat-value">{{ $interventions->count() }}</div>
            <div class="stat-label">Interventions</div>
        </div>
        <div class="stat-item">
            <div class="stat-value">{{ $carburations->count() }}</div>
            <div class="stat-label">Carburations</div>
        </div>
    </div>

    <div class="section-title">Planifications de Maintenance</div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Véhicule</th>
                <th>Date Planning</th>
                <th>Type Véhicule</th>
                <th>Marque</th>
                <th>Intervention</th>
            </tr>
        </thead>
        <tbody>
            @foreach($planningMaintenances as $planning)
            <tr>
                <td>#{{ $planning->id }}</td>
                <td>{{ $planning->vehicule->numero ?? 'N/A' }}</td>
                <td>{{ $planning->date_planifiee ? $planning->date_planifiee->format('d/m/Y') : 'Non définie' }}</td>
                <td>{{ $planning->vehicule->type_vehicule ?? 'N/A' }}</td>
                <td>{{ $planning->vehicule->marque ?? 'N/A' }}</td>
                <td>{{ Str::limit($planning->description_travaux, 30) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="section-title">Interventions Récentes</div>
    <table>
        <thead>
            <tr>
                <th>Véhicule</th>
                <th>Description</th>
                <th>Date Début</th>
                <th>Statut</th>
                <th>Signatures</th>
            </tr>
        </thead>
        <tbody>
            @foreach($interventions as $intervention)
            <tr>
                <td>{{ $intervention->vehicule->numero ?? 'N/A' }}</td>
                <td>{{ Str::limit($intervention->description, 40) }}</td>
                <td>{{ $intervention->date_debut ? $intervention->date_debut->format('d/m/Y') : 'Non définie' }}</td>
                <td>
                    <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $intervention->statut)) }}">
                        {{ $intervention->statut }}
                    </span>
                </td>
                <td>
                    @if($intervention->signatureMaintenanceUser)
                        <span style="color: green;">✓ Maint.</span>
                    @else
                        <span style="color: gray;">○ Maint.</span>
                    @endif
                    @if($intervention->signatureLogistiqueUser)
                        <span style="color: green;">✓ Log.</span>
                    @else
                        <span style="color: gray;">○ Log.</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="section-title">Carburations Récentes</div>
    <table>
        <thead>
            <tr>
                <th>Véhicule</th>
                <th>Chauffeur</th>
                <th>Date</th>
                <th>Quantité</th>
                <th>Prix Unitaire</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($carburations as $carburation)
            <tr>
                <td>{{ $carburation->vehicule->numero ?? 'N/A' }}</td>
                <td>{{ $carburation->chauffeur->nom ?? 'N/A' }}</td>
                <td>{{ $carburation->date_carburation ? $carburation->date_carburation->format('d/m/Y') : 'Non définie' }}</td>
                <td>{{ $carburation->quantite_litres ?? '-' }} L</td>
                <td>{{ $carburation->prix_litre ? number_format($carburation->prix_litre, 0, ',', ' ') . ' FCFA' : '-' }}</td>
                <td>
                    @if($carburation->quantite_litres && $carburation->prix_litre)
                        {{ number_format($carburation->quantite_litres * $carburation->prix_litre, 0, ',', ' ') }} FCFA
                    @else
                        -
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Document généré automatiquement par le système GMAO Trans'urb</p>
        <p>Module Logistique - Planning Maintenance</p>
    </div>
</body>
</html>
