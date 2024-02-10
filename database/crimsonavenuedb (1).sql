-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2024 at 03:25 PM
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
-- Database: `crimsonavenuedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `account_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `affiliation` varchar(16) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) NOT NULL,
  `gender` varchar(16) NOT NULL,
  `college_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `contact` varchar(16) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `user_role` int(11) NOT NULL,
  `verification_status` varchar(16) NOT NULL DEFAULT 'Not Verified',
  `restriction_status` varchar(16) NOT NULL DEFAULT 'Unrestricted',
  `is_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_id`, `email`, `password`, `affiliation`, `firstname`, `middlename`, `lastname`, `gender`, `college_id`, `department_id`, `contact`, `address`, `profile_image`, `user_role`, `verification_status`, `restriction_status`, `is_created`, `is_updated`, `is_deleted`) VALUES
(53, 'mrhiraru@gmail.com', '$2y$10$fe966OYQ7YmFUdqsvyGkKeZcius//gAf6rWmqulAODkRbPxUYmMqa', 'Non-student', 'Hilal', 'Jamiruddin', 'Abdulajid', 'Male', NULL, NULL, '09123456789', NULL, NULL, 2, 'Verified', 'Unrestricted', '2024-01-30 02:53:27', '2024-01-30 03:15:14', 0),
(54, 'qb202101164@wmsu.edu.ph', '$2y$10$sMF4Qk8fx0j7AazdOaEqyeQP2qG/O44iapPDWZdM0c3xdo7XJKp0G', 'Student', 'Hilal', 'Jamiruddin', 'Abdulajid', 'Male', 1, 1, '09999999999', NULL, NULL, 0, 'Verified', 'Unrestricted', '2024-01-30 02:53:27', '2024-02-05 04:46:06', 0),
(55, 'moderator@wmsu.edu.ph', 'thisaccountisfortesting', 'Student', 'Mod', 'E', 'Rator', 'Male', 1, 1, '09123456789', NULL, NULL, 1, 'Verified', 'Unrestricted', '2024-02-02 12:39:26', '2024-02-02 12:39:26', 0),
(56, 'moderatora@wmsu.edu.ph', 'thisisatestaaccount', 'Faculty', 'Alexa', 'Bard', 'GPT', 'Other', 3, 2, '09876543211', NULL, NULL, 1, 'Verified', 'Unrestricted', '2024-02-02 13:58:55', '2024-02-02 13:58:55', 0),
(57, 'moderatorb@wmsu.edu.ph', 'thisisatestdummymoderator', 'Faculty', 'Cat', 'FISH', 'Lion', 'Female', 5, NULL, '09999999999', NULL, NULL, 1, 'Verified', 'Unrestricted', '2024-02-02 14:50:53', '2024-02-02 14:52:33', 0),
(60, 'jejemon@gmail.com', '$2y$10$EtgWDCg3fbdbgldBhPCwa.Ek.ynWqiWW2QcGnnZLcHlywjNIS4TS6', 'Non-student', 'Charls', '', 'Pausal', 'Other', NULL, NULL, '09222222222', NULL, NULL, 2, 'Not Verified', 'Unrestricted', '2024-02-03 01:26:54', '2024-02-03 01:26:54', 0),
(61, 'hahaha3@wmsu.edu.ph', '$2y$10$xN44Khf/HZ00/caO7j2XD.IyLybAX72x/A/2elnf8xaZiQTb8kkjq', 'Student', 'Zxc', '', 'Mon', 'Male', 4, 4, '09222222222', NULL, NULL, 2, 'Not Verified', 'Unrestricted', '2024-02-04 12:34:04', '2024-02-04 12:34:04', 0),
(64, 'klaljkasad@gg.com', '$2y$10$ODh03tNx2M/FDXqh7FQ6Auwg.7YxhNX/HejbzfDT6DMQDNqA/ml6m', 'Non-student', 'Zxc', 'Asd', 'Qwe', 'Male', NULL, NULL, '09222222222', NULL, NULL, 2, 'Not Verified', 'Unrestricted', '2024-02-08 03:46:24', '2024-02-08 03:46:24', 0),
(65, '123123@gmail.com', '$2y$10$hj4spYFIOPeJM1LOOcsDW.Z4TXrMeJVvJVIoodpJF5HY2jxjyZBxu', 'Non-student', 'Asdasd', 'Xcvxcv', 'Yukyuky', 'Female', NULL, NULL, '09666666666', NULL, NULL, 1, 'Not Verified', 'Unrestricted', '2024-02-08 15:32:21', '2024-02-08 15:32:21', 0);

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

CREATE TABLE `college` (
  `college_id` int(11) NOT NULL,
  `college_name` varchar(255) NOT NULL,
  `is_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `college`
--

