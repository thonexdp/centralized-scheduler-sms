/*
SQLyog Enterprise v13.1.1 (64 bit)
MySQL - 10.4.24-MariaDB : Database - cm-sms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cm-sms` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `cm-sms`;

/*Table structure for table `department` */

DROP TABLE IF EXISTS `department`;

CREATE TABLE `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `campus` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

/*Data for the table `department` */

insert  into `department`(`id`,`name`,`description`,`campus`) values 
(12,'CCSIT','c2022345','mc'),
(13,'CCSIT',NULL,'toc'),
(14,'CCSIT45',NULL,'bc'),
(15,'CCSIT',NULL,'bc'),
(16,'CCSIT',NULL,'mcc'),
(17,'CCSIT',NULL,'hc'),
(18,'CCSIT3',NULL,'bc'),
(19,'CCSIT45',NULL,'toc'),
(21,'CCSIT35345',NULL,'mc');

/*Table structure for table `employee` */

DROP TABLE IF EXISTS `employee`;

CREATE TABLE `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(200) DEFAULT NULL,
  `middlename` varchar(200) DEFAULT NULL,
  `lastname` varchar(200) DEFAULT NULL,
  `agencyno` int(20) DEFAULT NULL,
  `department` int(10) DEFAULT NULL,
  `cellno` varchar(20) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `itemname` varchar(100) DEFAULT NULL,
  `campus` varchar(50) DEFAULT NULL,
  `photo` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `employee` */

insert  into `employee`(`id`,`firstname`,`middlename`,`lastname`,`agencyno`,`department`,`cellno`,`status`,`itemname`,`campus`,`photo`) values 
(8,'Super',NULL,'Admin',123,NULL,NULL,NULL,NULL,NULL,NULL),
(9,'Anotni',NULL,'depaz',1,13,'06542132323','Job Order','Clerk','mc',NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empid` int(10) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `password` text DEFAULT NULL COMMENT 'admin123',
  `role` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`id`,`empid`,`username`,`password`,`role`) values 
(2,8,'admin123','$2y$10$QS2vdK0Yq9OietQs4WAXhuA8HyTvyQLbvGH9WGSf51Z7Q8QQpWKNG','sadmin'),
(3,9,'depaz1','$2y$10$jvYyhiOfOYxAquGAN58otOiiK0ejKrGW1xLm.wWhFSASshQZ54Oie','clerk');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
