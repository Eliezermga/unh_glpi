#!/bin/bash

echo "=== Commandes de vérification GLPI Docker ==="
echo ""

echo "1. Démarrer la stack complète :"
echo "   docker compose up -d"
echo ""

echo "2. Vérifier l'état des services :"
echo "   docker compose ps"
echo ""

echo "3. Voir les logs en temps réel :"
echo "   docker compose logs -f"
echo ""

echo "4. Logs spécifiques par service :"
echo "   docker compose logs glpi"
echo "   docker compose logs database"
echo ""

echo "5. Accéder au conteneur GLPI :"
echo "   docker compose exec glpi bash"
echo ""

echo "6. Accéder à MySQL :"
echo "   docker compose exec database mysql -u glpi_user -p glpi"
echo ""

echo "7. Vérifier la connectivité réseau :"
echo "   docker compose exec glpi ping database"
echo ""

echo "8. Redémarrer un service :"
echo "   docker compose restart glpi"
echo "   docker compose restart database"
echo ""

echo "9. Arrêter la stack :"
echo "   docker compose down"
echo ""

echo "10. Arrêter et supprimer les volumes (⚠️ PERTE DE DONNÉES) :"
echo "    docker compose down -v"
echo ""

echo "11. Vérifier les volumes :"
echo "    docker volume ls | grep unh_glpi"
echo ""

echo "12. Monitoring des ressources :"
echo "    docker compose top"
echo "    docker stats"