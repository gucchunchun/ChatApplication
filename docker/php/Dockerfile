FROM php:8.2.0-fpm-buster
SHELL ["/bin/bash", "-oeux", "pipefail", "-c"]

ARG WORKDIR \
DOCKERDIR

# timezone environment
ENV LANG=ja_JP.UTF-8 \
LANGUAGE=ja_JP:ja \
LC_ALL=ja_JP.UTF-8 \
# composer environment
COMPOSER_ALLOW_SUPERUSER=1 \
COMPOSER_HOME=/composer

COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

COPY ${DOCKERDIR}/php/php-fpm.d/zzz-www.conf /usr/local/etc/php-fpm.d/zzz-www.conf
COPY ${DOCKERDIR}/php/php.ini /usr/local/etc/php/php.ini

# Update and install system dependencies
RUN apt-get update && \
apt-get -y install \
git \
libicu-dev \
libonig-dev \
libzip-dev \
unzip \
locales \
libfreetype6-dev \
libjpeg62-turbo-dev \
libpng-dev && \
apt-get clean && \
rm -rf /var/lib/apt/lists/* 

# Configure locale
RUN locale-gen ja_JP.UTF-8 && \
localedef -f UTF-8 -i ja_JP ja_JP.UTF-8

# Create directory for PHP-FPM
RUN mkdir /var/run/php-fpm

# Install PHP extensions
RUN docker-php-ext-configure intl && \
docker-php-ext-configure pdo_mysql && \
docker-php-ext-configure zip && \
docker-php-ext-configure bcmath && \
docker-php-ext-configure gd --with-freetype --with-jpeg && \
docker-php-ext-install intl pdo_mysql zip bcmath gd

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
composer config -g process-timeout 3600 && \
composer config -g repos.packagist composer https://packagist.org


RUN docker-php-ext-install pdo pdo_mysql

WORKDIR ${WORKDIR}