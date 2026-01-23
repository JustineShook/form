-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2026 at 02:18 PM
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
-- Database: `sss_registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `beneficiaries`
--

CREATE TABLE `beneficiaries` (
  `id` int(11) NOT NULL,
  `registrant_id` int(11) NOT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `suffix` varchar(10) DEFAULT NULL,
  `relationship` varchar(100) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `order_index` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `beneficiaries`
--

INSERT INTO `beneficiaries` (`id`, `registrant_id`, `last_name`, `first_name`, `middle_name`, `suffix`, `relationship`, `date_of_birth`, `order_index`, `created_at`, `updated_at`) VALUES
(1, 1, 'dsds', 'dsds', 'asdasd', 'asd', 'asdasd', '2026-01-16', 1, '2026-01-22 02:09:50', '2026-01-22 02:09:50'),
(2, 2, 'asd', 'asd', 'asd', 'asd', 'adsasd', '2026-01-27', 1, '2026-01-23 05:15:44', '2026-01-23 05:15:44');

-- --------------------------------------------------------

--
-- Table structure for table `children`
--

CREATE TABLE `children` (
  `id` int(11) NOT NULL,
  `registrant_id` int(11) NOT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `suffix` varchar(10) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `order_index` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `children`
--

INSERT INTO `children` (`id`, `registrant_id`, `last_name`, `first_name`, `middle_name`, `suffix`, `date_of_birth`, `order_index`, `created_at`, `updated_at`) VALUES
(1, 1, 'libios', 'shane', 'sad', 'sds', NULL, 1, '2026-01-22 02:09:50', '2026-01-22 02:09:50'),
(2, 2, 'asd', 'asd', 'asd', 'asd', '2025-12-30', 1, '2026-01-23 05:15:44', '2026-01-23 05:15:44');

-- --------------------------------------------------------

--
-- Table structure for table `registrants`
--

CREATE TABLE `registrants` (
  `id` int(11) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `date_of_birth` date NOT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `civil_status` enum('Single','Married','Widowed','Legally Separated','Others') NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `place_of_birth` varchar(255) NOT NULL,
  `same_address` tinyint(1) DEFAULT 0,
  `home_address` varchar(255) NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mother_last_name` varchar(100) NOT NULL,
  `mother_first_name` varchar(100) NOT NULL,
  `mother_middle_name` varchar(100) NOT NULL,
  `father_last_name` varchar(100) NOT NULL,
  `father_first_name` varchar(100) NOT NULL,
  `father_middle_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `registrants`
--

INSERT INTO `registrants` (`id`, `last_name`, `first_name`, `middle_name`, `date_of_birth`, `sex`, `civil_status`, `nationality`, `place_of_birth`, `same_address`, `home_address`, `mobile_number`, `email`, `mother_last_name`, `mother_first_name`, `mother_middle_name`, `father_last_name`, `father_first_name`, `father_middle_name`, `created_at`, `updated_at`) VALUES
(1, 'asdsda', 'asd', 'dasd', '2026-01-05', 'Female', 'Married', 'dasdasd', 'asdasdas', 1, 'asdasdas', '09224238091', 'dasda@gmail.com', 'asdasd', 'asdasdasdas', 'dasdasdasdas', 'dasd', 'asd', 'asd', '2026-01-22 02:09:50', '2026-01-22 02:09:50'),
(2, 'dasd', 'asdasdas', 'd', '2026-01-14', 'Female', 'Married', 'adacad', 'dasdasdasdasdasd', 1, 'dasdasdasdasdasd', '09224238091', 'asd@gmail.com', 'dasd', 'asd', 'asd', 'ads', 'asd', 'ads', '2026-01-23 05:15:44', '2026-01-23 05:15:44');

-- --------------------------------------------------------

--
-- Table structure for table `spouses`
--

CREATE TABLE `spouses` (
  `id` int(11) NOT NULL,
  `registrant_id` int(11) NOT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `suffix` varchar(10) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spouses`
--

INSERT INTO `spouses` (`id`, `registrant_id`, `last_name`, `first_name`, `middle_name`, `suffix`, `date_of_birth`, `created_at`, `updated_at`) VALUES
(1, 1, 'libios', 'das', 'dasdasd', 'asd', '2026-01-13', '2026-01-22 02:09:50', '2026-01-22 02:09:50'),
(2, 2, 'dasd', 'asd', 'asd', 'asd', '2026-01-18', '2026-01-23 05:15:44', '2026-01-23 05:15:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_registrant` (`registrant_id`),
  ADD KEY `idx_order` (`registrant_id`,`order_index`);

--
-- Indexes for table `children`
--
ALTER TABLE `children`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_registrant` (`registrant_id`),
  ADD KEY `idx_order` (`registrant_id`,`order_index`);

--
-- Indexes for table `registrants`
--
ALTER TABLE `registrants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_email` (`email`),
  ADD KEY `idx_mobile` (`mobile_number`),
  ADD KEY `idx_last_name` (`last_name`),
  ADD KEY `idx_created_at` (`created_at`);

--
-- Indexes for table `spouses`
--
ALTER TABLE `spouses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_registrant` (`registrant_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `children`
--
ALTER TABLE `children`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `registrants`
--
ALTER TABLE `registrants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `spouses`
--
ALTER TABLE `spouses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  ADD CONSTRAINT `beneficiaries_ibfk_1` FOREIGN KEY (`registrant_id`) REFERENCES `registrants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `children`
--
ALTER TABLE `children`
  ADD CONSTRAINT `children_ibfk_1` FOREIGN KEY (`registrant_id`) REFERENCES `registrants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `spouses`
--
ALTER TABLE `spouses`
  ADD CONSTRAINT `spouses_ibfk_1` FOREIGN KEY (`registrant_id`) REFERENCES `registrants` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
