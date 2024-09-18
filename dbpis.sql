-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2024 at 12:55 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbpis`
--

-- --------------------------------------------------------

--
-- Table structure for table `dbpis_useraccounts`
--

CREATE TABLE `dbpis_useraccounts` (
  `uaid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `modid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbpis_useraccounts`
--

INSERT INTO `dbpis_useraccounts` (`uaid`, `name`, `username`, `password`, `status`, `modid`) VALUES
(1, 'admin', 'admin', 'admin', 1, 0),
(2, 'godwin', 'godwin', '123456', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dbpis_useraccounts`
--
ALTER TABLE `dbpis_useraccounts`
  ADD PRIMARY KEY (`uaid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dbpis_useraccounts`
--
ALTER TABLE `dbpis_useraccounts`
  MODIFY `uaid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
