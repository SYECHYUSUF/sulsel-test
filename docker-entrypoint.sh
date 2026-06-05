#!/bin/sh
set -e

echo "──────────────────────────────────────────"
echo " PPID Backend – Docker Entrypoint"
echo "──────────────────────────────────────────"

# 1. Generate APP_KEY jika belum ada (aman: hanya jalan jika kosong)
if [ -z "$APP_KEY" ]; then
  echo "[entrypoint] APP_KEY kosong, generate otomatis..."
  php artisan key:generate --force
else
  echo "[entrypoint] APP_KEY sudah ada, skip generate."
fi

# 2. Tunggu database siap (sudah di-handle healthcheck, tapi double-check)
echo "[entrypoint] Menunggu koneksi database..."
until php artisan migrate:status > /dev/null 2>&1; do
  echo "[entrypoint] Database belum siap, tunggu 3 detik..."
  sleep 3
done

# 3. Jalankan migrasi
echo "[entrypoint] Menjalankan migrasi database..."
php artisan migrate --force

# 4. Cache config & routes (penting untuk production)
echo "[entrypoint] Cache config, route, dan view..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 5. Storage link
echo "[entrypoint] Membuat storage link..."
php artisan storage:link || true

echo "[entrypoint] Selesai. Menjalankan server..."
echo "──────────────────────────────────────────"

# Jalankan command utama (frankenphp run ...)
exec "$@"
