-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2026 at 09:24 AM
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
-- Database: `smartflood_sensor`
--

-- --------------------------------------------------------

--
-- Table structure for table `flood_sensors`
--

CREATE TABLE `flood_sensors` (
  `id` int(11) NOT NULL,
  `location_name` varchar(100) NOT NULL,
  `water_level_cm` int(11) DEFAULT 0,
  `status` enum('Aman','Siaga','Bahaya') DEFAULT 'Aman',
  `latest_photo` varchar(255) DEFAULT NULL,
  `last_updated` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flood_sensors`
--

INSERT INTO `flood_sensors` (`id`, `location_name`, `water_level_cm`, `status`, `latest_photo`, `last_updated`) VALUES
(1, 'Jembatan Dayeuhkolot', 115, 'Bahaya', NULL, '2026-06-04 12:45:04'),
(2, 'Jalan Telekomunikasi (Depan Telyu)', 25, 'Aman', NULL, '2026-06-04 12:45:04'),
(3, 'Bojongsoang Raya', 60, 'Siaga', NULL, '2026-06-04 12:45:04'),
(4, 'Baleendah Andir', 140, 'Bahaya', NULL, '2026-06-04 12:45:04'),
(5, 'Sungai Citarum Sektor 6', 45, 'Aman', NULL, '2026-06-04 12:45:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin_banjir', '$2y$10$wz8J2p1w.x.F9O8oP1l3.uG3G5I4M9y6D8K9O2x3A1s2D3F4G5H6J', 'admin'),
(2, 'Rakha', '$2y$10$dco6nnCBThYkNZLuCw6/XOXWAcqhkRNisGUc8dicEPL7RFH2gY3qS', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `flood_sensors`
--
ALTER TABLE `flood_sensors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `flood_sensors`
--
ALTER TABLE `flood_sensors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
