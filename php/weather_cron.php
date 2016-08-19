<?php

set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__);
require_once "Config.class.php";
require_once "Weather.class.php";
require_once "WeatherType.class.php";
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

    file_put_contents(__DIR__ . "/weather.json", $json);

    $weather = new Weather();
    $weather->weather_type_id = $data["weather"][0]["id"];
    $weather->temperature = $data["main"]["temp"];
    $weather->pressure = $data["main"]["pressure"];
    $weather->humidity = $data["main"]["humidity"];
    $weather->wind_speed = $data["wind"]["speed_kmh"];
    $weather->gust_speed = $data["wind"]["gust_kmh"];
    $weather->wind_direction = $data["wind"]["deg"];
    $weather->clouds = $data["clouds"]["all"];
    $weather->updated = new DateTime("@" . $data["updated"]["timestamp"]);

    $weather_type = new WeatherType();
    $weather_type->id = $data["weather"][0]["id"];
    $weather_type->main = $data["weather"][0]["main"];
    $weather_type->description = $data["weather"][0]["description"];
    $weather_type->icon = $data["weather"][0]["weather_icon"];

    $repository = new WeatherRepository($config);
    $repository->saveWeatherType($weather_type);
    $repository->saveWeather($weather);
    $repository->closeConnection();
}
catch (Exception $e) {
    $message = date("r") . " - " . $e->getMessage() . "\n";
    file_put_contents(__DIR__ . "/weather_cron.log", $message, FILE_APPEND);
}