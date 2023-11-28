-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2023 at 07:57 AM
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
(27, 1700368410, 1, 2, 1, 'cappuccino iced', 19, 70, '2023-11-20 11:39:31'),
(28, 1700368410, 1, 3, 1, 'chocobanana toast', 6, 105, '2023-11-20 11:39:31'),
(29, 1700368410, 1, 6, 1, 'mango-bingsu', 4, 140, '2023-11-20 11:39:31'),
(30, 1699519675, NULL, 4, 1, 'chocostrawberry toast', 3, 110, '2023-11-20 11:44:36'),
(31, 1699519675, NULL, 3, 1, 'chocobanana toast', 4, 105, '2023-11-20 11:44:36'),
(32, 1699519675, NULL, 2, 1, 'cappuccino iced', 3, 70, '2023-11-20 11:44:36'),
(33, 1700474299, 5, 3, 1, 'chocobanana toast', 1, 105, '2023-11-20 16:58:31'),
(34, 1700474299, 5, 6, 1, 'mango-bingsu', 1, 140, '2023-11-20 16:58:31'),
(35, 1699804415, 4, 2, 1, 'cappuccino iced', 7, 70, '2023-11-20 20:49:05'),
(36, 1699804415, 4, 3, 1, 'chocobanana toast', 1, 105, '2023-11-20 20:49:05'),
(37, 1699804415, 4, 4, 1, 'chocostrawberry toast', 1, 110, '2023-11-20 20:49:05'),
(38, 1699804415, 4, 7, 1, 'americano iced', 2, 60, '2023-11-20 20:49:05'),
(39, 1699804415, 4, 6, 1, 'mango-bingsu', 2, 140, '2023-11-20 20:49:05'),
(40, 1699804415, 4, 5, 1, 'hojicha bingsu', 1, 150, '2023-11-20 20:49:05');

-- --------------------------------------------------------

--
-- Table structure for table `menu_info`
--

CREATE TABLE `menu_info` (
  `menu_id` int(2) NOT NULL,
  `menu_name` text NOT NULL,
  `menu_price` int(8) NOT NULL,
  `disable` tinyint(1) NOT NULL,
  `menu_type` text NOT NULL,
  `menu_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_info`
--

INSERT INTO `menu_info` (`menu_id`, `menu_name`, `menu_price`, `disable`, `menu_type`, `menu_img`) VALUES
(2, 'cappuccino iced', 70, 0, 'drink', 'assets/images/menu/cappuccino-iced.jpg'),
(3, 'chocobanana toast', 105, 0, 'toast', 'assets/images/menu/chocobanana-toast.jpg'),
(4, 'chocostrawberry toast', 110, 0, 'toast', 'assets/images/menu/chocostrawberry-toast.jpg'),
(5, 'hojicha bingsu', 150, 0, 'bing-su', 'assets/images/menu/hojicha-bingsu.jpg'),
(6, 'mango-bingsu', 140, 0, 'bing-su', 'assets/images/menu/mango-bingsu.jpg'),
(7, 'americano iced', 60, 0, 'drink', 'assets/images/menu/americano-iced.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orders_id` int(8) NOT NULL,
  `table_id` int(2) DEFAULT NULL,
  `menu_id` int(2) NOT NULL,
  `onhold_qty` int(3) NOT NULL,
  `served_qty` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orders_id`, `table_id`, `menu_id`, `onhold_qty`, `served_qty`) VALUES
(1700441492, 2, 2, 1, 0),
(1700455330, NULL, 2, 3, 0),
(1700455334, NULL, 3, 5, 0),
(1700455343, NULL, 5, 4, 0),
(1700455349, NULL, 6, 4, 0),
(1700455353, NULL, 2, 4, 0),
(1700455359, NULL, 2, 2, 0),
(1700455535, NULL, 2, 4, 0),
(1700455535, NULL, 4, 1, 0),
(1700455535, NULL, 5, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `table_info`
--

CREATE TABLE `table_info` (
  `table_id` int(2) NOT NULL,
  `disable` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_info`
--

INSERT INTO `table_info` (`table_id`, `disable`) VALUES
(1, 0),
(2, 0),
(3, 1),
(4, 0),
(5, 0),
(6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(8) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `role`) VALUES
(1, 'om2546', '$2y$10$Gr.7h0mgwIBP8N4nWWuOX.JUA2EhEgYMZKE5BvousbEqmQfsxNlIe', 'Chayarob', 'Chantrapiwat', 'manager'),
(2, 'Mary', '$2y$10$kxoJW56qGmYO56EILS8CpeINaR0XP09DroQGpwveniunL6dsdhl6G', 'Fnameeee', 'Lname', 'cashier');

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
  ADD KEY `role` (`role`(768));

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `menu_info`
--
ALTER TABLE `menu_info`
  MODIFY `menu_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
