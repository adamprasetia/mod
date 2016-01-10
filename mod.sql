-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.8 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for mod
CREATE DATABASE IF NOT EXISTS `mod` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `mod`;


-- Dumping structure for table mod.absent
CREATE TABLE IF NOT EXISTS `absent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(10) NOT NULL,
  `event` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `shift` varchar(10) NOT NULL,
  `user_create` varchar(50) NOT NULL,
  `date_create` datetime NOT NULL,
  `user_update` varchar(50) NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=263 DEFAULT CHARSET=latin1;

-- Dumping data for table mod.absent: ~48 rows (approximately)
/*!40000 ALTER TABLE `absent` DISABLE KEYS */;
INSERT INTO `absent` (`id`, `user`, `event`, `tanggal`, `shift`, `user_create`, `date_create`, `user_update`, `date_update`) VALUES
	(174, 'M002', 'MR', '2016-01-01', 'M', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(175, 'M002', 'MR', '2016-01-02', 'M', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(176, 'M002', 'MR', '2016-01-03', 'M', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(184, 'M001', 'MR', '2016-01-01', 'M', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(185, 'M001', 'MR', '2016-01-02', 'M', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(186, 'M001', 'MR', '2016-01-03', 'M', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(194, 'M003', 'MR', '2016-01-01', 'S', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(195, 'M003', 'MR', '2016-01-02', 'S', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(196, 'M003', 'MR', '2016-01-03', 'S', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(204, 'M009', 'MR', '2016-01-01', 'S', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(205, 'M009', 'MR', '2016-01-02', 'S', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(206, 'M009', 'MR', '2016-01-03', 'S', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(214, 'M002', 'MR', '2016-01-04', 'M', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(215, 'M002', 'MR', '2016-01-06', 'M', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(216, 'M002', 'MR', '2016-01-08', 'M', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(217, 'M002', 'MR', '2016-01-10', 'M', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(218, 'M001', 'MR', '2016-01-04', 'M', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(219, 'M001', 'MR', '2016-01-05', 'M', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(220, 'M001', 'MR', '2016-01-06', 'M', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(221, 'M001', 'MR', '2016-01-07', 'M', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(222, 'M001', 'MR', '2016-01-08', 'M', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(223, 'M001', 'MR', '2016-01-09', 'M', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(224, 'M001', 'MR', '2016-01-10', 'M', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(225, 'M003', 'MR', '2016-01-04', 'S', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(226, 'M003', 'MR', '2016-01-06', 'S', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(227, 'M003', 'MR', '2016-01-08', 'S', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(228, 'M003', 'MR', '2016-01-10', 'S', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(229, 'M009', 'MR', '2016-01-04', 'S', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(230, 'M009', 'MR', '2016-01-06', 'S', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(231, 'M009', 'MR', '2016-01-08', 'S', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(232, 'M009', 'MR', '2016-01-10', 'S', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(233, 'M002', 'MR', '2016-01-12', 'M', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(234, 'M002', 'MR', '2016-01-14', 'M', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(235, 'M002', 'MR', '2016-01-16', 'M', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(236, 'M001', 'MR', '2016-01-11', 'M', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(237, 'M001', 'MR', '2016-01-12', 'M', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(238, 'M001', 'MR', '2016-01-13', 'M', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(239, 'M001', 'MR', '2016-01-14', 'M', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(240, 'M001', 'MR', '2016-01-15', 'M', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(241, 'M001', 'MR', '2016-01-16', 'M', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(242, 'M001', 'MR', '2016-01-17', 'M', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(243, 'M003', 'MR', '2016-01-12', 'S', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(244, 'M003', 'MR', '2016-01-14', 'S', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(245, 'M003', 'MR', '2016-01-16', 'S', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(246, 'M009', 'MR', '2016-01-12', 'S', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(247, 'M009', 'MR', '2016-01-14', 'S', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(248, 'M009', 'MR', '2016-01-16', 'S', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(249, 'M006', 'MB', '2016-01-04', 'M', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(250, 'M006', 'MB', '2016-01-05', 'M', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(251, 'M006', 'MB', '2016-01-08', 'M', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(252, 'M006', 'MB', '2016-01-09', 'M', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(253, 'M006', 'MB', '2016-01-10', 'M', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(254, 'M008', 'MB', '2016-01-06', 'M', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(255, 'M008', 'MB', '2016-01-07', 'M', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(256, 'M008', 'MB', '2016-01-09', 'S', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(257, 'M008', 'MB', '2016-01-10', 'S', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(258, 'M007', 'MB', '2016-01-04', 'S', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(259, 'M007', 'MB', '2016-01-05', 'S', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(260, 'M007', 'MB', '2016-01-06', 'S', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(261, 'M007', 'MB', '2016-01-07', 'S', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(262, 'M007', 'MB', '2016-01-08', 'S', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `absent` ENABLE KEYS */;


-- Dumping structure for table mod.event
CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tipe` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `user_create` varchar(50) NOT NULL,
  `date_create` datetime NOT NULL,
  `user_update` varchar(50) NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table mod.event: ~3 rows (approximately)
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` (`id`, `kode`, `nama`, `tipe`, `status`, `user_create`, `date_create`, `user_update`, `date_update`) VALUES
	(1, 'MR', 'Moderasi Regular', 'D', 'R', 'damz', '2016-01-03 11:18:12', '', '0000-00-00 00:00:00'),
	(2, 'MM', 'Moderasi Marlboro', 'S', 'R', 'damz', '2016-01-03 11:21:47', '', '0000-00-00 00:00:00'),
	(3, 'MB', 'Moderasi Beat', 'S', 'R', 'damz', '2016-01-03 11:21:58', '', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `event` ENABLE KEYS */;


-- Dumping structure for table mod.event_status
CREATE TABLE IF NOT EXISTS `event_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `user_create` varchar(50) NOT NULL,
  `date_create` datetime NOT NULL,
  `user_update` varchar(50) NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table mod.event_status: ~2 rows (approximately)
