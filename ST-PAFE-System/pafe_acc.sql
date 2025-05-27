-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 27, 2025 at 10:51 AM
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
-- Table structure for table `pafe_acc`
--

CREATE TABLE `pafe_acc` (
  `id` int NOT NULL,
  `img` blob,
  `firstname` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pafe_acc`
--

INSERT INTO `pafe_acc` (`id`, `img`, `firstname`, `lastname`, `email`, `password`, `role`) VALUES
(1234, NULL, 'IJPE', 'gwapo', 'rouenmayaay@gmail.com', '$2y$10$YJbfexNHwfolDVNVpPW/X.Shd/Kp55lmMWKFDWA6HIs3LwZhYEwy6', 'officer'),
(2003, NULL, 'admin', 'admin', 'admin@gmail.com', '$2y$10$pspBtsUvght4PmWt8MzOuufdOEeBBfw6hugdJh4kTEuDcPirZsxMm', 'officer'),
(2023305122, NULL, 'Jevi', 'Bantiad', 'jevi@gmail.com', '$2y$10$MYL7t0X4jcfJyaBumbmcMOOTUqIBcPOfW2TvfQ8d70E7q2XNT28cu', 'officer'),
(2023305123, NULL, 'Me', 'oha', 'mkjjyj@gmail.com', '$2y$10$q1p9okINQ12GG8u7hXJ9puRcgG//TP9afLNp/k6LN8fz1uEcHalCK', 'student'),
(2023306356, NULL, 'Ian', 'Duman-ag', 'kdumz23@gmail.com', '$2y$10$VUUAPDPvt44W0rsod4l21uIfn7kH75GJogNpNTQhhbU6bSF2Yar3S', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pafe_acc`
--
ALTER TABLE `pafe_acc`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
