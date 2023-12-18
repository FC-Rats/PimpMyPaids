-- phpMyAdmin SQL Dump
-- version 4.6.6deb4+deb9u2
-- https://www.phpmyadmin.net/
--
-- Généré le :  Lun 18 Décembre 2023 à 17:23
-- Version du serveur :  5.7.30-log
-- Version de PHP :  7.0.33-0+deb9u12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `PimpMyPaids_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `TRAN_CUSTOMER_ACCOUNT`
--

CREATE TABLE `TRAN_CUSTOMER_ACCOUNT` (
  `siren` char(9) NOT NULL,
  `companyName` varchar(255) NOT NULL,
  `currency` char(3) NOT NULL,
  `idUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `TRAN_CUSTOMER_ACCOUNT`
--

INSERT INTO `TRAN_CUSTOMER_ACCOUNT` (`siren`, `companyName`, `currency`, `idUser`) VALUES
('100010001', 'LA', 'EUR', 7),
('123456789', 'McDo Champs', 'EUR', 1),
('234567890', 'HomePlus Central', 'USD', 5),
('876543219', 'QuickMart Town', 'GPB', 6),
('987654321', 'Leroy Merlin Noisy', 'EUR', 2);

-- --------------------------------------------------------

--
-- Structure de la table `TRAN_REMITTANCES`
--

