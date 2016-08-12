<?php

require "Config.class.php";
require "Weather.class.php";
require "ApiResult.class.php";

try {
    $config = new Config();
    $config->setDefaultTimezone();

    $weather = new Weather($config);
    $data = $weather->getForecast();

    $apiResult = new ApiResult();
    $apiResult->setData($data);
    $apiResult->success();
    $json = $apiResult->getJSON();

    file_put_contents("forecast.json", $json);
    echo $json . "\n";
}
catch(Exception $e) {
    $apiResult = new ApiResult();
    $apiResult->error($e->message, $e->code);
    $apiResult->sendJSON();
}
