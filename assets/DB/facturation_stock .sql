-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2023 at 09:04 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `facturation_stock`
--

-- --------------------------------------------------------

--
-- Table structure for table `banque`
--

CREATE TABLE `banque` (
  `id` int(64) NOT NULL,
  `nomBanque` varchar(64) NOT NULL,
  `courtNomBanque` varchar(32) NOT NULL,
  `adresseBanque` varchar(128) NOT NULL,
  `cpBanque` int(8) NOT NULL,
  `villeBanque` varchar(32) NOT NULL,
  `telBanque` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `banque`
--

INSERT INTO `banque` (`id`, `nomBanque`, `courtNomBanque`, `adresseBanque`, `cpBanque`, `villeBanque`, `telBanque`) VALUES
(1, 'BANQUE POPULAIRE', 'BNP', '9 RUE GAMBETTA', 17200, 'ROYAN', '05_46_87_74_30'),
(2, 'CREDIT AGRICOLE', 'CA', '16 RUE LA BOETIE', 75001, 'PARIS', '05_46_05_02_77'),
(3, 'CIC', 'CIC', '14 RUE JEAN JAURES', 87000, 'LIMOGES', '05_55_33_60_54'),
(4, 'CAISSE D\'EPARGNE', 'CEP', '23 PL. DES CARMES', 87100, 'LIMOGES', '05_55_01_74_65'),
(5, 'CREDIT MUTUEL', 'CM', '69 Bd Aristide Briand', 17200, 'ROYAN', '05_46_23_54_00');

-- --------------------------------------------------------

--
-- Table structure for table `cheque`
--

CREATE TABLE `cheque` (
  `numeroCheque` varchar(32) NOT NULL,
  `dateCheque` date NOT NULL,
  `statutChequeSignature` tinyint(1) NOT NULL DEFAULT 0,
  `dateChequeSignature` date DEFAULT NULL,
  `statutChequeExpedition` tinyint(1) DEFAULT NULL,
  `dateChequeExpedition` date DEFAULT NULL,
  `descriptionCheque` varchar(128) DEFAULT NULL,
  `fkFacture` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cheque`
--

INSERT INTO `cheque` (`numeroCheque`, `dateCheque`, `statutChequeSignature`, `dateChequeSignature`, `statutChequeExpedition`, `dateChequeExpedition`, `descriptionCheque`, `fkFacture`) VALUES
('cvcv', '2023-05-10', 1, '2023-05-30', 1, '2023-05-30', '', 'er'),
('ddd', '2023-03-01', 1, '2023-03-06', 1, '2023-03-06', '', 'cx8787'),
('dsd', '2023-03-01', 1, '2023-03-06', 1, '2023-03-06', '', '125'),
('fdf', '2023-08-02', 1, '2023-08-18', 1, '2023-08-18', '', 'fdfd'),
('fdffdf', '2023-08-01', 1, '2023-08-18', NULL, NULL, '', 'fdfdd5'),
('qss', '2023-05-02', 1, '2023-05-30', 1, '2023-05-30', '', 'dsd'),
('sds', '2023-02-28', 1, '2023-03-06', 0, '2023-03-06', 'pour la raison x', 'cxfdfdf4'),
('vcv', '2023-05-01', 1, '2023-05-30', 0, '2023-08-18', 'fdfdfdf', 'fdfdfdd'),
('xx0025', '2023-03-01', 1, '2023-03-06', 1, '2023-03-06', '', 'dfdf'),
('zeze', '2023-05-02', 1, '2023-05-30', 0, '2023-05-30', 'cxcxc', 'bc');

-- --------------------------------------------------------

--
-- Table structure for table `facture`
--

CREATE TABLE `facture` (
  `numeroFacture` varchar(32) NOT NULL,
  `dateFacture` date NOT NULL,
  `montantFacture` decimal(32,0) NOT NULL,
  `montantLettresFacture` varchar(256) NOT NULL,
  `statutFacture` tinyint(1) NOT NULL,
  `fkSociete` int(32) NOT NULL,
  `statutChequeFacture` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `facture`
--

INSERT INTO `facture` (`numeroFacture`, `dateFacture`, `montantFacture`, `montantLettresFacture`, `statutFacture`, `fkSociete`, `statutChequeFacture`) VALUES
('125', '2023-03-14', 12, 'douze ', 1, 10, 1),
('78', '2023-08-22', 54, 'cinquante quatre  ', 1, 10, 0),
('bc', '2023-05-17', 56, 'cinquante six  ', 1, 5, 1),
('cx8787', '2023-03-02', 65, 'soixante cinq  ', 1, 7, 1),
('cxfdfdf4', '2022-12-26', 555, 'cinq cent quarante cinq  ', 1, 6, 1),
('dfdf', '2022-11-30', 42, 'quarante deux  ', 1, 4, 1),
('dfdg', '2023-08-08', 852, 'huit cent cinquante deux  ', 0, 9, 0),
('dsd', '2023-02-28', 54, 'cinquante quatre  ', 1, 10, 1),
('egdfg', '2023-08-09', 4, 'quatre ', 0, 3, 0),
('er', '2022-12-22', 545, 'cinquante quatre  ', 1, 5, 1),
('fdfd', '2022-12-02', 562, 'cinq cent soixante deux  ', 1, 3, 1),
('fdfdd5', '2023-05-10', 1, 'un ', 1, 6, 1),
('fdfdf', '2022-12-22', 565, 'cinq cent soixante cinq  ', 1, 5, 0),
('fdfdfdd', '2022-12-22', 74, 'soixante-dix quatre  ', 1, 7, 1),
('ffg', '2022-12-28', 541, 'cinq cent quarante un  ', 1, 7, 0),
('fh', '2023-05-04', 645, 'six cent quarante cinq  ', 1, 6, 0),
('fqfqs', '2023-08-02', 35, 'trent cinq  ', 1, 7, 0),
('fr0023', '2023-05-03', 65, 'soixante cinq  ', 1, 10, 0),
('gf', '2023-01-21', 54, 'cinquante quatre  ', 1, 3, 0),
('gfgf', '2023-05-04', 125, 'un cent vingt cinq  ', 1, 10, 0),
('gfsf', '2023-08-02', 56, 'cinquante six  ', 1, 5, 0),
('gh', '2023-05-10', 125, 'un cent vingt cinq  ', 1, 1, 0),
('hd', '2023-05-11', 6, 'six ', 1, 2, 0),
('hgjn', '2022-12-06', 544, 'cinq cent quarante quatre  ', 1, 2, 0),
('khg', '2023-05-12', 5, 'cinq ', 1, 5, 0),
('lk', '2023-05-12', 65, 'soixante cinq  ', 1, 10, 0),
('lkk', '2023-03-06', 6565, 'six  mille cinq cent soixante cinq  ', 1, 10, 0),
('lklk', '2023-03-08', 51, 'cinquante un  ', 1, 10, 0),
('rw', '2023-05-25', 65, 'soixante cinq  ', 1, 4, 0),
('sd', '2022-12-21', 25, 'vingt cinq  ', 1, 10, 0),
('sdd', '2023-08-31', 5, 'cinq ', 0, 7, 0),
('sdfgh,', '2022-12-08', 544, 'cinq cent quarante quatre  ', 1, 6, 0),
('sds', '2023-08-24', 21, 'vingt un  ', 1, 10, 0),
('sdsd', '2022-12-13', 5445, 'cinq  mille quatre cent quarante cinq  ', 1, 2, 0),
('sdsdsd', '2022-12-22', 56, 'cinquante six  ', 1, 7, 0),
('sdsdsdsd', '2023-05-18', 111, 'un cent onze ', 1, 6, 0),
('sdsqqfg', '2023-08-15', 54, 'cinquante quatre  ', 1, 5, 0),
('sqdqf', '2023-08-31', 322, 'trois cent vingt deux  ', 1, 7, 0),
('tr', '2023-05-05', 5, 'cinq ', 1, 7, 0),
('vc879', '2023-03-04', 5, 'cinq ', 1, 6, 0),
('vdsgdsg', '2022-12-13', 125, 'un cent vingt cinq  ', 1, 4, 0),
('xx', '2023-05-06', 5445, 'cinq  mille quatre cent quarante cinq  ', 1, 5, 0),
('xx001', '2022-12-14', 45, 'quarante cinq  ', 1, 4, 0),
('xx5', '2023-05-02', 2, 'deux ', 1, 7, 0),
('xy005', '2023-03-02', 124, 'un cent vingt quatre  ', 1, 2, 0),
('yg', '2023-05-10', 45, 'quarante cinq  ', 1, 3, 0),
('ythg', '2023-08-03', 526565656, 'x', 0, 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `societe`
--

CREATE TABLE `societe` (
  `id` int(11) NOT NULL,
  `nomSociete` varchar(64) NOT NULL,
  `fkBanque` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `societe`
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
-- Indexes for dumped tables
--

--
-- Indexes for table `banque`
--
ALTER TABLE `banque`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cheque`
--
ALTER TABLE `cheque`
  ADD PRIMARY KEY (`numeroCheque`),
  ADD KEY `fk_cheque_k_facture` (`fkFacture`);

--
-- Indexes for table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`numeroFacture`),
  ADD KEY `fk_facture_k_societe` (`fkSociete`);

--
-- Indexes for table `societe`
--
ALTER TABLE `societe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_societe_k_banque` (`fkBanque`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banque`
--
ALTER TABLE `banque`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `societe`
--
ALTER TABLE `societe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cheque`
--
ALTER TABLE `cheque`
  ADD CONSTRAINT `fk_cheque_k_facture` FOREIGN KEY (`fkFacture`) REFERENCES `facture` (`numeroFacture`);

--
-- Constraints for table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `fk_facture_k_societe` FOREIGN KEY (`fkSociete`) REFERENCES `societe` (`id`);

--
-- Constraints for table `societe`
--
ALTER TABLE `societe`
  ADD CONSTRAINT `fk_societe_k_banque` FOREIGN KEY (`fkBanque`) REFERENCES `banque` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
