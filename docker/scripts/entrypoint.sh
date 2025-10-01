#!/bin/sh

# Script d'entrée pour le conteneur Laravel GMAO Trans'urb

set -e

echo "🚀 Démarrage de l'application GMAO Trans'urb..."

# Fonction pour attendre qu'un service soit prêt
wait_for_service() {
    local host=$1
    local port=$2
    local service_name=$3
    local max_attempts=30
    local attempt=1
    
    echo "⏳ Attente de $service_name ($host:$port)..."
    while ! nc -z "$host" "$port" >/dev/null 2>&1; do
        if [ $attempt -eq $max_attempts ]; then
            echo "❌ Timeout en attendant $service_name après $max_attempts tentatives"
            return 1
        fi
        echo "   Tentative $attempt/$max_attempts..."
        sleep 2
        attempt=$((attempt + 1))
    done
    echo "✅ $service_name est prêt !"
    return 0
}

# Attendre la base de données si elle est configurée
if [ "$DB_CONNECTION" = "mysql" ] && [ -n "$DB_HOST" ]; then
    wait_for_service "$DB_HOST" "${DB_PORT:-3306}" "MySQL"
fi

# Attendre Redis s'il est configuré
if [ -n "$REDIS_HOST" ]; then
    wait_for_service "$REDIS_HOST" "${REDIS_PORT:-6379}" "Redis"
fi

# Générer la clé d'application si elle n'existe pas
if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "" ]; then
    echo "🔑 Génération de la clé d'application..."
    php artisan key:generate --force --no-interaction
fi

# Créer le répertoire de sessions s'il n'existe pas
mkdir -p storage/framework/sessions

# Créer la base de données SQLite si elle est utilisée
if [ "$DB_CONNECTION" = "sqlite" ]; then
    echo "📄 Configuration de SQLite..."
    touch "${DB_DATABASE:-database/database.sqlite}"
    chmod 664 "${DB_DATABASE:-database/database.sqlite}"
fi

# Exécuter les migrations
echo "🗄️  Exécution des migrations..."
php artisan migrate --force --no-interaction || echo "⚠️  Les migrations ont échoué, continuons..."

# Créer le lien symbolique pour le stockage
if [ ! -L public/storage ]; then
    echo "🔗 Création du lien symbolique pour le stockage..."
    php artisan storage:link || echo "⚠️  Création du lien symbolique échouée"
fi

# Optimiser les configurations Laravel si en production
if [ "$APP_ENV" = "production" ]; then
    echo "⚙️  Optimisation des configurations..."
    php artisan config:cache || echo "⚠️  Cache de configuration échoué"
    php artisan route:cache || echo "⚠️  Cache de routes échoué"
    php artisan view:cache || echo "⚠️  Cache de vues échoué"
fi

# Optimiser l'autoloader
echo "🚀 Optimisation de l'autoloader..."
composer dump-autoload --optimize || echo "⚠️  Optimisation de l'autoloader échouée"

# Définir les permissions appropriées
echo "🔐 Configuration des permissions..."
chown -R www-data:www-data storage bootstrap/cache || echo "⚠️  Configuration des permissions échouée"
chmod -R 775 storage bootstrap/cache || echo "⚠️  Configuration des permissions échouée"

# Exécuter les seeders en production si demandé
if [ "$APP_ENV" = "production" ] && [ "$RUN_SEEDERS" = "true" ]; then
    echo "🌱 Exécution des seeders..."
    php artisan db:seed --force || echo "⚠️  Seeders échoués"
fi

echo "✅ Application GMAO Trans'urb prête !"

# Exécuter la commande principale
exec "$@"