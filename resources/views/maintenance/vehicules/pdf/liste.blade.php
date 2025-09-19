<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Véhicules - GMAO Trans'urb</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #2563eb;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #2563eb;
            margin: 0;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .stats {
            display: flex;
            justify-content: space-around;
            margin-bottom: 30px;
            background: #f8fafc;
            padding: 15px;
            border-radius: 8px;
        }
        .stat-item {
            text-align: center;
        }
        .stat-number {
            font-size: 24px;
            font-weight: bold;
            color: #2563eb;
        }
        .stat-label {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 10px;
        }
        th {
            background-color: #2563eb;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
        .status-en-service { color: #059669; }
        .status-au-garage { color: #dc2626; }
        .status-en-reparation { color: #d97706; }
        .status-maintenance { color: #7c3aed; }
    </style>
</head>
<body>
    <div class="header">
        <h1>GMAO Trans'urb</h1>
        <p>Liste des Véhicules</p>
        <p>Généré le {{ date('d/m/Y à H:i') }}</p>
    </div>

    <div class="stats">
        <div class="stat-item">
            <div class="stat-number">{{ $vehicules->where('statut', 'En Service')->count() }}</div>
            <div class="stat-label">En Service</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ $vehicules->where('statut', 'Au Garage')->count() }}</div>
            <div class="stat-label">Au Garage</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ $vehicules->where('statut', 'En Réparation')->count() }}</div>
            <div class="stat-label">En Réparation</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ $vehicules->where('statut', 'Maintenance')->count() }}</div>
            <div class="stat-label">Maintenance</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>N°</th>
                <th>Immatriculation</th>
                <th>Type</th>
                <th>Marque</th>
                <th>Modèle</th>
                <th>Année</th>
                <th>Affectation</th>
                <th>Ligne</th>
                <th>Statut</th>
                <th>Capacité</th>
                <th>Kilométrage</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vehicules as $vehicule)
            <tr>
                <td>{{ $vehicule->numero }}</td>
                <td>{{ $vehicule->immatriculation }}</td>
                <td>{{ $vehicule->type_vehicule }}</td>
                <td>{{ $vehicule->marque }}</td>
                <td>{{ $vehicule->modele }}</td>
                <td>{{ $vehicule->annee }}</td>
                <td>
                    {{ $vehicule->affectation }}
                    @if($vehicule->affectation === 'Location' && $vehicule->entite_location)
                        <br><small>({{ $vehicule->entite_location }})</small>
                    @endif
                </td>
                <td>
                    @if($vehicule->ligneTransport)
                        {{ $vehicule->ligneTransport->nom }}
                    @else
                        -
                    @endif
                </td>
                <td class="status-{{ strtolower(str_replace(' ', '-', $vehicule->statut)) }}">
                    {{ $vehicule->statut }}
                </td>
                <td>
                    @if($vehicule->capacite)
                        {{ $vehicule->capacite }} places
                    @else
                        -
                    @endif
                </td>
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
        <p>Total : {{ $vehicules->count() }} véhicule(s)</p>
    </div>
</body>
</html>
