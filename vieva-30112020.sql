-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 30, 2020 at 10:21 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vieva`
--

-- --------------------------------------------------------

--
-- Table structure for table `vieva_all_checks`
--

CREATE TABLE `vieva_all_checks` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `checks_type` tinyint(3) UNSIGNED NOT NULL COMMENT '0: weekly, 1: monthly',
  `score` int(10) UNSIGNED NOT NULL,
  `percent` int(10) UNSIGNED NOT NULL,
  `check_datetime` timestamp NOT NULL DEFAULT current_timestamp(),
  `QA1` tinyint(4) NOT NULL,
  `QA2` tinyint(4) NOT NULL,
  `QA3` tinyint(4) NOT NULL,
  `QA4` tinyint(4) NOT NULL,
  `QA5` tinyint(4) NOT NULL,
  `QA6` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vieva_all_checks`
--

INSERT INTO `vieva_all_checks` (`id`, `user_id`, `checks_type`, `score`, `percent`, `check_datetime`, `QA1`, `QA2`, `QA3`, `QA4`, `QA5`, `QA6`) VALUES
(1, 23, 0, 75, 57, '2020-08-22 11:52:04', 0, 1, 2, 2, 1, 'false,true,false,false,true,false'),
(2, 32, 1, 16, 34, '2020-08-24 12:29:03', 2, 5, 4, 2, 0, 'true,true,true,false,false,true'),
(3, 34, 1, 23, 50, '2020-08-31 19:11:23', 4, 3, 1, 3, 3, 'false,false,false,false,false,true'),
(4, 35, 1, 23, 30, '2020-08-04 19:13:18', 5, 3, 2, 4, 3, 'true,true,false,false,true,true'),
(5, 36, 1, 43, 87, '2020-08-12 19:13:23', 3, 3, 3, 5, 3, 'false,true,false,true,true,false'),
(6, 37, 1, 34, 56, '2020-08-21 19:13:26', 2, 3, 4, 2, 3, 'true,true,true,false,true,false'),
(7, 38, 1, 23, 87, '2020-08-29 19:13:29', 3, 4, 4, 1, 3, 'false,false,false,true,false,false'),
(8, 33, 1, 54, 24, '2020-08-30 19:13:32', 4, 3, 3, 3, 3, 'true,true,true,true,false,false');

-- --------------------------------------------------------

--
-- Table structure for table `vieva_breathing_tool`
--

