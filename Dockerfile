FROM php:8.1-apache

# Install system dependencies
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

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    gd \
    zip \
    intl \
    mysqli \
    pdo_mysql \
    mbstring

# Set working directory
WORKDIR /var/www/html

# Copy application code
COPY . .

# Copy and set permissions for init script
COPY init.sh /usr/local/bin/init.sh
RUN chmod +x /usr/local/bin/init.sh

# Install GLPI dependencies using its own system
RUN if [ -f "bin/console" ]; then \
        php bin/console dependencies install --no-interaction || true; \
    fi

# Create GLPI required directories
RUN mkdir -p /var/www/html/files/_cache \
    && mkdir -p /var/www/html/files/_cron \
    && mkdir -p /var/www/html/files/_dumps \
    && mkdir -p /var/www/html/files/_graphs \
    && mkdir -p /var/www/html/files/_lock \
    && mkdir -p /var/www/html/files/_pictures \
    && mkdir -p /var/www/html/files/_plugins \
    && mkdir -p /var/www/html/files/_rss \
    && mkdir -p /var/www/html/files/_sessions \
    && mkdir -p /var/www/html/files/_tmp \
    && mkdir -p /var/www/html/files/_uploads

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 777 /var/www/html/files \
    && chmod -R 777 /var/www/html/config

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80

# Start with init script
CMD ["/usr/local/bin/init.sh"]