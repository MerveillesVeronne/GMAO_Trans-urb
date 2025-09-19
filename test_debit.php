<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== TEST DEBIT AUTOMATIQUE ===\n";

$bon = App\Models\BonCommandeMaintenance::find(3);

if ($bon && $bon->intervention) {
    echo "Bon de commande: " . $bon->reference . "\n";
    echo "Intervention pieces_necessaires: " . $bon->intervention->pieces_necessaires . "\n";
    echo "Intervention quantite_pieces: " . $bon->intervention->quantite_pieces . "\n";
    
    // Parser les pièces et quantités
    $piecesArray = explode(', ', $bon->intervention->pieces_necessaires);
    $quantitesArray = explode(', ', $bon->intervention->quantite_pieces);
    
    echo "\n=== PARSING ===\n";
    foreach ($piecesArray as $index => $pieceName) {
        if (isset($quantitesArray[$index])) {
            $quantite = (int) preg_replace('/[^0-9]/', '', $quantitesArray[$index]);
            $designation = trim($pieceName);
            echo "Pièce: '$designation' - Quantité: $quantite\n";
            
            // Chercher la pièce
            $piece = App\Models\Piece::where('designation', 'LIKE', '%' . $designation . '%')->first();
            if ($piece) {
                echo "  -> Trouvée: ID {$piece->id}, Stock actuel: {$piece->quantite_stock}\n";
                if ($piece->quantite_stock >= $quantite) {
                    echo "  -> Stock suffisant, débit possible\n";
                } else {
                    echo "  -> Stock insuffisant!\n";
                }
            } else {
                echo "  -> Pièce non trouvée dans le stock\n";
            }
        }
    }
} else {
    echo "Bon de commande ou intervention non trouvé\n";
}
