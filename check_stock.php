<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== STOCK ACTUEL ===\n";

$pieces = App\Models\Piece::all();
foreach ($pieces as $piece) {
    echo "ID: {$piece->id} - {$piece->designation} - Stock: {$piece->quantite_stock}\n";
}

echo "\n=== SORTIES DE STOCK RECENTES ===\n";
$sorties = App\Models\SortieStock::orderBy('created_at', 'desc')->limit(5)->get();
foreach ($sorties as $sortie) {
    echo "ID: {$sortie->id} - Référence: {$sortie->reference_produit} - Quantité: {$sortie->quantite_sortie} - Date: {$sortie->created_at}\n";
}
