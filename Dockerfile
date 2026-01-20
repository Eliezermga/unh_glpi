# Multi-stage build pour optimiser la taille
FROM php:8.1-apache-slim as base

# Installation des dépendances système minimales
RUN apt-get update && apt-get install -y --no-install-recommends \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libicu-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    && rm -rf /var/lib/apt/lists/*

# Installation des extensions PHP requises
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    mysqli \
    pdo_mysql \
    gd \
    zip \
    intl \
    curl \
    xml \
    dom \
    fileinfo \
    session \
    simplexml

# Configuration Apache
RUN a2enmod rewrite headers \
    && sed -i 's/80/8080/' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's/80/8080/' /etc/apache2/ports.conf

# Configuration PHP pour production
RUN { \
    echo 'memory_limit = 256M'; \
    echo 'upload_max_filesize = 20M'; \
    echo 'post_max_size = 20M'; \
    echo 'max_execution_time = 300'; \
    echo 'session.cookie_httponly = 1'; \
    echo 'session.cookie_secure = 1'; \
    echo 'expose_php = Off'; \
} > /usr/local/etc/php/conf.d/glpi.ini

# Stage de build
FROM base as builder

WORKDIR /tmp/glpi
COPY . .

# Nettoyage des fichiers de développement
RUN rm -rf \
    .git* \
    tests/ \
    tools/phpunit/ \
    *.md \
    composer.* \
    phpunit.xml* \
    phpstan.* \
    .php* \
    node_modules/

# Stage final
FROM base as production

# Création de l'utilisateur non-root
RUN groupadd -r glpi && useradd -r -g glpi -s /bin/false glpi

# Copie de l'application
COPY --from=builder --chown=glpi:glpi /tmp/glpi /var/www/html/

# Configuration des permissions
RUN chown -R glpi:glpi /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/files /var/www/html/config

# Script d'entrée
COPY --chown=glpi:glpi docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Configuration Apache pour utilisateur non-root
RUN sed -i 's/Listen 8080/Listen 8080/' /etc/apache2/ports.conf \
    && echo "User glpi" >> /etc/apache2/apache2.conf \
    && echo "Group glpi" >> /etc/apache2/apache2.conf

EXPOSE 8080

USER glpi

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"]