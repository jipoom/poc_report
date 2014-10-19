-- phpMyAdmin SQL Dump
-- version 4.1.13
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 19, 2014 at 04:26 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `report`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE IF NOT EXISTS `area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `found_at_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `name`, `found_at_id`) VALUES
(1, 'โรงจอดรถเรือนจำ', 1),
(2, 'ร้านค้าสงเคราะห์ผู้ต้องขัง', 1),
(3, 'บริเวณแนวรอบรั้วกําแพงรอบเรือนจํา/ทัณฑสถาน', 1),
(4, 'ร้านค้าทั่วไปหน้าเรือนจํา', 1),
(5, 'ประตูเรือนจํา/ทัณฑสถาน', 1),
(6, 'ตู้จดหมายเรือนจํา/ทัณฑสถาน', 1),
(7, 'ท่อระบายน้ํารอบเรือนจํา/ทัณฑสถาน', 1),
(8, 'บ้านพักข้าราชการเรือนจํา/ทัณฑสถาน', 1),
(9, 'ตะกร้าเสื้อผ้า', 1),
(10, 'เจ้าหน้าที่เรือนจำ/ทัณฑสถาน', 1),
(11, 'แดนแรกรับผู้ต้องขังเข้าใหม่', 2),
(12, 'เขตควบคุมพิเศษ', 2),
(13, 'แดนประหาร', 2),
(14, 'แดนผู้ร้ายรายสําคัญ', 2),
(15, 'แดนการศึกษา', 2),
(16, 'ห้องขังเดี่ยว', 2),
(17, 'สถานพยาบาล', 2),
(18, 'สูทกรรม', 2),
(19, 'โรงเลี้ยง', 2),
(20, 'โรงงานฝึกวิชาชีพ', 2),
(21, 'ท่อระบายน้ำในแดน', 2),
(22, 'อ่างอาบน้ำ/บล็อคส้วม', 2),
(23, 'แดนอื่นๆ', 2),
(24, 'เรือนนอน', 2),
(25, 'ฝ้าเพดาน', 2),
(26, 'พื้นห้องนอน', 2),
(27, 'ใต้ถุนอาคารเรือนนอน', 2),
(28, 'บริเวณรอบอาคารเรือนนอน', 2),
(29, 'ร้านค้าสงเคราะห์ผู้ต้องขัง', 2),
(30, 'สนามกีฬาฟุตบอล/ตะกร้อ/เปตอง/อื่นๆ', 2),
(31, 'แนวรอบรั้วกำแพงภายในเรือนจำ/ทัณฑสถาน', 2),
(32, 'ป้อมยามรอบรั้วกำแพง', 2),
(33, 'รถส่งอาหารเรือนจำ', 2),
(34, 'รถส่งวัสดุอุปกรณ์โรงงานฝึกวิชาชีพ', 2),
(35, 'บุคคลภายนอก/ตำรวจ/ทนายความ/วิทยากรวิชาชีพต่างๆ', 2),
(36, 'เจ้าหน้าที่เรือนจำ/ทัณฑสถาน', 2);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'สิ่งของต้องห้าม'),
(2, 'ยาเสพติด');

-- --------------------------------------------------------

--
-- Table structure for table `found_at`
--

CREATE TABLE IF NOT EXISTS `found_at` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `found_at`
--

INSERT INTO `found_at` (`id`, `name`) VALUES
(1, 'สกัดกั้นก่อนเข้าเรือนจำ'),
(2, 'พบภายในเรือนจำ');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `unit` varchar(64) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `unit`, `category_id`) VALUES
(0, 'ไม่พบ', 'ไม่พบ', 0),
(1, 'ยาบ้า', 'เม็ด', 2),
(2, 'ไอซ์', 'กรัม', 2),
(3, 'เฮโรอีน', 'กรัม', 2),
(4, 'กัญชา', 'กรัม', 2),
(5, 'ยาเมา', 'เม็ด', 2),
(6, 'ฝิ่น', 'กรัม', 2),
(7, 'สุราหรือของมึนเมาอย่างอื่น', 'ชิ้น', 0),
(8, 'อุปกรณ์สำหรับเล่นการพนัน', 'ชิ้น', 0),
(9, 'เครื่องมืออันเป็นอุปกรณ์ในการหลบหนี', 'ชิ้น', 0),
(10, 'อาวุธ เครื่องกระสุนปืน วัตถุระเบิด ดอกไม้เพลิง และสิ่งเทียมอาวุธปืน', 'ชิ้น', 0),
(11, 'อาวุธดัดแปลง เหล็กแหลม', 'อัน', 0),
(12, 'ของเน่าเสีย หรือของมีพิษต่อร่างกาย', 'ชิ้น', 0),
(13, 'น้ำมันเชื้อเพลิง', 'ชิ้น', 0),
(14, 'สัตว์มีชีวิต', 'ตัว', 0),
(15, 'เครื่องคอมพิวเตอร์', 'ชิ้น', 0),
(16, 'โทรศัพท์มือถือ', 'ชิ้น', 1),
(17, 'แบตเตอรี่', 'ชิ้น', 0),
(18, 'ซิมการ์ด', 'ชิ้น', 1),
(19, 'เมมโมรี่การ์ด', 'ชิ้น', 0),
(20, 'หูฟัง/บลูธูท', 'ชิ้น', 0),
(21, 'อุปกรณ์ชาร์จแบตเตอรี่', 'ชิ้น', 0),
(22, 'วัตถุ เอกสารหรือสิ่งพิมพ์ซึ่งอาจก่อให้เกิดความไม่สงบเรียบร้อย หรือเสื่อมต่อศีลธรรมอันดีของประชาชน', 'ชิ้น', 0),
(23, 'อื่นๆ', 'หน่วย', 0);

-- --------------------------------------------------------

--
-- Table structure for table `khets`
--

CREATE TABLE IF NOT EXISTS `khets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `khets`
--

INSERT INTO `khets` (`id`, `name`) VALUES
(1, 'เขต1'),
(2, 'เขต2'),
(3, 'เขต3'),
(4, 'เขต4'),
(5, 'เขต5'),
(6, 'เขต6'),
(7, 'เขต7'),
(8, 'เขต8'),
(9, 'เขต9'),
(10, 'เขตอิสระ');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `latitude` varchar(32) NOT NULL,
  `longitude` varchar(32) NOT NULL,
  `khet_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=198 ;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `fullname`, `latitude`, `longitude`, `khet_id`) VALUES
