FROM php:8.1-apache

# Dépendances système
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libicu-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    libonig-dev \
    unzip \
    git \
    default-mysql-client \
    && rm -rf /var/lib/apt/lists/*

# Extensions PHP requises par GLPI
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
    gd \
    zip \
    intl \
    mysqli \
    pdo_mysql \
    mbstring

# Activation d’Apache
RUN a2enmod rewrite

# Dossier de travail
WORKDIR /var/www/html

# Copie du code GLPI
COPY . .

# Script d'initialisation
COPY init.sh /usr/local/bin/init.sh
RUN chmod +x /usr/local/bin/init.sh

# Création des dossiers requis par GLPI
RUN mkdir -p /var/www/html/files/{_cache,_cron,_dumps,_graphs,_lock,_pictures,_plugins,_rss,_sessions,_tmp,_uploads}

# Permissions correctes
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/files /var/www/html/config

EXPOSE 80

CMD ["/usr/local/bin/init.sh"]
