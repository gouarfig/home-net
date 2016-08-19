<?php

require_once "Config.class.php";
require_once "Weather.class.php";
require_once "WeatherType.class.php";

class WeatherRepository {
    private $config;
    private $mysqli = null;

    function __construct(Config $config){
        if (!isset($config) || is_null($config)) throw new Exception("Missing config object");
        $this->config = $config;
    }

    public function openConnection() {
        $this->mysqli = new mysqli(
            $this->config->db_server,
            $this->config->db_user,
            $this->config->db_password,
            $this->config->db_name
            );
        if ($this->mysqli->connect_errno) {
            throw new Exception("Mysqli connect failed: " . $this->mysqli->connect_error, $this->mysqli->connect_errno);
        }
    }

    public function closeConnection() {
        $this->mysqli->close();
    }

    public function connectionOpened() {
        return $this->mysqli !== null;
    }

    public function saveWeather(Weather $weather) {
        if (!$this->connectionOpened()) $this->openConnection();
        $query = "INSERT INTO `weather` ";
        $query .= "(`weather_type_id`, `temperature`, `pressure`, `humidity`, `wind_speed`, `gust_speed`, `wind_direction`, `clouds`, `updated`) ";
        $query .= "VALUES (";
        $query .= "{$weather->weather_type_id}, ";
        $query .= "{$weather->temperature}, ";
        $query .= "{$weather->pressure}, ";
        $query .= "{$weather->humidity}, ";
        $query .= "{$weather->wind_speed}, ";
        $query .= "{$weather->gust_speed}, ";
        $query .= "{$weather->wind_direction}, ";
        $query .= "{$weather->clouds}, ";
        $query .= "'" . $weather->updated->format('Y-m-d H:i:sP') . "'";
        $query .= ")";
        $result = $this->mysqli->query($query);
        if (!$result) throw new Exception("And mysqli exception occured: " . $this->mysqli->error);
        $result->free();
    }

    public function saveWeatherType(WeatherType $weather_type) {
        if (!$this->connectionOpened()) $this->openConnection();
        if (!is_numeric($weather_type->id) || ($weather_type->id <= 0)) throw new Exception("weather_type_id is invalid");
        $result = $this->mysqli->query("SELECT FROM `weather_type` WHERE `weather_type_id`={$weather_type->id}");
        if ($result->num_rows >0) return;
        $result->free();

        $query = "INSERT INTO `weather_type` ";
        $query .= "(`weather_type_id`, `main`, `description`, `icon`) ";
        $query .= "VALUES (";
        $query .= "{$weather_type->id}, ";
        $query .= "'" . $this->mysqli->escape_string($weather_type->main) . "', ";
        $query .= "'" . $this->mysqli->escape_string($weather_type->description) . "', ";
        $query .= "'" . $this->mysqli->escape_string($weather_type->icon) . "' ";
        $query .= ")";
        $result = $this->mysqli->query($query);
        if (!$result) throw new Exception("And mysqli exception occured: " . $this->mysqli->error);
        $result->free();
    }
}