FROM php:7.4-apache

ENV COMPOSER_ALLOW_SUPERUSER=1

# EXPOSE 80
WORKDIR /var/www/html/app

RUN apt-get update -qq && \
    apt-get install -qy \
    git \
    gnupg \
    unzip \
    zip && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# PHP Extensions
RUN docker-php-ext-install -j$(nproc) opcache pdo_mysql

COPY docker/php/php.ini /usr/local/etc/php/conf.d/app.ini
COPY . /var/www/html/app

CMD php bin/console server:run 0.0.0.0:8000
