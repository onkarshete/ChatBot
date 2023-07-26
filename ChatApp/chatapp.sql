-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2022 at 03:03 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chatapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `bus_commands`
--

CREATE TABLE `bus_commands` (
  `id` int(10) NOT NULL,
  `command_msg` text NOT NULL,
  `command_reply` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bus_commands`
--

INSERT INTO `bus_commands` (`id`, `command_msg`, `command_reply`) VALUES
(1, '00', '1. Get Bus TimeTable<br>2. Book Ticket<br>50. Grievance<br>97. Clear Chat<br>98. Talk with Customer Care<br>00. Main Menu<br>99. Exit<br>'),
(2, '1', '11. Pune<br>12. Nashik<br>13. Mumbai<br>14. Nagpur<br>15. Amravati<br>'),
(3, '11', 'Pune to Washim (06:30)<br>Pune to Nashik (02:00,10:00,14:15)<br>Pune to Mumbai (07:00,12:00,15:15)<br>Pune to Kothrud (08:00,11:45)<br>Pune to Karjat (09:00)<br>00. Main Menu <br>99. Exit<br>'),
(4, '12', 'Nashik to Pune (06:30,10:00,14:15)<br>Nashik to Karjat (12:10)<br>Nashik to Thane (06:10,11:30)<br>Nashik to Solapur (16:15)<br>Nashik to Akola (15:00,20:15)<br>00. Main Menu <br>99. Exit<br>'),
(5, '13', 'Mumbai to Pune (06:30,10:00,14:15)<br>Mumbai to Beed (12:10)<br>Mumbai to Kothrud (06:10,14:30)<br>Mumbai to Solapur (16:15)<br>Mumbai to Nashik(12:00,20:15)<br>00. Main Menu <br>99. Exit<br>'),
(6, '14', 'Nagpur to Pune (07:30,11:00)<br>Nagpur to Beed (09:10,13:05)<br>Nagpur to Kothrud (06:10,14:30)<br>Nagpur to Solapur (14:15)<br>Nagpur to Nashik(10:00,20:15)<br>00. Main Menu <br>99. Exit<br>'),
(7, '15', 'Amravati to Washim (07:30)<br>Amravati to Nashik (02:00,15:15)<br>Amravati to Mumbai (07:00,15:15)<br>Amravati to Pune (08:00,11:45)<br>Amravati to Karjat (09:00,12:00)<br>00. Main Menu <br>99. Exit<br>'),
(8, '2', '<a href=\"https://msrtc.maharashtra.gov.in/\" target=\"_blank\">MSRTC</a><br><a href=\"https://www.makemytrip.com/bus-tickets/\" target=\"_blank\">Make My Trip</a><br><a href=\"https://busandticket.com/\" target=\"_blank\">Bus And Ticket</a><br><a href=\"https://m.redbus.in/\" target=\"_blank\">Red Bus</a><br>00. Main Menu <br>99. Exit<br>'),
(9, '98', 'Our Service Provider Contact You Shortly...'),
(10, '99', 'Thanks For Contacting....'),
(11, '50', '51. New Grivience<br>52. See Grivience Status'),
(12, '52', 'Your Previous Grievances are:'),
(13, '51', 'Enter Details About Problem');

-- --------------------------------------------------------

--
-- Table structure for table `grievances`
--

CREATE TABLE `grievances` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `griv_msg` text NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grievances`
--

INSERT INTO `grievances` (`id`, `service_id`, `user_id`, `griv_msg`, `status`) VALUES
(24, 521535301, 100, 'Test', 'Solved'),
(65, 654490014, 100, 'Test', 'Solved');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `msg_type` varchar(10) NOT NULL,
  `msg_time` datetime NOT NULL,
  `msg_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`, `msg_type`, `msg_time`, `msg_status`) VALUES
