#!/bin/bash
set -e

# Génération de la config DB GLPI si absente
if [ ! -f /var/www/html/config/config_db.php ] && [ -n "$DB_HOST" ]; then
cat > /var/www/html/config/config_db.php <<EOF
<?php
class DB extends DBmysql {
   public \$dbhost = '${DB_HOST}';
   public \$dbuser = '${DB_USER}';
   public \$dbpassword = '${DB_PASSWORD}';
   public \$dbdefault = '${DB_NAME}';
}
EOF
fi

# Permissions
if [ "$(id -u)" = "0" ]; then
    chown -R glpi:glpi /var/www/html/files /var/www/html/config
fi

exec "$@"
