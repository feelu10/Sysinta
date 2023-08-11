-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2023 at 05:26 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `academics`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `RefNum` int(11) NOT NULL,
  `SemNum` int(11) DEFAULT NULL,
  `CourseID` varchar(50) DEFAULT NULL,
  `Credits` int(11) DEFAULT NULL,
  `Campus` varchar(50) DEFAULT NULL,
  `Room` varchar(50) DEFAULT NULL,
  `Mon` varchar(3) DEFAULT NULL,
  `Tues` varchar(3) DEFAULT NULL,
  `Wed` varchar(3) DEFAULT NULL,
  `Thu` varchar(3) DEFAULT NULL,
  `Fri` varchar(3) DEFAULT NULL,
  `Sat` varchar(3) DEFAULT NULL,
  `Sun` varchar(3) DEFAULT NULL,
  `StartTime` time DEFAULT NULL,
  `EndTime` time DEFAULT NULL,
  `Instructor` varchar(50) DEFAULT NULL,
  `Grade` char(1) DEFAULT NULL,
  `Notes` text DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('student','admin') NOT NULL DEFAULT 'student',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_image` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `profile_image`, `birthdate`, `bio`, `address`) VALUES
(1, 'Student1', 'student1@example.com', '55A6A81EC7E09E5F84CA704C12364E74', 'student', '2023-08-07 13:55:21', NULL, '2000-01-01', 'This is a bio about Student1.', '1 Main St, Anytown, USA'),
(2, 'Student2', 'student2@example.com', '55A6A81EC7E09E5F84CA704C12364E74', 'student', '2023-08-07 13:55:22', NULL, '2000-01-02', 'This is a bio about Student2.', '2 Main St, Anytown, USA'),
(3, 'Student3', 'student3@example.com', '55A6A81EC7E09E5F84CA704C12364E74', 'student', '2023-08-07 13:55:22', NULL, '2000-01-03', 'This is a bio about Student3.', '3 Main St, Anytown, USA'),
(4, 'Student4', 'student4@example.com', '55A6A81EC7E09E5F84CA704C12364E74', 'student', '2023-08-07 13:55:22', NULL, '2000-01-04', 'This is a bio about Student4.', '4 Main St, Anytown, USA'),
(5, 'Student5', 'student5@example.com', '55A6A81EC7E09E5F84CA704C12364E74', 'student', '2023-08-07 13:55:22', NULL, '2000-01-05', 'This is a bio about Student5.', '5 Main St, Anytown, USA'),
(6, 'Student6', 'student6@example.com', '55A6A81EC7E09E5F84CA704C12364E74', 'student', '2023-08-07 13:55:22', NULL, '2000-01-06', 'This is a bio about Student6.', '6 Main St, Anytown, USA'),
(7, 'Student7', 'student7@example.com', '55A6A81EC7E09E5F84CA704C12364E74', 'student', '2023-08-07 13:55:23', NULL, '2000-01-07', 'This is a bio about Student7.', '6 Main St, Anytown, USA'),
(8, 'Student8', 'student8@example.com', '55A6A81EC7E09E5F84CA704C12364E74', 'student', '2023-08-07 13:55:23', NULL, '2000-01-08', 'This is a bio about Student8.', '6 Main St, Anytown, USA'),
(9, 'Student9', 'student9@example.com', '55A6A81EC7E09E5F84CA704C12364E74', 'student', '2023-08-07 13:55:23', NULL, '2000-01-09', 'This is a bio about Student9.', '6 Main St, Anytown, USA'),
(10, 'Student10', 'student10@example.com', '55A6A81EC7E09E5F84CA704C12364E74', 'student', '2023-08-07 13:55:23', NULL, '2000-01-10', 'This is a bio about Student10.', '6 Main St, Anytown, USA'),
(11, 'Student11', 'student11@example.com', '55A6A81EC7E09E5F84CA704C12364E74', 'student', '2023-08-07 13:55:23', NULL, '2000-01-11', 'This is a bio about Student11.', '6 Main St, Anytown, USA'),
(13, 'Student13', 'student13@example.com', '55A6A81EC7E09E5F84CA704C12364E74', 'student', '2023-08-07 13:55:23', NULL, '2000-01-13', 'This is a bio about Student13.', '6 Main St, Anytown, USA'),
(15, 'Student15', 'student15@example.com', '55A6A81EC7E09E5F84CA704C12364E74', 'student', '2023-08-07 13:55:23', NULL, '2000-01-15', 'This is a bio about Student15.', '6 Main St, Anytown, USA'),
(16, 'Student16', 'student16@example.com', '55A6A81EC7E09E5F84CA704C12364E74', 'student', '2023-08-07 13:55:23', NULL, '2000-01-16', 'This is a bio about Student16.', '6 Main St, Anytown, USA'),
(123, 'Student123', 'student123@example.com', '55A6A81EC7E09E5F84CA704C12364E74', 'student', '2023-08-07 13:55:23', NULL, '0000-00-00', 'This is a bio about Student123.', '6 Main St, Anytown, USA'),
(124, 'Mia Lyn Bungay', 'mia_lyn@gmail.com', '$2y$10$VaEnzj7VM6Em.s.4ZvRkaeuz97Tc21m/C4JlYfqdjApYQ1yu/vr5e', 'admin', '2023-08-07 15:25:23', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`RefNum`),
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
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `RefNum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90036;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
