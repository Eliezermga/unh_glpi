#!/bin/bash
set -e

echo "Waiting for MySQL..."

until mysqladmin ping \
  -h"$DB_HOST" \
  -u"$DB_USER" \
  -p"$DB_PASSWORD" \
  --silent; do
    echo "MySQL not ready, waiting..."
    sleep 5
done

echo "MySQL is ready."

exec apache2-foreground
