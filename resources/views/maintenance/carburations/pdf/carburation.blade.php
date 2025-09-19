<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche Carburation - {{ $carburation->vehicule->numero }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.4;
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
            font-weight: bold;
        }
        .header .subtitle {
            color: #666;
            font-size: 14px;
            margin-top: 5px;
        }
        .info-section {
            margin-bottom: 25px;
        }
        .info-section h2 {
            color: #17423b;
            font-size: 16px;
            margin-bottom: 15px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        .info-grid {
            display: table;
            width: 100%;
            margin-bottom: 15px;
        }
        .info-row {
            display: table-row;
        }
        .info-label {
            display: table-cell;
            width: 30%;
            font-weight: bold;
            padding: 8px 0;
            vertical-align: top;
        }
        .info-value {
            display: table-cell;
            padding: 8px 0 8px 15px;
            vertical-align: top;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-planifiee { background-color: #fff3cd; color: #856404; }
        .status-effectuee { background-color: #d4edda; color: #155724; }
        .status-annulee { background-color: #f8d7da; color: #721c24; }
        .type-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .type-diesel { background-color: #d1ecf1; color: #0c5460; }
        .type-essence { background-color: #f8d7da; color: #721c24; }
        .type-gpl { background-color: #d4edda; color: #155724; }
        .type-electrique { background-color: #e2e3e5; color: #383d41; }
        .cost-highlight {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 5px;
            padding: 15px;
            margin-top: 10px;
            text-align: center;
        }
        .cost-amount {
            font-size: 18px;
            font-weight: bold;
            color: #17423b;
        }
        .notes-box {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 15px;
            margin-top: 10px;
        }
        .footer {
            position: fixed;
            bottom: 20px;
            left: 20px;
            right: 20px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <!-- En-tête -->
    <div class="header">
        <h1>FICHE DE CARBURATION</h1>
        <div class="subtitle">GMAO Trans'urb - {{ date('d/m/Y H:i') }}</div>
    </div>

    <!-- Informations générales -->
    <div class="info-section">
        <h2>🚌 Informations du Véhicule</h2>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Véhicule :</div>
                <div class="info-value">{{ $carburation->vehicule->numero }} - {{ $carburation->vehicule->marque }} {{ $carburation->vehicule->modele }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Immatriculation :</div>
                <div class="info-value">{{ $carburation->vehicule->immatriculation }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Type de véhicule :</div>
                <div class="info-value">{{ $carburation->vehicule->type_vehicule ?? 'Non spécifié' }}</div>
            </div>
        </div>
    </div>

    <!-- Informations de carburation -->
    <div class="info-section">
        <h2>⛽ Détails de la Carburation</h2>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Date :</div>
                <div class="info-value">{{ \Carbon\Carbon::parse($carburation->date_carburation)->format('d/m/Y') }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Heure :</div>
                <div class="info-value">{{ \Carbon\Carbon::parse($carburation->heure_carburation)->format('H:i') }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Type de carburant :</div>
                <div class="info-value">
                    <span class="type-badge type-{{ strtolower($carburation->type_carburation) }}">
                        {{ $carburation->type_carburation }}
                    </span>
                </div>
            </div>
            <div class="info-row">
                <div class="info-label">Quantité (litres) :</div>
                <div class="info-value">{{ number_format($carburation->quantite_litres, 2, ',', ' ') }} L</div>
            </div>
            <div class="info-row">
                <div class="info-label">Prix par litre :</div>
                <div class="info-value">{{ number_format($carburation->prix_litre, 0, ',', ' ') }} FCFA</div>
            </div>
            <div class="info-row">
                <div class="info-label">État :</div>
                <div class="info-value">
                    <span class="status-badge status-{{ strtolower($carburation->etat) }}">
                        {{ $carburation->etat }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Personnel -->
    <div class="info-section">
        <h2>👤 Personnel</h2>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Chauffeur :</div>
                <div class="info-value">{{ $carburation->chauffeur->nom }} {{ $carburation->chauffeur->prenom }}</div>
            </div>
            @if($carburation->chauffeur->telephone)
            <div class="info-row">
                <div class="info-label">Téléphone :</div>
                <div class="info-value">{{ $carburation->chauffeur->telephone }}</div>
            </div>
            @endif
        </div>
    </div>

    <!-- Coût total -->
    <div class="info-section">
        <h2>💰 Coût Total</h2>
        <div class="cost-highlight">
            <div style="font-size: 14px; margin-bottom: 5px;">Coût total de la carburation</div>
            <div class="cost-amount">{{ number_format($carburation->cout_total, 0, ',', ' ') }} FCFA</div>
            <div style="font-size: 12px; color: #666; margin-top: 5px;">
                {{ number_format($carburation->quantite_litres, 2, ',', ' ') }} L × {{ number_format($carburation->prix_litre, 0, ',', ' ') }} FCFA/L
            </div>
        </div>
    </div>

    <!-- Notes -->
    @if($carburation->notes)
    <div class="info-section">
        <h2>📝 Notes</h2>
        <div class="notes-box">
            {{ $carburation->notes }}
        </div>
    </div>
    @endif

    <!-- Informations système -->
    <div class="info-section">
        <h2>ℹ️ Informations Système</h2>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Créé le :</div>
                <div class="info-value">{{ \Carbon\Carbon::parse($carburation->created_at)->format('d/m/Y H:i') }}</div>
            </div>
            @if($carburation->updated_at != $carburation->created_at)
            <div class="info-row">
                <div class="info-label">Modifié le :</div>
                <div class="info-value">{{ \Carbon\Carbon::parse($carburation->updated_at)->format('d/m/Y H:i') }}</div>
            </div>
            @endif
        </div>
    </div>

    <!-- Pied de page -->
    <div class="footer">
        Document généré automatiquement par le système GMAO Trans'urb le {{ date('d/m/Y à H:i') }}
    </div>
</body>
</html>
