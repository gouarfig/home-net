<?php

require "Config.class.php";
require "Weather.class.php";

$config = new Config();
$config->setDefaultTimezone();

$weather = new Weather($config);
$json = $weather->getWeatherJSON();
file_put_contents("weather.json", $json);
echo $json . "\n";
