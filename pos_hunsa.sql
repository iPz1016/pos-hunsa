-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2023 at 10:22 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
  `id` int(11) NOT NULL,
  `orders_id` int(11) NOT NULL,
  `table_id` int(11) DEFAULT NULL,
  `menu_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `menu_name` text NOT NULL,
  `qty` int(11) NOT NULL,
  `menu_price` int(11) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `orders_id`, `table_id`, `menu_id`, `staff_id`, `menu_name`, `qty`, `menu_price`, `time`) VALUES
(8, 1699674302, 2, 5, 1, 'hojicha bingsu', 1, 150, '2023-11-12 10:32:43'),
(9, 1699674302, 2, 6, 1, 'mango-bingsu', 1, 140, '2023-11-12 10:32:43'),
(11, 1699674302, 2, 1, 1, 'americano iced', 1, 65, '2023-11-12 10:32:43'),
(12, 1699674302, 2, 2, 1, 'cappuccino iced', 1, 70, '2023-11-12 10:32:43'),
(13, 1699781440, 2, 1, 1, 'americano iced', 2, 65, '2023-11-12 16:33:51'),
(14, 1699781440, 2, 2, 1, 'cappuccino iced', 1, 70, '2023-11-12 16:33:51'),
(15, 1699804408, 2, 1, 1, 'americano iced', 4, 65, '2023-11-12 22:54:26'),
(18, 1700279859, 1, 2, 1, 'cappuccino iced', 1, 70, '2023-11-18 11:45:44'),
(19, 1700279859, 1, 3, 1, 'chocobanana toast', 1, 105, '2023-11-18 11:45:44'),
(20, 1700279859, 1, 4, 1, 'chocostrawberry toast', 1, 110, '2023-11-18 11:45:44'),
(21, 1700279859, 1, 5, 1, 'hojicha bingsu', 1, 150, '2023-11-18 11:45:44'),
(22, 1700279859, 1, 7, 1, 'americano iced', 3, 60, '2023-11-18 11:45:44'),
(23, 1699804474, 2, 2, 1, 'cappuccino iced', 3, 70, '2023-11-19 09:40:40'),
(24, 1699804474, 2, 3, 1, 'chocobanana toast', 1, 105, '2023-11-19 09:40:40'),
(25, 1699804474, 2, 4, 1, 'chocostrawberry toast', 1, 110, '2023-11-19 09:40:40'),
(26, 1700367584, 1, 2, 1, 'cappuccino iced', 7, 70, '2023-11-19 11:19:54'),
(27, 1701155063, 5, 2, 1, 'cappuccino iced', 1, 70, '2023-11-28 14:04:31'),
(28, 1701155063, 5, 3, 1, 'chocobanana toast', 1, 105, '2023-11-28 14:04:31'),
(29, 1701155063, 5, 4, 1, 'chocostrawberry toast', 1, 110, '2023-11-28 14:04:31'),
(30, 1701155063, 5, 5, 1, 'hojicha bingsu', 1, 150, '2023-11-28 14:04:31'),
(31, 1700386708, 2, 2, 1, 'cappuccino iced', 3, 70, '2023-11-28 14:25:25'),
(32, 1700386708, 2, 3, 1, 'chocobanana toast', 3, 105, '2023-11-28 14:25:25'),
(33, 1700386708, 2, 4, 1, 'chocostrawberry toast', 3, 110, '2023-11-28 14:25:25'),
(34, 1700386708, 2, 5, 1, 'hojicha bingsu', 3, 150, '2023-11-28 14:25:25'),
(35, 1700386708, 2, 7, 1, 'americano iced', 1, 60, '2023-11-28 14:25:25'),
(36, 1700386708, 2, 6, 1, 'mango-bingsu', 1, 140, '2023-11-28 14:25:25'),
(37, 1699694929, NULL, 2, 1, 'cappuccino iced', 1, 70, '2023-11-28 15:39:46'),
(38, 1699694929, NULL, 3, 1, 'chocobanana toast', 1, 105, '2023-11-28 15:39:46'),
(39, 1699694929, NULL, 4, 1, 'chocostrawberry toast', 1, 110, '2023-11-28 15:39:46'),
(40, 1701160971, 2, 2, 7, 'cappuccino iced', 1, 70, '2023-12-01 20:17:33'),
(41, 1701160971, 2, 3, 7, 'chocobanana toast', 2, 105, '2023-12-01 20:17:33'),
(42, 1701160971, 2, 4, 7, 'chocostrawberry toast', 1, 110, '2023-12-01 20:17:33'),
(43, 1701437010, 2, 2, 7, 'cappuccino iced', 1, 70, '2023-12-01 20:24:34'),
(44, 1701437010, 2, 6, 7, 'mango-bingsu', 1, 140, '2023-12-01 20:24:34'),
(45, 1701442712, 5, 3, 7, 'chocobanana toast', 2, 105, '2023-12-01 23:54:15'),
(46, 1701442712, 5, 2, 7, 'cappuccino iced', 1, 70, '2023-12-01 23:54:15'),
(47, 1701442712, 5, 4, 7, 'chocostrawberry toast', 1, 110, '2023-12-01 23:54:15'),
(48, 1701442712, 5, 5, 7, 'hojicha bingsu', 1, 150, '2023-12-01 23:54:15'),
(49, 1701442712, 5, 6, 7, 'mango-bingsu', 1, 140, '2023-12-01 23:54:15'),
(50, 1701442712, 5, 7, 7, 'americano iced', 1, 60, '2023-12-01 23:54:15'),
(51, 1701538731, 2, 3, 7, 'chocobanana toast', 3, 105, '2023-12-03 00:39:58'),
(52, 1701538731, 2, 2, 7, 'cappuccino iced', 3, 70, '2023-12-03 00:39:58'),
(53, 1701538731, 2, 4, 7, 'chocostrawberry toast', 6, 110, '2023-12-03 00:39:58'),
(54, 1701538731, 2, 5, 7, 'hojicha bingsu', 2, 150, '2023-12-03 00:39:58'),
(55, 1701538731, 2, 6, 7, 'mango-bingsu', 2, 140, '2023-12-03 00:39:58'),
(56, 1701538731, 2, 7, 7, 'americano iced', 1, 60, '2023-12-03 00:39:58'),
(57, 1701542411, 2, 5, 7, 'hojicha bingsu', 2, 150, '2023-12-05 16:15:04'),
(58, 1701542411, 2, 7, 7, 'americano iced', 5, 60, '2023-12-05 16:15:04'),
(59, 1701542411, 2, 4, 7, 'chocostrawberry toast', 4, 110, '2023-12-05 16:15:04'),
(60, 1701542411, 2, 3, 7, 'chocobanana toast', 2, 105, '2023-12-05 16:15:04'),
(61, 1701542411, 2, 6, 7, 'mango-bingsu', 1, 140, '2023-12-05 16:15:04'),
(62, 1701542411, 2, 2, 7, 'cappuccino iced', 1, 70, '2023-12-05 16:15:04'),
(63, 1701767726, 2, 5, 7, 'hojicha bingsu', 1, 150, '2023-12-05 16:16:32'),
(64, 1701767906, 2, 5, 7, 'hojicha bingsu', 1, 150, '2023-12-05 16:18:30'),
(65, 1701767933, 2, 4, 7, 'chocostrawberry toast', 1, 110, '2023-12-05 16:18:57'),
(66, 1701768013, 2, 5, 7, 'hojicha bingsu', 1, 150, '2023-12-05 16:20:20'),
(67, 1701768042, 2, 6, 7, 'mango-bingsu', 1, 140, '2023-12-05 16:20:47'),
(68, 1701768059, 2, 6, 7, 'mango-bingsu', 1, 140, '2023-12-05 16:21:02'),
(69, 1701768073, 2, 7, 7, 'americano iced', 1, 60, '2023-12-05 16:21:19'),
(70, 1701768088, 2, 7, 7, 'americano iced', 1, 60, '2023-12-05 16:21:32'),
(71, 1701768167, 2, 6, 7, 'mango-bingsu', 1, 140, '2023-12-05 16:22:51'),
(72, 1701768178, 2, 6, 7, 'mango-bingsu', 1, 140, '2023-12-05 16:23:03'),
(73, 1701768236, 2, 4, 7, 'chocostrawberry toast', 1, 110, '2023-12-05 16:24:00'),
(74, 1701768342, 2, 7, 7, 'americano iced', 1, 60, '2023-12-05 16:25:46'),
(75, 1701768367, 2, 2, 7, 'cappuccino iced', 1, 70, '2023-12-05 16:28:16'),
(76, 1701768367, 2, 5, 7, 'hojicha bingsu', 1, 150, '2023-12-05 16:28:16'),
(77, 1701768367, 2, 3, 7, 'chocobanana toast', 1, 105, '2023-12-05 16:28:16'),
(78, 1701768367, 2, 6, 7, 'mango-bingsu', 1, 140, '2023-12-05 16:28:16'),
(79, 1701768367, 2, 4, 7, 'chocostrawberry toast', 1, 110, '2023-12-05 16:28:16'),
(80, 1701768367, 2, 7, 7, 'americano iced', 1, 60, '2023-12-05 16:28:16'),
(81, 1701768663, 2, 5, 7, 'hojicha bingsu', 1, 150, '2023-12-05 20:59:12'),
(82, 1701768663, 2, 2, 7, 'cappuccino iced', 1, 70, '2023-12-05 20:59:12'),
(83, 1701513852, 1, 5, 7, 'hojicha bingsu', 8, 150, '2023-12-05 21:57:38'),
(84, 1701513852, 1, 6, 7, 'mango-bingsu', 4, 140, '2023-12-05 21:57:38'),
(85, 1701513852, 1, 3, 7, 'chocobanana toast', 5, 105, '2023-12-05 21:57:38'),
(86, 1701513852, 1, 4, 7, 'chocostrawberry toast', 6, 110, '2023-12-05 21:57:38'),
(87, 1701513852, 1, 2, 7, 'cappuccino iced', 6, 70, '2023-12-05 21:57:38'),
(88, 1701513852, 1, 7, 7, 'americano iced', 4, 60, '2023-12-05 21:57:38'),
(89, 1702124373, 2, 3, 7, 'chocobanana toast', 1, 105, '2023-12-09 19:20:21'),
(90, 1702124373, 2, 4, 7, 'chocostrawberry toast', 1, 110, '2023-12-09 19:20:21'),
(91, 1702124373, 2, 7, 7, 'americano iced', 1, 60, '2023-12-09 19:20:21'),
(92, 1702124426, 2, 13, 9, 'Matcha TOAST', 1, 225, '2023-12-09 22:07:20'),
(93, 1702124426, 2, 4, 9, 'chocostrawberry toast', 1, 110, '2023-12-09 22:07:20'),
(94, 1702130634, 1, 5, 9, 'hojicha bingsu', 1, 150, '2023-12-09 22:07:28'),
(95, 1702130634, 1, 6, 9, 'mango-bingsu', 1, 140, '2023-12-09 22:07:28'),
(96, 1701537481, 5, 5, 9, 'hojicha bingsu', 1, 150, '2023-12-09 22:07:34'),
(97, 1701537481, 5, 6, 9, 'mango-bingsu', 1, 140, '2023-12-09 22:07:34'),
(98, 1701537481, 5, 7, 9, 'americano iced', 1, 60, '2023-12-09 22:07:34'),
(99, 1701537481, 5, 3, 9, 'chocobanana toast', 1, 105, '2023-12-09 22:07:34'),
(100, 1699804415, 4, 2, 9, 'cappuccino iced', 8, 75, '2023-12-09 22:07:42'),
(101, 1699804415, 4, 3, 9, 'chocobanana toast', 1, 105, '2023-12-09 22:07:42'),
(102, 1702216384, 8, 5, 9, 'hojicha bingsu', 1, 150, '2023-12-10 20:59:12'),
(103, 1702273788, NULL, 2, 9, 'cappuccino iced', 1, 75, '2023-12-11 12:50:01'),
(104, 1702273788, NULL, 3, 9, 'chocobanana toast', 1, 105, '2023-12-11 12:50:01');

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
(25, 'Hojicha BING-SU', 265, 0, 'BING-SU', 'assets/images/menu/hojicha-bingsu.jpg'),
(26, 'Mango BING-SU', 265, 0, 'BING-SU', 'assets/images/menu/mango-bingsu.jpg'),
(27, 'Milk BING-SU', 245, 0, 'BING-SU', 'assets/images/menu/milk-bingsu.jpg'),
(28, 'Strawberry Chesecake BING-SU', 265, 0, 'BING-SU', 'assets/images/menu/strawberrychesecake-bingsu.jpg'),
(29, 'Thai Tea BING-SU', 255, 0, 'BING-SU', 'assets/images/menu/thaitea-bingsu.jpg'),
(30, 'Two Tone BING-SU', 255, 0, 'BING-SU', 'assets/images/menu/twotone-bingsu.jpg'),
(31, 'Ferrero TOAST', 265, 0, 'TOAST', 'assets/images/menu/ferrero-toast.jpg'),
(32, 'Nutella TOAST', 225, 0, 'TOAST', 'assets/images/menu/nutella-toast.jpg'),
(33, 'Matcha TOAST', 225, 0, 'TOAST', 'assets/images/menu/matcha-toast.jpg'),
(34, 'Chocolate TOAST with Banana', 215, 0, 'TOAST', 'assets/images/menu/chocobanana-toast.jpg'),
(35, 'Chocolate TOAST with Strawberry', 235, 0, 'TOAST', 'assets/images/menu/chocostrawberry-toast.jpg'),
(36, 'Chocolate FRAPPE', 95, 0, 'FRAPPE', 'assets/images/menu/darkchocolate-frappe.jpg'),
(37, 'Matcha FRAPPE', 95, 0, 'FRAPPE', 'assets/images/menu/matcha-frappe.jpg'),
(38, 'Mochaccino FRAPPE', 95, 0, 'FRAPPE', 'assets/images/menu/mochaccino-frappe.jpg'),
(39, 'Milk FRAPPE', 75, 0, 'FRAPPE', 'assets/images/menu/milk-frappe.jpg'),
(40, 'Nutella Crunch FRAPPE', 105, 0, 'FRAPPE', 'assets/images/menu/nutellacrunch-frappe.jpg'),
(41, 'Americano ICED', 65, 0, 'ICED', 'assets/images/menu/americano-iced.jpg'),
(42, 'Royal Thai Tea ICED', 65, 0, 'ICED', 'assets/images/menu/royalthaimilk-iced.jpg'),
(43, 'Late ICED', 70, 0, 'ICED', 'assets/images/menu/late-iced.jpg'),
(44, 'Cappuccino ICED', 70, 0, 'ICED', 'assets/images/menu/cappuccino-iced.jpg');

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
(1702286387, 1, 26, 1, 0),
(1702286387, 1, 25, 1, 0),
(1702286387, 1, 27, 2, 0),
(1702286392, 2, 38, 1, 0),
(1702286392, 2, 37, 0, 1),
(1702286392, 2, 32, 1, 0),
(1702286392, 2, 33, 0, 1),
(1702286392, 2, 35, 1, 0),
(1702286392, 2, 34, 0, 1),
(1702286387, 1, 29, 0, 1),
(1702286419, 10, 25, 0, 2),
(1702286419, 10, 26, 0, 1),
(1702286426, 14, 27, 0, 1),
(1702286426, 14, 33, 0, 1),
(1702286426, 14, 36, 0, 1),
(1702286426, 14, 39, 0, 1),
(1702286440, NULL, 29, 1, 0),
(1702286440, NULL, 30, 0, 1),
(1702286440, NULL, 27, 0, 1),
(1702286461, NULL, 25, 2, 0),
(1702286472, NULL, 33, 1, 0);

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
(4, 1),
(5, 0),
(6, 0),
(7, 0),
(8, 0),
(9, 0),
(10, 0),
(11, 1),
(12, 0),
(13, 0),
(14, 0),
(15, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `role`) VALUES
(14, 'Cashier', '$2y$10$qtyCm86S8KqnPiqNCQSshuSXH8VxuDgz/1iFbXUBkSsICZy0tv2DK', 'CASHIER', 'POS', 'cashier'),
(15, 'Manager', '$2y$10$lb2xNoqmiOn6pTBJhUCqIu8wcusPV40C6a7NQIlYHd35wr8tDlMdu', 'MANAGER', 'POS', 'manager');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_info`
--
ALTER TABLE `menu_info`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `menu_info`
--
ALTER TABLE `menu_info`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
