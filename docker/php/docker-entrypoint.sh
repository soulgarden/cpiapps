#!/usr/bin/env bash

set -e

CUSER="www-data"
MYUID=`stat -c "%u" .`

chown -R www-data: /var/www/.composer/

if [[ "$MYUID" -gt '0' && "$MYUID" != `id -u ${CUSER}` ]]; then
    usermod -u ${MYUID} ${CUSER}
fi

/usr/local/sbin/php-fpm