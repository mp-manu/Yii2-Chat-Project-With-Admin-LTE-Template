/*
SQLyog Ultimate v12.14 (64 bit)
MySQL - 10.0.38-MariaDB : Database - test_chat
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`test_chat` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `test_chat`;

/*Table structure for table `auth_assignment` */

DROP TABLE IF EXISTS `auth_assignment`;

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_assignment` */

insert  into `auth_assignment`(`item_name`,`user_id`,`created_at`) values 
('admin','1',1608015289),
('admin-permission','1',1608015285),
('guest','1',1608015289),
('guest','8',1608016824),
('guest-permission','1',1608015289),
('guest-permission','8',1608016824),
('user','1',1608015289),
('user','7',1608015634),
('user-permission','1',1608015289),
('user-permission','7',1608015634);

/*Table structure for table `auth_item` */

DROP TABLE IF EXISTS `auth_item`;

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_item` */

insert  into `auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values 
('/*',2,NULL,NULL,NULL,1608007379,1608007379),
('/chat-user/*',2,NULL,NULL,NULL,1608015676,1608015676),
('/chat-user/create',2,NULL,NULL,NULL,1608015676,1608015676),
('/chat-user/delete',2,NULL,NULL,NULL,1608015676,1608015676),
('/chat-user/index',2,NULL,NULL,NULL,1608015676,1608015676),
('/chat-user/update',2,NULL,NULL,NULL,1608015676,1608015676),
('/chat-user/view',2,NULL,NULL,NULL,1608015676,1608015676),
('/chat/*',2,NULL,NULL,NULL,1608015676,1608015676),
('/chat/create',2,NULL,NULL,NULL,1608015676,1608015676),
('/chat/delete',2,NULL,NULL,NULL,1608015676,1608015676),
('/chat/get-chat',2,NULL,NULL,NULL,1608030367,1608030367),
('/chat/index',2,NULL,NULL,NULL,1608015676,1608015676),
('/chat/list',2,NULL,NULL,NULL,1608015676,1608015676),
('/chat/send-message',2,NULL,NULL,NULL,1608030367,1608030367),
('/chat/send-message-admin',2,NULL,NULL,NULL,1608058583,1608058583),
('/chat/show-chat',2,NULL,NULL,NULL,1608058583,1608058583),
('/chat/update',2,NULL,NULL,NULL,1608015676,1608015676),
('/chat/view',2,NULL,NULL,NULL,1608015676,1608015676),
('/debug/*',2,NULL,NULL,NULL,1608007379,1608007379),
('/debug/default/*',2,NULL,NULL,NULL,1608007379,1608007379),
('/debug/default/db-explain',2,NULL,NULL,NULL,1608007379,1608007379),
('/debug/default/download-mail',2,NULL,NULL,NULL,1608007379,1608007379),
('/debug/default/index',2,NULL,NULL,NULL,1608007379,1608007379),
('/debug/default/toolbar',2,NULL,NULL,NULL,1608007379,1608007379),
('/debug/default/view',2,NULL,NULL,NULL,1608007379,1608007379),
('/debug/user/*',2,NULL,NULL,NULL,1608007379,1608007379),
('/debug/user/reset-identity',2,NULL,NULL,NULL,1608007379,1608007379),
('/debug/user/set-identity',2,NULL,NULL,NULL,1608007379,1608007379),
('/gii/*',2,NULL,NULL,NULL,1608007379,1608007379),
('/gii/default/*',2,NULL,NULL,NULL,1608007379,1608007379),
('/gii/default/action',2,NULL,NULL,NULL,1608007379,1608007379),
('/gii/default/diff',2,NULL,NULL,NULL,1608007379,1608007379),
('/gii/default/index',2,NULL,NULL,NULL,1608007379,1608007379),
('/gii/default/preview',2,NULL,NULL,NULL,1608007379,1608007379),
('/gii/default/view',2,NULL,NULL,NULL,1608007379,1608007379),
('/message/*',2,NULL,NULL,NULL,1608015676,1608015676),
('/message/create',2,NULL,NULL,NULL,1608015676,1608015676),
('/message/delete',2,NULL,NULL,NULL,1608015676,1608015676),
('/message/incorrect',2,NULL,NULL,NULL,1608058583,1608058583),
('/message/index',2,NULL,NULL,NULL,1608015676,1608015676),
('/message/set-correct',2,NULL,NULL,NULL,1608058583,1608058583),
('/message/set-incorrect',2,NULL,NULL,NULL,1608058583,1608058583),
('/message/update',2,NULL,NULL,NULL,1608015676,1608015676),
('/message/view',2,NULL,NULL,NULL,1608015676,1608015676),
('/rbac/*',2,NULL,NULL,NULL,1608007379,1608007379),
('/rbac/assignment/*',2,NULL,NULL,NULL,1608007379,1608007379),
('/rbac/assignment/assign',2,NULL,NULL,NULL,1608007379,1608007379),
('/rbac/assignment/index',2,NULL,NULL,NULL,1608007379,1608007379),
('/rbac/assignment/remove',2,NULL,NULL,NULL,1608007379,1608007379),
('/rbac/assignment/view',2,NULL,NULL,NULL,1608007379,1608007379),
('/rbac/permission/*',2,NULL,NULL,NULL,1608007379,1608007379),
('/rbac/permission/assign',2,NULL,NULL,NULL,1608007379,1608007379),
('/rbac/permission/create',2,NULL,NULL,NULL,1608007379,1608007379),
('/rbac/permission/delete',2,NULL,NULL,NULL,1608007379,1608007379),
('/rbac/permission/index',2,NULL,NULL,NULL,1608007379,1608007379),
('/rbac/permission/remove',2,NULL,NULL,NULL,1608007379,1608007379),
('/rbac/permission/update',2,NULL,NULL,NULL,1608007379,1608007379),
('/rbac/permission/view',2,NULL,NULL,NULL,1608007379,1608007379),
('/rbac/role/*',2,NULL,NULL,NULL,1608007379,1608007379),
('/rbac/role/assign',2,NULL,NULL,NULL,1608007379,1608007379),
('/rbac/role/create',2,NULL,NULL,NULL,1608007379,1608007379),
('/rbac/role/delete',2,NULL,NULL,NULL,1608007379,1608007379),
('/rbac/role/index',2,NULL,NULL,NULL,1608007379,1608007379),
('/rbac/role/remove',2,NULL,NULL,NULL,1608007379,1608007379),
('/rbac/role/update',2,NULL,NULL,NULL,1608007379,1608007379),
('/rbac/role/view',2,NULL,NULL,NULL,1608007379,1608007379),
('/rbac/route/*',2,NULL,NULL,NULL,1608007379,1608007379),
('/rbac/route/assign',2,NULL,NULL,NULL,1608007379,1608007379),
('/rbac/route/index',2,NULL,NULL,NULL,1608007379,1608007379),
('/rbac/route/refresh',2,NULL,NULL,NULL,1608007379,1608007379),
('/rbac/route/remove',2,NULL,NULL,NULL,1608007379,1608007379),
('/rbac/rule/*',2,NULL,NULL,NULL,1608007379,1608007379),
('/rbac/rule/create',2,NULL,NULL,NULL,1608007379,1608007379),
('/rbac/rule/delete',2,NULL,NULL,NULL,1608007379,1608007379),
('/rbac/rule/index',2,NULL,NULL,NULL,1608007379,1608007379),
('/rbac/rule/update',2,NULL,NULL,NULL,1608007379,1608007379),
('/rbac/rule/view',2,NULL,NULL,NULL,1608007379,1608007379),
('/site/*',2,NULL,NULL,NULL,1608007379,1608007379),
('/site/about',2,NULL,NULL,NULL,1608007379,1608007379),
('/site/captcha',2,NULL,NULL,NULL,1608007379,1608007379),
('/site/contact',2,NULL,NULL,NULL,1608007379,1608007379),
('/site/error',2,NULL,NULL,NULL,1608007379,1608007379),
('/site/index',2,NULL,NULL,NULL,1608007379,1608007379),
('/site/login',2,NULL,NULL,NULL,1608007379,1608007379),
('/site/logout',2,NULL,NULL,NULL,1608007379,1608007379),
('/user/*',2,NULL,NULL,NULL,1608015676,1608015676),
('/user/create',2,NULL,NULL,NULL,1608015676,1608015676),
('/user/delete',2,NULL,NULL,NULL,1608015676,1608015676),
('/user/index',2,NULL,NULL,NULL,1608015676,1608015676),
('/user/update',2,NULL,NULL,NULL,1608015676,1608015676),
('/user/view',2,NULL,NULL,NULL,1608015676,1608015676),
('admin',1,'Administrator',NULL,NULL,1608005764,1608005764),
('admin-permission',2,NULL,NULL,NULL,1608007398,1608007398),
('guest',1,'Guest',NULL,NULL,1608005782,1608005782),
('guest-permission',2,NULL,NULL,NULL,1608007497,1608007497),
('user',1,'User',NULL,NULL,1608005808,1608005808),
('user-permission',2,'User',NULL,NULL,1608007346,1608007346);

/*Table structure for table `auth_item_child` */

DROP TABLE IF EXISTS `auth_item_child`;

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_item_child` */

