-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2024 at 08:42 PM
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
-- Database: `calm_table`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `guest_name` varchar(128) DEFAULT NULL,
  `guest_email` varchar(128) DEFAULT NULL,
  `counsellor_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `appointment_status` enum('Scheduled','Completed','Cancelled') DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `service_title` varchar(128) NOT NULL,
  `service_description` text NOT NULL,
  `duration` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_title`, `service_description`, `duration`, `price`, `created`, `modified`) VALUES
(2, 'Service 01', 'Service ', 100, 100.00, '2024-04-12 15:12:55', '2024-04-12 15:12:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(128) NOT NULL,
  `last_name` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Client','Counsellor','Admin') DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `date_of_birth` date NOT NULL,
  `phone_number` varchar(25) NOT NULL,
  `address` varchar(255) NOT NULL,
  `bio` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `nonce` varchar(255) DEFAULT NULL,
  `nonce_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role`, `gender`, `date_of_birth`, `phone_number`, `address`, `bio`, `created`, `modified`, `nonce`, `nonce_expiry`) VALUES
(15, 'admin', 'admin', 'admin@gmail.com', '$2y$10$rdO7tBFIL97Tk5262GSGC.6H9kv8zKbWkrT76yPQlS5bG0eDl4Uqi', 'Admin', 'Male', '2024-04-18', '0000000000', 'Monash ', '', '2024-04-17 22:31:48', '2024-04-20 18:28:54', 'e5442ef524c6ba87d923f005b1ff4f819c9b5524233a9bdac583e11f66522b92a4ff2819e3ba9c6326f61a90eac69d4c6e2d5cb97c48d4f2877b66f51faa323a', '2024-04-27 18:28:54'),
(17, 'sujeewa', 'Darshani', 'sujeewadrashani@gmail.com', '$2y$10$niY/PzMOwyLjLHhNZfIqkOc/S4kNVrwhKKdo3KsPdECVh.IecvWW2', 'Client', 'Male', '2024-04-30', '0000000000', 'Monash ', '', '2024-04-17 23:33:00', '2024-04-17 23:33:00', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `counsellor_id` (`counsellor_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`counsellor_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `appointments_ibfk_3` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
