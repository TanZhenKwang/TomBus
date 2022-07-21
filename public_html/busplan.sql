-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2022 at 09:19 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `busplan`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(10) UNSIGNED NOT NULL,
  `route_id` int(10) UNSIGNED NOT NULL,
  `seat_no` varchar(50) CHARACTER SET latin1 NOT NULL,
  `bus_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `booking_time` datetime NOT NULL,
  `pay_amount` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `route_id`, `seat_no`, `bus_id`, `user_id`, `booking_time`, `pay_amount`) VALUES
(66, 1, '23', 1, 2, '2021-07-12 03:54:30', 10),
(67, 1, '23', 1, 2, '2022-07-19 15:40:00', 9),
(68, 1, '23', 1, 2, '2021-07-12 03:54:30', 10),
(70, 1, '23', 1, 2, '2021-08-12 03:54:30', 10),
(71, 1, '23', 1, 2, '2021-09-12 03:54:30', 10),
(72, 1, '20, 24', 1, 2, '2022-07-19 23:50:10', 18),
(73, 1, '20, 24', 1, 2, '2022-07-20 00:56:03', 18),
(74, 4, '20, 24', 1, 2, '2022-07-20 03:10:44', 18),
(75, 4, '20, 24', 3, 2, '2022-07-20 03:21:50', 18),
(92, 1, '15, 16', 1, 2, '2022-07-21 00:33:47', 18),
(93, 1, '24', 1, 2, '2022-07-21 01:01:40', 9),
(94, 1, '32', 1, 2, '2022-07-21 01:40:47', 9),
(95, 1, '32', 1, 2, '2022-07-21 01:41:19', 9),
(96, 1, '32', 1, 2, '2022-07-21 01:41:21', 9),
(97, 1, '32', 1, 2, '2022-07-21 01:42:50', 9),
(98, 1, '32', 1, 2, '2022-07-21 01:42:50', 9),
(99, 1, '32', 1, 2, '2022-07-21 01:43:13', 9),
(100, 1, '32', 1, 2, '2022-07-19 15:40:00', 10),
(103, 1, '32', 1, 2, '2022-07-21 01:44:06', 9),
(104, 1, '32', 1, 2, '2022-07-21 01:44:25', 9),
(105, 1, '32', 1, 2, '2022-07-21 01:44:30', 9),
(106, 1, '20, 32', 1, 2, '2022-07-21 01:44:55', 18),
(111, 1, '32', 1, 2, '2022-07-19 15:40:00', 9),
(112, 1, '27', 1, 2, '2022-07-21 12:22:23', 9),
(113, 1, '23', 1, 2, '2021-07-12 03:54:30', 10),
(114, 1, '23', 1, 2, '2021-07-12 03:54:30', 10),
(115, 1, '12, 16', 1, 2, '2022-07-21 14:22:18', 18);

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `bus_id` int(10) UNSIGNED NOT NULL,
  `bus_name` varchar(40) CHARACTER SET latin1 NOT NULL,
  `bus_logo` varchar(260) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`bus_id`, `bus_name`, `bus_logo`) VALUES
(1, 'Nices Imperials', 'nice_bus.jpg'),
(2, 'Transtar Travel Bus', 'transtar_bus.jpg'),
(3, 'Supernice Grassland', 'super_bus.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `busroute`
--

CREATE TABLE `busroute` (
  `route_id` int(10) UNSIGNED NOT NULL,
  `departure` varchar(30) CHARACTER SET latin1 NOT NULL,
  `destination` varchar(30) CHARACTER SET latin1 NOT NULL,
  `date` date NOT NULL,
  `departure_time` time NOT NULL,
  `arrival_time` time NOT NULL,
  `fare` int(10) NOT NULL,
  `bus_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `busroute`
--

