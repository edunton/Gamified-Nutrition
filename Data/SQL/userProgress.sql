-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 22, 2014 at 05:01 AM
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
`userProgressID` int(10) NOT NULL,
  `userID` int(10) NOT NULL,
  `message` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `userProgress`
--

INSERT INTO `userProgress` (`userProgressID`, `userID`, `message`, `date`) VALUES
(1, 2, 'hello world', '2014-11-22 03:29:14'),
(2, 3, 'eeee', '2014-11-22 03:34:44'),
(3, 12, 'dfsadaf', '2014-11-22 03:56:08'),
(4, 1, 'You ate -1000 too many calories!', '2014-11-22 03:56:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `userProgress`
--
ALTER TABLE `userProgress`
 ADD PRIMARY KEY (`userProgressID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `userProgress`
--
ALTER TABLE `userProgress`
MODIFY `userProgressID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
