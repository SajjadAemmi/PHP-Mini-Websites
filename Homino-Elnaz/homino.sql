-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2018 at 06:03 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homino`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(10) NOT NULL,
  `name` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `family` varchar(40) COLLATE utf8_persian_ci NOT NULL,
  `username` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_persian_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_persian_ci NOT NULL,
  `mobile` varchar(11) COLLATE utf8_persian_ci NOT NULL,
  `jensiat` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `rezume` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `valid` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `family`, `username`, `password`, `email`, `mobile`, `jensiat`, `rezume`, `valid`) VALUES
(1, 'mahdi', '', 'mahdi.sadi', '9636', '', '78963', 'man', 'htygfedvb', 0),
(3, 'ماهان', '', 'mahan', '81dc9bdb52d04dc20036dbd8313ed055', '', '123456456', 'man', 'olkijuyhgrsdjbb', 0),
(6, 'مریم', '', 'maryam', '81dc9bdb52d04dc20036dbd8313ed055', '', '3458219', 'women', '4565mjmhbfc vxf', 0),
(7, 'مهلا', 'مهلایی', 'mahla', '81dc9bdb52d04dc20036dbd8313ed055', '', '596874123', 'women', '7z8a5as1sjujsbhj', 1),
(8, 'چنگیز', 'چنگیزی', 'changiz', '81dc9bdb52d04dc20036dbd8313ed055', 'sajjadaemmi@gmail.com', '09123456779', 'man', 'سلام', 1);

-- --------------------------------------------------------

--
-- Table structure for table `footer`
--

CREATE TABLE `footer` (
  `id` int(10) NOT NULL,
  `title` text COLLATE utf8_persian_ci NOT NULL,
  `text` text COLLATE utf8_persian_ci NOT NULL,
  `subtitle` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `footer`
--

INSERT INTO `footer` (`id`, `title`, `text`, `subtitle`) VALUES
(1, 'هومینو: وبسایت خدمات منزل', 'مشهد هم صاحب یکی از شعبات بازار آنلاین خدمات «هومینو» شد. اگر کسب و کاری دارید که به کارهای منازل رسیدگی‌ می‌کند، می‌توانید با عضوشدن در «هومینو» بدون دادن آگهی تبلیغاتی گران قیمت به مشتریان خانگی دسترسی داشته‌بشید. مشهدی‌های کوهسنگی، سجاد، احمد آباد و وکیل آباد و آزادشهر یا آنهایی که در معلم و ملک آباد و امامیه و هاشمیه خانه دارند و البته ساکنین سناباد و بلوار شریعتی و الهیه و کارمندان، همه می‌توانند برای انجام‌شدن کارهای تاسیسات و الکتریکی و دکوراسیون داخلی خانه و البته برای دسترسی داشتن به شرکت‌های خدماتی نظافتی منزل و پذیرایی، یا بازسازی ساختمان و سم‌ پاشی، در بازار خدمات هومینو سفارش ثبت کرده و بعد از اینکه قیمت و سابقه‌ پیشنهادهای مختلف را بررسی کردند کار را به متخصص ایده‌آل خود بسپارند.', 'شهر های استان خراسان رضوی در هومینو (شهر های خاکستری در آینده نزدیک فعال می شوند): مشهد - نیشابور - سبزوار - تربت حیدریه - کاشمر - قوچان - تربت جام - تایباد - چناران - سرخس - گناباد - فریمان - درگز - خواف - بردسکن - طرقبه - گلبهار');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(10) NOT NULL,
  `title` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `title`, `price`) VALUES
(1, 'آرایشی', 10000),
(2, 'پرستاری', 25000),
(3, 'آموزشی', 15000),
(4, 'تست', 20000),
(5, 'تعمیرات', 20000),
(6, 'خدمات', 520),
(7, 'پرستاری از سالمندان', 808000);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `text` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `send_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `text`, `send_date`) VALUES
(1, 2, 'salam', '2018-08-04 08:39:37'),
(2, 6, 'salam.khoobi', '2018-08-07 22:38:09'),
(3, 8, 'mersi.to chetori?', '2018-08-07 22:38:47'),
(4, 6, 'manam khoobam', '2018-08-07 22:39:15'),
(5, 3, 'che khabar?', '2018-08-07 22:39:37'),
(6, 4, 'salamati', '2018-08-07 22:39:50'),
(7, 5, 'khosh migzareh?', '2018-08-07 22:40:21'),
(8, 1, 'man raftam', '2018-08-07 22:40:41'),
(9, 2, 'bye bye', '2018-08-07 22:40:55'),
(10, 8, 'سلام', '2018-09-04 05:06:59');

