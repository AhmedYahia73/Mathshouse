-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2024 at 09:18 AM
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
-- Database: `math_house`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_carts`
--

CREATE TABLE `academic_carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `chapter_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lesson_id` bigint(20) UNSIGNED DEFAULT NULL,
  `group_id` bigint(20) UNSIGNED DEFAULT NULL,
  `student_id` bigint(20) UNSIGNED DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address_line_1` varchar(191) NOT NULL,
  `address_line_2` varchar(191) DEFAULT NULL,
  `city` varchar(191) NOT NULL,
  `postal_code` varchar(191) NOT NULL,
  `state` varchar(191) NOT NULL,
  `country` varchar(191) NOT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_roles`
--

CREATE TABLE `admin_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_admin_id` bigint(20) UNSIGNED NOT NULL,
  `admin_role` enum('Admin','User Wallet','Users','Payment','Courses','Settings','Live','Packages','ReportIssues','Slider','Affilate','Marketing','Reports') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_roles`
--

INSERT INTO `admin_roles` (`id`, `user_admin_id`, `admin_role`, `created_at`, `updated_at`) VALUES
(88, 7, 'Admin', '2024-04-20 07:33:30', '2024-04-20 07:33:30'),
(89, 7, 'Users', '2024-04-20 07:33:30', '2024-04-20 07:33:30'),
(100, 6, 'Admin', '2024-05-14 10:21:33', '2024-05-14 10:21:33'),
(101, 6, 'Users', '2024-05-14 10:21:33', '2024-05-14 10:21:33'),
(102, 6, 'Courses', '2024-05-14 10:21:33', '2024-05-14 10:21:33'),
(103, 6, 'Settings', '2024-05-14 10:21:33', '2024-05-14 10:21:33'),
(104, 6, 'Live', '2024-05-14 10:21:33', '2024-05-14 10:21:33'),
(110, 8, 'User Wallet', '2024-05-20 06:49:21', '2024-05-20 06:49:21'),
(111, 8, 'Payment', '2024-05-20 06:49:21', '2024-05-20 06:49:21'),
(113, 9, 'Admin', '2024-05-20 07:19:19', '2024-05-20 07:19:19'),
(114, 9, 'Users', '2024-05-20 07:19:19', '2024-05-20 07:19:19'),
(115, 9, 'Courses', '2024-05-20 07:19:19', '2024-05-20 07:19:19'),
(116, 9, 'Settings', '2024-05-20 07:19:19', '2024-05-20 07:19:19'),
(117, 10, 'Reports', '2024-05-21 09:59:22', '2024-05-21 09:59:22'),
(118, 10, 'User Wallet', '2024-05-21 09:59:22', '2024-05-21 09:59:22');

-- --------------------------------------------------------

--
-- Table structure for table `affilate`
--

CREATE TABLE `affilate` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `organization` varchar(255) DEFAULT NULL,
  `wallet` varchar(255) NOT NULL DEFAULT '0',
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `affilate`
--

INSERT INTO `affilate` (`id`, `user_id`, `organization`, `wallet`, `created_at`, `updated_at`) VALUES
(1, 5, 'Company', '1506.06', '2024-01-08', '2024-07-30'),
(2, 1, 'fd', '430.55', '2024-01-24', '2024-07-05'),
(6, 77, 'wego', '0', '2024-04-23', '2024-04-23'),
(8, 98, 'sdasd', '0', '2024-06-08', '2024-06-08');

-- --------------------------------------------------------

--
-- Table structure for table `affilate_requests`
--

CREATE TABLE `affilate_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `affilate_id` bigint(20) UNSIGNED NOT NULL,
  `service` varchar(255) NOT NULL,
  `earned` float NOT NULL,
  `payment_req_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `affilate_requests`
--

INSERT INTO `affilate_requests` (`id`, `affilate_id`, `service`, `earned`, `payment_req_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Course', 0, 164, '2024-05-17 11:31:38', '2024-05-17 11:31:38'),
(2, 1, 'Questions', 5.55, 166, '2024-05-17 11:46:43', '2024-05-17 11:46:43'),
(3, 1, 'Questions', 5.55, 167, '2024-05-17 11:48:05', '2024-05-17 11:48:05'),
(4, 1, 'Exams', 6, 173, '2024-05-17 12:05:34', '2024-05-17 12:05:34'),
(5, 1, 'Exams', 6, 174, '2024-05-17 12:06:26', '2024-05-17 12:06:26'),
(6, 1, 'Exams', 30, 176, '2024-05-17 12:07:33', '2024-05-17 12:07:33'),
(7, 1, 'Chapter', 7.1, 178, '2024-05-17 12:10:18', '2024-05-17 12:10:18'),
(8, 1, 'Chapter', 7.1, 182, '2024-05-17 12:23:04', '2024-05-17 12:23:04'),
(9, 1, 'Course', 475, 253, '2024-07-06 11:33:24', '2024-07-06 11:33:24'),
(10, 1, 'Course', 475, 254, '2024-07-06 11:47:02', '2024-07-06 11:47:02'),
(11, 1, 'Course', 475, 255, '2024-07-06 11:55:50', '2024-07-06 11:55:50'),
(12, 1, 'Course', 475, 258, '2024-07-06 12:20:49', '2024-07-06 12:20:49'),
(13, 1, 'Course', 475, 259, '2024-07-06 12:22:11', '2024-07-06 12:22:11'),
(14, 1, 'Exams', 60, 262, '2024-07-08 12:09:34', '2024-07-08 12:09:34'),
(15, 1, 'Questions', 83.25, 265, '2024-07-08 16:09:10', '2024-07-08 16:09:10'),
(16, 1, 'Course', 475, 267, '2024-07-10 11:07:10', '2024-07-10 11:07:10'),
(17, 1, 'Course', 237.5, 268, '2024-07-10 11:26:04', '2024-07-10 11:26:04'),
(18, 1, 'Course', 237.5, 269, '2024-07-10 11:27:54', '2024-07-10 11:27:54'),
(19, 1, 'Course', 187.5, 270, '2024-07-10 11:29:10', '2024-07-10 11:29:10'),
(20, 1, 'Chapter', 12.5, 274, '2024-07-10 11:36:20', '2024-07-10 11:36:20'),
(21, 1, 'Chapter', 12.5, 275, '2024-07-10 11:36:42', '2024-07-10 11:36:42'),
(22, 1, 'Chapter', 12.5, 276, '2024-07-10 11:38:23', '2024-07-10 11:38:23'),
(23, 1, 'Chapter', 12.5, 277, '2024-07-10 11:43:23', '2024-07-10 11:43:23'),
(24, 1, 'Chapter', 12.5, 278, '2024-07-10 11:43:51', '2024-07-10 11:43:51'),
(25, 1, 'Chapter', 12.5, 279, '2024-07-10 11:44:44', '2024-07-10 11:44:44'),
(26, 1, 'Chapter', 12.5, 280, '2024-07-10 11:49:09', '2024-07-10 11:49:09'),
(27, 1, 'Chapter', 11.125, 281, '2024-07-10 11:50:21', '2024-07-10 11:50:21'),
(28, 1, 'Chapter', 11.125, 282, '2024-07-10 11:50:50', '2024-07-10 11:50:50');

-- --------------------------------------------------------

--
-- Table structure for table `affilate_services`
--

CREATE TABLE `affilate_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `affilate_id` bigint(20) UNSIGNED NOT NULL,
  `service` enum('Course','Chapter','Exams','Questions','Live Session') NOT NULL,
  `earned` float NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `affilate_services`
--

INSERT INTO `affilate_services` (`id`, `affilate_id`, `service`, `earned`, `created_at`, `updated_at`) VALUES
(1, 1, 'Course', 400, NULL, NULL),
(2, 1, 'Chapter', 200, NULL, NULL),
(3, 2, 'Questions', 5.55, '2024-04-26 14:58:59', '2024-04-26 14:58:59'),
(4, 1, 'Questions', 5.55, '2024-04-26 15:02:03', '2024-04-26 15:02:03'),
(5, 1, 'Course', 0, '2024-04-27 07:45:30', '2024-04-27 07:45:30'),
(6, 1, 'Exams', 6, '2024-05-01 07:45:20', '2024-05-01 07:45:20'),
(7, 1, 'Course', 0, '2024-05-08 11:25:59', '2024-05-08 11:25:59'),
(8, 1, 'Course', 0, '2024-05-08 11:31:11', '2024-05-08 11:31:11'),
(9, 1, 'Course', 0, '2024-05-13 08:55:29', '2024-05-13 08:55:29'),
(10, 1, 'Course', 0, '2024-05-13 08:56:50', '2024-05-13 08:56:50'),
(11, 1, 'Course', 0, '2024-05-13 08:57:06', '2024-05-13 08:57:06'),
(12, 1, 'Course', 0, '2024-05-13 08:57:25', '2024-05-13 08:57:25'),
(13, 1, 'Course', 0, '2024-05-13 08:57:46', '2024-05-13 08:57:46'),
(14, 1, 'Course', 0, '2024-05-13 08:58:20', '2024-05-13 08:58:20'),
(15, 1, 'Course', 0, '2024-05-13 08:58:46', '2024-05-13 08:58:46'),
(16, 1, 'Questions', 5.55, '2024-05-13 09:01:48', '2024-05-13 09:01:48'),
(17, 1, 'Course', 0, '2024-05-17 11:33:39', '2024-05-17 11:33:39'),
(18, 1, 'Course', 0, '2024-05-17 11:35:18', '2024-05-17 11:35:18'),
(19, 1, 'Questions', 5.55, '2024-05-17 11:48:46', '2024-05-17 11:48:46'),
(20, 1, 'Questions', 5.55, '2024-05-17 11:51:15', '2024-05-17 11:51:15'),
(21, 1, 'Questions', 5.55, '2024-05-17 11:54:11', '2024-05-17 11:54:11'),
(22, 1, 'Exams', 6, '2024-05-17 11:57:40', '2024-05-17 11:57:40'),
(23, 1, 'Exams', 6, '2024-05-17 12:06:47', '2024-05-17 12:06:47'),
(24, 1, 'Live Session', 30, '2024-05-17 12:07:55', '2024-05-17 12:07:55'),
(25, 1, 'Chapter', 7.1, '2024-05-17 12:26:28', '2024-05-17 12:26:28'),
(26, 1, 'Chapter', 7.1, '2024-05-17 12:26:40', '2024-05-17 12:26:40'),
(27, 1, 'Chapter', 7.1, '2024-05-17 12:28:11', '2024-05-17 12:28:11'),
(28, 1, 'Chapter', 7.1, '2024-05-17 12:28:21', '2024-05-17 12:28:21'),
(29, 1, 'Exams', 30, '2024-05-17 12:28:32', '2024-05-17 12:28:32'),
(30, 1, 'Exams', 6, '2024-05-17 12:28:42', '2024-05-17 12:28:42'),
(31, 1, 'Exams', 6, '2024-05-17 12:28:53', '2024-05-17 12:28:53'),
(32, 1, 'Course', 0, '2024-05-22 08:07:03', '2024-05-22 08:07:03'),
(33, 1, 'Exams', 0, '2024-05-22 08:07:49', '2024-05-22 08:07:49'),
(34, 1, 'Exams', 6, '2024-05-22 08:35:11', '2024-05-22 08:35:11'),
(35, 1, 'Chapter', 0, '2024-07-05 11:12:54', '2024-07-05 11:12:54'),
(36, 1, 'Chapter', 25, '2024-07-05 11:16:05', '2024-07-05 11:16:05'),
(37, 1, 'Chapter', 25, '2024-07-05 11:20:16', '2024-07-05 11:20:16'),
(38, 1, 'Questions', 111, '2024-07-05 14:57:37', '2024-07-05 14:57:37'),
(39, 1, 'Questions', 111, '2024-07-05 15:14:27', '2024-07-05 15:14:27'),
(40, 1, 'Questions', 111, '2024-07-05 15:15:46', '2024-07-05 15:15:46'),
(41, 1, 'Questions', 111, '2024-07-05 15:16:49', '2024-07-05 15:16:49'),
(42, 1, 'Questions', 83.25, '2024-07-05 15:19:58', '2024-07-05 15:19:58'),
(43, 1, 'Questions', 83.25, '2024-07-05 15:21:42', '2024-07-05 15:21:42'),
(44, 1, 'Exams', 60, '2024-07-05 15:23:52', '2024-07-05 15:23:52'),
(45, 1, 'Course', 475, '2024-07-05 15:36:34', '2024-07-05 15:36:34'),
(46, 1, 'Course', 375, '2024-07-05 15:45:08', '2024-07-05 15:45:08'),
(47, 1, 'Chapter', 25, '2024-07-05 15:49:43', '2024-07-05 15:49:43'),
(48, 1, 'Chapter', 25, '2024-07-05 15:52:22', '2024-07-05 15:52:22'),
(49, 1, 'Chapter', 25, '2024-07-05 15:53:39', '2024-07-05 15:53:39'),
(50, 1, 'Chapter', 22.25, '2024-07-05 15:54:59', '2024-07-05 15:54:59'),
(51, 1, 'Course', 475, '2024-07-06 11:56:20', '2024-07-06 11:56:20'),
(52, 1, 'Course', 475, '2024-07-06 12:19:51', '2024-07-06 12:19:51'),
(53, 1, 'Chapter', 22.25, '2024-07-07 14:43:01', '2024-07-07 14:43:01'),
(54, 1, 'Exams', 60, '2024-07-08 11:50:40', '2024-07-08 11:50:40'),
(55, 1, 'Questions', 111, '2024-07-08 12:13:42', '2024-07-08 12:13:42'),
(56, 1, 'Questions', 83.25, '2024-07-08 12:16:33', '2024-07-08 12:16:33'),
(57, 1, 'Course', 475, '2024-07-10 11:04:25', '2024-07-10 11:04:25'),
(58, 1, 'Course', 475, '2024-07-10 11:13:49', '2024-07-10 11:13:49'),
(59, 1, 'Course', 237.5, '2024-07-10 11:26:28', '2024-07-10 11:26:28'),
(60, 1, 'Course', 237.5, '2024-07-10 11:27:20', '2024-07-10 11:27:20'),
(61, 1, 'Course', 237.5, '2024-07-10 11:28:06', '2024-07-10 11:28:06'),
(62, 1, 'Course', 187.5, '2024-07-10 11:29:22', '2024-07-10 11:29:22'),
(63, 1, 'Course', 187.5, '2024-07-10 11:29:52', '2024-07-10 11:29:52'),
(64, 1, 'Chapter', 11.125, '2024-07-10 11:30:43', '2024-07-10 11:30:43'),
(65, 1, 'Chapter', 11.125, '2024-07-10 11:33:24', '2024-07-10 11:33:24'),
(66, 1, 'Chapter', 12.5, '2024-07-10 11:36:36', '2024-07-10 11:36:36'),
(67, 1, 'Chapter', 12.5, '2024-07-10 11:38:34', '2024-07-10 11:38:34'),
(68, 1, 'Chapter', 12.5, '2024-07-10 11:43:35', '2024-07-10 11:43:35'),
(69, 1, 'Chapter', 12.5, '2024-07-10 11:45:13', '2024-07-10 11:45:13'),
(70, 1, 'Chapter', 12.5, '2024-07-10 11:48:04', '2024-07-10 11:48:04'),
(71, 1, 'Chapter', 12.5, '2024-07-10 11:50:27', '2024-07-10 11:50:27'),
(72, 1, 'Chapter', 11.125, '2024-07-10 11:51:09', '2024-07-10 11:51:09'),
(73, 1, 'Chapter', 11.125, '2024-07-10 11:51:50', '2024-07-10 11:51:50'),
(74, 1, 'Questions', 31.2188, '2024-07-10 12:59:32', '2024-07-10 12:59:32'),
(75, 1, 'Questions', 31.2188, '2024-07-10 13:01:25', '2024-07-10 13:01:25'),
(76, 1, 'Questions', 31.2188, '2024-07-10 13:05:23', '2024-07-10 13:05:23'),
(77, 1, 'Questions', 55.5, '2024-07-10 13:05:49', '2024-07-10 13:05:49'),
(78, 1, 'Questions', 55.5, '2024-07-10 13:06:09', '2024-07-10 13:06:09'),
(79, 1, 'Questions', 55.5, '2024-07-10 13:06:33', '2024-07-10 13:06:33'),
(80, 1, 'Questions', 55.5, '2024-07-10 13:06:48', '2024-07-10 13:06:48'),
(81, 1, 'Exams', 30, '2024-07-14 12:24:11', '2024-07-14 12:24:11'),
(82, 1, 'Exams', 30, '2024-07-14 12:55:51', '2024-07-14 12:55:51'),
(83, 1, 'Questions', 55.5, '2024-07-15 12:30:24', '2024-07-15 12:30:24'),
(84, 1, 'Questions', 55.5, '2024-07-15 12:47:28', '2024-07-15 12:47:28'),
(85, 1, 'Questions', 55.5, '2024-07-15 12:47:59', '2024-07-15 12:47:59'),
(86, 1, 'Questions', 55.5, '2024-07-15 12:48:58', '2024-07-15 12:48:58'),
(87, 1, 'Questions', 55.5, '2024-07-15 12:49:06', '2024-07-15 12:49:06'),
(88, 1, 'Questions', 55.5, '2024-07-15 12:49:51', '2024-07-15 12:49:51'),
(89, 1, 'Questions', 55.5, '2024-07-15 12:50:10', '2024-07-15 12:50:10'),
(90, 1, 'Questions', 55.5, '2024-07-15 12:50:26', '2024-07-15 12:50:26'),
(91, 1, 'Questions', 55.5, '2024-07-15 12:56:46', '2024-07-15 12:56:46'),
(92, 1, 'Questions', 55.5, '2024-07-15 12:57:03', '2024-07-15 12:57:03'),
(93, 1, 'Questions', 55.5, '2024-07-15 12:57:49', '2024-07-15 12:57:49'),
(94, 1, 'Exams', 30, '2024-07-15 13:02:02', '2024-07-15 13:02:02'),
(95, 1, 'Exams', 30, '2024-07-15 13:04:28', '2024-07-15 13:04:28'),
(96, 1, 'Questions', 55.5, '2024-07-16 12:21:24', '2024-07-16 12:21:24'),
(97, 1, 'Course', 8.97, '2024-07-16 12:30:55', '2024-07-16 12:30:55'),
(98, 1, 'Chapter', 3.06, '2024-07-16 12:37:20', '2024-07-16 12:37:20'),
(99, 1, 'Chapter', 3.06, '2024-07-16 12:40:09', '2024-07-16 12:40:09'),
(100, 1, 'Course', 8.97, '2024-07-16 12:40:43', '2024-07-16 12:40:43'),
(101, 1, 'Questions', 55.5, '2024-07-16 12:50:02', '2024-07-16 12:50:02'),
(102, 1, 'Questions', 55.5, '2024-07-16 12:50:36', '2024-07-16 12:50:36'),
(103, 1, 'Questions', 55.5, '2024-07-16 12:51:36', '2024-07-16 12:51:36'),
(104, 1, 'Questions', 55.5, '2024-07-20 10:18:44', '2024-07-20 10:18:44'),
(105, 1, 'Questions', 55.5, '2024-07-20 10:50:35', '2024-07-20 10:50:35'),
(106, 1, 'Questions', 55.5, '2024-07-20 10:52:54', '2024-07-20 10:52:54'),
(107, 1, 'Exams', 30, '2024-07-20 10:55:11', '2024-07-20 10:55:11'),
(108, 1, 'Questions', 55.5, '2024-07-22 12:13:59', '2024-07-22 12:13:59'),
(109, 1, 'Questions', 55.5, '2024-07-27 16:04:28', '2024-07-27 16:04:28'),
(110, 1, 'Questions', 55.5, '2024-07-30 09:19:16', '2024-07-30 09:19:16');

-- --------------------------------------------------------

--
-- Table structure for table `cancel_session`
--

CREATE TABLE `cancel_session` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `session_id` bigint(20) UNSIGNED NOT NULL,
  `statue` enum('Pendding','Approve','Rejected') NOT NULL DEFAULT 'Pendding',
  `date` date NOT NULL,
  `time` time NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cancel_session`
--

INSERT INTO `cancel_session` (`id`, `user_id`, `session_id`, `statue`, `date`, `time`, `created_at`, `updated_at`) VALUES
(2, 5, 8, 'Pendding', '2024-04-10', '19:59:34', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cate_name` varchar(191) NOT NULL,
  `cate_des` text NOT NULL,
  `cate_url` varchar(191) NOT NULL DEFAULT 'Default.jfif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `teacher_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cate_name`, `cate_des`, `cate_url`, `created_at`, `updated_at`, `teacher_id`) VALUES
(1, 'Category 1', 'Category One', '6362024X03X09X09X44X1532023X11X28X08X45X14pexelsXrevacXfilm\'s&photographyX205337.jpg', NULL, '2024-03-09 07:44:15', 1),
(8, 'category Three', 'category Three', '9202024X03X09X09X44X26622023X12X11X13X53X39pexelsXriccardoXbertoloX4245826.jpg', '2024-02-05 10:52:50', '2024-03-09 07:44:26', 8),
(9, 'American Doploma', 'hello', '7922024X02X19X07X46X04202301101725mvf_dark_logo.png', '2024-02-19 05:46:04', '2024-02-19 05:46:04', 8);

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chapter_name` varchar(191) NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `ch_des` text NOT NULL,
  `ch_url` varchar(255) NOT NULL DEFAULT 'Default.jfif',
  `pre_requisition` text DEFAULT NULL,
  `gain` text DEFAULT NULL,
  `teacher_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chapters`
--

INSERT INTO `chapters` (`id`, `chapter_name`, `course_id`, `ch_des`, `ch_url`, `pre_requisition`, `gain`, `teacher_id`, `created_at`, `updated_at`) VALUES
(4, 'Chapter 1', 1, 'Chapter One', 'Default.jfif', 'to', 'what', 1, NULL, '2024-04-18 14:29:28'),
(6, 'Chapter 26', 1, 'errw', '20230826085456153827_2318787155110616_6392255175880343552_n.jpg', 'jfdgh', 'o', 5, '2024-01-03 00:35:50', '2024-04-30 13:36:52'),
(20, 'Chapter 32', 4, 'arwrwe', 'Default.jfif', 'asE', 'ERRWE', 44, NULL, '2024-05-18 11:47:20'),
(21, 'Chapter Two', 2, '', 'Default.jfif', 'sfer', 'wdfr', 1, NULL, NULL),
(22, 'Chapter One', 2, 'sdas', 'Default.jfif', 'asdasd', 'adsf', NULL, NULL, NULL),
(23, 'sr', 12, 'kjl', '842024X06X02X06X28X557.png', 'hmjhjk', 'jhkjl', 71, '2024-06-02 06:28:55', '2024-06-02 06:28:55'),
(24, 'sr', 12, 'asdfs', '2882024X06X02X06X29X407.png', 'cfvsd', 'dfsed', 71, '2024-06-02 06:29:40', '2024-06-02 11:57:39');

-- --------------------------------------------------------

--
-- Table structure for table `chapter_prices`
--

CREATE TABLE `chapter_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `duration` int(20) NOT NULL,
  `price` float NOT NULL,
  `discount` float NOT NULL,
  `chapter_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `chapter_prices`
--

INSERT INTO `chapter_prices` (`id`, `duration`, `price`, `discount`, `chapter_id`, `created_at`, `updated_at`) VALUES
(27, 50, 225, 22, 4, '2024-04-18', '2024-04-18'),
(28, 35, 9, 32, 4, '2024-04-18', '2024-04-18'),
(29, 13, 43, 12, 4, '2024-04-18', '2024-04-18'),
(30, 22, 25, 11, 6, '2024-04-30', '2024-04-30'),
(35, 1122, 10, 77, 20, '2024-05-18', '2024-05-18'),
(36, 1122, 33, 33, 20, '2024-05-18', '2024-05-18'),
(45, 33, 33, 2, 21, NULL, NULL),
(46, 44, 44, 2, 21, NULL, NULL),
(47, 33, 120, 2, 22, NULL, NULL),
(48, 21, 21, 12, 24, '2024-06-02', '2024-06-02');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `country_id`, `city`, `created_at`, `updated_at`) VALUES
(2, '5', 'Karachi', NULL, NULL),
(8, '61', 'Alexandria', NULL, NULL),
(9, '61', 'Aswan', NULL, NULL),
(10, '61', 'Asyut', NULL, NULL),
(11, '61', 'Damanhur', NULL, NULL),
(12, '61', 'Marsa Matruh', NULL, NULL),
(13, '10', 'Port Said', NULL, NULL),
(14, '61', 'Luxor', NULL, NULL),
(15, '61', 'Faiyum', NULL, NULL),
(16, '61', 'Giza', NULL, NULL),
(17, '61', 'Cairo', NULL, NULL),
(18, '61', 'Hurghada', NULL, NULL),
(19, '61', 'Sharm El Sheikh', NULL, NULL),
(20, '7', 'Abha', NULL, NULL),
(21, '7', 'Ad-Dilam', NULL, NULL),
(22, '7', 'Al-Abwa', NULL, NULL),
(23, '7', 'Al Artaweeiyah', NULL, NULL),
(25, '7', 'Al Bukayriyah', NULL, NULL),
(26, '7', 'Badr', NULL, NULL),
(27, '7', 'Baljurashi', NULL, NULL),
(28, '7', 'Bisha', NULL, NULL),
(29, '7', 'Bareq', NULL, NULL),
(30, '7', 'Buraydah', NULL, NULL),
(31, '7', 'Buraydah', NULL, NULL),
(32, '7', 'Al Bahah', NULL, NULL),
(33, '7', 'Buqaa', NULL, NULL),
(34, '7', 'Dammam', NULL, NULL),
(35, '7', 'Dhahran', NULL, NULL),
(36, '7', 'Dhurma', NULL, NULL),
(37, '7', 'Dahaban', NULL, NULL),
(38, '7', 'Diriyah', NULL, NULL),
(39, '7', 'Duba', NULL, NULL),
(40, '7', 'Dumat Al-Jandal', NULL, NULL),
(41, '7', 'Dawadmi', NULL, NULL),
(42, '7', 'Farasan', NULL, NULL),
(43, '7', 'Gatgat', NULL, NULL),
(44, '7', 'Gerrha', NULL, NULL),
(45, '7', 'Ghawiyah', NULL, NULL),
(46, '7', 'Al-Gwei\'iyyah', NULL, NULL),
(47, '7', 'Hautat Sudair', NULL, NULL),
(48, '7', 'Habaala', NULL, NULL),
(49, '7', 'Hajrah', NULL, NULL),
(50, '7', 'Haql', NULL, NULL),
(51, '7', 'Al-Hareeq', NULL, NULL),
(52, '7', 'Harmah', NULL, NULL),
(53, '7', 'Ha\'il', NULL, NULL),
(54, '7', 'Hotat Bani Tamim', NULL, NULL),
(55, '7', 'Hofuf', NULL, NULL),
(56, '7', 'Huraymila', NULL, NULL),
(57, '7', 'Hafr Al-Batin', NULL, NULL),
(58, '7', 'Jabal Umm al Ru\'us', NULL, NULL),
(59, '7', 'Jalajil', NULL, NULL),
(60, '7', 'Jeddah', NULL, NULL),
(61, '7', 'Jizan', NULL, NULL),
(62, '7', 'Jizan Economic City', NULL, NULL),
(63, '7', 'Jubail', NULL, NULL),
(64, '7', 'Al Jafr', NULL, NULL),
(65, '7', 'Khafji', NULL, NULL),
(66, '7', 'Khaybar', NULL, NULL),
(67, '7', 'King Abdullah Economic City', NULL, NULL),
(68, '7', 'Khamis Mushait', NULL, NULL),
(69, '7', 'Al-Saih', NULL, NULL),
(70, '7', 'Knowledge Economic City, Medina', NULL, NULL),
(71, '7', 'Khobar', NULL, NULL),
(72, '7', 'Al-Khutt', NULL, NULL),
(73, '7', 'Layla', NULL, NULL),
(74, '7', 'Lihyan', NULL, NULL),
(75, '7', 'Al Lith', NULL, NULL),
(76, '7', 'Al Majma\'ah', NULL, NULL),
(77, '7', 'Mastoorah', NULL, NULL),
(78, '7', 'Al Mikhwah', NULL, NULL),
(79, '7', 'Al-Mubarraz', NULL, NULL),
(80, '7', 'Al Mawain', NULL, NULL),
(81, '7', 'Medina', NULL, NULL),
(82, '7', 'Mecca', NULL, NULL),
(83, '7', 'Muzahmiyya', NULL, NULL),
(84, '7', 'Najran', NULL, NULL),
(85, '7', 'Al-Namas', NULL, NULL),
(86, '7', 'Umluj', NULL, NULL),
(87, '7', 'Al-Omran', NULL, NULL),
(88, '7', 'Al-Oyoon', NULL, NULL),
(89, '7', 'Qadeimah', NULL, NULL),
(90, '7', 'Qatif', NULL, NULL),
(91, '7', 'Qaisumah', NULL, NULL),
(92, '7', 'Al Qunfudhah', NULL, NULL),
(93, '7', 'Qurayyat', NULL, NULL),
(94, '7', 'Rabigh', NULL, NULL),
(96, '7', 'Rafha', NULL, NULL),
(97, '7', 'Ar Rass', NULL, NULL),
(98, '7', 'Ras Tanura', NULL, NULL),
(99, '7', 'Ranyah', NULL, NULL),
(100, '7', 'Riyadh', NULL, NULL),
(101, '7', 'Riyadh Al-Khabra', NULL, NULL),
(102, '7', 'Rumailah', NULL, NULL),
(103, '7', 'Sabt Al Alaya', NULL, NULL),
(104, '7', 'Sarat Abidah', NULL, NULL),
(105, '7', 'Saihat', NULL, NULL),
(106, '7', 'Safwa city', NULL, NULL),
(107, '7', 'Sakakah', NULL, NULL),
(108, '7', 'Sharurah', NULL, NULL),
(109, '7', 'Shaqraa', NULL, NULL),
(110, '7', 'Shaybah', NULL, NULL),
(111, '7', 'As Sulayyil', NULL, NULL),
(112, '7', 'Taif', NULL, NULL),
(113, '7', 'Tabuk', NULL, NULL),
(114, '7', 'Tanomah', NULL, NULL),
(115, '7', 'Tarout', NULL, NULL),
(116, '7', 'Tayma', NULL, NULL),
(117, '7', 'Thadiq', NULL, NULL),
(118, '7', 'Thuwal', NULL, NULL),
(119, '7', 'Thuqbah', NULL, NULL),
(120, '7', 'Turaif', NULL, NULL),
(121, '7', 'Tabarjal', NULL, NULL),
(122, '7', 'Udhailiyah', NULL, NULL),
(123, '7', 'Al-\'Ula', NULL, NULL),
(124, '7', 'Um Al-Sahek', NULL, NULL),
(125, '7', 'Unaizah', NULL, NULL),
(126, '7', 'Uqair', NULL, NULL),
(127, '7', '\'Uyayna', NULL, NULL),
(128, '7', 'Uyun AlJiwa', NULL, NULL),
(129, '7', 'Wadi Al-Dawasir', NULL, NULL),
(130, '7', 'Al Wajh', NULL, NULL),
(131, '7', 'Yanbu', NULL, NULL),
(132, '7', 'Az Zaimah', NULL, NULL),
(133, '7', 'Zulfi', NULL, NULL),
(134, '195', 'Dubai', NULL, NULL),
(135, '195', 'Abu Dhabi', NULL, NULL),
(136, '195', 'Sharjah', NULL, NULL),
(137, '195', 'Al Ain', NULL, NULL),
(138, '195', 'Ajman', NULL, NULL),
(139, '195', 'Ras Al Khaimah', NULL, NULL),
(140, '195', 'Fujairah', NULL, NULL),
(141, '195', 'Umm al-Quwain', NULL, NULL),
(142, '190', 'Istanbul', NULL, NULL),
(143, '190', 'Ankara', NULL, NULL),
(144, '190', 'Izmir', NULL, NULL),
(145, '190', 'Bursa', NULL, NULL),
(146, '103', 'Beirut', NULL, NULL),
(147, '103', 'Tripoli', NULL, NULL),
(148, '103', 'Sidon', NULL, NULL),
(149, '103', 'Tyre', NULL, NULL),
(150, '103', 'Nabatîyé et Tahta', NULL, NULL),
(151, '103', 'Habboûch', NULL, NULL),
(152, '103', 'Jounieh', NULL, NULL),
(153, '103', 'Zahle', NULL, NULL),
(154, '103', 'Ghazieh', NULL, NULL),
(155, '103', 'Baalbek', NULL, NULL),
(156, '103', 'En Nâqoûra', NULL, NULL),
(157, '103', 'Byblos', NULL, NULL),
(158, '151', 'Doha', NULL, NULL),
(159, '151', 'Abu az Zuluf', NULL, NULL),
(160, '151', 'Abu Thaylah', NULL, NULL),
(161, '151', 'Ad Dawhah al Jadidah', NULL, NULL),
(162, '151', 'Al `Arish', NULL, NULL),
(163, '151', 'Al Bida` ash Sharqiyah', NULL, NULL),
(164, '151', 'Al Ghanim', NULL, NULL),
(165, '151', 'Al Ghuwariyah', NULL, NULL),
(166, '151', 'Al Hilal al Gharbiyah', NULL, NULL),
(167, '151', 'Al Hilal ash Sharqiyah', NULL, NULL),
(168, '151', 'Al Hitmi', NULL, NULL),
(169, '151', 'Al Jasrah', NULL, NULL),
(170, '151', 'Al Jumaliyah', NULL, NULL),
(171, '151', 'Al Ka`biyah', NULL, NULL),
(172, '151', 'Al Khalifat', NULL, NULL),
(173, '151', 'Al Khor', NULL, NULL),
(174, '151', 'Al Khawr', NULL, NULL),
(175, '151', 'Al Khuwayr', NULL, NULL),
(176, '151', 'Al Mafjar', NULL, NULL),
(177, '151', 'Al Qa`abiyah', NULL, NULL),
(178, '151', 'Al Wakrah', NULL, NULL),
(179, '151', 'Al `Adhbah', NULL, NULL),
(180, '151', 'An Najmah', NULL, NULL),
(181, '151', 'Ar Rakiyat', NULL, NULL),
(182, '151', 'Al Rayyan', NULL, NULL),
(183, '151', 'Ar Ru\'ays', NULL, NULL),
(184, '151', 'As Salatah', NULL, NULL),
(185, '151', 'As Salatah al Jadidah', NULL, NULL),
(186, '151', 'As Sani`', NULL, NULL),
(187, '151', 'As Sawq', NULL, NULL),
(188, '151', 'Ath Thaqab', NULL, NULL),
(189, '151', 'Blaré', NULL, NULL),
(190, '151', 'Dukhan', NULL, NULL),
(191, '151', 'Ras Laffan Industrial City', NULL, NULL),
(192, '151', 'Umm Bab', NULL, NULL),
(193, '151', 'Umm Sa\'id', NULL, NULL),
(194, '151', 'Umm Salal Ali', NULL, NULL),
(195, '151', 'Umm Salal Mohammed', NULL, NULL),
(196, '22', 'Manama', NULL, NULL),
(197, '22', 'Riffa', NULL, NULL),
(198, '22', 'Muharraq', NULL, NULL),
(199, '22', 'Hamad Town', NULL, NULL),
(200, '22', 'A\'ali', NULL, NULL),
(201, '22', 'Isa Town', NULL, NULL),
(202, '22', 'Sitra', NULL, NULL),
(203, '22', 'Budaiya', NULL, NULL),
(204, '22', 'Jidhafs', NULL, NULL),
(205, '22', 'Al-Malikiyah', NULL, NULL),
(206, '114', 'Malé', NULL, NULL),
(207, '114', 'Fuvahmulah', NULL, NULL),
(208, '114', 'Hithadhoo', NULL, NULL),
(209, '114', 'Kulhudhuffushi', NULL, NULL),
(210, '114', 'Thinadhoo', NULL, NULL),
(211, '114', 'Naifaru', NULL, NULL),
(212, '114', 'Hulhumale', NULL, NULL),
(213, '114', 'Dhihdhoo', NULL, NULL),
(214, '114', 'Maafushi', NULL, NULL),
(215, '114', 'Maafushi', NULL, NULL),
(216, '114', 'Viligili', NULL, NULL),
(217, '114', 'Funadhoo', NULL, NULL),
(218, '114', 'Eydhafushi', NULL, NULL),
(219, '190', 'Adana', NULL, NULL),
(220, '190', 'Gaziantep', NULL, NULL),
(221, '190', 'Konya', NULL, NULL),
(222, '190', 'Konya', NULL, NULL),
(223, '190', 'Kayseri', NULL, NULL),
(224, '190', 'Mersin', NULL, NULL),
(225, '190', 'Eskisehir', NULL, NULL),
(226, '190', 'Diyarbakir', NULL, NULL),
(227, '190', 'Samsun', NULL, NULL),
(228, '190', 'Denizli', NULL, NULL),
(229, '190', 'Sanliurfa', NULL, NULL),
(230, '190', 'Adapazari', NULL, NULL),
(231, '190', 'Malatya', NULL, NULL),
(232, '190', 'Kahramanmaras', NULL, NULL),
(233, '190', 'Erzurum', NULL, NULL),
(234, '190', 'Van', NULL, NULL),
(235, '190', 'Batman', NULL, NULL),
(236, '190', 'Elazig', NULL, NULL),
(237, '190', 'Izmit', NULL, NULL),
(238, '190', 'Manisa', NULL, NULL),
(239, '190', 'Sivas', NULL, NULL),
(240, '190', 'Sivas', NULL, NULL),
(241, '190', 'Sivas', NULL, NULL),
(242, '190', 'Gebze', NULL, NULL),
(243, '190', 'Balikesir', NULL, NULL),
(244, '190', 'Tarsus', NULL, NULL),
(246, '190', 'Kutahya', NULL, NULL),
(247, '190', 'Trabzon', NULL, NULL),
(248, '190', 'Corum', NULL, NULL),
(249, '190', 'Corlu', NULL, NULL),
(250, '190', 'Adiyaman', NULL, NULL),
(252, '190', 'Osmaniye', NULL, NULL),
(253, '190', 'Kirikkale', NULL, NULL),
(254, '190', 'Antakya', NULL, NULL),
(255, '190', 'Aydin', NULL, NULL),
(256, '190', 'Iskenderun', NULL, NULL),
(257, '190', 'Usak', NULL, NULL),
(258, '190', 'Aksaray', NULL, NULL),
(259, '197', 'New York', NULL, NULL),
(260, '197', 'Los Angeles', NULL, NULL),
(261, '197', 'Chicago', NULL, NULL),
(262, '197', 'Houston', NULL, NULL),
(263, '197', 'Phoenix', NULL, NULL),
(264, '197', 'Philadelphia', NULL, NULL),
(265, '197', 'San Antonio', NULL, NULL),
(266, '197', 'San Diego', NULL, NULL),
(267, '197', 'Dallas', NULL, NULL),
(268, '197', 'San Jose', NULL, NULL),
(269, '197', 'Austin', NULL, NULL),
(270, '197', 'Jacksonville', NULL, NULL),
(271, '197', 'Fort Worth', NULL, NULL),
(272, '197', 'Columbus', NULL, NULL),
(273, '197', 'Indianapolis', NULL, NULL),
(274, '197', 'Charlotte', NULL, NULL),
(275, '197', 'San Francisco', NULL, NULL),
(276, '197', 'Seattle', NULL, NULL),
(277, '197', 'Denver', NULL, NULL),
(278, '197', 'Oklahoma City', NULL, NULL),
(279, '197', 'Nashville', NULL, NULL),
(280, '197', 'El Paso', NULL, NULL),
(281, '197', 'Washington', NULL, NULL),
(282, '197', 'Boston', NULL, NULL),
(283, '197', 'Las Vegas', NULL, NULL),
(284, '197', 'Portland', NULL, NULL),
(285, '197', 'Detroit', NULL, NULL),
(286, '197', 'Louisville', NULL, NULL),
(287, '197', 'Memphis', NULL, NULL),
(288, '197', 'Baltimore', NULL, NULL),
(289, '197', 'Milwaukee', NULL, NULL),
(290, '197', 'Albuquerque', NULL, NULL),
(291, '197', 'Sacramento', NULL, NULL),
(292, '197', 'Kansas City', NULL, NULL),
(293, '197', 'Atlanta', NULL, NULL),
(294, '197', 'Georgia', NULL, NULL),
(295, '197', 'California', NULL, NULL),
(296, '197', 'Omaha', NULL, NULL),
(297, '197', 'Raleigh', NULL, NULL),
(298, '197', 'Virginia Beach', NULL, NULL),
(299, '197', 'Virginia', NULL, NULL),
(300, '197', 'Miami', NULL, NULL),
(301, '197', 'Minneapolis', NULL, NULL),
(302, '197', 'Minnesota', NULL, NULL),
(303, '197', 'Wichita', NULL, NULL),
(304, '197', 'New Orleans', NULL, NULL),
(305, '197', 'Florida', NULL, NULL),
(306, '197', 'Hawaii', NULL, NULL),
(307, '197', 'Honolulu', NULL, NULL),
(308, '197', 'Texas', NULL, NULL),
(309, '197', 'Santa Ana', NULL, NULL),
(310, '197', 'New Jersey', NULL, NULL),
(311, '197', 'Newark', NULL, NULL),
(312, '197', 'Saint Paul', NULL, NULL),
(313, '197', 'Saint Paul', NULL, NULL),
(314, '197', 'Saint Paul', NULL, NULL),
(315, '197', 'Lincoln', NULL, NULL),
(316, '197', 'Anchorage', NULL, NULL),
(317, '197', 'Frisco', NULL, NULL),
(318, '197', 'Columbus', NULL, NULL),
(319, '197', 'Little Rock', NULL, NULL),
(320, '197', 'Mississippi', NULL, NULL),
(321, '197', 'Columbia', NULL, NULL),
(322, '197', 'Victorville', NULL, NULL),
(323, '197', 'Elizabeth', NULL, NULL),
(324, '197', 'Cambridge', NULL, NULL),
(325, '197', 'Manchester', NULL, NULL),
(326, '70', 'Paris', NULL, NULL),
(327, '70', 'Marseille', NULL, NULL),
(328, '70', 'Lyon', NULL, NULL),
(330, '70', 'Toulouse', NULL, NULL),
(331, '70', 'Nice', NULL, NULL),
(332, '70', 'Nantes', NULL, NULL),
(333, '70', 'Montpellier', NULL, NULL),
(334, '70', 'Strasbourg', NULL, NULL),
(335, '70', 'Bordeaux', NULL, NULL),
(336, '70', 'Lille', NULL, NULL),
(338, '70', 'Rennes', NULL, NULL),
(339, '70', 'Grenoble', NULL, NULL),
(340, '70', 'Rouen', NULL, NULL),
(341, '70', 'Avignon', NULL, NULL),
(342, '70', 'Saint Etienne', NULL, NULL),
(343, '70', 'Tours', NULL, NULL),
(344, '70', 'Clermont-Ferrand', NULL, NULL),
(345, '70', 'Nancy', NULL, NULL),
(346, '70', 'Orléans', NULL, NULL),
(347, '70', 'Caen', NULL, NULL),
(348, '70', 'Angers', NULL, NULL),
(349, '70', 'Metz', NULL, NULL),
(350, '70', 'Dijon', NULL, NULL),
(351, '70', 'Béthune', NULL, NULL),
(352, '70', 'Valenciennes', NULL, NULL),
(353, '70', 'Le Mans', NULL, NULL),
(354, '70', 'Reims', NULL, NULL),
(355, '70', 'Brest', NULL, NULL),
(356, '70', 'Perpignan', NULL, NULL),
(357, '70', 'Nîmes', NULL, NULL),
(358, '70', 'Nîmes', NULL, NULL),
(359, '70', 'Poitiers', NULL, NULL),
(360, '70', 'Besançon', NULL, NULL),
(361, '70', 'Annecy', NULL, NULL),
(362, '70', 'La Rochelle', NULL, NULL),
(363, '70', 'Chambéry', NULL, NULL),
(364, '70', '(Geneva) Annemasse', NULL, NULL),
(365, '70', 'Saint-Nazaire', NULL, NULL),
(366, '70', 'Valence', NULL, NULL),
(367, '70', 'Angoulême', NULL, NULL),
(368, '70', 'Maubeuge', NULL, NULL),
(369, '70', 'Montbéliard', NULL, NULL),
(370, '92', 'Rome', NULL, NULL),
(371, '92', 'Milan', NULL, NULL),
(372, '92', 'Naples', NULL, NULL),
(373, '92', 'Turin', NULL, NULL),
(374, '92', 'Palermo', NULL, NULL),
(375, '92', 'Genoa', NULL, NULL),
(376, '92', 'Bologna', NULL, NULL),
(377, '92', 'Florence', NULL, NULL),
(378, '92', 'Bari', NULL, NULL),
(379, '92', 'Catania', NULL, NULL),
(380, '92', 'Verona', NULL, NULL),
(381, '92', 'Venice', NULL, NULL),
(382, '92', 'Messina', NULL, NULL),
(383, '92', 'Padua', NULL, NULL),
(384, '92', 'Prato', NULL, NULL),
(385, '92', 'Trieste', NULL, NULL),
(386, '92', 'Brescia', NULL, NULL),
(387, '92', 'Parma', NULL, NULL),
(388, '92', 'Taranto', NULL, NULL),
(389, '92', 'Modena', NULL, NULL),
(390, '92', 'Perugia', NULL, NULL),
(391, '92', 'Ravenna', NULL, NULL),
(392, '92', 'Cagliari', NULL, NULL),
(393, '92', 'Foggia', NULL, NULL),
(394, '92', 'Trento', NULL, NULL),
(395, '92', 'Ancona', NULL, NULL),
(396, '92', 'Catanzaro', NULL, NULL),
(397, '92', 'Treviso', NULL, NULL),
(398, '92', 'L’Aquila', NULL, NULL),
(399, '92', 'Potenza', NULL, NULL),
(400, '92', 'Turin', NULL, NULL),
(401, '92', 'Piedmont', NULL, NULL),
(402, '92', 'Sicily', NULL, NULL),
(403, '92', 'Palermo', NULL, NULL),
(404, '92', 'Genoa', NULL, NULL),
(405, '92', 'Liguria', NULL, NULL),
(406, '92', 'Bologna', NULL, NULL),
(407, '92', 'Emilia-Romagna', NULL, NULL),
(408, '92', 'Florence', NULL, NULL),
(409, '92', 'Tuscany', NULL, NULL),
(410, '92', 'Bari', NULL, NULL),
(411, '92', 'Apulia', NULL, NULL),
(412, '92', 'Catania', NULL, NULL),
(413, '92', 'Verona', NULL, NULL),
(414, '92', 'Veneto', NULL, NULL),
(415, '92', 'Venice', NULL, NULL),
(416, '92', 'Messina', NULL, NULL),
(418, '92', 'Modena', NULL, NULL),
(419, '74', 'Berlin', NULL, NULL),
(420, '74', 'Hamburg', NULL, NULL),
(421, '74', 'Munich', NULL, NULL),
(422, '74', 'Stuttgart', NULL, NULL),
(423, '74', 'Frankfurt am Main', NULL, NULL),
(424, '74', 'Düsseldorf', NULL, NULL),
(425, '74', 'Leipzig', NULL, NULL),
(426, '74', 'Dresden', NULL, NULL),
(427, '74', 'Dortmund', NULL, NULL),
(428, '74', 'Bonn', NULL, NULL),
(429, '74', 'Essen', NULL, NULL),
(430, '74', 'Cologne', NULL, NULL),
(431, '74', 'Nuremberg', NULL, NULL),
(432, '74', 'Chemnitz', NULL, NULL),
(433, '74', 'Mannheim', NULL, NULL),
(434, '74', 'Mainz', NULL, NULL),
(435, '74', 'Braunschweig', NULL, NULL),
(436, '74', 'Osnabrück', NULL, NULL),
(437, '74', 'Frankfurt', NULL, NULL),
(438, '74', 'Kiel', NULL, NULL),
(439, '74', 'Magdeburg', NULL, NULL),
(440, '74', 'Mainz', NULL, NULL),
(441, '74', 'Erfurt', NULL, NULL),
(442, '74', 'Potsdam', NULL, NULL),
(443, '74', 'Saarbrücken', NULL, NULL),
(444, '74', 'Düsseldorf', NULL, NULL),
(445, '74', 'Leipzig', NULL, NULL),
(446, '74', 'Dortmund', NULL, NULL),
(447, '74', 'Bremen', NULL, NULL),
(448, '74', 'Duisburg', NULL, NULL),
(449, '74', 'Nuremberg', NULL, NULL),
(450, '74', 'Hanover', NULL, NULL),
(451, '174', 'Madrid', NULL, NULL),
(452, '174', 'Barcelona', NULL, NULL),
(453, '174', 'Valencia', NULL, NULL),
(454, '174', 'Seville', NULL, NULL),
(455, '174', 'Zaragoza', NULL, NULL),
(456, '174', 'Bilbao', NULL, NULL),
(457, '174', 'Córdoba', NULL, NULL),
(458, '174', 'Granada', NULL, NULL),
(459, '174', 'Málaga', NULL, NULL),
(460, '174', 'Alicante', NULL, NULL),
(461, '174', 'Palma', NULL, NULL),
(462, '174', 'Murcia', NULL, NULL),
(463, '174', 'Toledo', NULL, NULL),
(464, '174', 'Cádiz', NULL, NULL),
(465, '174', 'San Sebastian', NULL, NULL),
(466, '174', 'Salamanca', NULL, NULL),
(467, '174', 'Las Palmas', NULL, NULL),
(468, '174', 'Oviedo', NULL, NULL),
(469, '174', 'Valladolid', NULL, NULL),
(470, '174', 'Pamplona', NULL, NULL),
(471, '174', 'Santiago de Compostela', NULL, NULL),
(472, '174', 'Almería', NULL, NULL),
(473, '174', 'Girona', NULL, NULL),
(474, '174', 'Jerez de la Frontera', NULL, NULL),
(475, '132', 'Rotterdam', NULL, NULL),
(476, '132', 'The Hague', NULL, NULL),
(477, '132', 'Amsterdam', NULL, NULL),
(478, '132', 'Utrecht', NULL, NULL),
(479, '132', 'Eindhoven', NULL, NULL),
(480, '132', 'Groningen', NULL, NULL),
(481, '132', 'Haarlem', NULL, NULL),
(482, '132', 'Arnhem', NULL, NULL),
(483, '132', 'Breda', NULL, NULL),
(484, '132', '\'s-Hertogenbosch', NULL, NULL),
(485, '132', 'Nijmegen', NULL, NULL),
(486, '132', 'Zwolle', NULL, NULL),
(487, '132', 'Apeldoorn', NULL, NULL),
(488, '132', 'Zaanstad', NULL, NULL),
(489, '132', 'Den Helder', NULL, NULL),
(490, '113', 'Kuala Lumpur', NULL, NULL),
(491, '113', 'Ipoh', NULL, NULL),
(492, '113', 'George Town', NULL, NULL),
(493, '113', 'Kuching', NULL, NULL),
(494, '113', 'Malacca City', NULL, NULL),
(495, '113', 'Petaling Jaya', NULL, NULL),
(496, '113', 'Sandakan', NULL, NULL),
(497, '113', 'Kuala Terengganu', NULL, NULL),
(498, '113', 'Kota Bharu', NULL, NULL),
(499, '113', 'Kota Bharu', NULL, NULL),
(500, '113', 'Tawau', NULL, NULL),
(501, '113', 'Johor Bahru', NULL, NULL),
(502, '113', 'Kota Kinabalu', NULL, NULL),
(503, '113', 'Klang', NULL, NULL),
(504, '184', 'Bangkok', NULL, NULL),
(505, '184', 'Nonthaburi', NULL, NULL),
(506, '184', 'Pak Kret', NULL, NULL),
(507, '184', 'Hat Yai', NULL, NULL),
(508, '184', 'Chaophraya Surasak', NULL, NULL),
(509, '184', 'Surat Thani', NULL, NULL),
(510, '184', 'Nakhon Ratchasima', NULL, NULL),
(511, '184', 'Chiang Mai', NULL, NULL),
(512, '184', 'Udon Thani', NULL, NULL),
(513, '184', 'Pattaya', NULL, NULL),
(514, '184', 'Khon Kaen', NULL, NULL),
(515, '184', 'Nakhon Si Thammarat', NULL, NULL),
(516, '184', 'Laem Chabang', NULL, NULL),
(517, '184', 'Rangsit', NULL, NULL),
(518, '184', 'Nakhon Sawan', NULL, NULL),
(519, '184', 'Phuket', NULL, NULL),
(520, '184', 'Chiang Rai', NULL, NULL),
(521, '184', 'Ubon Ratchathani', NULL, NULL),
(522, '184', 'Nakhon Pathom', NULL, NULL),
(523, '184', 'Ko Samui', NULL, NULL),
(524, '184', 'Samut Sakhon', NULL, NULL),
(525, '184', 'Phitsanulok', NULL, NULL),
(526, '184', 'Rayong', NULL, NULL),
(527, '184', 'Songkhla', NULL, NULL),
(528, '184', 'Yala', NULL, NULL),
(529, '184', 'Trang', NULL, NULL),
(530, '184', 'Om Noi', NULL, NULL),
(531, '184', 'Sakon Nakhon', NULL, NULL),
(532, '184', 'Lampang', NULL, NULL),
(533, '184', 'Samut Prakan', NULL, NULL),
(534, '184', 'Phra Nakhon Si Ayutthaya', NULL, NULL),
(535, '184', 'Mae Sot', NULL, NULL),
(536, '61', 'Alexandria', NULL, NULL),
(538, '161', 'madina', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `commissions`
--

CREATE TABLE `commissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` enum('Course','Chapter','Exams','Questions','Live Session') NOT NULL,
  `precentage` float NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `commissions`
--

INSERT INTO `commissions` (`id`, `user_id`, `name`, `precentage`, `state`, `created_at`, `updated_at`) VALUES
(9, 2, 'Course', 11, 1, '2024-05-21', '2024-05-21'),
(10, 2, 'Chapter', 1, 1, '2024-05-21', '2024-05-21'),
(11, 6, 'Course', 12, 1, '2024-05-22', '2024-05-22'),
(12, 1, 'Course', 50, 1, '2024-07-05', '2024-07-05'),
(13, 1, 'Chapter', 50, 1, '2024-07-05', '2024-07-05'),
(14, 1, 'Exams', 50, 1, '2024-07-05', '2024-07-05'),
(15, 1, 'Questions', 50, 1, '2024-07-05', '2024-07-05'),
(16, 1, 'Live Session', 50, 1, '2024-07-05', '2024-07-05');

-- --------------------------------------------------------

--
-- Table structure for table `confirm_sign`
--

CREATE TABLE `confirm_sign` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `code` varchar(20) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `confirm_sign`
--

INSERT INTO `confirm_sign` (`id`, `email`, `code`, `created_at`, `updated_at`) VALUES
(1, 'ahmedahmadahmid73@gmail.com', '1873', '2023-12-31', '2023-12-31'),
(2, 'ziadm57@yahoo.com', '1756', '2023-12-31', '2023-12-31'),
(3, 'ziadm0176@gmail.com', '5567', '2023-12-31', '2023-12-31'),
(4, 'admin@gmail.com', '6618', '2024-01-03', '2024-01-03'),
(5, 'admin@gmail.com', '3021', '2024-01-03', '2024-01-03'),
(6, 'admin@gmail.com', '6842', '2024-01-03', '2024-01-03'),
(7, 'admin2312@gmail.com', '9858', '2024-01-03', '2024-01-03'),
(8, 'karimelfakey84@gmail.com', '9349', '2024-01-04', '2024-01-04'),
(9, 'karimelfakey84@gmail.com', '5987', '2024-01-04', '2024-01-04'),
(10, 'karimelfakey84@gmail.com', '9299', '2024-01-04', '2024-01-04'),
(11, 'sdfs@gmail.com', '1039', '2024-01-04', '2024-01-04'),
(12, 'sdfs@gmail.com', '3273', '2024-01-04', '2024-01-04'),
(13, 'sdfs@gmail.com', '2720', '2024-01-04', '2024-01-04'),
(14, 'sdfs@gmail.com', '7016', '2024-01-04', '2024-01-04'),
(15, 'student_one@gmail.com', '9301', '2024-04-08', '2024-04-08'),
(16, 'ahmed312@gmail.com', '4351', '2024-04-30', '2024-04-30'),
(17, 'ahmedahmddadaddhmid73@gmail.com', '9676', '2024-05-01', '2024-05-01'),
(18, 'sdffssd@gmail.com', '7694', '2024-05-05', '2024-05-05'),
(19, 'ertgttg@gmail.com', '2599', '2024-05-05', '2024-05-05'),
(20, 'ahmedahmadahmid73@gmail.com', '3125', '2024-05-08', '2024-05-08'),
(21, 'ahmedahmadahmid73@gmail.com', '2501', '2024-05-08', '2024-05-08'),
(22, 'ahmedahmadahmid73@gmail.com', '5300', '2024-05-08', '2024-05-08'),
(23, 'ahmedahmadahmid73@gmail.com', '9578', '2024-05-17', '2024-05-17'),
(24, 'ahmedahmadahmid73@gmail.com', '1193', '2024-05-17', '2024-05-17'),
(25, 'sd@gmail.com', '5624', '2024-06-12', '2024-06-12'),
(26, 'wqew@gmail.com', '5930', '2024-06-12', '2024-06-12'),
(27, 'dfas@gmail.com', '5599', '2024-06-12', '2024-06-12'),
(28, 'dffas@gmail.com', '3184', '2024-06-12', '2024-06-12'),
(29, 'efew@gmail.com', '351', '2024-06-12', '2024-06-12'),
(30, 'sdf@gmail.com', '5391', '2024-06-12', '2024-06-12'),
(31, 'sdfadfdf3@gmail.com', '9214', '2024-06-12', '2024-06-12'),
(32, 'dfffe565@gmail.com', '1037', '2024-06-12', '2024-06-12'),
(33, 'dfffe565ds@gmail.com', '6227', '2024-06-12', '2024-06-12'),
(34, 'dfs@gmail.com', '3272', '2024-06-12', '2024-06-12'),
(35, 'sdf23@gmail.com', '4031', '2024-06-12', '2024-06-12'),
(36, 'tret@gmail.com', '3755', '2024-06-23', '2024-06-23'),
(37, 'sdfs@gmail.com', '7246', '2024-06-23', '2024-06-23');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 'mohamed yasen', 'admin@gmail.com', 'Hello', 'My Msg', '2024-01-20', '2024-01-20');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `created_at`, `updated_at`) VALUES
(10, 'Afghanistan', '2023-05-02 04:20:41', '2023-05-02 04:20:41'),
(11, 'Albania', '2023-05-02 04:20:54', '2023-05-02 04:20:54'),
(12, 'Algeria', '2023-05-02 04:21:05', '2023-05-02 04:21:05'),
(13, 'Andorra', '2023-05-02 04:21:18', '2023-05-02 04:21:18'),
(14, 'Angola', '2023-05-02 04:21:32', '2023-05-02 04:21:32'),
(15, 'Antigua and Barbuda', '2023-05-02 04:21:47', '2023-05-02 04:21:47'),
(16, 'Argentina', '2023-05-02 04:24:32', '2023-05-02 04:24:32'),
(17, 'Armenia', '2023-05-02 04:24:48', '2023-05-02 04:24:48'),
(18, 'Australia', '2023-05-02 04:24:59', '2023-05-02 04:24:59'),
(19, 'Austria', '2023-05-02 04:25:10', '2023-05-02 04:25:10'),
(20, 'Azerbaijan', '2023-05-02 04:25:21', '2023-05-02 04:25:21'),
(21, 'Bahamas', '2023-05-02 04:25:33', '2023-05-02 04:25:33'),
(22, 'Bahrain', '2023-05-02 04:25:43', '2023-05-02 04:25:43'),
(23, 'Bangladesh', '2023-05-02 04:25:53', '2023-05-02 04:25:53'),
(24, 'Barbados', '2023-05-02 04:27:02', '2023-05-02 04:27:02'),
(25, 'Belarus', '2023-05-02 04:27:27', '2023-05-02 04:27:27'),
(26, 'Belgium', '2023-05-02 04:28:46', '2023-05-02 04:28:46'),
(27, 'Belize', '2023-05-02 04:28:57', '2023-05-02 04:28:57'),
(28, 'Benin', '2023-05-02 04:32:12', '2023-05-02 04:32:12'),
(29, 'Bhutan', '2023-05-02 04:32:45', '2023-05-02 04:32:45'),
(30, 'Bolivia', '2023-05-02 04:32:59', '2023-05-02 04:32:59'),
(31, 'Bosnia and Herzegovina', '2023-05-02 04:33:17', '2023-05-02 04:33:17'),
(32, 'Botswana', '2023-05-02 04:33:31', '2023-05-02 04:33:31'),
(33, 'Brazil', '2023-05-02 04:45:12', '2023-05-02 04:45:12'),
(34, 'Brunei', '2023-05-02 04:45:41', '2023-05-02 04:45:41'),
(35, 'Bulgaria', '2023-05-02 04:52:29', '2023-05-02 04:52:29'),
(36, 'Burkina Faso', '2023-05-02 04:53:34', '2023-05-02 04:53:34'),
(37, 'Burundi', '2023-05-02 04:53:53', '2023-05-02 04:53:53'),
(38, 'Côte d\'Ivoire', '2023-05-02 04:54:04', '2023-05-02 04:54:04'),
(39, 'Cabo Verde', '2023-05-02 04:54:15', '2023-05-02 04:54:15'),
(40, 'Cambodia', '2023-05-02 04:57:48', '2023-05-02 04:57:48'),
(41, 'Cameroon', '2023-05-02 04:57:58', '2023-05-02 04:57:58'),
(42, 'Canada', '2023-05-02 04:58:09', '2023-05-02 04:58:09'),
(43, 'Central African Republic', '2023-05-02 04:58:21', '2023-05-02 04:58:21'),
(44, 'Chad', '2023-05-02 05:00:10', '2023-05-02 05:00:10'),
(45, 'Chile', '2023-05-02 05:00:22', '2023-05-02 05:00:22'),
(46, 'China', '2023-05-02 05:00:34', '2023-05-02 05:00:34'),
(47, 'Colombia', '2023-05-02 05:00:44', '2023-05-02 05:00:44'),
(48, 'Comoros', '2023-05-02 05:01:00', '2023-05-02 05:01:00'),
(49, 'Congo (Congo-Brazzaville)', '2023-05-02 05:01:16', '2023-05-02 05:01:16'),
(50, 'Costa Rica', '2023-05-02 05:01:27', '2023-05-02 05:01:27'),
(51, 'Croatia', '2023-05-02 05:01:39', '2023-05-02 05:01:39'),
(52, 'Cuba', '2023-05-02 05:01:50', '2023-05-02 05:01:50'),
(53, 'Cyprus', '2023-05-02 05:02:01', '2023-05-02 05:02:01'),
(54, 'Czechia (Czech Republic)', '2023-05-02 05:02:21', '2023-05-02 05:02:21'),
(55, 'Democratic Republic of the Congo', '2023-05-02 05:02:38', '2023-05-02 05:02:38'),
(56, 'Denmark', '2023-05-02 05:02:50', '2023-05-02 05:02:50'),
(57, 'Djibouti', '2023-05-02 05:03:06', '2023-05-02 05:03:06'),
(58, 'Dominica', '2023-05-02 05:03:17', '2023-05-02 05:03:17'),
(59, 'Dominican Republic', '2023-05-02 05:03:29', '2023-05-02 05:03:29'),
(60, 'Ecuador', '2023-05-02 05:03:40', '2023-05-02 05:03:40'),
(61, 'Egypt', '2023-05-02 05:03:50', '2023-05-02 05:03:50'),
(62, 'El Salvador', '2023-05-02 05:04:18', '2023-05-02 05:04:18'),
(63, 'Equatorial Guinea', '2023-05-02 05:04:28', '2023-05-02 05:04:28'),
(64, 'Eritrea', '2023-05-02 05:04:39', '2023-05-02 05:04:39'),
(65, 'Estonia', '2023-05-02 05:04:49', '2023-05-02 05:04:49'),
(66, 'Eswatini (fmr. \"Swaziland\")', '2023-05-02 05:05:02', '2023-05-02 05:05:02'),
(67, 'Ethiopia', '2023-05-02 05:05:12', '2023-05-02 05:05:12'),
(68, 'Fiji', '2023-05-02 05:05:23', '2023-05-02 05:05:23'),
(69, 'Finland', '2023-05-02 05:05:32', '2023-05-02 05:05:32'),
(70, 'France', '2023-05-02 05:05:42', '2023-05-02 05:05:42'),
(71, 'Gabon', '2023-05-02 05:05:54', '2023-05-02 05:05:54'),
(72, 'Gambia', '2023-05-02 05:06:08', '2023-05-02 05:06:08'),
(73, 'Georgia', '2023-05-02 05:06:36', '2023-05-02 05:06:36'),
(74, 'Germany', '2023-05-02 05:06:46', '2023-05-02 05:06:46'),
(75, 'Ghana', '2023-05-02 05:06:58', '2023-05-02 05:06:58'),
(76, 'Greece', '2023-05-02 05:07:07', '2023-05-02 05:07:07'),
(77, 'Grenada', '2023-05-02 05:07:21', '2023-05-02 05:07:21'),
(78, 'Guatemala', '2023-05-02 05:07:34', '2023-05-02 05:07:34'),
(79, 'Guinea', '2023-05-02 05:07:43', '2023-05-02 05:07:43'),
(80, 'Guinea-Bissau', '2023-05-02 05:07:53', '2023-05-02 05:07:53'),
(81, 'Guyana', '2023-05-02 05:08:02', '2023-05-02 05:08:02'),
(82, 'Haiti', '2023-05-02 05:08:14', '2023-05-02 05:08:14'),
(83, 'Holy See', '2023-05-02 05:08:25', '2023-05-02 05:08:25'),
(84, 'Honduras', '2023-05-02 05:08:45', '2023-05-02 05:08:45'),
(85, 'Hungary', '2023-05-02 05:08:57', '2023-05-02 05:08:57'),
(86, 'Iceland', '2023-05-02 05:09:09', '2023-05-02 05:09:09'),
(87, 'India', '2023-05-02 05:09:20', '2023-05-02 05:09:20'),
(88, 'Indonesia', '2023-05-02 05:10:10', '2023-05-02 05:10:10'),
(89, 'Iran', '2023-05-02 05:10:23', '2023-05-02 05:10:23'),
(90, 'Iraq', '2023-05-02 05:10:34', '2023-05-02 05:10:34'),
(91, 'Ireland', '2023-05-02 05:10:44', '2023-05-02 05:10:44'),
(92, 'Italy', '2023-05-02 05:11:03', '2023-05-02 05:11:03'),
(93, 'Jamaica', '2023-05-02 05:11:17', '2023-05-02 05:11:17'),
(94, 'Japan', '2023-05-02 05:11:31', '2023-05-02 05:11:31'),
(95, 'Jordan', '2023-05-02 05:11:47', '2023-05-02 05:11:47'),
(96, 'Kazakhstan', '2023-05-02 05:11:59', '2023-05-02 05:11:59'),
(97, 'Kenya', '2023-05-02 05:12:09', '2023-05-02 05:12:09'),
(98, 'Kiribati', '2023-05-02 05:12:19', '2023-05-02 05:12:19'),
(99, 'Kuwait', '2023-05-02 05:12:54', '2023-05-02 05:12:54'),
(100, 'Kyrgyzstan', '2023-05-02 05:13:26', '2023-05-02 05:13:26'),
(101, 'Laos', '2023-05-02 05:13:37', '2023-05-02 05:13:37'),
(102, 'Latvia', '2023-05-02 05:13:46', '2023-05-02 05:13:46'),
(103, 'Lebanon', '2023-05-02 05:14:50', '2023-05-02 05:14:50'),
(104, 'Lesotho', '2023-05-02 05:15:22', '2023-05-02 05:15:22'),
(105, 'Liberia', '2023-05-02 05:15:34', '2023-05-02 05:15:34'),
(106, 'Libya', '2023-05-02 05:15:48', '2023-05-02 05:15:48'),
(107, 'Libya', '2023-05-02 05:15:48', '2023-05-02 05:15:48'),
(108, 'Liechtenstein', '2023-05-02 05:17:24', '2023-05-02 05:17:24'),
(109, 'Lithuania', '2023-05-02 05:17:45', '2023-05-02 05:17:45'),
(110, 'Luxembourg', '2023-05-02 06:31:48', '2023-05-02 06:31:48'),
(111, 'Madagascar', '2023-05-02 06:42:28', '2023-05-02 06:42:28'),
(112, 'Malawi', '2023-05-02 06:42:46', '2023-05-02 06:42:46'),
(113, 'Malaysia', '2023-05-02 06:43:49', '2023-05-02 06:43:49'),
(114, 'Maldives', '2023-05-02 06:44:17', '2023-05-02 06:44:17'),
(115, 'Malta', '2023-05-02 09:41:04', '2023-05-02 09:41:04'),
(116, 'Marshall Islands', '2023-05-02 09:41:15', '2023-05-02 09:41:15'),
(117, 'Mauritania', '2023-05-02 09:41:27', '2023-05-02 09:41:27'),
(118, 'Mauritius', '2023-05-02 09:41:54', '2023-05-02 09:41:54'),
(119, 'Mexico', '2023-05-02 09:42:05', '2023-05-02 09:42:05'),
(120, 'Micronesia', '2023-05-02 09:43:01', '2023-05-02 09:43:01'),
(121, 'Moldova', '2023-05-02 09:43:11', '2023-05-02 09:43:11'),
(122, 'Monaco', '2023-05-02 09:43:23', '2023-05-02 09:43:23'),
(123, 'Mongolia', '2023-05-02 09:43:35', '2023-05-02 09:43:35'),
(124, 'Montenegro', '2023-05-02 09:43:44', '2023-05-02 09:43:44'),
(125, 'Morocco', '2023-05-02 09:43:54', '2023-05-02 09:43:54'),
(126, 'Mozambique', '2023-05-02 09:44:04', '2023-05-02 09:44:04'),
(127, 'Myanmar (formerly Burma)', '2023-05-02 09:44:15', '2023-05-02 09:44:15'),
(128, 'Namibia', '2023-05-02 09:45:21', '2023-05-02 09:45:21'),
(129, 'Nauru', '2023-05-02 09:45:32', '2023-05-02 09:45:32'),
(130, 'Nepal', '2023-05-02 09:47:31', '2023-05-02 09:47:31'),
(131, 'Nepal', '2023-05-02 09:48:06', '2023-05-02 09:48:06'),
(132, 'Netherlands', '2023-05-02 09:48:20', '2023-05-02 09:48:20'),
(133, 'New Zealand', '2023-05-02 09:48:30', '2023-05-02 09:48:30'),
(134, 'Nicaragua', '2023-05-02 09:48:40', '2023-05-02 09:48:40'),
(135, 'Niger', '2023-05-02 09:48:50', '2023-05-02 09:48:50'),
(136, 'Nigeria', '2023-05-02 09:49:01', '2023-05-02 09:49:01'),
(137, 'North Korea', '2023-05-02 09:49:22', '2023-05-02 09:49:22'),
(138, 'North Macedonia', '2023-05-02 09:49:32', '2023-05-02 09:49:32'),
(139, 'Norway', '2023-05-02 09:49:46', '2023-05-02 09:49:46'),
(140, 'Oman', '2023-05-02 09:49:57', '2023-05-02 09:49:57'),
(141, 'Pakistan', '2023-05-02 09:50:07', '2023-05-02 09:50:07'),
(142, 'Palau', '2023-05-02 09:50:21', '2023-05-02 09:50:21'),
(143, 'Palestine State', '2023-05-02 09:51:02', '2023-05-02 09:51:02'),
(144, 'Panama', '2023-05-02 09:51:13', '2023-05-02 09:51:13'),
(145, 'Papua New Guinea', '2023-05-02 09:51:28', '2023-05-02 09:51:28'),
(146, 'Paraguay', '2023-05-02 09:52:02', '2023-05-02 09:52:02'),
(147, 'Peru', '2023-05-02 09:52:14', '2023-05-02 09:52:14'),
(148, 'Philippines', '2023-05-02 09:52:23', '2023-05-02 09:52:23'),
(149, 'Poland', '2023-05-02 09:52:35', '2023-05-02 09:52:35'),
(150, 'Portugal', '2023-05-02 09:52:47', '2023-05-02 09:52:47'),
(151, 'Qatar', '2023-05-02 09:52:58', '2023-05-02 09:52:58'),
(152, 'Romania', '2023-05-02 09:53:07', '2023-05-02 09:53:07'),
(153, 'Russia', '2023-05-02 09:53:17', '2023-05-02 09:53:17'),
(154, 'Rwanda', '2023-05-02 09:53:26', '2023-05-02 09:53:26'),
(155, 'Saint Kitts and Nevis', '2023-05-02 09:53:35', '2023-05-02 09:53:35'),
(156, 'Saint Lucia', '2023-05-02 09:53:43', '2023-05-02 09:53:43'),
(157, 'Saint Vincent and the Grenadines', '2023-05-02 09:53:57', '2023-05-02 09:53:57'),
(158, 'Samoa', '2023-05-02 09:54:06', '2023-05-02 09:54:06'),
(159, 'San Marino', '2023-05-02 09:54:15', '2023-05-02 09:54:15'),
(160, 'Sao Tome and Principe', '2023-05-02 09:54:25', '2023-05-02 09:54:25'),
(161, 'Saudi Arabia', '2023-05-02 09:54:36', '2023-05-02 09:54:36'),
(162, 'Senegal', '2023-05-02 09:54:46', '2023-05-02 09:54:46'),
(163, 'Serbia', '2023-05-02 09:54:56', '2023-05-02 09:54:56'),
(164, 'Seychelles', '2023-05-02 09:55:07', '2023-05-02 09:55:07'),
(165, 'Sierra Leone', '2023-05-02 09:55:17', '2023-05-02 09:55:17'),
(166, 'Singapore', '2023-05-02 09:55:25', '2023-05-02 09:55:25'),
(167, 'Slovakia', '2023-05-02 09:55:50', '2023-05-02 09:55:50'),
(168, 'Slovenia', '2023-05-02 09:56:10', '2023-05-02 09:56:10'),
(169, 'Solomon Islands', '2023-05-02 09:56:28', '2023-05-02 09:56:28'),
(170, 'Somalia', '2023-05-02 09:56:39', '2023-05-02 09:56:39'),
(171, 'South Africa', '2023-05-02 09:56:50', '2023-05-02 09:56:50'),
(172, 'South Korea', '2023-05-02 09:59:19', '2023-05-02 09:59:19'),
(173, 'South Sudan', '2023-05-02 09:59:28', '2023-05-02 09:59:28'),
(174, 'Spain', '2023-05-02 09:59:38', '2023-05-02 09:59:38'),
(175, 'Sri Lanka', '2023-05-02 09:59:49', '2023-05-02 09:59:49'),
(176, 'Sudan', '2023-05-02 09:59:59', '2023-05-02 09:59:59'),
(177, 'Suriname', '2023-05-02 10:00:09', '2023-05-02 10:00:09'),
(178, 'Sweden', '2023-05-02 10:00:19', '2023-05-02 10:00:19'),
(179, 'Switzerland', '2023-05-03 03:38:16', '2023-05-03 03:38:16'),
(180, 'Switzerland', '2023-05-03 03:38:17', '2023-05-03 03:38:17'),
(181, 'Syria', '2023-05-03 03:38:27', '2023-05-03 03:38:27'),
(182, 'Tajikistan', '2023-05-03 03:39:25', '2023-05-03 03:39:25'),
(183, 'Tanzania', '2023-05-03 03:39:36', '2023-05-03 03:39:36'),
(184, 'Thailand', '2023-05-03 03:39:46', '2023-05-03 03:39:46'),
(185, 'Timor-Leste', '2023-05-03 03:39:59', '2023-05-03 03:39:59'),
(186, 'Togo', '2023-05-03 03:40:10', '2023-05-03 03:40:10'),
(187, 'Tonga', '2023-05-03 03:40:21', '2023-05-03 03:40:21'),
(188, 'Trinidad and Tobago', '2023-05-03 03:40:33', '2023-05-03 03:40:33'),
(189, 'Tunisia', '2023-05-03 03:40:45', '2023-05-03 03:40:45'),
(190, 'Turkey', '2023-05-03 03:41:57', '2023-05-03 03:41:57'),
(191, 'Turkmenistan', '2023-05-03 03:42:08', '2023-05-03 03:42:08'),
(192, 'Tuvalu', '2023-05-03 03:42:20', '2023-05-03 03:42:20'),
(193, 'Uganda', '2023-05-03 03:42:30', '2023-05-03 03:42:30'),
(194, 'Ukraine', '2023-05-03 03:42:40', '2023-05-03 03:42:40'),
(195, 'United Arab Emirates', '2023-05-03 03:42:54', '2023-05-03 03:42:54'),
(196, 'United Kingdom', '2023-05-03 03:43:19', '2023-05-03 03:43:19'),
(197, 'United States of America', '2023-05-03 03:43:35', '2023-05-03 03:43:35'),
(198, 'Uruguay', '2023-05-03 03:43:47', '2023-05-03 03:43:47'),
(199, 'Uzbekistan', '2023-05-03 03:45:03', '2023-05-03 03:45:03'),
(200, 'Vanuatu', '2023-05-03 03:45:18', '2023-05-03 03:45:18'),
(201, 'Venezuela', '2023-05-03 03:45:31', '2023-05-03 03:45:31'),
(202, 'Vietnam', '2023-05-03 03:45:39', '2023-05-03 03:45:39'),
(203, 'Yemen', '2023-05-03 03:45:51', '2023-05-03 03:45:51'),
(204, 'Zambia', '2023-05-03 03:46:01', '2023-05-03 03:46:01'),
(205, 'Zimbabwe', '2023-05-03 03:46:17', '2023-05-03 03:46:17');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_name` varchar(191) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `course_des` text NOT NULL,
  `course_url` varchar(191) NOT NULL DEFAULT 'Default.jfif',
  `pre_requisition` text DEFAULT NULL,
  `gain` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `teacher_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `category_id`, `course_des`, `course_url`, `pre_requisition`, `gain`, `created_at`, `updated_at`, `teacher_id`, `user_id`) VALUES
(1, 'Course 1', 1, 'Course One', 'Default.jfif', 'sd', 'sad', NULL, '2024-04-18 12:29:00', 1, 1),
(2, 'Course 2', 1, 'Course Two', 'Default.jfif', 'weq', 'tr', NULL, NULL, 1, 1),
(4, 'SAT', 1, 'hello', '2024X01X01X12X08X23612220231001083656153827_2318787155110616_6392255175880343552_n.jpg', 'Grid 10', 'hello', '2024-01-01 10:08:23', '2024-01-01 10:08:23', 1, NULL),
(6, 'erwe', 1, 'asd', '2024X01X24X11X14X1187535.jpg', 'das', 'asd', '2024-01-24 09:14:11', '2024-01-24 09:14:53', 1, NULL),
(9, 'dddddd', 1, 'ddddd', '2024X01X28X10X16X1464223.png', 'sdsdsd', 'sdsdd', '2024-01-28 08:16:14', '2024-01-28 08:16:14', 1, NULL),
(10, 'Course Eleven', 1, 'Course Eleven', '2024X02X05X12X54X4940013.jpg', 'asd', 'asd', '2024-02-05 10:54:49', '2024-02-05 10:54:49', 1, NULL),
(12, 'IS', 9, 'hello', '2024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'dfg', 'fgg', '2024-02-19 05:47:01', '2024-05-18 07:31:20', 1, NULL),
(13, 'course 21', 1, 'sad', '2024X03X27X12X32X3648672024X02X19X07X46X506890202301101725mvf_dark_logo.png', 'df', 'sd', '2024-03-27 10:32:36', '2024-03-27 10:32:36', 1, NULL),
(14, 'Course 13', 1, 'sxas', 'Default.jfif', 'sad', 'asdsda', '2024-03-27 10:37:06', '2024-05-19 05:40:15', 1, NULL),
(15, 'fdgfd', 9, 'fdgd', '2024X06X02X06X31X0910196.png', 'sdgfd', 'gdfgdf', '2024-06-02 04:31:09', '2024-06-02 05:21:41', 65, NULL),
(16, 'sdfs', 9, 'dfsf', '2024X06X02X08X04X269376.png', 'sdf', 'sdfsd', '2024-06-02 06:04:26', '2024-06-02 06:04:26', 71, NULL),
(17, 'sdfs', 9, 'dfsf', '2024X06X02X08X08X4116776.png', 'sdf', 'sdfsd', '2024-06-02 06:08:41', '2024-06-02 06:08:41', 71, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_prices`
--

CREATE TABLE `course_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `duration` int(11) NOT NULL,
  `price` float NOT NULL,
  `discount` float NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_prices`
--

INSERT INTO `course_prices` (`id`, `course_id`, `duration`, `price`, `discount`, `created_at`, `updated_at`) VALUES
(17, 9, 1, 100, 10, '2024-01-28', '2024-01-28'),
(21, 6, 4, 400, 3, '2024-02-05', '2024-02-05'),
(22, 4, 1, 23, 22, '2024-02-05', '2024-02-05'),
(23, 10, 1, 100, 1, '2024-02-05', '2024-02-05'),
(28, 2, 30, 600, 5, NULL, NULL),
(29, 13, 11, 21, 12, '2024-03-27', '2024-03-27'),
(32, 1, 5, 500, 5, '2024-04-18', '2024-04-18'),
(33, 1, 1, 23, 22, '2024-05-18', '2024-05-18'),
(35, 14, 12, 23, 12, '2024-05-19', '2024-05-19');

-- --------------------------------------------------------

--
-- Table structure for table `dai_exam_mistakes`
--

CREATE TABLE `dai_exam_mistakes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_exam_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dai_exam_mistakes`
--

INSERT INTO `dai_exam_mistakes` (`id`, `student_exam_id`, `question_id`, `created_at`, `updated_at`) VALUES
(2, 2, 18, '2024-03-03', '2024-03-03'),
(3, 2, 18, '2024-03-03', '2024-03-03'),
(4, 2, 18, '2024-03-03', '2024-03-03'),
(5, 2, 18, '2024-03-03', '2024-03-03'),
(6, 2, 18, '2024-03-03', '2024-03-03'),
(7, 2, 18, '2024-03-03', '2024-03-03'),
(8, 2, 18, '2024-03-03', '2024-03-03'),
(9, 2, 19, '2024-03-03', '2024-03-03'),
(10, 2, 19, '2024-03-03', '2024-03-03'),
(11, 2, 19, '2024-03-03', '2024-03-03'),
(12, 2, 19, '2024-03-03', '2024-03-03'),
(13, 2, 19, '2024-03-03', '2024-03-03'),
(14, 2, 19, '2024-03-03', '2024-03-03'),
(15, 2, 19, '2024-03-03', '2024-03-03'),
(16, 3, 18, '2024-03-03', '2024-03-03'),
(17, 3, 18, '2024-03-03', '2024-03-03'),
(18, 3, 18, '2024-03-03', '2024-03-03'),
(19, 3, 18, '2024-03-03', '2024-03-03'),
(20, 3, 18, '2024-03-03', '2024-03-03'),
(21, 3, 18, '2024-03-03', '2024-03-03'),
(22, 3, 18, '2024-03-03', '2024-03-03'),
(23, 3, 19, '2024-03-03', '2024-03-03'),
(24, 3, 19, '2024-03-03', '2024-03-03'),
(25, 3, 19, '2024-03-03', '2024-03-03'),
(26, 3, 19, '2024-03-03', '2024-03-03'),
(27, 3, 19, '2024-03-03', '2024-03-03'),
(28, 3, 19, '2024-03-03', '2024-03-03'),
(29, 3, 19, '2024-03-03', '2024-03-03'),
(30, 4, 18, '2024-03-03', '2024-03-03'),
(31, 4, 18, '2024-03-03', '2024-03-03'),
(32, 4, 18, '2024-03-03', '2024-03-03'),
(33, 4, 18, '2024-03-03', '2024-03-03'),
(34, 4, 18, '2024-03-03', '2024-03-03'),
(35, 4, 18, '2024-03-03', '2024-03-03'),
(36, 4, 18, '2024-03-03', '2024-03-03'),
(37, 4, 19, '2024-03-03', '2024-03-03'),
(38, 4, 19, '2024-03-03', '2024-03-03'),
(39, 4, 19, '2024-03-03', '2024-03-03'),
(40, 4, 19, '2024-03-03', '2024-03-03'),
(41, 4, 19, '2024-03-03', '2024-03-03'),
(42, 4, 19, '2024-03-03', '2024-03-03'),
(43, 4, 19, '2024-03-03', '2024-03-03'),
(44, 5, 18, '2024-03-03', '2024-03-03'),
(45, 5, 18, '2024-03-03', '2024-03-03'),
(46, 5, 18, '2024-03-03', '2024-03-03'),
(47, 5, 18, '2024-03-03', '2024-03-03'),
(48, 5, 18, '2024-03-03', '2024-03-03'),
(49, 5, 18, '2024-03-03', '2024-03-03'),
(50, 5, 18, '2024-03-03', '2024-03-03'),
(51, 5, 19, '2024-03-03', '2024-03-03'),
(52, 5, 19, '2024-03-03', '2024-03-03'),
(53, 5, 19, '2024-03-03', '2024-03-03'),
(54, 5, 19, '2024-03-03', '2024-03-03'),
(55, 5, 19, '2024-03-03', '2024-03-03'),
(56, 5, 19, '2024-03-03', '2024-03-03'),
(57, 5, 19, '2024-03-03', '2024-03-03'),
(58, 6, 18, '2024-03-03', '2024-03-03'),
(59, 6, 18, '2024-03-03', '2024-03-03'),
(60, 6, 18, '2024-03-03', '2024-03-03'),
(61, 6, 18, '2024-03-03', '2024-03-03'),
(62, 6, 18, '2024-03-03', '2024-03-03'),
(63, 6, 18, '2024-03-03', '2024-03-03'),
(64, 6, 18, '2024-03-03', '2024-03-03'),
(65, 6, 19, '2024-03-03', '2024-03-03'),
(66, 6, 19, '2024-03-03', '2024-03-03'),
(67, 6, 19, '2024-03-03', '2024-03-03'),
(68, 6, 19, '2024-03-03', '2024-03-03'),
(69, 6, 19, '2024-03-03', '2024-03-03'),
(70, 6, 19, '2024-03-03', '2024-03-03'),
(71, 6, 19, '2024-03-03', '2024-03-03'),
(72, 7, 18, '2024-03-03', '2024-03-03'),
(73, 7, 18, '2024-03-03', '2024-03-03'),
(74, 7, 18, '2024-03-03', '2024-03-03'),
(75, 7, 18, '2024-03-03', '2024-03-03'),
(76, 7, 18, '2024-03-03', '2024-03-03'),
(77, 7, 18, '2024-03-03', '2024-03-03'),
(78, 7, 18, '2024-03-03', '2024-03-03'),
(79, 7, 19, '2024-03-03', '2024-03-03'),
(80, 7, 19, '2024-03-03', '2024-03-03'),
(81, 7, 19, '2024-03-03', '2024-03-03'),
(82, 7, 19, '2024-03-03', '2024-03-03'),
(83, 7, 19, '2024-03-03', '2024-03-03'),
(84, 7, 19, '2024-03-03', '2024-03-03'),
(85, 7, 19, '2024-03-03', '2024-03-03'),
(86, 8, 18, '2024-03-03', '2024-03-03'),
(87, 8, 18, '2024-03-03', '2024-03-03'),
(88, 8, 18, '2024-03-03', '2024-03-03'),
(89, 8, 18, '2024-03-03', '2024-03-03'),
(90, 8, 18, '2024-03-03', '2024-03-03'),
(91, 8, 18, '2024-03-03', '2024-03-03'),
(92, 8, 18, '2024-03-03', '2024-03-03'),
(93, 8, 19, '2024-03-03', '2024-03-03'),
(94, 8, 19, '2024-03-03', '2024-03-03'),
(95, 8, 19, '2024-03-03', '2024-03-03'),
(96, 8, 19, '2024-03-03', '2024-03-03'),
(97, 8, 19, '2024-03-03', '2024-03-03'),
(98, 8, 19, '2024-03-03', '2024-03-03'),
(99, 8, 19, '2024-03-03', '2024-03-03'),
(100, 9, 18, '2024-03-03', '2024-03-03'),
(101, 9, 18, '2024-03-03', '2024-03-03'),
(102, 9, 18, '2024-03-03', '2024-03-03'),
(103, 9, 18, '2024-03-03', '2024-03-03'),
(104, 9, 18, '2024-03-03', '2024-03-03'),
(105, 9, 18, '2024-03-03', '2024-03-03'),
(106, 9, 18, '2024-03-03', '2024-03-03'),
(107, 9, 19, '2024-03-03', '2024-03-03'),
(108, 9, 19, '2024-03-03', '2024-03-03'),
(109, 9, 19, '2024-03-03', '2024-03-03'),
(110, 9, 19, '2024-03-03', '2024-03-03'),
(111, 9, 19, '2024-03-03', '2024-03-03'),
(112, 9, 19, '2024-03-03', '2024-03-03'),
(113, 9, 19, '2024-03-03', '2024-03-03'),
(114, 10, 18, '2024-03-03', '2024-03-03'),
(115, 10, 18, '2024-03-03', '2024-03-03'),
(116, 10, 18, '2024-03-03', '2024-03-03'),
(117, 10, 18, '2024-03-03', '2024-03-03'),
(118, 10, 18, '2024-03-03', '2024-03-03'),
(119, 10, 18, '2024-03-03', '2024-03-03'),
(120, 10, 18, '2024-03-03', '2024-03-03'),
(121, 10, 19, '2024-03-03', '2024-03-03'),
(122, 10, 19, '2024-03-03', '2024-03-03'),
(123, 10, 19, '2024-03-03', '2024-03-03'),
(124, 10, 19, '2024-03-03', '2024-03-03'),
(125, 10, 19, '2024-03-03', '2024-03-03'),
(126, 10, 19, '2024-03-03', '2024-03-03'),
(127, 10, 19, '2024-03-03', '2024-03-03'),
(128, 11, 18, '2024-03-03', '2024-03-03'),
(129, 11, 18, '2024-03-03', '2024-03-03'),
(130, 11, 18, '2024-03-03', '2024-03-03'),
(131, 11, 18, '2024-03-03', '2024-03-03'),
(132, 11, 18, '2024-03-03', '2024-03-03'),
(133, 11, 18, '2024-03-03', '2024-03-03'),
(134, 11, 18, '2024-03-03', '2024-03-03'),
(135, 11, 19, '2024-03-03', '2024-03-03'),
(136, 11, 19, '2024-03-03', '2024-03-03'),
(137, 11, 19, '2024-03-03', '2024-03-03'),
(138, 11, 19, '2024-03-03', '2024-03-03'),
(139, 11, 19, '2024-03-03', '2024-03-03'),
(140, 11, 19, '2024-03-03', '2024-03-03'),
(141, 11, 19, '2024-03-03', '2024-03-03'),
(142, 12, 18, '2024-03-03', '2024-03-03'),
(143, 12, 18, '2024-03-03', '2024-03-03'),
(144, 12, 18, '2024-03-03', '2024-03-03'),
(145, 12, 18, '2024-03-03', '2024-03-03'),
(146, 12, 18, '2024-03-03', '2024-03-03'),
(147, 12, 18, '2024-03-03', '2024-03-03'),
(148, 12, 18, '2024-03-03', '2024-03-03'),
(149, 12, 19, '2024-03-03', '2024-03-03'),
(150, 12, 19, '2024-03-03', '2024-03-03'),
(151, 12, 19, '2024-03-03', '2024-03-03'),
(152, 12, 19, '2024-03-03', '2024-03-03'),
(153, 12, 19, '2024-03-03', '2024-03-03'),
(154, 12, 19, '2024-03-03', '2024-03-03'),
(155, 12, 19, '2024-03-03', '2024-03-03'),
(156, 13, 18, '2024-03-03', '2024-03-03'),
(157, 13, 18, '2024-03-03', '2024-03-03'),
(158, 13, 18, '2024-03-03', '2024-03-03'),
(159, 13, 18, '2024-03-03', '2024-03-03'),
(160, 13, 18, '2024-03-03', '2024-03-03'),
(161, 13, 18, '2024-03-03', '2024-03-03'),
(162, 13, 18, '2024-03-03', '2024-03-03'),
(163, 13, 19, '2024-03-03', '2024-03-03'),
(164, 13, 19, '2024-03-03', '2024-03-03'),
(165, 13, 19, '2024-03-03', '2024-03-03'),
(166, 13, 19, '2024-03-03', '2024-03-03'),
(167, 13, 19, '2024-03-03', '2024-03-03'),
(168, 13, 19, '2024-03-03', '2024-03-03'),
(169, 13, 19, '2024-03-03', '2024-03-03'),
(170, 14, 18, '2024-03-03', '2024-03-03'),
(171, 14, 18, '2024-03-03', '2024-03-03'),
(172, 14, 18, '2024-03-03', '2024-03-03'),
(173, 14, 18, '2024-03-03', '2024-03-03'),
(174, 14, 18, '2024-03-03', '2024-03-03'),
(175, 14, 18, '2024-03-03', '2024-03-03'),
(176, 14, 18, '2024-03-03', '2024-03-03'),
(177, 14, 19, '2024-03-03', '2024-03-03'),
(178, 14, 19, '2024-03-03', '2024-03-03'),
(179, 14, 19, '2024-03-03', '2024-03-03'),
(180, 14, 19, '2024-03-03', '2024-03-03'),
(181, 14, 19, '2024-03-03', '2024-03-03'),
(182, 14, 19, '2024-03-03', '2024-03-03'),
(183, 14, 19, '2024-03-03', '2024-03-03'),
(184, 15, 18, '2024-03-03', '2024-03-03'),
(185, 15, 18, '2024-03-03', '2024-03-03'),
(186, 15, 18, '2024-03-03', '2024-03-03'),
(187, 15, 18, '2024-03-03', '2024-03-03'),
(188, 15, 18, '2024-03-03', '2024-03-03'),
(189, 15, 18, '2024-03-03', '2024-03-03'),
(190, 15, 18, '2024-03-03', '2024-03-03'),
(191, 15, 19, '2024-03-03', '2024-03-03'),
(192, 15, 19, '2024-03-03', '2024-03-03'),
(193, 15, 19, '2024-03-03', '2024-03-03'),
(194, 15, 19, '2024-03-03', '2024-03-03'),
(195, 15, 19, '2024-03-03', '2024-03-03'),
(196, 15, 19, '2024-03-03', '2024-03-03'),
(197, 15, 19, '2024-03-03', '2024-03-03'),
(198, 16, 18, '2024-03-03', '2024-03-03'),
(199, 16, 18, '2024-03-03', '2024-03-03'),
(200, 16, 18, '2024-03-03', '2024-03-03'),
(201, 16, 18, '2024-03-03', '2024-03-03'),
(202, 16, 18, '2024-03-03', '2024-03-03'),
(203, 16, 18, '2024-03-03', '2024-03-03'),
(204, 16, 18, '2024-03-03', '2024-03-03'),
(205, 16, 19, '2024-03-03', '2024-03-03'),
(206, 16, 19, '2024-03-03', '2024-03-03'),
(207, 16, 19, '2024-03-03', '2024-03-03'),
(208, 16, 19, '2024-03-03', '2024-03-03'),
(209, 16, 19, '2024-03-03', '2024-03-03'),
(210, 16, 19, '2024-03-03', '2024-03-03'),
(211, 16, 19, '2024-03-03', '2024-03-03'),
(212, 17, 18, '2024-03-03', '2024-03-03'),
(213, 17, 18, '2024-03-03', '2024-03-03'),
(214, 17, 18, '2024-03-03', '2024-03-03'),
(215, 17, 18, '2024-03-03', '2024-03-03'),
(216, 17, 18, '2024-03-03', '2024-03-03'),
(217, 17, 18, '2024-03-03', '2024-03-03'),
(218, 17, 18, '2024-03-03', '2024-03-03'),
(219, 17, 19, '2024-03-03', '2024-03-03'),
(220, 17, 19, '2024-03-03', '2024-03-03'),
(221, 17, 19, '2024-03-03', '2024-03-03'),
(222, 17, 19, '2024-03-03', '2024-03-03'),
(223, 17, 19, '2024-03-03', '2024-03-03'),
(224, 17, 19, '2024-03-03', '2024-03-03'),
(225, 17, 19, '2024-03-03', '2024-03-03'),
(226, 18, 19, '2024-03-04', '2024-03-04'),
(227, 18, 19, '2024-03-04', '2024-03-04'),
(228, 18, 19, '2024-03-04', '2024-03-04'),
(229, 18, 19, '2024-03-04', '2024-03-04'),
(230, 18, 19, '2024-03-04', '2024-03-04'),
(231, 18, 19, '2024-03-04', '2024-03-04'),
(232, 18, 19, '2024-03-04', '2024-03-04'),
(233, 18, 19, '2024-03-04', '2024-03-04'),
(234, 18, 20, '2024-03-04', '2024-03-04'),
(235, 18, 20, '2024-03-04', '2024-03-04'),
(236, 18, 20, '2024-03-04', '2024-03-04'),
(237, 18, 20, '2024-03-04', '2024-03-04'),
(238, 18, 20, '2024-03-04', '2024-03-04'),
(239, 19, 19, '2024-03-04', '2024-03-04'),
(240, 19, 19, '2024-03-04', '2024-03-04'),
(241, 19, 19, '2024-03-04', '2024-03-04'),
(242, 19, 19, '2024-03-04', '2024-03-04'),
(243, 19, 19, '2024-03-04', '2024-03-04'),
(244, 19, 19, '2024-03-04', '2024-03-04'),
(245, 19, 19, '2024-03-04', '2024-03-04'),
(246, 19, 19, '2024-03-04', '2024-03-04'),
(247, 19, 20, '2024-03-04', '2024-03-04'),
(248, 19, 20, '2024-03-04', '2024-03-04'),
(249, 19, 20, '2024-03-04', '2024-03-04'),
(250, 19, 20, '2024-03-04', '2024-03-04'),
(251, 19, 20, '2024-03-04', '2024-03-04'),
(252, 20, 19, '2024-03-04', '2024-03-04'),
(253, 20, 19, '2024-03-04', '2024-03-04'),
(254, 20, 19, '2024-03-04', '2024-03-04'),
(255, 20, 19, '2024-03-04', '2024-03-04'),
(256, 20, 19, '2024-03-04', '2024-03-04'),
(257, 20, 19, '2024-03-04', '2024-03-04'),
(258, 20, 19, '2024-03-04', '2024-03-04'),
(259, 20, 19, '2024-03-04', '2024-03-04'),
(260, 20, 20, '2024-03-04', '2024-03-04'),
(261, 20, 20, '2024-03-04', '2024-03-04'),
(262, 20, 20, '2024-03-04', '2024-03-04'),
(263, 20, 20, '2024-03-04', '2024-03-04'),
(264, 20, 20, '2024-03-04', '2024-03-04'),
(265, 21, 19, '2024-03-04', '2024-03-04'),
(266, 21, 19, '2024-03-04', '2024-03-04'),
(267, 21, 19, '2024-03-04', '2024-03-04'),
(268, 21, 19, '2024-03-04', '2024-03-04'),
(269, 21, 19, '2024-03-04', '2024-03-04'),
(270, 21, 19, '2024-03-04', '2024-03-04'),
(271, 21, 19, '2024-03-04', '2024-03-04'),
(272, 21, 19, '2024-03-04', '2024-03-04'),
(273, 21, 20, '2024-03-04', '2024-03-04'),
(274, 21, 20, '2024-03-04', '2024-03-04'),
(275, 21, 20, '2024-03-04', '2024-03-04'),
(276, 21, 20, '2024-03-04', '2024-03-04'),
(277, 21, 20, '2024-03-04', '2024-03-04'),
(278, 22, 19, '2024-03-04', '2024-03-04'),
(279, 22, 19, '2024-03-04', '2024-03-04'),
(280, 22, 19, '2024-03-04', '2024-03-04'),
(281, 22, 19, '2024-03-04', '2024-03-04'),
(282, 22, 19, '2024-03-04', '2024-03-04'),
(283, 22, 19, '2024-03-04', '2024-03-04'),
(284, 22, 19, '2024-03-04', '2024-03-04'),
(285, 22, 19, '2024-03-04', '2024-03-04'),
(286, 22, 20, '2024-03-04', '2024-03-04'),
(287, 22, 20, '2024-03-04', '2024-03-04'),
(288, 22, 20, '2024-03-04', '2024-03-04'),
(289, 22, 20, '2024-03-04', '2024-03-04'),
(290, 22, 20, '2024-03-04', '2024-03-04'),
(291, 23, 18, '2024-03-04', '2024-03-04'),
(292, 23, 18, '2024-03-04', '2024-03-04'),
(293, 23, 18, '2024-03-04', '2024-03-04'),
(294, 23, 18, '2024-03-04', '2024-03-04'),
(295, 23, 18, '2024-03-04', '2024-03-04'),
(296, 23, 1, '2024-03-04', '2024-03-04'),
(297, 23, 1, '2024-03-04', '2024-03-04'),
(298, 23, 1, '2024-03-04', '2024-03-04'),
(299, 23, 1, '2024-03-04', '2024-03-04'),
(300, 23, 1, '2024-03-04', '2024-03-04'),
(301, 24, 18, '2024-03-04', '2024-03-04'),
(302, 24, 18, '2024-03-04', '2024-03-04'),
(303, 24, 18, '2024-03-04', '2024-03-04'),
(304, 24, 18, '2024-03-04', '2024-03-04'),
(305, 24, 18, '2024-03-04', '2024-03-04'),
(306, 24, 1, '2024-03-04', '2024-03-04'),
(307, 24, 1, '2024-03-04', '2024-03-04'),
(308, 24, 1, '2024-03-04', '2024-03-04'),
(309, 24, 1, '2024-03-04', '2024-03-04'),
(310, 24, 1, '2024-03-04', '2024-03-04'),
(311, 25, 19, '2024-03-04', '2024-03-04'),
(312, 25, 19, '2024-03-04', '2024-03-04'),
(313, 25, 19, '2024-03-04', '2024-03-04'),
(314, 25, 19, '2024-03-04', '2024-03-04'),
(315, 25, 19, '2024-03-04', '2024-03-04'),
(316, 25, 18, '2024-03-04', '2024-03-04'),
(317, 25, 18, '2024-03-04', '2024-03-04'),
(318, 25, 18, '2024-03-04', '2024-03-04'),
(319, 25, 18, '2024-03-04', '2024-03-04'),
(320, 25, 20, '2024-03-04', '2024-03-04'),
(321, 25, 20, '2024-03-04', '2024-03-04'),
(322, 26, 19, '2024-03-04', '2024-03-04'),
(323, 26, 19, '2024-03-04', '2024-03-04'),
(324, 26, 19, '2024-03-04', '2024-03-04'),
(325, 26, 19, '2024-03-04', '2024-03-04'),
(326, 26, 19, '2024-03-04', '2024-03-04'),
(327, 26, 18, '2024-03-04', '2024-03-04'),
(328, 26, 18, '2024-03-04', '2024-03-04'),
(329, 26, 18, '2024-03-04', '2024-03-04'),
(330, 26, 18, '2024-03-04', '2024-03-04'),
(331, 26, 20, '2024-03-04', '2024-03-04'),
(332, 26, 20, '2024-03-04', '2024-03-04'),
(333, 27, 19, '2024-03-04', '2024-03-04'),
(334, 27, 19, '2024-03-04', '2024-03-04'),
(335, 27, 19, '2024-03-04', '2024-03-04'),
(336, 27, 19, '2024-03-04', '2024-03-04'),
(337, 27, 19, '2024-03-04', '2024-03-04'),
(338, 27, 18, '2024-03-04', '2024-03-04'),
(339, 27, 18, '2024-03-04', '2024-03-04'),
(340, 27, 18, '2024-03-04', '2024-03-04'),
(341, 27, 18, '2024-03-04', '2024-03-04'),
(342, 27, 20, '2024-03-04', '2024-03-04'),
(343, 27, 20, '2024-03-04', '2024-03-04'),
(344, 28, 19, '2024-03-04', '2024-03-04'),
(345, 28, 19, '2024-03-04', '2024-03-04'),
(346, 28, 19, '2024-03-04', '2024-03-04'),
(347, 28, 19, '2024-03-04', '2024-03-04'),
(348, 28, 19, '2024-03-04', '2024-03-04'),
(349, 28, 18, '2024-03-04', '2024-03-04'),
(350, 28, 18, '2024-03-04', '2024-03-04'),
(351, 28, 18, '2024-03-04', '2024-03-04'),
(352, 28, 18, '2024-03-04', '2024-03-04'),
(353, 28, 20, '2024-03-04', '2024-03-04'),
(354, 28, 20, '2024-03-04', '2024-03-04'),
(355, 29, 19, '2024-03-04', '2024-03-04'),
(356, 29, 19, '2024-03-04', '2024-03-04'),
(357, 29, 19, '2024-03-04', '2024-03-04'),
(358, 29, 19, '2024-03-04', '2024-03-04'),
(359, 29, 19, '2024-03-04', '2024-03-04'),
(360, 29, 19, '2024-03-04', '2024-03-04'),
(361, 29, 19, '2024-03-04', '2024-03-04'),
(362, 29, 19, '2024-03-04', '2024-03-04'),
(363, 29, 20, '2024-03-04', '2024-03-04'),
(364, 29, 20, '2024-03-04', '2024-03-04'),
(365, 29, 20, '2024-03-04', '2024-03-04'),
(366, 29, 20, '2024-03-04', '2024-03-04'),
(367, 30, 19, '2024-03-04', '2024-03-04'),
(368, 30, 19, '2024-03-04', '2024-03-04'),
(369, 30, 19, '2024-03-04', '2024-03-04'),
(370, 30, 19, '2024-03-04', '2024-03-04'),
(371, 30, 19, '2024-03-04', '2024-03-04'),
(372, 30, 19, '2024-03-04', '2024-03-04'),
(373, 30, 19, '2024-03-04', '2024-03-04'),
(374, 30, 19, '2024-03-04', '2024-03-04'),
(375, 30, 20, '2024-03-04', '2024-03-04'),
(376, 30, 20, '2024-03-04', '2024-03-04'),
(377, 30, 20, '2024-03-04', '2024-03-04'),
(378, 30, 20, '2024-03-04', '2024-03-04'),
(379, 31, 19, '2024-03-04', '2024-03-04'),
(380, 31, 19, '2024-03-04', '2024-03-04'),
(381, 31, 19, '2024-03-04', '2024-03-04'),
(382, 31, 19, '2024-03-04', '2024-03-04'),
(383, 31, 19, '2024-03-04', '2024-03-04'),
(384, 31, 19, '2024-03-04', '2024-03-04'),
(385, 31, 19, '2024-03-04', '2024-03-04'),
(386, 31, 19, '2024-03-04', '2024-03-04'),
(387, 31, 20, '2024-03-04', '2024-03-04'),
(388, 31, 20, '2024-03-04', '2024-03-04'),
(389, 31, 20, '2024-03-04', '2024-03-04'),
(390, 31, 20, '2024-03-04', '2024-03-04'),
(391, 32, 19, '2024-03-04', '2024-03-04'),
(392, 32, 19, '2024-03-04', '2024-03-04'),
(393, 32, 19, '2024-03-04', '2024-03-04'),
(394, 32, 19, '2024-03-04', '2024-03-04'),
(395, 32, 19, '2024-03-04', '2024-03-04'),
(396, 32, 19, '2024-03-04', '2024-03-04'),
(397, 32, 19, '2024-03-04', '2024-03-04'),
(398, 32, 19, '2024-03-04', '2024-03-04'),
(399, 32, 20, '2024-03-04', '2024-03-04'),
(400, 32, 20, '2024-03-04', '2024-03-04'),
(401, 32, 20, '2024-03-04', '2024-03-04'),
(402, 32, 20, '2024-03-04', '2024-03-04'),
(403, 33, 19, '2024-03-04', '2024-03-04'),
(404, 33, 19, '2024-03-04', '2024-03-04'),
(405, 33, 19, '2024-03-04', '2024-03-04'),
(406, 33, 19, '2024-03-04', '2024-03-04'),
(407, 33, 19, '2024-03-04', '2024-03-04'),
(408, 33, 19, '2024-03-04', '2024-03-04'),
(409, 33, 19, '2024-03-04', '2024-03-04'),
(410, 33, 19, '2024-03-04', '2024-03-04'),
(411, 33, 20, '2024-03-04', '2024-03-04'),
(412, 33, 20, '2024-03-04', '2024-03-04'),
(413, 33, 20, '2024-03-04', '2024-03-04'),
(414, 33, 20, '2024-03-04', '2024-03-04'),
(415, 34, 20, '2024-03-04', '2024-03-04'),
(416, 35, 20, '2024-03-04', '2024-03-04'),
(417, 36, 20, '2024-03-04', '2024-03-04'),
(418, 37, 20, '2024-03-04', '2024-03-04'),
(419, 38, 20, '2024-03-04', '2024-03-04'),
(420, 39, 20, '2024-03-04', '2024-03-04'),
(421, 40, 20, '2024-03-04', '2024-03-04'),
(422, 41, 20, '2024-03-04', '2024-03-04'),
(423, 42, 20, '2024-03-04', '2024-03-04'),
(424, 43, 20, '2024-03-04', '2024-03-04'),
(425, 44, 20, '2024-03-04', '2024-03-04'),
(426, 45, 20, '2024-03-09', '2024-03-09'),
(427, 46, 19, '2024-03-09', '2024-03-09'),
(428, 50, 1, '2024-04-17', '2024-04-17'),
(429, 54, 19, '2024-05-04', '2024-05-04'),
(430, 10, 19, '2024-05-04', '2024-05-04'),
(431, 10, 20, '2024-05-04', '2024-05-04'),
(432, 10, 21, '2024-05-04', '2024-05-04'),
(433, 12, 19, '2024-05-14', '2024-05-14'),
(434, 12, 19, '2024-05-18', '2024-05-18'),
(435, 12, 19, '2024-05-18', '2024-05-18'),
(436, 63, 20, '2024-05-25', '2024-05-25'),
(437, 65, 19, '2024-05-28', '2024-05-28'),
(438, 66, 19, '2024-05-28', '2024-05-28'),
(439, 67, 19, '2024-05-28', '2024-05-28'),
(440, 68, 19, '2024-05-28', '2024-05-28'),
(441, 69, 19, '2024-05-28', '2024-05-28'),
(442, 70, 19, '2024-05-28', '2024-05-28'),
(443, 71, 19, '2024-05-28', '2024-05-28'),
(444, 72, 19, '2024-05-28', '2024-05-28'),
(445, 73, 19, '2024-05-28', '2024-05-28'),
(446, 74, 20, '2024-05-29', '2024-05-29'),
(447, 75, 20, '2024-05-29', '2024-05-29'),
(448, 76, 18, '2024-06-01', '2024-06-01'),
(449, 77, 18, '2024-06-01', '2024-06-01'),
(450, 78, 18, '2024-06-01', '2024-06-01'),
(451, 79, 18, '2024-06-01', '2024-06-01'),
(452, 80, 18, '2024-06-01', '2024-06-01'),
(453, 81, 18, '2024-06-01', '2024-06-01'),
(454, 82, 18, '2024-06-01', '2024-06-01'),
(455, 83, 18, '2024-06-01', '2024-06-01'),
(456, 84, 18, '2024-06-01', '2024-06-01'),
(457, 85, 18, '2024-06-01', '2024-06-01'),
(458, 86, 18, '2024-06-01', '2024-06-01'),
(459, 87, 18, '2024-06-01', '2024-06-01'),
(460, 88, 18, '2024-06-01', '2024-06-01'),
(461, 89, 18, '2024-06-01', '2024-06-01'),
(462, 90, 18, '2024-06-01', '2024-06-01'),
(463, 91, 18, '2024-06-01', '2024-06-01'),
(464, 92, 20, '2024-06-04', '2024-06-04'),
(465, 93, 18, '2024-06-04', '2024-06-04'),
(466, 94, 19, '2024-06-05', '2024-06-05'),
(467, 95, 19, '2024-06-05', '2024-06-05'),
(468, 96, 19, '2024-06-12', '2024-06-12'),
(469, 97, 20, '2024-06-12', '2024-06-12'),
(470, 98, 19, '2024-06-12', '2024-06-12'),
(471, 99, 18, '2024-06-19', '2024-06-19'),
(472, 100, 19, '2024-06-22', '2024-06-22'),
(473, 101, 20, '2024-07-04', '2024-07-04'),
(474, 102, 20, '2024-07-04', '2024-07-04'),
(475, 103, 20, '2024-07-08', '2024-07-08'),
(476, 104, 20, '2024-07-14', '2024-07-14'),
(477, 105, 18, '2024-07-14', '2024-07-14'),
(478, 106, 18, '2024-07-14', '2024-07-14'),
(479, 107, 18, '2024-07-14', '2024-07-14'),
(480, 108, 18, '2024-07-14', '2024-07-14'),
(481, 109, 28, '2024-07-20', '2024-07-20'),
(482, 109, 25, '2024-07-20', '2024-07-20'),
(483, 110, 18, '2024-07-27', '2024-07-27'),
(484, 111, 20, '2024-07-28', '2024-07-28'),
(485, 112, 18, '2024-07-28', '2024-07-28');

-- --------------------------------------------------------

--
-- Table structure for table `diagnostic_exams`
--

CREATE TABLE `diagnostic_exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `time` varchar(255) NOT NULL,
  `score` int(11) NOT NULL,
  `pass_score` float NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `score_id` bigint(20) UNSIGNED DEFAULT NULL,
  `state` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diagnostic_exams`
--

INSERT INTO `diagnostic_exams` (`id`, `title`, `description`, `time`, `score`, `pass_score`, `course_id`, `score_id`, `state`, `created_at`, `updated_at`) VALUES
(10, 'sad', 'asd', 'Hours  M', 100, 48, 1, 4, 0, '2024-01-24', '2024-03-26'),
(12, 'ggggg', 'ggggg', '1Hours 1 M', 100, 48, 1, 4, 0, '2024-02-03', '2024-02-03'),
(13, 'sasasasasasasa', 'sasasa', '1Hours 1 M', 100, 40, 1, 4, 0, '2024-02-15', '2024-02-15'),
(14, 'asddsa', 'asds', '1Hours 2 M', 100, 21, 1, 4, 0, '2024-03-04', '2024-03-04'),
(15, 'asddsa', 'asds', '1Hours 2 M', 100, 21, 1, 4, 0, '2024-03-04', '2024-03-04'),
(16, 'asddsa', 'asds', '1Hours 2 M', 100, 21, 1, 4, 1, '2024-03-04', '2024-03-04'),
(17, 'scdas', 'asd', '1Hours 1 M', 100, 8, 1, 4, 1, '2024-03-04', '2024-03-04'),
(18, 'adf', 'asd', 'Hours  M', 100, 22, 1, 4, 1, '2024-03-04', '2024-03-04'),
(19, 'ssad', 'ss', '1Hours 1 M', 100, 48, 1, 4, 1, '2024-03-09', '2024-03-09'),
(20, 'nnnnn', 'nnnnn', 'Hours  M', 100, 40, 1, 4, 1, '2024-03-31', '2024-07-30'),
(21, 'nnnnnnn', 'nnnnnnnnn', 'Hours  M', 100, 48, 1, 4, 1, '2024-03-31', '2024-06-12'),
(23, 'sdf', 'dsf', '1Hours 1 M', 1001, 40, 1, 4, 1, '2024-05-11', '2024-05-11'),
(24, 'dddd', 'dddd', '1Hours 1 M', 100, 40, 1, 2, 0, '2024-05-25', '2024-07-30'),
(25, 'dash', 'asd', 'Hours  M', 100, 40, 1, 2, 1, '2024-06-03', '2024-07-30');

-- --------------------------------------------------------

--
-- Table structure for table `diagnostic_exams_history`
--

CREATE TABLE `diagnostic_exams_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `diagnostic_exams_id` bigint(20) UNSIGNED NOT NULL,
  `score` int(11) NOT NULL,
  `time` time DEFAULT NULL,
  `r_questions` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diagnostic_exams_history`
--

INSERT INTO `diagnostic_exams_history` (`id`, `user_id`, `diagnostic_exams_id`, `score`, `time`, `r_questions`, `date`, `created_at`, `updated_at`) VALUES
(1, 8, 10, 0, NULL, 0, NULL, '2024-03-03', '2024-03-03'),
(2, 8, 10, 0, NULL, 0, NULL, '2024-03-03', '2024-03-03'),
(3, 8, 10, 0, NULL, 0, NULL, '2024-03-03', '2024-03-03'),
(4, 8, 10, 0, NULL, 0, NULL, '2024-03-03', '2024-03-03'),
(5, 8, 10, 0, NULL, 0, NULL, '2024-03-03', '2024-03-03'),
(6, 8, 10, 0, NULL, 0, NULL, '2024-03-03', '2024-03-03'),
(7, 8, 10, 0, NULL, 0, NULL, '2024-03-03', '2024-03-03'),
(8, 8, 10, 0, NULL, 0, NULL, '2024-03-03', '2024-03-03'),
(9, 8, 10, 0, NULL, 0, NULL, '2024-03-03', '2024-03-03'),
(10, 8, 10, 0, NULL, 0, NULL, '2024-03-03', '2024-03-03'),
(11, 8, 10, 0, NULL, 0, NULL, '2024-03-03', '2024-03-03'),
(12, 8, 10, 0, NULL, 0, NULL, '2024-03-03', '2024-03-03'),
(13, 8, 10, 0, NULL, 0, NULL, '2024-03-03', '2024-03-03'),
(14, 8, 10, 0, NULL, 0, NULL, '2024-03-03', '2024-03-03'),
(15, 8, 10, 0, NULL, 0, NULL, '2024-03-03', '2024-03-03'),
(16, 8, 10, 0, NULL, 0, NULL, '2024-03-03', '2024-03-03'),
(17, 8, 10, 0, NULL, 0, NULL, '2024-03-03', '2024-03-03'),
(18, 8, 12, 3, NULL, 2, NULL, '2024-03-04', '2024-03-04'),
(19, 8, 12, 3, NULL, 2, NULL, '2024-03-04', '2024-03-04'),
(20, 8, 12, 3, NULL, 2, NULL, '2024-03-04', '2024-03-04'),
(21, 8, 12, 3, NULL, 2, NULL, '2024-03-04', '2024-03-04'),
(22, 8, 12, 3, NULL, 2, NULL, '2024-03-04', '2024-03-04'),
(23, 8, 13, 0, NULL, 0, NULL, '2024-03-04', '2024-03-04'),
(24, 8, 13, 0, NULL, 0, NULL, '2024-03-04', '2024-03-04'),
(25, 8, 16, 5, NULL, 4, NULL, '2024-03-04', '2024-03-04'),
(26, 8, 16, 5, NULL, 4, NULL, '2024-03-04', '2024-03-04'),
(27, 8, 16, 5, NULL, 4, NULL, '2024-03-04', '2024-03-04'),
(28, 8, 16, 5, NULL, 4, NULL, '2024-03-04', '2024-03-04'),
(29, 8, 12, 4, NULL, 3, NULL, '2024-03-04', '2024-03-04'),
(30, 8, 12, 4, NULL, 3, NULL, '2024-03-04', '2024-03-04'),
(31, 8, 12, 4, NULL, 3, NULL, '2024-03-04', '2024-03-04'),
(32, 8, 12, 4, NULL, 3, NULL, '2024-03-04', '2024-03-04'),
(33, 8, 12, 4, NULL, 3, NULL, '2024-03-04', '2024-03-04'),
(34, 8, 12, 4, NULL, 3, NULL, '2024-03-04', '2024-03-04'),
(35, 8, 12, 2, NULL, 1, NULL, '2024-03-04', '2024-03-04'),
(36, 8, 12, 2, NULL, 1, NULL, '2024-03-04', '2024-03-04'),
(37, 8, 12, 2, NULL, 1, NULL, '2024-03-04', '2024-03-04'),
(38, 8, 12, 2, NULL, 1, NULL, '2024-03-04', '2024-03-04'),
(39, 8, 12, 2, NULL, 1, NULL, '2024-03-04', '2024-03-04'),
(40, 8, 12, 2, NULL, 1, NULL, '2024-03-04', '2024-03-04'),
(41, 8, 12, 2, NULL, 1, NULL, '2024-03-04', '2024-03-04'),
(42, 8, 12, 2, NULL, 1, NULL, '2024-03-04', '2024-03-04'),
(43, 8, 12, 2, NULL, 1, NULL, '2024-03-04', '2024-03-04'),
(44, 8, 12, 2, NULL, 1, NULL, '2024-03-04', '2024-03-04'),
(45, 8, 12, 2, NULL, 1, '2024-03-09', '2024-03-09', '2024-03-09'),
(46, 8, 10, 2, NULL, 1, '2024-03-09', '2024-03-09', '2024-03-09'),
(47, 8, 14, 2, NULL, 1, '2024-03-20', '2024-03-20', '2024-03-20'),
(48, 8, 14, 2, NULL, 1, '2024-03-20', '2024-03-20', '2024-03-20'),
(49, 8, 18, 2, NULL, 1, '2024-04-17', '2024-04-17', '2024-04-17'),
(50, 8, 15, 0, NULL, 0, '2024-04-17', '2024-04-17', '2024-04-17'),
(51, 8, 10, 5, NULL, 5, '2024-04-25', '2024-04-25', '2024-04-25'),
(52, 8, 10, 5, NULL, 5, '2024-04-25', '2024-04-25', '2024-04-25'),
(53, 8, 10, 5, NULL, 5, '2024-04-25', '2024-04-25', '2024-04-25'),
(54, 8, 20, 0, NULL, 0, '2024-05-04', '2024-05-04', '2024-05-04'),
(55, 8, 10, 5, NULL, 5, '2024-05-04', '2024-05-04', '2024-05-04'),
(56, 8, 10, 5, NULL, 5, '2024-05-04', '2024-05-04', '2024-05-04'),
(57, 8, 12, 2, NULL, 1, '2024-05-14', '2024-05-14', '2024-05-14'),
(58, 8, 19, 5, NULL, 4, '2024-05-17', '2024-05-17', '2024-05-17'),
(59, 8, 12, 2, NULL, 1, '2024-05-18', '2024-05-18', '2024-05-18'),
(60, 8, 12, 2, NULL, 1, '2024-05-18', '2024-05-18', '2024-05-18'),
(61, 8, 19, 5, NULL, 4, '2024-05-18', '2024-05-18', '2024-05-18'),
(62, 8, 19, 5, NULL, 4, '2024-05-25', '2024-05-25', '2024-05-25'),
(63, 8, 18, 0, NULL, 0, '2024-05-25', '2024-05-25', '2024-05-25'),
(64, 8, 21, 2, NULL, 1, '2024-05-28', '2024-05-28', '2024-05-28'),
(65, 8, 21, 0, NULL, 0, '2024-05-28', '2024-05-28', '2024-05-28'),
(66, 8, 21, 0, NULL, 0, '2024-05-28', '2024-05-28', '2024-05-28'),
(67, 8, 21, 0, NULL, 0, '2024-05-28', '2024-05-28', '2024-05-28'),
(68, 8, 21, 0, NULL, 0, '2024-05-28', '2024-05-28', '2024-05-28'),
(69, 8, 21, 0, NULL, 0, '2024-05-28', '2024-05-28', '2024-05-28'),
(70, 8, 21, 0, NULL, 0, '2024-05-28', '2024-05-28', '2024-05-28'),
(71, 8, 21, 0, NULL, 0, '2024-05-28', '2024-05-28', '2024-05-28'),
(72, 8, 21, 0, NULL, 0, '2024-05-28', '2024-05-28', '2024-05-28'),
(73, 8, 21, 0, NULL, 0, '2024-05-28', '2024-05-28', '2024-05-28'),
(74, 8, 18, 0, NULL, 0, '2024-05-29', '2024-05-29', '2024-05-29'),
(75, 8, 18, 0, NULL, 0, '2024-05-29', '2024-05-29', '2024-05-29'),
(76, 8, 17, 0, NULL, 0, '2024-06-01', '2024-06-01', '2024-06-01'),
(77, 8, 17, 0, NULL, 0, '2024-06-01', '2024-06-01', '2024-06-01'),
(78, 8, 17, 0, NULL, 0, '2024-06-01', '2024-06-01', '2024-06-01'),
(79, 8, 17, 0, NULL, 0, '2024-06-01', '2024-06-01', '2024-06-01'),
(80, 8, 17, 0, NULL, 0, '2024-06-01', '2024-06-01', '2024-06-01'),
(81, 8, 17, 0, NULL, 0, '2024-06-01', '2024-06-01', '2024-06-01'),
(82, 8, 17, 0, NULL, 0, '2024-06-01', '2024-06-01', '2024-06-01'),
(83, 8, 17, 0, NULL, 0, '2024-06-01', '2024-06-01', '2024-06-01'),
(84, 8, 17, 0, NULL, 0, '2024-06-01', '2024-06-01', '2024-06-01'),
(85, 8, 17, 0, NULL, 0, '2024-06-01', '2024-06-01', '2024-06-01'),
(86, 8, 17, 0, NULL, 0, '2024-06-01', '2024-06-01', '2024-06-01'),
(87, 8, 17, 0, NULL, 0, '2024-06-01', '2024-06-01', '2024-06-01'),
(88, 8, 17, 0, NULL, 0, '2024-06-01', '2024-06-01', '2024-06-01'),
(89, 8, 17, 0, NULL, 0, '2024-06-01', '2024-06-01', '2024-06-01'),
(90, 8, 17, 0, NULL, 0, '2024-06-01', '2024-06-01', '2024-06-01'),
(91, 8, 17, 0, NULL, 0, '2024-06-01', '2024-06-01', '2024-06-01'),
(92, 8, 19, 200, NULL, 0, '2024-06-04', '2024-06-04', '2024-06-04'),
(93, 8, 17, 200, NULL, 0, '2024-06-04', '2024-06-04', '2024-06-04'),
(94, 8, 21, 200, NULL, 0, '2024-06-05', '2024-06-05', '2024-06-05'),
(95, 8, 21, 200, NULL, 0, '2024-06-05', '2024-06-05', '2024-06-05'),
(96, 8, 21, 200, NULL, 0, '2024-06-12', '2024-06-12', '2024-06-12'),
(97, 8, 18, 200, NULL, 0, '2024-06-12', '2024-06-12', '2024-06-12'),
(98, 8, 21, 200, '00:00:01', 0, '2024-06-12', '2024-06-12', '2024-06-12'),
(99, 8, 17, 200, '00:00:00', 0, '2024-06-19', '2024-06-19', '2024-06-19'),
(100, 8, 20, 200, '00:00:00', 0, '2024-06-22', '2024-06-22', '2024-06-22'),
(101, 8, 18, 200, '00:00:00', 0, '2024-07-04', '2024-07-04', '2024-07-04'),
(102, 8, 18, 200, '00:00:00', 0, '2024-07-04', '2024-07-04', '2024-07-04'),
(103, 8, 19, 200, NULL, 0, '2024-07-08', '2024-07-08', '2024-07-08'),
(104, 8, 18, 200, '00:00:00', 0, '2024-07-14', '2024-07-14', '2024-07-14'),
(105, 8, 17, 200, '00:00:00', 0, '2024-07-14', '2024-07-14', '2024-07-14'),
(106, 8, 17, 200, '00:00:00', 0, '2024-07-14', '2024-07-14', '2024-07-14'),
(107, 8, 17, 200, '00:00:00', 0, '2024-07-14', '2024-07-14', '2024-07-14'),
(108, 8, 17, 200, '00:00:32', 0, '2024-07-14', '2024-07-14', '2024-07-14'),
(109, 8, 25, 1, '00:00:03', 1, '2024-07-20', '2024-07-20', '2024-07-20'),
(110, 8, 17, 200, NULL, 0, '2024-07-27', '2024-07-27', '2024-07-27'),
(111, 8, 18, 200, '00:00:00', 0, '2024-07-28', '2024-07-28', '2024-07-28'),
(112, 8, 17, 200, '00:00:02', 0, '2024-07-28', '2024-07-28', '2024-07-28');

-- --------------------------------------------------------

--
-- Table structure for table `dia_questions`
--

CREATE TABLE `dia_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `diagnostic_exam_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dia_questions`
--

INSERT INTO `dia_questions` (`id`, `diagnostic_exam_id`, `question_id`, `created_at`, `updated_at`) VALUES
(14, 12, 19, '2024-02-03', '2024-02-03'),
(15, 12, 20, '2024-02-03', '2024-02-03'),
(16, 13, 1, '2024-02-15', '2024-02-15'),
(17, 13, 18, '2024-02-15', '2024-02-15'),
(18, 16, 20, '2024-03-04', '2024-03-04'),
(19, 16, 19, '2024-03-04', '2024-03-04'),
(20, 14, 18, '2024-03-04', '2024-03-04'),
(21, 15, 1, '2024-03-04', '2024-03-04'),
(22, 17, 18, '2024-03-04', '2024-03-04'),
(25, 19, 1, '2024-03-09', '2024-03-09'),
(26, 19, 18, '2024-03-09', '2024-03-09'),
(28, 18, 20, '2024-03-09', '2024-03-09'),
(29, 19, 21, '2024-03-09', '2024-03-09'),
(30, 19, 20, '2024-03-09', '2024-03-09'),
(36, 10, 21, '2024-03-26', '2024-03-26'),
(37, 10, 20, '2024-03-26', '2024-03-26'),
(46, 23, 1, '2024-05-11', '2024-05-11'),
(47, 23, 1, '2024-05-11', '2024-05-11'),
(48, 23, 1, '2024-05-11', '2024-05-11'),
(84, 21, 19, '2024-06-12', '2024-06-12'),
(85, 21, 1, '2024-06-12', '2024-06-12'),
(86, 21, 1, '2024-06-12', '2024-06-12'),
(104, 24, 28, '2024-07-30', '2024-07-30'),
(105, 24, 27, '2024-07-30', '2024-07-30'),
(106, 24, 1, '2024-07-30', '2024-07-30'),
(107, 24, 18, '2024-07-30', '2024-07-30'),
(108, 20, 19, '2024-07-30', '2024-07-30'),
(109, 20, 38, '2024-07-30', '2024-07-30'),
(110, 20, 39, '2024-07-30', '2024-07-30'),
(111, 20, 40, '2024-07-30', '2024-07-30'),
(112, 25, 25, '2024-07-30', '2024-07-30'),
(113, 25, 25, '2024-07-30', '2024-07-30'),
(114, 25, 25, '2024-07-30', '2024-07-30'),
(115, 25, 31, '2024-07-30', '2024-07-30'),
(116, 25, 28, '2024-07-30', '2024-07-30'),
(117, 25, 25, '2024-07-30', '2024-07-30'),
(118, 25, 25, '2024-07-30', '2024-07-30'),
(119, 25, 38, '2024-07-30', '2024-07-30'),
(120, 25, 39, '2024-07-30', '2024-07-30'),
(121, 25, 40, '2024-07-30', '2024-07-30'),
(122, 25, 34, '2024-07-30', '2024-07-30'),
(123, 25, 35, '2024-07-30', '2024-07-30'),
(124, 25, 36, '2024-07-30', '2024-07-30'),
(125, 25, 40, '2024-07-30', '2024-07-30'),
(126, 25, 41, '2024-07-30', '2024-07-30');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `time` time NOT NULL,
  `score` int(11) NOT NULL,
  `pass_score` int(11) NOT NULL,
  `sections` int(11) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `month` int(10) UNSIGNED DEFAULT NULL,
  `code_id` bigint(20) UNSIGNED DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `score_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('extra','trail') NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`id`, `title`, `description`, `time`, `score`, `pass_score`, `sections`, `year`, `month`, `code_id`, `course_id`, `score_id`, `type`, `state`, `created_at`, `updated_at`) VALUES
(2, 'Exam 1', '111', '11:37:22', 111, 11, NULL, '2024', 3, 2, 2, 4, 'extra', 1, NULL, '2024-03-26'),
(4, 'dcf', 'fdsf', '00:00:01', 100, 21, NULL, '2011', NULL, NULL, 1, 4, 'trail', 1, '2024-03-05', '2024-03-26'),
(5, 'nnnnnn', 'nnnnnn', '00:00:01', 100, 48, NULL, NULL, NULL, NULL, 1, 2, 'extra', 1, '2024-03-31', '2024-03-31'),
(6, 'xzvc', 'dxf', '00:00:01', 100, 40, NULL, NULL, NULL, NULL, 1, 2, 'extra', 1, '2024-03-31', '2024-03-31'),
(7, 'vvv', 'vv', '00:00:01', 100, 48, NULL, NULL, NULL, NULL, 1, 2, 'extra', 1, '2024-03-31', '2024-03-31'),
(8, 'sa', 'asd', '00:00:01', 100, 48, NULL, NULL, NULL, NULL, 1, 2, 'extra', 1, '2024-03-31', '2024-03-31'),
(9, 'llll', 'llll', '00:00:01', 100, 48, NULL, NULL, NULL, NULL, 1, 2, 'extra', 1, '2024-03-31', '2024-03-31'),
(10, 'wef', 'fwf', '00:00:01', 100, 40, NULL, NULL, NULL, NULL, 1, 2, 'trail', 1, '2024-04-24', '2024-06-12'),
(11, 'Exam 31', 'asd31', '00:00:01', 31, 31, NULL, NULL, NULL, NULL, 1, 4, 'trail', 1, '2024-05-01', '2024-06-11'),
(12, 'Exam 25', 'Exam 25', '00:00:01', 15, 5, NULL, NULL, NULL, NULL, 12, 2, 'trail', 1, '2024-05-14', '2024-06-11'),
(13, 'Exam 77', 'Des 77', '01:02:00', 100, 40, 3, NULL, NULL, NULL, 1, 2, 'extra', 0, '2024-07-16', '2024-07-16'),
(14, 'Exam 55', 'Desc Exam 55', '01:03:00', 100, 40, 3, NULL, NULL, NULL, 1, 2, 'extra', 0, '2024-07-16', '2024-07-16'),
(15, 'Exam 45', 'Desc Exam 45', '01:00:00', 100, 40, 3, NULL, NULL, NULL, 1, 2, 'extra', 0, '2024-07-16', '2024-07-16'),
(16, 'Exam 45', 'Desc Exam 45', '01:00:00', 100, 40, 3, NULL, NULL, NULL, 1, 2, 'extra', 0, '2024-07-16', '2024-08-04'),
(17, 'aaa', 'aaa', '01:01:00', 11, 11, 3, NULL, NULL, NULL, 1, 4, 'extra', 1, '2024-07-16', '2024-08-04');

-- --------------------------------------------------------

--
-- Table structure for table `exam_codes`
--

CREATE TABLE `exam_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_code` varchar(255) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `exam_codes`
--

INSERT INTO `exam_codes` (`id`, `exam_code`, `created_at`, `updated_at`) VALUES
(2, '1234', '2024-01-24', '2024-03-02'),
(3, '765', '2024-04-01', '2024-04-01');

-- --------------------------------------------------------

--
-- Table structure for table `exam_history`
--

CREATE TABLE `exam_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `score` int(11) NOT NULL,
  `time` time DEFAULT NULL,
  `date` date DEFAULT NULL,
  `r_questions` int(11) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_history`
--

INSERT INTO `exam_history` (`id`, `user_id`, `exam_id`, `score`, `time`, `date`, `r_questions`, `created_at`, `updated_at`) VALUES
(1, 8, 2, 2, '00:00:00', '2024-03-06', 1, '2024-03-06', '2024-03-06'),
(2, 8, 2, 2, '00:00:00', '2024-03-06', 1, '2024-03-06', '2024-03-06'),
(3, 8, 2, 2, '00:00:00', '2024-03-06', 1, '2024-03-06', '2024-03-06'),
(4, 8, 2, 2, '00:00:00', '2024-03-06', 1, '2024-03-06', '2024-03-06'),
(5, 8, 2, 2, '00:00:00', '2024-03-06', 1, '2024-03-06', '2024-03-06'),
(6, 8, 2, 2, '00:00:00', '2024-03-06', 1, '2024-03-06', '2024-03-06'),
(7, 8, 2, 2, '00:00:00', '2024-03-06', 1, '2024-03-06', '2024-03-06'),
(8, 8, 2, 2, '00:00:00', '2024-03-06', 1, '2024-03-06', '2024-03-06'),
(9, 8, 2, 2, '00:00:00', '2024-03-06', 1, '2024-03-06', '2024-03-06'),
(10, 8, 2, 2, '00:00:00', '2024-03-09', 1, '2024-03-09', '2024-03-09'),
(11, 8, 2, 0, '00:00:00', '2024-04-04', 0, '2024-04-04', '2024-04-04'),
(12, 8, 2, 0, '00:00:00', '2024-04-04', 0, '2024-04-04', '2024-04-04'),
(13, 8, 2, 0, '00:00:00', '2024-04-04', 0, '2024-04-04', '2024-04-04'),
(14, 8, 2, 5, '00:00:00', '2024-04-22', 5, '2024-04-22', '2024-04-22'),
(15, 8, 2, 5, '00:00:00', '2024-04-22', 5, '2024-04-22', '2024-04-22'),
(16, 8, 2, 5, '00:00:00', '2024-04-22', 5, '2024-04-22', '2024-04-22'),
(17, 8, 2, 5, '00:00:00', '2024-04-22', 5, '2024-04-22', '2024-04-22'),
(18, 8, 2, 5, '00:00:00', '2024-04-22', 5, '2024-04-22', '2024-04-22'),
(19, 8, 2, 5, '00:00:00', '2024-04-29', 4, '2024-04-29', '2024-04-29'),
(20, 8, 2, 5, '00:00:00', '2024-04-29', 4, '2024-04-29', '2024-04-29'),
(21, 8, 2, 5, '00:00:00', '2024-04-29', 4, '2024-04-29', '2024-04-29'),
(22, 8, 2, 5, '00:00:00', '2024-04-29', 4, '2024-04-29', '2024-04-29'),
(23, 8, 4, 4, '00:00:00', '2024-05-01', 3, '2024-05-01', '2024-05-01'),
(24, 8, 4, 4, '00:00:00', '2024-05-01', 3, '2024-05-01', '2024-05-01'),
(25, 8, 4, 4, '00:00:00', '2024-05-01', 3, '2024-05-01', '2024-05-01'),
(26, 8, 4, 4, '00:00:00', '2024-05-01', 3, '2024-05-01', '2024-05-01'),
(27, 8, 4, 4, '00:00:00', '2024-05-01', 3, '2024-05-01', '2024-05-01'),
(28, 8, 4, 4, '00:00:00', '2024-05-01', 3, '2024-05-01', '2024-05-01'),
(29, 8, 4, 4, '00:00:00', '2024-05-01', 3, '2024-05-01', '2024-05-01'),
(30, 8, 4, 4, '00:00:00', '2024-05-18', 3, '2024-05-18', '2024-05-18'),
(31, 8, 4, 4, '00:00:00', '2024-05-18', 3, '2024-05-18', '2024-05-18'),
(32, 8, 2, 4, '00:00:00', '2024-05-25', 3, '2024-05-25', '2024-05-25'),
(33, 8, 2, 5, '00:00:00', '2024-05-25', 4, '2024-05-25', '2024-05-25'),
(34, 8, 2, 4, '00:00:00', '2024-05-28', 3, '2024-05-28', '2024-05-28'),
(35, 8, 2, 3, '00:00:00', '2024-05-28', 2, '2024-05-28', '2024-05-28'),
(36, 8, 2, 3, '00:00:00', '2024-05-29', 2, '2024-05-29', '2024-05-29'),
(37, 8, 2, 3, '00:00:00', '2024-05-29', 2, '2024-05-29', '2024-05-29'),
(38, 8, 2, 3, '00:00:00', '2024-05-29', 2, '2024-05-29', '2024-05-29'),
(39, 8, 2, 3, '00:00:00', '2024-05-29', 2, '2024-05-29', '2024-05-29'),
(40, 8, 2, 3, '00:00:00', '2024-05-29', 2, '2024-05-29', '2024-05-29'),
(41, 8, 2, 3, '00:00:00', '2024-05-29', 2, '2024-05-29', '2024-05-29'),
(42, 8, 2, 3, '00:00:00', '2024-05-29', 2, '2024-05-29', '2024-05-29'),
(43, 8, 2, 3, '00:00:00', '2024-05-29', 2, '2024-05-29', '2024-05-29'),
(44, 8, 2, 3, '00:00:00', '2024-05-29', 2, '2024-05-29', '2024-05-29'),
(45, 8, 2, 3, '00:00:00', '2024-05-29', 2, '2024-05-29', '2024-05-29'),
(46, 8, 2, 3, '00:00:00', '2024-05-29', 2, '2024-05-29', '2024-05-29'),
(47, 8, 2, 3, '00:00:00', '2024-05-29', 2, '2024-05-29', '2024-05-29'),
(48, 8, 2, 3, '00:00:00', '2024-05-29', 2, '2024-05-29', '2024-05-29'),
(49, 8, 2, 3, '00:00:00', '2024-05-29', 2, '2024-05-29', '2024-05-29'),
(50, 8, 2, 3, '00:00:00', '2024-05-29', 2, '2024-05-29', '2024-05-29'),
(51, 8, 2, 4, '00:00:00', '2024-05-30', 3, '2024-05-30', '2024-05-30'),
(52, 8, 2, 4, '00:00:00', '2024-05-30', 3, '2024-05-30', '2024-05-30'),
(53, 8, 2, 4, '00:00:00', '2024-05-30', 3, '2024-05-30', '2024-05-30'),
(54, 8, 2, 0, '00:00:00', '2024-06-04', 0, '2024-06-04', '2024-06-04'),
(55, 8, 2, 200, '00:00:00', '2024-06-04', 0, '2024-06-04', '2024-06-04'),
(56, 8, 2, 200, '00:00:00', '2024-06-04', 0, '2024-06-04', '2024-06-04'),
(57, 8, 2, 200, '00:00:00', '2024-06-04', 0, '2024-06-04', '2024-06-04'),
(58, 8, 2, 200, '00:00:00', '2024-06-05', 0, '2024-06-05', '2024-06-05'),
(59, 8, 2, 200, '00:00:00', '2024-06-05', 0, '2024-06-05', '2024-06-05'),
(60, 8, 2, 200, '00:00:00', '2024-06-05', 0, '2024-06-05', '2024-06-05'),
(61, 8, 2, 200, '00:00:00', '2024-06-05', 0, '2024-06-05', '2024-06-05'),
(62, 8, 2, 200, '00:00:00', '2024-06-05', 0, '2024-06-05', '2024-06-05'),
(63, 8, 2, 200, '00:00:00', '2024-06-05', 0, '2024-06-05', '2024-06-05'),
(64, 8, 2, 200, '00:00:00', '2024-06-05', 0, '2024-06-05', '2024-06-05'),
(65, 8, 2, 200, '00:00:00', '2024-06-05', 0, '2024-06-05', '2024-06-05'),
(66, 8, 2, 200, '00:00:00', '2024-06-05', 0, '2024-06-05', '2024-06-05'),
(67, 8, 2, 200, '00:00:00', '2024-06-05', 0, '2024-06-05', '2024-06-05'),
(68, 8, 2, 200, '00:00:00', '2024-06-05', 0, '2024-06-05', '2024-06-05'),
(69, 8, 2, 200, '00:00:00', '2024-06-08', 0, '2024-06-08', '2024-06-08'),
(70, 8, 2, 200, '00:00:00', '2024-06-08', 0, '2024-06-08', '2024-06-08'),
(71, 8, 2, 200, '00:00:00', '2024-06-12', 0, '2024-06-12', '2024-06-12'),
(72, 8, 2, 200, '00:00:00', '2024-06-12', 0, '2024-06-12', '2024-06-12'),
(73, 8, 2, 200, '00:00:00', '2024-06-12', 0, '2024-06-12', '2024-06-12'),
(74, 8, 2, 200, '00:00:00', '2024-06-12', 0, '2024-06-12', '2024-06-12'),
(75, 8, 5, 200, '00:00:00', '2024-06-19', 0, '2024-06-19', '2024-06-19'),
(76, 8, 5, 200, '00:00:00', '2024-06-19', 0, '2024-06-19', '2024-06-19'),
(77, 8, 5, 200, '00:00:00', '2024-06-19', 0, '2024-06-19', '2024-06-19'),
(78, 8, 5, 200, '00:00:00', '2024-06-19', 0, '2024-06-19', '2024-06-19'),
(79, 8, 5, 200, '00:00:00', '2024-06-19', 0, '2024-06-19', '2024-06-19'),
(80, 8, 5, 200, '00:00:00', '2024-06-19', 0, '2024-06-19', '2024-06-19'),
(81, 8, 5, 200, '00:00:00', '2024-06-19', 0, '2024-06-19', '2024-06-19'),
(82, 8, 5, 200, '00:00:00', '2024-06-19', 0, '2024-06-19', '2024-06-19'),
(83, 8, 5, 200, '00:00:00', '2024-06-19', 0, '2024-06-19', '2024-06-19'),
(84, 8, 5, 200, '00:00:00', '2024-06-19', 0, '2024-06-19', '2024-06-19'),
(85, 8, 5, 200, '00:00:00', '2024-06-19', 0, '2024-06-19', '2024-06-19'),
(86, 8, 5, 200, '00:00:00', '2024-06-19', 0, '2024-06-19', '2024-06-19'),
(87, 8, 5, 200, '00:00:00', '2024-06-19', 0, '2024-06-19', '2024-06-19'),
(88, 8, 5, 200, '00:00:00', '2024-06-19', 0, '2024-06-19', '2024-06-19'),
(89, 8, 5, 200, '00:00:00', '2024-06-19', 0, '2024-06-19', '2024-06-19'),
(90, 8, 5, 200, '00:00:00', '2024-06-19', 0, '2024-06-19', '2024-06-19'),
(91, 8, 5, 200, '00:00:00', '2024-06-19', 0, '2024-06-19', '2024-06-19'),
(92, 8, 6, 200, '00:00:00', '2024-07-08', 0, '2024-07-08', '2024-07-08'),
(93, 8, 6, 200, '00:00:00', '2024-07-08', 0, '2024-07-08', '2024-07-08'),
(94, 8, 5, 200, '00:00:00', '2024-07-09', 0, '2024-07-09', '2024-07-09'),
(95, 8, 2, 200, '00:00:00', '2024-07-09', 0, '2024-07-09', '2024-07-09'),
(96, 8, 11, 200, '00:00:00', '2024-07-14', 0, '2024-07-14', '2024-07-14'),
(97, 8, 11, 200, '00:00:00', '2024-07-14', 0, '2024-07-14', '2024-07-14'),
(98, 8, 11, 200, '00:00:00', '2024-07-14', 0, '2024-07-14', '2024-07-14'),
(99, 8, 11, 5, '00:00:00', '2024-07-14', 4, '2024-07-14', '2024-07-14'),
(100, 8, 11, 5, '00:00:00', '2024-07-14', 4, '2024-07-14', '2024-07-14'),
(101, 8, 11, 3, '00:00:00', '2024-07-14', 2, '2024-07-14', '2024-07-14'),
(102, 8, 11, 200, '00:00:00', '2024-07-14', 0, '2024-07-14', '2024-07-14'),
(103, 8, 11, 200, '00:00:00', '2024-07-14', 0, '2024-07-14', '2024-07-14'),
(104, 8, 11, 200, '00:00:00', '2024-07-14', 0, '2024-07-14', '2024-07-14'),
(105, 8, 11, 200, '00:00:00', '2024-07-14', 0, '2024-07-14', '2024-07-14'),
(106, 8, 11, 200, '00:00:00', '2024-07-14', 0, '2024-07-14', '2024-07-14'),
(107, 8, 11, 200, '00:00:00', '2024-07-14', 0, '2024-07-14', '2024-07-14'),
(108, 8, 11, 200, '00:00:00', '2024-07-14', 0, '2024-07-14', '2024-07-14'),
(109, 8, 11, 200, '00:00:00', '2024-07-14', 0, '2024-07-14', '2024-07-14'),
(110, 8, 11, 200, '00:00:00', '2024-07-14', 0, '2024-07-14', '2024-07-14'),
(111, 8, 11, 200, '00:00:00', '2024-07-14', 0, '2024-07-14', '2024-07-14'),
(112, 8, 11, 200, '00:00:00', '2024-07-14', 0, '2024-07-14', '2024-07-14'),
(113, 8, 11, 200, '00:00:00', '2024-07-14', 0, '2024-07-14', '2024-07-14'),
(114, 8, 11, 200, '00:00:00', '2024-07-14', 0, '2024-07-14', '2024-07-14'),
(115, 8, 11, 200, '00:00:00', '2024-07-14', 0, '2024-07-14', '2024-07-14'),
(116, 8, 11, 200, NULL, '2024-07-14', 0, '2024-07-14', '2024-07-14'),
(117, 8, 11, 200, NULL, '2024-07-14', 0, '2024-07-14', '2024-07-14'),
(118, 8, 11, 200, NULL, '2024-07-14', 0, '2024-07-14', '2024-07-14'),
(119, 8, 11, 200, NULL, '2024-07-14', 0, '2024-07-14', '2024-07-14'),
(120, 8, 11, 200, '00:00:32', '2024-07-14', 0, '2024-07-14', '2024-07-14'),
(121, 8, 11, 200, '00:00:12', '2024-07-20', 0, '2024-07-20', '2024-07-20'),
(122, 8, 11, 200, NULL, '2024-07-27', 0, '2024-07-27', '2024-07-27'),
(123, 8, 11, 200, NULL, '2024-07-27', 0, '2024-07-27', '2024-07-27'),
(124, 8, 11, 200, NULL, '2024-07-27', 0, '2024-07-27', '2024-07-27'),
(125, 8, 11, 200, '00:00:05', '2024-07-28', 0, '2024-07-28', '2024-07-28'),
(126, 8, 11, 200, '00:00:00', '2024-07-29', 0, '2024-07-29', '2024-07-29'),
(127, 8, 11, 200, NULL, '2024-07-29', 0, '2024-07-29', '2024-07-29'),
(128, 8, 11, 200, NULL, '2024-07-29', 0, '2024-07-29', '2024-07-29');

-- --------------------------------------------------------

--
-- Table structure for table `exam_history_sections`
--

CREATE TABLE `exam_history_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_history_id` bigint(20) UNSIGNED NOT NULL,
  `exam_section_id` bigint(20) UNSIGNED NOT NULL,
  `timer` time NOT NULL,
  `score` float NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_mistakes`
--

CREATE TABLE `exam_mistakes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_exam_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_mistakes`
--

INSERT INTO `exam_mistakes` (`id`, `student_exam_id`, `question_id`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 2, 1, 8, '2024-03-06', '2024-03-06'),
(3, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(4, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(5, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(6, 2, 19, NULL, '2024-03-06', '2024-03-06'),
(7, 2, 19, NULL, '2024-03-06', '2024-03-06'),
(8, 2, 19, NULL, '2024-03-06', '2024-03-06'),
(9, 2, 19, NULL, '2024-03-06', '2024-03-06'),
(10, 2, 19, NULL, '2024-03-06', '2024-03-06'),
(11, 2, 19, NULL, '2024-03-06', '2024-03-06'),
(12, 2, 19, NULL, '2024-03-06', '2024-03-06'),
(13, 2, 19, NULL, '2024-03-06', '2024-03-06'),
(14, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(15, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(16, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(17, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(18, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(19, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(20, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(21, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(22, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(23, 2, 19, NULL, '2024-03-06', '2024-03-06'),
(24, 2, 19, NULL, '2024-03-06', '2024-03-06'),
(25, 2, 19, NULL, '2024-03-06', '2024-03-06'),
(26, 2, 19, NULL, '2024-03-06', '2024-03-06'),
(27, 2, 19, NULL, '2024-03-06', '2024-03-06'),
(28, 2, 19, NULL, '2024-03-06', '2024-03-06'),
(29, 2, 19, NULL, '2024-03-06', '2024-03-06'),
(30, 2, 19, NULL, '2024-03-06', '2024-03-06'),
(31, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(32, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(33, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(34, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(35, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(36, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(37, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(38, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(39, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(40, 2, 19, NULL, '2024-03-06', '2024-03-06'),
(41, 2, 19, NULL, '2024-03-06', '2024-03-06'),
(42, 2, 19, NULL, '2024-03-06', '2024-03-06'),
(43, 2, 19, NULL, '2024-03-06', '2024-03-06'),
(44, 2, 19, NULL, '2024-03-06', '2024-03-06'),
(45, 2, 19, NULL, '2024-03-06', '2024-03-06'),
(46, 2, 19, NULL, '2024-03-06', '2024-03-06'),
(47, 2, 19, NULL, '2024-03-06', '2024-03-06'),
(48, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(49, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(50, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(51, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(52, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(53, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(54, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(55, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(56, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(57, 2, 19, NULL, '2024-03-06', '2024-03-06'),
(58, 2, 19, NULL, '2024-03-06', '2024-03-06'),
(59, 2, 19, NULL, '2024-03-06', '2024-03-06'),
(60, 2, 19, NULL, '2024-03-06', '2024-03-06'),
(61, 2, 19, NULL, '2024-03-06', '2024-03-06'),
(62, 2, 19, NULL, '2024-03-06', '2024-03-06'),
(63, 2, 19, NULL, '2024-03-06', '2024-03-06'),
(64, 2, 19, NULL, '2024-03-06', '2024-03-06'),
(65, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(66, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(67, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(68, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(69, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(70, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(71, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(72, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(73, 2, 1, NULL, '2024-03-06', '2024-03-06'),
(74, 2, 19, NULL, '2024-03-09', '2024-03-09'),
(75, 2, 19, NULL, '2024-03-09', '2024-03-09'),
(76, 2, 1, NULL, '2024-03-09', '2024-03-09'),
(77, 2, 1, NULL, '2024-03-09', '2024-03-09'),
(78, 2, 20, NULL, '2024-03-09', '2024-03-09'),
(79, 2, 19, NULL, '2024-04-04', '2024-04-04'),
(80, 2, 19, NULL, '2024-04-04', '2024-04-04'),
(81, 2, 19, NULL, '2024-04-04', '2024-04-04'),
(82, 2, 18, NULL, '2024-04-04', '2024-04-04'),
(83, 2, 20, NULL, '2024-04-04', '2024-04-04'),
(84, 2, 20, NULL, '2024-04-04', '2024-04-04'),
(85, 2, 19, NULL, '2024-04-04', '2024-04-04'),
(86, 2, 19, NULL, '2024-04-04', '2024-04-04'),
(87, 2, 19, NULL, '2024-04-04', '2024-04-04'),
(88, 2, 18, NULL, '2024-04-04', '2024-04-04'),
(89, 2, 20, NULL, '2024-04-04', '2024-04-04'),
(90, 2, 20, NULL, '2024-04-04', '2024-04-04'),
(91, 2, 19, NULL, '2024-04-04', '2024-04-04'),
(92, 2, 19, NULL, '2024-04-04', '2024-04-04'),
(93, 2, 19, NULL, '2024-04-04', '2024-04-04'),
(94, 2, 18, NULL, '2024-04-04', '2024-04-04'),
(95, 2, 20, NULL, '2024-04-04', '2024-04-04'),
(96, 2, 20, NULL, '2024-04-04', '2024-04-04'),
(97, 4, 19, NULL, '2024-05-01', '2024-05-01'),
(98, 4, 20, NULL, '2024-05-01', '2024-05-01'),
(99, 4, 21, NULL, '2024-05-01', '2024-05-01'),
(100, 4, 19, 8, '2024-05-18', '2024-05-18'),
(101, 4, 20, 8, '2024-05-18', '2024-05-18'),
(102, 4, 19, 8, '2024-05-18', '2024-05-18'),
(103, 4, 20, 8, '2024-05-18', '2024-05-18'),
(104, 32, 19, NULL, '2024-05-25', '2024-05-25'),
(105, 32, 19, NULL, '2024-05-25', '2024-05-25'),
(106, 32, 19, NULL, '2024-05-25', '2024-05-25'),
(107, 33, 20, NULL, '2024-05-25', '2024-05-25'),
(108, 33, 19, NULL, '2024-05-25', '2024-05-25'),
(109, 34, 19, NULL, '2024-05-28', '2024-05-28'),
(110, 34, 20, NULL, '2024-05-28', '2024-05-28'),
(111, 34, 18, NULL, '2024-05-28', '2024-05-28'),
(112, 35, 19, NULL, '2024-05-28', '2024-05-28'),
(113, 35, 20, NULL, '2024-05-28', '2024-05-28'),
(114, 35, 20, NULL, '2024-05-28', '2024-05-28'),
(115, 35, 19, NULL, '2024-05-28', '2024-05-28'),
(116, 36, 19, NULL, '2024-05-29', '2024-05-29'),
(117, 36, 19, NULL, '2024-05-29', '2024-05-29'),
(118, 36, 20, NULL, '2024-05-29', '2024-05-29'),
(119, 36, 18, NULL, '2024-05-29', '2024-05-29'),
(120, 37, 19, NULL, '2024-05-29', '2024-05-29'),
(121, 37, 19, NULL, '2024-05-29', '2024-05-29'),
(122, 37, 20, NULL, '2024-05-29', '2024-05-29'),
(123, 37, 18, NULL, '2024-05-29', '2024-05-29'),
(124, 38, 19, NULL, '2024-05-29', '2024-05-29'),
(125, 38, 19, NULL, '2024-05-29', '2024-05-29'),
(126, 38, 20, NULL, '2024-05-29', '2024-05-29'),
(127, 38, 18, NULL, '2024-05-29', '2024-05-29'),
(128, 39, 19, NULL, '2024-05-29', '2024-05-29'),
(129, 39, 19, NULL, '2024-05-29', '2024-05-29'),
(130, 39, 20, NULL, '2024-05-29', '2024-05-29'),
(131, 39, 18, NULL, '2024-05-29', '2024-05-29'),
(132, 40, 19, NULL, '2024-05-29', '2024-05-29'),
(133, 40, 19, NULL, '2024-05-29', '2024-05-29'),
(134, 40, 20, NULL, '2024-05-29', '2024-05-29'),
(135, 40, 18, NULL, '2024-05-29', '2024-05-29'),
(136, 41, 19, NULL, '2024-05-29', '2024-05-29'),
(137, 41, 19, NULL, '2024-05-29', '2024-05-29'),
(138, 41, 20, NULL, '2024-05-29', '2024-05-29'),
(139, 41, 18, NULL, '2024-05-29', '2024-05-29'),
(140, 42, 19, NULL, '2024-05-29', '2024-05-29'),
(141, 42, 19, NULL, '2024-05-29', '2024-05-29'),
(142, 42, 20, NULL, '2024-05-29', '2024-05-29'),
(143, 42, 18, NULL, '2024-05-29', '2024-05-29'),
(144, 43, 19, NULL, '2024-05-29', '2024-05-29'),
(145, 43, 19, NULL, '2024-05-29', '2024-05-29'),
(146, 43, 20, NULL, '2024-05-29', '2024-05-29'),
(147, 43, 18, NULL, '2024-05-29', '2024-05-29'),
(148, 44, 19, NULL, '2024-05-29', '2024-05-29'),
(149, 44, 19, NULL, '2024-05-29', '2024-05-29'),
(150, 44, 20, NULL, '2024-05-29', '2024-05-29'),
(151, 44, 18, NULL, '2024-05-29', '2024-05-29'),
(152, 45, 19, NULL, '2024-05-29', '2024-05-29'),
(153, 45, 19, NULL, '2024-05-29', '2024-05-29'),
(154, 45, 20, NULL, '2024-05-29', '2024-05-29'),
(155, 45, 18, NULL, '2024-05-29', '2024-05-29'),
(156, 46, 19, NULL, '2024-05-29', '2024-05-29'),
(157, 46, 19, NULL, '2024-05-29', '2024-05-29'),
(158, 46, 20, NULL, '2024-05-29', '2024-05-29'),
(159, 46, 18, NULL, '2024-05-29', '2024-05-29'),
(160, 47, 19, NULL, '2024-05-29', '2024-05-29'),
(161, 47, 19, NULL, '2024-05-29', '2024-05-29'),
(162, 47, 20, NULL, '2024-05-29', '2024-05-29'),
(163, 47, 18, NULL, '2024-05-29', '2024-05-29'),
(164, 48, 19, NULL, '2024-05-29', '2024-05-29'),
(165, 48, 19, NULL, '2024-05-29', '2024-05-29'),
(166, 48, 20, NULL, '2024-05-29', '2024-05-29'),
(167, 48, 18, NULL, '2024-05-29', '2024-05-29'),
(168, 49, 19, NULL, '2024-05-29', '2024-05-29'),
(169, 49, 19, NULL, '2024-05-29', '2024-05-29'),
(170, 49, 20, NULL, '2024-05-29', '2024-05-29'),
(171, 49, 18, NULL, '2024-05-29', '2024-05-29'),
(172, 50, 19, NULL, '2024-05-29', '2024-05-29'),
(173, 50, 19, NULL, '2024-05-29', '2024-05-29'),
(174, 50, 20, NULL, '2024-05-29', '2024-05-29'),
(175, 50, 18, NULL, '2024-05-29', '2024-05-29'),
(176, 51, 19, NULL, '2024-05-30', '2024-05-30'),
(177, 51, 20, NULL, '2024-05-30', '2024-05-30'),
(178, 51, 18, NULL, '2024-05-30', '2024-05-30'),
(179, 52, 19, NULL, '2024-05-30', '2024-05-30'),
(180, 52, 20, NULL, '2024-05-30', '2024-05-30'),
(181, 52, 18, NULL, '2024-05-30', '2024-05-30'),
(182, 53, 19, NULL, '2024-05-30', '2024-05-30'),
(183, 53, 20, NULL, '2024-05-30', '2024-05-30'),
(184, 53, 18, NULL, '2024-05-30', '2024-05-30'),
(185, 54, 19, NULL, '2024-06-04', '2024-06-04'),
(186, 54, 19, NULL, '2024-06-04', '2024-06-04'),
(187, 54, 20, NULL, '2024-06-04', '2024-06-04'),
(188, 54, 20, NULL, '2024-06-04', '2024-06-04'),
(189, 54, 19, NULL, '2024-06-04', '2024-06-04'),
(190, 54, 18, NULL, '2024-06-04', '2024-06-04'),
(191, 55, 19, NULL, '2024-06-04', '2024-06-04'),
(192, 55, 19, NULL, '2024-06-04', '2024-06-04'),
(193, 55, 20, NULL, '2024-06-04', '2024-06-04'),
(194, 55, 20, NULL, '2024-06-04', '2024-06-04'),
(195, 55, 19, NULL, '2024-06-04', '2024-06-04'),
(196, 55, 18, NULL, '2024-06-04', '2024-06-04'),
(197, 56, 19, NULL, '2024-06-04', '2024-06-04'),
(198, 56, 19, NULL, '2024-06-04', '2024-06-04'),
(199, 56, 20, NULL, '2024-06-04', '2024-06-04'),
(200, 56, 20, NULL, '2024-06-04', '2024-06-04'),
(201, 56, 19, NULL, '2024-06-04', '2024-06-04'),
(202, 56, 18, NULL, '2024-06-04', '2024-06-04'),
(203, 57, 19, NULL, '2024-06-04', '2024-06-04'),
(204, 57, 19, NULL, '2024-06-04', '2024-06-04'),
(205, 57, 20, NULL, '2024-06-04', '2024-06-04'),
(206, 57, 20, NULL, '2024-06-04', '2024-06-04'),
(207, 57, 19, NULL, '2024-06-04', '2024-06-04'),
(208, 57, 18, NULL, '2024-06-04', '2024-06-04'),
(209, 58, 19, NULL, '2024-06-05', '2024-06-05'),
(210, 58, 19, NULL, '2024-06-05', '2024-06-05'),
(211, 58, 20, NULL, '2024-06-05', '2024-06-05'),
(212, 58, 20, NULL, '2024-06-05', '2024-06-05'),
(213, 58, 19, NULL, '2024-06-05', '2024-06-05'),
(214, 58, 18, NULL, '2024-06-05', '2024-06-05'),
(215, 59, 19, NULL, '2024-06-05', '2024-06-05'),
(216, 59, 19, NULL, '2024-06-05', '2024-06-05'),
(217, 59, 20, NULL, '2024-06-05', '2024-06-05'),
(218, 59, 20, NULL, '2024-06-05', '2024-06-05'),
(219, 59, 19, NULL, '2024-06-05', '2024-06-05'),
(220, 59, 18, NULL, '2024-06-05', '2024-06-05'),
(221, 60, 19, NULL, '2024-06-05', '2024-06-05'),
(222, 60, 19, NULL, '2024-06-05', '2024-06-05'),
(223, 60, 20, NULL, '2024-06-05', '2024-06-05'),
(224, 60, 20, NULL, '2024-06-05', '2024-06-05'),
(225, 60, 19, NULL, '2024-06-05', '2024-06-05'),
(226, 60, 18, NULL, '2024-06-05', '2024-06-05'),
(227, 61, 19, NULL, '2024-06-05', '2024-06-05'),
(228, 61, 19, NULL, '2024-06-05', '2024-06-05'),
(229, 61, 20, NULL, '2024-06-05', '2024-06-05'),
(230, 61, 20, NULL, '2024-06-05', '2024-06-05'),
(231, 61, 19, NULL, '2024-06-05', '2024-06-05'),
(232, 61, 18, NULL, '2024-06-05', '2024-06-05'),
(233, 62, 19, NULL, '2024-06-05', '2024-06-05'),
(234, 62, 19, NULL, '2024-06-05', '2024-06-05'),
(235, 62, 20, NULL, '2024-06-05', '2024-06-05'),
(236, 62, 20, NULL, '2024-06-05', '2024-06-05'),
(237, 62, 19, NULL, '2024-06-05', '2024-06-05'),
(238, 62, 18, NULL, '2024-06-05', '2024-06-05'),
(239, 63, 19, NULL, '2024-06-05', '2024-06-05'),
(240, 63, 19, NULL, '2024-06-05', '2024-06-05'),
(241, 63, 20, NULL, '2024-06-05', '2024-06-05'),
(242, 63, 20, NULL, '2024-06-05', '2024-06-05'),
(243, 63, 19, NULL, '2024-06-05', '2024-06-05'),
(244, 63, 18, NULL, '2024-06-05', '2024-06-05'),
(245, 64, 19, NULL, '2024-06-05', '2024-06-05'),
(246, 64, 19, NULL, '2024-06-05', '2024-06-05'),
(247, 64, 20, NULL, '2024-06-05', '2024-06-05'),
(248, 64, 20, NULL, '2024-06-05', '2024-06-05'),
(249, 64, 19, NULL, '2024-06-05', '2024-06-05'),
(250, 64, 18, NULL, '2024-06-05', '2024-06-05'),
(251, 65, 19, NULL, '2024-06-05', '2024-06-05'),
(252, 65, 19, NULL, '2024-06-05', '2024-06-05'),
(253, 65, 20, NULL, '2024-06-05', '2024-06-05'),
(254, 65, 20, NULL, '2024-06-05', '2024-06-05'),
(255, 65, 19, NULL, '2024-06-05', '2024-06-05'),
(256, 65, 18, NULL, '2024-06-05', '2024-06-05'),
(257, 66, 19, NULL, '2024-06-05', '2024-06-05'),
(258, 66, 19, NULL, '2024-06-05', '2024-06-05'),
(259, 66, 20, NULL, '2024-06-05', '2024-06-05'),
(260, 66, 20, NULL, '2024-06-05', '2024-06-05'),
(261, 66, 19, NULL, '2024-06-05', '2024-06-05'),
(262, 66, 18, NULL, '2024-06-05', '2024-06-05'),
(263, 67, 19, NULL, '2024-06-05', '2024-06-05'),
(264, 67, 19, NULL, '2024-06-05', '2024-06-05'),
(265, 67, 20, NULL, '2024-06-05', '2024-06-05'),
(266, 67, 20, NULL, '2024-06-05', '2024-06-05'),
(267, 67, 19, NULL, '2024-06-05', '2024-06-05'),
(268, 67, 18, NULL, '2024-06-05', '2024-06-05'),
(269, 68, 19, NULL, '2024-06-05', '2024-06-05'),
(270, 68, 19, NULL, '2024-06-05', '2024-06-05'),
(271, 68, 20, NULL, '2024-06-05', '2024-06-05'),
(272, 68, 20, NULL, '2024-06-05', '2024-06-05'),
(273, 68, 19, NULL, '2024-06-05', '2024-06-05'),
(274, 68, 18, NULL, '2024-06-05', '2024-06-05'),
(275, 69, 19, NULL, '2024-06-08', '2024-06-08'),
(276, 69, 19, NULL, '2024-06-08', '2024-06-08'),
(277, 69, 20, NULL, '2024-06-08', '2024-06-08'),
(278, 69, 20, NULL, '2024-06-08', '2024-06-08'),
(279, 69, 19, NULL, '2024-06-08', '2024-06-08'),
(280, 69, 18, NULL, '2024-06-08', '2024-06-08'),
(281, 70, 19, NULL, '2024-06-08', '2024-06-08'),
(282, 70, 19, NULL, '2024-06-08', '2024-06-08'),
(283, 70, 20, NULL, '2024-06-08', '2024-06-08'),
(284, 70, 20, NULL, '2024-06-08', '2024-06-08'),
(285, 70, 19, NULL, '2024-06-08', '2024-06-08'),
(286, 70, 18, NULL, '2024-06-08', '2024-06-08'),
(287, 71, 20, NULL, '2024-06-12', '2024-06-12'),
(288, 71, 20, NULL, '2024-06-12', '2024-06-12'),
(289, 71, 18, NULL, '2024-06-12', '2024-06-12'),
(290, 71, 19, NULL, '2024-06-12', '2024-06-12'),
(291, 71, 19, NULL, '2024-06-12', '2024-06-12'),
(292, 71, 19, NULL, '2024-06-12', '2024-06-12'),
(293, 72, 20, NULL, '2024-06-12', '2024-06-12'),
(294, 72, 20, NULL, '2024-06-12', '2024-06-12'),
(295, 72, 18, NULL, '2024-06-12', '2024-06-12'),
(296, 72, 19, NULL, '2024-06-12', '2024-06-12'),
(297, 72, 19, NULL, '2024-06-12', '2024-06-12'),
(298, 72, 19, NULL, '2024-06-12', '2024-06-12'),
(299, 73, 20, NULL, '2024-06-12', '2024-06-12'),
(300, 73, 20, NULL, '2024-06-12', '2024-06-12'),
(301, 73, 18, NULL, '2024-06-12', '2024-06-12'),
(302, 73, 19, NULL, '2024-06-12', '2024-06-12'),
(303, 73, 19, NULL, '2024-06-12', '2024-06-12'),
(304, 73, 19, NULL, '2024-06-12', '2024-06-12'),
(305, 74, 20, NULL, '2024-06-12', '2024-06-12'),
(306, 74, 20, NULL, '2024-06-12', '2024-06-12'),
(307, 74, 18, NULL, '2024-06-12', '2024-06-12'),
(308, 74, 19, NULL, '2024-06-12', '2024-06-12'),
(309, 74, 19, NULL, '2024-06-12', '2024-06-12'),
(310, 74, 19, NULL, '2024-06-12', '2024-06-12'),
(311, 75, 1, NULL, '2024-06-19', '2024-06-19'),
(312, 76, 1, NULL, '2024-06-19', '2024-06-19'),
(313, 77, 1, NULL, '2024-06-19', '2024-06-19'),
(314, 78, 1, NULL, '2024-06-19', '2024-06-19'),
(315, 79, 1, NULL, '2024-06-19', '2024-06-19'),
(316, 80, 1, NULL, '2024-06-19', '2024-06-19'),
(317, 81, 1, NULL, '2024-06-19', '2024-06-19'),
(318, 82, 1, NULL, '2024-06-19', '2024-06-19'),
(319, 83, 1, NULL, '2024-06-19', '2024-06-19'),
(320, 84, 1, NULL, '2024-06-19', '2024-06-19'),
(321, 85, 1, NULL, '2024-06-19', '2024-06-19'),
(322, 86, 1, NULL, '2024-06-19', '2024-06-19'),
(323, 87, 1, NULL, '2024-06-19', '2024-06-19'),
(324, 88, 1, NULL, '2024-06-19', '2024-06-19'),
(325, 89, 1, NULL, '2024-06-19', '2024-06-19'),
(326, 90, 1, NULL, '2024-06-19', '2024-06-19'),
(327, 91, 1, NULL, '2024-06-19', '2024-06-19'),
(328, 92, 1, NULL, '2024-07-08', '2024-07-08'),
(329, 93, 1, NULL, '2024-07-08', '2024-07-08'),
(330, 94, 1, NULL, '2024-07-09', '2024-07-09'),
(331, 95, 20, NULL, '2024-07-09', '2024-07-09'),
(332, 95, 20, NULL, '2024-07-09', '2024-07-09'),
(333, 95, 19, NULL, '2024-07-09', '2024-07-09'),
(334, 95, 19, NULL, '2024-07-09', '2024-07-09'),
(335, 95, 18, NULL, '2024-07-09', '2024-07-09'),
(336, 95, 32, NULL, '2024-07-09', '2024-07-09'),
(337, 96, 1, NULL, '2024-07-14', '2024-07-14'),
(338, 96, 1, NULL, '2024-07-14', '2024-07-14'),
(339, 96, 1, NULL, '2024-07-14', '2024-07-14'),
(340, 96, 1, NULL, '2024-07-14', '2024-07-14'),
(341, 97, 1, NULL, '2024-07-14', '2024-07-14'),
(342, 97, 1, NULL, '2024-07-14', '2024-07-14'),
(343, 97, 1, NULL, '2024-07-14', '2024-07-14'),
(344, 97, 1, NULL, '2024-07-14', '2024-07-14'),
(345, 98, 1, NULL, '2024-07-14', '2024-07-14'),
(346, 98, 1, NULL, '2024-07-14', '2024-07-14'),
(347, 98, 1, NULL, '2024-07-14', '2024-07-14'),
(348, 98, 1, NULL, '2024-07-14', '2024-07-14'),
(349, 99, 31, NULL, '2024-07-14', '2024-07-14'),
(350, 99, 33, NULL, '2024-07-14', '2024-07-14'),
(351, 100, 31, NULL, '2024-07-14', '2024-07-14'),
(352, 100, 33, NULL, '2024-07-14', '2024-07-14'),
(353, 101, 27, NULL, '2024-07-14', '2024-07-14'),
(354, 101, 35, NULL, '2024-07-14', '2024-07-14'),
(355, 101, 31, NULL, '2024-07-14', '2024-07-14'),
(356, 101, 33, NULL, '2024-07-14', '2024-07-14'),
(357, 102, 27, NULL, '2024-07-14', '2024-07-14'),
(358, 102, 35, NULL, '2024-07-14', '2024-07-14'),
(359, 102, 31, NULL, '2024-07-14', '2024-07-14'),
(360, 102, 33, NULL, '2024-07-14', '2024-07-14'),
(361, 102, 32, NULL, '2024-07-14', '2024-07-14'),
(362, 102, 25, NULL, '2024-07-14', '2024-07-14'),
(363, 103, 27, NULL, '2024-07-14', '2024-07-14'),
(364, 103, 35, NULL, '2024-07-14', '2024-07-14'),
(365, 103, 31, NULL, '2024-07-14', '2024-07-14'),
(366, 103, 33, NULL, '2024-07-14', '2024-07-14'),
(367, 103, 32, NULL, '2024-07-14', '2024-07-14'),
(368, 103, 25, NULL, '2024-07-14', '2024-07-14'),
(369, 104, 27, NULL, '2024-07-14', '2024-07-14'),
(370, 104, 35, NULL, '2024-07-14', '2024-07-14'),
(371, 104, 31, NULL, '2024-07-14', '2024-07-14'),
(372, 104, 33, NULL, '2024-07-14', '2024-07-14'),
(373, 104, 32, NULL, '2024-07-14', '2024-07-14'),
(374, 104, 25, NULL, '2024-07-14', '2024-07-14'),
(375, 105, 27, NULL, '2024-07-14', '2024-07-14'),
(376, 105, 35, NULL, '2024-07-14', '2024-07-14'),
(377, 105, 31, NULL, '2024-07-14', '2024-07-14'),
(378, 105, 33, NULL, '2024-07-14', '2024-07-14'),
(379, 105, 32, NULL, '2024-07-14', '2024-07-14'),
(380, 105, 25, NULL, '2024-07-14', '2024-07-14'),
(381, 106, 27, NULL, '2024-07-14', '2024-07-14'),
(382, 106, 35, NULL, '2024-07-14', '2024-07-14'),
(383, 106, 31, NULL, '2024-07-14', '2024-07-14'),
(384, 106, 33, NULL, '2024-07-14', '2024-07-14'),
(385, 106, 32, NULL, '2024-07-14', '2024-07-14'),
(386, 106, 25, NULL, '2024-07-14', '2024-07-14'),
(387, 107, 27, NULL, '2024-07-14', '2024-07-14'),
(388, 107, 35, NULL, '2024-07-14', '2024-07-14'),
(389, 107, 31, NULL, '2024-07-14', '2024-07-14'),
(390, 107, 33, NULL, '2024-07-14', '2024-07-14'),
(391, 107, 32, NULL, '2024-07-14', '2024-07-14'),
(392, 107, 25, NULL, '2024-07-14', '2024-07-14'),
(393, 108, 27, NULL, '2024-07-14', '2024-07-14'),
(394, 108, 35, NULL, '2024-07-14', '2024-07-14'),
(395, 108, 31, NULL, '2024-07-14', '2024-07-14'),
(396, 108, 33, NULL, '2024-07-14', '2024-07-14'),
(397, 108, 32, NULL, '2024-07-14', '2024-07-14'),
(398, 108, 25, NULL, '2024-07-14', '2024-07-14'),
(399, 109, 27, NULL, '2024-07-14', '2024-07-14'),
(400, 109, 35, NULL, '2024-07-14', '2024-07-14'),
(401, 109, 31, NULL, '2024-07-14', '2024-07-14'),
(402, 109, 33, NULL, '2024-07-14', '2024-07-14'),
(403, 109, 32, NULL, '2024-07-14', '2024-07-14'),
(404, 109, 25, NULL, '2024-07-14', '2024-07-14'),
(405, 110, 27, NULL, '2024-07-14', '2024-07-14'),
(406, 110, 35, NULL, '2024-07-14', '2024-07-14'),
(407, 110, 31, NULL, '2024-07-14', '2024-07-14'),
(408, 110, 33, NULL, '2024-07-14', '2024-07-14'),
(409, 110, 32, NULL, '2024-07-14', '2024-07-14'),
(410, 110, 25, NULL, '2024-07-14', '2024-07-14'),
(411, 111, 27, NULL, '2024-07-14', '2024-07-14'),
(412, 111, 35, NULL, '2024-07-14', '2024-07-14'),
(413, 111, 31, NULL, '2024-07-14', '2024-07-14'),
(414, 111, 33, NULL, '2024-07-14', '2024-07-14'),
(415, 111, 32, NULL, '2024-07-14', '2024-07-14'),
(416, 111, 25, NULL, '2024-07-14', '2024-07-14'),
(417, 112, 27, NULL, '2024-07-14', '2024-07-14'),
(418, 112, 35, NULL, '2024-07-14', '2024-07-14'),
(419, 112, 31, NULL, '2024-07-14', '2024-07-14'),
(420, 112, 33, NULL, '2024-07-14', '2024-07-14'),
(421, 112, 32, NULL, '2024-07-14', '2024-07-14'),
(422, 112, 25, NULL, '2024-07-14', '2024-07-14'),
(423, 113, 27, NULL, '2024-07-14', '2024-07-14'),
(424, 113, 35, NULL, '2024-07-14', '2024-07-14'),
(425, 113, 31, NULL, '2024-07-14', '2024-07-14'),
(426, 113, 33, NULL, '2024-07-14', '2024-07-14'),
(427, 113, 32, NULL, '2024-07-14', '2024-07-14'),
(428, 113, 25, NULL, '2024-07-14', '2024-07-14'),
(429, 114, 27, NULL, '2024-07-14', '2024-07-14'),
(430, 114, 35, NULL, '2024-07-14', '2024-07-14'),
(431, 114, 31, NULL, '2024-07-14', '2024-07-14'),
(432, 114, 33, NULL, '2024-07-14', '2024-07-14'),
(433, 114, 32, NULL, '2024-07-14', '2024-07-14'),
(434, 114, 25, NULL, '2024-07-14', '2024-07-14'),
(435, 115, 27, NULL, '2024-07-14', '2024-07-14'),
(436, 115, 35, NULL, '2024-07-14', '2024-07-14'),
(437, 115, 31, NULL, '2024-07-14', '2024-07-14'),
(438, 115, 33, NULL, '2024-07-14', '2024-07-14'),
(439, 115, 32, NULL, '2024-07-14', '2024-07-14'),
(440, 115, 25, NULL, '2024-07-14', '2024-07-14'),
(441, 116, 27, NULL, '2024-07-14', '2024-07-14'),
(442, 116, 35, NULL, '2024-07-14', '2024-07-14'),
(443, 116, 31, NULL, '2024-07-14', '2024-07-14'),
(444, 116, 33, NULL, '2024-07-14', '2024-07-14'),
(445, 116, 32, NULL, '2024-07-14', '2024-07-14'),
(446, 116, 25, NULL, '2024-07-14', '2024-07-14'),
(447, 117, 27, NULL, '2024-07-14', '2024-07-14'),
(448, 117, 35, NULL, '2024-07-14', '2024-07-14'),
(449, 117, 31, NULL, '2024-07-14', '2024-07-14'),
(450, 117, 33, NULL, '2024-07-14', '2024-07-14'),
(451, 117, 32, NULL, '2024-07-14', '2024-07-14'),
(452, 117, 25, NULL, '2024-07-14', '2024-07-14'),
(453, 118, 27, NULL, '2024-07-14', '2024-07-14'),
(454, 118, 35, NULL, '2024-07-14', '2024-07-14'),
(455, 118, 31, NULL, '2024-07-14', '2024-07-14'),
(456, 118, 33, NULL, '2024-07-14', '2024-07-14'),
(457, 118, 32, NULL, '2024-07-14', '2024-07-14'),
(458, 118, 25, NULL, '2024-07-14', '2024-07-14'),
(459, 119, 27, NULL, '2024-07-14', '2024-07-14'),
(460, 119, 35, NULL, '2024-07-14', '2024-07-14'),
(461, 119, 31, NULL, '2024-07-14', '2024-07-14'),
(462, 119, 33, NULL, '2024-07-14', '2024-07-14'),
(463, 119, 32, NULL, '2024-07-14', '2024-07-14'),
(464, 119, 25, NULL, '2024-07-14', '2024-07-14'),
(465, 120, 27, NULL, '2024-07-14', '2024-07-14'),
(466, 120, 35, NULL, '2024-07-14', '2024-07-14'),
(467, 120, 31, NULL, '2024-07-14', '2024-07-14'),
(468, 120, 33, NULL, '2024-07-14', '2024-07-14'),
(469, 120, 32, NULL, '2024-07-14', '2024-07-14'),
(470, 120, 25, NULL, '2024-07-14', '2024-07-14'),
(471, 121, 27, NULL, '2024-07-20', '2024-07-20'),
(472, 121, 35, NULL, '2024-07-20', '2024-07-20'),
(473, 121, 31, NULL, '2024-07-20', '2024-07-20'),
(474, 121, 33, NULL, '2024-07-20', '2024-07-20'),
(475, 121, 32, NULL, '2024-07-20', '2024-07-20'),
(476, 121, 25, NULL, '2024-07-20', '2024-07-20'),
(477, 122, 35, NULL, '2024-07-27', '2024-07-27'),
(478, 122, 31, NULL, '2024-07-27', '2024-07-27'),
(479, 122, 33, NULL, '2024-07-27', '2024-07-27'),
(480, 122, 32, NULL, '2024-07-27', '2024-07-27'),
(481, 122, 27, NULL, '2024-07-27', '2024-07-27'),
(482, 122, 25, NULL, '2024-07-27', '2024-07-27'),
(483, 123, 35, NULL, '2024-07-27', '2024-07-27'),
(484, 123, 31, NULL, '2024-07-27', '2024-07-27'),
(485, 123, 33, NULL, '2024-07-27', '2024-07-27'),
(486, 123, 32, NULL, '2024-07-27', '2024-07-27'),
(487, 123, 27, NULL, '2024-07-27', '2024-07-27'),
(488, 123, 25, NULL, '2024-07-27', '2024-07-27'),
(489, 124, 35, NULL, '2024-07-27', '2024-07-27'),
(490, 124, 31, NULL, '2024-07-27', '2024-07-27'),
(491, 124, 33, NULL, '2024-07-27', '2024-07-27'),
(492, 124, 32, NULL, '2024-07-27', '2024-07-27'),
(493, 124, 27, NULL, '2024-07-27', '2024-07-27'),
(494, 124, 25, NULL, '2024-07-27', '2024-07-27'),
(495, 125, 35, NULL, '2024-07-28', '2024-07-28'),
(496, 125, 31, NULL, '2024-07-28', '2024-07-28'),
(497, 125, 33, NULL, '2024-07-28', '2024-07-28'),
(498, 125, 32, NULL, '2024-07-28', '2024-07-28'),
(499, 125, 27, NULL, '2024-07-28', '2024-07-28'),
(500, 125, 25, NULL, '2024-07-28', '2024-07-28'),
(501, 126, 35, NULL, '2024-07-29', '2024-07-29'),
(502, 126, 31, NULL, '2024-07-29', '2024-07-29'),
(503, 126, 33, NULL, '2024-07-29', '2024-07-29'),
(504, 126, 32, NULL, '2024-07-29', '2024-07-29'),
(505, 126, 27, NULL, '2024-07-29', '2024-07-29'),
(506, 126, 25, NULL, '2024-07-29', '2024-07-29'),
(507, 127, 35, NULL, '2024-07-29', '2024-07-29'),
(508, 127, 31, NULL, '2024-07-29', '2024-07-29'),
(509, 127, 33, NULL, '2024-07-29', '2024-07-29'),
(510, 127, 32, NULL, '2024-07-29', '2024-07-29'),
(511, 127, 27, NULL, '2024-07-29', '2024-07-29'),
(512, 127, 25, NULL, '2024-07-29', '2024-07-29'),
(513, 128, 35, NULL, '2024-07-29', '2024-07-29'),
(514, 128, 31, NULL, '2024-07-29', '2024-07-29'),
(515, 128, 33, NULL, '2024-07-29', '2024-07-29'),
(516, 128, 32, NULL, '2024-07-29', '2024-07-29'),
(517, 128, 27, NULL, '2024-07-29', '2024-07-29'),
(518, 128, 25, NULL, '2024-07-29', '2024-07-29');

-- --------------------------------------------------------

--
-- Table structure for table `exam_questions`
--

CREATE TABLE `exam_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_questions`
--

INSERT INTO `exam_questions` (`id`, `exam_id`, `question_id`, `section_id`, `created_at`, `updated_at`) VALUES
(10, 17, 38, 11, '2024-08-04', '2024-08-04'),
(11, 17, 39, 12, '2024-08-04', '2024-08-04'),
(12, 17, 40, 12, '2024-08-04', '2024-08-04'),
(13, 17, 35, 13, '2024-08-04', '2024-08-04'),
(14, 17, 36, 13, '2024-08-04', '2024-08-04'),
(15, 17, 37, 13, '2024-08-04', '2024-08-04');

-- --------------------------------------------------------

--
-- Table structure for table `exam_sections`
--

CREATE TABLE `exam_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `timer` time NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_sections`
--

INSERT INTO `exam_sections` (`id`, `name`, `description`, `timer`, `exam_id`, `created_at`, `updated_at`) VALUES
(1, 'Sec 1', 'Des 1', '01:02:00', 13, '2024-07-16 15:35:28', '2024-07-16 15:35:28'),
(2, 'Sec 1', 'Des 1', '01:03:00', 14, '2024-07-16 16:25:44', '2024-07-16 16:25:44'),
(3, 'Sec 1', 'Des 1', '01:03:00', 14, '2024-07-16 16:25:44', '2024-07-16 16:25:44'),
(4, 'Sec 2', 'Des 2', '01:03:00', 14, '2024-07-16 16:25:44', '2024-07-16 16:25:44'),
(5, 'Sec 2', 'Des 2', '01:03:00', 14, '2024-07-16 16:25:44', '2024-07-16 16:25:44'),
(6, 'Sec 3', 'Des 3', '01:03:00', 14, '2024-07-16 16:25:44', '2024-07-16 16:25:44'),
(7, 'Sec 3', 'Des 3', '01:03:00', 14, '2024-07-16 16:25:44', '2024-07-16 16:25:44'),
(8, 'Secection 1', 'Desc 1', '01:01:00', 16, '2024-07-16 16:35:24', '2024-07-16 16:35:24'),
(9, 'Secection 2', 'Desc 2', '01:01:00', 16, '2024-07-16 16:35:24', '2024-07-16 16:35:24'),
(10, 'Secection 3', 'Desc 3', '01:01:00', 16, '2024-07-16 16:35:24', '2024-07-16 16:35:24'),
(11, 'Secection 1', 'Desc 1', '00:00:00', 17, '2024-07-16 16:39:19', '2024-07-16 16:39:19'),
(12, 'Sec 1', 'Desc 1', '00:00:00', 17, '2024-07-16 16:39:19', '2024-07-16 16:39:19'),
(13, 'Secection 1', 'Des 2', '00:00:00', 17, '2024-07-16 16:39:19', '2024-07-16 16:39:19');

-- --------------------------------------------------------

--
-- Table structure for table `exam_time`
--

CREATE TABLE `exam_time` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `time` datetime NOT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_time`
--

INSERT INTO `exam_time` (`id`, `user_id`, `exam_id`, `time`, `updated_at`, `created_at`) VALUES
(2, 8, 2, '2024-02-26 09:32:23', '2024-02-26', '2024-02-26');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forget_passwords`
--

CREATE TABLE `forget_passwords` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forget_passwords`
--

INSERT INTO `forget_passwords` (`id`, `user_id`, `code`, `created_at`, `updated_at`) VALUES
(1, 92, '877262', '2024-05-28 11:54:23', '2024-05-28 11:54:23'),
(2, 92, '390403', '2024-05-28 11:55:50', '2024-05-28 11:55:50');

-- --------------------------------------------------------

--
-- Table structure for table `grid_ans`
--

CREATE TABLE `grid_ans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `grid_ans` text NOT NULL,
  `q_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `grid_ans`
--

INSERT INTO `grid_ans` (`id`, `grid_ans`, `q_id`, `created_at`, `updated_at`) VALUES
(1, '.5', 25, '2023-12-25', '2023-12-25'),
(2, '1', 21, '2023-12-25', '2023-12-25'),
(4, '1', 1, '2024-01-29', '2024-01-29');

-- --------------------------------------------------------

--
-- Table structure for table `group_days`
--

CREATE TABLE `group_days` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `day` enum('Sat','Sun','Mon','Tues','Wed','Thurs','Fri') NOT NULL,
  `from` time NOT NULL,
  `to` time NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_days`
--

INSERT INTO `group_days` (`id`, `day`, `from`, `to`, `group_id`, `created_at`, `updated_at`) VALUES
(22, 'Sat', '11:59:00', '11:59:00', 5, '2024-01-27', '2024-01-27'),
(23, 'Sat', '00:59:00', '11:59:00', 5, '2024-01-27', '2024-01-27'),
(39, 'Sat', '13:48:00', '13:49:00', 7, '2024-03-31', '2024-03-31'),
(40, 'Sat', '13:48:00', '13:48:00', 7, '2024-03-31', '2024-03-31'),
(51, 'Sat', '10:44:21', '12:45:21', 1, '2024-05-08', '2024-05-08'),
(52, 'Sat', '10:44:21', '12:45:21', 1, '2024-05-08', '2024-05-08'),
(53, 'Sun', '10:44:21', '12:45:21', 1, '2024-05-08', '2024-05-08'),
(59, 'Sat', '11:03:00', '11:03:00', 8, '2024-06-06', '2024-06-06'),
(61, 'Sat', '10:40:00', '10:40:00', 9, '2024-06-06', '2024-06-06');

-- --------------------------------------------------------

--
-- Table structure for table `group_students`
--

CREATE TABLE `group_students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `stu_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `group_students`
--

INSERT INTO `group_students` (`id`, `group_id`, `stu_id`, `created_at`, `updated_at`) VALUES
(14, 1, 8, '2024-05-08', '2024-05-08'),
(24, 8, 78, '2024-06-06', '2024-06-06'),
(27, 9, 87, '2024-06-06', '2024-06-06'),
(28, 9, 92, '2024-06-06', '2024-06-06');

-- --------------------------------------------------------

--
-- Table structure for table `idea_lessons`
--

CREATE TABLE `idea_lessons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idea` varchar(255) DEFAULT NULL,
  `syllabus` varchar(255) DEFAULT NULL,
  `idea_order` int(11) DEFAULT NULL,
  `pdf` varchar(255) DEFAULT NULL,
  `v_link` varchar(255) DEFAULT NULL,
  `lesson_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `idea_lessons`
--

INSERT INTO `idea_lessons` (`id`, `idea`, `syllabus`, `idea_order`, `pdf`, `v_link`, `lesson_id`, `created_at`, `updated_at`) VALUES
(6, '12', '12', 12, NULL, 'https://www.youtube.com/watch?v=v69praWH6cs', 12, '2024-02-01', '2024-02-01'),
(42, '2', '12', 12, NULL, NULL, 22, '2024-04-24', '2024-04-24'),
(44, 'dgsdsf', 'fgyd', 2, NULL, 'fdgtdgd', 23, '2024-05-14', '2024-05-14'),
(45, 'sdw', 'ede', 12, NULL, 'https://www.youtube.com/watch?v=N_J3HCATA1c', 26, NULL, NULL),
(46, 'sadfd', 'dfs', 21, NULL, 'https://www.youtube.com/watch?v=N_J3HCATA1c', 27, NULL, NULL),
(47, '12', '12', 12, NULL, 'https://us06web.zoom.us/j/86444846998?pwd=UkpFVNlkbVAvhRYTwrl0f6qdebaLFX.1', 28, '2024-05-30', '2024-05-30'),
(48, '1', '2', 2, NULL, 'dfsfg', 30, '2024-07-28', '2024-07-28'),
(49, '1', '2', 3, NULL, 'ewterter', 31, '2024-07-28', '2024-07-28'),
(50, '1', '1', 1, NULL, '1233445', 32, '2024-07-28', '2024-07-28'),
(51, '1', '2', 3, NULL, '43534543', 34, '2024-07-28', '2024-07-28'),
(55, 'nm123', 'ljk', 1, '2024V07V28V14V56V38https___login.mathshouse.net_files_lessons_pdf2024V07V28V14V40V33LessonV1VVRatioV&VProportionVAndVPercentageVESTVII.pdf', 'https://www.youtube.com/embed/v69praWH6cs?si=3ntnEewNZm5NcrFp', 4, '2024-07-28', '2024-07-28'),
(56, 'sadsad', 'dasdas', 12, NULL, 'h', 4, '2024-07-28', '2024-07-28'),
(57, 'nm', 'ljk', 1, NULL, 'https://www.youtube.com/embed/v69praWH6cs?si=3ntnEewNZm5NcrFp', 4, '2024-07-28', '2024-07-28');

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lesson_name` varchar(255) NOT NULL,
  `chapter_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `lesson_des` text NOT NULL,
  `lesson_url` varchar(191) DEFAULT NULL,
  `pre_requisition` text DEFAULT NULL,
  `gain` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `lesson_name`, `chapter_id`, `teacher_id`, `lesson_des`, `lesson_url`, `pre_requisition`, `gain`, `created_at`, `updated_at`) VALUES
(4, 'Lesson 1', 4, 5, 'fg', '5692024X02X01X16X46X574.jpg', 'jhf', 'g', '2024-01-02 07:48:20', '2024-07-28 12:56:38'),
(12, 'Lesson 26', 6, 5, 'fdfhg', NULL, 'jfggj', 'fgjfgh', '2024-01-30 10:15:21', '2024-01-30 10:15:21'),
(18, 'Lesson 22', 4, 5, 'das', '3662024X02X05X12X57X434.png', 'sfd', 'assd', '2024-02-05 10:57:43', '2024-05-19 05:41:23'),
(22, 'Lesson 2uihijbjib', 6, 11, 'dvgdf', '5592024X04X24X09X33X318032024X03X27X12X18X322024X02X19X07X46X506890202301101725mvf_dark_logo.png', 'cxgvf', 'fgdfgh', '2024-04-24 07:33:31', '2024-04-24 07:34:02'),
(23, 'lesson 12', 20, 44, 'tdyfdfghj', 'efwef', 'fdger', 'trgrt', NULL, '2024-05-14 07:50:30'),
(26, 'lesson one', 22, 11, 'fg', 'gfjhtyty', 'fghn', 'nhgng', NULL, NULL),
(27, 'Lesson two', 21, 79, 'dfg', 'fgjh', 'ghf', 'fgbnfh', NULL, NULL),
(28, 'Lesson 321', 21, 65, 'adf sdfsdf', '8102024X05X30X11X54X237.png', 'dfsd', 'fsdfsd', '2024-05-30 09:54:23', '2024-05-30 09:54:23'),
(29, 'dfs', 4, 11, 'dfsdf', '4342024X07X28X12X44X2521X62X700x700.webp', 'sadsda', 'dsfsdf', '2024-07-28 10:44:25', '2024-07-28 10:44:25'),
(30, 'dfsrfgertr', 4, 65, 'rtgeg', '1522024X07X28X12X45X55322777964_1607467966387425_1864140506085720113_n.jpg', 'etgerty', 'yrtytr', '2024-07-28 10:45:55', '2024-07-28 10:45:55'),
(31, 'bhfgh', 4, 65, 'jhkkjh', '2612024X07X28X14X27X2621X62X700x700.webp', 'fdgdfg', 'fdgfdggf', '2024-07-28 12:27:26', '2024-07-28 12:27:26'),
(32, 'sdafs', 4, 65, 'fdghtrh', NULL, 'r534', 't45t', '2024-07-28 12:28:28', '2024-07-28 12:28:28'),
(33, 'weter', 4, 65, 'dfgdfg', NULL, 'fdgergr', 'gerdger', '2024-07-28 12:30:23', '2024-07-28 12:30:23'),
(34, 'gfhf', 4, 65, 'fghfg', NULL, 'hgfhf', 'fgjhghj', '2024-07-28 12:32:13', '2024-07-28 12:32:13');

-- --------------------------------------------------------

--
-- Table structure for table `live_courses`
--

CREATE TABLE `live_courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `live_courses`
--

INSERT INTO `live_courses` (`id`, `user_id`, `course_id`, `state`, `created_at`, `updated_at`) VALUES
(1, 8, 1, 0, '0000-00-00', '0000-00-00'),
(2, 8, 2, 0, '0000-00-00', '0000-00-00'),
(3, 8, 4, 0, '2024-05-03', '2024-05-03'),
(4, 85, 1, 0, '2024-05-27', '2024-05-27'),
(5, 81, 1, 0, '2024-05-28', '2024-05-28'),
(6, 88, 1, 0, '2024-05-28', '2024-05-28'),
(7, 83, 2, 0, '2024-05-30', '2024-05-30'),
(8, 111, 1, 0, '2024-07-20', '2024-07-20');

-- --------------------------------------------------------

--
-- Table structure for table `live_lessons`
--

CREATE TABLE `live_lessons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `lesson_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `live_lessons`
--

INSERT INTO `live_lessons` (`id`, `user_id`, `lesson_id`, `created_at`, `updated_at`) VALUES
(3, 8, 12, '2024-04-15', '2024-04-15'),
(6, 8, 4, '2024-05-03', '2024-05-03'),
(7, 85, 4, '2024-05-27', '2024-05-27'),
(8, 81, 4, '2024-05-28', '2024-05-28'),
(9, 85, 18, '2024-05-28', '2024-05-28'),
(10, 88, 4, '2024-05-28', '2024-05-28'),
(11, 83, 27, '2024-05-30', '2024-05-30'),
(12, 85, 12, '2024-05-31', '2024-05-31');

-- --------------------------------------------------------

--
-- Table structure for table `login_users`
--

CREATE TABLE `login_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('mobile','web') NOT NULL DEFAULT 'web',
  `ip` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_users`
--

INSERT INTO `login_users` (`id`, `user_id`, `type`, `ip`, `created_at`, `updated_at`) VALUES
(148, 8, 'mobile', NULL, '2024-07-29 11:14:26', '2024-07-29 11:14:26'),
(160, 8, 'mobile', NULL, '2024-08-03 13:03:08', '2024-08-03 13:03:08'),
(162, 8, 'web', '78854799796', '2024-08-03 15:09:32', '2024-08-03 15:09:32'),
(163, 68, 'web', '79767489208', '2024-08-04 09:40:16', '2024-08-04 09:40:16');

-- --------------------------------------------------------

--
-- Table structure for table `marketings`
--

CREATE TABLE `marketings` (
  `id` int(11) NOT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `chapter_id` bigint(20) UNSIGNED DEFAULT NULL,
  `affilate_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marketing_popups`
--

CREATE TABLE `marketing_popups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `starts` date NOT NULL,
  `ends` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marketing_popups`
--

INSERT INTO `marketing_popups` (`id`, `name`, `starts`, `ends`, `image`, `created_at`, `updated_at`) VALUES
(2, 'Adversting 1', '2024-04-01', '2024-04-30', '1.png', NULL, '2024-05-11'),
(3, 'asd', '2024-04-01', '2024-04-30', '1.png', '2024-04-06', '2024-04-06'),
(4, 'fdfd123', '2024-04-02', '2024-04-30', '4702024X04X06X14X13X452024X02X22X12X39X331211202304300850download.png', '2024-04-06', '2024-04-06'),
(5, 'popup 321', '2024-05-22', '2024-05-25', '2072024X05X11X12X59X361.png', '2024-05-11', '2024-05-11');

-- --------------------------------------------------------

--
-- Table structure for table `mcq_ans`
--

CREATE TABLE `mcq_ans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mcq_num` varchar(35) DEFAULT NULL,
  `mcq_ans` varchar(255) DEFAULT NULL,
  `mcq_answers` varchar(255) DEFAULT NULL,
  `q_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `mcq_ans`
--

INSERT INTO `mcq_ans` (`id`, `mcq_num`, `mcq_ans`, `mcq_answers`, `q_id`, `created_at`, `updated_at`) VALUES
(1, 'A', 'answer 1', 'A', 18, '2023-12-25', '2023-12-25'),
(2, 'B', 'answer 2', 'A', 18, '2023-12-25', '2023-12-25'),
(3, 'C', 'answer 3', 'A', 18, '2023-12-25', '2023-12-25'),
(4, 'D', 'answer 4', 'A', 18, '2023-12-25', '2023-12-25'),
(8, 'A', '1', 'A', 19, '2023-12-26', '2023-12-26'),
(9, 'B', '2', 'A', 19, '2023-12-26', '2023-12-26'),
(17, 'C', '6', 'A', 19, '2024-01-24', '2024-01-24'),
(18, 'D', '7', 'A', 19, '2024-01-24', '2024-01-24'),
(19, 'A', '8', 'A', 20, '2024-01-24', '2024-01-24'),
(56, 'B', 'fg', 'A', 20, '2024-01-29', '2024-01-29'),
(57, 'C', 'fg', 'A', 20, '2024-01-29', '2024-01-29'),
(58, 'D', 'fg', 'A', 20, '2024-01-29', '2024-01-29'),
(59, 'A', 'fg', 'A', 21, '2024-01-29', '2024-01-29'),
(60, 'B', 'fg', 'A', 21, '2024-01-29', '2024-01-29'),
(61, 'C', 'fg', 'A', 21, '2024-01-29', '2024-01-29'),
(62, 'D', 'fg', 'A', 21, '2024-01-29', '2024-01-29'),
(100, 'A', '1', 'A', 27, '2024-05-07', '2024-05-07'),
(101, 'B', '2', 'A', 27, '2024-05-07', '2024-05-07'),
(102, 'C', '3', 'A', 27, '2024-05-07', '2024-05-07'),
(103, 'D', '4', 'A', 27, '2024-05-07', '2024-05-07'),
(104, 'A', NULL, 'A', 27, '2024-05-07', '2024-05-07'),
(105, 'B', '1', 'A', 28, '2024-05-11', '2024-05-11'),
(106, 'C', '2', 'A', 28, '2024-05-11', '2024-05-11'),
(107, 'D', '3', 'A', 28, '2024-05-11', '2024-05-11'),
(108, 'A', '4', 'A', 28, '2024-05-11', '2024-05-11'),
(109, 'B', NULL, 'A', 28, '2024-05-11', '2024-05-11'),
(119, 'E', '1', 'A', 29, '2024-05-27', '2024-05-27'),
(120, 'F', '2', 'A', 29, '2024-05-27', '2024-05-27'),
(121, 'G', '3', 'A', 29, '2024-05-27', '2024-05-27'),
(122, 'H', '4', 'A', 29, '2024-05-27', '2024-05-27'),
(123, 'A', NULL, 'A', 32, '2024-05-28', '2024-05-28'),
(124, 'B', NULL, 'A', 32, '2024-05-28', '2024-05-28'),
(125, 'C', NULL, 'A', 32, '2024-05-28', '2024-05-28'),
(126, 'D', NULL, 'A', 32, '2024-05-28', '2024-05-28'),
(127, 'F', NULL, 'A', 32, '2024-05-28', '2024-05-28'),
(128, 'f', NULL, 'A', 33, '2024-05-28', '2024-05-28'),
(129, 'f', NULL, 'A', 33, '2024-05-28', '2024-05-28'),
(130, 'f', NULL, 'A', 33, '2024-05-28', '2024-05-28'),
(131, 'f', NULL, 'A', 33, '2024-05-28', '2024-05-28'),
(132, 'F', NULL, 'A', 35, '2024-05-28', '2024-05-28'),
(133, 'A', '2', 'A', 35, '2024-05-28', '2024-05-28'),
(149, 'Ax', '23', 'A', 35, '2024-05-28', '2024-05-28'),
(150, 'B', '4', 'A', 36, '2024-05-28', '2024-05-28'),
(151, 'Cx', '6', 'A', 36, '2024-05-28', '2024-05-28'),
(152, 'Dx', '7', 'A', 36, '2024-05-28', '2024-05-28'),
(153, 'F', NULL, 'A', 36, '2024-05-28', '2024-05-28'),
(154, 'A', NULL, 'A', 37, '2024-05-28', '2024-05-28'),
(155, 'B', NULL, 'A', 37, '2024-05-28', '2024-05-28'),
(156, 'C', NULL, 'A', 37, '2024-05-28', '2024-05-28'),
(157, 'D', NULL, 'A', 37, '2024-05-28', '2024-05-28'),
(158, 'F', NULL, 'A', 37, '2024-05-28', '2024-05-28'),
(159, 'A', NULL, 'A', 38, '2024-05-28', '2024-05-28'),
(160, 'B', NULL, 'A', 38, '2024-05-28', '2024-05-28'),
(161, 'C', NULL, 'A', 38, '2024-05-28', '2024-05-28'),
(162, 'D', NULL, 'A', 38, '2024-05-28', '2024-05-28'),
(163, 'F', NULL, 'A', 38, '2024-05-28', '2024-05-28'),
(218, 'A', 'fg', 'A', 1, '2024-06-27', '2024-06-27'),
(219, 'B', 'fg', 'A', 1, '2024-06-27', '2024-06-27'),
(220, 'C', 'fg', 'A', 1, '2024-06-27', '2024-06-27'),
(221, 'D', 'sa', 'A', 1, '2024-06-27', '2024-06-27'),
(242, 'A', NULL, 'A', 39, '2024-07-11', '2024-07-11'),
(243, 'B', NULL, 'A', 39, '2024-07-11', '2024-07-11'),
(244, 'C', NULL, 'A', 39, '2024-07-11', '2024-07-11'),
(245, 'D', NULL, 'A', 39, '2024-07-11', '2024-07-11'),
(246, 'F', NULL, 'A', 31, '2024-07-11', '2024-07-11'),
(247, 'e', NULL, 'A', 31, '2024-07-11', '2024-07-11'),
(248, 'as', NULL, 'A', 31, '2024-07-11', '2024-07-11'),
(249, 'New Answer', NULL, 'A', 31, '2024-07-11', '2024-07-11'),
(255, 'A', NULL, 'A', 40, '2024-07-20', '2024-07-20'),
(256, 'B', NULL, 'A', 40, '2024-07-20', '2024-07-20'),
(257, 'C', NULL, 'A', 40, '2024-07-20', '2024-07-20'),
(258, 'D', NULL, 'A', 40, '2024-07-20', '2024-07-20'),
(259, 'E', NULL, 'A', 40, '2024-07-20', '2024-07-20'),
(260, 'f', NULL, 'A', 40, '2024-07-20', '2024-07-20'),
(266, 'A', NULL, 'A', 41, '2024-07-23', '2024-07-23'),
(267, 'D', NULL, 'A', 41, '2024-07-23', '2024-07-23'),
(268, 'E', NULL, 'A', 41, '2024-07-23', '2024-07-23'),
(269, 'SS', NULL, 'A', 41, '2024-07-23', '2024-07-23');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_05_28_090500_add_login_fields_to_users_table', 1),
(6, '2023_06_11_075700_create_permission_tables', 1),
(7, '2023_06_12_013333_add_profile_photo_path_column_to_users_table', 1),
(8, '2023_10_09_041104_create_addresses_table', 1),
(9, '2023_12_12_111922_create_admin_roles_table', 1),
(10, '2023_12_12_113333_create_categories_table', 1),
(11, '2023_12_12_113743_create_courses_table', 1),
(12, '2023_12_12_113826_create_chapters_table', 1),
(13, '2024_06_30_095404_create_sessions_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `module` enum('Exam','Question','Live') NOT NULL,
  `number` int(11) NOT NULL,
  `price` float NOT NULL,
  `duration` int(11) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `module`, `number`, `price`, `duration`, `created_at`, `updated_at`) VALUES
(2, 'Package 1', 'Exam', 10, 60, 30, NULL, '2024-02-20'),
(3, 'Package 2', 'Question', 11, 111, 11, '2024-02-20', '2024-02-20'),
(4, 'Package 3', 'Live', 10, 600, 30, NULL, NULL),
(5, 'Package 4', 'Live', 11, 22, 22, '2024-03-31', '2024-03-31');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `statue` tinyint(1) DEFAULT 0,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`id`, `payment`, `description`, `logo`, `statue`, `created_at`, `updated_at`) VALUES
(2, 'Visa', 'Number 1', 'VodafoneIcon.svg', 1, '2024-01-07', '2024-04-15'),
(4, 'pay 1', 'Number 2', '2024X01X27X09X01X1410931.jpg', 1, '2024-01-27', '2024-01-27'),
(5, 'Visa', NULL, '2024X02X05X13X14X0069575.png', 1, '2024-02-05', '2024-02-05'),
(7, 'pay 1', NULL, '2024X02X12X10X01X511491202301101725mvf_dark_logo.png', 0, '2024-02-12', '2024-04-09'),
(8, 'vodafone cash', 'Number 12', '2024X04X15X12X40X36863download.jfif', 1, '2024-04-15', '2024-04-15');

-- --------------------------------------------------------

--
-- Table structure for table `payment_orders`
--

CREATE TABLE `payment_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_request_id` bigint(20) UNSIGNED NOT NULL,
  `chapter_id` bigint(20) UNSIGNED NOT NULL,
  `duration` int(11) NOT NULL,
  `discount` float DEFAULT NULL,
  `state` tinyint(1) NOT NULL DEFAULT 0,
  `date` datetime DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_orders`
--

INSERT INTO `payment_orders` (`id`, `payment_request_id`, `chapter_id`, `duration`, `discount`, `state`, `date`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 0, NULL, 0, NULL, NULL, NULL),
(4, 7, 6, 22, NULL, 0, NULL, '2024-02-28', '2024-02-28'),
(6, 62, 4, 4, NULL, 1, NULL, '2024-02-28', '2024-02-28'),
(8, 62, 6, 4, NULL, 0, NULL, '2024-02-28', '2024-02-28'),
(10, 72, 4, 35, NULL, 0, NULL, '2024-03-07', '2024-03-07'),
(11, 72, 6, 22, NULL, 0, NULL, '2024-03-07', '2024-03-07'),
(13, 73, 4, 4, NULL, 0, NULL, '2024-03-07', '2024-03-07'),
(15, 73, 6, 4, NULL, 0, NULL, '2024-03-07', '2024-03-07'),
(17, 74, 4, 4, NULL, 0, NULL, '2024-03-07', '2024-03-07'),
(19, 74, 6, 4, NULL, 0, NULL, '2024-03-07', '2024-03-07'),
(21, 75, 4, 4, NULL, 0, NULL, '2024-03-07', '2024-03-07'),
(23, 75, 6, 4, NULL, 0, NULL, '2024-03-07', '2024-03-07'),
(25, 76, 4, 4, NULL, 0, NULL, '2024-03-07', '2024-03-07'),
(27, 76, 6, 4, NULL, 0, NULL, '2024-03-07', '2024-03-07'),
(29, 77, 4, 4, NULL, 0, NULL, '2024-03-07', '2024-03-07'),
(31, 77, 6, 4, NULL, 0, NULL, '2024-03-07', '2024-03-07'),
(33, 78, 4, 4, NULL, 0, NULL, '2024-03-07', '2024-03-07'),
(35, 78, 6, 4, NULL, 0, NULL, '2024-03-07', '2024-03-07'),
(37, 79, 4, 4, NULL, 0, NULL, '2024-03-07', '2024-03-07'),
(39, 79, 6, 4, NULL, 0, NULL, '2024-03-07', '2024-03-07'),
(41, 80, 4, 4, NULL, 0, NULL, '2024-03-07', '2024-03-07'),
(43, 80, 6, 4, NULL, 0, NULL, '2024-03-07', '2024-03-07'),
(45, 81, 4, 4, NULL, 0, NULL, '2024-03-07', '2024-03-07'),
(47, 81, 6, 4, NULL, 0, NULL, '2024-03-07', '2024-03-07'),
(49, 82, 4, 4, NULL, 0, NULL, '2024-03-07', '2024-03-07'),
(51, 82, 6, 4, NULL, 0, NULL, '2024-03-07', '2024-03-07'),
(53, 83, 4, 4, NULL, 0, NULL, '2024-03-07', '2024-03-07'),
(55, 83, 6, 4, NULL, 0, NULL, '2024-03-07', '2024-03-07'),
(57, 84, 4, 4, NULL, 0, NULL, '2024-03-07', '2024-03-07'),
(59, 84, 6, 4, NULL, 0, NULL, '2024-03-07', '2024-03-07'),
(62, 85, 6, 22, NULL, 0, NULL, '2024-03-07', '2024-03-07'),
(65, 86, 6, 22, NULL, 0, NULL, '2024-03-07', '2024-03-07'),
(68, 87, 6, 22, NULL, 0, NULL, '2024-03-07', '2024-03-07'),
(71, 88, 6, 22, NULL, 0, NULL, '2024-03-07', '2024-03-07'),
(77, 122, 4, 50, NULL, 0, NULL, '2024-04-17', '2024-04-17'),
(78, 122, 4, 35, NULL, 0, NULL, '2024-04-17', '2024-04-17'),
(79, 122, 4, 13, NULL, 0, NULL, '2024-04-17', '2024-04-17'),
(80, 133, 4, 0, NULL, 0, NULL, '2024-04-27', '2024-04-27'),
(81, 133, 6, 0, NULL, 0, NULL, '2024-04-27', '2024-04-27'),
(84, 135, 4, 0, NULL, 0, NULL, '2024-05-05', '2024-05-05'),
(85, 135, 6, 0, NULL, 0, NULL, '2024-05-05', '2024-05-05'),
(90, 137, 6, 22, NULL, 0, NULL, '2024-05-08', '2024-05-08'),
(93, 140, 20, 0, NULL, 1, NULL, '2024-05-08', '2024-05-08'),
(94, 141, 4, 0, NULL, 0, NULL, '2024-05-09', '2024-05-09'),
(95, 141, 6, 0, NULL, 0, NULL, '2024-05-09', '2024-05-09'),
(98, 142, 6, 22, NULL, 0, NULL, '2024-05-09', '2024-05-09'),
(101, 143, 6, 22, NULL, 1, '2024-05-09 12:33:15', '2024-05-09', '2024-05-09'),
(104, 144, 6, 22, NULL, 1, NULL, '2024-05-09', '2024-05-09'),
(107, 145, 4, 0, NULL, 1, NULL, '2024-05-13', '2024-05-13'),
(108, 145, 6, 0, NULL, 1, NULL, '2024-05-13', '2024-05-13'),
(111, 146, 4, 0, NULL, 1, NULL, '2024-05-13', '2024-05-13'),
(112, 146, 6, 0, NULL, 1, NULL, '2024-05-13', '2024-05-13'),
(115, 147, 4, 0, NULL, 1, NULL, '2024-05-13', '2024-05-13'),
(116, 147, 6, 0, NULL, 1, NULL, '2024-05-13', '2024-05-13'),
(119, 148, 4, 0, NULL, 1, NULL, '2024-05-13', '2024-05-13'),
(120, 148, 6, 0, NULL, 1, NULL, '2024-05-13', '2024-05-13'),
(123, 149, 4, 0, NULL, 1, NULL, '2024-05-13', '2024-05-13'),
(124, 149, 6, 0, NULL, 1, NULL, '2024-05-13', '2024-05-13'),
(127, 150, 4, 0, NULL, 1, NULL, '2024-05-13', '2024-05-13'),
(128, 150, 6, 0, NULL, 1, NULL, '2024-05-13', '2024-05-13'),
(131, 151, 4, 0, NULL, 1, NULL, '2024-05-13', '2024-05-13'),
(132, 151, 6, 0, NULL, 1, NULL, '2024-05-13', '2024-05-13'),
(135, 152, 6, 22, NULL, 1, NULL, '2024-05-13', '2024-05-13'),
(138, 153, 6, 22, NULL, 1, NULL, '2024-05-13', '2024-05-13'),
(141, 157, 4, 7, NULL, 1, '2024-05-13 12:11:28', '2024-05-13', '2024-05-13'),
(142, 157, 6, 7, NULL, 1, '2024-05-13 12:11:28', '2024-05-13', '2024-05-13'),
(143, 158, 4, 7, NULL, 1, '2024-05-13 12:12:18', '2024-05-13', '2024-05-13'),
(144, 158, 6, 7, NULL, 1, '2024-05-13 12:12:18', '2024-05-13', '2024-05-13'),
(147, 162, 4, 0, NULL, 0, NULL, '2024-05-16', '2024-05-16'),
(148, 162, 6, 0, NULL, 0, NULL, '2024-05-16', '2024-05-16'),
(150, 163, 4, 0, NULL, 0, NULL, '2024-05-16', '2024-05-16'),
(151, 163, 6, 0, NULL, 0, NULL, '2024-05-16', '2024-05-16'),
(153, 164, 4, 0, NULL, 1, '2024-05-17 11:35:18', '2024-05-17', '2024-05-17'),
(154, 164, 6, 0, NULL, 1, '2024-05-17 11:35:18', '2024-05-17', '2024-05-17'),
(156, 165, 4, 0, NULL, 1, NULL, '2024-05-17', '2024-05-17'),
(157, 165, 6, 0, NULL, 1, NULL, '2024-05-17', '2024-05-17'),
(159, 178, 6, 22, NULL, 1, '2024-05-17 12:28:21', '2024-05-17', '2024-05-17'),
(161, 179, 6, 22, NULL, 1, NULL, '2024-05-17', '2024-05-17'),
(163, 180, 6, 22, NULL, 1, NULL, '2024-05-17', '2024-05-17'),
(165, 181, 6, 22, NULL, 1, NULL, '2024-05-17', '2024-05-17'),
(167, 182, 6, 22, NULL, 1, '2024-05-17 12:28:11', '2024-05-17', '2024-05-17'),
(169, 183, 6, 22, NULL, 1, NULL, '2024-05-17', '2024-05-17'),
(171, 184, 6, 22, NULL, 1, NULL, '2024-05-17', '2024-05-17'),
(173, 196, 4, 0, NULL, 1, NULL, '2024-05-22', '2024-05-22'),
(174, 196, 6, 0, NULL, 1, NULL, '2024-05-22', '2024-05-22'),
(176, 199, 21, 33, NULL, 1, NULL, '2024-05-25', '2024-05-25'),
(177, 200, 4, 33, NULL, 1, '2024-05-25 11:52:57', '2024-05-25', '2024-05-25'),
(178, 200, 6, 44, NULL, 1, '2024-05-25 11:52:57', '2024-05-25', '2024-05-25'),
(179, 216, 4, 0, NULL, 1, NULL, '2024-07-04', '2024-07-04'),
(180, 216, 6, 0, NULL, 1, NULL, '2024-07-04', '2024-07-04'),
(181, 218, 6, 22, NULL, 1, NULL, '2024-07-04', '2024-07-04'),
(182, 219, 6, 22, NULL, 1, NULL, '2024-07-04', '2024-07-04'),
(183, 220, 6, 22, NULL, 1, NULL, '2024-07-04', '2024-07-04'),
(184, 221, 6, 22, NULL, 1, NULL, '2024-07-04', '2024-07-04'),
(185, 233, 6, 22, NULL, 1, NULL, '2024-07-05', '2024-07-05'),
(186, 234, 6, 22, NULL, 1, NULL, '2024-07-05', '2024-07-05'),
(187, 235, 6, 22, NULL, 1, NULL, '2024-07-05', '2024-07-05'),
(188, 236, 6, 22, NULL, 1, NULL, '2024-07-05', '2024-07-05'),
(189, 244, 4, 0, NULL, 1, NULL, '2024-07-05', '2024-07-05'),
(190, 244, 6, 0, NULL, 1, NULL, '2024-07-05', '2024-07-05'),
(191, 245, 4, 0, NULL, 1, NULL, '2024-07-05', '2024-07-05'),
(192, 245, 6, 0, NULL, 1, NULL, '2024-07-05', '2024-07-05'),
(193, 246, 6, 22, NULL, 1, NULL, '2024-07-05', '2024-07-05'),
(194, 247, 6, 22, NULL, 1, NULL, '2024-07-05', '2024-07-05'),
(195, 248, 6, 22, NULL, 1, NULL, '2024-07-05', '2024-07-05'),
(196, 249, 6, 22, NULL, 1, NULL, '2024-07-05', '2024-07-05'),
(197, 250, 6, 22, NULL, 1, NULL, '2024-07-05', '2024-07-05'),
(198, 251, 6, 22, NULL, 1, NULL, '2024-07-05', '2024-07-05'),
(199, 252, 6, 22, NULL, 1, NULL, '2024-07-05', '2024-07-05'),
(200, 253, 4, 0, NULL, 0, NULL, '2024-07-06', '2024-07-06'),
(201, 253, 6, 0, NULL, 0, NULL, '2024-07-06', '2024-07-06'),
(202, 254, 4, 0, NULL, 0, NULL, '2024-07-06', '2024-07-06'),
(203, 254, 6, 0, NULL, 0, NULL, '2024-07-06', '2024-07-06'),
(204, 255, 4, 0, NULL, 0, NULL, '2024-07-06', '2024-07-06'),
(205, 255, 6, 0, NULL, 0, NULL, '2024-07-06', '2024-07-06'),
(206, 256, 4, 0, NULL, 1, NULL, '2024-07-06', '2024-07-06'),
(207, 256, 6, 0, NULL, 1, NULL, '2024-07-06', '2024-07-06'),
(208, 257, 4, 0, NULL, 1, NULL, '2024-07-06', '2024-07-06'),
(209, 257, 6, 0, NULL, 1, NULL, '2024-07-06', '2024-07-06'),
(210, 258, 4, 0, NULL, 0, NULL, '2024-07-06', '2024-07-06'),
(211, 258, 6, 0, NULL, 0, NULL, '2024-07-06', '2024-07-06'),
(212, 259, 4, 0, NULL, 0, NULL, '2024-07-06', '2024-07-06'),
(213, 259, 6, 0, NULL, 0, NULL, '2024-07-06', '2024-07-06'),
(214, 260, 6, 22, NULL, 1, NULL, '2024-07-07', '2024-07-07'),
(215, 266, 4, 0, NULL, 1, NULL, '2024-07-10', '2024-07-10'),
(216, 266, 6, 0, NULL, 1, NULL, '2024-07-10', '2024-07-10'),
(217, 267, 4, 0, NULL, 1, '2024-07-10 11:13:49', '2024-07-10', '2024-07-10'),
(218, 267, 6, 0, NULL, 1, '2024-07-10 11:13:49', '2024-07-10', '2024-07-10'),
(219, 268, 4, 0, NULL, 1, '2024-07-10 11:27:20', '2024-07-10', '2024-07-10'),
(220, 268, 6, 0, NULL, 1, '2024-07-10 11:27:20', '2024-07-10', '2024-07-10'),
(221, 269, 4, 0, NULL, 1, '2024-07-10 11:28:06', '2024-07-10', '2024-07-10'),
(222, 269, 6, 0, NULL, 1, '2024-07-10 11:28:06', '2024-07-10', '2024-07-10'),
(223, 270, 4, 0, NULL, 1, '2024-07-10 11:29:22', '2024-07-10', '2024-07-10'),
(224, 270, 6, 0, NULL, 1, '2024-07-10 11:29:22', '2024-07-10', '2024-07-10'),
(225, 271, 4, 0, NULL, 1, NULL, '2024-07-10', '2024-07-10'),
(226, 271, 6, 0, NULL, 1, NULL, '2024-07-10', '2024-07-10'),
(227, 272, 6, 22, NULL, 1, NULL, '2024-07-10', '2024-07-10'),
(228, 273, 6, 22, NULL, 1, NULL, '2024-07-10', '2024-07-10'),
(229, 274, 6, 22, NULL, 1, '2024-07-10 11:36:36', '2024-07-10', '2024-07-10'),
(230, 275, 6, 22, NULL, 1, '2024-07-10 11:50:27', '2024-07-10', '2024-07-10'),
(231, 276, 6, 22, NULL, 1, '2024-07-10 11:38:34', '2024-07-10', '2024-07-10'),
(232, 277, 6, 22, NULL, 1, '2024-07-10 11:43:35', '2024-07-10', '2024-07-10'),
(233, 278, 6, 22, NULL, 1, '2024-07-10 11:48:04', '2024-07-10', '2024-07-10'),
(234, 279, 6, 22, NULL, 1, '2024-07-10 11:45:13', '2024-07-10', '2024-07-10'),
(235, 280, 6, 22, NULL, 0, NULL, '2024-07-10', '2024-07-10'),
(236, 281, 6, 22, NULL, 1, '2024-07-10 11:51:50', '2024-07-10', '2024-07-10'),
(237, 282, 6, 22, NULL, 1, '2024-07-10 11:51:09', '2024-07-10', '2024-07-10'),
(238, 306, 4, 0, NULL, 1, NULL, '2024-07-16', '2024-07-16'),
(239, 306, 6, 0, NULL, 1, NULL, '2024-07-16', '2024-07-16'),
(240, 307, 4, 35, NULL, 1, NULL, '2024-07-16', '2024-07-16'),
(241, 308, 4, 35, NULL, 1, NULL, '2024-07-16', '2024-07-16'),
(242, 309, 4, 35, NULL, 1, NULL, '2024-07-16', '2024-07-16'),
(243, 310, 4, 35, NULL, 1, NULL, '2024-07-16', '2024-07-16'),
(244, 311, 4, 0, NULL, 1, NULL, '2024-07-16', '2024-07-16'),
(245, 311, 6, 0, NULL, 1, NULL, '2024-07-16', '2024-07-16');

-- --------------------------------------------------------

--
-- Table structure for table `payment_package_order`
--

CREATE TABLE `payment_package_order` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_request_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `discount` float DEFAULT NULL,
  `state` tinyint(1) NOT NULL DEFAULT 0,
  `date` date NOT NULL,
  `number` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_package_order`
--

INSERT INTO `payment_package_order` (`id`, `payment_request_id`, `user_id`, `package_id`, `discount`, `state`, `date`, `number`, `created_at`, `updated_at`) VALUES
(3, 318, 8, 2, NULL, 1, '2024-07-20', 4, '2024-07-20', '2024-07-29'),
(5, 320, 8, 3, NULL, 1, '2024-07-27', 0, '2024-07-27', '2024-07-28'),
(6, 321, 8, 3, NULL, 1, '2024-07-30', 1, '2024-07-30', '2024-08-01'),
(7, 322, 8, 3, NULL, 0, '2024-08-03', 0, '2024-08-03', '2024-08-03'),
(8, 323, 8, 3, NULL, 0, '2024-08-03', 0, '2024-08-03', '2024-08-03'),
(9, 324, 8, 3, NULL, 0, '2024-08-03', 0, '2024-08-03', '2024-08-03');

-- --------------------------------------------------------

--
-- Table structure for table `payment_requests`
--

CREATE TABLE `payment_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_method_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `price` float UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `module` enum('Chapters','Package','Course') NOT NULL DEFAULT 'Chapters',
  `state` enum('Pendding','Approve','Rejected') NOT NULL DEFAULT 'Pendding',
  `rejected_reason` varchar(255) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_requests`
--

INSERT INTO `payment_requests` (`id`, `payment_method_id`, `user_id`, `price`, `image`, `module`, `state`, `rejected_reason`, `created_at`, `updated_at`) VALUES
(1, 7, 8, 800, '2024X01X28X12X04X3729854.png', 'Chapters', 'Approve', NULL, NULL, '2024-03-03'),
(2, 7, 11, 300, '2024X01X28X12X04X3729854.png', 'Chapters', 'Approve', NULL, NULL, '2024-01-28'),
(3, 7, 8, 100, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-01-28', '2024-01-28'),
(4, 7, 8, 100, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-01-28', '2024-01-28'),
(5, 7, 8, 400, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-01-29', '2024-01-29'),
(6, 7, 8, 100, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-01-29', '2024-01-29'),
(7, 7, 8, 300, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-01-29', '2024-01-29'),
(8, 7, 8, 300, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-01-29', '2024-01-29'),
(9, 7, 8, 300, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-01-29', '2024-01-29'),
(10, 7, 8, 300, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-01-29', '2024-01-29'),
(11, 7, 8, 300, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-01-29', '2024-01-29'),
(12, 7, 8, 300, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-01-29', '2024-01-29'),
(13, 7, 8, 300, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-01-29', '2024-01-29'),
(14, 7, 8, 300, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-01-29', '2024-01-29'),
(15, 7, 8, 300, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-01-29', '2024-01-29'),
(16, 7, 8, 300, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-01-29', '2024-01-29'),
(17, 7, 8, 300, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-01-29', '2024-01-29'),
(18, 7, 8, 300, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-01-29', '2024-01-29'),
(19, 7, 8, 300, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-01-29', '2024-01-29'),
(20, 7, 8, 300, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-01-29', '2024-01-29'),
(21, 7, 8, 300, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-01-29', '2024-01-29'),
(22, 7, 8, 300, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-01-29', '2024-01-29'),
(23, 7, 8, 300, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-01-29', '2024-01-29'),
(24, 7, 8, 300, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-01-29', '2024-01-29'),
(25, 7, 8, 300, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-01-29', '2024-01-29'),
(26, 7, 8, 300, '2024X01X28X12X04X3729854.png', 'Chapters', 'Rejected', NULL, '2024-01-30', '2024-02-05'),
(27, 7, 8, 350, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-02-12', '2024-02-12'),
(28, 7, 8, 100, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-02-12', '2024-02-12'),
(29, 7, 8, 100, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-02-12', '2024-02-12'),
(30, 7, 8, 550, '2024X01X28X12X04X3729854.png', 'Chapters', 'Rejected', NULL, '2024-02-13', '2024-02-13'),
(31, 7, 8, 60, '2024X01X28X12X04X3729854.png', 'Package', 'Pendding', NULL, '2024-02-22', '2024-02-22'),
(32, 7, 8, 60, '2024X01X28X12X04X3729854.png', 'Package', 'Pendding', NULL, '2024-02-22', '2024-02-22'),
(33, 7, 8, 60, '2024X01X28X12X04X3729854.png', 'Package', 'Pendding', NULL, '2024-02-22', '2024-02-22'),
(34, 7, 8, 400, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-02-22', '2024-02-22'),
(35, 7, 8, 500, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-02-24', '2024-02-24'),
(36, 7, 8, 500, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-02-24', '2024-02-24'),
(37, 7, 8, 500, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-02-24', '2024-02-24'),
(38, 7, 8, 500, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-02-24', '2024-02-24'),
(39, 7, 8, 500, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-02-24', '2024-02-24'),
(40, 7, 8, 500, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-02-24', '2024-02-24'),
(41, 7, 8, 60, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-02-25', '2024-02-27'),
(42, 7, 8, 60, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-02-27', '2024-02-27'),
(43, 7, 8, 68, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-02-28', '2024-02-28'),
(44, 7, 8, 68, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-02-28', '2024-02-28'),
(45, 7, 8, 400, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-02-28', '2024-02-28'),
(46, 7, 8, 400, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-02-28', '2024-02-28'),
(47, 7, 8, 400, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-02-28', '2024-02-28'),
(48, 7, 8, 400, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-02-28', '2024-02-28'),
(49, 7, 8, 400, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-02-28', '2024-02-28'),
(50, 7, 8, 500, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-02-28', '2024-02-28'),
(51, 7, 8, 500, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-02-28', '2024-02-28'),
(52, 7, 8, 500, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-02-28', '2024-02-28'),
(53, 7, 8, 500, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-02-28', '2024-02-28'),
(54, 7, 8, 500, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-02-28', '2024-02-28'),
(55, 7, 8, 500, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-02-28', '2024-02-28'),
(56, 7, 8, 500, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-02-28', '2024-02-28'),
(57, 7, 8, 500, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-02-28', '2024-02-28'),
(58, 7, 8, 500, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-02-28', '2024-02-28'),
(59, 7, 8, 400, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-02-28', '2024-02-28'),
(60, 7, 8, 400, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-02-28', '2024-02-28'),
(61, 7, 8, 400, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-02-28', '2024-02-28'),
(62, 7, 8, 400, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-02-28', '2024-02-28'),
(63, 7, 8, 60, '2024X01X28X12X04X3729854.png', 'Package', 'Rejected', 'sdfsdfsd', '2024-02-29', '2024-03-13'),
(64, 7, 8, 60, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-02-29', '2024-02-29'),
(65, 7, 8, 60, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-02-29', '2024-02-29'),
(66, 7, 8, 60, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-02-29', '2024-02-29'),
(67, 7, 8, 111, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-02-29', '2024-02-29'),
(68, 7, 8, 111, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-02-29', '2024-02-29'),
(69, 7, 8, 60, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-02-29', '2024-02-29'),
(70, 7, 8, 57, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-03-07', '2024-03-07'),
(71, 7, 8, 57, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-03-07', '2024-03-07'),
(72, 7, 8, 57, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-03-07', '2024-03-07'),
(73, 7, 8, 400, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-03-07', '2024-03-07'),
(74, 7, 8, 400, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-03-07', '2024-03-07'),
(75, 7, 8, 400, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-03-07', '2024-03-07'),
(76, 7, 8, 400, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-03-07', '2024-03-07'),
(77, 7, 8, 400, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-03-07', '2024-03-07'),
(78, 7, 8, 400, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-03-07', '2024-03-07'),
(79, 7, 8, 400, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-03-07', '2024-03-07'),
(80, 7, 8, 400, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-03-07', '2024-03-07'),
(81, 7, 8, 400, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-03-07', '2024-03-07'),
(82, 7, 8, 400, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-03-07', '2024-03-07'),
(83, 7, 8, 400, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-03-07', '2024-03-07'),
(84, 7, 8, 400, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-03-07', '2024-03-07'),
(85, 7, 8, 68, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-03-07', '2024-03-07'),
(86, 7, 8, 68, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-03-07', '2024-03-07'),
(87, 7, 8, 68, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-03-07', '2024-03-07'),
(88, 7, 8, 68, '2024X01X28X12X04X3729854.png', 'Chapters', 'Approve', NULL, '2024-03-07', '2024-03-07'),
(89, 7, 8, 60, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-03-07', '2024-03-07'),
(90, 7, 8, 60, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-03-07', '2024-03-07'),
(91, 7, 8, 60, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-03-07', '2024-03-07'),
(92, 7, 8, 60, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-03-07', '2024-03-07'),
(93, 7, 8, 111, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-03-07', '2024-03-07'),
(94, 7, 8, 111, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-03-14', '2024-03-14'),
(95, 7, 8, 111, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-03-14', '2024-03-14'),
(96, 7, 8, 111, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-03-14', '2024-03-14'),
(97, 7, 8, 111, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-03-15', '2024-03-15'),
(98, 7, 8, 60, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-03-15', '2024-03-15'),
(99, 7, 8, 111, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-03-16', '2024-03-16'),
(100, NULL, 8, 111, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-03-23', '2024-03-23'),
(101, NULL, 8, 111, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-03-26', '2024-03-26'),
(102, NULL, 8, 111, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-03-26', '2024-03-26'),
(103, NULL, 8, 111, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-03-26', '2024-03-26'),
(104, NULL, 8, 111, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-03-26', '2024-03-26'),
(105, NULL, 8, 111, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-03-26', '2024-03-26'),
(106, NULL, 8, 111, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-03-26', '2024-03-26'),
(107, NULL, 8, 60, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-03-27', '2024-03-27'),
(108, NULL, 8, 570, '2024X01X28X12X04X3729854.png', 'Chapters', 'Approve', NULL, '2024-03-27', '2024-03-27'),
(109, NULL, 8, 111, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-04-01', '2024-04-01'),
(110, NULL, 8, 60, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-04-01', '2024-04-01'),
(111, NULL, 8, 111, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-04-08', '2024-04-08'),
(112, NULL, 8, 111, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-04-08', '2024-04-08'),
(113, NULL, 8, 111, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-04-08', '2024-04-08'),
(114, NULL, 8, 111, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-04-08', '2024-04-08'),
(115, NULL, 8, 111, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-04-08', '2024-04-08'),
(116, NULL, 8, 111, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-04-08', '2024-04-08'),
(117, NULL, 8, 111, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-04-08', '2024-04-08'),
(118, NULL, 8, 111, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-04-08', '2024-04-08'),
(119, NULL, 8, 570, '2024X01X28X12X04X3729854.png', 'Chapters', 'Approve', NULL, '2024-04-08', '2024-04-08'),
(120, NULL, 8, 17.94, '2024X01X28X12X04X3729854.png', 'Chapters', 'Approve', NULL, '2024-04-08', '2024-04-08'),
(121, NULL, 8, 60, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-04-17', '2024-04-17'),
(122, NULL, 8, 37.84, '2024X01X28X12X04X3729854.png', 'Chapters', 'Approve', NULL, '2024-04-17', '2024-04-17'),
(123, NULL, 8, 111, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-04-20', '2024-04-20'),
(124, NULL, 8, 60, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-04-21', '2024-04-21'),
(125, NULL, 8, 111, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-04-21', '2024-04-21'),
(126, NULL, 8, 111, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-04-22', '2024-04-22'),
(127, NULL, 8, 111, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-04-26', '2024-04-26'),
(128, NULL, 8, 111, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-04-26', '2024-04-26'),
(129, NULL, 8, 111, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-04-26', '2024-04-26'),
(130, NULL, 8, 111, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-04-26', '2024-04-26'),
(131, NULL, 8, 111, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-04-26', '2024-04-26'),
(132, NULL, 8, 475, '2024X01X28X12X04X3729854.png', 'Chapters', 'Approve', NULL, '2024-04-27', '2024-04-27'),
(133, NULL, 8, 475, '2024X01X28X12X04X3729854.png', 'Chapters', 'Approve', NULL, '2024-04-27', '2024-04-27'),
(134, NULL, 8, 60, '2024X01X28X12X04X3729854.png', 'Package', 'Approve', NULL, '2024-05-01', '2024-05-01'),
(135, 8, 8, 475, '2024X01X28X12X04X3729854.png', 'Chapters', 'Pendding', NULL, '2024-05-05', '2024-05-05'),
(136, NULL, 8, 46, NULL, 'Chapters', 'Approve', NULL, '2024-05-07', '2024-05-07'),
(137, NULL, 8, 14.89, NULL, 'Chapters', 'Approve', NULL, '2024-05-08', '2024-05-08'),
(138, NULL, 8, 17.94, NULL, 'Chapters', 'Approve', NULL, '2024-05-08', '2024-05-08'),
(139, NULL, 8, 17.94, NULL, 'Chapters', 'Approve', NULL, '2024-05-08', '2024-05-08'),
(140, NULL, 8, 17.94, NULL, 'Chapters', 'Approve', NULL, '2024-05-08', '2024-05-08'),
(141, 8, 8, 475, '2024X05X09X12X10X367306sad.png', 'Chapters', 'Pendding', NULL, '2024-05-09', '2024-05-09'),
(142, 8, 8, 14.89, '2024X05X09X12X13X331836shocked.png', 'Chapters', 'Pendding', NULL, '2024-05-09', '2024-05-09'),
(143, 8, 8, 14.89, '2024X05X09X12X14X3550719.png', 'Chapters', 'Approve', NULL, '2024-05-09', '2024-05-09'),
(144, NULL, 8, 14.89, '2024X05X09X12X14X49942419.png', 'Chapters', 'Approve', NULL, '2024-05-09', '2024-05-09'),
(145, NULL, 8, 475, NULL, 'Chapters', 'Approve', NULL, '2024-05-13', '2024-05-13'),
(146, NULL, 8, 475, NULL, 'Chapters', 'Approve', NULL, '2024-05-13', '2024-05-13'),
(147, NULL, 8, 475, NULL, 'Chapters', 'Approve', NULL, '2024-05-13', '2024-05-13'),
(148, NULL, 8, 475, NULL, 'Chapters', 'Approve', NULL, '2024-05-13', '2024-05-13'),
(149, NULL, 8, 475, NULL, 'Chapters', 'Approve', NULL, '2024-05-13', '2024-05-13'),
(150, NULL, 8, 475, NULL, 'Chapters', 'Approve', NULL, '2024-05-13', '2024-05-13'),
(151, NULL, 8, 475, NULL, 'Chapters', 'Approve', NULL, '2024-05-13', '2024-05-13'),
(152, NULL, 8, 14.89, NULL, 'Chapters', 'Approve', NULL, '2024-05-13', '2024-05-13'),
(153, NULL, 8, 14.89, NULL, 'Chapters', 'Approve', NULL, '2024-05-13', '2024-05-13'),
(154, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-05-13', '2024-05-13'),
(155, NULL, 8, 50, NULL, 'Chapters', 'Approve', NULL, '2024-05-13', '2024-05-13'),
(156, NULL, 8, 50, NULL, 'Chapters', 'Approve', NULL, '2024-05-13', '2024-05-13'),
(157, NULL, 8, 50, NULL, 'Chapters', 'Approve', NULL, '2024-05-13', '2024-05-13'),
(158, NULL, 8, 50, NULL, 'Chapters', 'Approve', NULL, '2024-05-13', '2024-05-13'),
(159, NULL, 8, 50, NULL, 'Package', 'Approve', NULL, '2024-05-13', '2024-05-13'),
(160, NULL, 8, 50, NULL, 'Chapters', 'Approve', NULL, '2024-05-13', '2024-05-13'),
(161, NULL, 8, 48.75, NULL, 'Package', 'Approve', NULL, '2024-05-13', '2024-05-13'),
(162, 2, 8, 475, '2024X05X16X10X53X2349188.png', 'Chapters', 'Pendding', NULL, '2024-05-16', '2024-05-16'),
(163, 2, 8, 475, '2024X05X16X11X01X4830728.png', 'Chapters', 'Pendding', NULL, '2024-05-16', '2024-05-16'),
(164, 2, 8, 475, '2024X05X17X11X31X3892016.png', 'Chapters', 'Approve', NULL, '2024-05-17', '2024-05-17'),
(165, NULL, 8, 475, NULL, 'Chapters', 'Approve', NULL, '2024-05-17', '2024-05-17'),
(166, 8, 8, 111, '2024X05X17X11X46X4349888.png', 'Package', 'Pendding', NULL, '2024-05-17', '2024-05-17'),
(167, 8, 8, 111, '2024X05X17X11X48X0544758.png', 'Package', 'Approve', NULL, '2024-05-17', '2024-05-17'),
(168, NULL, 8, 111, '2024X05X17X11X48X4644078.png', 'Package', 'Approve', NULL, '2024-05-17', '2024-05-17'),
(169, NULL, 8, 60, NULL, 'Package', 'Approve', NULL, '2024-05-17', '2024-05-17'),
(170, 7, 8, 60, '2024X05X17X11X58X0895907.png', 'Package', 'Pendding', NULL, '2024-05-17', '2024-05-17'),
(171, 8, 8, 60, '2024X05X17X12X03X39208.png', 'Package', 'Approve', NULL, '2024-05-17', '2024-05-19'),
(172, 8, 8, 60, '2024X05X17X12X04X4473468.png', 'Package', 'Approve', NULL, '2024-05-17', '2024-05-17'),
(173, 8, 8, 60, '2024X05X17X12X05X3420348.png', 'Package', 'Approve', NULL, '2024-05-17', '2024-05-17'),
(174, 8, 8, 60, '2024X05X17X12X06X2618077.png', 'Package', 'Approve', NULL, '2024-05-17', '2024-05-17'),
(175, NULL, 8, 60, '2024X05X17X12X06X4727857.png', 'Package', 'Approve', NULL, '2024-05-17', '2024-05-17'),
(176, 2, 8, 600, '2024X05X17X12X07X3367507.png', 'Package', 'Approve', NULL, '2024-05-17', '2024-05-17'),
(177, NULL, 8, 600, '2024X05X17X12X07X5544897.png', 'Package', 'Approve', NULL, '2024-05-17', '2024-05-17'),
(178, 8, 8, 40.65, '2024X05X17X12X10X1876176.png', 'Chapters', 'Approve', NULL, '2024-05-17', '2024-05-17'),
(179, NULL, 8, 40.65, NULL, 'Chapters', 'Approve', NULL, '2024-05-17', '2024-05-17'),
(180, NULL, 8, 40.65, NULL, 'Chapters', 'Approve', NULL, '2024-05-17', '2024-05-17'),
(181, NULL, 8, 40.65, NULL, 'Chapters', 'Approve', NULL, '2024-05-17', '2024-05-17'),
(182, 5, 8, 40.65, '2024X05X17X12X23X0445027.png', 'Chapters', 'Approve', NULL, '2024-05-17', '2024-05-17'),
(183, NULL, 8, 40.65, NULL, 'Chapters', 'Approve', NULL, '2024-05-17', '2024-05-17'),
(184, NULL, 8, 40.65, NULL, 'Chapters', 'Approve', NULL, '2024-05-17', '2024-05-17'),
(185, NULL, 8, 200, NULL, 'Package', 'Approve', NULL, '2024-05-19', '2024-05-19'),
(186, NULL, 8, 2000, NULL, 'Package', 'Approve', NULL, '2024-05-19', '2024-05-19'),
(187, NULL, 8, 200, NULL, 'Package', 'Approve', NULL, '2024-05-19', '2024-05-19'),
(188, NULL, 8, 200, NULL, 'Package', 'Approve', NULL, '2024-05-19', '2024-05-19'),
(189, NULL, 8, 200, NULL, 'Package', 'Approve', NULL, '2024-05-19', '2024-05-19'),
(190, NULL, 8, 200, NULL, 'Package', 'Approve', NULL, '2024-05-19', '2024-05-19'),
(191, NULL, 8, 200, NULL, 'Package', 'Approve', NULL, '2024-05-19', '2024-05-19'),
(192, NULL, 8, 200, NULL, 'Package', 'Approve', NULL, '2024-05-19', '2024-05-19'),
(193, NULL, 8, 200, NULL, 'Package', 'Approve', NULL, '2024-05-19', '2024-05-19'),
(194, NULL, 8, 200, NULL, 'Package', 'Approve', NULL, '2024-05-19', '2024-05-19'),
(195, NULL, 8, 200, NULL, 'Package', 'Approve', NULL, '2024-05-19', '2024-05-19'),
(196, NULL, 8, 475, NULL, 'Chapters', 'Approve', NULL, '2024-05-22', '2024-05-22'),
(197, NULL, 8, 60, NULL, 'Package', 'Approve', NULL, '2024-05-22', '2024-05-22'),
(198, NULL, 8, 60, NULL, 'Package', 'Approve', NULL, '2024-05-22', '2024-05-22'),
(199, NULL, 8, 32.34, NULL, 'Chapters', 'Approve', NULL, '2024-05-25', '2024-05-25'),
(200, NULL, 8, 50, NULL, 'Chapters', 'Approve', NULL, '2024-05-25', '2024-05-25'),
(201, NULL, 8, 300, NULL, 'Course', 'Approve', NULL, '2024-05-27', '2024-05-27'),
(202, NULL, 8, 6.12, NULL, 'Chapters', 'Approve', NULL, '2024-05-28', '2024-05-28'),
(203, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-05-30', '2024-05-30'),
(204, NULL, 8, 60, NULL, 'Package', 'Approve', NULL, '2024-06-04', '2024-06-04'),
(205, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-06-05', '2024-06-05'),
(206, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-06-06', '2024-06-06'),
(207, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-06-06', '2024-06-06'),
(208, NULL, 8, 60, NULL, 'Package', 'Approve', NULL, '2024-06-12', '2024-06-12'),
(209, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-06-12', '2024-06-12'),
(210, NULL, 8, 60, NULL, 'Package', 'Approve', NULL, '2024-06-12', '2024-06-12'),
(211, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-06-19', '2024-06-19'),
(212, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-06-23', '2024-06-23'),
(213, NULL, 8, 60, NULL, 'Package', 'Approve', NULL, '2024-06-23', '2024-06-23'),
(214, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-06-23', '2024-06-23'),
(215, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-02', '2024-07-02'),
(216, NULL, 8, 475, NULL, 'Chapters', 'Approve', NULL, '2024-07-04', '2024-07-04'),
(217, NULL, 8, 22.25, NULL, 'Chapters', 'Approve', NULL, '2024-07-04', '2024-07-04'),
(218, NULL, 8, 22.25, NULL, 'Chapters', 'Approve', NULL, '2024-07-04', '2024-07-04'),
(219, NULL, 8, 22.25, NULL, 'Chapters', 'Approve', NULL, '2024-07-04', '2024-07-04'),
(220, NULL, 8, 6.12, NULL, 'Chapters', 'Approve', NULL, '2024-07-04', '2024-07-04'),
(221, NULL, 8, 22.25, NULL, 'Chapters', 'Approve', NULL, '2024-07-04', '2024-07-04'),
(222, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-05', '2024-07-05'),
(223, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-05', '2024-07-05'),
(224, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-05', '2024-07-05'),
(225, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-05', '2024-07-05'),
(226, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-05', '2024-07-05'),
(227, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-05', '2024-07-05'),
(228, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-05', '2024-07-05'),
(229, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-05', '2024-07-05'),
(230, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-05', '2024-07-05'),
(231, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-05', '2024-07-05'),
(232, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-05', '2024-07-05'),
(233, NULL, 8, 22.25, NULL, 'Chapters', 'Approve', NULL, '2024-07-05', '2024-07-05'),
(234, NULL, 8, 22.25, NULL, 'Chapters', 'Approve', NULL, '2024-07-05', '2024-07-05'),
(235, NULL, 8, 22.25, NULL, 'Chapters', 'Approve', NULL, '2024-07-05', '2024-07-05'),
(236, NULL, 8, 22.25, NULL, 'Chapters', 'Approve', NULL, '2024-07-05', '2024-07-05'),
(237, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-05', '2024-07-05'),
(238, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-05', '2024-07-05'),
(239, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-05', '2024-07-05'),
(240, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-05', '2024-07-05'),
(241, NULL, 8, 83.25, NULL, 'Package', 'Approve', NULL, '2024-07-05', '2024-07-05'),
(242, NULL, 8, 83.25, NULL, 'Package', 'Approve', NULL, '2024-07-05', '2024-07-05'),
(243, NULL, 8, 60, NULL, 'Package', 'Approve', NULL, '2024-07-05', '2024-07-05'),
(244, NULL, 8, 475, NULL, 'Chapters', 'Approve', NULL, '2024-07-05', '2024-07-05'),
(245, NULL, 8, 375, NULL, 'Chapters', 'Approve', NULL, '2024-07-05', '2024-07-05'),
(246, NULL, 8, 22.25, NULL, 'Chapters', 'Approve', NULL, '2024-07-05', '2024-07-05'),
(247, NULL, 8, 22.25, NULL, 'Chapters', 'Approve', NULL, '2024-07-05', '2024-07-05'),
(248, NULL, 8, 22.25, NULL, 'Chapters', 'Approve', NULL, '2024-07-05', '2024-07-05'),
(249, NULL, 8, 22.25, NULL, 'Chapters', 'Approve', NULL, '2024-07-05', '2024-07-05'),
(250, NULL, 8, 22.25, NULL, 'Chapters', 'Approve', NULL, '2024-07-05', '2024-07-05'),
(251, NULL, 8, 22.25, NULL, 'Chapters', 'Approve', NULL, '2024-07-05', '2024-07-05'),
(252, NULL, 8, 22.25, NULL, 'Chapters', 'Approve', NULL, '2024-07-05', '2024-07-05'),
(253, NULL, 8, 475, NULL, 'Chapters', 'Pendding', NULL, '2024-07-06', '2024-07-06'),
(254, NULL, 8, 475, NULL, 'Chapters', 'Pendding', NULL, '2024-07-06', '2024-07-06'),
(255, 5, 8, 475, '2024X07X06X11X55X5068452024X06X09X10X48X028604Screenshot[12]X01.png', 'Chapters', 'Pendding', NULL, '2024-07-06', '2024-07-06'),
(256, NULL, 8, 475, NULL, 'Chapters', 'Approve', NULL, '2024-07-06', '2024-07-06'),
(257, NULL, 8, 475, NULL, 'Chapters', 'Approve', NULL, '2024-07-06', '2024-07-06'),
(258, 4, 8, 475, NULL, 'Chapters', 'Pendding', NULL, '2024-07-06', '2024-07-06'),
(259, 4, 8, 475, '2024X07X06X12X22X1165082024X06X09X10X48X028604Screenshot[12]X01.png', 'Chapters', 'Pendding', NULL, '2024-07-06', '2024-07-06'),
(260, NULL, 8, 22.25, NULL, 'Chapters', 'Approve', NULL, '2024-07-07', '2024-07-07'),
(261, NULL, 8, 60, NULL, 'Package', 'Approve', NULL, '2024-07-08', '2024-07-08'),
(262, 7, 8, 60, '2024X07X08X12X09X3417072024X06X09X10X48X028604Screenshot[12]X01.png', 'Package', 'Pendding', NULL, '2024-07-08', '2024-07-08'),
(263, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-08', '2024-07-08'),
(264, NULL, 8, 83.25, NULL, 'Package', 'Approve', NULL, '2024-07-08', '2024-07-08'),
(265, 2, 8, 83.25, '2024X07X08X16X09X101406umbrellas.jpg', 'Package', 'Pendding', NULL, '2024-07-08', '2024-07-08'),
(266, NULL, 8, 475, NULL, 'Chapters', 'Approve', NULL, '2024-07-10', '2024-07-10'),
(267, 2, 8, 475, '2024X07X10X11X07X103540umbrellas.jpg', 'Chapters', 'Approve', NULL, '2024-07-10', '2024-07-10'),
(268, 2, 8, 475, '2024X07X10X11X26X04258umbrellas.jpg', 'Chapters', 'Approve', NULL, '2024-07-10', '2024-07-10'),
(269, 5, 8, 475, '2024X07X10X11X27X549559umbrellas.jpg', 'Chapters', 'Approve', NULL, '2024-07-10', '2024-07-10'),
(270, 2, 8, 375, '2024X07X10X11X29X104957umbrellas.jpg', 'Chapters', 'Approve', NULL, '2024-07-10', '2024-07-10'),
(271, NULL, 8, 375, NULL, 'Chapters', 'Approve', NULL, '2024-07-10', '2024-07-10'),
(272, NULL, 8, 22.25, NULL, 'Chapters', 'Approve', NULL, '2024-07-10', '2024-07-10'),
(273, NULL, 8, 22.25, NULL, 'Chapters', 'Approve', NULL, '2024-07-10', '2024-07-10'),
(274, 4, 8, 22.25, '2024X07X10X11X36X207011umbrellas.jpg', 'Chapters', 'Approve', NULL, '2024-07-10', '2024-07-10'),
(275, 4, 8, 22.25, '2024X07X10X11X36X428470umbrellas.jpg', 'Chapters', 'Approve', NULL, '2024-07-10', '2024-07-10'),
(276, 2, 8, 22.25, '2024X07X10X11X38X237397umbrellas.jpg', 'Chapters', 'Approve', NULL, '2024-07-10', '2024-07-10'),
(277, 2, 8, 22.25, '2024X07X10X11X43X235959umbrellas.jpg', 'Chapters', 'Approve', NULL, '2024-07-10', '2024-07-10'),
(278, 2, 8, 22.25, '2024X07X10X11X43X515104umbrellas.jpg', 'Chapters', 'Approve', NULL, '2024-07-10', '2024-07-10'),
(279, 2, 8, 22.25, '2024X07X10X11X44X444679umbrellas.jpg', 'Chapters', 'Approve', NULL, '2024-07-10', '2024-07-10'),
(280, 2, 8, 22.25, '2024X07X10X11X49X096604umbrellas.jpg', 'Chapters', 'Pendding', NULL, '2024-07-10', '2024-07-10'),
(281, 2, 8, 22.25, '2024X07X10X11X50X216585umbrellas.jpg', 'Chapters', 'Approve', NULL, '2024-07-10', '2024-07-10'),
(282, 4, 8, 22.25, '2024X07X10X11X50X505884umbrellas.jpg', 'Chapters', 'Approve', NULL, '2024-07-10', '2024-07-10'),
(283, NULL, 8, 62.4375, NULL, 'Package', 'Approve', NULL, '2024-07-10', '2024-07-10'),
(284, NULL, 8, 62.4375, NULL, 'Package', 'Approve', NULL, '2024-07-10', '2024-07-10'),
(285, NULL, 8, 62.4375, NULL, 'Package', 'Approve', NULL, '2024-07-10', '2024-07-10'),
(286, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-10', '2024-07-10'),
(287, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-10', '2024-07-10'),
(288, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-10', '2024-07-10'),
(289, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-10', '2024-07-10'),
(290, NULL, 8, 60, NULL, 'Package', 'Approve', NULL, '2024-07-14', '2024-07-14'),
(291, NULL, 8, 60, NULL, 'Package', 'Approve', NULL, '2024-07-14', '2024-07-14'),
(292, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-15', '2024-07-15'),
(293, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-15', '2024-07-15'),
(294, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-15', '2024-07-15'),
(295, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-15', '2024-07-15'),
(296, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-15', '2024-07-15'),
(297, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-15', '2024-07-15'),
(298, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-15', '2024-07-15'),
(299, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-15', '2024-07-15'),
(300, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-15', '2024-07-15'),
(301, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-15', '2024-07-15'),
(302, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-15', '2024-07-15'),
(303, NULL, 44, 60, NULL, 'Package', 'Approve', NULL, '2024-07-15', '2024-07-15'),
(304, NULL, 8, 60, NULL, 'Package', 'Approve', NULL, '2024-07-15', '2024-07-15'),
(305, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-16', '2024-07-16'),
(306, NULL, 8, 17.94, NULL, 'Chapters', 'Approve', NULL, '2024-07-16', '2024-07-16'),
(307, NULL, 8, 6.12, NULL, 'Chapters', 'Approve', NULL, '2024-07-16', '2024-07-16'),
(308, NULL, 8, 6.12, NULL, 'Chapters', 'Approve', NULL, '2024-07-16', '2024-07-16'),
(309, NULL, 8, 6.12, NULL, 'Chapters', 'Approve', NULL, '2024-07-16', '2024-07-16'),
(310, NULL, 8, 6.12, NULL, 'Chapters', 'Approve', NULL, '2024-07-16', '2024-07-16'),
(311, NULL, 8, 17.94, NULL, 'Chapters', 'Approve', NULL, '2024-07-16', '2024-07-16'),
(312, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-16', '2024-07-16'),
(313, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-16', '2024-07-16'),
(314, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-16', '2024-07-16'),
(315, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-20', '2024-07-20'),
(316, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-20', '2024-07-20'),
(317, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-20', '2024-07-20'),
(318, NULL, 8, 60, NULL, 'Package', 'Approve', NULL, '2024-07-20', '2024-07-20'),
(319, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-22', '2024-07-22'),
(320, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-27', '2024-07-27'),
(321, NULL, 8, 111, NULL, 'Package', 'Approve', NULL, '2024-07-30', '2024-07-30'),
(322, 8, 8, 111, NULL, 'Package', 'Pendding', NULL, '2024-08-03', '2024-08-03'),
(323, 8, 8, 111, '2024X08X03X16X09X026954download.jpg', 'Package', 'Pendding', NULL, '2024-08-03', '2024-08-03'),
(324, 8, 8, 111, '2024X08X03X16X11X361952338221185_1220559635281891_1236998351022324965_n.jpg', 'Package', 'Pendding', NULL, '2024-08-03', '2024-08-03');

-- --------------------------------------------------------

--
-- Table structure for table `payouts`
--

CREATE TABLE `payouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `affilate_id` bigint(20) UNSIGNED NOT NULL,
  `amount` float NOT NULL,
  `payment_method` bigint(20) UNSIGNED DEFAULT NULL,
  `statue` enum('pendding','approve','rejected') NOT NULL DEFAULT 'pendding',
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `payouts`
--

INSERT INTO `payouts` (`id`, `date`, `affilate_id`, `amount`, `payment_method`, `statue`, `created_at`, `updated_at`) VALUES
(1, '2024-01-16', 1, 200, 2, 'approve', NULL, '2024-01-27'),
(3, '2024-04-25', 1, 200, 2, 'approve', '2024-04-25', '2024-04-25'),
(4, '2024-04-25', 1, 100, 2, 'pendding', '2024-04-25', '2024-04-25'),
(5, '2024-04-25', 1, 100, 2, 'approve', '2024-04-25', '2024-04-25');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(3, 'App\\Models\\User', 68, 'user', '2efee2afc1b140298929fc3f32f00c70ba1ef2e068b7da7195f9d028d4a256ef', '[\"*\"]', NULL, NULL, '2024-07-02 07:57:07', '2024-07-02 07:57:07'),
(7, 'App\\Models\\User', 68, 'user', 'cc1a849864f16cd6bf8b0ded3342965b763fe1101f7ec38fe136da8bcfdd412d', '[\"*\"]', NULL, NULL, '2024-07-03 17:44:24', '2024-07-03 17:44:24'),
(10, 'App\\Models\\User', 68, 'user', 'b79195b51360cd5a42f7702f49fff9173fda8530ef3ee324c2131a4a24821b0f', '[\"*\"]', NULL, NULL, '2024-07-04 21:15:20', '2024-07-04 21:15:20'),
(13, 'App\\Models\\User', 5, 'user', '7a2c31668756c2b77a2ba20cc46e23820bb53e50c1dea0b9192a9fcd0e933f41', '[\"*\"]', NULL, NULL, '2024-07-05 09:11:30', '2024-07-05 09:11:30'),
(15, 'App\\Models\\User', 5, 'user', '3aa37cb9ae8056d1e0c057c0e892393a5d1ac67ccc2adfd3192d54316d7d990b', '[\"*\"]', NULL, NULL, '2024-07-05 09:13:19', '2024-07-05 09:13:19'),
(17, 'App\\Models\\User', 68, 'user', '99ee5f5e43fcda83b5906a1d627eb5120948c6bab6448b33ea45f4445c80a44b', '[\"*\"]', NULL, NULL, '2024-07-05 09:13:50', '2024-07-05 09:13:50'),
(19, 'App\\Models\\User', 5, 'user', '4b11481901c0c09ced5aab87224872db02c1919cbfcd74a0639f3621b84370d2', '[\"*\"]', NULL, NULL, '2024-07-05 09:16:20', '2024-07-05 09:16:20'),
(22, 'App\\Models\\User', 5, 'user', 'a8422e9c01b504da3ab83e121e803b2521d9f2aff0a6ea88cda33f220aa104e9', '[\"*\"]', NULL, NULL, '2024-07-05 09:20:33', '2024-07-05 09:20:33'),
(24, 'App\\Models\\User', 68, 'user', '4a8b9448954308ef428838218fdcf7b61385347c3b0b79a666efe6f25b1ec3e5', '[\"*\"]', NULL, NULL, '2024-07-05 12:53:41', '2024-07-05 12:53:41'),
(25, 'App\\Models\\User', 5, 'user', '16a9dcc8b65deb5ff74ed183f959d82c852a7b4d551791b6aeb91a0b33f28e9a', '[\"*\"]', NULL, NULL, '2024-07-05 12:54:34', '2024-07-05 12:54:34'),
(35, 'App\\Models\\User', 68, 'user', 'd9eea9112162ce3866857f078c8838ab50dcdc42ba0f209cdca8a0dec29f2558', '[\"*\"]', NULL, NULL, '2024-07-06 14:35:00', '2024-07-06 14:35:00'),
(39, 'App\\Models\\User', 68, 'user', '7481ad72f83f51eb504650fcc04e018be272c2500520ea061be4ef9ecbf9c802', '[\"*\"]', NULL, NULL, '2024-07-07 10:40:11', '2024-07-07 10:40:11'),
(42, 'App\\Models\\User', 68, 'user', '7e4a795e1e38fd168cdca3dc4b2a129f82e45b84380d0b3ff094ce84d216daf1', '[\"*\"]', NULL, NULL, '2024-07-07 12:52:33', '2024-07-07 12:52:33'),
(48, 'App\\Models\\User', 68, 'user', '142752ae627d71474d40dda34fd6dd5ab9ef6dbad95e0516f8491b17b7ea7180', '[\"*\"]', NULL, NULL, '2024-07-09 09:33:09', '2024-07-09 09:33:09'),
(54, 'App\\Models\\User', 68, 'user', '2033ee69a057b285bac02e501d714cb950960115356e698515cf1ba060be356b', '[\"*\"]', NULL, NULL, '2024-07-09 13:27:40', '2024-07-09 13:27:40'),
(60, 'App\\Models\\User', 68, 'user', '107e3c85f7ee2f1ca8c069fb5e773890b1c710fb31da3d080db0c040214eb5be', '[\"*\"]', NULL, NULL, '2024-07-10 09:13:22', '2024-07-10 09:13:22'),
(61, 'App\\Models\\User', 68, 'user', '98cee3953b1c20b6187955a4613bbd86f724eda2315b4bc22416f7b7fcf8c868', '[\"*\"]', NULL, NULL, '2024-07-10 09:24:31', '2024-07-10 09:24:31'),
(64, 'App\\Models\\User', 68, 'user', '83ca8c1573ad2fbc6e02be1850933ee47d7e1cd0b3ee90c86734f7662f5401b6', '[\"*\"]', NULL, NULL, '2024-07-10 12:26:23', '2024-07-10 12:26:23'),
(67, 'App\\Models\\User', 68, 'user', '3506292845a6cfcd2792f9f4abe06078a8f359c30d84ff453c7cb0e215ae9f24', '[\"*\"]', NULL, NULL, '2024-07-10 13:39:48', '2024-07-10 13:39:48'),
(69, 'App\\Models\\User', 68, 'user', '81b8a7ca1cdd7889c50d67d6120b7d03b66f3325d04f253f7c9416f4c6eaa645', '[\"*\"]', NULL, NULL, '2024-07-11 10:29:32', '2024-07-11 10:29:32'),
(71, 'App\\Models\\User', 68, 'user', '7ff5bbc0ea96cc39c882180021ba2fa264184338f4c6777a8644eeb3cddc4801', '[\"*\"]', NULL, NULL, '2024-07-11 19:33:52', '2024-07-11 19:33:52'),
(75, 'App\\Models\\User', 68, 'user', '8c56af489dbac9ce2c77dd87ab04605f4980d14ca95541d9e6bb8b86eb4938da', '[\"*\"]', NULL, NULL, '2024-07-13 07:54:44', '2024-07-13 07:54:44'),
(78, 'App\\Models\\User', 68, 'user', '7b29b685d5b7c87c63af53b13a73eeb3df7743ed52671252fb6fd1e1c0d65d29', '[\"*\"]', NULL, NULL, '2024-07-13 09:28:24', '2024-07-13 09:28:24'),
(80, 'App\\Models\\User', 68, 'user', '162b52c303a4887f683c5a00f2df7f0aeac0075da214baeadcf53e27c6366050', '[\"*\"]', NULL, NULL, '2024-07-14 07:24:53', '2024-07-14 07:24:53'),
(82, 'App\\Models\\User', 68, 'user', '887c115b4e4828b29e15eceda8c2248f966782b785b7489f9d6dfe0b3b2984a0', '[\"*\"]', NULL, NULL, '2024-07-14 14:45:12', '2024-07-14 14:45:12'),
(86, 'App\\Models\\User', 68, 'user', '864f46d6e99730765939c26edbc861d7e113bf8a0839f4745aefb7e8d59239f5', '[\"*\"]', NULL, NULL, '2024-07-15 13:13:11', '2024-07-15 13:13:11'),
(89, 'App\\Models\\User', 68, 'user', '3efd674fb9f622f3747501ed92fdd9697a9e96c5270159650dd57a903e5e8fc8', '[\"*\"]', NULL, NULL, '2024-07-16 12:42:43', '2024-07-16 12:42:43'),
(90, 'App\\Models\\User', 68, 'user', '7aaae93b5b4192ef73a26e7132421a1f94da201ae7d3d2641fc36ced0560a76f', '[\"*\"]', NULL, NULL, '2024-07-16 15:05:21', '2024-07-16 15:05:21'),
(94, 'App\\Models\\User', 68, 'user', '418431277348606f36219a8465e28e359d1b8f6b13aab3769dd4852bd205285c', '[\"*\"]', NULL, NULL, '2024-07-20 08:59:23', '2024-07-20 08:59:23'),
(96, 'App\\Models\\User', 68, 'user', '498c281f7df3d699cb2fb834965ee1f6132eb18cb591a83a05b7fef23d1a18b1', '[\"*\"]', NULL, NULL, '2024-07-20 09:01:44', '2024-07-20 09:01:44'),
(98, 'App\\Models\\User', 68, 'user', '4e9eb1cacaac9f428bf217843c8b773d6e106b91765f62869abfb73a224a906a', '[\"*\"]', NULL, NULL, '2024-07-20 10:33:42', '2024-07-20 10:33:42'),
(99, 'App\\Models\\User', 8, 'user', 'bf676038b8ba74e93b42cad4892c08d54006c533c994875ec9edaefa5150a3ce', '[\"*\"]', NULL, NULL, '2024-07-20 10:34:24', '2024-07-20 10:34:24'),
(100, 'App\\Models\\User', 68, 'user', '2d490d02b8058a0baac30c690446d90da9031df76692abd8ae614042ce8be052', '[\"*\"]', NULL, NULL, '2024-07-20 10:42:41', '2024-07-20 10:42:41'),
(101, 'App\\Models\\User', 68, 'user', 'a7e0cca5891c0332f7e4e99c4906fe2b1b4a22bb261d27c10d6585482c39e8af', '[\"*\"]', NULL, NULL, '2024-07-20 14:03:57', '2024-07-20 14:03:57'),
(102, 'App\\Models\\User', 68, 'user', 'd5472233bb1be2930aac4c6ce98660342c82d1fa1b9e04f6336d9b7676d2b1ac', '[\"*\"]', NULL, NULL, '2024-07-21 07:43:41', '2024-07-21 07:43:41'),
(103, 'App\\Models\\User', 8, 'user', '6464d7316ad4cb6a43bb8579334a3ea4f918431163619287dda71c3b642b6dc5', '[\"*\"]', NULL, NULL, '2024-07-21 07:44:39', '2024-07-21 07:44:39'),
(104, 'App\\Models\\User', 68, 'user', '013a81f6554336c4a39d48268232b8e09ae85f84e865e60e4655d1a38b9d5dbb', '[\"*\"]', NULL, NULL, '2024-07-21 12:21:32', '2024-07-21 12:21:32'),
(105, 'App\\Models\\User', 8, 'user', 'f71bcd74a99c1e404b4f0348d63d04cf66f6cf5228bcdac0cb19ef7b48a5195d', '[\"*\"]', NULL, NULL, '2024-07-22 07:46:20', '2024-07-22 07:46:20'),
(106, 'App\\Models\\User', 68, 'user', 'da5d5d43eb138ee1a1739084fe5fec816a870743746db3fa391460d30767e1a1', '[\"*\"]', NULL, NULL, '2024-07-22 08:08:30', '2024-07-22 08:08:30'),
(107, 'App\\Models\\User', 8, 'user', '4513efc966fcb987bdd36976b98d2430501ae4adcaeb9d9297fb441935af4b5a', '[\"*\"]', NULL, NULL, '2024-07-22 09:04:29', '2024-07-22 09:04:29'),
(108, 'App\\Models\\User', 8, 'user', '70398d9231dce4e9ce5b72fdea7ce53e100364384d54b787f064f9ea376565c8', '[\"*\"]', NULL, NULL, '2024-07-22 14:25:29', '2024-07-22 14:25:29'),
(109, 'App\\Models\\User', 8, 'user', '3419fd8df3d6ee684ddca048444d1b1ba0de15fbf456d0f0eb7013dcdd813f9d', '[\"*\"]', NULL, NULL, '2024-07-23 00:14:21', '2024-07-23 00:14:21'),
(110, 'App\\Models\\User', 8, 'user', 'cf94cd98620e2716f5f9a21654da414a771125ca05dbeb6ff58f89d5411b4fba', '[\"*\"]', NULL, NULL, '2024-07-23 07:32:32', '2024-07-23 07:32:32'),
(111, 'App\\Models\\User', 8, 'user', '2e180afbf109b25a1cf84335c7cae17621288aa69a6e59e08293abab8429a2ef', '[\"*\"]', NULL, NULL, '2024-07-23 07:35:24', '2024-07-23 07:35:24'),
(112, 'App\\Models\\User', 68, 'user', '706150fc0159e2848d88ba3fce6a875b8812ad4597568b2c1f3dc34865da754a', '[\"*\"]', NULL, NULL, '2024-07-23 09:00:28', '2024-07-23 09:00:28'),
(113, 'App\\Models\\User', 8, 'user', '73432d4df6549c8e848872ab039314cd374f3b88311111ff7910cfeb2d08b5c1', '[\"*\"]', NULL, NULL, '2024-07-23 10:09:55', '2024-07-23 10:09:55'),
(114, 'App\\Models\\User', 68, 'user', '53ec8ab33c928629f53e042f61d7786593a189d0423c05f9e105ebe4d88ce2fa', '[\"*\"]', NULL, NULL, '2024-07-23 12:06:19', '2024-07-23 12:06:19'),
(115, 'App\\Models\\User', 68, 'user', '9cd29df7cdccdf06e7bee2b8c1f61de6cb4f0b8131476dcc5bf5b0256ce7806f', '[\"*\"]', NULL, NULL, '2024-07-24 07:13:30', '2024-07-24 07:13:30'),
(116, 'App\\Models\\User', 8, 'user', '3855b6e5e074d6098571361cc138de29d021603ec4b78af5c00a5d2588f694bb', '[\"*\"]', NULL, NULL, '2024-07-24 07:45:46', '2024-07-24 07:45:46'),
(117, 'App\\Models\\User', 68, 'user', 'a31e3955cd6239ab3ea4f4b93091c314093630ea53ad618efbb80e9021a4856b', '[\"*\"]', NULL, NULL, '2024-07-24 12:10:33', '2024-07-24 12:10:33'),
(118, 'App\\Models\\User', 8, 'user', 'db9d9bcae672b249c2d740419ae21f162ba3eaee6b3ca410388cdf8d45f73ffc', '[\"*\"]', NULL, NULL, '2024-07-24 14:30:53', '2024-07-24 14:30:53'),
(119, 'App\\Models\\User', 68, 'user', 'b51e4fe777765c38f527fedd684bd559339900e8a3f37cfbe728016d1518dc7f', '[\"*\"]', NULL, NULL, '2024-07-24 14:52:42', '2024-07-24 14:52:42'),
(120, 'App\\Models\\User', 68, 'user', 'c59ea3a72ab78a67623d32a1cdb9ca9f78e97d5f77d873f5433d02c45a34bdb3', '[\"*\"]', NULL, NULL, '2024-07-24 16:00:17', '2024-07-24 16:00:17'),
(121, 'App\\Models\\User', 68, 'user', 'd78c13b69c687f9817f5e432b555f3f1bd024160a48cf680c8faea5a00ac2b89', '[\"*\"]', NULL, NULL, '2024-07-25 11:46:45', '2024-07-25 11:46:45'),
(122, 'App\\Models\\User', 8, 'user', 'a25a5bbfcfe596f586c7e0cc51e5416de5877f2baee69b4bac09f90c37dfdb3b', '[\"*\"]', NULL, NULL, '2024-07-27 08:43:24', '2024-07-27 08:43:24'),
(123, 'App\\Models\\User', 68, 'user', '21829c4f32efcb4845f9b7bd8449c8242b0c24436d215a155b8013e90daad69b', '[\"*\"]', NULL, NULL, '2024-07-27 09:51:24', '2024-07-27 09:51:24'),
(124, 'App\\Models\\User', 8, 'user', 'daa5540714fbe424e6f9e0af3fb536948297af2ed08ea46f00998ad126fbbefa', '[\"*\"]', NULL, NULL, '2024-07-27 09:51:55', '2024-07-27 09:51:55'),
(125, 'App\\Models\\User', 8, 'user', '8dd507024c13274f14739b6e1b1ddb54d9788313fc07fcf48ca59d15be678f8a', '[\"*\"]', NULL, NULL, '2024-07-27 12:16:03', '2024-07-27 12:16:03'),
(126, 'App\\Models\\User', 68, 'user', '2d0aa8e8fd6032a59c059fec9ec8a589a67f5c37ad96cf12161449521e448815', '[\"*\"]', NULL, NULL, '2024-07-28 07:33:04', '2024-07-28 07:33:04'),
(127, 'App\\Models\\User', 8, 'user', 'a8e011c2d9351cfbc54fe1674d07e4c3e3029c7aa9675c642a71a1210fe43409', '[\"*\"]', NULL, NULL, '2024-07-28 07:37:52', '2024-07-28 07:37:52'),
(128, 'App\\Models\\User', 8, 'user', '7dac033f032927ae8b11b98c42a896180dffdeb6d86f3721f303a49be994bd82', '[\"*\"]', NULL, NULL, '2024-07-28 10:25:55', '2024-07-28 10:25:55'),
(129, 'App\\Models\\User', 68, 'user', '7d15af10b94ebacdc5b52f51e2eddb63382c453693dd253b6627e0dd748394d7', '[\"*\"]', NULL, NULL, '2024-07-28 10:42:00', '2024-07-28 10:42:00'),
(130, 'App\\Models\\User', 8, 'user', 'afeb2b91bc4018153dbf0fed8b5a6c76816985f6b6264ee53bf9638bbd60d0e1', '[\"*\"]', NULL, NULL, '2024-07-28 12:42:04', '2024-07-28 12:42:04'),
(131, 'App\\Models\\User', 68, 'user', '7ac96112e95f92b6bd684311d8673575d5dd28bfc00232d329a4537de05b567b', '[\"*\"]', NULL, NULL, '2024-07-28 12:45:58', '2024-07-28 12:45:58'),
(132, 'App\\Models\\User', 8, 'personal access tokens', 'ee8f9da5b85f315fee30f1203e73520de0dc5de8effae17447cafc4b5f9db18c', '[\"*\"]', '2024-07-29 09:14:42', NULL, '2024-07-29 09:14:26', '2024-07-29 09:14:42'),
(133, 'App\\Models\\User', 8, 'user', 'c2db5b8e514d68978476f509cd1f1d44fa718a69919d1b63adf291c788ee8d15', '[\"*\"]', NULL, NULL, '2024-07-29 14:33:29', '2024-07-29 14:33:29'),
(134, 'App\\Models\\User', 8, 'user', '3b5c68272f7bc0a28835227eb954324f7f543f59fe159ef91e9ce3d772425aca', '[\"*\"]', NULL, NULL, '2024-07-30 07:18:13', '2024-07-30 07:18:13'),
(135, 'App\\Models\\User', 68, 'user', 'dd217b27377cc2089aef66fd4db65fc18a5bae98b9ae5c09f0299d040abadf1f', '[\"*\"]', NULL, NULL, '2024-07-30 09:51:13', '2024-07-30 09:51:13'),
(136, 'App\\Models\\User', 8, 'user', 'aa47529f1490fff8ecd29961026de2991660f10b0b1418295ea1332cb255dee7', '[\"*\"]', NULL, NULL, '2024-07-30 14:09:13', '2024-07-30 14:09:13'),
(137, 'App\\Models\\User', 68, 'user', 'a4fb803197f480e26c2e8b072c2cd8ed7fa62c7541f1a39c0b01d80230f09d4b', '[\"*\"]', NULL, NULL, '2024-08-01 09:12:55', '2024-08-01 09:12:55'),
(138, 'App\\Models\\User', 8, 'user', 'dc2562f2bd265ce52dd27680e3da910d0093293c91e1750eeb762d8b9720ec05', '[\"*\"]', NULL, NULL, '2024-08-01 09:33:45', '2024-08-01 09:33:45'),
(139, 'App\\Models\\User', 68, 'user', 'bd10f014227440aca183791fb04a4cc64454ba5d8d35c4d1110f2d8348f8ec18', '[\"*\"]', NULL, NULL, '2024-08-01 11:55:12', '2024-08-01 11:55:12'),
(140, 'App\\Models\\User', 8, 'user', 'dde79490c4690b96d6d15452e8a7053da54c8c47ad19cdffddc66dc51b690f09', '[\"*\"]', NULL, NULL, '2024-08-01 11:56:51', '2024-08-01 11:56:51'),
(141, 'App\\Models\\User', 8, 'user', '5938d2182feb913cc4cbf69fbb74142d716f47d85ae642755dfdbe9b0d8606d1', '[\"*\"]', NULL, NULL, '2024-08-01 11:57:27', '2024-08-01 11:57:27'),
(142, 'App\\Models\\User', 68, 'user', '4817a2da3dffddc04e13c0f94407a6fcbfeb2db5238d8024dbe5e1d00696b66f', '[\"*\"]', NULL, NULL, '2024-08-01 12:48:21', '2024-08-01 12:48:21'),
(143, 'App\\Models\\User', 68, 'user', 'ddd2a334f244cb57cfdc47ebad0cad58620a556a31aec371bf3d5cca023fecb7', '[\"*\"]', NULL, NULL, '2024-08-03 08:36:03', '2024-08-03 08:36:03'),
(144, 'App\\Models\\User', 8, 'personal access tokens', '71d3c6170d2639d2b481c29c62b73bac536771e9f4e1d040a491aea5c69c8686', '[\"*\"]', '2024-08-03 11:57:31', NULL, '2024-08-03 11:03:08', '2024-08-03 11:57:31'),
(145, 'App\\Models\\User', 68, 'user', '91519795b6105d8f087b9fc057b73e0ffa6d86820ff0a8665fadbfce73ff49ee', '[\"*\"]', NULL, NULL, '2024-08-03 12:01:37', '2024-08-03 12:01:37'),
(146, 'App\\Models\\User', 8, 'user', '2655d670ffcc296efc50e3a73feef6386c69390f57bfd553a80d417432cbe553', '[\"*\"]', NULL, NULL, '2024-08-03 13:09:32', '2024-08-03 13:09:32'),
(147, 'App\\Models\\User', 68, 'user', 'e6cd9711aeb952a7aed59b1d47eca37055071d34106a4cc4d6795793fe154fbd', '[\"*\"]', NULL, NULL, '2024-08-04 07:40:16', '2024-08-04 07:40:16');

-- --------------------------------------------------------

--
-- Table structure for table `popup_pages`
--

CREATE TABLE `popup_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `popup_pages`
--

INSERT INTO `popup_pages` (`id`, `page_name`, `created_at`, `updated_at`) VALUES
(1, 'Home', NULL, NULL),
(2, 'Categories', NULL, NULL),
(3, 'Courses', NULL, NULL),
(4, 'Exams', NULL, NULL),
(5, 'Diagnostic Exam', NULL, NULL),
(6, 'Student Dashboard', NULL, NULL),
(7, 'Teacher Dashboard', NULL, NULL),
(8, 'Affilate User Dashboard', NULL, NULL),
(9, 'Question', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `popup_popup_pages`
--

CREATE TABLE `popup_popup_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `marketing_popup_id` bigint(20) UNSIGNED NOT NULL,
  `popup_page_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `popup_popup_pages`
--

INSERT INTO `popup_popup_pages` (`id`, `marketing_popup_id`, `popup_page_id`, `created_at`, `updated_at`) VALUES
(3, 3, 7, NULL, NULL),
(4, 2, 7, '2024-05-11', '2024-05-11'),
(5, 2, 4, '2024-05-11', '2024-05-11'),
(6, 5, 5, '2024-05-11', '2024-05-11'),
(7, 5, 6, '2024-05-11', '2024-05-11');

-- --------------------------------------------------------

--
-- Table structure for table `private_request`
--

CREATE TABLE `private_request` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `from` time NOT NULL,
  `to` time NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Confirm','Pendding','Rejected') NOT NULL DEFAULT 'Pendding',
  `rejected_reason` text DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `private_request`
--

INSERT INTO `private_request` (`id`, `user_id`, `date`, `from`, `to`, `teacher_id`, `status`, `rejected_reason`, `created_at`, `updated_at`) VALUES
(1, 5, '2023-11-08', '10:44:21', '12:45:21', 44, 'Confirm', NULL, NULL, '2024-02-13');

-- --------------------------------------------------------

--
-- Table structure for table `promo_chapters`
--

CREATE TABLE `promo_chapters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `promo_id` bigint(20) UNSIGNED NOT NULL,
  `chapter_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promo_chapters`
--

INSERT INTO `promo_chapters` (`id`, `promo_id`, `chapter_id`, `created_at`, `updated_at`) VALUES
(1, 6, 16, '2024-05-12 09:21:48', '2024-05-12 09:21:48'),
(2, 6, 18, '2024-05-12 09:21:48', '2024-05-12 09:21:48'),
(3, 8, 16, '2024-05-12 09:23:54', '2024-05-12 09:23:54'),
(4, 8, 19, '2024-05-12 09:23:54', '2024-05-12 09:23:54');

-- --------------------------------------------------------

--
-- Table structure for table `promo_codes`
--

CREATE TABLE `promo_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `discount` float NOT NULL DEFAULT 0,
  `starts` date DEFAULT NULL,
  `ends` date DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `num_usage` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promo_codes`
--

INSERT INTO `promo_codes` (`id`, `name`, `discount`, `starts`, `ends`, `code`, `num_usage`, `created_at`, `updated_at`) VALUES
(2, 'Promo 1', 25, '2024-01-02', '2024-08-09', '111', 115, NULL, '2024-07-11'),
(5, 'admin@gmail.com', 22, '2024-01-11', '2024-06-05', '22', 22, '2024-01-23', '2024-01-23'),
(6, 'Promo 2', 5, '2024-04-01', '2024-04-16', 'Promo 2', 22, '2024-04-01', '2024-05-12'),
(7, 'sad12', 2, '2024-05-07', '2024-05-17', '312', 22, '2024-05-12', '2024-05-12'),
(8, 'sad12', 2, '2024-05-07', '2024-05-17', '312', 22, '2024-05-12', '2024-05-12'),
(9, 'sda', 3, '2024-05-01', '2024-06-06', 'asd', 21, '2024-05-12', '2024-05-12'),
(10, 'asd', 10, '2024-07-03', '2024-07-05', 'asd', 0, '2024-07-03', '2024-07-03'),
(11, 'asd', 10, '2024-07-03', '2024-07-05', 'asd', 1, '2024-07-03', '2024-07-03'),
(12, 'asd', 10, '2024-07-03', '2024-07-05', 'asd', 1, '2024-07-03', '2024-07-03'),
(13, 'asd', 10, '2024-07-03', '2024-07-05', 'asd', 1, '2024-07-03', '2024-07-03');

-- --------------------------------------------------------

--
-- Table structure for table `promo_courses`
--

CREATE TABLE `promo_courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `promo_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promo_courses`
--

INSERT INTO `promo_courses` (`id`, `promo_id`, `course_id`, `created_at`, `updated_at`) VALUES
(6, 2, 1, '2024-01-23', '2024-01-23'),
(9, 2, 2, '2024-01-23', '2024-01-23'),
(12, 6, 1, '2024-05-12', '2024-05-12'),
(13, 6, 2, '2024-05-12', '2024-05-12'),
(16, 8, 1, '2024-05-12', '2024-05-12'),
(17, 8, 2, '2024-05-12', '2024-05-12'),
(18, 9, 1, '2024-05-12', '2024-05-12'),
(19, 10, 1, '2024-07-03', '2024-07-03'),
(20, 11, 1, '2024-07-03', '2024-07-03'),
(21, 12, 1, '2024-07-03', '2024-07-03'),
(22, 13, 1, '2024-07-03', '2024-07-03');

-- --------------------------------------------------------

--
-- Table structure for table `promo_packages`
--

CREATE TABLE `promo_packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `promo_id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promo_packages`
--

INSERT INTO `promo_packages` (`id`, `promo_id`, `package_id`, `created_at`, `updated_at`) VALUES
(1, 2, 3, NULL, NULL),
(2, 2, 3, NULL, NULL),
(3, 2, 4, NULL, NULL),
(4, 2, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `promo_users`
--

CREATE TABLE `promo_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `promo_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lesson_id` bigint(20) UNSIGNED NOT NULL,
  `question` text DEFAULT NULL,
  `state` enum('0','1','2') NOT NULL,
  `q_url` varchar(255) DEFAULT NULL,
  `q_code` varchar(255) DEFAULT NULL,
  `q_type` enum('Trail','Parallel','Extra') DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `q_num` varchar(20) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `section` enum('1','2','3','4') DEFAULT NULL,
  `difficulty` enum('A','B','C','D','E') NOT NULL,
  `ans_type` enum('MCQ','Grid_in') DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `lesson_id`, `question`, `state`, `q_url`, `q_code`, `q_type`, `month`, `q_num`, `year`, `section`, `difficulty`, `ans_type`, `updated_at`, `created_at`) VALUES
(1, 4, 'Question 2', '0', NULL, '2', 'Extra', 3, '2', 2022, '1', 'A', 'MCQ', '2024-06-27', '2024-01-29'),
(18, 4, NULL, '1', '2.png', '2', 'Parallel', 3, '2', 2022, '1', 'B', 'MCQ', '2024-02-05', NULL),
(19, 4, 'Question 2', '2', '2.png', '2', 'Trail', 3, '2', 2022, '1', 'A', 'MCQ', '2024-01-29', NULL),
(20, 4, 'question 2', '0', NULL, '2', 'Parallel', 3, '2', 2022, '2', 'A', 'MCQ', '2024-01-29', '2024-01-29'),
(21, 4, 'question 2', '0', NULL, '2', 'Parallel', 3, '2', 2022, '2', 'A', 'MCQ', '2024-01-29', '2024-01-29'),
(25, 4, '4 + 4 =', '0', NULL, '2', 'Trail', 4, '2', 2022, '1', 'A', 'Grid_in', NULL, NULL),
(27, 4, '<p>jhk</p>', '2', '2024X05X07X06X51X4575168.png', '2', 'Trail', 1, '2', 2015, '1', 'A', 'MCQ', '2024-05-07', '2024-05-07'),
(28, 4, '<p>212</p>', '2', '2024X05X11X09X10X278775592024X04X24X09X33X318032024X03X27X12X18X322024X02X19X07X46X506890202301101725mvf_dark_logo.png', '2', 'Trail', 3, '2', 2012, '1', 'A', 'MCQ', '2024-05-11', '2024-05-11'),
(29, 4, '<p>44 + 55</p>', '2', '2024X05X27X08X05X396064.png', '2', 'Trail', 7, '2', 2005, '1', 'A', 'MCQ', '2024-05-27', '2024-05-27'),
(30, 4, '<p>7 + 7</p>', '2', '2024X05X28X08X35X3514527.png', '2', 'Trail', 6, '2', 2023, '1', 'A', 'MCQ', '2024-05-28', '2024-05-28'),
(31, 4, '<p>7 + 7</p>', '2', '2024X05X28X08X36X5635847.png', '2', 'Trail', 6, '2', 2019, '2', 'A', 'MCQ', '2024-05-28', '2024-05-28'),
(32, 27, '<p>8-8</p>', '2', '2024X05X28X08X41X4344678.png', '3', 'Trail', 11, '2', 2007, '3', 'A', 'MCQ', '2024-05-28', '2024-05-28'),
(33, 4, '<p>7</p>', '2', '2024X05X28X08X44X3587717.png', '2', 'Trail', 9, '2', 2020, '1', 'A', 'MCQ', '2024-05-28', '2024-05-28'),
(34, 4, '<p>8 + 5</p>', '2', '2024X05X28X09X45X0357457.png', '2', 'Trail', 10, '2', 2022, '2', 'A', 'MCQ', '2024-05-28', '2024-05-28'),
(35, 4, '<p>6+6</p>', '2', '2024X05X28X09X47X4544926.png', '3', 'Trail', 9, '2', 2015, '2', 'A', 'MCQ', '2024-05-28', '2024-05-28'),
(36, 4, '<p>9-5</p>', '2', '2024X05X28X09X50X5436077.png', '3', 'Trail', 10, '2', 2021, '1', 'A', 'MCQ', '2024-05-28', '2024-05-28'),
(37, 4, '<p>7+9</p>', '2', '2024X05X28X11X09X5643026.png', '2', 'Trail', 6, '2', 2022, '1', 'A', 'MCQ', '2024-05-28', '2024-05-28'),
(38, 4, '<p>question</p>', '2', '2024X05X28X12X42X5335477.png', '2', 'Trail', 10, '2', 2013, NULL, 'A', 'MCQ', '2024-05-28', '2024-05-28'),
(39, 4, '<p>xfsdfd</p>', '2', '2024X05X30X11X55X3274447.png', '2', 'Trail', 11, '2', 2016, '1', 'A', 'MCQ', '2024-07-11', '2024-05-30'),
(40, 4, '<p>sd</p>', '0', NULL, '2', 'Trail', 1, '2', 2000, '1', 'A', 'MCQ', '2024-07-20', '2024-07-20'),
(41, 4, '<p>ewf</p>', '0', NULL, '2', 'Extra', 1, '2', 2000, '1', 'A', 'MCQ', '2024-07-23', '2024-07-20');

-- --------------------------------------------------------

--
-- Table structure for table `question_history`
--

CREATE TABLE `question_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `answer` tinyint(1) NOT NULL,
  `time` time DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question_history`
--

INSERT INTO `question_history` (`id`, `user_id`, `question_id`, `answer`, `time`, `created_at`, `updated_at`) VALUES
(1, 8, 1, 0, NULL, '2024-03-12 11:50:41', '2024-03-14 11:50:41'),
(2, 8, 1, 0, NULL, '2024-03-14 12:00:38', '2024-03-14 12:00:38'),
(3, 8, 1, 0, NULL, '2024-04-09 14:07:00', '2024-04-09 14:07:00'),
(4, 8, 1, 0, NULL, '2024-04-09 14:08:20', '2024-04-09 14:08:20'),
(5, 8, 1, 1, NULL, '2024-04-17 08:34:04', '2024-04-17 08:34:04'),
(6, 8, 25, 0, NULL, '2024-05-01 09:53:03', '2024-05-01 09:53:03'),
(7, 8, 1, 0, NULL, '2024-05-25 13:14:24', '2024-05-25 13:14:24'),
(8, 8, 1, 1, NULL, '2024-06-04 08:59:35', '2024-06-04 08:59:35'),
(9, 8, 1, 0, NULL, '2024-06-04 08:59:44', '2024-06-04 08:59:44'),
(10, 8, 1, 0, NULL, '2024-06-04 09:00:22', '2024-06-04 09:00:22'),
(11, 8, 1, 0, NULL, '2024-06-04 09:03:20', '2024-06-04 09:03:20'),
(12, 8, 1, 0, NULL, '2024-06-04 09:03:26', '2024-06-04 09:03:26'),
(13, 8, 1, 1, NULL, '2024-06-04 09:03:32', '2024-06-04 09:03:32'),
(14, 8, 1, 1, NULL, '2024-06-04 09:13:15', '2024-06-04 09:13:15'),
(15, 8, 1, 1, NULL, '2024-06-04 09:13:50', '2024-06-04 09:13:50'),
(16, 8, 1, 1, NULL, '2024-06-04 11:49:01', '2024-06-04 11:49:01'),
(17, 8, 1, 1, NULL, '2024-06-04 11:49:26', '2024-06-04 11:49:26'),
(18, 8, 1, 1, NULL, '2024-06-04 11:50:26', '2024-06-04 11:50:26'),
(19, 8, 1, 0, NULL, '2024-06-05 07:40:51', '2024-06-05 07:40:51'),
(20, 8, 1, 0, NULL, '2024-06-05 08:59:42', '2024-06-05 08:59:42'),
(21, 8, 18, 0, NULL, '2024-06-05 08:59:58', '2024-06-05 08:59:58'),
(22, 8, 18, 0, NULL, '2024-06-05 09:02:04', '2024-06-05 09:02:04'),
(23, 8, 1, 0, NULL, '2024-06-05 09:03:30', '2024-06-05 09:03:30'),
(24, 8, 1, 0, NULL, '2024-06-05 09:04:47', '2024-06-05 09:04:47'),
(25, 8, 1, 0, NULL, '2024-06-08 08:43:38', '2024-06-08 08:43:38'),
(26, 8, 1, 0, NULL, '2024-06-12 09:58:20', '2024-06-12 09:58:20'),
(27, 8, 1, 0, '00:00:00', '2024-06-12 10:45:12', '2024-06-12 10:45:12'),
(28, 8, 1, 0, '00:00:00', '2024-06-12 11:58:03', '2024-06-12 11:58:03'),
(29, 8, 1, 0, '00:00:00', '2024-06-19 15:42:16', '2024-06-19 15:42:16'),
(30, 8, 1, 0, '00:00:00', '2024-06-19 15:50:58', '2024-06-19 15:50:58'),
(31, 8, 1, 0, '00:00:00', '2024-06-19 15:52:28', '2024-06-19 15:52:28'),
(32, 8, 1, 0, '00:00:00', '2024-06-19 15:54:02', '2024-06-19 15:54:02'),
(33, 8, 1, 0, '00:00:00', '2024-06-19 15:59:30', '2024-06-19 15:59:30'),
(34, 8, 1, 0, '00:00:00', '2024-06-19 16:00:21', '2024-06-19 16:00:21'),
(35, 8, 1, 0, '00:00:00', '2024-06-19 16:02:54', '2024-06-19 16:02:54'),
(36, 8, 18, 0, '00:00:00', '2024-06-19 16:08:56', '2024-06-19 16:08:56'),
(37, 8, 19, 0, '00:00:00', '2024-07-08 12:34:41', '2024-07-08 12:34:41'),
(38, 8, 19, 0, '00:00:00', '2024-07-08 12:36:48', '2024-07-08 12:36:48'),
(39, 8, 25, 1, '00:00:06', '2024-07-09 11:00:54', '2024-07-09 11:00:54'),
(40, 8, 25, 1, '00:00:13', '2024-07-09 11:01:02', '2024-07-09 11:01:02'),
(41, 8, 25, 1, '00:00:06', '2024-07-09 11:01:15', '2024-07-09 11:01:15'),
(42, 8, 25, 0, '00:00:10', '2024-07-09 11:04:12', '2024-07-09 11:04:12'),
(43, 8, 25, 1, '00:00:31', '2024-07-09 11:06:28', '2024-07-09 11:06:28'),
(44, 8, 25, 0, '00:00:31', '2024-07-09 11:08:57', '2024-07-09 11:08:57'),
(45, 8, 25, 1, '00:00:38', '2024-07-09 11:09:06', '2024-07-09 11:09:06'),
(46, 8, 25, 0, '00:00:44', '2024-07-09 11:09:13', '2024-07-09 11:09:13'),
(47, 8, 1, 0, '00:00:00', '2024-07-13 14:34:00', '2024-07-13 14:34:00'),
(48, 8, 1, 0, '00:00:01', '2024-07-13 14:46:05', '2024-07-13 14:46:05'),
(49, 8, 1, 0, '00:00:01', '2024-07-13 14:48:31', '2024-07-13 14:48:31'),
(50, 8, 1, 0, '00:00:01', '2024-07-13 14:51:17', '2024-07-13 14:51:17'),
(51, 8, 1, 0, '00:00:01', '2024-07-13 14:51:48', '2024-07-13 14:51:48'),
(52, 8, 1, 0, '00:00:01', '2024-07-13 14:52:58', '2024-07-13 14:52:58'),
(53, 8, 1, 0, '00:00:01', '2024-07-13 14:53:42', '2024-07-13 14:53:42'),
(54, 8, 1, 0, '00:00:01', '2024-07-13 15:00:25', '2024-07-13 15:00:25'),
(55, 8, 1, 0, '00:00:01', '2024-07-13 15:02:09', '2024-07-13 15:02:09'),
(56, 8, 1, 0, '00:00:01', '2024-07-13 15:03:00', '2024-07-13 15:03:00'),
(57, 8, 25, 0, '00:00:00', '2024-07-14 11:00:24', '2024-07-14 11:00:24'),
(58, 8, 25, 0, '00:01:35', '2024-07-14 11:04:12', '2024-07-14 11:04:12'),
(59, 8, 25, 0, '00:01:35', '2024-07-14 11:04:20', '2024-07-14 11:04:20'),
(60, 8, 25, 1, NULL, '2024-07-20 10:24:11', '2024-07-20 10:24:11'),
(61, 8, 25, 1, '00:00:14', '2024-07-20 10:49:32', '2024-07-20 10:49:32'),
(62, 8, 25, 1, '00:00:14', '2024-07-20 10:50:05', '2024-07-20 10:50:05'),
(63, 8, 25, 1, '00:00:06', '2024-07-20 10:53:33', '2024-07-20 10:53:33'),
(64, 8, 25, 0, '00:00:06', '2024-07-20 10:53:43', '2024-07-20 10:53:43'),
(65, 8, 1, 1, NULL, '2024-07-22 09:51:49', '2024-07-22 09:51:49'),
(66, 8, 1, 1, NULL, '2024-07-22 09:53:01', '2024-07-22 09:53:01'),
(67, 8, 1, 0, NULL, '2024-07-22 09:58:35', '2024-07-22 09:58:35'),
(68, 8, 1, 0, NULL, '2024-07-22 09:59:11', '2024-07-22 09:59:11'),
(69, 8, 1, 0, NULL, '2024-07-22 09:59:34', '2024-07-22 09:59:34'),
(70, 8, 1, 0, NULL, '2024-07-22 10:02:15', '2024-07-22 10:02:15'),
(71, 8, 1, 0, NULL, '2024-07-22 10:05:29', '2024-07-22 10:05:29'),
(72, 8, 1, 0, NULL, '2024-07-27 16:12:38', '2024-07-27 16:12:38'),
(73, 8, 1, 0, NULL, '2024-07-27 16:14:42', '2024-07-27 16:14:42'),
(74, 8, 1, 0, NULL, '2024-07-27 16:28:43', '2024-07-27 16:28:43'),
(75, 8, 27, 0, NULL, '2024-07-27 16:29:05', '2024-07-27 16:29:05'),
(76, 8, 1, 0, '00:00:04', '2024-07-28 09:47:23', '2024-07-28 09:47:23'),
(77, 8, 18, 0, '00:00:02', '2024-08-01 12:12:16', '2024-08-01 12:12:16'),
(78, 8, 18, 0, NULL, '2024-08-01 12:26:51', '2024-08-01 12:26:51'),
(79, 8, 18, 0, NULL, '2024-08-01 12:27:42', '2024-08-01 12:27:42'),
(80, 8, 18, 0, NULL, '2024-08-01 12:28:06', '2024-08-01 12:28:06'),
(81, 8, 18, 0, NULL, '2024-08-01 12:29:13', '2024-08-01 12:29:13'),
(82, 8, 18, 0, NULL, '2024-08-01 12:29:34', '2024-08-01 12:29:34'),
(83, 8, 18, 0, NULL, '2024-08-01 12:29:53', '2024-08-01 12:29:53'),
(84, 8, 18, 0, NULL, '2024-08-01 12:31:30', '2024-08-01 12:31:30'),
(85, 8, 18, 0, NULL, '2024-08-01 12:42:09', '2024-08-01 12:42:09');

-- --------------------------------------------------------

--
-- Table structure for table `question_times`
--

CREATE TABLE `question_times` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `q_id` bigint(20) UNSIGNED NOT NULL,
  `time` datetime NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question_times`
--

INSERT INTO `question_times` (`id`, `user_id`, `q_id`, `time`, `created_at`, `updated_at`) VALUES
(1, 8, 1, '2024-02-26 09:43:38', '2024-02-26', '2024-02-26'),
(2, 8, 1, '2024-02-29 12:15:18', '2024-02-29', '2024-02-29'),
(3, 8, 18, '2024-02-29 12:16:37', '2024-02-29', '2024-02-29');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `pass_score` float DEFAULT NULL,
  `quizze_order` int(10) UNSIGNED NOT NULL,
  `lesson_id` bigint(20) UNSIGNED DEFAULT NULL,
  `state` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `title`, `description`, `time`, `score`, `pass_score`, `quizze_order`, `lesson_id`, `state`, `created_at`, `updated_at`) VALUES
(11, 'sa', 'ad', '1hours1M', 100, 48, 0, 4, 1, '2024-01-18', '2024-01-18'),
(12, 'sa', 'ad', '1hours1M', 100, 48, 0, 4, 1, '2024-01-18', '2024-01-18'),
(13, 'dfe', 'edfw', '1hours1M', 100, 48, 0, 4, 0, '2024-01-18', '2024-01-18'),
(14, 'da', NULL, '3hours3M', 1, 8, 0, 4, 0, '2024-01-20', '2024-01-20'),
(15, NULL, NULL, 'hoursM', NULL, NULL, 0, 4, 0, '2024-01-24', '2024-01-24'),
(18, 'adfw22', 'asd', '1Hours 1 M', 100, 22, 0, 4, 0, '2024-01-30', '2024-03-04'),
(19, 'sad', 'ds', '1hours1M', 100, 48, 0, 4, 0, '2024-01-30', '2024-01-30'),
(20, 'ffffff', 'ffff', '1hours1M', 100, 48, 0, 4, 0, '2024-01-31', '2024-01-31'),
(21, NULL, NULL, 'hoursM', NULL, NULL, 0, 4, 0, '2024-02-12', '2024-02-12'),
(22, 'lala', 'sfggdf', '1hours1M', 100, 8, 4, 4, 1, '2024-02-14', '2024-02-14'),
(23, 'lala', 'df', '1hours1M', 100, 48, 5, 4, 1, '2024-02-14', '2024-02-14'),
(24, 'lala', 'df', '1hours1M', 100, 48, 5, 4, 1, '2024-02-14', '2024-02-14'),
(25, 'lala', 'df', '1hours1M', 100, 48, 5, 4, 1, '2024-02-14', '2024-02-14'),
(26, 'lala', 'df', '1hours1M', 100, 48, 5, 4, 1, '2024-02-14', '2024-02-14'),
(29, 'nnnnn', 'nnnnn', '1hours1M', 100, 45, 2, 4, 1, '2024-03-31', '2024-03-31'),
(31, 'quiz 1', 'dfsgfdf', '1hours1M', 100, 48, 2, 22, 1, '2024-05-01', '2024-05-01'),
(32, 'quiz 1', 'asdf', '1hours1M', 100, 48, 1, 4, 1, '2024-05-01', '2024-07-25'),
(33, 'acds1', 'dfsd1', '1hours0M', 101, 41, 2, 4, 1, '2024-06-10', '2024-07-25');

-- --------------------------------------------------------

--
-- Table structure for table `quizze_stu_ans`
--

CREATE TABLE `quizze_stu_ans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `quizze_id` bigint(20) UNSIGNED NOT NULL,
  `stu_id` bigint(20) UNSIGNED NOT NULL,
  `answer` varchar(255) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quizze_stu_ans`
--

INSERT INTO `quizze_stu_ans` (`id`, `question_id`, `quizze_id`, `stu_id`, `answer`, `created_at`, `updated_at`) VALUES
(1, 18, 12, 8, 'answer 1', '2024-02-10', '2024-02-10'),
(2, 1, 12, 8, '2', '2024-02-10', '2024-02-10'),
(3, 18, 12, 8, 'answer 1', '2024-02-10', '2024-02-10'),
(4, 1, 12, 8, '2', '2024-02-10', '2024-02-10'),
(5, 18, 12, 8, 'answer 1', '2024-02-10', '2024-02-10'),
(6, 1, 12, 8, '2', '2024-02-10', '2024-02-10');

-- --------------------------------------------------------

--
-- Table structure for table `q_ans`
--

CREATE TABLE `q_ans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ans_pdf` varchar(255) DEFAULT NULL,
  `ans_video` varchar(255) DEFAULT NULL,
  `Q_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `q_ans`
--

INSERT INTO `q_ans` (`id`, `ans_pdf`, `ans_video`, `Q_id`, `created_at`, `updated_at`) VALUES
(3, '2023X12X24X11X56X40202301111020C5631746XA3DDX43F6XA634X158716ABFA8B.jpeg', 'https://www.youtube.com/embed/zoPyeFrnX3k?si=CpLpiNS2wNDvuGH1', 18, '2023-12-24', '2023-12-24'),
(4, '2023X12X24X11X58X17202301101901SnapchatX2011979818.jpg', 'https://www.youtube.com/embed/zoPyeFrnX3k?si=CpLpiNS2wNDvuGH1', 19, '2023-12-24', '2023-12-24'),
(5, '2023X12X24X11X58X17202301100931mvf_light_logo.png', 'https://www.youtube.com/embed/zoPyeFrnX3k?si=CpLpiNS2wNDvuGH1', 19, '2023-12-24', '2023-12-24'),
(6, '2023X12X25X14X16X59202301111020C5631746XA3DDX43F6XA634X158716ABFA8B.jpeg', 'https://www.youtube.com/embed/zoPyeFrnX3k?si=CpLpiNS2wNDvuGH1', 20, '2023-12-25', '2023-12-25'),
(7, '2023X12X25X14X18X43202301111011mvf_light_logo.png', 'https://www.youtube.com/embed/zoPyeFrnX3k?si=CpLpiNS2wNDvuGH1', 21, '2023-12-25', '2023-12-25'),
(8, '2023X12X26X11X07X34202301100934C5631746XA3DDX43F6XA634X158716ABFA8B.jpeg', 'https://www.youtube.com/embed/zoPyeFrnX3k?si=CpLpiNS2wNDvuGH1', 20, '2023-12-26', '2023-12-26'),
(9, '2023X12X26X11X10X38202301100934C5631746XA3DDX43F6XA634X158716ABFA8B.jpeg', 'https://www.youtube.com/embed/zoPyeFrnX3k?si=CpLpiNS2wNDvuGH1', 19, '2023-12-26', '2023-12-26'),
(10, '2024X01X24X09X46X176.jpg', '2024X01X24X09X46X17', 20, '2024-01-24', '2024-01-24'),
(11, '2024X01X24X11X10X516.jpg', '2024X01X24X11X10X516.jpg', 21, '2024-01-24', '2024-01-24'),
(12, '2024X01X29X08X53X504.png', '2024X01X29X08X53X505.png', 18, '2024-01-29', '2024-01-29'),
(13, '2024X02X03X11X43X2412.jpg', '2024X02X03X11X43X2412.jpg', 18, '2024-02-03', '2024-02-03'),
(14, '2024X02X03X11X44X3110.jpg', '2024X02X03X11X44X3110.jpg', 18, '2024-02-03', '2024-02-03'),
(15, '2024X02X03X11X46X449.jpg', '2024X02X03X11X46X449.jpg', 18, '2024-02-03', '2024-02-03'),
(20, 'www.', 'www.', 25, '2024-05-07', '2024-05-07'),
(21, 'www.', 'www.', 27, '2024-05-07', '2024-05-07'),
(22, 'vvv', 'vvv', 27, '2024-05-07', '2024-05-07'),
(25, '2024X05X11X09X10X2787vectorX1.png', 'sadas', 28, '2024-05-11', '2024-05-11'),
(37, '2024X05X27X13X15X1665898.png', 'www.ahmed.com', 29, '2024-05-27', '2024-05-27'),
(38, '2024X05X28X08X41X4353997.png', 'www.ahmed.com', 32, '2024-05-28', '2024-05-28'),
(39, '2024X05X28X08X44X3554818.png', 'www.ahmed.com', 33, '2024-05-28', '2024-05-28'),
(40, '2024X05X28X10X49X245676', 'www.ahmed.com', 36, '2024-05-28', '2024-05-28'),
(41, '2024X05X28X11X09X5671167.png', 'www.ahmed11.com', 37, '2024-05-28', '2024-05-28'),
(42, '2024X05X28X12X42X5366978.png', 'www.ahmed.com', 38, '2024-05-28', '2024-05-28'),
(58, '2024X06X27X15X22X512034', 'cvghfg', 1, '2024-06-27', '2024-06-27'),
(62, '2024X07X11X12X30X571939', 'https://us06web.zoom.us/j/86444846998?pwd=UkpFVNlkbVAvhRYTwrl0f6qdebaLFX.1', 39, '2024-07-11', '2024-07-11'),
(64, '2024X07X20X11X02X167304', 'adfsd', 40, '2024-07-20', '2024-07-20'),
(66, '2024X07X23X11X01X025064', 'sda', 41, '2024-07-23', '2024-07-23');

-- --------------------------------------------------------

--
-- Table structure for table `q_quizes`
--

CREATE TABLE `q_quizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quizze_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `q_quizes`
--

INSERT INTO `q_quizes` (`id`, `quizze_id`, `question_id`, `created_at`, `updated_at`) VALUES
(7, 12, 25, '2024-01-18', '2024-01-18'),
(8, 12, 18, '2024-01-18', '2024-01-18'),
(11, 12, 18, '2024-01-20', '2024-01-20'),
(49, 18, 18, '2024-01-30', '2024-01-30'),
(51, 19, 18, '2024-01-30', '2024-01-30'),
(52, 19, 19, '2024-01-30', '2024-01-30'),
(55, 20, 18, '2024-01-31', '2024-01-31'),
(56, 12, 19, '2024-01-31', '2024-01-31'),
(57, 12, 20, '2024-01-31', '2024-01-31'),
(60, 12, 1, '2024-01-31', '2024-01-31'),
(62, 14, 21, '2024-01-31', '2024-01-31'),
(63, 14, 19, '2024-01-31', '2024-01-31'),
(64, 14, 18, '2024-01-31', '2024-01-31'),
(163, 32, 1, '2024-07-25', '2024-07-25'),
(164, 32, 19, '2024-07-25', '2024-07-25'),
(165, 32, 18, '2024-07-25', '2024-07-25'),
(214, 33, 27, '2024-07-25', '2024-07-25'),
(215, 33, 21, '2024-07-25', '2024-07-25'),
(216, 33, 20, '2024-07-25', '2024-07-25'),
(217, 33, 29, '2024-07-25', '2024-07-25'),
(218, 33, 19, '2024-07-25', '2024-07-25'),
(219, 33, 25, '2024-07-25', '2024-07-25'),
(220, 33, 25, '2024-07-25', '2024-07-25'),
(221, 33, 18, '2024-07-25', '2024-07-25'),
(222, 33, 31, '2024-07-25', '2024-07-25'),
(223, 33, 31, '2024-07-25', '2024-07-25'),
(224, 33, 30, '2024-07-25', '2024-07-25'),
(225, 33, 30, '2024-07-25', '2024-07-25'),
(226, 33, 31, '2024-07-25', '2024-07-25'),
(227, 33, 36, '2024-07-25', '2024-07-25'),
(228, 33, 35, '2024-07-25', '2024-07-25'),
(229, 33, 28, '2024-07-25', '2024-07-25'),
(230, 33, 33, '2024-07-25', '2024-07-25'),
(231, 33, 33, '2024-07-25', '2024-07-25'),
(232, 33, 1, '2024-07-25', '2024-07-25'),
(233, 33, 18, '2024-07-25', '2024-07-25'),
(234, 33, 19, '2024-07-25', '2024-07-25'),
(235, 33, 21, '2024-07-25', '2024-07-25'),
(236, 33, 20, '2024-07-25', '2024-07-25'),
(237, 33, 25, '2024-07-25', '2024-07-25'),
(238, 33, 27, '2024-07-25', '2024-07-25');

-- --------------------------------------------------------

--
-- Table structure for table `report_questions`
--

CREATE TABLE `report_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `list_id` bigint(20) UNSIGNED NOT NULL,
  `statues` enum('pendding','inprogress','done') NOT NULL DEFAULT 'pendding',
  `details` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report_questions`
--

INSERT INTO `report_questions` (`id`, `date`, `user_id`, `question_id`, `list_id`, `statues`, `details`, `created_at`, `updated_at`) VALUES
(3, '2024-06-23', 8, 20, 1, 'pendding', NULL, '2024-06-23 12:15:16', '2024-06-23 12:15:16'),
(4, '2024-06-23', 8, 20, 2, 'pendding', NULL, '2024-06-23 12:15:19', '2024-06-23 12:15:19'),
(5, '2024-06-23', 8, 1, 1, 'pendding', NULL, '2024-06-23 12:18:11', '2024-06-23 12:18:11'),
(6, '2024-06-23', 8, 1, 2, 'pendding', NULL, '2024-06-23 12:19:57', '2024-06-23 12:19:57'),
(7, '2024-06-23', 8, 31, 1, 'pendding', NULL, '2024-06-23 12:20:39', '2024-06-23 12:20:39'),
(8, '2024-06-23', 8, 19, 1, 'pendding', NULL, '2024-06-23 12:22:34', '2024-06-23 12:22:34'),
(9, '2024-06-23', 8, 19, 2, 'pendding', NULL, '2024-06-23 12:23:10', '2024-06-23 12:23:10'),
(10, '2024-06-23', 8, 20, 1, 'pendding', NULL, '2024-06-23 12:39:25', '2024-06-23 12:39:25'),
(11, '2024-06-23', 8, 18, 2, 'pendding', NULL, '2024-06-23 12:40:21', '2024-06-23 12:40:21');

-- --------------------------------------------------------

--
-- Table structure for table `report_question_lists`
--

CREATE TABLE `report_question_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `list` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report_question_lists`
--

INSERT INTO `report_question_lists` (`id`, `list`, `created_at`, `updated_at`) VALUES
(1, 'Error 1', NULL, NULL),
(2, 'Error 2', NULL, '2024-04-16 12:03:57'),
(5, 'Error 3', '2024-04-17 08:29:22', '2024-04-17 09:18:55');

-- --------------------------------------------------------

--
-- Table structure for table `report_videos`
--

CREATE TABLE `report_videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `lesson_video_id` bigint(20) UNSIGNED DEFAULT NULL,
  `q_video_id` bigint(20) UNSIGNED DEFAULT NULL,
  `list_id` bigint(20) UNSIGNED NOT NULL,
  `statues` enum('pendding','inprogress','done') NOT NULL DEFAULT 'pendding',
  `details` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report_videos`
--

INSERT INTO `report_videos` (`id`, `date`, `user_id`, `lesson_video_id`, `q_video_id`, `list_id`, `statues`, `details`, `created_at`, `updated_at`) VALUES
(18, '2024-06-19', 8, NULL, 12, 1, 'pendding', NULL, '2024-06-19 16:09:07', '2024-06-19 16:09:07'),
(19, '2024-06-19', 8, NULL, 13, 2, 'pendding', NULL, '2024-06-19 16:09:39', '2024-06-19 16:09:39'),
(20, '2024-06-19', 8, NULL, 3, 2, 'pendding', NULL, '2024-06-19 16:10:15', '2024-06-19 16:10:15'),
(21, '2024-07-09', 8, NULL, 3, 2, 'pendding', NULL, '2024-07-09 11:13:28', '2024-07-09 11:13:28'),
(22, '2024-07-13', 8, NULL, 58, 2, 'pendding', NULL, '2024-07-13 15:02:51', '2024-07-13 15:02:51'),
(23, '2024-07-14', 8, NULL, 3, 1, 'pendding', NULL, '2024-07-14 11:39:45', '2024-07-14 11:39:45'),
(24, '2024-07-14', 8, NULL, 21, 1, 'pendding', NULL, '2024-07-14 11:43:08', '2024-07-14 11:43:08');

-- --------------------------------------------------------

--
-- Table structure for table `report_video_lists`
--

CREATE TABLE `report_video_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `list` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report_video_lists`
--

INSERT INTO `report_video_lists` (`id`, `list`, `created_at`, `updated_at`) VALUES
(1, 'Error 11', '2024-04-17 10:21:42', '2024-04-17 08:48:06'),
(2, 'Error 22', '2024-04-17 10:21:42', '2024-04-17 10:21:42'),
(4, 'Error 33', '2024-04-17 08:51:49', '2024-04-17 08:51:49');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `score_list`
--

CREATE TABLE `score_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `score_id` bigint(20) UNSIGNED NOT NULL,
  `question_num` int(11) NOT NULL,
  `score` float NOT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `score_list`
--

INSERT INTO `score_list` (`id`, `score_id`, `question_num`, `score`, `updated_at`, `created_at`) VALUES
(47, 5, 1, 2, '2024-02-25', '2024-02-25'),
(48, 5, 2, 5, '2024-02-25', '2024-02-25'),
(49, 7, 1, 2, '2024-05-05', '2024-05-05'),
(50, 7, 2, 3, '2024-05-05', '2024-05-05'),
(51, 8, 1, 1, '2024-05-05', '2024-05-05'),
(52, 8, 2, 2, '2024-05-05', '2024-05-05'),
(143, 4, 1, 22, '2024-06-09', '2024-06-09'),
(144, 4, 2, 3, '2024-06-09', '2024-06-09'),
(145, 4, 3, 4, '2024-06-09', '2024-06-09'),
(146, 4, 4, 5, '2024-06-09', '2024-06-09'),
(147, 4, 5, 5, '2024-06-09', '2024-06-09'),
(148, 4, 6, 6, '2024-06-09', '2024-06-09'),
(149, 4, 7, 8, '2024-06-09', '2024-06-09'),
(150, 4, 8, 8, '2024-06-09', '2024-06-09'),
(151, 4, 9, 8, '2024-06-09', '2024-06-09'),
(152, 4, 10, 9, '2024-06-09', '2024-06-09'),
(153, 4, 11, 11, '2024-06-09', '2024-06-09'),
(154, 4, 12, 21, '2024-06-09', '2024-06-09'),
(155, 4, 13, 21, '2024-06-09', '2024-06-09'),
(156, 4, 14, 21, '2024-06-09', '2024-06-09'),
(157, 4, 15, 12, '2024-06-09', '2024-06-09'),
(158, 4, 16, 12, '2024-06-09', '2024-06-09'),
(159, 4, 17, 32, '2024-06-09', '2024-06-09'),
(160, 4, 18, 32, '2024-06-09', '2024-06-09'),
(161, 4, 19, 32, '2024-06-09', '2024-06-09'),
(162, 4, 20, 23, '2024-06-09', '2024-06-09'),
(163, 4, 21, 32, '2024-06-09', '2024-06-09'),
(164, 4, 22, 23, '2024-06-09', '2024-06-09'),
(165, 4, 23, 23, '2024-06-09', '2024-06-09'),
(166, 4, 24, 43, '2024-06-09', '2024-06-09'),
(167, 4, 25, 34, '2024-06-09', '2024-06-09'),
(168, 4, 26, 45, '2024-06-09', '2024-06-09'),
(169, 4, 27, 45, '2024-06-09', '2024-06-09'),
(170, 4, 28, 45, '2024-06-09', '2024-06-09'),
(171, 4, 29, 45, '2024-06-09', '2024-06-09'),
(172, 4, 30, 45, '2024-06-09', '2024-06-09'),
(173, 4, 31, 45, '2024-06-09', '2024-06-09'),
(174, 4, 32, 54, '2024-06-09', '2024-06-09'),
(175, 4, 33, 45, '2024-06-09', '2024-06-09'),
(176, 4, 34, 45, '2024-06-09', '2024-06-09'),
(177, 4, 35, 54, '2024-06-09', '2024-06-09'),
(178, 4, 36, 56, '2024-06-09', '2024-06-09'),
(179, 4, 37, 56, '2024-06-09', '2024-06-09'),
(180, 4, 38, 65, '2024-06-09', '2024-06-09'),
(181, 4, 39, 76, '2024-06-09', '2024-06-09'),
(182, 4, 40, 76, '2024-06-09', '2024-06-09'),
(183, 4, 41, 76, '2024-06-09', '2024-06-09'),
(184, 4, 42, 76, '2024-06-09', '2024-06-09'),
(185, 4, 43, 78, '2024-06-09', '2024-06-09'),
(186, 4, 44, 78, '2024-06-09', '2024-06-09'),
(187, 4, 45, 100, '2024-06-09', '2024-06-09'),
(204, 9, 1, 1, '2024-07-22', '2024-07-22'),
(205, 9, 2, 2, '2024-07-22', '2024-07-22'),
(206, 9, 3, 3, '2024-07-22', '2024-07-22'),
(207, 9, 4, 4, '2024-07-22', '2024-07-22'),
(255, 2, 1, 1, '2024-07-22', '2024-07-22'),
(256, 2, 2, 1, '2024-07-22', '2024-07-22'),
(257, 2, 3, 3, '2024-07-22', '2024-07-22'),
(258, 2, 4, 4, '2024-07-22', '2024-07-22'),
(259, 2, 5, 445, '2024-07-22', '2024-07-22'),
(260, 10, 1, 1, '2024-07-24', '2024-07-24'),
(261, 10, 2, 2, '2024-07-24', '2024-07-24'),
(262, 10, 3, 3, '2024-07-24', '2024-07-24'),
(263, 11, 1, 1, '2024-07-24', '2024-07-24'),
(264, 11, 2, 1, '2024-07-24', '2024-07-24'),
(265, 11, 3, 1, '2024-07-24', '2024-07-24'),
(266, 11, 4, 1, '2024-07-24', '2024-07-24');

-- --------------------------------------------------------

--
-- Table structure for table `score_sheet`
--

CREATE TABLE `score_sheet` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `score` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `score_sheet`
--

INSERT INTO `score_sheet` (`id`, `name`, `course_id`, `score`, `created_at`, `updated_at`) VALUES
(2, 'vd3', 1, 33, '2024-02-18', '2024-07-22'),
(3, 'vd1', 2, 100, '2024-02-18', '2024-02-18'),
(4, 'video 4', 2, 90, '2024-02-18', '2024-06-09'),
(5, 'asdf', 1, 100, '2024-02-25', '2024-02-25'),
(6, 'score', 1, 80, '2024-05-05', '2024-05-05'),
(7, 'score', 1, 80, '2024-05-05', '2024-05-05'),
(8, 'sdf', 1, 111, '2024-05-05', '2024-05-05'),
(9, 'asd', 1, 100, '2024-07-22', '2024-07-22'),
(10, 'fdg', 1, 100, '2024-07-24', '2024-07-24'),
(11, 'tttt', 1, 100, '2024-07-24', '2024-07-24');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `link` varchar(255) NOT NULL,
  `material_link` varchar(255) DEFAULT NULL,
  `from` time NOT NULL,
  `to` time NOT NULL,
  `duration` int(11) DEFAULT NULL,
  `lesson_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` enum('group','private','session') NOT NULL,
  `price` float DEFAULT NULL,
  `access_dayes` int(11) DEFAULT NULL,
  `repeat` enum('Once','Repeat') DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `name`, `date`, `link`, `material_link`, `from`, `to`, `duration`, `lesson_id`, `teacher_id`, `group_id`, `type`, `price`, `access_dayes`, `repeat`, `created_at`, `updated_at`) VALUES
(4, 'sa', '2024-09-11', 'https://www.link.com', 'https://www.link.com', '11:00:00', '14:12:00', 11, 4, 71, NULL, 'group', 222, 13, 'Repeat', '2024-01-15', '2024-01-24'),
(6, 'session', '2024-06-08', 'https://www.link.com', 'https://www.link.com', '00:51:00', '11:55:00', 0, 4, 71, NULL, 'private', 22, 13, 'Once', '2024-01-24', '2024-01-24'),
(8, 'dfg', '2024-09-05', 'https://www.link.com', 'https://www.link.com', '10:47:00', '10:48:00', 0, 4, 71, NULL, 'session', 200, 13, 'Once', '2024-01-27', '2024-01-27'),
(10, 'ewr', '2024-09-05', 'https://www.link.com', 'https://www.link.com', '10:00:00', '10:01:00', 0, 4, 1, NULL, 'session', 22, 13, 'Once', '2024-01-27', '2024-01-27'),
(11, 'mohamed yasen', '2024-02-01', 'https://www.link.com', 'https://www.link.com', '16:06:00', '16:06:00', 0, 4, 1, 1, 'group', NULL, NULL, 'Once', '2024-02-04', '2024-02-04'),
(12, 'admin@gmail.com', '2024-02-06', 'https://www.link.com', 'sdss', '09:31:00', '11:32:00', 0, 4, 1, 1, 'group', NULL, NULL, 'Once', '2024-02-05', '2024-02-05'),
(13, 'vd1', '2024-02-22', 'https://www.link.com', 'sdss', '10:43:00', '10:43:00', 0, 4, 1, 1, 'group', NULL, NULL, 'Once', '2024-02-05', '2024-02-05'),
(14, 'rtr', '2024-02-23', 'https://www.link.com', NULL, '10:53:00', '10:52:00', 0, 4, 1, 1, 'group', NULL, NULL, 'Once', '2024-02-05', '2024-02-05'),
(15, 'rtr', '2024-02-23', 'https://www.link.com', NULL, '10:53:00', '10:52:00', 0, 4, 1, 1, 'group', NULL, NULL, 'Once', '2024-02-05', '2024-02-05'),
(18, 'fdfh', '2024-03-28', 'https//:-www.link.com', 'https//:-www.link.com', '13:45:00', '13:46:00', 2, 4, 1, 1, 'private', NULL, NULL, 'Repeat', '2024-03-31', '2024-03-31'),
(19, 'dddddd1111111', '2024-06-09', 'sdad', 'sdss', '15:48:00', '14:47:00', 1111, 4, 1, 1, 'private', NULL, NULL, 'Once', '2024-03-31', '2024-03-31'),
(20, 'vd1', '2024-06-01', 'tytfhg', 'hfghfgh', '16:31:00', '16:34:00', 2, 4, 1, NULL, 'private', NULL, NULL, 'Once', '2024-04-09', '2024-04-09'),
(21, 'asdfs', '2024-05-21', 'vbfghb', 'gfhfghf', '15:05:00', '15:08:00', NULL, 4, 11, 1, 'group', NULL, NULL, NULL, '2024-05-10', '2024-05-10'),
(22, 'rter', '2024-05-08', 'df', 'sfdr', '21:19:00', '21:16:00', NULL, 4, 71, 8, 'group', NULL, NULL, NULL, '2024-05-23', '2024-05-23'),
(23, 'df', '2024-06-06', 'https://us06web.zoom.us/j/86444846998?pwd=UkpFVNlkbVAvhRYTwrl0f6qdebaLFX.1', 'https://us06web.zoom.us/j/86444846998?pwd=UkpFVNlkbVAvhRYTwrl0f6qdebaLFX.1', '16:31:00', '16:29:00', NULL, 4, 71, 1, 'group', NULL, NULL, NULL, '2024-06-05', '2024-06-05'),
(24, 'zzzzzz', '2024-07-24', 'scsd', 'dsfsdfd', '11:12:00', '11:15:00', NULL, 4, 71, 1, 'group', NULL, NULL, NULL, '2024-07-21', '2024-08-01'),
(25, 'rizk', '2024-07-25', 'efsfgrg', 'rgdrgdfgfd', '17:19:00', '17:28:00', NULL, 4, 71, NULL, 'private', NULL, NULL, NULL, '2024-07-24', '2024-08-01'),
(26, 'session 1', '2024-08-09', 'gdfgdf', 'efg', '13:57:00', '13:59:00', NULL, 4, 71, NULL, 'session', NULL, NULL, NULL, '2024-08-01', '2024-08-01');

-- --------------------------------------------------------

--
-- Table structure for table `session_attendance`
--

CREATE TABLE `session_attendance` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `session_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `session_attendance`
--

INSERT INTO `session_attendance` (`id`, `user_id`, `session_id`, `created_at`, `updated_at`) VALUES
(4, 8, 4, '2024-05-15', NULL),
(5, 8, 19, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `session_days`
--

CREATE TABLE `session_days` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_id` bigint(20) UNSIGNED NOT NULL,
  `day` varchar(255) NOT NULL,
  `times` int(11) DEFAULT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `session_days`
--

INSERT INTO `session_days` (`id`, `session_id`, `day`, `times`, `created_at`, `updated_at`) VALUES
(1, 3, 'SaturDay', NULL, '2024-01-14', '2024-01-14'),
(2, 3, 'SunDay', NULL, '2024-01-14', '2024-01-14'),
(3, 3, 'MonDay', NULL, '2024-01-14', '2024-01-14'),
(4, 4, 'SaturDay', 6, '2024-01-15', '2024-01-15'),
(5, 4, 'SunDay', 6, '2024-01-15', '2024-01-15'),
(6, 4, 'MonDay', 6, '2024-01-15', '2024-01-15'),
(7, 5, 'SunDay', NULL, '2024-01-15', '2024-01-15'),
(8, 5, 'MonDay', NULL, '2024-01-15', '2024-01-15'),
(9, 5, 'TuesDay', NULL, '2024-01-15', '2024-01-15'),
(10, 9, 'SaturDay', 2, '2024-01-27', '2024-01-27'),
(11, 9, 'SunDay', 2, '2024-01-27', '2024-01-27');

-- --------------------------------------------------------

--
-- Table structure for table `session_groups`
--

CREATE TABLE `session_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `session_groups`
--

INSERT INTO `session_groups` (`id`, `name`, `teacher_id`, `state`, `created_at`, `updated_at`) VALUES
(1, 'group1', 1, 1, NULL, '2024-05-08'),
(5, 'mohamed yasen', 1, 1, '2024-01-27', '2024-01-27'),
(7, 'vd1', 8, 1, '2024-03-31', '2024-03-31'),
(8, 'my group 1', 11, 0, '2024-05-08', '2024-06-06'),
(9, 'asdds', 11, 1, '2024-06-06', '2024-06-06');

-- --------------------------------------------------------

--
-- Table structure for table `session_students`
--

CREATE TABLE `session_students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `session_students`
--

INSERT INTO `session_students` (`id`, `session_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 20, 8, '2024-05-25', '2024-05-25'),
(3, 6, 8, '2024-05-25', '2024-05-25'),
(6, 25, 8, '2024-08-01', '2024-08-01'),
(7, 24, 8, '2024-08-01', '2024-08-01');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slider_img` varchar(255) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `slider_img`, `created_at`, `updated_at`) VALUES
(1, '2942024X03X25X13X19X182024X02X19X07X47X0129202301101725mvf_dark_logo.png', NULL, '2024-03-25'),
(2, '2.png', NULL, NULL),
(3, '3.png', NULL, NULL),
(4, '4.png', NULL, NULL),
(5, '5.png', NULL, NULL),
(6, '6.png', NULL, NULL),
(7, '7.png', NULL, NULL),
(8, '3182024X03X25X13X30X122024X02X19X07X47X0129202301101725mvf_dark_logo.png', '2024-03-25', '2024-03-25');

-- --------------------------------------------------------

--
-- Table structure for table `small_packages`
--

CREATE TABLE `small_packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `module` enum('Exam','Question','Live') NOT NULL,
  `number` int(11) NOT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `small_packages`
--

INSERT INTO `small_packages` (`id`, `user_id`, `admin_id`, `module`, `number`, `updated_at`, `created_at`) VALUES
(1, 8, 1, 'Live', 2, '2024-06-09', '2024-03-21'),
(2, 68, 1, 'Exam', 0, '2024-03-23', '2024-03-23'),
(3, 1, 1, 'Exam', 11, '2024-04-09', '2024-04-09'),
(4, 8, 68, 'Exam', 0, '2024-06-04', '2024-05-04'),
(5, 8, 68, 'Exam', 0, '2024-06-04', '2024-05-12'),
(6, 8, 68, 'Exam', 0, '2024-06-04', '2024-05-12'),
(7, 8, 68, 'Exam', 0, '2024-06-04', '2024-05-12'),
(8, 59, 68, 'Question', 7, '2024-05-12', '2024-05-12'),
(9, 59, 68, 'Question', 7, '2024-05-12', '2024-05-12'),
(10, 72, 68, 'Live', 5, '2024-05-12', '2024-05-12'),
(11, 72, 68, 'Live', 5, '2024-05-12', '2024-05-12'),
(12, 72, 68, 'Live', 5, '2024-05-12', '2024-05-12'),
(13, 73, 68, 'Question', 3, '2024-05-12', '2024-05-12');

-- --------------------------------------------------------

--
-- Table structure for table `student_quizzes`
--

CREATE TABLE `student_quizzes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `lesson_id` bigint(20) UNSIGNED NOT NULL,
  `quizze_id` bigint(20) UNSIGNED NOT NULL,
  `score` int(11) NOT NULL,
  `time` time NOT NULL,
  `r_questions` int(11) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_quizzes`
--

INSERT INTO `student_quizzes` (`id`, `date`, `student_id`, `lesson_id`, `quizze_id`, `score`, `time`, `r_questions`, `created_at`, `updated_at`) VALUES
(1, '2024-07-14', 8, 4, 12, 0, '00:00:00', 0, '2024-07-14', '2024-07-14'),
(2, '2024-07-14', 8, 4, 12, 0, '00:00:00', 0, '2024-07-14', '2024-07-14'),
(3, '2024-07-14', 8, 4, 12, 0, '00:00:00', 0, '2024-07-14', '2024-07-14'),
(4, '2024-07-14', 8, 4, 12, 0, '00:00:00', 0, '2024-07-14', '2024-07-14'),
(5, '2024-07-14', 8, 4, 12, 0, '00:00:00', 0, '2024-07-14', '2024-07-14'),
(6, '2024-07-14', 8, 4, 12, 0, '00:00:00', 0, '2024-07-14', '2024-07-14'),
(7, '2024-07-14', 8, 4, 12, 0, '00:00:00', 0, '2024-07-14', '2024-07-14'),
(8, '2024-07-14', 8, 4, 12, 0, '00:00:00', 0, '2024-07-14', '2024-07-14'),
(9, '2024-07-14', 8, 4, 12, 0, '00:00:00', 0, '2024-07-14', '2024-07-14'),
(10, '2024-07-14', 8, 4, 12, 0, '00:00:00', 0, '2024-07-14', '2024-07-14'),
(11, '2024-07-14', 8, 4, 12, 0, '00:00:00', 0, '2024-07-14', '2024-07-14'),
(12, '2024-07-14', 8, 4, 12, 0, '00:00:00', 0, '2024-07-14', '2024-07-14'),
(13, '2024-07-14', 8, 4, 12, 0, '00:00:00', 0, '2024-07-14', '2024-07-14'),
(14, '2024-07-14', 8, 4, 12, 0, '00:00:00', 0, '2024-07-14', '2024-07-14'),
(15, '2024-07-20', 8, 4, 12, 17, '00:00:04', 1, '2024-07-20', '2024-07-20'),
(16, '2024-07-22', 8, 4, 12, 17, '00:00:00', 1, '2024-07-22', '2024-07-22'),
(17, '2024-07-24', 8, 4, 12, 0, '00:00:00', 0, '2024-07-24', '2024-07-24'),
(18, '2024-07-24', 8, 4, 12, 0, '00:00:03', 0, '2024-07-24', '2024-07-24'),
(19, '2024-07-24', 8, 4, 12, 0, '00:00:00', 0, '2024-07-24', '2024-07-24'),
(20, '2024-07-24', 8, 4, 12, 0, '00:00:04', 0, '2024-07-24', '2024-07-24'),
(21, '2024-07-24', 8, 4, 12, 0, '00:00:58', 0, '2024-07-24', '2024-07-24'),
(22, '2024-07-24', 8, 4, 12, 0, '00:00:02', 0, '2024-07-24', '2024-07-24'),
(23, '2024-07-24', 8, 4, 12, 0, '00:00:05', 0, '2024-07-24', '2024-07-24'),
(24, '2024-07-24', 8, 4, 12, 0, '00:00:09', 0, '2024-07-24', '2024-07-24'),
(25, '2024-07-24', 8, 4, 12, 0, '00:00:22', 0, '2024-07-24', '2024-07-24'),
(26, '2024-07-27', 8, 4, 12, 17, '00:00:06', 1, '2024-07-27', '2024-07-27'),
(27, '2024-07-27', 8, 4, 12, 0, '00:00:08', 0, '2024-07-27', '2024-07-27'),
(28, '2024-07-27', 8, 4, 12, 17, '00:00:04', 1, '2024-07-27', '2024-07-27'),
(29, '2024-07-27', 8, 4, 12, 0, '00:00:02', 0, '2024-07-27', '2024-07-27'),
(30, '2024-07-27', 8, 4, 12, 0, '00:00:01', 0, '2024-07-27', '2024-07-27'),
(31, '2024-07-27', 8, 4, 12, 0, '00:00:23', 0, '2024-07-27', '2024-07-27');

-- --------------------------------------------------------

--
-- Table structure for table `student_quizze_mistakes`
--

CREATE TABLE `student_quizze_mistakes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `student_quizze_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_quizze_mistakes`
--

INSERT INTO `student_quizze_mistakes` (`id`, `question_id`, `student_quizze_id`, `created_at`, `updated_at`) VALUES
(1, 18, 28, '2024-07-27', '2024-07-27'),
(2, 19, 28, '2024-07-27', '2024-07-27'),
(3, 20, 28, '2024-07-27', '2024-07-27'),
(4, 1, 28, '2024-07-27', '2024-07-27'),
(5, 25, 28, '2024-07-27', '2024-07-27'),
(6, 18, 29, '2024-07-27', '2024-07-27'),
(7, 18, 29, '2024-07-27', '2024-07-27'),
(8, 19, 29, '2024-07-27', '2024-07-27'),
(9, 20, 29, '2024-07-27', '2024-07-27'),
(10, 1, 29, '2024-07-27', '2024-07-27'),
(11, 25, 29, '2024-07-27', '2024-07-27'),
(12, 18, 30, '2024-07-27', '2024-07-27'),
(13, 18, 30, '2024-07-27', '2024-07-27'),
(14, 19, 30, '2024-07-27', '2024-07-27'),
(15, 20, 30, '2024-07-27', '2024-07-27'),
(16, 1, 30, '2024-07-27', '2024-07-27'),
(17, 25, 30, '2024-07-27', '2024-07-27'),
(18, 18, 31, '2024-07-27', '2024-07-27'),
(19, 18, 31, '2024-07-27', '2024-07-27'),
(20, 19, 31, '2024-07-27', '2024-07-27'),
(21, 20, 31, '2024-07-27', '2024-07-27'),
(22, 1, 31, '2024-07-27', '2024-07-27'),
(23, 25, 31, '2024-07-27', '2024-07-27');

-- --------------------------------------------------------

--
-- Table structure for table `student_sessions`
--

CREATE TABLE `student_sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_sessions`
--

INSERT INTO `student_sessions` (`id`, `course_id`, `student_id`, `created_at`, `updated_at`) VALUES
(23, 1, 8, '2024-04-30', '2024-04-30'),
(24, 1, 8, '2024-04-30', '2024-04-30'),
(25, 1, 8, '2024-05-02', '2024-05-02'),
(26, 1, 8, '2024-05-02', '2024-05-02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sessions`
--

CREATE TABLE `tbl_sessions` (
  `id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_courses`
--

CREATE TABLE `teacher_courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_courses`
--

INSERT INTO `teacher_courses` (`id`, `user_id`, `course_id`, `created_at`, `updated_at`) VALUES
(3, 71, 1, '2024-05-23 14:42:31', '2024-05-23 14:42:31'),
(10, 95, 2, '2024-06-12 16:35:36', '2024-06-12 16:35:36');

-- --------------------------------------------------------

--
-- Table structure for table `teacher__courses`
--

CREATE TABLE `teacher__courses` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usage_promo`
--

CREATE TABLE `usage_promo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `promo_id` bigint(20) UNSIGNED NOT NULL,
  `promo` varchar(255) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usage_promo`
--

INSERT INTO `usage_promo` (`id`, `user_id`, `promo_id`, `promo`, `created_at`, `updated_at`) VALUES
(16, 8, 2, '111', '2024-07-11', '2024-07-11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `f_name` varchar(255) DEFAULT NULL,
  `l_name` varchar(255) DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `nick_name` varchar(255) DEFAULT NULL,
  `email` varchar(191) NOT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(191) NOT NULL,
  `parent_phone` varchar(191) DEFAULT NULL,
  `parent_email` varchar(191) DEFAULT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'default.png',
  `city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `position` enum('user_admin','admin','student','teacher','affilate') NOT NULL,
  `user_admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `grade` varchar(20) DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `state` enum('hidden','Show') NOT NULL,
  `avatar` varchar(191) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `extra_email` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login_at` datetime DEFAULT NULL,
  `last_login_ip` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `f_name`, `l_name`, `name`, `nick_name`, `email`, `profile_photo_path`, `email_verified_at`, `phone`, `parent_phone`, `parent_email`, `image`, `city_id`, `position`, `user_admin_id`, `grade`, `course_id`, `category_id`, `password`, `state`, `avatar`, `remember_token`, `extra_email`, `deleted_at`, `created_at`, `updated_at`, `last_login_at`, `last_login_ip`) VALUES
(1, 'Mohammed', 'Yahia', 'Ahmed', 'Ahmed', 'Ahmed@gmail.com', NULL, NULL, '0113443534', '012345346', 'Ali@gmail.com', '1972024X01X27X10X03X326.jpg', NULL, 'admin', NULL, NULL, 2, 1, '$2y$10$O4pDFFvEQGAkfZ.mcGIhaOb0MQCocleYwEySm4OYgq9./pKT021de', 'Show', NULL, NULL, NULL, NULL, NULL, '2024-01-27 08:03:32', NULL, NULL),
(5, 'Ahmed', 'Yahia', 'affilate', 'Ahmed1', 'affilate@gmail.com', NULL, NULL, '01063546545', NULL, NULL, '9362024X04X26X11X56X262.png', NULL, 'affilate', NULL, NULL, NULL, NULL, '$2y$10$CObD/nCljL5PpIad0fMwpe.jZVBdNwmn9HPt4xDpOnzgG2JjeMXFO', 'Show', NULL, NULL, NULL, NULL, '2023-12-18 09:42:45', '2024-05-13 11:21:18', NULL, NULL),
(8, 'Mohammed2', 'Yahia2', 'student', 'Rizk', 'student@gmail.com', NULL, NULL, '123234556', NULL, NULL, '7452024X02X19X09X11X19202301101725mvf_dark_logo.png', NULL, 'student', NULL, NULL, NULL, NULL, '$2y$10$9Z4Y/RglhKwbQI4VD8Zeuu7GYyOVSAHiadvz2yNgWMKwdA62SRhTC', 'Show', NULL, NULL, NULL, NULL, '2023-12-18 09:44:14', '2024-06-09 14:02:43', NULL, NULL),
(11, 'Mohammed', 'Yahia', 'Teacher12', 'Ahmed', 'teacher2@gmail.com', NULL, NULL, '01099475854', NULL, NULL, '2023X12X18X11X52X277966202304090932egyptXflagXwaveXiconX32.png', NULL, 'teacher', NULL, NULL, 1, 1, '$2y$10$Y4fg1B5EpujC8OVSCO6fNOyxdAj2lPJDZWibbtD8j55Jik6fU4Uq6', 'Show', NULL, NULL, NULL, NULL, '2023-12-18 09:52:27', '2024-02-05 10:45:46', NULL, NULL),
(44, 'Mohammed', 'Yahia', 'admin@gmail.com', 'Ahmed', 'sad@gmail.com', NULL, NULL, '123', '123', NULL, 'default.png', NULL, 'student', 9, NULL, NULL, NULL, '$2y$10$RkeDuqhtAqMTRC7gfMFxG.Vl8pLtWGgj1jisi0ZkphX9LDVUQaZpO', 'Show', NULL, NULL, NULL, NULL, '2023-12-31 06:31:28', '2024-02-05 10:15:37', NULL, NULL),
(59, 'Mohammed', 'Yahia', 'as', 'Ahmed', 'admin2312@gmail.com', NULL, NULL, '213', NULL, NULL, 'default.png', NULL, 'student', NULL, '1', NULL, NULL, '$2y$10$UT7CEpaDZ6etgdvQDjN5huCPzvCM/xdiLbT02hZIZh.doXV6/SLRS', 'hidden', NULL, NULL, NULL, NULL, '2024-01-03 07:52:53', '2024-01-03 07:52:53', NULL, NULL),
(65, 'Mohammed', 'Yahia', 'wdwe', 'Ahmed', 'admin1234@gmail.com', NULL, NULL, 'ewfwef', NULL, NULL, 'default.png', NULL, 'teacher', NULL, NULL, 12, 9, '$2y$10$oK/jrMZawz/dg0fgQBAp2OHA8WpEfHIdGbSJnXZgl4QRbZq5zdVT2', 'hidden', NULL, NULL, NULL, NULL, '2024-02-27 10:45:08', '2024-02-27 10:45:08', NULL, NULL),
(66, 'Mohammed', 'Yahia', 'xcas', 'Ahmed', 'admin332@gmail.com', NULL, NULL, '32423243', '011324567611', 'yasen@gmail.com', 'default.png', NULL, 'admin', NULL, NULL, NULL, NULL, '$2y$10$BzpILuoESKJAgcYPg2muY.NLOL0DUrqPpAo7dUBz7c5mZBTJCzCwq', 'hidden', NULL, NULL, NULL, NULL, '2024-02-27 10:57:38', '2024-02-27 10:57:38', NULL, NULL),
(68, 'Mohammed', 'Yahia', 'Ahmed_Yahia', 'Ahmed', 'admin@gmail.com', NULL, NULL, '0123456789', '0123456789', NULL, 'default.png', NULL, 'admin', 9, NULL, NULL, NULL, '$2y$10$o694AWL8QgiCJQCwxbKTh.ny2Uf1bORwKgy5BHbPL8q396p2lU/xK', '', NULL, NULL, NULL, NULL, NULL, '2024-04-18 09:35:56', NULL, NULL),
(71, 'Mohammed', 'Yahia', 'teacher', 'Ahmed', 'teacher@gmail.com', NULL, NULL, '123456789', NULL, NULL, '9062024X03X28X11X19X583882024X03X16X08X07X112024X02X19X07X47X0129202301101725mvf_dark_logo.png', NULL, 'teacher', NULL, NULL, 1, 1, '$2y$10$GVCwnwSesuLeMnG8mDXs7uvPB.8pLdWJnpJ2Qle/j0qgATGLkc/BW', '', NULL, NULL, NULL, NULL, NULL, '2024-05-23 12:42:31', NULL, NULL),
(72, 'Mohammed', 'Yahia', 'student73', 'Ahmed', 'student73@gmail.com', NULL, NULL, '01099475854', NULL, NULL, 'default.png', NULL, 'student', NULL, NULL, NULL, NULL, '$2y$10$9Z4Y/RglhKwbQI4VD8Zeuu7GYyOVSAHiadvz2yNgWMKwdA62SRhTC', 'Show', NULL, NULL, NULL, NULL, '2024-04-08 09:42:18', '2024-04-08 09:42:18', NULL, NULL),
(73, 'Mohammed', 'Yahia', 'student75', 'Ahmed', 'student75@gmail.com', NULL, NULL, '01099475854', NULL, NULL, 'default.png', NULL, 'student', NULL, NULL, NULL, NULL, '$2y$10$yB/widboWULJiBQWEWWmpuj7RJusa6evvLuAZLayMVHYccIm8AW5i', 'Show', NULL, NULL, NULL, NULL, '2024-04-08 09:49:39', '2024-04-08 09:49:39', NULL, NULL),
(74, 'Mohammed', 'Yahia', 'student', 'Ahmed', 'student_one@gmail.com', NULL, NULL, '123456789', NULL, NULL, 'default.png', NULL, 'student', NULL, NULL, NULL, NULL, '$2y$10$BKsTSaAuydPqgotRajVNYea94qRZLLN57roEqf8Sx8KaDbZsX/x72', 'hidden', NULL, NULL, NULL, NULL, '2024-04-08 10:02:04', '2024-04-08 10:02:04', NULL, NULL),
(77, 'Ahmed', 'Said', 'affilate2', 'Ahmed', 'affilate2@gmail.com', NULL, NULL, '123456789', NULL, NULL, 'default.png', NULL, 'affilate', NULL, NULL, NULL, NULL, '$2y$10$SViEJcpV/5jyWZByMXnaZunZGNUP5OIJtp3lhe07PacZhdQUwiNyS', 'hidden', NULL, NULL, NULL, NULL, '2024-04-23 07:30:47', '2024-04-23 07:30:47', NULL, NULL),
(78, 'Ahmed', 'Yahia', 'ahmed yahia', 'Ahmed', 'ahmed312@gmail.com', NULL, NULL, '012343554', NULL, NULL, 'default.png', 2, 'student', NULL, '2', NULL, NULL, '$2y$10$qkS1oFF96EuZCiJXRTType39oBdEocuYyMYZnXejiyg2OphtYsLrO', 'hidden', NULL, NULL, NULL, NULL, '2024-04-30 10:42:47', '2024-04-30 10:42:47', NULL, NULL),
(79, 'Ahmed', 'mohamed', NULL, 'Ahmed', 'ahmedahmddadaddhm@gmail.com', NULL, NULL, '012343554', NULL, NULL, 'default.png', 2, 'student', NULL, '2', NULL, NULL, '$2y$10$TzR/.poBKCgEfLoKzd3HtOFe89kziAdqAdz1fF.STEVLBdQP2wVmO', 'hidden', NULL, NULL, NULL, NULL, '2024-05-01 11:35:18', '2024-05-01 11:35:18', NULL, NULL),
(81, NULL, NULL, 'asdds', NULL, 'admin564@gmail.com', NULL, NULL, '01099475854', NULL, NULL, 'default.png', NULL, 'student', NULL, NULL, NULL, NULL, '$2y$10$OwOtlHPpSib9hKb6MdBM9O240.fqunDVHVO5PeJTBZWYLBH5s3AnK', 'Show', NULL, NULL, NULL, NULL, '2024-05-05 06:37:28', '2024-05-05 06:37:28', NULL, NULL),
(82, 'asd', 'asdas', NULL, 'asdsfd', 'sdffssd@gmail.com', NULL, NULL, '233', NULL, NULL, 'default.png', 17, 'student', NULL, '9', NULL, NULL, '$2y$10$6Bxwf4v.vzbRg1ci/ykKXeqCyOw29gh/IKhDFO9ei354lByfCrB2K', 'hidden', NULL, NULL, NULL, NULL, '2024-05-05 10:33:52', '2024-05-05 10:33:52', NULL, NULL),
(83, NULL, NULL, NULL, 'asd', 'dfsff@gmail.com', NULL, NULL, '01099475854', NULL, NULL, 'default.png', NULL, 'student', NULL, NULL, NULL, NULL, '$2y$10$nBIxbC0nRSBXKIRj9MXy2uqPXysarL.xzAsY5X0W5Dc52dl8xUN3m', 'Show', NULL, NULL, NULL, NULL, '2024-05-05 11:21:15', '2024-05-05 11:21:15', NULL, NULL),
(84, 'karim', 'as', NULL, 'dtge', 'ertgttg@gmail.com', NULL, NULL, '4234345', NULL, NULL, 'default.png', 10, 'student', NULL, '10', NULL, NULL, '$2y$10$Ziob5wIzehAK6fid0k6YmeIxv1dbLKL.cqEOnicww4Q4Hd6cqxQJW', 'hidden', NULL, NULL, NULL, NULL, '2024-05-05 11:24:54', '2024-05-05 11:24:54', NULL, NULL),
(85, 'adel', 'saad', NULL, 'adel', 'adel@gmail.com', NULL, NULL, '14214356', NULL, NULL, 'default.png', NULL, 'student', NULL, NULL, NULL, NULL, '$2y$10$1Xz0N.Bd/v5G5t9mSmIZfu01LUkq9IJDaMJH3NQw34jp56Wglsoci', 'Show', NULL, NULL, NULL, NULL, '2024-05-08 04:35:31', '2024-05-08 04:35:31', NULL, NULL),
(86, 'new', 'user', NULL, 'new user', 'ahmedahmadahm@gmail.com', NULL, NULL, '12423453', NULL, NULL, 'default.png', 536, 'student', NULL, '11', NULL, NULL, '$2y$10$u3ER48Yvx1wsZTfSpeYzgOb8Xq0cNjlSOPdcxFY4zSgoLJ9H/dzT.', 'hidden', NULL, NULL, NULL, NULL, '2024-05-08 08:47:56', '2024-05-08 08:47:56', NULL, NULL),
(87, 'dfsd', 'dfs', NULL, 'fds', 'ahmedahmadahmid@gmail.com', NULL, NULL, '4523', NULL, NULL, 'default.png', 8, 'student', NULL, '11', NULL, NULL, '$2y$10$M5XcoAQpwBkzQvIeHc9nTeqniY/MpN/28YbVHAc5Oo9Ni3vaQabHW', 'hidden', NULL, NULL, NULL, NULL, '2024-05-08 08:53:19', '2024-05-08 08:53:19', NULL, NULL),
(88, 'ahmed', 'ahmed', NULL, 'ahmedahmed', 'ahmedahmadahmid3@gmail.com', NULL, NULL, '123456789', NULL, NULL, 'default.png', 8, 'student', NULL, '10', NULL, NULL, '$2y$10$6xMpkdwL6ld.Qj1yvEajS.Iq2wjCDFfIB6B800noRChEXXnb79dve', 'hidden', NULL, NULL, NULL, NULL, '2024-05-08 10:46:15', '2024-05-11 05:49:03', NULL, NULL),
(90, NULL, NULL, NULL, 'amr', 'amr@gmail.com', NULL, NULL, '01099475854', NULL, NULL, 'default.png', NULL, 'user_admin', 7, NULL, NULL, NULL, '$2y$10$GN68O0v770qa6tlu7/wRwOKqGn3186gZu9ZYpqnCxAk275b6Otcmm', 'Show', NULL, NULL, NULL, NULL, '2024-05-11 10:01:42', '2024-05-19 05:47:57', NULL, NULL),
(92, 'sdf', 'd', NULL, 'sdfw', 'ahmedahmadahmid73@gmail.com', NULL, NULL, '453432', NULL, NULL, 'default.png', 16, 'student', NULL, '10', NULL, NULL, '$2y$10$rjgaMh5Z0W1qeRIiqv/QEekH.k7VENL2WJzyLxTNqBizCHOP5POey', 'hidden', NULL, NULL, NULL, NULL, '2024-05-17 10:39:30', '2024-05-17 10:39:30', NULL, NULL),
(93, 'sdf', 'sdfs', NULL, 'as', 'asd@gmail.com', NULL, NULL, '12568908', NULL, NULL, 'default.png', NULL, 'user_admin', 6, NULL, NULL, NULL, '$2y$10$2QghDqKnq5.HWLa3D7ux3eucHUUGfJ5Yyl5yWzS2WQu3qDfUPTZGi', 'Show', NULL, NULL, NULL, '2024-06-22 09:17:36', '2024-05-19 05:48:20', '2024-06-22 09:17:36', NULL, NULL),
(94, 'sda', 'sad', NULL, 'sadASAAd', 'sdsddsf@gmail.com', NULL, NULL, '12568908', NULL, NULL, 'default.png', NULL, 'student', NULL, NULL, NULL, NULL, '$2y$10$.Fq1hWyJ66p1LZK5USIFC.uvv7yZ0ORbldsGBlZ68NE200dIhml.W', 'Show', NULL, NULL, NULL, NULL, '2024-05-19 09:41:25', '2024-05-19 09:41:25', NULL, NULL),
(95, NULL, NULL, NULL, 'ssss', 'ssss@gmail.com', NULL, NULL, '45345', NULL, NULL, 'default.png', NULL, 'teacher', NULL, NULL, NULL, NULL, '$2y$10$rPnveTitwldMOME6hr8xX.tNOoOAlbkvI7Kr38wpfhv4fNIMftmsW', 'Show', NULL, NULL, NULL, NULL, '2024-05-23 12:43:37', '2024-06-12 14:35:36', NULL, NULL),
(96, NULL, NULL, NULL, 'asddsa', 'asddsa@gmail.com', NULL, NULL, '2131234', NULL, NULL, 'default.png', NULL, 'student', NULL, NULL, NULL, NULL, '$2y$10$aXoJiB.kenYjLClrnrA9a.71mfX1vozOFKk1UU9rKp3o1lq7JQ3qC', 'Show', NULL, NULL, NULL, NULL, '2024-05-29 11:31:43', '2024-05-29 11:31:43', NULL, NULL),
(97, 'Asad', 'Sayed', NULL, 'sdasad', 'fsdfgs@gmail.com', NULL, NULL, '12431233', NULL, NULL, 'default.png', NULL, 'student', NULL, NULL, NULL, NULL, '$2y$10$KKnl9tB3fm3/rsPYETz5qOdI7q8.0JLMu3YmtKaQQ0nGhw4Uug6Ei', 'Show', NULL, NULL, NULL, NULL, '2024-05-29 11:35:48', '2024-05-29 11:35:48', NULL, NULL),
(98, 'asd', 'dsa', NULL, 'sdfa', 'sdasd@gmail.com', NULL, NULL, '01134568', NULL, NULL, 'default.png', NULL, 'affilate', NULL, NULL, NULL, NULL, '$2y$10$bb7kgLSVgdwglfYPpJeQGOhUYq6ozSj6yGflDshjE/6hHx3Nkb5Za', 'Show', NULL, NULL, NULL, NULL, '2024-06-08 06:23:16', '2024-06-08 06:23:16', NULL, NULL),
(99, 'asd', 'sd', NULL, 'sda', 'sd@gmail.com', NULL, NULL, '21', NULL, NULL, 'default.png', 19, 'student', NULL, '12', NULL, NULL, '$2y$10$bF9QVVvH/J24irFzLGCzYeaV9B6o/OsfFltMh6Ig1q7E/z.o24HwS', 'hidden', NULL, NULL, NULL, NULL, '2024-06-12 13:33:35', '2024-06-12 13:33:35', NULL, NULL),
(100, 'wedq', 'qwe', NULL, 'wqeqw', 'wqew@gmail.com', NULL, NULL, '3454', NULL, NULL, 'default.png', 19, 'student', NULL, '12', NULL, NULL, '$2y$10$thA9e5uZORohdjG0STGBCuuYiHPkp6YwlhFcB.nN92SihIbc9n6Sm', 'hidden', NULL, NULL, NULL, NULL, '2024-06-12 13:35:22', '2024-06-12 13:35:22', NULL, NULL),
(101, 'gfgh', 'ghf', NULL, 'trt', 'dfas@gmail.com', NULL, NULL, '56443', NULL, NULL, 'default.png', 16, 'student', NULL, '2', NULL, NULL, '$2y$10$x3cM25DEPiQol9Y4/GtubelOYeimGZ0b/O9kZKC2P8gK54fPvI26a', 'hidden', NULL, NULL, NULL, NULL, '2024-06-12 13:39:10', '2024-06-12 13:39:10', NULL, NULL),
(102, 'gfgh', 'ghf', NULL, 'trt6', 'dffas@gmail.com', NULL, NULL, '56443', NULL, NULL, 'default.png', 18, 'student', NULL, '11', NULL, NULL, '$2y$10$va1Z8IFazab7leALPJxM9uEnplnnZkOg4O.oD1P4fCkdvEus5VjU2', 'hidden', NULL, NULL, NULL, NULL, '2024-06-12 13:41:40', '2024-06-12 13:41:40', NULL, NULL),
(103, 'fdfds', 'fdsfwe', NULL, 'efwewe', 'efew@gmail.com', NULL, NULL, '2312', NULL, NULL, 'default.png', 19, 'student', NULL, '2', NULL, NULL, '$2y$10$zFFq0rRx3trTiFk01C.k0O57tNg/Q1hOJCk5kJbsEO361Yo5moEpa', 'hidden', NULL, NULL, NULL, NULL, '2024-06-12 13:46:08', '2024-06-12 13:46:08', NULL, NULL),
(104, 'dfv', 'sdf', NULL, 'sdf', 'sdf@gmail.com', NULL, NULL, 'dff', NULL, NULL, 'default.png', 19, 'student', NULL, '9', NULL, NULL, '$2y$10$H.9miIPuY202uGecp2Cyo.lRhqL.bJz3i7Nb3rgCTi6LvWH30EXdq', 'hidden', NULL, NULL, NULL, NULL, '2024-06-12 13:49:36', '2024-06-12 13:49:36', NULL, NULL),
(105, 'fgfr', 'rfer', NULL, 'rfer', 'sdfadfdf3@gmail.com', NULL, NULL, '123312', NULL, NULL, 'default.png', 19, 'student', NULL, '12', NULL, NULL, '$2y$10$Y7fPiSdRoW3v9dKu/GAu7ezhz9m0kTUOZviMRXs2g.b8KKxTJYXsq', 'hidden', NULL, NULL, NULL, NULL, '2024-06-12 13:57:09', '2024-06-12 13:57:09', NULL, NULL),
(106, 'fgfrsdf', 'rfesdfr', NULL, 'rfersdf', 'dfffe565@gmail.com', NULL, NULL, '123312', NULL, NULL, 'default.png', 536, 'student', NULL, '11', NULL, NULL, '$2y$10$dOrb7ABAxrWpLPnMa7YVcuqylaTciES6q.40.TeEFLusM/LLANOQC', 'hidden', NULL, NULL, NULL, NULL, '2024-06-12 14:04:19', '2024-06-12 14:04:19', NULL, NULL),
(107, 'fgfrsdf', 'rfesdfr', NULL, 'rfersdfdf', 'dfffe565ds@gmail.com', NULL, NULL, '123312', NULL, NULL, 'default.png', 536, 'student', NULL, '11', NULL, NULL, '$2y$10$zSk443M8D.2NHihQPb12V.wrdIjC3Qm6Iwy1tu0ksNvJK0hMidKmq', 'hidden', NULL, NULL, NULL, NULL, '2024-06-12 14:05:04', '2024-06-12 14:05:04', NULL, NULL),
(108, 'dsfgf', 'fgfsf', NULL, 'sdfwef', 'dfs@gmail.com', NULL, NULL, '2341', NULL, NULL, 'default.png', 8, 'student', NULL, '12', NULL, NULL, '$2y$10$7H6rF8INo3zdfzvZkyRs0Omj6Yft6kWWUfmKxvqTFNEn32ywnPT9e', 'hidden', NULL, NULL, NULL, NULL, '2024-06-12 14:06:25', '2024-06-12 14:06:25', NULL, NULL),
(109, 'dsfs', 'sdfds', NULL, 'sdfsd', 'sdf23@gmail.com', NULL, NULL, '231', NULL, NULL, 'default.png', 536, 'student', NULL, '12', NULL, NULL, '$2y$10$9N3JWjDJ2i4UfqX/0PlhNOBjmUmqPsmiM3g3CAypWUdMzei29bfbe', 'hidden', NULL, NULL, NULL, NULL, '2024-06-12 14:08:18', '2024-06-12 14:08:18', NULL, NULL),
(110, 'trer', 'ert', NULL, 'erte', 'tret@gmail.com', NULL, NULL, '213', NULL, NULL, 'default.png', NULL, 'student', NULL, NULL, NULL, NULL, '$2y$10$p6aapL6GZRyvheAM.5VzMOYwNKdlPPeU6rJaX.SxE1gxdtUPP5yN.', 'hidden', NULL, NULL, NULL, NULL, '2024-06-23 08:36:03', '2024-06-23 08:36:03', NULL, NULL),
(111, 'dsfsd', 'sdfd', NULL, 'sdfsddsfs', 'sdfs@gmail.com', NULL, NULL, '123', NULL, NULL, 'default.png', NULL, 'student', NULL, NULL, NULL, NULL, '$2y$10$sBi5.C.MSN/ut7Ic2.8w..8GFE4SYhoXx3oBOrF3IlhAd/KvTZgn.', 'hidden', NULL, NULL, NULL, NULL, '2024-06-23 08:38:33', '2024-06-23 08:38:33', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_admins`
--

CREATE TABLE `user_admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_admin` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_admins`
--

INSERT INTO `user_admins` (`id`, `user_admin`, `created_at`, `updated_at`) VALUES
(2, 'Affilate', NULL, NULL),
(4, 'Programmer', '2024-04-18 12:51:05', '2024-04-18 12:51:05'),
(5, 'Sasles', '2024-04-18 17:10:59', '2024-04-18 17:10:59'),
(6, 'Super Affilate', '2024-04-20 09:28:21', '2024-04-20 09:28:21'),
(7, 'Programmer', '2024-04-20 09:33:30', '2024-04-20 09:33:30'),
(8, 'Super Sales', '2024-04-20 13:38:29', '2024-04-20 13:38:29'),
(9, 'Developer', '2024-05-14 12:22:08', '2024-05-14 12:22:08'),
(10, 'Back end', '2024-05-20 08:50:25', '2024-05-20 08:50:25');

-- --------------------------------------------------------

--
-- Table structure for table `user_packages`
--

CREATE TABLE `user_packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_sessions`
--

CREATE TABLE `user_sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `session_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `rejected_reason` varchar(255) DEFAULT NULL,
  `wallet` int(11) NOT NULL,
  `date` date NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `state` enum('Pendding','Approve','Rejected') NOT NULL DEFAULT 'Pendding',
  `payment_request_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_method_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `student_id`, `rejected_reason`, `wallet`, `date`, `image`, `state`, `payment_request_id`, `payment_method_id`, `created_at`, `updated_at`) VALUES
(1, 8, NULL, 100000, '2024-01-28', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', NULL, 4, '2024-01-28', '2024-01-28'),
(2, 8, NULL, 4, '2024-01-28', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', NULL, NULL, '2024-01-28', '2024-01-28'),
(3, 8, NULL, 7, '2024-01-28', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Pendding', NULL, NULL, '2024-01-28', '2024-01-28'),
(4, 8, NULL, 4, '2024-01-28', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Pendding', NULL, NULL, '2024-01-28', '2024-01-28'),
(5, 8, NULL, 2, '2024-01-28', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Pendding', NULL, NULL, '2024-01-28', '2024-01-28'),
(6, 59, NULL, 2, '2024-01-28', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Pendding', NULL, NULL, '2024-01-28', '2024-01-28'),
(7, 8, NULL, 11, '2024-03-07', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Pendding', NULL, NULL, '2024-03-07', '2024-03-07'),
(8, 8, NULL, 11, '2024-03-07', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Pendding', NULL, NULL, '2024-03-07', '2024-03-07'),
(9, 8, NULL, 5, '2024-03-07', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Pendding', NULL, NULL, '2024-03-07', '2024-03-07'),
(10, 8, NULL, -57, '2024-03-07', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Pendding', NULL, NULL, '2024-03-07', '2024-03-07'),
(11, 8, NULL, -57, '2024-03-07', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Pendding', NULL, NULL, '2024-03-07', '2024-03-07'),
(12, 8, NULL, -57, '2024-03-07', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Pendding', NULL, NULL, '2024-03-07', '2024-03-07'),
(13, 8, NULL, -57, '2024-03-07', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Pendding', NULL, NULL, '2024-03-07', '2024-03-07'),
(14, 8, NULL, -57, '2024-03-07', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Pendding', NULL, NULL, '2024-03-07', '2024-03-07'),
(15, 8, NULL, -57, '2024-03-07', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Pendding', NULL, NULL, '2024-03-07', '2024-03-07'),
(16, 8, NULL, -57, '2024-03-07', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Pendding', NULL, NULL, '2024-03-07', '2024-03-07'),
(17, 8, NULL, -57, '2024-03-07', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Pendding', NULL, NULL, '2024-03-07', '2024-03-07'),
(18, 8, NULL, -57, '2024-03-07', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Pendding', NULL, NULL, '2024-03-07', '2024-03-07'),
(19, 8, NULL, -57, '2024-03-07', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Pendding', NULL, NULL, '2024-03-07', '2024-03-07'),
(20, 8, NULL, 1400, '2024-03-07', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', NULL, NULL, '2024-03-07', '2024-03-07'),
(23, 8, NULL, 400, '2024-03-07', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Pendding', 74, NULL, '2024-03-07', '2024-03-07'),
(24, 8, NULL, 400, '2024-03-07', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 75, NULL, '2024-03-07', '2024-03-07'),
(25, 8, NULL, 1400, '2024-03-07', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 76, NULL, '2024-03-07', '2024-03-07'),
(26, 8, NULL, 400, '2024-03-07', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 77, NULL, '2024-03-07', '2024-03-07'),
(27, 8, NULL, 400, '2024-03-07', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 78, NULL, '2024-03-07', '2024-03-07'),
(28, 8, NULL, -400, '2024-03-07', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 79, NULL, '2024-03-07', '2024-03-07'),
(29, 8, NULL, -400, '2024-03-07', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 80, NULL, '2024-03-07', '2024-03-07'),
(30, 8, NULL, -400, '2024-03-07', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 81, NULL, '2024-03-07', '2024-03-07'),
(31, 8, NULL, 400, '2024-03-07', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 82, NULL, '2024-03-07', '2024-03-07'),
(32, 8, NULL, 400, '2024-03-07', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 83, NULL, '2024-03-07', '2024-03-07'),
(33, 8, NULL, 400, '2024-03-07', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 84, NULL, '2024-03-07', '2024-03-07'),
(34, 8, NULL, -68, '2024-03-07', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 85, NULL, '2024-03-07', '2024-03-07'),
(35, 8, NULL, -68, '2024-03-07', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 86, NULL, '2024-03-07', '2024-03-07'),
(36, 8, NULL, -68, '2024-03-07', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 87, NULL, '2024-03-07', '2024-03-07'),
(37, 8, NULL, -68, '2024-03-07', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 88, NULL, '2024-03-07', '2024-03-07'),
(38, 8, NULL, -60, '2024-03-07', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 90, NULL, '2024-03-07', '2024-03-07'),
(39, 8, NULL, -60, '2024-03-07', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 92, NULL, '2024-03-07', '2024-03-07'),
(40, 8, NULL, -111, '2024-03-07', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 93, NULL, '2024-03-07', '2024-03-07'),
(41, 8, NULL, 18, '2024-03-13', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Pendding', NULL, NULL, '2024-03-13', '2024-03-13'),
(42, 8, NULL, -111, '2024-03-14', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 94, NULL, '2024-03-14', '2024-03-14'),
(43, 8, NULL, -111, '2024-03-14', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 95, NULL, '2024-03-14', '2024-03-14'),
(44, 8, NULL, -111, '2024-03-14', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 96, NULL, '2024-03-14', '2024-03-14'),
(45, 8, NULL, -111, '2024-03-15', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 97, NULL, '2024-03-15', '2024-03-15'),
(46, 8, NULL, -60, '2024-03-15', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 98, NULL, '2024-03-15', '2024-03-15'),
(47, 8, NULL, 3, '2024-03-16', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Pendding', NULL, 7, '2024-03-16', '2024-03-16'),
(48, 8, NULL, 1, '2024-03-16', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Pendding', NULL, 7, '2024-03-16', '2024-03-16'),
(49, 8, NULL, -111, '2024-03-16', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 99, NULL, '2024-03-16', '2024-03-16'),
(50, 8, NULL, -111, '2024-03-23', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 100, NULL, '2024-03-23', '2024-03-23'),
(51, 8, NULL, -111, '2024-03-26', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 101, NULL, '2024-03-26', '2024-03-26'),
(52, 8, NULL, -111, '2024-03-26', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 102, NULL, '2024-03-26', '2024-03-26'),
(53, 8, NULL, -111, '2024-03-26', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 103, NULL, '2024-03-26', '2024-03-26'),
(54, 8, NULL, -111, '2024-03-26', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 104, NULL, '2024-03-26', '2024-03-26'),
(55, 8, NULL, -111, '2024-03-26', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 105, NULL, '2024-03-26', '2024-03-26'),
(56, 8, NULL, -111, '2024-03-26', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 106, NULL, '2024-03-26', '2024-03-26'),
(57, 8, NULL, -60, '2024-03-27', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 107, NULL, '2024-03-27', '2024-03-27'),
(58, 8, NULL, -570, '2024-03-27', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 108, NULL, '2024-03-27', '2024-03-27'),
(59, 8, NULL, 500, '2024-03-30', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', NULL, NULL, '2024-03-30', '2024-03-30'),
(60, 8, NULL, -111, '2024-04-01', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 109, NULL, '2024-04-01', '2024-04-01'),
(61, 8, NULL, -60, '2024-04-01', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 110, NULL, '2024-04-01', '2024-04-01'),
(62, 8, NULL, 12, '2024-04-02', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', NULL, NULL, '2024-04-02', '2024-04-02'),
(63, 8, NULL, -111, '2024-04-08', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 111, NULL, '2024-04-08', '2024-04-08'),
(64, 8, NULL, -111, '2024-04-08', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 112, NULL, '2024-04-08', '2024-04-08'),
(65, 8, NULL, -111, '2024-04-08', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 113, NULL, '2024-04-08', '2024-04-08'),
(66, 8, NULL, -111, '2024-04-08', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 114, NULL, '2024-04-08', '2024-04-08'),
(67, 8, NULL, -111, '2024-04-08', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 115, NULL, '2024-04-08', '2024-04-08'),
(68, 8, NULL, -111, '2024-04-08', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 117, NULL, '2024-04-08', '2024-04-08'),
(69, 8, NULL, -111, '2024-04-08', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 118, NULL, '2024-04-08', '2024-04-08'),
(70, 8, NULL, -570, '2024-04-08', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 119, NULL, '2024-04-08', '2024-04-08'),
(71, 8, NULL, -18, '2024-04-08', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 120, NULL, '2024-04-08', '2024-04-08'),
(72, 8, NULL, -60, '2024-04-17', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 121, NULL, '2024-04-17', '2024-04-17'),
(73, 8, NULL, -38, '2024-04-17', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 122, NULL, '2024-04-17', '2024-04-17'),
(74, 8, NULL, -111, '2024-04-20', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 123, NULL, '2024-04-20', '2024-04-20'),
(75, 8, NULL, -60, '2024-04-21', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 124, NULL, '2024-04-21', '2024-04-21'),
(76, 8, NULL, -111, '2024-04-21', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 125, NULL, '2024-04-21', '2024-04-21'),
(77, 8, NULL, -111, '2024-04-22', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 126, NULL, '2024-04-22', '2024-04-22'),
(78, 8, NULL, -111, '2024-04-26', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 129, NULL, '2024-04-26', '2024-04-26'),
(79, 8, NULL, -111, '2024-04-26', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 131, NULL, '2024-04-26', '2024-04-26'),
(80, 8, NULL, -475, '2024-04-27', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 133, NULL, '2024-04-27', '2024-04-27'),
(81, 8, NULL, -60, '2024-05-01', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 134, NULL, '2024-05-01', '2024-05-01'),
(82, 8, NULL, -46, '2024-05-07', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 136, NULL, '2024-05-07', '2024-05-07'),
(83, 8, NULL, -15, '2024-05-08', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 137, NULL, '2024-05-08', '2024-05-08'),
(84, 8, NULL, 555, '2024-05-08', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Pendding', NULL, 8, '2024-05-08', '2024-05-08'),
(85, 8, NULL, 3, '2024-05-08', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Pendding', NULL, 2, '2024-05-08', '2024-05-08'),
(86, 8, NULL, -18, '2024-05-08', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 139, NULL, '2024-05-08', '2024-05-08'),
(87, 8, NULL, -18, '2024-05-08', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Approve', 140, NULL, '2024-05-08', '2024-05-08'),
(88, 8, 'asd', 123, '2024-05-09', '4242024X03X07X09X29X372024X02X19X07X47X0129202301101725mvf_dark_logo.png', 'Rejected', NULL, 8, '2024-05-09', '2024-05-09'),
(89, 8, NULL, 1112, '2024-05-09', '5442024X05X09X09X15X445592024X04X24X09X33X318032024X03X27X12X18X322024X02X19X07X46X506890202301101725mvf_dark_logo.png', 'Pendding', NULL, 2, '2024-05-09', '2024-05-09'),
(90, 8, NULL, 4321, '2024-05-09', '242024X05X09X09X17X09happy.png', 'Approve', NULL, 2, '2024-05-09', '2024-05-09'),
(91, 8, NULL, -15, '2024-05-09', NULL, 'Approve', 144, NULL, '2024-05-09', '2024-05-09'),
(92, 8, NULL, 222, '2024-05-10', '792024X05X10X12X15X555592024X04X24X09X33X318032024X03X27X12X18X322024X02X19X07X46X506890202301101725mvf_dark_logo.png', 'Pendding', NULL, 8, '2024-05-10', '2024-05-10'),
(93, 8, NULL, 55, '2024-05-12', '6892024X05X12X11X20X482.png', 'Pendding', NULL, 2, '2024-05-12', '2024-05-12'),
(94, 8, NULL, 3, '2024-05-13', '02024X05X13X08X39X257.png', 'Approve', NULL, 8, '2024-05-13', '2024-05-19'),
(95, 8, NULL, -475, '2024-05-13', NULL, 'Approve', 145, NULL, '2024-05-13', '2024-05-13'),
(96, 8, NULL, -475, '2024-05-13', NULL, 'Approve', 146, NULL, '2024-05-13', '2024-05-13'),
(97, 8, NULL, -475, '2024-05-13', NULL, 'Approve', 147, NULL, '2024-05-13', '2024-05-13'),
(98, 8, NULL, -475, '2024-05-13', NULL, 'Approve', 148, NULL, '2024-05-13', '2024-05-13'),
(99, 8, NULL, -475, '2024-05-13', NULL, 'Approve', 149, NULL, '2024-05-13', '2024-05-13'),
(100, 8, NULL, -475, '2024-05-13', NULL, 'Approve', 150, NULL, '2024-05-13', '2024-05-13'),
(101, 8, NULL, -475, '2024-05-13', NULL, 'Approve', 151, NULL, '2024-05-13', '2024-05-13'),
(102, 8, NULL, -15, '2024-05-13', NULL, 'Approve', 152, NULL, '2024-05-13', '2024-05-13'),
(103, 8, NULL, -15, '2024-05-13', NULL, 'Approve', 153, NULL, '2024-05-13', '2024-05-13'),
(104, 8, NULL, -111, '2024-05-13', NULL, 'Approve', 154, NULL, '2024-05-13', '2024-05-13'),
(105, 8, NULL, -50, '2024-05-13', NULL, 'Approve', 155, NULL, '2024-05-13', '2024-05-13'),
(106, 8, NULL, -50, '2024-05-13', NULL, 'Approve', 156, NULL, '2024-05-13', '2024-05-13'),
(107, 8, NULL, -50, '2024-05-13', NULL, 'Approve', 157, NULL, '2024-05-13', '2024-05-13'),
(108, 8, NULL, -50, '2024-05-13', NULL, 'Approve', 158, NULL, '2024-05-13', '2024-05-13'),
(109, 8, NULL, -50, '2024-05-13', NULL, 'Approve', 159, NULL, '2024-05-13', '2024-05-13'),
(110, 8, NULL, -50, '2024-05-13', NULL, 'Approve', 160, NULL, '2024-05-13', '2024-05-13'),
(111, 8, NULL, -49, '2024-05-13', NULL, 'Approve', 161, NULL, '2024-05-13', '2024-05-13'),
(112, 8, NULL, -475, '2024-05-17', NULL, 'Approve', 165, NULL, '2024-05-17', '2024-05-17'),
(113, 8, NULL, -111, '2024-05-17', NULL, 'Approve', 168, NULL, '2024-05-17', '2024-05-17'),
(114, 8, NULL, -60, '2024-05-17', NULL, 'Approve', 169, NULL, '2024-05-17', '2024-05-17'),
(115, 8, NULL, -60, '2024-05-17', NULL, 'Approve', 175, NULL, '2024-05-17', '2024-05-17'),
(116, 8, NULL, -600, '2024-05-17', NULL, 'Approve', 177, NULL, '2024-05-17', '2024-05-17'),
(117, 8, NULL, -41, '2024-05-17', NULL, 'Approve', 179, NULL, '2024-05-17', '2024-05-17'),
(118, 8, NULL, -41, '2024-05-17', NULL, 'Approve', 180, NULL, '2024-05-17', '2024-05-17'),
(119, 8, NULL, -41, '2024-05-17', NULL, 'Approve', 181, NULL, '2024-05-17', '2024-05-17'),
(120, 8, NULL, -41, '2024-05-17', NULL, 'Approve', 183, NULL, '2024-05-17', '2024-05-17'),
(121, 8, NULL, -41, '2024-05-17', NULL, 'Approve', 184, NULL, '2024-05-17', '2024-05-17'),
(122, 8, NULL, -200, '2024-05-19', NULL, 'Approve', 185, NULL, '2024-05-19', '2024-05-19'),
(123, 8, NULL, -2000, '2024-05-19', NULL, 'Approve', 186, NULL, '2024-05-19', '2024-05-19'),
(124, 8, NULL, -200, '2024-05-19', NULL, 'Approve', 187, NULL, '2024-05-19', '2024-05-19'),
(125, 8, NULL, -200, '2024-05-19', NULL, 'Approve', 188, NULL, '2024-05-19', '2024-05-19'),
(126, 8, NULL, -200, '2024-05-19', NULL, 'Approve', 189, NULL, '2024-05-19', '2024-05-19'),
(127, 8, NULL, -200, '2024-05-19', NULL, 'Approve', 190, NULL, '2024-05-19', '2024-05-19'),
(128, 8, NULL, -200, '2024-05-19', NULL, 'Approve', 191, NULL, '2024-05-19', '2024-05-19'),
(129, 8, NULL, -200, '2024-05-19', NULL, 'Approve', 192, NULL, '2024-05-19', '2024-05-19'),
(130, 8, NULL, -200, '2024-05-19', NULL, 'Approve', 193, NULL, '2024-05-19', '2024-05-19'),
(131, 8, NULL, -200, '2024-05-19', NULL, 'Approve', 194, NULL, '2024-05-19', '2024-05-19'),
(132, 8, NULL, -200, '2024-05-19', NULL, 'Approve', 195, NULL, '2024-05-19', '2024-05-19'),
(133, 8, NULL, -475, '2024-05-22', NULL, 'Approve', 196, NULL, '2024-05-22', '2024-05-22'),
(134, 8, NULL, -60, '2024-05-22', NULL, 'Approve', 197, NULL, '2024-05-22', '2024-05-22'),
(135, 8, NULL, -60, '2024-05-22', NULL, 'Approve', 198, NULL, '2024-05-22', '2024-05-22'),
(136, 8, NULL, -32, '2024-05-25', NULL, 'Approve', 199, NULL, '2024-05-25', '2024-05-25'),
(137, 8, NULL, -50, '2024-05-25', NULL, 'Approve', 200, NULL, '2024-05-25', '2024-05-25'),
(138, 8, NULL, 111, '2024-05-25', '722024X05X25X12X17X318.png', 'Approve', NULL, 2, '2024-05-25', '2024-05-25'),
(139, 8, NULL, -300, '2024-05-27', NULL, 'Approve', 201, NULL, '2024-05-27', '2024-05-27'),
(140, 8, NULL, -6, '2024-05-28', NULL, 'Approve', 202, NULL, '2024-05-28', '2024-05-28'),
(141, 8, NULL, -111, '2024-05-30', NULL, 'Approve', 203, NULL, '2024-05-30', '2024-05-30'),
(142, 8, NULL, -60, '2024-06-04', NULL, 'Approve', 204, NULL, '2024-06-04', '2024-06-04'),
(143, 8, NULL, -111, '2024-06-05', NULL, 'Approve', 205, NULL, '2024-06-05', '2024-06-05'),
(144, 8, NULL, -111, '2024-06-06', NULL, 'Approve', 206, NULL, '2024-06-06', '2024-06-06'),
(145, 8, NULL, -111, '2024-06-06', NULL, 'Approve', 207, NULL, '2024-06-06', '2024-06-06'),
(146, 8, NULL, -60, '2024-06-12', NULL, 'Approve', 208, NULL, '2024-06-12', '2024-06-12'),
(147, 8, NULL, -111, '2024-06-12', NULL, 'Approve', 209, NULL, '2024-06-12', '2024-06-12'),
(148, 8, NULL, -60, '2024-06-12', NULL, 'Approve', 210, NULL, '2024-06-12', '2024-06-12'),
(149, 8, NULL, -111, '2024-06-19', NULL, 'Approve', 211, NULL, '2024-06-19', '2024-06-19'),
(150, 8, NULL, -111, '2024-06-23', NULL, 'Approve', 212, NULL, '2024-06-23', '2024-06-23'),
(151, 8, NULL, -60, '2024-06-23', NULL, 'Approve', 213, NULL, '2024-06-23', '2024-06-23'),
(152, 8, NULL, -111, '2024-06-23', NULL, 'Approve', 214, NULL, '2024-06-23', '2024-06-23'),
(153, 8, NULL, -111, '2024-07-02', NULL, 'Approve', 215, NULL, '2024-07-02', '2024-07-02'),
(154, 8, NULL, -475, '2024-07-04', NULL, 'Approve', 216, NULL, '2024-07-04', '2024-07-04'),
(155, 8, NULL, -22, '2024-07-04', NULL, 'Approve', 217, NULL, '2024-07-04', '2024-07-04'),
(156, 8, NULL, -22, '2024-07-04', NULL, 'Approve', 218, NULL, '2024-07-04', '2024-07-04'),
(157, 8, NULL, -22, '2024-07-04', NULL, 'Approve', 219, NULL, '2024-07-04', '2024-07-04'),
(158, 8, NULL, -6, '2024-07-04', NULL, 'Approve', 220, NULL, '2024-07-04', '2024-07-04'),
(159, 8, NULL, -22, '2024-07-04', NULL, 'Approve', 221, NULL, '2024-07-04', '2024-07-04'),
(160, 8, NULL, -111, '2024-07-05', NULL, 'Approve', 222, NULL, '2024-07-05', '2024-07-05'),
(161, 8, NULL, -111, '2024-07-05', NULL, 'Approve', 223, NULL, '2024-07-05', '2024-07-05'),
(162, 8, NULL, -111, '2024-07-05', NULL, 'Approve', 225, NULL, '2024-07-05', '2024-07-05'),
(163, 8, NULL, -111, '2024-07-05', NULL, 'Approve', 226, NULL, '2024-07-05', '2024-07-05'),
(164, 8, NULL, -111, '2024-07-05', NULL, 'Approve', 227, NULL, '2024-07-05', '2024-07-05'),
(165, 8, NULL, -111, '2024-07-05', NULL, 'Approve', 228, NULL, '2024-07-05', '2024-07-05'),
(166, 8, NULL, -111, '2024-07-05', NULL, 'Approve', 229, NULL, '2024-07-05', '2024-07-05'),
(167, 8, NULL, -111, '2024-07-05', NULL, 'Approve', 231, NULL, '2024-07-05', '2024-07-05'),
(168, 8, NULL, -111, '2024-07-05', NULL, 'Approve', 232, NULL, '2024-07-05', '2024-07-05'),
(169, 8, NULL, -22, '2024-07-05', NULL, 'Approve', 233, NULL, '2024-07-05', '2024-07-05'),
(170, 8, NULL, -22, '2024-07-05', NULL, 'Approve', 234, NULL, '2024-07-05', '2024-07-05'),
(171, 8, NULL, -22, '2024-07-05', NULL, 'Approve', 235, NULL, '2024-07-05', '2024-07-05'),
(172, 8, NULL, -22, '2024-07-05', NULL, 'Approve', 236, NULL, '2024-07-05', '2024-07-05'),
(173, 8, NULL, -111, '2024-07-05', NULL, 'Approve', 237, NULL, '2024-07-05', '2024-07-05'),
(174, 8, NULL, -111, '2024-07-05', NULL, 'Approve', 238, NULL, '2024-07-05', '2024-07-05'),
(175, 8, NULL, -111, '2024-07-05', NULL, 'Approve', 239, NULL, '2024-07-05', '2024-07-05'),
(176, 8, NULL, -111, '2024-07-05', NULL, 'Approve', 240, NULL, '2024-07-05', '2024-07-05'),
(177, 8, NULL, -83, '2024-07-05', NULL, 'Approve', 241, NULL, '2024-07-05', '2024-07-05'),
(178, 8, NULL, -83, '2024-07-05', NULL, 'Approve', 242, NULL, '2024-07-05', '2024-07-05'),
(179, 8, NULL, -60, '2024-07-05', NULL, 'Approve', 243, NULL, '2024-07-05', '2024-07-05'),
(180, 8, NULL, -475, '2024-07-05', NULL, 'Approve', 244, NULL, '2024-07-05', '2024-07-05'),
(181, 8, NULL, -375, '2024-07-05', NULL, 'Approve', 245, NULL, '2024-07-05', '2024-07-05'),
(182, 8, NULL, -22, '2024-07-05', NULL, 'Approve', 246, NULL, '2024-07-05', '2024-07-05'),
(183, 8, NULL, -22, '2024-07-05', NULL, 'Approve', 247, NULL, '2024-07-05', '2024-07-05'),
(184, 8, NULL, -22, '2024-07-05', NULL, 'Approve', 248, NULL, '2024-07-05', '2024-07-05'),
(185, 8, NULL, -22, '2024-07-05', NULL, 'Approve', 249, NULL, '2024-07-05', '2024-07-05'),
(186, 8, NULL, -22, '2024-07-05', NULL, 'Approve', 250, NULL, '2024-07-05', '2024-07-05'),
(187, 8, NULL, -22, '2024-07-05', NULL, 'Approve', 251, NULL, '2024-07-05', '2024-07-05'),
(188, 8, NULL, -22, '2024-07-05', NULL, 'Approve', 252, NULL, '2024-07-05', '2024-07-05'),
(189, 8, NULL, -475, '2024-07-06', NULL, 'Approve', 256, NULL, '2024-07-06', '2024-07-06'),
(190, 8, NULL, -475, '2024-07-06', NULL, 'Approve', 257, NULL, '2024-07-06', '2024-07-06'),
(191, 8, NULL, -22, '2024-07-07', NULL, 'Approve', 260, NULL, '2024-07-07', '2024-07-07'),
(192, 8, NULL, -60, '2024-07-08', NULL, 'Approve', 261, NULL, '2024-07-08', '2024-07-08'),
(193, 8, NULL, -111, '2024-07-08', NULL, 'Approve', 263, NULL, '2024-07-08', '2024-07-08'),
(194, 8, NULL, -83, '2024-07-08', NULL, 'Approve', 264, NULL, '2024-07-08', '2024-07-08'),
(195, 8, NULL, -475, '2024-07-10', NULL, 'Approve', 266, NULL, '2024-07-10', '2024-07-10'),
(196, 8, NULL, -375, '2024-07-10', NULL, 'Approve', 271, NULL, '2024-07-10', '2024-07-10'),
(197, 8, NULL, -22, '2024-07-10', NULL, 'Approve', 272, NULL, '2024-07-10', '2024-07-10'),
(198, 8, NULL, -22, '2024-07-10', NULL, 'Approve', 273, NULL, '2024-07-10', '2024-07-10'),
(199, 8, NULL, -62, '2024-07-10', NULL, 'Approve', 283, NULL, '2024-07-10', '2024-07-10'),
(200, 8, NULL, -62, '2024-07-10', NULL, 'Approve', 284, NULL, '2024-07-10', '2024-07-10'),
(201, 8, NULL, -62, '2024-07-10', NULL, 'Approve', 285, NULL, '2024-07-10', '2024-07-10'),
(202, 8, NULL, -111, '2024-07-10', NULL, 'Approve', 286, NULL, '2024-07-10', '2024-07-10'),
(203, 8, NULL, -111, '2024-07-10', NULL, 'Approve', 287, NULL, '2024-07-10', '2024-07-10'),
(204, 8, NULL, -111, '2024-07-10', NULL, 'Approve', 288, NULL, '2024-07-10', '2024-07-10'),
(205, 8, NULL, -111, '2024-07-10', NULL, 'Approve', 289, NULL, '2024-07-10', '2024-07-10'),
(206, 8, NULL, -60, '2024-07-14', NULL, 'Approve', 290, NULL, '2024-07-14', '2024-07-14'),
(207, 8, NULL, -60, '2024-07-14', NULL, 'Approve', 291, NULL, '2024-07-14', '2024-07-14'),
(208, 8, NULL, -111, '2024-07-15', NULL, 'Approve', 292, NULL, '2024-07-15', '2024-07-15'),
(209, 8, NULL, -111, '2024-07-15', NULL, 'Approve', 293, NULL, '2024-07-15', '2024-07-15'),
(210, 8, NULL, -111, '2024-07-15', NULL, 'Approve', 294, NULL, '2024-07-15', '2024-07-15'),
(211, 8, NULL, -111, '2024-07-15', NULL, 'Approve', 295, NULL, '2024-07-15', '2024-07-15'),
(212, 8, NULL, -111, '2024-07-15', NULL, 'Approve', 296, NULL, '2024-07-15', '2024-07-15'),
(213, 8, NULL, -111, '2024-07-15', NULL, 'Approve', 297, NULL, '2024-07-15', '2024-07-15'),
(214, 8, NULL, -111, '2024-07-15', NULL, 'Approve', 298, NULL, '2024-07-15', '2024-07-15'),
(215, 8, NULL, -111, '2024-07-15', NULL, 'Approve', 299, NULL, '2024-07-15', '2024-07-15'),
(216, 8, NULL, -111, '2024-07-15', NULL, 'Approve', 300, NULL, '2024-07-15', '2024-07-15'),
(217, 8, NULL, -111, '2024-07-15', NULL, 'Approve', 301, NULL, '2024-07-15', '2024-07-15'),
(218, 8, NULL, -111, '2024-07-15', NULL, 'Approve', 302, NULL, '2024-07-15', '2024-07-15'),
(219, 8, NULL, -60, '2024-07-15', NULL, 'Approve', 303, NULL, '2024-07-15', '2024-07-15'),
(220, 8, NULL, -60, '2024-07-15', NULL, 'Approve', 304, NULL, '2024-07-15', '2024-07-15'),
(221, 8, NULL, -111, '2024-07-16', NULL, 'Approve', 305, NULL, '2024-07-16', '2024-07-16'),
(222, 8, NULL, -18, '2024-07-16', NULL, 'Approve', 306, NULL, '2024-07-16', '2024-07-16'),
(223, 8, NULL, -6, '2024-07-16', NULL, 'Approve', 307, NULL, '2024-07-16', '2024-07-16'),
(224, 8, NULL, -6, '2024-07-16', NULL, 'Approve', 308, NULL, '2024-07-16', '2024-07-16'),
(225, 8, NULL, -6, '2024-07-16', NULL, 'Approve', 309, NULL, '2024-07-16', '2024-07-16'),
(226, 8, NULL, -6, '2024-07-16', NULL, 'Approve', 310, NULL, '2024-07-16', '2024-07-16'),
(227, 8, NULL, -18, '2024-07-16', NULL, 'Approve', 311, NULL, '2024-07-16', '2024-07-16'),
(228, 8, NULL, -111, '2024-07-16', NULL, 'Approve', 312, NULL, '2024-07-16', '2024-07-16'),
(229, 8, NULL, -111, '2024-07-16', NULL, 'Approve', 313, NULL, '2024-07-16', '2024-07-16'),
(230, 8, NULL, -111, '2024-07-16', NULL, 'Approve', 314, NULL, '2024-07-16', '2024-07-16'),
(231, 8, NULL, -111, '2024-07-20', NULL, 'Approve', 315, NULL, '2024-07-20', '2024-07-20'),
(232, 8, NULL, -111, '2024-07-20', NULL, 'Approve', 316, NULL, '2024-07-20', '2024-07-20'),
(233, 8, NULL, -111, '2024-07-20', NULL, 'Approve', 317, NULL, '2024-07-20', '2024-07-20'),
(234, 8, NULL, -60, '2024-07-20', NULL, 'Approve', 318, NULL, '2024-07-20', '2024-07-20'),
(235, 8, NULL, -111, '2024-07-22', NULL, 'Approve', 319, NULL, '2024-07-22', '2024-07-22'),
(236, 8, NULL, -111, '2024-07-27', NULL, 'Approve', 320, NULL, '2024-07-27', '2024-07-27'),
(237, 8, NULL, -111, '2024-07-30', NULL, 'Approve', 321, NULL, '2024-07-30', '2024-07-30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_carts`
--
ALTER TABLE `academic_carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_roles_user_id_foreign` (`user_admin_id`);

--
-- Indexes for table `affilate`
--
ALTER TABLE `affilate`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `affilate_requests`
--
ALTER TABLE `affilate_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `affilate_services`
--
ALTER TABLE `affilate_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Service_Affilate` (`affilate_id`);

--
-- Indexes for table `cancel_session`
--
ALTER TABLE `cancel_session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Cancel_Session` (`session_id`),
  ADD KEY `FK_Cancel_Student` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Categories_Teacher` (`teacher_id`);

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chapters_course_id_foreign` (`course_id`),
  ADD KEY `FK_Chapters_Teacher` (`teacher_id`);

--
-- Indexes for table `chapter_prices`
--
ALTER TABLE `chapter_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Price_Chapter` (`chapter_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commissions`
--
ALTER TABLE `commissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Commision_User` (`user_id`);

--
-- Indexes for table `confirm_sign`
--
ALTER TABLE `confirm_sign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_category_id_foreign` (`category_id`),
  ADD KEY `FK_Course_Teacher` (`teacher_id`);

--
-- Indexes for table `course_prices`
--
ALTER TABLE `course_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Price_Course` (`course_id`);

--
-- Indexes for table `dai_exam_mistakes`
--
ALTER TABLE `dai_exam_mistakes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Mistakes_Question` (`question_id`),
  ADD KEY `FK_Mistakes_Exam` (`student_exam_id`);

--
-- Indexes for table `diagnostic_exams`
--
ALTER TABLE `diagnostic_exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Dia_Course` (`course_id`),
  ADD KEY `FK_Dia_Score` (`score_id`);

--
-- Indexes for table `diagnostic_exams_history`
--
ALTER TABLE `diagnostic_exams_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_DiaHistory_User` (`user_id`),
  ADD KEY `FK_DiaHistory_Dia` (`diagnostic_exams_id`);

--
-- Indexes for table `dia_questions`
--
ALTER TABLE `dia_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_DiaExam` (`diagnostic_exam_id`),
  ADD KEY `FK_Question` (`question_id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Exam_Course` (`course_id`),
  ADD KEY `FK_Exam_Time` (`code_id`),
  ADD KEY `FK_Exam_Score` (`score_id`);

--
-- Indexes for table `exam_codes`
--
ALTER TABLE `exam_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_history`
--
ALTER TABLE `exam_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_EHistory_Exam` (`exam_id`),
  ADD KEY `FK_EHistory_Student` (`user_id`);

--
-- Indexes for table `exam_history_sections`
--
ALTER TABLE `exam_history_sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ExamHistorySec_ExamHistory` (`exam_history_id`),
  ADD KEY `FK_ExamHistorySec_ExamSec` (`exam_section_id`);

--
-- Indexes for table `exam_mistakes`
--
ALTER TABLE `exam_mistakes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_EMistakes_Exam` (`student_exam_id`),
  ADD KEY `FK_EMistakes_Question` (`question_id`),
  ADD KEY `FK_EMistakes_User` (`user_id`);

--
-- Indexes for table `exam_questions`
--
ALTER TABLE `exam_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Exam_Exam` (`exam_id`),
  ADD KEY `FK_Exam_Question` (`question_id`),
  ADD KEY `FK_ExamQ_ExamSec` (`section_id`);

--
-- Indexes for table `exam_sections`
--
ALTER TABLE `exam_sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ExamSections_Exam` (`exam_id`);

--
-- Indexes for table `exam_time`
--
ALTER TABLE `exam_time`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ExamTime_User` (`user_id`),
  ADD KEY `FK_ExamTime_Exam` (`exam_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `forget_passwords`
--
ALTER TABLE `forget_passwords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grid_ans`
--
ALTER TABLE `grid_ans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Grid_Question` (`q_id`);

--
-- Indexes for table `group_days`
--
ALTER TABLE `group_days`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_GDays_Group` (`group_id`);

--
-- Indexes for table `group_students`
--
ALTER TABLE `group_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_GStu_Group` (`group_id`),
  ADD KEY `FK_GStu_Student` (`stu_id`);

--
-- Indexes for table `idea_lessons`
--
ALTER TABLE `idea_lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Idea_Lesson` (`lesson_id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Lesson_Chapter` (`chapter_id`),
  ADD KEY `FK_Lesson_Teacher` (`teacher_id`);

--
-- Indexes for table `live_courses`
--
ALTER TABLE `live_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Live_Users` (`user_id`),
  ADD KEY `FK_Live_Course` (`course_id`);

--
-- Indexes for table `live_lessons`
--
ALTER TABLE `live_lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_LiveLesson_Users` (`user_id`),
  ADD KEY `FK_LiveLesson_Lesson` (`lesson_id`);

--
-- Indexes for table `login_users`
--
ALTER TABLE `login_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Login_User` (`user_id`);

--
-- Indexes for table `marketings`
--
ALTER TABLE `marketings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Maketing_Affilate` (`affilate_id`),
  ADD KEY `FK_Maketing_Chapter` (`chapter_id`),
  ADD KEY `FK_Maketing_Course` (`course_id`),
  ADD KEY `FK_Maketing_Student` (`student_id`);

--
-- Indexes for table `marketing_popups`
--
ALTER TABLE `marketing_popups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mcq_ans`
--
ALTER TABLE `mcq_ans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_MCQ_Q` (`q_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_orders`
--
ALTER TABLE `payment_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Order_Request` (`payment_request_id`),
  ADD KEY `FK_Order_Chapter` (`chapter_id`);

--
-- Indexes for table `payment_package_order`
--
ALTER TABLE `payment_package_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Order_Package` (`package_id`),
  ADD KEY `FK_Order_PRequest` (`payment_request_id`);

--
-- Indexes for table `payment_requests`
--
ALTER TABLE `payment_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Pay_Method` (`payment_method_id`),
  ADD KEY `FK_Pay_User` (`user_id`);

--
-- Indexes for table `payouts`
--
ALTER TABLE `payouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Payout_Affilate` (`affilate_id`),
  ADD KEY `FK_Payment_Method` (`payment_method`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `popup_pages`
--
ALTER TABLE `popup_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `popup_popup_pages`
--
ALTER TABLE `popup_popup_pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Popup_Page` (`popup_page_id`),
  ADD KEY `FK_Popup_Popup` (`marketing_popup_id`);

--
-- Indexes for table `private_request`
--
ALTER TABLE `private_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Private_Teacher` (`teacher_id`),
  ADD KEY `FK_Private_User` (`user_id`);

--
-- Indexes for table `promo_chapters`
--
ALTER TABLE `promo_chapters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promo_codes`
--
ALTER TABLE `promo_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promo_courses`
--
ALTER TABLE `promo_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Promo` (`promo_id`),
  ADD KEY `FK_Course` (`course_id`);

--
-- Indexes for table `promo_packages`
--
ALTER TABLE `promo_packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_PromoPackage_Promo` (`promo_id`),
  ADD KEY `FK_PromoPackage_Package` (`package_id`);

--
-- Indexes for table `promo_users`
--
ALTER TABLE `promo_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Users` (`user_id`),
  ADD KEY `FK_PromoC` (`promo_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Q_Lesson` (`lesson_id`);

--
-- Indexes for table `question_history`
--
ALTER TABLE `question_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_times`
--
ALTER TABLE `question_times`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Quizze_Lesson` (`lesson_id`);

--
-- Indexes for table `quizze_stu_ans`
--
ALTER TABLE `quizze_stu_ans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `q_ans`
--
ALTER TABLE `q_ans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Answer_Question` (`Q_id`);

--
-- Indexes for table `q_quizes`
--
ALTER TABLE `q_quizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_qq_Quizze` (`quizze_id`),
  ADD KEY `FK_qq_Question` (`question_id`);

--
-- Indexes for table `report_questions`
--
ALTER TABLE `report_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ReportQuestion_Student` (`user_id`),
  ADD KEY `FK_ReportQuestion_Question` (`question_id`),
  ADD KEY `FK_ReportQuestion_List` (`list_id`);

--
-- Indexes for table `report_question_lists`
--
ALTER TABLE `report_question_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_videos`
--
ALTER TABLE `report_videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ReportVideo_Lists` (`list_id`),
  ADD KEY `FK_ReportVideo_Student` (`user_id`),
  ADD KEY `FK_ReportVideo_Video` (`lesson_video_id`),
  ADD KEY `FK_QReportVideo_Video` (`q_video_id`);

--
-- Indexes for table `report_video_lists`
--
ALTER TABLE `report_video_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `score_list`
--
ALTER TABLE `score_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ScoreList_Score` (`score_id`);

--
-- Indexes for table `score_sheet`
--
ALTER TABLE `score_sheet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Score_Course` (`course_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Session_Lesson` (`lesson_id`),
  ADD KEY `FK_Session_Teacher` (`teacher_id`);

--
-- Indexes for table `session_attendance`
--
ALTER TABLE `session_attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Attendance_User` (`user_id`),
  ADD KEY `FK_Attendance_Session` (`session_id`);

--
-- Indexes for table `session_days`
--
ALTER TABLE `session_days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `session_groups`
--
ALTER TABLE `session_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_SessionG_Teacher` (`teacher_id`);

--
-- Indexes for table `session_students`
--
ALTER TABLE `session_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Session` (`session_id`),
  ADD KEY `FK_Stu` (`user_id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `small_packages`
--
ALTER TABLE `small_packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_SmallPackage_User` (`user_id`),
  ADD KEY `FK_SmallPackage_Admin` (`admin_id`);

--
-- Indexes for table `student_quizzes`
--
ALTER TABLE `student_quizzes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Stu_Lesson` (`lesson_id`),
  ADD KEY `FK_Stu_Quizze` (`quizze_id`),
  ADD KEY `FK_Stu_Stu` (`student_id`);

--
-- Indexes for table `student_quizze_mistakes`
--
ALTER TABLE `student_quizze_mistakes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_sessions`
--
ALTER TABLE `student_sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sessions`
--
ALTER TABLE `tbl_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_sessions_user_id_index` (`user_id`),
  ADD KEY `tbl_sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `teacher_courses`
--
ALTER TABLE `teacher_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_TeacherC_Course` (`course_id`),
  ADD KEY `FK_TeacherC_Teacher` (`user_id`);

--
-- Indexes for table `teacher__courses`
--
ALTER TABLE `teacher__courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_tc_category` (`category_id`),
  ADD KEY `FK_tc_course` (`course_id`),
  ADD KEY `FK_tc_user` (`user_id`);

--
-- Indexes for table `usage_promo`
--
ALTER TABLE `usage_promo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Promo_User` (`user_id`),
  ADD KEY `FK_Promo_Promo` (`promo_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `FK_Teacher_Categories` (`category_id`),
  ADD KEY `FK_Teacher_Course` (`course_id`),
  ADD KEY `FK_User_UserAdmin` (`user_admin_id`);

--
-- Indexes for table `user_admins`
--
ALTER TABLE `user_admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_packages`
--
ALTER TABLE `user_packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Package_User` (`user_id`),
  ADD KEY `FK_User_Package` (`package_id`);

--
-- Indexes for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Wallet_Student` (`student_id`),
  ADD KEY `FK_Wallet_Method` (`payment_method_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_carts`
--
ALTER TABLE `academic_carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_roles`
--
ALTER TABLE `admin_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `affilate`
--
ALTER TABLE `affilate`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `affilate_requests`
--
ALTER TABLE `affilate_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `affilate_services`
--
ALTER TABLE `affilate_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `cancel_session`
--
ALTER TABLE `cancel_session`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `chapter_prices`
--
ALTER TABLE `chapter_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=539;

--
-- AUTO_INCREMENT for table `commissions`
--
ALTER TABLE `commissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `confirm_sign`
--
ALTER TABLE `confirm_sign`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `course_prices`
--
ALTER TABLE `course_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `dai_exam_mistakes`
--
ALTER TABLE `dai_exam_mistakes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=486;

--
-- AUTO_INCREMENT for table `diagnostic_exams`
--
ALTER TABLE `diagnostic_exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `diagnostic_exams_history`
--
ALTER TABLE `diagnostic_exams_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `dia_questions`
--
ALTER TABLE `dia_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `exam_codes`
--
ALTER TABLE `exam_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `exam_history`
--
ALTER TABLE `exam_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `exam_history_sections`
--
ALTER TABLE `exam_history_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_mistakes`
--
ALTER TABLE `exam_mistakes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=519;

--
-- AUTO_INCREMENT for table `exam_questions`
--
ALTER TABLE `exam_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `exam_sections`
--
ALTER TABLE `exam_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `exam_time`
--
ALTER TABLE `exam_time`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forget_passwords`
--
ALTER TABLE `forget_passwords`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `grid_ans`
--
ALTER TABLE `grid_ans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `group_days`
--
ALTER TABLE `group_days`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `group_students`
--
ALTER TABLE `group_students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `idea_lessons`
--
ALTER TABLE `idea_lessons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `live_courses`
--
ALTER TABLE `live_courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `live_lessons`
--
ALTER TABLE `live_lessons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `login_users`
--
ALTER TABLE `login_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT for table `marketings`
--
ALTER TABLE `marketings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `marketing_popups`
--
ALTER TABLE `marketing_popups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mcq_ans`
--
ALTER TABLE `mcq_ans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=270;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payment_orders`
--
ALTER TABLE `payment_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT for table `payment_package_order`
--
ALTER TABLE `payment_package_order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payment_requests`
--
ALTER TABLE `payment_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=325;

--
-- AUTO_INCREMENT for table `payouts`
--
ALTER TABLE `payouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `popup_pages`
--
ALTER TABLE `popup_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `popup_popup_pages`
--
ALTER TABLE `popup_popup_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `private_request`
--
ALTER TABLE `private_request`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `promo_chapters`
--
ALTER TABLE `promo_chapters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `promo_codes`
--
ALTER TABLE `promo_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `promo_courses`
--
ALTER TABLE `promo_courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `promo_packages`
--
ALTER TABLE `promo_packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `promo_users`
--
ALTER TABLE `promo_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `question_history`
--
ALTER TABLE `question_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `question_times`
--
ALTER TABLE `question_times`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `quizze_stu_ans`
--
ALTER TABLE `quizze_stu_ans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `q_ans`
--
ALTER TABLE `q_ans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `q_quizes`
--
ALTER TABLE `q_quizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;

--
-- AUTO_INCREMENT for table `report_questions`
--
ALTER TABLE `report_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `report_question_lists`
--
ALTER TABLE `report_question_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `report_videos`
--
ALTER TABLE `report_videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `report_video_lists`
--
ALTER TABLE `report_video_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `score_list`
--
ALTER TABLE `score_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=267;

--
-- AUTO_INCREMENT for table `score_sheet`
--
ALTER TABLE `score_sheet`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `session_attendance`
--
ALTER TABLE `session_attendance`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `session_days`
--
ALTER TABLE `session_days`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `session_groups`
--
ALTER TABLE `session_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `session_students`
--
ALTER TABLE `session_students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `small_packages`
--
ALTER TABLE `small_packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `student_quizzes`
--
ALTER TABLE `student_quizzes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `student_quizze_mistakes`
--
ALTER TABLE `student_quizze_mistakes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `student_sessions`
--
ALTER TABLE `student_sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `teacher_courses`
--
ALTER TABLE `teacher_courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `teacher__courses`
--
ALTER TABLE `teacher__courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usage_promo`
--
ALTER TABLE `usage_promo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `user_admins`
--
ALTER TABLE `user_admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_packages`
--
ALTER TABLE `user_packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_sessions`
--
ALTER TABLE `user_sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD CONSTRAINT `FK_AdminRoles_UserAdmin` FOREIGN KEY (`user_admin_id`) REFERENCES `user_admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `affilate`
--
ALTER TABLE `affilate`
  ADD CONSTRAINT `FK_Affilate_User` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `affilate_services`
--
ALTER TABLE `affilate_services`
  ADD CONSTRAINT `FK_Service_Affilate` FOREIGN KEY (`affilate_id`) REFERENCES `affilate` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cancel_session`
--
ALTER TABLE `cancel_session`
  ADD CONSTRAINT `FK_Cancel_Session` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Cancel_Student` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `FK_Categories_Teacher` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chapters`
--
ALTER TABLE `chapters`
  ADD CONSTRAINT `FK_Chapters_Teacher` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chapters_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chapter_prices`
--
ALTER TABLE `chapter_prices`
  ADD CONSTRAINT `FK_Price_Chapter` FOREIGN KEY (`chapter_id`) REFERENCES `chapters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `commissions`
--
ALTER TABLE `commissions`
  ADD CONSTRAINT `FK_Commision_User` FOREIGN KEY (`user_id`) REFERENCES `affilate` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `FK_Course_Teacher` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `courses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course_prices`
--
ALTER TABLE `course_prices`
  ADD CONSTRAINT `FK_Price_Course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dai_exam_mistakes`
--
ALTER TABLE `dai_exam_mistakes`
  ADD CONSTRAINT `FK_Mistakes_History` FOREIGN KEY (`student_exam_id`) REFERENCES `diagnostic_exams_history` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Mistakes_Question` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `diagnostic_exams`
--
ALTER TABLE `diagnostic_exams`
  ADD CONSTRAINT `FK_Dia_Course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Dia_Score` FOREIGN KEY (`score_id`) REFERENCES `score_sheet` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `diagnostic_exams_history`
--
ALTER TABLE `diagnostic_exams_history`
  ADD CONSTRAINT `FK_DiaHistory_Dia` FOREIGN KEY (`diagnostic_exams_id`) REFERENCES `diagnostic_exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_DiaHistory_User` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dia_questions`
--
ALTER TABLE `dia_questions`
  ADD CONSTRAINT `FK_DiaExam` FOREIGN KEY (`diagnostic_exam_id`) REFERENCES `diagnostic_exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Question` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `FK_Exam_Course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Exam_Score` FOREIGN KEY (`score_id`) REFERENCES `score_sheet` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Exam_Time` FOREIGN KEY (`code_id`) REFERENCES `exam_codes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_history`
--
ALTER TABLE `exam_history`
  ADD CONSTRAINT `FK_EHistory_Exam` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_EHistory_Student` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_history_sections`
--
ALTER TABLE `exam_history_sections`
  ADD CONSTRAINT `FK_ExamHistorySec_ExamHistory` FOREIGN KEY (`exam_history_id`) REFERENCES `exam_history` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ExamHistorySec_ExamSec` FOREIGN KEY (`exam_section_id`) REFERENCES `exam_sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_mistakes`
--
ALTER TABLE `exam_mistakes`
  ADD CONSTRAINT `FK_EMistakes_History` FOREIGN KEY (`student_exam_id`) REFERENCES `exam_history` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_EMistakes_Question` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_EMistakes_User` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_questions`
--
ALTER TABLE `exam_questions`
  ADD CONSTRAINT `FK_ExamQ_ExamSec` FOREIGN KEY (`section_id`) REFERENCES `exam_sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Exam_Exam` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Exam_Question` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_sections`
--
ALTER TABLE `exam_sections`
  ADD CONSTRAINT `FK_ExamSections_Exam` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_time`
--
ALTER TABLE `exam_time`
  ADD CONSTRAINT `FK_ExamTime_Exam` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ExamTime_User` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `grid_ans`
--
ALTER TABLE `grid_ans`
  ADD CONSTRAINT `FK_Grid_Question` FOREIGN KEY (`q_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `group_days`
--
ALTER TABLE `group_days`
  ADD CONSTRAINT `FK_GDays_Group` FOREIGN KEY (`group_id`) REFERENCES `session_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `group_students`
--
ALTER TABLE `group_students`
  ADD CONSTRAINT `FK_GStu_Group` FOREIGN KEY (`group_id`) REFERENCES `session_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_GStu_Student` FOREIGN KEY (`stu_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `idea_lessons`
--
ALTER TABLE `idea_lessons`
  ADD CONSTRAINT `FK_Idea_Lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `FK_Lesson_Chapter` FOREIGN KEY (`chapter_id`) REFERENCES `chapters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Lesson_Teacher` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `live_courses`
--
ALTER TABLE `live_courses`
  ADD CONSTRAINT `FK_Live_Course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Live_Users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `live_lessons`
--
ALTER TABLE `live_lessons`
  ADD CONSTRAINT `FK_LiveLesson_Lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_LiveLesson_Users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `login_users`
--
ALTER TABLE `login_users`
  ADD CONSTRAINT `FK_Login_User` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `marketings`
--
ALTER TABLE `marketings`
  ADD CONSTRAINT `FK_Maketing_Affilate` FOREIGN KEY (`affilate_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Maketing_Chapter` FOREIGN KEY (`chapter_id`) REFERENCES `chapters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Maketing_Course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Maketing_Student` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mcq_ans`
--
ALTER TABLE `mcq_ans`
  ADD CONSTRAINT `FK_MCQ_Q` FOREIGN KEY (`q_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment_orders`
--
ALTER TABLE `payment_orders`
  ADD CONSTRAINT `FK_Order_Chapter` FOREIGN KEY (`chapter_id`) REFERENCES `chapters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Order_Request` FOREIGN KEY (`payment_request_id`) REFERENCES `payment_requests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment_package_order`
--
ALTER TABLE `payment_package_order`
  ADD CONSTRAINT `FK_Order_PRequest` FOREIGN KEY (`payment_request_id`) REFERENCES `payment_requests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Order_Package` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment_requests`
--
ALTER TABLE `payment_requests`
  ADD CONSTRAINT `FK_Pay_Method` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_method` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Pay_User` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payouts`
--
ALTER TABLE `payouts`
  ADD CONSTRAINT `FK_Payment_Method` FOREIGN KEY (`payment_method`) REFERENCES `payment_method` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Payout_Affilate` FOREIGN KEY (`affilate_id`) REFERENCES `affilate` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `popup_popup_pages`
--
ALTER TABLE `popup_popup_pages`
  ADD CONSTRAINT `FK_Popup_Page` FOREIGN KEY (`popup_page_id`) REFERENCES `popup_pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Popup_Popup` FOREIGN KEY (`marketing_popup_id`) REFERENCES `marketing_popups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `private_request`
--
ALTER TABLE `private_request`
  ADD CONSTRAINT `FK_Private_Teacher` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Private_User` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `promo_courses`
--
ALTER TABLE `promo_courses`
  ADD CONSTRAINT `FK_Course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Promo` FOREIGN KEY (`promo_id`) REFERENCES `promo_codes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `promo_packages`
--
ALTER TABLE `promo_packages`
  ADD CONSTRAINT `FK_PromoPackage_Package` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_PromoPackage_Promo` FOREIGN KEY (`promo_id`) REFERENCES `promo_codes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `promo_users`
--
ALTER TABLE `promo_users`
  ADD CONSTRAINT `FK_PromoC` FOREIGN KEY (`promo_id`) REFERENCES `promo_codes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `FK_Q_Lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD CONSTRAINT `FK_Quizze_Lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `q_ans`
--
ALTER TABLE `q_ans`
  ADD CONSTRAINT `FK_Answer_Question` FOREIGN KEY (`Q_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `q_quizes`
--
ALTER TABLE `q_quizes`
  ADD CONSTRAINT `FK_qq_Question` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_qq_Quizze` FOREIGN KEY (`quizze_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `report_questions`
--
ALTER TABLE `report_questions`
  ADD CONSTRAINT `FK_ReportQuestion_List` FOREIGN KEY (`list_id`) REFERENCES `report_question_lists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ReportQuestion_Question` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ReportQuestion_Student` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `report_videos`
--
ALTER TABLE `report_videos`
  ADD CONSTRAINT `FK_QReportVideo_Video` FOREIGN KEY (`q_video_id`) REFERENCES `q_ans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ReportVideo_Lists` FOREIGN KEY (`list_id`) REFERENCES `report_video_lists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ReportVideo_Student` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ReportVideo_Video` FOREIGN KEY (`lesson_video_id`) REFERENCES `idea_lessons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `score_list`
--
ALTER TABLE `score_list`
  ADD CONSTRAINT `FK_ScoreList_Score` FOREIGN KEY (`score_id`) REFERENCES `score_sheet` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `score_sheet`
--
ALTER TABLE `score_sheet`
  ADD CONSTRAINT `FK_Score_Course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `FK_Session_Lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Session_Teacher` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `session_attendance`
--
ALTER TABLE `session_attendance`
  ADD CONSTRAINT `FK_Attendance_Session` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Attendance_User` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `session_groups`
--
ALTER TABLE `session_groups`
  ADD CONSTRAINT `FK_SessionG_Teacher` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `session_students`
--
ALTER TABLE `session_students`
  ADD CONSTRAINT `FK_Session` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Stu` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `small_packages`
--
ALTER TABLE `small_packages`
  ADD CONSTRAINT `FK_SmallPackage_Admin` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_SmallPackage_User` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_quizzes`
--
ALTER TABLE `student_quizzes`
  ADD CONSTRAINT `FK_Stu_Lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Stu_Quizze` FOREIGN KEY (`quizze_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Stu_Stu` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher_courses`
--
ALTER TABLE `teacher_courses`
  ADD CONSTRAINT `FK_TeacherC_Course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_TeacherC_Teacher` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher__courses`
--
ALTER TABLE `teacher__courses`
  ADD CONSTRAINT `FK_tc_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tc_course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tc_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usage_promo`
--
ALTER TABLE `usage_promo`
  ADD CONSTRAINT `FK_Promo_Promo` FOREIGN KEY (`promo_id`) REFERENCES `promo_codes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Promo_User` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_Teacher_Categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Teacher_Course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_User_UserAdmin` FOREIGN KEY (`user_admin_id`) REFERENCES `user_admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_packages`
--
ALTER TABLE `user_packages`
  ADD CONSTRAINT `FK_Package_User` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_User_Package` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wallets`
--
ALTER TABLE `wallets`
  ADD CONSTRAINT `FK_Wallet_Method` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_method` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Wallet_Student` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
