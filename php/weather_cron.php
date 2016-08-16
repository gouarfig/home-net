<?php

require_once "Config.class.php";
require_once "Weather.class.php";
require_once "WeatherLoader.class.php";
require_once "WeatherRepository.class.php";
require_once "ApiResult.class.php";

try {
    $config = new Config();
    $config->setDefaultTimezone();

    $weatherLoader = new WeatherLoader($config);
    $data = $weatherLoader->getWeather();

    $apiResult = new ApiResult();
    $apiResult->setData($data);
    $apiResult->success();
    $json = $apiResult->getJSON();

    file_put_contents("weather.json", $json);

    $weather = new Weather();
    $weather->weather_id = $data["weather"][0]["id"];
    $weather->temperature = $data["main"]["temp"];
    $weather->pressure = $data["main"]["pressure"];
    $weather->humidity = $data["main"]["humidity"];
    $weather->wind_speed = $data["wind"]["speed_kmh"];
    $weather->gust_speed = $data["wind"]["gust_kmh"];
    $weather->wind_direction = $data["wind"]["deg"];
    $weather->clouds = $data["clouds"]["all"];
    $weather->updated = new DateTime("@" . $data["updated"]["timestamp"]);
    $repository = new WeatherRepository($config);
    $repository->save($weather);
    $repository->closeConnection();
}
catch (Exception $e) {
    file_put_contents("weather_cron.log", $e->getMessage(), FILE_APPEND);
}