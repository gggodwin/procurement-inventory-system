-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2024 at 06:05 AM
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
-- Table structure for table `dbpis_department`
--

CREATE TABLE `dbpis_department` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(100) NOT NULL,
  `dept_group` varchar(100) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbpis_department`
--

INSERT INTO `dbpis_department` (`dept_id`, `dept_name`, `dept_group`, `CreatedAt`, `UpdatedAt`) VALUES
(101, 'Human Resources', 'Administration', '2024-10-15 09:47:12', '2024-10-15 12:28:45'),
(103, 'Information Technology', 'Technical', '2024-10-15 09:47:12', '2024-10-15 10:18:09'),
(106, 'Customer Service', 'Support', '2024-10-15 09:47:12', '2024-10-15 10:18:22'),
(109, 'College ', 'Academic', '2024-10-16 13:04:18', '2024-10-16 13:04:18');

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
(232, '100001', 'Thermal Paste', 'Arctic', 'I.T Supplies', 10, 50, 'tubes', '2024-10-18 00:10:58'),
(233, '100002', 'USB Flash Drive', 'SanDisk', 'I.T Supplies', 5, 30, 'units', '2024-10-18 00:10:58'),
(234, '100003', 'HDMI Cable', 'Belkin', 'I.T Supplies', 15, 10, 'meters', '2024-10-18 00:15:02'),
(235, '100004', 'Power Supply Unit', 'Corsair', 'I.T Supplies', 8, 25, 'units', '2024-10-18 00:10:58'),
(236, '100005', 'Cooling Fan', 'Noctua', 'I.T Supplies', 12, 35, 'units', '2024-10-18 00:10:58'),
(237, '100006', 'Engine Oil', 'Shell', 'Automotive Supplies', 20, 60, 'liters', '2024-10-18 00:10:58'),
(238, '100007', 'Brake Pads', 'Bosch', 'Automotive Supplies', 15, 50, 'pairs', '2024-10-18 00:10:58'),
(239, '100008', 'Air Filter', 'K&N', 'Automotive Supplies', 10, 30, 'units', '2024-10-18 00:10:58'),
(240, '100009', 'Fuel Filter', 'ACDelco', 'Automotive Supplies', 8, 25, 'units', '2024-10-18 00:10:58'),
(241, '100010', 'Battery', 'Exide', 'Automotive Supplies', 5, 15, 'units', '2024-10-18 00:10:58'),
(242, '100011', 'Welding Rods', 'Lincoln Electric', 'Welding Supplies', 50, 100, 'packs', '2024-10-18 00:10:58'),
(243, '100012', 'Drill Bits Set', 'Dewalt', 'Tools', 20, 60, 'sets', '2024-10-18 00:10:58'),
(244, '100013', 'Cutting Oil', 'Mobil', 'Maintenance', 10, 40, 'liters', '2024-10-18 00:10:58'),
(245, '100014', 'Safety Gloves', '3M', 'Safety Gear', 25, 100, 'pairs', '2024-10-18 00:10:58'),
(246, '100015', 'Ear Protection', 'Howard Leight', 'Safety Gear', 30, 80, 'pairs', '2024-10-18 00:10:58'),
(247, '100016', 'Relay Module', 'SainSmart', 'Electromechanical Supplies', 10, 30, 'units', '2024-10-18 00:10:58'),
(248, '100017', 'Solenoid Valve', 'ASCO', 'Electromechanical Supplies', 5, 15, 'units', '2024-10-18 00:10:58'),
(249, '100018', 'Circuit Breaker', 'Schneider Electric', 'Electromechanical Supplies', 8, 20, 'units', '2024-10-18 00:10:58'),
(250, '100019', 'Electrical Wire', 'Southwire', 'Electromechanical Supplies', 50, 200, 'meters', '2024-10-18 00:10:58'),
(251, '100020', 'Connector Kit', 'Molex', 'Electromechanical Supplies', 15, 45, 'kits', '2024-10-18 00:10:58'),
(252, '100021', 'Multimeter', 'Fluke', 'Electromechanical Supplies', 5, 10, 'units', '2024-10-18 00:10:58'),
(253, '100022', 'Soldering Wire', 'Kester', 'Electromechanical Supplies', 20, 75, 'spools', '2024-10-18 00:10:58'),
(254, '100023', 'Network Cable', 'TP-Link', 'I.T Supplies', 10, 50, 'meters', '2024-10-18 00:11:08'),
(255, '100024', 'Router', 'Netgear', 'I.T Supplies', 8, 20, 'units', '2024-10-18 00:11:08'),
(256, '100025', 'Mouse', 'Logitech', 'I.T Supplies', 15, 40, 'units', '2024-10-18 00:11:08'),
(257, '100026', 'Keyboard', 'Microsoft', 'I.T Supplies', 10, 30, 'units', '2024-10-18 00:11:08'),
(258, '100027', 'Monitor', 'Samsung', 'I.T Supplies', 5, 10, 'units', '2024-10-18 00:11:08'),
(259, '100028', 'Tire Pressure Gauge', 'Slime', 'Automotive Supplies', 20, 60, 'units', '2024-10-18 00:11:08'),
(260, '100029', 'Spark Plugs', 'NGK', 'Automotive Supplies', 15, 45, 'units', '2024-10-18 00:11:08'),
(261, '100030', 'Coolant', 'Prestone', 'Automotive Supplies', 12, 30, 'liters', '2024-10-18 00:11:08'),
(262, '100031', 'Fuel Injector Cleaner', 'Chevron', 'Automotive Supplies', 10, 25, 'bottles', '2024-10-18 00:11:08'),
(263, '100032', 'Pliers', 'Irwin', 'Automotive Supplies', 8, 20, 'units', '2024-10-18 00:11:08'),
(264, '100033', 'Capacitor', 'Nichicon', 'I.T Supplies', 10, 5, 'units', '2024-10-18 00:24:42'),
(265, '100034', 'Inductor', 'Wurth', 'Electromechanical Supplies', 15, 40, 'units', '2024-10-18 00:11:08'),
(266, '100035', 'PCB Board', 'Adafruit', 'Electromechanical Supplies', 5, 15, 'units', '2024-10-18 00:11:08'),
(267, '100036', 'Servo Motor', 'TowerPro', 'Electromechanical Supplies', 8, 25, 'units', '2024-10-18 00:11:08'),
(268, '100037', 'Breadboard', 'Elegoo', 'Electromechanical Supplies', 10, 35, 'units', '2024-10-18 00:11:08'),
(269, '100038', 'Heat Shrink Tubing', 'Goot', 'Electromechanical Supplies', 20, 80, 'meters', '2024-10-18 00:11:08'),
(270, '100039', 'Diode', 'Vishay', 'Electromechanical Supplies', 15, 50, 'units', '2024-10-18 00:11:08'),
(271, '100040', 'Resistor Kit', 'Bourns', 'Electromechanical Supplies', 10, 60, 'kits', '2024-10-18 00:11:08'),
(272, '100041', 'Screwdriver Set', 'Stanley', 'Tools', 5, 10, 'sets', '2024-10-18 00:11:08'),
(273, '100042', 'Flashlight', 'Maglite', 'Tools', 8, 20, 'units', '2024-10-18 00:11:08'),
(274, '100043', 'Welding Helmet', 'Lincoln Electric', 'Welding Supplies', 10, 30, 'units', '2024-10-18 00:12:35'),
(275, '100044', 'Welding Gloves', 'Miller', 'Welding Supplies', 15, 50, 'pairs', '2024-10-18 00:12:35'),
(276, '100045', 'Welding Wire', 'Hobart', 'Welding Supplies', 20, 60, 'spools', '2024-10-18 00:12:35'),
(277, '100046', 'Welding Rods', 'ESAB', 'Welding Supplies', 12, 40, 'packs', '2024-10-18 00:12:35'),
(278, '100047', 'Cutting Torch', 'Victor', 'Welding Supplies', 5, 15, 'units', '2024-10-18 00:12:35');

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
  `approved_by` varchar(255) NOT NULL,
  `date_needed` date DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbpis_prs`
