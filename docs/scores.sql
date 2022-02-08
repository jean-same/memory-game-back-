-- Adminer 4.8.1 MySQL 5.5.5-10.5.12-MariaDB-1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `scores`;
CREATE TABLE `scores` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `nbSeconds` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `scores` (`id`, `nbSeconds`, `date`) VALUES
(1,	96,	'2022-02-06 19:38:45'),
(3,	143,	'2022-02-06 14:45:10'),
(6,	102,	'2022-02-06 14:45:57'),
(7,	80,	'2022-02-06 14:46:20'),
(9,	157,	'2022-02-06 15:02:50'),
(10,	88,	'2022-02-06 15:03:02'),
(15,	48,	'2022-02-08 02:06:48'),
(17,	57,	'2022-02-08 02:09:45'),
(88,	213,	'2022-02-08 21:16:23'),
(89,	67,	'2022-02-08 21:28:53'),
(90,	131,	'2022-02-08 21:29:26'),
(91,	7,	'2022-02-08 21:29:31');

-- 2022-02-08 20:30:19
