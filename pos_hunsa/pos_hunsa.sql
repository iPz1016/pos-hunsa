-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2023 at 05:30 AM
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
(15, 1699804408, 2, 1, 1, 'americano iced', 4, 65, '2023-11-12 22:54:26');

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
(1699519675, NULL, 1, 8, 10),
(1699519675, NULL, 4, 3, 0),
(1699519675, NULL, 3, 0, 4),
(1699694929, NULL, 1, 0, 1),
(1699694929, NULL, 2, 0, 1),
(1699694929, NULL, 3, 1, 0),
(1699694929, NULL, 4, 1, 0),
(1699804415, 4, 1, 6, 0),
(1699804415, 4, 2, 7, 0),
(1699804474, 2, 1, 1, 4),
(1699804474, 2, 2, 3, 0),
(1699804474, 2, 3, 1, 0),
(1699804474, 2, 4, 1, 0);

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
  ADD KEY `email` (`email`),
  ADD KEY `date` (`date`),
  ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `menu_info`
--
ALTER TABLE `menu_info`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
