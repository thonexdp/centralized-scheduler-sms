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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

/*Data for the table `department` */

insert  into `department`(`id`,`name`,`description`,`campus`) values 
(12,'CCSIT','c2022345-3','mc'),
(13,'CCSIT',NULL,'toc'),
(14,'CCSIT45',NULL,'bc'),
(15,'CCSIT',NULL,'bc'),
(16,'CCSIT',NULL,'mcc'),
(17,'CCSIT',NULL,'hc'),
(18,'CCSIT3',NULL,'bc'),
(19,'CCSIT45',NULL,'toc'),
(22,'BSIT','Bachelor','mc');

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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

/*Data for the table `employee` */

insert  into `employee`(`id`,`firstname`,`middlename`,`lastname`,`agencyno`,`department`,`cellno`,`status`,`itemname`,`campus`,`photo`,`email`) values 
(8,'Super',NULL,'Admin',123,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(9,'99',NULL,'99',1,12,'06542132323','Job Order','Clerk','mc',NULL,NULL),
(10,'1212',NULL,'1212',5,12,'9518226035','Job Order','Instructor','mc',NULL,NULL),
(11,'1010','dfdsf','1010',344,17,'0987654','Job Order','Clerk','mc',NULL,NULL),
(12,'1111','dfdsf','1111',344,17,'0987654','Permanent-Staff','Instructor','mc',NULL,NULL),
(13,'11342',NULL,'11',11,13,'111','Job Order','President','mc',NULL,NULL),
(14,'22',NULL,'22',22,12,'111','Permanent-Staff','Instructor','mc',NULL,NULL),
(15,'33',NULL,'33',33,12,'33','Job Order','President','bc',NULL,NULL),
(16,'44',NULL,'44',33,12,'33','Job Order','President','bc',NULL,NULL),
(17,'55',NULL,'5',33,12,'33','Job Order','President','bc',NULL,NULL),
(18,'77',NULL,'77',77,12,'77','Job Order',NULL,'mc',NULL,NULL),
(19,'88',NULL,'88',77,12,'77','Job Order','President','mc',NULL,NULL),
(20,'test',NULL,'test',123,12,'09873','Job Order','Clerk','mc',NULL,NULL),
(21,'sadsa',NULL,'asds',45,12,'email@gmail.com','Permanent-Staff','Director','mc',NULL,NULL),
(22,'78787',NULL,'7878',7878,12,'9876345353','Job Order','Dean','mc',NULL,'admin@gmial.ocm'),
(23,'asd',NULL,'asd',114,12,'asd','Permanent-Staff','President','mc',NULL,'admin@gmial.ocm'),
(24,'qwewqewqewq',NULL,'qwewqewqewq',34,12,'098765432','Job Order','Clerk',NULL,NULL,'pazjeck14@gmail.com'),
(25,'adsadsa',NULL,'asdsad',23,12,'098763','Job Order','President','mc','images/1669379843.png','admin@gmial.ocm'),
(26,'sdfsdf3333',NULL,'sdfdsf',12,12,'098764','Job Order','Instructor','mc','images/1669378831.png','admin@gmial.ocm');

/*Table structure for table `meeting` */

DROP TABLE IF EXISTS `meeting`;

CREATE TABLE `meeting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) DEFAULT NULL,
  `topic` text DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  `timestart` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `addedby` int(10) DEFAULT NULL,
  `venue` text DEFAULT NULL,
  `active` int(2) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `meeting` */

insert  into `meeting`(`id`,`description`,`topic`,`date`,`timestart`,`type`,`duration`,`addedby`,`venue`,`active`) values 
(1,'Meting 02','tipic 12','2022-11-25','06:00','In-Person','am',0,'Plenary',1),
(2,'Fee 23 2020 General MEeting','tipic 12','2022-11-02','07:00','In-Person','am',0,'Plasza',1),
(4,'Now meeting 101 At Plenary Hall Meering Plaxa','No Topic','2022-11-20','09:12','In-Person','am',0,'Plenary',1);

/*Table structure for table `participants` */

DROP TABLE IF EXISTS `participants`;

CREATE TABLE `participants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empid` int(10) DEFAULT NULL,
  `meetingId` int(10) DEFAULT NULL,
  `active` int(2) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

/*Data for the table `participants` */

insert  into `participants`(`id`,`empid`,`meetingId`,`active`) values 
(16,11,2,1),
(17,12,2,1),
(18,11,3,1),
(19,12,3,1),
(23,10,1,1),
(24,16,1,1),
(25,17,1,1),
(26,18,1,1),
(27,19,1,1),
(28,9,1,1),
(29,20,1,1),
(30,13,1,1),
(31,13,2,1),
(32,13,4,1);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empid` int(10) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `password` text DEFAULT NULL COMMENT 'admin123',
  `role` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`id`,`empid`,`username`,`password`,`role`) values 
