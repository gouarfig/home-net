-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 16, 2016 at 03:47 PM
-- Server version: 5.5.50
-- PHP Version: 5.4.45-0+deb7u4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `homenet`
--

-- --------------------------------------------------------

--
-- Table structure for table `weather`
--

CREATE TABLE IF NOT EXISTS `weather` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `weather_id` smallint(5) unsigned NOT NULL,
  `temperature` decimal(5,2) NOT NULL,
  `pressure` smallint(5) unsigned NOT NULL,
  `humidity` smallint(5) unsigned NOT NULL,
  `wind_speed` decimal(5,2) unsigned NOT NULL,
  `gust_speed` decimal(5,2) unsigned NOT NULL,
  `wind_direction` smallint(5) unsigned NOT NULL,
  `clouds` smallint(5) unsigned NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `recorded` (`updated`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

