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

## Tools

Configure linters described below and run command `make run_fixers` to call them all

### PHP Code Sniffer

1. Configure Code sniffer in phpstorm, specify bin path [Instruction](https://confluence.jetbrains.com/display/PhpStorm/PHP+Code+Sniffer+in+PhpStorm#PHPCodeSnifferinPhpStorm-1.1.SpecifyingthepathtoPHPCodeSniffer)
2. Configure Code sniffer in phpstorm inspections, coding standard - PSR2 [Instruction](https://confluence.jetbrains.com/display/PhpStorm/PHP+Code+Sniffer+in+PhpStorm#PHPCodeSnifferinPhpStorm-1.2.ConfigurePHPCodeSnifferasaPhpStorminspection)

Usage:

* `make run_cs`

### PHP CS Fixer
1. Configure PHP CS Fixer, specify bin path [Instruction](https://blog.jetbrains.com/phpstorm/2018/11/php-cs-fixer-support/)
2. Configure PHP CS Fixer in phpstorm inspections, ruleset - PSR2 [Instruction](https://blog.jetbrains.com/phpstorm/2018/11/php-cs-fixer-support/)

Usage:

* Check code style `make fixer_check`
* Fix code style `make fixer_run`

### PHP mess detector
1. Configure Mess detector in phpstorm, specify bin path [Instruction](https://confluence.jetbrains.com/display/PhpStorm/PHP+Mess+Detector+in+PhpStorm#PHPMessDetectorinPhpStorm-1.EnablePHPMessDetectorintegrationinPhpStorm)
2. Configure Mess detector inspections in phpstorm [Instruction](https://confluence.jetbrains.com/display/PhpStorm/PHP+Mess+Detector+in+PhpStorm#PHPMessDetectorinPhpStorm-1.2.ConfigurePHPMessDetectorasaPhpStorminspection)

Usage:

* `make md_run`