(2,8,'admin123','$2y$10$QS2vdK0Yq9OietQs4WAXhuA8HyTvyQLbvGH9WGSf51Z7Q8QQpWKNG','sadmin'),
(3,9,'depaz1','$2y$10$jvYyhiOfOYxAquGAN58otOiiK0ejKrGW1xLm.wWhFSASshQZ54Oie','clerk'),
(4,10,'deplkj5','$2y$10$NV8UkGdML8TrsQQpWTlzK.OgHyz3uprTPBgHILkVZ4Ldp4Sw5wWcC','instructor'),
(5,11,'uytrte344','$2y$10$MQ6W1UX1y0w9yM5OldF9J.XyicN.izWkL4jJ8NCmzmgqDhTdxlEOS','clerk'),
(6,12,'uytrte34344','$2y$10$dhqS1LP0/dc2CoNx7UDlquBjCGGMU7IGusEEFVQCTNRooLchqtSIW','instructor'),
(7,13,'1111','$2y$10$U/W9HS9uS2.jfbl7VhnN8uMT5v31i/m2R2Yz7v0PF6jVnV.imd57y','president'),
(8,14,'2222','$2y$10$DCp.47J76L/GN0rOWTfK6O8M5nxKtLDDgPXp5vFHIHYfusoSzI83a','instructor'),
(9,15,'3333','$2y$10$MatNqSeiWphFHgyl9zc4ku9HRSl5JnCWyzvFeQKORoi.QR5WtBuIq','president'),
(10,16,'4433','$2y$10$wEItkLTBloUFyzUwsYzOze6XmMfmxxwgGbYeep.Kr7IqEf3ZhTPem','president'),
(11,17,'533','$2y$10$BE3XpQyCt2xR6tAljKllROLou2kRcar/48/kngO/6nQqyt6Bddo3q','president'),
(12,18,'7777','$2y$10$NHAXUGwEcr15Dq1DtmwwBu/l/1yJuqtAYq584sSh9BhzqCub2.yry',''),
(13,19,'8877','$2y$10$fxUKzBV22Vc2ztn/Q7JWWOIU7gwErgMJOv1P7YWFZR6aOSMF2bxFa','president'),
(14,20,'test123','$2y$10$QF9zHmryUQo9gaXaUxdf/eUfJxG918O1LXZljXKcQePEjvs3Zf5KS','clerk'),
(15,21,'asds45','$2y$10$xVy2VuB/tJ3YGx4F7vRr9u/VhBixWimplbEkyVWrgIvOwIRXA.Yti','director'),
(16,22,'78787878','$2y$10$c7hhUR2oyjI9WuLMpRJR5erQ1lgapo6aORtkiAyKPnXWKgjS9s.8m','dean'),
(17,23,'asd114','$2y$10$8vwWAIimzkHt7a49P91pNugPh2sxuaj1t/nghYY4nqy8Mmsh0XOxa','president'),
(18,24,'qwewqewqewq34','$2y$10$TyQomtuVKGj5tVNwa3tj4uMS4FTIBLkvn/WNFmPGX/m0nJRtFvTvG','clerk'),
(19,25,'asdsad23','$2y$10$/Z.xJfawcwl26pd00EtLkea97oNpmnIBVDRAu4k6TXmVoYcQ381DW','president'),
(20,26,'sdfdsf12','$2y$10$aX6md7e1LvE04Z0G2McMNOaVxfSV6l69R4nYc9SsnRnK9wnN95cg2','instructor');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
