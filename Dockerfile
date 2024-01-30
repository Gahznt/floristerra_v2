FROM php:8.0-apache

# Install Mysql
RUN docker-php-ext-install pdo pdo_mysql
COPY v2/ /var/www/html

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install unzip utility and libs needed by zip PHP extension 
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    unzip
RUN docker-php-ext-install zip

# Ativa rewrite engine
RUN a2enmod rewrite

RUN chmod -R ugo+rw storage