/*!40000 ALTER TABLE `event_status` DISABLE KEYS */;
INSERT INTO `event_status` (`id`, `kode`, `nama`, `user_create`, `date_create`, `user_update`, `date_update`) VALUES
	(1, 'R', 'Running', 'damz', '2016-01-03 11:00:31', '', '0000-00-00 00:00:00'),
	(2, 'C', 'Complete', 'damz', '2016-01-03 11:00:45', '', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `event_status` ENABLE KEYS */;


-- Dumping structure for table mod.event_tipe
CREATE TABLE IF NOT EXISTS `event_tipe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `user_create` varchar(50) NOT NULL,
  `date_create` datetime NOT NULL,
  `user_update` varchar(50) NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table mod.event_tipe: ~2 rows (approximately)
/*!40000 ALTER TABLE `event_tipe` DISABLE KEYS */;
INSERT INTO `event_tipe` (`id`, `kode`, `nama`, `user_create`, `date_create`, `user_update`, `date_update`) VALUES
	(1, 'S', 'Single 3 Person', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(2, 'D', 'Double 6 Person', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `event_tipe` ENABLE KEYS */;


-- Dumping structure for table mod.price
CREATE TABLE IF NOT EXISTS `price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event` varchar(10) NOT NULL,
  `shift` varchar(10) NOT NULL,
  `level` varchar(10) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `user_create` varchar(50) NOT NULL,
  `date_create` datetime NOT NULL,
  `user_update` varchar(50) NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table mod.price: ~10 rows (approximately)
/*!40000 ALTER TABLE `price` DISABLE KEYS */;
INSERT INTO `price` (`id`, `event`, `shift`, `level`, `jumlah`, `user_create`, `date_create`, `user_update`, `date_update`) VALUES
	(11, 'MR', 'S', 'MJ', 110000, 'ADM2', '2016-01-10 05:19:02', '', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `price` ENABLE KEYS */;


-- Dumping structure for table mod.schedule
CREATE TABLE IF NOT EXISTS `schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event` varchar(10) NOT NULL,
  `slot` tinyint(4) NOT NULL,
  `user` varchar(10) NOT NULL,
  `shift` varchar(10) NOT NULL,
  `user_create` varchar(50) NOT NULL,
  `date_create` datetime NOT NULL,
  `user_update` varchar(50) NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

-- Dumping data for table mod.schedule: ~4 rows (approximately)
/*!40000 ALTER TABLE `schedule` DISABLE KEYS */;
INSERT INTO `schedule` (`id`, `event`, `slot`, `user`, `shift`, `user_create`, `date_create`, `user_update`, `date_update`) VALUES
	(10, 'MB', 1, 'M007', 'S', 'ADM2', '2016-01-10 04:36:12', '', '0000-00-00 00:00:00'),
	(11, 'MB', 2, 'M007', 'S', 'ADM2', '2016-01-10 04:38:38', '', '0000-00-00 00:00:00'),
	(12, 'MB', 3, 'M007', 'S', 'ADM2', '2016-01-10 04:38:46', '', '0000-00-00 00:00:00'),
	(13, 'MB', 4, 'M007', 'S', 'ADM2', '2016-01-10 04:38:55', '', '0000-00-00 00:00:00'),
	(14, 'MB', 5, 'M007', 'S', 'ADM2', '2016-01-10 04:39:05', '', '0000-00-00 00:00:00'),
	(15, 'MB', 6, 'M008', 'S', 'ADM2', '2016-01-10 04:39:25', 'ADM2', '2016-01-10 04:44:19'),
	(16, 'MB', 7, 'M008', 'S', 'ADM2', '2016-01-10 04:39:37', 'ADM2', '2016-01-10 04:44:11'),
	(17, 'MB', 8, 'M007', 'S', 'ADM2', '2016-01-10 04:42:12', '', '0000-00-00 00:00:00'),
	(18, 'MB', 9, 'M007', 'S', 'ADM2', '2016-01-10 04:42:25', '', '0000-00-00 00:00:00'),
	(19, 'MB', 10, 'M007', 'S', 'ADM2', '2016-01-10 04:42:35', '', '0000-00-00 00:00:00'),
	(20, 'MB', 11, 'M007', 'S', 'ADM2', '2016-01-10 04:42:44', '', '0000-00-00 00:00:00'),
	(21, 'MB', 12, 'M007', 'S', 'ADM2', '2016-01-10 04:42:55', '', '0000-00-00 00:00:00'),
	(22, 'MB', 13, 'M006', 'S', 'ADM2', '2016-01-10 04:43:03', 'ADM2', '2016-01-10 04:43:58'),
	(23, 'MB', 14, 'M006', 'S', 'ADM2', '2016-01-10 04:43:11', 'ADM2', '2016-01-10 04:43:47'),
	(24, 'MB', 1, 'M006', 'M', 'ADM2', '2016-01-10 04:36:12', '', '0000-00-00 00:00:00'),
	(25, 'MB', 2, 'M006', 'M', 'ADM2', '2016-01-10 04:38:38', '', '0000-00-00 00:00:00'),
	(26, 'MB', 3, 'M008', 'M', 'ADM2', '2016-01-10 04:38:46', '', '0000-00-00 00:00:00'),
	(27, 'MB', 4, 'M008', 'M', 'ADM2', '2016-01-10 04:38:55', '', '0000-00-00 00:00:00'),
	(28, 'MB', 5, 'M006', 'M', 'ADM2', '2016-01-10 04:39:05', '', '0000-00-00 00:00:00'),
	(29, 'MB', 6, 'M006', 'M', 'ADM2', '2016-01-10 04:39:25', 'ADM2', '2016-01-10 04:44:19'),
	(30, 'MB', 7, 'M006', 'M', 'ADM2', '2016-01-10 04:39:37', 'ADM2', '2016-01-10 04:44:11'),
	(31, 'MB', 8, 'M008', 'M', 'ADM2', '2016-01-10 04:42:12', '', '0000-00-00 00:00:00'),
	(32, 'MB', 9, 'M008', 'M', 'ADM2', '2016-01-10 04:42:25', '', '0000-00-00 00:00:00'),
	(33, 'MB', 10, 'M006', 'M', 'ADM2', '2016-01-10 04:42:35', '', '0000-00-00 00:00:00'),
	(34, 'MB', 11, 'M006', 'M', 'ADM2', '2016-01-10 04:42:44', '', '0000-00-00 00:00:00'),
	(35, 'MB', 12, 'M008', 'M', 'ADM2', '2016-01-10 04:42:55', '', '0000-00-00 00:00:00'),
	(36, 'MB', 13, 'M008', 'M', 'ADM2', '2016-01-10 04:43:03', 'ADM2', '2016-01-10 04:43:58'),
	(37, 'MB', 14, 'M008', 'M', 'ADM2', '2016-01-10 04:43:11', 'ADM2', '2016-01-10 04:43:47');
/*!40000 ALTER TABLE `schedule` ENABLE KEYS */;


-- Dumping structure for table mod.shift
CREATE TABLE IF NOT EXISTS `shift` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `user_create` varchar(50) NOT NULL,
  `date_create` datetime NOT NULL,
  `user_update` varchar(50) NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table mod.shift: ~3 rows (approximately)
/*!40000 ALTER TABLE `shift` DISABLE KEYS */;
INSERT INTO `shift` (`id`, `kode`, `nama`, `user_create`, `date_create`, `user_update`, `date_update`) VALUES
	(1, 'S', 'Siang', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(2, 'M', 'Malam', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(7, 'T', 'Training', 'damz', '2016-01-03 12:34:55', '', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `shift` ENABLE KEYS */;


-- Dumping structure for table mod.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(10) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `ip_login` varchar(50) NOT NULL,
  `date_login` datetime NOT NULL,
  `user_agent` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `user_create` varchar(50) NOT NULL,
  `date_create` datetime NOT NULL,
  `user_update` varchar(50) NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table mod.user: ~11 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `kode`, `nama`, `nickname`, `username`, `password`, `level`, `photo`, `ip_login`, `date_login`, `user_agent`, `status`, `user_create`, `date_create`, `user_update`, `date_update`) VALUES
	(1, 'M001', 'Wahyu Suprianto', 'Wahyu', '', '', 'MS', '', '', '0000-00-00 00:00:00', '', 'ON', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(2, 'M002', 'Wisnu Andika', 'Wisnu', '', '', 'MS', '', '', '0000-00-00 00:00:00', '', 'ON', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(3, 'M003', 'Eva Ambarwati', 'Eva', '', '', 'MS', '', '', '0000-00-00 00:00:00', '', 'ON', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(4, 'M004', 'Rozalino Geovany', 'Geo', '', '', 'MS', '', '', '0000-00-00 00:00:00', '', 'ON', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(5, 'M005', 'Yanuar Irianto', 'Yeyen', '', '', 'MS', '', '', '0000-00-00 00:00:00', '', 'ON', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(6, 'M006', 'Hardiansyah', 'Adi', '', '', 'MS', '', '', '0000-00-00 00:00:00', '', 'ON', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(7, 'M007', 'Titik Wijayanti', 'Titik', '', '', 'MS', '', '', '0000-00-00 00:00:00', '', 'ON', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(8, 'M008', 'Bayu Asmoro', 'Bayu', 'asd', 'asd', 'MS', '', '', '0000-00-00 00:00:00', '', 'ON', '', '0000-00-00 00:00:00', 'ADM2', '2016-01-09 10:09:38'),
	(9, 'M009', 'Dika Martha Lukitasari', 'Martha', 'martha', '123', 'MJ', '', '', '0000-00-00 00:00:00', '', 'ON', '', '0000-00-00 00:00:00', 'ADM2', '2016-01-09 03:41:43'),
	(10, 'ADM1', 'Irfan Hamidal', 'Babeh', 'babeh', '321', 'ADM', '4395131a55b3547c13f2db9b78ea6143.jpg', '127.0.0.1', '2016-01-03 04:37:36', 'Windows 7(Google Chrome 47.0.2526.106)', 'ON', '', '0000-00-00 00:00:00', 'damz', '2016-01-03 04:22:02'),
	(11, 'ADM2', 'Adam Prasetia', 'Adam', 'damz', '123', 'ADM', '4490c46e4b3566b8a79bc566b989f697.jpg', '127.0.0.1', '2016-01-10 02:33:52', 'Windows 7(Google Chrome 47.0.2526.106)', 'ON', '', '0000-00-00 00:00:00', 'ADM2', '2016-01-09 18:53:57');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


-- Dumping structure for table mod.user_event
CREATE TABLE IF NOT EXISTS `user_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(10) NOT NULL,
  `event` varchar(10) NOT NULL,
  `user_create` varchar(50) NOT NULL,
  `date_create` datetime NOT NULL,
  `user_update` varchar(50) NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Dumping data for table mod.user_event: ~12 rows (approximately)
/*!40000 ALTER TABLE `user_event` DISABLE KEYS */;
INSERT INTO `user_event` (`id`, `user`, `event`, `user_create`, `date_create`, `user_update`, `date_update`) VALUES
	(3, 'M007', 'MB', 'damz', '2016-01-03 12:09:15', '', '0000-00-00 00:00:00'),
	(4, 'M008', 'MB', 'damz', '2016-01-03 12:09:20', '', '0000-00-00 00:00:00'),
	(5, 'M006', 'MB', 'damz', '2016-01-03 12:09:29', '', '0000-00-00 00:00:00'),
	(6, 'M009', 'MR', 'damz', '2016-01-03 12:10:03', '', '0000-00-00 00:00:00'),
	(7, 'M003', 'MR', 'damz', '2016-01-03 12:10:11', '', '0000-00-00 00:00:00'),
	(8, 'M001', 'MR', 'damz', '2016-01-03 12:10:37', '', '0000-00-00 00:00:00'),
	(9, 'M005', 'MR', 'damz', '2016-01-03 12:10:43', '', '0000-00-00 00:00:00'),
	(10, 'M002', 'MR', 'damz', '2016-01-03 12:10:51', '', '0000-00-00 00:00:00'),
	(11, 'M004', 'MR', 'damz', '2016-01-03 12:10:57', '', '0000-00-00 00:00:00'),
	(12, 'M001', 'MM', 'ADM2', '2016-01-09 10:54:06', '', '0000-00-00 00:00:00'),
	(13, 'M002', 'MM', 'ADM2', '2016-01-09 10:54:11', '', '0000-00-00 00:00:00'),
	(14, 'M003', 'MM', 'ADM2', '2016-01-09 10:54:16', '', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `user_event` ENABLE KEYS */;


-- Dumping structure for table mod.user_level
CREATE TABLE IF NOT EXISTS `user_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `user_create` varchar(50) NOT NULL,
  `date_create` datetime NOT NULL,
  `user_update` varchar(50) NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table mod.user_level: ~3 rows (approximately)
/*!40000 ALTER TABLE `user_level` DISABLE KEYS */;
INSERT INTO `user_level` (`id`, `kode`, `nama`, `user_create`, `date_create`, `user_update`, `date_update`) VALUES
	(1, 'ADM', 'Admin', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(2, 'MJ', 'Moderator Junior', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
	(3, 'MS', 'Moderator Senior', 'damz', '2016-01-03 03:06:57', '', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `user_level` ENABLE KEYS */;


-- Dumping structure for table mod.user_status
CREATE TABLE IF NOT EXISTS `user_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `user_create` varchar(50) NOT NULL,
  `date_create` datetime NOT NULL,
  `user_update` varchar(50) NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table mod.user_status: ~2 rows (approximately)
/*!40000 ALTER TABLE `user_status` DISABLE KEYS */;
INSERT INTO `user_status` (`id`, `kode`, `nama`, `user_create`, `date_create`, `user_update`, `date_update`) VALUES
	(1, 'ON', 'Aktif', '', '2015-10-31 14:00:03', 'damz', '2015-11-28 02:32:32'),
	(2, 'OFF', 'Tidak Aktif', '', '2015-10-31 14:00:03', 'damz', '2015-11-28 02:32:22');
/*!40000 ALTER TABLE `user_status` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
