-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
<<<<<<< HEAD
<<<<<<< HEAD
-- Host: localhost
-- Generation Time: Nov 20, 2014 at 02:32 AM
=======
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2014 at 01:43 AM
>>>>>>> FETCH_HEAD
=======
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2014 at 01:43 AM
>>>>>>> FETCH_HEAD
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
-- Table structure for table `userprofiles`
--

CREATE TABLE IF NOT EXISTS `userprofiles` (
  `userID` varchar(40) CHARACTER SET utf32 COLLATE utf32_bin NOT NULL DEFAULT '',
  `username` varchar(40) CHARACTER SET utf32 COLLATE utf32_bin NOT NULL,
<<<<<<< HEAD
<<<<<<< HEAD
  `password` varchar(40) CHARACTER SET utf32 COLLATE utf32_bin NOT NULL,
  `caloryGoal` int(6) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `userProfiles`
--

INSERT INTO `userProfiles` (`userID`, `firstName`, `lastName`, `username`, `password`, `caloryGoal`) VALUES
(1, 'Kim', 'Polanun', 'test@bu.edu', '123456', 2000);
=======
  `passwordHash` varchar(300) CHARACTER SET utf32 COLLATE utf32_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
>>>>>>> FETCH_HEAD
=======
  `passwordHash` varchar(300) CHARACTER SET utf32 COLLATE utf32_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
>>>>>>> FETCH_HEAD

--
-- Indexes for dumped tables
--

--
-- Indexes for table `userprofiles`
--
ALTER TABLE `userprofiles`
 ADD PRIMARY KEY (`userID`), ADD UNIQUE KEY `userID` (`userID`), ADD UNIQUE KEY `username` (`username`);

<<<<<<< HEAD
<<<<<<< HEAD
--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `userProfiles`
--
ALTER TABLE `userProfiles`
MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
=======
>>>>>>> FETCH_HEAD
=======
>>>>>>> FETCH_HEAD
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
