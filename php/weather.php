<?php

require_once "Config.class.php";
require_once "WeatherLoader.class.php";
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
    echo $json . "\n";
}
catch (Exception $e) {
    $apiResult = new ApiResult();
    $apiResult->error($e->getMessage(), $e->getCode());
    $apiResult->sendJSON();
}