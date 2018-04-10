-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2018 at 08:22 PM
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

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `addEmployeesByProject` (IN `getselectedproj` INT)  BEGIN
	select UserID, FullName, Address, EmailID, JobTitle from employee where UserID not in (select UserID from team where ProjectID = getselectedproj);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `generateReport` (IN `getselectedproj` INT, IN `getreporttype` INT, IN `getstartdate` DATE, IN `getenddate` DATE)  NO SQL
BEGIN
	set @sqlQuery = "select *, TIME_FORMAT(ts.StartTime, '%h:%i %p') as StartTime, TIME_FORMAT(ts.EndTime, '%h:%i %p') as EndTime, TIME_FORMAT(TIMEDIFF(ts.EndTime,ts.StartTime), '%H:%i') as HoursWorked from timesheet ts inner join employee e on ts.UserID = e.UserID inner join project p on ts.ProjectID = p.ProjectID where ts.ProjectID = ";
    
    set @sqlQuery = concat(@sqlQuery, getselectedproj);
    
    CASE getreporttype
     WHEN 1 THEN set @sqlQuery = concat(@sqlQuery, " and ts.Date = CURDATE();"); 
     WHEN 2 THEN set @sqlQuery = concat(@sqlQuery,  "  and ts.Date between DATE_SUB(CURDATE(),INTERVAL(WEEKDAY(CURDATE()))DAY) and CURDATE( ); ");
     WHEN 3 THEN set @sqlQuery = concat(@sqlQuery, " and ts.Date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH);");
	  WHEN 4 THEN 
       set @sqlQuery = concat(@sqlQuery, " and ts.Date >= DATE('",
       getstartdate, "') and ts.Date <= DATE('", getenddate, "');");
      ELSE
      BEGIN
      END;
    END CASE; 
    
    PREPARE stmt FROM @sqlQuery;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
                           
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertEmployeeIntoTeam` (IN `SelectedUserID` INT(30), IN `ProjectID` INT(30))  BEGIN
	insert into team (UserID, ProjectID) values(SelectedUserID, ProjectID);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `mpSelectEmployee` ()  BEGIN
   	select UserID, FullName from employee where JobTitle != "Supervisor";
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `mpSelectEmpProj` ()  BEGIN
	select e.UserID, e.FullName, t.ProjectID from employee e inner join team t on e.UserID = t.UserID where e.Role != 2;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `mpSelectProject` ()  BEGIN
	(select p.ProjectID, p.ProjectTitle, p.SupervisorID, e.Fullname as SupervisorName, p.Budget, p.CustomerName from Project p inner join employee e on p.SupervisorID = e.UserID)
UNION 
(select ProjectID, ProjectTitle, "Not Assigned" as SupervisorID , "Not Assigned" as SupervisorName, Budget, CustomerName from Project where SupervisorID = 0);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `mpSelectSupervisor` ()  BEGIN
   	select UserID, FullName from employee where Role = 2;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectProjBySupervisor` (IN `loggedInUser` INT(30))  BEGIN
	select * from project where SupervisorID = loggedInUser;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `showEmployeesByProject` (IN `getselectedproj` INT)  BEGIN
	select t.UserID, e.FullName, e.Address, e.EmailID, e.JobTitle from team t inner join employee e on t.UserID = e.UserID where t.ProjectID = getselectedproj;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `showProjectDetails` (IN `getselectedproj` INT)  BEGIN
	select * from project where ProjectID = getselectedproj;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `viewEmployeeTimesheet` (IN `loggedInUser` INT)  BEGIN
	
	
	set @sqlQuery = "select *, DATE_FORMAT(ts.Date, '%m/%d/%Y') as DateFormatted, TIME_FORMAT(ts.StartTime, '%h:%i %p') as StartTimeFormatted, TIME_FORMAT(ts.EndTime, '%h:%i %p') as EndTimeFormatted, TIME_FORMAT(TIMEDIFF(ts.EndTime,ts.StartTime), '%H:%i') as HoursWorked from timesheet ts inner join project p on ts.ProjectID = p.ProjectID ";
    
    IF (loggedInUser <> 0)
    THEN
    	set @sqlQuery = CONCAT(@sqlQuery,'where UserID = ', loggedInUser, ';');
    ELSE
    	set @sqlQuery = CONCAT(@sqlQuery,'inner join employee e on e.UserID=ts.UserID;');
    END IF;
    PREPARE stmt FROM @sqlQuery;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `viewProjects` (IN `loggedInUser` INT(30))  BEGIN
	select t.ProjectID, p.ProjectTitle from team t inner join project p on t.ProjectID = p.ProjectID where UserID = loggedInUser;
