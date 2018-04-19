-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2018 at 06:00 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbimage`
--

CREATE TABLE `tbimage` (
  `imageID` int(10) NOT NULL,
  `imagePath` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `DateCreated` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbimage`
--

INSERT INTO `tbimage` (`imageID`, `imagePath`, `DateCreated`) VALUES
(33, '/image/atmbanking/19-04-2018/rollerlarry', '19-04-2018'),
(34, '/image/atmbanking/19-04-2018/rollerlarry', '19-04-2018'),
(35, '/image/atmbanking/19-04-2018/rollerlarry', '19-04-2018'),
(36, '/image/atmbanking/19-04-2018/rollerlarry', '19-04-2018'),
(37, '/image/atmbanking/19-04-2018/rollerlarry', '19-04-2018'),
(38, '/image/atmbanking/19-04-2018/rollerlarry', '19-04-2018'),
(39, '/image/atmbanking/19-04-2018/rollerlarry', '19-04-2018'),
(40, '/image/vpn/19-04-2018/roller', '19-04-2018'),
(41, '/image/vpn/19-04-2018/roller', '19-04-2018'),
(42, '/image/vpn/19-04-2018/roller', '19-04-2018');

-- --------------------------------------------------------

--
-- Table structure for table `tbproject`
--

CREATE TABLE `tbproject` (
  `projectID` int(10) NOT NULL,
  `projectName` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `folderName` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbproject`
--

INSERT INTO `tbproject` (`projectID`, `projectName`, `folderName`) VALUES
(1, 'Project A', 'project_a'),
(2, 'ABC', 'abc'),
(7, 'ABC', 'abc'),
(72, 'ATM Banking', 'atmbanking'),
(73, 'ATM Banking', 'atmbanking'),
(74, 'ATM Banking', 'atmbanking'),
(75, 'ATM Banking', 'atmbanking'),
(76, 'ATM Banking', 'atmbanking'),
(77, 'VPN', 'vpn'),
(78, 'VPN', 'vpn'),
(79, 'VPN', 'vpn');

-- --------------------------------------------------------

--
-- Table structure for table `tbuser`
--

CREATE TABLE `tbuser` (
  `userID` int(11) NOT NULL,
  `fullName` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `userName` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbuser`
--

INSERT INTO `tbuser` (`userID`, `fullName`, `userName`, `password`) VALUES
(1, 'Roller Larry', 'rollerlarry', '33'),
(2, 'Aden Hazzah', 'adenhazzah', '123456'),
(23, 'Alex Nguyen', 'alexnguyen', '111');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbimage`
--
ALTER TABLE `tbimage`
  ADD PRIMARY KEY (`imageID`);

--
-- Indexes for table `tbproject`
--
ALTER TABLE `tbproject`
  ADD PRIMARY KEY (`projectID`);

--
-- Indexes for table `tbuser`
--
ALTER TABLE `tbuser`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbimage`
--
ALTER TABLE `tbimage`
  MODIFY `imageID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbproject`
--
ALTER TABLE `tbproject`
  MODIFY `projectID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `tbuser`
--
ALTER TABLE `tbuser`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