CREATE TABLE `TRAN_REMITTANCES` (
  `remittanceNumber` varchar(30) NOT NULL,
  `dateRemittance` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `TRAN_REMITTANCES`
--

INSERT INTO `TRAN_REMITTANCES` (`remittanceNumber`, `dateRemittance`) VALUES
('REM001', '2023-08-30'),
('REM002', '2023-12-26'),
('REM003', '2023-02-16'),
('REM004', '2023-10-18'),
('REM005', '2023-08-10'),
('REM006', '2023-02-14'),
('REM007', '2023-05-01'),
('REM008', '2023-06-12'),
('REM009', '2023-12-30'),
('REM010', '2023-08-14'),
('REM011', '2023-06-11'),
('REM012', '2023-12-12'),
('REM013', '2023-10-15'),
('REM014', '2023-04-09'),
('REM015', '2023-09-30'),
('REM016', '2023-12-08'),
('REM017', '2023-09-22'),
('REM018', '2023-09-28'),
('REM019', '2023-05-17');

-- --------------------------------------------------------

--
-- Structure de la table `TRAN_REQUEST_PO`
--

CREATE TABLE `TRAN_REQUEST_PO` (
  `idRequest` int(11) NOT NULL,
  `siren` char(9) DEFAULT NULL,
  `login` varchar(255) NOT NULL,
  `companyName` varchar(255) NOT NULL,
  `currency` char(3) DEFAULT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `comment` varchar(1024) DEFAULT NULL,
  `type` int(11) NOT NULL,
  `statement` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `TRAN_REQUEST_PO`
--

INSERT INTO `TRAN_REQUEST_PO` (`idRequest`, `siren`, `login`, `companyName`, `currency`, `firstName`, `lastName`, `email`, `comment`, `type`, `statement`) VALUES
(19, '100010001', 'LinksAwordkening', 'LA', 'EUR', 'Team', 'Rats', 'projet-saebut@gmail.com', 'Hésitez pas à nous soutenir sur nos autres projets !', 0, 'A exécuter'),
(20, NULL, 'McDo', 'McDo Champs', NULL, NULL, NULL, NULL, 'En redressement judiciaire ', 1, 'A exécuter');

-- --------------------------------------------------------

--
-- Structure de la table `TRAN_TRANSACTIONS`
--

CREATE TABLE `TRAN_TRANSACTIONS` (
  `idTransac` int(11) NOT NULL,
  `dateTransac` date NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `numAutorisation` char(6) NOT NULL,
  `creditCardNumber` char(16) NOT NULL,
  `network` char(2) NOT NULL,
  `sign` char(1) NOT NULL,
  `remittanceNumber` varchar(30) DEFAULT NULL,
  `siren` char(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `TRAN_TRANSACTIONS`
--

INSERT INTO `TRAN_TRANSACTIONS` (`idTransac`, `dateTransac`, `amount`, `numAutorisation`, `creditCardNumber`, `network`, `sign`, `remittanceNumber`, `siren`) VALUES
(1, '2023-08-30', '10.99', '123456', '4111111111111111', 'VS', '+', 'REM001', '123456789'),
(2, '2023-08-30', '150.00', '234567', '4111111111112222', 'VS', '+', 'REM001', '123456789'),
(3, '2023-08-30', '200.00', '345678', '4111111111113333', 'VS', '-', 'REM001', '123456789'),
(4, '2023-08-30', '250.00', '456789', '4111111111114444', 'VS', '+', 'REM001', '123456789'),
(5, '2023-08-30', '2500.00', '567890', '4111111111115555', 'VS', '+', 'REM001', '123456789'),
(6, '2023-12-22', '700.00', '678901', '5555555555556666', 'MC', '+', 'REM002', '987654321'),
(7, '2023-12-22', '400.00', '789012', '5555555555557777', 'MC', '-', 'REM002', '987654321'),
(8, '2023-12-22', '450.00', '890123', '5555555555558888', 'MC', '+', 'REM002', '987654321'),
(9, '2023-12-22', '500.00', '901234', '5555555555559999', 'MC', '+', 'REM002', '987654321'),
(10, '2023-12-22', '550.00', '012345', '5555555555550000', 'MC', '-', 'REM002', '987654321'),
(11, '2023-02-16', '2000.50', '137890', '4111111111115556', 'CB', '+', 'REM003', '987654321'),
(12, '2023-02-16', '25.00', '628501', '5555555555556667', 'CB', '+', 'REM003', '987654321'),
(13, '2023-02-16', '40.00', '749022', '5555555555556667', 'CB', '-', 'REM003', '987654321'),
(14, '2023-02-16', '2415.00', '894173', '5555555555558882', 'CB', '+', 'REM003', '987654321'),
(15, '2023-02-16', '53.00', '204234', '5555555555559992', 'CB', '+', 'REM003', '987654321'),
(16, '2023-02-16', '222.22', '213345', '5555555555550001', 'CB', '-', 'REM003', '987654321'),
(17, '2023-10-18', '100.00', '321654', '4111111111116666', 'VS', '+', 'REM004', '234567890'),
(18, '2023-10-18', '200.00', '432765', '5555555555551111', 'MC', '-', 'REM004', '234567890'),
(19, '2023-10-18', '150.00', '543876', '4111111111117777', 'VS', '+', 'REM004', '234567890'),
(20, '2023-10-18', '250.25', '654987', '5555555555552222', 'MC', '-', 'REM004', '234567890'),
(21, '2023-08-10', '300.00', '765098', '4111111111118888', 'VS', '+', 'REM005', '876543219'),
(22, '2023-08-10', '400.00', '876109', '5555555555553333', 'MC', '-', 'REM005', '876543219'),
(23, '2023-08-10', '500.00', '987210', '4111111111119999', 'VS', '+', 'REM005', '876543219'),
(24, '2023-08-10', '6.00', '098321', '5555555555554444', 'CB', '-', 'REM005', '876543219'),
(25, '2023-08-10', '700.00', '109432', '4111111111110000', 'VS', '+', 'REM005', '876543219'),
(26, '2023-02-14', '350.00', '215634', '5555555555551111', 'MC', '+', 'REM006', '234567890'),
(27, '2023-02-14', '450.00', '326745', '4111111111112222', 'VS', '-', 'REM006', '234567890'),
(28, '2023-02-14', '550.00', '437856', '5555555555553333', 'MC', '+', 'REM006', '234567890'),
(29, '2023-05-01', '250.00', '548967', '4111111111114444', 'VS', '-', 'REM007', '876543219'),
(30, '2023-05-01', '350.00', '659078', '5555555555555555', 'VS', '+', 'REM007', '876543219'),
(31, '2023-05-01', '45.99', '770189', '4111111111116666', 'CB', '-', 'REM007', '876543219'),
(32, '2023-05-01', '550.00', '881290', '5555555555557777', 'MC', '+', 'REM007', '876543219'),
(33, '2023-05-01', '650.00', '992401', '4111111111118888', 'VS', '-', 'REM007', '876543219'),
(34, '2023-06-12', '150.00', '103512', '5555555555559999', 'MC', '+', 'REM008', '234567890'),
(35, '2023-06-12', '250.00', '214623', '4111111111110000', 'VS', '-', 'REM008', '234567890'),
(36, '2023-06-12', '350.00', '325734', '5555555555551111', 'MC', '+', 'REM008', '234567890'),
(37, '2023-06-12', '450.00', '436845', '4111111111112222', 'VS', '-', 'REM008', '234567890'),
(38, '2023-06-12', '550.00', '547956', '5555555555553333', 'MC', '+', 'REM008', '234567890'),
(39, '2023-06-12', '650.00', '658067', '4111111111114444', 'VS', '-', 'REM008', '234567890'),
(40, '2023-06-12', '750.00', '769178', '5555555555555555', 'MC', '+', 'REM008', '234567890'),
(41, '2023-12-19', '200.00', '880289', '4111111111116666', 'VS', '+', 'REM009', '876543219'),
(42, '2023-12-19', '300.00', '991390', '5555555555557777', 'MC', '-', 'REM009', '876543219'),
(43, '2023-12-19', '400.00', '102501', '4111111111118888', 'VS', '+', 'REM009', '876543219'),
(44, '2023-12-19', '500.00', '213612', '5555555555559999', 'MC', '-', 'REM009', '876543219'),
(45, '2023-08-14', '100.00', '324135', '4111111111117777', 'VS', '+', 'REM010', '234567890'),
(46, '2023-08-14', '200.00', '435246', '5555555555558888', 'MC', '-', 'REM010', '234567890'),
(47, '2023-08-14', '300.00', '546357', '4111111111119999', 'VS', '+', 'REM010', '234567890'),
(48, '2023-08-14', '400.00', '657468', '5555555555550000', 'MC', '-', 'REM010', '234567890'),
(49, '2023-06-11', '150.00', '768579', '4111111111111111', 'VS', '-', 'REM011', '876543219'),
(50, '2023-06-11', '250.00', '879680', '5555555555552222', 'MC', '+', 'REM011', '876543219'),
(51, '2023-06-11', '350.00', '990791', '4111111111113333', 'VS', '-', 'REM011', '876543219'),
(52, '2023-12-12', '200.00', '101902', '5555555555554444', 'MC', '+', 'REM012', '234567890'),
(53, '2023-12-12', '300.00', '213013', '4111111111115555', 'VS', '-', 'REM012', '234567890'),
(54, '2023-12-12', '400.00', '324124', '5555555555556666', 'MC', '+', 'REM012', '234567890'),
(55, '2023-12-12', '500.00', '435235', '4111111111117777', 'VS', '-', 'REM012', '234567890'),
(56, '2023-12-12', '600.00', '546346', '5555555555558888', 'MC', '+', 'REM012', '234567890'),
(57, '2023-10-15', '150.00', '658479', '4111111111118888', 'VS', '+', 'REM013', '876543219'),
(58, '2023-10-15', '250.00', '769580', '5555555555559999', 'MC', '-', 'REM013', '876543219'),
(59, '2023-10-15', '350.00', '880691', '4111111111110000', 'CB', '+', 'REM013', '876543219'),
(60, '2023-10-15', '450.00', '991802', '5555555555551111', 'MC', '-', 'REM013', '876543219'),
(61, '2023-10-15', '550.00', '102913', '4111111111112222', 'VS', '+', 'REM013', '876543219'),
(62, '2023-10-15', '650.00', '214024', '5555555555553333', 'CB', '-', 'REM013', '876543219'),
(63, '2023-04-09', '200.00', '325135', '4111111111114444', 'VS', '+', 'REM014', '234567890'),
(64, '2023-04-09', '300.00', '436246', '5555555555555555', 'MC', '-', 'REM014', '234567890'),
(65, '2023-04-09', '400.00', '547357', '4111111111116666', 'VS', '+', 'REM014', '234567890'),
(66, '2023-04-09', '50.00', '658468', '5555555555557777', 'CB', '-', 'REM014', '234567890'),
(67, '2023-09-30', '250.00', '769579', '4111111111118888', 'VS', '-', 'REM015', '876543219'),
(68, '2023-09-30', '350.00', '880680', '5555555555559999', 'MC', '+', 'REM015', '876543219'),
(69, '2023-09-30', '450.00', '991791', '4111111111110000', 'VS', '-', 'REM015', '876543219'),
(70, '2023-09-30', '550.00', '102902', '5555555555551111', 'MC', '+', 'REM015', '876543219'),
(71, '2023-09-30', '650.00', '214013', '4111111111112222', 'VS', '-', 'REM015', '876543219'),
(72, '2023-12-08', '100.00', '325124', '5555555555553333', 'MC', '+', 'REM016', '234567890'),
(73, '2023-12-08', '200.00', '436235', '4111111111114444', 'VS', '-', 'REM016', '234567890'),
(74, '2023-12-08', '300.00', '547346', '5555555555555555', 'MC', '+', 'REM016', '234567890'),
(75, '2023-12-08', '400.00', '658457', '4111111111116666', 'CB', '-', 'REM016', '234567890'),
(76, '2023-12-08', '500.00', '769568', '5555555555557777', 'MC', '+', 'REM016', '234567890'),
(77, '2023-12-08', '600.00', '880679', '4111111111118888', 'VS', '-', 'REM016', '234567890'),
(78, '2023-12-08', '700.00', '991790', '5555555555559999', 'MC', '+', 'REM016', '234567890'),
(79, '2023-09-22', '300.00', '802901', '4111111111110000', 'VS', '+', 'REM017', '234567890'),
(80, '2023-09-22', '400.00', '913012', '5555555555551111', 'CB', '-', 'REM017', '234567890'),
(81, '2023-09-22', '50.00', '024123', '4111111111112222', 'VS', '+', 'REM017', '234567890'),
(82, '2023-09-28', '150.00', '135234', '5555555555553333', 'MC', '-', 'REM018', '876543219'),
(83, '2023-09-28', '250.00', '246345', '4111111111114444', 'VS', '+', 'REM018', '876543219'),
(84, '2023-09-28', '350.00', '357456', '5555555555555555', 'MC', '-', 'REM018', '876543219'),
(85, '2023-09-28', '450.00', '468567', '4111111111116666', 'VS', '+', 'REM018', '876543219'),
(86, '2023-09-28', '550.00', '579678', '5555555555557777', 'CB', '-', 'REM018', '876543219'),
(87, '2023-09-28', '50.00', '690789', '4111111111118888', 'VS', '+', 'REM018', '876543219'),
(88, '2023-05-17', '200.00', '801890', '5555555555559999', 'MC', '+', 'REM019', '234567890'),
(89, '2023-05-17', '300.00', '912901', '4111111111110000', 'CB', '+', 'REM019', '234567890'),
(90, '2023-05-17', '400.00', '023012', '5555555555551111', 'CB', '+', 'REM019', '234567890'),
(91, '2023-05-17', '500.00', '134123', '4111111111112222', 'VS', '+', 'REM019', '234567890'),
(92, '2023-05-17', '60.00', '245234', '5555555555553333', 'MC', '+', 'REM019', '234567890'),
(93, '2023-09-11', '5000.00', '123456', '4111111111111111', 'VS', '+', NULL, '123456789'),
(94, '2023-01-24', '5500.00', '234567', '4111111111112222', 'VS', '+', NULL, '123456789'),
(95, '2023-01-31', '6000.00', '345678', '4111111111113333', 'VS', '+', NULL, '123456789'),
(96, '2023-09-24', '6500.00', '456789', '4111111111114444', 'VS', '+', NULL, '123456789'),
(97, '2023-01-09', '7000.00', '567890', '4111111111115555', 'VS', '+', NULL, '123456789'),
(98, '2023-03-06', '5000.00', '678901', '5555555555556666', 'MC', '+', NULL, '987654321'),
(99, '2023-10-19', '5500.00', '789012', '5555555555557777', 'MC', '+', NULL, '987654321'),
(100, '2023-03-05', '6000.00', '890123', '5555555555558888', 'MC', '+', NULL, '987654321'),
(101, '2023-02-08', '6500.00', '901234', '5555555555559999', 'MC', '+', NULL, '987654321'),
(102, '2023-01-15', '7000.00', '012345', '5555555555550000', 'MC', '+', NULL, '987654321'),
(103, '2023-04-27', '7500.00', '137890', '4111111111115556', 'CB', '+', NULL, '987654321'),
(104, '2023-09-17', '8000.00', '628501', '5555555555556667', 'CB', '+', NULL, '987654321'),
(105, '2023-06-13', '5000.00', '894173', '5555555555558882', 'CB', '+', NULL, '234567890'),
(106, '2023-06-12', '5500.00', '204234', '5555555555559992', 'CB', '+', NULL, '234567890'),
(107, '2023-02-12', '6000.00', '213345', '5555555555550001', 'CB', '+', NULL, '234567890'),
(108, '2023-08-17', '6500.00', '321654', '4111111111116666', 'VS', '+', NULL, '234567890'),
(109, '2023-03-24', '7000.00', '432765', '5555555555551111', 'MC', '+', NULL, '234567890'),
(110, '2023-04-11', '5000.00', '543876', '4111111111117777', 'VS', '+', NULL, '876543219'),
(111, '2023-06-03', '5500.00', '654987', '5555555555552222', 'MC', '+', NULL, '876543219'),
(112, '2023-09-01', '6000.00', '765098', '4111111111118888', 'VS', '+', NULL, '876543219'),
(113, '2023-01-02', '6500.00', '876109', '5555555555553333', 'MC', '+', NULL, '876543219'),
(114, '2023-05-18', '7000.00', '987210', '4111111111119999', 'VS', '+', NULL, '876543219'),
(115, '2023-12-12', '7500.00', '098321', '5555555555554444', 'CB', '+', NULL, '876543219'),
(116, '2023-10-13', '7999.99', '109432', '4111111111110000', 'VS', '+', NULL, '876543219'),
(117, '2023-04-19', '200.00', '429050', '4111111111111111', 'VS', '-', NULL, '123456789'),
(118, '2023-06-25', '150.00', '769401', '4111111111111111', 'VS', '-', NULL, '123456789'),
(119, '2023-02-05', '300.00', '205631', '4111111111111111', 'VS', '-', NULL, '123456789'),
(120, '2023-10-16', '220.00', '892300', '4111111111111111', 'VS', '-', NULL, '123456789'),
(121, '2023-12-12', '2000.00', '619845', '1254896523652145', 'CB', '+', 'REM001', '123456789'),
(122, '2023-12-13', '3000.00', '985412', '3214569874521458', 'MC', '-', NULL, '987654321'),
(123, '2023-12-14', '3001.01', '963265', '3214569874521458', 'MC', '-', NULL, '987654321');

-- --------------------------------------------------------

--
-- Structure de la table `TRAN_UNPAIDS`
--

CREATE TABLE `TRAN_UNPAIDS` (
  `unpaidFileNumber` char(5) NOT NULL,
  `idTransac` int(11) NOT NULL,
  `idUnpaidReason` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `TRAN_UNPAIDS`
--

INSERT INTO `TRAN_UNPAIDS` (`unpaidFileNumber`, `idTransac`, `idUnpaidReason`) VALUES
('UP008', 3, 3),
('UP009', 7, 2),
('UP010', 10, 5),
('UP011', 13, 1),
('UP012', 16, 3),
('UP013', 18, 4),
('UP014', 20, 7),
('UP015', 22, 6),
('UP016', 24, 2),
('UP017', 27, 5),
('UP018', 29, 8),
('UP019', 31, 1),
('UP020', 33, 3),
('UP021', 35, 4),
('UP022', 37, 7),
('UP023', 39, 6),
('UP024', 42, 2),
('UP025', 44, 5),
('UP026', 46, 8),
('UP027', 48, 1),
('UP028', 49, 3),
('UP029', 51, 4),
('UP030', 53, 7),
('UP031', 55, 6),
('UP032', 60, 2),
('UP033', 62, 5),
('UP034', 64, 8),
('UP035', 66, 1),
('UP036', 67, 3),
('UP037', 69, 4),
('UP038', 73, 7),
('UP039', 75, 6),
('UP040', 77, 2),
('UP041', 80, 5),
('UP042', 82, 8),
('UP043', 84, 1),
('UP044', 86, 3),
('UP045', 117, 3),
('UP046', 118, 8),
('UP047', 119, 4),
('UP048', 120, 5);

-- --------------------------------------------------------

--
-- Structure de la table `TRAN_UNPAID_REASONS`
--

CREATE TABLE `TRAN_UNPAID_REASONS` (
  `idUnpaidReason` int(11) NOT NULL,
  `unpaidName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `TRAN_UNPAID_REASONS`
--

INSERT INTO `TRAN_UNPAID_REASONS` (`idUnpaidReason`, `unpaidName`) VALUES
(1, 'Fraude à la carte'),
(2, 'Compte à découvert'),
(3, 'Compte clôturé'),
(4, 'Compte bloqué'),
(5, 'Provision insuffisante'),
(6, 'Opération contestée par le débiteur'),
(7, 'Titulaire décédé'),
(8, 'Raison non communiquée, contactez la banque du client'),
(9, 'Autre raison');

-- --------------------------------------------------------

--
-- Structure de la table `TRAN_USERS`
--

CREATE TABLE `TRAN_USERS` (
  `idUser` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profil` varchar(8) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tokenR` bigint(20) DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `TRAN_USERS`
--

INSERT INTO `TRAN_USERS` (`idUser`, `login`, `password`, `profil`, `lastName`, `firstName`, `email`, `tokenR`, `state`) VALUES
(1, 'McDo', '$2y$10$QICPc4xVvLVg4wWfQADiG.S1IlpH8czgI1PfKCcU.swILAnIXxsW6', 'Merchant', 'Doe', 'John', 'johndoe@mcdo.com', NULL, 1),
(2, 'LeroyMerlin', '$2y$10$Ocl.hnVtGbhlkW3cGj6KEeITYHSNCo45nsHUFtKkpo7l3P418PNLW', 'Merchant', 'Smith', 'Jane', 'smithjane@merlin.com', NULL, 1),
(3, 'PO', '$2y$10$6VgP8aRVh2Cxojs58sdiXuOxlVUuctE0S9Ajx.xY/fwghvTY06lwS', 'PO', 'Tran', 'Louis', 'exemple.po@gmail.com', NULL, 1),
(4, 'Admin', '$2y$10$UtB.xnqj/jNlxuSsB2Ay7uFfsWdgR92XPoMEtolp.SE/EoF6ibUpm', 'Admin', 'Wilson', 'Bob', 'exemple.admin@gmail.com', NULL, 1),
(5, 'HomePlus', '$2y$10$Higc7NYVaqrNU/lezQ.yM.746R4fk2gBDAPDQXNhNQDLTC31evqGG', 'Merchant', 'Johnson', 'Emily', 'johnsonemily@gmail.com', NULL, 1),
(6, 'QuickMart', '$2y$10$3Ce1mmzmd53GApb09jg2leLOEgFTEwVnACH.wM9xTSaDXMo4uGwca', 'Merchant', 'Davis', 'Michael', 'davismichael@gmail.com', NULL, 1),
(7, 'LinksAwordkening', '$2y$10$O6acBbASzmREBaBwVu1E6ORe/MRrORv3XffCfq9nGFOYRh6tihDvG', 'Merchant', 'Rats', 'Team', 'projet-saebut@gmail.com', NULL, 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `TRAN_CUSTOMER_ACCOUNT`
--
ALTER TABLE `TRAN_CUSTOMER_ACCOUNT`
  ADD PRIMARY KEY (`siren`),
  ADD KEY `idUser-Account` (`idUser`);

--
-- Index pour la table `TRAN_REMITTANCES`
--
ALTER TABLE `TRAN_REMITTANCES`
  ADD PRIMARY KEY (`remittanceNumber`);

--
-- Index pour la table `TRAN_REQUEST_PO`
--
ALTER TABLE `TRAN_REQUEST_PO`
  ADD PRIMARY KEY (`idRequest`);

--
-- Index pour la table `TRAN_TRANSACTIONS`
--
ALTER TABLE `TRAN_TRANSACTIONS`
  ADD PRIMARY KEY (`idTransac`),
  ADD KEY `fk_Transac_CustomerAccount` (`siren`),
  ADD KEY `fk_Transac_Remittance` (`remittanceNumber`);

--
-- Index pour la table `TRAN_UNPAIDS`
--
ALTER TABLE `TRAN_UNPAIDS`
  ADD PRIMARY KEY (`unpaidFileNumber`),
  ADD KEY `fkk_unpaids_transac` (`idTransac`),
  ADD KEY `fkk_unpaids_unpaidReasons` (`idUnpaidReason`);

--
-- Index pour la table `TRAN_UNPAID_REASONS`
--
ALTER TABLE `TRAN_UNPAID_REASONS`
  ADD PRIMARY KEY (`idUnpaidReason`);

--
-- Index pour la table `TRAN_USERS`
--
ALTER TABLE `TRAN_USERS`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `TRAN_REQUEST_PO`
--
ALTER TABLE `TRAN_REQUEST_PO`
  MODIFY `idRequest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `TRAN_TRANSACTIONS`
--
ALTER TABLE `TRAN_TRANSACTIONS`
  MODIFY `idTransac` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;
--
-- AUTO_INCREMENT pour la table `TRAN_USERS`
--
ALTER TABLE `TRAN_USERS`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `TRAN_CUSTOMER_ACCOUNT`
--
ALTER TABLE `TRAN_CUSTOMER_ACCOUNT`
  ADD CONSTRAINT `idUser-Account` FOREIGN KEY (`idUser`) REFERENCES `TRAN_USERS` (`idUser`) ON DELETE SET NULL;

--
-- Contraintes pour la table `TRAN_TRANSACTIONS`
--
ALTER TABLE `TRAN_TRANSACTIONS`
  ADD CONSTRAINT `fk_Transac_CustomerAccount` FOREIGN KEY (`siren`) REFERENCES `TRAN_CUSTOMER_ACCOUNT` (`siren`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Transac_Remittance` FOREIGN KEY (`remittanceNumber`) REFERENCES `TRAN_REMITTANCES` (`remittanceNumber`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `TRAN_UNPAIDS`
--
ALTER TABLE `TRAN_UNPAIDS`
  ADD CONSTRAINT `fkk_unpaids_transac` FOREIGN KEY (`idTransac`) REFERENCES `TRAN_TRANSACTIONS` (`idTransac`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkk_unpaids_unpaidReasons` FOREIGN KEY (`idUnpaidReason`) REFERENCES `TRAN_UNPAID_REASONS` (`idUnpaidReason`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
