#!/bin/sh

PHP=/usr/bin/php

echo "Running in $PWD"
curl https://phar.phpunit.de/phpunit-4.8.27.phar -o phpunit.phar
"$PHP" --version
"$PHP" phpunit.phar --self-update
"$PHP" phpunit.phar --version
