-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mer. 09 nov. 2022 à 09:49
-- Version du serveur :  5.7.34
-- Version de PHP : 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `PowerOfMemory`
--

-- --------------------------------------------------------

--
-- Structure de la table `Jeux`
--

CREATE TABLE `Jeux` (
  `IdJeu` int(11) NOT NULL,
  `NomJeu` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Jeux`
--

INSERT INTO `Jeux` (`IdJeu`, `NomJeu`) VALUES
(1, 'MemoryGame');

-- --------------------------------------------------------

--
-- Structure de la table `Message`
--

CREATE TABLE `Message` (
  `IndentiMsg` int(11) NOT NULL,
  `IdJeu` int(11) NOT NULL,
  `IdExpe` int(11) NOT NULL,
  `Msg` varchar(280) NOT NULL,
  `DateHeureMsg` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Score`
--

CREATE TABLE `Score` (
  `IdentiScore` int(11) NOT NULL,
  `IdJoueur` int(11) NOT NULL,
  `IdJeu` int(11) NOT NULL,
  `DiffPartie` varchar(15) NOT NULL,
  `ScorePartie` int(11) NOT NULL,
  `DateHeurePartie` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Score`
--

INSERT INTO `Score` (`IdentiScore`, `IdJoueur`, `IdJeu`, `DiffPartie`, `ScorePartie`, `DateHeurePartie`) VALUES
(6, 1, 1, 'Facile', 4200, '2022-11-09'),
(7, 9, 1, 'Facile', 2830, '2022-11-09'),
(8, 7, 1, 'Normal', 6030, '2022-11-09'),
(9, 8, 1, 'Normal', 7420, '2022-11-09'),
(10, 10, 1, 'Facile', 5023, '2022-11-09');

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `Identi` int(11) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Mdp` varchar(500) NOT NULL,
  `Pseudo` varchar(20) NOT NULL,
  `DateHeureInscri` date NOT NULL,
  `DateHconnexion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Utilisateur`
--

INSERT INTO `Utilisateur` (`Identi`, `Email`, `Mdp`, `Pseudo`, `DateHeureInscri`, `DateHconnexion`) VALUES
(1, 'mailcommun@yahoo.com', '12345', 'Bgdelastreet', '2022-11-09', NULL),
(7, 'mailpascommun@yahoo.com', '12345', 'RoroDu95', '2022-11-09', NULL),
(8, 'mailrare@yahoo.com', '12345', 'Jimmy99', '2022-11-09', NULL),
(9, 'mailepic@yahoo.com', '12345', 'WakandaWarrior', '2022-11-09', NULL),
(10, 'maillegendaire@yahoo.com', '12345', 'SugmaMale', '2022-11-09', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Jeux`
--
ALTER TABLE `Jeux`
  ADD PRIMARY KEY (`IdJeu`);

--
-- Index pour la table `Message`
--
ALTER TABLE `Message`
  ADD PRIMARY KEY (`IndentiMsg`),
  ADD KEY `IdJeu` (`IdJeu`),
  ADD KEY `IdExpe` (`IdExpe`);

--
-- Index pour la table `Score`
--
ALTER TABLE `Score`
  ADD PRIMARY KEY (`IdentiScore`),
  ADD KEY `IdJoueur` (`IdJoueur`),
  ADD KEY `IdJeu` (`IdJeu`);

--
-- Index pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD PRIMARY KEY (`Identi`),
  ADD UNIQUE KEY `Email` (`Email`,`Pseudo`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Jeux`
--
ALTER TABLE `Jeux`
  MODIFY `IdJeu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `Message`
--
ALTER TABLE `Message`
  MODIFY `IndentiMsg` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Score`
--
ALTER TABLE `Score`
  MODIFY `IdentiScore` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  MODIFY `Identi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Message`
--
ALTER TABLE `Message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`IdJeu`) REFERENCES `Jeux` (`IdJeu`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`IdExpe`) REFERENCES `Utilisateur` (`Identi`);

--
-- Contraintes pour la table `Score`
--
ALTER TABLE `Score`
  ADD CONSTRAINT `score_ibfk_1` FOREIGN KEY (`IdJoueur`) REFERENCES `Utilisateur` (`Identi`),
  ADD CONSTRAINT `score_ibfk_2` FOREIGN KEY (`IdJeu`) REFERENCES `Jeux` (`IdJeu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
