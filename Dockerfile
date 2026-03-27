FROM php:8.3-apache AS base
WORKDIR /var/www/html
# Enable Apache mod_rewrite
RUN a2enmod rewrite
# Enable mysqli extension (you'll need this too)
RUN docker-php-ext-install mysqli
# Install system deps (for composer + GD)
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    libgd-dev \
    libjpeg-dev \
    libpng-dev \
    libwebp-dev \
    && docker-php-ext-configure gd \
        --with-jpeg \
        --with-webp \
    && docker-php-ext-install gd
# Copy custom PHP config
# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
# Copy composer files
COPY composer.json ./
RUN composer install --no-dev --no-interaction

# Entrypoint to fix volume permissions at startup - multi-stage build 

##target=dev (dev only, mounted volume, error logging on)
FROM base AS dev
COPY php.ini.dev /usr/local/etc/php/php.ini
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
ENTRYPOINT ["/entrypoint.sh"]
CMD ["apache2-foreground"]

FROM base AS prod
COPY . .
COPY php.ini /usr/local/etc/php/php.ini
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
ENTRYPOINT ["/entrypoint.sh"]
CMD ["apache2-foreground"]