--

INSERT INTO `dbpis_prs` (`prs_id`, `prs_code`, `requested_by`, `department`, `date_requested`, `approval_status`, `approved_by`, `date_needed`, `remarks`, `created_at`, `updated_at`) VALUES
(37, '6000', 'Godwin Santiago', 'Information Technology', '2024-10-18', 'Approved', 'Godwin Santiago', '2024-10-22', 'sample description ', '2024-10-18 00:32:53', '2024-10-18 01:49:24'),
(38, '6001', 'Godwin Santiago', 'College ', '2024-10-18', 'Pending', '', '2024-10-22', 'CSS NC II TOOLS', '2024-10-18 00:39:03', '2024-10-18 00:39:03'),
(39, '6002', 'Godwin Santiago', 'College ', '2024-10-18', 'Approved', 'Super Admin', '2024-10-22', 'sample ', '2024-10-18 02:03:10', '2024-10-18 02:03:39'),
(40, '6003', 'Godwin Santiago', 'College ', '2024-10-18', 'Pending', '', '2024-10-21', 'sadsdasd', '2024-10-18 03:04:15', '2024-10-18 03:04:15'),
(41, '6004', 'Godwin Santiago', 'Information Technology', '2024-10-18', 'Pending', '', '2024-10-18', '424', '2024-10-18 03:07:12', '2024-10-18 03:07:12'),
(42, '6005', 'Godwin Santiago', 'Information Technology', '2024-10-18', 'Pending', '', '2024-10-29', '42141', '2024-10-18 03:24:40', '2024-10-18 03:24:40'),
(43, '6006', 'Godwin Santiago', 'Information Technology', '2024-10-18', 'Pending', '', '2024-10-22', '42412', '2024-10-18 03:26:32', '2024-10-18 03:26:32'),
(44, '6007', 'Godwin Santiago', 'Customer Service', '2024-10-18', 'Pending', '', '2024-10-23', '13413', '2024-10-18 03:31:30', '2024-10-18 03:31:30'),
(45, '6008', 'Godwin Santiago', 'Information Technology', '2024-10-18', 'Pending', '', '2024-10-21', '24', '2024-10-18 03:35:42', '2024-10-18 03:35:42'),
(46, '6009', 'Godwin Santiago', 'Information Technology', '2024-10-18', 'Pending', '', '2024-10-21', '42', '2024-10-18 03:36:51', '2024-10-18 03:36:51'),
(47, '6010', 'Godwin Santiago', 'Information Technology', '2024-10-18', 'Pending', '', '2024-10-29', '4', '2024-10-18 03:40:15', '2024-10-18 03:40:15'),
(48, '6011', 'Godwin Santiago', 'Information Technology', '2024-10-18', 'Pending', '', '2024-10-30', '42', '2024-10-18 03:44:02', '2024-10-18 03:44:02'),
(49, '6012', 'Godwin Santiago', 'Information Technology', '2024-10-18', 'Pending', '', '2024-10-28', '43', '2024-10-18 03:45:11', '2024-10-18 03:45:11'),
(50, '6013', 'Godwin Santiago', 'Information Technology', '2024-10-18', 'Pending', '', '2024-10-22', '24', '2024-10-18 03:46:32', '2024-10-18 03:46:32'),
(51, '6014', 'Godwin Santiago', 'Information Technology', '2024-10-18', 'Pending', '', '2024-10-22', '', '2024-10-18 03:47:35', '2024-10-18 03:47:35'),
(52, '6015', 'Godwin Santiago', 'Human Resources', '2024-10-18', 'Pending', '', '2024-10-15', 'ds', '2024-10-18 03:55:11', '2024-10-18 03:55:11'),
(53, '6016', 'Godwin Santiago', 'Information Technology', '2024-10-18', 'Pending', '', '2024-10-23', '24', '2024-10-18 04:04:56', '2024-10-18 04:04:56');

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
  `supplier` varchar(255) NOT NULL,
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

