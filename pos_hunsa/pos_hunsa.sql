-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2023 at 04:41 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos_hunsa`
--

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `orders_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `table_id` int(11) DEFAULT NULL,
  `staff_id` int(11) NOT NULL,
  `menu_name` text NOT NULL,
  `qty` int(11) NOT NULL,
  `menu_price` int(11) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`orders_id`, `menu_id`, `table_id`, `staff_id`, `menu_name`, `qty`, `menu_price`, `time`) VALUES
(1699759362, 1, 4, 1, 'americano iced', 1, 65, '1970-01-01 00:00:00'),
(1699759362, 2, 4, 1, 'cappuccino iced', 1, 70, '1970-01-01 00:00:00'),
(1699759438, 1, 4, 1, 'americano iced', 1, 65, '1970-01-01 01:00:00'),
(1699759438, 2, 4, 1, 'cappuccino iced', 1, 70, '1970-01-01 01:00:00'),
(1699759438, 3, 4, 1, 'chocobanana toast', 1, 105, '1970-01-01 01:00:00'),
(1699759518, 4, 4, 1, 'chocostrawberry toast', 1, 110, '2023-11-12 10:31:24'),
(1699759518, 5, 4, 1, 'hojicha bingsu', 1, 150, '2023-11-12 10:31:24'),
(1699674302, 5, 2, 1, 'hojicha bingsu', 1, 150, '2023-11-12 10:32:43'),
(1699674302, 6, 2, 1, 'mango-bingsu', 1, 140, '2023-11-12 10:32:43'),
(1699674302, 4, 2, 1, 'chocostrawberry toast', 4, 110, '2023-11-12 10:32:43'),
(1699674302, 1, 2, 1, 'americano iced', 1, 65, '2023-11-12 10:32:43'),
(1699674302, 2, 2, 1, 'cappuccino iced', 1, 70, '2023-11-12 10:32:43');

-- --------------------------------------------------------

--
-- Table structure for table `menu_info`
--

CREATE TABLE `menu_info` (
  `menu_id` int(11) NOT NULL,
  `menu_name` text NOT NULL,
  `menu_price` int(11) NOT NULL,
  `disable` tinyint(4) NOT NULL,
  `menu_type` text NOT NULL,
  `menu_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_info`
--

INSERT INTO `menu_info` (`menu_id`, `menu_name`, `menu_price`, `disable`, `menu_type`, `menu_img`) VALUES
(1, 'americano iced', 65, 0, 'drink', 'assets/images/beverages/americano-iced.jpg'),
(2, 'cappuccino iced', 70, 0, 'drink', 'assets/images/beverages/cappuccino-iced.jpg'),
(3, 'chocobanana toast', 105, 0, 'toast', 'assets/images/toast/chocobanana-toast.jpg'),
(4, 'chocostrawberry toast', 110, 0, 'toast', 'assets/images/toast/chocostrawberry-toast.jpg'),
(5, 'hojicha bingsu', 150, 0, 'bing-su', 'assets/images/bing-su/hojicha-bingsu.jpg'),
(6, 'mango-bingsu', 140, 0, 'bing-su', 'assets/images/BING-SU/mango-bingsu.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orders_id` int(11) NOT NULL,
  `table_id` int(11) DEFAULT NULL,
  `menu_id` int(11) NOT NULL,
  `onhold_qty` int(11) NOT NULL,
  `served_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orders_id`, `table_id`, `menu_id`, `onhold_qty`, `served_qty`) VALUES
(1699519675, NULL, 1, 6, 10),
(1699519675, NULL, 4, 3, 0),
(1699519675, NULL, 3, 0, 4),
(1699694929, NULL, 1, 1, 0),
(1699694929, NULL, 2, 1, 0),
(1699694929, NULL, 3, 1, 0),
(1699694929, NULL, 4, 1, 0),
(1699698001, 1, 1, 1, 0),
(1699698001, 1, 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `barcode` varchar(15) NOT NULL,
  `description` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `image` varchar(500) NOT NULL,
  `user_id` varchar(60) NOT NULL,
  `date` datetime NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `menu_type` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `barcode`, `description`, `qty`, `amount`, `image`, `user_id`, `date`, `views`, `menu_type`) VALUES
(1, '2222472108593', 'Biscuits', 100, '10.95', 'uploads/019111ea60f176a07807d9be878b7b0ff5d4c52b_5812.jpg', '1', '2022-01-03 18:33:44', 31, 'food'),
(3, '2222947895764', 'Crisps', 100, '4.95', 'uploads/a376a3a3f34dc21971ca40ac6dd6664585c197a6_4817.jpg', '1', '2022-01-09 08:46:29', 45, 'food'),
(4, '2222881344444', 'Burger', 100, '10.00', 'uploads/c322c54a3249e75ca46347a2c4ec9385672cb8e3_5698.jpg', '1', '2022-01-09 08:47:02', 10, 'food'),
(5, '1234', 'So good milk', 100, '20.00', 'uploads/e149b8702ddb43e5cda3c10803c563203b27cfc0_6896.jpg', '1', '2022-01-09 08:47:54', 17, 'drink'),
(6, '2222925913231', 'OMO SOFTENER', 100, '50.00', 'uploads/e80200cc753ea342725ba080f668144fe4c763b9_7977.jpg', 'Unknown', '2022-01-16 08:35:24', 44, 'drink');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `barcode` varchar(15) NOT NULL,
  `receipt_no` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `date` datetime NOT NULL,
  `user_id` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `barcode`, `receipt_no`, `description`, `qty`, `amount`, `total`, `date`, `user_id`) VALUES
