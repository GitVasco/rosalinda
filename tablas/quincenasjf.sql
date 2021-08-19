/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.16-MariaDB : Database - vasco
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, vasco=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`new_vasco` /*!40100 DEFAULT CHARACTER SET latin1 */;
vasco
USE `new_vasco`;

/*Table structure for table `quincenasjf` */

DROP TABLE IF EXISTS `quincenasjf`;

CREATE TABLE `quincenasjf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ano` int(11) DEFAULT NULL,
  `mes` int(11) DEFAULT NULL,
  `quincena` int(11) DEFAULT NULL,
  `inicio` date DEFAULT NULL,
  `fin` date DEFAULT NULL,
  `usuario` int(11) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `quincenasjf` */

insert  into `quincenasjf`(`id`,`ano`,`mes`,`quincena`,`inicio`,`fin`,`usuario`,`fecha_creacion`) values (1,2020,9,1,'2020-08-31','2020-09-14',6,'2020-09-11 10:42:00'),(2,2020,9,2,'2020-09-15','2020-09-29',6,'2020-09-11 10:42:45'),(3,2020,8,1,'2020-07-31','2020-08-14',6,'2020-09-11 11:48:58'),(4,2020,8,2,'2020-08-15','2020-09-30',6,'2020-09-11 11:53:43'),(5,2020,7,1,'2020-06-30','2020-09-14',6,'2020-09-11 11:54:34');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
