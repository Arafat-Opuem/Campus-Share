-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2026 at 07:17 AM
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
-- Database: `campus_share`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrowrequests`
--

CREATE TABLE `borrowrequests` (
  `RequestID` int(11) NOT NULL,
  `ItemID` int(11) NOT NULL,
  `BorrowerID` int(11) NOT NULL,
  `StartDate` date NOT NULL,
  `ReturnDate` date NOT NULL,
  `Status` enum('Pending','Approved','Rejected','Returned') DEFAULT 'Pending',
  `RequestDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrowrequests`
--

INSERT INTO `borrowrequests` (`RequestID`, `ItemID`, `BorrowerID`, `StartDate`, `ReturnDate`, `Status`, `RequestDate`) VALUES
(1, 1, 7, '2026-08-14', '2026-08-16', 'Pending', '2026-08-12 21:47:49'),
(2, 3, 7, '2026-08-15', '2026-08-17', 'Pending', '2026-08-12 21:56:03'),
(3, 2, 7, '2026-08-18', '2026-08-24', 'Pending', '2026-08-16 08:12:03'),
(4, 2, 8, '2026-08-18', '2026-08-20', 'Pending', '2026-08-18 05:12:33');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(100) NOT NULL,
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`CategoryID`, `CategoryName`, `Description`) VALUES
(1, 'Electronics', 'Electronic and programming equipment'),
(2, 'Camera', 'Camera and photography equipment'),
(3, 'Lab Tools', 'Laboratory tools and equipment'),
(4, 'Books', 'Academic and reference books'),
(5, 'Accessories', 'Computer and electronic accessories'),
(6, 'Others', 'Other useful campus equipment');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `ItemID` int(11) NOT NULL,
  `OwnerID` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `ItemName` varchar(150) NOT NULL,
  `Description` text DEFAULT NULL,
  `ItemCondition` varchar(100) DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `Availability` enum('Available','Borrowed','Unavailable') DEFAULT 'Available',
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`ItemID`, `OwnerID`, `CategoryID`, `ItemName`, `Description`, `ItemCondition`, `Image`, `Availability`, `CreatedAt`) VALUES
(1, 5, 4, 'History Book', 'My history book is available', 'Good', NULL, 'Available', '2026-08-12 21:37:41'),
(2, 5, 1, 'Electric Wear', 'Electric Wear', 'Excellent', NULL, 'Available', '2026-08-12 21:40:25'),
(3, 8, 6, 'A4 Paper', 'I have a bunch of A4 Paper. If anyone need just request.', 'Excellent', NULL, 'Available', '2026-08-12 21:54:23');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `NotificationID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Message` text NOT NULL,
  `IsRead` tinyint(1) DEFAULT 0,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `ReturnID` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL,
  `ReturnDate` date NOT NULL,
  `ConditionAfterReturn` varchar(100) DEFAULT NULL,
  `Remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `UniversityID` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Department` varchar(100) DEFAULT NULL,
  `Role` enum('student','staff','admin') DEFAULT 'student',
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Name`, `UniversityID`, `Email`, `Password`, `Department`, `Role`, `CreatedAt`) VALUES
(1, 'Arafat Opu', '231014121', 'arafatopu35@gmail.com', '$2y$10$XTHb3KtRetv4RQDWomTOl.DmURCkafCA5Wqch0GwDiPeHCkt7Q6jG', 'CSE', 'student', '2026-08-12 19:51:02'),
(5, 'Arafat Opu', '231014124', 'arafatopu95@gmail.com', '$2y$10$WDEQsSFzmnMwPV1J8B73s.BaiDJ7ZLWLdVK6X/nXM2LI69sgGXjwC', 'CSE', 'student', '2026-08-12 19:53:54'),
(6, 'rohim', '2233441', 'rahim@22gmail.com', '$2y$10$AiWRWI5yfJg9yEanjLpA4el4WTyvFM3PYMrdko2r79n6/kEJWG6zW', 'CSE', 'student', '2026-08-12 21:46:18'),
(7, 'sabbir', '23134221', 'sabbirvai@gmail.com', '$2y$10$SNmdgo5D/6fhcyvF6uouqeflTHGlzXNXxIPwwJXJHMwUs//dbr1Ga', 'CSE', 'student', '2026-08-12 21:47:14'),
(8, 'Arafat Opu', '231123423', 'arafatopu40@gmail.com', '$2y$10$kybbnl4ugeV9J/byfEeq0ubXtKuJiKnad8reK1XKucPHM8htDT6g2', 'CSE', 'student', '2026-08-12 21:52:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borrowrequests`
--
ALTER TABLE `borrowrequests`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `ItemID` (`ItemID`),
  ADD KEY `BorrowerID` (`BorrowerID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`ItemID`),
  ADD KEY `OwnerID` (`OwnerID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`NotificationID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`ReturnID`),
  ADD KEY `RequestID` (`RequestID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `UniversityID` (`UniversityID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borrowrequests`
--
ALTER TABLE `borrowrequests`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `ItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `NotificationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `ReturnID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrowrequests`
--
ALTER TABLE `borrowrequests`
  ADD CONSTRAINT `borrowrequests_ibfk_1` FOREIGN KEY (`ItemID`) REFERENCES `items` (`ItemID`) ON DELETE CASCADE,
  ADD CONSTRAINT `borrowrequests_ibfk_2` FOREIGN KEY (`BorrowerID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`OwnerID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `items_ibfk_2` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`CategoryID`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `returns`
--
ALTER TABLE `returns`
  ADD CONSTRAINT `returns_ibfk_1` FOREIGN KEY (`RequestID`) REFERENCES `borrowrequests` (`RequestID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
