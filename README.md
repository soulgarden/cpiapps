# cpiapps

[![Build Status](https://travis-ci.com/soulgarden/cpiapps.svg?branch=master)](https://travis-ci.com/soulgarden/cpiapps)

Cpiapps is a backend for CPI platform.

Used technologies and tools:

* php 7.3
* symfony 4
* lua
* postgresql 
* rabbitmq
* openresty
* redis

## Project Installation

* install docker and docker-compose [instruction](https://docs.docker.com/install/)

For mac
* make docker_manage_hosts_mac
* make docker_up_mac
* make docker_prepare

For linux
* make docker_manage_hosts
* make docker_up
* make docker_prepare


* make configure_code_sniffer

## Tests ##

To run tests, run the following commands in the console from the root of the project folder.

* make docker_run_tests

## API Reference ##
https://documenter.getpostman.com/view/5139478/RWaC2X6Y#13310474-dd94-45df-b430-f4a2056d2808