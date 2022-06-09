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
-- Structure de la table `p_tapis`
--

CREATE TABLE `p_tapis` (
  `id_tapis` int(32) NOT NULL,
  `nom_tapis` varchar(64) NOT NULL,
  `largeur` float NOT NULL,
  `longueur` float NOT NULL,
  `prix` float NOT NULL,
  `coefficient_solde` float NOT NULL DEFAULT '1',
  `marque` varchar(32) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `p_tapis`
--

INSERT INTO `p_tapis` (`id_tapis`, `nom_tapis`, `largeur`, `longueur`, `prix`, `coefficient_solde`, `marque`, `stock`) VALUES
(2, 'Tapis Voiture', 160, 200, 45, 10, 'Ka-Chow!', 685),
(3, 'Tapis imprimé léopard', 100, 160, 150, 0, 'RugVista', 86),
(5, 'Tapis renard enfant', 55, 55, 55, 1, 'zemmour', 2),
(6, 'Tapie Bernard', 45, 45, 1337, 90, 'OM', 0),
(7, 'TapisDeLaCaillé', 54, 54, 19, 1, 'BoutiqueDeLaCaillé', 17),
(8, 'Tapis tapis rouge', 60, 60, 25, 0, 'Pomme de rainette', 35),
(9, 'Tapis tapis gris', 60, 60, 25, 80, 'Pomme d\'api', 50);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `p_tapis`
--
ALTER TABLE `p_tapis`
  ADD PRIMARY KEY (`id_tapis`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `p_tapis`
--
ALTER TABLE `p_tapis`
  MODIFY `id_tapis` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
