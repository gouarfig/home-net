<?php

require_once "Config.class.php";

$config = new Config();
$mysqli = new mysqli(
            $config->db_server,
            $config->db_user,
            $config->db_password,
            $config->db_name
            );
if ($mysqli->connect_errno) {
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$query = "SELECT * FROM sensors WHERE key='" . $mysqli->escape_string($_GET['key']) . "'";

$str = sha1_file(__FILE__);
echo count($str);
echo "<br />";
echo $str;

if (!isset($_GET['pi_temperature']) || !is_numeric($_GET['pi_temperature'])) $_GET['pi_temperature'] = 0;
if (!isset($_GET['sensor1_temperature']) || !is_numeric($_GET['sensor1_temperature'])) $_GET['sensor1_temperature'] = 0;
if (!isset($_GET['sensor1_humidity']) || !is_numeric($_GET['sensor1_humidity'])) $_GET['sensor1_humidity'] = 0;
if (!isset($_GET['sensor2_temperature']) || !is_numeric($_GET['sensor2_temperature'])) $_GET['sensor2_temperature'] = 0;
if (!isset($_GET['sensor2_pressure']) || !is_numeric($_GET['sensor2_pressure'])) $_GET['sensor2_pressure'] = 0;

if ($_GET['pi_temperature'] > 0) {
	if (!$mysqli->query("INSERT INTO sensor_0 (recorded, temperature) VALUES (UTC_TIMESTAMP(), {$_GET['pi_temperature']})")) {
		echo "Query failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
}

if (($_GET['sensor1_temperature'] > 0) || ($_GET['sensor1_humidity'] > 0)) {
	if (!$mysqli->query("INSERT INTO sensor_1 (recorded, temperature, relative_humidity) VALUES (UTC_TIMESTAMP(), {$_GET['sensor1_temperature']}, {$_GET['sensor1_humidity']})")) {
		echo "Query failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
}

if (($_GET['sensor2_temperature'] > 0) || ($_GET['sensor2_pressure'] > 0)) {
	if (!$mysqli->query("INSERT INTO sensor_2 (recorded, temperature, atmospheric_pressure) VALUES (UTC_TIMESTAMP(), {$_GET['sensor2_temperature']}, {$_GET['sensor2_pressure']})")) {
		echo "Query failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
}

//$sql = "INSERT INTO `sensor_0` (recorded, temperature) SELECT recorded, pi_temperature FROM `log` WHERE pi_temperature>0";
//$sql = "INSERT INTO `sensor_1` (recorded, temperature, relative_humidity) SELECT recorded, sensor_temperature, relative_humidity FROM `log` WHERE (sensor_temperature>0 OR relative_humidity>0)";
//$sql = "INSERT INTO `sensor_2` (recorded, temperature, atmospheric_pressure) SELECT recorded, sensor2_temperature, sensor2_atmospheric_pressure FROM `log` WHERE (sensor2_temperature>0 OR sensor2_atmospheric_pressure>0)";