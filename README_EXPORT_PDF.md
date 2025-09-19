# Export PDF - GMAO Trans'urb

## 🎯 Fonctionnalités Ajoutées

### 1. **Export PDF de la Liste des Véhicules**
- **Route** : `GET /maintenance/vehicules/export/pdf`
- **Nom** : `maintenance.vehicules.export.pdf`
- **Fichier généré** : `liste-vehicules-YYYY-MM-DD.pdf`

### 2. **Export PDF des Interventions d'un Véhicule**
- **Route** : `GET /maintenance/vehicules/{id}/interventions/export/pdf`
- **Nom** : `maintenance.vehicules.interventions.export.pdf`
- **Fichier généré** : `interventions-{numero}-YYYY-MM-DD.pdf`

## 📋 Contenu des Exports

### Liste des Véhicules
- **En-tête** : Titre, date de génération
- **Statistiques** : Compteurs par statut (En Service, Au Garage, En Réparation, Maintenance)
- **Tableau détaillé** : Tous les véhicules avec leurs informations complètes
- **Pied de page** : Total des véhicules

**Colonnes incluses :**
- Numéro du véhicule
- Immatriculation
- Type de véhicule
- Marque et modèle
- Année
- Affectation (avec entité de location si applicable)
- Ligne de transport assignée
- Statut actuel
- Capacité en passagers

### Interventions d'un Véhicule
- **En-tête** : Titre, numéro du véhicule, date de génération
- **Informations du véhicule** : Détails complets du véhicule
- **Historique des interventions** : Toutes les interventions avec détails
- **Résumé** : Statistiques des interventions (total, en cours, terminées, coût total)

**Informations des interventions :**
- Date d'intervention
- Nature de l'intervention
- Description
- Technicien assigné
- Priorité
- Statut
- Coût

## 🚀 Utilisation

### Export de la Liste des Véhicules
1. Aller sur la page **Liste des Véhicules** (`/maintenance/vehicules`)
2. Cliquer sur le bouton **"Exporter PDF"** (bleu, avec icône PDF)
3. Le fichier se télécharge automatiquement

### Export des Interventions d'un Véhicule
1. Aller sur la page **Détails d'un Véhicule** (`/maintenance/vehicules/{id}`)
2. Dans la section "Interventions Récentes"
3. Cliquer sur le bouton **"Exporter interventions"** (bleu, avec icône PDF)
4. Le fichier se télécharge automatiquement

## 🎨 Design des PDF

### Style Général
- **Police** : Arial (compatible avec tous les systèmes)
- **Couleurs** : Palette bleue professionnelle
- **Mise en page** : Responsive et lisible
- **En-têtes** : Titre GMAO Trans'urb avec bordure bleue

### Éléments Visuels
- **Statuts** : Couleurs distinctives pour chaque statut
- **Priorités** : Codes couleur pour les niveaux de priorité
- **Tableaux** : Lignes alternées pour une meilleure lisibilité
- **Bordures** : Cadres nets et professionnels

## 🔧 Configuration Technique

### Dépendances
- **DomPDF** : Package Laravel déjà installé
- **Routes** : Ajoutées dans le groupe middleware `maintenance`
- **Contrôleur** : Méthodes ajoutées au `VehiculeController`

### Modèles Utilisés
- **Vehicule** : Avec relation `ligneTransport`
- **Intervention** : Avec relations `user`, `intervenant`
- **LigneTransport** : Pour les informations de ligne

### Vues PDF
- **`liste.blade.php`** : Template pour la liste des véhicules
- **`interventions.blade.php`** : Template pour les interventions

## 📁 Structure des Fichiers

```
resources/views/maintenance/vehicules/pdf/
├── liste.blade.php           # Template liste des véhicules
└── interventions.blade.php   # Template interventions d'un véhicule
```

## 🎯 Avantages

### Pour les Utilisateurs
- **Rapports imprimables** : Documents professionnels pour réunions
- **Archivage** : Sauvegarde des informations importantes
- **Partage** : Envoi par email ou impression
- **Audit** : Traçabilité des interventions

### Pour l'Administration
- **Suivi** : Vue d'ensemble de la flotte
- **Maintenance** : Historique détaillé des interventions
- **Coûts** : Suivi des dépenses de maintenance
- **Planification** : Données pour la planification

## 🚨 Notes Importantes

### Génération des PDF
- Les PDF sont générés **à la demande**
- Pas de stockage temporaire des fichiers
- Téléchargement direct dans le navigateur

### Performance
- **Petits volumes** : Génération instantanée
- **Gros volumes** : Peut prendre quelques secondes
- **Mémoire** : Optimisé pour éviter les dépassements

### Compatibilité
- **Navigateurs** : Tous les navigateurs modernes
- **Systèmes** : Windows, macOS, Linux
- **Lecteurs PDF** : Adobe Reader, Chrome, Firefox, etc.

## 🔮 Évolutions Futures Possibles

- **Filtres** : Export par statut, type, ligne
- **Périodes** : Export sur une période donnée
- **Formats** : Export Excel, CSV
- **Planification** : Génération automatique de rapports
- **Email** : Envoi automatique des rapports



