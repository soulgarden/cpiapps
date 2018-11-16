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

## Copyright and License ##
Copyright (c) 2018 [Soulgarden](https://soulgarden.ru)

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.