FROM php:8.3-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Enable mysqli extension (you'll need this too)
RUN docker-php-ext-install mysqli

# Copy custom PHP config
COPY php.ini /usr/local/etc/php/