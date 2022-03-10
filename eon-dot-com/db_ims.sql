-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 23, 2021 at 02:55 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ims`
--

-- --------------------------------------------------------

--
-- Table structure for table `part_master_five`
--

CREATE TABLE `part_master_five` (
  `part_id` varchar(20) NOT NULL,
  `part_ann_entry_no` varchar(20) NOT NULL,
  `part_spn` varchar(20) NOT NULL,
  `part_drawing_no` varchar(20) NOT NULL,
  `part_specification_no` varchar(20) NOT NULL,
  `part_proposed_by` varchar(30) NOT NULL,
  `part_pic_link` varchar(60) NOT NULL,
  `part_video_link` varchar(60) NOT NULL,
  `part_updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `part_updated_by` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `part_master_four`
--

CREATE TABLE `part_master_four` (
  `part_id` varchar(20) NOT NULL,
  `part_is_repairable` tinyint(1) NOT NULL,
  `part_inhouse_repair` tinyint(1) NOT NULL,
  `part_repairer_list` text NOT NULL,
  `part_updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `part_updated_by` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `part_master_one`
--

CREATE TABLE `part_master_one` (
  `part_id` int(20) NOT NULL,
  `part_number` varchar(20) NOT NULL,
  `part_desc` text NOT NULL,
  `part_catagory` varchar(30) NOT NULL,
  `part_subpart` varchar(30) NOT NULL,
  `part_unit` varchar(20) NOT NULL,
  `part_is_active` tinyint(1) NOT NULL,
  `part_updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `part_updated_by` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `part_master_one`
--

INSERT INTO `part_master_one` (`part_id`, `part_number`, `part_desc`, `part_catagory`, `part_subpart`, `part_unit`, `part_is_active`, `part_updated_time`, `part_updated_by`) VALUES
(1, '123', 'abc', 'cat 1', 'sub 1', 'unit 1', 1, '2021-07-07 05:44:49', ''),
(2, '123', 'cvd', 'Cat 2', 'sub 2', 'unit 2', 0, '2021-07-07 05:45:04', ''),
(3, '123', 'aaa', 'Cat 2', 'Other', 'unit 2', 1, '2021-07-07 05:45:12', ''),
(4, '1245', 'qwa', 'cat 1', 'sub 1', 'unit 1', 0, '2021-07-07 05:45:34', ''),
(14, '777', 'trgd', 'cat 3', 'sub 3', 'unit 2', 0, '2021-07-22 10:00:59', '');

-- --------------------------------------------------------

--
-- Table structure for table `part_master_one_two`
--

CREATE TABLE `part_master_one_two` (
  `part_id` varchar(20) NOT NULL,
  `part_number` varchar(20) NOT NULL,
  `part_desc` text NOT NULL,
  `part_catagory` varchar(30) NOT NULL,
  `part_subpart` varchar(30) NOT NULL,
  `part_unit` varchar(20) NOT NULL,
  `part_is_active` tinyint(1) NOT NULL,
  `part_updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `part_updated_by` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `part_master_one_two`
--

INSERT INTO `part_master_one_two` (`part_id`, `part_number`, `part_desc`, `part_catagory`, `part_subpart`, `part_unit`, `part_is_active`, `part_updated_time`, `part_updated_by`) VALUES
('', '123', 'e67055e82a291ce02c930f733604cad8', 'cat 1', 'sub 1', 'unit 1', 1, '2021-07-07 00:12:51', '');

-- --------------------------------------------------------

--
-- Table structure for table `part_master_seven`
--

CREATE TABLE `part_master_seven` (
  `part_id` varchar(20) NOT NULL,
  `part_pref_vendor` varchar(20) NOT NULL,
  `part_updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `part_updated_by` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `part_master_six`
--

CREATE TABLE `part_master_six` (
  `part_id` varchar(20) NOT NULL,
  `part_amb` varchar(30) NOT NULL COMMENT 'Acceptable Make Brand',
  `part_updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `part_updated_by` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `part_master_three`
--

CREATE TABLE `part_master_three` (
  `pm3_id` int(20) NOT NULL,
  `part_id` int(20) NOT NULL,
  `part_op_stock` int(10) NOT NULL,
  `part_storage_location` varchar(10) NOT NULL,
  `part_updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `part_updated_by` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `part_master_three`
--

INSERT INTO `part_master_three` (`pm3_id`, `part_id`, `part_op_stock`, `part_storage_location`, `part_updated_time`, `part_updated_by`) VALUES
(4, 4, 7, ' tggggg', '2021-07-23 06:27:29', ''),
(9, 1, 7, ' yjjjjjj', '2021-07-09 06:52:58', ''),
(10, 2, 6, 'f', '2021-07-09 02:44:27', ''),
(11, 4, 6, 't', '2021-07-09 06:39:20', ''),
(12, 4, 6, 'tttt', '2021-07-09 06:39:20', ''),
(15, 1, 44, '21232fwsdf', '2021-07-13 02:09:25', ''),
(17, 1, 99, 'uuu', '2021-07-13 02:09:41', ''),
(19, 3, 9, ' iuy', '2021-07-23 06:22:27', ''),
(21, 1, 5, 'rt', '2021-07-13 02:11:32', ''),
(23, 1, 5, '5', '2021-07-13 02:13:44', ''),
(25, 1, 5666, 'tt', '2021-07-13 02:14:08', ''),
(27, 4, 6, 'g', '2021-07-13 02:14:44', ''),
(29, 4, 6, 'g', '2021-07-13 02:16:33', ''),
(31, 1, 8, 'y', '2021-07-13 02:16:48', ''),
(33, 1, 5, 's', '2021-07-13 02:18:11', ''),
(34, 1, 5, 's', '2021-07-13 02:18:11', ''),
(35, 1, 777, 'gggg', '2021-07-13 02:18:11', ''),
(39, 4, 77, 'yy', '2021-07-13 02:23:45', ''),
(45, 3, 8, 'y', '2021-07-13 02:26:31', ''),
(49, 4, 999, 'jjj', '2021-07-13 02:29:36', ''),
(51, 3, 5, 'r', '2021-07-13 02:29:36', ''),
(52, 3, 5, 'r', '2021-07-13 02:29:36', ''),
(53, 2, 9, 'jh', '2021-07-13 02:29:36', ''),
(54, 2, 9, 'u', '2021-07-13 02:31:04', ''),
(56, 1, 5677, ' tyt', '2021-07-23 06:22:51', ''),
(57, 3, 22, 'qq', '2021-07-13 02:37:26', ''),
(58, 4, 46766, 'fgft', '2021-07-13 02:41:10', ''),
(59, 4, 46766, 'fgft', '2021-07-13 02:42:00', ''),
(60, 1, 8, 'y', '2021-07-13 03:03:46', ''),
(61, 1, 8, 'y', '2021-07-13 03:03:46', ''),
(62, 1, 8, 'y', '2021-07-13 03:03:46', ''),
(63, 1, 8, 'y', '2021-07-13 03:03:46', ''),
(64, 1, 8, 'y', '2021-07-13 03:03:46', ''),
(65, 4, 23, 'qwe321', '2021-07-13 03:03:46', ''),
(66, 2, 9, 'i', '2021-07-23 06:40:36', ''),
(67, 3, 9, '0', '2021-07-23 06:40:36', ''),
(68, 4, 88, '00', '2021-07-23 06:40:36', ''),
(69, 1, 9, 'j', '2021-07-23 06:40:36', ''),
(70, 2, 5, 'uu', '2021-07-23 06:40:36', ''),
(71, 2, 5, 'uu888', '2021-07-23 06:40:36', ''),
(72, 1, 77, '666', '2021-07-23 06:40:36', ''),
(73, 2, 5, 'uu888', '2021-07-23 06:40:36', ''),
(74, 4, 99, 'jj', '2021-07-23 06:40:36', ''),
(75, 1, 11111, '4554', '2021-07-23 06:42:01', ''),
(76, 1, 124, 'qwerrt', '2021-07-23 06:42:01', ''),
(77, 1, 11111, '4554', '2021-07-23 06:43:23', ''),
(78, 1, 124, 'qwerrt', '2021-07-23 06:43:23', ''),
(79, 2, 99, 'ii', '2021-07-23 06:43:33', '');

-- --------------------------------------------------------

--
-- Table structure for table `part_master_three_ex`
--

CREATE TABLE `part_master_three_ex` (
  `pm3_id` int(20) NOT NULL,
  `part_id` int(20) NOT NULL,
  `part_op_stock` int(10) NOT NULL,
  `part_storage_location` varchar(10) NOT NULL,
  `part_updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `part_updated_by` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `part_master_two`
--

CREATE TABLE `part_master_two` (
  `part_id` int(20) NOT NULL,
  `part_value` varchar(20) NOT NULL,
  `part_hsn` varchar(10) NOT NULL,
  `part_gst` float NOT NULL,
  `part_min_stock` int(10) NOT NULL,
  `part_max_stock` int(10) NOT NULL,
  `part_warranty` tinyint(1) NOT NULL,
  `part_updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `part_updated_by` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `part_master_two`
--

INSERT INTO `part_master_two` (`part_id`, `part_value`, `part_hsn`, `part_gst`, `part_min_stock`, `part_max_stock`, `part_warranty`, `part_updated_time`, `part_updated_by`) VALUES
(3, '34', '4d08fca2e8', 12.5, 5, 23, 1, '2021-07-07 01:31:53', ''),
(4, '34', 'G123e', 13.5, 1, 1000, 1, '2021-07-22 12:14:34', ''),
(14, '12345', 'G123', 18.2, 200, 500, 0, '2021-07-22 12:05:11', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `fname` char(20) NOT NULL,
  `lname` char(20) NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `email`, `fname`, `lname`, `password`) VALUES
(1, 'admin@test.com', 'Pratik', 'Raval', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `track_machine_master_one`
--

CREATE TABLE `track_machine_master_one` (
  `tm_id` varchar(20) NOT NULL,
  `tm_type` varchar(20) NOT NULL,
  `tm_make` varchar(20) NOT NULL,
  `tm_brand` varchar(30) NOT NULL,
  `tm_model_no` varchar(20) NOT NULL,
  `tm_is_active` longblob NOT NULL,
  `tm_video` mediumblob NOT NULL,
  `tm_pic` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `track_machine_master_two`
--

CREATE TABLE `track_machine_master_two` (
  `tm_id` varchar(20) NOT NULL,
  `tm_catagory` varchar(30) NOT NULL,
  `tm_parts` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `track_machine_schedule_entry`
--

CREATE TABLE `track_machine_schedule_entry` (
  `tmse_id` int(11) NOT NULL,
  `tmse_track_machine` int(11) NOT NULL,
  `tmse_unique_machine_number` varchar(30) NOT NULL,
  `tmse_purchase_date` date NOT NULL,
  `tmse_rlway_with` varchar(30) NOT NULL,
  `tmse_divison_with` int(11) NOT NULL,
  `tmse_first_poh` date NOT NULL,
  `tmse_second_poh` date NOT NULL,
  `tmse_third_poh` date NOT NULL,
  `tmse_other_work` varchar(50) NOT NULL,
  `updated_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `usr_id` int(20) NOT NULL,
  `usr_name` varchar(50) NOT NULL,
  `usr_password` varchar(128) NOT NULL,
  `usr_department` varchar(30) NOT NULL,
  `usr_designation` varchar(30) NOT NULL,
  `usr_email` varchar(30) NOT NULL,
  `usr_mobile` varchar(20) NOT NULL,
  `usr_is_admin` tinyint(1) NOT NULL,
  `usr_is_active` tinyint(1) NOT NULL,
  `usr_updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usr_updated_by` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`usr_id`, `usr_name`, `usr_password`, `usr_department`, `usr_designation`, `usr_email`, `usr_mobile`, `usr_is_admin`, `usr_is_active`, `usr_updated_time`, `usr_updated_by`) VALUES
(1, 'asd', 'f27f6f1c7c5cbf4e3e192e0a47b85300', 'Dept 3', 'Designation 2', 'pratikraval1203@gmail.com', '1234567890', 1, 1, '2021-07-21 04:55:56', ''),
(3, 'ab', 'b2ca678b4c936f905fb82f2733f5297f', 'Dept 3', 'Designation 2', 'abc@abc.com', '9999999999', 1, 0, '2021-07-22 06:00:06', ''),
(4, 'asdgjhg', '4fd86cf4e0ff37675add29288d3d228f', 'Dept 4', 'Designation 4', 'abc@abc.com', '9999999999', 0, 1, '2021-07-22 08:15:25', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_master_two`
--

CREATE TABLE `user_master_two` (
  `usr_id` varchar(20) NOT NULL,
  `usr_username` varchar(50) NOT NULL,
  `usr_password` varchar(128) NOT NULL,
  `usr_department` varchar(30) NOT NULL,
  `usr_designation` varchar(30) NOT NULL,
  `usr_email` varchar(30) NOT NULL,
  `usr_mobile` varchar(20) NOT NULL,
  `usr_is_admin` tinyint(1) NOT NULL,
  `usr_is_active` tinyint(1) NOT NULL,
  `usr_updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usr_updated_by` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_master_two`
--

INSERT INTO `user_master_two` (`usr_id`, `usr_username`, `usr_password`, `usr_department`, `usr_designation`, `usr_email`, `usr_mobile`, `usr_is_admin`, `usr_is_active`, `usr_updated_time`, `usr_updated_by`) VALUES
('', 'abc', '900150983cd24fb0d6963f7d28e17f72', 'Dept 1', 'on', 'abc@abc.com', '1234567890', 0, 1, '2021-07-06 04:22:14', ''),
('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'dept1', 'HOD', 'abc@test.com', '9265937437', 1, 1, '2021-07-06 07:52:06', 'admin'),
('', 'abc', 'd41d8cd98f00b204e9800998ecf8427e', 'Dept 1', 'on', 'abc@abc.com', '1234567890', 0, 1, '2021-07-06 04:24:28', ''),
('', 'abc', 'd41d8cd98f00b204e9800998ecf8427e', 'Dept 1', 'on', 'abc@abc.com', '1234567890', 0, 1, '2021-07-06 04:25:40', ''),
('', 'abc', '900150983cd24fb0d6963f7d28e17f72', 'Dept 3', 'Team Leader', 'abc@abc.com', '1234567890', 0, 1, '2021-07-06 04:26:59', ''),
('', 'abc', '900150983cd24fb0d6963f7d28e17f72', 'Dept 3', 'Team Leader', 'abc@abc.com', '1234567890', 0, 1, '2021-07-06 05:36:03', ''),
('', '', 'd41d8cd98f00b204e9800998ecf8427e', '', '', '', '', 0, 1, '2021-07-06 11:14:24', ''),
('', 'hi', '49f68a5c8493ec2c0bf489821c21fc3b', 'Dept 1', 'Designation 2', 'abc@abc.com', '1234567890', 0, 1, '2021-07-06 11:15:32', ''),
('', 'abc', '900150983cd24fb0d6963f7d28e17f72', 'Dept 2', 'Designation 2', 'abc@abc.com', '1234567890', 0, 1, '2021-07-06 11:17:52', ''),
('', 'abc', '900150983cd24fb0d6963f7d28e17f72', 'Dept 2', 'Designation 2', 'abc@abc.com', '1234567890', 1, 0, '2021-07-06 11:20:42', ''),
('', 'asd', '7815696ecbf1c96e6894b779456d330e', 'Dept 2', 'Designation 3', 'abc@abc.com', '1234567890', 0, 1, '2021-07-06 11:24:44', ''),
('', 'asd', '1f73402c644002a7ea3c9532e8ba4139', 'Dept 2', 'Designation 3', 'abc@abc.com', '1234567890', 1, 1, '2021-07-06 11:25:55', ''),
('', 'abc', '77963b7a931377ad4ab5ad6a9cd718aa', 'Dept 1', 'Designation 1', 'abc@abc.com', '1234567890', 1, 0, '2021-07-06 11:33:10', '');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_master`
--

CREATE TABLE `vendor_master` (
  `ven_id` int(11) NOT NULL,
  `ven_name` varchar(30) NOT NULL,
  `ven_code` varchar(20) NOT NULL,
  `ven_type` varchar(20) NOT NULL,
  `ven_email` varchar(30) NOT NULL,
  `ven_mobile` varchar(15) NOT NULL,
  `ven_website` varchar(30) NOT NULL,
  `ven_address` text NOT NULL,
  `ven_grade` varchar(20) NOT NULL,
  `ven_updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ven_updated_by` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor_master`
--

INSERT INTO `vendor_master` (`ven_id`, `ven_name`, `ven_code`, `ven_type`, `ven_email`, `ven_mobile`, `ven_website`, `ven_address`, `ven_grade`, `ven_updated_time`, `ven_updated_by`) VALUES
(1, 'dsdhghfghfgh', 'khaaaaaaa', 'Contractor', 'pratikraval1203@gmail.com', '1213435657', 'abc.tk', '01, Staff Quarters, Vishwakarma Temple,', '1234er', '2021-07-22 07:16:40', ''),
(4, 'ffgfg', 'xvcvbc', 'Other', 'abc@abc.com', '1213435657', 'acd.th', '01, Staff Quarters, Temple,', 'sdfsdf', '2021-07-22 09:32:23', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `part_master_five`
--
ALTER TABLE `part_master_five`
  ADD PRIMARY KEY (`part_id`),
  ADD KEY `part_updated_by` (`part_updated_by`);

--
-- Indexes for table `part_master_four`
--
ALTER TABLE `part_master_four`
  ADD PRIMARY KEY (`part_id`);

--
-- Indexes for table `part_master_one`
--
ALTER TABLE `part_master_one`
  ADD PRIMARY KEY (`part_id`);

--
-- Indexes for table `part_master_seven`
--
ALTER TABLE `part_master_seven`
  ADD KEY `part_id` (`part_id`),
  ADD KEY `part_updated_by` (`part_updated_by`);

--
-- Indexes for table `part_master_six`
--
ALTER TABLE `part_master_six`
  ADD KEY `part_id` (`part_id`),
  ADD KEY `part_updated_by` (`part_updated_by`);

--
-- Indexes for table `part_master_three`
--
ALTER TABLE `part_master_three`
  ADD PRIMARY KEY (`pm3_id`);

--
-- Indexes for table `part_master_three_ex`
--
ALTER TABLE `part_master_three_ex`
  ADD PRIMARY KEY (`pm3_id`);

--
-- Indexes for table `part_master_two`
--
ALTER TABLE `part_master_two`
  ADD PRIMARY KEY (`part_id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `track_machine_master_one`
--
ALTER TABLE `track_machine_master_one`
  ADD PRIMARY KEY (`tm_id`);

--
-- Indexes for table `track_machine_master_two`
--
ALTER TABLE `track_machine_master_two`
  ADD PRIMARY KEY (`tm_id`);

--
-- Indexes for table `track_machine_schedule_entry`
--
ALTER TABLE `track_machine_schedule_entry`
  ADD PRIMARY KEY (`tmse_id`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`usr_id`);

--
-- Indexes for table `vendor_master`
--
ALTER TABLE `vendor_master`
  ADD PRIMARY KEY (`ven_id`),
  ADD KEY `ven_updated_by` (`ven_updated_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `part_master_one`
--
ALTER TABLE `part_master_one`
  MODIFY `part_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `part_master_three`
--
ALTER TABLE `part_master_three`
  MODIFY `pm3_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `part_master_three_ex`
--
ALTER TABLE `part_master_three_ex`
  MODIFY `pm3_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `track_machine_schedule_entry`
--
ALTER TABLE `track_machine_schedule_entry`
  MODIFY `tmse_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `usr_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vendor_master`
--
ALTER TABLE `vendor_master`
  MODIFY `ven_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `part_master_two`
--
ALTER TABLE `part_master_two`
  ADD CONSTRAINT `part_master_two_ibfk_1` FOREIGN KEY (`part_id`) REFERENCES `part_master_one` (`part_id`);

--
-- Constraints for table `track_machine_master_two`
--
ALTER TABLE `track_machine_master_two`
  ADD CONSTRAINT `track_machine_master_two_ibfk_1` FOREIGN KEY (`tm_id`) REFERENCES `track_machine_master_one` (`tm_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
