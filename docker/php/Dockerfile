FROM php:7.2-fpm

RUN apt-get update && apt-get install -y zip git

WORKDIR /var/www/cpiapps/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer \
    && mkdir /var/www/.composer/

ADD ./docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]