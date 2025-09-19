<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bon de Commande {{ $bons_commande->reference }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 12px;
            line-height: 1.4;
        }
        
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .admin-header {
            text-align: left;
            margin-bottom: 15px;
        }
        
        .admin-header h2 {
            margin: 0;
            font-size: 14px;
            font-weight: bold;
        }
        
        .bon-commande-number {
            text-align: center;
            margin: 15px 0;
            font-size: 14px;
        }
        
        .main-title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            text-decoration: underline;
            border: 2px solid #000;
            padding: 10px;
            margin: 20px 0;
        }
        
        .vehicle-section {
            margin: 20px 0;
        }
        
        .vehicle-row {
            display: flex;
            margin-bottom: 15px;
            align-items: flex-start;
        }
        
        .vehicle-label {
            font-weight: bold;
            width: 120px;
            flex-shrink: 0;
            margin-right: 10px;
        }
        
        .checkbox-group {
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
        }
        
        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-right: 10px;
            white-space: nowrap;
        }
        
        .checkbox {
            width: 15px;
            height: 15px;
            border: 1px solid #000;
        }
        
        .checkbox.checked {
            background-color: #000;
            position: relative;
        }
        
        .checkbox.checked::after {
            content: "✓";
            color: white;
            position: absolute;
            top: -1px;
            left: 1px;
            font-size: 10px;
            font-weight: bold;
            line-height: 1;
        }
        
        .vehicle-field {
            border-bottom: 1px solid #000;
            min-width: 200px;
            padding: 2px 5px;
            margin-left: 10px;
        }
        
        .nature-section {
            margin: 20px 0;
        }
        
        .nature-title {
            font-weight: bold;
            font-size: 14px;
            border: 1px solid #000;
            padding: 5px;
            background-color: #f0f0f0;
            margin-bottom: 10px;
        }
        
        .nature-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 8px;
        }
        
        .nature-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .articles-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        
        .articles-table th,
        .articles-table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        
        .articles-table th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }
        
        .qte-col {
            width: 80px;
            text-align: center;
        }
        
        .details-col {
            width: 60%;
        }
        
        .obs-col {
            width: 120px;
        }
        
        .signatures-section {
            margin-top: 30px;
        }
        
        .signatures-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
        
        .signature-block {
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
        }
        
        .signature-title {
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 12px;
        }
        
        .signature-line {
            border-bottom: 1px solid #000;
            height: 30px;
            margin: 10px 0;
        }
        
        .signature-circle {
            width: 40px;
            height: 40px;
            border: 1px solid #000;
            border-radius: 50%;
            margin: 10px auto;
        }
        
        .footer {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
            font-size: 10px;
        }
        
        .download-button {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        
        .download-button:hover {
            background-color: #0056b3;
        }
        
        @media print {
            .download-button {
                display: none;
            }
        }
    </style>
</head>
<body>
    @if(request()->get('mode') === 'view')
        <button class="download-button" onclick="window.print()">
            <i class="fas fa-download"></i> Télécharger PDF
        </button>
    @endif

    <!-- En-tête Administration -->
    <div class="admin-header">
        <h2>ADMINISTRATION GENERALE</h2>
        <h2>SERVICE MAINTENANCE ET LOGISTIQUE</h2>
    </div>

    <!-- Numéro de bon de commande -->
    <div class="bon-commande-number">
        <strong>N° BON DE COMMANDE: {{ $bons_commande->reference }}</strong>
    </div>

    <!-- Titre principal -->
    <div class="main-title">
        BON DE COMMANDE PIECES DETACHEES ET CONSOMMABLES
    </div>

    <!-- Informations véhicule -->
    <div class="vehicle-section">
        <div class="vehicle-row">
            <span class="vehicle-label">TYPE DE VEHICULE:</span>
            <div class="checkbox-group">
                <div class="checkbox-item">
                    <div class="checkbox {{ $bons_commande->vehicule->type_vehicule == 'GRAND BUS' ? 'checked' : '' }}"></div>
                    <span>GRAND BUS</span>
                </div>
                <div class="checkbox-item">
                    <div class="checkbox {{ $bons_commande->vehicule->type_vehicule == 'PETIT BUS' ? 'checked' : '' }}"></div>
                    <span>PETIT BUS</span>
                </div>
                <div class="checkbox-item">
                    <div class="checkbox {{ $bons_commande->vehicule->type_vehicule == 'AUTRES' ? 'checked' : '' }}"></div>
                    <span>AUTRES</span>
                </div>
            </div>
        </div>

        <div class="vehicle-row">
            <span class="vehicle-label">MARQUE:</span>
            <div class="checkbox-group">
                <div class="checkbox-item">
                    <div class="checkbox {{ $bons_commande->vehicule->marque == 'GOLDEN D.' ? 'checked' : '' }}"></div>
                    <span>GOLDEN D.</span>
                </div>
                <div class="checkbox-item">
                    <div class="checkbox {{ $bons_commande->vehicule->marque == 'MERCEDES MCV' ? 'checked' : '' }}"></div>
                    <span>MERCEDES MCV</span>
                </div>
                <div class="checkbox-item">
                    <div class="checkbox {{ $bons_commande->vehicule->marque == 'TOYOTA COASTER' ? 'checked' : '' }}"></div>
                    <span>TOYOTA COASTER</span>
                </div>
            </div>
            <span class="vehicle-label" style="margin-left: 30px;">NUM DE PARC:</span>
            <div class="vehicle-field">{{ $bons_commande->vehicule->numero ?? '' }}</div>
        </div>

        <div class="vehicle-row">
            <span class="vehicle-label">IMMATRICULATION:</span>
            <div class="vehicle-field">{{ $bons_commande->vehicule->immatriculation }}</div>
        </div>
    </div>

    <!-- Nature des articles -->
    <div class="nature-section">
        <div class="nature-title">NATURE DES ARTICLES</div>
        
        <!-- Catégories principales -->
        <div style="margin-bottom: 15px;">
            <div style="font-weight: bold; margin-bottom: 8px;">CATEGORIES PRINCIPALES:</div>
            <div class="nature-grid" style="grid-template-columns: repeat(2, 1fr);">
                <div class="nature-item">
                    <div class="checkbox"></div>
                    <span>PIECES</span>
                </div>
                <div class="nature-item">
                    <div class="checkbox"></div>
                    <span>HUILES</span>
                </div>
            </div>
        </div>
        
        <!-- Sous-catégories -->
        <div>
            <div style="font-weight: bold; margin-bottom: 8px;">SOUS-CATEGORIES (MECANIQUE, ELECTRICITE, PNEUMATIQUE, ETC.):</div>
            <div class="nature-grid" style="grid-template-columns: repeat(4, 1fr);">
                <div class="nature-item">
                    <div class="checkbox"></div>
                    <span>MECANIQUE</span>
                </div>
                <div class="nature-item">
                    <div class="checkbox"></div>
                    <span>ELECTRICITE</span>
                </div>
                <div class="nature-item">
                    <div class="checkbox"></div>
                    <span>PNEUMATIQUE</span>
                </div>
                <div class="nature-item">
                    <div class="checkbox"></div>
                    <span>FREINS</span>
                </div>
                <div class="nature-item">
                    <div class="checkbox"></div>
                    <span>TRANSMISSION</span>
                </div>
                <div class="nature-item">
                    <div class="checkbox"></div>
                    <span>CLIMATISATION</span>
                </div>
                <div class="nature-item">
                    <div class="checkbox"></div>
                    <span>FILTRES</span>
                </div>
                <div class="nature-item">
                    <div class="checkbox"></div>
                    <span>CARROSSERIE</span>
                </div>
                <div class="nature-item">
                    <div class="checkbox"></div>
                    <span>ACCESSOIRES</span>
                </div>
                <div class="nature-item">
                    <div class="checkbox"></div>
                    <span>SECURITE</span>
                </div>
                <div class="nature-item">
                    <div class="checkbox"></div>
                    <span>OUTILLAGE</span>
                </div>
                <div class="nature-item">
                    <div class="checkbox"></div>
                    <span>CONSOMMABLES</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau des articles -->
    <table class="articles-table">
        <thead>
            <tr>
                <th class="qte-col">Qté Commandée</th>
                <th class="details-col">DETAILS DES ARTICLES / PIECES DETACHEES</th>
                <th class="qte-col">Qté Livrée</th>
                <th class="obs-col">OBSERVATIONS</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="qte-col">1</td>
                <td class="details-col">{{ $bons_commande->pieces_necessaires }}</td>
                <td class="qte-col"></td>
                <td class="obs-col"></td>
            </tr>
            <tr>
                <td class="qte-col"></td>
                <td class="details-col"></td>
                <td class="qte-col"></td>
                <td class="obs-col"></td>
            </tr>
            <tr>
                <td class="qte-col"></td>
                <td class="details-col"></td>
                <td class="qte-col"></td>
                <td class="obs-col"></td>
            </tr>
            <tr>
                <td class="qte-col"></td>
                <td class="details-col"></td>
                <td class="qte-col"></td>
                <td class="obs-col"></td>
            </tr>
            <tr>
                <td class="qte-col"></td>
                <td class="details-col"></td>
                <td class="qte-col"></td>
                <td class="obs-col"></td>
            </tr>
        </tbody>
    </table>

    <!-- Motif de l'intervention -->
    <div style="margin: 20px 0;">
        <strong>MOTIF DE L'INTERVENTION:</strong><br>
        <div style="border: 1px solid #000; padding: 10px; min-height: 60px;">
            {{ $bons_commande->motif_intervention }}
        </div>
    </div>

    <!-- Signatures -->
    <div class="signatures-section">
        <div class="signatures-grid">
            <!-- Colonne gauche -->
            <div class="signature-block">
                <div class="signature-title">TECHNICIEN</div>
                <div class="signature-line"></div>
                <div>Nom et Signature</div>
                <div class="signature-circle"></div>
            </div>

            <div class="signature-block">
                <div class="signature-title">BUREAU RECEPTION</div>
                <div class="signature-line"></div>
                <div>Nom et Signature</div>
            </div>

            <!-- Colonne milieu -->
            <div class="signature-block">
                <div class="signature-title">MAGASINIER</div>
                <div class="signature-line"></div>
                <div>Nom et Signature</div>
            </div>

            <div class="signature-block">
                <div class="signature-title">VISA LOGISTIQUE</div>
                <div style="font-size: 10px; margin-bottom: 5px;">Personne habilitée</div>
                <div class="signature-line"></div>
                <div>Nom et Signature</div>
                @if($bons_commande->signataire2)
                    <div style="margin-top: 5px; font-size: 10px;">
                        <strong>{{ $bons_commande->signataire2->nom }} {{ $bons_commande->signataire2->prenom }}</strong><br>
                        {{ $bons_commande->signature_2_date->format('d/m/Y H:i') }}
                    </div>
                @endif
            </div>

            <!-- Colonne droite -->
            <div class="signature-block">
                <div class="signature-title">SECURITE</div>
                <div class="signature-line"></div>
                <div>Nom et Signature</div>
            </div>

            <div class="signature-block">
                <div class="signature-title">CHEF DE SERVICE MAINTENANCE</div>
                <div class="signature-line"></div>
                <div>Nom et Signature</div>
                @if($bons_commande->signataire1)
                    <div style="margin-top: 5px; font-size: 10px;">
                        <strong>{{ $bons_commande->signataire1->nom }} {{ $bons_commande->signataire1->prenom }}</strong><br>
                        {{ $bons_commande->signature_1_date->format('d/m/Y H:i') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Pied de page -->
    <div class="footer">
        <div>
            <strong>N.B. Veuillez conserver à l'affichage de ce document en cas d'inventaire</strong>
        </div>
        <div>
            <strong>SERVICE MAINTENANCE ET LOGISTIQUE</strong>
        </div>
    </div>
</body>
</html>
