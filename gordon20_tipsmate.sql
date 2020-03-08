/*
SQLyog Community v13.1.5  (64 bit)
MySQL - 10.3.16-MariaDB : Database - tipsmate
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`gordon20_tipsmate` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `gordon20_tipsmate`;

/*Table structure for table `answer` */

DROP TABLE IF EXISTS `answer`;

CREATE TABLE `answer` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userimage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_id` int(11) NOT NULL,
  `following` int(11) NOT NULL,
  `register_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `answer` */

insert  into `answer`(`id`,`name`,`userimage`,`image_name`,`answer`,`question_id`,`following`,`register_date`) values 
(1,'Drew','Drew','','Oh boy do i!!! First things first i bought my water bed during the water bed prohibition of 1980 so ii had to pay an extra 200 bucks to have it imported from Guam. And then when i got it it was full of toothpaste and shaving cream, so i had to drain it and refill it. My cat ended up eating the toothpaste and died! Anyways besides that it great to have sex on.\r\n',3,0,'2019-09-03 00:25:58'),
(2,'Tiffany','Tiffany','','I love my bed! I love my room too it has over 150 posters on the walls and its filled with fx machines and strobe lights and black lights. My bed has tons of pillows and fluffy blankets. I use a big bear that my boyfriend got my as a headrest behind my pillows when i\'m playing video games in my room on my flat screen.',3,0,'2019-09-03 00:26:03'),
(3,'Borat','Borat','','I don\'t have bed. I sleep on ground',3,2,'2019-09-03 00:26:05'),
(4,'MerrylLynch','MerrylLynch','','I don t care, as Long as my Love is in it things are fine.',3,0,'2019-09-03 00:26:07'),
(5,'Gummy Roach','Gummy Roach','','No, not at all! I have a very comfortable bed.',3,2,'0000-00-00 00:00:00');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_09_03_030516_create_q_a_s_table',1),
(4,'2019_09_03_043455_question',2),
(5,'2019_09_03_043614_answer',3),
(6,'2019_09_03_044009_answer',4),
(7,'2019_09_03_044221_answer',5),
(8,'2019_09_03_044906_question',6),
(9,'2019_09_03_071514_answer',7);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `q_a_s` */

DROP TABLE IF EXISTS `q_a_s`;

CREATE TABLE `q_a_s` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `q_a_s` */

insert  into `q_a_s`(`id`,`category`,`created_at`,`updated_at`) values 
(1,'All Categories','2019-09-03 01:50:15',NULL),
(2,'Arts Humanities','2019-09-03 01:50:19',NULL),
(3,'Beauty & Style','2019-09-03 01:50:21',NULL),
(4,'Business & Finance','2019-09-03 01:50:23',NULL),
(5,'Cars & Transportation','2019-09-03 01:50:25',NULL),
(6,'Computers & Internet','2019-09-03 01:50:27',NULL),
(7,'Consumer Electronics','2019-09-03 01:50:29',NULL),
(8,'Dining Out','2019-09-03 01:50:30',NULL),
(9,'Education & Reference','2019-09-03 01:50:32',NULL),
(10,'Entertainment & Music','2019-09-03 01:50:34',NULL),
(11,'Environment','2019-09-03 01:50:36',NULL),
(12,'Family & Relationships','2019-09-03 01:50:38',NULL),
(13,'Food & Drink','2019-09-03 01:50:39',NULL),
(14,'Games & Recreation','2019-09-03 01:50:42',NULL),
(15,'Health','2019-09-03 01:50:43',NULL),
(16,'Home & Garden','2019-09-03 01:50:45',NULL),
(17,'Local Businesses','2019-09-03 01:50:47',NULL),
(18,'News & Events','2019-09-03 01:50:49',NULL),
(19,'Pets','2019-09-03 01:50:50',NULL),
(20,'Politics & Government','2019-09-03 01:50:52',NULL),
(21,'Pregnancy & Parenting','2019-09-03 01:50:54',NULL),
(22,'Science & Mathematics','2019-09-03 01:50:56',NULL),
(23,'Social Science','2019-09-03 01:50:58',NULL),
(24,'Society & Culture','2019-09-03 01:50:59',NULL),
(25,'Sports','2019-09-03 01:51:01',NULL),
(26,'Travel',NULL,NULL);

/*Table structure for table `question` */

DROP TABLE IF EXISTS `question`;

CREATE TABLE `question` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `register_date` datetime NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `question` */

insert  into `question`(`id`,`title`,`register_date`,`category_id`) values 
(1,'How can I gain more Instagram followers?','2019-09-02 21:51:11',2),
(2,'Why was AOC(Communist-D-NY) againist Boston\'s Straight Pride Parade?','2019-09-02 21:53:04',2),
(3,'Do you hate your bed?','2019-09-02 21:53:39',2),
(4,'Have you ever had a pet that dumped you?','2019-09-02 21:54:22',2),
(5,'Do you cry when you cook something that tastes bad?','2019-09-02 21:56:07',2),
(6,'When was the last time you hugged an oak tree?\r\n','2019-09-02 21:56:38',4),
(7,'What\'s something you haven\'t loved yet?','2019-09-02 21:56:54',2),
(8,'True or false: you graduated from Grambling state university?','2019-09-02 21:57:14',3),
(9,'What\'s something you spend too little on?','2019-09-02 21:57:28',5),
(10,'Do liberals think calling rural voters \"rednecks\" and \"hicks\" is a winning strategy for them in 2020?','2019-09-02 21:57:41',3),
(11,'Was Elvis actually talented or was he handsome and white?','2019-09-02 21:57:54',4),
(12,'Is Black Lives Matter a good or bad movement?','2019-09-02 21:58:15',3),
(13,'Have you ever had clean hands?','2019-09-02 21:58:28',6),
(14,'Why are gay parades OK, but not straight pride parades?','2019-09-02 21:58:42',7),
(15,'What would be the impact of doubling the minimum wage?','2019-09-02 21:58:56',8),
(16,'What\'s something that doesn\'t have big brown eyes?','2019-09-02 21:59:10',9),
(17,'Why did liberals protest and hate the “Straight Pride Parade”? Isn’t it discrimination to protest someone’s preference for sexual attraction?','2019-09-02 21:59:24',8),
(18,'True or false: being a bad cook doesn\'t really stop you from having people over for a home-cooked meal?','2019-09-02 21:59:38',11),
(19,'Are women owned small businesses legally advantaged over male owned?','2019-09-02 21:59:53',10),
(20,'That obama was a class act at all times. dont you miss a president like that?','2019-09-02 22:00:10',12),
(21,'Has your last name ever been \"Bartholdy\"?','2019-09-02 22:00:30',11);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
