-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2025 at 09:17 PM
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
-- Database: `classic_events`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nm` varchar(10) NOT NULL,
  `pswd` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nm`, `pswd`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `anniversary`
--

CREATE TABLE `anniversary` (
  `id` int(11) NOT NULL,
  `img` varchar(1000) NOT NULL,
  `nm` varchar(20) NOT NULL,
  `price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `anniversary`
--

INSERT INTO `anniversary` (`id`, `img`, `nm`, `price`) VALUES
(1, 'IMG_9909.JPG', 'Balloon Decoration w', 210000),
(2, 'cs_anniversary1.jpg', 'Table Decoration1', 48000);

-- --------------------------------------------------------

--
-- Table structure for table `birthday`
--

CREATE TABLE `birthday` (
  `id` int(11) NOT NULL,
  `img` varchar(1000) NOT NULL,
  `nm` varchar(20) NOT NULL,
  `price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `birthday`
--

INSERT INTO `birthday` (`id`, `img`, `nm`, `price`) VALUES
(1, 'cs_birthday1.jpg', 'Baby Pink balloon bi', 80000),
(2, 'cs_minion.jpg', 'Minion birthday them', 120000),
(3, '13164198_965117990250248_2782481749866692985_n.jpg', 'Birthday decoration ', 130000),
(4, 'cs_birthday3.jpg', 'Birthday Cake', 1200),
(5, 'birthday1.jpg', 'Balloon', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `nm` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `mo` int(10) NOT NULL,
  `theme` varchar(1000) NOT NULL,
  `thm_nm` varchar(20) NOT NULL,
  `price` int(10) NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `nm`, `email`, `mo`, `theme`, `thm_nm`, `price`, `date`) VALUES
(23, 'asdfg', 'as@gmail.com', 2147483647, 'cs_wedding_flower.jpg', 'Flower Decoration', 20000, '2025-11-20');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `unm` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `comment` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `unm`, `email`, `comment`) VALUES
(4, 'test', 'test12@gmail.com', 'hi want to connect for wedding event');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `unm` varchar(39) NOT NULL,
  `pswd` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `unm`, `pswd`) VALUES
