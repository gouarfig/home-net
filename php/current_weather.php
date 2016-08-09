<?php

require "config.php";

date_default_timezone_set($config["timezone"]);

$url = "http://api.openweathermap.org/data/2.5/weather?id={$config['town_id']}&units={$config['units']}&APPID={$config['appid']}";

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);
$result = curl_exec($ch);
curl_close($ch);

$weather = json_decode($result, true);
if ($weather["id"] !== $config['town_id']) {
	echo "An error occured.";
	exit(1);
}
unset($weather["coord"]);
unset($weather["base"]);
unset($weather["cod"]);
$weather["dt_format"] = date("D jS M Y H:i", $weather["dt"]);
$weather["sys"]["sunrise_format"] = date("H:i", $weather["sys"]["sunrise"]);
$weather["sys"]["sunset_format"] = date("H:i", $weather["sys"]["sunset"]);
$weather["timezone"] = date_default_timezone_get();

$json = json_encode($weather);
file_put_contents("weather.json", $json);
echo $json;
