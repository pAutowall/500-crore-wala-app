-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2022 at 10:46 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loginsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `foodId` int(11) NOT NULL,
  `donorId` int(11) NOT NULL,
  `foodDetails` text DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `expiry` bigint(20) DEFAULT NULL,
  `requestType` text DEFAULT NULL,
  `foodDisplayId` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`foodId`, `donorId`, `foodDetails`, `location`, `expiry`, `requestType`, `foodDisplayId`) VALUES
(2, 1, 'Test food details', '22.4600098,88.3821707', 2147483647, NULL, '3BU-SWI-NJX'),
(3, 1, 'Test food details', '22.4600098,88.3821707', 1652113664728, NULL, '9ZX-SWI-NJO'),
(4, 5, 'new sdexcp', '22.4600098,88.3821707', 1652114616666, NULL, NULL),
(5, 5, 'new dlkjsd', '22.4600098,88.3821707', NULL, 'reciever', NULL),
(6, 5, 'saxgasgsgsg', '22.4600098,88.3821707', 1652058000, 'donor', NULL),
(7, 5, 'saxgasgsgsg', '22.4600098,88.3821707', 1652058000, 'donor', NULL),
(8, 5, 'test', '22.4600098,88.3821707', 1652166000, 'donor', NULL),
(14, 1, 'safasf', '22.4600098,88.3821707', 1651524600, 'donor', '3BU-SWI-NJM'),
(15, 5, 'hekuoeydj', '22.4600098,88.3821707', 54465465654, 'reciever', 'ZD7-5ZG-PWZ'),
(16, 5, 'dgjdgj', '22.4600098,88.3821707', NULL, 'reciever', 'C6Q-H42-VV6'),
(17, 6, 'Not edited at all', '22.4600098,88.3821707', NULL, 'reciever', 'VCY-WND-5ZA');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `requestId` int(11) NOT NULL,
  `foodId` int(11) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `requestorId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`requestId`, `foodId`, `details`, `status`, `requestorId`) VALUES
(1, 17, 'Test request<br>new line', 1, 5),
(2, 14, 'test message', 0, 5),
(3, 3, 'test apply hek', 0, 5),
(5, 2, 'test app hek', 0, 5),
(6, 3, 'Test request<br>new line', 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tracking`
--

CREATE TABLE `tracking` (
  `requestId` int(11) NOT NULL,
  `trackingLink` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tracking`
--

INSERT INTO `tracking` (`requestId`, `trackingLink`) VALUES
(1, 'https://glympse.com/0WMM-HW5N');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `pfp` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `pfp`) VALUES
(1, 'Bogesh', 'yogesh12@gmail.com', '123456', NULL),
(3, 'CHAD POGRAMMER', 'bsdk@gmail.com', '123456', NULL),
(4, 'Yogesh6', 'yogesh@gmail.com', '123456', NULL),
(5, 'Shounak Ghosh', 'test@test.com', '123456', 'account-planning-module-for-perfex-crm-logo.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`foodId`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`requestId`),
  ADD KEY `foodId` (`foodId`);

--
-- Indexes for table `tracking`
--
ALTER TABLE `tracking`
  ADD KEY `requestId` (`requestId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `foodId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `requestId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`foodId`) REFERENCES `food` (`foodId`);

--
-- Constraints for table `tracking`
--
ALTER TABLE `tracking`
  ADD CONSTRAINT `tracking_ibfk_1` FOREIGN KEY (`requestId`) REFERENCES `requests` (`requestId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