CREATE TABLE `vieva_breathing_tool` (
  `id` int(11) NOT NULL,
  `title_in_english` varchar(50) CHARACTER SET utf8 NOT NULL,
  `title_in_french` varchar(50) CHARACTER SET utf8 NOT NULL,
  `breathe_in` int(11) NOT NULL,
  `hold1` int(11) NOT NULL,
  `breathe_out` int(11) NOT NULL,
  `hold2` int(11) DEFAULT NULL,
  `locked` tinyint(4) NOT NULL COMMENT '0: unlocked, 1: locked',
  `user_level` varchar(10) DEFAULT NULL COMMENT '0123456789: all users can see it;\r\n0: only superadmin;\r\n01 : superadmin and admins \r\n..'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vieva_breathing_tool`
--

INSERT INTO `vieva_breathing_tool` (`id`, `title_in_english`, `title_in_french`, `breathe_in`, `hold1`, `breathe_out`, `hold2`, `locked`, `user_level`) VALUES
(2, 'breathing tool 2', 'breathing tool 2', 2, 2, 2, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vieva_categories_series`
--

CREATE TABLE `vieva_categories_series` (
  `category_id` int(11) NOT NULL,
  `category_frensh` varchar(200) NOT NULL,
  `category_english` varchar(200) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vieva_challenges`
--

CREATE TABLE `vieva_challenges` (
  `challenge_id` int(11) NOT NULL,
  `name_frensh` varchar(200) NOT NULL,
  `name_english` varchar(200) NOT NULL,
  `description_frensh` varchar(200) NOT NULL,
  `description_english` varchar(200) NOT NULL,
  `icon` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vieva_challenges`
--

INSERT INTO `vieva_challenges` (`challenge_id`, `name_frensh`, `name_english`, `description_frensh`, `description_english`, `icon`) VALUES
(1, 'french name 1', 'edited english name 1', 'french description 1', 'english description 1', 'icon'),
(3, 'test', 'test', 'test', 'test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `vieva_coaching_reports`
--

CREATE TABLE `vieva_coaching_reports` (
  `report_id` int(11) NOT NULL,
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
  `client_feedbck` tinyint(5) NOT NULL COMMENT '1: much better; 2:better ; 3:about the same; 4:worse; 5:much worse'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vieva_coaching_reports`
--

INSERT INTO `vieva_coaching_reports` (`report_id`, `duration`, `session_date`, `motif_seance_id`, `rating`, `coach_name`, `user_first_name`, `user_last_name`, `user_email`, `user_id`, `language`, `note`, `report_date`, `status`, `client_feedbck`) VALUES
(21, 1, '2020-10-20', 2, 5, 'coach3', 'cor3', 'cor3', 'cor3@example.com', 0, 1, 'This is note', '2020-10-08 02:14:53', 2, 2),
(22, 2, '2020-10-23', 3, 3, 'coach3', 'cor3', 'cor3', 'cor3@example.com', 41, 1, 'fffff', '2020-10-31 07:43:36', 1, 1),
(35, 1, '2020-10-20', 1, 2, 'coach3', 'cor3', 'cor3', 'cor3@example.com', 0, 1, 'This is note', '2020-10-31 07:43:26', 2, 2),
(36, 2, '2020-10-20', 2, 4, 'coach3', 'cor2', 'cor2', 'cor3@example.com', 0, 2, 'This is note', '2020-10-07 19:14:53', 4, 5),
(37, 2, '2020-10-20', 3, 4, 'coach3', 'cor4', 'cor4', 'cor3@example.com', 0, 2, 'This is note', '2020-10-07 19:14:53', 2, 3),
(38, 2, '2020-10-20', 3, 5, 'coach3', 'cor5', 'cor5', 'cor3@example.com', 0, 1, 'This is note', '2020-10-07 19:14:53', 1, 5),
(39, 1, '2020-10-20', 4, 5, 'coach3', 'cor6', 'cor6', 'cor3@example.com', 0, 2, 'This is note', '2020-10-07 19:14:53', 3, 2),
(40, 2, '2020-10-20', 1, 5, 'coach3', 'cor7', 'cor7', 'cor3@example.com', 0, 1, 'This is note', '2020-10-07 19:14:53', 2, 2),
(41, 1, '2020-10-20', 2, 3, 'coach3', 'cor8', 'cor8', 'cor3@example.com', 0, 1, 'This is note', '2020-10-07 19:14:53', 4, 4),
(42, 2, '2020-10-20', 2, 3, 'coach3', 'cor9', 'cor9', 'cor3@example.com', 0, 1, 'This is note', '2020-10-07 19:14:53', 2, 4),
(43, 1, '2020-10-20', 3, 5, 'coach3', 'cor10', 'cor10', 'cor3@example.com', 0, 1, 'This is note', '2020-10-07 19:14:53', 3, 2),
(44, 1, '2020-10-20', 2, 2, 'coach3', 'cor11', 'cor11', 'cor3@example.com', 0, 2, 'This is note', '2020-10-07 19:14:53', 1, 5),
(45, 2, '2020-10-20', 1, 3, 'coach3', 'cor12', 'cor12', 'cor3@example.com', 0, 2, 'This is note', '2020-10-31 07:43:19', 2, 1),
(46, 2, '2020-10-20', 2, 3, 'coach3', 'cor13', 'cor13', 'cor3@example.com', 0, 1, 'This is note', '2020-10-07 19:14:53', 2, 1),
(47, 1, '2020-10-20', 1, 5, 'coach3', 'cor3', 'cor3', 'cor3@example.com', 0, 1, 'This is note', '2020-10-08 01:14:53', 2, 2),
(48, 2, '2020-10-20', 2, 4, 'coach3', 'cor2', 'cor2', 'cor3@example.com', 0, 2, 'This is note', '2020-10-08 01:14:53', 4, 5),
(49, 2, '2020-10-20', 3, 4, 'coach3', 'cor4', 'cor4', 'cor3@example.com', 0, 2, 'This is note', '2020-10-08 01:14:53', 2, 3),
(50, 2, '2020-10-20', 3, 5, 'coach3', 'cor5', 'cor5', 'cor3@example.com', 0, 1, 'This is note', '2020-10-08 01:14:53', 1, 5),
(51, 1, '2020-10-20', 4, 5, 'coach3', 'cor6', 'cor6', 'cor3@example.com', 0, 2, 'This is note', '2020-10-08 01:14:53', 3, 2),
(52, 2, '2020-10-20', 1, 5, 'coach3', 'cor7', 'cor7', 'cor3@example.com', 0, 1, 'This is note', '2020-10-08 01:14:53', 2, 2),
(53, 1, '2020-10-20', 2, 3, 'coach3', 'cor8', 'cor8', 'cor3@example.com', 0, 1, 'This is note', '2020-10-08 01:14:53', 4, 4),
(54, 2, '2020-10-20', 2, 3, 'coach3', 'cor9', 'cor9', 'cor3@example.com', 0, 1, 'This is note', '2020-10-08 01:14:53', 2, 4),
(55, 1, '2020-10-20', 3, 5, 'coach3', 'cor10', 'cor10', 'cor3@example.com', 0, 1, 'This is note', '2020-10-08 01:14:53', 3, 2),
(56, 1, '2020-10-20', 2, 2, 'coach3', 'cor11', 'cor11', 'cor3@example.com', 0, 2, 'This is note', '2020-10-08 01:14:53', 1, 5),
(57, 2, '2020-10-20', 1, 5, 'coach3', 'cor12', 'cor12', 'cor3@example.com', 0, 2, 'This is note', '2020-10-08 01:14:53', 2, 1),
(58, 2, '2020-10-20', 2, 3, 'coach3', 'cor13', 'cor13', 'cor3@example.com', 0, 1, 'This is note', '2020-10-08 01:14:53', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vieva_coach_info`
--

CREATE TABLE `vieva_coach_info` (
  `coach_id` int(11) NOT NULL,
  `full_name` int(11) NOT NULL,
  `biography_frensh` int(11) NOT NULL,
  `biography_english` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vieva_corporate_clients`
--

CREATE TABLE `vieva_corporate_clients` (
  `corporate_client_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL COMMENT '1: only superadmin',
  `corporate_name` varchar(250) NOT NULL,
  `plan_starting_date` date NOT NULL,
  `plan_expiration_date` date NOT NULL,
  `plattform` varchar(200) NOT NULL DEFAULT 'Web' COMMENT 'for ex: mobile',
  `Number_licences` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vieva_corporate_clients`
--

INSERT INTO `vieva_corporate_clients` (`corporate_client_id`, `admin_id`, `corporate_name`, `plan_starting_date`, `plan_expiration_date`, `plattform`, `Number_licences`) VALUES
(20, 22, 'name1', '2020-10-02', '2020-10-28', 'Web', 33),
(21, 49, 'name2', '2020-10-16', '2020-10-30', 'Web', 3232);

-- --------------------------------------------------------

--
-- Table structure for table `vieva_corporate_clients_settings`
--

CREATE TABLE `vieva_corporate_clients_settings` (
  `settings_id` int(11) NOT NULL,
  `corporate_id` int(11) NOT NULL,
  `number_licences` int(11) DEFAULT NULL,
  `validation_key` varchar(8) DEFAULT NULL,
  `hours` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vieva_corporate_clients_settings`
--

INSERT INTO `vieva_corporate_clients_settings` (`settings_id`, `corporate_id`, `number_licences`, `validation_key`, `hours`) VALUES
(1, 20, NULL, NULL, 3),
(2, 21, NULL, NULL, 43);

-- --------------------------------------------------------

--
-- Table structure for table `vieva_corporate_groups`
--

CREATE TABLE `vieva_corporate_groups` (
  `group_id` int(11) NOT NULL,
  `corporate_client_id` int(11) NOT NULL,
  `group_name` varchar(200) NOT NULL,
  `corporate_group_admin_id` int(11) NOT NULL DEFAULT 1 COMMENT '1: superadmin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vieva_corporate_groups`
--

INSERT INTO `vieva_corporate_groups` (`group_id`, `corporate_client_id`, `group_name`, `corporate_group_admin_id`) VALUES
(3, 1, 'Humain Resources', 8),
(4, 12, 'Marketing', 29),
(6, 1, 'IT department', 27),
(15, 12, 'dddddddddd', 37),
(19, 1, 'sdsds', 29);

-- --------------------------------------------------------

--
-- Table structure for table `vieva_current_users`
--

CREATE TABLE `vieva_current_users` (
  `user_id` int(11) NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vieva_guided_meditation`
--

CREATE TABLE `vieva_guided_meditation` (
  `guided_meditation_id` int(11) NOT NULL,
  `title_frensh` varchar(250) NOT NULL,
  `title_english` varchar(250) NOT NULL,
  `description_frensh` text NOT NULL,
  `description_english` text NOT NULL,
  `file_name_frensh` varchar(250) NOT NULL,
  `file_name_english` varchar(250) NOT NULL,
  `user_level` varchar(10) DEFAULT NULL COMMENT '0123456789: all users can see it;\r\n0: only superadmin;\r\n01 : superadmin and admins \r\n..'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vieva_guided_meditation`
--

INSERT INTO `vieva_guided_meditation` (`guided_meditation_id`, `title_frensh`, `title_english`, `description_frensh`, `description_english`, `file_name_frensh`, `file_name_english`, `user_level`) VALUES
(1, 'Guided Meditation 1', 'Guided Meditation 1', 'Guided Meditation 1', 'Guided Meditation 1', 'Guided Meditation 1', 'Guided Meditation 1', NULL),
(3, 'Guided Meditation 2', 'Guided Meditation 2', 'fdsa', 'fe', 'Guided Meditation 2', 'Guided Meditation 2', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vieva_mindfulness_categories`
--

CREATE TABLE `vieva_mindfulness_categories` (
  `id` int(11) NOT NULL,
  `category_name_in_french` varchar(50) NOT NULL,
  `category_name_in_english` varchar(50) NOT NULL,
  `category_thumbnail` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vieva_mindfulness_categories`
--

INSERT INTO `vieva_mindfulness_categories` (`id`, `category_name_in_french`, `category_name_in_english`, `category_thumbnail`) VALUES
(1, 'OCÉAN', 'Beach', 'uploads/images/beach/thumb.jpg'),
(2, 'FORÊT', 'Forest', 'uploads/images/forest/thumb.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `vieva_mindfulness_tool`
--

CREATE TABLE `vieva_mindfulness_tool` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `image_url` text CHARACTER SET utf8 NOT NULL,
  `sound_link` text CHARACTER SET utf8 DEFAULT NULL,
  `order_number` int(11) DEFAULT NULL,
  `user_level` varchar(10) DEFAULT NULL COMMENT '0123456789: all users can see it;\r\n0: only superadmin;\r\n01 : superadmin and admins \r\n..'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vieva_mindfulness_tool`
--

INSERT INTO `vieva_mindfulness_tool` (`id`, `category_id`, `image_url`, `sound_link`, `order_number`, `user_level`) VALUES
(8, 1, '2020_11_19-51.jpg', '', NULL, NULL),
(7, 1, '2020_11_19-43.png', '2020_11_19-40.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vieva_motif_seance`
--

CREATE TABLE `vieva_motif_seance` (
  `motif_seance_id` int(11) NOT NULL,
  `seance_name` varchar(200) NOT NULL,
  `picture` varchar(200) NOT NULL DEFAULT 'none'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vieva_motif_seance`
--

INSERT INTO `vieva_motif_seance` (`motif_seance_id`, `seance_name`, `picture`) VALUES
(1, 'depression', 'none'),
(2, 'parenting-issues', 'none'),
(3, 'relationship-issues', 'none'),
(4, 'mourning', 'none'),
(5, 'conflicts', 'none'),
(6, 'self_confidence', 'none'),
(7, 'addictions', 'none'),
(8, 'others', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `vieva_notifications`
--

CREATE TABLE `vieva_notifications` (
  `notification_id` int(11) NOT NULL,
  `notification_name` varchar(250) NOT NULL COMMENT 'for admin management purposes',
  `content_frensh` text NOT NULL,
  `content_english` text NOT NULL,
  `date` datetime NOT NULL,
  `target` tinyint(5) NOT NULL COMMENT '0:freeuser & guests, 1:premium_user, 2:corporate_client, 9:all',
  `target_id` int(11) NOT NULL DEFAULT -1 COMMENT '-1 means for example if we have target=0 and target_id= -1 so the notification will be sent to all freeusers and guests'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vieva_notifications`
--

INSERT INTO `vieva_notifications` (`notification_id`, `notification_name`, `content_frensh`, `content_english`, `date`, `target`, `target_id`) VALUES
(4, 'aaa', 'This is a notification', 'This is a notification', '2020-10-08 03:47:06', 9, -1);

-- --------------------------------------------------------

--
-- Table structure for table `vieva_notification_listing`
--

CREATE TABLE `vieva_notification_listing` (
  `listing_id` int(11) NOT NULL,
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `status` tinyint(2) NOT NULL COMMENT '0:unread , 1:read'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vieva_notification_listing`
--

INSERT INTO `vieva_notification_listing` (`listing_id`, `notification_id`, `user_id`, `timestamp`, `status`) VALUES
(4, 4, 20, '2020-10-08 03:47:06', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vieva_premium_payment_plans`
--

CREATE TABLE `vieva_premium_payment_plans` (
  `plan_id` int(11) NOT NULL,
  `title_frensh` varchar(250) NOT NULL,
  `title_english` varchar(250) NOT NULL,
  `price` int(11) NOT NULL,
  `description_frensh` text NOT NULL,
  `description_english` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vieva_premium_payment_plans`
--

INSERT INTO `vieva_premium_payment_plans` (`plan_id`, `title_frensh`, `title_english`, `price`, `description_frensh`, `description_english`) VALUES
(1, 'paiement mensuel', 'monthly ', 99, 'paiement mensuel pour les utilisateurs \"premium user\".', 'monthly payment for premium users.'),
(2, 'annuel', 'yearly', 899, 'paiement annuel pour les utilisateurs \"premium user\".', 'yearly payment for premium users.');

-- --------------------------------------------------------

--
-- Table structure for table `vieva_questions`
--

CREATE TABLE `vieva_questions` (
  `question_id` int(11) NOT NULL,
  `question` varchar(350) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `language` tinyint(4) NOT NULL COMMENT '0: frensh ; 1: english',
  `lesson_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vieva_questions`
--

INSERT INTO `vieva_questions` (`question_id`, `question`, `is_active`, `language`, `lesson_id`) VALUES
(1, 'question13', 1, 1, 11),
(2, 'question2', 1, 1, NULL),
(4, 'question22', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vieva_questions_possible_choices`
--

CREATE TABLE `vieva_questions_possible_choices` (
  `choice_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `choice` varchar(340) NOT NULL,
  `is_right_choice` tinyint(4) NOT NULL COMMENT '0: no ; 1: yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vieva_questions_possible_choices`
--

INSERT INTO `vieva_questions_possible_choices` (`choice_id`, `question_id`, `choice`, `is_right_choice`) VALUES
(1, 1, 'choice 1', 1),
(2, 2, 'choice 12', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vieva_quotes`
--

CREATE TABLE `vieva_quotes` (
  `quote_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `language` tinyint(2) NOT NULL COMMENT '0: frensh ; 1: english',
  `video_id` int(11) NOT NULL,
  `Author` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vieva_quotes`
--

INSERT INTO `vieva_quotes` (`quote_id`, `content`, `language`, `video_id`, `Author`) VALUES
(8, 'This is a new quote', 1, 9, 'coach2'),
(9, 'another quote', 0, 11, 'coach3'),
(10, 'sds', 1, 9, 'bbb'),
(11, 'This is a update quote', 0, 9, 'Dropdown');

-- --------------------------------------------------------

--
-- Table structure for table `vieva_quote_likes`
--

CREATE TABLE `vieva_quote_likes` (
  `id` int(111) NOT NULL,
  `quote_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vieva_quote_video_related`
--

CREATE TABLE `vieva_quote_video_related` (
  `quote_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vieva_routines`
--

CREATE TABLE `vieva_routines` (
  `routine_id` int(11) NOT NULL,
  `name_frensh` varchar(250) NOT NULL,
  `name_english` varchar(250) NOT NULL,
  `description_frensh` text NOT NULL,
  `description_english` text NOT NULL,
  `icon` varchar(100) NOT NULL DEFAULT 'none'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vieva_routines`
--

INSERT INTO `vieva_routines` (`routine_id`, `name_frensh`, `name_english`, `description_frensh`, `description_english`, `icon`) VALUES
(1, 'Focus', 'Focus', '', '', 'none'),
(2, 'Conscious breathing', 'conscious breathing', '', '', 'none'),
(3, 'Meditate ', 'Meditate', '', '', 'none'),
(4, 'Call my parents', 'Call my parents', '', '', 'none'),
(5, 'Journaling', 'Journaling', '', '', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `vieva_routines_settings`
--

CREATE TABLE `vieva_routines_settings` (
  `routine_settings_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `routine_id` int(11) NOT NULL,
  `routine_type` tinyint(5) NOT NULL COMMENT '0: default routine; 1:user_specified; 2: videos; .... ',
  `routine_info` varchar(250) NOT NULL COMMENT 'can be f.e "1" for video_id=1 ...or "breathing" ...',
  `WeekDays` varchar(7) NOT NULL COMMENT '1111111: everyday; 1000000: sunday; 0100000: monday ...',
  `SetNotification` tinyint(1) NOT NULL,
  `NotificationTime` time NOT NULL,
  `DateCreation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vieva_routines_set_by_users`
--

CREATE TABLE `vieva_routines_set_by_users` (
  `r_s_user_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `WeekDays` varchar(7) NOT NULL COMMENT '1111111:All Days, 1000000:Sunday, 0100000:Monday ..',
  `SetNotification` tinyint(1) NOT NULL,
  `NotificationTime` time NOT NULL,
  `DateCreation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vieva_routine_checked`
--

CREATE TABLE `vieva_routine_checked` (
  `routine_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `RoutineType` tinyint(2) NOT NULL COMMENT '0: default routine; 1: user_specified routine',
  `checked` tinyint(1) NOT NULL,
  `Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vieva_self_hypnosis`
--

CREATE TABLE `vieva_self_hypnosis` (
  `self_hypnosis_id` int(11) NOT NULL,
  `title_frensh` varchar(250) NOT NULL,
  `title_english` varchar(250) NOT NULL,
  `description_frensh` text NOT NULL,
  `description_english` text NOT NULL,
  `file_name_frensh` varchar(250) NOT NULL,
  `file_name_english` varchar(250) NOT NULL,
  `user_level` varchar(10) DEFAULT NULL COMMENT '0123456789: all users can see it;\r\n0: only superadmin;\r\n01 : superadmin and admins \r\n..'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vieva_self_hypnosis`
--

INSERT INTO `vieva_self_hypnosis` (`self_hypnosis_id`, `title_frensh`, `title_english`, `description_frensh`, `description_english`, `file_name_frensh`, `file_name_english`, `user_level`) VALUES
(1, 'self hypnosis 1', 'self hypnosis 1', 'self hypnosis 1', 'self hypnosis 1', 'self hypnosis 1', 'self hypnosis 1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vieva_series`
--

CREATE TABLE `vieva_series` (
  `serie_id` int(11) NOT NULL,
  `title_frensh` varchar(300) NOT NULL,
  `title_english` varchar(300) NOT NULL,
  `description_frensh` text NOT NULL,
  `description_english` text NOT NULL,
  `picture` varchar(200) NOT NULL DEFAULT 'none',
  `display_order` int(11) DEFAULT NULL COMMENT 'display order'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vieva_series`
--

INSERT INTO `vieva_series` (`serie_id`, `title_frensh`, `title_english`, `description_frensh`, `description_english`, `picture`, `display_order`) VALUES
(15, 'first', 'first', 'first', 'first', '2020_08_16-95.png', 5),
(21, 'second', 'second', 'This is the second', 'This is the second', '2020_08_27-77.png', 4),
(24, 'third', 'third', 'This is the third', 'This is the third', '2020_08_28-12.png', 3);

-- --------------------------------------------------------

--
-- Table structure for table `vieva_series_scheduler`
--

CREATE TABLE `vieva_series_scheduler` (
  `serie_scheduler_id` int(11) NOT NULL,
  `order` tinyint(5) NOT NULL,
  `number_released` int(11) NOT NULL DEFAULT 3,
  `frequency` tinyint(5) NOT NULL COMMENT '0:weekly; 1: monthly; ...'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vieva_series_settings`
--

CREATE TABLE `vieva_series_settings` (
  `serie_setting_id` int(11) NOT NULL,
  `serie_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `tag1_frensh` varchar(200) NOT NULL,
  `tag1_english` varchar(200) NOT NULL,
  `tag2_frensh` varchar(200) NOT NULL,
  `tag2_english` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vieva_team_members`
--

CREATE TABLE `vieva_team_members` (
  `team_members_id` int(11) NOT NULL,
  `corporate_client_id` int(11) DEFAULT NULL,
  `corporate_group_admin_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vieva_team_members`
--

INSERT INTO `vieva_team_members` (`team_members_id`, `corporate_client_id`, `corporate_group_admin_id`, `user_id`) VALUES
(1, 1, 8, 22),
(2, 20, 8, 36),
(3, 21, 29, 32),
(4, 12, 29, 33),
(5, 12, 29, 25),
(6, 1, 37, 26),
(7, NULL, NULL, 37),
(15, 12, 37, 33),
(16, 12, 37, 35),
(21, 1, 27, 21),
(22, 21, 27, 21),
(23, 21, 27, 20),
(24, 20, 29, 35),
(25, 1, 29, 21);

-- --------------------------------------------------------

--
-- Table structure for table `vieva_tools`
--

CREATE TABLE `vieva_tools` (
  `tools_id` int(11) NOT NULL,
  `tool_type_id` int(11) NOT NULL,
  `tool_type` varchar(200) NOT NULL COMMENT 'self_hypnosis, guided_meditation, breathing_tool, mindfulness_tool',
  `name_frensh` varchar(300) NOT NULL,
  `name_english` varchar(300) NOT NULL,
  `description_frensh` text NOT NULL,
  `description_english` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vieva_tools`
--

INSERT INTO `vieva_tools` (`tools_id`, `tool_type_id`, `tool_type`, `name_frensh`, `name_english`, `description_frensh`, `description_english`) VALUES
(1, 0, '', '', 'Breathing exercisesfdfdfd', '', 'description of : Breathing exercises'),
(2, 0, '', 'Mindfulness', 'Mindfulness', 'description of ...', 'description of ..'),
(3, 0, '', '', 'Guided meditationssds', '', 'description of ..'),
(4, 0, '', '', 'Self-hypnosis', '', 'description of Self-hypnosis');

-- --------------------------------------------------------

--
-- Table structure for table `vieva_users`
--

CREATE TABLE `vieva_users` (
  `id` int(11) NOT NULL,
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
  `conncetion_status` varchar(10) DEFAULT 'offline'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vieva_users`
--

INSERT INTO `vieva_users` (`id`, `first_name`, `last_name`, `email`, `password`, `user_level`, `user_status`, `last_login`, `update_raison`, `device_token`, `sponsore_id`, `platform`, `language`, `conncetion_status`) VALUES
(20, 'Super admin', 'aaa', 'superadmin@example.com', '$2y$10$nJ5T7SVvl/YOwSkoPuJOvOISaAjpi8ssxIIi5WYUi.vReCtVFM9Lm', 0, 1, '2020-08-15 03:25:55', 0, '0', 1, 'desktop', 'english', '0'),
(22, 'cor_admin1', 'ccc', 'corporate1@example.com', '$2y$10$aobi7Gdh5CwVOSYx5W2RdO4GIUiC0zVAA8GPI7av3IPQZdOhWM48i', 2, 1, '2020-08-15 03:27:36', 0, '0', 1, 'desktop', 'french', '0'),
(23, 'cor_admin2', 'user1', 'corporate2@example.com', '$2y$10$MXHbLXWsyV0TyNh6LmbZSe5zQNanYLskSKPCMwJJ.aU7EafqI/L2C', 2, 1, '2020-08-16 14:07:22', 0, '0', 1, 'desktop', 'french', '0'),
(24, 'Admin2', 'user2', 'admin1@example.com', '$2y$10$tJd7li85xAVAWvr/WLwV8.L0ilnQZKUM.nFPDjg9MZexCg04ukBES', 1, 1, '2020-08-16 14:07:52', 0, '0', 1, 'desktop', 'french', 'offline'),
(27, 'teamadmin1', 'teamadmin1', 'teamadmin@example.com', '$2y$10$bbG04Me8m5bkl9KvOlux.ORHC0cLmDOm4ZAba6fy6KxZwwOjXgena', 7, 1, '2020-08-16 17:02:29', 0, '0', 1, 'desktop', 'french', 'offline'),
(28, 'teamadmin2', 'teamadmin2', 'dwdw@example.com', '$2y$10$2dcF15RO4zilc07Q6YT1KOV.4OVLAyVEKu/YdsZcwlTiBjENHMwVS', 7, 1, '2020-08-16 22:49:40', 0, '0', 1, 'desktop', 'french', 'offline'),
(29, 'teamadmin3', 'teamadmin3', 'teamadmin1@example.com', '$2y$10$dBbKcF46fINdCZiJNu5nAutcxc1qfwDCiMNFknFIBHqWXeplPsnQS', 7, 1, '2020-08-18 03:45:49', 0, '0', 1, 'desktop', 'french', 'offline'),
(32, 'member', 'abc', 'def@example.com', '$2y$10$BR5elob6zH70l0idTxXAKu4PI4NDVaCWKdR1R5Qjuyn2Sx64Utmge', 2, 1, '2020-09-01 18:42:27', 0, '0', 1, 'desktop', 'french', 'offline'),
(33, 'cor3', 'cor3', 'cor3@example.com', '$2y$10$uKGp7fjAyzgBqSlF3Lnvaeozd7.e0vXH9x881llA26YPSZ1dA6wzO', 8, 1, '2020-08-19 08:40:44', 0, '0', 3, 'desktop', 'french', 'offline'),
(34, 'cor4', 'cor4', 'cor4@example.com', '$2y$10$DrTVBPQaZsmyRi.MA8c7A.G2xqeAtwZUgNaTGnblIqjMSCRv1HpXK', 8, 1, '2020-08-19 08:41:16', 0, '0', 1, 'desktop', 'french', 'offline'),
(35, 'cor5', 'cor5', 'cor5@example.com', '$2y$10$K104gE3vcGEyb/2KvWHsnexeRokwEIOfn.trPpAD0fD9erm.iWBQ.', 8, 1, '2020-08-19 08:41:39', 0, '0', 1, 'desktop', 'french', 'offline'),
(36, 'teamadmin4', 'cor6', 'cor6@example.com', '$2y$10$YHXNp4ibeaWzbTTOVCXRKOGPJZYenUZCGpXtapYfYPF/X9gDqdkSq', 7, 1, '2020-08-19 08:42:03', 0, '0', 1, 'desktop', 'french', 'offline'),
(37, 'cor7', 'cor7', 'cor7@example.com', '$2y$10$V4xpgRJhOMagmoTxSOIXJ.W5UJMx3JjCdwfifBb17d9vM4auAmuHe', 8, 1, '2020-08-19 08:42:26', 0, '0', 1, 'desktop', 'french', 'offline'),
(38, 'cor8', 'cor8', 'cor8@example.com', '$2y$10$RNgQZjFjhNNhSl2YvXj6XeJMwRNEHMPbTRb0x3aFfD985Z9Th8Kqq', 8, 1, '2020-08-19 08:42:54', 0, '0', 1, 'desktop', 'french', 'offline'),
(39, 'teamadmin6', 'coach1', 'coach1@example.com', '$2y$10$V1slBAyLSvP7elvZGRjKdewv9SL4ZIjfkF/T7CfmnJjeJhawbPkjm', 7, 1, '2020-08-27 13:30:42', 0, '0', 1, 'desktop', 'french', 'offline'),
(40, 'coach2', 'coach2', 'coach2@example.com', '$2y$10$DwCY.RxWyWap0bPqwSbncufzFnEvR6tdnPxEws9zBdgi/YbFasDOO', 6, 1, '2020-08-27 13:31:10', 0, '0', 1, 'desktop', 'french', 'offline'),
(41, 'coach3', 'coach3', 'coach3@example.com', '$2y$10$fFXlR/0sJYuwJu6hzOKCq.DnjtJW2hzh5DRpsioKSfR4C5Ok6DTRy', 6, 1, '2020-08-27 13:31:33', 0, '0', 1, 'desktop', 'french', 'offline'),
(42, 'coach4', 'coach4', 'coach4@example.com', '$2y$10$KnJDPoETQMymhJ7UO71RYerh.YVcQmGccI9RptYKNs.7n8IDcOGgK', 6, 1, '2020-08-27 13:31:56', 0, '0', 1, 'desktop', 'french', 'offline'),
(43, 'dsds', 'sss', 'admin2@exmaple.com', '$2y$10$KaZMJbEc0Hfpjq9hz0ODL.UoUVkgPKFmzUU2i/X5fFPoMbkQyJuD.', 1, 1, '2020-08-27 20:08:01', 0, '0', 1, 'desktop', 'french', 'offline'),
(46, 'person2', 'person2', 'person2@example.com', '$2y$10$n/uPhM2t89r1fQlX8IxgxOaz9I.sLzA8.lBNzAOwWeYEbfNCMzvaO', 8, 1, '2020-08-28 14:26:48', 0, '0', 1, 'desktop', 'french', 'offline'),
(49, 'admin', 'admin', 'admin4@example.com', '$2y$10$HBSziGVB2uZ.pSAdUIU9w.4M7AvG1F8JEJs0IVLfB/bNSXD9AmzJO', 2, 0, '2020-09-01 18:42:27', 0, '0', 1, 'mobile', 'english', 'offline'),
(52, 'teamadmin5', 'aaa', 'newteamadmin@example.com', '$2y$10$Qo4EH/ODnEO5aKis1xQ7NeuKOjxsxoZPhsIEAKd7wAhx47G3jJcpC', 7, 1, '2020-09-11 21:27:10', 0, '0', 1, 'desktop', 'english', 'offline'),
(53, 'any', 'any', 'new@example.com', '$2y$10$L7sXBy9rBYTlL0ANPDa4RuaDYcYmBnGZg7/TkiRqbM0HM0e3INml2', 3, 0, '2020-09-12 19:10:08', 0, '0', 1, 'desktop', 'english', 'offline'),
(54, 'fname', 'lname', 'admin@admin.com', '$2y$10$HxBnnnbJRYGJ4JD38DB00e2MutnZ18LvnkjPO..0Co0JhsyqXuApa', 0, 1, '2020-10-28 03:19:36', 0, '0', 1, 'desktop', 'french', 'offline');

-- --------------------------------------------------------

--
-- Table structure for table `vieva_users_challenges`
--

CREATE TABLE `vieva_users_challenges` (
  `user_challenge_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `challenge_id` int(11) NOT NULL,
  `accepted` tinyint(1) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vieva_users_challenges`
--

INSERT INTO `vieva_users_challenges` (`user_challenge_id`, `user_id`, `challenge_id`, `accepted`, `date`) VALUES
(1, 22, 0, 1, '2020-08-19 05:51:16'),
(2, 24, 0, 0, '2020-08-12 05:51:19'),
(3, 25, 0, 1, '2020-08-04 05:51:23'),
(4, 26, 0, 1, '2020-08-10 05:51:26'),
(5, 27, 0, 0, '2020-08-17 05:51:30');

-- --------------------------------------------------------

--
-- Table structure for table `vieva_user_activities_videos`
--

CREATE TABLE `vieva_user_activities_videos` (
  `activity_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0:none; 1:Quiz done; 2: challenge accepted; 3: all done',
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vieva_user_activities_videos`
--

INSERT INTO `vieva_user_activities_videos` (`activity_id`, `user_id`, `video_id`, `status`, `date`) VALUES
(1, 32, 1, 0, '2020-08-24'),
(2, 31, 2, 0, '2020-08-27'),
(3, 33, 1, 0, '2020-08-25'),
(4, 32, 2, 0, '2020-08-21'),
(5, 22, 1, 0, '2020-09-01'),
(6, 36, 2, 0, '2020-09-01'),
(7, 40, 2, 0, '2020-09-01');

-- --------------------------------------------------------

--
-- Table structure for table `vieva_user_activity`
--

CREATE TABLE `vieva_user_activity` (
  `user_id` int(11) NOT NULL,
  `activity_type` varchar(50) NOT NULL,
  `activity_content` text NOT NULL,
  `activity_datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vieva_user_login_history`
--

CREATE TABLE `vieva_user_login_history` (
  `user_id` int(11) NOT NULL,
  `token` varchar(250) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vieva_user_questions_answers`
--

CREATE TABLE `vieva_user_questions_answers` (
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `choice_id` int(11) NOT NULL,
  `is_right` tinyint(2) NOT NULL COMMENT '0:no ; 1:yes',
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vieva_videos_challenges`
--

CREATE TABLE `vieva_videos_challenges` (
  `video_challenge_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `challenge_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vieva_video_comments`
--

CREATE TABLE `vieva_video_comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `likes` tinyint(1) NOT NULL DEFAULT 0,
  `dislikes` tinyint(1) NOT NULL DEFAULT 0,
  `reply_id` int(11) DEFAULT NULL,
  `note` varchar(150) NOT NULL,
  `answer1` text NOT NULL,
  `answer2` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vieva_video_comments`
--

INSERT INTO `vieva_video_comments` (`id`, `user_id`, `video_id`, `comment`, `likes`, `dislikes`, `reply_id`, `note`, `answer1`, `answer2`, `date`) VALUES
(1, 22, 3, 'aaaaaaaaaa', 0, 1, NULL, '', '', '', '2020-09-01 22:37:41'),
(2, 24, 4, 'ccccccccccc', 0, 1, NULL, '', '', '', '2020-09-01 22:37:41'),
(3, 25, 4, 'wwwwwwwwwww', 1, 0, NULL, '', '', '', '2020-09-01 22:37:41'),
(4, 27, 4, 'eeeeeeeeeeeee', 1, 0, NULL, '', '', '', '2020-09-01 22:37:41'),
(5, 26, 3, 'rrrrrrrrrr', 0, 1, NULL, '', '', '', '2020-09-01 22:37:41'),
(6, 32, 1, 'ffffffffff', 0, 0, NULL, '', '', '', '2020-09-01 22:37:41'),
(7, 32, 2, 'gggggggggggggg', 0, 0, NULL, '', '', '', '2020-09-01 22:37:41'),
(8, 32, 1, 'eeeeeeeeeeeee', 0, 0, NULL, '', '', '', '2020-09-01 22:37:41'),
(9, 32, 3, '', 0, 0, NULL, '', '', '', '2020-09-01 22:37:41');

-- --------------------------------------------------------

--
-- Table structure for table `vieva_video_favorites`
--

CREATE TABLE `vieva_video_favorites` (
  `fav_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vieva_video_lessons`
--

CREATE TABLE `vieva_video_lessons` (
  `lesson_id` int(11) NOT NULL,
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
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vieva_video_lessons`
--

INSERT INTO `vieva_video_lessons` (`lesson_id`, `tools_id`, `serie_id`, `challenge_id`, `coach_id`, `title_frensh`, `title_english`, `description_frensh`, `description_english`, `video_file`, `order_number`, `date_creation`) VALUES
(7, 1, 24, 1, 41, 'The first lesson', 'The first lessons', 'This is the first lesson', 'This is the first lesson', '2020-08-27_120.mp4', 1, '2020-11-19 08:22:15'),
(9, 1, 24, NULL, 0, 'The second lesson', 'The second lesson', 'This is the second lesson', 'This is the second lesson', '2020-08-27_132.mp4', 2, '2020-11-19 08:08:03'),
(11, NULL, 1, NULL, 0, 'The third lesson', 'The third lesson', 'This is the third lesson', 'This is the third lesson', '2020-08-28_198.mp4', 3, '2020-08-28 05:26:47'),
(12, 2, 21, NULL, 0, 'The fourth lesson', 'The fourth lesson', 'The fourth lesson', 'The fourth lesson', '2020-10-30_156.avi', 4, '2020-10-30 10:35:46'),
(13, 3, 21, 3, 0, 'The fifth lesson', 'The fifth lesson', 'fdsa', 'fdsa', '2020-11-02_105.webm', 5, '2020-11-02 09:15:15'),
(14, 3, 24, 3, 0, 'The sixth lesson', 'The sixth lesson', 'The sixth lesson', 'The sixth lesson', '2020-11-19_132.webm', 6, '2020-11-19 08:13:09');

-- --------------------------------------------------------

--
-- Table structure for table `vieva_video_lessons_settings`
--

CREATE TABLE `vieva_video_lessons_settings` (
  `settings_id` int(11) NOT NULL,
  `video_id` int(11) DEFAULT NULL,
  `user_level` varchar(10) DEFAULT NULL COMMENT '0123456789: all users can see it;\r\n0: only superadmin;\r\n01 : superadmin and admins \r\n..',
  `challenge_id` int(11) DEFAULT NULL,
  `order_number` int(11) DEFAULT NULL,
  `starting_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'when the video will be  available for the users',
  `ending_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'when the video will be hidden for the users.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vieva_video_likes`
--

CREATE TABLE `vieva_video_likes` (
  `id` int(11) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `likes` int(11) DEFAULT 0,
  `dislikes` int(11) DEFAULT 0,
  `video_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vieva_video_likes`
--

INSERT INTO `vieva_video_likes` (`id`, `user_id`, `likes`, `dislikes`, `video_id`, `date`) VALUES
(1, 22, 0, 0, 4, '2020-08-25 18:53:48'),
(2, 20, 1, 1, 4, '2020-08-25 18:53:54'),
(3, 25, 1, 0, 3, '2020-08-25 18:53:59'),
(4, 20, 1, 1, 3, '2020-08-25 18:54:04'),
(5, 27, 1, 0, 3, '2020-08-25 18:54:10'),
(6, 36, 1, 0, 3, '2020-08-25 18:54:15'),
(7, 32, 0, 1, 1, '2020-08-25 18:54:22'),
(8, 32, 0, 1, 2, '2020-08-25 18:54:28'),
(9, 32, 1, 0, 3, '2020-08-25 18:54:34'),
(10, 32, 0, 0, 2, '2020-08-25 18:54:43'),
(11, 37, 0, 0, 2, '2020-09-01 18:21:58');

-- --------------------------------------------------------

--
-- Table structure for table `vieva_week_progress`
--

CREATE TABLE `vieva_week_progress` (
  `progress_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `stress_level` tinyint(3) NOT NULL COMMENT '0:low, 1:moderate, 2:high',
  `workload_level` tinyint(3) NOT NULL COMMENT '0:low, 1:moderate, 2:high',
  `energy_level` tinyint(3) NOT NULL COMMENT '0:low, 1:moderate, 2:high',
  `highlight_of_week` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vieva_week_progress`
--

INSERT INTO `vieva_week_progress` (`progress_id`, `user_id`, `stress_level`, `workload_level`, `energy_level`, `highlight_of_week`, `date`) VALUES
(1, 22, 0, 1, 2, 'dfdf', '2020-08-10 05:05:16'),
(2, 23, 2, 2, 2, 'fdddd', '2020-08-19 05:05:22'),
(3, 24, 1, 1, 0, 'aaaaaaaa', '2020-08-20 05:06:19'),
(4, 24, 5, 2, 0, 'dddddddd', '2020-07-08 05:06:41'),
(5, 26, 1, 2, 0, 'cccccccccc', '2020-07-23 05:07:01'),
(6, 32, 2, 1, 2, 'rrrrrrrrrrrrrrrrr', '2020-09-01 01:46:17'),
(7, 33, 3, 2, 3, '33333333333333', '2020-09-01 01:46:46'),
(8, 20, 2, 3, 2, 'hhhhhhhhhhhhhhhhh', '2020-09-01 01:46:48'),
(9, 21, 2, 1, 2, 'jjjjjjjjjj', '2020-09-01 19:20:37'),
(10, 38, 3, 2, 3, 'yyyyyyyyyy', '2020-09-01 19:20:41'),
(11, 20, 4, 3, 1, 'uuuuuu', '2020-09-01 19:20:43'),
(12, 21, 5, 2, 3, 'kkkkkkkkkk', '2020-09-01 19:20:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vieva_all_checks`
--
ALTER TABLE `vieva_all_checks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vieva_breathing_tool`
--
ALTER TABLE `vieva_breathing_tool`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vieva_categories_series`
--
ALTER TABLE `vieva_categories_series`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `vieva_challenges`
--
ALTER TABLE `vieva_challenges`
  ADD PRIMARY KEY (`challenge_id`);

--
-- Indexes for table `vieva_coaching_reports`
--
ALTER TABLE `vieva_coaching_reports`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `vieva_corporate_clients`
--
ALTER TABLE `vieva_corporate_clients`
  ADD PRIMARY KEY (`corporate_client_id`);

--
-- Indexes for table `vieva_corporate_clients_settings`
--
ALTER TABLE `vieva_corporate_clients_settings`
  ADD PRIMARY KEY (`settings_id`);

--
-- Indexes for table `vieva_corporate_groups`
--
ALTER TABLE `vieva_corporate_groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `vieva_guided_meditation`
--
ALTER TABLE `vieva_guided_meditation`
  ADD PRIMARY KEY (`guided_meditation_id`);

--
-- Indexes for table `vieva_mindfulness_categories`
--
ALTER TABLE `vieva_mindfulness_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vieva_mindfulness_tool`
--
ALTER TABLE `vieva_mindfulness_tool`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vieva_motif_seance`
--
ALTER TABLE `vieva_motif_seance`
  ADD PRIMARY KEY (`motif_seance_id`);

--
-- Indexes for table `vieva_notifications`
--
ALTER TABLE `vieva_notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `vieva_notification_listing`
--
ALTER TABLE `vieva_notification_listing`
  ADD PRIMARY KEY (`listing_id`);

--
-- Indexes for table `vieva_premium_payment_plans`
--
ALTER TABLE `vieva_premium_payment_plans`
  ADD PRIMARY KEY (`plan_id`);

--
-- Indexes for table `vieva_questions`
--
ALTER TABLE `vieva_questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `vieva_questions_possible_choices`
--
ALTER TABLE `vieva_questions_possible_choices`
  ADD PRIMARY KEY (`choice_id`);

--
-- Indexes for table `vieva_quotes`
--
ALTER TABLE `vieva_quotes`
  ADD PRIMARY KEY (`quote_id`);

--
-- Indexes for table `vieva_quote_likes`
--
ALTER TABLE `vieva_quote_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vieva_routines`
--
ALTER TABLE `vieva_routines`
  ADD PRIMARY KEY (`routine_id`);

--
-- Indexes for table `vieva_routines_settings`
--
ALTER TABLE `vieva_routines_settings`
  ADD PRIMARY KEY (`routine_settings_id`);

--
-- Indexes for table `vieva_routines_set_by_users`
--
ALTER TABLE `vieva_routines_set_by_users`
  ADD PRIMARY KEY (`r_s_user_id`);

--
-- Indexes for table `vieva_self_hypnosis`
--
ALTER TABLE `vieva_self_hypnosis`
  ADD PRIMARY KEY (`self_hypnosis_id`);

--
-- Indexes for table `vieva_series`
--
ALTER TABLE `vieva_series`
  ADD PRIMARY KEY (`serie_id`);

--
-- Indexes for table `vieva_series_scheduler`
--
ALTER TABLE `vieva_series_scheduler`
  ADD PRIMARY KEY (`serie_scheduler_id`);

--
-- Indexes for table `vieva_series_settings`
--
ALTER TABLE `vieva_series_settings`
  ADD PRIMARY KEY (`serie_setting_id`);

--
-- Indexes for table `vieva_team_members`
--
ALTER TABLE `vieva_team_members`
  ADD PRIMARY KEY (`team_members_id`);

--
-- Indexes for table `vieva_tools`
--
ALTER TABLE `vieva_tools`
  ADD PRIMARY KEY (`tools_id`);

--
-- Indexes for table `vieva_users`
--
ALTER TABLE `vieva_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vieva_users_challenges`
--
ALTER TABLE `vieva_users_challenges`
  ADD PRIMARY KEY (`user_challenge_id`);

--
-- Indexes for table `vieva_user_activities_videos`
--
ALTER TABLE `vieva_user_activities_videos`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `vieva_videos_challenges`
--
ALTER TABLE `vieva_videos_challenges`
  ADD PRIMARY KEY (`video_challenge_id`);

--
-- Indexes for table `vieva_video_comments`
--
ALTER TABLE `vieva_video_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vieva_video_favorites`
--
ALTER TABLE `vieva_video_favorites`
  ADD PRIMARY KEY (`fav_id`);

--
-- Indexes for table `vieva_video_lessons`
--
ALTER TABLE `vieva_video_lessons`
  ADD PRIMARY KEY (`lesson_id`);

--
-- Indexes for table `vieva_video_lessons_settings`
--
ALTER TABLE `vieva_video_lessons_settings`
  ADD PRIMARY KEY (`settings_id`);

--
-- Indexes for table `vieva_video_likes`
--
ALTER TABLE `vieva_video_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vieva_week_progress`
--
ALTER TABLE `vieva_week_progress`
  ADD PRIMARY KEY (`progress_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vieva_all_checks`
--
ALTER TABLE `vieva_all_checks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vieva_breathing_tool`
--
ALTER TABLE `vieva_breathing_tool`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vieva_categories_series`
--
ALTER TABLE `vieva_categories_series`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vieva_challenges`
--
ALTER TABLE `vieva_challenges`
  MODIFY `challenge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vieva_coaching_reports`
--
ALTER TABLE `vieva_coaching_reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `vieva_corporate_clients`
--
ALTER TABLE `vieva_corporate_clients`
  MODIFY `corporate_client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `vieva_corporate_clients_settings`
--
ALTER TABLE `vieva_corporate_clients_settings`
  MODIFY `settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vieva_corporate_groups`
--
ALTER TABLE `vieva_corporate_groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `vieva_guided_meditation`
--
ALTER TABLE `vieva_guided_meditation`
  MODIFY `guided_meditation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vieva_mindfulness_categories`
--
ALTER TABLE `vieva_mindfulness_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vieva_mindfulness_tool`
--
ALTER TABLE `vieva_mindfulness_tool`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vieva_motif_seance`
--
ALTER TABLE `vieva_motif_seance`
  MODIFY `motif_seance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `vieva_notifications`
--
ALTER TABLE `vieva_notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vieva_notification_listing`
--
ALTER TABLE `vieva_notification_listing`
  MODIFY `listing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vieva_premium_payment_plans`
--
ALTER TABLE `vieva_premium_payment_plans`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vieva_questions`
--
ALTER TABLE `vieva_questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vieva_questions_possible_choices`
--
ALTER TABLE `vieva_questions_possible_choices`
  MODIFY `choice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vieva_quotes`
--
ALTER TABLE `vieva_quotes`
  MODIFY `quote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `vieva_quote_likes`
--
ALTER TABLE `vieva_quote_likes`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vieva_routines`
--
ALTER TABLE `vieva_routines`
  MODIFY `routine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vieva_routines_settings`
--
ALTER TABLE `vieva_routines_settings`
  MODIFY `routine_settings_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vieva_routines_set_by_users`
--
ALTER TABLE `vieva_routines_set_by_users`
  MODIFY `r_s_user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vieva_self_hypnosis`
--
ALTER TABLE `vieva_self_hypnosis`
  MODIFY `self_hypnosis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vieva_series`
--
ALTER TABLE `vieva_series`
  MODIFY `serie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `vieva_series_scheduler`
--
ALTER TABLE `vieva_series_scheduler`
  MODIFY `serie_scheduler_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vieva_series_settings`
--
ALTER TABLE `vieva_series_settings`
  MODIFY `serie_setting_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vieva_team_members`
--
ALTER TABLE `vieva_team_members`
  MODIFY `team_members_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `vieva_tools`
--
ALTER TABLE `vieva_tools`
  MODIFY `tools_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vieva_users`
--
ALTER TABLE `vieva_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `vieva_users_challenges`
--
ALTER TABLE `vieva_users_challenges`
  MODIFY `user_challenge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vieva_user_activities_videos`
--
ALTER TABLE `vieva_user_activities_videos`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vieva_videos_challenges`
--
ALTER TABLE `vieva_videos_challenges`
  MODIFY `video_challenge_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vieva_video_comments`
--
ALTER TABLE `vieva_video_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `vieva_video_favorites`
--
ALTER TABLE `vieva_video_favorites`
  MODIFY `fav_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vieva_video_lessons`
--
ALTER TABLE `vieva_video_lessons`
  MODIFY `lesson_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `vieva_video_lessons_settings`
--
ALTER TABLE `vieva_video_lessons_settings`
  MODIFY `settings_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vieva_video_likes`
--
ALTER TABLE `vieva_video_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `vieva_week_progress`
--
ALTER TABLE `vieva_week_progress`
  MODIFY `progress_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
