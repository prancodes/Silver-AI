# Use the official PHP image with Apache
FROM php:8.2-apache

# Install system deps and build mysqli, pdo_mysql, zip
RUN apt-get update && \
    apt-get install -y libzip-dev zip unzip git && \
    docker-php-ext-install zip pdo_mysql mysqli && \
    rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy app source code to the container
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install

# Set appropriate permissions
RUN chown -R www-data:www-data /var/www/html

# Expose Apache port
EXPOSE 80
