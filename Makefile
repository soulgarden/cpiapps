docker_exec_php = docker-compose exec --user=www-data php
console_path = ./backend/bin/console
add_hosts = sudo ./docker/manage-etc-hosts.sh add
php_cs_fixer = ./backend/vendor/bin/php-cs-fixer
php_code_sniffer = ./backend/vendor/bin/phpcbf
php_md = ./backend/vendor/bin/phpmd

docker_up su:
	docker-compose up --build -d

docker_up_mac dum:
	docker-compose -f docker-compose.yml -f docker-compose-mac.yml up --build -d

docker_down dd:
	docker-compose down

docker_restart dr:
	docker-compose restart

docker_prepare dp: docker_composer_install docker_openresty_lua_params_prepare docker_php_setup_rmq docker_database_update_scheme docker_load_fixtures
	${docker_exec_php} ${console_path} app:redis-persis-streams

docker_openresty_lua_params_prepare:
	${docker_exec_php} cp -u ./docker/openresty/lua_parameters.conf.dist ./docker/openresty/lua_parameters.conf

docker_php_setup_rmq:
	${docker_exec_php} ${console_path} rabbitmq:setup-fabric

docker_composer_install:
	${docker_exec_php} composer install -o -d backend

docker_php_sh:
	${docker_exec_php} /bin/sh

docker_openresty_bash:
	docker-compose exec openresty /bin/sh

docker_redis_bash:
	docker-compose exec redis /bin/sh

docker_run_tests: docker_recreate_database docker_database_update_scheme docker_load_fixtures
	${docker_exec_php} ./backend/vendor/bin/behat --config ./backend/behat.yml

docker_load_fixtures:
	${docker_exec_php} ${console_path} hautelook:fixtures:load -n --purge-with-truncate

docker_recreate_database:
	${docker_exec_php} ${console_path} doctrine:database:drop --force --if-exists
	${docker_exec_php} ${console_path} doctrine:database:create --if-not-exists

docker_database_update_scheme:
	${docker_exec_php} ${console_path} doctrine:schema:update --force

docker_manage_hosts:
	sudo chmod 744 ./docker/manage-etc-hosts.sh
	${add_hosts} entry.cpiapps.local      160.10.101.3
	${add_hosts} cpiapps.local            160.10.101.3
	${add_hosts} redis.cpiapps.local      160.10.101.4
	${add_hosts} rabbitmq.cpiapps.local   160.10.101.5
	${add_hosts} mailcather.cpiapps.local 160.10.101.6
	${add_hosts} postgresql.cpiapps.local 160.10.101.7

docker_manage_hosts_mac:
	sudo chmod 744 ./docker/manage-etc-hosts.sh
	ETC_HOSTS=/private/etc/hosts
	${add_hosts} entry.cpiapps.local
	${add_hosts} cpiapps.local
	${add_hosts} redis.cpiapps.local
	${add_hosts} rabbitmq.cpiapps.local
	${add_hosts} mailcather.cpiapps.local
	${add_hosts} postgresql.cpiapps.local

#linters

run_fixers: run_cs fixer_run md_run

run_cs:
	${php_code_sniffer} --standard=PSR2 --encoding=utf-8 --ignore=vendor,var,templates ./backend -p

fixer_run:
	${php_cs_fixer} fix --config=./backend/.php_cs.php

md_run:
	${php_md} ./backend text ./backend/phpmd.xml --exclude /backend/vendor,/backend/var,/backend/templates
