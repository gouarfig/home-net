#!/bin/sh

set SCRIPT=`readlink -f "$0"`
set SCRIPTPATH=`dirname "$SCRIPT"`
cd $SCRIPTPATH
/usr/bin/php ./weather_cron.php
