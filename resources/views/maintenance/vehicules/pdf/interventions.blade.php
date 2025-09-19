<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interventions - {{ $vehicule->numero }} - GMAO Trans'urb</title>
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
        .vehicule-info {
            background: #f8fafc;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            border-left: 4px solid #2563eb;
        }
        .vehicule-info h2 {
            margin: 0 0 15px 0;
            color: #2563eb;
            font-size: 18px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        .info-item {
            display: flex;
            align-items: center;
        }
        .info-label {
            font-weight: bold;
            min-width: 120px;
            color: #666;
        }
        .info-value {
            color: #333;
        }
        .interventions-section h2 {
            color: #2563eb;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
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
        .status-en-cours { color: #d97706; }
        .status-terminee { color: #059669; }
        .status-annulee { color: #dc2626; }
        .priorite-haute { color: #dc2626; font-weight: bold; }
        .priorite-moyenne { color: #d97706; }
        .priorite-basse { color: #059669; }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
        .no-interventions {
            text-align: center;
            padding: 40px;
            color: #666;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>GMAO Trans'urb</h1>
        <p>Interventions du Véhicule {{ $vehicule->numero }}</p>
        <p>Généré le {{ date('d/m/Y à H:i') }}</p>
    </div>

    <div class="vehicule-info">
        <h2>Informations du Véhicule</h2>
        <div class="info-grid">
            <div class="info-item">
                <span class="info-label">Numéro :</span>
                <span class="info-value">{{ $vehicule->numero }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Immatriculation :</span>
                <span class="info-value">{{ $vehicule->immatriculation }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Type :</span>
                <span class="info-value">{{ $vehicule->type_vehicule }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Marque :</span>
                <span class="info-value">{{ $vehicule->marque }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Modèle :</span>
                <span class="info-value">{{ $vehicule->modele }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Année :</span>
                <span class="info-value">{{ $vehicule->annee }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Affectation :</span>
                <span class="info-value">
                    {{ $vehicule->affectation }}
                    @if($vehicule->affectation === 'Location' && $vehicule->entite_location)
                        ({{ $vehicule->entite_location }})
                    @endif
                </span>
            </div>
            <div class="info-item">
                <span class="info-label">Ligne :</span>
                <span class="info-value">
                    @if($vehicule->ligneTransport)
                        {{ $vehicule->ligneTransport->nom }}
                    @else
                        Non assignée
                    @endif
                </span>
            </div>
            <div class="info-item">
                <span class="info-label">Statut :</span>
                <span class="info-value">{{ $vehicule->statut }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Capacité :</span>
                <span class="info-value">
                    @if($vehicule->capacite)
                        {{ $vehicule->capacite }} places
                    @else
                        Non définie
                    @endif
                </span>
            </div>
            <div class="info-item">
                <span class="info-label">Kilométrage :</span>
                <span class="info-value">
                    @if($vehicule->kilometrage)
                        {{ number_format($vehicule->kilometrage, 0, ',', ' ') }} km
                    @else
                        Non défini
                    @endif
                </span>
            </div>
        </div>
    </div>

    <div class="interventions-section">
        <h2>Historique des Interventions</h2>
        
        @if($vehicule->interventions->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Nature</th>
                        <th>Description</th>
                        <th>Technicien</th>
                        <th>Priorité</th>
                        <th>Statut</th>
                        <th>Coût</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vehicule->interventions->sortByDesc('date_intervention') as $intervention)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($intervention->date_intervention)->format('d/m/Y') }}</td>
                        <td>{{ $intervention->nature_intervention ?? '-' }}</td>
                        <td>{{ Str::limit($intervention->description, 50) }}</td>
                        <td>
                            @if($intervention->intervenant)
                                {{ $intervention->intervenant->nom }} {{ $intervention->intervenant->prenom }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="priorite-{{ strtolower($intervention->priorite) }}">
                            {{ $intervention->priorite }}
                        </td>
                        <td class="status-{{ strtolower($intervention->statut) }}">
                            {{ $intervention->statut }}
                        </td>
                        <td>
                            @if($intervention->cout_total)
                                {{ number_format($intervention->cout_total, 0, ',', ' ') }} FCFA
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div style="margin-top: 20px;">
                <h3>Résumé des Interventions</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Total interventions :</span>
                        <span class="info-value">{{ $vehicule->interventions->count() }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">En cours :</span>
                        <span class="info-value">{{ $vehicule->interventions->where('statut', 'En cours')->count() }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Terminées :</span>
                        <span class="info-value">{{ $vehicule->interventions->where('statut', 'Terminée')->count() }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Coût total :</span>
                        <span class="info-value">
                            {{ number_format($vehicule->interventions->sum('cout_total'), 0, ',', ' ') }} FCFA
                        </span>
                    </div>
                </div>
            </div>
        @else
            <div class="no-interventions">
                <p>Aucune intervention enregistrée pour ce véhicule.</p>
            </div>
        @endif
    </div>

    <div class="carburations-section">
        <h2>Historique des Carburations</h2>
        
        @if($vehicule->carburations->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Date & Heure</th>
                        <th>Chauffeur</th>
                        <th>Type</th>
                        <th>Quantité</th>
                        <th>Prix/L</th>
                        <th>Coût Total</th>
                        <th>État</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vehicule->carburations->sortByDesc('date_carburation') as $carburation)
                    <tr>
                        <td>{{ $carburation->date_carburation->format('d/m/Y H:i') }}</td>
                        <td>
                            @if($carburation->chauffeur)
                                {{ $carburation->chauffeur->nom }} {{ $carburation->chauffeur->prenom }}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $carburation->type_carburation }}</td>
                        <td>{{ number_format($carburation->quantite_litres, 2, ',', ' ') }} L</td>
                        <td>{{ number_format($carburation->prix_litre, 0, ',', ' ') }} FCFA</td>
                        <td>{{ number_format($carburation->cout_total, 0, ',', ' ') }} FCFA</td>
                        <td class="status-{{ strtolower($carburation->etat) }}">
                            {{ $carburation->etat }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div style="margin-top: 20px;">
                <h3>Résumé des Carburations</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Total carburations :</span>
                        <span class="info-value">{{ $vehicule->carburations->count() }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Planifiées :</span>
                        <span class="info-value">{{ $vehicule->carburations->where('etat', 'Planifiée')->count() }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Effectuées :</span>
                        <span class="info-value">{{ $vehicule->carburations->where('etat', 'Effectuée')->count() }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Coût total :</span>
                        <span class="info-value">
                            {{ number_format($vehicule->carburations->sum('cout_total'), 0, ',', ' ') }} FCFA
                        </span>
                    </div>
                </div>
            </div>
        @else
            <div class="no-interventions">
                <p>Aucune carburation enregistrée pour ce véhicule.</p>
            </div>
        @endif
    </div>

    <div class="footer">
        <p>Document généré automatiquement par le système GMAO Trans'urb</p>
        <p>Véhicule : {{ $vehicule->numero }} | Total interventions : {{ $vehicule->interventions->count() }}</p>
    </div>
</body>
</html>
