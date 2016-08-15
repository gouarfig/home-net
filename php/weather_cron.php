<?php

require "Config.class.php";
require "Weather.class.php";
require "ApiResult.class.php";

try {
    $config = new Config();
    $config->setDefaultTimezone();

    $weather = new Weather($config);
    $data = $weather->getWeather();

    $apiResult = new ApiResult();
    $apiResult->setData($data);
    $apiResult->success();
    $json = $apiResult->getJSON();

    file_put_contents("weather.json", $json);
}
catch (Exception $e) {
    file_put_contents("weather_cron.log", $e->getMessage(), FILE_APPEND);
}