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

/*Table structure for table `condiciones_ventajf` */

DROP TABLE IF EXISTS `condiciones_ventajf`;

CREATE TABLE `condiciones_ventajf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) DEFAULT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `cta_cte` varchar(5) DEFAULT NULL,
  `dias` int(11) DEFAULT NULL,
  `letras` varchar(5) DEFAULT NULL,
  `dscto` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;

/*Data for the table `condiciones_ventajf` */

insert  into `condiciones_ventajf`(`id`,`codigo`,`descripcion`,`cta_cte`,`dias`,`letras`,`dscto`) values (1,'01','CONTADO','Si',NULL,'No',NULL),(2,'02','CONTRA ENTREGA','Si',NULL,'No',NULL),(3,'03','PAGO 7 DIAS','Si',7,'No',NULL),(4,'04','PAGO 15 DIAS','Si',15,'No',NULL),(5,'05','PAGO DE 30 DIAS','Si',30,'No',NULL),(6,'06','PAGO DE 45 DIAS ','Si',45,'No',NULL),(7,'07','PAGO DE 60 DIAS ','Si',60,'No',NULL),(8,'08','FACTURA 07 DIAS','Si',7,'No',NULL),(9,'09','FACTURA 15 DIAS','Si',15,'No',NULL),(10,'10','FACTURA 30 DIAS','Si',30,'No',NULL),(11,'11','FACTURA 45 DIAS','Si',45,'No',NULL),(12,'12','FACTURA 60 DIAS','Si',60,'Si',NULL),(13,'13','LETRA 30 DIAS','Si',30,'Si',NULL),(14,'14','LETRAS 30/35/40','Si',45,'Si',NULL),(15,'15','LETRAS 30/35/40/45/50','Si',30,'Si',NULL),(16,'16','LETRAS 30/35/40/45/50/55','Si',30,'Si',NULL),(17,'17','LETRAS 30/35/40/45/50/55/60/65/70/','Si',30,'Si',NULL),(18,'18','LETRAS 30/36/42','Si',30,'Si',NULL),(19,'19','L.30/36//42/48/54/60/66/72/78','Si',30,'Si',NULL),(20,'20','LETRAS 30/37','Si',30,'Si',NULL),(21,'21','LETRAS 30/37/44','Si',30,'Si',NULL),(22,'22','LET. 30/37/44/51/58','Si',30,'Si',NULL),(23,'23','LETR. 30/37/44/51/58/65','Si',30,'Si',NULL),(24,'24','LET.30/37/44/51/58/65/72','Si',30,'Si',NULL),(25,'25','L. 30/37/44/51/58/65/72/79','Si',30,'Si',NULL),(26,'26','L. 30/37/44/51/58/65/72/79/86','Si',30,'Si',NULL),(27,'27','LETRAS 30/40/50','Si',30,'Si',NULL),(28,'28','LETRAS 30/40/50/60','Si',30,'Si',NULL),(29,'29','LETRAS 30/40/50/60/70','Si',40,'Si',NULL),(30,'30','LETRAS 30/40/50/60/70/80','Si',30,'Si',NULL),(31,'31','LETRAS 30/40/50/60/70/80/90','Si',30,'Si',NULL),(32,'32','LETRAS 30/38/46','Si',30,'Si',NULL),(33,'33','L. 30/38/46/54/62','Si',30,'Si',NULL),(34,'34','L. 30/38/46/54/62/70/78/86/94','Si',30,'Si',NULL),(35,'35','LETRAS 30/36/42/48/54/60/66','Si',30,'Si',NULL),(36,'36','LETRA.36/42/48','Si',30,'Si',NULL),(37,'37','letras 40-50','Si',36,'Si',NULL),(38,'41','LETRAS 30/45/60','Si',40,'Si',NULL),(39,'42','LETRAS 30/45/60','Si',30,'Si',NULL),(40,'43','LETRA 45 DIAS','Si',30,'Si',NULL),(41,'44','LETRA 60 DIAS','Si',45,'Si',NULL),(42,'45','LETRAS 37/47/57/67','Si',60,'Si',NULL),(43,'46','LETRAS 30/37/44/51','Si',37,'Si',NULL),(44,'47','LETRA 30-45-50-55-60-65-70','Si',30,'Si',NULL),(45,'48','LETRA 30-40-50-60-70','Si',30,'Si',NULL),(46,'49','LETRA 35-45-55','Si',30,'Si',NULL),(47,'50','LT. 30-42-54','Si',30,'Si',NULL),(48,'51','LETRA 75-80 DIAS','Si',75,'Si',NULL),(49,'52','LETRA 40/50/60/70/80/90 DIAS','Si',61,'Si',NULL),(50,'53','LETRA 51-58-65','Si',51,'Si',NULL),(51,'54','LETRA 65/75/79/86','Si',65,'Si',NULL),(52,'55','LETRA 30/38/46/54/62/70/78/86','Si',30,'Si',NULL),(53,'56','LETRAS 30/45','Si',30,'Si',NULL),(54,'57','LETRA 30/38/46/54','Si',30,'Si',NULL),(55,'58','LETRA 40/50/60/70','Si',40,'Si',NULL),(56,'59','LETRA 50 DIAS ','Si',50,'Si',NULL),(57,'60','LETRAS 37/44/51/58/65/72','Si',37,'Si',NULL),(58,'61','LETRAS 30/60 DIAS','Si',30,'Si',NULL),(59,'62','LETRAS 30/45 DIAS','Si',30,'Si',NULL),(60,'63','LETRAS 30/45/55/65/75','Si',30,'Si',NULL),(61,'64','LETRAS 45/60 DIAS','Si',45,'Si',NULL),(62,'65','LETRAS 45/50/55/60/65','Si',45,'Si',NULL),(63,'66','LETRA45/52/59/66/73/80','Si',45,'Si',NULL),(64,'67','LETRAS 80/85/90/95','Si',80,'Si',NULL),(65,'68','LETRAS 35/45/55','Si',35,'Si',NULL),(66,'69','LETRAS 50/55/60/65/70/75/80','Si',50,'Si',NULL),(67,'70','LET. 30/36/42/48','Si',30,'Si',NULL),(68,'71','LETRAS 60/70','Si',60,'Si',NULL),(69,'72','LETRA 30/38/46/84/62/70/78','Si',30,'Si',NULL),(70,'73','LETRA 40/45/50/55/60/65/70','Si',40,'Si',NULL),(71,'74','LETRA 60/75/90','Si',60,'Si',NULL),(72,'75','LETRA 70 DIAS','Si',70,'Si',NULL),(73,'76','LETRA 80 DIAS','Si',80,'Si',NULL),(74,'77','LET. 45/52/59/66/73/80/87/94','Si',45,'Si',NULL),(75,'78','LETRA 30/40','Si',30,'Si',NULL),(76,'79','LETRA 79/84/89/94','Si',79,'Si',NULL),(77,'80','L.60/64/68/72/76/80/84/88','Si',60,'Si',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
