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
    $repository = new WeatherRepository($config);
    $repository->save($weather);
    $repository->close();
}
catch (Exception $e) {
    file_put_contents("weather_cron.log", $e->getMessage(), FILE_APPEND);
}