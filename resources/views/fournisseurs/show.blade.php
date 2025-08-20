@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Header avec bouton retour -->
    <div style="background: #fff; border-radius: 12px; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <a href="{{ route('liste.fournisseurs') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i>Retour à la liste
            </a>
            <div style="display: flex; align-items: center; gap: 1rem;">
                <h1 style="color: #17423b; font-size: 2rem; font-weight: 700;">📊 {{ $fournisseur->nom }}</h1>
                <a href="{{ route('fournisseur.pdf', $fournisseur) }}" 
                   style="background: #219150; color: #fff; padding: 0.8rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 0.5rem; transition: background 0.2s;"
                   onmouseover="this.style.background='#1e5c4a'" 
                   onmouseout="this.style.background='#219150'">
                    <i class="fas fa-file-pdf"></i>Exporter PDF
                </a>
            </div>
        </div>
    </div>

    <!-- Informations du fournisseur -->
    <div style="background: #fff; border-radius: 12px; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
            <div>
                <h3 style="font-size: 1.3rem; font-weight: 600; color: #17423b; margin-bottom: 1rem;">👤 Informations générales</h3>
                <div style="display: grid; gap: 0.8rem;">
                    <div>
                        <span style="font-weight: 600; color: #666;">Email:</span>
                        <span style="margin-left: 0.5rem;">{{ $fournisseur->email }}</span>
                    </div>
                    <div>
                        <span style="font-weight: 600; color: #666;">Téléphone:</span>
                        <span style="margin-left: 0.5rem;">{{ $fournisseur->telephone }}</span>
                    </div>
                    <div>
                        <span style="font-weight: 600; color: #666;">Type:</span>
                        <span style="margin-left: 0.5rem;">{{ $fournisseur->type ?: 'Non spécifié' }}</span>
                    </div>
                    <div>
                        <span style="font-weight: 600; color: #666;">Responsable:</span>
                        <span style="margin-left: 0.5rem;">{{ $fournisseur->responsable ?: 'Non spécifié' }}</span>
                    </div>
                </div>
            </div>
            <div>
                <h3 style="font-size: 1.3rem; font-weight: 600; color: #17423b; margin-bottom: 1rem;">📍 Adresse</h3>
                <div style="display: grid; gap: 0.8rem;">
                    <div>
                        <span style="font-weight: 600; color: #666;">Adresse:</span>
                        <span style="margin-left: 0.5rem;">{{ $fournisseur->adresse ?: 'Non spécifiée' }}</span>
                    </div>
                    <div>
                        <span style="font-weight: 600; color: #666;">Ville:</span>
                        <span style="margin-left: 0.5rem;">{{ $fournisseur->ville ?: 'Non spécifiée' }}</span>
                    </div>
                    <div>
                        <span style="font-weight: 600; color: #666;">Pays:</span>
                        <span style="margin-left: 0.5rem;">{{ $fournisseur->pays ?: 'Non spécifié' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Score et statistiques principales -->
    <div style="background: #fff; border-radius: 12px; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <h3 style="font-size: 1.3rem; font-weight: 600; color: #17423b; margin-bottom: 1.5rem;">📈 Score et performance</h3>
        
        <!-- Score principal -->
        <div style="background: linear-gradient(135deg, #eafaf4 0%, #d1f2e7 100%); border-radius: 12px; padding: 2rem; margin-bottom: 2rem; text-align: center;">
            <div style="font-size: 3rem; font-weight: bold; color: {{ $stats['score_color'] == 'green' ? '#219150' : ($stats['score_color'] == 'yellow' ? '#f59e0b' : ($stats['score_color'] == 'orange' ? '#f97316' : '#ef4444')) }};">
                {{ $stats['score_global'] }}/100
            </div>
            <div style="font-size: 1.2rem; font-weight: 600; color: #17423b; margin-bottom: 0.5rem;">{{ $stats['score_label'] }}</div>
            <div style="color: #666;">Score global du fournisseur</div>
        </div>

        <!-- Statistiques détaillées -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem;">
            <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; text-align: center;">
                <div style="font-size: 2rem; font-weight: bold; color: #219150;">{{ $stats['total_commandes'] }}</div>
                <div style="color: #666; font-size: 0.9rem;">Total commandes</div>
            </div>
            <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; text-align: center;">
                <div style="font-size: 2rem; font-weight: bold; color: #219150;">{{ number_format($stats['montant_total'], 0, ',', ' ') }} FCFA</div>
                <div style="color: #666; font-size: 0.9rem;">Montant total</div>
            </div>
            <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; text-align: center;">
                <div style="font-size: 2rem; font-weight: bold; color: #219150;">{{ $stats['taux_ponctualite'] }}%</div>
                <div style="color: #666; font-size: 0.9rem;">Ponctualité</div>
                <div style="font-size: 0.8rem; color: #999;">{{ $stats['livraisons_a_temps'] }}/{{ $stats['commandes_livrees'] }} livraisons</div>
            </div>
            <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; text-align: center;">
                <div style="font-size: 2rem; font-weight: bold; color: #219150;">{{ $stats['commandes_livrees'] }}</div>
                <div style="color: #666; font-size: 0.9rem;">Commandes livrées</div>
            </div>
        </div>
    </div>

    <!-- Commandes récentes -->
    <div style="background: #fff; border-radius: 12px; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <h3 style="font-size: 1.3rem; font-weight: 600; color: #17423b; margin-bottom: 1.5rem;">📦 Commandes récentes</h3>
        
        @if($commandes_recentes->count() > 0)
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #f8f9fa;">
                            <th style="padding: 1rem; text-align: left; border-bottom: 2px solid #dee2e6;">Référence</th>
                            <th style="padding: 1rem; text-align: left; border-bottom: 2px solid #dee2e6;">Bon de commande</th>
                            <th style="padding: 1rem; text-align: center; border-bottom: 2px solid #dee2e6;">Montant</th>
                            <th style="padding: 1rem; text-align: center; border-bottom: 2px solid #dee2e6;">Statut</th>
                            <th style="padding: 1rem; text-align: center; border-bottom: 2px solid #dee2e6;">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($commandes_recentes as $commande)
                            <tr style="border-bottom: 1px solid #dee2e6;">
                                <td style="padding: 1rem;">
                                    <a href="{{ route('commande.details', $commande) }}" style="color: #219150; text-decoration: none; font-weight: 600;">
                                        {{ $commande->reference }}
                                    </a>
                                </td>
                                <td style="padding: 1rem;">
                                    @if($commande->bonCommande)
                                        <a href="{{ route('bons-commande.show', $commande->bonCommande) }}" style="color: #666; text-decoration: none;">
                                            {{ $commande->bonCommande->reference }}
                                        </a>
                                    @else
                                        <span style="color: #999;">-</span>
                                    @endif
                                </td>
                                <td style="padding: 1rem; text-align: center; font-weight: 600;">
                                    {{ number_format($commande->montant_total, 0, ',', ' ') }} FCFA
                                </td>
                                <td style="padding: 1rem; text-align: center;">
                                    <span style="padding: 0.3rem 0.8rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600; 
                                        background: {{ $commande->statut == 'livree' ? '#eafaf4' : ($commande->statut == 'en_cours' ? '#fff3cd' : '#f8d7da') }};
                                        color: {{ $commande->statut == 'livree' ? '#219150' : ($commande->statut == 'en_cours' ? '#856404' : '#721c24') }};">
                                        {{ ucfirst($commande->statut) }}
                                    </span>
                                </td>
                                <td style="padding: 1rem; text-align: center; color: #666;">
                                    {{ $commande->created_at->format('d/m/Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div style="text-align: center; color: #999; padding: 2rem;">
                <i class="fas fa-box-open" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                <p>Aucune commande pour ce fournisseur</p>
            </div>
        @endif
    </div>

    <!-- Évolution mensuelle -->
    @if($evolution_mensuelle->count() > 0)
        <div style="background: #fff; border-radius: 12px; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <h3 style="font-size: 1.3rem; font-weight: 600; color: #17423b; margin-bottom: 1.5rem;">📊 Évolution des commandes (6 derniers mois)</h3>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1rem;">
                @foreach($evolution_mensuelle as $evolution)
                    <div style="background: #f8f9fa; padding: 1rem; border-radius: 8px; text-align: center;">
                        <div style="font-weight: 600; color: #17423b; margin-bottom: 0.5rem;">
                            {{ \Carbon\Carbon::createFromDate($evolution->annee, $evolution->mois, 1)->format('M Y') }}
                        </div>
                        <div style="font-size: 1.5rem; font-weight: bold; color: #219150;">{{ $evolution->nombre }}</div>
                        <div style="color: #666; font-size: 0.8rem;">commandes</div>
                        <div style="color: #666; font-size: 0.8rem;">{{ number_format($evolution->montant, 0, ',', ' ') }} FCFA</div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection 