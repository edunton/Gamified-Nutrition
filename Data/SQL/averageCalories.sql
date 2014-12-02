-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 02, 2014 at 03:49 AM
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
-- Table structure for table `averageCalories`
--

CREATE TABLE IF NOT EXISTS `averageCalories` (
`averageCaloriesID` int(11) NOT NULL,
  `userID` varchar(40) NOT NULL,
  `averageCaloriesPerDay` int(4) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `averageCalories`
--

INSERT INTO `averageCalories` (`averageCaloriesID`, `userID`, `averageCaloriesPerDay`) VALUES
(1, '1', 1000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `averageCalories`
--
ALTER TABLE `averageCalories`
 ADD PRIMARY KEY (`averageCaloriesID`), ADD UNIQUE KEY `userID` (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `averageCalories`
--
ALTER TABLE `averageCalories`
MODIFY `averageCaloriesID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
