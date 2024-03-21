-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 29, 2024 at 04:58 PM
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
-- Database: `bookwise`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminUsername` varchar(20) NOT NULL,
  `adminPassword` varchar(20) NOT NULL,
  `adminFirstName` varchar(20) DEFAULT NULL,
  `adminLastName` varchar(20) DEFAULT NULL,
  `adminGender` varchar(6) DEFAULT NULL,
  `adminNRIC` varchar(20) DEFAULT NULL,
  `adminPhone` varchar(15) DEFAULT NULL,
  `adminEmail` varchar(20) DEFAULT NULL,
  `adminAddress` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminUsername`, `adminPassword`, `adminFirstName`, `adminLastName`, `adminGender`, `adminNRIC`, `adminPhone`, `adminEmail`, `adminAddress`) VALUES
('admin123', 'password', 'Sang', 'Admin', 'Male', '680210015908', '0188727579', 'admin@gmail.com', 'Unisel Bestari Jaya');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bookingID` varchar(50) NOT NULL,
  `resourceID` varchar(15) NOT NULL,
  `userUsername` varchar(20) NOT NULL,
  `bookingDate` date NOT NULL,
  `bookingStartTime` time NOT NULL,
  `bookingEndTime` time NOT NULL,
  `bookingDuration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bookingID`, `resourceID`, `userUsername`, `bookingDate`, `bookingStartTime`, `bookingEndTime`, `bookingDuration`) VALUES
('amsyar_nz_1709141151_7045', 'key01', 'amsyar_nz', '2024-03-01', '09:00:00', '10:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedbackID` varchar(100) NOT NULL,
  `userUsername` varchar(20) NOT NULL,
  `userFirstName` varchar(20) NOT NULL,
  `userLastName` varchar(20) NOT NULL,
  `userEmail` varchar(50) NOT NULL,
  `userPhone` varchar(15) NOT NULL,
  `feedbackType` varchar(30) NOT NULL,
  `feedbackDescription` varchar(255) NOT NULL,
  `feedbackStatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedbackID`, `userUsername`, `userFirstName`, `userLastName`, `userEmail`, `userPhone`, `feedbackType`, `feedbackDescription`, `feedbackStatus`) VALUES
('amsyar_nz_1708743810', 'amsyar_nz', 'Amsyar', 'Zahran', 'amsyar.zahran@gmail.com', '+601128253665', 'Improvement Recommendation', 'Please add more toilet ', 'Submitted'),
('amsyar_nz_1708743828', 'amsyar_nz', 'Amsyar', 'Zahran', 'amsyar.zahran@gmail.com', '+601128253665', 'Complaint', 'The trash bin is not emptied on time, too much rubbish', 'Submitted');

-- --------------------------------------------------------

--
-- Table structure for table `resourceinfo`
--

CREATE TABLE `resourceinfo` (
  `resourceID` varchar(20) NOT NULL,
  `resourceType` varchar(20) NOT NULL,
  `resourceName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resourceinfo`
--

INSERT INTO `resourceinfo` (`resourceID`, `resourceType`, `resourceName`) VALUES
('key01', 'Key', 'BK01'),
('key02', 'Key', 'GL002'),
('key03', 'Key', 'BK03'),
('key04', 'Key', 'BS4');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userUsername` varchar(20) NOT NULL,
  `userFirstName` varchar(20) DEFAULT NULL,
  `userLastName` varchar(20) DEFAULT NULL,
  `userNRIC` varchar(15) DEFAULT NULL,
  `userPassword` varchar(20) NOT NULL,
  `userGender` varchar(10) DEFAULT NULL,
  `userPhone` varchar(15) DEFAULT NULL,
  `userEmail` varchar(50) DEFAULT NULL,
  `userAddress` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userUsername`, `userFirstName`, `userLastName`, `userNRIC`, `userPassword`, `userGender`, `userPhone`, `userEmail`, `userAddress`) VALUES
('amsyar_nz', 'Amsyar', 'Zahran', '020210140197', 'password', 'Student', '+601128253665', 'amsyar.zahran@gmail.com', 'No 36, Lot 1175, Kampung Haji Pahlil,  Batu 15 Dusun Tua, 43100, Hulu Langat, Selangor'),
('new2', 'newuse', 'adlafwef', '12454363623535', 'password', 'Student', '124356363', 'new2@gmail.com', 'unisel'),
('newuser', 'new', 'user', '020210141242332', 'password', 'Lecturer', '02342353245', 'new1@gmail.com', 'unisel\r\n'),
('qyhaaaa', 'Faqihah', 'Insyirah', '030817110552', 'password', 'Male', '0188727579', 'faqihah.insyirah@gmail.com', 'Jerteh Terengganu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminUsername`),
  ADD UNIQUE KEY `adminNRIC` (`adminNRIC`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bookingID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedbackID`);

--
-- Indexes for table `resourceinfo`
--
ALTER TABLE `resourceinfo`
  ADD PRIMARY KEY (`resourceID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userUsername`),
  ADD UNIQUE KEY `userNRIC` (`userNRIC`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
