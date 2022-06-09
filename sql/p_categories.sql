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
-- Structure de la table `p_categories`
--

CREATE TABLE `p_categories` (
  `id_categorie` int(32) NOT NULL,
  `nom_categorie` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `p_categories`
--

INSERT INTO `p_categories` (`id_categorie`, `nom_categorie`) VALUES
(1, 'Produit'),
(2, 'Soie'),
(3, 'Laine'),
(4, 'Acrylique'),
(5, 'Nylon'),
(6, 'Polyprène'),
(7, 'Polyester'),
(8, 'Coton'),
(9, 'Prière'),
(10, 'Moderne'),
(11, 'Unicolore'),
(12, 'Bleu'),
(13, 'Rouge'),
(14, 'Noir'),
(15, 'Gris'),
(16, 'Vert'),
(17, 'Jaune'),
(18, 'Multicolore'),
(19, 'Enfants'),
(20, 'Tendance'),
(21, 'Muscu');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `p_categories`
--
ALTER TABLE `p_categories`
  ADD PRIMARY KEY (`id_categorie`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `p_categories`
--
ALTER TABLE `p_categories`
  MODIFY `id_categorie` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
