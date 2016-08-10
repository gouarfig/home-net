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
        $weather = json_decode($json, true);

        $this->validateData($weather);

        $weather["dt"] = $this->addFormattedDate($this->config->full_date_format, $weather["dt"]);
        $weather["sunrise"] = $this->addFormattedDate($this->config->hour_format, $weather["sys"]["sunrise"]);
        $weather["sunset"] = $this->addFormattedDate($this->config->hour_format, $weather["sys"]["sunset"]);
        $weather["timezone"] = date_default_timezone_get();
        if (isset($weather["rain"])) {
            $weather["rain"] = $this->precipitationFormat($weather["rain"]);
        }
        if (isset($weather["snow"])) {
            $weather["snow"] = $this->precipitationFormat($weather["snow"]);
        }

        unset($weather["coord"]);
        unset($weather["base"]);
        unset($weather["cod"]);
        unset($weather["sys"]);

        $json = json_encode($weather);
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
            "three_hours" => $orig["3h"]
        );
        return $formatted;
    }

    public function getJSON() {
        $json = $this->getRawJSON();
        $json = $this->convertData($json);
        return $json;
    }
}