-- --------------------------------------------------------

--
-- Table structure for table `reserves`
--

CREATE TABLE `reserves` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `time_id` int(10) NOT NULL,
  `reserve_date` varchar(40) COLLATE utf8_persian_ci NOT NULL,
  `done` int(1) NOT NULL DEFAULT '0',
  `accept` int(1) NOT NULL DEFAULT '0',
  `score` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `reserves`
--

INSERT INTO `reserves` (`id`, `user_id`, `time_id`, `reserve_date`, `done`, `accept`, `score`) VALUES
(1, 1, 2, '2018-08-08 13:52:26', 0, 1, 0),
(2, 4, 2, '2018-08-08 13:52:28', 0, 1, 0),
(3, 2, 5, '2018-08-08 13:52:30', 0, 0, 10),
(4, 4, 4, '2018-08-08 13:54:07', 1, 0, 0),
(6, 4, 5, '2018-08-08 14:14:57', 0, 0, 0),
(7, 4, 6, '2018-08-08 14:16:29', 0, 0, 0),
(8, 4, 5, '2018-08-11 10:02:05', 0, 0, 4),
(9, 1, 5, '2018-08-27 10:57:08', 0, 0, 0),
(11, 1, 2, '2018-08-27 11:00:08', 0, 1, 20),
(12, 1, 5, '2018-08-28 11:08:52', 0, 0, 0),
(13, 1, 5, '1397/05/11 11:09:20', 0, 0, 18),
(14, 1, 2, '1397/05/11 11:09:45', 1, 0, 0),
(15, 3, 6, '1397/05/11 12:48:11', 0, 0, 0),
(16, 4, 2, '1397/05/11 18:54:07', 1, 0, 17),
(21, 4, 2, '1397/06/11 18:31:44', 0, 0, 0),
(22, 4, 6, '1397/06/11 18:31:50', 0, 0, 0),
(23, 4, 2, '1397/06/11 18:31:54', 0, 0, 0),
(25, 8, 3, '1397/06/13 10:00:21', 0, 0, 0),
(27, 8, 9, '1397/06/13 10:06:24', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `times`
--

CREATE TABLE `times` (
  `id` int(10) NOT NULL,
  `employee_id` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `date` date NOT NULL,
  `group_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `times`
--

INSERT INTO `times` (`id`, `employee_id`, `start_time`, `end_time`, `date`, `group_id`) VALUES
(1, '2', '10:30:00', '00:00:00', '2018-08-06', 4),
(2, '3', '00:00:12', '00:00:15', '2018-08-16', 3),
(3, '4', '00:00:07', '00:00:10', '2018-08-03', 5),
(4, '5', '00:00:08', '00:00:10', '2018-08-05', 2),
(5, '1', '00:00:12', '00:00:14', '2018-08-10', 2),
(6, '5', '00:00:11', '00:00:13', '2018-08-03', 6),
(7, '6', '00:00:18', '00:00:22', '2018-08-03', 6),
(8, '5', '17:05:00', '04:00:00', '1397-06-13', 1),
(9, '8', '01:59:00', '12:58:00', '1397-06-14', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `family` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `username` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_persian_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `mobile` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `valid` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `family`, `username`, `password`, `email`, `mobile`, `address`, `valid`) VALUES
(1, 'جواد', 'جوادی', 'b', '12', '', '0', 'سید رضی 67 پلاک 67', 1),
(2, 'ali hosseini', '', 'ali', '1234', '', '12', 'masshad', 1),
(3, 'سجاد', '', 'sajjad', '8fc00922bc09442f10ff8a8be0973604', 'sajjadaemmi@rocketmail.com', '1', 'a', 1),
(4, 'hamid', '', 'hamid', '81dc9bdb52d04dc20036dbd8313ed055', '', '0', 'yast', 1),
(5, 'yusef', '', 'ye73', '81dc9bdb52d04dc20036dbd8313ed055', '', '789654123', ',iguvhgctrhsfbdz', 0),
(6, 'ayda', '', 'ayad', '659832', '', '7598541', 'olikujyhyht', 1),
(7, 'مینا', 'مینایی', 'mina', '458574', '', '32514697', 'kjih lo huuu', 1),
(8, 'غلام', 'غلامی', 'gholam', '202cb962ac59075b964b07152d234b70', 'sajjadaemmi@gmail.com', '09123456789', 'شیراز', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footer`
--
ALTER TABLE `footer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reserves`
--
ALTER TABLE `reserves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `times`
--
ALTER TABLE `times`
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
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `footer`
--
ALTER TABLE `footer`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `reserves`
--
ALTER TABLE `reserves`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `times`
--
ALTER TABLE `times`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
