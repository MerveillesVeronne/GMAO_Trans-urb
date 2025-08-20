<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContratController extends Controller
{
    public function index(Request $request)
    {
        $query = Contrat::with('fournisseur');

        // Filtres
        if ($request->filled('categorie')) {
            $query->byCategorie($request->categorie);
        }

        if ($request->filled('periodicite')) {
            $query->byPeriodicite($request->periodicite);
        }

        if ($request->filled('statut')) {
            $query->byStatut($request->statut);
        }

        if ($request->filled('fournisseur')) {
            $query->where('fournisseur_id', $request->fournisseur);
        }

        // Tri
        $tri = $request->get('tri', 'recent');
        switch ($tri) {
            case 'ancien':
                $query->orderBy('created_at', 'asc');
                break;
            case 'montant':
                $query->orderBy('montant', 'desc');
                break;
            case 'date_fin':
                $query->orderBy('date_fin', 'asc');
                break;
            case 'categorie':
                $query->orderBy('categorie', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $contrats = $query->get();
        $fournisseurs = Fournisseur::all();
        
        // Statistiques
        $stats = [
            'total_contrats' => $contrats->count(),
            'contrats_actifs' => $contrats->where('statut', 'actif')->count(),
            'montant_total' => $contrats->sum('montant'),
            'categories' => $contrats->groupBy('categorie')->map->count()
        ];
        
        return view('lists.contrats', compact('contrats', 'fournisseurs', 'stats'));
    }

    public function create()
    {
        $fournisseurs = Fournisseur::all();
        return view('contrats.create', compact('fournisseurs'));
    }

    public function store(Request $request)
    {
        // Déterminer si c'est un contrat à durée indéterminée (avec périodicité)
        $categoriesAvecPeriodicite = Contrat::getCategoriesAvecPeriodicite();
        $isContratADureeIndeterminee = in_array($request->categorie, $categoriesAvecPeriodicite);
        
        $rules = [
            'intitule' => 'required|string|max:255',
            'fournisseur_id' => 'required|exists:fournisseurs,id',
            'date_debut' => 'required|date',
            'montant' => 'required|numeric|min:0',
            'statut' => 'required|in:actif,suspendu,renouvele,resilie,expire',
            'categorie' => 'required|string',
            'description' => 'nullable|string'
        ];
        
        // Ajouter la règle de durée seulement pour les contrats à durée déterminée
        if (!$isContratADureeIndeterminee) {
            $rules['duree'] = 'required|integer|min:1';
        } else {
            // Pour les contrats avec périodicité, la périodicité est obligatoire
            $rules['periodicite'] = 'required|string';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // Debug: Afficher les erreurs de validation
            \Log::error('Erreurs de validation:', $validator->errors()->toArray());
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Debug: Afficher les données reçues
            \Log::info('Données reçues pour création contrat:', $request->all());
            
            $dateDebut = \Carbon\Carbon::parse($request->date_debut);
            $dateFin = null;
            
            // Pour les contrats à durée déterminée uniquement
            if (!$isContratADureeIndeterminee) {
                $dateFin = $dateDebut->copy()->addMonths((int) $request->duree);
                
                // Validation de cohérence dates/statut UNIQUEMENT pour les contrats à durée déterminée
                $aujourdhui = \Carbon\Carbon::now();
                $statutPropose = $request->statut;
                
                if ($dateFin->isPast() && $statutPropose !== 'expire') {
                    return redirect()->back()
                        ->withErrors(['statut' => 'Un contrat avec une date de fin passée doit avoir le statut "Expiré"'])
                        ->withInput();
                }
                
                if ($dateFin->isFuture() && $statutPropose === 'expire') {
                    return redirect()->back()
                        ->withErrors(['statut' => 'Un contrat avec une date de fin future ne peut pas être "Expiré"'])
                        ->withInput();
                }
            }
            
            // Pour les contrats à durée indéterminée (avec périodicité) :
            // - Pas de date de fin (null)
            // - Pas de validation de cohérence dates/statut
            // - Le statut peut être "actif" même avec une date de début dans le passé
            // - Ces contrats sont continus et n'expirent jamais automatiquement

            // Préparer les données pour la création
            $contratData = [
                'fournisseur_id' => $request->fournisseur_id,
                'intitule' => $request->intitule,
                'date_debut' => $request->date_debut,
                'date_fin' => $dateFin, // null pour les contrats à durée indéterminée
                'montant' => $request->montant,
                'statut' => $request->statut,
                'categorie' => $request->categorie,
                'description' => $request->description
            ];

            // Ajouter la périodicité seulement si elle existe
            if ($request->filled('periodicite')) {
                $contratData['periodicite'] = $request->periodicite;
            }

            // Debug: Afficher les données qui vont être créées
            \Log::info('Données pour création contrat:', $contratData);

            try {
                $contrat = Contrat::create($contratData);
                
                return redirect()->route('liste.contrats')
                    ->with('success', 'Contrat créé avec succès ! Référence: ' . $contrat->reference);
                    
            } catch (\Exception $e) {
                \Log::error('Erreur création contrat: ' . $e->getMessage());
                \Log::error('Stack trace: ' . $e->getTraceAsString());
                
                return redirect()->back()
                    ->withErrors(['error' => 'Erreur lors de la création du contrat: ' . $e->getMessage()])
                    ->withInput();
            }

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Erreur lors de la création du contrat: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function show($id)
    {
        $contrat = Contrat::with('fournisseur')->findOrFail($id);
        $fournisseurs = \App\Models\Fournisseur::all();
        
        // Déterminer quelle vue utiliser selon le statut
        if ($contrat->statut === 'resilie') {
            return view('contrats.details-resilie', compact('contrat', 'fournisseurs'));
        }
        
        return view('contrats.details', compact('contrat', 'fournisseurs'));
    }

    public function exportPdf(Request $request)
    {
        $query = Contrat::with('fournisseur');

        // Appliquer exactement les mêmes filtres que dans index()
        if ($request->filled('categorie')) {
            $query->byCategorie($request->categorie);
        }

        if ($request->filled('periodicite')) {
            $query->byPeriodicite($request->periodicite);
        }

        if ($request->filled('statut')) {
            $query->byStatut($request->statut);
        }

        if ($request->filled('fournisseur')) {
            $query->where('fournisseur_id', $request->fournisseur);
        }

        // Appliquer exactement le même tri que dans index()
        $tri = $request->get('tri', 'recent');
        switch ($tri) {
            case 'ancien':
                $query->orderBy('created_at', 'asc');
                break;
            case 'montant':
                $query->orderBy('montant', 'desc');
                break;
            case 'date_fin':
                $query->orderBy('date_fin', 'asc');
                break;
            case 'categorie':
                $query->orderBy('categorie', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $contrats = $query->get();
        $fournisseurs = Fournisseur::all();
        
        // Statistiques basées sur les contrats filtrés
        $stats = [
            'total_contrats' => $contrats->count(),
            'contrats_actifs' => $contrats->where('statut', 'actif')->count(),
            'montant_total' => $contrats->sum('montant'),
            'categories' => $contrats->groupBy('categorie')->map->count()
        ];

        // Générer un nom de fichier avec les filtres appliqués
        $filtres = [];
        if ($request->filled('categorie')) $filtres[] = 'cat-' . $request->categorie;
        if ($request->filled('statut')) $filtres[] = 'statut-' . $request->statut;
        if ($request->filled('fournisseur')) $filtres[] = 'fourn-' . $request->fournisseur;
        
        $nomFichier = 'contrats';
        if (!empty($filtres)) {
            $nomFichier .= '-' . implode('-', $filtres);
        }
        $nomFichier .= '-' . now()->format('Y-m-d') . '.pdf';

        $pdf = \PDF::loadView('contrats.pdf', compact('contrats', 'fournisseurs', 'stats'));
        
        return $pdf->download($nomFichier);
    }

    public function renouveler(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'duree' => 'required|integer|min:1',
            'nouveau_montant' => 'required|numeric|min:0',
            'raison' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $contrat = Contrat::findOrFail($id);
            
            // Calculer les jours de suspension à ajouter
            $joursSuspensionAAjouter = 0;
            if ($contrat->statut === 'suspendu' && $contrat->date_debut_suspension) {
                $debutSuspension = \Carbon\Carbon::parse($contrat->date_debut_suspension);
                $aujourdhui = \Carbon\Carbon::now();
                $joursSuspensionAAjouter = (int) $debutSuspension->diffInDays($aujourdhui);
            }
            
            // Ajouter aux jours de suspension existants
            $totalJoursSuspension = (int) (($contrat->jours_suspension ?? 0) + $joursSuspensionAAjouter);
            
            // Calculer la nouvelle date de fin : date de fin actuelle + durée renouvellement + jours de suspension
            $nouvelleDateFin = \Carbon\Carbon::parse($contrat->date_fin)
                ->addMonths($request->duree)
                ->addDays($totalJoursSuspension);
            
            // Mettre à jour le contrat
            $contrat->update([
                'date_fin' => $nouvelleDateFin,
                'montant' => $request->nouveau_montant,
                'statut' => 'renouvele',
                'nombre_renouvellements' => $contrat->nombre_renouvellements + 1,
                'jours_suspension' => $totalJoursSuspension,
                'date_debut_suspension' => null // Réinitialiser la date de début de suspension
            ]);

            $message = 'Contrat renouvelé avec succès';
            if ($totalJoursSuspension > 0) {
                $message .= '. ' . $totalJoursSuspension . ' jours de suspension ont été ajoutés à la durée.';
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'contrat' => $contrat->load('fournisseur')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors du renouvellement: ' . $e->getMessage()
            ], 500);
        }
    }

    public function resilier(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'raison_resiliation' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $contrat = Contrat::findOrFail($id);
            
            $contrat->update([
                'statut' => 'resilie',
                'date_resiliation' => now(),
                'raison_resiliation' => $request->raison_resiliation
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Contrat résilié avec succès',
                'contrat' => $contrat->load('fournisseur')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la résiliation: ' . $e->getMessage()
            ], 500);
        }
    }

    public function suspendre(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'raison_suspension' => 'required|string|max:500'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $contrat = Contrat::findOrFail($id);
            
            // Vérifier que le contrat peut être suspendu
            if ($contrat->statut === 'resilie') {
                return redirect()->back()
                    ->withErrors(['error' => 'Un contrat résilié ne peut pas être suspendu'])
                    ->withInput();
            }
            
            // Vérifier si le contrat peut être suspendu selon sa catégorie
            if (!$contrat->peutEtreSuspendu()) {
                return redirect()->back()
                    ->withErrors(['error' => 'Ce type de contrat ne peut pas être suspendu. Seule la résiliation est possible.'])
                    ->withInput();
            }
            
            $contrat->update([
                'statut' => 'suspendu',
                'raison_suspension' => $request->raison_suspension,
                'date_debut_suspension' => now() // Enregistrer la date de début de suspension
            ]);

            return redirect()->route('contrat.details', $contrat->id)
                ->with('success', 'Contrat suspendu avec succès. Les jours de suspension seront comptabilisés automatiquement.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Erreur lors de la suspension: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function reactiver($id)
    {
        $contrat = Contrat::findOrFail($id);
        
        // Vérifier si le contrat peut être réactivé
        if ($contrat->statut !== 'suspendu') {
            return redirect()->back()->with('error', 'Ce contrat ne peut pas être réactivé.');
        }
        
        // Calculer la nouvelle date de fin en ajoutant la durée de suspension
        $dureeSuspension = $contrat->date_debut_suspension ? 
            $contrat->date_debut_suspension->diffInDays(now()) : 0;
        
        $nouvelleDateFin = $contrat->date_fin->addDays($dureeSuspension);
        
        $contrat->update([
            'statut' => 'actif',
            'date_fin' => $nouvelleDateFin,
            'date_debut_suspension' => null,
            'raison_suspension' => null,
            'jours_suspension' => 0
        ]);
        
        return redirect()->back()->with('success', 'Contrat réactivé avec succès.');
    }

    /**
     * Traiter un paiement périodique pour un contrat
     */
    public function traiterPaiement(Request $request, $id)
    {
        $contrat = Contrat::findOrFail($id);
        
        $request->validate([
            'montant' => 'required|numeric|min:0.01',
            'mode_paiement' => 'required|in:especes,cheque,virement,carte',
            'reference_paiement' => 'nullable|string|max:100',
            'commentaire' => 'nullable|string|max:500'
        ]);

        try {
            if ($contrat->aPeriodicitePaiement()) {
                // Utiliser la méthode de paiement périodique
                $contrat->traiterPaiementPeriodique($request->montant);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Paiement périodique traité avec succès.',
                    'contrat' => [
                        'avance' => $contrat->fresh()->avance,
                        'reste_a_payer' => $contrat->fresh()->reste_a_payer,
                        'statut_paiement' => $contrat->fresh()->statut_paiement_label,
                        'echeances_en_retard' => $contrat->fresh()->getEcheancesEnRetard(),
                        'montant_redevances' => $contrat->fresh()->getMontantRedevances(),
                        'prochaine_echeance' => $contrat->fresh()->getProchaineEcheance()?->format('d/m/Y')
                    ]
                ]);
            } else {
                // Paiement simple
                $contrat->enregistrerPaiement(
                    $request->montant,
                    $request->mode_paiement,
                    $request->reference_paiement,
                    $request->commentaire
                );
                
                return response()->json([
                    'success' => true,
                    'message' => 'Paiement enregistré avec succès.',
                    'contrat' => [
                        'avance' => $contrat->fresh()->avance,
                        'reste_a_payer' => $contrat->fresh()->reste_a_payer,
                        'statut_paiement' => $contrat->fresh()->statut_paiement_label
                    ]
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors du traitement du paiement: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtenir les informations de paiement d'un contrat
     */
    public function getInfosPaiement($id)
    {
        $contrat = Contrat::findOrFail($id);
        
        $infos = [
            'id' => $contrat->id,
            'reference' => $contrat->reference,
            'intitule' => $contrat->intitule,
            'fournisseur' => $contrat->fournisseur->nom,
            'montant' => $contrat->montant,
            'avance' => $contrat->avance,
            'reste_a_payer' => $contrat->reste_a_payer,
            'statut_paiement' => $contrat->statut_paiement_label,
            'a_periodicite' => $contrat->aPeriodicitePaiement(),
            'peut_etre_suspendu' => $contrat->peutEtreSuspendu()
        ];

        if ($contrat->aPeriodicitePaiement()) {
            $infos['periodicite'] = $contrat->periodicite_label;
            $infos['echeances_en_retard'] = $contrat->getEcheancesEnRetard();
            $infos['montant_redevances'] = $contrat->getMontantRedevances();
            $infos['prochaine_echeance'] = $contrat->getProchaineEcheance()?->format('d/m/Y');
            $infos['echeance_depassee'] = $contrat->echeanceDepassee();
        }

        return response()->json([
            'success' => true,
            'contrat' => $infos
        ]);
    }

    /**
     * Obtenir le détail des échéances d'un contrat
     */
    public function getEcheances($id)
    {
        $contrat = Contrat::findOrFail($id);
        
        if (!$contrat->aPeriodicitePaiement()) {
            return response()->json([
                'success' => false,
                'message' => 'Ce contrat n\'a pas de périodicité de paiement'
            ], 400);
        }

        $echeances = $contrat->getDetailEcheances();

        return response()->json([
            'success' => true,
            'echeances' => $echeances
        ]);
    }

    public function update(Request $request, $id)
    {
        // Log pour debug
        \Log::info('Update request received', ['id' => $id, 'data' => $request->all(), 'method' => $request->method()]);
        
        // Si c'est une requête JSON, traiter les données
        if ($request->isJson()) {
            $data = $request->json()->all();
        } else {
            $data = $request->all();
        }
        
        $validator = Validator::make($data, [
            'intitule' => 'required|string|max:255',
            'fournisseur_id' => 'required|exists:fournisseurs,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
            'montant' => 'required|numeric|min:0',
            'statut' => 'required|in:actif,suspendu,renouvele,resilie,expire',
            'type' => 'nullable|in:maintenance,logistique,autre',
            'description' => 'nullable|string',
            'reference' => 'nullable|string|max:255',
            'jours_suspension' => 'nullable|integer|min:0',
            'date_debut_suspension' => 'nullable|date',
            'date_fin_suspension' => 'nullable|date|after_or_equal:date_debut_suspension',
            'raison_suspension' => 'nullable|string',
            'nombre_renouvellements' => 'nullable|integer|min:0',
            'raison_renouvellement' => 'nullable|string',
            'date_resiliation' => 'nullable|date',
            'raison_resiliation' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            \Log::error('Validation failed', ['errors' => $validator->errors()]);
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $contrat = Contrat::findOrFail($id);
            
            // Vérifications de cohérence
            $dateDebut = \Carbon\Carbon::parse($data['date_debut']);
            $dateFin = \Carbon\Carbon::parse($data['date_fin']);
            $aujourdhui = \Carbon\Carbon::now();
            
            // Si on change le statut de suspendu vers actif, réinitialiser la suspension
            if ($contrat->statut === 'suspendu' && $data['statut'] === 'actif') {
                $data['date_debut_suspension'] = null;
                $data['date_fin_suspension'] = null;
                $data['raison_suspension'] = null;
            }
            
            // Si on met en suspension, enregistrer la date de début si pas déjà fait
            if ($data['statut'] === 'suspendu' && empty($data['date_debut_suspension'])) {
                $data['date_debut_suspension'] = $aujourdhui->format('Y-m-d');
            }
            
            // Préparer les données de mise à jour
            $updateData = [
                'intitule' => $data['intitule'],
                'fournisseur_id' => $data['fournisseur_id'],
                'date_debut' => $data['date_debut'],
                'date_fin' => $data['date_fin'],
                'montant' => $data['montant'],
                'statut' => $data['statut'],
                'type' => $data['type'] ?? null,
                'description' => $data['description'] ?? null,
                'reference' => $data['reference'] ?? null,
                'jours_suspension' => $data['jours_suspension'] ?? 0,
                'date_debut_suspension' => $data['date_debut_suspension'] ?? null,
                'date_fin_suspension' => $data['date_fin_suspension'] ?? null,
                'raison_suspension' => $data['raison_suspension'] ?? null,
                'nombre_renouvellements' => $data['nombre_renouvellements'] ?? 0,
                'raison_renouvellement' => $data['raison_renouvellement'] ?? null,
                'date_resiliation' => $data['date_resiliation'] ?? null,
                'raison_resiliation' => $data['raison_resiliation'] ?? null
            ];
            
            // Log des données de mise à jour
            \Log::info('Updating contract with data', $updateData);
            
            // Mise à jour du contrat
            $contrat->update($updateData);
            
            \Log::info('Contract updated successfully', ['id' => $contrat->id]);

            return redirect()->route('contrat.details', $contrat->id)
                ->with('success', 'Contrat modifié avec succès !');

        } catch (\Exception $e) {
            \Log::error('Error updating contract', ['id' => $id, 'error' => $e->getMessage()]);
            return redirect()->back()
                ->withErrors(['error' => 'Erreur lors de la modification: ' . $e->getMessage()])
                ->withInput();
        }
    }
}
