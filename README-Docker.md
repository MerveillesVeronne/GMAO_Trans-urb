# 🐳 Configuration Docker pour GMAO Trans'urb

Cette documentation explique comment utiliser Docker pour déployer l'application GMAO Trans'urb.

## 📋 Prérequis

- Docker Engine 20.10+
- Docker Compose 2.0+
- Git

## 🚀 Installation et démarrage

### 1. Cloner le projet

```bash
git clone <url-du-repo>
cd GMAO_Trans-urb
```

### 2. Configurer les variables d'environnement

```bash
# Copier le fichier d'exemple
cp env.example .env

# Éditer le fichier .env selon vos besoins
nano .env
```

### 3. Construire et démarrer les services

#### Pour la production :

```bash
# Construire les images
docker-compose build

# Démarrer tous les services
docker-compose up -d

# Voir les logs
docker-compose logs -f
```

#### Pour le développement :

```bash
# Démarrer en mode développement (avec SQLite et Vite)
docker-compose -f docker-compose.dev.yml up -d

# Ou démarrer uniquement l'application
docker-compose -f docker-compose.dev.yml up app
```

## 🏗️ Architecture des services

### Services inclus

1. **app** - Application Laravel principale
2. **db** - Base de données MySQL 8.0
3. **redis** - Cache et sessions Redis
4. **phpmyadmin** - Interface web pour gérer MySQL
5. **nginx** - Serveur web (proxy inverse)
6. **queue** - Gestionnaire des files d'attente
7. **scheduler** - Planificateur de tâches (cron)

### Ports exposés

- **8084** : Application web principale
- **3308** : Base de données MySQL
- **6379** : Redis
- **8085** : PHPMyAdmin (interface de gestion MySQL)
- **80** : Nginx (production)
- **5173** : Serveur Vite (développement)

## 🔧 Commandes utiles

### Gestion des conteneurs

```bash
# Voir le statut des conteneurs
docker-compose ps

# Redémarrer un service
docker-compose restart app

# Voir les logs d'un service
docker-compose logs -f app

# Arrêter tous les services
docker-compose down

# Arrêter et supprimer les volumes
docker-compose down -v
```

### Commandes Laravel

```bash
# Exécuter une commande Artisan
docker-compose exec app php artisan migrate

# Accéder au conteneur
docker-compose exec app sh

# Installer les dépendances
docker-compose exec app composer install

# Générer la clé d'application
docker-compose exec app php artisan key:generate
```

### Base de données

```bash
# Exécuter les migrations
docker-compose exec app php artisan migrate

# Exécuter les seeders
docker-compose exec app php artisan db:seed

# Accéder à MySQL via ligne de commande
docker-compose exec db mysql -u gmao_user -p gmao_transurb

# Accéder à MySQL via PHPMyAdmin
# Ouvrir http://localhost:8085 dans votre navigateur
# Utilisateur : gmao_user (ou root)
# Mot de passe : gmao_password (ou root_password pour root)
```

## 📂 Structure des fichiers Docker

```
docker/
├── nginx/           # Configuration Nginx
│   ├── nginx.conf
│   └── default.conf
├── php/            # Configuration PHP
│   ├── php.ini
│   └── opcache.ini
├── supervisor/     # Configuration Supervisor
│   └── supervisord.conf
├── scripts/        # Scripts d'initialisation
│   └── entrypoint.sh
└── mysql/          # Configuration MySQL
    └── my.cnf
```

## 🔐 Sécurité

### Variables d'environnement sensibles

Assurez-vous de définir des mots de passe forts pour :

- `APP_KEY` : Clé de chiffrement Laravel
- `DB_ROOT_PASSWORD` : Mot de passe root MySQL
- `DB_PASSWORD` : Mot de passe utilisateur MySQL

### Recommandations

1. Utilisez des mots de passe complexes
2. Limitez l'accès aux ports en production
3. Configurez un reverse proxy avec SSL/TLS
4. Surveillez les logs de sécurité

## 🚀 Déploiement en production

### 1. Optimisations

```bash
# Optimiser Laravel
docker-compose exec app php artisan optimize

# Nettoyer le cache
docker-compose exec app php artisan cache:clear
```

### 2. SSL/TLS

Placez vos certificats SSL dans `docker/ssl/` et modifiez la configuration Nginx.

### 3. Monitoring

Considérez l'ajout de services de monitoring comme :
- Prometheus + Grafana
- ELK Stack (Elasticsearch, Logstash, Kibana)

## 🐛 Dépannage

### Problèmes courants

1. **Erreur de connexion à la base de données**
   ```bash
   # Vérifier que MySQL est démarré
   docker-compose ps db
   
   # Voir les logs MySQL
   docker-compose logs db
   ```

2. **Problèmes de permissions**
   ```bash
   # Corriger les permissions
   docker-compose exec app chown -R www:www storage bootstrap/cache
   ```

3. **Cache Redis non accessible**
   ```bash
   # Vérifier Redis
   docker-compose exec redis redis-cli ping
   ```

### Commandes de diagnostic

```bash
# Voir l'utilisation des ressources
docker stats

# Inspecter un conteneur
docker inspect gmao_transurb_app

# Voir les réseaux
docker network ls
```

## 📞 Support

Pour obtenir de l'aide :

1. Consultez les logs : `docker-compose logs`
2. Vérifiez la configuration dans le fichier `.env`
3. Assurez-vous que tous les services sont démarrés

## 📝 Notes de version

- **v1.0** : Configuration initiale avec Laravel 12, MySQL 8.0, Redis 7
- Support de PHP 8.2
- Optimisations de performance incluses
- Configuration de développement et production séparées
