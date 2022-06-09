-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mar. 08 mars 2022 à 16:52
-- Version du serveur :  5.5.47-0+deb8u1
-- Version de PHP :  7.2.22-1+0~20190902.26+debian8~1.gbpd64eb7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `delalandet`
--

-- --------------------------------------------------------

--
-- Structure de la table `p_ligne_categorie`
--

CREATE TABLE `p_ligne_categorie` (
  `id_categorie` int(32) NOT NULL,
  `id_tapis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `p_ligne_categorie`
--

INSERT INTO `p_ligne_categorie` (`id_categorie`, `id_tapis`) VALUES
(1, 2),
(8, 2),
(10, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(18, 2),
(19, 2),
(20, 2),
(1, 3),
(3, 3),
(10, 3),
(11, 3),
(14, 3),
(17, 3),
(18, 3),
(1, 5),
(8, 5),
(10, 5),
(13, 5),
(15, 5),
(18, 5),
(19, 5),
(1, 6),
(14, 6),
(20, 6),
(1, 7),
(6, 7),
(7, 7),
(11, 7),
(12, 7),
(20, 7),
(21, 7),
(20, 8),
(21, 8),
(1, 9),
(2, 9),
(8, 9),
(12, 9),
(14, 9),
(16, 9),
(18, 9),
(19, 9);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `p_ligne_categorie`
--
ALTER TABLE `p_ligne_categorie`
  ADD PRIMARY KEY (`id_categorie`,`id_tapis`),
  ADD KEY `id_tapis` (`id_tapis`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `p_ligne_categorie`
--
ALTER TABLE `p_ligne_categorie`
  ADD CONSTRAINT `p_ligne_categorie_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `p_categories` (`id_categorie`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `p_ligne_categorie_ibfk_2` FOREIGN KEY (`id_tapis`) REFERENCES `p_tapis` (`id_tapis`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
