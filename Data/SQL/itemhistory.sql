-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 23, 2014 at 01:55 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gamifiedNutrition`
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
  `totalCalories` int(6) NOT NULL,
  `historyDate` date NOT NULL,
  `lastEditDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itemhistory`
--

INSERT INTO `itemhistory` (`historyID`, `itemID`, `userID`, `servings`, `totalCalories`, `historyDate`, `lastEditDate`) VALUES
('1', '1', '1', 1, 1500, '2014-11-21', '2014-11-21'),
('1233', '100', '1', 1, 1111, '2014-11-22', '2014-11-22'),
('2', '2', '1', 1, 1500, '2014-11-21', '2014-11-21'),
('89', '1', '1', 1, 100, '2014-11-22', '2014-11-22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `itemhistory`
--
ALTER TABLE `itemhistory`
 ADD PRIMARY KEY (`historyID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
