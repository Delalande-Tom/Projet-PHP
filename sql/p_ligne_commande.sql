-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mar. 08 mars 2022 à 16:53
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
-- Structure de la table `p_ligne_commande`
--

CREATE TABLE `p_ligne_commande` (
  `id_commande` int(32) NOT NULL,
  `id_tapis` int(32) NOT NULL,
  `nb_tapis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `p_ligne_commande`
--

INSERT INTO `p_ligne_commande` (`id_commande`, `id_tapis`, `nb_tapis`) VALUES
(40, 2, 1),
(41, 2, 8),
(42, 2, 6),
(43, 2, 32),
(45, 2, 1),
(41, 3, 4),
(38, 6, 8),
(41, 6, 3),
(45, 6, 3),
(42, 7, 30),
(43, 7, 2),
(42, 8, 10),
(42, 9, 9);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `p_ligne_commande`
--
ALTER TABLE `p_ligne_commande`
  ADD PRIMARY KEY (`id_tapis`,`id_commande`),
  ADD KEY `id_commande` (`id_commande`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `p_ligne_commande`
--
ALTER TABLE `p_ligne_commande`
  ADD CONSTRAINT `p_ligne_commande_ibfk_1` FOREIGN KEY (`id_commande`) REFERENCES `p_commandes` (`id_commande`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `p_ligne_commande_ibfk_2` FOREIGN KEY (`id_tapis`) REFERENCES `p_tapis` (`id_tapis`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
