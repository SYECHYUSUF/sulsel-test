# ─────────────────────────────────────────────
# Stage 1: Get Composer binary
# ─────────────────────────────────────────────
FROM composer:latest AS composer_bin

# ─────────────────────────────────────────────
# Stage 2: Build (install deps)
# ─────────────────────────────────────────────
FROM dunglas/frankenphp:1.4-php8.4-alpine AS build

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN apk add --no-cache git unzip \
    && install-php-extensions pdo_pgsql pgsql zip intl gd opcache

WORKDIR /app

COPY --from=composer_bin /usr/bin/composer /usr/bin/composer

# Copy composer manifest dulu (layer cache lebih efisien)
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

COPY . .

RUN composer run-script post-autoload-dump

# ─────────────────────────────────────────────
# Stage 3: Final image
# ─────────────────────────────────────────────
FROM dunglas/frankenphp:1.4-php8.4-alpine

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN install-php-extensions pdo_pgsql pgsql zip intl gd opcache

WORKDIR /app

COPY --from=build /app /app
COPY Caddyfile /etc/caddy/Caddyfile

# ── Baked-in defaults (TIDAK sensitif) ──────────────────────────────────────
# Nilai ini akan di-OVERRIDE oleh environment dari docker-compose / .env
ENV APP_ENV=production \
    APP_DEBUG=false \
    FRANKENPHP_CONFIG="worker ./public/frankenphp-worker.php"

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 8000

# ── Entrypoint: jalankan migrasi + cache sebelum server start ────────────────
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["frankenphp", "run", "--config", "/etc/caddy/Caddyfile"]
