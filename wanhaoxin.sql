-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2022 at 07:14 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wanhaoxin`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(15) CHARACTER SET utf8mb4 NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `confirm_password` varchar(50) DEFAULT NULL,
  `first_name` varchar(30) CHARACTER SET utf8mb4 DEFAULT NULL,
  `last_name` varchar(30) CHARACTER SET utf8mb4 DEFAULT NULL,
  `gender` enum('Male','Female') CHARACTER SET utf8mb4 DEFAULT 'Male',
  `dateofbirth` date DEFAULT NULL,
  `registration` datetime DEFAULT current_timestamp(),
  `last_modified` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `accountstatus` enum('Active','Inactive') DEFAULT 'Active',
  `customer_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `email`, `password`, `confirm_password`, `first_name`, `last_name`, `gender`, `dateofbirth`, `registration`, `last_modified`, `accountstatus`, `customer_img`) VALUES
('admin', 'admin123@gmail.com', '0192023a7bbd73250516f069df18b500', NULL, 'Wan', 'Hao Xin', 'Male', '2001-10-06', '2022-07-27 16:57:17', NULL, 'Active', ''),
('AdminLim123', 'AdminLim123@gmail.com', 'd60409d9c6cd7e4231a9ee443a6beead', NULL, 'admin', 'Lim', 'Female', '2002-10-29', '2022-07-29 17:53:29', NULL, 'Active', ''),
('Itachi123', 'Itachi123@gmail.com', '9d72c316d7e751ae59a303fb59550515', NULL, 'Uchiha', 'Itachi', 'Male', '1999-06-30', '2022-07-28 16:06:52', '2022-07-28 17:11:11', 'Active', 'itachi.jpg'),
('wanhaoxin1006', 'haoxintv@gmail.com', '17994f6b2301f98ccb0cec2fec13c8e8', NULL, 'Wan', 'Hao Xin', 'Male', '2001-10-06', '2022-07-29 22:12:47', NULL, 'Active', 'eevee.png');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(20) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `description`) VALUES
(1, 'Men Leather Shoe', 'Suitable only for Men, Made by Leather/Patent Leather Material, more durable than PU/PVC Material.'),
(4, 'Female Leather Shoe', 'Made by Leather, suitable for female only'),
(5, 'Men PU/PVC Shoe', 'Made by PU/PVC Material, suitable for Men.'),
(6, 'Female PU/PVC Shoe', 'Suitable for Female, made by PU/PVC Material');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `username` varchar(15) CHARACTER SET utf8mb4 NOT NULL,
  `email` varchar(30) NOT NULL,
  `first_name` varchar(30) CHARACTER SET utf8mb4 DEFAULT NULL,
  `last_name` varchar(30) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`username`, `email`, `first_name`, `last_name`) VALUES
('Chomiyeon', 'Chomiyeon@gmail.com', 'Cho', 'Miyeon'),
('Jason Chong', 'JasonChong@gmail.com', 'Jason', 'Chong'),
('Luffy', 'Luffy@gmail.com', 'Luffy', 'Monkey'),
('Wan Hao Xin', 'wanhaoxin1006@e.newera.edu.my', 'Wan', 'Hao Xin');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `orderdetail_id` int(20) NOT NULL,
  `order_id` int(20) NOT NULL,
  `product_id` int(20) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`orderdetail_id`, `order_id`, `product_id`, `quantity`) VALUES
(8, 7, 1, 2),
(10, 9, 8, 5),
(11, 9, 7, 2),
(12, 10, 1, 1),
(13, 10, 8, 2),
(14, 10, 6, 1),
(15, 11, 1, 1),
(16, 11, 6, 2),
(17, 11, 8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `order_summary`
--

CREATE TABLE `order_summary` (
  `order_id` int(15) NOT NULL,
  `username` varchar(15) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_summary`
--

INSERT INTO `order_summary` (`order_id`, `username`, `order_date`) VALUES
(7, 'Chomiyeon', '2022-07-29 15:36:57'),
(9, 'Luffy', '2022-07-29 15:57:39'),
(10, 'Jason Chong', '2022-07-29 15:58:27'),
(11, 'Chomiyeon', '2022-07-29 16:11:24');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(20) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `price` double NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `promotion_price` double DEFAULT NULL,
  `manufacture_date` date DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  `product_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `category_id`, `price`, `created`, `modified`, `promotion_price`, `manufacture_date`, `expired_date`, `product_img`) VALUES
(1, 'Dunlico 380 Kasut Kulit Polis', 'Hand Made by Patent Leather, Suitable for Polis Footwear.', 1, 178, '2022-07-28 15:18:27', '2022-07-29 07:49:22', 168, '2022-07-28', '0000-00-00', 'Dunlico 380D.jpg'),
(6, 'Dunlico 4410 Lady Leather Shoe', 'Female, made by leather, suitable for daily footwear', 4, 138, '2022-07-29 15:44:41', '2022-07-29 13:44:41', 128, '2022-07-29', '0000-00-00', ''),
(7, 'Dunlico 3310 Men Office Shoe', 'Suitable for Men, Daily office footwear, made by PU Material.', 5, 138, '2022-07-29 15:47:00', '2022-07-29 07:48:48', 0, '2022-07-29', '0000-00-00', NULL),
(8, 'Dunlico 410 Female Formal Shoe', 'Female, Suitable for Formal activities footwear', 6, 128, '2022-07-29 15:56:35', '2022-07-29 08:29:32', 100, '2022-07-28', '0000-00-00', NULL),
(9, 'Dunlico 3330 Men Police Shoe', 'Men Formal Police Shoe.', 5, 98, '2022-07-29 16:04:20', '2022-07-29 08:29:17', 88, '2022-07-29', '0000-00-00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`orderdetail_id`),
  ADD KEY `FK_order_id` (`order_id`),
  ADD KEY `FK_product_id` (`product_id`);

--
-- Indexes for table `order_summary`
--
ALTER TABLE `order_summary`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `FK_customers_order` (`username`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `FK_category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `orderdetail_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `order_summary`
--
ALTER TABLE `order_summary`
  MODIFY `order_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `FK_order_id` FOREIGN KEY (`order_id`) REFERENCES `order_summary` (`order_id`),
  ADD CONSTRAINT `FK_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `order_summary`
--
ALTER TABLE `order_summary`
  ADD CONSTRAINT `FK_customers_order` FOREIGN KEY (`username`) REFERENCES `customer` (`username`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