INSERT INTO `college` (`college_id`, `college_name`, `is_created`, `is_updated`, `is_deleted`) VALUES
(1, 'Computing Studies', '2024-02-01 18:21:07', '2024-02-01 18:36:57', 0),
(2, 'Nursing', '2024-02-01 18:21:40', '2024-02-01 18:40:20', 0),
(3, 'Engineering', '2024-02-01 18:49:11', '2024-02-01 18:49:11', 0),
(4, 'Liberal Arts', '2024-02-01 18:50:40', '2024-02-01 19:24:04', 0),
(5, 'Asian and Islamic Studies', '2024-02-02 08:18:43', '2024-02-02 08:18:43', 0),
(6, 'Criminal Justice', '2024-02-02 10:40:42', '2024-02-02 10:40:42', 0),
(7, 'Social Work and Community Development', '2024-02-02 10:54:29', '2024-02-02 10:54:29', 0),
(8, 'Elementary', '2024-02-02 10:59:36', '2024-02-02 10:59:36', 0),
(9, 'Highschool', '2024-02-03 00:15:51', '2024-02-03 00:15:51', 0),
(10, 'Home Economics', '2024-02-03 00:51:11', '2024-02-08 04:56:14', 0);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `college_id` int(11) DEFAULT NULL,
  `department_name` varchar(255) NOT NULL,
  `is_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `college_id`, `department_name`, `is_created`, `is_updated`, `is_deleted`) VALUES
(1, 1, 'Computer Science', '2024-02-02 06:47:48', '2024-02-03 00:06:52', 0),
(2, 3, 'Civil Engineering', '2024-02-02 07:05:47', '2024-02-02 07:05:47', 0),
(3, 1, 'Information Technology', '2024-02-02 07:07:22', '2024-02-02 07:07:22', 0),
(4, 4, 'Political Science', '2024-02-02 07:26:51', '2024-02-02 07:26:51', 0),
(5, 3, 'Electrical Engineering', '2024-02-02 08:07:13', '2024-02-02 12:09:47', 0),
(6, 2, 'Patient', '2024-02-02 08:14:23', '2024-02-03 00:38:39', 0),
(7, 3, 'Mechanical Engineering', '2024-02-02 10:38:29', '2024-02-02 10:38:51', 0),
(8, 3, 'Sanitary Engineering', '2024-02-02 10:39:28', '2024-02-02 10:39:28', 0),
(9, 3, 'Computer Engineering', '2024-02-02 10:39:59', '2024-02-02 10:39:59', 0),
(10, 4, 'Filipino', '2024-02-02 10:44:55', '2024-02-03 00:09:05', 1),
(11, 4, 'Mass Communication', '2024-02-02 10:45:50', '2024-02-02 10:45:50', 0),
(12, 4, 'Philosopy', '2024-02-02 10:48:05', '2024-02-02 10:48:05', 0),
(13, 1, 'Application Development', '2024-02-02 10:51:05', '2024-02-02 10:55:31', 1),
(14, 1, 'Cyber Security', '2024-02-02 10:53:05', '2024-02-02 10:55:10', 0),
(15, 2, 'Ward 10', '2024-02-03 00:03:18', '2024-02-03 00:05:58', 1),
(16, 9, 'Senior High School', '2024-02-03 00:16:07', '2024-02-03 00:16:20', 0),
(17, 10, 'Pera', '2024-02-03 00:51:51', '2024-02-03 00:51:51', 0),
(18, 1, 'Hacking', '2024-02-05 04:49:22', '2024-02-05 04:49:22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `moderator`
--

CREATE TABLE `moderator` (
  `moderator_id` int(11) NOT NULL,
  `college_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `is_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `moderator`
--

INSERT INTO `moderator` (`moderator_id`, `college_id`, `account_id`, `is_created`, `is_updated`, `is_deleted`) VALUES
(1, 4, 55, '2024-02-02 14:04:06', '2024-02-08 04:18:33', 1),
(2, 3, 57, '2024-02-02 14:52:45', '2024-02-08 04:06:38', 1),
(3, 2, 56, '2024-02-08 04:18:49', '2024-02-08 04:43:09', 1),
(5, 3, 57, '2024-02-08 04:19:24', '2024-02-08 04:41:38', 1),
(6, 7, 55, '2024-02-08 04:19:59', '2024-02-08 04:41:03', 1),
(7, 1, 55, '2024-02-08 04:41:51', '2024-02-08 04:41:58', 1),
(8, 1, 55, '2024-02-08 04:43:17', '2024-02-08 04:58:05', 1),
(9, 3, 57, '2024-02-08 04:43:25', '2024-02-08 04:44:59', 1),
(10, 2, 56, '2024-02-08 04:43:34', '2024-02-08 04:43:45', 1),
(11, 10, 56, '2024-02-08 04:48:42', '2024-02-08 11:11:31', 0),
(12, 6, 57, '2024-02-08 04:54:07', '2024-02-08 11:11:19', 0);

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `semester_id` int(11) NOT NULL,
  `semester_number` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`semester_id`, `semester_number`, `start_date`, `end_date`, `status`, `is_deleted`) VALUES
(1, 1, '2024-01-02', '2024-01-03', NULL, 0),
(2, 1, '2024-01-02', '2024-01-03', NULL, 0),
(3, 1, '2024-01-02', '2024-01-03', NULL, 0),
(4, 1, '2024-01-02', '2024-01-25', NULL, 0),
(5, 1, '2024-01-06', '2024-01-08', NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_colacc` (`college_id`),
  ADD KEY `fk_deptacc` (`department_id`);

--
-- Indexes for table `college`
--
ALTER TABLE `college`
  ADD PRIMARY KEY (`college_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`),
  ADD KEY `fk_coldept` (`college_id`);

--
-- Indexes for table `moderator`
--
ALTER TABLE `moderator`
  ADD PRIMARY KEY (`moderator_id`),
  ADD KEY `fk_colmod` (`college_id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`semester_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `college`
--
ALTER TABLE `college`
  MODIFY `college_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `moderator`
--
ALTER TABLE `moderator`
  MODIFY `moderator_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `semester_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `fk_colacc` FOREIGN KEY (`college_id`) REFERENCES `college` (`college_id`),
  ADD CONSTRAINT `fk_deptacc` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`);

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `fk_coldept` FOREIGN KEY (`college_id`) REFERENCES `college` (`college_id`);

--
-- Constraints for table `moderator`
--
ALTER TABLE `moderator`
  ADD CONSTRAINT `fk_accmod` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`),
  ADD CONSTRAINT `fk_colmod` FOREIGN KEY (`college_id`) REFERENCES `college` (`college_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