(788, 550338353, 521535301, 'Welcome To Our Service', 'text', '2022-06-29 18:30:06', 1),
(792, 550338353, 654490014, 'Welcome To Our Service', 'text', '2022-06-29 18:30:20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `railway_commands`
--

CREATE TABLE `railway_commands` (
  `id` int(10) NOT NULL,
  `command_msg` text NOT NULL,
  `command_reply` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `railway_commands`
--

INSERT INTO `railway_commands` (`id`, `command_msg`, `command_reply`) VALUES
(1, '00', '1. Get Train TimeTable<br>2. Book Ticket<br>3. Get Reservation Status<br>50. Grievance<br>97. Clear Chat<br>98. Talk with Service Provider<br>00. Main Menu <br>99. Exit<br>'),
(2, '1', '11. Pune<br>12. Nashik<br>13. Mumbai<br>14. Nagpur<br>15. Amravati<br>'),
(3, '11', 'Pune to Washim (06:30)<br>Pune to Nashik (02:00,10:00,14:15)<br>Pune to Mumbai (07:00,12:00,15:15)<br>Pune to Kothrud (08:00,11:45)<br>Pune to Karjat (09:00)<br>00. Main Menu <br>99. Exit<br>'),
(4, '12', 'Nashik to Karjat (12:10)<br>Nashik to Thane (06:10,11:30)<br>Nashik to Solapur (16:15)<br>Nashik to Akola (15:00,20:15)<br>00. Main Menu <br>99. Exit<br>'),
(5, '13', 'Mumbai to Pune (06:30,10:00,14:15)<br>Mumbai to Beed (12:10)<br>Mumbai to Kothrud (06:10,14:30)<br>Mumbai to Solapur (16:15)<br>Mumbai to Nashik(12:00,20:15)<br>00. Main Menu <br>99. Exit<br>'),
(6, '14', 'Nagpur to Pune (07:30,11:00)<br>Nagpur to Beed (09:10,13:05)<br>Nagpur to Kothrud (06:10,14:30)<br>Nagpur to Solapur (14:15)<br>Nagpur to Nashik(10:00,20:15)<br>00. Main Menu <br>99. Exit<br>'),
(7, '15', 'Amravati to Washim (07:30)<br>Amravati to Nashik (02:00,15:15)<br>Amravati to Mumbai (07:00,15:15)<br>Amravati to Pune (08:00,11:45)<br>Amravati to Karjat (09:00,12:00)<br>00. Main Menu <br>99. Exit<br>'),
(8, '2', '<a class=\"link\" href=\"https://www.irctc.co.in/nget/train-search\" target=\"_blank\">IRCTC eTicketing</a><br><a class=\"link\" href=\"https://www.confirmtkt.com/rbooking-d/\" target=\"_blank\">Confirm Ticket</a><br><a class=\"link\" href=\"https://www.goibibo.com/trains/\" target=\"_blank\">Goibibo Trains</a><br><a class=\"link\" href=\"https://www.trainman.in/\" target=\"_blank\">TrainMan Booking</a><br>00. Main Menu <br>99. Exit<br>'),
(9, '98', 'Our Service Provider Contact You Shortly...'),
(10, '99', 'Thanks For Contacting....'),
(11, '3', 'Try PNR SMS service: SMS \"PNR <10-digit PNR Number>\" to 139 From your registered Mobile Number. For example if your PNR is 1234567890 : type PNR 1234567890 and send it to 139.<br> 00. Main Menu<br>99. Exit'),
(15, '50', '51. New Grivience<br>52. See Grivience Status'),
(16, '52', 'Your Previous Grievances are:'),
(17, '51', 'Enter Details About Problem');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `unique_id` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `about` varchar(30) NOT NULL,
  `last_log` datetime NOT NULL,
  `email_verify` varchar(255) NOT NULL,
  `user_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `fname`, `lname`, `email`, `password`, `img`, `about`, `last_log`, `email_verify`, `user_type`) VALUES
(8, 654490014, 'Bus', 'Transport', 'meghanhart44.2.60222@gmail.com', '362ba93ce9a94d6bc76294ed96d42433', '1651755866download (3).jpg', 'Available', '2022-06-24 01:01:44', '1', 'service'),
(9, 521535301, 'Railway', 'Transport', 'assaultdigi.t.al0538@gmail.com', 'eee9fd550a4d01c79f52db32eec6c88f', '16517560201.jpg', 'Available', '2022-06-29 18:26:15', '1', 'service'),
(18, 550338353, 'Sudheer', 'Hire', 'dorin.eu.lwc.366@gmail.com', '91297a2b4a47fff94672ed78a8fc4da8', '16517574711626850840700.jpg', 'Not Working', '2022-06-29 18:30:22', '1', 'user'),
(23, 764683456, 'Admin', '', 'admin@gmail.com', '75d23af433e0cea4c0e45a56dba18b30', 'Default.png', 'Available', '2022-06-24 01:54:17', '1', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bus_commands`
--
ALTER TABLE `bus_commands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grievances`
--
ALTER TABLE `grievances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `railway_commands`
--
ALTER TABLE `railway_commands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bus_commands`
--
ALTER TABLE `bus_commands`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=793;

--
-- AUTO_INCREMENT for table `railway_commands`
--
ALTER TABLE `railway_commands`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
