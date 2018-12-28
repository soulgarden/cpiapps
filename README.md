# cpiapps

[![Build Status](https://travis-ci.com/soulgarden/cpiapps.svg?branch=master)](https://travis-ci.com/soulgarden/cpiapps)

Cpiapps is a backend for CPI platform.

Used technologies and tools:

* php 7.2
* symfony 4
* lua
* postgresql 
* rabbitmq
* openresty
* redis

## Installation

* install docker and docker-compose
* make docker_manage_hosts       # linux
* make docker_manage_hosts_mac   # mac
* make docker_up                 # linux
* make docker_up_mac             # mac 
* make docker_prepare


* make configure_code_sniffer

## Tests ##

To run tests, run the following commands in the console from the root of the project folder.

* make docker_run_tests

## API Reference ##
https://documenter.getpostman.com/view/5139478/RWaC2X6Y#13310474-dd94-45df-b430-f4a2056d2808