-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2025 at 01:04 PM
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
-- Database: `khata_book`
--

-- --------------------------------------------------------

--
-- Table structure for table `daily`
--

CREATE TABLE `daily` (
  `id` int(11) NOT NULL,
  `investmentSource` varchar(100) NOT NULL,
  `investmentAmount` decimal(12,2) NOT NULL,
  `interestRate` decimal(5,2) DEFAULT NULL,
  `investmentType` varchar(50) NOT NULL,
  `investmentDate` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daily`
--

INSERT INTO `daily` (`id`, `investmentSource`, `investmentAmount`, `interestRate`, `investmentType`, `investmentDate`, `created_at`, `user_id`) VALUES
(1, 'business', 12000.00, 6.00, 'stock', '2025-07-29', '2025-07-29 10:52:43', NULL),
(2, 'business', 12000.00, 6.00, 'stock', '2025-07-29', '2025-07-29 10:55:07', NULL),
(3, 'business', 12000.00, 6.00, 'stock', '2025-07-29', '2025-07-29 10:59:45', NULL),
(4, 'business', 12000.00, 6.00, 'stock', '2025-07-29', '2025-07-29 10:59:51', NULL),
(5, 'dasd', 4343.00, 5.00, 'stock', '2025-07-29', '2025-07-29 11:01:27', NULL),
(6, 'dasd', 4343.00, 5.00, 'stock', '2025-07-29', '2025-07-29 11:01:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `daily_expenses`
--

CREATE TABLE `daily_expenses` (
  `id` int(11) NOT NULL,
  `expenseName` varchar(100) NOT NULL,
  `expenseAmount` decimal(12,2) NOT NULL,
  `expenseDate` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daily_expenses`
--

INSERT INTO `daily_expenses` (`id`, `expenseName`, `expenseAmount`, `expenseDate`, `created_at`) VALUES
(1, 'asdasd', 12323123.00, '2025-07-29', '2025-07-29 11:03:21'),
(2, '2121', 12121.00, '2025-07-29', '2025-07-29 11:28:32');

-- --------------------------------------------------------

--
-- Table structure for table `giventaken`
--

CREATE TABLE `giventaken` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` enum('giver','taker') NOT NULL,
  `AmountgivenTaken` decimal(12,2) NOT NULL,
  `dateGiven` date DEFAULT NULL,
  `dateTaken` date DEFAULT NULL,
  `dateReturning` date DEFAULT NULL,
  `transactionMessage` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `giventaken`
--

INSERT INTO `giventaken` (`id`, `name`, `status`, `AmountgivenTaken`, `dateGiven`, `dateTaken`, `dateReturning`, `transactionMessage`, `created_at`, `user_id`) VALUES
(1, 'shubham gond', 'giver', 5000.00, '2025-07-29', NULL, '2029-02-25', 'sasdas', '2025-07-29 11:02:55', NULL),
(2, '1212', 'giver', 1212.00, '2025-07-29', NULL, '2025-07-29', 'we', '2025-07-29 11:28:45', NULL),
(3, '1212', 'giver', 1212.00, '2025-07-29', NULL, '2025-07-29', 'we', '2025-07-29 11:29:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `id` int(11) NOT NULL,
  `incomeSource` varchar(100) NOT NULL,
  `totalAmount` decimal(12,2) NOT NULL,
  `incomeType` varchar(50) NOT NULL,
  `incomeDate` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`id`, `incomeSource`, `totalAmount`, `incomeType`, `incomeDate`, `created_at`, `user_id`) VALUES
(1, 'asdf', 44.00, 'business', '2025-07-29', '2025-07-29 10:50:25', NULL),
(2, 'asdf', 44.00, 'business', '2025-07-29', '2025-07-29 10:51:39', NULL),
(3, 'aa', 12121.00, 'salary', '2025-07-29', '2025-07-29 11:00:02', NULL),
(4, 'shailesh ', 200000.00, 'business', '2025-07-29', '2025-07-29 11:00:47', NULL),
(5, 'asdf', 9999999999.99, 'business', '2025-07-29', '2025-07-29 11:25:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_type` varchar(255) NOT NULL,
  `gender` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `email`, `dob`, `phone`, `profile_photo`, `password_hash`, `created_at`, `user_type`, `gender`) VALUES
(3, 'a', 'a', 'a', 'a@gmail.com', '2025-01-01', '1212121212', NULL, NULL, '2025-07-29 10:49:07', 'Personal Use', 'Male');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daily`
--
ALTER TABLE `daily`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `daily_expenses`
--
ALTER TABLE `daily_expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `giventaken`
--
ALTER TABLE `giventaken`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
-- AUTO_INCREMENT for table `daily`
--
ALTER TABLE `daily`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `daily_expenses`
--
ALTER TABLE `daily_expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `giventaken`
--
ALTER TABLE `giventaken`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daily`
--
ALTER TABLE `daily`
  ADD CONSTRAINT `daily_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `giventaken`
--
ALTER TABLE `giventaken`
  ADD CONSTRAINT `giventaken_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `income`
--
ALTER TABLE `income`
  ADD CONSTRAINT `income_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
