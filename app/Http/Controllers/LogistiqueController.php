<?php

namespace App\Http\Controllers;

use App\Models\BonCommandeMaintenance;
use App\Models\Piece;
use App\Models\Stock;
use Illuminate\Http\Request;

class LogistiqueController extends Controller
{
    /**
     * Afficher le dashboard de logistique
     */
    public function index()
    {
        // Statistiques pour le dashboard
        $stats = [
            'total_pieces' => Piece::count(),
            'pieces_en_stock' => Piece::enStock()->count(),
            'pieces_stock_faible' => Piece::stockFaible()->count(),
            'pieces_en_rupture' => Piece::enRupture()->count(),
            'bons_commande_en_attente' => BonCommandeMaintenance::where('statut', 'En Attente')->count(),
            'bons_commande_a_signer' => BonCommandeMaintenance::where('statut', 'Signé')->count(),
        ];

        // Bons de commande récents
        $bonsCommandeRecents = BonCommandeMaintenance::with(['intervention', 'vehicule'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Pièces en stock faible
        $piecesStockFaible = Piece::stockFaible()->limit(5)->get();

        return view('logistique.index', compact('stats', 'bonsCommandeRecents', 'piecesStockFaible'));
    }
}
