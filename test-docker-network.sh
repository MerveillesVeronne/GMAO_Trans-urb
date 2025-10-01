#!/bin/bash

# Script pour tester et corriger la configuration réseau Docker

echo "🔧 Test de la configuration réseau Docker"
echo "=========================================="

# Test 1: Vérifier Docker Desktop
echo ""
echo "📦 Test 1: Docker Desktop"
echo "-------------------------"
if docker info > /dev/null 2>&1; then
    echo "✅ Docker Desktop fonctionne"
else
    echo "❌ Docker Desktop ne fonctionne pas"
    echo "💡 Solution: Redémarrez Docker Desktop"
    exit 1
fi

# Test 2: Vérifier la connectivité Internet
echo ""
echo "🌐 Test 2: Connectivité Internet depuis Docker"
echo "----------------------------------------------"
if docker run --rm alpine:latest ping -c 1 google.com > /dev/null 2>&1; then
    echo "✅ Connectivité Internet OK"
else
    echo "❌ Pas de connectivité Internet depuis Docker"
    echo "💡 Vérifiez votre configuration proxy ou VPN"
fi

# Test 3: Tester avec une image locale
echo ""
echo "🐳 Test 3: Construction avec image locale"
echo "-----------------------------------------"
if docker run --rm hello-world > /dev/null 2>&1; then
    echo "✅ Docker peut exécuter des conteneurs"
else
    echo "❌ Problème d'exécution de conteneurs"
fi

# Test 4: Nettoyer et essayer la version simplifiée
echo ""
echo "🧹 Test 4: Nettoyage et version simplifiée"
echo "-------------------------------------------"

echo "Nettoyage des ressources Docker..."
docker system prune -f > /dev/null 2>&1

echo "Test de construction avec la version simplifiée..."
if docker-compose -f docker-compose.simple.yml build > /dev/null 2>&1; then
    echo "✅ Construction avec la version simplifiée réussie"
    
    echo "Démarrage des services simplifiés..."
    if docker-compose -f docker-compose.simple.yml up -d; then
        echo "✅ Services démarrés avec succès !"
        echo ""
        echo "🎉 Application accessible sur: http://localhost:8084"
        echo "📋 Pour voir les logs: docker-compose -f docker-compose.simple.yml logs -f"
        echo "🛑 Pour arrêter: docker-compose -f docker-compose.simple.yml down"
    else
        echo "❌ Échec du démarrage des services"
    fi
else
    echo "❌ Échec de la construction même avec la version simplifiée"
    echo ""
    echo "🚨 Solutions possibles:"
    echo "1. Redémarrer Docker Desktop"
    echo "2. Vérifier la configuration proxy/VPN"
    echo "3. Changer les DNS Docker (8.8.8.8, 1.1.1.1)"
    echo "4. Augmenter les ressources allouées à Docker"
fi

echo ""
echo "🏁 Test terminé"
