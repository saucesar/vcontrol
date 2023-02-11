FROM php:8.1-apache

ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN apt update && apt install git zip unzip libzip-dev libpq-dev libpng-dev -y

RUN pecl install --force redis

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql

RUN docker-php-ext-install zip gd pdo pdo_pgsql

RUN docker-php-ext-enable redis gd

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

RUN a2enmod rewrite

WORKDIR /var/www/html/

COPY docker/site.conf /etc/apache2/sites-available/000-default.conf

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
