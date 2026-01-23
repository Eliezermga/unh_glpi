#!/bin/bash

# Attendre que MySQL soit prêt (avec timeout)
echo "Attente de MySQL..."
for i in {1..30}; do
    if mysqladmin ping -h"$DB_HOST" -u"$DB_USER" -p"$DB_PASSWORD" --silent 2>/dev/null; then
        echo "MySQL est prêt!"
        break
    fi
    if [ $i -eq 30 ]; then
        echo "Timeout MySQL - démarrage d'Apache sans DB"
        break
    fi
    sleep 2
done

# Démarrer Apache
exec apache2-foreground