#!/bin/sh

PHP=/usr/bin/php
PHPUNIT=phpunit.phar

echo "Running in $PWD"
"$PHP" "$PHPUNIT" --verbose *Test.php