(1, '1234', 1, 'So good milk', 2, '20.00', '40.00', '2022-02-11 10:06:12', 'Unknown'),
(2, '2222947895764', 1, 'Crisps', 1, '4.95', '4.95', '2022-02-11 10:06:12', 'Unknown'),
(3, '2222881344444', 1, 'Burger', 1, '10.00', '10.00', '2022-02-11 10:06:12', 'Unknown'),
(4, '2222925913231', 2, 'OMO SOFTENER', 2, '50.00', '100.00', '2022-02-11 10:07:27', 'Unknown'),
(5, '1234', 2, 'So good milk', 1, '20.00', '20.00', '2022-02-11 10:07:27', 'Unknown'),
(6, '2222472108593', 2, 'Biscuits', 1, '10.95', '10.95', '2022-02-11 10:07:27', 'Unknown'),
(7, '1234', 3, 'So good milk', 1, '20.00', '20.00', '2022-02-17 19:42:00', '1'),
(8, '2222472108593', 4, 'Biscuits', 2, '10.95', '21.90', '2022-02-17 19:50:49', '1'),
(9, '2222472108593', 5, 'Biscuits', 2, '10.95', '21.90', '2022-02-17 19:52:19', '1'),
(10, '2222472108593', 6, 'Biscuits', 1, '10.95', '10.95', '2022-02-17 19:52:40', '1'),
(11, '2222925913231', 7, 'OMO SOFTENER', 1, '50.00', '50.00', '2022-02-17 19:56:02', '1'),
(12, '1234', 8, 'So good milk', 2, '20.00', '40.00', '2022-02-17 19:57:31', '1'),
(13, '1234', 9, 'So good milk', 1, '20.00', '20.00', '2022-02-17 19:57:44', '1'),
(14, '1234', 10, 'So good milk', 3, '20.00', '60.00', '2022-02-17 19:57:53', '1'),
(15, '2222472108593', 11, 'Biscuits', 2, '10.95', '21.90', '2022-03-28 19:40:38', '1'),
(17, '1234', 12, 'So good milk', 1, '20.00', '20.00', '2022-04-08 17:53:31', '1'),
(18, '2222925913231', 12, 'OMO SOFTENER', 1, '50.00', '50.00', '2022-04-08 17:53:31', '1'),
(19, '2222947895764', 12, 'Crisps', 1, '4.95', '4.95', '2022-04-08 17:53:31', '1'),
(20, '2222881344444', 12, 'Burger', 1, '10.00', '10.00', '2022-04-08 17:53:31', '1'),
(21, '2222472108593', 12, 'Biscuits', 1, '10.95', '10.95', '2022-04-08 17:53:31', '1'),
(22, '2222947895764', 13, 'Crisps', 2, '4.95', '9.90', '2022-04-08 17:53:44', '1'),
(23, '2222925913231', 13, 'OMO SOFTENER', 3, '50.00', '150.00', '2022-04-08 17:53:44', '1'),
(24, '1234', 13, 'So good milk', 2, '20.00', '40.00', '2022-04-08 17:53:44', '1'),
(25, '2222472108593', 13, 'Biscuits', 2, '10.95', '21.90', '2022-04-08 17:53:44', '1'),
(26, '2222881344444', 13, 'Burger', 1, '10.00', '10.00', '2022-04-08 17:53:44', '1'),
(27, '1234', 14, 'So good milk', 2, '20.00', '40.00', '2022-04-08 19:54:02', '1'),
(28, '2222925913231', 14, 'OMO SOFTENER', 1, '50.00', '50.00', '2022-04-08 19:54:02', '1'),
(29, '2222947895764', 14, 'Crisps', 1, '4.95', '4.95', '2022-04-08 19:54:02', '1'),
(30, '2222881344444', 14, 'Burger', 1, '10.00', '10.00', '2022-04-08 19:54:02', '1'),
(31, '2222472108593', 15, 'Biscuits', 3, '10.95', '32.85', '2022-04-08 20:21:04', '1'),
(32, '2222925913231', 15, 'OMO SOFTENER', 3, '50.00', '150.00', '2022-04-08 20:21:04', '1'),
(33, '2222947895764', 15, 'Crisps', 3, '4.95', '14.85', '2022-04-08 20:21:04', '1'),
(34, '2222881344444', 15, 'Burger', 1, '10.00', '10.00', '2022-04-08 20:21:04', '1'),
(35, '1234', 15, 'So good milk', 2, '20.00', '40.00', '2022-04-08 20:21:04', '1'),
(36, '2222925913231', 16, 'OMO SOFTENER', 1, '50.00', '50.00', '2022-04-13 20:23:09', '1'),
(37, '2222472108593', 16, 'Biscuits', 2, '10.95', '21.90', '2022-04-13 20:23:09', '1'),
(38, '1234', 16, 'So good milk', 1, '20.00', '20.00', '2022-04-13 20:23:09', '1'),
(39, '2222881344444', 16, 'Burger', 1, '10.00', '10.00', '2022-04-13 20:23:09', '1'),
(40, '2222947895764', 16, 'Crisps', 1, '4.95', '4.95', '2022-04-13 20:23:09', '1'),
(41, '2222925913231', 17, 'OMO SOFTENER', 2, '50.00', '100.00', '2022-04-14 13:21:19', '1'),
(42, '2222947895764', 17, 'Crisps', 1, '4.95', '4.95', '2022-04-14 13:21:19', '1'),
(43, '2222472108593', 17, 'Biscuits', 1, '10.95', '10.95', '2022-04-14 13:21:19', '1'),
(44, '2222881344444', 17, 'Burger', 1, '10.00', '10.00', '2022-04-14 13:21:19', '1'),
(45, '2222925913231', 18, 'OMO SOFTENER', 1, '50.00', '50.00', '2022-04-14 13:34:16', '1'),
(46, '1234', 18, 'So good milk', 1, '20.00', '20.00', '2022-04-14 13:34:16', '1'),
(47, '2222472108593', 19, 'Biscuits', 1, '10.95', '10.95', '2022-04-14 13:54:49', '1'),
(48, '2222947895764', 19, 'Crisps', 1, '4.95', '4.95', '2022-04-14 13:54:49', '1'),
(49, '2222925913231', 19, 'OMO SOFTENER', 1, '50.00', '50.00', '2022-04-14 13:54:49', '1'),
(50, '2222947895764', 20, 'Crisps', 1, '4.95', '4.95', '2022-04-14 14:03:27', '1'),
(51, '1234', 20, 'So good milk', 1, '20.00', '20.00', '2022-04-14 14:03:27', '1'),
(52, '2222472108593', 20, 'Biscuits', 1, '10.95', '10.95', '2022-04-14 14:03:27', '1'),
(53, '2222925913231', 21, 'OMO SOFTENER', 2, '50.00', '100.00', '2022-04-14 14:13:38', '1'),
(54, '2222472108593', 21, 'Biscuits', 1, '10.95', '10.95', '2022-04-14 14:13:38', '1'),
(55, '2222881344444', 21, 'Burger', 1, '10.00', '10.00', '2022-04-14 14:13:38', '1'),
(56, '2222947895764', 21, 'Crisps', 1, '4.95', '4.95', '2022-04-14 14:13:38', '1'),
(57, '1234', 21, 'So good milk', 1, '20.00', '20.00', '2022-04-14 14:13:38', '1'),
(58, '2222472108593', 22, 'Biscuits', 1, '10.95', '10.95', '2022-04-14 14:18:35', '1'),
(59, '1234', 22, 'So good milk', 2, '20.00', '40.00', '2022-04-14 14:18:35', '1'),
(60, '2222925913231', 22, 'OMO SOFTENER', 2, '50.00', '100.00', '2022-04-14 14:18:35', '1'),
(61, '2222947895764', 22, 'Crisps', 1, '4.95', '4.95', '2022-04-14 14:18:35', '1'),
(62, '1234', 23, 'So good milk', 2, '20.00', '40.00', '2022-04-14 14:20:16', '1'),
(63, '2222881344444', 23, 'Burger', 1, '10.00', '10.00', '2022-04-14 14:20:16', '1'),
(64, '2222472108593', 23, 'Biscuits', 1, '10.95', '10.95', '2022-04-14 14:20:16', '1'),
(65, '2222947895764', 24, 'Crisps', 2, '4.95', '9.90', '2022-04-14 14:21:37', '1'),
(66, '2222925913231', 24, 'OMO SOFTENER', 1, '50.00', '50.00', '2022-04-14 14:21:37', '1'),
(67, '2222947895764', 25, 'Crisps', 2, '4.95', '9.90', '2022-04-14 14:24:55', '1'),
(68, '2222925913231', 25, 'OMO SOFTENER', 2, '50.00', '100.00', '2022-04-14 14:24:55', '1'),
(69, '1234', 25, 'So good milk', 1, '20.00', '20.00', '2022-04-14 14:24:55', '1'),
(70, '2222947895764', 26, 'Crisps', 2, '4.95', '9.90', '2022-04-14 14:26:41', '1'),
(71, '2222472108593', 26, 'Biscuits', 1, '10.95', '10.95', '2022-04-14 14:26:41', '1'),
(72, '2222947895764', 27, 'Crisps', 1, '4.95', '4.95', '2022-04-14 14:27:12', '1'),
(73, '2222925913231', 27, 'OMO SOFTENER', 1, '50.00', '50.00', '2022-04-14 14:27:12', '1'),
(74, '2222881344444', 28, 'Burger', 2, '10.00', '20.00', '2022-04-28 13:25:08', '1'),
(75, '2222472108593', 29, 'Biscuits', 2, '10.95', '21.90', '2022-05-01 07:05:09', '1'),
(76, '2222947895764', 29, 'Crisps', 2, '4.95', '9.90', '2022-05-01 07:05:09', '1'),
(77, '2222925913231', 30, 'OMO SOFTENER', 2, '50.00', '100.00', '2022-05-01 07:08:47', '1'),
(78, '2222947895764', 30, 'Crisps', 2, '4.95', '9.90', '2022-05-01 07:08:47', '1'),
(79, '2222925913231', 31, 'OMO SOFTENER', 1, '50.00', '50.00', '2022-05-01 07:30:34', '1'),
(80, '2222472108593', 31, 'Biscuits', 1, '10.95', '10.95', '2022-05-01 07:30:34', '1'),
(81, '1234', 31, 'So good milk', 1, '20.00', '20.00', '2022-05-01 07:30:34', '1'),
(82, '2222472108593', 32, 'Biscuits', 1, '10.95', '10.95', '2022-05-01 07:32:02', '1'),
(83, '2222947895764', 32, 'Crisps', 1, '4.95', '4.95', '2022-05-01 07:32:02', '1'),
(84, '1234', 32, 'So good milk', 1, '20.00', '20.00', '2022-05-01 07:32:02', '1'),
(85, '2222925913231', 33, 'OMO SOFTENER', 2, '50.00', '100.00', '2022-05-01 07:32:43', '1'),
(86, '2222947895764', 33, 'Crisps', 1, '4.95', '4.95', '2022-05-01 07:32:43', '1'),
(87, '2222925913231', 34, 'OMO SOFTENER', 1, '50.00', '50.00', '2022-05-01 07:33:35', '1'),
(88, '2222472108593', 34, 'Biscuits', 2, '10.95', '21.90', '2022-05-01 07:33:35', '1'),
(89, '2222472108593', 35, 'Biscuits', 2, '10.95', '21.90', '2022-05-01 07:34:37', '1'),
(90, '2222947895764', 35, 'Crisps', 2, '4.95', '9.90', '2022-05-01 07:34:37', '1'),
(91, '2222947895764', 36, 'Crisps', 1, '4.95', '4.95', '2022-05-01 07:34:59', '1'),
(92, '2222925913231', 36, 'OMO SOFTENER', 2, '50.00', '100.00', '2022-05-01 07:34:59', '1'),
(93, '2222925913231', 37, 'OMO SOFTENER', 2, '50.00', '100.00', '2022-05-01 07:36:23', '1'),
(94, '2222472108593', 37, 'Biscuits', 1, '10.95', '10.95', '2022-05-01 07:36:23', '1'),
(95, '2222472108593', 38, 'Biscuits', 1, '10.95', '10.95', '2022-05-01 07:47:26', '1'),
(96, '2222947895764', 38, 'Crisps', 1, '4.95', '4.95', '2022-05-01 07:47:26', '1'),
(97, '2222947895764', 39, 'Crisps', 1, '4.95', '4.95', '2022-05-01 07:48:03', '1'),
(98, '2222925913231', 39, 'OMO SOFTENER', 1, '50.00', '50.00', '2022-05-01 07:48:03', '1'),
(99, '2222472108593', 40, 'Biscuits', 1, '10.95', '10.95', '2022-05-01 07:48:20', '1'),
(100, '2222925913231', 40, 'OMO SOFTENER', 1, '50.00', '50.00', '2022-05-01 07:48:20', '1'),
(101, '2222472108593', 41, 'Biscuits', 1, '10.95', '10.95', '2022-05-01 07:53:54', '1'),
(102, '2222947895764', 41, 'Crisps', 1, '4.95', '4.95', '2022-05-01 07:53:54', '1'),
(103, '2222925913231', 42, 'OMO SOFTENER', 1, '50.00', '50.00', '2022-05-01 07:57:35', '1'),
(104, '2222947895764', 42, 'Crisps', 1, '4.95', '4.95', '2022-05-01 07:57:35', '1'),
(105, '2222925913231', 43, 'OMO SOFTENER', 1, '50.00', '50.00', '2022-05-01 07:58:31', '1'),
(106, '2222472108593', 43, 'Biscuits', 1, '10.95', '10.95', '2022-05-01 07:58:31', '1'),
(107, '2222472108593', 44, 'Biscuits', 1, '10.95', '10.95', '2022-05-01 07:59:54', '1'),
(108, '2222947895764', 44, 'Crisps', 1, '4.95', '4.95', '2022-05-01 07:59:54', '1'),
(109, '2222947895764', 45, 'Crisps', 1, '4.95', '4.95', '2022-05-01 08:00:08', '1'),
(110, '2222925913231', 45, 'OMO SOFTENER', 1, '50.00', '50.00', '2022-05-01 08:00:08', '1'),
(111, '2222925913231', 46, 'OMO SOFTENER', 1, '50.00', '50.00', '2022-05-01 08:00:42', '1'),
(112, '2222472108593', 46, 'Biscuits', 1, '10.95', '10.95', '2022-05-01 08:00:42', '1'),
(113, '2222472108593', 47, 'Biscuits', 1, '10.95', '10.95', '2022-05-01 08:01:17', '1'),
(114, '2222947895764', 47, 'Crisps', 1, '4.95', '4.95', '2022-05-01 08:01:17', '1'),
(115, '2222947895764', 48, 'Crisps', 1, '4.95', '4.95', '2022-05-01 08:03:37', '1'),
(116, '2222925913231', 48, 'OMO SOFTENER', 1, '50.00', '50.00', '2022-05-01 08:03:37', '1'),
(117, '2222472108593', 49, 'Biscuits', 1, '10.95', '10.95', '2022-05-01 08:04:25', '1'),
(118, '1234', 49, 'So good milk', 1, '20.00', '20.00', '2022-05-01 08:04:25', '1'),
(119, '2222947895764', 50, 'Crisps', 1, '4.95', '4.95', '2022-05-01 08:05:08', '1'),
(120, '2222925913231', 50, 'OMO SOFTENER', 1, '50.00', '50.00', '2022-05-01 08:05:08', '1'),
(121, '2222947895764', 51, 'Crisps', 1, '4.95', '4.95', '2022-05-01 08:06:14', '1'),
(122, '2222925913231', 51, 'OMO SOFTENER', 1, '50.00', '50.00', '2022-05-01 08:06:14', '1'),
(123, '2222925913231', 52, 'OMO SOFTENER', 1, '50.00', '50.00', '2022-05-01 08:07:20', '1'),
(124, '2222472108593', 52, 'Biscuits', 1, '10.95', '10.95', '2022-05-01 08:07:20', '1'),
(125, '2222947895764', 53, 'Crisps', 1, '4.95', '4.95', '2022-05-01 08:08:09', '1'),
(126, '2222925913231', 53, 'OMO SOFTENER', 1, '50.00', '50.00', '2022-05-01 08:08:09', '1'),
(127, '2222947895764', 54, 'Crisps', 1, '4.95', '4.95', '2022-05-01 08:08:35', '1'),
(128, '2222947895764', 55, 'Crisps', 1, '4.95', '4.95', '2022-05-01 08:09:39', '1'),
(129, '2222925913231', 55, 'OMO SOFTENER', 1, '50.00', '50.00', '2022-05-01 08:09:39', '1'),
(130, '2222881344444', 56, 'Burger', 1, '10.00', '10.00', '2022-05-01 08:10:25', '1'),
(131, '2222947895764', 57, 'Crisps', 1, '4.95', '4.95', '2022-05-01 08:10:49', '1'),
(132, '2222947895764', 58, 'Crisps', 1, '4.95', '4.95', '2022-05-01 08:10:59', '1'),
(133, '2222947895764', 59, 'Crisps', 1, '4.95', '4.95', '2022-05-01 08:11:16', '1'),
(134, '2222947895764', 60, 'Crisps', 1, '4.95', '4.95', '2022-05-01 06:14:54', '1'),
(135, '2222925913231', 60, 'OMO SOFTENER', 1, '50.00', '50.00', '2022-05-01 06:14:54', '1'),
(136, '2222925913231', 61, 'OMO SOFTENER', 1, '50.00', '50.00', '2022-05-01 06:15:36', '1'),
(137, '2222472108593', 62, 'Biscuits', 1, '10.95', '10.95', '2022-05-01 06:17:05', '1'),
(138, '2222947895764', 63, 'Crisps', 2, '4.95', '9.90', '2022-05-01 08:32:11', '1'),
(139, '2222925913231', 63, 'OMO SOFTENER', 2, '50.00', '100.00', '2022-05-01 08:32:11', '1'),
(140, '2222947895764', 64, 'Crisps', 1, '4.95', '4.95', '2022-05-01 08:33:10', '1'),
(141, '2222925913231', 64, 'OMO SOFTENER', 1, '50.00', '50.00', '2022-05-01 08:33:10', '1'),
(142, '2222925913231', 65, 'OMO SOFTENER', 2, '50.00', '100.00', '2022-05-01 08:33:38', '1'),
(143, '2222947895764', 65, 'Crisps', 1, '4.95', '4.95', '2022-05-01 08:33:38', '1'),
(144, '2222925913231', 66, 'OMO SOFTENER', 1, '50.00', '50.00', '2022-05-01 08:33:55', '1'),
(145, '2222947895764', 67, 'Crisps', 1, '4.95', '4.95', '2022-05-01 08:34:29', '1'),
(146, '2222925913231', 67, 'OMO SOFTENER', 1, '50.00', '50.00', '2022-05-01 08:34:29', '1'),
(147, '2222947895764', 68, 'Crisps', 1, '4.95', '4.95', '2022-05-01 08:36:02', '1'),
(148, '2222947895764', 69, 'Crisps', 1, '4.95', '4.95', '2022-05-01 08:36:38', '1'),
(149, '2222947895764', 70, 'Crisps', 1, '4.95', '4.95', '2022-05-01 06:37:38', '1'),
(150, '2222925913231', 70, 'OMO SOFTENER', 1, '50.00', '50.00', '2022-05-01 06:37:38', '1'),
(151, '2222925913231', 71, 'OMO SOFTENER', 1, '50.00', '50.00', '2022-05-01 06:38:57', '1'),
(152, '2222925913231', 72, 'OMO SOFTENER', 1, '50.00', '50.00', '2022-05-01 06:46:31', '1'),
(153, '2222472108593', 72, 'Biscuits', 1, '10.95', '10.95', '2022-05-01 06:46:31', '1'),
(154, '2222947895764', 73, 'Crisps', 2, '4.95', '9.90', '2023-11-05 13:01:03', '1'),
(155, '2222925913231', 73, 'OMO SOFTENER', 2, '50.00', '100.00', '2023-11-05 13:01:03', '1');

