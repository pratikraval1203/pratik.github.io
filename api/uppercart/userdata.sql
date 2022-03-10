-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2021 at 06:43 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `userdata`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `add_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `phoneno` varchar(10) NOT NULL,
  `currentstreet` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`add_id`, `name`, `phoneno`, `currentstreet`) VALUES
(4, 'dipsha patel', '8320595521', 'gandhinagar'),
(5, 'kevin patel', '6351048625', 'gandhinagar'),
(7, 'prakash patel', '9662218000', 'gandhinagar');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `productimage` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `price` int(250) NOT NULL,
  `discount` int(250) NOT NULL,
  `quantity` int(250) NOT NULL,
  `productnumber` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `productimage`, `title`, `price`, `discount`, `quantity`, `productnumber`) VALUES
(2, 0, 'pepsi', 40, 5, 2, 0),
(3, 0, 'chocolate', 25, 5, 15, 0),
(4, 0, 'chips', 25, 5, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `coupon_id` int(11) NOT NULL,
  `couponcode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `address` varchar(250) NOT NULL,
  `paymentdetail` varchar(250) NOT NULL,
  `coupon` varchar(50) NOT NULL,
  `deliverytime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `address`, `paymentdetail`, `coupon`, `deliverytime`) VALUES
(1, 'gn', 'cash', '123', '0000-00-00 00:00:00'),
(2, 'gn', 'cash', '1234', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `pay_id` int(11) NOT NULL,
  `cartnumber` varchar(16) NOT NULL,
  `mm` int(250) NOT NULL,
  `yy` int(250) NOT NULL,
  `cvv` varchar(3) NOT NULL,
  `name` varchar(250) NOT NULL,
  `country` varchar(250) NOT NULL,
  `zip` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`pay_id`, `cartnumber`, `mm`, `yy`, `cvv`, `name`, `country`, `zip`) VALUES
(5, '5241780005672567', 5, 2023, '234', 'dipsha patel', 'gandhinagar', '382006'),
(6, '5241780005673689', 8, 2024, '123', 'kevin patel', 'gandhinagar', '382008'),
(7, '1234567891358573', 8, 2024, '456', 'tani patel', 'gandhinagar', '382004');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(50) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `profilephoto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `name`, `lastname`, `profilephoto`) VALUES
(1, 'tani123@gmail.com', 'tani123', 'tani', 'patel', 0),
(2, 'aarav123@gmail.com', 'aarav123', 'aarav', 'patel', 0),
(3, 'heli123@gmail.com', 'heli123', 'heli', 'patel', 0),
(5, 'tani123@gmail.com', 'kevin123', 'tani', 'patel', 0),
(7, 'jayshree123@gmail.com', 'jayshree123', 'jatyshree', 'patel', 0),
(8, 'prakash123@gmail.com', 'prakash123', 'prakash', 'patel', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `p_id` int(11) NOT NULL,
  `productimage` varbinary(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `price` int(250) NOT NULL,
  `discount` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`p_id`, `productimage`, `title`, `price`, `discount`) VALUES
(1, 0x30, 'chips', 10, 5),
(2, 0x30, 'chips', 10, 5),
(3, 0x30, 'chips', 10, 5),
(4, 0x30, 'chips', 10, 5),
(6, 0x30, 'chocolate', 25, 5),
(8, 0x30, 'chips', 25, 5),
(9, 0x30, 'chocolate', 25, 5),
(10, 0x30, 'chocolate', 25, 5),
(11, 0x30, 'chocolate', 25, 5),
(13, 0x30, 'chocolate', 25, 5),
(14, 0x30, 'chocolate', 25, 5),
(16, '', 'pepsi', 40, 5),
(17, '', 'pepsi', 40, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`add_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`p_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `add_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
