docker_up:
	docker-compose up --build -d

docker_down:
	docker-compose down

docker_restart:
	docker-compose restart

docker_prepare: docker_composer_install docker_openresty_lua_params_prepare docker_php_setup_rmq
	docker-compose exec --user=www-data php ./backend/bin/console doctrine:schema:update --force
	docker-compose exec --user=www-data php ./backend/bin/console hautelook:fixtures:load -n

docker_openresty_lua_params_prepare:
	cp -n ./docker/openresty/lua_parameters.conf.dist ./docker/openresty/lua_parameters.conf

docker_php_setup_rmq:
	docker-compose exec --user=www-data php ./backend/bin/console rabbitmq:setup-fabric

docker_composer_install:
	docker-compose exec --user=www-data php composer install -o -d backend

docker_php_bash:
	docker-compose exec --user=www-data php /bin/bash

docker_openresty_bash:
	docker-compose exec openresty /bin/sh

docker_redis_bash:
	docker-compose exec redis /bin/sh

docker_run_tests:
	docker-compose exec --user=www-data php ./backend/bin/console hautelook:fixtures:load
	docker-compose exec --user=www-data php ./backend/vendor/bin/behat --config ./backend/behat.yml

docker_manage_hosts:
	sudo ./docker/manage-etc-hosts.sh add cpiapps.local            160.10.101.3
	sudo ./docker/manage-etc-hosts.sh add redis.cpiapps.local      160.10.101.4
	sudo ./docker/manage-etc-hosts.sh add rabbitmq.cpiapps.local   160.10.101.5
	sudo ./docker/manage-etc-hosts.sh add mailcather.cpiapps.local 160.10.101.6
	sudo ./docker/manage-etc-hosts.sh add postgresql.cpiapps.local 160.10.101.7

configure_code_sniffer:
	./backend/vendor/squizlabs/php_codesniffer/scripts/phpcs --config-set encoding utf-8
	./backend/vendor/squizlabs/php_codesniffer/scripts/phpcs --config-set installed_paths "../../../vendor/endouble/symfony3-custom-coding-standard"
	./backend/vendor/squizlabs/php_codesniffer/scripts/phpcs --config-set default_standard ruleset.xml