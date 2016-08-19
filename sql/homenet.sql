SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE IF NOT EXISTS `weather` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `weather_type_id` smallint(5) unsigned NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `weather_type` (
  `weather_type_id` smallint(5) unsigned NOT NULL,
  `main` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `icon` varchar(20) NOT NULL,
  PRIMARY KEY (`weather_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
