/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.16-MariaDB : Database - new_vasco
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`new_vasco` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `new_vasco`;

/*Table structure for table `movimientosjf_2021` */

DROP TABLE IF EXISTS `movimientosjf_2021`;

CREATE TABLE `movimientosjf_2021` (
  `tipo` varchar(5) DEFAULT NULL,
  `documento` varchar(20) DEFAULT NULL,
  `taller` varchar(5) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `articulo` varchar(20) DEFAULT NULL,
  `linea` varchar(5) DEFAULT NULL,
  `cliente` varchar(20) DEFAULT NULL,
  `vendedor` varchar(5) DEFAULT NULL,
  `cantidad` decimal(12,6) DEFAULT '0.000000',
  `precio` decimal(20,2) DEFAULT '0.00',
  `dscto1` decimal(20,2) DEFAULT '0.00',
  `dscto2` decimal(20,2) DEFAULT '0.00',
  `total` decimal(20,2) DEFAULT '0.00',
  `nombre_tipo` varchar(20) DEFAULT NULL,
  `almacen` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
