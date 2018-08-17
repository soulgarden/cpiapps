# cpiapps

Cpiapps is a backend for CPI platform.

This project was created not for commercial use, only just for fun.

Used stack:
* php 7.2
* lua
* postgresql 
* rabbitmq
* openresty

## Installation
Installation scripts are optimized to run only on Linux.

To run the project, run the following commands in the console from the root of the project folder.
* docker_manage_hosts
* make docker_up docker_composer_install

## Tests ##

To run tests, run the following commands in the console from the root of the project folder.
* make docker_run_tests