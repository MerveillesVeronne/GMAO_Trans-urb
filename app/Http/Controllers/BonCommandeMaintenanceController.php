<?php

namespace App\Http\Controllers;

use App\Models\BonCommandeMaintenance;
use App\Models\Intervention;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDF;

class BonCommandeMaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bons_commande = BonCommandeMaintenance::with(['intervention', 'vehicule', 'signataire1', 'signataire2'])
            ->orderBy('created_at', 'desc')
            ->get();

        $stats = [
            'total' => $bons_commande->count(),
            'en_attente' => $bons_commande->where('statut', 'En Attente')->count(),
            'signe' => $bons_commande->where('statut', 'Signé')->count(),
            'approuve' => $bons_commande->where('statut', 'Approuvé')->count(),
            'en_cours' => $bons_commande->where('statut', 'En Cours')->count(),
            'termine' => $bons_commande->where('statut', 'Terminé')->count(),
        ];

        return view('maintenance.bons-commande.index', compact('bons_commande', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $interventions = Intervention::where('statut', 'En Attente')
            ->whereDoesntHave('bonCommande')
            ->with('vehicule')
            ->get();

        return view('maintenance.bons-commande.create', compact('interventions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'intervention_id' => 'required|exists:interventions,id',
            'date_besoin' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $intervention = Intervention::findOrFail($request->intervention_id);
            $bonCommande = $intervention->creerBonCommande();

            // Mettre à jour la date de besoin si fournie
            if ($request->date_besoin) {
                $bonCommande->update(['date_besoin' => $request->date_besoin]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Bon de commande créé avec succès !',
                'bonCommande' => $bonCommande
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création : ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BonCommandeMaintenance $bons_commande)
    {
        $bons_commande->load(['intervention', 'vehicule', 'signataire1', 'signataire2', 'validePar']);
        
        return view('maintenance.bons-commande.show', compact('bons_commande'));
    }

    /**
     * Afficher la liste des bons de commande pour la logistique (lecture + signature)
     */
    public function indexLogistique()
    {
        $bons_commande = BonCommandeMaintenance::with(['intervention', 'vehicule', 'signataire1', 'signataire2'])
            ->orderBy('created_at', 'desc')
            ->get();

        $stats = [
            'total' => $bons_commande->count(),
            'en_attente' => $bons_commande->where('statut', 'En Attente')->count(),
            'signe' => $bons_commande->where('statut', 'Signé')->count(),
            'approuve' => $bons_commande->where('statut', 'Approuvé')->count(),
            'en_cours' => $bons_commande->where('statut', 'En Cours')->count(),
            'termine' => $bons_commande->where('statut', 'Terminé')->count(),
        ];

        return view('logistique.bons-commande.index', compact('bons_commande', 'stats'));
    }

    /**
     * Afficher les détails d'un bon de commande pour la logistique
     */
    public function showLogistique(BonCommandeMaintenance $bon)
    {
        $bon->load(['intervention', 'vehicule', 'signataire1', 'signataire2', 'validePar']);
        
        return view('logistique.bons-commande.show', compact('bon'));
    }

    /**
     * Signer un bon de commande pour la logistique (signature finale)
     */
    public function signerLogistique(Request $request, BonCommandeMaintenance $bon)
    {
        $request->validate([
            'signature_fonction' => 'required|string|max:200',
            'commentaires' => 'nullable|string|max:1000',
        ]);

        try {
            // Signature logistique (signature 2/2)
            $bon->update([
                'signataire_2_id' => auth()->id(),
                'signature_2_date' => now(),
                'signature_2_fonction' => $request->signature_fonction,
                'statut' => 'Approuvé',
                'valide' => true,
                'valide_par_id' => auth()->id(),
                'valide_le' => now(),
                'notes' => $request->commentaires ? ($bon->notes . "\n\n" . $request->commentaires) : $bon->notes
            ]);

            // Si les deux signatures sont présentes, déclencher la sortie automatique
            if ($bon->signataire_1_id && $bon->signataire_2_id) {
                $this->processerSortieAutomatique($bon);
            }

            return response()->json([
                'success' => true,
                'message' => 'Bon de commande signé et validé avec succès !'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la signature : ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Traiter la sortie automatique du stock après validation du bon de commande
     */
    private function processerSortieAutomatique(BonCommandeMaintenance $bon)
    {
        try {
            // Charger l'intervention avec ses pièces nécessaires
            $intervention = $bon->intervention;
            
            if (!$intervention || !$intervention->pieces_necessaires || !$intervention->quantite_pieces) {
                \Log::warning('Aucune pièce nécessaire trouvée pour l\'intervention', [
                    'bon_commande_id' => $bon->id,
                    'intervention_id' => $intervention->id ?? null,
                    'pieces_necessaires' => $intervention->pieces_necessaires ?? 'NULL',
                    'quantite_pieces' => $intervention->quantite_pieces ?? 'NULL'
                ]);
                return;
            }

            // Parser les pièces et quantités selon le format existant
            $piecesArray = explode(', ', $intervention->pieces_necessaires);
            $quantitesArray = explode(', ', $intervention->quantite_pieces);
            
            $piecesTraitees = 0;
            
            foreach ($piecesArray as $index => $pieceName) {
                if (isset($quantitesArray[$index])) {
                    $quantite = (int) preg_replace('/[^0-9]/', '', $quantitesArray[$index]);
                    $designation = trim($pieceName);
                    
                    if ($quantite > 0) {
                        // Chercher la pièce dans le stock
                        $piece = \App\Models\Piece::where('designation', 'LIKE', '%' . $designation . '%')->first();
                        
                        if ($piece) {
                            // Vérifier si le stock est suffisant
                            if ($piece->quantite_stock >= $quantite) {
                                // Créer une sortie de stock
                                \App\Models\SortieStock::create([
                                    'stock_id' => $piece->id,
                                    'reference_produit' => $piece->reference ?? $piece->designation,
                                    'quantite_sortie' => $quantite,
                                    'unite' => 'pièce',
                                    'cout_unitaire' => $piece->prix_unitaire ?? 0,
                                    'cout_total' => $quantite * ($piece->prix_unitaire ?? 0),
                                    'service_destinataire' => 'Maintenance',
                                    'personne_destinataire' => $intervention->technicien ?? 'Technicien',
                                    'poste_destinataire' => 'Technicien Maintenance',
                                    'motif_sortie' => 'Bon de commande validé - Intervention #' . $intervention->id,
                                    'valide_par' => auth()->id(),
                                    'valide_le' => now(),
                                    'commentaires' => 'Débit automatique suite à validation du bon de commande #' . $bon->reference,
                                    'statut' => 'validee'
                                ]);
                                
                                // Débiter le stock
                                $piece->decrement('quantite_stock', $quantite);
                                $piecesTraitees++;
                                
                                \Log::info('Pièce débitée du stock', [
                                    'piece_id' => $piece->id,
                                    'designation' => $piece->designation,
                                    'quantite_debitee' => $quantite,
                                    'stock_restant' => $piece->quantite_stock - $quantite,
                                    'bon_commande_id' => $bon->id
                                ]);
                            } else {
                                \Log::warning('Stock insuffisant pour la pièce', [
                                    'piece_id' => $piece->id,
                                    'designation' => $piece->designation,
                                    'quantite_demandee' => $quantite,
                                    'stock_disponible' => $piece->quantite_stock
                                ]);
                            }
                        } else {
                            \Log::warning('Pièce non trouvée dans le stock', [
                                'designation_recherchee' => $designation,
                                'bon_commande_id' => $bon->id
                            ]);
                        }
                    }
                }
            }
            
            \Log::info('Bon de commande validé et stock débité', [
                'bon_commande_id' => $bon->id,
                'reference' => $bon->reference,
                'pieces_traitees' => $piecesTraitees
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Erreur lors du débit automatique du stock', [
                'bon_commande_id' => $bon->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }
    
    /**
     * Parser les pièces nécessaires depuis le texte
     */
    private function parserPiecesNecessaires($texte)
    {
        $pieces = [];
        
        // Diviser par virgule ou point-virgule
        $lignes = preg_split('/[,;]/', $texte);
        
        foreach ($lignes as $ligne) {
            $ligne = trim($ligne);
            
            // Chercher un pattern comme "Pièce:2" ou "Pièce (2)" ou "2x Pièce"
            if (preg_match('/(.+?)[:\s]+(\d+)/', $ligne, $matches)) {
                $designation = trim($matches[1]);
                $quantite = (int) $matches[2];
                
                if ($designation && $quantite > 0) {
                    $pieces[] = [
                        'designation' => $designation,
                        'quantite' => $quantite
                    ];
                }
            } elseif (preg_match('/(\d+)x\s*(.+)/', $ligne, $matches)) {
                $quantite = (int) $matches[1];
                $designation = trim($matches[2]);
                
                if ($designation && $quantite > 0) {
                    $pieces[] = [
                        'designation' => $designation,
                        'quantite' => $quantite
                    ];
                }
            }
        }
        
        return $pieces;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BonCommandeMaintenance $bons_commande)
    {
        $bons_commande->load(['intervention', 'vehicule']);
        
        return view('maintenance.bons-commande.edit', compact('bons_commande'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BonCommandeMaintenance $bons_commande)
    {
        $validator = Validator::make($request->all(), [
            'chauffeur' => 'nullable|string|max:200',
            'notes' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $bons_commande->update($request->only(['chauffeur', 'notes']));

            return response()->json([
                'success' => true,
                'message' => 'Bon de commande mis à jour avec succès !',
                'bonCommande' => $bons_commande
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour : ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BonCommandeMaintenance $bons_commande)
    {
        try {
            $bons_commande->delete();

            return response()->json([
                'success' => true,
                'message' => 'Bon de commande supprimé avec succès !'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression : ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Signer le bon de commande
     */
    public function signer(Request $request, BonCommandeMaintenance $bons_commande)
    {
        $validator = Validator::make($request->all(), [
            'signataire_id' => 'required|exists:users,id',
            'fonction' => 'required|string|max:200',
            'numero_signature' => 'required|in:1,2',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $bons_commande->signer(
                $request->signataire_id,
                $request->fonction,
                $request->numero_signature
            );

            return response()->json([
                'success' => true,
                'message' => 'Signature ajoutée avec succès !',
                'bonCommande' => $bons_commande->fresh()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la signature : ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Valider le bon de commande
     */
    public function valider(Request $request, BonCommandeMaintenance $bons_commande)
    {
        try {
            if ($bons_commande->valider(auth()->id())) {
                return response()->json([
                    'success' => true,
                    'message' => 'Bon de commande validé avec succès !',
                    'bonCommande' => $bons_commande->fresh()
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Le bon de commande ne peut pas être validé (signatures manquantes)'
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la validation : ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Démarrer l'intervention
     */
    public function demarrerIntervention(BonCommandeMaintenance $bons_commande)
    {
        try {
            if ($bons_commande->demarrerIntervention()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Intervention démarrée avec succès !',
                    'bonCommande' => $bons_commande->fresh()
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'L\'intervention ne peut pas être démarrée'
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors du démarrage : ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Terminer l'intervention
     */
    public function terminerIntervention(BonCommandeMaintenance $bons_commande)
    {
        try {
            $bons_commande->terminerIntervention();

            return response()->json([
                'success' => true,
                'message' => 'Intervention terminée avec succès !',
                'bonCommande' => $bons_commande->fresh()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la finalisation : ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Exporter en PDF
     */
    public function exportPdf(Request $request, BonCommandeMaintenance $bons_commande)
    {
        $bons_commande->load(['intervention', 'vehicule', 'signataire1', 'signataire2', 'validePar']);
        
        $pdf = PDF::loadView('maintenance.bons-commande.pdf', compact('bons_commande'));
        
        // Si mode=view, afficher dans le navigateur, sinon télécharger
        if ($request->get('mode') === 'view') {
            return $pdf->stream("Bon_Commande_{$bons_commande->reference}.pdf");
        }
        
        return $pdf->download("Bon_Commande_{$bons_commande->reference}.pdf");
    }

    /**
     * Obtenir les utilisateurs pour les signatures
     */
    public function getSignataires()
    {
        $users = User::where('statut', 'Actif')
            ->orderBy('nom')
            ->get(['id', 'nom', 'prenom', 'fonction']);

        return response()->json($users);
    }
}
