<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche Intervention - {{ $intervention->vehicule->numero }}</title>
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
        .status-en-attente { background-color: #fef3cd; color: #856404; }
        .status-en-cours { background-color: #d1ecf1; color: #0c5460; }
        .status-terminee { background-color: #d4edda; color: #155724; }
        .status-annulee { background-color: #f8d7da; color: #721c24; }
        .status-livre { background-color: #d4edda; color: #155724; }
        .priority-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .priority-normal { background-color: #e2e3e5; color: #383d41; }
        .priority-a-prevoir { background-color: #fff3cd; color: #856404; }
        .priority-urgent { background-color: #f8d7da; color: #721c24; }
        .description-box {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 15px;
            margin-top: 10px;
        }
        .signatures {
            margin-top: 30px;
            page-break-inside: avoid;
        }
        .signature-box {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin: 10px 0;
            min-height: 80px;
        }
        .signature-label {
            font-weight: bold;
            margin-bottom: 10px;
            color: #17423b;
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
        <h1>FICHE D'INTERVENTION</h1>
        <div class="subtitle">GMAO Trans'urb - {{ date('d/m/Y H:i') }}</div>
    </div>

    <!-- Informations générales -->
    <div class="info-section">
        <h2>📋 Informations Générales</h2>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Véhicule :</div>
                <div class="info-value">{{ $intervention->vehicule->numero }} - {{ $intervention->vehicule->marque }} {{ $intervention->vehicule->modele }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Immatriculation :</div>
                <div class="info-value">{{ $intervention->vehicule->immatriculation }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Type d'intervention :</div>
                <div class="info-value">{{ $intervention->type_intervention }}</div>
            </div>
            @if($intervention->nature_intervention)
            <div class="info-row">
                <div class="info-label">Nature :</div>
                <div class="info-value">{{ $intervention->nature_intervention }}</div>
            </div>
            @endif
            <div class="info-row">
                <div class="info-label">Priorité :</div>
                <div class="info-value">
                    <span class="priority-badge priority-{{ strtolower(str_replace(' ', '-', $intervention->priorite)) }}">
                        {{ $intervention->priorite }}
                    </span>
                </div>
            </div>
            <div class="info-row">
                <div class="info-label">Statut :</div>
                <div class="info-value">
                    <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $intervention->statut)) }}">
                        {{ $intervention->statut }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Dates et horaires -->
    <div class="info-section">
        <h2>📅 Planning</h2>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Date de début :</div>
                <div class="info-value">{{ \Carbon\Carbon::parse($intervention->date_debut)->format('d/m/Y H:i') }}</div>
            </div>
            @if($intervention->date_fin_prevue)
            <div class="info-row">
                <div class="info-label">Date de fin prévue :</div>
                <div class="info-value">{{ \Carbon\Carbon::parse($intervention->date_fin_prevue)->format('d/m/Y H:i') }}</div>
            </div>
            @endif
            @if($intervention->date_fin_reelle)
            <div class="info-row">
                <div class="info-label">Date de fin réelle :</div>
                <div class="info-value">{{ \Carbon\Carbon::parse($intervention->date_fin_reelle)->format('d/m/Y H:i') }}</div>
            </div>
            @endif
        </div>
    </div>

    <!-- Personnel -->
    <div class="info-section">
        <h2>👥 Personnel</h2>
        <div class="info-grid">
            @if($intervention->technicien)
            <div class="info-row">
                <div class="info-label">Technicien :</div>
                <div class="info-value">{{ $intervention->technicien }}</div>
            </div>
            @endif
            @if($intervention->signatureMaintenanceUser)
            <div class="info-row">
                <div class="info-label">Signataire Maintenance :</div>
                <div class="info-value">{{ $intervention->signatureMaintenanceUser->nom_complet ?? $intervention->signatureMaintenanceUser->nom }}</div>
            </div>
            @endif
            @if($intervention->signatureLogistiqueUser)
            <div class="info-row">
                <div class="info-label">Signataire Logistique :</div>
                <div class="info-value">{{ $intervention->signatureLogistiqueUser->nom_complet ?? $intervention->signatureLogistiqueUser->nom }}</div>
            </div>
            @endif
        </div>
    </div>

    <!-- Description -->
    @if($intervention->description)
    <div class="info-section">
        <h2>📝 Description de l'intervention</h2>
        <div class="description-box">
            {{ $intervention->description }}
        </div>
    </div>
    @endif

    <!-- Pièces utilisées -->
    @if($intervention->pieces_necessaires)
    <div class="info-section">
        <h2>🔧 Pièces Nécessaires</h2>
        <div class="description-box">
            {{ $intervention->pieces_necessaires }}
        </div>
    </div>
    @endif

    <!-- Coût -->
    @if($intervention->cout_intervention)
    <div class="info-section">
        <h2>💰 Coût de l'intervention</h2>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Coût total :</div>
                <div class="info-value">{{ number_format($intervention->cout_intervention, 0, ',', ' ') }} FCFA</div>
            </div>
        </div>
    </div>
    @endif

    <!-- Signatures -->
    <div class="signatures">
        <h2>✍️ Signatures</h2>
        
        @if($intervention->signature_maintenance)
        <div class="signature-box">
            <div class="signature-label">Signature Maintenance :</div>
            <div style="color: #28a745; font-weight: bold;">✓ Signé le {{ \Carbon\Carbon::parse($intervention->signature_maintenance)->format('d/m/Y H:i') }}</div>
        </div>
        @else
        <div class="signature-box">
            <div class="signature-label">Signature Maintenance :</div>
            <div style="color: #dc3545;">En attente de signature</div>
        </div>
        @endif

        @if($intervention->signature_logistique)
        <div class="signature-box">
            <div class="signature-label">Signature Logistique :</div>
            <div style="color: #28a745; font-weight: bold;">✓ Signé le {{ \Carbon\Carbon::parse($intervention->signature_logistique)->format('d/m/Y H:i') }}</div>
        </div>
        @else
        <div class="signature-box">
            <div class="signature-label">Signature Logistique :</div>
            <div style="color: #dc3545;">En attente de signature</div>
        </div>
        @endif
    </div>

    <!-- Pied de page -->
    <div class="footer">
        Document généré automatiquement par le système GMAO Trans'urb le {{ date('d/m/Y à H:i') }}
    </div>
</body>
</html>
