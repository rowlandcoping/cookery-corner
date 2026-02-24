FROM php:8.3-apache

WORKDIR /var/www/html

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Enable mysqli extension (you'll need this too)
RUN docker-php-ext-install mysqli

# stuff to run composer
RUN apt-get update && apt-get install -y unzip git

# Copy custom PHP config
COPY php.ini /usr/local/etc/php/

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy composer files
COPY composer.json ./
RUN composer install --no-dev --no-interaction