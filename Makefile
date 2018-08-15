docker_up:
	docker-compose up --build -d

docker_down:
	docker-compose down

docker_composer_install:
	docker-compose exec --user=www-data -php composer install -o

docker_php_bash:
	docker-compose exec --user=www-data php /bin/bash

docker_openresty_bash:
	docker-compose exec openresty /bin/sh

docker_set_hosts:
	sudo ./manage-etc-hosts.sh add cpiapps.local            160.10.101.03
	sudo ./manage-etc-hosts.sh add rabbitmq.cpiapps.local   160.10.101.05
	sudo ./manage-etc-hosts.sh add mailcather.cpiapps.local 160.10.101.06
	sudo ./manage-etc-hosts.sh add postgresql.cpiapps.local 160.10.101.07

configure_code_sniffer:
	./vendor/squizlabs/php_codesniffer/scripts/phpcs --config-set encoding utf-8
	./vendor/squizlabs/php_codesniffer/scripts/phpcs --config-set installed_paths "../../../vendor/endouble/symfony3-custom-coding-standard"
	./vendor/squizlabs/php_codesniffer/scripts/phpcs --config-set default_standard ruleset.xml