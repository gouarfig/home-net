<?php

require "Config.class.php";
require "Weather.class.php";

$config = new Config();
$config->setDefaultTimezone();

$weather = new Weather($config);
$json = $weather->getForecastJSON();
file_put_contents("forecast.json", $json);
echo $json . "\n";
