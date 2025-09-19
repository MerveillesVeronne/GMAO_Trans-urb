# Gestion des Lignes de Transport - GMAO_Trans'urb

## Nouveautés Ajoutées

### 1. Modèle LigneTransport
- **Fichier** : `app/Models/LigneTransport.php`
- **Fonctionnalités** :
  - Gestion des types d'affectation (Location, Urbain, Inter-urbain)
  - Relation avec les véhicules
  - Statut actif/inactif
  - Description des lignes

### 2. Nouveaux Champs dans le Modèle Vehicule
- **affectation** : Type d'affectation (Location, Urbain, Inter-urbain)
- **entite_location** : Nom de l'entité pour les véhicules en location
- **ligne_transport_id** : Référence vers la ligne de transport

### 3. Formulaire Modifié des Véhicules
- **Champ affectation** : Select avec les 3 types d'affectation
- **Champ entité de location** : Apparaît uniquement si "Location" est sélectionné
- **Champ ligne de transport** : Select avec bouton pour créer de nouvelles lignes
- **Modal de création de lignes** : Intégré directement dans la page

### 4. Contrôleur LigneTransportController
- **Route POST** : `/maintenance/lignes-transport` pour créer des lignes
- **Route GET** : `/maintenance/lignes-transport/select` pour récupérer les lignes

## Installation et Configuration

### 1. Exécuter les Migrations
```bash
php artisan migrate
```

### 2. Exécuter les Seeders
```bash
php artisan db:seed --class=LigneTransportSeeder
```

### 3. Vérifier les Routes
Les routes sont automatiquement ajoutées dans le groupe middleware `maintenance`.

## Utilisation

### Création d'un Véhicule
1. Remplir le formulaire avec les informations de base
2. Sélectionner le **type d'affectation** :
   - **Location** : Saisir le nom de l'entité (CNSS, ANINF, etc.)
   - **Urbain** : Sélectionner une ligne urbaine
   - **Inter-urbain** : Sélectionner une ligne inter-urbaine
3. Choisir une **ligne de transport** existante ou en créer une nouvelle

### Création d'une Ligne de Transport
1. Cliquer sur le bouton **+** à côté du select des lignes
2. Remplir le formulaire :
   - **Nom** : Ex: "Rio-Charbonnage", "CNSS"
   - **Type d'affectation** : Location, Urbain, ou Inter-urbain
   - **Description** : Détails de la ligne
3. Valider pour créer la ligne

## Types d'Affectation

### Location
- Véhicules loués à des entités externes
- Exemples : CNSS, ANINF, autres administrations
- Champ "entité de location" obligatoire

### Urbain
- Lignes de transport urbain
- Exemples : Ligne 1, Ligne 2
- Pas de champ entité de location

### Inter-urbain
- Lignes entre villes
- Exemples : Rio-Charbonnage, Libreville-Ntoum
- Pas de champ entité de location

## Lignes Pré-configurées

Le seeder crée automatiquement :
- **CNSS** et **ANINF** (Location)
- **Ligne 1** et **Ligne 2** (Urbain)
- **Rio-Charbonnage** et **Libreville-Ntoum** (Inter-urbain)

## Structure de la Base de Données

### Table `lignes_transports`
- `id` : Clé primaire
- `nom` : Nom de la ligne
- `type_affectation` : Enum (Location, Urbain, Inter-urbain)
- `description` : Description de la ligne
- `actif` : Statut actif/inactif
- `created_at`, `updated_at` : Timestamps

### Table `vehicules` (modifiée)
- Nouveaux champs ajoutés après le champ `ligne` existant
- `affectation` : Type d'affectation
- `entite_location` : Entité de location
- `ligne_transport_id` : Clé étrangère vers lignes_transports

## Notes Techniques

- **Validation** : Les nouveaux champs sont validés côté serveur
- **Interface** : Modal intégré dans la page des véhicules
- **JavaScript** : Gestion dynamique de l'affichage des champs
- **Responsive** : Interface adaptée aux différentes tailles d'écran
