<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\LigneCommande;
use App\Models\Livraison;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LivraisonController extends Controller
{
    /**
     * Afficher le formulaire de livraison pour une commande
     */
    public function create(Commande $commande)
    {
        $commande->load(['lignes', 'fournisseur']);
        
        return view('livraisons.create', compact('commande'));
    }

    /**
     * Enregistrer une nouvelle livraison
     */
    public function store(Request $request, Commande $commande)
    {
        $request->validate([
            'ligne_commande_id' => 'required|exists:ligne_commandes,id',
            'date_livraison' => 'required|date',
            'quantite_livree' => 'required|integer|min:1',
            'commentaires' => 'nullable|string',
            'statut' => 'required|in:complete,partielle,retard'
        ]);

        $ligneCommande = LigneCommande::findOrFail($request->ligne_commande_id);
        
        // Vérifier que la ligne appartient à la commande
        if ($ligneCommande->commande_id !== $commande->id) {
            return back()->withErrors(['ligne_commande_id' => 'Ligne de commande invalide']);
        }

        // Vérifier que la quantité livrée ne dépasse pas la quantité restante
        $quantiteRestante = $ligneCommande->getQuantiteRestante();
        if ($request->quantite_livree > $quantiteRestante) {
            return back()->withErrors(['quantite_livree' => "Quantité invalide. Reste à livrer : {$quantiteRestante}"]);
        }

        DB::beginTransaction();
        try {
            // Créer la livraison
            $livraison = Livraison::create([
                'commande_id' => $commande->id,
                'ligne_commande_id' => $ligneCommande->id,
                'date_livraison' => $request->date_livraison,
                'quantite_livree' => $request->quantite_livree,
                'quantite_commandee' => $ligneCommande->quantite,
                'commentaires' => $request->commentaires,
                'statut' => $request->statut
            ]);

            // Valider automatiquement la livraison
            $livraison->valider(auth()->id());

            DB::commit();

            return redirect()->route('commande.details', $commande)
                           ->with('success', 'Livraison enregistrée et validée avec succès');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Erreur lors de l\'enregistrement de la livraison']);
        }
    }

    /**
     * Valider une livraison existante
     */
    public function valider(Livraison $livraison)
    {
        if ($livraison->valide_par) {
            return back()->withErrors(['error' => 'Cette livraison a déjà été validée']);
        }

        DB::beginTransaction();
        try {
            $livraison->valider(auth()->id());
            DB::commit();

            return back()->with('success', 'Livraison validée avec succès');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Erreur lors de la validation']);
        }
    }

    /**
     * Afficher l'historique des livraisons
     */
    public function index(Request $request)
    {
        $query = Livraison::with(['commande.fournisseur', 'ligneCommande', 'validePar']);

        // Filtres
        if ($request->filled('date_debut')) {
            $query->whereDate('date_livraison', '>=', $request->date_debut);
        }

        if ($request->filled('date_fin')) {
            $query->whereDate('date_livraison', '<=', $request->date_fin);
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('validee')) {
            if ($request->validee == '1') {
                $query->validees();
            } else {
                $query->enAttente();
            }
        }

        $livraisons = $query->orderBy('date_livraison', 'desc')->paginate(15);

        return view('livraisons.index', compact('livraisons'));
    }

    /**
     * Afficher les détails d'une livraison
     */
    public function show(Livraison $livraison)
    {
        $livraison->load(['commande.fournisseur', 'ligneCommande', 'validePar']);
        
        return view('livraisons.show', compact('livraison'));
    }

    /**
     * Afficher le formulaire d'édition d'une livraison
     */
    public function edit(Livraison $livraison)
    {
        if ($livraison->valide_par) {
            return back()->withErrors(['error' => 'Impossible de modifier une livraison validée']);
        }

        $livraison->load(['commande.fournisseur', 'ligneCommande']);
        
        return view('livraisons.edit', compact('livraison'));
    }

    /**
     * Mettre à jour une livraison
     */
    public function update(Request $request, Livraison $livraison)
    {
        if ($livraison->valide_par) {
            return back()->withErrors(['error' => 'Impossible de modifier une livraison validée']);
        }

        $request->validate([
            'date_livraison' => 'required|date',
            'quantite_livree' => 'required|integer|min:1',
            'commentaires' => 'nullable|string',
            'statut' => 'required|in:complete,partielle,retard'
        ]);

        $ligneCommande = $livraison->ligneCommande;
        $quantiteRestante = $ligneCommande->getQuantiteRestante() + $livraison->quantite_livree;
        
        if ($request->quantite_livree > $quantiteRestante) {
            return back()->withErrors(['quantite_livree' => "Quantité invalide. Reste à livrer : {$quantiteRestante}"]);
        }

        $livraison->update([
            'date_livraison' => $request->date_livraison,
            'quantite_livree' => $request->quantite_livree,
            'commentaires' => $request->commentaires,
            'statut' => $request->statut
        ]);

        return redirect()->route('commande.details', $livraison->commande)
                       ->with('success', 'Livraison mise à jour avec succès');
    }

    /**
     * Supprimer une livraison
     */
    public function destroy(Livraison $livraison)
    {
        if ($livraison->valide_par) {
            return back()->withErrors(['error' => 'Impossible de supprimer une livraison validée']);
        }

        $commande = $livraison->commande;
        $livraison->delete();

        return redirect()->route('commande.details', $commande)
                       ->with('success', 'Livraison supprimée avec succès');
    }

    public function validerLigne(Request $request, $ligneId)
    {
        $request->validate([
            'date_livraison' => 'required|date',
            'quantite_livree' => 'required|integer|min:1',
            'commentaires' => 'nullable|string',
        ]);

        $ligne = \App\Models\LigneCommande::findOrFail($ligneId);
        $commande = $ligne->commande;
        $reste = $ligne->getQuantiteRestante();
        $quantiteLivree = min($request->quantite_livree, $reste);

        // Création de la livraison
        $livraison = \App\Models\Livraison::create([
            'commande_id' => $commande->id,
            'ligne_commande_id' => $ligne->id,
            'date_livraison' => $request->date_livraison,
            'quantite_livree' => $quantiteLivree,
            'quantite_commandee' => $ligne->quantite,
            'commentaires' => $request->commentaires,
            'statut' => $quantiteLivree == $reste ? 'complete' : 'partielle',
            'valide_par' => auth()->id(),
            'valide_le' => now(),
        ]);

        // Mise à jour de la ligne
        $ligne->quantite_livree += $quantiteLivree;
        $ligne->date_derniere_livraison = $request->date_livraison;
        $ligne->livraison_complete = ($ligne->quantite_livree >= $ligne->quantite);
        $ligne->statut_ligne = $ligne->livraison_complete ? 'livree' : 'approuvee';
        $ligne->save();

        // Mise à jour du stock - créer automatiquement si n'existe pas
        $stock = \App\Models\Stock::trouverOuCreer(
            $ligne->produit,
            $ligne->description,
            'Matériel'
        );
        $stock->ajouterStock($quantiteLivree, $ligne->cout_unitaire);

        // Vérifier si la commande est totalement livrée
        $commande->verifierLivraisonComplete();

        // Mettre à jour la satisfaction du bon de commande si applicable
        if ($commande->bonCommande) {
            // Trouver la ligne de bon de commande correspondante
            $ligneBonCommande = $commande->bonCommande->lignes()
                ->where('produit', $ligne->produit)
                ->first();
            
            if ($ligneBonCommande) {
                $ligneBonCommande->mettreAJourSatisfaction($quantiteLivree);
            }
        }

        return redirect()->route('commande.details', $commande)->with('success', 'Livraison validée avec succès.');
    }
}
