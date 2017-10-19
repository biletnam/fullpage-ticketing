# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.35)
# Database: silvester
# Generation Time: 2017-10-19 14:03:54 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table carted
# ------------------------------------------------------------

DROP TABLE IF EXISTS `carted`;

CREATE TABLE `carted` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(37) NOT NULL DEFAULT '',
  `stage` int(11) unsigned NOT NULL,
  `price` int(11) unsigned NOT NULL,
  `time_carted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table orders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '',
  `surname` varchar(30) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `mobile` varchar(20) DEFAULT NULL,
  `date_placed` datetime NOT NULL,
  `price` int(11) NOT NULL,
  `admin_reviewed` tinyint(1) NOT NULL DEFAULT '0',
  `payment_type` tinyint(1) DEFAULT NULL,
  `payment_usage` varchar(11) DEFAULT NULL,
  `date_payed` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table pricing
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pricing`;

CREATE TABLE `pricing` (
  `stage` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `priority` int(11) NOT NULL,
  `name` varchar(23) NOT NULL DEFAULT '',
  `price` int(11) unsigned NOT NULL,
  `quantity` int(11) unsigned DEFAULT NULL,
  `left` int(11) unsigned DEFAULT NULL,
  `expiration` datetime DEFAULT NULL,
  PRIMARY KEY (`stage`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `pricing` WRITE;
/*!40000 ALTER TABLE `pricing` DISABLE KEYS */;

INSERT INTO `pricing` (`stage`, `priority`, `name`, `price`, `quantity`, `left`, `expiration`)
VALUES
	(2,1,'Super Early-Bird Ticket',2000,40,40,'2017-12-24 00:00:00'),
	(3,2,'Early-Bird Ticket',2500,60,60,'2017-12-24 00:00:00'),
	(4,3,'Standard Ticket',3000,NULL,NULL,'2017-12-24 00:00:00'),
	(5,4,'Last-Minute Ticket',3999,NULL,NULL,NULL);

/*!40000 ALTER TABLE `pricing` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tickets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tickets`;

CREATE TABLE `tickets` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(36) NOT NULL DEFAULT '',
  `order` int(11) unsigned NOT NULL,
  `name` varchar(11) NOT NULL DEFAULT '',
  `surname` varchar(20) NOT NULL DEFAULT '',
  `stage` int(11) unsigned NOT NULL,
  `price` int(11) unsigned NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `date_sent` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
