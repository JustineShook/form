-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2026 at 02:46 AM
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
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` int(11) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `dob` date NOT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `civil_status` varchar(50) NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `place_of_birth` varchar(255) NOT NULL,
  `home_address` varchar(255) NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mother_last_name` varchar(100) DEFAULT NULL,
  `mother_first_name` varchar(100) DEFAULT NULL,
  `mother_middle_name` varchar(100) DEFAULT NULL,
  `father_last_name` varchar(100) DEFAULT NULL,
  `father_first_name` varchar(100) DEFAULT NULL,
  `father_middle_name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`id`, `last_name`, `first_name`, `middle_name`, `dob`, `sex`, `civil_status`, `nationality`, `place_of_birth`, `home_address`, `mobile_number`, `email`, `mother_last_name`, `mother_first_name`, `mother_middle_name`, `father_last_name`, `father_first_name`, `father_middle_name`, `created_at`) VALUES
(1, 'adad', 'asdasdas', 'sdasdasdsa', '0000-00-00', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, 'asdsa', '2026-01-14 00:27:51'),
(2, 'sadsad', 'dasd', 'adsas', '0000-00-00', '', '', 'asd', 'asd', 'asdasd', '', 'dasda', 'sdasd', 'asd', 'asdasd', 'asdasd', 'asdas', 'asdasd', '2026-01-14 00:27:51'),
(3, 'libios', 'shane', 'dadad', '2026-01-08', 'Female', 'Single', 'adacad', 'asdasdas', 'Sitio Long Dream, Bulacao', '51944984984984', 'justineshook123@gmail.com', 'libios', 'shane', 'dasdasdas', 'libios', 'shane', 'asdasdasd', '2026-01-14 00:49:49'),
(15, 'libios', 'shane', '', '2003-07-16', 'Female', 'Single', 'adacad', 'dasdasd', 'dasdasd', '09224238091', 'justineshook123@gmail.com', 'dasdasdasd', 'shane', 'dasdasdas', 'libios', 'dasdasd', 'asdasdasd', '2026-01-14 01:36:59'),
(16, 'libios', 'shane', 'dadad', '2026-01-15', 'Female', 'Single', 'adacad', 'asdasdas', 'asdasdas', '09224238091', 'loujustine123@gmail.com', 'asdasd', 'shane', 'dasdasdas', 'libios', 'dasdasd', 'asdasdasd', '2026-01-14 01:43:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_email` (`email`),
  ADD KEY `idx_mobile` (`mobile_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
