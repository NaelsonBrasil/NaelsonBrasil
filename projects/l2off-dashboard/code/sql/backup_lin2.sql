-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 14, 2019 at 04:45 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lin2rpg`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(65) NOT NULL,
  `data_create` varchar(32) NOT NULL,
  `status` varchar(32) NOT NULL,
  `vip` int(11) DEFAULT NULL,
  `login` varchar(32) DEFAULT NULL,
  `logout` varchar(32) DEFAULT NULL,
  `coupon` int(11) DEFAULT NULL,
  `access_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `name`, `email`, `password`, `data_create`, `status`, `vip`, `login`, `logout`, `coupon`, `access_level`) VALUES
(1, 'naelson', 'naelson.g.saraiva@gmail.com', '$2y$10$UIGLCwizFdRdvGZX0rNw4uNTUqMR.HSWazvrwJerVwNl6gqhKB6re', '2019-07-20 14:21:25', 'active', NULL, NULL, NULL, NULL, 1),
(2, 'Valter', 'valter19.1991@gmail.com', '$2y$10$UIGLCwizFdRdvGZX0rNw4uNTUqMR.HSWazvrwJerVwNl6gqhKB6re', '2019-08-05 12:10:35', 'active', NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `history_payment`
--

CREATE TABLE `history_payment` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `price` varchar(11) NOT NULL,
  `data` varchar(20) NOT NULL,
  `method` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history_payment`
--

INSERT INTO `history_payment` (`id`, `id_user`, `id_product`, `amount`, `price`, `data`, `method`) VALUES
(2, 2, 2, 0, '1', '25', '1');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `site_name` varchar(50) NOT NULL,
  `num_order` varchar(20) NOT NULL,
  `price` varchar(11) NOT NULL,
  `dyas` int(11) NOT NULL,
  `discount` float DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL,
  `data_order` varchar(20) NOT NULL,
  `data_aproved` varchar(20) DEFAULT NULL,
  `token` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `id_user`, `site_id`, `site_name`, `num_order`, `price`, `dyas`, `discount`, `status`, `data_order`, `data_aproved`, `token`) VALUES
(21, 1, 4, 'test', 'v23297mrfs-01', '79.00', 30, 0, 'pedding', '2019-08-13 20:04:16', NULL, 'c74c2c2b2c99c3468dfdeb4623499ade');

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `id` int(11) NOT NULL,
  `free` int(11) NOT NULL,
  `price` varchar(11) DEFAULT NULL,
  `dyas` int(11) DEFAULT NULL,
  `chronic` varchar(100) NOT NULL,
  `project` varchar(20) NOT NULL,
  `plataform` varchar(16) NOT NULL,
  `html` varchar(2000) DEFAULT '<li>Suport&nbsp<i class="fas fa-check text-danger"></i></li><li>CSRF&nbsp<i class="fas fa-check text-success"></i></li>',
  `category` varchar(1) NOT NULL,
  `image` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`id`, `free`, `price`, `dyas`, `chronic`, `project`, `plataform`, `html`, `category`, `image`) VALUES
(2, 0, NULL, NULL, 'Interlude', 'frozen', 'java', '<li>Suport&nbsp<i class=\"fas fa-check text-danger\"></i></li>\r\n  <li>REGISTER&nbsp<i class=\"fas fa-check text-success\"></i></li>\r\n  <li>LOGIN&nbsp<i class=\"fas fa-check text-success\"></i></li>\r\n  <li>UNLOCK CHARACTERES&nbsp<i class=\"fas fa-check text-success\"></i></li>\r\n  <li>CHANGE PASSWORD&nbsp<i class=\"fas fa-check text-success\"></i></li>\r\n  <li>COUNT REGRESSIVE&nbsp<i class=\"fas fa-check text-success\"></i></li>\r\n  <li>BOX FACEBOOK&nbsp<i class=\"fas fa-check text-success\"></i></li>\r\n  <li>CONTECT SEND EMAIL&nbsp<i class=\"fas fa-check text-success\"></i></li>\r\n  <li>RECOVERS&REPORT BUGS&nbsp<i class=\"fas fa-check text-success\"></i></li>', 'a', '29383e8227582a46258108764ef2ffcb.jpg'),
(3, 0, NULL, NULL, 'Interlude', 'acis', 'java', '<li>Suport&nbsp<i class=\"fas fa-check text-danger\"></i></li>', 'a', '66e44e17e4b6cb0b344cb2a8a147a072.jpg'),
(4, 1, '79.00', 30, 'Interlude', 'acis', 'java', '<li>Suport&nbsp<i class=\"fas fa-check text-danger\"></i></li>', 'a', '66e44e17e4b6cb0b344cb2a8a147a072.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `web_name`
--

CREATE TABLE `web_name` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `template_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `project_name` varchar(50) NOT NULL,
  `data` varchar(30) NOT NULL,
  `total_visit` int(11) NOT NULL DEFAULT '0',
  `token` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `web_temp`
--

CREATE TABLE `web_temp` (
  `id` int(11) NOT NULL,
  `web_name_id` int(11) NOT NULL,
  `number_days` int(11) NOT NULL,
  `begin_data` varchar(25) NOT NULL,
  `end_data` varchar(25) NOT NULL,
  `free` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_payment`
--
ALTER TABLE `history_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`,`token`,`num_order`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_name`
--
ALTER TABLE `web_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_temp`
--
ALTER TABLE `web_temp`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `history_payment`
--
ALTER TABLE `history_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `web_name`
--
ALTER TABLE `web_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `web_temp`
--
ALTER TABLE `web_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
