FROM php:8.2-fpm

RUN apt-get update

RUN apt-get install -y curl zip
RUN apt install -q -y libpq-dev
RUN docker-php-ext-install pdo_pgsql pgsql

# composer is not needed for running the app
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# RUN usermod -u 1000 www-data && groupmod -g 1000 www-data
# USER "1000:1000"
WORKDIR /var/www