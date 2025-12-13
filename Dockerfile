FROM composer:2 as composer_builder

RUN apk update && apk upgrade && rm -rf /var/cache/apk/*

WORKDIR /var/www/html

COPY composer.json composer.lock ./

RUN composer install --no-dev --optimize-autoloader --no-scripts --prefer-dist


FROM php:8.3-fpm-alpine

RUN apk add --no-cache \
    postgresql-dev \
    libzip-dev \
    unzip \
    # Install postgre driver php
    && docker-php-ext-install pdo pdo_pgsql zip \
    # Bersihkan cache APK setelah instalasi
    && rm -rf /var/cache/apk/*

# Tentukan workdir di container final (harus sama dengan path mounting)
WORKDIR /var/www/html

# 1. Salin dependencies (folder vendor) yang sudah selesai dari Stage 1
COPY --from=composer_builder /var/www/html/vendor /var/www/html/vendor

# 2. Salin seluruh kode sumber PHP-mu (kecuali yang ada di .dockerignore)
COPY . /var/www/html

# Ekspos port PHP-FPM (Port INTERNAL yang akan dihubungkan oleh Nginx)
EXPOSE 9000

# Perintah utama container saat dijalankan
# FPM akan otomatis berjalan dan listening di port 9000
CMD ["php-fpm"]