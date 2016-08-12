<?php

class Weather {
    private $config = null;

    function __construct(Config $config){
        if (!isset($config) || is_null($config)) throw new Exception("Missing config object");
        $this->config = $config;
    }

    private function getRawJSON($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    private function validateWeatherData($input) {
        if ($input["id"] !== $this->config->town_id) {
            throw new Exception("Invalid JSON data (id={$input['id']})");
        }
    }

    private function validateForecastData($input) {
        if ($input["city"]["id"] !== $this->config->town_id) {
            throw new Exception("Invalid JSON data (id={$input["city"]['id']})");
        }
    }

    private function convertSingleWeatherData($input) {
        $output = array(
            "weather" => $input["weather"],
            "main" => $input["main"],
            "wind" => $input["wind"],
            "rain" => isset($input["rain"]) ? $this->precipitationFormat($input["rain"]) : null,
            "snow" => isset($input["snow"]) ? $this->precipitationFormat($input["snow"]) : null,
            "clouds" => $input["clouds"],
            "updated" => $this->addFormattedDate($this->config->full_date_format, $input["dt"]),
        );
        return $output;
    }

    private function convertWeatherData($json) {
        $input = json_decode($json, true);

        $this->validateWeatherData($input);

        $output = array_merge(
            array(
                "town_id" => $input["id"],
                "town_name" => $input["name"],
                "timezone" => date_default_timezone_get(),
                "sunrise" => $this->addFormattedDate($this->config->hour_format, $input["sys"]["sunrise"]),
                "sunset" => $this->addFormattedDate($this->config->hour_format, $input["sys"]["sunset"]),
            ),
            $this->convertSingleWeatherData($input)
        );
        return $output;
    }

    private function convertForecastData($json) {
        $input = json_decode($json, true);

        $this->validateForecastData($input);

        $output = array(
            "town_id" => $input["city"]["id"],
            "town_name" => $input["city"]["name"],
            "timezone" => date_default_timezone_get(),
        );

        foreach ($input["list"] as $item) {
            $output["list"][] = $this->convertSingleWeatherData($item);
        }
        return $output;
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

    public function getWeather() {
        $json = $this->getRawJSON($this->config->getWeatherUrl());
        $data = $this->convertWeatherData($json);
        return $data;
    }

    public function getForecast() {
        $json = $this->getRawJSON($this->config->getForecastUrl());
        $data = $this->convertForecastData($json);
        return $data;
    }
}