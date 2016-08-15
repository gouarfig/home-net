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

    private function toArray($json) {
        file_put_contents("last_api_call.json", $json);
        $array = json_decode($json, true);
        return $array;
    }

    private function validateWeatherData($input) {
        if ($input["cod"] !== 200) {
            throw new Exception("HTTP error {$input['cod']}: {$input['message']}", $input["cod"]);
        }
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
            "weather" => $this->addWeatherIcons($input["weather"]),
            "main" => $input["main"],
            "wind" => $this->windConversion($input["wind"]),
            "rain" => isset($input["rain"]) ? $this->precipitationFormat($input["rain"]) : null,
            "snow" => isset($input["snow"]) ? $this->precipitationFormat($input["snow"]) : null,
            "clouds" => $input["clouds"],
            "updated" => $this->addFormattedDate($this->config->full_date_format, $input["dt"]),
        );
        return $output;
    }

    private function convertWeatherData($json) {
        $input = $this->toArray($json);

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
        $input = $this->toArray($json);

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

    private function meterPerSecondToKmPerHour($ms) {
        $kmh = round(($ms * 3600) / 1000);
        return $kmh;
    }

    private function windConversion($input) {
        $output = array(
            "speed_ms" => isset($input["speed"]) ? $input["speed"] : null,
            "speed_kmh" => isset($input["speed"]) ? $this->meterPerSecondToKmPerHour($input["speed"]) : null,
            "gust_ms" => isset($input["gust"]) ? $input["gust"] : null,
            "gust_kmh" => isset($input["gust"]) ? $this->meterPerSecondToKmPerHour($input["gust"]) : null,
            "deg" => $input["deg"],
        );
        return $output;
    }

    private function getWeatherIconFromId($id, $icon) {
        if (strpos($icon, 'd') !== false) $day_night = "day";
        else if (strpos($icon, 'n') !== false) $day_night = "night";

        switch ($id) {
            case 500:
            case 501:
                $weather_icon = "{$day_night}-rain-mix";
                break;

            case 502:
            case 503:
            case 504:
                $weather_icon = "{$day_night}-rain";
                break;

            case 520:
            case 521:
            case 522:
            case 531:
                $weather_icon = "{$day_night}-showers";
                break;

            case 800:   // clear sky
                $weather_icon = "{$day_night}-clear";
                break;
            
            case 801:   // few clouds
                $weather_icon = "{$day_night}-sunny-overcast";
                break;
            
            case 802:   // scattered clouds
                $weather_icon = "{$day_night}-cloudy";
                break;
            
            case 803:   // broken clouds
                $weather_icon = "cloudy";
                break;
            
            case 804:   // overcast clouds
                $weather_icon = "cloud";
                break;
            
            default:
                $weather_icon = "na";
                break;
        }
        return $weather_icon;
    }

    private function addWeatherIcons($array) {
        $output = array();
        foreach ($array as $input) {
            $output[] = array(
                "id" => $input["id"],
                "main" => $input["main"],
                "description" => $input["description"],
                "weather_icon" => $this->getWeatherIconFromId($input["id"], $input["icon"]),
            );
        }
        return $output;
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