INSERT INTO `dbpis_prsdetails` (`prsdetails_id`, `prs_code`, `item_code`, `item_description`, `quantity`, `supplier`, `unit_price`, `unit_type`, `requested_date`, `created_at`, `updated_at`) VALUES
(56, '6000', 100003, 'HDMI Cable - Belkin', 24, 'Office Essentials', '2.00', 'kg', '2024-10-18', '2024-10-18 00:32:53', '2024-10-18 00:32:53'),
(57, '6001', 100001, 'Thermal Paste - Arctic', 5, 'Office Essentials', '140.00', 'pcs', '2024-10-18', '2024-10-18 00:39:03', '2024-10-18 00:39:03'),
(58, '6002', 100005, 'Cooling Fan - Noctua', 24, 'Warehouse Supplies Ltd.', '42.00', 'kg', '2024-10-18', '2024-10-18 02:03:10', '2024-10-18 02:03:10'),
(59, '6002', 100003, 'HDMI Cable - Belkin', 5, 'Warehouse Supplies Ltd.', '4.00', 'pcs', '2024-10-18', '2024-10-18 02:03:10', '2024-10-18 02:03:10'),
(60, '6003', 100005, '100005', 52, 'Office Essentials', '52.00', 'units', '2024-10-18', '2024-10-18 03:04:15', '2024-10-18 03:04:15'),
(61, '6003', 100017, '100017', 42, 'Tech Supply Co.', '44.00', 'units', '2024-10-18', '2024-10-18 03:04:15', '2024-10-18 03:04:15'),
(62, '6003', 100001, '100001', 5, 'Electro World', '52.00', 'tubes', '2024-10-18', '2024-10-18 03:04:16', '2024-10-18 03:04:16'),
(63, '6004', 100002, '100002', 4, 'Warehouse Supplies Ltd.', '52.00', 'units', '2024-10-18', '2024-10-18 03:07:12', '2024-10-18 03:07:12'),
(64, '6005', 100004, '100004', 4524, 'Electro World', '42.00', 'units', '2024-10-18', '2024-10-18 03:24:40', '2024-10-18 03:24:40'),
(65, '6005', 100001, '100001', 42, 'Electro World', '42.00', 'tubes', '2024-10-18', '2024-10-18 03:24:40', '2024-10-18 03:24:40'),
(66, '6006', 100004, '100004', 42, 'Electro World', '42.00', 'units', '2024-10-18', '2024-10-18 03:26:32', '2024-10-18 03:26:32'),
(67, '6007', 100005, '100005', 213, 'Office Essentials', '53.00', 'units', '2024-10-18', '2024-10-18 03:31:30', '2024-10-18 03:31:30'),
(68, '6007', 100001, '100001', 42, 'Electro World', '43.00', 'tubes', '2024-10-18', '2024-10-18 03:31:30', '2024-10-18 03:31:30'),
(69, '6008', 100005, '100005', 421, 'Electro World', '1.00', 'pcs', '2024-10-18', '2024-10-18 03:35:42', '2024-10-18 03:35:42'),
(70, '6009', 100004, 'Power Supply Unit - Corsair', 412, 'Warehouse Supplies Ltd.', '1.00', 'kg', '2024-10-18', '2024-10-18 03:36:51', '2024-10-18 03:36:51'),
(71, '6010', 100004, '100004', 421, 'Electro World', '1.00', 'units', '2024-10-18', '2024-10-18 03:40:15', '2024-10-18 03:40:15'),
(72, '6011', 100005, '100005', 42, 'Electro World', '42.00', 'units', '2024-10-18', '2024-10-18 03:44:02', '2024-10-18 03:44:02'),
(73, '6012', 100004, '100004', 53, 'Electro World', '31.00', 'units', '2024-10-18', '2024-10-18 03:45:11', '2024-10-18 03:45:11'),
(74, '6013', 100004, '100004', 42, 'Warehouse Supplies Ltd.', '42.00', 'units', '2024-10-18', '2024-10-18 03:46:32', '2024-10-18 03:46:32'),
(75, '6014', 100004, '100004', 24, 'Warehouse Supplies Ltd.', '42.00', 'units', '2024-10-18', '2024-10-18 03:47:35', '2024-10-18 03:47:35'),
(76, '6015', 100005, '100005', 42, 'Warehouse Supplies Ltd.', '42.00', 'units', '2024-10-18', '2024-10-18 03:55:11', '2024-10-18 03:55:11'),
(77, '6016', 100005, 'Cooling Fan - Noctua', 3, 'Electro World', '2.00', 'pcs', '2024-10-18', '2024-10-18 04:04:56', '2024-10-18 04:04:56');

