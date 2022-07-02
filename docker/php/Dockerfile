FROM php:7.4.1-fpm

#Copy php.ini
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini

# Composer install
COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

# install Node.js
COPY --from=node:12.14 /usr/local/bin /usr/local/bin
COPY --from=node:12.14 usr/local/lib /usr/local/lib

RUN apt-get update && \
    apt-get -y install \
    git \
    zip \
    unzip \
    vim \
    && docker-php-ext-install pdo_mysql bcmath

WORKDIR /var/www/html
