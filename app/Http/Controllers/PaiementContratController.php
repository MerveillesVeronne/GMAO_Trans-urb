<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use App\Models\PaiementContrat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaiementContratController extends Controller
{
    public function showModal(Contrat $contrat)
    {
        // Initialiser le paiement si nécessaire
        $contrat->initialiserPaiement();
        
        return response()->json([
            'contrat' => [
                'id' => $contrat->id,
                'reference' => $contrat->reference,
                'intitule' => $contrat->intitule,
                'montant_a_payer' => $contrat->montant_a_payer,
                'avance' => $contrat->avance,
                'reste_a_payer' => $contrat->reste_a_payer,
                'statut_paiement' => $contrat->statut_paiement,
                'montant_total' => $contrat->montant
            ]
        ]);
    }

    public function store(Request $request, Contrat $contrat)
    {
        // Récupérer les données JSON si elles sont envoyées
        $data = $request->all();
        if ($request->header('Content-Type') === 'application/json') {
            $data = $request->json()->all();
        }

        $validator = Validator::make($data, [
            'montant' => 'required|numeric|min:0.01|max:' . ($contrat->montant_a_payer ?? $contrat->montant),
            'mode_paiement' => 'required|in:especes,cheque,virement,carte',
            'reference_paiement' => 'nullable|string|max:255',
            'commentaire' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Initialiser le paiement si nécessaire
            $contrat->initialiserPaiement();

            // Enregistrer le paiement
            $paiement = $contrat->enregistrerPaiement(
                $data['montant'],
                $data['mode_paiement'],
                $data['reference_paiement'] ?? null,
                $data['commentaire'] ?? null
            );

            return response()->json([
                'success' => true,
                'message' => 'Paiement enregistré avec succès',
                'paiement' => $paiement,
                'contrat' => [
                    'avance' => $contrat->fresh()->avance,
                    'reste_a_payer' => $contrat->fresh()->reste_a_payer,
                    'statut_paiement' => $contrat->fresh()->statut_paiement
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'enregistrement du paiement: ' . $e->getMessage()
            ], 500);
        }
    }

    public function historique(Contrat $contrat)
    {
        $paiements = $contrat->historique_paiements;
        
        return response()->json([
            'paiements' => $paiements->map(function($paiement) {
                return [
                    'id' => $paiement->id,
                    'montant' => $paiement->montant,
                    'mode_paiement' => $paiement->mode_paiement_label,
                    'reference_paiement' => $paiement->reference_paiement,
                    'commentaire' => $paiement->commentaire,
                    'date_paiement' => $paiement->date_paiement->format('d/m/Y H:i'),
                    'user' => $paiement->user->nom_complet ?? 'Utilisateur'
                ];
            })
        ]);
    }
}
