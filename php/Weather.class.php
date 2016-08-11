<?php

class Weather {
    private $config = null;

    function __construct(Config $config){
        if (!isset($config) || is_null($config)) throw new Exception("Missing config object");
        $this->config = $config;
    }

    private function getRawJSON() {
        $url = $this->config->getWeatherUrl();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    private function validateData($weather) {
        if ($weather["id"] !== $this->config->town_id) {
            throw new Exception("Invalid JSON data");
        }
    }

    private function convertData($json) {
        echo $json . "\n";
        $weather = json_decode($json, true);

        $this->validateData($weather);

        $output = array(
            "weather" => $weather["weather"],
            "main" => $weather["main"],
            "wind" => $weather["wind"],
            "rain" => isset($weather["rain"]) ? $this->precipitationFormat($weather["rain"]) : null,
            "snow" => isset($weather["snow"]) ? $this->precipitationFormat($weather["snow"]) : null,
            "clouds" => $weather["clouds"],
            "updated" => $this->addFormattedDate($this->config->full_date_format, $weather["dt"]),
            "town_id" => $weather["id"],
            "town_name" => $weather["name"],
            "timezone" => date_default_timezone_get(),
            "sunrise" => $this->addFormattedDate($this->config->hour_format, $weather["sys"]["sunrise"]),
            "sunset" => $this->addFormattedDate($this->config->hour_format, $weather["sys"]["sunset"]),
        );
        $data = array(
            "data" => $output
        );
        $json = json_encode($data);
        return $json;
    }

    private function addFormattedDate($format, $timestamp) {
        $formatted = array(
            "timestamp" => $timestamp,
            "formatted" => date($format, $timestamp),
        );
        return $formatted;
    }

    private function precipitationFormat($orig) {
        $formatted = array(
            "one_hour" => isset($orig["1h"]) ? $orig["1h"] : null,
            "three_hours" => isset($orig["3h"]) ? $orig["3h"] : null,
        );
        return $formatted;
    }

    public function getJSON() {
        $json = $this->getRawJSON();
        $json = $this->convertData($json);
        return $json;
    }
}