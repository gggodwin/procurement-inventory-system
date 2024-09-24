-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2024 at 01:26 PM
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
-- Table structure for table `dbpis_items`
--

CREATE TABLE `dbpis_items` (
  `id` int(11) NOT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `particular` varchar(255) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `safety_stock` int(11) DEFAULT NULL,
  `current_stock` int(11) DEFAULT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbpis_items`
--

INSERT INTO `dbpis_items` (`id`, `barcode`, `particular`, `brand`, `category`, `safety_stock`, `current_stock`, `last_updated`) VALUES
(1, '100000000001', 'Hydraulic Pump', 'Bosch', 'Mechanical', 20, 100, '2024-09-20 09:39:16'),
(2, '100000000002', 'Alternator', 'Delphi', 'Automotive', 10, 50, '2024-09-20 09:39:16'),
(3, '100000000003', 'Servo Motor', 'Siemens', 'Electromechanical', 15, 80, '2024-09-20 09:39:16'),
(4, '100000000004', 'Transmission Belt', 'Gates', 'Mechanical', 25, 120, '2024-09-20 09:39:16'),
(5, '100000000005', 'Carburetor', 'Holley', 'Automotive', 5, 30, '2024-09-20 09:39:16'),
(6, '100000000006', 'Electric Motor', 'ABB', 'Electromechanical', 10, 40, '2024-09-20 09:39:16'),
(7, '100000000007', 'Gearbox', 'SEW-Eurodrive', 'Mechanical', 8, 25, '2024-09-20 09:39:16'),
(8, '100000000008', 'RJ-45', 'Phoenix', 'Information Tech', 50, 60, '2024-09-20 09:39:16'),
(9, '100000000009', 'Relay Switch', 'Schneider', 'Electromechanical', 30, 150, '2024-09-20 09:39:16'),
(10, '100000000010', 'Fuel Pump', 'Denso', 'Automotive', 6, 35, '2024-09-20 09:39:16');

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
-- Indexes for table `dbpis_items`
--
ALTER TABLE `dbpis_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dbpis_useraccounts`
--
ALTER TABLE `dbpis_useraccounts`
  ADD PRIMARY KEY (`uaid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dbpis_items`
--
ALTER TABLE `dbpis_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `dbpis_useraccounts`
--
ALTER TABLE `dbpis_useraccounts`
  MODIFY `uaid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
