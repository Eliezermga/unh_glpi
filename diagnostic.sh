#!/bin/bash

echo "=== Diagnostic GLPI ==="

echo "1. Statut des conteneurs :"
docker-compose ps

echo -e "\n2. Logs MySQL :"
docker-compose logs mysql | tail -20

echo -e "\n3. Logs GLPI :"
docker-compose logs web | tail -20

echo -e "\n4. Test réseau entre conteneurs :"
docker-compose exec web ping -c 3 mysql 2>/dev/null || echo "Ping MySQL échoué"

echo -e "\n5. Variables d'environnement GLPI :"
docker-compose exec web env | grep DB_

echo -e "\n6. Test connexion MySQL :"
docker-compose exec web mysqladmin ping -h mysql -u glpi -pglpi_password 2>/dev/null && echo "MySQL accessible" || echo "MySQL non accessible"

echo -e "\n7. Ports ouverts :"
netstat -tlnp | grep -E ':(8080|3306)'