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
    public $timestamp = 0;

    public function loadFromArray($row) {
        $this->id = $row['id'];
        $this->weather_type_id = $row['weather_type_id'];
        $this->temperature = $row['temperature'];
        $this->pressure = $row['pressure'];
        $this->humidity = $row['humidity'];
        $this->wind_speed = $row['wind_speed'];
        $this->gust_speed = $row['gust_speed'];
        $this->wind_direction = $row['wind_direction'];
        $this->clouds = $row['clouds'];
        $this->updated = $row['updated'];
        $this->timestamp = strtotime($row['updated']);
    }
}