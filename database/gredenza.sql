-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 19, 2020 at 04:48 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gredenza`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fuel_filling`
--

DROP TABLE IF EXISTS `tbl_fuel_filling`;
CREATE TABLE IF NOT EXISTS `tbl_fuel_filling` (
  `f_id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `quantity` double NOT NULL,
  `amount` double NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`f_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_fuel_filling`
--

INSERT INTO `tbl_fuel_filling` (`f_id`, `vehicle_id`, `quantity`, `amount`, `timestamp`) VALUES
(1, 1, 6.62, 510, '2020-10-15 15:01:15'),
(2, 3, 7.12, 600, '2020-10-18 15:04:39'),
(3, 1, 4.1, 300, '2020-10-18 15:05:06'),
(4, 2, 9.35, 800, '2020-10-18 15:05:32'),
(5, 3, 11.36, 1200, '2020-10-18 16:54:39'),
(6, 5, 6.62, 500, '2020-10-19 04:43:59');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `name`, `username`, `password`) VALUES
(1, 'Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicle`
--

DROP TABLE IF EXISTS `tbl_vehicle`;
CREATE TABLE IF NOT EXISTS `tbl_vehicle` (
  `v_id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_number` text NOT NULL,
  `seating_capacity` int(11) NOT NULL,
  `purchase_date` date NOT NULL,
  PRIMARY KEY (`v_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_vehicle`
--

INSERT INTO `tbl_vehicle` (`v_id`, `registration_number`, `seating_capacity`, `purchase_date`) VALUES
(1, 'KL-58-T-6001', 2, '2016-09-10'),
(2, 'KL-58-P-9540', 2, '2015-04-14'),
(3, 'KL-58-A-7532', 5, '2008-05-05'),
(5, 'KL-58-A-3435', 2, '2008-01-11');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
