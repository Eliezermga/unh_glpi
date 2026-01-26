#!/bin/bash

echo "=== Test de connectivité MySQL ==="

# Redémarrer complètement
docker-compose down -v
docker-compose up -d

# Attendre MySQL
echo "Attente de MySQL (60s)..."
sleep 60

# Tester la résolution DNS
echo "Test résolution DNS :"
docker-compose exec web nslookup mysql

# Tester la connectivité MySQL
echo "Test connexion MySQL :"
docker-compose exec web mysqladmin ping -h mysql -u glpi -pglpi_password

# Afficher les logs
echo "Logs GLPI :"
docker-compose logs web | tail -10