#!/bin/bash

# Script de démarrage pour GMAO Trans'urb avec Docker

set -e

echo "🚀 Démarrage de GMAO Trans'urb avec Docker..."

# Vérifier que Docker est installé et en cours d'exécution
if ! command -v docker &> /dev/null; then
    echo "❌ Docker n'est pas installé. Veuillez installer Docker Desktop."
    exit 1
fi

if ! docker info &> /dev/null; then
    echo "❌ Docker n'est pas en cours d'exécution. Veuillez démarrer Docker Desktop."
    exit 1
fi

# Créer le fichier .env s'il n'existe pas
if [ ! -f .env ]; then
    echo "📄 Création du fichier .env..."
    cp env.example .env
    echo "✅ Fichier .env créé. Veuillez le modifier selon vos besoins."
fi

# Vérifier la variable APP_KEY
if ! grep -q "APP_KEY=base64:" .env; then
    echo "🔑 Génération de la clé d'application..."
    
    # Générer une clé temporaire
    APP_KEY=$(openssl rand -base64 32)
    if [ -n "$APP_KEY" ]; then
        sed -i.bak "s/APP_KEY=/APP_KEY=base64:$APP_KEY/" .env
        echo "✅ Clé d'application générée."
    else
        echo "⚠️  Impossible de générer la clé automatiquement."
        echo "   Utilisez : docker-compose exec app php artisan key:generate"
    fi
fi

# Arrêter les services existants (au cas où)
echo "🛑 Arrêt des services existants..."
docker-compose down --remove-orphans

# Construire les images
echo "🏗️  Construction des images Docker..."
if docker-compose build; then
    echo "✅ Images construites avec succès."
else
    echo "❌ Erreur lors de la construction des images."
    echo "💡 Essayez : docker system prune -f && docker-compose build --no-cache"
    exit 1
fi

# Démarrer les services
echo "▶️  Démarrage des services..."
if docker-compose up -d; then
    echo "✅ Services démarrés avec succès !"
    
    # Attendre quelques secondes pour que les services se stabilisent
    echo "⏳ Attente de la stabilisation des services..."
    sleep 10
    
    # Afficher le statut
    echo "📊 Statut des services :"
    docker-compose ps
    
    echo ""
    echo "🎉 GMAO Trans'urb est maintenant accessible !"
    echo "🌐 Application web : http://localhost:8084"
    echo "🗄️  Base de données : localhost:3308"
    echo "🔴 Redis : localhost:6379"
    echo ""
    echo "📋 Commandes utiles :"
    echo "   Voir les logs : docker-compose logs -f"
    echo "   Arrêter : docker-compose down"
    echo "   Redémarrer : docker-compose restart"
    echo ""
    
else
    echo "❌ Erreur lors du démarrage des services."
    echo "📋 Voir les logs : docker-compose logs"
    exit 1
fi
