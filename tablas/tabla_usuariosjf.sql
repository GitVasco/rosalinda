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

/*Table structure for table `usuariosjf` */

DROP TABLE IF EXISTS `usuariosjf`;

CREATE TABLE `usuariosjf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NOT NULL,
  `perfil` text COLLATE utf8_spanish_ci NOT NULL,
  `foto` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `ultimo_login` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `correo` tinyint(1) DEFAULT '0',
  `datos` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `usuariosjf` */

insert  into `usuariosjf`(`id`,`nombre`,`usuario`,`password`,`perfil`,`foto`,`estado`,`ultimo_login`,`fecha`,`correo`,`datos`) values (1,'USUARIO ADMINISTRADOR','admin','$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG','Administrador','vistas/img/usuarios/admin/anonymous.png',1,'2020-08-27 16:17:00','2020-08-27 16:17:00',0,0),(6,'Joel Medrano','jmedrano','$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG','Sistemas','vistas/img/usuarios/jmedrano/242.png',1,'2020-08-25 10:50:50','2020-08-25 10:50:50',0,0),(7,'Elvis Huaman','ehuaman','$2a$07$asxx54ahjppf45sd87a5auBfP8SzPxOC9lb4skT0/mpZfQro.Fl.a','Logistica','vistas/img/usuarios/ehuaman/864.jpg',1,'2020-07-15 16:14:00','2020-07-15 16:14:00',0,0),(8,'Carlos Medrano','cmedrano','$2a$07$asxx54ahjppf45sd87a5auBfP8SzPxOC9lb4skT0/mpZfQro.Fl.a','Costos','vistas/img/usuarios/cmedrano/574.jpg',1,'2020-03-02 12:00:17','2020-03-02 12:00:18',0,0),(9,'Telmo Alayo','talayo','$2a$07$asxx54ahjppf45sd87a5au5704JSJjoOCnS6rOseTB3w7fIUXvhoO','Supervisores','vistas/img/usuarios/talayo/anonymous.png',1,'2020-08-25 10:48:10','2020-08-25 10:48:10',0,0),(10,'Kennedy Rosales','krosales','$2a$07$asxx54ahjppf45sd87a5auGBZ7m4P6nS3L5XF/AjWqPx0E5E/odbS','Produccion','vistas/img/usuarios/krosales/anonymous.png',1,'0000-00-00 00:00:00','2019-11-29 09:23:11',0,0),(11,'Katia Rodriguez','krodriguez','$2a$07$asxx54ahjppf45sd87a5auLh2OU6YOA9S81FkG6NOaHByfEOD3ary','Supervisores','vistas/img/usuarios/krodriguez/anonymous.png',1,'0000-00-00 00:00:00','2019-11-29 09:23:07',0,0),(12,'Lucy Roncal','lroncal','$2a$07$asxx54ahjppf45sd87a5auTotPOsKLTKzRtmOP6BxnOuSnjr0nQCW','Udp','vistas/img/usuarios/lroncal/anonymous.png',1,'2019-11-11 17:28:22','2019-11-29 09:23:08',0,0),(13,'Yudy Rosales LAzaro','yrosales','$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly','Supervisores','vistas/img/usuarios/yrosales/708.jpg',1,'2019-11-19 12:27:19','2019-11-19 12:27:20',0,0),(14,'Isaac Gonzales','igonzales','$2a$07$asxx54ahjppf45sd87a5auBfP8SzPxOC9lb4skT0/mpZfQro.Fl.a','Costos','vistas/img/usuarios/igonzales/181.jpg',1,'2020-01-31 12:19:49','2020-01-31 12:19:49',0,0),(16,'Rodolfo Antara','rantara','$2a$07$asxx54ahjppf45sd87a5auSWi1Jf7igWLWGBcxrFD/Y7Tn2odFznu','Administrador','',1,'2020-01-29 12:38:38','2020-01-29 12:38:39',0,0),(17,'Mariel Cochachi','mcochachi','$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly','Supervisores','',1,'2020-02-03 08:02:12','2020-02-03 08:02:06',0,0),(18,'Carlos Ibarra','cibarra','$2a$07$asxx54ahjppf45sd87a5auBfP8SzPxOC9lb4skT0/mpZfQro.Fl.a','Sistemas','vistas/img/usuarios/cibarra/327.jpg',1,'2020-03-14 10:24:05','2020-03-14 10:24:05',0,0),(19,'Brean Flores','bflores','$2a$07$asxx54ahjppf45sd87a5auBfP8SzPxOC9lb4skT0/mpZfQro.Fl.a','Sistemas','vistas/img/usuarios/bflores/944.jpg',1,'2020-09-29 12:29:39','2020-09-29 12:29:39',0,0),(29,'prueba','12346','$2a$07$asxx54ahjppf45sd87a5auJRR6foEJ7ynpjisKtbiKJbvJsoQ8VPS','Administrador','',0,'0000-00-00 00:00:00','2020-08-25 13:19:21',0,0),(30,'pruebaa','1234567','$2a$07$asxx54ahjppf45sd87a5aun0iJCspK2tYZAQ8nHDIm/OIFN8OLMyO','Administrador','',0,'0000-00-00 00:00:00','2020-08-25 13:20:47',0,0),(31,'asdsadas','45678','$2a$07$asxx54ahjppf45sd87a5auCMcNGvV8OlYc9dwsAJQ4JsdhWYaHQb6','Vendedor','',0,'0000-00-00 00:00:00','2020-08-25 17:12:38',0,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