-- --------------------------------------------------------

--
-- Table structure for table `table_info`
--

CREATE TABLE `table_info` (
  `table_id` int(11) NOT NULL,
  `disable` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_info`
--

INSERT INTO `table_info` (`table_id`, `disable`) VALUES
(1, 0),
(2, 0),
(3, 1),
(4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `image` varchar(500) DEFAULT NULL,
  `role` varchar(20) NOT NULL,
  `gender` varchar(6) NOT NULL DEFAULT 'male',
  `deletable` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `date`, `image`, `role`, `gender`, `deletable`) VALUES
(1, 'Eathorne', 'email@email.com', '$2y$10$mIRwGavpKoOCWu62PLDMlOOCA1a.CwnqLqtIICKO2.X9ew.lKXXH2', '2021-12-28 09:33:15', 'uploads/9696c9f84f34af001df13ab4cfc6337cdae55ca3_6105.jpg', 'admin', 'male', 0),
(2, 'Mary', 'mary@email.com', '$2y$10$kxoJW56qGmYO56EILS8CpeINaR0XP09DroQGpwveniunL6dsdhl6G', '2021-12-28 10:39:58', 'uploads/1f523731c17b23485e5bcc0bd15efae5bc774ed9_3779.jpg', 'cashier', 'female', 1),
(5, 'some user', 'mail@mail.com', '$2y$10$ooQK6400JBosHjglFRfP4uiuj6ZoMgs2aQlU4.vcbDlnXVsmKd/4i', '2022-02-17 19:13:49', NULL, 'user', 'male', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu_info`
--
ALTER TABLE `menu_info`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barcode` (`barcode`),
  ADD KEY `description` (`description`),
  ADD KEY `qty` (`qty`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `date` (`date`),
  ADD KEY `views` (`views`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barcode` (`barcode`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `date` (`date`),
  ADD KEY `description` (`description`),
  ADD KEY `receipt_no` (`receipt_no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `date` (`date`),
  ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu_info`
--
ALTER TABLE `menu_info`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
