-- phpMyAdmin SQL Dump
-- version 4.1.13
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 02, 2014 at 10:05 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `doc_report`
--

-- --------------------------------------------------------

--
-- Table structure for table `poc_location`
--

CREATE TABLE IF NOT EXISTS `poc_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL,
  `lat` varchar(16) NOT NULL,
  `long` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `poc_location`
--

INSERT INTO `poc_location` (`id`, `name`, `lat`, `long`) VALUES
(1, 'Bangkok', '13.727896', '100.524123'),
(2, 'Chaingmai', '18.787744', '98.993119'),
(3, 'Suratthani', '9.138239', '99.321748'),
(4, 'Nongkhai', '17.878280', '102.741264');

-- --------------------------------------------------------

--
-- Table structure for table `poc_threat`
--

CREATE TABLE IF NOT EXISTS `poc_threat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `poc_threat`
--

INSERT INTO `poc_threat` (`id`, `location_id`, `qty`, `create_at`, `updated_at`) VALUES
(1, 1, 5, '2014-09-02 04:16:53', '0000-00-00 00:00:00'),
(2, 1, 600, '2014-09-02 04:16:53', '0000-00-00 00:00:00'),
(3, 1, 4000, '2014-09-02 04:16:53', '0000-00-00 00:00:00'),
(4, 2, 14, '2014-09-02 04:16:53', '0000-00-00 00:00:00'),
(5, 2, 40, '2014-09-02 04:16:53', '0000-00-00 00:00:00'),
(6, 3, 65, '2014-09-02 04:16:53', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
