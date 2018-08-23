FROM php:7.2-fpm

RUN apt-get update && apt-get install -y libssl-dev libicu-dev zip git zlib1g-dev libpq-dev librabbitmq-dev
RUN docker-php-ext-install -j$(nproc) zip json intl pdo pdo_pgsql pgsql opcache
RUN pecl install amqp && docker-php-ext-enable amqp

WORKDIR /var/www/cpiapps/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer \
    && mkdir /var/www/.composer/

ADD ./docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]