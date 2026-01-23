#!/bin/bash
# Installation serveur GLPI - VPS
# Objectif : Docker + Nginx + MySQL 5.7 (obligatoire)

set -e

echo "=== Installation Docker ==="
curl -fsSL https://get.docker.com -o get-docker.sh
sh get-docker.sh

echo "=== Installation Nginx ==="
apt update -y
apt install -y nginx

echo "=== Configuration Nginx ==="
cp nginx/glpi.conf /etc/nginx/sites-available/glpi
ln -sf /etc/nginx/sites-available/glpi /etc/nginx/sites-enabled/glpi
rm -f /etc/nginx/sites-enabled/default

nginx -t
systemctl reload nginx

echo "=== Création des volumes Docker ==="
docker volume create glpi-data
docker volume create glpi-config
docker volume create glpi-mysql

echo "=== Installation MySQL 5.7 (obligatoire) ==="
docker rm -f glpi-mysql 2>/dev/null || true

docker run -d \
  --name glpi-mysql \
  --restart unless-stopped \
  -e MYSQL_ROOT_PASSWORD=rootpass123 \
  -e MYSQL_DATABASE=glpi \
  -e MYSQL_USER=glpi \
  -e MYSQL_PASSWORD=glpi123 \
  -p 127.0.0.1:3306:3306 \
  -v glpi-mysql:/var/lib/mysql \
  mysql:5.7

echo "=== Attente MySQL ==="
until docker exec glpi-mysql mysqladmin ping -h localhost --silent; do
  echo "Waiting for MySQL 5.7..."
  sleep 3
done

echo "=== MySQL 5.7 prêt ==="
echo "Serveur configuré. Déploiement via GitHub Actions prêt."
