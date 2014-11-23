-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 23, 2014 at 01:57 AM
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
-- Table structure for table `userProgress`
--

CREATE TABLE IF NOT EXISTS `userProgress` (
  `userProgressID` varchar(40) NOT NULL,
  `userID` int(10) NOT NULL,
  `progress` int(3) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userProgress`
--

INSERT INTO `userProgress` (`userProgressID`, `userID`, `progress`, `date`) VALUES
('1', 1, 8, '2014-11-22 21:02:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `userProgress`
--
ALTER TABLE `userProgress`
 ADD PRIMARY KEY (`userProgressID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
