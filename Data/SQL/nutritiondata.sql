-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2014 at 10:43 PM
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
-- Table structure for table `nutritiondata`
--

CREATE TABLE IF NOT EXISTS `nutritiondata` (
  `itemID` varchar(40) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `itemName` varchar(4000) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `brandID` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `brandName` varchar(4000) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `calories` float NOT NULL,
  `caloriesFromFat` float NOT NULL,
  `totalFat` float NOT NULL,
  `saturatedFat` float NOT NULL,
  `transFattyAcid` float NOT NULL,
  `polyunsaturatedFat` float NOT NULL,
  `monounsaturatedFat` float NOT NULL,
  `cholesterol` float NOT NULL,
  `sodium` float NOT NULL,
  `totalCarbohydrate` float NOT NULL,
  `dietaryFiber` float NOT NULL,
  `sugars` float NOT NULL,
  `protein` float NOT NULL,
  `vitaminA` int(11) NOT NULL,
  `vitaminC` int(11) NOT NULL,
  `calcium` int(11) NOT NULL,
  `iron` int(11) NOT NULL,
  `refusePct` int(11) NOT NULL,
  `servingsPerContainer` int(11) NOT NULL,
  `servingSizeQty` float NOT NULL,
  `servingSizeUnit` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `servingWeightGrams` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
