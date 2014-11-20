-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 20, 2014 at 02:30 AM
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
-- Table structure for table `userHistory`
--

CREATE TABLE IF NOT EXISTS `userHistory` (
  `timeEntered` datetime NOT NULL,
  `oldAPIID` int(11) NOT NULL,
  `itemID` varchar(40) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `itemName` varchar(40) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `brandID` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `brandName` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `calories` int(4) NOT NULL,
  `caloriesFromFat` int(4) NOT NULL,
  `totalFat` int(11) NOT NULL,
  `saturatedFat` int(11) NOT NULL,
  `transFattyAcid` int(11) NOT NULL,
  `polyunsaturatedFat` int(11) NOT NULL,
  `monounsaturatedFat` int(11) NOT NULL,
  `cholesterol` int(11) NOT NULL,
  `sodium` int(11) NOT NULL,
  `totalCarbohydrate` int(11) NOT NULL,
  `dietaryFiber` int(11) NOT NULL,
  `sugars` int(11) NOT NULL,
  `protein` int(11) NOT NULL,
  `vitaminA` int(11) NOT NULL,
  `vitaminC` int(11) NOT NULL,
  `calcium` int(11) NOT NULL,
  `iron` int(11) NOT NULL,
  `refusePct` int(11) NOT NULL,
  `servingsPerContainer` int(11) NOT NULL,
  `servingSizeQty` int(11) NOT NULL,
  `servingSizeUnit` int(11) NOT NULL,
  `servingWeightGrams` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userHistory`
--

INSERT INTO `userHistory` (`timeEntered`, `oldAPIID`, `itemID`, `itemName`, `brandID`, `brandName`, `calories`, `caloriesFromFat`, `totalFat`, `saturatedFat`, `transFattyAcid`, `polyunsaturatedFat`, `monounsaturatedFat`, `cholesterol`, `sodium`, `totalCarbohydrate`, `dietaryFiber`, `sugars`, `protein`, `vitaminA`, `vitaminC`, `calcium`, `iron`, `refusePct`, `servingsPerContainer`, `servingSizeQty`, `servingSizeUnit`, `servingWeightGrams`) VALUES
('2014-11-19 20:00:00', 0, '1', 'Hot Dog', '1', 'Dominos', 200, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('2014-11-19 20:00:00', 0, '2', 'Pizza', '3', 'Pizza Hut', 2000, 160, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
