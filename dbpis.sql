-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2024 at 03:02 PM
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
  `units` varchar(20) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbpis_items`
--

INSERT INTO `dbpis_items` (`id`, `barcode`, `particular`, `brand`, `category`, `safety_stock`, `current_stock`, `units`, `last_updated`) VALUES
(15, '100000000012', 'Ethernet Cable', 'Belkin', 'Information Tech', 50, 76, 'pcs', '2024-10-11 09:30:45'),
(16, '100000000013', 'SSD 1TB', 'Samsung', 'Information Tech', 30, 20, 'pcs', '2024-10-11 09:30:47'),
(17, '100000000014', 'Ball Bearing', 'SKF', 'Mechanical', 15, 60, 'pcs', '2024-10-11 09:30:49'),
(18, '100000000015', 'Hydraulic Pump', 'Bosch', 'Mechanical', 5, 20, 'pcs', '2024-10-11 09:30:51'),
(19, '100000000016', 'Oil Filter', 'Mann', 'Automotive', 25, 5, 'pcs', '2024-10-11 09:30:54'),
(20, '100000000017', 'Spark Plug', 'NGK', 'Automotive', 25, 50, 'pcs', '2024-10-11 09:30:56'),
(21, '100000000018', 'Servo Motor', 'Siemens', 'Electromechanical', 10, 50, 'pcs', '2024-10-11 09:30:59'),
(22, '100000000019', 'Circuit Breaker', 'Schneider', 'Electromechanical', 20, 75, 'pcs', '2024-10-11 09:31:02'),
(23, '100000000020', 'Motherboard', 'ASUS', 'Information Tech', 10, 5, 'pcs', '2024-10-11 09:31:05'),
(24, '100000000021', 'Timing Belt', 'Gates', 'Automotive', 15, 60, 'pcs', '2024-10-11 09:31:07'),
(125, '100000000006', 'Electric Motor', 'ABB', 'Electromechanical', 10, 40, 'pcs', '2024-10-12 05:12:42'),
(126, '100000000007', 'Gearbox', 'SEW-Eurodrive', 'Mechanical', 8, 10, 'pcs', '2024-10-12 05:12:47'),
(127, '100000000008', 'RJ-45', 'Phoenix', 'Information Tech', 50, 60, 'pcs', '2024-10-12 05:12:52'),
(128, '100000000009', 'Relay Switch', 'Schneider', 'Electromechanical', 30, 150, 'pcs', '2024-10-12 05:12:56'),
(129, '100000000010', 'Fuel Pump', 'Denso', 'Automotive', 6, 35, 'pcs', '2024-10-12 05:13:00'),
(131, '100000000002', 'Alternator', 'Delphi', 'Automotive', 10, 60, 'pcs', '2024-10-12 02:55:26'),
(132, '100000000003', 'Servo Motor', 'Siemens', 'Electromechanical', 15, 80, 'pcs', '2024-10-12 02:36:50'),
(133, '100000000004', 'Transmission Belt', 'Gates', 'Mechanical', 25, 25, 'pcs', '2024-10-12 02:36:50'),
(134, '100000000005', 'Carburetor', 'Holley', 'Automotive', 5, 10, 'pcs', '2024-10-12 02:36:50'),
(140, '100000000011', 'Hydraulic Pump', 'Bosch', 'Mechanical', 20, 25, 'pcs', '2024-10-12 02:51:07'),
(141, '	100000000001', 'Hydraulic Pump', 'Bosch', 'Mechanical', 20, 19, 'pcs', '2024-10-12 05:11:37'),
(142, '100000000022', 'asdasd', 'asdasd', 'Information Tech', 2, 5, 'box', '2024-10-12 00:40:22');

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
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbpis_prs`
--

