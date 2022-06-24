/*
SQLyog Community v13.1.5  (32 bit)
MySQL - 10.4.13-MariaDB : Database - dropdown
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(20,'2014_10_12_000000_create_users_table',1),
(21,'2014_10_12_100000_create_password_resets_table',1),
(22,'2019_08_19_000000_create_failed_jobs_table',1),
(23,'2020_07_29_052907_create_shows_table',1),
(24,'2021_01_21_021555_create_vieva_quizes_table',1),
(25,'2021_01_21_022122_create_vieva_quiz_questions_table',1),
(26,'2021_01_26_184158_add_email_verified_at_to_vieva_users_table',2),
(27,'2021_01_28_144135_add_file_link_to_vieva_guided_meditation_table',3),
(28,'2021_01_28_164342_add_file_link_t',4),
(29,'2021_01_28_164608_add_file_link_to_vieva_self_hypnosis_table',4),
(30,'2021_01_28_165037_add_file_link_to_vieva_self_hypnosis_table',5);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `shows` */

DROP TABLE IF EXISTS `shows`;

CREATE TABLE `shows` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `show_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imdb_rating` double(8,2) NOT NULL,
  `leader_actor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `shows` */

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

/*Table structure for table `vieva_all_checks` */

DROP TABLE IF EXISTS `vieva_all_checks`;

CREATE TABLE `vieva_all_checks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `checks_type` tinyint(3) unsigned NOT NULL COMMENT '0: weekly, 1: monthly',
  `score` int(10) unsigned NOT NULL,
  `percent` int(10) unsigned NOT NULL,
  `check_datetime` timestamp NOT NULL DEFAULT current_timestamp(),
  `QA1` tinyint(4) NOT NULL,
  `QA2` tinyint(4) NOT NULL,
  `QA3` tinyint(4) NOT NULL,
  `QA4` tinyint(4) NOT NULL,
  `QA5` tinyint(4) NOT NULL,
  `QA6` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `vieva_all_checks` */

insert  into `vieva_all_checks`(`id`,`user_id`,`checks_type`,`score`,`percent`,`check_datetime`,`QA1`,`QA2`,`QA3`,`QA4`,`QA5`,`QA6`) values 
(1,23,0,75,57,'2020-08-22 18:52:04',0,1,2,2,1,'false,true,false,false,true,false'),
(2,32,1,16,34,'2020-08-24 19:29:03',2,5,4,2,0,'true,true,true,false,false,true'),
(3,34,1,23,50,'2020-09-01 02:11:23',4,3,1,3,3,'false,false,false,false,false,true'),
(4,35,1,23,30,'2020-08-05 02:13:18',5,3,2,4,3,'true,true,false,false,true,true'),
(5,36,1,43,87,'2020-08-13 02:13:23',3,3,3,5,3,'false,true,false,true,true,false'),
(6,37,1,34,56,'2020-08-22 02:13:26',2,3,4,2,3,'true,true,true,false,true,false'),
(7,38,1,23,87,'2020-08-30 02:13:29',3,4,4,1,3,'false,false,false,true,false,false'),
(8,33,1,54,24,'2020-08-31 02:13:32',4,3,3,3,3,'true,true,true,true,false,false');

/*Table structure for table `vieva_breathing_tool` */

DROP TABLE IF EXISTS `vieva_breathing_tool`;

CREATE TABLE `vieva_breathing_tool` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_in_english` varchar(50) CHARACTER SET utf8 NOT NULL,
  `title_in_french` varchar(50) CHARACTER SET utf8 NOT NULL,
  `breathe_in` int(11) NOT NULL,
  `hold1` int(11) NOT NULL,
  `breathe_out` int(11) NOT NULL,
  `hold2` int(11) DEFAULT NULL,
  `locked` tinyint(4) NOT NULL COMMENT '0: unlocked, 1: locked',
  `user_level` varchar(10) DEFAULT NULL COMMENT '0123456789: all users can see it;\r\n0: only superadmin;\r\n01 : superadmin and admins \r\n..',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `vieva_breathing_tool` */

insert  into `vieva_breathing_tool`(`id`,`title_in_english`,`title_in_french`,`breathe_in`,`hold1`,`breathe_out`,`hold2`,`locked`,`user_level`) values 
(2,'breathing tool 2','breathing tool 2',2,2,2,NULL,1,NULL);

/*Table structure for table `vieva_categories_series` */

DROP TABLE IF EXISTS `vieva_categories_series`;

CREATE TABLE `vieva_categories_series` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_frensh` varchar(200) NOT NULL,
  `category_english` varchar(200) NOT NULL,
  `note` text NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `vieva_categories_series` */

/*Table structure for table `vieva_challenges` */

DROP TABLE IF EXISTS `vieva_challenges`;

