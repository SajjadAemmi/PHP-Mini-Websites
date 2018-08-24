-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2017 at 08:44 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mashhad_taxi`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(10) NOT NULL,
  `title` varchar(40) COLLATE utf8_persian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `title`) VALUES
(1, 'پراید'),
(2, 'پژو 206'),
(3, 'سمند'),
(4, 'پژو پارس'),
(5, 'زانتیا'),
(6, 'L90');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `taxi_id` int(10) NOT NULL,
  `price` double NOT NULL,
  `begin_lat` double NOT NULL,
  `begin_lng` double NOT NULL,
  `destination_lat` double NOT NULL,
  `destination_lng` double NOT NULL,
  `is_done` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `user_id`, `taxi_id`, `price`, `begin_lat`, `begin_lng`, `destination_lat`, `destination_lng`, `is_done`) VALUES
(1, 1, 1, 0, 36.3362633, 59.5256404, 36.34061907414034, 59.56512251669915, 1),
(2, 1, 1, 0, 36.336314699999996, 59.525603399999994, 36.32649603660924, 59.48878203464358, 1),
(3, 1, 1, 0, 36.323707899999995, 59.5590722, 36.31354184187785, 59.516929331957954, 1),
(4, 1, 1, 0, 36.3363392, 59.5256381, 36.33889738009397, 59.48289441713871, 1),
(5, 1, 1, 6, 36.3363527, 59.525527499999995, 36.326810640268185, 59.491796039428664, 1),
(6, 1, 1, 39, 36.336340799999995, 59.5256404, 36.33869156316801, 59.56632414633782, 1),
(7, 1, 1, 62, 36.3361983, 59.5255895, 36.327347715605434, 59.48756650500491, 1),
(8, 1, 1, 36, 36.3363547, 59.525520699999994, 36.32937113344606, 59.492046731494156, 1),
(9, 1, 1, 96, 36.3364985, 59.525913800000005, 36.32398297438878, 59.49321230769044, 1),
(10, 1, 1, 17, 36.336373, 59.5255718, 36.32074554241037, 59.48548886848141, 1),
(11, 1, 1, 37, 36.3363392, 59.525638199999996, 36.32631308986465, 59.491134263232425, 1),
(12, 1, 1, 2, 36.3363565, 59.5255186, 36.32764423141103, 59.48792475844721, 1),
(13, 1, 1, 119, 36.3366094, 59.5252055, 36.32907267754468, 59.499627954833954, 1),
(14, 1, 1, 37, 36.3363392, 59.525638199999996, 36.32672798897731, 59.5652061473877, 1),
(15, 1, 1, 10326, 36.3236955, 59.5575195, 36.31837058645133, 59.52842289660646, 1),
(16, 1, 1, 37, 36.3363392, 59.525638199999996, 36.310130301461584, 59.53044471855469, 1),
(17, 1, 1, 222, 36.3369232, 59.525036199999995, 36.33505638090277, 59.54323230595696, 1),
(18, 1, 1, 0, 36.2604623, 59.616754900000004, 36.25395643696061, 59.592722307226495, 1);

-- --------------------------------------------------------

--
-- Table structure for table `taxies`
--

CREATE TABLE `taxies` (
  `id` int(10) NOT NULL,
  `name` varchar(40) COLLATE utf8_persian_ci NOT NULL,
  `phone_number` varchar(12) COLLATE utf8_persian_ci NOT NULL,
  `car_id` int(10) NOT NULL,
  `avatar` varchar(40) COLLATE utf8_persian_ci NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `username` varchar(40) COLLATE utf8_persian_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_persian_ci NOT NULL,
  `location_lat` double NOT NULL DEFAULT '0',
  `location_lng` double NOT NULL DEFAULT '0',
  `pelak` varchar(40) COLLATE utf8_persian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `taxies`
--

INSERT INTO `taxies` (`id`, `name`, `phone_number`, `car_id`, `avatar`, `start_time`, `end_time`, `username`, `password`, `location_lat`, `location_lng`, `pelak`) VALUES
(1, 'علی', '123', 1, 'ali.jpg', '08:00:00', '15:59:00', 'ali', '81dc9bdb52d04dc20036dbd8313ed055', 36.3367593, 59.5248582, '12 ج 151 | 36'),
(4, '1', '1', 1, '1.jpg', '21:00:00', '21:59:00', '1', 'c4ca4238a0b923820dcc509a6f75849b', 37, 60, '1 2 3 4');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(40) COLLATE utf8_persian_ci NOT NULL,
  `phone_number` varchar(12) COLLATE utf8_persian_ci NOT NULL,
  `avatar` varchar(40) COLLATE utf8_persian_ci NOT NULL,
  `username` varchar(40) COLLATE utf8_persian_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_persian_ci NOT NULL,
  `location_lat` double NOT NULL DEFAULT '0',
  `location_lng` double NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone_number`, `avatar`, `username`, `password`, `location_lat`, `location_lng`) VALUES
(1, 'سجادو', '09150471487', 'sajjad.jpg', 'sajjad', '81dc9bdb52d04dc20036dbd8313ed055', 36.3062415, 59.49850610000001),
(6, 'بسکوییان', '09365310033', 'besco.jpg', 'besco', '81dc9bdb52d04dc20036dbd8313ed055', 36.2604623, 59.616754900000004),
(5, 'علیو', '01234', 'ali.jpg', 'ali', '81dc9bdb52d04dc20036dbd8313ed055', 36.2604623, 59.616754900000004);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxies`
--
ALTER TABLE `taxies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `taxies`
--
ALTER TABLE `taxies`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
