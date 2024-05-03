-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 03, 2024 at 03:00 PM
-- Server version: 11.3.2-MariaDB
-- PHP Version: 8.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `calmcenter_1`
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

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `client_id`, `guest_name`, `guest_email`, `counsellor_id`, `service_id`, `appointment_date`, `start_time`, `end_time`, `appointment_status`, `note`, `created`, `modified`) VALUES
(20, 19, NULL, NULL, 18, 2, '2024-05-10', '14:41:42', '16:21:42', 'Scheduled', '', '2024-05-03 07:41:54', '2024-05-03 07:41:54');

-- --------------------------------------------------------

--
-- Table structure for table `content_blocks`
--

CREATE TABLE `content_blocks` (
  `id` int(11) NOT NULL,
  `parent` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `label` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `type` varchar(32) NOT NULL,
  `value` text DEFAULT NULL,
  `previous_value` text DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `content_blocks`
--

INSERT INTO `content_blocks` (`id`, `parent`, `slug`, `label`, `description`, `type`, `value`, `previous_value`, `modified`) VALUES
(1, 'global', 'website-title', 'Website Title', 'Shown on the home page, as well as any tabs in the users browser.', 'text', 'Calm Wellness Center', 'Calm Wellness Cent', '2024-05-03 14:25:18'),
(2, 'global', 'logo', 'Logo', 'Shown in the centre of the home page, and also in the top corner of all administration pages.', 'image', '/content-blocks/uploads/logo.8e774dd74cd293fb17f94cdef818573a.jpg', NULL, '2024-05-03 14:27:57'),
(3, 'home', 'home-content', 'Home Page Content', 'The main content shown in the centre of the home page.', 'html', '<p>Client Calm Wellness Centre focuses on conducting counselling sessions with customers,<br />mostly those with chronic fatigue syndrome, locally, within Australia.<br />The intent is to keep up with the current business climate and move from pen and paper<br />to having an online system with a website attracting customers and educating the public.</p>', '<p>Example app showcasing the <code>ugie-cake/cakephp-content-blocks</code> plugin.</p>', '2024-05-03 14:28:52'),
(4, 'home', 'copyright-message', 'Copyright Message', 'Copyright information shown at the bottom of the home page.', 'text', 'Copyright &copy; Team007 2024', 'Copyright &copy; Team007', '2024-05-03 14:50:44'),
(5, 'home', 'contact-us', 'Contact Us', 'The contact us info that is displayed on the home page.', 'html', '<p><a href=\"mailto:admin@team007.u24s1007.monash-ie.me\">Send email</a></p>', '<p><a href=\"mailto:admin@team007.u24s1007.monash-ie.me\">Send email</a></p>', '2024-05-03 14:29:26');

-- --------------------------------------------------------

--
-- Table structure for table `content_blocks_phinxlog`
--

CREATE TABLE `content_blocks_phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `content_blocks_phinxlog`
--

INSERT INTO `content_blocks_phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20230402063959, 'ContentBlocksMigration', '2024-05-02 19:08:36', '2024-05-02 19:08:36', 0);

-- --------------------------------------------------------

--
-- Table structure for table `phinxlog`
--

CREATE TABLE `phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(17, 'sujeewa', 'Darshani', 'sujeewadrashani@gmail.com', '$2y$10$niY/PzMOwyLjLHhNZfIqkOc/S4kNVrwhKKdo3KsPdECVh.IecvWW2', 'Client', 'Male', '2024-04-30', '0000000000', 'Monash ', '', '2024-04-17 23:33:00', '2024-04-17 23:33:00', NULL, NULL),
(18, 'Harriet', 'T', 'counsellor@gmail.com', '$2y$10$kD6qtt6WAOiGwR0Zz0qfL.RTbB8ZB3F3wstv95S17WXUeAqTjXJ/S', 'Counsellor', 'Male', '1010-10-10', '222', '222', 'the first counsellor of calm wellness center', '2024-04-21 09:05:35', '2024-04-21 09:05:35', NULL, NULL),
(19, 'Client', 'A', 'client@gmail.com', '$2y$10$dl8rkXPffhOKa09.tcqG7u9Ahr/a/lPQFOIzUF1RunHmErPg0NKS2', 'Client', 'Female', '2012-12-12', '2222', '2222', 'client a of the business', '2024-04-21 09:11:41', '2024-04-21 09:11:41', NULL, NULL),
(20, 'Gordon', 'L', 'glie0003@student.monash.edu', '$2y$10$wnMgzMzcYahlNBNl5V2y4eSPVWvkc/MIp4IX7H73K0/2J5rgXlQbK', 'Client', 'Male', '1900-12-12', '11111', '24 Bennett Street', 'bio of gordon', '2024-04-21 09:34:12', '2024-04-21 09:34:47', '6d340106c59efab71f513334d079c493476f31a101ac7055d89e168ed28758155fe8fb0712dc527954ec80dfeee640b44deef2180ab01c9de70810608f37179f', '2024-04-28 09:34:47');

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
-- Indexes for table `content_blocks`
--
ALTER TABLE `content_blocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content_blocks_phinxlog`
--
ALTER TABLE `content_blocks_phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `phinxlog`
--
ALTER TABLE `phinxlog`
  ADD PRIMARY KEY (`version`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `content_blocks`
--
ALTER TABLE `content_blocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
