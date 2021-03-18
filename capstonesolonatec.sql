-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2019 at 11:22 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capstonesolonatec`
--

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `gameID` int(11) NOT NULL,
  `gameName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `playerTag` varchar(50) DEFAULT NULL,
  `tournamentIDs` varchar(5000) DEFAULT NULL,
  `placings` varchar(5000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`playerTag`, `tournamentIDs`, `placings`) VALUES
('N80', '  Melee_Tournament_#1', '  1st'),
('Shifty', '  Melee_Tournament_#1', '  Not_Placed'),
('Underscores', '  Melee_Tournament_#1', '  4th'),
('Dredex99', '  Melee_Tournament_#1', '  Not_Placed'),
('amandabubbles', '  Melee_Tournament_#1', '  Not_Placed'),
('sllim300', '  Melee_Tournament_#1', '  3rd'),
('bmoricebowls', '  Melee_Tournament_#1', '  Not_Placed'),
('Test', '  Melee_Tournament_#1', '  2nd');

-- --------------------------------------------------------

--
-- Table structure for table `tournamentorganizers`
--

CREATE TABLE `tournamentorganizers` (
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `playerTag` varchar(50) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `tournamentsRan` varchar(5000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tournamentorganizers`
--

INSERT INTO `tournamentorganizers` (`username`, `password`, `playerTag`, `city`, `tournamentsRan`) VALUES
('Nate', '$2y$12$C/7tJrlIU1bNn0PjjjUzPeXnKdyvthsjwhQXhscxzzwdManzAoIvu', 'N80', 'Lincoln', NULL),
('admin', '$2y$12$jBITJez75n.B6TqIJ4yy4umbsyhj0l4UjJIgls1JAJ0ILgSMDM8J.', 'admin', 'Lincoln', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tournaments`
--

CREATE TABLE `tournaments` (
  `tournamentID` int(11) NOT NULL,
  `tournamentName` varchar(50) DEFAULT NULL,
  `tournamentCity` varchar(50) DEFAULT NULL,
  `tournamentOrganizers` varchar(5000) DEFAULT NULL,
  `dateHappened` varchar(50) DEFAULT NULL,
  `results` varchar(5000) DEFAULT NULL,
  `entrantCap` varchar(10) DEFAULT NULL,
  `gameName` varchar(100) DEFAULT NULL,
  `entrants` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tournaments`
--

INSERT INTO `tournaments` (`tournamentID`, `tournamentName`, `tournamentCity`, `tournamentOrganizers`, `dateHappened`, `results`, `entrantCap`, `gameName`, `entrants`) VALUES
(146, 'Melee Tournament #1', 'Lincoln', 'nate', '2019-12-11', '1st: N80 | 2nd: Test | 3rd: sllim300 | 4th: Underscores', '8', 'Smash_Bros_Melee', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`gameID`);

--
-- Indexes for table `tournaments`
--
ALTER TABLE `tournaments`
  ADD PRIMARY KEY (`tournamentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `gameID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tournaments`
--
ALTER TABLE `tournaments`
  MODIFY `tournamentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
