-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 08 mai 2023 à 19:20
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `the_pokeshippers_projet`
--
CREATE DATABASE IF NOT EXISTS `the_pokeshippers_projet` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `the_pokeshippers_projet`;

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sauv` ()   BEGIN
SET @filename = CONCAT('sauv_collectionneur_', DATE_FORMAT(NOW(), '%Y-%m-%d_%H-%i-%s'), '.csv');
SET @filepath = CONCAT('G:/xampp/htdocs/monwww/PokeShippers_projet/base_de_donnee/sauv/', @filename);
SET @requete = CONCAT("SELECT * INTO OUTFILE '",@filepath,"' CHARACTER SET utf8mb4 FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\\n' FROM collectionneur_copy;");
PREPARE s1 FROM @requete;
EXECUTE s1;
DEALLOCATE PREPARE s1;
-- On vide la table
DELETE FROM collectionneur_copy;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sauv_collectionneur` ()   BEGIN
SET @filename = CONCAT('sauvegarde_collectionneur_', DATE_FORMAT(NOW(), '%Y-%m-%d_%H-%i-%s'), '.csv');
SET @filepath = CONCAT('G:/xampp/htdocs/monwww/PokeShippers_projet/base_de_donnee/sauv', @filename);
SET @requete = CONCAT("SELECT * INTO OUTFILE '",@filepath,"' CHARACTER SET utf8mb4 FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\\n' FROM collectionneur_copy;");
PREPARE s1 FROM @requete;
EXECUTE s1;
DEALLOCATE PREPARE s1;
-- On vide la table
DELETE FROM collectionneur_copy;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sauv_collectionneur_copy` ()   BEGIN
SET @filename = CONCAT('sauv_collectionneur_', DATE_FORMAT(NOW(), '%Y-%m-%d_%H-%i-%s'), '.csv');
SET @filepath = CONCAT('G:/xampp/htdocs/monwww/PokeShippers_projet/base_de_donnee/sauv/', @filename);
SET @requete = CONCAT("SELECT * INTO OUTFILE '",@filepath,"' CHARACTER SET utf8mb4 FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\\n' FROM collectionneur_copy;");
PREPARE s1 FROM @requete;
EXECUTE s1;
DEALLOCATE PREPARE s1;
-- On vide la table
DELETE FROM collectionneur_copy;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sauv_collectionneur_total` ()   BEGIN
SET @filename = CONCAT('sauv_collectionneur_total_', DATE_FORMAT(NOW(), '%Y-%m-%d_%H-%i-%s'), '.csv');
SET @filepath = CONCAT('G:/xampp/htdocs/monwww/PokeShippers_projet/base_de_donnee/sauv/', @filename);
SET @requete = CONCAT("SELECT * INTO OUTFILE '",@filepath,"' CHARACTER SET utf8mb4 FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\\n' FROM collectionneur;");
PREPARE s1 FROM @requete;
EXECUTE s1;
DEALLOCATE PREPARE s1;
-- On vide la table
DELETE FROM collectionneur_copy;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `carte`
--

