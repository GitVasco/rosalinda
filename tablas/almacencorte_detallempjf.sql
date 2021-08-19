/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.38-MariaDB : Database - new_vasco
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

/*Table structure for table `almacencorte_detalle_mpjf` */

DROP TABLE IF EXISTS `almacencorte_detalle_mpjf`;

CREATE TABLE `almacencorte_detalle_mpjf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `almacencorte` int(11) DEFAULT NULL,
  `mat_pri` varchar(20) DEFAULT NULL,
  `cons_total` decimal(11,4) DEFAULT NULL,
  `cons_real` decimal(11,4) DEFAULT NULL,
  `diferencia` decimal(11,4) DEFAULT NULL,
  `can_entregada` decimal(11,4) DEFAULT NULL,
  `merma` decimal(11,4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `almacencorte_detalle_mpjf` */

insert  into `almacencorte_detalle_mpjf`(`id`,`almacencorte`,`mat_pri`,`cons_total`,`cons_real`,`diferencia`,`can_entregada`,`merma`) values (1,12,'01517',3.4650,11.0000,7.5350,18.0000,7.0000),(2,12,'01519',3.4650,11.0000,7.5350,14.0000,3.0000),(3,12,'01520',3.4650,11.0000,7.5350,17.0000,6.0000),(4,12,'01531',1.1550,11.0000,9.8450,15.0000,4.0000);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
