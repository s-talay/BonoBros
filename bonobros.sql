DROP DATABASE IF EXISTS `bonobros`;
CREATE DATABASE `bonobros`;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 31, 2023 at 04:23 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

USE `bonobros`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


--
-- Database: `bonobros`
--

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `gameid` int(11) UNSIGNED NOT NULL,
  `gamename` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `game`(`gameid`, `gamename`) VALUES ('1','Tic-Tac-Toe');

-- --------------------------------------------------------

--
-- Table structure for table `lobby`
--

CREATE TABLE `lobby` (
  `lobbyid` int(11) UNSIGNED NOT NULL,
  `state` varchar(30) NOT NULL,
  `gameid` int(10) UNSIGNED NOT NULL,
  `player1id` int(10) UNSIGNED NOT NULL,
  `player2id` int(10) UNSIGNED DEFAULT NULL,
  `winnerid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lobby`
--

INSERT INTO `lobby` (`lobbyid`, `state`, `gameid`, `player1id`, `player2id`, `winnerid`) VALUES
(1, 'open', 1, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `moves_tictactoe`
--

CREATE TABLE `moves_tictactoe` (
  `moveid` int(10) UNSIGNED NOT NULL,
  `lobbyid` int(10) UNSIGNED NOT NULL,
  `playerid` int(10) UNSIGNED NOT NULL,
  `movetype` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `admin`, `enabled`, `created_at`) VALUES
(1, 'admin@root.de', 'admin', '$2y$10$hLEuieqlq4QfXzJF/PC7kueDuICWsJ9mdVLBQ/fVK59wtxSkh/PUe', 1, 1, '2023-05-03 15:39:12'),
(2, 'user@user.de', 'user', '$2y$10$rHjjO47HsB1fdYO/uVey7.RQRcxM/eE0AWrHgqQ6DpBMErXKGdOsG', 0, 1, '2023-05-31 16:20:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`gameid`);

--
-- Indexes for table `lobby`
--
ALTER TABLE `lobby`
  ADD PRIMARY KEY (`lobbyid`);

--
-- Indexes for table `moves_tictactoe`
--
ALTER TABLE `moves_tictactoe`
  ADD PRIMARY KEY (`moveid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `gameid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lobby`
--
ALTER TABLE `lobby`
  MODIFY `lobbyid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `moves_tictactoe`
--
ALTER TABLE `moves_tictactoe`
  MODIFY `moveid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
