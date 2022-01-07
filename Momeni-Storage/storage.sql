-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2017 at 09:57 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `storage`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) NOT NULL,
  `type` varchar(40) COLLATE utf8_persian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `type`) VALUES
(1, 'مواد غذایی'),
(2, 'ابزار'),
(3, 'شوینده');

-- --------------------------------------------------------

--
-- Table structure for table `factors`
--

CREATE TABLE `factors` (
  `id` int(10) NOT NULL,
  `storage_keeper_id` int(10) NOT NULL,
  `kala_id` int(10) NOT NULL,
  `difference_number` int(10) NOT NULL,
  `factor_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `factors`
--

INSERT INTO `factors` (`id`, `storage_keeper_id`, `kala_id`, `difference_number`, `factor_time`) VALUES
(1, 1, 1, 3, '2017-09-10 00:00:39'),
(2, 1, 3, 10, '2017-09-10 00:00:39'),
(3, 1, 2, 2, '2017-09-02 00:07:36'),
(4, 1, 3, 1, '2017-09-10 00:07:36'),
(5, 2, 2, 1, '2017-09-10 06:19:51'),
(6, 2, 3, 3, '2017-09-10 06:19:51'),
(7, 2, 2, 1, '2017-09-10 06:20:38'),
(8, 2, 3, 3, '2017-09-07 06:20:38'),
(9, 2, 4, 45, '2017-09-10 06:20:38'),
(10, 1, 4, -4, '2017-09-12 06:23:28'),
(11, 1, 3, 2, '2017-09-10 06:30:15'),
(12, 1, 4, 2, '2017-09-10 06:30:15'),
(13, 1, 4, 2, '2017-09-10 06:30:28'),
(14, 1, 5, 4, '2017-09-11 06:31:40'),
(15, 1, 5, 2, '2017-09-10 06:35:45'),
(16, 2, 2, -20, '2017-09-06 06:37:23'),
(17, 0, 2, 2, '2017-09-18 00:51:23'),
(18, 0, 3, 4, '2017-09-18 00:51:23'),
(19, 0, 4, 4, '2017-09-18 00:51:23'),
(20, 0, 5, 6, '2017-09-18 00:51:23'),
(21, 0, 6, 6, '2017-09-18 00:51:23');

-- --------------------------------------------------------

--
-- Table structure for table `kalas`
--

CREATE TABLE `kalas` (
  `id` int(10) NOT NULL,
  `name` varchar(40) COLLATE utf8_persian_ci NOT NULL,
  `about` text COLLATE utf8_persian_ci NOT NULL,
  `category_id` int(10) NOT NULL,
  `price` double NOT NULL,
  `image` varchar(40) COLLATE utf8_persian_ci NOT NULL DEFAULT '0',
  `insert_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `number` int(10) NOT NULL DEFAULT '0',
  `unit_id` int(10) NOT NULL,
  `origin_company` varchar(40) COLLATE utf8_persian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `kalas`
--

INSERT INTO `kalas` (`id`, `name`, `about`, `category_id`, `price`, `image`, `insert_date`, `number`, `unit_id`, `origin_company`) VALUES
(1, 'شکر', 'شیرین و خوشمزه', 1, 1212, '0', '2017-09-09 21:06:25', 17, 3, 'بسکو'),
(2, 'ضدیخ', 'بهترین و عالی ترین', 2, 456200, '0', '2017-09-09 23:53:32', 2, 6, 'کاسپین'),
(3, 'پودر ماشین لباس شویی', 'سفید کننده قوی', 3, 123000, '0', '2017-09-10 00:00:39', 21, 1, 'تاژ'),
(4, 'َسیش', 'سیشس', 1, 456, '0', '2017-09-10 06:20:38', 49, 4, 'کمتسکی'),
(5, 'ت', '4', 1, 4, '0', '2017-09-10 06:31:40', 12, 1, '4'),
(6, 'سیب', '23', 1, 20, '0', '2017-09-18 00:51:23', 6, 3, '23');

-- --------------------------------------------------------

--
-- Table structure for table `storage_keepers`
--

CREATE TABLE `storage_keepers` (
  `id` int(10) NOT NULL,
  `name` varchar(40) COLLATE utf8_persian_ci NOT NULL,
  `username` varchar(40) COLLATE utf8_persian_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_persian_ci NOT NULL,
  `image` varchar(40) COLLATE utf8_persian_ci NOT NULL,
  `phone_number` varchar(12) COLLATE utf8_persian_ci NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `storage_keepers`
--

INSERT INTO `storage_keepers` (`id`, `name`, `username`, `password`, `image`, `phone_number`, `start_time`, `end_time`) VALUES
(1, 'سجاد', 'sajjad', '81dc9bdb52d04dc20036dbd8313ed055', '1', '91504714', '00:00:00', '00:00:00'),
(2, 'محسن', 'Mohsen', 'b59c67bf196a4758191e42f76670ceba', '1111.jpg', '1', '11:11:00', '01:01:00'),
(3, 'reza', 'reza', '81dc9bdb52d04dc20036dbd8313ed055', 'reza.jpg', '1234', '01:01:00', '14:02:00');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(10) NOT NULL,
  `title` varchar(40) COLLATE utf8_persian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `title`) VALUES
(1, 'عدد'),
(2, 'گرم'),
(3, 'کیلوگرم'),
(4, 'مثقال'),
(5, 'تن'),
(6, 'لیتر'),
(7, 'میلی لیتر'),
(8, 'متر');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `factors`
--
ALTER TABLE `factors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kalas`
--
ALTER TABLE `kalas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `storage_keepers`
--
ALTER TABLE `storage_keepers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `factors`
--
ALTER TABLE `factors`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `kalas`
--
ALTER TABLE `kalas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `storage_keepers`
--
ALTER TABLE `storage_keepers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
