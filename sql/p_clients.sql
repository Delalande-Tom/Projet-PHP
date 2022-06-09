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
-- Structure de la table `p_clients`
--

CREATE TABLE `p_clients` (
  `id_client` int(64) NOT NULL,
  `prenom` varchar(32) NOT NULL,
  `nom` varchar(32) NOT NULL,
  `mail` varchar(256) NOT NULL,
  `adresse` varchar(1024) NOT NULL,
  `ville` varchar(64) NOT NULL,
  `code_postal` varchar(16) NOT NULL,
  `mot_de_passe` varchar(256) NOT NULL,
  `date_naissance` date NOT NULL,
  `login` varchar(64) NOT NULL,
  `nonce` varchar(32) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `p_clients`
--

INSERT INTO `p_clients` (`id_client`, `prenom`, `nom`, `mail`, `adresse`, `ville`, `code_postal`, `mot_de_passe`, `date_naissance`, `login`, `nonce`, `admin`) VALUES
(9, 'Alexandre', 'Roura', 'ss', 'sao', 'soa', '55', 'G24oHwJz1tbe18f8f06fcb93fc307596', '0000-00-00', 'Alex', NULL, 0),
(10, 'Liam', 'Thorel', 'a', 'aa', 'aa', '34770', 'G24oHwJz1teef0c396c1a2c19d311921', '2012-12-12', 'aa', NULL, 0),
(12, 'z', 'z', 'z@pd.fr', 'z', 'z', 'z', 'G24oHwJz1t594e519ae499312b29433b', '0000-00-00', 'z', NULL, NULL),
(13, 'q', 'q', 'q@q.fr', 'q', 'q', 'q', 'G24oHwJz1t8e35c2cd3bf6641bdb0e2050b76932cbb2e6034a0ddacc1d9bea82a6ba57f7cf', '0000-00-00', 'q', NULL, 1),
(14, 'Alexandre', 'Roura', 'alexandre.roura@outlook.fr', '40 rue ppp', 'ppp', '64600', 'G24oHwJz1tfcddb3ba91ab8b4ff38a08424f343f7f465e93ac1e61926e2cf283b9d493ce09', '2002-09-27', 'Alexandre', NULL, NULL),
(16, 'tom', 'delalande', 'tom.delalande@etu.umontpellier.fr', 'ici', 'gigean', '34770', 'G24oHwJz1t6f354d45ce11676b1b19707c4755d770b4cc0112b08d0ee1defdeed5c36d05a8', '2002-09-29', 'delalandet', NULL, 1),
(18, 'qq', 'qq', 'qq@qq.fr', 'qq', 'qq', 'qq', 'G24oHwJz1td5ce2b19fbda14a25deac948154722f33efd37b369a32be8f03ec2be8ef7d3a5', '4545-05-04', 'qq', NULL, NULL),
(21, 'j', 'j', 'j@j.fr', 'j', 'j', '34770', 'G24oHwJz1t189f40034be7a199f1fa9891668ee3ab6049f82d38c68be70f596eab2e1857b7', '2021-12-02', 'j', NULL, NULL),
(23, 'zae', 'aze', 'aze@za.fr', 'zeae', 'aze', 'aze', 'G24oHwJz1t811786ad1ae74adfdd20dd0372abaaebc6246e343aebd01da0bfc4c02bf0106c', '0012-12-12', '45', NULL, NULL),
(24, 'test', 'test', 'testman@gmail.com', 'testtes', 'test', '3400', 'G24oHwJz1t9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08', '2002-04-29', 'test', NULL, 0),
(25, 'toto', 'toto', 'toto@a.fr', 'toto', 'toto', 'toto', 'G24oHwJz1t31f7a65e315586ac198bd798b6629ce4903d0899476d5741a9f32e2e521b6a66', '2525-12-25', 'toto', NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `p_clients`
--
ALTER TABLE `p_clients`
  ADD PRIMARY KEY (`id_client`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `p_clients`
--
ALTER TABLE `p_clients`
  MODIFY `id_client` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
