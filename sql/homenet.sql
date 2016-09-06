-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 06, 2016 at 09:19 PM
-- Server version: 5.5.50
-- PHP Version: 5.4.45-0+deb7u4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `homenet`
--

-- --------------------------------------------------------

--
-- Table structure for table `envirophat`
--

CREATE TABLE IF NOT EXISTS `envirophat` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `recorded` datetime NOT NULL,
  `pi_temperature` decimal(5,2) DEFAULT NULL,
  `sensor_temperature` decimal(5,2) DEFAULT NULL,
  `sensor_pressure` decimal(6,2) unsigned DEFAULT NULL,
  `sensor_light` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prototype1`
--

CREATE TABLE IF NOT EXISTS `prototype1` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `recorded` datetime NOT NULL,
  `pi_temperature` decimal(5,2) DEFAULT NULL,
  `sensor_temperature1` decimal(5,2) DEFAULT NULL,
  `sensor_humidity` decimal(5,2) DEFAULT NULL,
  `sensor_temperature2` decimal(5,2) DEFAULT NULL,
  `sensor_pressure` decimal(6,2) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sensors`
--

CREATE TABLE IF NOT EXISTS `sensors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(40) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `def_pi_temperature` varchar(30) DEFAULT NULL,
  `pi_temperature_factor` smallint(6) NOT NULL DEFAULT '0',
  `def_sensor_temperature1` varchar(30) DEFAULT NULL,
  `sensor_temperature1_factor` smallint(6) NOT NULL DEFAULT '0',
  `def_sensor_humidity` varchar(30) DEFAULT NULL,
  `sensor_humidity_factor` smallint(6) NOT NULL DEFAULT '0',
  `def_sensor_temperature2` varchar(30) DEFAULT NULL,
  `sensor_temperature2_factor` smallint(6) NOT NULL DEFAULT '0',
  `def_sensor_pressure` varchar(30) DEFAULT NULL,
  `sensor_pressure_factor` smallint(6) NOT NULL DEFAULT '0',
  `def_sensor_light` varchar(30) DEFAULT NULL,
  `sensor_light_factor` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `weather`
--

CREATE TABLE IF NOT EXISTS `weather` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `weather_type_id` smallint(5) unsigned NOT NULL,
  `temperature` decimal(5,2) NOT NULL,
  `pressure` smallint(5) unsigned NOT NULL,
  `humidity` smallint(5) unsigned NOT NULL,
  `wind_speed` decimal(5,2) unsigned NOT NULL,
  `gust_speed` decimal(5,2) unsigned DEFAULT NULL,
  `wind_direction` smallint(5) unsigned NOT NULL,
  `clouds` smallint(5) unsigned NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `recorded` (`updated`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `weather_type`
--

CREATE TABLE IF NOT EXISTS `weather_type` (
  `weather_type_id` smallint(5) unsigned NOT NULL,
  `main` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `icon` varchar(20) NOT NULL,
  PRIMARY KEY (`weather_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
