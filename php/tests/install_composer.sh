#!/bin/sh

PHP=/usr/bin/php

echo "Running in $PWD"

php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
mkdir ./bin
php composer-setup.php --install-dir=bin --filename=composer
php -r "unlink('composer-setup.php');"
