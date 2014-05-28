-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 22, 2014 at 12:24 PM
-- Server version: 5.5.33
-- PHP Version: 5.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bionetvote`
--

-- --------------------------------------------------------

--
-- Table structure for table `choices`
--

CREATE TABLE `choices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  `order` int(11) NOT NULL,
  `vote_count` int(11) NOT NULL DEFAULT '0',
  `trial` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `choices`
--

INSERT INTO `choices` (`id`, `name`, `order`, `vote_count`, `trial`) VALUES
(4, 'test1', 0, 0, 5),
(5, 'test2', 0, 0, 5),
(6, 'test3', 0, 0, 5),
(7, 'test', 0, 2, 21),
(8, 'test2', 0, 3, 21);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trial` int(11) NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `trial`, `comment`) VALUES
(1, 22, 'test'),
(2, 22, 'ขนมเหนียบ');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `permissions` text,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `groups_name_unique` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '{"superuser":1}', '2014-04-24 02:11:57', '2014-04-24 02:11:57');

-- --------------------------------------------------------

--
-- Table structure for table `maillogs`
--

CREATE TABLE `maillogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trial` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` text NOT NULL,
  `voted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=74 ;

--
-- Dumping data for table `maillogs`
--

INSERT INTO `maillogs` (`id`, `trial`, `email`, `token`, `voted`) VALUES
(72, 21, 'uttapong.rua@biotec.or.th', '9bbcf79940225267e01439a7ba67ca6d', 0),
(73, 22, 'uttapong.rua@biotec.or.th', '90cac6290b838a0d423c955128cd4e3e', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_04_07_233718_create_admins_table', 1),
('2012_12_06_225921_migration_cartalyst_sentry_install_users', 2),
('2012_12_06_225929_migration_cartalyst_sentry_install_groups', 2),
('2012_12_06_225945_migration_cartalyst_sentry_install_users_groups_pivot', 2),
('2012_12_06_225988_migration_cartalyst_sentry_install_throttle', 2),
('2013_07_16_172358_alter_user_table', 3),
('2013_09_02_072804_create_permission_table', 3),
('2013_09_08_191339_update_admin_group_permission', 3);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `value` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_value_unique` (`value`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `value`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Super User', 'superuser', 'All permissions', '2014-04-24 02:11:57', '2014-04-24 02:11:57'),
(2, 'List Users', 'view-users-list', 'View the list of users', '2014-04-24 02:11:57', '2014-04-24 02:11:57'),
(3, 'Create user', 'create-user', 'Create new user', '2014-04-24 02:11:57', '2014-04-24 02:11:57'),
(4, 'Delete user', 'delete-user', 'Delete a user', '2014-04-24 02:11:57', '2014-04-24 02:11:57'),
(5, 'Update user', 'update-user-info', 'Update a user profile', '2014-04-24 02:11:57', '2014-04-24 02:11:57'),
(6, 'Update user group', 'user-group-management', 'Add/Remove a user in a group', '2014-04-24 02:11:57', '2014-04-24 02:11:57'),
(7, 'Groups management', 'groups-management', 'Manage group (CRUD)', '2014-04-24 02:11:57', '2014-04-24 02:11:57'),
(8, 'Permissions management', 'permissions-management', 'Manage permissions (CRUD)', '2014-04-24 02:11:57', '2014-04-24 02:11:57');

-- --------------------------------------------------------

--
-- Table structure for table `throttle`
--

CREATE TABLE `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `attempts` int(11) NOT NULL DEFAULT '0',
  `suspended` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `last_attempt_at` timestamp NULL DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `throttle_user_id_index` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `throttle`
--

INSERT INTO `throttle` (`id`, `user_id`, `ip_address`, `attempts`, `suspended`, `banned`, `last_attempt_at`, `suspended_at`, `banned_at`) VALUES
(1, 1, '::1', 0, 0, 0, NULL, NULL, NULL),
(2, 1, '192.168.1.4', 0, 0, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `trial`
--

CREATE TABLE `trial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `created_date` datetime NOT NULL,
  `expire` date NOT NULL,
  `type` varchar(50) NOT NULL,
  `vote_approve` int(11) NOT NULL DEFAULT '0',
  `vote_disapprove` int(11) NOT NULL DEFAULT '0',
  `vote_abstain` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `trial`
--

INSERT INTO `trial` (`id`, `title`, `description`, `created_date`, `expire`, `type`, `vote_approve`, `vote_disapprove`, `vote_abstain`) VALUES
(1, 'testno 1', 'Better check yourself, you''re not looking too good.', '2014-05-14 00:00:00', '2014-05-30', 'voteapprove', 0, 0, 0),
(2, 'test no2', 'utility class to quickly provide matching colored links within any alert.', '2014-05-13 00:00:00', '2014-05-21', 'voteapprove', 0, 0, 0),
(5, 'adfadf', 'adfadf', '2014-05-12 00:00:00', '0000-00-00', 'choicevote', 0, 0, 0),
(7, 'adfadf', 'adfadf', '2014-05-12 00:00:00', '0000-00-00', 'voteapprove', 0, 0, 0),
(8, 'adfadf', 'adfadf', '2014-05-12 00:00:00', '0000-00-00', 'choicevote', 0, 0, 0),
(9, 'adfadf', 'adfadf', '2014-05-12 00:00:00', '0000-00-00', 'choicevote', 0, 0, 0),
(13, 'adfadf', 'adfadf', '2014-05-12 00:00:00', '0000-00-00', 'voteapprove', 0, 0, 0),
(14, 'adfadf222222', 'adfadf', '2014-05-12 00:00:00', '0000-00-00', 'choicevote', 0, 0, 0),
(15, 'adfadf', 'adfadf', '0000-00-00 00:00:00', '0000-00-00', 'voteapprove', 0, 0, 0),
(16, 'adfadf222222', 'adfa afdf adf', '0000-00-00 00:00:00', '0000-00-00', 'voteapprove', 0, 0, 0),
(17, 'adfadf', 'adfadf', '0000-00-00 00:00:00', '0000-00-00', 'voteapprove', 0, 0, 0),
(18, 'test', 'tesafadsfadf', '0000-00-00 00:00:00', '0000-00-00', 'voteapprove', 0, 0, 0),
(20, 'ท่านเห็นด้วยกับผู้ที่ได้รับรางวัลในตำแหน่ง Miss Thailand Universe 2014', 'จบแล้วนะคะกับการแถลงข่าว เป็นไปตามสูตรค่ะ ออกมาขอโทษและก็จบ ดิฉันรู้อยู่แล้วว่านางต้องไม่คืนตำแหน่ง เพราะนางย้ำนัก ย้ำหนาว่ามาจากการเลือกของกรรมการ (ตกลงหล่อนไม่ได้มาแข่งสินะ ) เอาเถอะ ทำอะไรไม่ได้แล้ว ก็คงต้องให้นางงามที่มาจากการเลือกตั้ง ทำหน้าที่ของนางต่อไป จริงๆแล้วเราไม่ได้อยากให้นางถอนตัวก็ได้ (ถ้าละอายใจก็ควรถอนค่ะ) เพียงแต่อยากให้นางสละสิทธิ์การไปประกวด MU โดยให้ รอง 1 ไปแทน ด้วยเหตุผลที่ว่า\\''ตัวเองศักยภาพไม่พอ\\'' สุดท้ายแล้วการประกวดปีนี้ก็เป็นแค่โชว์ปาหี่ธรรมดาค่ะ แน่นอนว่าไม่ได้มีผลกับการดำเนินชีวิต ดิฉันยังสามารถใช้ชีวิตได้อย่างต่อไป แต่ในฐานะแฟนนางงามบอกเลยว่าปวดใจมาก นี่คือความอัปยศของวงการนางงามไทย ทุกวันนี้ก็ภาวนาให้ลิขสิทธิ์ MU ในไทยตกไปอยู่กับคนที่พร้อมและยุติธรรมกว่านี้ ดังนั้นปีหน้าเดี๋ยวก็มีประกวดใหม่ค่ะ ปีนี้ก็แค่งด Support ประเทศตัวเอง บอกเลยว่า อายประเทศ AEC มากค่ะ แต่ถามว่าเชียร์มั้ย ? ขอดูหลังจากนี้ค่ะ \r\nปล.วันนี้แอลลี่สวยมาก ยิ่งดูยิ่งเสียดาย วอนกอง MUT หาเวทีส่งออกน้องด้วยเถอะค่ะ 9 เดือนที่แอลลี่บินมากตามฝันจาก LA แอลลี่ทำดีที่สุดแล้ว พี่รักหนูนะ (บรรดาคนที่ชนะรางวัลพิเศษก็สวยกว่าคนชนะมงค่ะ)\r\nปล.2 \\''หนูพร้อมจะเป็นคนดีค่ะ\\'' พอรอง 2 พูดจบ มงกุฎหักปั๊บ เอ่อออ มงกุฎไม่ตอบรับนางงามหรือคะ ?\r\nปล.3 ผู้ใหญ่บางคน \\''แก่เพราะกินข้าว เฒ่าเพราะอยู่นาน\\'' สิ่งที่คุณทำในวันนี้ คุณจะโดนถอนหงอกจนกว่าผมจะหมดหัวแน่นอนค่ะ\r\n\r\nสุดท้าย โชคดีนะฝ้ายย บรัยส์ // เบะปากกกกกกกก', '2014-05-20 07:27:40', '0000-00-00', 'voteapprove', 3, 1, 0),
(21, 'adfadfddddd', 'รณีที่จะได้ใช้ก็ประมาณว่า เรามีบทความ หรือ บอร์ด', '2014-05-20 09:52:12', '0000-00-00', 'choicevote', 0, 0, 0),
(22, 'อยากได้อะไรในวันศุกร์', 'อยากกินอะไรนะ', '2014-05-22 08:48:40', '0000-00-00', 'askcomment', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE `upload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `permissions` text,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `activation_code` varchar(255) DEFAULT NULL,
  `activated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `persist_code` varchar(255) DEFAULT NULL,
  `reset_password_code` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`),
  KEY `users_activation_code_index` (`activation_code`),
  KEY `users_reset_password_code_index` (`reset_password_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `permissions`, `activated`, `activation_code`, `activated_at`, `last_login`, `persist_code`, `reset_password_code`, `first_name`, `last_name`, `created_at`, `updated_at`) VALUES
(1, 'uttapong@gmail.com', 'admin', '$2y$10$sXJdQrhJ4j/eqp0ZbIAmEOSdRsrca.FrECGIwEs6krjqkADYHIhJW', NULL, 1, NULL, '2014-04-24 02:12:51', '2014-05-21 18:56:12', '$2y$10$i56QcGC10CIVfH38qfhUu.qDd/MgYzN6dbJljNq6oUVeUruXCi0h.', NULL, NULL, NULL, '2014-04-24 02:12:51', '2014-05-21 18:56:12');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`user_id`, `group_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vote_count`
--

CREATE TABLE `vote_count` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `upload_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `vote_count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
         