INSERT INTO `busroute` (`route_id`, `departure`, `destination`, `date`, `departure_time`, `arrival_time`, `fare`, `bus_id`) VALUES
(1, 'Penang', 'Kuala Lumpur', '2022-07-11', '16:00:00', '21:00:00', 9, 1),
(2, 'Penang', 'Melacca', '2022-07-13', '16:00:00', '21:00:00', 10, 2),
(3, 'Penang', 'Johor', '2022-07-11', '16:00:00', '21:00:00', 9, 3),
(4, 'Penang', 'Kuala Lumpur', '2022-07-11', '13:20:00', '18:00:00', 10, 3),
(5, 'Kuala Lumpur', 'Penang', '2022-07-11', '12:00:00', '17:00:00', 9, 2),
(6, 'Kuala Lumpur', 'Melacca', '2022-07-14', '16:00:00', '21:00:00', 9, 3),
(7, 'Kuala Lumpur', 'Johor', '2022-07-11', '17:00:00', '18:00:00', 7, 1),
(8, 'Kuala Lumpur', 'Perlis', '2022-07-13', '16:00:00', '21:00:00', 12, 2),
(9, 'Melacca', 'Penang', '2022-07-11', '16:00:00', '21:00:00', 9, 3),
(10, 'Melacca', 'Kuala Lumpur', '2022-07-12', '16:00:00', '21:00:00', 8, 1),
(11, 'Melacca', 'Johor', '2022-07-11', '09:00:00', '11:00:00', 8, 2),
(12, 'Melacca', 'Perlis', '2022-07-12', '16:00:00', '21:00:00', 9, 3),
(13, 'Johor', 'Penang', '2022-07-11', '16:00:00', '19:54:06', 13, 1),
(14, 'Johor', 'Kuala Lumpur', '2022-07-14', '12:00:00', '21:00:00', 9, 2),
(15, 'Johor', 'Melacca', '2022-07-11', '16:00:00', '18:00:00', 12, 3),
(16, 'Johor', 'Perlis', '2022-07-12', '11:00:00', '21:00:00', 9, 1),
(17, 'Perlis', 'Penang', '2022-07-11', '16:00:00', '21:00:00', 9, 2),
(18, 'Perlis', 'Kuala Lumpur', '2022-07-13', '16:00:00', '21:00:00', 10, 3),
(19, 'Perlis', 'Melacca', '2022-07-11', '12:00:00', '18:00:00', 9, 1),
(20, 'Perlis', 'Johor', '2022-07-13', '19:00:00', '21:00:00', 7, 2),
(22, 'Penang', 'Kuala Lumpur', '2022-10-11', '11:11:00', '23:10:00', 12, 2),
(24, 'Penang', 'Johor', '2022-07-07', '11:08:00', '23:10:00', 10, 3),
(25, 'Penang', 'Johor', '2022-07-07', '11:08:00', '23:10:00', 10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(20) CHARACTER SET latin1 NOT NULL,
  `last_name` varchar(20) CHARACTER SET latin1 NOT NULL,
  `phone_no` varchar(15) CHARACTER SET latin1 NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `password` varchar(32) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `phone_no`, `email`, `password`) VALUES
(2, 'Tommy', 'Tan', '60102288618', 'tommytan2002@hotmail.com', '2b6254819e4ece1a6ee3be58af327576'),
(6, 'Tommy', 'Tan', '60102288618', 'tommytan@hotmail.com', '2b6254819e4ece1a6ee3be58af327576'),
(7, 'Tommy', 'Tan', '0102288618', 'tommytan20402@hotmail.com', '2b6254819e4ece1a6ee3be58af327576'),
(8, 'Tommy', 'Cats', '60102288618', 'tommytan123@hotmail.com', 'ce1c01cdeaa3693dd22ce20cb3c80c43'),
(10, 'Tommy', 'Tan', '0102288618', 'tommytan2012302@hotmail.com', 'Tommy123!'),
(11, 'Tommy', 'Tan', '60102288618', 'tommytan202@hotmail.com', '2b6254819e4ece1a6ee3be58af327576'),
(14, 'Tommy', 'Tan', '0102288618', 'tommytassdan2002@hotmail.com', '2b6254819e4ece1a6ee3be58af327576'),
(15, 'Soail', 'La', '60102288618', 'soaila@hotmail.com', 'Tommytan123!'),
(16, 'Tommy', 'Tan', '0102288618', 'tommytan2121002@hotmail.com', '2b6254819e4ece1a6ee3be58af327576'),
(17, 'Tommy', 'Tan', '60102288618', 'tommytan2002@hotmail.com', '2b6254819e4ece1a6ee3be58af327576');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `route_id` (`route_id`),
  ADD KEY `bus_id` (`bus_id`);

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`bus_id`);

--
-- Indexes for table `busroute`
--
ALTER TABLE `busroute`
  ADD PRIMARY KEY (`route_id`),
  ADD KEY `bus_id` (`bus_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `bus`
--
ALTER TABLE `bus`
  MODIFY `bus_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `busroute`
--
ALTER TABLE `busroute`
  MODIFY `route_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`route_id`) REFERENCES `busroute` (`route_id`),
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`bus_id`) REFERENCES `bus` (`bus_id`);

--
-- Constraints for table `busroute`
--
ALTER TABLE `busroute`
  ADD CONSTRAINT `busroute_ibfk_1` FOREIGN KEY (`bus_id`) REFERENCES `bus` (`bus_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
