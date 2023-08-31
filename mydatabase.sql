-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2023 at 07:37 AM
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
-- Database: `mydatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(2, 'mahederegezaheng@gmail.com', '12121212'),
(10, 'ctvyh@gmail.com', '84954ascasaca');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_type` varchar(10) NOT NULL DEFAULT 'event',
  `event_title` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `event_description` text NOT NULL,
  `event_image` varchar(100) NOT NULL DEFAULT 'uploads/Polygon Luminary.svg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_type`, `event_title`, `event_date`, `event_description`, `event_image`) VALUES
(17, 'news', 'speackeres', '2023-08-22', 'this is the demo provoction \r\n', 'uploads/hero.jpg'),
(18, 'news', 'breaking news', '2023-08-25', 'tommorow is the biggest day of the event get ready', 'uploads/Polygon Luminary.svg'),
(21, 'breaking-n', 'image demo', '2023-02-05', 'news image insert ', 'uploads/harrar.jpeg'),
(23, 'breaking-n', 'the second demo', '2023-08-29', 'dire dawa ', 'uploads/yy.jpg'),
(24, 'breaking-n', 'thisis two demo', '2023-08-23', 'qwooqoq', 'uploads/yy.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `exhibitors`
--

CREATE TABLE `exhibitors` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `section` varchar(255) DEFAULT NULL,
  `mobile_phone` varchar(255) DEFAULT NULL,
  `office_phone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `pobox` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `alternative_person` varchar(255) DEFAULT NULL,
  `payment` varchar(255) DEFAULT NULL,
  `zone` varchar(255) DEFAULT NULL,
  `website` varchar(1000) NOT NULL,
  `booth_option1` varchar(255) DEFAULT NULL,
  `booth_option2` varchar(255) DEFAULT NULL,
  `booth_option3` varchar(255) DEFAULT NULL,
  `total_sqm` varchar(255) DEFAULT NULL,
  `approve` int(1) DEFAULT NULL,
  `method` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exhibitors`
--

INSERT INTO `exhibitors` (`id`, `company_name`, `display_name`, `section`, `mobile_phone`, `office_phone`, `fax`, `pobox`, `email`, `contact_person`, `alternative_person`, `payment`, `zone`, `website`, `booth_option1`, `booth_option2`, `booth_option3`, `total_sqm`, `approve`, `method`) VALUES
(29, 'ict conm', 'vasf', 'Government', '7845613218', '0979089495', '1651svds', '948', 'lelida@gmail.com', 'mahedere', 'gezaheng', 'Cpo', 'green', 'https://miltivrex.com/en/reset-password', '789', '54', '51', '300', 1, ''),
(31, 'zxvzv', 'zxvzvxz', 'Service', '7845613218', '0979089495', 'zxv', 'zxv', 'geza@gmail.com', 'mahedere', 'zxvzx', 'cash', 'zvx', 'https://miltivrex.com/en/reset-password', '789', '4', 'zxv', '100', 0, 'local'),
(32, 'xcvbn', 'vasf', 'Service', '7845613218', '0979089495', '1651svds', '948', 'oct@gmail.com', 'mahedere', 'gezaheng', NULL, 'exrctvybjn', 'https://miltivrex.com/en/reset-password', '789', '4', '51', '100', 0, 'international'),
(33, 'skylink', 'skylink', 'Service', '0944556633', '0988554444', '756', '956', 'mahedere@gmail.com', 'mahedere', 'habib', 'cash', 'green', 'https://miltivrex.com/en/reset-password', '789', '51', '51', '100', 1, 'local');

-- --------------------------------------------------------

--
-- Table structure for table `registor`
--

CREATE TABLE `registor` (
  `id` int(6) UNSIGNED NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `verification_code` varchar(10) NOT NULL,
  `approve` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registor`
--

INSERT INTO `registor` (`id`, `first_name`, `last_name`, `company_name`, `email`, `phone_number`, `verification_code`, `approve`) VALUES
(9, 'ABEL ', 'gezahng', 'SKYLINK', 'geza@gmail.com', '0923422323', '101', 0),
(10, 'ABEL ', 'YIBELU', 'skilink', 'ABEL@GMAIL.COM', '0986656632', '798', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exhibitors`
--
ALTER TABLE `exhibitors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registor`
--
ALTER TABLE `registor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `exhibitors`
--
ALTER TABLE `exhibitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `registor`
--
ALTER TABLE `registor`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
