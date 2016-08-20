<?php

class Weather {
    public $id = 0;
    public $weather_type_id = 0;
    public $temperature = 0;
    public $pressure = 1000;
    public $humidity = 0;
    public $wind_speed = 0;
    public $gust_speed = 0;
    public $wind_direction = 0;
    public $clouds = 0;
    public $updated = null;

    public function loadFromArray($row) {
        $weather->id = $row['id'];
        $weather->weather_type_id = $row['weather_type_id'];
        $weather->temperature = $row['temperature'];
        $weather->pressure = $row['pressure'];
        $weather->humidity = $row['humidity'];
        $weather->wind_speed = $row['wind_speedid'];
        $weather->gust_speed = $row['gust_speed'];
        $weather->wind_direction = $row['wind_direction'];
        $weather->clouds = $row['clouds'];
        $weather->updated = $row['updated'];
    }
}