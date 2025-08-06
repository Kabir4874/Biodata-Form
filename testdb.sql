-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2025 at 12:25 PM
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
-- Database: `testdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `biodata`
--

CREATE TABLE `biodata` (
  `id` int(11) NOT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `full_name` varchar(100) NOT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `date_of_birth` date NOT NULL,
  `age` int(11) DEFAULT NULL,
  `height` varchar(20) DEFAULT NULL,
  `weight` varchar(20) DEFAULT NULL,
  `gender` enum('male','female','other') NOT NULL DEFAULT 'male',
  `religion` enum('hindu','muslim','christian','sikh','jain','buddhist','other') NOT NULL,
  `caste` varchar(50) DEFAULT NULL,
  `mother_tongue` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text DEFAULT NULL,
  `education` enum('high-school','diploma','graduate','post-graduate','doctorate','other') DEFAULT NULL,
  `degree` varchar(100) DEFAULT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `income` varchar(50) DEFAULT NULL,
  `organization` varchar(100) DEFAULT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `father_occupation` varchar(100) DEFAULT NULL,
  `mother_name` varchar(100) DEFAULT NULL,
  `mother_occupation` varchar(100) DEFAULT NULL,
  `siblings` varchar(100) DEFAULT NULL,
  `family_type` enum('joint','nuclear') DEFAULT NULL,
  `family_values` set('traditional','moderate','liberal') DEFAULT NULL,
  `pref_age` varchar(20) DEFAULT NULL,
  `pref_height` varchar(20) DEFAULT NULL,
  `pref_religion` enum('hindu','muslim','christian','sikh','jain','buddhist') DEFAULT NULL,
  `pref_caste` varchar(50) DEFAULT NULL,
  `pref_education` varchar(100) DEFAULT NULL,
  `pref_profession` varchar(100) DEFAULT NULL,
  `about_yourself` text DEFAULT NULL,
  `partner_expectations` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `biodata`
--

INSERT INTO `biodata` (`id`, `profile_photo`, `full_name`, `nickname`, `date_of_birth`, `age`, `height`, `weight`, `gender`, `religion`, `caste`, `mother_tongue`, `email`, `phone`, `address`, `education`, `degree`, `occupation`, `income`, `organization`, `father_name`, `father_occupation`, `mother_name`, `mother_occupation`, `siblings`, `family_type`, `family_values`, `pref_age`, `pref_height`, `pref_religion`, `pref_caste`, `pref_education`, `pref_profession`, `about_yourself`, `partner_expectations`, `created_at`, `updated_at`) VALUES
(4, '17544737171-intro-photo-final.jpg', 'Kabir Ahmed Ridoy', 'Inez Castillo', '1992-03-26', 78, '4', '3', 'female', 'buddhist', 'Eu deserunt elit an', 'At sit vitae quidem ', 'kabir.cse.bd@gmail.com', '+8801886807343', '90/3-A, Darusslam, Mirpur, Dhaka-1216', 'high-school', 'Modi recusandae Ad ', 'Itaque iure mollitia', '876', 'Kane Jarvis Co', 'Kelsie Sharpe', 'Odio eos inventore ', 'Alana Knapp', 'Dolor voluptate inci', '2', 'nuclear', 'traditional,moderate,liberal', '2', '2', 'muslim', 'Non voluptatibus qua', 'Minim quidem ad lore', 'Esse id nihil ipsum', 'Sit dolorem quibusda', 'Qui amet harum dolo', '2025-08-06 09:48:37', '2025-08-06 10:15:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Kabir Ahmed Ridoy', 'kabir@gmail.com', '$2y$10$0ytSv/T4DBNUyQvlH8VU4OGhs2okkWRKd4x45TeSWX4cEWyN7hnyy', '2025-08-06 09:43:16', '2025-08-06 09:43:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biodata`
--
ALTER TABLE `biodata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `biodata`
--
ALTER TABLE `biodata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
