-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 19, 2022 at 07:17 PM
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
-- Table structure for table `jeux`
--

CREATE TABLE `jeux` (
  `IdJeu` int(11) NOT NULL,
  `NomJeu` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jeux`
--

INSERT INTO `jeux` (`IdJeu`, `NomJeu`) VALUES
(1, 'MemoryGame');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `IndentiMsg` int(11) NOT NULL,
  `IdJeu` int(11) NOT NULL,
  `IdExpe` int(11) NOT NULL,
  `Msg` varchar(280) NOT NULL,
  `DateHeureMsg` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`IndentiMsg`, `IdJeu`, `IdExpe`, `Msg`, `DateHeureMsg`) VALUES
(1, 1, 1, 'Fromage', '2022-11-09 13:45:17'),
(2, 1, 7, 'Je voudrais un bonhomme de neige', '2022-11-09 13:46:12'),
(3, 1, 8, 'Cochon', '2022-11-01 14:54:17');

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `IdentiScore` int(11) NOT NULL,
  `IdJoueur` int(11) NOT NULL,
  `IdJeu` int(11) NOT NULL,
  `DiffPartie` varchar(15) NOT NULL,
  `ScorePartie` int(11) NOT NULL,
  `DateHeurePartie` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `score`
--

INSERT INTO `score` (`IdentiScore`, `IdJoueur`, `IdJeu`, `DiffPartie`, `ScorePartie`, `DateHeurePartie`) VALUES
(6, 1, 1, 'Facile', 4200, '2022-11-09'),
(7, 9, 1, 'Facile', 2830, '2022-11-09'),
(8, 7, 1, 'Normal', 6030, '2022-11-09'),
(9, 8, 1, 'Normal', 7420, '2022-11-09'),
(10, 10, 1, 'Facile', 5023, '2022-11-09');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `Identi` int(11) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Mdp` varchar(500) NOT NULL,
  `Pseudo` varchar(20) NOT NULL,
  `DateHeureInscri` datetime NOT NULL,
  `DateHconnexion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`Identi`, `Email`, `Mdp`, `Pseudo`, `DateHeureInscri`, `DateHconnexion`) VALUES
(1, 'mailcommun@yahoo.com', '12345', 'Bgdelastreet', '2022-11-09 00:00:00', '2022-11-19 20:16:09'),
(7, 'mailpascommun@yahoo.com', '12345', 'RoroDu95', '2022-11-09 00:00:00', NULL),
(8, 'mailrare@yahoo.com', '12345', 'Jimmy99', '2022-11-09 00:00:00', NULL),
(9, 'mailepic@yahoo.com', '12345', 'WakandaWarrior', '2022-11-09 00:00:00', NULL),
(10, 'maillegendaire@yahoo.com', '12345', 'SugmaMale', '2022-11-09 00:00:00', NULL),
(41, 'test@gmail.com', '12345', 'BeauGosseDu69', '2022-11-09 00:00:00', NULL),
(42, 'jeanjuste.lefebvre@gmail.com', 'Lamère78', 'Otari', '2022-11-18 00:00:00', '2022-11-19 20:16:27'),
(43, 'robert@salut.com', 'Samère23', 'ejfkosfjisfj', '2022-11-19 00:29:00', '2022-11-19 00:25:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jeux`
--
ALTER TABLE `jeux`
  ADD PRIMARY KEY (`IdJeu`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`IndentiMsg`),
  ADD KEY `IdJeu` (`IdJeu`),
  ADD KEY `IdExpe` (`IdExpe`);

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`IdentiScore`),
  ADD KEY `IdJoueur` (`IdJoueur`),
  ADD KEY `IdJeu` (`IdJeu`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`Identi`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Pseudo` (`Pseudo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jeux`
--
ALTER TABLE `jeux`
  MODIFY `IdJeu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `IndentiMsg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `score`
--
ALTER TABLE `score`
  MODIFY `IdentiScore` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `Identi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`IdJeu`) REFERENCES `jeux` (`IdJeu`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`IdExpe`) REFERENCES `utilisateur` (`Identi`);

--
-- Constraints for table `score`
--
ALTER TABLE `score`
  ADD CONSTRAINT `score_ibfk_1` FOREIGN KEY (`IdJoueur`) REFERENCES `utilisateur` (`Identi`),
  ADD CONSTRAINT `score_ibfk_2` FOREIGN KEY (`IdJeu`) REFERENCES `jeux` (`IdJeu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
