-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2018 at 10:28 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `UserID` int(30) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `FullName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `UserID` int(30) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `EmailID` varchar(100) NOT NULL,
  `JobTitle` varchar(100) NOT NULL,
  `Salary` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`UserID`, `Password`, `FullName`, `Address`, `EmailID`, `JobTitle`, `Salary`) VALUES
(145255, '145255', 'MS  Dhoni', 'Phoenix, AZ, 401223', 'ms@gmail.com', 'CEO', '400000'),
(1234532, '1234532', 'Steve Smith', 'Chicago, Il, 60176', 'stevesmith@gmail.com', 'Supervisor', '160000'),
(1543212, '1543212', 'Rohit Sharma', 'Northbook, IL , 60180', 'rohitsharma@gmail.com', 'Supervisor', '176000'),
(1678345, '1678345', 'Annie Leblanc', 'Cuppertino, California, SF, 56743', 'annieleblanc@gmail.com', 'Quality Assurance Engineer', '67000'),
(1735772, '1735772', 'Ruhi Sharma', 'Naperville, IL, 60175', 'ruhisharma@gmaiil.com', 'Supervisor', '140000'),
(1834535, '1834535', 'Komal Thakkar', 'NIU, Delakb, IL, 60189', 'komalthakkar@gmail.com', 'Software Developer', '90000'),
(1834678, '1834678', 'Keerthi Sai', 'Weeling, Il, 60165', 'keerthisai@gmail.com', 'Software Developer', '80000'),
(1835791, '1835791', 'Priya Mukherjee', 'Thornhill Dr, Carol Stream, IL, 60188', 'priyamukherjee@gmail.com', 'Software Developer', '70000'),
(1875643, '1875643', 'John Bolton', 'San Jose, California, 54636', 'johnbolton@gmail.com', 'Test Engineer', '65000');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `ProjectID` int(30) NOT NULL,
  `ProjectTitle` varchar(100) NOT NULL,
  `Budget` int(30) NOT NULL,
  `CustomerName` varchar(255) NOT NULL,
  `SupervisorID` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`ProjectID`, `ProjectTitle`, `Budget`, `CustomerName`, `SupervisorID`) VALUES
(100001, 'Billing System', 400000, 'Best Buy', 1234532),
(100002, 'Ipstack Maintaintence', 500000, 'Cisco', 1735772),
(100003, 'Speciality Pharma', 500000, 'CVS', 1543212),
(100004, 'Claim Automation', 600000, 'Aetna', 1234532);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `UserID` int(30) NOT NULL,
  `ProjectID` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`UserID`, `ProjectID`) VALUES
(145255, 100003),
(1678345, 100003),
(1834535, 100001),
(1834535, 100003),
(1834678, 100003),
(1835791, 100001);

-- --------------------------------------------------------

--
-- Table structure for table `timesheet`
--

CREATE TABLE `timesheet` (
  `UserID` int(30) NOT NULL,
  `ProjectID` int(30) NOT NULL,
  `Date` date NOT NULL,
  `StartTime` time NOT NULL,
  `EndTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`UserID`);

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
  ADD PRIMARY KEY (`UserID`,`ProjectID`),
  ADD KEY `ProjectID` (`ProjectID`);

--
-- Constraints for dumped tables
--

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
