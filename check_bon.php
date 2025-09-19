<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== BON DE COMMANDE ID 3 ===\n";

$bon = App\Models\BonCommandeMaintenance::find(3);

if ($bon) {
    echo "Reference: " . $bon->reference . "\n";
    echo "Signataire 1 (Maintenance): " . ($bon->signataire_1_id ?? 'NULL') . "\n";
    echo "Signataire 2 (Logistique): " . ($bon->signataire_2_id ?? 'NULL') . "\n";
    echo "Statut: " . $bon->statut . "\n";
    echo "Validé: " . ($bon->valide ? 'OUI' : 'NON') . "\n";
    
    if ($bon->signataire_1_id && $bon->signataire_2_id) {
        echo "\n✅ Les deux signatures sont présentes - Le débit devrait avoir lieu\n";
    } else {
        echo "\n❌ Une ou les deux signatures manquent\n";
    }
} else {
    echo "Bon de commande non trouvé\n";
}
