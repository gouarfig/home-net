<?php

require_once "Config.class.php";
require_once "Weather.class.php";

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

    public function save(Weather $weather) {
        if (!$this->connectionOpened()) $this->openConnection();
        $query = "INSERT INTO `weather` ";
        $query .= "(`weather_id`, `temperature`, `pressure`, `humidity`, `wind_speed`, `gust_speed`, `wind_direction`, `clouds`, `updated`) ";
        $query .= "VALUES (";
        $query .= "{$weather->weather_id}, ";
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
    }
}