insert  into `auth_item_child`(`parent`,`child`) values 
('admin-permission','/*'),
('admin-permission','/chat-user/*'),
('admin-permission','/chat-user/create'),
('admin-permission','/chat-user/delete'),
('admin-permission','/chat-user/index'),
('admin-permission','/chat-user/update'),
('admin-permission','/chat-user/view'),
('admin-permission','/chat/*'),
('admin-permission','/chat/create'),
('admin-permission','/chat/delete'),
('admin-permission','/chat/get-chat'),
('admin-permission','/chat/index'),
('admin-permission','/chat/list'),
('admin-permission','/chat/send-message'),
('admin-permission','/chat/send-message-admin'),
('admin-permission','/chat/show-chat'),
('admin-permission','/chat/update'),
('admin-permission','/chat/view'),
('admin-permission','/debug/*'),
('admin-permission','/debug/default/*'),
('admin-permission','/debug/default/db-explain'),
('admin-permission','/debug/default/download-mail'),
('admin-permission','/debug/default/index'),
('admin-permission','/debug/default/toolbar'),
('admin-permission','/debug/default/view'),
('admin-permission','/debug/user/*'),
('admin-permission','/debug/user/reset-identity'),
('admin-permission','/debug/user/set-identity'),
('admin-permission','/gii/*'),
('admin-permission','/gii/default/*'),
('admin-permission','/gii/default/action'),
('admin-permission','/gii/default/diff'),
('admin-permission','/gii/default/index'),
('admin-permission','/gii/default/preview'),
('admin-permission','/gii/default/view'),
('admin-permission','/message/*'),
('admin-permission','/message/create'),
('admin-permission','/message/delete'),
('admin-permission','/message/incorrect'),
('admin-permission','/message/index'),
('admin-permission','/message/set-correct'),
('admin-permission','/message/set-incorrect'),
('admin-permission','/message/update'),
('admin-permission','/message/view'),
('admin-permission','/rbac/*'),
('admin-permission','/rbac/assignment/*'),
('admin-permission','/rbac/assignment/assign'),
('admin-permission','/rbac/assignment/index'),
('admin-permission','/rbac/assignment/remove'),
('admin-permission','/rbac/assignment/view'),
('admin-permission','/rbac/permission/*'),
('admin-permission','/rbac/permission/assign'),
('admin-permission','/rbac/permission/create'),
('admin-permission','/rbac/permission/delete'),
('admin-permission','/rbac/permission/index'),
('admin-permission','/rbac/permission/remove'),
('admin-permission','/rbac/permission/update'),
('admin-permission','/rbac/permission/view'),
('admin-permission','/rbac/role/*'),
('admin-permission','/rbac/role/assign'),
('admin-permission','/rbac/role/create'),
('admin-permission','/rbac/role/delete'),
('admin-permission','/rbac/role/index'),
('admin-permission','/rbac/role/remove'),
('admin-permission','/rbac/role/update'),
('admin-permission','/rbac/role/view'),
('admin-permission','/rbac/route/*'),
('admin-permission','/rbac/route/assign'),
('admin-permission','/rbac/route/index'),
('admin-permission','/rbac/route/refresh'),
('admin-permission','/rbac/route/remove'),
('admin-permission','/rbac/rule/*'),
('admin-permission','/rbac/rule/create'),
('admin-permission','/rbac/rule/delete'),
('admin-permission','/rbac/rule/index'),
('admin-permission','/rbac/rule/update'),
('admin-permission','/rbac/rule/view'),
('admin-permission','/site/*'),
('admin-permission','/site/about'),
('admin-permission','/site/captcha'),
('admin-permission','/site/contact'),
('admin-permission','/site/error'),
('admin-permission','/site/index'),
('admin-permission','/site/login'),
('admin-permission','/site/logout'),
('admin-permission','/user/*'),
('admin-permission','/user/create'),
('admin-permission','/user/delete'),
('admin-permission','/user/index'),
('admin-permission','/user/update'),
('admin-permission','/user/view'),
('admin-permission','guest-permission'),
('admin-permission','user-permission'),
('guest-permission','/chat/get-chat'),
('guest-permission','/chat/list'),
('guest-permission','/site/index'),
('guest-permission','/site/login'),
('guest-permission','/site/logout'),
('user-permission','/chat/get-chat'),
('user-permission','/chat/list'),
('user-permission','/chat/send-message'),
('user-permission','/site/*');