(1, 'abc', 'abc'),
(2, 'c', 'e'),
(3, 'b', 'abc'),
(4, 'abc', 'abc'),
(5, 'pkhokhar162@rku.ac.in', 'test'),
(6, 'psk', 'reset123'),
(7, 'test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `otherevent`
--

CREATE TABLE `otherevent` (
  `id` int(11) NOT NULL,
  `img` varchar(1000) NOT NULL,
  `nm` varchar(2000) NOT NULL,
  `price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `otherevent`
--

INSERT INTO `otherevent` (`id`, `img`, `nm`, `price`) VALUES
(1, 'cs_dj1.jpg', 'Dj parties in club', 90000),
(2, 'cs_dj-sound1.jpg', 'Wedding enjoyment', 60000),
(3, 'cs_eno2.JPG', 'Inoguration of new shop', 30000),
(4, 'cs_gift.jpg', 'Gift for function', 30000),
(5, 'IMG_9871.JPG', 'Selfy Zone', 85000),
(6, 'cs_dj-sound.jpg', 'Wedding Dhol', 15000),
(7, '11707822_846071408796477_7148431446458227749_n.jpg', 'asjdgjsagdj', 2565372);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `token` varchar(64) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `expires_at` datetime NOT NULL,
  `used` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `username`, `token`, `created_at`, `expires_at`, `used`) VALUES
(1, 'abc', '5ee65c47078b5cc0b1c9d9975dd27736e649c087221ea15dd1fa0458d3cc6d6a', '2025-11-15 00:06:52', '2025-11-14 19:41:52', 0),
(2, 'abc', '4f639c69326d5ef3e2578c9b149a7519caee92110446c7e4235fe9629af4ef7e', '2025-11-15 00:10:17', '2025-11-14 19:45:17', 0),
(3, 'abc', 'fa7d37ab4cc2ba98122dfbc0086ce5569d36e59f23bcd32f08efd687ed1a7f6c', '2025-11-15 00:11:35', '2025-11-14 19:46:35', 0),
(4, 'yrdy', '308f8dc9202fcf3859590a87a5f682eed5ce92ad5199e7a33868152e4c81036e', '2025-11-15 00:11:44', '2025-11-14 19:46:44', 0),
(5, 'abc', 'ccbd4804e1383f40678bedb5f0c743e3a566f006979da44cfadb4df8eb418968', '2025-11-15 00:18:18', '2025-11-14 19:53:18', 0),
(6, 'yrdy', '3fc5106a294120a6914a015824101528c2e04715c1649b6b93a0961ef0134000', '2025-11-15 00:18:26', '2025-11-14 19:53:26', 0),
(8, 'psk', '99e9a365365edb9179ddb62c369243ee8edefdca9ed033feaa08eb8d954e16cb', '2025-11-15 00:33:08', '2025-11-14 20:08:08', 0),
(9, 'psk', 'dba28cb8a5934983749d1f78f393d38695e8259b37ca7c20cbbb2aff464bb529', '2025-11-15 00:33:28', '2025-11-14 20:08:28', 0),
(10, 'psk', '3aae53a2427190d1e8dcaa8fd50f9408420fcf7db1938287793f6394076848eb', '2025-11-15 00:34:18', '2025-11-14 20:09:18', 0),
(11, 'psk', '9af6fd43c14103526e95d5aa9224d460916b1fd5a09183144fc562540c911e43', '2025-11-15 00:34:29', '2025-11-14 20:09:29', 0),
(12, 'psk', 'd6c6be9bfe3b34917cde70f8e9984cbc8c3e677ed9f4d9962bd7dcfca137903e', '2025-11-15 00:37:11', '2025-11-14 20:12:11', 0),
(13, 'psk', 'ee17991dd8ce2fc621f2a7ac388695a0aaf9d7201950859073b7b9d3f3c1cfe5', '2025-11-15 00:38:21', '2025-11-14 20:13:21', 0),
(14, 'test', 'e6d541942e2a62b5db7ca44808fa4b17cf1e4b5d369dd8cf0d22d69b13f6c21e', '2025-11-15 00:40:29', '2025-11-14 20:15:29', 0),
(15, 'test', 'cfd34902deeb6222e0d1c9776c57d9cdddb1a6af441f121df5c3f690ec88a940', '2025-11-15 00:40:57', '2025-11-14 20:15:57', 0),
(16, 'test', '4793a449b4150fb4335de8ace16cc83bc1b77a63fea759075e5ec750ab52ec88', '2025-11-15 00:41:12', '2025-11-14 20:16:12', 0),
(18, 'test', 'ee2c1392045a65eef63e38a61d178868c51c90d4fed65452cc0c1f64f95ccf16', '2025-11-15 00:48:49', '2025-11-14 20:23:49', 0);

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `nm` varchar(20) NOT NULL,
  `surnm` varchar(20) NOT NULL,
  `unm` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pswd` varchar(30) NOT NULL,
  `mo` int(11) NOT NULL,
  `gen` enum('Male','Female','Other') NOT NULL,
  `adrs` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `nm`, `surnm`, `unm`, `email`, `pswd`, `mo`, `gen`, `adrs`) VALUES
(1, 'abc', 'a', 'b', 'c', 'abc', 687688, '', 'mbjaj'),
(2, 'abc', 'abc', 'abc', 'abc', 'abc', 2801909, '', 'abc'),
(3, 'yrdy', 'yrdyd', 'yrdy', 'trdy12@gmail.com', 'test', 1234567890, '', 'test'),
(4, 'parth', 'khokhar', 'psk', 'pkhokhar162@rku.ac.in', 'p12345678', 2147483647, 'Male', 'rajkot'),
(5, 'test', 'test', 'test', 'test1234@gmail.com', 'test', 2147483647, 'Male', 'wr aer ae');

-- --------------------------------------------------------

--
-- Table structure for table `temp`
--

CREATE TABLE `temp` (
  `id` int(11) NOT NULL,
  `img` varchar(500) NOT NULL,
  `nm` varchar(200) NOT NULL,
  `price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `temp`
--

INSERT INTO `temp` (`id`, `img`, `nm`, `price`) VALUES
(9, 'cs_wedding_flower.jpg', 'Flower Decoration', 20000);

-- --------------------------------------------------------

--
-- Table structure for table `wedding`
--

CREATE TABLE `wedding` (
  `id` int(11) NOT NULL,
  `img` varchar(1000) NOT NULL,
  `nm` varchar(200) NOT NULL,
  `price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `wedding`
--

INSERT INTO `wedding` (`id`, `img`, `nm`, `price`) VALUES
(1, 'cs_wedding1.jpg', 'Yellow Rajwadi', 500000),
(5, 'cs_wedding4.jpg', 'Snow white theme', 450000),
(6, 'cs_wedding7 - Copy.jpg', 'Rajwadi theme', 505000),
(7, 'cs_dj-sound.jpg', 'Enjoyment', 5000),
(8, 'cs_wedding_mandap.jpg', 'Wedding mandap', 10000),
(9, 'cs_wedding_flower.jpg', 'Flower Decoration', 20000),
(10, '1795470_933513173385633_6804003732512774959_n.jpg', 'white wedding theme', 480000),
(12, '14191925_1227924543944493_6325969755918013020_n.jpg', 'Red flower decoratio', 460000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anniversary`
--
ALTER TABLE `anniversary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `birthday`
--
ALTER TABLE `birthday`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otherevent`
--
ALTER TABLE `otherevent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp`
--
ALTER TABLE `temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wedding`
--
ALTER TABLE `wedding`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anniversary`
--
ALTER TABLE `anniversary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `birthday`
--
ALTER TABLE `birthday`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `otherevent`
--
ALTER TABLE `otherevent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `temp`
--
ALTER TABLE `temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `wedding`
--
ALTER TABLE `wedding`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
