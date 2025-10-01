#!/bin/bash

# Script de diagnostic pour GMAO Trans'urb Docker

echo "🔍 Diagnostic GMAO Trans'urb Docker"
echo "=================================="

# Vérifier Docker
echo ""
echo "📦 Docker Information:"
echo "---------------------"
if command -v docker &> /dev/null; then
    echo "✅ Docker installé : $(docker --version)"
    if docker info &> /dev/null; then
        echo "✅ Docker en cours d'exécution"
    else
        echo "❌ Docker n'est pas en cours d'exécution"
    fi
else
    echo "❌ Docker n'est pas installé"
fi

# Vérifier Docker Compose
if command -v docker-compose &> /dev/null; then
    echo "✅ Docker Compose installé : $(docker-compose --version)"
else
    echo "❌ Docker Compose n'est pas installé"
fi

# Statut des conteneurs
echo ""
echo "📊 Statut des conteneurs:"
echo "-------------------------"
docker-compose ps

# Utilisation des ressources
echo ""
echo "💾 Utilisation des ressources:"
echo "------------------------------"
docker stats --no-stream

# Vérifier les logs récents
echo ""
echo "📋 Logs récents des services:"
echo "-----------------------------"
echo "Application:"
docker-compose logs --tail=10 app 2>/dev/null | head -5

echo ""
echo "Base de données:"
docker-compose logs --tail=10 db 2>/dev/null | head -5

echo ""
echo "Redis:"
docker-compose logs --tail=10 redis 2>/dev/null | head -5

# Vérifier la connectivité réseau
echo ""
echo "🌐 Connectivité réseau:"
echo "----------------------"
if docker-compose exec -T app nc -z db 3306 2>/dev/null; then
    echo "✅ Connexion app -> db : OK"
else
    echo "❌ Connexion app -> db : ÉCHEC"
fi

if docker-compose exec -T app nc -z redis 6379 2>/dev/null; then
    echo "✅ Connexion app -> redis : OK"
else
    echo "❌ Connexion app -> redis : ÉCHEC"
fi

# Vérifier les volumes
echo ""
echo "💿 Volumes Docker:"
echo "-----------------"
docker volume ls | grep gmao || echo "Aucun volume GMAO trouvé"

# Vérifier les réseaux
echo ""
echo "🔗 Réseaux Docker:"
echo "------------------"
docker network ls | grep gmao || echo "Aucun réseau GMAO trouvé"

# Espace disque
echo ""
echo "💽 Espace disque Docker:"
echo "------------------------"
docker system df

echo ""
echo "🏁 Diagnostic terminé"
echo "===================="
echo ""
echo "💡 Commandes utiles pour le dépannage :"
echo "   - Voir tous les logs : docker-compose logs"
echo "   - Redémarrer tout : docker-compose restart"
echo "   - Reconstruire : docker-compose build --no-cache"
echo "   - Nettoyer : docker system prune -f"
