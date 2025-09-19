# Système de Gestion des Carburations - GMAO Trans'urb

## 🎯 Vue d'ensemble

Le système de gestion des carburations permet de suivre et planifier les carburations des véhicules de la flotte Trans'urb. Il intègre parfaitement avec le système de gestion des véhicules et des interventions.

## 🔧 Fonctionnalités Principales

### **Gestion des Carburations**
- **Création** : Ajouter de nouvelles carburations planifiées ou effectuées
- **Modification** : Mettre à jour les informations des carburations existantes
- **Suppression** : Supprimer les carburations obsolètes
- **Consultation** : Visualiser l'historique complet des carburations

### **Types de Carburants Supportés**
- **Diesel** : Carburant principal pour la flotte
- **Essence** : Pour certains véhicules légers
- **GPL** : Alternative écologique
- **Électrique** : Pour les véhicules électriques

### **États des Carburations**
- **Planifiée** : Carburation prévue mais pas encore effectuée
- **Effectuée** : Carburation réalisée avec succès
- **Annulée** : Carburation annulée pour diverses raisons

## 📊 Structure des Données

### **Table `carburations`**
```sql
- id (Primary Key)
- vehicule_id (Foreign Key -> vehicules)
- chauffeur_id (Foreign Key -> users)
- date_carburation (Date)
- heure_carburation (Time)
- quantite_litres (Decimal 8,2)
- prix_litre (Decimal 8,2)
- cout_total (Decimal 10,2) - Calculé automatiquement
- etat (Enum: Planifiée, Effectuée, Annulée)
- type_carburation (Enum: Essence, Diesel, GPL, Électrique)
- notes (Text, nullable)
- created_at, updated_at (Timestamps)
```

### **Relations**
- **Carburation** → **Vehicule** (belongsTo)
- **Carburation** → **Chauffeur** (belongsTo)
- **Vehicule** → **Carburations** (hasMany)

## 🚀 Interface Utilisateur

### **Page de Liste (`/maintenance/carburations`)**
- Tableau des carburations avec pagination
- Filtrage par véhicule, chauffeur, état
- Actions rapides (voir, modifier, supprimer)
- Bouton pour créer une nouvelle carburation

### **Formulaire de Création (`/maintenance/carburations/create`)**
- Sélection du véhicule et du chauffeur
- Date et heure de carburation
- Quantité et prix par litre
- Type de carburant et état
- Notes optionnelles
- Calcul automatique du coût total

### **Page de Détails (`/maintenance/carburations/{id}`)**
- Informations complètes de la carburation
- Liens vers le véhicule et le chauffeur
- Actions disponibles (modifier, supprimer)
- Affichage formaté des montants

### **Formulaire de Modification (`/maintenance/carburations/{id}/edit`)**
- Pré-remplissage des données existantes
- Validation côté client et serveur
- Mise à jour en temps réel

## 🔗 Intégration avec les Véhicules

### **Section Carburations dans la Vue Véhicule**
- Affichage des 5 dernières carburations
- Bouton pour créer une nouvelle carburation
- Navigation directe vers les détails

### **Export PDF Combiné**
- Les carburations sont incluses dans l'export des interventions
- Même document avec sections séparées
- Résumé des coûts et statistiques

## 💰 Gestion Financière

### **Calcul Automatique des Coûts**
```php
$coutTotal = $quantite_litres * $prix_litre;
```

### **Suivi des Dépenses**
- Coût par carburation
- Coût total par véhicule
- Statistiques par période
- Comparaison entre véhicules

## 📱 Responsive Design

### **Adaptation Mobile**
- Grille responsive (1-3 colonnes selon l'écran)
- Boutons tactiles optimisés
- Navigation intuitive

### **Composants UI**
- Modals de confirmation
- Notifications de succès/erreur
- Formulaires validés
- Tableaux avec tri

## 🔒 Sécurité et Validation

### **Validation Côté Serveur**
```php
'vehicule_id' => 'required|exists:vehicules,id',
'chauffeur_id' => 'required|exists:users,id',
'date_carburation' => 'required|date',
'quantite_litres' => 'required|numeric|min:0.01',
'prix_litre' => 'required|numeric|min:0.01',
'etat' => 'required|in:Planifiée,Effectuée,Annulée',
'type_carburation' => 'required|in:Essence,Diesel,GPL,Électrique'
```

### **Protection CSRF**
- Tokens automatiques sur tous les formulaires
- Validation côté serveur obligatoire

## 📈 Statistiques et Rapports

### **Métriques Disponibles**
- Nombre total de carburations
- Répartition par état
- Coût total des carburations
- Fréquence par véhicule
- Consommation par type de carburant

### **Export PDF**
- Historique complet des carburations
- Informations du véhicule
- Résumé financier
- Format professionnel

## 🚀 Utilisation

### **Créer une Carburation**
1. Accéder à `/maintenance/carburations/create`
2. Sélectionner le véhicule et le chauffeur
3. Renseigner la date, heure et quantité
4. Choisir le type de carburant et l'état
5. Ajouter des notes si nécessaire
6. Valider la création

### **Modifier une Carburation**
1. Accéder aux détails de la carburation
2. Cliquer sur "Modifier"
3. Ajuster les informations nécessaires
4. Sauvegarder les modifications

### **Consulter l'Historique**
1. Accéder à la liste des carburations
2. Utiliser les filtres si nécessaire
3. Cliquer sur "Voir" pour les détails
4. Naviguer entre les pages

## 🔮 Évolutions Futures

### **Fonctionnalités Avancées**
- **Alertes** : Notifications de carburations planifiées
- **Planification** : Calendrier des carburations
- **Analyse** : Graphiques de consommation
- **Intégration** : Synchronisation avec les stations-service

### **Automatisations**
- **Rappels** : Notifications automatiques
- **Calculs** : Estimation des besoins en carburant
- **Rapports** : Génération automatique des rapports

## 📝 Notes Techniques

### **Performance**
- Pagination des résultats (15 par page)
- Relations eager loading pour éviter les N+1 queries
- Index sur les colonnes fréquemment utilisées

### **Maintenance**
- Migrations réversibles
- Seeders pour les données de test
- Validation robuste des données

### **Compatibilité**
- Laravel 10+
- PHP 8.1+
- Base de données MySQL/PostgreSQL
- Navigateurs modernes (ES6+)

---

**Système développé pour GMAO Trans'urb**  
*Gestion de Maintenance Assistée par Ordinateur*
