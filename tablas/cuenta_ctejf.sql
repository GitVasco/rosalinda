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
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`vasco` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `vasco`;

/*Table structure for table `cuenta_ctejf` */

DROP TABLE IF EXISTS `cuenta_ctejf`;

CREATE TABLE `cuenta_ctejf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_doc` varchar(10) DEFAULT NULL,
  `num_cta` varchar(20) DEFAULT NULL,
  `cod_pago` varchar(10) DEFAULT NULL,
  `doc_origen` varchar(20) DEFAULT NULL,
  `fecha` varchar(12) DEFAULT NULL,
  `fecha_ven` varchar(12) DEFAULT NULL,
  `monto` double(11,2) DEFAULT NULL,
  `saldo` double(11,2) DEFAULT NULL,
  `tip_cambio` varchar(12) DEFAULT NULL,
  `ult_pago` varchar(12) DEFAULT NULL,
  `cliente` varchar(15) DEFAULT NULL,
  `vendedor` varchar(10) DEFAULT NULL,
  `notas` varchar(100) DEFAULT NULL,
  `fecha_cep` varchar(12) DEFAULT NULL,
  `banco` varchar(10) DEFAULT NULL,
  `num_unico` varchar(12) DEFAULT NULL,
  `renovacion` tinyint(4) DEFAULT NULL,
  `protesta` tinyint(4) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `tip_mon` varchar(12) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `estado_doc` varchar(12) DEFAULT NULL,
  `fecha_envio` varchar(12) DEFAULT NULL,
  `fecha_abono` varchar(12) DEFAULT NULL,
  `tip_mov` varchar(1) DEFAULT '+',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
