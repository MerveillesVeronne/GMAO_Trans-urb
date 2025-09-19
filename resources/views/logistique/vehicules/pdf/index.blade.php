<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Véhicules - Logistique</title>
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
        .status-en-service { background-color: #d4edda; color: #155724; }
        .status-au-garage { background-color: #fff3cd; color: #856404; }
        .status-en-reparation { background-color: #f8d7da; color: #721c24; }
        .status-maintenance { background-color: #d1ecf1; color: #0c5460; }
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
        <h1>Inventaire des Véhicules - Logistique</h1>
        <p>GMAO Trans'urb - Généré le {{ date('d/m/Y à H:i') }}</p>
    </div>

    <div class="stats">
        <div class="stat-item">
            <div class="stat-value">{{ $stats['en_service'] }}</div>
            <div class="stat-label">En Service</div>
        </div>
        <div class="stat-item">
            <div class="stat-value">{{ $stats['au_garage'] }}</div>
            <div class="stat-label">Au Garage</div>
        </div>
        <div class="stat-item">
            <div class="stat-value">{{ $stats['en_reparation'] }}</div>
            <div class="stat-label">En Réparation</div>
        </div>
        <div class="stat-item">
            <div class="stat-value">{{ $stats['maintenance'] }}</div>
            <div class="stat-label">Maintenance</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Numéro</th>
                <th>Immatriculation</th>
                <th>Type</th>
                <th>Marque</th>
                <th>Modèle</th>
                <th>Année</th>
                <th>Statut</th>
                <th>Ligne</th>
                <th>Kilométrage</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vehicules as $vehicule)
            <tr>
                <td>{{ $vehicule->numero }}</td>
                <td>{{ $vehicule->immatriculation }}</td>
                <td>{{ $vehicule->type_vehicule ?? 'N/A' }}</td>
                <td>{{ $vehicule->marque }}</td>
                <td>{{ $vehicule->modele }}</td>
                <td>{{ $vehicule->annee }}</td>
                <td>
                    <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $vehicule->statut)) }}">
                        {{ $vehicule->statut }}
                    </span>
                </td>
                <td>{{ $vehicule->ligne ?? 'Non assigné' }}</td>
                <td>
                    @if($vehicule->kilometrage)
                        {{ number_format($vehicule->kilometrage, 0, ',', ' ') }} km
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
        <p>Module Logistique - Consultation des véhicules</p>
    </div>
</body>
</html>


