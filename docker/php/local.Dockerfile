FROM php:8.3.0-fpm

ARG PROJECT_DIR=/var/www/html
ARG PHP_INI=/usr/local/etc/php/php.ini

ARG PUID=1000
ENV PUID ${PUID}
ARG PGID=1000
ENV PGID ${PGID}

WORKDIR $PROJECT_DIR

RUN apt-get update && apt-get install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

RUN pecl install xdebug-3.3.1
RUN docker-php-ext-enable xdebug

# Configure non-root user.
RUN groupmod -o -g ${PGID} www-data
RUN usermod -o -u ${PUID} -g www-data www-data

WORKDIR /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

USER www-data

COPY ./ /var/www/html
COPY ./docker/php/config/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

RUN PATH=$PATH:/var/www/html/vendor/bin:bin