END$$

DELIMITER ;

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
(1875643, '1875643', 'John Bolton', 'San Jose, California, 54636', 'johnbolton@gmail.com', 'Test Engineer', '65000', 2, NULL, NULL, NULL),
(1875644, '$2y$10$DfqPkf09pZ0hgxbVwe08ouk.yLMOjmEOZqmeiCrartVZzNvmlvK6C', 'Olivia', 'California', 'olivia@gmail.com', 'Administrator', '90000', 1, 'p3RP1JCn7FLzsjKGwUZcnwwiVU0EjjYqxlpX7KZ7ASR14oueuvTiClcaZc9W', NULL, NULL),
(1875645, '$2y$10$wqp7zyNdF1lsfVoaG8JtrOw1xmAOBw3nQEBl4AMxJHcqAI88XPaQG', 'Keerthi Sai', 'Weeling, Il, 60165', 'keerthisai@gmail.com', 'Software Engineer', '90000', 2, 'ahr3m5RrOlaw2yHw3F7eGpam2a6ZlxSDEceIJbbEqv1O75Y6zEcnI6r7FSJq', NULL, NULL),
(1875646, '$2y$10$iTAAgFaxD.xc/y/epUccNuD5TwRuJtqx6MfVhEeivYUt1Ou2S9SHK', 'Peter Pan', 'Tempe, Arizona, 41827', 'peterpan@gmail.com', 'Network Engineer', '80000', 3, 'AqJKGzYvXMsoVyqj5ryAwSg92WJ7hmwDzE7YJziWIACWMgshUEYrZVdtc0wP', NULL, NULL);

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
(100001, 'Billing System', 400000, 'Best Buy', 1875645, '2018-04-02 17:01:48'),
(100002, 'Ipstack Maintaintence', 500000, 'Cisco', 1875645, '2018-04-09 00:18:01'),
(100003, 'Speciality Pharma', 500000, 'CVS', 0, NULL),
(100004, 'Claim Automation', 600000, 'Aetna', 1875643, '2018-04-09 00:17:10'),
(100005, 'Patient Enrollment', 700000, 'Walgreens', 1875643, NULL);

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
(1543212, 100002, NULL),
(1678345, 100001, NULL),
(1678345, 100002, NULL),
(1678345, 100003, NULL),
(1678345, 100004, NULL),
(1735772, 100001, NULL),
(1735772, 100002, NULL),
(1735772, 100003, NULL),
(1735772, 100005, NULL),
(1735987, 100001, NULL),
(1735987, 100002, NULL),
(1735987, 100003, NULL),
(1735987, 100005, NULL),
(1834535, 100005, NULL),
(1835791, 100001, NULL),
(1835791, 100004, NULL),
(1835791, 100005, NULL),
(1875646, 100001, NULL);

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
(1678345, 100001, '2018-04-06', '09:15:00', '17:30:00', NULL),
(1678345, 100002, '2018-03-15', '09:30:00', '17:00:00', NULL),
(1834535, 100001, '2018-04-03', '09:30:00', '17:00:00', NULL),
(1834535, 100002, '2018-03-31', '14:30:00', '17:15:00', '2018-04-09 02:11:57'),
(1875646, 100001, '2018-04-08', '09:30:00', '17:30:00', NULL);

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
  ADD PRIMARY KEY (`UserID`,`ProjectID`),
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
  MODIFY `UserID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1875647;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `ProjectID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100006;

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
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`Role`) REFERENCES `user_role` (`id`);

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
