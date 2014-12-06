-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 06, 2014 at 09:12 PM
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
-- Table structure for table `user_Targets`
--

CREATE TABLE IF NOT EXISTS `user_Targets` (
  `userTargetID` varchar(40) NOT NULL,
  `userID` varchar(40) NOT NULL,
  `typeID` int(5) NOT NULL,
  `targetLimit` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_Targets`
--

INSERT INTO `user_Targets` (`userTargetID`, `userID`, `typeID`, `targetLimit`) VALUES
('1', '1', 1, 2000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_Targets`
--
ALTER TABLE `user_Targets`
 ADD PRIMARY KEY (`userTargetID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