-- --------------------------------------------------------

--
-- Table structure for table `dbpis_supplier`
--

CREATE TABLE `dbpis_supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `contact_name` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbpis_supplier`
--

INSERT INTO `dbpis_supplier` (`supplier_id`, `supplier_name`, `contact_name`, `contact_email`, `contact_phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Tech Supply Co.', 'John Doe', 'john.doe@techsupply.com', '555-1234', '123 Tech Street', '2024-10-15 12:57:22', '2024-10-15 12:57:22'),
(2, 'Office Essentials', 'Jane Smith', 'jane.smith@officeessentials.com', '555-5678', '456 Office Ave', '2024-10-15 12:57:22', '2024-10-15 12:57:22'),
(3, 'Warehouse Supplies Ltd.', 'Robert Brown', 'robert.brown@warehousesupplies.com', '555-8765', '789 Warehouse Blvd', '2024-10-15 12:57:22', '2024-10-15 12:57:22'),
(4, 'Electro World', 'Alice Green', 'alice.green@electroworld.com', '555-4321', '101 Electro Way', '2024-10-15 12:57:22', '2024-10-15 12:57:22');

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
(1, 'Super Admin', 'admin', 'admin', 1, 0),
(2, 'Godwin Santiago', 'godwin', '123456', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dbpis_department`
--
ALTER TABLE `dbpis_department`
  ADD PRIMARY KEY (`dept_id`);

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
-- Indexes for table `dbpis_supplier`
--
ALTER TABLE `dbpis_supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `dbpis_useraccounts`
--
ALTER TABLE `dbpis_useraccounts`
  ADD PRIMARY KEY (`uaid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dbpis_department`
--
ALTER TABLE `dbpis_department`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `dbpis_items`
--
ALTER TABLE `dbpis_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=279;

--
-- AUTO_INCREMENT for table `dbpis_prs`
--
ALTER TABLE `dbpis_prs`
  MODIFY `prs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `dbpis_prsdetails`
--
ALTER TABLE `dbpis_prsdetails`
  MODIFY `prsdetails_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `dbpis_supplier`
--
ALTER TABLE `dbpis_supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dbpis_useraccounts`
--
ALTER TABLE `dbpis_useraccounts`
  MODIFY `uaid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
