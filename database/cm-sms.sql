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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

/*Data for the table `department` */

insert  into `department`(`id`,`name`,`description`,`campus`) values 
(12,'CCSIT','c2022345-3','mc'),
(22,'BSIT','Bachelor',NULL);

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
  `email` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

/*Data for the table `employee` */

insert  into `employee`(`id`,`firstname`,`middlename`,`lastname`,`agencyno`,`department`,`cellno`,`status`,`itemname`,`campus`,`photo`,`email`) values 
(27,'james',NULL,'read',123,12,'098765432','Permanent-Faculty','Department Head','mc',NULL,'admin@gmail.com'),
(28,'ana',NULL,'cruz',124,12,'098765432','Permanent-Faculty','Department Head','mc',NULL,'admin@gmail.com'),
(29,'Admin',NULL,'Admin',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(30,'Clerk',NULL,'Clerk',111,12,'09876432',NULL,'Clerk','mc','images/1670069517.png','admin@gmail.com'),
(31,'instructor',NULL,'instructor',2222,12,'098765432',NULL,'Instructor','mc','images/1670069600.png','admin@gmail.com');

/*Table structure for table `meeting` */

DROP TABLE IF EXISTS `meeting`;

CREATE TABLE `meeting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) DEFAULT NULL,
  `topic` text DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  `timestart` time DEFAULT NULL,
  `timend` time DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `addedby` int(10) DEFAULT NULL,
  `venue` text DEFAULT NULL,
  `active` int(2) DEFAULT 1,
  `link` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

/*Data for the table `meeting` */

insert  into `meeting`(`id`,`description`,`topic`,`date`,`timestart`,`timend`,`type`,`duration`,`addedby`,`venue`,`active`,`link`) values 
(16,'Meeting 1','No Topic','2022-12-10','07:00:00','10:00:00','Virtual',NULL,0,NULL,1,'http://localhost:8000/meeting'),
(17,'Meting 01','topic','2022-12-03','07:00:00','09:30:00','In-Person',NULL,0,'Plenary Mpc',1,NULL),
(18,'New Meeting','No Topic','2022-12-03','08:00:00','09:00:00','In-Person',NULL,0,'Plenary',1,NULL);

/*Table structure for table `participants` */

DROP TABLE IF EXISTS `participants`;

CREATE TABLE `participants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empid` int(10) DEFAULT NULL,
  `meetingId` int(10) DEFAULT NULL,
  `active` int(2) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4;

/*Data for the table `participants` */

insert  into `participants`(`id`,`empid`,`meetingId`,`active`) values 
(42,27,16,1),
(43,31,18,1),
(45,30,18,1),
(46,28,18,1),
(47,30,17,1),
(48,31,17,1);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empid` int(10) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `password` text DEFAULT NULL COMMENT 'admin123',
  `role` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`id`,`empid`,`username`,`password`,`role`) values 
(2,29,'admin123','$2y$10$QS2vdK0Yq9OietQs4WAXhuA8HyTvyQLbvGH9WGSf51Z7Q8QQpWKNG','sadmin'),
(21,27,'read123','$2y$10$LV8pr3uL9K5JDexxfrJEk.zMY8VabxNoMi4hFyQ..YmGccbbGVwOa','clerk'),
(22,28,'cruz124','$2y$10$7Nr7ctu/d0/jh061V.VJNeFwcNYsIImL0ZqavpRzJ3DEuGz9LBSw2','department head'),
(23,30,'clerk111','$2y$10$aBNCJtgLhtq6OlOzkrDuxeDKXtoQOjrVrw3dwKi/QPmTIMN/Ad4yC','clerk'),
(24,31,'instructor2222','$2y$10$gqeh2gIM3Uc5VqT8wnxH1.WMbsqtoEy6QYKeBxO9Jmqhf9t/MZ62K','instructor');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
