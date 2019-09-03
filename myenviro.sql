/*
SQLyog Community v12.4.3 (64 bit)
MySQL - 5.7.24 : Database - myenviro
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`myenviro` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `myenviro`;

/*Table structure for table `gap` */

DROP TABLE IF EXISTS `gap`;

CREATE TABLE `gap` (
  `id` int(11) unsigned,
  `company_name` varchar(255) DEFAULT NULL,
  `farm_name` varchar(255) DEFAULT NULL,
  `farm_address` varchar(255) DEFAULT NULL,
  `negeri` varchar(255) DEFAULT NULL,
  `type_operation` varchar(255) DEFAULT NULL,
  `long` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `gap` */

insert  into `gap`(`id`,`company_name`,`farm_name`,`farm_address`,`negeri`,`type_operation`,`long`,`lat`) values 
(1,'AR-RAUDHAH BIO-TECH FARM SDN BHD','AR-RAUDHAH BIO-TECH FARM SDN BHD','Kampung Bunga Raya','Selangor','Kambing Pedaging','101.7340499','3.1478947'),
(2,'AYAMAS INTEGRATED POULTRY FARM SDN BHD','BANGI FARM','Lot 2315, Kampung Rinching Hilir, Bangi','Selangor','Ayam Baka Pedaging (PS)','101.569126','3.268596'),
(3,'EMENINT FARM SDN BHD','EMENINT FARM SDN BHD','Lot 244-253,Jalan Haji Omar, Bukit Belimbing','Selangor','Ayam Baka Pedaging (PS) & Pusat Penetasan Telur','101.458307','3.051977'),
(4,'EMENINT FARM SDN BHD','EMENINT FARM SDN BHD - BROILED BREEDER','Lot 739-741, Mukim Api - Api','Selangor','Ayam Baka Pedaging (PS)','101.460335','3.054730');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
