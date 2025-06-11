FROM php:8.2-apache

# Enable PostgreSQL
RUN docker-php-ext-install pdo pdo_pgsql

# Copy project files
COPY . /var/www/html/

# Optional: Enable mod_rewrite if needed
RUN a2enmod rewrite
