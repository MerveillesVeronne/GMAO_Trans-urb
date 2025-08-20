<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\LigneCommande;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Commande::with(['fournisseur', 'user', 'lignes', 'bonCommande']);

        // Filtres
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('fournisseur_id')) {
            $query->where('fournisseur_id', $request->fournisseur_id);
        }

        if ($request->filled('date_debut')) {
            $query->where('date_commande', '>=', $request->date_debut);
        }

        if ($request->filled('date_fin')) {
            $query->where('date_commande', '<=', $request->date_fin);
        }

        $commandes = $query->orderBy('date_commande', 'desc')->paginate(15);
        $fournisseurs = Fournisseur::all();

        return view('lists.commandes', compact('commandes', 'fournisseurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fournisseurs = Fournisseur::all();
        return view('commandes.nouvelle', compact('fournisseurs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fournisseur_id' => 'required|exists:fournisseurs,id',
            'date_commande' => 'required|date',
            'date_livraison' => 'nullable|date|after_or_equal:date_commande',
            'commentaires' => 'nullable|string',
            'produits' => 'required|array|min:1',
            'produits.*.produit' => 'required|string|max:255',
            'produits.*.quantite' => 'required|integer|min:1',
            'produits.*.cout_unitaire' => 'nullable|numeric|min:0',
            'produits.*.description' => 'nullable|string',
            'produits.*.commentaires' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            // Générer une référence unique
            $reference = 'CMD-' . date('Y') . '-' . str_pad(Commande::whereYear('created_at', date('Y'))->count() + 1, 4, '0', STR_PAD_LEFT);

            // Créer la commande
            $commande = Commande::create([
                'reference' => $reference,
                'date_commande' => $request->date_commande,
                'date_livraison' => $request->date_livraison,
                'fournisseur_id' => $request->fournisseur_id,
                'commentaires' => $request->commentaires,
                'user_id' => auth()->id(),
                'statut' => 'en_attente'
            ]);

            // Calculer le délai si la date de livraison est fournie
            if ($request->date_livraison) {
                $commande->calculerDelai();
            }

            // Créer les lignes de commande
            foreach ($request->produits as $produit) {
                LigneCommande::create([
                    'commande_id' => $commande->id,
                    'produit' => $produit['produit'],
                    'description' => $produit['description'] ?? null,
                    'quantite' => $produit['quantite'],
                    'cout_unitaire' => $produit['cout_unitaire'] ?? null,
                    'commentaires' => $produit['commentaires'] ?? null,
                    'statut_ligne' => 'en_attente'
                ]);
            }

            DB::commit();

            return redirect()->route('liste.commandes')->with('success', 'Commande créée avec succès. Référence: ' . $reference);

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Erreur lors de la création de la commande: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Commande $commande)
    {
        $commande->load(['fournisseur', 'user', 'lignes']);
        return view('commandes.details', compact('commande'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commande $commande)
    {
        $fournisseurs = Fournisseur::all();
        $commande->load('lignes');
        return view('commandes.edit', compact('commande', 'fournisseurs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Commande $commande)
    {
        $request->validate([
            'fournisseur_id' => 'required|exists:fournisseurs,id',
            'date_commande' => 'required|date',
            'date_livraison' => 'nullable|date|after_or_equal:date_commande',
            'statut' => 'required|in:en_attente,approuvee,livree,annulee',
            'commentaires' => 'nullable|string',
        ]);

        $commande->update([
            'date_commande' => $request->date_commande,
            'date_livraison' => $request->date_livraison,
            'fournisseur_id' => $request->fournisseur_id,
            'statut' => $request->statut,
            'commentaires' => $request->commentaires,
        ]);

        // Recalculer le délai
        $commande->calculerDelai();

        return redirect()->route('liste.commandes')->with('success', 'Commande mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commande $commande)
    {
        if ($commande->statut === 'livree') {
            return back()->withErrors(['error' => 'Impossible de supprimer une commande livrée.']);
        }

        $commande->delete();
        return redirect()->route('liste.commandes')->with('success', 'Commande supprimée avec succès.');
    }

    /**
     * Approuver une commande avec les quantités réellement livrées
     */
    public function approuver(Commande $commande)
    {
        try {
            // Vérifier si la commande peut être approuvée
            if (!$commande->peutEtreApprouvee()) {
                return redirect()->back()->with('error', 'Impossible d\'approuver : aucune livraison validée. Veuillez d\'abord valider des livraisons.');
            }

            // Approuver avec les quantités réellement livrées
            $commande->approuverAvecLivraisons();
            
            return redirect()->back()->with('success', 'Commande approuvée avec succès. Montant ajusté selon les livraisons effectives.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de l\'approbation : ' . $e->getMessage());
        }
    }

    /**
     * Marquer comme livrée
     */
    public function livrer(Commande $commande)
    {
        $commande->update([
            'statut' => 'livree',
            'date_livraison' => now()
        ]);

        // Marquer toutes les lignes comme livrées
        $commande->lignes()->update(['statut_ligne' => 'livree']);

        // Recalculer le délai
        $commande->calculerDelai();

        return back()->with('success', 'Commande marquée comme livrée.');
    }

    /**
     * Annuler une commande
     */
    public function annuler(Commande $commande)
    {
        if ($commande->statut === 'livree') {
            return back()->withErrors(['error' => 'Impossible d\'annuler une commande livrée.']);
        }

        $commande->update(['statut' => 'annulee']);
        
        // Annuler toutes les lignes
        $commande->lignes()->update(['statut_ligne' => 'annulee']);

        return back()->with('success', 'Commande annulée avec succès.');
    }

    /**
     * Mettre à jour le statut d'une ligne
     */
    public function updateLigne(Request $request, LigneCommande $ligne)
    {
        $request->validate([
            'statut_ligne' => 'required|in:en_attente,approuvee,livree,annulee',
            'incidents' => 'nullable|string',
            'commentaires' => 'nullable|string',
        ]);

        $ligne->update($request->only(['statut_ligne', 'incidents', 'commentaires']));

        return back()->with('success', 'Ligne de commande mise à jour.');
    }

    /**
     * Afficher la page des paiements
     */
    public function paiements()
    {
        $commandes = Commande::with(['fournisseur', 'user'])
            ->payables()
            ->orderBy('date_commande', 'desc')
            ->get();

        return view('commandes.paiements', compact('commandes'));
    }

    /**
     * Afficher le formulaire de paiement pour une commande
     */
    public function formulairePaiement(Commande $commande)
    {
        if (!$commande->peutEtrePayee()) {
            return redirect()->back()->with('error', 'Cette commande ne peut pas être payée.');
        }

        return view('commandes.formulaire-paiement', compact('commande'));
    }

    /**
     * Traiter le paiement d'une commande
     */
    public function traiterPaiement(Request $request, Commande $commande)
    {
        $request->validate([
            'montant' => 'required|numeric|min:0.01|max:' . $commande->reste_a_payer,
            'commentaire' => 'nullable|string|max:500'
        ]);

        try {
            $commande->enregistrerPaiement(
                $request->montant,
                $request->commentaire
            );

            return redirect()->route('commandes.paiements')
                ->with('success', 'Paiement enregistré avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erreur lors de l\'enregistrement du paiement: ' . $e->getMessage());
        }
    }

    /**
     * Initialiser les paiements pour les commandes approuvées
     */
    public function initialiserPaiements()
    {
        $commandes = Commande::whereIn('statut', ['approuvee', 'livree'])
            ->whereNull('montant_a_payer')
            ->get();

        foreach ($commandes as $commande) {
            $commande->initialiserPaiement();
        }

        return redirect()->back()
            ->with('success', $commandes->count() . ' commande(s) initialisée(s) pour le paiement.');
    }

    /**
     * Exporter la liste des commandes en PDF
     */
    public function exportPdf(Request $request)
    {
        $query = Commande::with(['fournisseur', 'user', 'lignes', 'bonCommande']);

        // Appliquer les mêmes filtres que dans index()
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('fournisseur_id')) {
            $query->where('fournisseur_id', $request->fournisseur_id);
        }

        if ($request->filled('date_debut')) {
            $query->where('date_commande', '>=', $request->date_debut);
        }

        if ($request->filled('date_fin')) {
            $query->where('date_commande', '<=', $request->date_fin);
        }

        $commandes = $query->orderBy('date_commande', 'desc')->get();

        $pdf = PDF::loadView('commandes.pdf', compact('commandes'));
        return $pdf->download('commandes-' . date('Y-m-d') . '.pdf');
    }
}