CREATE TABLE `carte` (
  `IdCarte` int(11) NOT NULL,
  `SeriePaquet` varchar(50) NOT NULL,
  `Rareté` varchar(25) DEFAULT NULL,
  `IdGenerationCarte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `carte`
--

INSERT INTO `carte` (`IdCarte`, `SeriePaquet`, `Rareté`, `IdGenerationCarte`) VALUES
(1, 'rubissaphir', 'EX', 1),
(1, 'tempete', 'rare', 4),
(2, 'rubissaphir', 'rare', 1),
(2, 'tempete', 'rare', 4),
(3, 'rubissaphir', 'EX', 1),
(3, 'tempete', 'rare', 4),
(4, 'rubissaphir', 'rare', 1),
(4, 'tempete', 'rare', 4),
(5, 'rubissaphir', 'rare', 1),
(5, 'tempete', 'rare', 4),
(6, 'rubissaphir', 'rare', 1),
(6, 'tempete', 'rare', 4),
(7, 'rubissaphir', 'rare', 1),
(7, 'tempete', 'rare', 4),
(8, 'rubissaphir', 'rare', 1),
(8, 'tempete', 'rare', 4),
(9, 'rubissaphir', 'rare', 1),
(9, 'tempete', 'rare', 4),
(10, 'rubissaphir', 'rare', 1),
(10, 'tempete', 'rare', 4),
(11, 'rubissaphir', 'rare', 1),
(12, 'rubissaphir', 'rare', 1),
(13, 'rubissaphir', 'rare', 1),
(14, 'rubissaphir', 'rare', 1),
(15, 'rubissaphir', 'rare', 1),
(16, 'rubissaphir', 'rare', 1),
(17, 'rubissaphir', 'rare', 1),
(18, 'rubissaphir', 'rare', 1),
(19, 'rubissaphir', 'rare', 1),
(20, 'rubissaphir', 'rare', 1),
(21, 'rubissaphir', 'rare', 1),
(22, 'rubissaphir', 'rare', 1),
(23, 'rubissaphir', 'rare', 1),
(24, 'rubissaphir', 'rare', 1),
(25, 'rubissaphir', 'commun', 1),
(26, 'rubissaphir', 'peu_commun', 1),
(27, 'rubissaphir', 'commun', 1),
(28, 'rubissaphir', 'peu_commun', 1),
(29, 'rubissaphir', 'commun', 1),
(30, 'rubissaphir', 'peu_commun', 1),
(31, 'rubissaphir', 'commun', 1),
(32, 'rubissaphir', 'peu_commun', 1),
(33, 'rubissaphir', 'commun', 1),
(34, 'rubissaphir', 'commun', 1),
(35, 'rubissaphir', 'commun', 1),
(36, 'rubissaphir', 'rare', 1),
(37, 'rubissaphir', 'commun', 1),
(38, 'rubissaphir', 'commun', 1),
(39, 'rubissaphir', 'commun', 1),
(40, 'rubissaphir', 'commun', 1),
(41, 'rubissaphir', 'peu_commun', 1),
(42, 'rubissaphir', 'rare', 1),
(43, 'rubissaphir', 'commun', 1),
(44, 'rubissaphir', 'commun', 1),
(45, 'rubissaphir', 'commun', 1),
(46, 'rubissaphir', 'peu_commun', 1),
(47, 'rubissaphir', 'commun', 1),
(48, 'rubissaphir', 'commun', 1),
(49, 'rubissaphir', 'rare', 1),
(50, 'rubissaphir', 'commun', 1),
(51, 'rubissaphir', 'peu_commun', 1),
(52, 'rubissaphir', 'commun', 1),
(53, 'rubissaphir', 'commun', 1),
(54, 'rubissaphir', 'commun', 1),
(55, 'rubissaphir', 'commun', 1),
(55, 'tempete', 'peu-commun', 4),
(56, 'rubissaphir', 'peu_commun', 1),
(56, 'tempete', 'peu-commun', 4),
(57, 'rubissaphir', 'rare', 1),
(57, 'tempete', 'peu-commun', 4),
(58, 'rubissaphir', 'commun', 1),
(58, 'tempete', 'peu-commun', 4),
(59, 'rubissaphir', 'commun', 1),
(59, 'tempete', 'peu-commun', 4),
(60, 'rubissaphir', 'commun', 1),
(60, 'tempete', 'peu-commun', 4),
(61, 'rubissaphir', 'commun', 1),
(61, 'tempete', 'peu-commun', 4),
(62, 'rubissaphir', 'commun', 1),
(62, 'tempete', 'peu-commun', 4),
(63, 'rubissaphir', 'rare', 1),
(63, 'tempete', 'peu-commun', 4),
(64, 'rubissaphir', 'commun', 1),
(64, 'tempete', 'peu-commun', 4),
(65, 'rubissaphir', 'commun', 1),
(65, 'tempete', 'peu-commun', 4),
(66, 'rubissaphir', 'peu_commun', 1),
(67, 'rubissaphir', 'commun', 1),
(68, 'rubissaphir', 'peu_commun', 1),
(69, 'rubissaphir', 'rare', 1),
(70, 'rubissaphir', 'commun', 1),
(71, 'rubissaphir', 'commun', 1),
(72, 'rubissaphir', 'commun', 1),
(73, 'rubissaphir', 'commun', 1),
(74, 'rubissaphir', 'peu_commun', 1),
(75, 'rubissaphir', 'commun', 1),
(76, 'rubissaphir', 'commun', 1),
(77, 'rubissaphir', 'commun', 1),
(78, 'rubissaphir', 'commun', 1),
(79, 'rubissaphir', 'commun', 1),
(80, 'rubissaphir', 'rare', 1),
(81, 'rubissaphir', 'commun', 1),
(82, 'rubissaphir', 'commun', 1),
(83, 'rubissaphir', 'commun', 1),
(84, 'rubissaphir', 'commun', 1),
(85, 'rubissaphir', 'commun', 1),
(85, 'tempete', 'commun', 4),
(86, 'rubissaphir', 'commun', 1),
(86, 'tempete', 'commun', 4),
(87, 'rubissaphir', 'commun', 1),
(87, 'tempete', 'commun', 4),
(88, 'rubissaphir', 'commun', 1),
(88, 'tempete', 'commun', 4),
(89, 'rubissaphir', 'rare', 1),
(89, 'tempete', 'commun', 4),
(90, 'rubissaphir', 'peu_commun', 1),
(90, 'tempete', 'commun', 4),
(91, 'rubissaphir', 'commun', 1),
(91, 'tempete', 'commun', 4),
(92, 'rubissaphir', 'commun', 1),
(92, 'tempete', 'commun', 4),
(93, 'rubissaphir', 'commun', 1),
(93, 'tempete', 'commun', 4),
(94, 'rubissaphir', 'commun', 1),
(94, 'tempete', 'commun', 4),
(95, 'rubissaphir', 'commun', 1),
(95, 'tempete', 'commun', 4),
(96, 'rubissaphir', 'EX', 1),
(97, 'rubissaphir', 'EX', 1),
(98, 'rubissaphir', 'EX', 1),
(99, 'rubissaphir', 'EX', 1),
(100, 'rubissaphir', 'EX', 1),
(101, 'rubissaphir', 'EX', 1),
(102, 'rubissaphir', 'EX', 1),
(103, 'rubissaphir', 'EX', 1),
(104, 'rubissaphir', 'commun', 1),
(105, 'rubissaphir', 'commun', 1),
(105, 'tempete', 'peu-commun', 4),
(106, 'rubissaphir', 'commun', 1),
(106, 'tempete', 'peu-commun', 4),
(107, 'rubissaphir', 'commun', 1),
(107, 'tempete', 'peu-commun', 4),
(108, 'rubissaphir', 'commun', 1),
(108, 'tempete', 'peu-commun', 4),
(109, 'rubissaphir', 'commun', 1),
(120, 'tempete', 'EX', 4),
(121, 'tempete', 'EX', 4),
(122, 'tempete', 'EX', 4),
(123, 'tempete', 'commun', 4),
(124, 'tempete', 'commun', 4),
(125, 'tempete', 'commun', 4),
(126, 'tempete', 'commun', 4),
(127, 'tempete', 'commun', 4),
(128, 'tempete', 'commun', 4),
(129, 'tempete', 'commun', 4),
(130, 'tempete', 'commun', 4);

-- --------------------------------------------------------

--
-- Structure de la table `colis`
--

CREATE TABLE `colis` (
  `IdLivraison` int(11) NOT NULL,
  `IdCollectionneur` int(11) NOT NULL,
  `DateEnvoiColis` date DEFAULT NULL,
  `LieuLivraison` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `colis`
--

INSERT INTO `colis` (`IdLivraison`, `IdCollectionneur`, `DateEnvoiColis`, `LieuLivraison`) VALUES
(11, 6, '2023-05-09', 'Chez moi');

-- --------------------------------------------------------

--
-- Structure de la table `collectionneur`
--

CREATE TABLE `collectionneur` (
  `IdCollectionneur` int(11) NOT NULL,
  `Pseudo` varchar(50) DEFAULT NULL,
  `Mail` varchar(125) DEFAULT NULL,
  `Mdp` longtext DEFAULT NULL,
  `Role` varchar(25) DEFAULT NULL,
  `Credit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `collectionneur`
--

INSERT INTO `collectionneur` (`IdCollectionneur`, `Pseudo`, `Mail`, `Mdp`, `Role`, `Credit`) VALUES
(6, 'DylanPoke', 'arditi.dylan@gmail.com', '$2y$10$HP92NsVUL626nvVinYYQCOB4pOJvfux7yUAlktmcZRYhtYc1QGJm2', 'collectionneur', 2960),
(7, 'test', 'test@gmail.com', '$2y$10$cid0EOGXDWXoMFoCSZdzKOWFFp/681kBE6rLE3UWJipiRNpJzkE16', 'collectionneur', 2740),
(8, 'Pikachu_anonyme', 'Pikachu_anonyme@gmail.com', '$2y$10$VgvtVOXDxvNipLwkblEjjuGymdejmKbnncMS7l/ijNNzw.46LlDAa', 'collectionneur', 4000),
(9, 'Pokemon1337', 'Pokemon1337@gmail.com', '$2y$10$8mnaoQXikPw4MGr3P/sN2uBBkIoCdf7TzEyWCQkFj6gU2XK3gt0SC', 'collectionneur', 1900),
(11, 'TEST23', 'TEST23@gmail.com', '$2y$10$HK0Dip6DetHYeccDmcKUnO3vyYKzpQNaN/KE0z/KadRZqUYE9dq.K', 'collectionneur', 0);

--
-- Déclencheurs `collectionneur`
--
DELIMITER $$
CREATE TRIGGER `collectionneur_copy_delete` AFTER DELETE ON `collectionneur` FOR EACH ROW INSERT INTO collectionneur_copy (IdCollectionneur,Pseudo,Mail,Mdp,Role,Credit,modification)
VALUES (OLD.IdCollectionneur, OLD.Pseudo, OLD.Mail,OLD.Mdp, OLD.Role, OLD.Credit,"D")
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `collectionneur_copy_insert` AFTER INSERT ON `collectionneur` FOR EACH ROW INSERT INTO collectionneur_copy (IdCollectionneur,Pseudo,Mail,Mdp,Role,Credit,modification)
VALUES (NEW.IdCollectionneur, NEW.Pseudo, NEW.Mail,NEW.Mdp, NEW.Role, NEW.Credit,"I")
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `collectionneur_copy_update` AFTER UPDATE ON `collectionneur` FOR EACH ROW INSERT INTO collectionneur_copy (IdCollectionneur,Pseudo,Mail,Mdp,Role,Credit,modification)
VALUES (NEW.IdCollectionneur, NEW.Pseudo, NEW.Mail,NEW.Mdp, NEW.Role, NEW.Credit,"U")
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `collectionneur_copy`
--

CREATE TABLE `collectionneur_copy` (
  `IdCollectionneur` int(11) NOT NULL,
  `Pseudo` varchar(50) DEFAULT NULL,
  `Mail` varchar(125) DEFAULT NULL,
  `Mdp` longtext DEFAULT NULL,
  `Role` varchar(25) DEFAULT NULL,
  `Credit` int(11) DEFAULT NULL,
  `modification` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

CREATE TABLE `contenir` (
  `IdCarte` int(11) NOT NULL,
  `SeriePaquet` varchar(50) NOT NULL,
  `IdLivraison` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contenir`
--

INSERT INTO `contenir` (`IdCarte`, `SeriePaquet`, `IdLivraison`) VALUES
(13, 'rubissaphir', 11);

-- --------------------------------------------------------

--
-- Structure de la table `dresseur`
--

CREATE TABLE `dresseur` (
  `IdDresseur` int(11) NOT NULL,
  `SeriePaquet` varchar(50) NOT NULL,
  `NomDresseur` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `dresseur`
--

INSERT INTO `dresseur` (`IdDresseur`, `SeriePaquet`, `NomDresseur`) VALUES
(80, 'rubissaphir', 'suppression_energie'),
(81, 'rubissaphir', 'restauration_energie'),
(82, 'rubissaphir', 'echange_energie'),
(83, 'rubissaphir', 'mademoiselle_sortie'),
(84, 'rubissaphir', 'baie_prine'),
(85, 'rubissaphir', 'baie_oran'),
(86, 'rubissaphir', 'pokeball'),
(87, 'rubissaphir', 'inversion_pokemon'),
(88, 'rubissaphir', 'pokenav'),
(89, 'rubissaphir', 'prof_seko'),
(90, 'rubissaphir', 'recherche_energie'),
(91, 'rubissaphir', 'potion'),
(92, 'rubissaphir', 'passe-passe'),
(105, 'tempete', 'double-guerison-totale'),
(106, 'tempete', 'restauration-energie'),
(107, 'tempete', 'echange-energie'),
(108, 'tempete', 'centre-pokemon-nuit');

-- --------------------------------------------------------

--
-- Structure de la table `energie`
--

CREATE TABLE `energie` (
  `IdEnergie` int(11) NOT NULL,
  `SeriePaquet` varchar(50) NOT NULL,
  `NomEnergie` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `energie`
--

INSERT INTO `energie` (`IdEnergie`, `SeriePaquet`, `NomEnergie`) VALUES
(93, 'rubissaphir', 'tenebre'),
(94, 'rubissaphir', 'acier'),
(95, 'rubissaphir', 'multicolore'),
(104, 'rubissaphir', 'plante'),
(105, 'rubissaphir', 'combat'),
(106, 'rubissaphir', 'eau'),
(107, 'rubissaphir', 'psy'),
(108, 'rubissaphir', 'feu'),
(109, 'rubissaphir', 'elektrik'),
(123, 'tempete', 'plante'),
(124, 'tempete', 'feu'),
(125, 'tempete', 'eau'),
(126, 'tempete', 'electrik'),
(127, 'tempete', 'psy'),
(128, 'tempete', 'combat'),
(129, 'tempete', 'tenebre'),
(130, 'tempete', 'acier');

-- --------------------------------------------------------

--
-- Structure de la table `generation`
--

CREATE TABLE `generation` (
  `IdGenerationCarte` int(11) NOT NULL,
  `GenerationPokemon` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `generation`
--

INSERT INTO `generation` (`IdGenerationCarte`, `GenerationPokemon`) VALUES
(1, 1),
(2, 1),
(4, 4);

-- --------------------------------------------------------

--
-- Structure de la table `pokemon`
--

CREATE TABLE `pokemon` (
  `IdPokemon` int(11) NOT NULL,
  `SeriePaquet` varchar(50) NOT NULL,
  `NomPokemon` varchar(50) DEFAULT NULL,
  `Type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `pokemon`
--

INSERT INTO `pokemon` (`IdPokemon`, `SeriePaquet`, `NomPokemon`, `Type`) VALUES
(1, 'rubissaphir', 'galeking', 'acier'),
(1, 'tempete', 'dialga', 'acier'),
(2, 'rubissaphir', 'charmillon', 'plante'),
(2, 'tempete', 'noctunoir', 'spectre'),
(3, 'rubissaphir', 'brasegali', 'feu'),
(3, 'tempete', 'elekable', 'electrik'),
(4, 'rubissaphir', 'camerupt', 'feu'),
(4, 'tempete', 'pingoleon', 'eau'),
(5, 'rubissaphir', 'delcatty', 'normal'),
(5, 'tempete', 'simiabraz', 'feu'),
(6, 'rubissaphir', 'papinox', 'plante'),
(6, 'tempete', 'lucario', 'combat'),
(7, 'rubissaphir', 'gardevoir', 'psy'),
(7, 'tempete', 'luxray', 'electrik'),
(8, 'rubissaphir', 'hariyama', 'combat'),
(8, 'tempete', 'magnezone', 'acier'),
(9, 'rubissaphir', 'elecsprint', 'electrik'),
(9, 'tempete', 'manaphy', 'eau'),
(10, 'rubissaphir', 'grahyena', 'tenebre'),
(10, 'tempete', 'magireve', 'spectre'),
(11, 'rubissaphir', 'jungko', 'plante'),
(12, 'rubissaphir', 'monaflemit', 'normal'),
(13, 'rubissaphir', 'laggron', 'eau'),
(14, 'rubissaphir', 'wailord', 'eau'),
(15, 'rubissaphir', 'brasegali', 'feu'),
(16, 'rubissaphir', 'chapignon', 'plante'),
(17, 'rubissaphir', 'donphan', 'combat'),
(18, 'rubissaphir', 'tarinor', 'combat'),
(19, 'rubissaphir', 'bekipan', 'eau'),
(20, 'rubissaphir', 'jungko', 'plante'),
(21, 'rubissaphir', 'poissoroy', 'eau'),
(22, 'rubissaphir', 'sharpedo', 'eau'),
(23, 'rubissaphir', 'laggron', 'eau'),
(24, 'rubissaphir', 'smogogo', 'plante'),
(25, 'rubissaphir', 'galekid', 'acier'),
(26, 'rubissaphir', 'blindalys', 'plante'),
(27, 'rubissaphir', 'galifeu', 'feu'),
(28, 'rubissaphir', 'galifeu', 'feu'),
(29, 'rubissaphir', 'delcatty', 'normal'),
(30, 'rubissaphir', 'dynavolt', 'electrik'),
(31, 'rubissaphir', 'massko', 'plante'),
(32, 'rubissaphir', 'massko', 'plante'),
(33, 'rubissaphir', 'hariyama', 'combat'),
(34, 'rubissaphir', 'kirlia', 'psy'),
(35, 'rubissaphir', 'kirlia', 'psy'),
(36, 'rubissaphir', 'galegon', 'acier'),
(37, 'rubissaphir', 'galegon', 'acier'),
(38, 'rubissaphir', 'lineon', 'normal'),
(39, 'rubissaphir', 'elecsprint', 'electrik'),
(40, 'rubissaphir', 'flobio', 'eau'),
(41, 'rubissaphir', 'flobio', 'eau'),
(42, 'rubissaphir', 'grahyena', 'tenebre'),
(43, 'rubissaphir', 'armulys', 'plante'),
(44, 'rubissaphir', 'skitty', 'normal'),
(45, 'rubissaphir', 'parecool', 'normal'),
(46, 'rubissaphir', 'heledelle', 'normal'),
(47, 'rubissaphir', 'vigoroth', 'normal'),
(48, 'rubissaphir', 'wailmer', 'eau'),
(49, 'rubissaphir', 'galekid', 'acier'),
(50, 'rubissaphir', 'galekid', 'acier'),
(51, 'rubissaphir', 'carvanha', 'eau'),
(52, 'rubissaphir', 'dynavolt', 'electrik'),
(53, 'rubissaphir', 'dynavolt', 'electrik'),
(54, 'rubissaphir', 'smogo', 'plante'),
(55, 'rubissaphir', 'poissirene', 'eau'),
(55, 'tempete', 'babimanta', 'eau'),
(56, 'rubissaphir', 'makuhita', 'combat'),
(56, 'tempete', 'chimpenfeu', 'feu'),
(57, 'rubissaphir', 'makuhita', 'combat'),
(57, 'tempete', 'pifeuil', 'tenebre'),
(58, 'rubissaphir', 'makuhita', 'combat'),
(58, 'tempete', 'prinplouf', 'eau'),
(59, 'rubissaphir', 'gobou', 'eau'),
(59, 'tempete', 'galopa', 'feu'),
(60, 'rubissaphir', 'gobou', 'eau'),
(60, 'tempete', 'rhinoferos', 'sol'),
(61, 'rubissaphir', 'chamallot', 'feu'),
(61, 'tempete', 'riolu', 'combat'),
(62, 'rubissaphir', 'phanpy', 'combat'),
(62, 'tempete', 'poissoroy', 'eau'),
(63, 'rubissaphir', 'medhyena', 'tenebre'),
(63, 'tempete', 'armulys', 'plante'),
(64, 'rubissaphir', 'medhyena', 'tenebre'),
(64, 'tempete', 'etourvol', 'vol'),
(65, 'rubissaphir', 'medhyena', 'tenebre'),
(65, 'tempete', 'zarbi', 'psy'),
(66, 'rubissaphir', 'tarsal', 'psy'),
(67, 'rubissaphir', 'tarsal', 'psy'),
(68, 'rubissaphir', 'tarsal', 'psy'),
(69, 'rubissaphir', 'balignon', 'plante'),
(70, 'rubissaphir', 'skitty', 'normal'),
(71, 'rubissaphir', 'skitty', 'normal'),
(72, 'rubissaphir', 'nirondelle', 'normal'),
(73, 'rubissaphir', 'poussifeu', 'feu'),
(74, 'rubissaphir', 'poussifeu', 'feu'),
(75, 'rubissaphir', 'arcko', 'plante'),
(76, 'rubissaphir', 'arcko', 'plante'),
(77, 'rubissaphir', 'goelise', 'eau'),
(78, 'rubissaphir', 'chenipotte', 'plante'),
(79, 'rubissaphir', 'zigzaton', 'normal'),
(85, 'tempete', 'hoothoot', 'vol'),
(86, 'tempete', 'machoc', 'combat'),
(87, 'tempete', 'magneti', 'acier'),
(88, 'tempete', 'marill', 'eau'),
(89, 'tempete', 'meditikka', 'combat'),
(90, 'tempete', 'mimejr', 'psy'),
(91, 'tempete', 'feuforeve', 'spectre'),
(92, 'tempete', 'onix', 'roche'),
(93, 'tempete', 'tiplouf', 'eau'),
(94, 'tempete', 'ponyta', 'feu'),
(95, 'tempete', 'rhinocorne', 'sol'),
(96, 'rubissaphir', 'leveinard', 'normal'),
(97, 'rubissaphir', 'elektek', 'electrik'),
(98, 'rubissaphir', 'tygnon', 'combat'),
(99, 'rubissaphir', 'lokhlass', 'eau'),
(100, 'rubissaphir', 'magmar', 'feu'),
(101, 'rubissaphir', 'mewtwo', 'psy'),
(102, 'rubissaphir', 'insecateur', 'plante'),
(103, 'rubissaphir', 'farfuret', 'tenebre'),
(120, 'tempete', 'pingoleon', 'eau'),
(121, 'tempete', 'simiabraz', 'feu'),
(122, 'tempete', 'torterra', 'plante');

-- --------------------------------------------------------

--
-- Structure de la table `posséder`
--

CREATE TABLE `posséder` (
  `IdCarte` int(11) NOT NULL,
  `SeriePaquet` varchar(50) NOT NULL,
  `IdCollectionneur` int(11) NOT NULL,
  `nbrExemplaire` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `posséder`
--

INSERT INTO `posséder` (`IdCarte`, `SeriePaquet`, `IdCollectionneur`, `nbrExemplaire`) VALUES
(1, 'tempete', 6, 0),
(2, 'rubissaphir', 7, 1),
(3, 'tempete', 7, 0),
(4, 'tempete', 9, 0),
(5, 'rubissaphir', 6, 0),
(5, 'rubissaphir', 7, 0),
(5, 'tempete', 6, 0),
(6, 'rubissaphir', 9, 0),
(7, 'rubissaphir', 6, 0),
(9, 'rubissaphir', 6, 3),
(10, 'tempete', 7, 1),
(11, 'rubissaphir', 7, 0),
(12, 'rubissaphir', 6, 4),
(13, 'rubissaphir', 6, 7),
(14, 'rubissaphir', 6, 6),
(16, 'rubissaphir', 6, 6),
(16, 'rubissaphir', 8, 1),
(17, 'rubissaphir', 6, 6),
(18, 'rubissaphir', 6, 5),
(19, 'rubissaphir', 7, 2),
(20, 'rubissaphir', 6, 5),
(21, 'rubissaphir', 6, 8),
(21, 'rubissaphir', 7, 1),
(22, 'rubissaphir', 6, 5),
(22, 'rubissaphir', 7, 1),
(24, 'rubissaphir', 6, 7),
(24, 'rubissaphir', 8, 2),
(25, 'rubissaphir', 6, 11),
(26, 'rubissaphir', 6, 32),
(27, 'rubissaphir', 6, 11),
(27, 'rubissaphir', 8, 0),
(28, 'rubissaphir', 6, 34),
(29, 'rubissaphir', 6, 15),
(30, 'rubissaphir', 6, 35),
(30, 'rubissaphir', 7, 3),
(31, 'rubissaphir', 6, 9),
(31, 'rubissaphir', 7, 2),
(32, 'rubissaphir', 6, 28),
(32, 'rubissaphir', 8, 3),
(33, 'rubissaphir', 6, 17),
(34, 'rubissaphir', 6, 14),
(34, 'rubissaphir', 7, 3),
(35, 'rubissaphir', 6, 7),
(35, 'rubissaphir', 7, 1),
(36, 'rubissaphir', 6, 7),
(37, 'rubissaphir', 6, 0),
(37, 'rubissaphir', 7, 2),
(38, 'rubissaphir', 6, 8),
(39, 'rubissaphir', 6, 14),
(39, 'rubissaphir', 8, 1),
(40, 'rubissaphir', 6, 8),
(41, 'rubissaphir', 6, 28),
(41, 'rubissaphir', 7, 11),
(42, 'rubissaphir', 6, 4),
(43, 'rubissaphir', 6, 9),
(43, 'rubissaphir', 7, 5),
(44, 'rubissaphir', 6, 14),
(45, 'rubissaphir', 6, 9),
(45, 'rubissaphir', 7, 1),
(46, 'rubissaphir', 6, 34),
(46, 'rubissaphir', 7, 3),
(46, 'rubissaphir', 9, 2),
(47, 'rubissaphir', 6, 16),
(47, 'rubissaphir', 7, 2),
(48, 'rubissaphir', 6, 5),
(48, 'rubissaphir', 7, 2),
(49, 'rubissaphir', 6, 6),
(50, 'rubissaphir', 6, 15),
(51, 'rubissaphir', 6, 27),
(51, 'rubissaphir', 7, 9),
(51, 'rubissaphir', 8, 1),
(51, 'rubissaphir', 9, 2),
(52, 'rubissaphir', 6, 15),
(52, 'rubissaphir', 7, 7),
(53, 'rubissaphir', 6, 14),
(53, 'rubissaphir', 7, 2),
(54, 'rubissaphir', 6, 15),
(54, 'rubissaphir', 7, 4),
(55, 'rubissaphir', 6, 8),
(55, 'rubissaphir', 7, 3),
(55, 'tempete', 6, 1),
(56, 'rubissaphir', 6, 37),
(56, 'rubissaphir', 7, 8),
(56, 'rubissaphir', 9, 1),
(56, 'tempete', 6, 5),
(56, 'tempete', 9, 7),
(57, 'rubissaphir', 6, 1),
(58, 'rubissaphir', 6, 19),
(58, 'rubissaphir', 7, 1),
(58, 'tempete', 6, 0),
(59, 'rubissaphir', 6, 17),
(59, 'rubissaphir', 7, 3),
(59, 'tempete', 7, 0),
(60, 'rubissaphir', 6, 13),
(60, 'rubissaphir', 7, 4),
(60, 'tempete', 6, 0),
(60, 'tempete', 7, 1),
(61, 'rubissaphir', 6, 13),
(61, 'rubissaphir', 7, 1),
(62, 'rubissaphir', 6, 18),
(62, 'rubissaphir', 7, 1),
(62, 'tempete', 7, 0),
(63, 'rubissaphir', 6, 6),
(64, 'rubissaphir', 6, 12),
(64, 'rubissaphir', 7, 2),
(64, 'rubissaphir', 9, 1),
(64, 'tempete', 7, 0),
(65, 'rubissaphir', 6, 15),
(65, 'rubissaphir', 7, 2),
(65, 'tempete', 7, 0),
(66, 'rubissaphir', 6, 33),
(66, 'rubissaphir', 7, 6),
(66, 'rubissaphir', 8, 1),
(66, 'rubissaphir', 9, 1),
(67, 'rubissaphir', 6, 19),
(67, 'rubissaphir', 7, 4),
(67, 'rubissaphir', 9, 2),
(68, 'rubissaphir', 6, 34),
(68, 'rubissaphir', 7, 8),
(68, 'rubissaphir', 8, 2),
(68, 'rubissaphir', 9, 3),
(69, 'rubissaphir', 6, 4),
(70, 'rubissaphir', 6, 13),
(71, 'rubissaphir', 6, 11),
(71, 'rubissaphir', 7, 1),
(71, 'rubissaphir', 8, 1),
(71, 'rubissaphir', 9, 1),
(72, 'rubissaphir', 6, 11),
(72, 'rubissaphir', 7, 4),
(73, 'rubissaphir', 6, 10),
(74, 'rubissaphir', 6, 30),
(74, 'rubissaphir', 7, 5),
(75, 'rubissaphir', 6, 15),
(76, 'rubissaphir', 6, 8),
(76, 'rubissaphir', 7, 1),
(77, 'rubissaphir', 6, 14),
(77, 'rubissaphir', 7, 1),
(78, 'rubissaphir', 6, 18),
(79, 'rubissaphir', 6, 18),
(79, 'rubissaphir', 7, 3),
(80, 'rubissaphir', 6, 8),
(80, 'rubissaphir', 7, 1),
(81, 'rubissaphir', 6, 7),
(82, 'rubissaphir', 6, 8),
(82, 'rubissaphir', 7, 3),
(83, 'rubissaphir', 6, 10),
(83, 'rubissaphir', 7, 1),
(84, 'rubissaphir', 6, 9),
(84, 'rubissaphir', 9, 1),
(85, 'rubissaphir', 6, 10),
(85, 'rubissaphir', 7, 1),
(85, 'tempete', 7, 0),
(86, 'rubissaphir', 6, 10),
(86, 'rubissaphir', 7, 2),
(86, 'tempete', 9, 1),
(87, 'rubissaphir', 6, 13),
(87, 'tempete', 6, 2),
(88, 'rubissaphir', 6, 14),
(88, 'rubissaphir', 7, 1),
(88, 'tempete', 6, 1),
(89, 'rubissaphir', 6, 10),
(89, 'rubissaphir', 7, 1),
(89, 'tempete', 7, 0),
(90, 'rubissaphir', 6, 10),
(90, 'rubissaphir', 7, 2),
(90, 'tempete', 6, 3),
(90, 'tempete', 7, 8),
(90, 'tempete', 9, 6),
(91, 'rubissaphir', 6, 5),
(91, 'rubissaphir', 7, 2),
(91, 'tempete', 7, 2),
(92, 'rubissaphir', 6, 11),
(93, 'rubissaphir', 6, 18),
(93, 'tempete', 6, 1),
(94, 'rubissaphir', 6, 12),
(94, 'rubissaphir', 7, 4),
(94, 'tempete', 7, 0),
(95, 'rubissaphir', 6, 13),
(95, 'tempete', 6, 0),
(95, 'tempete', 9, 3),
(98, 'rubissaphir', 6, 1),
(100, 'rubissaphir', 6, 2),
(100, 'rubissaphir', 7, 1),
(101, 'rubissaphir', 6, 2),
(103, 'rubissaphir', 6, 3),
(104, 'rubissaphir', 6, 15),
(105, 'rubissaphir', 6, 13),
(105, 'rubissaphir', 7, 9),
(105, 'tempete', 6, 0),
(105, 'tempete', 7, 0),
(105, 'tempete', 9, 2),
(106, 'rubissaphir', 6, 13),
(106, 'tempete', 6, 1),
(107, 'rubissaphir', 6, 19),
(107, 'tempete', 7, 0),
(108, 'rubissaphir', 6, 12),
(108, 'rubissaphir', 9, 1),
(108, 'tempete', 7, 0),
(109, 'rubissaphir', 6, 12),
(109, 'rubissaphir', 9, 3),
(123, 'tempete', 6, 0),
(124, 'tempete', 7, 0),
(126, 'tempete', 9, 1),
(127, 'tempete', 6, 0),
(128, 'tempete', 6, 0),
(128, 'tempete', 7, 0),
(129, 'tempete', 7, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `carte`
--
ALTER TABLE `carte`
  ADD PRIMARY KEY (`IdCarte`,`SeriePaquet`),
  ADD KEY `IdGenerationCarte` (`IdGenerationCarte`);

--
-- Index pour la table `colis`
--
ALTER TABLE `colis`
  ADD PRIMARY KEY (`IdLivraison`),
  ADD KEY `IdCollectionneur` (`IdCollectionneur`);

--
-- Index pour la table `collectionneur`
--
ALTER TABLE `collectionneur`
  ADD PRIMARY KEY (`IdCollectionneur`),
  ADD UNIQUE KEY `Mail` (`Mail`);

--
-- Index pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD PRIMARY KEY (`IdCarte`,`SeriePaquet`,`IdLivraison`),
  ADD KEY `idLivraison` (`IdLivraison`);

--
-- Index pour la table `dresseur`
--
ALTER TABLE `dresseur`
  ADD PRIMARY KEY (`IdDresseur`,`SeriePaquet`);

--
-- Index pour la table `energie`
--
ALTER TABLE `energie`
  ADD PRIMARY KEY (`IdEnergie`,`SeriePaquet`);

--
-- Index pour la table `generation`
--
ALTER TABLE `generation`
  ADD PRIMARY KEY (`IdGenerationCarte`);

--
-- Index pour la table `pokemon`
--
ALTER TABLE `pokemon`
  ADD PRIMARY KEY (`IdPokemon`,`SeriePaquet`);

--
-- Index pour la table `posséder`
--
ALTER TABLE `posséder`
  ADD PRIMARY KEY (`IdCarte`,`SeriePaquet`,`IdCollectionneur`),
  ADD KEY `IdCollectionneur` (`IdCollectionneur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `colis`
--
ALTER TABLE `colis`
  MODIFY `IdLivraison` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `collectionneur`
--
ALTER TABLE `collectionneur`
  MODIFY `IdCollectionneur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `carte`
--
ALTER TABLE `carte`
  ADD CONSTRAINT `carte_ibfk_1` FOREIGN KEY (`IdGenerationCarte`) REFERENCES `generation` (`IdGenerationCarte`);

--
-- Contraintes pour la table `colis`
--
ALTER TABLE `colis`
  ADD CONSTRAINT `colis_ibfk_1` FOREIGN KEY (`IdCollectionneur`) REFERENCES `collectionneur` (`IdCollectionneur`);

--
-- Contraintes pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD CONSTRAINT `contenir_ibfk_1` FOREIGN KEY (`IdCarte`,`SeriePaquet`) REFERENCES `carte` (`IdCarte`, `SeriePaquet`),
  ADD CONSTRAINT `contenir_ibfk_2` FOREIGN KEY (`IdLivraison`) REFERENCES `colis` (`IdLivraison`);

--
-- Contraintes pour la table `dresseur`
--
ALTER TABLE `dresseur`
  ADD CONSTRAINT `dresseur_fk1` FOREIGN KEY (`IdDresseur`) REFERENCES `carte` (`IdCarte`),
  ADD CONSTRAINT `dresseur_ibfk_1` FOREIGN KEY (`IdDresseur`,`SeriePaquet`) REFERENCES `carte` (`IdCarte`, `SeriePaquet`);

--
-- Contraintes pour la table `energie`
--
ALTER TABLE `energie`
  ADD CONSTRAINT `energie_fk1` FOREIGN KEY (`IdEnergie`) REFERENCES `carte` (`IdCarte`),
  ADD CONSTRAINT `energie_ibfk_1` FOREIGN KEY (`IdEnergie`,`SeriePaquet`) REFERENCES `carte` (`IdCarte`, `SeriePaquet`);

--
-- Contraintes pour la table `pokemon`
--
ALTER TABLE `pokemon`
  ADD CONSTRAINT `pokemon_ibfk_1` FOREIGN KEY (`IdPokemon`,`SeriePaquet`) REFERENCES `carte` (`IdCarte`, `SeriePaquet`);

--
-- Contraintes pour la table `posséder`
--
ALTER TABLE `posséder`
  ADD CONSTRAINT `posséder_ibfk_1` FOREIGN KEY (`IdCarte`,`SeriePaquet`) REFERENCES `carte` (`IdCarte`, `SeriePaquet`),
  ADD CONSTRAINT `posséder_ibfk_2` FOREIGN KEY (`IdCollectionneur`) REFERENCES `collectionneur` (`IdCollectionneur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
