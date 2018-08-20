docker_up:
	docker-compose up --build -d

docker_down:
	docker-compose down

docker_composer_install:
	docker-compose exec --user=www-data php composer install -o -d backend

docker_php_bash:
	docker-compose exec --user=www-data php /bin/bash

docker_run_tests:
	docker-compose exec --user=www-data php ./backend/bin/console hautelook:fixtures:load
	docker-compose exec --user=www-data php ./backend/vendor/bin/behat --config ./backend/behat.yml

docker_openresty_bash:
	docker-compose exec openresty /bin/sh

docker_manage_hosts:
	sudo ./docker/manage-etc-hosts.sh add cpiapps.local            160.10.101.3
	sudo ./docker/manage-etc-hosts.sh add rabbitmq.cpiapps.local   160.10.101.5
	sudo ./docker/manage-etc-hosts.sh add mailcather.cpiapps.local 160.10.101.6
	sudo ./docker/manage-etc-hosts.sh add postgresql.cpiapps.local 160.10.101.7

configure_code_sniffer:
	./backend/vendor/squizlabs/php_codesniffer/scripts/phpcs --config-set encoding utf-8
	./backend/vendor/squizlabs/php_codesniffer/scripts/phpcs --config-set installed_paths "../../../vendor/endouble/symfony3-custom-coding-standard"
	./backend/vendor/squizlabs/php_codesniffer/scripts/phpcs --config-set default_standard ruleset.xml