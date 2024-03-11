-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2024 at 02:22 PM
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
(53, 'mrhiraru@gmail.com', '$2y$10$fe966OYQ7YmFUdqsvyGkKeZcius//gAf6rWmqulAODkRbPxUYmMqa', 'Non-student', 'Hilal', 'Jamiruddin', 'Abdulajid', 'Male', NULL, NULL, '09123456789', NULL, NULL, 1, 'Verified', 'Unrestricted', '2024-01-30 02:53:27', '2024-02-12 09:23:22', 0),
(54, 'qb202101164@wmsu.edu.ph', '$2y$10$sMF4Qk8fx0j7AazdOaEqyeQP2qG/O44iapPDWZdM0c3xdo7XJKp0G', 'Student', 'Hilal', 'Jamiruddin', 'Abdulajid', 'Male', 1, 1, '09999999999', NULL, NULL, 0, 'Verified', 'Unrestricted', '2024-01-30 02:53:27', '2024-02-05 04:46:06', 0),
(55, 'moderator@wmsu.edu.ph', 'thisaccountisfortesting', 'Student', 'Mod', 'E', 'Rator', 'Male', 1, 1, '09123456789', NULL, NULL, 1, 'Verified', 'Unrestricted', '2024-02-02 12:39:26', '2024-02-02 12:39:26', 0),
(56, 'moderatora@wmsu.edu.ph', 'thisisatestaaccount', 'Faculty', 'Alexa', 'Bard', 'GPT', 'Other', 3, 2, '09876543211', NULL, NULL, 1, 'Verified', 'Unrestricted', '2024-02-02 13:58:55', '2024-02-12 06:59:20', 0),
(57, 'moderatorb@wmsu.edu.ph', 'thisisatestdummymoderator', 'Faculty', 'Cat', 'FISH', 'Lion', 'Female', 5, NULL, '09999999999', NULL, NULL, 1, 'Verified', 'Unrestricted', '2024-02-02 14:50:53', '2024-02-02 14:52:33', 0),
(60, 'jejemon@gmail.com', '$2y$10$EtgWDCg3fbdbgldBhPCwa.Ek.ynWqiWW2QcGnnZLcHlywjNIS4TS6', 'Non-student', 'Charls', '', 'Pausal', 'Other', NULL, NULL, '09222222222', NULL, NULL, 2, 'Not Verified', 'Unrestricted', '2024-02-03 01:26:54', '2024-02-03 01:26:54', 0),
(61, 'hahaha3@wmsu.edu.ph', '$2y$10$xN44Khf/HZ00/caO7j2XD.IyLybAX72x/A/2elnf8xaZiQTb8kkjq', 'Student', 'Zxc', '', 'Mon', 'Male', 4, 4, '09222222222', NULL, NULL, 2, 'Not Verified', 'Unrestricted', '2024-02-04 12:34:04', '2024-02-04 12:34:04', 0),
(64, 'klaljkasad@gg.com', '$2y$10$ODh03tNx2M/FDXqh7FQ6Auwg.7YxhNX/HejbzfDT6DMQDNqA/ml6m', 'Non-student', 'Zxc', 'Asd', 'Qwe', 'Male', NULL, NULL, '09222222222', NULL, NULL, 2, 'Not Verified', 'Unrestricted', '2024-02-08 03:46:24', '2024-02-08 03:46:24', 0),
(65, '123123@gmail.com', '$2y$10$hj4spYFIOPeJM1LOOcsDW.Z4TXrMeJVvJVIoodpJF5HY2jxjyZBxu', 'Non-student', 'Asdasd', 'Xcvxcv', 'Yukyuky', 'Female', NULL, NULL, '09666666666', NULL, NULL, 1, 'Not Verified', 'Unrestricted', '2024-02-08 15:32:21', '2024-02-10 15:34:21', 0),
(66, 'askdjaksjdh@gmail.com', '$2y$10$lOjxux15cRPnE/P7aOq7sek.S39Yfd0yc9lSm6UkuLoySu0rmf9bK', 'Non-student', 'Jkljkl', 'Jkljkl', 'Jkljkl', 'Female', NULL, NULL, '09888888888', NULL, NULL, 2, 'Not Verified', 'Unrestricted', '2024-02-11 05:59:44', '2024-02-12 09:27:41', 0),
(67, 'dextermanait25@gmail.com', '$2y$10$CfFElr4sIl5AjPRunSN0rOK.SfrgMcO5pc594oyDGck01vhSXLsoy', 'Non-student', 'Dexter', 'Cabatuan', 'Manait', 'Male', NULL, NULL, '09091916246', NULL, NULL, 2, 'Not Verified', 'Unrestricted', '2024-03-11 05:56:34', '2024-03-11 05:56:34', 0),
(68, 'arkeo@gmail.com', '$2y$10$.HhAvUmvSD5eiJkMl2WhEOURoZZZygXaiGZbATgUtECO7luZUWE62', 'Non-student', 'Nisha', 'Shesh', 'Boom panis', 'Male', NULL, NULL, '09091916246', NULL, NULL, 2, 'Not Verified', 'Unrestricted', '2024-03-11 05:58:10', '2024-03-11 05:58:10', 0);

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
(1, 'Computing Studies', '2024-02-01 18:21:07', '2024-02-01 18:36:57', 0),
(2, 'Nursing', '2024-02-01 18:21:40', '2024-02-01 18:40:20', 0),
(3, 'Engineering', '2024-02-01 18:49:11', '2024-02-01 18:49:11', 0),
(4, 'Liberal Arts', '2024-02-01 18:50:40', '2024-02-01 19:24:04', 0),
(5, 'Asian and Islamic Studies', '2024-02-02 08:18:43', '2024-02-02 08:18:43', 0),
(6, 'Criminal Justice', '2024-02-02 10:40:42', '2024-02-02 10:40:42', 0),
(7, 'Social Work and Community Development', '2024-02-02 10:54:29', '2024-02-02 10:54:29', 0),
(8, 'Elementary', '2024-02-02 10:59:36', '2024-02-18 02:04:59', 1),
(9, 'Highschool', '2024-02-03 00:15:51', '2024-02-03 00:15:51', 0),
(10, 'Home Economics', '2024-02-03 00:51:11', '2024-02-08 04:56:14', 0),
(11, 'Science and Mathematics', '2024-02-11 06:16:52', '2024-02-11 06:16:52', 0),
(12, 'Medicine', '2024-02-11 06:18:12', '2024-02-11 06:18:12', 0),
(13, 'Medicine', '2024-02-11 06:19:45', '2024-02-11 06:21:02', 1),
(14, 'Example', '2024-02-18 02:02:55', '2024-02-18 02:02:55', 0);

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
(1, 1, 'Computer Science', '2024-02-02 06:47:48', '2024-02-18 02:08:43', 0),
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
(12, 4, 'Philosopy', '2024-02-02 10:48:05', '2024-02-19 05:25:56', 1),
(13, 1, 'Application Development', '2024-02-02 10:51:05', '2024-02-02 10:55:31', 1),
(14, 1, 'Cyber Security', '2024-02-02 10:53:05', '2024-02-02 10:55:10', 0),
(15, 2, 'Ward 10', '2024-02-03 00:03:18', '2024-02-03 00:05:58', 1),
(16, 9, 'Senior High School', '2024-02-03 00:16:07', '2024-02-03 00:16:20', 0),
(17, 10, 'Pera', '2024-02-03 00:51:51', '2024-02-03 00:51:51', 0),
(18, 1, 'Hacking', '2024-02-05 04:49:22', '2024-02-05 04:49:22', 0);

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
(1, 2, 'Small', '104x73 cm', '2024-02-20 11:15:52', '2024-02-27 06:54:29', 0),
(2, 3, 'Default', NULL, '2024-02-20 11:17:45', '2024-02-20 11:17:45', 0),
(3, 4, 'Default', NULL, '2024-02-20 12:21:40', '2024-02-20 12:21:40', 0),
(4, 2, 'Default', NULL, '2024-02-20 11:15:52', '2024-02-25 06:56:31', 1),
(5, 2, 'Medium', '110x79 cm', '2024-02-25 07:19:36', '2024-02-25 07:35:17', 0),
(6, 5, 'Default', NULL, '2024-02-25 07:24:05', '2024-02-25 07:24:05', 0),
(7, 2, 'Large', '115x85 cm', '2024-02-25 07:45:20', '2024-02-25 07:45:20', 0),
(8, 6, 'Default', NULL, '2024-02-29 04:28:10', '2024-02-29 04:28:10', 0),
(9, 7, 'Default', NULL, '2024-02-29 04:38:12', '2024-02-29 04:38:12', 0),
(10, 4, 'large', '104x73 cms', '2024-02-29 04:44:43', '2024-02-29 04:44:43', 0),
(11, 6, '78978', '567567', '2024-03-10 12:36:51', '2024-03-10 12:36:51', 0),
(12, 6, 'tyui', 'tyui', '2024-03-10 12:36:56', '2024-03-10 12:36:56', 0),
(13, 6, 'vbnvb', 'vbnv', '2024-03-10 12:37:01', '2024-03-11 05:47:18', 1),
(14, 6, 'xcvxc', 'xcvsdf', '2024-03-10 12:37:06', '2024-03-11 05:44:02', 1),
(15, 6, 'Style4', '300', '2024-03-10 12:37:12', '2024-03-11 05:48:28', 0),
(16, 6, 'style5', '200', '2024-03-10 12:37:19', '2024-03-11 05:47:46', 0);

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
(16, 7, 53, '2024-02-12 09:19:53', '2024-02-12 09:19:53', 0);

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
  `restriction_status` varchar(32) NOT NULL DEFAULT 'Unrestricted',
  `order_quantity_limit` int(11) NOT NULL DEFAULT 0,
  `estimated_order_time` int(11) NOT NULL DEFAULT 0,
  `is_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `store_id`, `category_id`, `product_name`, `exclusivity`, `sale_status`, `restriction_status`, `order_quantity_limit`, `estimated_order_time`, `is_created`, `is_updated`, `is_deleted`) VALUES
(2, 23, 1, 'Test SHirt', 'All Users', 'Pre-order', 'Unrestricted', 10, 30, '2024-02-20 11:15:52', '2024-02-28 05:15:34', 0),
(3, 23, 2, 'Final Necklace', 'WMSU Affiliates', 'Pre-order', 'Unrestricted', 0, 0, '2024-02-20 11:17:45', '2024-02-20 11:17:45', 0),
(4, 25, 4, 'Munchkin', 'All Users', 'On-hand', 'Unrestricted', 1, 15, '2024-02-20 12:21:40', '2024-02-29 04:41:32', 0),
(5, 23, 1, 'Smiley Hoodie ', 'All Users', 'Pre-order', 'Unrestricted', 0, 0, '2024-02-25 07:24:05', '2024-02-25 07:24:05', 0),
(6, 23, 4, 'Krsipy shushi', 'All Users', 'Pre-order', 'Unrestricted', 0, 0, '2024-02-29 04:28:10', '2024-02-29 04:28:10', 0),
(7, 25, 2, 'Fossil Watch', 'WMSU Affiliates', 'On-hand', 'Unrestricted', 0, 0, '2024-02-29 04:38:12', '2024-02-29 04:38:12', 0);

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
(1, 2, 'Color', 'Red', '2024-02-24 14:23:55', '2024-02-24 14:23:55', 0),
(2, 2, 'Material', 'Cotton', '2024-02-24 14:23:55', '2024-02-24 14:23:55', 0),
(4, 4, 'Flavor', 'Chocolate', '2024-02-24 14:23:55', '2024-02-24 14:23:55', 0),
(5, 4, 'Expiration', 'Bukas', '2024-02-24 14:23:55', '2024-02-24 14:23:55', 0),
(6, 4, 'Ingridients', 'Graham', '2024-02-24 14:23:55', '2024-02-24 14:23:55', 0),
(7, 4, 'Fillings', 'Peanut, Hazelnut, Coconut', '2024-02-24 14:23:55', '2024-02-24 14:23:55', 0),
(14, 4, 'Test again', '232', '2024-02-24 14:23:55', '2024-02-24 14:23:55', 0),
(16, 3, 'Material', 'Nickle', '2024-02-24 14:23:55', '2024-02-24 14:23:55', 0),
(17, 2, 'lasang', 'qweqwe', '2024-02-24 14:28:19', '2024-02-24 14:28:27', 1),
(18, 2, 'Sizes', 'Small, Medium, Large', '2024-02-24 15:11:04', '2024-02-24 15:11:04', 0),
(19, 2, '23', '123', '2024-02-25 07:18:00', '2024-02-25 07:43:00', 1),
(20, 2, '23', '123', '2024-02-25 07:18:04', '2024-02-25 07:40:14', 1),
(21, 2, '234', '123123', '2024-02-25 07:18:08', '2024-02-25 07:40:18', 1),
(22, 2, 'haha', 'ahaha', '2024-02-25 07:43:35', '2024-02-25 07:43:46', 1),
(23, 2, 'ahaha', 'ahaha', '2024-02-25 07:43:41', '2024-02-25 07:43:51', 1),
(24, 2, 'dawdwd ; &quot;INSER INTO user (email, password) values (&quot;wilfred@gmail.com&quot;,&quot;123123&quot;); --&quot;', '200012@#$)', '2024-02-29 04:25:46', '2024-02-29 04:26:09', 1);

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
(6, 2, '65db36a9470e05.76601217.png', '2024-02-25 12:46:33', '2024-02-25 12:46:33', 0),
(7, 2, '65db375b69c648.74531889.png', '2024-02-25 12:49:31', '2024-02-25 12:54:07', 1),
(8, 2, '65db3878164da3.75789981.png', '2024-02-25 12:54:16', '2024-02-25 12:54:16', 0),
(9, 2, '65db3dd67771e6.95929702.png', '2024-02-25 13:17:10', '2024-02-25 13:17:10', 0),
(10, 2, '65db3df4488ee2.60769972.png', '2024-02-25 13:17:40', '2024-02-25 13:17:40', 0),
(11, 5, '65dd9029a7f739.92255859.png', '2024-02-27 07:32:57', '2024-02-27 07:32:57', 0),
(12, 5, '65dd90406a4136.85327864.png', '2024-02-27 07:33:20', '2024-02-27 07:33:20', 0),
(13, 3, '65dd92358c97c7.02979357.png', '2024-02-27 07:41:41', '2024-02-27 07:41:41', 0),
(14, 2, '65deb5af99f834.29473194.png', '2024-02-28 04:25:19', '2024-02-28 04:25:19', 0),
(15, 6, '65ee999abd8f26.78236831.jpg', '2024-03-11 05:41:46', '2024-03-11 05:41:46', 0);

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
  `stock_sold` int(11) NOT NULL DEFAULT 0,
  `purchase_price` decimal(12,2) NOT NULL,
  `selling_price` decimal(12,2) NOT NULL,
  `is_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stock_id`, `product_id`, `variation_id`, `measurement_id`, `stock_quantity`, `stock_sold`, `purchase_price`, `selling_price`, `is_created`, `is_updated`, `is_deleted`) VALUES
(2, 2, 1, 1, 50, 3, 400.00, 550.00, '2024-03-10 04:08:43', '2024-03-10 05:33:29', 0),
(3, 2, 1, 5, 40, 0, 400.00, 550.00, '2024-03-10 04:43:10', '2024-03-10 04:43:10', 0),
(4, 2, 1, 1, 1, 0, 1.00, 1.00, '2024-03-10 04:46:26', '2024-03-10 05:07:03', 0),
(5, 6, 18, 12, 123123, 0, 12341.00, 34534.00, '2024-03-10 12:41:48', '2024-03-10 12:41:48', 0),
(6, 2, 7, 1, 50, 0, 150.00, 200.00, '2024-03-11 04:35:28', '2024-03-11 04:35:28', 0),
(7, 2, 22, 1, 55, 0, 500.00, 400.00, '2024-03-11 04:36:10', '2024-03-11 04:36:10', 0),
(8, 2, 1, 1, 5, 0, 100.00, 200.00, '2024-03-11 05:45:52', '2024-03-11 05:45:52', 0);

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
  `is_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`store_id`, `college_id`, `store_name`, `store_email`, `store_contact`, `store_location`, `store_bio`, `business_time`, `certificate`, `restriction_status`, `verification_status`, `is_created`, `is_updated`, `is_deleted`) VALUES