CREATE TABLE `vieva_challenges` (
  `challenge_id` int(11) NOT NULL AUTO_INCREMENT,
  `name_frensh` varchar(200) NOT NULL,
  `name_english` varchar(200) NOT NULL,
  `description_frensh` varchar(200) NOT NULL,
  `description_english` varchar(200) NOT NULL,
  `icon` varchar(100) NOT NULL,
  PRIMARY KEY (`challenge_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `vieva_challenges` */

insert  into `vieva_challenges`(`challenge_id`,`name_frensh`,`name_english`,`description_frensh`,`description_english`,`icon`) values 
(1,'french name 1','edited english name 1','french description 1','english description 1','icon'),
(3,'test','test','test','test','test');

/*Table structure for table `vieva_coach_info` */

DROP TABLE IF EXISTS `vieva_coach_info`;

CREATE TABLE `vieva_coach_info` (
  `coach_id` int(11) NOT NULL,
  `full_name` int(11) NOT NULL,
  `biography_frensh` int(11) NOT NULL,
  `biography_english` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `vieva_coach_info` */

/*Table structure for table `vieva_coaching_reports` */

DROP TABLE IF EXISTS `vieva_coaching_reports`;

CREATE TABLE `vieva_coaching_reports` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `duration` tinyint(2) NOT NULL COMMENT '1: 30 minutes; 2: 60 minutes',
  `session_date` date NOT NULL,
  `motif_seance_id` int(11) NOT NULL,
  `rating` tinyint(4) NOT NULL COMMENT '1: 1x Star , 5: 5x Stars',
  `coach_name` varchar(150) NOT NULL,
  `user_first_name` varchar(150) NOT NULL,
  `user_last_name` varchar(150) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `language` tinyint(2) NOT NULL COMMENT '1: English; 2: French',
  `note` text NOT NULL,
  `report_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(5) NOT NULL COMMENT '1:done; 2:non shown; 3:reschuduled; 4:cancelled',
  `client_feedbck` tinyint(5) NOT NULL COMMENT '1: much better; 2:better ; 3:about the same; 4:worse; 5:much worse',
  PRIMARY KEY (`report_id`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8;

/*Data for the table `vieva_coaching_reports` */

insert  into `vieva_coaching_reports`(`report_id`,`duration`,`session_date`,`motif_seance_id`,`rating`,`coach_name`,`user_first_name`,`user_last_name`,`user_email`,`user_id`,`language`,`note`,`report_date`,`status`,`client_feedbck`) values 
(21,1,'2020-10-20',2,5,'coach3','cor3','cor3','cor3@example.com',0,1,'This is note','2020-10-08 09:14:53',2,2),
(22,2,'2020-10-23',3,3,'coach3','cor3','cor3','cor3@example.com',41,1,'fffff','2020-10-31 14:43:36',1,1),
(35,1,'2020-10-20',1,2,'coach3','cor3','cor3','cor3@example.com',0,1,'This is note','2020-10-31 14:43:26',2,2),
(36,2,'2020-10-20',2,4,'coach3','cor2','cor2','cor3@example.com',0,2,'This is note','2020-10-08 02:14:53',4,5),
(37,2,'2020-10-20',3,4,'coach3','cor4','cor4','cor3@example.com',0,2,'This is note','2020-10-08 02:14:53',2,3),
(38,2,'2020-10-20',3,5,'coach3','cor5','cor5','cor3@example.com',0,1,'This is note','2020-10-08 02:14:53',1,5),
(39,1,'2020-10-20',4,5,'coach3','cor6','cor6','cor3@example.com',0,2,'This is note','2020-10-08 02:14:53',3,2),
(40,2,'2020-10-20',1,5,'coach3','cor7','cor7','cor3@example.com',0,1,'This is note','2020-10-08 02:14:53',2,2),
(41,1,'2020-10-20',2,3,'coach3','cor8','cor8','cor3@example.com',0,1,'This is note','2020-10-08 02:14:53',4,4),
(42,2,'2020-10-20',2,3,'coach3','cor9','cor9','cor3@example.com',0,1,'This is note','2020-10-08 02:14:53',2,4),
(43,1,'2020-10-20',3,5,'coach3','cor10','cor10','cor3@example.com',0,1,'This is note','2020-10-08 02:14:53',3,2),
(44,1,'2020-10-20',2,2,'coach3','cor11','cor11','cor3@example.com',0,2,'This is note','2020-10-08 02:14:53',1,5),
(45,2,'2020-10-20',1,3,'coach3','cor12','cor12','cor3@example.com',0,2,'This is note','2020-10-31 14:43:19',2,1),
(46,2,'2020-10-20',2,3,'coach3','cor13','cor13','cor3@example.com',0,1,'This is note','2020-10-08 02:14:53',2,1),
(47,1,'2020-10-20',1,5,'coach3','cor3','cor3','cor3@example.com',0,1,'This is note','2020-10-08 08:14:53',2,2),
(48,2,'2020-10-20',2,4,'coach3','cor2','cor2','cor3@example.com',0,2,'This is note','2020-10-08 08:14:53',4,5),
(49,2,'2020-10-20',3,4,'coach3','cor4','cor4','cor3@example.com',0,2,'This is note','2020-10-08 08:14:53',2,3),
(50,2,'2020-10-20',3,5,'coach3','cor5','cor5','cor3@example.com',0,1,'This is note','2020-10-08 08:14:53',1,5),
(51,1,'2020-10-20',4,5,'coach3','cor6','cor6','cor3@example.com',0,2,'This is note','2020-10-08 08:14:53',3,2),
(52,2,'2020-10-20',1,5,'coach3','cor7','cor7','cor3@example.com',0,1,'This is note','2020-10-08 08:14:53',2,2),
(53,1,'2020-10-20',2,3,'coach3','cor8','cor8','cor3@example.com',0,1,'This is note','2020-10-08 08:14:53',4,4),
(54,2,'2020-10-20',2,3,'coach3','cor9','cor9','cor3@example.com',0,1,'This is note','2020-10-08 08:14:53',2,4),
(55,1,'2020-10-20',3,5,'coach3','cor10','cor10','cor3@example.com',0,1,'This is note','2020-10-08 08:14:53',3,2),
(56,1,'2020-10-20',2,2,'coach3','cor11','cor11','cor3@example.com',0,2,'This is note','2020-10-08 08:14:53',1,5),
(57,2,'2020-10-20',1,5,'coach3','cor12','cor12','cor3@example.com',0,2,'This is note','2020-10-08 08:14:53',2,1),
(58,2,'2020-10-20',2,3,'coach3','cor13','cor13','cor3@example.com',0,1,'This is note','2020-10-08 08:14:53',2,1),
(59,1,'2020-10-20',1,5,'coach3','cor3','cor3','cor3@example.com',0,1,'This is note','2020-10-08 03:14:53',2,2),
(60,2,'2020-10-20',2,4,'coach3','cor2','cor2','cor3@example.com',0,2,'This is note','2020-10-08 03:14:53',4,5),
(61,2,'2020-10-20',3,4,'coach3','cor4','cor4','cor3@example.com',0,2,'This is note','2020-10-08 03:14:53',2,3),
(62,2,'2020-10-20',3,5,'coach3','cor5','cor5','cor3@example.com',0,1,'This is note','2020-10-08 03:14:53',1,5),
(63,1,'2020-10-20',4,5,'coach3','cor6','cor6','cor3@example.com',0,2,'This is note','2020-10-08 03:14:53',3,2),
(64,2,'2020-10-20',1,5,'coach3','cor7','cor7','cor3@example.com',0,1,'This is note','2020-10-08 03:14:53',2,2),
(65,1,'2020-10-20',2,3,'coach3','cor8','cor8','cor3@example.com',0,1,'This is note','2020-10-08 03:14:53',4,4),
(66,2,'2020-10-20',2,3,'coach3','cor9','cor9','cor3@example.com',0,1,'This is note','2020-10-08 03:14:53',2,4),
(67,1,'2020-10-20',3,5,'coach3','cor10','cor10','cor3@example.com',0,1,'This is note','2020-10-08 03:14:53',3,2),
(68,1,'2020-10-20',2,2,'coach3','cor11','cor11','cor3@example.com',0,2,'This is note','2020-10-08 03:14:53',1,5),
(69,2,'2020-10-20',1,5,'coach3','cor12','cor12','cor3@example.com',0,2,'This is note','2020-10-08 03:14:53',2,1),
(70,2,'2020-10-20',2,3,'coach3','cor13','cor13','cor3@example.com',0,1,'This is note','2020-10-08 03:14:53',2,1),
(71,1,'2020-10-20',1,5,'coach3','cor3','cor3','cor3@example.com',0,1,'This is note','2020-10-08 03:14:53',2,2),
(72,2,'2020-10-20',2,4,'coach3','cor2','cor2','cor3@example.com',0,2,'This is note','2020-10-08 03:14:53',4,5),
(73,2,'2020-10-20',3,4,'coach3','cor4','cor4','cor3@example.com',0,2,'This is note','2020-10-08 03:14:53',2,3),
(74,2,'2020-10-20',3,5,'coach3','cor5','cor5','cor3@example.com',0,1,'This is note','2020-10-08 03:14:53',1,5),
(75,1,'2020-10-20',4,5,'coach3','cor6','cor6','cor3@example.com',0,2,'This is note','2020-10-08 03:14:53',3,2),
(76,2,'2020-10-20',1,5,'coach3','cor7','cor7','cor3@example.com',0,1,'This is note','2020-10-08 03:14:53',2,2),
(77,1,'2020-10-20',2,3,'coach3','cor8','cor8','cor3@example.com',0,1,'This is note','2020-10-08 03:14:53',4,4),
(78,2,'2020-10-20',2,3,'coach3','cor9','cor9','cor3@example.com',0,1,'This is note','2020-10-08 03:14:53',2,4),
(79,1,'2020-10-20',3,5,'coach3','cor10','cor10','cor3@example.com',0,1,'This is note','2020-10-08 03:14:53',3,2),
(80,1,'2020-10-20',2,2,'coach3','cor11','cor11','cor3@example.com',0,2,'This is note','2020-10-08 03:14:53',1,5),
(81,2,'2020-10-20',1,5,'coach3','cor12','cor12','cor3@example.com',0,2,'This is note','2020-10-08 03:14:53',2,1),
(82,2,'2020-10-20',2,3,'coach3','cor13','cor13','cor3@example.com',0,1,'This is note','2020-10-08 03:14:53',2,1),
(83,1,'2020-10-20',1,5,'coach3','cor3','cor3','cor3@example.com',0,1,'This is note','2020-10-08 03:14:53',2,2),
(84,2,'2020-10-20',2,4,'coach3','cor2','cor2','cor3@example.com',0,2,'This is note','2020-10-08 03:14:53',4,5),
(85,2,'2020-10-20',3,4,'coach3','cor4','cor4','cor3@example.com',0,2,'This is note','2020-10-08 03:14:53',2,3),
(86,2,'2020-10-20',3,5,'coach3','cor5','cor5','cor3@example.com',0,1,'This is note','2020-10-08 03:14:53',1,5),
(87,1,'2020-10-20',4,5,'coach3','cor6','cor6','cor3@example.com',0,2,'This is note','2020-10-08 03:14:53',3,2),
(88,2,'2020-10-20',1,5,'coach3','cor7','cor7','cor3@example.com',0,1,'This is note','2020-10-08 03:14:53',2,2),
(89,1,'2020-10-20',2,3,'coach3','cor8','cor8','cor3@example.com',0,1,'This is note','2020-10-08 03:14:53',4,4),
(90,2,'2020-10-20',2,3,'coach3','cor9','cor9','cor3@example.com',0,1,'This is note','2020-10-08 03:14:53',2,4),
(91,1,'2020-10-20',3,5,'coach3','cor10','cor10','cor3@example.com',0,1,'This is note','2020-10-08 03:14:53',3,2),
(92,1,'2020-10-20',2,2,'coach3','cor11','cor11','cor3@example.com',0,2,'This is note','2020-10-08 03:14:53',1,5),
(93,2,'2020-10-20',1,5,'coach3','cor12','cor12','cor3@example.com',0,2,'This is note','2020-10-08 03:14:53',2,1),
(94,2,'2020-10-20',2,3,'coach3','cor13','cor13','cor3@example.com',0,1,'This is note','2020-10-08 03:14:53',2,1),
(95,1,'2020-10-20',1,5,'coach3','cor3','cor3','cor3@example.com',0,1,'This is note','2020-10-08 03:14:53',2,2),
(96,2,'2020-10-20',2,4,'coach3','cor2','cor2','cor3@example.com',0,2,'This is note','2020-10-08 03:14:53',4,5),
(97,2,'2020-10-20',3,4,'coach3','cor4','cor4','cor3@example.com',0,2,'This is note','2020-10-08 03:14:53',2,3),
(98,2,'2020-10-20',3,5,'coach3','cor5','cor5','cor3@example.com',0,1,'This is note','2020-10-08 03:14:53',1,5),
(99,1,'2020-10-20',4,5,'coach3','cor6','cor6','cor3@example.com',0,2,'This is note','2020-10-08 03:14:53',3,2),
(100,2,'2020-10-20',1,5,'coach3','cor7','cor7','cor3@example.com',0,1,'This is note','2020-10-08 03:14:53',2,2),
(101,1,'2020-10-20',2,3,'coach3','cor8','cor8','cor3@example.com',0,1,'This is note','2020-10-08 03:14:53',4,4),
(102,2,'2020-10-20',2,3,'coach3','cor9','cor9','cor3@example.com',0,1,'This is note','2020-10-08 03:14:53',2,4),
(103,1,'2020-10-20',3,5,'coach3','cor10','cor10','cor3@example.com',0,1,'This is note','2020-10-08 03:14:53',3,2),
(104,1,'2020-10-20',2,2,'coach3','cor11','cor11','cor3@example.com',0,2,'This is note','2020-10-08 03:14:53',1,5),
(105,2,'2020-10-20',1,5,'coach3','cor12','cor12','cor3@example.com',0,2,'This is note','2020-10-08 03:14:53',2,1),
(106,2,'2020-10-20',2,3,'coach3','cor13','cor13','cor3@example.com',0,1,'This is note','2020-10-08 03:14:53',2,1),
(107,1,'2020-12-28',1,1,'coach2','cor3','cor3','cor3@example.com',40,1,'sss','2021-01-29 19:40:09',1,1),
(108,1,'2020-10-20',1,5,'coach3','cor3','cor3','cor3@example.com',0,1,'This is note','2020-10-08 03:14:53',2,2),
(109,2,'2020-10-20',2,4,'coach3','cor2','cor2','cor3@example.com',0,2,'This is note','2020-10-08 03:14:53',4,5),
(110,2,'2020-10-20',3,4,'coach3','cor4','cor4','cor3@example.com',0,2,'This is note','2020-10-08 03:14:53',2,3),
(111,2,'2020-10-20',3,5,'coach3','cor5','cor5','cor3@example.com',0,1,'This is note','2020-10-08 03:14:53',1,5),
(112,1,'2020-10-20',4,5,'coach3','cor6','cor6','cor3@example.com',0,2,'This is note','2020-10-08 03:14:53',3,2),
(113,2,'2020-10-20',1,5,'coach3','cor7','cor7','cor3@example.com',0,1,'This is note','2020-10-08 03:14:53',2,2),
(114,1,'2020-10-20',2,3,'coach3','cor8','cor8','cor3@example.com',0,1,'This is note','2020-10-08 03:14:53',4,4),
(115,2,'2020-10-20',2,3,'coach3','cor9','cor9','cor3@example.com',0,1,'This is note','2020-10-08 03:14:53',2,4),
(116,1,'2020-10-20',3,5,'coach3','cor10','cor10','cor3@example.com',0,1,'This is note','2020-10-08 03:14:53',3,2),
(117,1,'2020-10-20',2,2,'coach3','cor11','cor11','cor3@example.com',0,2,'This is note','2020-10-08 03:14:53',1,5),
(118,2,'2020-10-20',1,5,'coach3','cor12','cor12','cor3@example.com',0,2,'This is note','2020-10-08 03:14:53',2,1),
(119,2,'2020-10-20',2,3,'coach3','cor13','cor13','cor3@example.com',0,1,'This is note','2020-10-08 03:14:53',2,1);

/*Table structure for table `vieva_corporate_clients` */

DROP TABLE IF EXISTS `vieva_corporate_clients`;

CREATE TABLE `vieva_corporate_clients` (
  `corporate_client_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL COMMENT '1: only superadmin',
  `corporate_name` varchar(250) NOT NULL,
  `plan_starting_date` date NOT NULL,
  `plan_expiration_date` date NOT NULL,
  `plattform` varchar(200) NOT NULL DEFAULT 'Web' COMMENT 'for ex: mobile',
  `Number_licences` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`corporate_client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Data for the table `vieva_corporate_clients` */

insert  into `vieva_corporate_clients`(`corporate_client_id`,`admin_id`,`corporate_name`,`plan_starting_date`,`plan_expiration_date`,`plattform`,`Number_licences`) values 
(20,22,'name1','2020-10-02','2020-10-28','Web',33),
(21,49,'name2','2020-10-16','2020-10-30','Web',3232);

/*Table structure for table `vieva_corporate_clients_settings` */

DROP TABLE IF EXISTS `vieva_corporate_clients_settings`;

CREATE TABLE `vieva_corporate_clients_settings` (
  `settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `corporate_id` int(11) NOT NULL,
  `number_licences` int(11) DEFAULT NULL,
  `validation_key` varchar(8) DEFAULT NULL,
  `hours` int(11) DEFAULT NULL,
  PRIMARY KEY (`settings_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `vieva_corporate_clients_settings` */

insert  into `vieva_corporate_clients_settings`(`settings_id`,`corporate_id`,`number_licences`,`validation_key`,`hours`) values 
(1,20,NULL,'100000',3),
(2,21,NULL,'100001',43);

/*Table structure for table `vieva_corporate_groups` */

DROP TABLE IF EXISTS `vieva_corporate_groups`;

CREATE TABLE `vieva_corporate_groups` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `corporate_client_id` int(11) NOT NULL,
  `group_name` varchar(200) NOT NULL,
  `corporate_group_admin_id` int(11) NOT NULL DEFAULT 1 COMMENT '1: superadmin',
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Data for the table `vieva_corporate_groups` */

insert  into `vieva_corporate_groups`(`group_id`,`corporate_client_id`,`group_name`,`corporate_group_admin_id`) values 
(3,1,'Humain Resources',8),
(4,12,'Marketing',29),
(6,1,'IT department',27),
(15,12,'dddddddddd',37),
(19,1,'sdsds',29);

/*Table structure for table `vieva_current_users` */

DROP TABLE IF EXISTS `vieva_current_users`;

CREATE TABLE `vieva_current_users` (
  `user_id` int(11) NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `vieva_current_users` */

/*Table structure for table `vieva_guided_meditation` */

DROP TABLE IF EXISTS `vieva_guided_meditation`;

CREATE TABLE `vieva_guided_meditation` (
  `guided_meditation_id` int(11) NOT NULL AUTO_INCREMENT,
  `title_frensh` varchar(250) NOT NULL,
  `title_english` varchar(250) NOT NULL,
  `description_frensh` text NOT NULL,
  `description_english` text NOT NULL,
  `file_name_frensh` varchar(250) NOT NULL,
  `file_name_english` varchar(250) NOT NULL,
  `user_level` varchar(10) DEFAULT NULL COMMENT '0123456789: all users can see it;\r\n0: only superadmin;\r\n01 : superadmin and admins \r\n..',
  `file_link` text NOT NULL,
  PRIMARY KEY (`guided_meditation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

/*Data for the table `vieva_guided_meditation` */

insert  into `vieva_guided_meditation`(`guided_meditation_id`,`title_frensh`,`title_english`,`description_frensh`,`description_english`,`file_name_frensh`,`file_name_english`,`user_level`,`file_link`) values 
(1,'Guided Meditation 1','Guided Meditation 1','Guided Meditation 1','Guided Meditation 1','Guided Meditation 1','Guided Meditation 1',NULL,''),
(3,'Guided Meditation 2','Guided Meditation 2','fdsa','fe','Guided Meditation 2','Guided Meditation 2',NULL,''),
(4,'french','english','second language','common language','common','common',NULL,'');

/*Table structure for table `vieva_mindfulness_categories` */

DROP TABLE IF EXISTS `vieva_mindfulness_categories`;

CREATE TABLE `vieva_mindfulness_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name_in_french` varchar(50) NOT NULL,
  `category_name_in_english` varchar(50) NOT NULL,
  `category_thumbnail` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `vieva_mindfulness_categories` */

insert  into `vieva_mindfulness_categories`(`id`,`category_name_in_french`,`category_name_in_english`,`category_thumbnail`) values 
(1,'OCÉAN','Beach','uploads/images/beach/thumb.jpg'),
(2,'FORÊT','Forest','uploads/images/forest/thumb.jpg');

/*Table structure for table `vieva_mindfulness_tool` */

DROP TABLE IF EXISTS `vieva_mindfulness_tool`;

CREATE TABLE `vieva_mindfulness_tool` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `image_url` text CHARACTER SET utf8 NOT NULL,
  `sound_link` text CHARACTER SET utf8 DEFAULT NULL,
  `order_number` int(11) DEFAULT NULL,
  `user_level` varchar(10) DEFAULT NULL COMMENT '0123456789: all users can see it;\r\n0: only superadmin;\r\n01 : superadmin and admins \r\n..',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `vieva_mindfulness_tool` */

insert  into `vieva_mindfulness_tool`(`id`,`category_id`,`image_url`,`sound_link`,`order_number`,`user_level`) values 
(8,1,'2020_11_19-51.jpg','',NULL,NULL),
(7,1,'2020_11_19-43.png','2020_11_19-40.png',NULL,NULL),
(10,1,'2021_01_28-68.jpg','2021_01_28-31.jpg',NULL,NULL);

/*Table structure for table `vieva_motif_seance` */

DROP TABLE IF EXISTS `vieva_motif_seance`;

CREATE TABLE `vieva_motif_seance` (
  `motif_seance_id` int(11) NOT NULL AUTO_INCREMENT,
  `seance_name` varchar(200) NOT NULL,
  `picture` varchar(200) NOT NULL DEFAULT 'none',
  PRIMARY KEY (`motif_seance_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

/*Data for the table `vieva_motif_seance` */

insert  into `vieva_motif_seance`(`motif_seance_id`,`seance_name`,`picture`) values 
(1,'depression','none'),
(2,'parenting-issues','none'),
(3,'relationship-issues','none'),
(4,'mourning','none'),
(5,'conflicts','none'),
(6,'self_confidence','none'),
(7,'addictions','none'),
(8,'others','none');

/*Table structure for table `vieva_notification_listing` */

DROP TABLE IF EXISTS `vieva_notification_listing`;

CREATE TABLE `vieva_notification_listing` (
  `listing_id` int(11) NOT NULL AUTO_INCREMENT,
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `status` tinyint(2) NOT NULL COMMENT '0:unread , 1:read',
  PRIMARY KEY (`listing_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `vieva_notification_listing` */

insert  into `vieva_notification_listing`(`listing_id`,`notification_id`,`user_id`,`timestamp`,`status`) values 
(4,4,20,'2020-10-08 03:47:06',0),
(5,5,55,'2021-01-28 13:49:31',0);

/*Table structure for table `vieva_notifications` */

DROP TABLE IF EXISTS `vieva_notifications`;

CREATE TABLE `vieva_notifications` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `notification_name` varchar(250) NOT NULL COMMENT 'for admin management purposes',
  `content_frensh` text NOT NULL,
  `content_english` text NOT NULL,
  `date` datetime NOT NULL,
  `target` tinyint(5) NOT NULL COMMENT '0:freeuser & guests, 1:premium_user, 2:corporate_client, 9:all',
  `target_id` int(11) NOT NULL DEFAULT -1 COMMENT '-1 means for example if we have target=0 and target_id= -1 so the notification will be sent to all freeusers and guests',
  PRIMARY KEY (`notification_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `vieva_notifications` */

insert  into `vieva_notifications`(`notification_id`,`notification_name`,`content_frensh`,`content_english`,`date`,`target`,`target_id`) values 
(4,'aaa','This is a notification','This is a notification','2020-10-08 03:47:06',9,-1),
(5,'xxx','asdfasdfasdfasdfasdfasdf','asdfasdfasdf','2021-01-28 13:49:31',9,-1);

/*Table structure for table `vieva_premium_payment_plans` */

DROP TABLE IF EXISTS `vieva_premium_payment_plans`;

CREATE TABLE `vieva_premium_payment_plans` (
  `plan_id` int(11) NOT NULL AUTO_INCREMENT,
  `title_frensh` varchar(250) NOT NULL,
  `title_english` varchar(250) NOT NULL,
  `price` int(11) NOT NULL,
  `description_frensh` text NOT NULL,
  `description_english` text NOT NULL,
  PRIMARY KEY (`plan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `vieva_premium_payment_plans` */

insert  into `vieva_premium_payment_plans`(`plan_id`,`title_frensh`,`title_english`,`price`,`description_frensh`,`description_english`) values 
(1,'paiement mensuel','monthly ',99,'paiement mensuel pour les utilisateurs \"premium user\".','monthly payment for premium users.'),
(2,'annuel','yearly',899,'paiement annuel pour les utilisateurs \"premium user\".','yearly payment for premium users.');

/*Table structure for table `vieva_questions` */

DROP TABLE IF EXISTS `vieva_questions`;

CREATE TABLE `vieva_questions` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(350) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `language` tinyint(4) NOT NULL COMMENT '0: frensh ; 1: english',
  `lesson_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

/*Data for the table `vieva_questions` */

insert  into `vieva_questions`(`question_id`,`question`,`is_active`,`language`,`lesson_id`) values 
(13,'question1: Good morning? How are you?',1,1,NULL),
(14,'question2: Fine thanks and you? Not too bad.',1,1,11),
(15,'question3: How is everythin doing? Everything is going very well.',1,1,NULL),
(16,'question4: What\'s your favorite color? I like purple.',1,1,13),
(17,'question5: Whare are you from. I\'m from Sweden. And you?',1,1,14),
(18,'question6: Nice to meet you. I\'m pleased to meet you. me too!',1,1,NULL),
(19,'question7: Oh you\'re welcome. Make yourself at home.',1,1,NULL),
(20,'Oh really, you look very tired.',1,1,NULL);

/*Table structure for table `vieva_questions_possible_choices` */

DROP TABLE IF EXISTS `vieva_questions_possible_choices`;

CREATE TABLE `vieva_questions_possible_choices` (
  `choice_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `choice` varchar(340) NOT NULL,
  `is_right_choice` tinyint(4) NOT NULL COMMENT '0: no ; 1: yes',
  PRIMARY KEY (`choice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `vieva_questions_possible_choices` */

insert  into `vieva_questions_possible_choices`(`choice_id`,`question_id`,`choice`,`is_right_choice`) values 
(3,13,'choice1-1',1),
(4,14,'choice2',1),
(5,17,'choice3',1),
(6,5,'choice4',0),
(7,20,'choice5',1),
(8,19,'home',0),
(9,15,'office',0);

/*Table structure for table `vieva_quiz_questions` */

DROP TABLE IF EXISTS `vieva_quiz_questions`;

CREATE TABLE `vieva_quiz_questions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `quiz_id` bigint(20) unsigned NOT NULL,
  `question_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vieva_quiz_questions_quiz_id_foreign` (`quiz_id`),
  KEY `vieva_quiz_questions_question_id_foreign` (`question_id`),
  CONSTRAINT `vieva_quiz_questions_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `vieva_questions` (`question_id`) ON DELETE CASCADE,
  CONSTRAINT `vieva_quiz_questions_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `vieva_quizes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `vieva_quiz_questions` */

insert  into `vieva_quiz_questions`(`id`,`quiz_id`,`question_id`,`created_at`,`updated_at`) values 
(42,20,13,NULL,NULL),
(43,20,14,NULL,NULL),
(44,20,16,NULL,NULL),
(45,20,20,NULL,NULL),
(51,21,14,NULL,NULL),
(52,21,19,NULL,NULL),
(53,22,14,NULL,NULL),
(54,22,19,NULL,NULL),
(57,23,19,NULL,NULL),
(58,23,20,NULL,NULL),
(59,24,15,NULL,NULL),
(60,24,17,NULL,NULL);

/*Table structure for table `vieva_quizes` */

DROP TABLE IF EXISTS `vieva_quizes`;

CREATE TABLE `vieva_quizes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `quiz_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `is_active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vieva_quizes_lesson_id_foreign` (`lesson_id`),
  CONSTRAINT `vieva_quizes_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `vieva_video_lessons` (`lesson_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `vieva_quizes` */

insert  into `vieva_quizes`(`id`,`quiz_text`,`lesson_id`,`is_active`,`created_at`,`updated_at`) values 
(20,'quiz1: Greeting.',7,'1','2021-01-27 18:54:18','2021-01-27 18:55:29'),
(21,'quiz2: laravel framework',11,'1','2021-01-27 18:55:59','2021-01-27 18:58:42'),
(22,'quiz3: test',7,'1','2021-01-27 19:13:12','2021-01-27 19:13:12'),
(23,'quiz4: test1',12,'1','2021-01-29 19:53:46','2021-01-29 19:53:57'),
(24,'quiz5:test3',13,'1','2021-01-30 16:55:34','2021-01-30 16:55:34');

/*Table structure for table `vieva_quote_likes` */

DROP TABLE IF EXISTS `vieva_quote_likes`;

CREATE TABLE `vieva_quote_likes` (
  `id` int(111) NOT NULL AUTO_INCREMENT,
  `quote_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `vieva_quote_likes` */

/*Table structure for table `vieva_quote_video_related` */

DROP TABLE IF EXISTS `vieva_quote_video_related`;

CREATE TABLE `vieva_quote_video_related` (
  `quote_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `vieva_quote_video_related` */

/*Table structure for table `vieva_quotes` */

DROP TABLE IF EXISTS `vieva_quotes`;

CREATE TABLE `vieva_quotes` (
  `quote_id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `language` tinyint(2) NOT NULL COMMENT '0: frensh ; 1: english',
  `video_id` int(11) NOT NULL,
  `Author` varchar(200) NOT NULL,
  PRIMARY KEY (`quote_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

/*Data for the table `vieva_quotes` */

insert  into `vieva_quotes`(`quote_id`,`content`,`language`,`video_id`,`Author`) values 
(8,'This is a new quote',1,9,'coach2'),
(9,'another quote',0,11,'coach3'),
(10,'sds',1,9,'bbb'),
(11,'This is a update quote',0,9,'Dropdown');

/*Table structure for table `vieva_routine_checked` */

DROP TABLE IF EXISTS `vieva_routine_checked`;

CREATE TABLE `vieva_routine_checked` (
  `routine_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `RoutineType` tinyint(2) NOT NULL COMMENT '0: default routine; 1: user_specified routine',
  `checked` tinyint(1) NOT NULL,
  `Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `vieva_routine_checked` */

/*Table structure for table `vieva_routines` */

DROP TABLE IF EXISTS `vieva_routines`;

CREATE TABLE `vieva_routines` (
  `routine_id` int(11) NOT NULL AUTO_INCREMENT,
  `name_frensh` varchar(250) NOT NULL,
  `name_english` varchar(250) NOT NULL,
  `description_frensh` text NOT NULL,
  `description_english` text NOT NULL,
  `icon` varchar(100) NOT NULL DEFAULT 'none',
  PRIMARY KEY (`routine_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `vieva_routines` */

insert  into `vieva_routines`(`routine_id`,`name_frensh`,`name_english`,`description_frensh`,`description_english`,`icon`) values 
(1,'Focus','Focus','','','none'),
(2,'Conscious breathing','conscious breathing','','','none'),
(3,'Meditate ','Meditate','','','none'),
(4,'Call my parents','Call my parents','','','none'),
(5,'Journaling','Journaling','','','none');

/*Table structure for table `vieva_routines_set_by_users` */

DROP TABLE IF EXISTS `vieva_routines_set_by_users`;

CREATE TABLE `vieva_routines_set_by_users` (
  `r_s_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `WeekDays` varchar(7) NOT NULL COMMENT '1111111:All Days, 1000000:Sunday, 0100000:Monday ..',
  `SetNotification` tinyint(1) NOT NULL,
  `NotificationTime` time NOT NULL,
  `DateCreation` datetime NOT NULL,
  PRIMARY KEY (`r_s_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `vieva_routines_set_by_users` */

/*Table structure for table `vieva_routines_settings` */

DROP TABLE IF EXISTS `vieva_routines_settings`;

CREATE TABLE `vieva_routines_settings` (
  `routine_settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `routine_id` int(11) NOT NULL,
  `routine_type` tinyint(5) NOT NULL COMMENT '0: default routine; 1:user_specified; 2: videos; .... ',
  `routine_info` varchar(250) NOT NULL COMMENT 'can be f.e "1" for video_id=1 ...or "breathing" ...',
  `WeekDays` varchar(7) NOT NULL COMMENT '1111111: everyday; 1000000: sunday; 0100000: monday ...',
  `SetNotification` tinyint(1) NOT NULL,
  `NotificationTime` time NOT NULL,
  `DateCreation` datetime NOT NULL,
  PRIMARY KEY (`routine_settings_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `vieva_routines_settings` */

/*Table structure for table `vieva_self_hypnosis` */

DROP TABLE IF EXISTS `vieva_self_hypnosis`;

CREATE TABLE `vieva_self_hypnosis` (
  `self_hypnosis_id` int(11) NOT NULL AUTO_INCREMENT,
  `title_frensh` varchar(250) NOT NULL,
  `title_english` varchar(250) NOT NULL,
  `description_frensh` text NOT NULL,
  `description_english` text NOT NULL,
  `file_name_frensh` varchar(250) NOT NULL,
  `file_name_english` varchar(250) NOT NULL,
  `user_level` varchar(10) DEFAULT NULL COMMENT '0123456789: all users can see it;\r\n0: only superadmin;\r\n01 : superadmin and admins \r\n..',
  `file_link` text NOT NULL,
  PRIMARY KEY (`self_hypnosis_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `vieva_self_hypnosis` */

insert  into `vieva_self_hypnosis`(`self_hypnosis_id`,`title_frensh`,`title_english`,`description_frensh`,`description_english`,`file_name_frensh`,`file_name_english`,`user_level`,`file_link`) values 
(1,'self hypnosis 1','self hypnosis 1','self hypnosis 1','self hypnosis 1','self hypnosis 1','self hypnosis 1',NULL,''),
(3,'self hypnosis 2','self hypnosis 2','self hypnosis 2','self hypnosis 2','self hypnosis 2','self hypnosis 2',NULL,'2021_01_28-92.mp4'),
(5,'ff','s','ff','ff','ff','ff',NULL,'ff-39.csv');

/*Table structure for table `vieva_series` */

DROP TABLE IF EXISTS `vieva_series`;

CREATE TABLE `vieva_series` (
  `serie_id` int(11) NOT NULL AUTO_INCREMENT,
  `title_frensh` varchar(300) NOT NULL,
  `title_english` varchar(300) NOT NULL,
  `description_frensh` text NOT NULL,
  `description_english` text NOT NULL,
  `picture` varchar(200) NOT NULL DEFAULT 'none',
  `display_order` int(11) DEFAULT NULL COMMENT 'display order',
  PRIMARY KEY (`serie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

/*Data for the table `vieva_series` */

insert  into `vieva_series`(`serie_id`,`title_frensh`,`title_english`,`description_frensh`,`description_english`,`picture`,`display_order`) values 
(15,'first','first','first','first','2020_08_16-95.png',5),
(21,'second','second','This is the second','This is the second','2020_08_27-77.png',4),
(24,'third','third','This is the third','This is the third','2020_08_28-12.png',3);

/*Table structure for table `vieva_series_scheduler` */

DROP TABLE IF EXISTS `vieva_series_scheduler`;

CREATE TABLE `vieva_series_scheduler` (
  `serie_scheduler_id` int(11) NOT NULL AUTO_INCREMENT,
  `order` tinyint(5) NOT NULL,
  `number_released` int(11) NOT NULL DEFAULT 3,
  `frequency` tinyint(5) NOT NULL COMMENT '0:weekly; 1: monthly; ...',
  PRIMARY KEY (`serie_scheduler_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `vieva_series_scheduler` */

/*Table structure for table `vieva_series_settings` */

DROP TABLE IF EXISTS `vieva_series_settings`;

CREATE TABLE `vieva_series_settings` (
  `serie_setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `serie_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `tag1_frensh` varchar(200) NOT NULL,
  `tag1_english` varchar(200) NOT NULL,
  `tag2_frensh` varchar(200) NOT NULL,
  `tag2_english` varchar(200) NOT NULL,
  PRIMARY KEY (`serie_setting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `vieva_series_settings` */

/*Table structure for table `vieva_team_members` */

DROP TABLE IF EXISTS `vieva_team_members`;

CREATE TABLE `vieva_team_members` (
  `team_members_id` int(11) NOT NULL AUTO_INCREMENT,
  `corporate_client_id` int(11) DEFAULT NULL,
  `corporate_group_admin_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`team_members_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

/*Data for the table `vieva_team_members` */

insert  into `vieva_team_members`(`team_members_id`,`corporate_client_id`,`corporate_group_admin_id`,`user_id`) values 
(1,1,8,22),
(2,20,8,36),
(3,21,29,32),
(4,12,29,33),
(5,12,29,25),
(6,1,37,26),
(7,NULL,NULL,37),
(15,12,37,33),
(16,12,37,35),
(21,1,27,21),
(22,21,27,21),
(23,21,27,20),
(24,20,29,35),
(25,1,29,21);

/*Table structure for table `vieva_tools` */

DROP TABLE IF EXISTS `vieva_tools`;

CREATE TABLE `vieva_tools` (
  `tools_id` int(11) NOT NULL AUTO_INCREMENT,
  `tool_type_id` int(11) NOT NULL,
  `tool_type` varchar(200) NOT NULL COMMENT 'self_hypnosis, guided_meditation, breathing_tool, mindfulness_tool',
  `name_frensh` varchar(300) NOT NULL,
  `name_english` varchar(300) NOT NULL,
  `description_frensh` text NOT NULL,
  `description_english` text NOT NULL,
  PRIMARY KEY (`tools_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `vieva_tools` */

insert  into `vieva_tools`(`tools_id`,`tool_type_id`,`tool_type`,`name_frensh`,`name_english`,`description_frensh`,`description_english`) values 
(1,0,'','','Breathing exercisesfdfdfd','','description of : Breathing exercises'),
(2,0,'','Mindfulness','Mindfulness','description of ...','description of ..'),
(3,0,'','','Guided meditation','','description of ..'),
(4,0,'','','Self-hypnosis','','description of Self-hypnosis');

/*Table structure for table `vieva_user_activities_videos` */

DROP TABLE IF EXISTS `vieva_user_activities_videos`;

CREATE TABLE `vieva_user_activities_videos` (
  `activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0:none; 1:Quiz done; 2: challenge accepted; 3: all done',
  `date` date NOT NULL,
  PRIMARY KEY (`activity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `vieva_user_activities_videos` */

insert  into `vieva_user_activities_videos`(`activity_id`,`user_id`,`video_id`,`status`,`date`) values 
(1,32,1,0,'2020-08-24'),
(2,31,2,0,'2020-08-27'),
(3,33,1,0,'2020-08-25'),
(4,32,2,0,'2020-08-21'),
(5,22,1,0,'2020-09-01'),
(6,36,2,0,'2020-09-01'),
(7,40,2,0,'2020-09-01');

/*Table structure for table `vieva_user_activity` */

DROP TABLE IF EXISTS `vieva_user_activity`;

CREATE TABLE `vieva_user_activity` (
  `user_id` int(11) NOT NULL,
  `activity_type` varchar(50) NOT NULL,
  `activity_content` text NOT NULL,
  `activity_datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `vieva_user_activity` */

/*Table structure for table `vieva_user_login_history` */

DROP TABLE IF EXISTS `vieva_user_login_history`;

CREATE TABLE `vieva_user_login_history` (
  `user_id` int(11) NOT NULL,
  `token` varchar(250) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `vieva_user_login_history` */

/*Table structure for table `vieva_user_questions_answers` */

DROP TABLE IF EXISTS `vieva_user_questions_answers`;

CREATE TABLE `vieva_user_questions_answers` (
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `choice_id` int(11) NOT NULL,
  `is_right` tinyint(2) NOT NULL COMMENT '0:no ; 1:yes',
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `vieva_user_questions_answers` */

/*Table structure for table `vieva_users` */

DROP TABLE IF EXISTS `vieva_users`;

CREATE TABLE `vieva_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `user_level` tinyint(5) NOT NULL DEFAULT 4 COMMENT '0: superadmin; 1: admin; 2: corporate_admin; 3: premium_user; 4:free_user; 5: guest; 6: coach; 7: corporate_group_admin; 8:corporate_user',
  `user_status` tinyint(5) NOT NULL DEFAULT 1 COMMENT '0: none; 1:allowed; 2:blocked; 3: deleted',
  `last_login` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_raison` tinyint(5) NOT NULL DEFAULT 0 COMMENT '0: created; 1:verified; 2: blocked; 3: closed; 4: reset password; 5: change profile; 6: other',
  `device_token` varchar(250) NOT NULL DEFAULT '0',
  `sponsore_id` int(11) NOT NULL DEFAULT 1 COMMENT '0: vieva as default for guests, freeusers and premium users',
  `platform` varchar(100) NOT NULL,
  `language` varchar(10) DEFAULT 'french',
  `conncetion_status` varchar(10) DEFAULT 'offline',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;

/*Data for the table `vieva_users` */

insert  into `vieva_users`(`id`,`first_name`,`last_name`,`email`,`password`,`user_level`,`user_status`,`last_login`,`update_raison`,`device_token`,`sponsore_id`,`platform`,`language`,`conncetion_status`) values 
(20,'Super admin','aaa','superadmin@example.com','$2y$10$nJ5T7SVvl/YOwSkoPuJOvOISaAjpi8ssxIIi5WYUi.vReCtVFM9Lm',0,1,'2020-08-15 10:25:55',1,'0',20,'desktop','english','0'),
(22,'cor_admin1','ccc','corporate1@example.com','$2y$10$aobi7Gdh5CwVOSYx5W2RdO4GIUiC0zVAA8GPI7av3IPQZdOhWM48i',2,1,'2020-08-15 10:27:36',0,'0',1,'desktop','french','0'),
(23,'cor_admin2','user1','corporate2@example.com','$2y$10$MXHbLXWsyV0TyNh6LmbZSe5zQNanYLskSKPCMwJJ.aU7EafqI/L2C',2,1,'2020-08-16 21:07:22',0,'0',1,'desktop','french','0'),
(24,'Admin2','user2','admin1@example.com','$2y$10$tJd7li85xAVAWvr/WLwV8.L0ilnQZKUM.nFPDjg9MZexCg04ukBES',1,1,'2020-08-16 21:07:52',0,'0',1,'desktop','french','offline'),
(27,'teamadmin1','teamadmin1','teamadmin@example.com','$2y$10$bbG04Me8m5bkl9KvOlux.ORHC0cLmDOm4ZAba6fy6KxZwwOjXgena',7,1,'2020-08-17 00:02:29',0,'0',1,'desktop','french','offline'),
(28,'teamadmin2','teamadmin2','dwdw@example.com','$2y$10$2dcF15RO4zilc07Q6YT1KOV.4OVLAyVEKu/YdsZcwlTiBjENHMwVS',7,1,'2020-08-17 05:49:40',0,'0',1,'desktop','french','offline'),
(29,'teamadmin3','teamadmin3','teamadmin1@example.com','$2y$10$dBbKcF46fINdCZiJNu5nAutcxc1qfwDCiMNFknFIBHqWXeplPsnQS',7,1,'2020-08-18 10:45:49',0,'0',1,'desktop','french','offline'),
(32,'member','abc','def@example.com','$2y$10$BR5elob6zH70l0idTxXAKu4PI4NDVaCWKdR1R5Qjuyn2Sx64Utmge',2,1,'2020-09-02 01:42:27',0,'0',1,'desktop','french','offline'),
(33,'cor3','cor3','cor3@example.com','$2y$10$uKGp7fjAyzgBqSlF3Lnvaeozd7.e0vXH9x881llA26YPSZ1dA6wzO',8,1,'2020-08-19 15:40:44',0,'0',3,'desktop','french','offline'),
(34,'cor4','cor4','cor4@example.com','$2y$10$DrTVBPQaZsmyRi.MA8c7A.G2xqeAtwZUgNaTGnblIqjMSCRv1HpXK',8,1,'2020-08-19 15:41:16',0,'0',1,'desktop','french','offline'),
(35,'cor5','cor5','cor5@example.com','$2y$10$K104gE3vcGEyb/2KvWHsnexeRokwEIOfn.trPpAD0fD9erm.iWBQ.',8,1,'2020-08-19 15:41:39',0,'0',1,'desktop','french','offline'),
(36,'teamadmin4','cor6','cor6@example.com','$2y$10$YHXNp4ibeaWzbTTOVCXRKOGPJZYenUZCGpXtapYfYPF/X9gDqdkSq',7,1,'2020-08-19 15:42:03',0,'0',1,'desktop','french','offline'),
(37,'cor7','cor7','cor7@example.com','$2y$10$V4xpgRJhOMagmoTxSOIXJ.W5UJMx3JjCdwfifBb17d9vM4auAmuHe',8,1,'2020-08-19 15:42:26',0,'0',1,'desktop','french','offline'),
(38,'cor8','cor8','cor8@example.com','$2y$10$RNgQZjFjhNNhSl2YvXj6XeJMwRNEHMPbTRb0x3aFfD985Z9Th8Kqq',8,1,'2020-08-19 15:42:54',0,'0',1,'desktop','french','offline'),
(39,'teamadmin6','coach1','coach1@example.com','$2y$10$V1slBAyLSvP7elvZGRjKdewv9SL4ZIjfkF/T7CfmnJjeJhawbPkjm',7,1,'2020-08-27 20:30:42',0,'0',1,'desktop','french','offline'),
(40,'coach2','coach2','coach2@example.com','$2y$10$DwCY.RxWyWap0bPqwSbncufzFnEvR6tdnPxEws9zBdgi/YbFasDOO',6,1,'2020-08-27 20:31:10',0,'0',1,'desktop','french','offline'),
(41,'coach3','coach3','coach3@example.com','$2y$10$fFXlR/0sJYuwJu6hzOKCq.DnjtJW2hzh5DRpsioKSfR4C5Ok6DTRy',6,1,'2020-08-27 20:31:33',0,'0',1,'desktop','french','offline'),
(42,'coach4','coach4','coach4@example.com','$2y$10$KnJDPoETQMymhJ7UO71RYerh.YVcQmGccI9RptYKNs.7n8IDcOGgK',6,1,'2020-08-27 20:31:56',0,'0',1,'desktop','french','offline'),
(43,'dsds','sss','admin2@exmaple.com','$2y$10$KaZMJbEc0Hfpjq9hz0ODL.UoUVkgPKFmzUU2i/X5fFPoMbkQyJuD.',1,1,'2020-08-28 03:08:01',0,'0',1,'desktop','french','offline'),
(46,'person2','person2','person2@example.com','$2y$10$n/uPhM2t89r1fQlX8IxgxOaz9I.sLzA8.lBNzAOwWeYEbfNCMzvaO',8,1,'2020-08-28 21:26:48',0,'0',1,'desktop','french','offline'),
(49,'admin','admin','admin4@example.com','$2y$10$HBSziGVB2uZ.pSAdUIU9w.4M7AvG1F8JEJs0IVLfB/bNSXD9AmzJO',2,0,'2020-09-02 01:42:27',0,'0',1,'mobile','english','offline'),
(52,'teamadmin5','aaa','newteamadmin@example.com','$2y$10$Qo4EH/ODnEO5aKis1xQ7NeuKOjxsxoZPhsIEAKd7wAhx47G3jJcpC',7,1,'2020-09-12 04:27:10',0,'0',1,'desktop','english','offline'),
(53,'any','any','new@example.com','$2y$10$L7sXBy9rBYTlL0ANPDa4RuaDYcYmBnGZg7/TkiRqbM0HM0e3INml2',3,0,'2020-09-13 02:10:08',0,'0',1,'desktop','english','offline'),
(54,'fname','lname','admin@admin.com','$2y$10$HxBnnnbJRYGJ4JD38DB00e2MutnZ18LvnkjPO..0Co0JhsyqXuApa',0,1,'2020-10-28 10:19:36',0,'0',1,'desktop','french','offline'),
(55,'admin','admin','admin@email.com','$2y$10$TWOgMFI1yF/jGSbroU3E1.ghJXFcH5tJnUwPo.6nGyp..GVu7lTHi',0,1,'2021-01-21 08:34:24',0,'0',1,'desktop','french','offline');

/*Table structure for table `vieva_users_challenges` */

DROP TABLE IF EXISTS `vieva_users_challenges`;

CREATE TABLE `vieva_users_challenges` (
  `user_challenge_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `challenge_id` int(11) NOT NULL,
  `accepted` tinyint(1) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`user_challenge_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `vieva_users_challenges` */

insert  into `vieva_users_challenges`(`user_challenge_id`,`user_id`,`challenge_id`,`accepted`,`date`) values 
(1,22,0,1,'2020-08-19 05:51:16'),
(2,24,0,0,'2020-08-12 05:51:19'),
(3,25,0,1,'2020-08-04 05:51:23'),
(4,26,0,1,'2020-08-10 05:51:26'),
(5,27,0,0,'2020-08-17 05:51:30');

/*Table structure for table `vieva_video_comments` */

DROP TABLE IF EXISTS `vieva_video_comments`;

CREATE TABLE `vieva_video_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `likes` tinyint(1) NOT NULL DEFAULT 0,
  `dislikes` tinyint(1) NOT NULL DEFAULT 0,
  `reply_id` int(11) DEFAULT NULL,
  `note` varchar(150) NOT NULL,
  `answer1` text NOT NULL,
  `answer2` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `vieva_video_comments` */

insert  into `vieva_video_comments`(`id`,`user_id`,`video_id`,`comment`,`likes`,`dislikes`,`reply_id`,`note`,`answer1`,`answer2`,`date`) values 
(1,22,3,'aaaaaaaaaa',0,1,NULL,'','','','2020-09-01 22:37:41'),
(2,24,4,'ccccccccccc',0,1,NULL,'','','','2020-09-01 22:37:41'),
(3,25,4,'wwwwwwwwwww',1,0,NULL,'','','','2020-09-01 22:37:41'),
(4,27,4,'eeeeeeeeeeeee',1,0,NULL,'','','','2020-09-01 22:37:41'),
(5,26,3,'rrrrrrrrrr',0,1,NULL,'','','','2020-09-01 22:37:41'),
(6,32,1,'ffffffffff',0,0,NULL,'','','','2020-09-01 22:37:41'),
(7,32,2,'gggggggggggggg',0,0,NULL,'','','','2020-09-01 22:37:41'),
(8,32,1,'eeeeeeeeeeeee',0,0,NULL,'','','','2020-09-01 22:37:41'),
(9,32,3,'',0,0,NULL,'','','','2020-09-01 22:37:41');

/*Table structure for table `vieva_video_favorites` */

DROP TABLE IF EXISTS `vieva_video_favorites`;

CREATE TABLE `vieva_video_favorites` (
  `fav_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  PRIMARY KEY (`fav_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `vieva_video_favorites` */

/*Table structure for table `vieva_video_lessons` */

DROP TABLE IF EXISTS `vieva_video_lessons`;

CREATE TABLE `vieva_video_lessons` (
  `lesson_id` int(11) NOT NULL AUTO_INCREMENT,
  `tools_id` int(11) DEFAULT NULL,
  `serie_id` int(11) NOT NULL,
  `challenge_id` int(11) DEFAULT NULL,
  `coach_id` int(11) NOT NULL,
  `title_frensh` varchar(250) NOT NULL,
  `title_english` varchar(250) NOT NULL,
  `description_frensh` text NOT NULL,
  `description_english` text NOT NULL,
  `video_file` varchar(150) NOT NULL,
  `order_number` int(11) DEFAULT 0,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`lesson_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `vieva_video_lessons` */

insert  into `vieva_video_lessons`(`lesson_id`,`tools_id`,`serie_id`,`challenge_id`,`coach_id`,`title_frensh`,`title_english`,`description_frensh`,`description_english`,`video_file`,`order_number`,`date_creation`) values 
(7,1,24,1,41,'The first lesson','The first lessons','This is the first lesson','This is the first lesson','2020-08-27_120.mp4',1,'2020-11-19 15:22:15'),
(9,1,24,NULL,0,'The second lesson','The second lesson','This is the second lesson','This is the second lesson','2020-08-27_132.mp4',3,'2020-11-19 15:08:03'),
(11,NULL,1,NULL,0,'The third lesson','The third lesson','This is the third lesson','This is the third lesson','2020-08-28_198.mp4',2,'2020-08-28 12:26:47'),
(12,2,21,NULL,0,'The fourth lesson','The fourth lesson','The fourth lesson','The fourth lesson','2020-10-30_156.avi',4,'2020-10-30 17:35:46'),
(13,3,21,3,0,'The fifth lesson','The fifth lesson','fdsa','fdsa','2020-11-02_105.webm',5,'2020-11-02 16:15:15'),
(14,3,24,3,0,'The sixth lesson','The sixth lesson','The sixth lesson','The sixth lesson','2020-11-19_132.webm',6,'2020-11-19 15:13:09');

/*Table structure for table `vieva_video_lessons_settings` */

DROP TABLE IF EXISTS `vieva_video_lessons_settings`;

CREATE TABLE `vieva_video_lessons_settings` (
  `settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `video_id` int(11) DEFAULT NULL,
  `user_level` varchar(10) DEFAULT NULL COMMENT '0123456789: all users can see it;\r\n0: only superadmin;\r\n01 : superadmin and admins \r\n..',
  `challenge_id` int(11) DEFAULT NULL,
  `order_number` int(11) DEFAULT NULL,
  `starting_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'when the video will be  available for the users',
  `ending_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'when the video will be hidden for the users.',
  PRIMARY KEY (`settings_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `vieva_video_lessons_settings` */

/*Table structure for table `vieva_video_likes` */

DROP TABLE IF EXISTS `vieva_video_likes`;

CREATE TABLE `vieva_video_likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `likes` int(11) DEFAULT 0,
  `dislikes` int(11) DEFAULT 0,
  `video_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `vieva_video_likes` */

insert  into `vieva_video_likes`(`id`,`user_id`,`likes`,`dislikes`,`video_id`,`date`) values 
(1,22,0,0,4,'2020-08-26 01:53:48'),
(2,20,1,1,4,'2020-08-26 01:53:54'),
(3,25,1,0,3,'2020-08-26 01:53:59'),
(4,20,1,1,3,'2020-08-26 01:54:04'),
(5,27,1,0,3,'2020-08-26 01:54:10'),
(6,36,1,0,3,'2020-08-26 01:54:15'),
(7,32,0,1,1,'2020-08-26 01:54:22'),
(8,32,0,1,2,'2020-08-26 01:54:28'),
(9,32,1,0,3,'2020-08-26 01:54:34'),
(10,32,0,0,2,'2020-08-26 01:54:43'),
(11,37,0,0,2,'2020-09-02 01:21:58');

/*Table structure for table `vieva_videos_challenges` */

DROP TABLE IF EXISTS `vieva_videos_challenges`;

CREATE TABLE `vieva_videos_challenges` (
  `video_challenge_id` int(11) NOT NULL AUTO_INCREMENT,
  `video_id` int(11) NOT NULL,
  `challenge_id` int(11) NOT NULL,
  PRIMARY KEY (`video_challenge_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `vieva_videos_challenges` */

/*Table structure for table `vieva_week_progress` */

DROP TABLE IF EXISTS `vieva_week_progress`;

CREATE TABLE `vieva_week_progress` (
  `progress_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `stress_level` tinyint(3) NOT NULL COMMENT '0:low, 1:moderate, 2:high',
  `workload_level` tinyint(3) NOT NULL COMMENT '0:low, 1:moderate, 2:high',
  `energy_level` tinyint(3) NOT NULL COMMENT '0:low, 1:moderate, 2:high',
  `highlight_of_week` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`progress_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `vieva_week_progress` */

insert  into `vieva_week_progress`(`progress_id`,`user_id`,`stress_level`,`workload_level`,`energy_level`,`highlight_of_week`,`date`) values 
(1,22,0,1,2,'dfdf','2020-08-10 05:05:16'),
(2,23,2,2,2,'fdddd','2020-08-19 05:05:22'),
(3,24,1,1,0,'aaaaaaaa','2020-08-20 05:06:19'),
(4,24,5,2,0,'dddddddd','2020-07-08 05:06:41'),
(5,26,1,2,0,'cccccccccc','2020-07-23 05:07:01'),
(6,32,2,1,2,'rrrrrrrrrrrrrrrrr','2020-09-01 01:46:17'),
(7,33,3,2,3,'33333333333333','2020-09-01 01:46:46'),
(8,20,2,3,2,'hhhhhhhhhhhhhhhhh','2020-09-01 01:46:48'),
(9,21,2,1,2,'jjjjjjjjjj','2020-09-01 19:20:37'),
(10,38,3,2,3,'yyyyyyyyyy','2020-09-01 19:20:41'),
(11,20,4,3,1,'uuuuuu','2020-09-01 19:20:43'),
(12,21,5,2,3,'kkkkkkkkkk','2020-09-01 19:20:44');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
