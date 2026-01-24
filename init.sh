#!/bin/bash
set -e

echo "🚀 Démarrage de GLPI..."

# Attendre que MySQL soit prêt (test TCP simple)
echo "⏳ Attente de la base de données..."
until nc -z -v -w30 "$DB_HOST" 3306; do
    echo "   Base de données non disponible, nouvelle tentative dans 5s..."
    sleep 5
done

echo "✅ Base de données disponible"

# Attendre 5 secondes supplémentaires pour que MySQL soit complètement prêt
sleep 5

# Vérifier si GLPI est déjà installé
if [ ! -f "/var/www/html/config/config_db.php" ]; then
    echo "📦 Première installation de GLPI..."
    
    # Copier la configuration de base
    cp /var/www/html/config/config_db.php.template /var/www/html/config/config_db.php 2>/dev/null || true
    
    # Installer GLPI via CLI si possible
    if [ -f "/var/www/html/bin/console" ]; then
        echo "🔧 Installation via console GLPI..."
        php /var/www/html/bin/console glpi:database:install \
            --db-host="$DB_HOST" \
            --db-name="$DB_NAME" \
            --db-user="$DB_USER" \
            --db-password="$DB_PASSWORD" \
            --no-interaction || echo "⚠️  Installation manuelle requise"
    fi
else
    echo "✅ GLPI déjà configuré"
fi

# Vérifier les permissions
echo "🔐 Vérification des permissions..."
chown -R www-data:www-data /var/www/html/files
chown -R www-data:www-data /var/www/html/config
chmod -R 755 /var/www/html
chmod -R 777 /var/www/html/files

echo "🌐 Démarrage d'Apache..."
exec apache2-foreground