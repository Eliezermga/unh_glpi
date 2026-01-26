#!/bin/bash
set -e

# Configuration de la base de données via variables d'environnement
if [ ! -f /var/www/html/config/config_db.php ] && [ -n "$DB_HOST" ]; then
    cat > /var/www/html/config/config_db.php << EOF
<?php
class DB extends DBmysql {
   public \$dbhost = '${DB_HOST}';
   public \$dbuser = '${DB_USER}';
   public \$dbpassword = '${DB_PASS}';
   public \$dbdefault = '${DB_NAME}';
}
EOF
fi

# Vérification des permissions
if [ "$(id -u)" = "0" ]; then
    chown -R glpi:glpi /var/www/html/files /var/www/html/config
fi

# Exécution de la commande
exec "$@"