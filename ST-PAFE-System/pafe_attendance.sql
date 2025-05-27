-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 27, 2025 at 11:37 AM
-- Server version: 8.0.42-0ubuntu0.20.04.1
-- PHP Version: 7.4.3-4ubuntu2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `societree`
--

-- --------------------------------------------------------

--
-- Table structure for table `pafe_attendance`
--

CREATE TABLE `pafe_attendance` (
  `id` int NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `gender` enum('Male','Female','Other') COLLATE utf8mb4_general_ci NOT NULL,
  `year_level` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `section` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `event_id` int NOT NULL,
  `status` enum('Pending','Approved','Rejected') COLLATE utf8mb4_general_ci DEFAULT 'Pending',
  `date` date NOT NULL,
  `time` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pafe_attendance`
--

INSERT INTO `pafe_attendance` (`id`, `fullname`, `gender`, `year_level`, `section`, `event_id`, `status`, `date`, `time`, `created_at`) VALUES
(15, 'DUMAN-AG, IAN KIRBY B.', '', '2', 'BSIT 2A', 13, 'Pending', '0000-00-00', '00:00:00', '2025-05-14 05:55:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pafe_attendance`
--
ALTER TABLE `pafe_attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pafe_attendance`
--
ALTER TABLE `pafe_attendance`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pafe_attendance`
--
ALTER TABLE `pafe_attendance`
  ADD CONSTRAINT `pafe_attendance_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `pafe_events` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