(0, 'อธิบดีกรมราชทัณฑ์', '', '0', '0', 0),
(1, 'ศปส.', '', '0', '0', 0),
(2, 'รจ.ก.บางขวาง', 'เรือนจำกลางบางขวาง', '13.8454159', '100.4916459', 10),
(3, 'รจ.ก.คลองเปรม', 'เรือนจำกลางคลองเปรม', '13.8505813', '100.5557528', 10),
(4, 'ทส.รพ.รท.', 'ทัณฑสถานโรงพยาบาลราชทัณฑ์', '0', '0', 10),
(5, 'รจ.พ.กรุงเทพ', 'เรือนจำพิเศษกรุงเทพ', '0', '0', 10),
(6, 'รจ.พ.ธนบุรี', 'เรือนจำพิเศษธนบุรี', '0', '0', 10),
(7, 'ทส.บ.กลาง', 'ทัณฑสถานบำบัดพิเศษกลาง', '0', '0', 10),
(8, 'ทส.ว.กลาง', 'ทัณสถานวัยหนุ่มกลาง', '0', '0', 10),
(9, 'ทส.ญ.กลาง', 'ทัณสถานหญิงกลาง', '0', '0', 10),
(10, 'รจ.ก.คลองไผ่', 'เรือนจำกลางคลองไผ่', '0', '0', 10),
(11, 'รจ.ช.คลองไผ่', 'เรือนจำชั่วคราวคลองไผ่', '0', '0', 10),
(12, 'รจ.ก.นครศรีธรรมราช', 'เรือนจำกลางนครศรีธรรมราช', '0', '0', 10),
(13, 'รจ.พ.นครศรีธรรมราช', 'เรือนจำพิเศษนครศรีธรรมราช', '0', '0', 10),
(14, 'รจ.ช.เขาหมาก', 'เรือนจำชั่วคราวเขาหมาก', '', '', 10),
(15, 'รจ.ก.นครสวรรค์', 'เรือนจำกลางนครสวรรค์', '', '', 10),
(16, 'รจ.ช.นครสวรรค์', 'เรือนจำชั่วคราวนครสวรรค์', '', '', 10),
(17, 'รจ.ช.คลองโพธิ์', 'เรือนจำชั่วคราวคลองโพธิ์', '', '', 10),
(18, 'รจ.ก.ระยอง', 'เรือนจำกลางระยอง', '', '', 10),
(19, 'รจ.พ.ระยอง', 'เรือนจำพิเศษระยอง', '', '', 10),
(20, 'รจ.ช.เขาไม้แก้ว', 'เรือนจำชั่วคราวเขาไม้แก้ว', '', '', 10),
(21, 'รจ.ก.ราชบุรี', 'เรือนจำกลางราชบุรี', '', '', 10),
(22, 'รจ.พ.ราชบุรี', 'เรือนจำพิเศษราชบุรี', '', '', 10),
(23, 'รจ.ช.เขาบิน', 'เรือนจำชั่วคราวเขาบิน', '', '', 10),
(24, 'รจ.ก.เขาบิน', 'เรือนจำกลางเขาบิน', '', '', 10),
(25, 'ทส.บ.หญิง', 'ทัณฑสถานบำบัดพิเศษหญิงธัญบุรี', '', '', 10),
(26, 'ทัณฑสถานหญิงนครราชสีมา', '', '', '', 10),
(27, 'รจ.พ.มีนบุรี', 'เรือนจำพิเศษมีนบุรี', '', '', 1),
(28, 'ทส.ญ. ธนบุรี', 'ทัณฑสถานหญิงธนบุรี', '', '', 1),
(29, 'รจ.จ.ชัยนาท', 'เรือนจำจังหวัดชัยนาท', '', '', 1),
(30, 'รจ.ช.เขาพลอง', 'เรือนจำชั่วคราวเขาพลอง', '', '', 1),
(31, 'รจ.จ.นนทบุรี', 'เรือนจำจังหวัดนนทบุรี', '', '', 1),
(32, 'รจ.จ.ปทุมธานี', 'เรือนจำจังหวัดปทุมธานี', '', '', 1),
(33, 'รจ.อ.ธัญบุรี', 'เรือนจำอำเภอธัญบุรี', '', '', 1),
(34, 'ทส.บ.ปทุมธานี', 'ทัณฑสถานบำบัดพิเศษปทุมธานี', '', '', 1),
(35, 'รจ.ก.อยุธยา', 'เรือนจำกลางพระนครศรีอยุธยา', '', '', 1),
(36, 'รจ.จ.อยุธยา', 'เรือนจำจังหวัดพระนครศรีอยุธยา', '', '', 1),
(37, 'ทส.บ.อยุธยา', 'ทัณฑสถานบำบัดพิเศษพระนครศรีอยุธยา', '', '', 1),
(38, 'ทส.ว.อยุธยา', 'ทัณฑสถานวัยหนุ่มพระนครศรีอยุธยา', '', '', 1),
(39, 'รจ.ก.ลพบุรี', 'เรือนจำกลางลพบุรี', '', '', 1),
(40, 'รจ.พ.ลพบุรี', 'เรือนจำพิเศษลพบุรี', '', '', 1),
(41, 'รจ.พ.สมุทรปราการ', 'เรือนจำพิเศษสมุทรปราการ', '', '', 1),
(42, 'รจ.จ.สระบุรี', 'เรือนจำจังหวัดสระบุรี', '', '', 1),
(43, 'รจ.จ.สิงห์บุรี', 'เรือนจำจังหวัดสิงห์บุรี', '', '', 1),
(44, 'รจ.จ.อ่างทอง', 'เรือนจำจังหวัดอ่างทอง', '', '', 1),
(45, 'รจ.อ.ชัยบาดาล', 'เรือนจำอำเภอชัยบาดาล', '', '', 1),
(46, 'สกข.จ.ปทุมธานี', 'สถานกักขังกลาง จังหวัดปทุมธานี', '', '', 1),
(47, 'รจ.ก.สมุทรปราการ', 'เรือนจำกลางสมุทรปราการ', '', '', 1),
(48, 'รจ.ก.ฉะเชิงเทรา', 'เรือนจำกลางฉะเชิงเทรา', '', '', 2),
(49, 'รจ.พ.ฉะเชิงเทรา', 'เรือนจำพิเศษฉะเชิงเทรา', '', '', 2),
(50, 'รจ.ก.ชลบุรี', 'เรือนจำกลางชลบุรี', '', '', 2),
(51, 'รจ.พ.ชลบุรี', 'เรือนจำพิเศษชลบุรี', '', '', 2),
(52, 'รจ.ช.บ้านบึง', 'เรือนจำชั่วคราวบ้านบึง(ชลบุรี)', '', '', 2),
(53, 'รจ.พ.พัทยา', 'เรือนจำพิเศษพัทยา', '', '', 2),
(54, 'ทส.ญ.ชลบุรี', 'ทัณฑสถานหญิงชลบุรี', '', '', 2),
(55, 'รจ.จ.ตราด', 'เรือนจำจังหวัดตราด', '', '', 2),
(56, 'รจ.ช.เขาระกำ', 'เรือนจำชั่วคราวเขาระกำ(ตราด)', '', '', 2),
(57, 'รจ.จ.นครนายก', 'เรือนจำจังหวัดนครนายก', '', '', 2),
(58, 'รจ.จ.ปราจีนบุรี', 'เรือนจำจังหวัดปราจีนบุรี', '', '', 2),
(59, 'ทส.ป.บ้านเนินสูง', 'ทัณฑสถานเปิดบ้านเนินสูง(ปราจีนบุรี)', '', '', 2),
(60, 'ทส.ป.ห้วยโป่ง', 'ทัณฑสถานเปิดห้วยโป่ง(ระยอง)', '', '', 2),
(61, 'รจ.จ.สระแก้ว', 'เรือนจำจังหวัดสระแก้ว', '', '', 2),
(62, 'รจ.อ.กบินทร์บุรี', 'เรือนจำอำเภอกบินทร์บุรี', '', '', 2),
(63, 'สกข.จ.ตราด', 'สถานกักขังกลางจังหวัดตราด', '', '', 2),
(64, 'รจ.จ.ชัยภูมิ', 'เรือนจำจังหวัดชัยภูมิ', '', '', 3),
(65, 'รจ.อ.ภูเขียว', 'เรือนจำอำเภอภูเขียว(ชัยภูมิ)', '', '', 3),
(66, 'รจ.ก.นครราชสีมา', 'เรือนจำกลางนครราชสีมา', '', '', 3),
(67, 'รจ.พ.นครราชสีมา', 'เรือนจำพิเศษนครราชสีมา', '', '', 3),
(68, 'รจ.ช.พิมาย', 'เรือนจำชั่วคราวพิมาย(นครราชสีมา)', '', '', 3),
(69, 'ทส.เกษตรอุตสาหกรรมเขาพริก', 'ทัณฑสถานเกษตรอุตสาหกรรมเขาพริก', '', '', 3),
(70, 'รจ.อ.สีคิ้ว', 'เรือนจำอำเภอสีคิ้ว(นครราชสีมา)', '', '', 3),
(71, 'รจ.จ.บุรีรัมย์', 'เรือนจำจังหวัดบุรีรัมย์', '', '', 3),
(72, 'รจ.ช.โคกมะตูม', 'เรือนจำชั่วคราวโคกมะตูม(บุรีรัมย์)', '', '', 3),
(73, 'รจ.อ.นางรอง', 'เรือนจำอำเภอนางรอง', '', '', 3),
(74, 'รจ.จ.ยโสธร', 'เรือนจำจังหวัดยโสธร', '', '', 3),
(75, 'รจ.จ.ศรีสะเกษ', 'เรือนจำจังหวัดศรีษะเกษ', '', '', 3),
(76, 'รจ.ก.สุรินทร์', 'เรือนจำกลางสุรินทร์', '', '', 3),
(77, 'รจ.พ.สุรินทร์', 'เรือนจำพิเศษสุรินทร์', '', '', 3),
(78, 'รจ.ช.โคกตาบัน', 'เรือนจำชั่วคราวโคกตาบัน(สุรินทร์)', '', '', 3),
(79, 'รจ.จ.อำนาจเจริญ', 'เรือนจำจังหวัดอำนาจเจริญ', '', '', 3),
(80, 'รจ.ก.อุบลราชธานี', 'เรือนจำกลางอุบลราชธานี', '', '', 3),
(81, 'รจ.อ.บัวใหญ่', 'เรือนจำอำเภอบัวใหญ่', '', '', 3),
(82, 'รจ.อ.รัตนบุรี', 'เรือนจำอำเภอรัตนบุรี', '', '', 3),
(83, 'รจ.อ.กันทรลักษ์', 'เรือนจำอำเภอกันทรลักษ์', '', '', 3),
(84, 'ทส.ญ.นครราชสีมา', 'ทัณฑสถานหญิงนครราชสีมา', '', '', 3),
(85, 'รจจ.กาฬสินธุ์', 'เรือนจำจังหวัดกาฬสินธุ์', '', '', 4),
(86, 'รจ.ช.โคกคำม่วง', 'เรือนจำชั่วคราวโคกคำม่วง(กาฬสินธุ์)', '', '', 4),
(87, 'รจ.ก.ขอนแก่น', 'เรือนจำกลางขอนแก่น', '', '', 4),
(88, 'รจ.พ.ขอนแก่น', 'เรือนจำพิเศษขอนแก่น', '', '', 4),
(89, 'รจ.อ.พล', 'เรือนจำอำเภอพล', '', '', 4),
(90, 'ทส.บ.ขอนแก่น', 'ทัณฑสถานบำบัดพิเศษข่อนแก่น', '', '', 4),
(91, 'รจ.ก.นครพนม', 'เรือนจำกลางนครพนม', '', '', 4),
(92, 'รจ.พ.นครพนม', 'เรือนจำพิเศษนครพนม', '', '', 4),
(93, 'รจ.จ.มหาสารคาม', 'เรือนจำจังหวัดมหาสารคาม', '', '', 4),
(94, 'รจ.จ.มุกดาหาร', 'เรือนจำจังหวัดมุกดาหาร', '', '', 4),
(95, 'รจ.จ.ร้อยเอ็ด', 'เรือนจำจังหวัดร้อยเอ็ด', '', '', 4),
(96, 'รจ.ช.รอบเมือง', 'เรือนจำชั่วคราวรอบเมือง(ร้อยเอ็ด)', '', '', 4),
(97, 'รจ.จ.เลย', 'เรือนจำจังหวัดเลย', '', '', 4),
(98, 'รจ.จ.สกลนคร', 'เรือนจำจังหวัดสกลนคร', '', '', 4),
(99, 'รจ.ช.นาอ้อย', 'เรือนจำชั่วคราวนาอ้อย(สกลนคร)', '', '', 4),
(100, 'รจ.อ.สว่างแดนดิน', 'เรือนจำอำเภอสว่างแดนดิน(สกลนคร)', '', '', 4),
(101, 'รจ.จ.หนองคาย', 'เรือนจำจังหวัดหนองคาย', '', '', 4),
(102, 'รจ.จ.บึงกาฬ', 'เรือนจำอำเภอบึงกาฬ(หนองคาย)', '', '', 4),
(103, 'รจ.จ.หนองบัวลำภู', 'เรือนจำจังหวัดหนองบัวลำภู', '', '', 4),
(104, 'รจ.ก.อุดรธานี', 'เรือนจำกลางอุดรธานี', '', '', 4),
(105, 'รจ.พ.อุดรธานี', 'เรือนจำพิเศษอุดรธานี', '', '', 4),
(106, 'สกข.จ.ร้อยเอ็ด', 'สถานกักขังจังหวัดร้อยเอ็ด', '', '', 4),
(107, 'รจ.ก.เชียงราย', 'เรือนจำกลางเชียงราย', '', '', 5),
(108, 'รจ.พ.เชียงราย', 'เรือนจำพิเศษเชียงราย', '', '', 5),
(109, 'รจ.ก.เชียงใหม่', 'เรือนจำกลางเชียงใหม่', '', '', 5),
(110, 'รจ.พ.เชียงใหม่', 'เรือนจำพิเศษเชียงใหม่', '', '', 5),
(111, 'ทส.ญ.เชียงใหม่', 'ทัณฑสถานหญิงเชียงใหม่', '', '', 5),
(112, 'รจ.อ.ฝาง', 'เรือนจำอำเภอฝาง', '', '', 5),
(113, 'รจ.จ.น่าน', 'เรือนจำจังหวัดน่าน', '', '', 5),
(114, 'รจ.ช.เขาน้อย', 'เรือนจำชั่วคราวเขาน้อย', '', '', 5),
(115, 'รจ.จ.พะเยา', 'เรือนจำจังหวัดพะเยา', '', '', 5),
(116, 'รจ.จ.แพร่', 'เรือนจำจังหวัดแพร่', '', '', 5),
(117, 'รจ.จ.แม่ฮ่องสอน', 'เรือนจำจังหวัดแม่ฮ่องสอน', '', '', 5),
(118, 'รจ.ก.ลำปาง', 'เรือนจำกลางลำปาง', '', '', 5),
(119, 'รจ.พ.ลำปาง', 'เรือนจำพิเศษลำปาง', '', '', 5),
(120, 'ทส.บ.ลำปาง', 'ทัณฑสถานบำบัดพิเศษลำปาง', '', '', 5),
(121, 'รจ.จ.ลำพูน', 'เรือนจำจังหวัดลำพูน', '', '', 5),
(122, 'รจ.อ.เทิง', 'เรือนจำอำเภอเทิง', '', '', 5),
(123, 'สกข.จ.ลำปาง', 'สถานกักขังกลางจังหวัดลำปาง', '', '', 5),
(124, 'รจ.ช.ปงยางคก', 'เรือนจำชั่วคราวปงยางคก', '', '', 5),
(125, 'รจ.อ.แม่สะเรียง', 'เรือนจำอำเภอแม่สะเรียง', '', '', 5),
(126, 'รจ.ก.กำแพงเพชร', 'เรือนจำกลางกำแพงเพชร', '', '', 6),
(127, 'รจ.พ.กำแพงเพชร', 'เรือนจำพิเศษกำแพงเพชร', '', '', 6),
(128, 'รจ.ก.ตาก', 'เรือนจำกลางตาก', '', '', 6),
(129, 'รจ.พ.ตาก', 'เรือนจำพิเศษตาก', '', '', 6),
(130, 'รจ.อ.แม่สอด', 'เรือนจำอำเภอแม่สอด', '', '', 6),
(131, 'ทส.ป.หนองน้ำขุ่น', 'ทัณฑสถานเปิดหนองน้ำขุ่น', '', '', 6),
(132, 'รจ.จ.พิจิตร', 'เรือนจำจังหวัดพิจิตร', '', '', 6),
(133, 'รจ.ก.พิษณุโลก', 'เรือนจำกลางพิษณุโลก', '', '', 6),
(134, 'รจ.จ.พิษณุโลก', 'เรือนจำจังหวัดพิษณุโลก', '', '', 6),
(135, 'รจ.จ.เพชรบูรณ์', 'เรือนจำจังหวัดเพชรบูรณ์', '', '', 6),
(136, 'รจ.ช.แคน้อย', 'เรือนจำชั่วคราวแคน้อย', '', '', 6),
(137, 'รจ.อ.หล่มสัก', 'เรือนจำอำเภอหล่มสัก', '', '', 6),
(138, 'ทส.ญ.พิษณุโลก', 'ทัณฑสถานหญิงพิษณุโลก', '', '', 6),
(139, 'รจ.จ.สุโขทัย', 'เรือนจำจังหวัดสุโขทัย', '', '', 6),
(140, 'รจ.อ.สวรรคโลก', 'เรือนจำอำเภอสวรรคโลก', '', '', 6),
(141, 'รจ.ช.หนองเรียง', 'เรือนจำชั่วคราวหนองเรียง', '', '', 6),
(142, 'รจ.จ.อุตรดิตถ์', 'เรือนจำจังหวัดอุตรดิตถ์', '', '', 6),
(143, 'รจ.จ.อุทัยธานี', 'เรือนจำจังหวัดอุทัยธานี', '', '', 6),
(144, 'รจ.ช.ห้วยหินฝน', 'เรือนจำชั่วคราวห้วยหินฝน', '', '', 6),
(145, 'รจ.จ.กาญจนบุรี', 'เรือนจำจังหวัดกาญจนบุรี', '', '', 7),
(146, 'รจ.อ.ทองผาภูมิ', 'เรือนจำอำเภอทองผาภูมิ', '', '', 7),
(147, 'รจ.ก.นครปฐม', 'เรือนจำกลางนครปฐม', '', '', 7),
(148, 'รจ.พ.นครปฐม', 'เรือนจำพิเศษนครปฐม', '', '', 7),
(149, 'รจ.ช.วังตะกู', 'เรือนจำชั่วคราววังตะกู', '', '', 7),
(150, 'รจ.จ.ประจวบคีรีขันธ์', 'เรือนจำจังหวัดประจวบคีรีขันธ์', '', '', 7),
(151, 'รจ.ก.เพชรบุรี', 'เรือนจำกลางเพชรบุรี', '', '', 7),
(152, 'รจ.พ.เพชรบุรี', 'เรือนจำพิเศษเพชรบุรี', '', '', 7),
(153, 'รจ.ช.เขากลิ้ง', 'เรือนจำชั่วคราวเขากลิ้ง', '', '', 7),
(154, 'รจ.ก.สมุทรสงคราม', 'เรือนจำกลาางสมุทรสงคราม', '', '', 7),
(155, 'รจ.พ.สมุทรสงคราม', 'เรือนจำพิเศษสมุทรสงคราม', '', '', 7),
(156, 'รจ.จ.สมุทรสาคร', 'เรือนจำจังหวัดสมุทรสาคร', '', '', 7),
(157, 'รจ.จ.สุพรรณบุรี', 'เรือนจำจังหวัดสุพรรณบุรี', '', '', 7),
(158, 'รจ.จ.กระบี่', 'เรือนจำจังหวัดกระบี่', '', '', 8),
(159, 'รจ.ช.กระบี่น้อย', 'เรือนจำชั่วคราวกระบี่น้อย', '', '', 8),
(160, 'รจ.จ.ชุมพร', 'เรือนจำจังหวัดชุมพร', '', '', 8),
(161, 'รจ.อ.หลังสวน', 'เรือนจำอำเภอหลังสวน(ชุมพร)', '', '', 8),
(162, 'รจ.ช.ห้วยกลั้ง', 'เรือนจำชั่วคราวห้วยกลิ้ง', '', '', 8),
(163, 'รจ.อ.ทุ่งสง', 'เรือนจำอำเภอทุ่งสง(นครศรี)', '', '', 8),
(164, 'รจ.อ.ปากพนัง', 'เรือนจำอำเภอปากพนัง(นครศรี)', '', '', 8),
(165, 'ทส.ว.นครศรีธรรมราช', 'ทัณฑสถานวัยหนุ่มนครศรีธรรมราช', '', '', 8),
(166, 'รจ.จ.พังงา', 'เรือนจำจังหวัดพังงา', '', '', 8),
(167, 'รจ.ช.เขาทอย', 'เรือนจำชั่วคราวเขาทอย', '', '', 8),
(168, 'รจ.อ.ตะกั่วป่า', 'เรือนจำอำเภอตะกั่วป่า(พังงา)', '', '', 8),
(169, 'รจ.จ.ภูเก็ต', 'เรือนจำจังหวัดภูเก็ต', '', '', 8),
(170, 'รจ.ช.บ้านบางโจ', 'เรือนจำชั่วคราวบ้านบางโจ', '', '', 8),
(171, 'รจ.จ.ระนอง', 'เรือนจำจังหวัดระนอง', '', '', 8),
(172, 'รจ.ก.สุราษฎร์ธานี', 'เรือนจำกลางสุราษฎร์ธานี', '', '', 8),
(173, 'รจ.พ.สุราษฎร์ธานี', 'เรือนจำพิเศษสุราษฎร์ธานี', '', '', 8),
(174, 'รจ.ช.ทุ่งเขน', 'เรือนจำชั่วคราวทุ่งเขน(สุราษฎร์ธานี)', '', '', 8),
(175, 'รจ.อ.เกาะสมุย', 'เรือนจำอำเภอเกาะสมุย', '', '', 8),
(176, 'รจ.อ.ไชยา', 'เรือนจำอำเภอไชยา(สุราษฎร์ธานี)', '', '', 8),
(177, 'สกข.จ.นครศรีธรรมราช', 'สถานกักขังกลางนครศรีธรรมราช', '', '', 8),
(178, 'รจ.จ.ตรัง', 'เรือนจำจังหวัดตรัง', '', '', 9),
(179, 'รจ.ช.เหรียงห้อง', 'เรือนจำชั่วคราวเหรียงห้อง', '', '', 9),
(180, 'รจ.จ.นราธิวาส', 'เรือนจำจังหวัดนราธิวาส', '', '', 9),
(181, 'รจ.ช.โคกยามู', 'เรือนจำชั่วคราวโคกยามู', '', '', 9),
(182, 'รจ.ก.ปัตตานี', 'เรือนจำกลางปัตตานี', '', '', 9),
(183, 'รจ.พ.ปัตตานี', 'เรือนจำพิเศษปัตตานี', '', '', 9),
(184, 'รจ.ก.พัทลุง', 'เรือนจำกลางพัทลุง', '', '', 9),
(185, 'รจ.พ.พัทลุง', 'เรือนจำพิเศษพัทลุง', '', '', 9),
(186, 'ทส.ป.บ้านนาวง', 'ทัณฑสถานเปิดบ้านนาวง(พัทลุง)', '', '', 9),
(187, 'รจ.ก.ยะลา', 'เรือนจำกลางยะลา', '', '', 9),
(188, 'รจ.พ.ยะลา', 'เรือนจำพิเศษยะลา', '', '', 9),
(189, 'รจ.อ.เบตง', 'เรือนจำอำเภอเบตง(ยะลา)', '', '', 9),
(190, 'รจ.ก.สงขลา', 'เรือนจำกลางสงขลา', '', '', 9),
(191, 'รจ.จ.สงขลา', 'เรือนจำจังหวัดสงขลา', '', '', 9),
(192, 'ทส.ญ.สงขลา', 'ทัณฑสถานหญิงสงขลา', '', '', 9),
(193, 'ทส.บ.สงขลา', 'ทัณฑสถานบำบัดพิเศษสงขลา', '', '', 9),
(194, 'รจ.จ.สตูล', 'เรือนจำจังหวัดสตูล', '', '', 9),
(195, 'รจ.อ.นาทวี', 'เรือนจำอำเภอนาทวี', '', '', 9),
(196, 'รจ.จ.จันทบุรี', 'เรือนจำจังหวัดจันทบุรี', '', '', 2),
(197, 'ทส.ป.ทุ่งเบญจา(จันทบุรี)', 'ทัณฑสถานเปิดทุ่งเบญจา(จันทบุรี)', '', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `methods`
--

CREATE TABLE IF NOT EXISTS `methods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `methods`
--

INSERT INTO `methods` (`id`, `name`) VALUES
(1, 'จู่โจมกรณีปกติ'),
(2, 'จู่โจมกรณีพิเศษ');

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE IF NOT EXISTS `note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE IF NOT EXISTS `report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `qty` varchar(16) DEFAULT NULL,
  `item_owner` text,
  `location_id` int(11) NOT NULL,
  `khet_id` int(11) NOT NULL,
  `found_at_id` int(11) NOT NULL,
  `found_date` date NOT NULL,
  `category_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `method_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ip_address` varchar(64) DEFAULT NULL,
  `is_confirmed` int(11) NOT NULL DEFAULT '0',
  `note` text,
  `note_id` int(11) NOT NULL,
  `other_item` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'superuser'),
