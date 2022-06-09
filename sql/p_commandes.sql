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
-- Structure de la table `p_commandes`
--

CREATE TABLE `p_commandes` (
  `id_commande` int(32) NOT NULL,
  `id_client` int(64) NOT NULL,
  `montant_commande` float NOT NULL,
  `date_commande` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `p_commandes`
--

INSERT INTO `p_commandes` (`id_commande`, `id_client`, `montant_commande`, `date_commande`) VALUES
(38, 14, 1070, '2021-12-07'),
(40, 14, 41, '2021-12-07'),
(41, 16, 1424, '2021-12-08'),
(42, 16, 57096.7, '2021-12-08'),
(43, 24, 1333.62, '2021-12-08'),
(44, 25, 118.8, '2021-12-08'),
(45, 25, 441.6, '2021-12-08');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `p_commandes`
--
ALTER TABLE `p_commandes`
  ADD PRIMARY KEY (`id_commande`),
  ADD KEY `p_commandes_ibfk_1` (`id_client`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `p_commandes`
--
ALTER TABLE `p_commandes`
  MODIFY `id_commande` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `p_commandes`
--
ALTER TABLE `p_commandes`
  ADD CONSTRAINT `p_commandes_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `p_clients` (`id_client`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
