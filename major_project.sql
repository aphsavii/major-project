-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2023 at 05:30 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `major_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`username`, `password`) VALUES
('admin', 'admin@123'),
('jc mess', '123');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `regno` int(11) UNSIGNED NOT NULL,
  `complaint` varchar(500) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `credentials`
--

CREATE TABLE `credentials` (
  `username` int(11) UNSIGNED NOT NULL,
  `password` varchar(45) NOT NULL,
  `signup time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `credentials`
--

INSERT INTO `credentials` (`username`, `password`, `signup time`) VALUES
(2010214, '214', '2023-04-04 12:11:03'),
(2010215, '215', '2023-04-14 22:21:59'),
(2010233, '233', '2023-04-08 21:55:58');

-- --------------------------------------------------------

--
-- Table structure for table `granted_rebates`
--

CREATE TABLE `granted_rebates` (
  `regno` int(11) NOT NULL,
  `fromdate` date NOT NULL,
  `todate` date NOT NULL,
  `noofdays` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mess-timing`
--

CREATE TABLE `mess-timing` (
  `open` varchar(10) NOT NULL,
  `close` varchar(10) NOT NULL,
  `type` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mess-timing`
--

INSERT INTO `mess-timing` (`open`, `close`, `type`) VALUES
('7:30 Am', '8:30 Am', 'breakfast'),
('7:30 Pm', '9:00 Pm', 'dinner'),
('12:30 Pm', '2:30 Pm', 'lunch');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `regno` int(11) UNSIGNED NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rebate`
--

CREATE TABLE `rebate` (
  `regno` int(11) UNSIGNED NOT NULL,
  `january` int(11) NOT NULL,
  `february` int(11) NOT NULL,
  `march` int(11) NOT NULL,
  `april` int(11) NOT NULL,
  `may` int(11) NOT NULL,
  `june` int(11) NOT NULL,
  `july` int(11) NOT NULL,
  `august` int(11) NOT NULL,
  `september` int(11) NOT NULL,
  `october` int(11) NOT NULL,
  `november` int(11) NOT NULL,
  `december` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rebate_requests`
--

CREATE TABLE `rebate_requests` (
  `regno` int(11) UNSIGNED NOT NULL,
  `fromdate` date NOT NULL,
  `todate` date NOT NULL,
  `noofdays` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rebate_status`
--

CREATE TABLE `rebate_status` (
  `regno` int(11) UNSIGNED NOT NULL,
  `fromdate` date NOT NULL,
  `todate` date NOT NULL,
  `noofdays` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `studentslist`
--

CREATE TABLE `studentslist` (
  `regno` int(11) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `trade` varchar(7) NOT NULL,
  `roomno` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studentslist`
--

INSERT INTO `studentslist` (`regno`, `name`, `trade`, `roomno`) VALUES
(2010214, 'Rajnish Raj', 'DCS-CDE', 121),
(2010215, 'Avinash Kumar', 'DCS-CDE', 114),
(2010233, 'Sahil Kumar', 'DCS-CDE', 306);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`regno`);

--
-- Indexes for table `credentials`
--
ALTER TABLE `credentials`
  ADD PRIMARY KEY (`username`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `granted_rebates`
--
ALTER TABLE `granted_rebates`
  ADD PRIMARY KEY (`regno`);

--
-- Indexes for table `mess-timing`
--
ALTER TABLE `mess-timing`
  ADD PRIMARY KEY (`type`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`regno`);

--
-- Indexes for table `rebate`
--
ALTER TABLE `rebate`
  ADD KEY `regno_fk` (`regno`),
  ADD KEY `regno` (`regno`);

--
-- Indexes for table `rebate_requests`
--
ALTER TABLE `rebate_requests`
  ADD PRIMARY KEY (`regno`);

--
-- Indexes for table `rebate_status`
--
ALTER TABLE `rebate_status`
  ADD PRIMARY KEY (`regno`);

--
-- Indexes for table `studentslist`
--
ALTER TABLE `studentslist`
  ADD PRIMARY KEY (`regno`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaints_ibfk_1` FOREIGN KEY (`regno`) REFERENCES `studentslist` (`regno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `credentials`
--
ALTER TABLE `credentials`
  ADD CONSTRAINT `username_fk` FOREIGN KEY (`username`) REFERENCES `studentslist` (`regno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`regno`) REFERENCES `studentslist` (`regno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rebate`
--
ALTER TABLE `rebate`
  ADD CONSTRAINT `regno_fk` FOREIGN KEY (`regno`) REFERENCES `studentslist` (`regno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rebate_requests`
--
ALTER TABLE `rebate_requests`
  ADD CONSTRAINT `rebate_requests_ibfk_1` FOREIGN KEY (`regno`) REFERENCES `studentslist` (`regno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rebate_status`
--
ALTER TABLE `rebate_status`
  ADD CONSTRAINT `rebate_status_ibfk_1` FOREIGN KEY (`regno`) REFERENCES `studentslist` (`regno`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