INSERT INTO `dbpis_prs` (`prs_id`, `prs_code`, `requested_by`, `department`, `date_requested`, `approval_status`, `approval_date`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 'PR001', 'John Doe', 'IT', '2024-09-25', 'Approved', '2024-09-26', 'Urgent request for IT equipment', '2024-09-27 08:27:15', '2024-09-27 08:27:15'),
(2, 'PR002', 'Jane Smith', 'HR', '2024-09-24', 'Pending', NULL, 'Office supplies request', '2024-09-27 08:27:15', '2024-09-27 08:27:15'),
(3, 'PR003', 'Mark Lee', 'Finance', '2024-09-23', 'Rejected', '2024-09-25', 'Software licenses', '2024-09-27 08:27:15', '2024-09-27 08:27:15'),
(4, 'PR004', 'Emily Davis', 'Marketing', '2024-09-27', 'Approved', '2024-09-28', 'Promotional materials', '2024-09-27 08:27:15', '2024-09-27 08:27:15'),
(5, 'PR005', 'Chris Wong', 'Operations', '2024-09-26', 'Pending', NULL, 'Warehouse tools', '2024-09-27 08:27:15', '2024-09-27 08:27:15'),
(9, '121312', 'dassd', 'sdadas', '2024-10-13', 'Pending', NULL, 'asdsd', '2024-10-13 12:55:59', '2024-10-13 12:55:59'),
(10, '123', '43', '22', '2024-10-13', 'Pending', NULL, 'ds', '2024-10-13 12:59:10', '2024-10-13 12:59:10');

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
  `unit_type` varchar(50) NOT NULL,
  `requested_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbpis_prsdetails`
--

INSERT INTO `dbpis_prsdetails` (`prsdetails_id`, `prs_code`, `item_code`, `item_description`, `quantity`, `unit_price`, `unit_type`, `requested_date`, `created_at`, `updated_at`) VALUES
(1, 'PR001', 1001, 'Laptop', 2, '500.00', '', '2024-09-25', '2024-09-27 08:28:26', '2024-09-27 08:28:26'),
(2, 'PR001', 1002, 'Monitor', 1, '300.00', '', '2024-09-25', '2024-09-27 08:28:26', '2024-09-27 08:28:26'),
(3, 'PR002', 2001, 'Stapler', 5, '10.00', '', '2024-09-24', '2024-09-27 08:28:26', '2024-09-27 08:28:26'),
(4, 'PR003', 3001, 'Accounting Software', 1, '500.00', '', '2024-09-23', '2024-09-27 08:28:26', '2024-09-27 08:28:26'),
(5, 'PR004', 4001, 'Flyers', 50, '1.20', '', '2024-09-27', '2024-09-27 08:28:26', '2024-09-27 08:28:59'),
(6, 'PR004', 4002, 'Banners', 5, '100.00', '', '2024-09-27', '2024-09-27 08:28:26', '2024-09-27 08:28:26'),
(7, 'PR005', 5001, 'Warehouse Trolley', 2, '200.00', '', '2024-09-26', '2024-09-27 08:28:26', '2024-09-27 08:28:26'),
(8, 'PR005', 5002, 'Shelving Unit', 3, '150.00', '', '2024-09-26', '2024-09-27 08:28:26', '2024-09-27 08:28:26'),
(12, '121312', 1, '4', 2, '52.00', 'pcs', '2024-10-13', '2024-10-13 12:55:59', '2024-10-13 12:55:59'),
(13, '121312', 2, '4', 55, '2.00', 'pcs', '2024-10-13', '2024-10-13 12:55:59', '2024-10-13 12:55:59'),
(14, '123', 4, '432', 55, '4.00', 'pcs', '2024-10-13', '2024-10-13 12:59:10', '2024-10-13 12:59:10'),
(15, '123', 5, '23', 2, '67.00', 'box', '2024-10-13', '2024-10-13 12:59:10', '2024-10-13 12:59:10');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `dbpis_prs`
--
ALTER TABLE `dbpis_prs`
  MODIFY `prs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `dbpis_prsdetails`
--
ALTER TABLE `dbpis_prsdetails`
  MODIFY `prsdetails_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `dbpis_useraccounts`
--
ALTER TABLE `dbpis_useraccounts`
  MODIFY `uaid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