(3, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `remember_token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=148 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role_id`, `location_id`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'admin', '$2y$10$fU0FHRE08FwM5oIIspjew.iplTwMuJ0sEENNKQh2anOzeByCWqFaS', 1, 1, '2014-09-08 18:36:21', '2014-09-08 18:36:21', NULL),
(2, 'copklpa', '$2y$10$XB.zOhHtNGwHPaCDtcEAt.OcDQnv0EHWeJNtaeW7j9U42nl0j9kvi', 3, 3, '2014-10-16 14:16:47', '2014-10-16 14:16:47', NULL),
(3, 'hosdoc', '$2y$10$Ngm6KxU8fgldii0LjqHqx.4xP8vjqZmqGjNYpKFMBjLyTxgSYNJ5C', 3, 4, '2014-10-16 14:16:47', '2014-10-16 14:16:47', NULL),
(4, 'copbank', '$2y$10$p.NgG.eh4gGd227eyzVGYuXZfQQhXoBfy0mQkVu2HuIU/3TRxUrcO', 3, 2, '2014-10-16 14:16:47', '2014-10-16 14:16:47', NULL),
(5, 'sopbakk', '$2y$10$ZPM4XMIdGbvbJFB70/CoMukN.4EthNafRxM8UnhCNvdUn14bFtKB6', 3, 5, '2014-10-16 14:16:47', '2014-10-16 14:16:47', NULL),
(6, 'sopthon', '$2y$10$DQF97KctJGYGE3QAS9k4lu0pLIQZJPOOU7KDOoNzinKk.Ij3KJQHG', 3, 6, '2014-10-16 14:16:47', '2014-10-16 14:16:47', NULL),
(7, 'tdccent', '$2y$10$v40h2hRlcFYEpuFCs.S0kuSlh1gaOr24JPlBHIxZZTLPITXHCtqIC', 3, 7, '2014-10-16 14:16:47', '2014-10-16 14:16:47', NULL),
(8, 'ydccent', '$2y$10$MbCdHu08TrFgTnttLw3qt.kGiTkZasIPShIMQVKHnbwda2QxZes4m', 3, 8, '2014-10-16 14:16:47', '2014-10-16 14:16:47', NULL),
(9, 'fdccent', '$2y$10$/fdDYrHZmZd1LVX0tvBrM.ab/cW0qCO8pPV3bLtWMoQnruFaInvDa', 3, 9, '2014-10-16 14:16:47', '2014-10-16 14:16:47', NULL),
(10, 'copklpi', '$2y$10$dmmmfvMZS8omR34cIbnrZeUJc0ekBKJ6oM7Jm/gZXmKULJarICrGi', 3, 10, '2014-10-16 14:52:00', '2014-10-16 14:52:00', NULL),
(11, 'copnaks', '$2y$10$yKk8taUvYSrGnio47XrOyuJvjjCI5yP71NxXocV/td84myDXlOHjO', 3, 12, '2014-10-16 14:52:00', '2014-10-16 14:52:00', NULL),
(12, 'copnakw', '$2y$10$T4q9KryQgfQp4vIR9Ak0C.vyo4yWY.NOvTK/TFLvDhYSyZkXs6/4a', 3, 15, '2014-10-16 14:52:00', '2014-10-16 14:52:00', NULL),
(13, 'coprayo', '$2y$10$Er0Fh7UfpnB8MveXP0wSu.VfdSBnV/e4.KdQ/kUKt9R0lla08cq7G', 3, 18, '2014-10-16 14:52:00', '2014-10-16 14:52:00', NULL),
(14, 'copratc', '$2y$10$5VuehoT7r9TfE6NXaUb5kON/aHAe55zJWRZI3VulbOWxLEtnV5mD2', 3, 21, '2014-10-16 14:52:00', '2014-10-16 14:52:00', NULL),
(15, 'tdcratc', '$2y$10$Mu8ceB9cg2E0ObdN8GQRGuaxviTC0D3FMUMhkuqWtoCEbgdZGN6Uy', 3, 24, '2014-10-16 14:52:00', '2014-10-16 14:52:00', NULL),
(16, 'tdcthan', '$2y$10$zn4HSfWhIY47pGXNnG0F2u0Gv73mAm/RWQ.2gT6uJ9tHc8GgnrkR6', 3, 25, '2014-10-16 14:52:00', '2014-10-16 14:52:00', NULL),
(17, 'sopmeen', '$2y$10$IK.Lm6Ij7qa9Ak/p/oUI2.5OdjENHfwH4lJkXU9lFWiOy9RNkE1R.', 3, 27, '2014-10-16 14:52:00', '2014-10-16 14:52:00', NULL),
(18, 'fdcthon', '$2y$10$iEZmVceF6mBjus9EyX9xWOF1kf4mqMdlC3aSyV2VvjTh1I3e3jK4m', 3, 28, '2014-10-16 14:54:42', '2014-10-16 14:54:42', NULL),
(19, 'popchin', '$2y$10$ZUJTzFJJH/8G0EAkhrXkKuVd/6qMGCFbsjDv2DOa1jBAwxED3AaCW', 3, 29, '2014-10-16 14:54:42', '2014-10-16 14:54:42', NULL),
(20, 'popnont', '$2y$10$xnnIFDtyauH1Jk2w5UshFeQWWjmd6rIQN4dtQ5YZS1ISnnQdnEvtm', 3, 31, '2014-10-16 14:54:42', '2014-10-16 14:54:42', NULL),
(21, 'poppatu', '$2y$10$eYe.xgDruQT8966vlfp7m.adqgLh3NRtE1wFot4Z/z0cJfLH6NgsK', 3, 32, '2014-10-16 14:54:42', '2014-10-16 14:54:42', NULL),
(22, 'aoptanya', '$2y$10$sj2qagxdj9ILJhpP6nGHs.tXKMvF.54vxgTDY0r0pd79.3SItFudK', 3, 33, '2014-10-16 14:54:42', '2014-10-16 14:54:42', NULL),
(23, 'tdcpatum', '$2y$10$jH7P/fRoR8bsNjqyfN8aYOS..w.sWdIlfmRvwz82prH/a5Pbmcx2.', 3, 34, '2014-10-16 14:54:43', '2014-10-16 14:54:43', NULL),
(24, 'copayut', '$2y$10$drLQ28tmec5pSQ7torHkF.4rOBVghNNs4F2sFnhKiFFDxnvrs69Le', 3, 35, '2014-10-16 14:54:43', '2014-10-16 14:54:43', NULL),
(25, 'popayut', '$2y$10$MCqzuielJZg3NZAZqFtqHONQekkIihDYd/4jZG5IjoZJQalGQP68S', 3, 36, '2014-10-16 14:54:43', '2014-10-16 14:54:43', NULL),
(26, 'tacayut', '$2y$10$.yYEWVefILoGZrIaJRlYlOyi2QMQqaBPim..p9Vk1Z/R99wTTaAaG', 3, 37, '2014-10-16 14:57:05', '2014-10-16 14:57:05', NULL),
(27, 'ydcayut', '$2y$10$WPL60cNAi2PYgQFcgBH0f.rI4Fk.7NVKSNARFk/OiQ0mYJyLsKOu2', 3, 38, '2014-10-16 14:57:05', '2014-10-16 14:57:05', NULL),
(28, 'coplop', '$2y$10$iM/FB8zHhrHR9oBcZpUzEuICurAoxtnuogepbZulAA4CrteMNaIf2', 3, 39, '2014-10-16 14:57:05', '2014-10-16 14:57:05', NULL),
(29, 'popsala', '$2y$10$tA9.80a6xk7K7HYrw2pqbOsYZzIw8lPBTUDtGhHYPs5ItLS/.yC42', 3, 42, '2014-10-16 14:57:05', '2014-10-16 14:57:05', NULL),
(30, 'popsing', '$2y$10$PYM1ZuNDDQu2u.Xm.km9sezFZDKHa2AtCbQeTua/w10sp22w7Bhq2', 3, 43, '2014-10-16 14:57:05', '2014-10-16 14:57:05', NULL),
(31, 'popangt', '$2y$10$oZ4RrC68d33bU.t/cyGVg.iNq.nW0RVmHH7v71eAgje2li49eCrIO', 3, 44, '2014-10-16 14:57:05', '2014-10-16 14:57:05', NULL),
(32, 'aopchab', '$2y$10$zNQUhRHdJ9J5ACy.SraMyuWad1O6t1l/WUQhBf6ZhrcQ.NJIT0a5q', 3, 45, '2014-10-16 14:57:06', '2014-10-16 14:57:06', NULL),
(33, 'idcpatu', '$2y$10$bKhyOMA/ih0Ny7937GkwBe7p2VOwEAhTVKursWWtFl.9WMiW.zKKG', 3, 46, '2014-10-16 14:57:06', '2014-10-16 14:57:06', NULL),
(34, 'copsamp', '$2y$10$3znTGxi9aU5wraryUj93xusMV.QmNEET1xUHbfPY/1X9lN5SgQwfO', 3, 47, '2014-10-16 14:59:56', '2014-10-16 14:59:56', NULL),
(35, 'popchan', '$2y$10$ZwEEW/ddpwEwAI3JUjQvv.RvvQHOQ4WyuTNHEEwA.mjMrD39G2COG', 3, 196, '2014-10-16 14:59:56', '2014-10-16 14:59:56', NULL),
(36, 'odctugb', '$2y$10$f3wiXWRt3bJ21tUGoIyBrOKEmt8mdnehhy4PBqSabQ51YRHjxXAKC', 3, 197, '2014-10-16 14:59:57', '2014-10-16 14:59:57', NULL),
(37, 'copchac', '$2y$10$6bDgqMvCUiIwMOYCIKfWFORyiCIa7GUafV0ozYTMkRmq4zoX1b1dG', 3, 48, '2014-10-16 14:59:57', '2014-10-16 14:59:57', NULL),
(38, 'copchon', '$2y$10$p1O1ZakFTEar4fyFmGXzxeosb1FUh9nHKS2YKNYb9I3mZE3DGZZYi', 3, 50, '2014-10-16 14:59:57', '2014-10-16 14:59:57', NULL),
(39, 'soppat', '$2y$10$NCevMwb2liqPDMPI0ak9FuIzEGHN5swd1tTHMQ3B19MZ7dur0gPt.', 3, 53, '2014-10-16 14:59:58', '2014-10-16 14:59:58', NULL),
(40, 'fdcchon', '$2y$10$Vok0jnpq70GRXlyJN2RWTOLsIlMw5pcuFEa8fsOJ3gyOUJzA4zds6', 3, 54, '2014-10-16 14:59:58', '2014-10-16 14:59:58', NULL),
(41, 'poptrad', '$2y$10$WMK0jLL3rUC0Y6zXlkfY8.piBRnGVV/84wJBZSpYGPbkC1lCuD6m6', 3, 55, '2014-10-16 14:59:58', '2014-10-16 14:59:58', NULL),
(42, 'popnakn', '$2y$10$t2VFgWs9aaaJtV7ZEwHgKOZcx7WTBPxg02m.4WQbrCOB5RZIPal9C', 3, 57, '2014-10-16 15:00:57', '2014-10-18 12:52:17', NULL),
(43, 'poppranc', '$2y$10$Hcr89ISZU3Wz6WUY6.cHa.dWoipW.RMmjqWsYsPKQsEvnH7bPz4cC', 3, 58, '2014-10-16 15:00:57', '2014-10-16 15:00:57', NULL),
(44, 'odcbans', '$2y$10$LKk9dMHnIwPwNHFVWzTP2.tiMCBNNLCU7r7K0JI1RCUBp61VXLkmW', 3, 59, '2014-10-16 15:02:07', '2014-10-16 15:02:07', NULL),
(45, 'odchoyp', '$2y$10$AurCLsLUywKKTdZ5ZiQPVeGPEEDHojDo9os31Syf1YlMnFwyB5nhG', 3, 60, '2014-10-16 15:02:07', '2014-10-16 15:02:07', NULL),
(46, 'popsara', '$2y$10$vreBro.sENo0af1gesya.u1KqXCp52gBGLR0DKjjBwWN9n/.n/KOS', 3, 61, '2014-10-16 15:03:11', '2014-10-16 15:03:11', NULL),
(47, 'aokabin', '$2y$10$DrsZqyx7OLYt8EPkhA5MS.bVchb3mblj5iJWx4L/fSssvQXf7qbwC', 3, 62, '2014-10-16 15:03:11', '2014-10-16 15:03:11', NULL),
(48, 'inctrad', '$2y$10$WQT/Q0xfmRQLTFrY7ITkPOvlQjeFgsv68b4jNWaPhDE5LkoLY/0pa', 3, 63, '2014-10-16 15:03:11', '2014-10-16 15:03:11', NULL),
(49, 'popchip', '$2y$10$Dmcly3qdTqAW9mkNm4YU4e53Ty.sOiXBwpYUABWIAlLYHS8gYg7zi', 3, 64, '2014-10-16 15:06:08', '2014-10-16 15:06:08', NULL),
(50, 'aoppook', '$2y$10$AuA6NEeIvYHUJlZvC7Mn6ObEcNZ4qR5PuXSNIhWJU.rYSOZ31OZGq', 3, 65, '2014-10-16 15:06:08', '2014-10-16 15:06:08', NULL),
(51, 'copnakr', '$2y$10$iOf.HEMzMrjyHdVqwwImVuaZRF4qWdaoeovuT/AjQJRSmHJUOFnde', 3, 66, '2014-10-16 15:06:09', '2014-10-16 15:06:09', NULL),
(52, 'ccakhop', '$2y$10$0WvhhBGiuND8CaBwm5ME/uG/kk8xQZq.q2KdLBoCq1zR8NU0CeagW', 3, 69, '2014-10-16 15:06:09', '2014-10-16 15:06:09', NULL),
(53, 'idsrike', '$2y$10$X9LxQPLoP3gyIsxWsxChM.VkcEYOZRVbNaKJSGXQC9kFyzk/JAL.K', 3, 70, '2014-10-16 15:06:09', '2014-10-16 15:06:09', NULL),
(54, 'popburi', '$2y$10$rDDC5BAhfJDxzIdPlpprsu0x3mPtlwb2Q43Bc.QFQ4cW/4JECxdxe', 3, 71, '2014-10-16 15:06:09', '2014-10-16 15:06:09', NULL),
(55, 'aopnang', '$2y$10$0gLt.EtjHB1XYcIxUxmJduWjc7njCN3KuYmf8gZqzwi45QkIHXbOC', 3, 73, '2014-10-16 15:06:09', '2014-10-16 15:06:09', NULL),
(56, 'popyaso', '$2y$10$MNftqa7beQrOaW9cdGUqv.0EZXMDvfrun3ejeOQnWrvC7jRqUplhe', 3, 74, '2014-10-16 15:06:09', '2014-10-16 15:06:09', NULL),
(57, 'popsisa', '$2y$10$k0ZbpltH0cUVabC/xOvSoOlQxQAkRhpUw2.mdY4cJSw34aZ6w1MeS', 3, 75, '2014-10-16 15:06:09', '2014-10-16 15:06:09', NULL),
(58, 'popsuri', '$2y$10$O5X9Hc6U93n9HV4l3wrtN.QjxHTXmx3/809WXrZ9T02k.lgKSujrC', 3, 76, '2014-10-16 15:11:10', '2014-10-16 15:11:10', NULL),
(60, 'temsuri', '$2y$10$FnhurWPdFrzAMqECY2deQurokrUaIoILJH09hpbds7KkfACXdLs9a', 3, 78, '2014-10-16 15:11:10', '2014-10-18 12:16:53', NULL),
(61, 'popamna', '$2y$10$jUBvntLHZl9cqe0bj475SelvKQYlEcqSGNLnp1dawZkmc6wIVtSya', 3, 79, '2014-10-16 15:11:10', '2014-10-16 15:11:10', NULL),
(62, 'popubon', '$2y$10$UKLQ/GhuOu5WvycUTskcMuwQd0l0tLs.AoNnYus3tgevnBDRoKLdG', 3, 80, '2014-10-16 15:11:10', '2014-10-16 15:11:10', NULL),
(63, 'aopyai', '$2y$10$hbwqpxVSKr97rOCAiUGh4eKPhgvyHO/5pmRAtpvYNltZ0MOwjWrD.', 3, 81, '2014-10-16 15:11:10', '2014-10-16 15:11:10', NULL),
(64, 'idratta', '$2y$10$epw0pb8hWnuz/Zf5eRfNne1OGm.R/kWYk9kWdn9KSrNXBG5pBHVay', 3, 82, '2014-10-16 15:11:10', '2014-10-16 15:11:10', NULL),
(65, 'aopkant', '$2y$10$00b6oVLDkohJNVv9U1/o3u3HPd72DpCV46agTFHPn84aUeQ.FetWu', 3, 83, '2014-10-16 15:11:11', '2014-10-16 15:11:11', NULL),
(66, 'fdcnakon', '$2y$10$eJuV/R61zj56PFimi7mIteU53Nhe40w9ptlAHt8b3LIuytwHSrxdK', 3, 84, '2014-10-16 15:11:11', '2014-10-16 15:11:11', NULL),
(67, 'popkala', '$2y$10$6blMunsywvbUuheMt1a9Wu0rb6VuhV58gW0Lou2i7ZBk7IElPEyka', 3, 85, '2014-10-17 00:54:43', '2014-10-17 00:54:43', NULL),
(68, 'copkhon', '$2y$10$DsKQhHOeDubHy6RkzvSAEOG5P8bdK6tMKUiREY3d3pK2EIY9.Yv0a', 3, 87, '2014-10-17 00:54:44', '2014-10-17 00:54:44', NULL),
(69, 'aopphon', '$2y$10$MfvxaiGn0PFLq6StZnEsXO2vJtY6LSTl4QYQw7N4GavXJBwDjaI0S', 3, 89, '2014-10-17 00:54:44', '2014-10-17 00:54:44', NULL),
(70, 'tdckhon', '$2y$10$luq84cH8dbdC46ilS90slePYVBKmDdUTWkLcqIHdIjqe3X7PqKFS2', 3, 90, '2014-10-17 00:54:44', '2014-10-17 00:54:44', NULL),
(71, 'popnakp', '$2y$10$otBe5yoY7RVoOWCX7f/Geew.lPk8OzUmm9lbCLxxYP5nU7JwibEEC', 3, 91, '2014-10-17 00:54:44', '2014-10-17 00:54:44', NULL),
(72, 'copnakp1', '$2y$10$QsIG9umyX9FlkxrbPSPjdOxKvwiKNR2bcWTkI5gyh3h4HTU1XtZVW', 3, 92, '2014-10-17 00:54:44', '2014-10-17 00:54:44', NULL),
(73, 'popmaha', '$2y$10$74bIqUmBQKG.vgq/ssBL2.VZVXhaQ5lV2AVbnKvRC2evVdNRqS6qG', 3, 93, '2014-10-17 00:54:44', '2014-10-17 00:54:44', NULL),
(74, 'popmukd', '$2y$10$jSbX6qb4gXVP2QPNJHOpXeXPdwC2g7VJUIEeUSXQg5QDy0bXAESJe', 3, 94, '2014-10-17 00:54:44', '2014-10-17 00:54:44', NULL),
(75, 'poproie', '$2y$10$P99Keo/z8MKjWjEFyi9GKun4fnuVLM6sM9KXmdpPXtfoe1qz03HEq', 3, 95, '2014-10-17 00:54:44', '2014-10-17 00:54:44', NULL),
(76, 'popsako', '$2y$10$.81DlABXNk33rX03OmR1mOr1b484OLuSPpuuLiemYLKbz2Fv6g8fq', 3, 98, '2014-10-17 00:54:44', '2014-10-17 00:54:44', NULL),
(77, 'aopsawa', '$2y$10$2G5XdfbiCx0UcoBj/Cjxte7uoaVd5hPZvUeLF7rVwO4Z0anTZO5dq', 3, 100, '2014-10-17 00:54:44', '2014-10-17 00:54:44', NULL),
(78, 'popnogk', '$2y$10$OIszPhOxZE7C8Ril6X53sO4AdrVxdKmDZAPU5VHfQkxEGq7bOzRMe', 3, 101, '2014-10-17 00:54:44', '2014-10-17 00:54:44', NULL),
(79, 'aopbung', '$2y$10$eUwbUU3/QilZnqZO/Egc7.sdJfovDTVajZSmLieFBUlS6e3Vibvtq', 3, 102, '2014-10-17 00:54:45', '2014-10-17 00:54:45', NULL),
(80, 'popnogb', '$2y$10$24S0NYt9ZBBlpWTBuqGt1egHm78wy8hsCNMApSH8bXyz6ElkHAPrO', 3, 103, '2014-10-17 00:54:45', '2014-10-17 00:54:45', NULL),
(81, 'copudon', '$2y$10$i0aOJidF.cUHv4WlA7DJR.wFKoJ8vzNoe5LQdJ1MqH5w4Yyn/dGhy', 3, 104, '2014-10-17 00:54:45', '2014-10-17 00:54:45', NULL),
(82, 'idcroie', '$2y$10$6OL.Af9x3H9aQgpLBLQcP..uq3mtq4rw0LUa91L4qrj1DIWEJLmki', 3, 106, '2014-10-17 00:54:45', '2014-10-17 00:54:45', NULL),
(83, 'copchar', '$2y$10$FxSzNGxSn1GRQNteNOYmROjtnPPcmqa1JmdbuQgFh/xINErwhioca', 3, 107, '2014-10-17 00:58:12', '2014-10-17 00:58:12', NULL),
(84, 'copcham', '$2y$10$i8cmTn3WaVMcION2AMCmvOp3pP8RhKeGLi5FwBzhCC6vlbpf65K8u', 3, 109, '2014-10-17 00:58:12', '2014-10-17 00:58:12', NULL),
(85, 'fdccham', '$2y$10$nZQX0V6Xz7FtUhFRvAaod.RaOPCHL74tv13BKcjo8bg0SrrzVU0sW', 3, 111, '2014-10-17 00:58:12', '2014-10-17 00:58:12', NULL),
(86, 'aopphan', '$2y$10$l/fcrY3ReYw2V3W.x1DurOkPAeJ6K.iut/ClmbP3PeTytq0ptfCBW', 3, 112, '2014-10-17 00:58:12', '2014-10-17 00:58:12', NULL),
(87, 'popnan', '$2y$10$bcIu7zNBRjGDrggX/z9dZ.1jSKJWY1tRv8EBp0vRlvHsw1xDgxyRq', 3, 113, '2014-10-17 00:58:12', '2014-10-17 00:58:12', NULL),
(88, 'popphay', '$2y$10$q5l.Ysgow27Y5i0wIpckpeTpVPflh36FY3B8CmMII1fKNtkMp5MXa', 3, 115, '2014-10-17 00:58:13', '2014-10-17 00:58:13', NULL),
(89, 'popphra', '$2y$10$OFOzIN1EErUFul2vk7yBq.U6m0RVR5.xo1AbnV7KdkEykAem4.Ri6', 3, 116, '2014-10-17 00:58:13', '2014-10-17 00:58:13', NULL),
(90, 'popmaeh', '$2y$10$7LH2doC2KMx3MTRyWGYUl.mm3/mEcCdDYUu07LOIvIiJQGwLyMNC2', 3, 117, '2014-10-17 00:58:13', '2014-10-17 00:58:13', NULL),
(91, 'aopmaer', '$2y$10$LgWHXk/.YBYW3PGMSqBJweGe/qKmCkS1vLDBMopaT07syXRx8CQ9G', 3, 125, '2014-10-17 00:58:13', '2014-10-17 00:58:13', NULL),
(92, 'coplamp', '$2y$10$udXVnZ/1v9v0/3kW2xXBhuhU1LJvDF/.A.bLanX7fP2/aBnHTHC6O', 3, 118, '2014-10-17 00:58:13', '2014-10-17 00:58:13', NULL),
(93, 'odclamp', '$2y$10$5meMHoSG0AD/UzJ4Nwijx.vgDaytUCccGAGZVEOHkVaUINJhmMgvW', 3, 120, '2014-10-17 00:58:13', '2014-10-17 00:58:13', NULL),
(94, 'poplapu', '$2y$10$9RdRG/LjH6CNY.6bPC78KOKy.5A3yL4U3BGX87vkP4xf/TN7oMZnC', 3, 121, '2014-10-17 00:58:13', '2014-10-17 00:58:13', NULL),
(95, 'poptaeg', '$2y$10$f/Ou495K.gE25ZujOmQteeyv5RVgEu0DLndjviUaOE/EguKgkWwMm', 3, 122, '2014-10-17 00:58:13', '2014-10-17 00:58:13', NULL),
(96, 'idclamp', '$2y$10$sd.7eTFPmXayYbKkhrMWRuE4GjjVIw1I4kQ/GX4EAcuNAK6904E6a', 3, 123, '2014-10-17 00:58:13', '2014-10-17 00:58:13', NULL),
(97, 'popkamp', '$2y$10$mFUan716iHqeWTU00Sh3X.lBWSFOxkIVDERghnBFpo2l4d8KcK2Ky', 3, 126, '2014-10-17 01:02:01', '2014-10-17 01:02:01', NULL),
(98, 'poptakk', '$2y$10$8JGJBnUx6ZcGsMLXDNyo2uzWA3VW46wODmLfYUG3KqWxjLbZrHe5i', 3, 128, '2014-10-17 01:02:01', '2014-10-17 01:02:01', NULL),
(99, 'aopmaes', '$2y$10$ntrTST4RO4aLtqAdeElnCuOJod7ezaMxxVwJI/6dRyEpfV/N1SaTC', 3, 130, '2014-10-17 01:02:01', '2014-10-17 01:02:01', NULL),
(100, 'odcnonn', '$2y$10$t3Nu/xB9PXCqp5gyv9ZSv.9ThXkFs4Op64BC/nCDreoh2Yhwc8iYi', 3, 131, '2014-10-17 01:02:01', '2014-10-17 01:02:01', NULL),
(101, 'popphic', '$2y$10$I/I1d0PZLTNId0wMGASH.OWjpeXNu2c4KjCZ1ywCLFZPNgwKB/yl6', 3, 132, '2014-10-17 01:02:01', '2014-10-17 01:02:01', NULL),
(102, 'copphit', '$2y$10$uNZyVe95jnk0qxr6zxZ6S.9ISQuo.sRN7FF2p9fQBzacsNX2idmHi', 3, 133, '2014-10-17 01:02:01', '2014-10-17 01:02:01', NULL),
(103, 'popphit', '$2y$10$RI0my8Se4VhcjNK1WOSJUuC7Ptom3tnfXhyxLDQGpW5626F.DXzQ.', 3, 134, '2014-10-17 01:02:01', '2014-10-17 01:02:01', NULL),
(104, 'poppheb', '$2y$10$TL44iQHAv0RF9GbNvJTsL.hsVr7O5WpM6kz1XYnvb/lwfb3DeqOm2', 3, 135, '2014-10-17 01:02:01', '2014-10-17 01:02:01', NULL),
(105, 'aoploms', '$2y$10$yY2CtRPgmUZbJukpSIhSXuQJlkI7jgYG422LwoAUu/ReZkulAHMCa', 3, 137, '2014-10-17 01:02:01', '2014-10-17 01:02:01', NULL),
(106, 'tdcphit', '$2y$10$hzCcL7ILOHT2S2wMw3WOruW/j4kDI0hCEeZ2/zhexsWpLrbXK8cxG', 3, 138, '2014-10-17 01:02:02', '2014-10-17 01:02:02', NULL),
(107, 'popsukh', '$2y$10$jY90Op.enFXYhJlX15jrGu6TKs0XamNZdlu75g0ulPxMNp0BiCT7.', 3, 139, '2014-10-17 01:02:02', '2014-10-17 01:02:02', NULL),
(108, 'aopswan', '$2y$10$enU79UGvrVOO7Gqcrstbnu5fLPxjdghBq539JotiZnXjQ2ajfWjUW', 3, 140, '2014-10-17 01:02:02', '2014-10-17 01:02:02', NULL),
(109, 'poptta', '$2y$10$.cTmhE2EjxvAqhLT.mQGhOdSJmVK6pGQnlMmmBTJpa/SS9V3QEzwK', 3, 142, '2014-10-17 01:02:02', '2014-10-17 01:02:02', NULL),
(110, 'poputha', '$2y$10$j0oGcbuITGxg3CZaId1saO.L1J9bu8QEQ7DmQjYtQsSmuQIOHeYbG', 3, 143, '2014-10-17 01:02:02', '2014-10-17 01:02:02', NULL),
(111, 'popkanc', '$2y$10$XPJW4VU87tVLbej9lTfEZOG1x/kGAHaGtNcHraIIcEScFRyLOubMO', 3, 145, '2014-10-17 01:04:08', '2014-10-17 01:04:08', NULL),
(112, 'aoptong', '$2y$10$uc1i3pJ3CXXUYtiXd/bZLOD/Ml/lqM5FQFHe7qkrHpdQEQL8/LSHG', 3, 146, '2014-10-17 01:04:09', '2014-10-17 01:04:09', NULL),
(113, 'copnakt', '$2y$10$IE4Z/6VYXPEaU4rbBm0R1OQN/hH9P.ki3WWRLmlWWowO9kzitvbmy', 3, 147, '2014-10-17 01:04:09', '2014-10-17 01:04:09', NULL),
(114, 'popprajob', '$2y$10$891/4Fp24BDmfh0qoZxyx.nPeX8WIdVjdWN4/i40pVtb6yvzqBfnS', 3, 150, '2014-10-17 01:04:09', '2014-10-17 01:04:09', NULL),
(115, 'copphet', '$2y$10$q7dL7ppG0Q7sxhpp2exrN.o.LM4x.2Kff1zU2HA5JoHVhL1CfegmK', 3, 151, '2014-10-17 01:04:09', '2014-10-17 01:04:09', NULL),
(116, 'copsams', '$2y$10$ZKmZjb/xuJx1SntprToalOuEJe4fTsO59p0Ka1Dw99V8hWGH/FYkC', 3, 154, '2014-10-17 01:04:09', '2014-10-17 01:04:09', NULL),
(117, 'popsamc', '$2y$10$wX.ZcLL3I.oKxzC9btL1WOVYFd9SStXPWFlXzJfbGSuNOKh.JqlN2', 3, 156, '2014-10-17 01:04:09', '2014-10-17 01:04:09', NULL),
(118, 'popsupa', '$2y$10$ZAfhg7jXnnEU/jl/4D4iEO7Qpjr3QGQTA.UCSi1ntTPH01uflWb4a', 3, 157, '2014-10-17 01:04:09', '2014-10-17 01:04:09', NULL),
(119, 'popkrap', '$2y$10$wzqZZaOmY1r1RTnQ0kXahORVXlX.cNcKphiVoLJM9iFQ.NXlGuk32', 3, 158, '2014-10-17 01:13:44', '2014-10-17 01:13:44', NULL),
(120, 'popchum', '$2y$10$/h73gBZWym1BdxtKoLpDHuWCy8jMiVE/JsYsQp6ha9Szo0LulpH1K', 3, 160, '2014-10-17 01:13:44', '2014-10-17 01:13:44', NULL),
(121, 'aoplung', '$2y$10$C8wqQQJJfRItk0FjU8nzL.Gq7phKUaJfM4bPb.6yH.UUPYOGRlUT2', 3, 161, '2014-10-17 01:13:44', '2014-10-17 01:13:44', NULL),
(122, 'aoptung', '$2y$10$jV0JZtxauKU1mwU6u1ihcuR6JpwrUgwhd9kV1mqe022RfiWZWE0oy', 3, 163, '2014-10-17 01:13:44', '2014-10-17 01:13:44', NULL),
(123, 'aoppakp', '$2y$10$V/dYeqGLyJ45g1FRIOuVT.g6RkvgE0Os3d5A82.pyV3k7Zkh2bfT2', 3, 164, '2014-10-17 01:13:44', '2014-10-17 01:13:44', NULL),
(124, 'ydcnaks', '$2y$10$6480W5Wra9gK6DXiS054Keluc3tTU6VfMECHTk5MgKJ3kSNg8S14C', 3, 165, '2014-10-17 01:13:44', '2014-10-17 01:13:44', NULL),
(125, 'popphan', '$2y$10$NJZKUcK9snPN.gitQhgPVOW7lqD3MbhYaSgZjvwoIze3DSe61LPOe', 3, 166, '2014-10-17 01:13:44', '2014-10-17 01:13:44', NULL),
(126, 'aoptaku', '$2y$10$8LB2uC5Tl48gMPTzQEPN3ugdOjREFEdyS4t8.6jqv3OR/g9WLsYK.', 3, 168, '2014-10-17 01:13:44', '2014-10-17 01:13:44', NULL),
(127, 'poppuk', '$2y$10$nXRxRxto7Fn2HKYwCnOnF.NAs3tX1WQ/IbcoUJWlzC4tN8xElchfO', 3, 169, '2014-10-17 01:13:44', '2014-10-17 01:13:44', NULL),
(128, 'poprano', '$2y$10$qsomgmTkh6176l6ixm0.JOWdr/bAA34fXC3TeVbnTb9H9zW72UyRa', 3, 171, '2014-10-17 01:13:44', '2014-10-17 01:13:44', NULL),
(129, 'copsura', '$2y$10$av2kfaHdDDRSx3wxBy/DtuDn9zeV7DICuEOuFpcWEadxPZEwTfQru', 3, 172, '2014-10-17 01:13:44', '2014-10-17 01:13:44', NULL),
(130, 'aopsamui', '$2y$10$a9jdkBbftLVgnJN4KHatbuqYrOuHbqpt518G6P0VsBqTTUSV1j5c.', 3, 175, '2014-10-17 01:13:45', '2014-10-17 01:13:45', NULL),
(131, 'aopciya', '$2y$10$Exjs/jG4JDwsnlb6la/uq.BnfNDnrNSH9u.fP5fRwsedWgrPn/kki', 3, 176, '2014-10-17 01:13:45', '2014-10-17 01:13:45', NULL),
(132, 'idcnaks', '$2y$10$ER1ohKXuJVAZ./P7MbbWfOWCRpUPTHGfiMXTFLHm.GcO4ZB8G8ldy', 3, 177, '2014-10-17 01:13:45', '2014-10-17 01:13:45', NULL),
(133, 'poptran', '$2y$10$syPdQbsaJnLY1O1l2g23ouy7ELGE.6VyHEjryo8vMk18rOBpTJl3y', 3, 178, '2014-10-17 01:16:45', '2014-10-17 01:16:45', NULL),
(134, 'popnara', '$2y$10$YU6I4c16ePg95fwg/xNfmu9cDNnR2jZ.a8szs3QSyAKMtYPBcte8q', 3, 180, '2014-10-17 01:16:45', '2014-10-17 01:16:45', NULL),
(135, 'poppatt', '$2y$10$lTNKFbj3GnzhSgs6d/Sc7O3QdPgulh2hd46yH.nY3Tree6nz8fr.S', 3, 182, '2014-10-17 01:16:45', '2014-10-17 01:16:45', NULL),
(136, 'coppata', '$2y$10$2NQkMFHYd00tyaKmfTvc5ugWWdkQeNsxuNNJUiWZV6mY/xM2cgZLy', 3, 184, '2014-10-17 01:16:45', '2014-10-17 01:16:45', NULL),
(137, 'coppata1', '$2y$10$5VhwKs2xBqd75mZhDDORgu4MRYDlR1rBTjW47IIsSEESX26e.7922', 3, 185, '2014-10-17 01:16:45', '2014-10-17 01:16:45', NULL),
(138, 'odcbanna', '$2y$10$SFjELvzQhYfi4igTqIifzeJ85t42tFrObwgGwfIqQLR0qts7mXXnu', 3, 186, '2014-10-17 01:16:45', '2014-10-17 01:16:45', NULL),
(139, 'copyala', '$2y$10$jMCp5FYENjEaFqyzN2sMj.FwYPZNSIhoNc4mVD91AWoAq3tdedI22', 3, 187, '2014-10-17 01:16:46', '2014-10-17 01:16:46', NULL),
(140, 'aopbato', '$2y$10$lkjbEaHAZjarXjkOa/db.eSFuKmBcg.kk9DlXfApjAd4IyTS9uyH6', 3, 189, '2014-10-17 01:16:46', '2014-10-17 01:16:46', NULL),
(141, 'copsong', '$2y$10$I26i0pqLc/5CqaXNu78Hiutxb8waWwXCd5yIWPOsI0qq.is1HJWvG', 3, 190, '2014-10-17 01:16:46', '2014-10-17 01:16:46', NULL),
(142, 'popsong', '$2y$10$pmJAY1M2/ztDvmkc2L.K4.oVD3d.n70tWp.cgXKYFazz7u.8IF.xe', 3, 191, '2014-10-17 01:16:46', '2014-10-17 01:16:46', NULL),
(143, 'fdcsong', '$2y$10$L4yZ3mVWbqDifMpotuyzAe4Q/F83wh7zzGx4Fsa26FumxaVHZd9.G', 3, 192, '2014-10-17 01:16:46', '2014-10-17 01:16:46', NULL),
(144, 'tdcsong', '$2y$10$mZSXuzukpvLKMMaT0ZkYvuZxCy.V9.zb.HQGTOE1wC7Tp0yFCddy2', 3, 193, '2014-10-17 01:16:46', '2014-10-17 01:16:46', NULL),
(145, 'popsatu', '$2y$10$gnK.Z/xVGCWMEj5IrzSucu1vJOXGIOle25aJvbU2iQU4L2VJKcaPy', 3, 194, '2014-10-17 01:16:46', '2014-10-17 01:16:46', NULL),
(146, 'aopnatv', '$2y$10$e/fh23nwbggJjDiAyfTrbOxi85d/Qt1GEY.5cNi1syaMOkb3vcCdW', 3, 195, '2014-10-17 01:16:46', '2014-10-17 01:16:46', NULL),
(147, 'poploei', '$2y$10$0SrMJy9zAy3z0Zg7MiF9DOWXiLTY/b18LnikXEJnPhLUOqHAuI7s2', 3, 97, '2014-10-17 06:55:36', '2014-10-17 06:55:36', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
