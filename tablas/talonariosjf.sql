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

/*Table structure for table `talonariosjf` */

DROP TABLE IF EXISTS `talonariosjf`;

CREATE TABLE `talonariosjf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pedido` int(11) DEFAULT NULL,
  `serie_factura` varchar(4) DEFAULT NULL,
  `facturas` int(11) DEFAULT NULL,
  `serie_boletas` varchar(4) DEFAULT NULL,
  `boletas` int(8) DEFAULT NULL,
  `serie_proformas` varchar(4) DEFAULT NULL,
  `proformas` int(8) DEFAULT NULL,
  `serie_guias` varchar(4) DEFAULT NULL,
  `guias_remision` int(8) DEFAULT NULL,
  `serie_nc` varchar(4) DEFAULT NULL,
  `nota_credito` int(8) DEFAULT NULL,
  `serie_nd` varchar(4) DEFAULT NULL,
  `nota_debito` int(8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `talonariosjf` */

insert  into `talonariosjf`(`id`,`pedido`,`serie_factura`,`facturas`,`serie_boletas`,`boletas`,`serie_proformas`,`proformas`,`serie_guias`,`guias_remision`,`serie_nc`,`nota_credito`,`serie_nd`,`nota_debito`) values (1,2020055,'F001',5114,'B001',1,'006',1,'003',1,'B001',1,'B001',1),(2,NULL,'F002',1,'B002',1,'003',1,'006',1,'B002',1,'B002',1),(3,NULL,'003',1,NULL,NULL,NULL,NULL,NULL,NULL,'F001',1,'F001',1),(4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'F002',1,'F002',1),(5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'003',1,'003',1),(6,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'006',1,'006',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