(23, 1, 'Test Final', NULL, NULL, NULL, NULL, NULL, 'CASE ANALYSIS.docx', 'Unrestricted', 'Verified', '2024-02-18 03:57:57', '2024-02-18 03:57:57', 0),
(24, 2, 'Nursing Gender Club', NULL, NULL, NULL, NULL, NULL, 'CASE STUDY.docx', 'Unrestricted', 'Verified', '2024-02-18 04:25:20', '2024-02-18 04:25:20', 0),
(25, NULL, 'Wilfred Sari Sari', NULL, NULL, NULL, NULL, NULL, 'CASE ANALYSIS.docx', 'Unrestricted', 'Not Verified', '2024-02-18 04:27:53', '2024-02-18 04:27:53', 0),
(26, NULL, 'AniTa MAx wynn &lt;3|', NULL, NULL, NULL, NULL, NULL, 'Thesis-Capsule-Proposal.docx', 'Unrestricted', 'Verified', '2024-02-19 05:31:01', '2024-02-19 05:33:51', 0),
(27, 3, 'Test Engineering', NULL, NULL, NULL, NULL, NULL, 'Screenshot 2023-11-26 101010.png', 'Unrestricted', 'Verified', '2024-02-19 18:33:49', '2024-02-19 18:33:49', 0),
(28, 1, 'CSS GENDER CLUB', NULL, NULL, NULL, NULL, NULL, 'Screenshot 2023-11-26 100517.png', 'Unrestricted', 'Verified', '2024-02-19 18:44:20', '2024-02-19 18:44:20', 0),
(29, 3, 'Son Goku', NULL, NULL, NULL, NULL, NULL, 'Acer_Wallpaper_03_3840x2400.jpg', 'Unrestricted', 'Not Verified', '2024-03-11 05:39:36', '2024-03-11 05:39:36', 0);

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
(3, 54, 23, 0, '2024-02-18 03:57:57', '2024-02-18 03:57:57', 0),
(4, 56, 24, 0, '2024-02-18 04:25:20', '2024-02-18 04:25:20', 0),
(5, 54, 25, 0, '2024-02-18 04:27:53', '2024-02-18 09:42:51', 0),
(6, 57, 23, 1, '2024-02-18 04:40:49', '2024-02-18 04:40:49', 0),
(7, 54, 26, 0, '2024-02-19 05:31:01', '2024-02-19 05:31:01', 0),
(8, 65, 27, 0, '2024-02-19 18:33:49', '2024-02-19 18:33:49', 0),
(9, 61, 28, 0, '2024-02-19 18:44:20', '2024-02-19 18:44:20', 0),
(10, 54, 29, 0, '2024-03-11 05:39:36', '2024-03-11 05:39:36', 0);

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
(1, 2, 'Style 1', '2024-02-20 11:15:52', '2024-02-24 15:04:17', 0),
(2, 3, 'Default', '2024-02-20 11:17:45', '2024-02-20 11:17:45', 0),
(3, 4, 'Default', '2024-02-20 12:21:40', '2024-02-20 12:21:40', 0),
(4, 2, 'Default', '2024-02-20 11:15:52', '2024-02-24 14:50:58', 1),
(5, 2, 'Default', '2024-02-20 11:15:52', '2024-02-24 14:51:29', 1),
(6, 2, 'Style 2', '2024-02-24 15:04:25', '2024-02-24 15:04:25', 0),
(7, 2, 'Style 3', '2024-02-24 15:08:46', '2024-02-24 15:09:12', 0),
(8, 2, 'Stly qwe qwe', '2024-02-24 15:09:19', '2024-02-24 15:09:33', 1),
(9, 2, 'Stly qwe qwe', '2024-02-24 15:21:33', '2024-02-24 15:21:39', 1),
(10, 2, 'Style 4', '2024-02-25 06:51:35', '2024-02-25 07:09:21', 1),
(11, 5, 'Default', '2024-02-25 07:24:05', '2024-02-25 07:24:05', 0),
(12, 2, 'Stly qwe qwe', '2024-02-25 07:49:29', '2024-02-25 07:49:45', 1),
(13, 6, 'Default', '2024-02-29 04:28:10', '2024-02-29 04:28:10', 0),
(14, 6, 'dawdadadw12312', '2024-02-29 04:28:46', '2024-02-29 04:28:46', 0),
(15, 6, '@#$%^&amp;*()_+', '2024-02-29 04:28:56', '2024-02-29 04:29:19', 1),
(16, 7, 'Default', '2024-02-29 04:38:12', '2024-02-29 04:38:12', 0),
(17, 4, 'Style sasaiya', '2024-02-29 04:42:31', '2024-02-29 04:42:31', 0),
(18, 6, 'qweqw', '2024-03-10 12:29:57', '2024-03-10 12:29:57', 0),
(19, 6, 'qweqwe', '2024-03-10 12:30:01', '2024-03-10 12:30:01', 0),
(20, 6, 'ytuiyu', '2024-03-10 12:30:05', '2024-03-10 12:30:05', 0),
(21, 6, 'fvghfgh', '2024-03-10 12:30:10', '2024-03-10 12:30:10', 0),
(22, 2, 'Style 4', '2024-03-11 04:35:46', '2024-03-11 04:35:46', 0);

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
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `college`
--
ALTER TABLE `college`
  MODIFY `college_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `measurement`
--
ALTER TABLE `measurement`
  MODIFY `measurement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `moderator`
