#!/bin/bash

echo "=== Déploiement GLPI sur VPS ==="

# Arrêter les conteneurs existants
echo "Arrêt des conteneurs existants..."
docker-compose down 2>/dev/null || true

# Nettoyer les images non utilisées
echo "Nettoyage des images..."
docker system prune -f

# Construire et démarrer les services
echo "Construction et démarrage des services..."
docker-compose up -d --build

# Attendre que MySQL soit prêt
echo "Attente de MySQL..."
sleep 30

# Vérifier le statut des conteneurs
echo "Statut des conteneurs :"
docker-compose ps

# Tester la connectivité
echo "Test de connectivité :"
curl -I http://localhost:8080 || echo "Service non encore accessible"

echo "=== Déploiement terminé ==="
echo "GLPI accessible sur : http://votre-ip-vps:8080"