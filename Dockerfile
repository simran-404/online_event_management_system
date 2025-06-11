FROM php:8.2-apache

# Install dependencies (includes PostgreSQL headers)
RUN apt-get update && \
    apt-get install -y libpq-dev && \
    docker-php-ext-install pdo pdo_pgsql

# Copy your project files
COPY . /var/www/html/

# (Optional) Enable Apache mod_rewrite
RUN a2enmod rewrite
