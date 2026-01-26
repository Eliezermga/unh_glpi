#!/bin/bash
# Installation serveur GLPI - 91.134.181.62

# Installation Docker
curl -fsSL https://get.docker.com -o get-docker.sh
sh get-docker.sh

# Installation Nginx
apt update
apt install -y nginx

# Configuration Nginx
cp nginx/glpi.conf /etc/nginx/sites-available/glpi
ln -sf /etc/nginx/sites-available/glpi /etc/nginx/sites-enabled/
rm -f /etc/nginx/sites-enabled/default

# Test configuration
nginx -t && systemctl reload nginx

# Création des volumes Docker
docker volume create glpi-data
docker volume create glpi-config

# Installation MySQL (optionnel)
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

echo "Serveur configuré. Déploiement via GitHub Actions prêt."