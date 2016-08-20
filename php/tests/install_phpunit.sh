#!/bin/sh

PHPUNIT_URL=https://phar.phpunit.de/phpunit-4.8.27.phar
PHP=/usr/bin/php
PHPUNIT=phpunit.phar

echo "Running in $PWD"
curl "$PHPUNIT_URL" -o "$PHPUNIT"
"$PHP" --version
"$PHP" "$PHPUNIT" --self-update
"$PHP" "$PHPUNIT" --version

