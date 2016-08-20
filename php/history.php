<?php

require_once "Config.class.php";
require_once "WeatherRepository.class.php";
require_once "ApiResult.class.php";

try {
    $config = new Config();
    $config->setDefaultTimezone();

    $repository = new WeatherRepository($config);
    $minus24hours = new DateTime("@" . (time() - 86400));
    $data = $repository->getWeather($minus24hours);

    $apiResult = new ApiResult();
    $apiResult->setData($data);
    $apiResult->success();
    $json = $apiResult->getJSON();

    file_put_contents("24h.json", $json);
    echo $json . "\n";
}
catch(Exception $e) {
    $apiResult = new ApiResult();
    $apiResult->error($e->message, $e->code);
    $apiResult->sendJSON();
}
