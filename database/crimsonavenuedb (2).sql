-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2024 at 06:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
(53, 'mrhiraru@gmail.com', '$2y$10$fe966OYQ7YmFUdqsvyGkKeZcius//gAf6rWmqulAODkRbPxUYmMqa', 'Non-student', 'Hilal', 'Jamiruddin', 'Abdulajid', 'Male', NULL, NULL, '09123456789', NULL, NULL, 1, 'Verified', 'Unrestricted', '2024-01-30 02:53:27', '2024-03-21 01:39:54', 0),
(54, 'qb202101164@wmsu.edu.ph', '$2y$10$sMF4Qk8fx0j7AazdOaEqyeQP2qG/O44iapPDWZdM0c3xdo7XJKp0G', 'Student', 'Hilal', 'Jamiruddin', 'Abdulajid', 'Male', 18, 1, '09999999999', NULL, NULL, 0, 'Verified', 'Unrestricted', '2024-01-30 02:53:27', '2024-03-20 17:19:28', 0),
(55, 'moderator@wmsu.edu.ph', 'thisaccountisfortesting', 'Student', 'Mod', 'E', 'Rator', 'Male', 1, 1, '09123456789', NULL, NULL, 1, 'Verified', 'Unrestricted', '2024-02-02 12:39:26', '2024-02-02 12:39:26', 0),
(56, 'moderatora@wmsu.edu.ph', 'thisisatestaaccount', 'Faculty', 'Alexa', 'Bard', 'GPT', 'Other', 3, 2, '09876543211', NULL, NULL, 1, 'Verified', 'Unrestricted', '2024-02-02 13:58:55', '2024-02-12 06:59:20', 0),
(57, 'moderatorb@wmsu.edu.ph', 'thisisatestdummymoderator', 'Faculty', 'Cat', 'FISH', 'Lion', 'Female', 5, NULL, '09999999999', NULL, NULL, 1, 'Verified', 'Unrestricted', '2024-02-02 14:50:53', '2024-02-02 14:52:33', 0),
(60, 'jejemon@gmail.com', '$2y$10$EtgWDCg3fbdbgldBhPCwa.Ek.ynWqiWW2QcGnnZLcHlywjNIS4TS6', 'Non-student', 'Charls', '', 'Pausal', 'Other', NULL, NULL, '09222222222', NULL, NULL, 2, 'Not Verified', 'Unrestricted', '2024-02-03 01:26:54', '2024-02-03 01:26:54', 0),
(61, 'hahaha3@wmsu.edu.ph', '$2y$10$xN44Khf/HZ00/caO7j2XD.IyLybAX72x/A/2elnf8xaZiQTb8kkjq', 'Student', 'Zxc', '', 'Mon', 'Male', 4, 4, '09222222222', NULL, NULL, 2, 'Not Verified', 'Unrestricted', '2024-02-04 12:34:04', '2024-02-04 12:34:04', 0),
(64, 'klaljkasad@gg.com', '$2y$10$ODh03tNx2M/FDXqh7FQ6Auwg.7YxhNX/HejbzfDT6DMQDNqA/ml6m', 'Non-student', 'Zxc', 'Asd', 'Qwe', 'Male', NULL, NULL, '09222222222', NULL, NULL, 2, 'Not Verified', 'Unrestricted', '2024-02-08 03:46:24', '2024-02-08 03:46:24', 0),
(65, '123123@gmail.com', '$2y$10$hj4spYFIOPeJM1LOOcsDW.Z4TXrMeJVvJVIoodpJF5HY2jxjyZBxu', 'Non-student', 'Asdasd', 'Xcvxcv', 'Yukyuky', 'Female', NULL, NULL, '09666666666', NULL, NULL, 1, 'Not Verified', 'Unrestricted', '2024-02-08 15:32:21', '2024-02-10 15:34:21', 0),
(66, 'askdjaksjdh@gmail.com', '$2y$10$lOjxux15cRPnE/P7aOq7sek.S39Yfd0yc9lSm6UkuLoySu0rmf9bK', 'Non-student', 'Jkljkl', 'Jkljkl', 'Jkljkl', 'Female', NULL, NULL, '09888888888', NULL, NULL, 2, 'Not Verified', 'Unrestricted', '2024-02-11 05:59:44', '2024-02-12 09:27:41', 0),
(67, 'dextermanait25@gmail.com', '$2y$10$CfFElr4sIl5AjPRunSN0rOK.SfrgMcO5pc594oyDGck01vhSXLsoy', 'Non-student', 'Dexter', 'Cabatuan', 'Manait', 'Male', NULL, NULL, '09091916246', NULL, NULL, 2, 'Not Verified', 'Unrestricted', '2024-03-11 05:56:34', '2024-03-11 05:56:34', 0),
(68, 'arkeo@gmail.com', '$2y$10$.HhAvUmvSD5eiJkMl2WhEOURoZZZygXaiGZbATgUtECO7luZUWE62', 'Non-student', 'Nisha', 'Shesh', 'Boom panis', 'Male', NULL, NULL, '09091916246', NULL, NULL, 2, 'Not Verified', 'Unrestricted', '2024-03-11 05:58:10', '2024-03-11 05:58:10', 0),
(69, 'qb202100243@wmsu.edu.ph', '$2y$10$jNoLwJTWhRmyVkq4bG1Cee27a3jwflUX3cP.Znbgq4QYDuRGTedyu', 'Non-student', 'Qweqer', 'Werwe', 'Erter', 'Male', NULL, NULL, '09222222222', NULL, NULL, 2, 'Not Verified', 'Unrestricted', '2024-03-13 01:45:11', '2024-03-13 01:45:11', 0),
(70, 'sirjaydee@wmsu.edu.ph', '$2y$10$eMWzttGZQ9xreuD6KBInUeSpWsLAT0OvBrvUnWZu89ZfSpr86ATCS', 'Student', 'Qwe', 'Weqw', 'We', 'Male', 28, NULL, '09222222222', NULL, NULL, 2, 'Not Verified', 'Unrestricted', '2024-03-13 01:59:55', '2024-03-13 01:59:55', 0),
(71, 'qweqwe@wmsu.edu.ph', '$2y$10$SpisZe.1X1WcGgLJ0IeICe0xsfnXkVk5wl.RWH8dWMKbjb2UODf2a', 'Student', 'Qweasd', 'Zxcz', 'Zxc', 'Male', 28, NULL, '09666666666', NULL, NULL, 2, 'Not Verified', 'Unrestricted', '2024-03-13 02:01:56', '2024-03-13 02:01:56', 0),
(72, 'haha@wmsu.edu.ph', '$2y$10$6.7a1Xbz1UR7qcBf8pHXJuy8EpPz7GeT9PGvgaxD8tjlZOyntC2/m', 'Student', 'Qweqwe', 'Qwe', 'Qwqrw', 'Male', 15, NULL, '09444444444', NULL, NULL, 2, 'Not Verified', 'Unrestricted', '2024-03-21 01:34:21', '2024-03-21 01:34:21', 0),
(73, 'imastudent@wmsu.edu.ph', '$2y$10$eqMTJfGj6EK82aB9IxNd2O2xIOzdiUKm/rH5V42ukihpx.kct/qtu', 'Student', 'Testcartfir', 'Testcartmid', 'Testcartlas', 'Female', 23, NULL, '09222222222', NULL, NULL, 2, 'Not Verified', 'Unrestricted', '2024-04-15 16:30:05', '2024-04-15 16:30:05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin_settings`
--

CREATE TABLE `admin_settings` (
  `settings_id` int(11) NOT NULL,
  `commission` int(11) DEFAULT NULL,
  `commission_type` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_settings`
--

INSERT INTO `admin_settings` (`settings_id`, `commission`, `commission_type`) VALUES
(1, 30, 'Percentage');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `is_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `account_id`, `is_created`, `is_updated`, `is_deleted`) VALUES
(1, 73, '2024-04-15 16:30:05', '2024-04-15 16:30:05', 0),
(2, 54, '2024-04-15 16:33:05', '2024-04-15 16:33:05', 0),
(3, 53, '2024-04-15 16:33:11', '2024-04-15 16:33:56', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `cart_item_id` int(11) NOT NULL,
  `cart_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `variation_id` int(11) DEFAULT NULL,
  `measurement_id` int(11) DEFAULT NULL,
  `stock_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `is_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_item`
--

INSERT INTO `cart_item` (`cart_item_id`, `cart_id`, `product_id`, `variation_id`, `measurement_id`, `stock_id`, `quantity`, `is_created`, `is_updated`, `is_deleted`) VALUES
(32, 2, 17, 32, 34, 19, 3, '2024-04-18 23:56:52', '2024-04-18 23:56:52', 0),
(33, 2, 17, 42, 34, 21, 3, '2024-04-18 23:56:58', '2024-04-18 23:56:58', 0),
(34, 2, 17, 43, 36, 26, 4, '2024-04-18 23:57:05', '2024-04-21 09:04:17', 1),
(35, 2, 19, 34, 28, NULL, 13, '2024-04-18 23:59:51', '2024-04-18 23:59:51', 0),
(36, 2, 19, 34, 28, NULL, 1, '2024-04-19 08:13:29', '2024-04-19 08:13:29', 0),
(37, 2, 17, 43, 35, 24, 5, '2024-04-21 07:57:19', '2024-04-21 07:57:19', 0),
(38, 2, 17, 43, 36, 26, 4, '2024-04-21 09:04:30', '2024-04-21 09:04:30', 0),
(39, 2, 17, 43, 36, 35, 4, '2024-04-21 09:39:42', '2024-04-21 09:39:42', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `is_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `is_created`, `is_updated`, `is_deleted`) VALUES
(1, 'Clothing', '2024-02-19 18:48:44', '2024-02-19 18:48:44', 0),
(2, 'Accessories', '2024-02-19 18:52:07', '2024-02-19 18:52:07', 0),
(3, 'Stationery', '2024-02-19 18:57:14', '2024-02-19 18:57:14', 0),
(4, 'Food and Beverages', '2024-02-19 18:57:25', '2024-02-19 18:57:25', 0),
(5, 'Personal Care', '2024-02-19 18:57:35', '2024-02-19 18:57:35', 0),
(6, 'Books and Media', '2024-02-19 18:57:43', '2024-02-19 18:57:43', 0),
(7, 'Others', '2024-02-19 18:57:49', '2024-02-19 18:57:49', 0);

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
(15, 'Agriculture', '2024-03-12 13:45:03', '2024-03-12 13:45:03', 0),
(16, 'Architecture', '2024-03-12 13:45:17', '2024-03-12 13:45:17', 0),
(17, 'Asian and Islamic Studies', '2024-03-12 13:45:28', '2024-03-12 13:45:28', 0),
(18, 'Computing Studies', '2024-03-12 13:45:43', '2024-03-12 13:45:43', 0),
(19, 'Criminal Justice Education', '2024-03-12 13:45:52', '2024-03-12 13:45:52', 0),
(20, 'Engineering', '2024-03-12 13:46:11', '2024-03-12 13:46:11', 0),
(21, 'Forestry and Environmental Studies', '2024-03-12 13:46:27', '2024-03-12 13:46:27', 0),
(22, 'Home Economics', '2024-03-12 13:46:37', '2024-03-12 13:46:37', 0),
(23, 'Law', '2024-03-12 13:46:46', '2024-03-12 13:46:46', 0),
(24, 'Liberal Arts', '2024-03-12 13:47:23', '2024-03-12 13:47:23', 0),
(25, 'Nursing', '2024-03-12 13:47:30', '2024-03-12 13:47:30', 0),
(26, 'Public Administration and Development Justice', '2024-03-12 13:48:10', '2024-03-12 13:48:10', 0),
(27, 'Sport Science and Physical Education', '2024-03-12 13:48:26', '2024-03-12 13:48:26', 0),
(28, 'Science and Mathematics', '2024-03-12 13:48:35', '2024-03-12 13:48:35', 0),
(29, 'Social Work and Community Development', '2024-03-12 13:48:51', '2024-03-12 13:48:51', 0),
(30, 'Teacher Education', '2024-03-12 13:49:08', '2024-03-12 13:49:08', 0);

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
(19, 15, 'Agriculture', '2024-03-12 13:57:15', '2024-03-12 13:57:15', 0),
(20, 15, 'Agribusiness', '2024-03-12 13:57:25', '2024-03-12 13:57:25', 0),
(21, 15, 'Food Techonology', '2024-03-12 13:57:43', '2024-03-12 13:57:43', 0),
(22, 17, 'Islamic Studies', '2024-03-12 13:59:40', '2024-03-12 13:59:40', 0),
(23, 17, 'Asian Studies', '2024-03-12 14:00:02', '2024-03-12 14:00:02', 0),
(24, 18, 'Computer Science', '2024-03-12 14:00:12', '2024-03-12 14:00:12', 0),
(25, 18, 'Information Techonology', '2024-03-12 14:00:23', '2024-03-12 14:00:23', 0),
(26, 19, 'Crimonology', '2024-03-12 14:00:55', '2024-03-12 14:00:55', 0),
(27, 20, 'Civil Engineering', '2024-03-12 14:02:48', '2024-03-12 14:02:48', 0),
(28, 20, 'Mechanical Engineering ', '2024-03-12 14:02:58', '2024-03-12 14:02:58', 0),
(29, 20, 'Electrical Engineering ', '2024-03-12 14:03:12', '2024-03-12 14:03:12', 0),
(30, 20, 'Industrial Engineering ', '2024-03-12 14:03:24', '2024-03-12 14:03:24', 0),
(31, 20, 'Geodetic Engineering ', '2024-03-12 14:03:33', '2024-03-12 14:03:33', 0),
(32, 20, 'Sanitary Engineering ', '2024-03-12 14:03:49', '2024-03-12 14:03:49', 0),
(33, 20, 'Environmental Engineering', '2024-03-12 14:04:00', '2024-03-12 14:04:00', 0),
(34, 20, 'Computer Engineering ', '2024-03-12 14:04:11', '2024-03-12 14:04:11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `measurement`
--

CREATE TABLE `measurement` (
  `measurement_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `measurement_name` varchar(255) NOT NULL,
  `value_unit` varchar(255) DEFAULT NULL,
  `is_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `measurement`
--

INSERT INTO `measurement` (`measurement_id`, `product_id`, `measurement_name`, `value_unit`, `is_created`, `is_updated`, `is_deleted`) VALUES
(21, 12, 'Small', '40 cm', '2024-03-20 13:36:42', '2024-03-25 17:26:31', 0),
(22, 13, 'Default', NULL, '2024-03-20 13:37:12', '2024-03-20 13:37:12', 0),
(23, 14, 'Default', NULL, '2024-03-20 15:07:26', '2024-03-20 15:07:26', 0),
(24, 15, 'Default', NULL, '2024-03-20 15:08:01', '2024-03-20 15:08:01', 0),
(25, 16, 'Default', NULL, '2024-03-20 16:28:42', '2024-03-20 16:28:42', 0),
(26, 17, 'Default', NULL, '2024-03-20 16:49:08', '2024-03-26 17:19:48', 1),
(27, 18, 'Default', NULL, '2024-03-20 17:04:03', '2024-03-20 17:04:03', 0),
(28, 19, 'Default', NULL, '2024-03-20 17:18:12', '2024-03-20 17:18:12', 0),
(29, 20, 'Default', NULL, '2024-03-22 16:59:34', '2024-03-22 16:59:34', 0),
(30, 21, 'Default', NULL, '2024-03-22 18:07:12', '2024-03-22 18:07:12', 0),
(31, 22, 'Default', NULL, '2024-03-22 18:08:03', '2024-03-22 18:08:03', 0),
(32, 12, 'Medium', '45 cm', '2024-03-25 17:26:42', '2024-03-25 17:26:42', 0),
(33, 12, 'Large', '50 cm', '2024-03-25 17:26:55', '2024-03-25 17:26:55', 0),
(34, 17, 'Small', '5 grams', '2024-03-26 17:19:32', '2024-03-26 17:19:32', 0),
(35, 17, 'Big', '10 grams', '2024-03-26 17:19:43', '2024-03-26 17:19:43', 0),
(36, 17, 'Medium', '7.5 grams', '2024-03-26 22:06:56', '2024-03-26 22:06:56', 0),
(37, 23, 'Default', NULL, '2024-03-29 06:25:47', '2024-03-29 06:25:47', 0),
(38, 24, 'Default', NULL, '2024-03-29 06:27:36', '2024-03-29 06:27:36', 0),
(39, 25, 'Default', NULL, '2024-03-29 06:28:48', '2024-03-29 06:28:48', 0),
(40, 26, 'Default', NULL, '2024-03-29 06:29:26', '2024-03-29 06:29:26', 0),
(41, 26, '546', '567', '2024-03-29 06:35:51', '2024-03-29 06:35:51', 0),
(42, 14, 'test', '232', '2024-04-15 17:46:14', '2024-04-15 17:46:14', 0),
(43, 19, 'tetstst', '22', '2024-04-16 05:48:00', '2024-04-16 05:49:57', 1),
(44, 27, 'Default', NULL, '2024-04-21 05:44:18', '2024-04-21 05:44:18', 0);

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
(12, 8, 57, '2024-02-08 04:54:07', '2024-02-12 07:01:31', 0),
(13, 9, 65, '2024-02-12 06:59:55', '2024-02-12 06:59:55', 0),
(14, 6, 53, '2024-02-12 08:57:47', '2024-02-12 09:04:53', 1),
(15, 8, 53, '2024-02-12 09:05:06', '2024-02-12 09:07:06', 1),
(16, 18, 53, '2024-02-12 09:19:53', '2024-04-12 17:59:27', 0),
(17, 15, 55, '2024-03-23 03:10:10', '2024-03-23 03:10:10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `total_payment` decimal(12,2) NOT NULL,
  `fulfillment_method` varchar(32) NOT NULL,
  `payment_method` varchar(32) NOT NULL,
  `order_status` varchar(16) NOT NULL,
  `is_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `variation_id` int(11) DEFAULT NULL,
  `measurement_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `selling_price` decimal(12,2) NOT NULL,
  `is_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `price_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `variation_id` int(11) DEFAULT NULL,
  `measurement_id` int(11) DEFAULT NULL,
  `purchase_price` decimal(12,2) NOT NULL,
  `selling_price` decimal(12,2) NOT NULL,
  `is_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` int(11) DEFAULT 0,
  `commission` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`price_id`, `product_id`, `variation_id`, `measurement_id`, `purchase_price`, `selling_price`, `is_created`, `is_updated`, `is_deleted`, `commission`) VALUES
(1, 12, 27, 21, 20.00, 100.00, '2024-04-12 15:08:53', '2024-04-21 07:08:07', 0, 30.00),
(2, 12, 38, 21, 20.00, 150.00, '2024-04-12 15:15:14', '2024-04-21 11:48:59', 0, 45.00),
(3, 14, 29, 23, 400.00, 450.00, '2024-04-15 17:45:41', '2024-04-21 11:48:59', 0, 135.00),
(4, 12, 38, 32, 20.00, 199.99, '2024-04-21 07:03:29', '2024-04-21 11:48:59', 0, 60.00),
(5, 12, 27, 32, 20.00, 200.00, '2024-04-21 07:07:30', '2024-04-21 11:48:59', 0, 60.00),
(6, 12, 39, 32, 20.00, 250.00, '2024-04-21 07:07:41', '2024-04-21 11:48:59', 0, 75.00),
(7, 12, 40, 32, 20.00, 300.99, '2024-04-21 07:07:53', '2024-04-21 11:48:59', 0, 90.30),
(8, 12, 39, 21, 20.00, 189.99, '2024-04-21 07:08:29', '2024-04-21 11:48:59', 0, 57.00),
(9, 12, 40, 21, 20.00, 199.50, '2024-04-21 07:08:43', '2024-04-21 11:48:59', 0, 59.85),
(10, 12, 27, 33, 20.00, 299.99, '2024-04-21 07:13:03', '2024-04-21 11:48:59', 0, 90.00),
(11, 12, 38, 33, 20.00, 349.99, '2024-04-21 07:15:17', '2024-04-21 11:48:59', 0, 105.00),
(12, 12, 39, 33, 20.00, 389.99, '2024-04-21 07:15:28', '2024-04-21 11:48:59', 0, 117.00),
(13, 12, 40, 33, 20.00, 459.99, '2024-04-21 07:15:39', '2024-04-21 11:48:59', 0, 138.00);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `store_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `exclusivity` varchar(32) DEFAULT NULL,
  `sale_status` varchar(32) DEFAULT NULL,
  `purchase_price` decimal(12,2) DEFAULT NULL,
  `selling_price` decimal(12,2) DEFAULT NULL,
  `restriction_status` varchar(32) NOT NULL DEFAULT 'Unrestricted',
  `order_quantity_limit` int(11) NOT NULL DEFAULT 0,
  `estimated_order_time` int(11) NOT NULL DEFAULT 0,
  `is_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` int(11) DEFAULT 0,
  `commission` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `store_id`, `category_id`, `product_name`, `exclusivity`, `sale_status`, `purchase_price`, `selling_price`, `restriction_status`, `order_quantity_limit`, `estimated_order_time`, `is_created`, `is_updated`, `is_deleted`, `commission`) VALUES
(12, 33, 2, 'Final Necklace', 'All Users', 'Pre-order', 20.00, 129.99, 'Unrestricted', 10, 30, '2024-03-20 13:36:42', '2024-04-21 11:48:59', 0, 39.00),
(13, 33, 5, 'Spicy Eyedrops', 'All Users', 'Pre-order', 99.00, 9990.00, 'Unrestricted', 0, 0, '2024-03-20 13:37:12', '2024-04-21 11:48:59', 0, 2997.00),
(14, 33, 1, 'Smiley Hoodie ', 'WMSU Users', 'On-hand', 400.00, 500.00, 'Unrestricted', 0, 0, '2024-03-20 15:07:26', '2024-04-21 11:48:59', 0, 150.00),
(15, 33, 7, 'Nothing', 'WMSU Users', 'Pre-order', 4.00, 300.00, 'Unrestricted', 0, 0, '2024-03-20 15:08:01', '2024-04-21 11:48:59', 0, 90.00),
(16, 33, 6, 'Venom Newspaper', 'WMSU Users', 'On-hand', 10.00, 20.00, 'Unrestricted', 0, 0, '2024-03-20 16:28:42', '2024-04-21 11:48:59', 0, 6.00),
(17, 33, 7, 'Poison Candy', 'All Users', 'On-hand', 10.00, 15.00, 'Unrestricted', 10, 0, '2024-03-20 16:49:08', '2024-04-21 11:48:59', 0, 4.50),
(18, 33, 5, 'test long name product for design HAHAHAHHAAHAHA', 'WMSU Users', 'Pre-order', 2.00, 2.00, 'Unrestricted', 0, 0, '2024-03-20 17:04:03', '2024-04-21 11:48:59', 0, 0.60),
(19, 35, 4, 'Special Chicken BBQ', 'Computing Studies', 'Pre-order', 30.00, 65.00, 'Unrestricted', 0, 0, '2024-03-20 17:18:12', '2024-04-21 11:48:59', 0, 19.50),
(20, 33, 4, 'Tubig Kanal', 'WMSU Users', 'Pre-order', 200.00, 200.00, 'Restricted', 0, 0, '2024-03-22 16:59:34', '2024-04-21 11:48:59', 0, 60.00),
(21, 33, 1, 'a', 'WMSU Users', 'Pre-order', 3.00, 3.00, 'Unrestricted', 0, 0, '2024-03-22 18:07:12', '2024-04-21 11:48:59', 0, 0.90),
(22, 33, 1, 'ab', 'WMSU Users', 'On-hand', 6.00, 6.50, 'Unrestricted', 0, 0, '2024-03-22 18:08:03', '2024-04-21 11:48:59', 0, 1.95),
(23, 33, 2, '123', 'All Users', 'Pre-order', 234.00, 234.00, 'Unrestricted', 0, 0, '2024-03-29 06:25:47', '2024-04-21 11:48:59', 0, 70.20),
(24, 33, 2, 'HAHA', 'All Users', 'Pre-order', 23.00, 23.00, 'Unrestricted', 0, 0, '2024-03-29 06:27:36', '2024-04-21 11:48:59', 0, 6.90),
(25, 33, 2, 'TESTETST', 'WMSU Users', 'Pre-order', 45.00, 45.00, 'Unrestricted', 0, 0, '2024-03-29 06:28:48', '2024-04-21 11:48:59', 0, 13.50),
(26, 33, 3, 'testing', 'WMSU Users', 'On-hand', 34.00, 645.00, 'Unrestricted', 0, 0, '2024-03-29 06:29:26', '2024-04-21 11:48:59', 0, 193.50),
(27, 33, 2, 'test final price', 'All Users', 'On-hand', 200.00, 250.00, 'Unrestricted', 0, 0, '2024-04-21 05:44:18', '2024-04-21 11:48:59', 0, 75.00);

-- --------------------------------------------------------

--
-- Table structure for table `product_desc`
--

CREATE TABLE `product_desc` (
  `desc_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `desc_label` varchar(255) NOT NULL,
  `desc_value` varchar(255) NOT NULL,
  `is_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_desc`
--

INSERT INTO `product_desc` (`desc_id`, `product_id`, `desc_label`, `desc_value`, `is_created`, `is_updated`, `is_deleted`) VALUES
(25, 12, 'Color', 'Red', '2024-03-22 05:11:19', '2024-03-22 05:11:19', 0),
(26, 12, 'Material', 'Gold', '2024-03-22 05:11:38', '2024-03-22 05:11:38', 0),
(27, 13, 'Ingridients', 'Tubig Kanal, Chili, and Black Pepper', '2024-03-22 05:14:58', '2024-03-22 05:14:58', 0),
(28, 13, 'Expiration Date', 'March 13, 1990', '2024-03-22 05:15:25', '2024-03-22 05:15:25', 0),
(29, 20, 'Flavor', 'Sweet and Spicy, Sour Cream, and Original', '2024-03-22 17:00:49', '2024-03-22 17:00:49', 0),
(30, 12, 'Karats', '14, 18, 22, 24', '2024-03-22 17:34:18', '2024-03-22 17:34:18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `image_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `image_file` varchar(255) NOT NULL,
  `is_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`image_id`, `product_id`, `image_file`, `is_created`, `is_updated`, `is_deleted`) VALUES
(16, 14, '65fb0c1c6b1234.66948198.jpg', '2024-03-20 16:17:32', '2024-03-20 16:17:32', 0),
(17, 12, '65fb15e0210336.74096115.jpg', '2024-03-20 16:59:12', '2024-03-20 16:59:12', 0),
(18, 17, '65fe09903e9f81.34598477.png', '2024-03-22 22:43:28', '2024-03-22 22:43:28', 0),
(19, 12, '65fe2f661b8491.28389597.png', '2024-03-23 01:24:54', '2024-03-23 01:24:54', 0),
(20, 22, '65fe4857ed2398.74020708.png', '2024-03-23 03:11:19', '2024-03-23 03:11:19', 0),
(21, 22, '65fe490cb9ecb2.08363302.png', '2024-03-23 03:14:20', '2024-03-23 03:14:20', 0),
(22, 13, '65fe4ae17ad460.51952930.png', '2024-03-23 03:22:09', '2024-03-23 03:22:09', 0),
(23, 17, '6603ab41f33cc8.87574816.jpg', '2024-03-27 05:14:42', '2024-03-27 05:14:42', 0);

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
(6, 1, '2024-04-21', '2024-08-15', 'Current', 0);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `variation_id` int(11) DEFAULT NULL,
  `measurement_id` int(11) DEFAULT NULL,
  `stock_quantity` int(11) NOT NULL,
  `stock_allocated` int(11) NOT NULL DEFAULT 0,
  `purchase_price` decimal(12,2) NOT NULL,
  `selling_price` decimal(12,2) NOT NULL,
  `is_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` int(11) DEFAULT 0,
  `commission` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stock_id`, `product_id`, `variation_id`, `measurement_id`, `stock_quantity`, `stock_allocated`, `purchase_price`, `selling_price`, `is_created`, `is_updated`, `is_deleted`, `commission`) VALUES
(2, 2, 1, 1, 50, 0, 400.00, 550.00, '2024-03-10 04:08:43', '2024-04-21 11:48:59', 0, 165.00),
(3, 2, 1, 5, 40, 0, 400.00, 550.00, '2024-03-10 04:43:10', '2024-04-21 11:48:59', 0, 165.00),
(4, 2, 1, 1, 1, 0, 1.00, 1.00, '2024-03-10 04:46:26', '2024-04-21 11:48:59', 0, 0.30),
(5, 6, 18, 12, 123123, 0, 12341.00, 34534.00, '2024-03-10 12:41:48', '2024-04-21 11:48:59', 0, 10360.20),
(6, 2, 7, 1, 50, 0, 150.00, 200.00, '2024-03-11 04:35:28', '2024-04-21 11:48:59', 0, 60.00),
(7, 2, 22, 1, 55, 0, 500.00, 400.00, '2024-03-11 04:36:10', '2024-04-21 11:48:59', 0, 120.00),
(8, 2, 1, 1, 5, 0, 100.00, 200.00, '2024-03-11 05:45:52', '2024-04-21 11:48:59', 0, 60.00),
(9, 14, 29, 23, 30, 0, 300.00, 500.00, '2024-03-20 15:10:33', '2024-04-21 11:48:59', 1, 150.00),
(10, 14, 29, 23, 20, 0, 300.00, 999.00, '2024-03-20 16:04:04', '2024-04-21 11:48:59', 1, 299.70),
(11, 17, 32, 26, 50, 0, 2.00, 5.00, '2024-03-20 16:52:17', '2024-04-21 11:48:59', 0, 1.50),
(12, 19, 34, 28, 5, 0, 30.00, 40.00, '2024-03-21 01:18:37', '2024-04-21 11:48:59', 0, 12.00),
(13, 13, 28, 22, 9, 0, 2.00, 9990.00, '2024-03-21 05:19:50', '2024-04-21 11:48:59', 0, 2997.00),
(14, 16, 31, 25, 20, 0, 10.00, 20.00, '2024-03-26 16:36:14', '2024-04-21 11:48:59', 0, 6.00),
(15, 16, 31, 25, 40, 0, 10.00, 20.00, '2024-03-26 16:36:19', '2024-04-21 11:48:59', 0, 6.00),
(16, 16, 31, 25, 15, 0, 10.00, 20.00, '2024-03-26 16:36:25', '2024-04-21 11:48:59', 0, 6.00),
(17, 16, 31, 25, 25, 0, 10.00, 20.00, '2024-03-26 16:50:54', '2024-04-21 11:48:59', 0, 6.00),
(18, 16, 41, 25, 2, 0, 10.00, 20.00, '2024-03-26 17:01:03', '2024-04-21 11:48:59', 0, 6.00),
(19, 17, 32, 34, 10, 3, 2.00, 23.00, '2024-03-26 17:20:02', '2024-04-21 11:48:59', 0, 6.90),
(20, 17, 32, 35, 20, 0, 2.00, 60.00, '2024-03-26 17:20:09', '2024-04-21 11:48:59', 0, 18.00),
(21, 17, 42, 34, 30, 3, 2.00, 23.00, '2024-03-26 17:20:20', '2024-04-21 11:48:59', 0, 6.90),
(22, 17, 42, 35, 40, 0, 2.00, 50.00, '2024-03-26 17:20:27', '2024-04-21 11:48:59', 0, 15.00),
(23, 17, 43, 34, 50, 0, 2.00, 23.00, '2024-03-26 17:20:36', '2024-04-21 11:48:59', 0, 6.90),
(24, 17, 43, 35, 60, 5, 2.00, 46.00, '2024-03-26 17:20:42', '2024-04-21 11:48:59', 0, 13.80),
(25, 22, 37, 31, 2, 0, 7.00, 6.50, '2024-03-26 18:04:28', '2024-04-21 11:48:59', 1, 1.95),
(26, 17, 43, 36, 4, 4, 2.00, 35.50, '2024-03-27 04:48:40', '2024-04-21 11:48:59', 0, 10.65),
(27, 12, 38, 21, 1, 0, 300.00, 400.00, '2024-04-12 11:05:27', '2024-04-21 11:48:59', 1, 120.00),
(28, 14, 29, 23, 400, 4, 40.00, 500.00, '2024-04-15 17:44:56', '2024-04-21 11:48:59', 0, 150.00),
(29, 14, 29, 23, 300, 0, 400.00, 500.00, '2024-04-16 02:40:04', '2024-04-21 11:48:59', 0, 150.00),
(30, 17, 43, 36, 30, 0, 20.00, 30.00, '2024-04-19 08:24:38', '2024-04-21 11:48:59', 1, 9.00),
(31, 27, 52, 44, 23, 0, 200.00, 220.00, '2024-04-21 06:27:15', '2024-04-21 11:48:59', 0, 66.00),
(32, 27, 52, 44, 20, 0, 200.00, 230.00, '2024-04-21 06:55:58', '2024-04-21 11:48:59', 0, 69.00),
(33, 17, 32, 36, 23, 0, 2.00, 10.00, '2024-04-21 07:29:14', '2024-04-21 11:48:59', 0, 3.00),
(34, 17, 42, 36, 23, 0, 2.00, 30.00, '2024-04-21 07:29:34', '2024-04-21 11:48:59', 0, 9.00),
(35, 17, 43, 36, 40, 4, 10.00, 40.00, '2024-04-21 09:39:11', '2024-04-21 11:48:59', 0, 12.00),
(36, 17, 43, 36, 30, 0, 10.00, 40.00, '2024-04-21 09:57:47', '2024-04-21 11:48:59', 0, 12.00);

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `store_id` int(11) NOT NULL,
  `college_id` int(11) DEFAULT NULL,
  `store_name` varchar(255) NOT NULL,
  `store_email` varchar(255) DEFAULT NULL,
  `store_contact` varchar(16) DEFAULT NULL,
  `store_location` varchar(255) DEFAULT NULL,
  `store_bio` varchar(255) DEFAULT NULL,
  `business_time` varchar(255) DEFAULT NULL,
  `certificate` varchar(255) NOT NULL,
  `restriction_status` varchar(32) DEFAULT 'Unrestricted',
  `verification_status` varchar(32) NOT NULL DEFAULT 'Not Verified',
  `registration_status` varchar(32) DEFAULT 'Not Registered',
  `is_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  `delivery_charge` decimal(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`store_id`, `college_id`, `store_name`, `store_email`, `store_contact`, `store_location`, `store_bio`, `business_time`, `certificate`, `restriction_status`, `verification_status`, `registration_status`, `is_created`, `is_updated`, `is_deleted`, `delivery_charge`) VALUES
(33, NULL, 'Test', NULL, NULL, NULL, NULL, NULL, 'Acer_Wallpaper_04_3840x2400.jpg', 'Unrestricted', 'Verified', 'Registered', '2024-03-12 15:14:40', '2024-03-21 05:18:08', 0, NULL),
(34, 16, 'Wilfred Sari Sari', NULL, NULL, NULL, NULL, NULL, 'Acer_Wallpaper_03_3840x2400.jpg', 'Unrestricted', 'Verified', 'Registered', '2024-03-12 15:51:01', '2024-03-12 15:51:01', 0, NULL),
(35, 18, 'CCS Ihawan', NULL, NULL, NULL, NULL, NULL, 'c++.jpg', 'Unrestricted', 'Verified', 'Registered', '2024-03-20 17:17:05', '2024-03-20 17:17:05', 0, NULL),
(36, NULL, 'Your Store', NULL, NULL, NULL, NULL, NULL, 'Screenshot (12).png', 'Unrestricted', 'Not Verified', 'Not Registered', '2024-03-23 03:07:04', '2024-04-21 12:13:10', 0, NULL),
(37, 15, '123oin', NULL, NULL, NULL, NULL, NULL, 'Screenshot (12).png', 'Unrestricted', 'Not Verified', 'Not Registered', '2024-03-23 03:07:32', '2024-03-23 03:07:32', 0, NULL),
(38, 15, '23234', NULL, NULL, NULL, NULL, NULL, 'Screenshot (13).png', 'Unrestricted', 'Verified', 'Registered', '2024-03-23 03:08:54', '2024-03-23 03:08:54', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `store_staff`
--

CREATE TABLE `store_staff` (
  `store_staff_id` int(11) NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `staff_role` int(11) DEFAULT NULL,
  `is_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `store_staff`
--

INSERT INTO `store_staff` (`store_staff_id`, `account_id`, `store_id`, `staff_role`, `is_created`, `is_updated`, `is_deleted`) VALUES
(12, 54, 33, 0, '2024-03-12 15:14:40', '2024-03-12 15:14:40', 0),
(13, 60, 34, 0, '2024-03-12 15:51:01', '2024-03-12 15:51:01', 0),
(14, 54, 35, 0, '2024-03-20 17:17:05', '2024-03-20 17:17:05', 0),
(15, 54, 36, 0, '2024-03-23 03:07:04', '2024-03-23 03:07:04', 0),
(16, 54, 37, 0, '2024-03-23 03:07:32', '2024-03-23 03:07:32', 0),
(17, 54, 38, 0, '2024-03-23 03:08:54', '2024-03-23 03:08:54', 0);

-- --------------------------------------------------------

--
-- Table structure for table `variation`
--

CREATE TABLE `variation` (
  `variation_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `variation_name` varchar(255) NOT NULL,
  `is_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `variation`
--

INSERT INTO `variation` (`variation_id`, `product_id`, `variation_name`, `is_created`, `is_updated`, `is_deleted`) VALUES
(27, 12, '18 Karat', '2024-03-20 13:36:42', '2024-03-25 17:25:22', 0),
(28, 13, 'Default', '2024-03-20 13:37:12', '2024-03-20 13:37:12', 0),
(29, 14, 'Default', '2024-03-20 15:07:26', '2024-03-20 15:07:26', 0),
(30, 15, 'Default', '2024-03-20 15:08:01', '2024-03-20 15:08:01', 0),
(31, 16, 'Default', '2024-03-20 16:28:42', '2024-03-20 16:28:42', 0),
(32, 17, 'Poison', '2024-03-20 16:49:08', '2024-03-26 17:18:50', 0),
(33, 18, 'Default', '2024-03-20 17:04:03', '2024-03-20 17:04:03', 0),
(34, 19, 'Default', '2024-03-20 17:18:12', '2024-03-20 17:18:12', 0),
(35, 20, 'Default', '2024-03-22 16:59:34', '2024-03-22 16:59:34', 0),
(36, 21, 'Default', '2024-03-22 18:07:12', '2024-03-22 18:07:12', 0),
(37, 22, 'Default', '2024-03-22 18:08:03', '2024-03-22 18:08:03', 0),
(38, 12, '14 Karat', '2024-03-25 17:25:04', '2024-03-25 17:25:04', 0),
(39, 12, '22 Karat', '2024-03-25 17:25:33', '2024-03-25 17:25:33', 0),
(40, 12, '24 Karat', '2024-03-25 17:25:45', '2024-03-25 17:25:45', 0),
(41, 16, 'Old Newspaper', '2024-03-26 16:58:10', '2024-03-26 16:58:10', 0),
(42, 17, 'Apple', '2024-03-26 17:18:35', '2024-03-26 17:18:35', 0),
(43, 17, 'Mango', '2024-03-26 17:18:58', '2024-03-26 17:18:58', 0),
(44, 22, 'hh', '2024-03-27 05:17:16', '2024-03-27 05:17:28', 1),
(45, 21, 'Default 2', '2024-03-29 06:06:00', '2024-03-29 06:06:00', 0),
(46, 23, 'Default', '2024-03-29 06:25:47', '2024-03-29 06:25:47', 0),
(47, 24, 'Default', '2024-03-29 06:27:36', '2024-03-29 06:27:36', 0),
(48, 25, 'Default', '2024-03-29 06:28:48', '2024-03-29 06:28:48', 0),
(49, 26, 'Default', '2024-03-29 06:29:26', '2024-03-29 06:29:26', 0),
(50, 14, 'test', '2024-04-15 17:46:07', '2024-04-15 17:46:07', 0),
(51, 20, '213', '2024-04-18 15:48:57', '2024-04-18 15:48:57', 0),
(52, 27, 'Default', '2024-04-21 05:44:18', '2024-04-21 05:44:18', 0);

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
-- Indexes for table `admin_settings`
--
ALTER TABLE `admin_settings`
  ADD PRIMARY KEY (`settings_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `fk_caracc` (`account_id`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD KEY `fk_citcar` (`cart_id`),
  ADD KEY `fk_citpro` (`product_id`),
  ADD KEY `fk_citvar` (`variation_id`),
  ADD KEY `fk_citmea` (`measurement_id`),
  ADD KEY `fk_citsto` (`stock_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

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
-- Indexes for table `measurement`
--
ALTER TABLE `measurement`
  ADD PRIMARY KEY (`measurement_id`),
  ADD KEY `fk_meapro` (`product_id`);

--
-- Indexes for table `moderator`
--
ALTER TABLE `moderator`
  ADD PRIMARY KEY (`moderator_id`),
  ADD KEY `fk_colmod` (`college_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_ordacc` (`account_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `fk_oitord` (`order_id`),
  ADD KEY `fk_oitpro` (`product_id`),
  ADD KEY `fk_oitvar` (`variation_id`),
  ADD KEY `fk_oitmea` (`measurement_id`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`price_id`),
  ADD KEY `fk_pripro` (`product_id`),
  ADD KEY `fk_primea` (`measurement_id`),
  ADD KEY `fk_privar` (`variation_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_procat` (`category_id`),
  ADD KEY `fk_prostr` (`store_id`);

--
-- Indexes for table `product_desc`
--
ALTER TABLE `product_desc`
  ADD PRIMARY KEY (`desc_id`),
  ADD KEY `fk_prodes` (`product_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `fk_proimg` (`product_id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`semester_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `fk_stopro` (`product_id`),
  ADD KEY `fk_stomea` (`measurement_id`),
  ADD KEY `fk_stovar` (`variation_id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`store_id`),
  ADD KEY `fk_colstor` (`college_id`);

--
-- Indexes for table `store_staff`
--
ALTER TABLE `store_staff`
  ADD PRIMARY KEY (`store_staff_id`),
  ADD KEY `fk_stfacc` (`account_id`),
  ADD KEY `fk_stfsto` (`store_id`);

--
-- Indexes for table `variation`
--
ALTER TABLE `variation`
  ADD PRIMARY KEY (`variation_id`),
  ADD KEY `fk_varpro` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `admin_settings`
--
ALTER TABLE `admin_settings`
  MODIFY `settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `cart_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `college`
--
ALTER TABLE `college`
  MODIFY `college_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `measurement`
--
ALTER TABLE `measurement`
  MODIFY `measurement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `moderator`
--
ALTER TABLE `moderator`
  MODIFY `moderator_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `product_desc`
--
ALTER TABLE `product_desc`
  MODIFY `desc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `semester_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `store_staff`
--
ALTER TABLE `store_staff`
  MODIFY `store_staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `variation`
--
ALTER TABLE `variation`
  MODIFY `variation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_caracc` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `fk_citsto` FOREIGN KEY (`stock_id`) REFERENCES `stock` (`stock_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
