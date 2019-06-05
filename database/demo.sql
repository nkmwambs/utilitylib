-- Adminer 4.6.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `birthday` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sex` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `level` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `is_approver` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `email` (`email`(100))
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `admin` (`admin_id`, `admin_name`, `email`, `birthday`, `sex`, `phone`, `level`, `is_approver`) VALUES
(1,	'Nicodemus Karisa',	'nkmwambs@gmail.com',	'',	'male',	'090933',	'super',	1),
(2,	'Livingstone Onduso',	'livingstoneonduso@gmail.com',	'',	'male',	'0909',	'super',	1),
(3,	'Hope Shume',	'hopeshume@gmail.com',	'',	'female',	'87778',	'super',	1),
(13,	'Betty Kanze',	'byeri123@gmail.com',	'05/10/2019',	'female',	'99889',	'super',	0);

CREATE TABLE `app` (
  `app_id` int(100) NOT NULL AUTO_INCREMENT,
  `app_name` varchar(20) NOT NULL,
  PRIMARY KEY (`app_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `app` (`app_id`, `app_name`) VALUES
(1,	'default'),
(2,	'schoolapp2');

CREATE TABLE `language` (
  `phrase_id` int(11) NOT NULL AUTO_INCREMENT,
  `phrase` longtext COLLATE utf8_unicode_ci NOT NULL,
  `tooltip` longtext COLLATE utf8_unicode_ci NOT NULL,
  `english` longtext COLLATE utf8_unicode_ci NOT NULL,
  `spanish` longtext COLLATE utf8_unicode_ci NOT NULL,
  `french` longtext COLLATE utf8_unicode_ci NOT NULL,
  `swahili` longtext COLLATE utf8_unicode_ci,
  `Hindu` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`phrase_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `login_type` (
  `login_type_id` int(100) NOT NULL AUTO_INCREMENT,
  `login_type_name` varchar(10) NOT NULL,
  PRIMARY KEY (`login_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `login_type` (`login_type_id`, `login_type_name`) VALUES
(1,	'admin'),
(2,	'teacher'),
(3,	'student'),
(4,	'parent');

CREATE TABLE `profile` (
  `profile_id` int(100) NOT NULL AUTO_INCREMENT,
  `profile_name` varchar(100) NOT NULL,
  `login_type_id` int(10) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`profile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `profile` (`profile_id`, `profile_name`, `login_type_id`, `description`) VALUES
(1,	'Super Admin',	1,	'System Main Administrator'),
(2,	'None Class Teachers',	2,	'None Class Teachers'),
(3,	'Secretary',	1,	'Admin Sec');

CREATE TABLE `user` (
  `user_id` int(100) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email_notify` int(11) NOT NULL DEFAULT '1',
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `login_type_id` tinyint(10) NOT NULL,
  `profile_id` tinyint(5) NOT NULL,
  `type_user_id` int(100) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `user` (`user_id`, `firstname`, `lastname`, `email`, `email_notify`, `phone`, `login_type_id`, `profile_id`, `type_user_id`) VALUES
(1,	'Nicodemus',	'Karisa',	'nkmwambs@gmail.com',	1,	'254711808071',	1,	1,	1),
(2,	'Livingstone',	'Onduso',	'livingstoneonduso@gmail.com',	1,	'0909',	1,	1,	2),
(7,	'Hope',	'Shume',	'hopeshume@gmail.com',	1,	'87778',	1,	3,	3);

-- 2019-06-05 16:19:36
