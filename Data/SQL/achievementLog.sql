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
-- Table structure for table `achievementLog`
--

CREATE TABLE IF NOT EXISTS `achievementLog` (
  `achievementLogID` varchar(40) NOT NULL,
  `userID` int(11) NOT NULL,
  `achievementType` varchar(20) NOT NULL,
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `achievementLog`
--

INSERT INTO `achievementLog` (`achievementLogID`, `userID`, `achievementType`, `Time`) VALUES
('1', 1, 'week', '2014-11-22 20:45:16'),
('4fe14993bb9a3fa2211d9f5761216cff', 1, 'weeklyGoal', '2014-11-22 20:55:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achievementLog`
--
ALTER TABLE `achievementLog`
 ADD PRIMARY KEY (`achievementLogID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
