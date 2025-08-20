<?php

namespace App\Http\Controllers;

use App\Models\BonCommande;
use App\Models\LigneBonCommande;
use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class BonCommandeController extends Controller
{
    /**
     * Afficher la liste des bons de commande
     */
    public function index()
    {
        $bonsCommande = BonCommande::with(['user', 'lignes'])
            ->orderBy('date_creation', 'desc')
            ->paginate(20);

        return view('bons-commande.index', compact('bonsCommande'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        return view('bons-commande.create');
    }

    /**
     * Enregistrer un nouveau bon de commande
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'budget_total' => 'required|numeric|min:0',
            'date_besoin' => 'required|date|after_or_equal:today',
            'commentaires' => 'nullable|string',
            'produit_principal' => 'required|string|max:255',
            'description_produit' => 'required|string',
            'quantite_totale_souhaitee' => 'required|integer|min:1',
            'unite_produit' => 'required|string|max:50',
            'cout_unitaire_estime' => 'required|numeric|min:0'
        ]);

        try {
            DB::beginTransaction();

            // Créer le bon de commande
            $bonCommande = BonCommande::create([
                'reference' => BonCommande::genererReference(),
                'titre' => $request->titre,
                'description' => $request->description,
                'budget_total' => $request->budget_total,
                'date_creation' => now(),
                'date_besoin' => $request->date_besoin,
                'statut' => 'en_attente',
                'user_id' => auth()->id(),
                'commentaires' => $request->commentaires,
                'produit_principal' => $request->produit_principal,
                'description_produit' => $request->description_produit,
                'quantite_totale_souhaitee' => $request->quantite_totale_souhaitee,
                'unite_produit' => $request->unite_produit,
                'cout_unitaire_estime' => $request->cout_unitaire_estime,
                'quantite_satisfaite' => 0
                ]);

            DB::commit();

            return redirect()->route('bons-commande.index')
                ->with('success', 'Bon de commande créé avec succès. Référence : ' . $bonCommande->reference);

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors de la création : ' . $e->getMessage());
        }
    }

    /**
     * Afficher les détails d'un bon de commande
     */
    public function show(BonCommande $bonCommande)
    {
        $bonCommande->load(['user', 'lignes', 'commandes.fournisseur']);
        return view('bons-commande.show', compact('bonCommande'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit(BonCommande $bonCommande)
    {
        if ($bonCommande->statut !== 'en_attente') {
            return redirect()->back()
                ->with('error', 'Impossible de modifier un bon de commande qui n\'est plus en attente.');
        }

        return view('bons-commande.edit', compact('bonCommande'));
    }

    /**
     * Mettre à jour un bon de commande
     */
    public function update(Request $request, BonCommande $bonCommande)
    {
        if ($bonCommande->statut !== 'en_attente') {
            return redirect()->back()
                ->with('error', 'Impossible de modifier un bon de commande qui n\'est plus en attente.');
        }

        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'budget_total' => 'required|numeric|min:0',
            'date_besoin' => 'required|date',
            'commentaires' => 'nullable|string',
            'lignes' => 'required|array|min:1',
            'lignes.*.produit' => 'required|string|max:255',
            'lignes.*.quantite_demandee' => 'required|integer|min:1',
            'lignes.*.cout_unitaire_estime' => 'required|numeric|min:0',
            'lignes.*.unite' => 'required|string|max:50'
        ]);

        try {
            DB::beginTransaction();

            // Mettre à jour le bon de commande
            $bonCommande->update($request->only([
                'titre', 'description', 'budget_total', 'date_besoin', 'commentaires'
            ]));

            // Mettre à jour les lignes existantes et créer les nouvelles
            $lignesIds = [];
            
            foreach ($request->lignes as $ligneData) {
                if (isset($ligneData['id'])) {
                    // Mettre à jour une ligne existante
                    $ligne = LigneBonCommande::where('id', $ligneData['id'])
                        ->where('bon_commande_id', $bonCommande->id)
                        ->first();
                    
                    if ($ligne) {
                        $ligne->update([
                            'produit' => $ligneData['produit'],
                            'description' => $ligneData['description'] ?? '',
                            'quantite_demandee' => $ligneData['quantite_demandee'],
                            'cout_unitaire_estime' => $ligneData['cout_unitaire_estime'],
                            'unite' => $ligneData['unite']
                        ]);
                        $lignesIds[] = $ligne->id;
                    }
                } else {
                    // Créer une nouvelle ligne
                    $ligne = $bonCommande->lignes()->create([
                        'produit' => $ligneData['produit'],
                        'description' => $ligneData['description'] ?? '',
                        'quantite_demandee' => $ligneData['quantite_demandee'],
                        'cout_unitaire_estime' => $ligneData['cout_unitaire_estime'],
                        'unite' => $ligneData['unite'],
                        'statut' => 'en_attente'
                    ]);
                    $lignesIds[] = $ligne->id;
                }
            }

            // Supprimer les lignes qui ne sont plus présentes
            $bonCommande->lignes()->whereNotIn('id', $lignesIds)->delete();

            DB::commit();

            return redirect()->route('bons-commande.show', $bonCommande)
                ->with('success', 'Bon de commande mis à jour avec succès.');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors de la mise à jour : ' . $e->getMessage());
        }
    }

    /**
     * Supprimer un bon de commande
     */
    public function destroy(BonCommande $bonCommande)
    {
        if ($bonCommande->statut !== 'en_attente') {
            return redirect()->back()
                ->with('error', 'Impossible de supprimer un bon de commande qui n\'est plus en attente.');
        }

        $bonCommande->delete();

        return redirect()->route('bons-commande.index')
            ->with('success', 'Bon de commande supprimé avec succès.');
    }

    /**
     * Créer une commande depuis un bon de commande
     */
    public function creerCommande(Request $request, BonCommande $bonCommande)
    {
        $request->validate([
            'fournisseur_id' => 'required|exists:fournisseurs,id',
            'quantite' => 'required|integer|min:1',
            'cout_unitaire' => 'required|numeric|min:0',
            'commentaires' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();

            // Vérifier que la quantité demandée ne dépasse pas la quantité restante
            $quantiteRestante = $bonCommande->getQuantiteRestante();
            if ($request->quantite > $quantiteRestante) {
                return redirect()->back()
                    ->with('error', "La quantité demandée ({$request->quantite}) dépasse la quantité restante ({$quantiteRestante})");
            }

            // Créer la commande
            $commande = Commande::create([
                'reference' => 'CMD-' . date('Y') . '-' . str_pad(Commande::count() + 1, 4, '0', STR_PAD_LEFT),
                'date_commande' => now(),
                'fournisseur_id' => $request->fournisseur_id,
                'statut' => 'en_attente',
                'user_id' => auth()->id(),
                'bon_commande_id' => $bonCommande->id,
                'commentaires' => $request->commentaires ?: "Commande créée depuis le bon de commande {$bonCommande->reference}"
            ]);

            // Créer la ligne de commande
            $commande->lignes()->create([
                'produit' => $bonCommande->produit_principal,
                'description' => $bonCommande->description_produit,
                'quantite' => $request->quantite,
                'cout_unitaire' => $request->cout_unitaire,
                'statut_ligne' => 'en_attente'
            ]);

            DB::commit();

            return redirect()->route('commande.details', $commande)
                ->with('success', "Commande créée avec succès pour {$bonCommande->produit_principal}. Référence : {$commande->reference}");

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors de la création : ' . $e->getMessage());
        }
    }

    /**
     * Valider globalement un bon de commande
     */
    public function validerGlobalement(Request $request, BonCommande $bonCommande)
    {
        $request->validate([
            'commentaires_validation' => 'nullable|string|max:1000'
        ]);

        try {
            // Vérifier que toutes les commandes sont validées
            if (!$bonCommande->toutesCommandesValidees()) {
                return redirect()->back()
                    ->with('error', 'Impossible de valider le bon de commande. Toutes les commandes doivent être livrées et validées.');
            }

            // Valider le bon de commande
            if ($bonCommande->validerGlobalement()) {
                // Ajouter les commentaires de validation si fournis
                if ($request->filled('commentaires_validation')) {
                    $bonCommande->update([
                        'commentaires_validation' => $request->commentaires_validation
                    ]);
                }

                return redirect()->back()
                    ->with('success', 'Bon de commande validé avec succès ! Le budget a été ajusté selon les commandes validées.');
            } else {
                return redirect()->back()
                    ->with('error', 'Erreur lors de la validation du bon de commande.');
            }

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erreur lors de la validation : ' . $e->getMessage());
        }
    }

    /**
     * Exporter la liste des bons de commande en PDF
     */
    public function exportPdf(Request $request)
    {
        $query = BonCommande::with(['user', 'lignes']);

        // Appliquer les mêmes filtres que dans index()
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('date_debut')) {
            $query->where('date_creation', '>=', $request->date_debut);
        }

        if ($request->filled('date_fin')) {
            $query->where('date_creation', '<=', $request->date_fin);
        }

        $bonsCommande = $query->orderBy('date_creation', 'desc')->get();

        $pdf = PDF::loadView('bons-commande.pdf', compact('bonsCommande'));
        return $pdf->download('bons-de-commande-' . date('Y-m-d') . '.pdf');
    }
}
