#!/bin/bash

composer install

php -S 0.0.0.0:8081 -t public

#tail -f /dev/null