/*Table structure for table `auth_rule` */

DROP TABLE IF EXISTS `auth_rule`;

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_rule` */

/*Table structure for table `chat` */

DROP TABLE IF EXISTS `chat`;

CREATE TABLE `chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `type` tinyint(3) DEFAULT NULL,
  `status` tinyint(3) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `chat` */

insert  into `chat`(`id`,`name`,`type`,`status`) values 
(1,'7_1',1,1),
(2,'8_7',1,1),
(4,'8_1',1,1);

/*Table structure for table `chat_user` */

DROP TABLE IF EXISTS `chat_user`;

CREATE TABLE `chat_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chat_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(3) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `chat_id` (`chat_id`,`user_id`,`status`),
  KEY `fk_chat_user_id` (`user_id`),
  CONSTRAINT `fk_chat_id` FOREIGN KEY (`chat_id`) REFERENCES `chat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_chat_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `chat_user` */

insert  into `chat_user`(`id`,`chat_id`,`user_id`,`status`) values 
(2,1,1,1),
(1,1,7,1),
(4,2,7,1),
(3,2,8,1),
(8,4,1,1),
(7,4,8,1);

/*Table structure for table `message` */

DROP TABLE IF EXISTS `message`;

CREATE TABLE `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(3) DEFAULT '1',
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_message_id` (`chat_id`),
  KEY `fk_message_user_id` (`user_id`),
  CONSTRAINT `fk_message_id` FOREIGN KEY (`chat_id`) REFERENCES `chat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_message_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `message` */

insert  into `message`(`id`,`chat_id`,`user_id`,`message`,`status`,`created_at`) values 
(1,1,1,'Hello World',1,1608029848),
(2,1,1,'How are you?',1,1608029852),
(3,1,7,'Hi',1,1608030408),
(4,1,7,'I am fine',1,1608030414),
(5,1,7,'TEst1',1,1608030706),
(6,1,7,'TEst1',1,1608030710),
(7,2,7,'Hello World',1,1608032060),
(8,4,1,'How are you?',1,1608036971),
(9,2,1,'Hi',1,1608055374),
(10,4,1,'Hello World',1,1608055640),
(11,2,1,'Hello World',1,1608055659),
(12,2,1,'Hello World',1,1608055694),
(13,2,1,'Hello World',1,1608055710);

/*Table structure for table `migration` */

DROP TABLE IF EXISTS `migration`;

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `migration` */

insert  into `migration`(`version`,`apply_time`) values 
('m201215_045214_create_table_chat',1608009085),
('m201215_045226_create_table_chat_users',1608009088),
('m201215_045256_create_table_message',1608009091),
('m201215_092701_add_column_created_at',1608024485);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(65) NOT NULL,
  `user_password` varchar(150) NOT NULL,
  `fio` varchar(255) DEFAULT NULL,
  `telefon` varchar(255) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `user_type` enum('admin','user','guest') NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `is_block` tinyint(2) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `auth_key` varchar(255) DEFAULT NULL,
  `secret_key` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_login_id` (`username`),
  KEY `updated_by` (`updated_by`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `user` */

insert  into `user`(`user_id`,`username`,`user_password`,`fio`,`telefon`,`email`,`user_type`,`photo`,`is_block`,`created_at`,`created_by`,`updated_at`,`updated_by`,`auth_key`,`secret_key`) values 
(1,'admin','4baee7411b65cadc2c33bdc3a3155e06','Администратор','+992927001911','manu6699@mail.ru','admin','1.jpg',0,'2017-10-23 11:52:23',1,NULL,NULL,NULL,NULL),
(7,'user','a02ab6584c044fc7c03203928ce2b647','Muzafarov Manuchehr','12025550125','johndoe@example.com','user',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),
(8,'guest','ec2a19dae54da19ca7494e3215b5cab7','Пользователь гость','12025550125','johndoe@example.com','guest',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
