#!/bin/bash

# Attendre que MySQL soit prêt
echo "Attente de MySQL..."
while ! mysqladmin ping -h"$DB_HOST" -u"$DB_USER" -p"$DB_PASSWORD" --silent; do
    sleep 1
done

echo "MySQL est prêt!"

# Attendre un peu plus pour s'assurer que MySQL est complètement prêt
sleep 5

echo "MySQL est complètement prêt!"

# Démarrer Apache
exec apache2-foreground