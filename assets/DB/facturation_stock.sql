-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 11 nov. 2022 à 14:51
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `facturation_stock`
--

-- --------------------------------------------------------

--
-- Structure de la table `banque`
--

DROP TABLE IF EXISTS `banque`;
CREATE TABLE IF NOT EXISTS `banque` (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `nomBanque` varchar(64) NOT NULL,
  `courtNomBanque` varchar(32) NOT NULL,
  `adresseBanque` varchar(128) NOT NULL,
  `cpBanque` int(8) NOT NULL,
  `villeBanque` varchar(32) NOT NULL,
  `telBanque` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `banque`
--

INSERT INTO `banque` (`id`, `nomBanque`, `courtNomBanque`, `adresseBanque`, `cpBanque`, `villeBanque`, `telBanque`) VALUES
(1, 'BANQUE POPULAIRE', 'BNP', '9 RUE GAMBETTA', 17200, 'ROYAN', '05_46_87_74_30'),
(2, 'CREDIT AGRICOLE', 'CA', '16 RUE LA BOETIE', 75001, 'PARIS', '05_46_05_02_77'),
(3, 'CIC', 'CIC', '14 RUE JEAN JAURES', 87000, 'LIMOGES', '05_55_33_60_54'),
(4, 'CAISSE D\'EPARGNE', 'CEP', '23 PL. DES CARMES', 87100, 'LIMOGES', '05_55_01_74_65'),
(5, 'CREDIT MUTUEL', 'CM', '69 Bd Aristide Briand', 17200, 'ROYAN', '05_46_23_54_00');

-- --------------------------------------------------------

--
-- Structure de la table `cheque`
--

DROP TABLE IF EXISTS `cheque`;
CREATE TABLE IF NOT EXISTS `cheque` (
  `numeroCheque` varchar(32) NOT NULL,
  `dateCheque` date NOT NULL,
  `statutChequeSignature` tinyint(1) NOT NULL,
  `dateChequeSignature` date NOT NULL,
  `statutChequeExpedition` tinyint(1) NOT NULL,
  `dateChequeExpedition` date NOT NULL,
  `descriptionCheque` varchar(128) NOT NULL,
  `fkFacture` varchar(32) NOT NULL,
  PRIMARY KEY (`numeroCheque`),
  KEY `fk_cheque_k_facture` (`fkFacture`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

DROP TABLE IF EXISTS `facture`;
CREATE TABLE IF NOT EXISTS `facture` (
  `numeroFacture` varchar(32) NOT NULL,
  `dateFacture` date NOT NULL,
  `montantFacture` decimal(32,0) NOT NULL,
  `statutFacture` tinyint(1) NOT NULL,
  `fkSociete` int(32) NOT NULL,
  PRIMARY KEY (`numeroFacture`),
  KEY `fk_facture_k_societe` (`fkSociete`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `facture`
--

INSERT INTO `facture` (`numeroFacture`, `dateFacture`, `montantFacture`, `statutFacture`, `fkSociete`) VALUES
('656', '2022-11-14', '65', 0, 7),
('gf', '2022-11-15', '565', 0, 2);

-- --------------------------------------------------------

--
-- Structure de la table `societe`
--

DROP TABLE IF EXISTS `societe`;
CREATE TABLE IF NOT EXISTS `societe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomSociete` varchar(64) NOT NULL,
  `fkBanque` int(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_societe_k_banque` (`fkBanque`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `societe`
--

INSERT INTO `societe` (`id`, `nomSociete`, `fkBanque`) VALUES
(1, 'SAS LA PREMIERE', 1),
(2, 'NICKEL CHROME', 2),
(3, 'ATLANTIQUE', 3),
(4, 'ALERT', 4),
(5, 'SARL FATOU', 5),
(6, 'SAISON', 3),
(7, 'FACTORIA', 2),
(8, 'STORM', 1),
(9, 'SIMAIR', 2),
(10, 'ATLAS LIFT', 2);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cheque`
--
ALTER TABLE `cheque`
  ADD CONSTRAINT `fk_cheque_k_facture` FOREIGN KEY (`fkFacture`) REFERENCES `facture` (`numeroFacture`);

--
-- Contraintes pour la table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `fk_facture_k_societe` FOREIGN KEY (`fkSociete`) REFERENCES `societe` (`id`);

--
-- Contraintes pour la table `societe`
--
ALTER TABLE `societe`
  ADD CONSTRAINT `fk_societe_k_banque` FOREIGN KEY (`fkBanque`) REFERENCES `banque` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
