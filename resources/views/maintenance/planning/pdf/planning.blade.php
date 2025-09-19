<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planning Maintenance - GMAO Trans'urb</title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #17423b;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #17423b;
            font-size: 24px;
            margin: 0 0 10px 0;
        }
        .header .subtitle {
            color: #666;
            font-size: 14px;
            margin: 0;
        }
        .stats {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
        }
        .stat-item {
            text-align: center;
            flex: 1;
        }
        .stat-value {
            font-size: 18px;
            font-weight: bold;
            color: #17423b;
        }
        .stat-label {
            font-size: 11px;
            color: #666;
            margin-top: 5px;
        }
        .section {
            margin-bottom: 30px;
        }
        .section-title {
            background: #17423b;
            color: white;
            padding: 10px 15px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 5px 5px 0 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th {
            background: #e9ecef;
            color: #17423b;
            padding: 8px;
            text-align: left;
            font-size: 11px;
            border: 1px solid #dee2e6;
        }
        .table td {
            padding: 8px;
            border: 1px solid #dee2e6;
            font-size: 11px;
        }
        .table tr:nth-child(even) {
            background: #f8f9fa;
        }
        .status {
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
            text-align: center;
        }
        .status-planifiee { background: #fff3cd; color: #856404; }
        .status-en-cours { background: #d1ecf1; color: #0c5460; }
        .status-terminee { background: #d4edda; color: #155724; }
        .status-annulee { background: #f8d7da; color: #721c24; }
        .type-badge {
            padding: 2px 6px;
            border-radius: 8px;
            font-size: 9px;
            font-weight: bold;
        }
        .type-intervention { background: #e3f2fd; color: #1565c0; }
        .type-carburation { background: #fff8e1; color: #f57f17; }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #dee2e6;
            padding-top: 20px;
        }
        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>GMAO Trans'urb</h1>
        <p class="subtitle">Planning des Planifications - {{ now()->format('d/m/Y') }}</p>
        @if($type !== 'all')
            <p class="subtitle">Filtre : {{ $type === 'interventions' ? 'Interventions uniquement' : 'Carburations uniquement' }}</p>
        @endif
    </div>

    <div class="stats">
        <div class="stat-item">
            <div class="stat-value">{{ $planningMaintenances->count() + $carburations->count() }}</div>
            <div class="stat-label">Total Planifications</div>
        </div>
        <div class="stat-item">
            <div class="stat-value">{{ $planningMaintenances->count() }}</div>
            <div class="stat-label">Interventions</div>
        </div>
        <div class="stat-item">
            <div class="stat-value">{{ $carburations->count() }}</div>
            <div class="stat-label">Carburations</div>
        </div>
        <div class="stat-item">
            <div class="stat-value">{{ $planningMaintenances->where('statut', 'Planifiee')->count() + $carburations->where('etat', 'Planifiée')->count() }}</div>
            <div class="stat-label">Planifiées</div>
        </div>
    </div>

    @if($planningMaintenances->count() > 0)
    <div class="section">
        <div class="section-title">
            <i class="fas fa-tools"></i> Interventions Planifiées
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Véhicule</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Statut</th>
                    <th>Technicien</th>
                    <th>Priorité</th>
                </tr>
            </thead>
            <tbody>
                @foreach($planningMaintenances as $planning)
                <tr>
                    <td>
                        <strong>{{ $planning->vehicule->numero }}</strong><br>
                        <small>{{ $planning->vehicule->immatriculation }}</small>
                    </td>
                    <td>
                        <span class="type-badge type-intervention">{{ $planning->type_maintenance }}</span>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($planning->date_planifiee)->format('d/m/Y') }}</td>
                    <td>{{ $planning->heure_debut }}</td>
                    <td>
                        @php
                            $statusClass = 'status-' . strtolower(str_replace(' ', '-', $planning->statut));
                        @endphp
                        <span class="status {{ $statusClass }}">{{ $planning->statut }}</span>
                    </td>
                    <td>{{ $planning->technicien }}</td>
                    <td>{{ $planning->priorite }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    @if($carburations->count() > 0)
    <div class="section">
        <div class="section-title">
            <i class="fas fa-gas-pump"></i> Carburations Planifiées
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Véhicule</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>État</th>
                    <th>Chauffeur</th>
                    <th>Quantité</th>
                </tr>
            </thead>
            <tbody>
                @foreach($carburations as $carburation)
                <tr>
                    <td>
                        <strong>{{ $carburation->vehicule->numero }}</strong><br>
                        <small>{{ $carburation->vehicule->immatriculation }}</small>
                    </td>
                    <td>
                        <span class="type-badge type-carburation">{{ $carburation->type_carburation }}</span>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($carburation->date_carburation)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($carburation->heure_carburation)->format('H:i') }}</td>
                    <td>
                        @php
                            $statusClass = 'status-' . strtolower(str_replace(' ', '-', $carburation->etat));
                        @endphp
                        <span class="status {{ $statusClass }}">{{ $carburation->etat }}</span>
                    </td>
                    <td>{{ $carburation->chauffeur->nom ?? 'N/A' }} {{ $carburation->chauffeur->prenom ?? '' }}</td>
                    <td>{{ number_format($carburation->quantite_litres, 2, ',', ' ') }} L</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <div class="footer">
        <p>Document généré le {{ now()->format('d/m/Y à H:i') }} par GMAO Trans'urb</p>
        <p>Total : {{ $planningMaintenances->count() + $carburations->count() }} planifications</p>
    </div>
</body>
</html>



