<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== DEBUG BON DE COMMANDE ID 3 ===\n";

$bon = App\Models\BonCommandeMaintenance::find(3);

if ($bon) {
    echo "Reference: " . $bon->reference . "\n";
    echo "Pieces necessaires (bon): " . ($bon->pieces_necessaires ?? 'NULL') . "\n";
    echo "Intervention ID: " . $bon->intervention_id . "\n";
    
    if ($bon->intervention) {
        echo "Intervention pieces_necessaires: " . ($bon->intervention->pieces_necessaires ?? 'NULL') . "\n";
        echo "Intervention quantite_pieces: " . ($bon->intervention->quantite_pieces ?? 'NULL') . "\n";
    } else {
        echo "Aucune intervention associée\n";
    }
    
    echo "Signataire 1: " . ($bon->signataire_1_id ?? 'NULL') . "\n";
    echo "Signataire 2: " . ($bon->signataire_2_id ?? 'NULL') . "\n";
    echo "Statut: " . $bon->statut . "\n";
} else {
    echo "Bon de commande non trouvé\n";
}

echo "\n=== PIECES EN STOCK ===\n";
$pieces = App\Models\Piece::all();
foreach ($pieces as $piece) {
    echo "ID: {$piece->id} - {$piece->designation} - Stock: {$piece->quantite_stock}\n";
}
