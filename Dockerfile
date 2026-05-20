# Get Composer binary
FROM docker.io/composer:latest AS composer_bin

# Build stage
FROM docker.io/dunglas/frankenphp:1.4-php8.4-alpine AS build

# Install PHP extension installer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

# Install system dependencies & PHP extensions
RUN apk add --no-cache git unzip \
    && install-php-extensions pdo_pgsql pgsql zip intl gd opcache

# Set working directory
WORKDIR /app

# Install Composer
COPY --from=composer_bin /usr/bin/composer /usr/bin/composer

# Copy composer files
COPY composer.json composer.lock ./

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy application code
COPY . .

# Run post-install scripts
RUN composer run-script post-autoload-dump

# Final stage
FROM docker.io/dunglas/frankenphp:1.4-php8.4-alpine

# Install PHP extension installer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

# Install PHP extensions (installer handles runtime deps automatically)
RUN install-php-extensions pdo_pgsql pgsql zip intl gd opcache

# Set working directory
WORKDIR /app

# Copy from build stage
COPY --from=build /app /app

# Configure FrankenPHP
ENV FRANKENPHP_CONFIG="worker ./public/frankenphp-worker.php"
ENV APP_ENV=production
ENV APP_DEBUG=false

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 8000

CMD ["frankenphp", "php-server", "--listen", ":8000"]
