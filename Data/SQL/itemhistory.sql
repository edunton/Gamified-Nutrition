-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2014 at 04:22 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gamifiednutrition`
--

-- --------------------------------------------------------

--
-- Table structure for table `itemhistory`
--

CREATE TABLE IF NOT EXISTS `itemhistory` (
  `historyID` varchar(40) CHARACTER SET utf32 COLLATE utf32_bin NOT NULL,
  `itemID` varchar(40) CHARACTER SET utf32 COLLATE utf32_bin NOT NULL,
  `userID` varchar(40) CHARACTER SET utf32 COLLATE utf32_bin NOT NULL,
  `servings` int(4) NOT NULL,
  `historyDate` date NOT NULL,
  `lastEditDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
