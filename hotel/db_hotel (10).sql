-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2021 at 08:50 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill_items`
--

CREATE TABLE `bill_items` (
  `entry_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `item_rate` int(11) NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bill_items`
--

INSERT INTO `bill_items` (`entry_id`, `bill_id`, `item_id`, `item_qty`, `item_rate`, `updated_time`, `updated_by`) VALUES
(294, 1, 4, 5, 60, '2021-09-29 06:34:32', 1),
(295, 1, 3, 2, 300, '2021-09-29 06:45:20', 1),
(296, 2, 4, 2, 60, '2021-09-29 06:46:19', 1),
(297, 2, 5, 3, 25, '2021-09-29 06:46:27', 1),
(298, 3, 5, 1, 25, '2021-09-29 06:58:54', 1),
(299, 3, 5, 1, 25, '2021-09-29 07:03:43', 1),
(300, 3, 3, 1, 300, '2021-09-29 07:03:46', 1),
(302, 4, 4, 1, 60, '2021-09-29 07:31:11', 1),
(303, 4, 3, 1, 300, '2021-09-29 07:32:15', 1),
(304, 5, 5, 7, 25, '2021-09-29 07:32:52', 1),
(316, 6, 4, 1, 60, '2021-09-30 01:22:28', 1),
(317, 6, 5, 1, 25, '2021-09-30 01:22:42', 1),
(318, 6, 3, 1, 300, '2021-09-30 01:22:56', 1),
(319, 7, 5, 1, 25, '2021-09-30 01:24:27', 1),
(320, 8, 3, 1, 300, '2021-09-30 01:25:26', 1),
(321, 9, 4, 3, 60, '2021-09-30 01:25:48', 1),
(322, 10, 3, 1, 300, '2021-09-30 01:28:40', 1),
(323, 10, 4, 1, 60, '2021-09-30 01:31:16', 1),
(324, 11, 4, 1, 60, '2021-09-30 01:31:46', 1),
(325, 12, 3, 1, 300, '2021-09-30 03:15:56', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_acc_master`
--

