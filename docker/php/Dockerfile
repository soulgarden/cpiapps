FROM php:7.3.6-fpm-alpine

RUN apk update && \
    apk add --update --no-cache $PHPIZE_DEPS \
                                libcurl curl-dev curl \
                                libmcrypt-dev libpcre32 bzip2 libbz2 bzip2-dev libzip-dev icu-dev \
                                postgresql-dev postgresql-client libpng libpng-dev rabbitmq-c-dev

RUN docker-php-ext-install -j$(nproc) zip mbstring intl pgsql pdo pdo_pgsql json opcache iconv curl gd bcmath
RUN pecl install && pecl install apcu amqp
RUN docker-php-ext-enable apcu amqp

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer && \
    mkdir -p /home/www-data/.composer/vendor /home/www-data/.composer/cache && \
    chown www-data:www-data -R /home/www-data/.composer

COPY composer.json /home/www-data/.composer/composer.json
COPY composer.lock /home/www-data/.composer/composer.lock

WORKDIR /var/www/cpiapps/

USER www-data:www-data

RUN composer global install -o