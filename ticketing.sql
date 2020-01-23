-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2019 at 05:45 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ticketing`
--

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `agent_id` int(11) NOT NULL,
  `f_name` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL,
  `l_name` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL,
  `phone_number` varchar(15) COLLATE utf8mb4_persian_ci NOT NULL,
  `mail` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `management_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`agent_id`, `f_name`, `l_name`, `phone_number`, `mail`, `password`, `active`, `management_id`) VALUES
(1, 'deaa', 'roos', '09123', 'droos@gmail.com', '123123', 1, 1),
(2, 'esmaeil', 'kaboosi', '123', 'eskab@gmail.com', '123', 1, 1),
(3, 'ali', 'q', '9393', 'aliq@gmail.com', '123456', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `apply_answer`
--

CREATE TABLE `apply_answer` (
  `apply_answer_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `text` varchar(1000) COLLATE utf8mb4_persian_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `apply_answer`
--

INSERT INTO `apply_answer` (`apply_answer_id`, `ticket_id`, `agent_id`, `text`, `date`) VALUES
(7, 6, 2, 'hellloo', '2019-12-07 22:07:03'),
(8, 2, 2, 'OKKK', '2019-12-07 22:21:41'),
(9, 8, 3, 'yeaaaahhh', '2019-12-07 22:46:54'),
(10, 2, 2, 'یشیش', '2019-12-07 23:51:50'),
(11, 9, 1, 'soooo bad ', '2019-12-07 23:54:11'),
(12, 10, 1, 'deaa', '2019-12-08 06:26:35'),
(13, 11, 1, 'HGCHJGFJ', '2019-12-08 06:51:37');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `f_name` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL,
  `l_name` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL,
  `phone_number` varchar(15) COLLATE utf8mb4_persian_ci NOT NULL,
  `mail` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL,
  `activity_time` date DEFAULT NULL,
  `password` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `management_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `f_name`, `l_name`, `phone_number`, `mail`, `activity_time`, `password`, `active`, `management_id`) VALUES
(1, 'hossien', 'salamhe', '123', 'hs@gmail.com', NULL, '123123', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `distribution_ticket`
--

CREATE TABLE `distribution_ticket` (
  `ticket_id` int(11) NOT NULL,
  `distributor_id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `distribution_ticket`
--

INSERT INTO `distribution_ticket` (`ticket_id`, `distributor_id`, `agent_id`, `date`) VALUES
(1, 1, 1, '0000-00-00 00:00:00'),
(2, 1, 2, '2019-11-24 15:27:43'),
(3, 1, 1, '2019-11-24 15:47:40'),
(4, 2, 2, '2019-12-07 20:51:41');

-- --------------------------------------------------------

--
-- Table structure for table `distributors`
--

CREATE TABLE `distributors` (
  `distributor_id` int(11) NOT NULL,
  `f_name` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL,
  `l_name` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL,
  `phone_number` varchar(15) COLLATE utf8mb4_persian_ci NOT NULL,
  `mail` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `management_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `distributors`
--

INSERT INTO `distributors` (`distributor_id`, `f_name`, `l_name`, `phone_number`, `mail`, `password`, `active`, `management_id`) VALUES
(1, 'fadel', 'sy', '12', 'fs@gmail.com', '123123', 1, 1),
(2, 'emad', 'emadi', '989', 'emad@gmail.com', '123', 1, 1),
(3, 'azize', 'moho', '123', 'mohoazez@bat.com', '123', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `managements`
--

CREATE TABLE `managements` (
  `management_id` int(11) NOT NULL,
  `f_name` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL,
  `l_name` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL,
  `phone_number` varchar(15) COLLATE utf8mb4_persian_ci NOT NULL,
  `mail` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `receive`
--

CREATE TABLE `receive` (
  `distributor_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `receive_ticket`
--

CREATE TABLE `receive_ticket` (
  `customer_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `return_ticket`
--

CREATE TABLE `return_ticket` (
  `ticket_id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `distributor_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `comment` varchar(100) COLLATE utf8mb4_persian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `send`
--

CREATE TABLE `send` (
  `customer_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `text` varchar(1000) COLLATE utf8mb4_persian_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(11) NOT NULL,
  `date` timestamp NULL DEFAULT current_timestamp(),
  `file` varchar(200) COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `level_tic` int(11) NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL,
  `text` varchar(200) COLLATE utf8mb4_persian_ci NOT NULL,
  `comment` varchar(200) COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `ticket_reply_id` int(11) DEFAULT NULL,
  `management_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `date`, `file`, `level_tic`, `type`, `text`, `comment`, `customer_id`, `ticket_reply_id`, `management_id`) VALUES
(1, '2019-11-22 23:16:55', '', 1, 'فنی', 'the ticket\r\ni sent', 'as', 1, NULL, NULL),
(2, '2019-11-22 23:17:07', '', 1, 'مالی', 'the ticket\r\ni sent', 'comment 4 2', 1, NULL, NULL),
(3, '2019-11-24 15:28:13', '', 1, '1', 'متن تیکت', 'commmentttttttttttt', 1, NULL, NULL),
(8, '2019-12-07 22:45:24', '', 1, 'Technical', 'i have techhh', 'whats up man ', 1, NULL, NULL),
(9, '2019-12-07 23:52:34', '', 3, 'Payment', 'how are you ', 'hiiii', 1, NULL, NULL),
(10, '2019-12-08 06:25:42', '', 1, 'Technical', 'azrzi', 'ffff', 1, NULL, NULL),
(11, '2019-12-08 06:48:13', '', 2, 'Other', 'FGDHCHGHJ', 'DEAA', 1, NULL, NULL),
(12, '2019-12-13 12:27:05', '', 1, 'Technical', 'deaaa\r\n', NULL, 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`agent_id`);

--
-- Indexes for table `apply_answer`
--
ALTER TABLE `apply_answer`
  ADD PRIMARY KEY (`apply_answer_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `distributors`
--
ALTER TABLE `distributors`
  ADD PRIMARY KEY (`distributor_id`);

--
-- Indexes for table `managements`
--
ALTER TABLE `managements`
  ADD PRIMARY KEY (`management_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `agent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `apply_answer`
--
ALTER TABLE `apply_answer`
  MODIFY `apply_answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `distributors`
--
ALTER TABLE `distributors`
  MODIFY `distributor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `managements`
--
ALTER TABLE `managements`
  MODIFY `management_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
