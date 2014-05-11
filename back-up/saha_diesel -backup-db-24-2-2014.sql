-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 24, 2014 at 03:38 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `saha_diesel`
--

-- --------------------------------------------------------

--
-- Table structure for table `barcode`
--

CREATE TABLE IF NOT EXISTS `barcode` (
  `idbarcode` int(11) NOT NULL AUTO_INCREMENT,
  `product_idProduct` int(11) NOT NULL,
  `barcode` varchar(45) NOT NULL,
  PRIMARY KEY (`idbarcode`),
  KEY `fk_barcode_product1_idx` (`product_idProduct`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `barcode`
--

INSERT INTO `barcode` (`idbarcode`, `product_idProduct`, `barcode`) VALUES
(1, 70, '101010190');

-- --------------------------------------------------------

--
-- Table structure for table `carbrand`
--

CREATE TABLE IF NOT EXISTS `carbrand` (
  `idbrand` int(11) NOT NULL AUTO_INCREMENT,
  `product_idProduct` int(11) NOT NULL,
  `carbrand` varchar(45) NOT NULL,
  PRIMARY KEY (`idbrand`),
  KEY `fk_brand_product1_idx` (`product_idProduct`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=99 ;

--
-- Dumping data for table `carbrand`
--

INSERT INTO `carbrand` (`idbrand`, `product_idProduct`, `carbrand`) VALUES
(1, 48, 'Hino'),
(2, 48, 'Isuzu'),
(3, 49, 'Hino'),
(4, 49, 'Isuzu'),
(5, 50, 'Hino'),
(6, 50, 'Isuzu'),
(7, 51, 'Hino'),
(8, 51, 'Isuzu'),
(9, 51, 'Nissan'),
(10, 51, 'Mitsubishi'),
(11, 51, 'Toyota'),
(12, 51, 'หางพ่วง'),
(13, 51, 'Other'),
(14, 55, 'Hino'),
(15, 55, 'Isuzu'),
(16, 55, 'Nissan'),
(17, 55, 'Mitsubishi'),
(18, 55, 'Toyota'),
(19, 55, 'หางพ่วง'),
(20, 55, 'Other'),
(21, 56, 'Hino'),
(22, 56, 'Isuzu'),
(23, 56, 'Nissan'),
(24, 56, 'Mitsubishi'),
(25, 56, 'Toyota'),
(26, 56, 'หางพ่วง'),
(27, 56, 'Other'),
(28, 57, 'Hino'),
(29, 57, 'Isuzu'),
(30, 57, 'Nissan'),
(31, 57, 'Mitsubishi'),
(32, 57, 'Toyota'),
(33, 57, 'หางพ่วง'),
(34, 57, 'Other'),
(49, 58, 'Hino'),
(50, 58, 'Isuzu'),
(51, 58, 'Mitsubishi'),
(56, 61, 'Other'),
(71, 64, 'Isuzu'),
(72, 66, 'Nissan'),
(76, 63, 'Mitsubishi'),
(77, 67, 'Nissan'),
(92, 65, 'Hino'),
(93, 65, 'ISUZU'),
(94, 62, 'Hino'),
(95, 62, 'Isuzu'),
(96, 69, 'Isuzu'),
(97, 70, 'Hino'),
(98, 70, 'Toyota');

-- --------------------------------------------------------

--
-- Table structure for table `category_options`
--

CREATE TABLE IF NOT EXISTS `category_options` (
  `sub_category_sub_category_id` int(11) NOT NULL,
  `option_1` varchar(45) DEFAULT NULL,
  `option_2` varchar(45) DEFAULT NULL,
  `option_3` varchar(45) DEFAULT NULL,
  `option_4` varchar(45) DEFAULT NULL,
  `option_5` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`sub_category_sub_category_id`),
  KEY `fk_category_options_sub_category1_idx` (`sub_category_sub_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_options`
--

INSERT INTO `category_options` (`sub_category_sub_category_id`, `option_1`, `option_2`, `option_3`, `option_4`, `option_5`) VALUES
(87, 'กว้าง', 'ยาว', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `main_category`
--

CREATE TABLE IF NOT EXISTS `main_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=143 ;

--
-- Dumping data for table `main_category`
--

INSERT INTO `main_category` (`category_id`, `name`, `image`) VALUES
(142, 'ทดสอบ', 'category142.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `oem`
--

CREATE TABLE IF NOT EXISTS `oem` (
  `idoem` int(11) NOT NULL AUTO_INCREMENT,
  `product_idProduct` int(11) NOT NULL,
  `oemcode` varchar(45) NOT NULL,
  PRIMARY KEY (`idoem`),
  KEY `fk_oem_product1_idx` (`product_idProduct`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `oem`
--

INSERT INTO `oem` (`idoem`, `product_idProduct`, `oemcode`) VALUES
(70, 70, '1010101010');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `idProduct` int(11) NOT NULL AUTO_INCREMENT,
  `sub_category_sub_category_id` int(11) NOT NULL,
  `productBrand` varchar(45) DEFAULT NULL,
  `supplier` varchar(45) DEFAULT NULL,
  `productName` varchar(45) DEFAULT NULL,
  `productCode` varchar(45) DEFAULT NULL,
  `qTy` int(45) DEFAULT NULL,
  `size` varchar(45) DEFAULT NULL,
  `poNo` varchar(45) DEFAULT NULL,
  `receivedDate` varchar(45) DEFAULT NULL,
  `itemLocation` varchar(500) NOT NULL,
  `safetyStock` int(45) DEFAULT NULL,
  `buyPrice` varchar(45) DEFAULT NULL,
  `sellPrice` varchar(45) DEFAULT NULL,
  `price1` varchar(45) DEFAULT NULL,
  `price2` varchar(45) DEFAULT NULL,
  `price3` varchar(45) DEFAULT NULL,
  `option1` varchar(45) DEFAULT NULL,
  `option2` varchar(45) DEFAULT NULL,
  `option3` varchar(45) DEFAULT NULL,
  `option4` varchar(45) DEFAULT NULL,
  `option5` varchar(45) DEFAULT NULL,
  `sahaDieselBarcodeBuy` varchar(45) DEFAULT NULL,
  `sahaDieselBarcodeSell` varchar(45) DEFAULT NULL,
  `note` text,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idProduct`),
  KEY `fk_Product_sub_category1_idx` (`sub_category_sub_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`idProduct`, `sub_category_sub_category_id`, `productBrand`, `supplier`, `productName`, `productCode`, `qTy`, `size`, `poNo`, `receivedDate`, `itemLocation`, `safetyStock`, `buyPrice`, `sellPrice`, `price1`, `price2`, `price3`, `option1`, `option2`, `option3`, `option4`, `option5`, `sahaDieselBarcodeBuy`, `sahaDieselBarcodeSell`, `note`, `image`) VALUES
(70, 87, 'BC', 'ช.กิจ', 'ฟัน', 'N-1', 10, '190-110-33/19', '6', '15/02/2014', 'หลังบ้านชั้นสอง', 20, '119', '190', '199', '', '', '10', '10', '', '', '', 'OOR', 'กบย', 'ข้อมูลเพิ่มเติม', 'product70.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE IF NOT EXISTS `sub_category` (
  `sub_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `main_category_category_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `uom` varchar(255) NOT NULL,
  `start_code` varchar(255) NOT NULL,
  PRIMARY KEY (`sub_category_id`),
  KEY `fk_sub_category_main_category_idx` (`main_category_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=88 ;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`sub_category_id`, `main_category_category_id`, `name`, `uom`, `start_code`) VALUES
(87, 142, 'ทดสอบย่อย', 'PC', 'N-1');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barcode`
--
ALTER TABLE `barcode`
  ADD CONSTRAINT `fk_barcode_product1` FOREIGN KEY (`product_idProduct`) REFERENCES `product` (`idProduct`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `category_options`
--
ALTER TABLE `category_options`
  ADD CONSTRAINT `fk_category_options_sub_category1` FOREIGN KEY (`sub_category_sub_category_id`) REFERENCES `sub_category` (`sub_category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `oem`
--
ALTER TABLE `oem`
  ADD CONSTRAINT `fk_oem_product1` FOREIGN KEY (`product_idProduct`) REFERENCES `product` (`idProduct`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_Product_sub_category1` FOREIGN KEY (`sub_category_sub_category_id`) REFERENCES `sub_category` (`sub_category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `fk_sub_category_main_category` FOREIGN KEY (`main_category_category_id`) REFERENCES `main_category` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
