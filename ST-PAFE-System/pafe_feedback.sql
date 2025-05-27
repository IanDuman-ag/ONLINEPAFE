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
-- Table structure for table `pafe_feedback`
--

CREATE TABLE `pafe_feedback` (
  `id` int NOT NULL,
  `event_id` int NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `comment` text COLLATE utf8mb4_general_ci NOT NULL,
  `rating` int NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pafe_feedback`
--

INSERT INTO `pafe_feedback` (`id`, `event_id`, `user_name`, `comment`, `rating`, `created_at`) VALUES
(3, 3, 'HEYRANA, SILVER MAE S', 'wowowowow kamatyunon na ang mga it students sa ustp', 5, '2025-05-13 15:47:20'),
(4, 3, 'LABAD, ROBERT JR. DUNGO', 'adasd', 5, '2025-05-13 16:07:22'),
(5, 3, 'Redjan Phil S. Visitacion', 'wow great', 4, '2025-05-13 19:49:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pafe_feedback`
--
ALTER TABLE `pafe_feedback`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pafe_feedback`
--
ALTER TABLE `pafe_feedback`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
