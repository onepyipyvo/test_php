-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.58 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for test_data
CREATE DATABASE IF NOT EXISTS `test_data` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `test_data`;

-- Dumping structure for table test_data.authors
CREATE TABLE IF NOT EXISTS `authors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `authname` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table test_data.authors: ~3 rows (approximately)
DELETE FROM `authors`;
/*!40000 ALTER TABLE `authors` DISABLE KEYS */;
INSERT INTO `authors` (`id`, `authname`) VALUES
	(1, 'author 1'),
	(2, 'author 2'),
	(3, 'author 3');
/*!40000 ALTER TABLE `authors` ENABLE KEYS */;

-- Dumping structure for table test_data.books
CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description_b` text NOT NULL,
  `image_b` varchar(255) NOT NULL,
  `author` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author` (`author`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- Dumping data for table test_data.books: ~2 rows (approximately)
DELETE FROM `books`;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` (`id`, `title`, `description_b`, `image_b`, `author`) VALUES
	(13, 'test 5', '                                                                                                Дисидентський рух в Україні                                                                                ', '66a2ff27e3170ec2292ed1d638a1aea91a1888e11550230042', 3),
	(17, 'test iage', 'active page menu\r\nphp errors handling\r\njs errors handling\r\ndescription view\r\nimage show', 'IMG_4518.JPG', 3),
	(18, 'test adding', 'Test description test test', '4-27-696x367.jpg', 3),
	(19, 'test json 2', 'test description parse json', 'chernyj-voron.jpg', 2),
	(20, 'test image 444', 'test description handle response', 'ajun0807ravens124.jpg', 2),
	(21, 'test image 444', 'test description handle response', 'ajun0807ravens124.jpg', 2),
	(22, 't2 dfgfdgfdgdgdfg', 'active page menu\r\nphp errors handling\r\njs errors handling\r\ndescription view\r\nimage show', 'depositphotos_10803150-stock-illustration-ravens-set.jpg', 1),
	(23, 't2 dfgfdgfdgdgdfg', 'active page menu\r\nphp errors handling\r\njs errors handling\r\ndescription view\r\nimage show', 'depositphotos_10803150-stock-illustration-ravens-set.jpg', 1);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
