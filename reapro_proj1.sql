-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 16 mai 2022 à 11:12
-- Version du serveur : 5.7.36
-- Version de PHP : 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `reapro_proj1`
--

-- --------------------------------------------------------

--
-- Structure de la table `chaise`
--

DROP TABLE IF EXISTS `chaise`;
CREATE TABLE IF NOT EXISTS `chaise` (
  `idChaise` int(11) NOT NULL AUTO_INCREMENT,
  `couleur` varchar(11) NOT NULL,
  `hauteur` int(11) NOT NULL,
  `image` varchar(25) NOT NULL,
  `nomSalle` varchar(11) NOT NULL,
  PRIMARY KEY (`idChaise`,`nomSalle`),
  KEY `nomSalle` (`nomSalle`,`idChaise`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `chaise`
--

INSERT INTO `chaise` (`idChaise`, `couleur`, `hauteur`, `image`, `nomSalle`) VALUES
(2, 'rouge', 50, 'chaise_rouge.jpg', 'B102'),
(4, 'verte', 50, 'chaise_verte.jpg', 'B102'),
(5, 'rouge', 50, 'chaise_rouge.jpg', 'B102');

-- --------------------------------------------------------

--
-- Structure de la table `chaise_bureau`
--

DROP TABLE IF EXISTS `chaise_bureau`;
CREATE TABLE IF NOT EXISTS `chaise_bureau` (
  `idChaiseBureau` int(11) NOT NULL AUTO_INCREMENT,
  `hauteurMin` decimal(10,0) NOT NULL,
  `hauteurMax` decimal(10,0) NOT NULL,
  `idChaise` int(11) NOT NULL,
  PRIMARY KEY (`idChaiseBureau`,`idChaise`),
  UNIQUE KEY `idChaise` (`idChaise`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ordinateur`
--

DROP TABLE IF EXISTS `ordinateur`;
CREATE TABLE IF NOT EXISTS `ordinateur` (
  `idOrdinateur` int(11) NOT NULL AUTO_INCREMENT,
  `OS` varchar(25) NOT NULL,
  `image` varchar(25) NOT NULL,
  `nomSalle` varchar(11) NOT NULL,
  PRIMARY KEY (`idOrdinateur`,`nomSalle`),
  UNIQUE KEY `nomSalle` (`nomSalle`,`idOrdinateur`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ordinateur`
--

INSERT INTO `ordinateur` (`idOrdinateur`, `OS`, `image`, `nomSalle`) VALUES
(1, 'Windows7', 'ordi_Windows7.png', 'B102'),
(2, 'iOS', 'ordi_iOS.png', 'B102');

-- --------------------------------------------------------

--
-- Structure de la table `ordinateur_prof`
--

DROP TABLE IF EXISTS `ordinateur_prof`;
CREATE TABLE IF NOT EXISTS `ordinateur_prof` (
  `idOrdinateurProf` int(11) NOT NULL AUTO_INCREMENT,
  `idOrdi` int(11) NOT NULL,
  PRIMARY KEY (`idOrdinateurProf`,`idOrdi`),
  UNIQUE KEY `idOrdi` (`idOrdi`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ordinateur_prof`
--

INSERT INTO `ordinateur_prof` (`idOrdinateurProf`, `idOrdi`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

DROP TABLE IF EXISTS `salle`;
CREATE TABLE IF NOT EXISTS `salle` (
  `nomSalle` varchar(11) NOT NULL,
  `longueur` int(11) NOT NULL,
  `largeur` int(11) NOT NULL,
  `capaciteSalle` int(11) NOT NULL,
  PRIMARY KEY (`nomSalle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`nomSalle`, `longueur`, `largeur`, `capaciteSalle`) VALUES
('B102', 30, 7, 24);

-- --------------------------------------------------------

--
-- Structure de la table `salle_info`
--

DROP TABLE IF EXISTS `salle_info`;
CREATE TABLE IF NOT EXISTS `salle_info` (
  `nomSalleInfo` varchar(11) NOT NULL,
  `capaciteOrdi` int(11) NOT NULL,
  PRIMARY KEY (`nomSalleInfo`),
  UNIQUE KEY `nomSalleInfo` (`nomSalleInfo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `salle_info`
--

INSERT INTO `salle_info` (`nomSalleInfo`, `capaciteOrdi`) VALUES
('B102', 24);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `chaise`
--
ALTER TABLE `chaise`
  ADD CONSTRAINT `chaise_ibfk_1` FOREIGN KEY (`nomSalle`) REFERENCES `salle` (`nomSalle`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `chaise_bureau`
--
ALTER TABLE `chaise_bureau`
  ADD CONSTRAINT `chaise_bureau_ibfk_1` FOREIGN KEY (`idChaise`) REFERENCES `chaise` (`idChaise`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ordinateur`
--
ALTER TABLE `ordinateur`
  ADD CONSTRAINT `ordinateur_ibfk_1` FOREIGN KEY (`nomSalle`) REFERENCES `salle` (`nomSalle`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ordinateur_prof`
--
ALTER TABLE `ordinateur_prof`
  ADD CONSTRAINT `ordinateur_prof_ibfk_1` FOREIGN KEY (`idOrdi`) REFERENCES `ordinateur` (`idOrdinateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `salle_info`
--
ALTER TABLE `salle_info`
  ADD CONSTRAINT `salle_info_ibfk_1` FOREIGN KEY (`nomSalleInfo`) REFERENCES `salle` (`nomSalle`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
