-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2017 at 09:06 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mgh`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `description` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Web Programming', 'Lorem ipsum dolor sit amet.'),
(2, 'C# Programming', 'Lorem ipsum dolor sit amet.'),
(3, 'Software', 'without description'),
(4, 'Java Programming', 'this is very good'),
(5, 'C++ Programming', 'C++ is a OO language');

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `id` int(11) NOT NULL,
  `link` varchar(40) NOT NULL,
  `icon` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`id`, `link`, `icon`) VALUES
(1, 'http://facebook.com', 'facebook.png'),
(2, 'http://google.com', 'google-plus.png'),
(3, 'http://twitter.com', 'twitter.png'),
(4, 'http://rss.com', 'rss.png'),
(5, 'http://viber.com', 'viber.png'),
(6, '#', 'html5.png'),
(7, 'http://instagram.com', 'instagram.png'),
(8, 'http://skype.com', 'skype.png');

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` int(10) NOT NULL,
  `topic_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `body` text CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id`, `topic_id`, `user_id`, `body`, `create_date`) VALUES
(1, 3, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2015-06-28 19:09:11'),
(2, 3, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2015-06-28 19:10:02'),
(9, 3, 6, '<p>:)))))))</p>', '2015-07-06 14:08:53'),
(10, 1, 3, '<p>:|</p>', '2017-01-10 11:10:10'),
(11, 5, 3, '<p>asdsad</p>', '2017-01-21 18:42:33'),
(12, 5, 3, '', '2017-01-21 18:42:36');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `body` text CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `image` varchar(100) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `category_id`, `user_id`, `title`, `body`, `image`, `create_date`) VALUES
(1, 1, 1, 'Favorite Server-side Language', 'What is your favorite server-side language?', '0', '2015-06-28 11:30:20'),
(2, 2, 1, 'Do you know HTML and Css?', 'lorem ipsum dolor sit amet', '0', '2015-06-28 12:17:37'),
(3, 2, 2, 'Software Engineer', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '0', '2015-06-28 17:41:47'),
(5, 1, 3, 'سلام دنیا', '<p>فوت آیت الله رفسنجانی تسلیت باد</p>', '0', '2017-01-10 08:40:43'),
(6, 1, 5, 'asd', '<p>asdasd</p>', '0', '2017-01-21 16:51:22');

-- --------------------------------------------------------

--
-- Table structure for table `unregistered_users`
--

CREATE TABLE `unregistered_users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `email` varchar(100) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `join_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `about` text CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unregistered_users`
--

INSERT INTO `unregistered_users` (`id`, `name`, `email`, `avatar`, `username`, `password`, `join_date`, `about`) VALUES
(1, 'nilu', 'nilu@gmail.com', 'nilu.jpg', 'nilu', '81dc9bdb52d04dc20036dbd8313ed055', '2017-01-10 08:40:21', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `email` varchar(100) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `last_activity` datetime NOT NULL,
  `join_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `about` text CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `block` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `avatar`, `username`, `password`, `last_activity`, `join_date`, `about`, `block`) VALUES
(1, 'Sajjad Aemmi', 'sajjadaemmi@gmail.com', 'avatar1.jpg', 'Sajjad', 'dbc4d84bfcfe2284ba11beffb853a8c4', '2015-06-10 00:00:00', '2015-06-28 11:24:39', 'I am a web developer', 0),
(2, 'Mahbube Moghimi', 'mahbube.moghimi94@yahoo.com', 'avatar2.jpg', 'Mahbube Mgh', 'dbc4d84bfcfe2284ba11beffb853a8c4', '2015-06-19 00:00:00', '2015-06-28 17:38:53', 'I am a software engineer', 0),
(3, 'ali', 'ali@gholi.com', 'ali.jpg', 'ali', '81dc9bdb52d04dc20036dbd8313ed055', '0000-00-00 00:00:00', '2017-01-10 08:40:24', '', 0),
(5, 'a', 'ali@gholi.com', 'noimage.png', 'admin', '81dc9bdb52d04dc20036dbd8313ed055', '0000-00-00 00:00:00', '2017-01-21 16:51:10', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unregistered_users`
--
ALTER TABLE `unregistered_users`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `unregistered_users`
--
ALTER TABLE `unregistered_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
