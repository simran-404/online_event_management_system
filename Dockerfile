FROM php:8.1-cli

# Install PostgreSQL support
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo_pgsql pgsql

# Copy files
COPY . /var/www/html
WORKDIR /var/www/html

# Start PHP server
CMD ["php", "-S", "0.0.0.0:10000", "-t", "."]
