<?php

require_once "Config.class.php";

if (!isset($_GET['key']) || !is_string($_GET['key'])) {
    exit("Incorrect parameters");
}

$config = new Config();
$mysqli = new mysqli(
            $config->db_server,
            $config->db_user,
            $config->db_password,
            $config->db_name
            );
if ($mysqli->connect_errno) {
	exit("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}

$fields = array();

$query = "SELECT * FROM `sensors` WHERE `key`='" . $mysqli->escape_string($_GET['key']) . "' LIMIT 1";
$sensors = $mysqli->query($query);
if (!$sensors) {
    exit("Query failed: (" . $mysqli->errno . ") " . $mysqli->error);
}
if ($sensors->num_rows == 0) {
    exit("Invalid key");
}
$definition = $sensors->fetch_assoc();
$table_name = $definition['name'];
foreach ($definition as $key => $value) {
    if ((strpos($key, "def_") === 0) && is_string($value)) {
        $fields[substr($key, 4)] = $value;
    }
}
$sensors->free();
unset($query);
unset($sensors);

$record= array();
foreach ($fields as $key => $value) {
    if (isset($_GET[$key]) && is_numeric($_GET[$key])) {
        $record[$value] = $_GET[$key];
    }
}
if (count($record) == 0) {
    exit("Invalid parameters");
}

$query = "INSERT INTO `{$table_name}` (recorded, ";
$query .= implode(", ", array_keys($record));
$query .= ") VALUES (UTC_TIMESTAMP(), ";
$query .= implode(", ", array_values($record));
$query .= ")";


if (!$mysqli->query($query)) {
    exit("Query failed: (" . $mysqli->errno . ") " . $mysqli->error);
}
