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
    && rm -rf /var/cache/apk/*

# Define workdir
WORKDIR /var/www/html

# 1. copy dependencies
COPY --from=composer_builder /var/www/html/vendor /var/www/html/vendor

# 2. copy source code
COPY . /var/www/html

# expose port php fpm
EXPOSE 9000

CMD ["php-fpm"]