--
ALTER TABLE `moderator`
  MODIFY `moderator_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_desc`
--
ALTER TABLE `product_desc`
  MODIFY `desc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `semester_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `store_staff`
--
ALTER TABLE `store_staff`
  MODIFY `store_staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `variation`
--
ALTER TABLE `variation`
  MODIFY `variation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
-- Constraints for table `measurement`
--
ALTER TABLE `measurement`
  ADD CONSTRAINT `fk_meapro` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `moderator`
--
ALTER TABLE `moderator`
  ADD CONSTRAINT `fk_accmod` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`),
  ADD CONSTRAINT `fk_colmod` FOREIGN KEY (`college_id`) REFERENCES `college` (`college_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_procat` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`),
  ADD CONSTRAINT `fk_prostr` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`);

--
-- Constraints for table `product_desc`
--
ALTER TABLE `product_desc`
  ADD CONSTRAINT `fk_prodes` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `fk_proimg` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `fk_stomea` FOREIGN KEY (`measurement_id`) REFERENCES `measurement` (`measurement_id`),
  ADD CONSTRAINT `fk_stopro` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `fk_stovar` FOREIGN KEY (`variation_id`) REFERENCES `variation` (`variation_id`);

--
-- Constraints for table `store`
--
ALTER TABLE `store`
  ADD CONSTRAINT `fk_colstor` FOREIGN KEY (`college_id`) REFERENCES `college` (`college_id`);

--
-- Constraints for table `store_staff`
--
ALTER TABLE `store_staff`
  ADD CONSTRAINT `fk_stfacc` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`),
  ADD CONSTRAINT `fk_stfsto` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`);

--
-- Constraints for table `variation`
--
ALTER TABLE `variation`
  ADD CONSTRAINT `fk_varpro` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
