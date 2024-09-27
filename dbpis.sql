-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2024 at 11:57 AM
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
(4, '100000000004', 'Transmission Belt', 'Gates', 'Mechanical', 25, 25, '2024-09-26 13:59:50'),
(5, '100000000005', 'Carburetor', 'Holley', 'Automotive', 5, 30, '2024-09-20 09:39:16'),
(6, '100000000006', 'Electric Motor', 'ABB', 'Electromechanical', 10, 40, '2024-09-20 09:39:16'),
(7, '100000000007', 'Gearbox', 'SEW-Eurodrive', 'Mechanical', 8, 25, '2024-09-20 09:39:16'),
(8, '100000000008', 'RJ-45', 'Phoenix', 'Information Tech', 50, 60, '2024-09-20 09:39:16'),
(9, '100000000009', 'Relay Switch', 'Schneider', 'Electromechanical', 30, 150, '2024-09-20 09:39:16'),
(10, '100000000010', 'Fuel Pump', 'Denso', 'Automotive', 6, 35, '2024-09-20 09:39:16'),
(14, '100000000011', 'HDMI Cable', 'AmazonBasics', 'Information Tech', 5, 10, '2024-09-21 01:03:04'),
(15, '100000000012', 'Ethernet Cable', 'Belkin', 'Information Tech', 50, 76, '2024-09-21 07:09:29'),
(16, '100000000013', 'SSD 1TB', 'Samsung', 'Information Tech', 30, 20, '2024-09-27 02:35:28'),
(17, '100000000014', 'Ball Bearing', 'SKF', 'Mechanical', 15, 60, '2024-09-21 07:05:18'),
(18, '100000000015', 'Hydraulic Pump', 'Bosch', 'Mechanical', 5, 20, '2024-09-21 07:05:18'),
(19, '100000000016', 'Oil Filter', 'Mann', 'Automotive', 25, 5, '2024-09-23 13:21:17'),
(20, '100000000017', 'Spark Plug', 'NGK', 'Automotive', 25, 50, '2024-09-21 07:09:41'),
(21, '100000000018', 'Servo Motor', 'Siemens', 'Electromechanical', 10, 50, '2024-09-21 07:05:18'),
(22, '100000000019', 'Circuit Breaker', 'Schneider', 'Electromechanical', 20, 75, '2024-09-21 07:05:18'),
(23, '100000000020', 'Motherboard', 'ASUS', 'Information Tech', 10, 5, '2024-09-23 13:21:29'),
(24, '100000000021', 'Timing Belt', 'Gates', 'Automotive', 15, 60, '2024-09-21 07:05:18'),
(36, '100000000024', 'Ethernet Cable', 'Phoenix', 'Information Tech', 5, 2, '2024-09-23 21:32:23'),
(39, '100000000025', 'Ethernet Cable', 'Sample', 'Information Tech', 20, 5, '2024-09-24 06:07:20'),
(60, '100000000026', '34534', '1234', '213', 1, 5, '2024-09-26 19:44:36'),
(61, '100000000027', '2343', '42', '12', 12, 23, '2024-09-26 19:45:46'),
(62, '100000000028', 'asdasd', 'asdasd', 'asasd', 4, 22, '2024-09-26 20:31:49');

-- --------------------------------------------------------

--
-- Table structure for table `dbpis_prs`
--

CREATE TABLE `dbpis_prs` (
  `prs_id` int(11) NOT NULL,
  `prs_code` varchar(50) NOT NULL,
  `requested_by` varchar(100) NOT NULL,
  `department` varchar(100) DEFAULT NULL,
  `date_requested` date NOT NULL,
  `approval_status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `approval_date` date DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbpis_prs`
--

INSERT INTO `dbpis_prs` (`prs_id`, `prs_code`, `requested_by`, `department`, `date_requested`, `approval_status`, `approval_date`, `total_amount`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 'PR001', 'John Doe', 'IT', '2024-09-25', 'Approved', '2024-09-26', '1500.00', 'Urgent request for IT equipment', '2024-09-27 08:27:15', '2024-09-27 08:27:15'),
(2, 'PR002', 'Jane Smith', 'HR', '2024-09-24', 'Pending', NULL, '300.00', 'Office supplies request', '2024-09-27 08:27:15', '2024-09-27 08:27:15'),
(3, 'PR003', 'Mark Lee', 'Finance', '2024-09-23', 'Rejected', '2024-09-25', '500.00', 'Software licenses', '2024-09-27 08:27:15', '2024-09-27 08:27:15'),
(4, 'PR004', 'Emily Davis', 'Marketing', '2024-09-27', 'Approved', '2024-09-28', '1200.00', 'Promotional materials', '2024-09-27 08:27:15', '2024-09-27 08:27:15'),
(5, 'PR005', 'Chris Wong', 'Operations', '2024-09-26', 'Pending', NULL, '850.00', 'Warehouse tools', '2024-09-27 08:27:15', '2024-09-27 08:27:15');

-- --------------------------------------------------------

--
-- Table structure for table `dbpis_prsdetails`
--

CREATE TABLE `dbpis_prsdetails` (
  `prsdetails_id` int(11) NOT NULL,
  `prs_code` varchar(50) NOT NULL,
  `item_code` int(11) NOT NULL,
  `item_description` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) GENERATED ALWAYS AS (`quantity` * `unit_price`) STORED,
  `requested_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbpis_prsdetails`
--

INSERT INTO `dbpis_prsdetails` (`prsdetails_id`, `prs_code`, `item_code`, `item_description`, `quantity`, `unit_price`, `requested_date`, `created_at`, `updated_at`) VALUES
(1, 'PR001', 1001, 'Laptop', 2, '500.00', '2024-09-25', '2024-09-27 08:28:26', '2024-09-27 08:28:26'),
(2, 'PR001', 1002, 'Monitor', 1, '300.00', '2024-09-25', '2024-09-27 08:28:26', '2024-09-27 08:28:26'),
(3, 'PR002', 2001, 'Stapler', 5, '10.00', '2024-09-24', '2024-09-27 08:28:26', '2024-09-27 08:28:26'),
(4, 'PR003', 3001, 'Accounting Software', 1, '500.00', '2024-09-23', '2024-09-27 08:28:26', '2024-09-27 08:28:26'),
(5, 'PR004', 4001, 'Flyers', 50, '1.20', '2024-09-27', '2024-09-27 08:28:26', '2024-09-27 08:28:59'),
(6, 'PR004', 4002, 'Banners', 5, '100.00', '2024-09-27', '2024-09-27 08:28:26', '2024-09-27 08:28:26'),
(7, 'PR005', 5001, 'Warehouse Trolley', 2, '200.00', '2024-09-26', '2024-09-27 08:28:26', '2024-09-27 08:28:26'),
(8, 'PR005', 5002, 'Shelving Unit', 3, '150.00', '2024-09-26', '2024-09-27 08:28:26', '2024-09-27 08:28:26');

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
-- Indexes for table `dbpis_prs`
--
ALTER TABLE `dbpis_prs`
  ADD PRIMARY KEY (`prs_id`);

--
-- Indexes for table `dbpis_prsdetails`
--
ALTER TABLE `dbpis_prsdetails`
  ADD PRIMARY KEY (`prsdetails_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `dbpis_prs`
--
ALTER TABLE `dbpis_prs`
  MODIFY `prs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dbpis_prsdetails`
--
ALTER TABLE `dbpis_prsdetails`
  MODIFY `prsdetails_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `dbpis_useraccounts`
--
ALTER TABLE `dbpis_useraccounts`
  MODIFY `uaid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