CREATE TABLE `customer_acc_master` (
  `transaction_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `cust_bill_no` varchar(50) NOT NULL,
  `cust_bill_date` date NOT NULL,
  `cust_bill_time` time NOT NULL,
  `cust_bill_amount` int(11) NOT NULL,
  `is_paid` tinyint(4) NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_acc_master`
--

INSERT INTO `customer_acc_master` (`transaction_id`, `cust_id`, `cust_bill_no`, `cust_bill_date`, `cust_bill_time`, `cust_bill_amount`, `is_paid`, `updated_time`, `updated_by`) VALUES
(1, 2, '1', '2021-09-20', '02:00:00', 500, 0, '2021-09-19 18:30:00', 1),
(2, 2, '2', '2021-09-20', '10:00:00', 1000, 0, '2021-09-09 18:30:00', 1),
(3, 1, '5', '2021-09-20', '04:00:00', 200, 1, '2021-09-19 22:30:00', 1),
(4, 1, '6', '2021-09-20', '03:16:00', 100, 0, '2021-09-19 21:49:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_master`
--

CREATE TABLE `customer_master` (
  `cust_id` int(11) NOT NULL,
  `cust_name` varchar(50) NOT NULL,
  `cust_address` text NOT NULL,
  `cust_city` varchar(50) NOT NULL,
  `cust_email` varchar(50) NOT NULL,
  `cust_mobile` varchar(20) NOT NULL,
  `cust_dob` date NOT NULL,
  `cust_annivesary_date` date NOT NULL,
  `cust_gst_no` varchar(50) NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_master`
--

INSERT INTO `customer_master` (`cust_id`, `cust_name`, `cust_address`, `cust_city`, `cust_email`, `cust_mobile`, `cust_dob`, `cust_annivesary_date`, `cust_gst_no`, `updated_time`, `updated_by`) VALUES
(1, 'abc', 'abc', 'ahm', 'abc@abc.com', '2147483647', '2021-08-30', '2021-08-23', 'abc456', '2021-08-28 18:18:29', 1),
(2, 'xyz', 'xyz', 'AHM', 'xyz@123.com', '9852364175', '2021-08-31', '2021-08-31', 'abc456', '2021-09-02 10:19:34', 1),
(3, 'Vipul patel', 'GROUND FLOOR. 42, BHANDRA ROAD, NAGPUR, MAHARASTRA - 440008', 'NAGPUR', 'pra@abc.com', '6523147895', '2021-08-04', '2021-09-11', 'abc456', '2021-09-02 10:19:20', 1),
(4, 'Vijal', 'GROUND FLOOR', 'NAGPUR', '', '5662224425', '2021-08-25', '2021-08-10', 'cac456', '2021-09-02 10:18:52', 1),
(5, 'aaa', 'GROUND FLOOR. 42, BHANDRA ROAD, NAGPUR, MAHARASTRA - 440008', 'NAGPUR', 'pra@abc.com', '1234567890', '2021-09-11', '2021-08-27', 'abc456', '2021-08-30 16:44:06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `department_master`
--

CREATE TABLE `department_master` (
  `department_id` int(11) NOT NULL,
  `department_code` int(100) NOT NULL,
  `department_name` varchar(50) NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_master`
--

INSERT INTO `department_master` (`department_id`, `department_code`, `department_name`, `updated_time`, `updated_by`) VALUES
(1, 1, 'AAB', '2021-08-29 21:47:18', 1),
(2, 2, 'BBC', '2021-08-29 21:45:32', 1),
(3, 3, 'AAA', '2021-08-30 16:58:22', 1),
(5, 5, 'ased', '2021-08-30 17:10:28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ex_tax_master`
--

CREATE TABLE `ex_tax_master` (
  `tax_id` int(11) NOT NULL,
  `tax_name` varchar(50) NOT NULL,
  `tax_percent` int(11) NOT NULL,
  `tax_description` varchar(50) NOT NULL,
  `tax_type` varchar(50) NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_master`
--

CREATE TABLE `hotel_master` (
  `hotel_id` int(11) NOT NULL,
  `hotel_name` varchar(50) NOT NULL,
  `hotel_mobile` varchar(30) NOT NULL,
  `hotel_website` varchar(50) NOT NULL,
  `hotel_reg_no` varchar(50) NOT NULL,
  `hotel_gst_no` varchar(50) NOT NULL,
  `hotel_email` varchar(40) NOT NULL,
  `hotel_address` text NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hotel_master`
--

INSERT INTO `hotel_master` (`hotel_id`, `hotel_name`, `hotel_mobile`, `hotel_website`, `hotel_reg_no`, `hotel_gst_no`, `hotel_email`, `hotel_address`, `updated_time`, `updated_by`) VALUES
(2, 'sankalp', '65234178', 'abc.tk', '123edfg', '123abcxyz', 'acb@123.tk', 'AHM', '2021-09-09 11:33:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `item_master`
--

CREATE TABLE `item_master` (
  `item_id` int(11) NOT NULL,
  `item_code` varchar(100) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_unit` varchar(100) NOT NULL,
  `item_rate_1` int(11) NOT NULL,
  `item_rate_2` int(11) NOT NULL,
  `item_rate_3` int(11) NOT NULL,
  `item_rate_4` int(11) NOT NULL,
  `item_rate_5` int(11) NOT NULL,
  `item_rate_6` int(11) NOT NULL,
  `department_name` varchar(50) NOT NULL,
  `item_type` varchar(100) NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_master`
--

INSERT INTO `item_master` (`item_id`, `item_code`, `item_name`, `item_unit`, `item_rate_1`, `item_rate_2`, `item_rate_3`, `item_rate_4`, `item_rate_5`, `item_rate_6`, `department_name`, `item_type`, `updated_time`, `updated_by`) VALUES
(3, '1', 'aaa', 'abc', 300, 500, 800, 1000, 5000, 10000, '3', '1', '2021-09-17 08:53:29', 1),
(4, '2', 'abb', 'kg', 60, 0, 0, 0, 0, 0, '3', '1', '2021-09-27 10:08:32', 1),
(5, '003', 'FLOUR', 'KG', 25, 0, 0, 0, 0, 0, '5', '0', '2021-09-20 09:06:40', 1);

-- --------------------------------------------------------

--
-- Table structure for table `new_table_master`
--

CREATE TABLE `new_table_master` (
  `table_id` int(11) NOT NULL,
  `table_no` varchar(50) NOT NULL,
  `table_rate_type` varchar(100) NOT NULL,
  `table_type` varchar(100) NOT NULL,
  `table_sgst` int(11) NOT NULL,
  `table_cgst` int(11) NOT NULL,
  `table_discount` int(100) NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `new_table_master`
--

INSERT INTO `new_table_master` (`table_id`, `table_no`, `table_rate_type`, `table_type`, `table_sgst`, `table_cgst`, `table_discount`, `updated_time`, `updated_by`) VALUES
(1, '1', 'abb', 'Type 2', 9, 9, 15, '2021-09-07 08:56:28', 1),
(3, '2', 'abb', 'Type 1', 6, 6, 10, '2021-09-07 08:56:42', 1),
(4, '3', '500', 'Type 3', 6, 6, 5, '2021-09-07 08:56:04', 1),
(5, '4', '1', 'Type 2', 7, 6, 6, '2021-09-29 10:33:05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock_master`
--

CREATE TABLE `stock_master` (
  `stock_id` int(11) NOT NULL,
  `stock_company_name` varchar(150) NOT NULL,
  `stock_bill_no` varchar(150) NOT NULL,
  `stock_date` date NOT NULL,
  `stock_barcode_no` int(11) NOT NULL,
  `stock_item_type` varchar(100) NOT NULL,
  `stock_item_name` varchar(100) NOT NULL,
  `stock` varchar(100) NOT NULL,
  `stock_qty` varchar(100) NOT NULL,
  `stock_unit` varchar(100) NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_master`
--

INSERT INTO `stock_master` (`stock_id`, `stock_company_name`, `stock_bill_no`, `stock_date`, `stock_barcode_no`, `stock_item_type`, `stock_item_name`, `stock`, `stock_qty`, `stock_unit`, `updated_time`, `updated_by`) VALUES
(2, 'aaa', '001', '2021-12-06', 12334, 'Item Type 2', '4', '50', '100', 'PCS', '2021-09-16 08:47:03', 1),
(3, 'aaa', '002', '2021-09-16', 2021, '1', '3', '10', '10', 'kg', '2021-09-22 10:08:54', 1),
(4, 'xyz', '110', '2021-09-20', 1202, '0', '5', '25', '25', 'kg', '2021-09-20 09:11:05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tax_master`
--

CREATE TABLE `tax_master` (
  `tax_id` int(11) NOT NULL,
  `tax_cgst` float NOT NULL,
  `tax_sgst` float NOT NULL,
  `tax_igst` float NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tax_master`
--

INSERT INTO `tax_master` (`tax_id`, `tax_cgst`, `tax_sgst`, `tax_igst`, `updated_time`, `updated_by`) VALUES
(4, 1.5, 1.5, 12, '2021-09-29 06:25:56', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` char(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `admin_mobile` varchar(50) NOT NULL,
  `user_role` varchar(50) NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `email`, `username`, `password`, `admin_mobile`, `user_role`, `updated_time`, `updated_by`) VALUES
(1, 'admin@test.com', 'VISHAKHA', '123', '6523987458', '2', '2021-09-15 10:07:35', 1),
(2, 'test@456.com', 'ADMIN', '123', '9635874126', '3', '2021-09-15 10:07:09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bills`
--

CREATE TABLE `tbl_bills` (
  `bill_id` int(11) NOT NULL,
  `table_no` int(11) NOT NULL,
  `total_person` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `sub_total` varchar(30) NOT NULL,
  `discount` varchar(30) NOT NULL,
  `cgst_amount` float NOT NULL,
  `sgst_amount` float NOT NULL,
  `payment_type` int(11) NOT NULL,
  `grand_total` varchar(30) NOT NULL,
  `bill_status` int(11) NOT NULL,
  `bill_date` date DEFAULT NULL,
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_bills`
--

INSERT INTO `tbl_bills` (`bill_id`, `table_no`, `total_person`, `cust_id`, `sub_total`, `discount`, `cgst_amount`, `sgst_amount`, `payment_type`, `grand_total`, `bill_status`, `bill_date`, `updated_time`, `updated_by`) VALUES
(1, 1, 9, 5, '600', '60', 8.1, 8.1, 1, '556.2', 1, '2021-09-30', '2021-09-30 04:36:43', 1),
(2, 5, 2, 3, '195', '100', 1.425, 1.425, 1, '97.85', 1, '2021-09-30', '2021-09-30 04:36:56', 1),
(3, 3, 3, 1, '25', '7.5', 0.2625, 0.2625, 1, '18.02', 2, '2021-09-30', '2021-09-30 04:37:03', 1),
(4, 4, 0, 0, '360', '10', 5.25, 5.25, 1, '360.5', 1, '2021-09-30', '2021-09-30 04:37:09', 1),
(5, 1, 2, 0, '175', '17.5', 2.3625, 2.3625, 1, '162.23', 1, '2021-09-30', '2021-09-30 04:37:28', 1),
(6, 3, 3, 0, '385', '0', 5.775, 5.775, 3, '396.55', 1, '2021-09-30', '2021-09-30 01:23:09', 1),
(7, 3, 2, 0, '25', '9', 0.24, 0.24, 1, '16.48', 1, '2021-09-30', '2021-09-30 01:24:34', 1),
(8, 3, 2, 0, '300', '0', 4.5, 4.5, 1, '309', 1, '2021-09-30', '2021-09-30 01:25:30', 1),
(9, 4, 3, 0, '180', '0', 2.7, 2.7, 2, '185.4', 1, '2021-09-30', '2021-09-30 01:26:39', 1),
(10, 1, 0, 0, '360', '0', 5.4, 5.4, 1, '370.8', 1, '2021-09-30', '2021-09-30 01:31:37', 1),
(11, 4, 0, 0, '60', '0', 0.9, 0.9, 1, '61.8', 2, '2021-09-30', '2021-09-30 01:31:48', 1),
(12, 1, 0, 0, '300', '0', 4.5, 4.5, 1, '309', 1, '2021-09-30', '2021-09-30 03:15:58', 1);

-- --------------------------------------------------------

--
-- Table structure for table `waiter_master`
--

CREATE TABLE `waiter_master` (
  `waiter_id` int(11) NOT NULL,
  `waiter_name` varchar(100) NOT NULL,
  `waiter_type` varchar(100) NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill_items`
--
ALTER TABLE `bill_items`
  ADD PRIMARY KEY (`entry_id`);

--
-- Indexes for table `customer_acc_master`
--
ALTER TABLE `customer_acc_master`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `customer_master`
--
ALTER TABLE `customer_master`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `department_master`
--
ALTER TABLE `department_master`
  ADD PRIMARY KEY (`department_id`),
  ADD UNIQUE KEY `department_code` (`department_code`),
  ADD UNIQUE KEY `department_name` (`department_name`);

--
-- Indexes for table `ex_tax_master`
--
ALTER TABLE `ex_tax_master`
  ADD PRIMARY KEY (`tax_id`);

--
-- Indexes for table `hotel_master`
--
ALTER TABLE `hotel_master`
  ADD PRIMARY KEY (`hotel_id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `item_master`
--
ALTER TABLE `item_master`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `new_table_master`
--
ALTER TABLE `new_table_master`
  ADD PRIMARY KEY (`table_id`),
  ADD UNIQUE KEY `table_no` (`table_no`);

--
-- Indexes for table `stock_master`
--
ALTER TABLE `stock_master`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `tax_master`
--
ALTER TABLE `tax_master`
  ADD PRIMARY KEY (`tax_id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tbl_bills`
--
ALTER TABLE `tbl_bills`
  ADD PRIMARY KEY (`bill_id`);

--
-- Indexes for table `waiter_master`
--
ALTER TABLE `waiter_master`
  ADD PRIMARY KEY (`waiter_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill_items`
--
ALTER TABLE `bill_items`
  MODIFY `entry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=326;

--
-- AUTO_INCREMENT for table `customer_acc_master`
--
ALTER TABLE `customer_acc_master`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer_master`
--
ALTER TABLE `customer_master`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `department_master`
--
ALTER TABLE `department_master`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ex_tax_master`
--
ALTER TABLE `ex_tax_master`
  MODIFY `tax_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotel_master`
--
ALTER TABLE `hotel_master`
  MODIFY `hotel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item_master`
--
ALTER TABLE `item_master`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `new_table_master`
--
ALTER TABLE `new_table_master`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stock_master`
--
ALTER TABLE `stock_master`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tax_master`
--
ALTER TABLE `tax_master`
  MODIFY `tax_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `waiter_master`
--
ALTER TABLE `waiter_master`
  MODIFY `waiter_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hotel_master`
--
ALTER TABLE `hotel_master`
  ADD CONSTRAINT `hotel_master_ibfk_1` FOREIGN KEY (`updated_by`) REFERENCES `tbl_admin` (`admin_id`);

--
-- Constraints for table `tax_master`
--
ALTER TABLE `tax_master`
  ADD CONSTRAINT `tax_master_ibfk_1` FOREIGN KEY (`updated_by`) REFERENCES `tbl_admin` (`admin_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
