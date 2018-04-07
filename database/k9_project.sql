-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2018 at 04:59 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `k9_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `UserID` int(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `EmailID` varchar(100) NOT NULL,
  `JobTitle` varchar(100) NOT NULL,
  `Salary` varchar(30) NOT NULL,
  `Role` int(10) NOT NULL DEFAULT '3',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`UserID`, `password`, `FullName`, `Address`, `EmailID`, `JobTitle`, `Salary`, `Role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1543212, '1543212', 'Jon Smith', 'Northbrook, IL, 60286', 'jonsmith@gmail.com', 'Scrum Master', '140000', 3, NULL, NULL, NULL),
(1678345, '1678345', 'Annie Leblanc', 'Cuppertino, California, SF, 56743', 'annieleblanc@gmail.com', 'Quality Assurance Engineer', '67000', 3, NULL, NULL, NULL),
(1735772, '1735772', 'Ruhi Sharma', 'Naperville, IL, 60175', 'ruhisharma@gmaiil.com', 'Business Analyst', '140000', 3, NULL, NULL, NULL),
(1735987, '1735987', 'Bill Anderson', '155 W 68th St, New York, NY 10023', 'billanderson@gmail.com', 'Technical Support', '110000', 3, NULL, NULL, NULL),
(1834535, '$2y$10$2Ll4yMhw.2YDQggDgIi5qONzrla4aXzTZNPLbtkZNocmXhDS.J.P2', 'Komal Thakkar', 'DeKalb', 'komalthakkar30@yahoo.in', 'Software Developer', '90000', 3, 'NGvjBKwP1qvN8NzkDtFmO6UxqDJOOtUHnqpB21YBFEOCoxiGnVpIi1n2e1Ru', NULL, NULL),
(1835791, '1835791', 'Priya Mukherjee', 'Thornhill Dr, Carol Stream, IL, 60188', 'priyamukherjee@gmail.com', 'Software Developer', '70000', 3, NULL, NULL, NULL),
(1875643, '1875643', 'John Bolton', 'San Jose, California, 54636', 'johnbolton@gmail.com', 'Test Engineer', '65000', 3, NULL, NULL, NULL),
(1875644, '$2y$10$DfqPkf09pZ0hgxbVwe08ouk.yLMOjmEOZqmeiCrartVZzNvmlvK6C', 'Olivia', 'California', 'olivia@gmail.com', 'Administrator', '90000', 1, 'rqfjop3nOmPdpeJixptdVDSTzCOUhuZnf027j00I55MgqPBR0K3aocHW1yzM', NULL, NULL),
(1875645, '$2y$10$wqp7zyNdF1lsfVoaG8JtrOw1xmAOBw3nQEBl4AMxJHcqAI88XPaQG', 'Keerthi Sai', 'Weeling, Il, 60165', 'keerthisai@gmail.com', 'Software Engineer', '90000', 2, 'TvFMwIpKoJkU2mDjorsfKLdFWNu6S2wNwHzYfg1U58EYOjxY5NdNWfElp7S7', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `ProjectID` int(30) NOT NULL,
  `ProjectTitle` varchar(100) NOT NULL,
  `Budget` int(30) NOT NULL,
  `CustomerName` varchar(255) NOT NULL,
  `SupervisorID` int(30) DEFAULT NULL,
  `updated_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`ProjectID`, `ProjectTitle`, `Budget`, `CustomerName`, `SupervisorID`, `updated_at`) VALUES
(100001, 'Billing System', 400000, 'Best Buy', 0, '2018-04-02 17:01:48'),
(100002, 'Ipstack Maintaintence', 500000, 'Cisco', 1875645, '2018-04-01 21:44:33'),
(100003, 'Speciality Pharma', 500000, 'CVS', 0, NULL),
(100004, 'Claim Automation', 600000, 'Aetna', 0, '2018-03-31 23:21:22');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `UserID` int(30) NOT NULL,
  `ProjectID` int(30) NOT NULL,
  `updated_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`UserID`, `ProjectID`, `updated_at`) VALUES
(1543212, 100001, NULL),
(1678345, 100001, NULL),
(1678345, 100002, NULL),
(1678345, 100003, NULL),
(1735772, 100001, NULL),
(1735772, 100002, NULL),
(1735772, 100003, NULL),
(1735987, 100001, NULL),
(1735987, 100002, NULL),
(1735987, 100003, NULL),
(1835791, 100001, NULL),
(1835791, 100002, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `timesheet`
--

CREATE TABLE `timesheet` (
  `UserID` int(30) NOT NULL,
  `ProjectID` int(30) NOT NULL,
  `Date` date NOT NULL,
  `StartTime` time NOT NULL,
  `EndTime` time NOT NULL,
  `updated_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timesheet`
--

INSERT INTO `timesheet` (`UserID`, `ProjectID`, `Date`, `StartTime`, `EndTime`, `updated_at`) VALUES
(1678345, 100002, '2018-03-15', '09:30:00', '17:00:00', NULL),
(1678345, 100003, '2018-03-30', '09:15:00', '17:30:00', NULL),
(1834535, 100001, '2018-04-03', '09:30:00', '17:00:00', NULL),
(1834535, 100002, '2018-04-02', '14:30:00', '16:45:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(10) NOT NULL,
  `roleName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `roleName`) VALUES
(1, 'Administrator'),
(2, 'Supervisor'),
(3, 'Employee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`UserID`),
  ADD KEY `employee_ibfk_1` (`Role`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`ProjectID`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`UserID`,`ProjectID`),
  ADD KEY `ProjectID` (`ProjectID`);

--
-- Indexes for table `timesheet`
--
ALTER TABLE `timesheet`
  ADD PRIMARY KEY (`UserID`,`ProjectID`, `Date`),
  ADD KEY `ProjectID` (`ProjectID`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `UserID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1875646;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `ProjectID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100005;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`role`) REFERENCES `user_role` (`id`);

--
-- Constraints for table `team`
--
ALTER TABLE `team`
  ADD CONSTRAINT `team_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `employee` (`UserID`),
  ADD CONSTRAINT `team_ibfk_2` FOREIGN KEY (`ProjectID`) REFERENCES `project` (`ProjectID`);

--
-- Constraints for table `timesheet`
--
ALTER TABLE `timesheet`
  ADD CONSTRAINT `timesheet_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `employee` (`UserID`),
  ADD CONSTRAINT `timesheet_ibfk_2` FOREIGN KEY (`ProjectID`) REFERENCES `project` (`ProjectID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
