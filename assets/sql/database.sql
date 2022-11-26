-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 26, 2022 at 11:05 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`id`, `name`) VALUES
(1, 'Power Of Memory');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL DEFAULT '1',
  `difficulty` varchar(8) NOT NULL,
  `score` float NOT NULL,
  `tries` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `score`
--

INSERT INTO `score` (`id`, `player_id`, `game_id`, `difficulty`, `score`, `tries`, `date`) VALUES
(4, 6, 1, 'easy', 3.09, 5, '2022-11-26 11:55:06'),
(5, 6, 1, 'easy', 11.6, 10, '2022-11-26 12:00:34'),
(6, 6, 1, 'easy', 113, 27, '2022-11-26 12:08:57'),
(7, 6, 1, 'normal', 75.1, 14, '2022-11-26 12:10:28'),
(9, 7, 1, 'easy', 1.46, 7, '2022-11-26 14:42:13'),
(10, 6, 1, 'easy', 2.87, 2, '2022-11-26 17:57:02'),
(11, 6, 1, 'easy', 2.4, 2, '2022-11-26 17:57:27'),
(12, 6, 1, 'easy', 1.58, 2, '2022-11-26 23:59:33');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `username` varchar(16) NOT NULL,
  `pass` char(60) NOT NULL,
  `bio` varchar(128) DEFAULT NULL,
  `pic` varchar(50) NOT NULL DEFAULT 'default.jpg',
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `connection_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `pass`, `bio`, `pic`, `creation_date`, `connection_date`) VALUES
(6, 'jeanjuste.lefebvre@gmail.com', 'JIJI', '$2y$10$ZUG.yajKWToaVBZ.7VkzWuCfUShWckFLIDemFutbv1mjIB6/vY6.q', NULL, 'default.jpg', '2022-11-21 00:15:07', '2022-11-27 00:05:03'),
(7, 'jiji@yahoo.com', 'LeJI', '$2y$10$AED9jcIU7aadGyJLpoZfee7Va/QKN5NuG8IpMNbdMOSkRvmCRKGuO', NULL, 'default.jpg', '2022-11-21 00:17:14', '2022-11-26 21:28:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`id`),
  ADD KEY `player_id` (`player_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `score`
--
ALTER TABLE `score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
