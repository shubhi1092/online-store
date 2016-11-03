-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2016 at 05:11 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online store`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ID` varchar(10) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Category` varchar(10) NOT NULL,
  `Quantity` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `Name`, `Category`, `Quantity`) VALUES
('2', 'abcd', 'putc', 10),
('29', 'ab', '12', 10),
('5', 'abcd', 'c1', 10),
('6', 'test', 'c1', 16),
('7', 'test', 'c2', 18),
('8', 'test', 'c2', 18),
('9', 'test', 'c2', 10),
('4', 'tets', 'c2', 10),
('10', 'abcd', 'c2', 20),
('11', 'abcd', 'c2', 20),
('14', 'abcd', 'putc', 10),
('15', 'abcd', 'c2', 20),
('16', 'abcd', 'c2', 20),
('17', 'abcd', 'c2', 20),
('18', 'abcd', 'c2', 20),
('19', 'abcd', 'c2', 20),
('20', 'abcd', 'c2', 20),
('21', 'abcd', 'c2', 20),
('22', 'abcd', 'c2', 20),
('23', 'abcd', 'c2', 20),
('24', 'abcd', 'c2', 20),
('25', 'abcd', 'c2', 20),
('26', 'abcd', 'c2', 20),
('27', 'abcd', 'c2', 20),
('28', 'abcd', 'c2', 20),
('1', 'abcd', 'c1', 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `U_ID` varchar(10) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Access_token` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`U_ID`, `Username`, `Access_token`) VALUES
('user1', 'ab_user', '123abc');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`U_ID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Access_token` (`Access_token`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
