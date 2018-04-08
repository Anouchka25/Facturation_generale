-- phpMyAdmin SQL Dump
-- version 4.1.14.8
-- http://www.phpmyadmin.net
--
-- Client :  db729402836.db.1and1.com
-- Généré le :  Dim 08 Avril 2018 à 16:55
-- Version du serveur :  5.5.59-0+deb7u1-log
-- Version de PHP :  5.4.45-0+deb7u13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `db729402836`
--

-- --------------------------------------------------------

--
-- Structure de la table `facturation`
--

CREATE TABLE IF NOT EXISTS `facturation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` text,
  `quantite` int(11) DEFAULT NULL,
  `prixht` decimal(10,0) DEFAULT NULL,
  `taxe` decimal(10,0) NOT NULL,
  `fk_facturation_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_facturation_id` (`fk_facturation_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=274 ;

--
-- Contenu de la table `facturation`
--

INSERT INTO `facturation` (`id`, `designation`, `quantite`, `prixht`, `taxe`, `fk_facturation_id`) VALUES
(1, 'designation 1', 3, '200', '20', 1),
(2, 'designation 2', 5, '300', '19', 1),
(4, 'Animation de la formation de « JasperReport niveau 1 & 2 » chez FICHORGA,\r\nPour le compte de l’entreprise ANASYS,\r\nAux dates de 27 et 28 mars 2018 toute la journée (7h)', 2, '550', '20', 5),
(3, 'Animation de la formation de « JasperReport niveau 1 & 2 » chez FICHORGA,\r\nPour le compte de l’entreprise ANASYS,\r\nA la date du 29 mars 2018 une demi-journée (4h)', 1, '314', '20', 5),
(5, 'designation 2', 10, '500', '19', 2),
(6, 'designation 1', 4, '300', '20', 2);

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `img_id` int(11) NOT NULL AUTO_INCREMENT,
  `img_nom` varchar(50) NOT NULL,
  `img_taille` varchar(25) NOT NULL,
  `img_type` varchar(25) NOT NULL,
  `img_desc` varchar(100) NOT NULL,
  `img_blob` blob NOT NULL,
  PRIMARY KEY (`img_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `infosfacture`
--

CREATE TABLE IF NOT EXISTS `infosfacture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num` varchar(10) DEFAULT NULL,
  `numtva` varchar(20) NOT NULL,
  `client` text,
  `datefacture` varchar(10) DEFAULT NULL,
  `facturede` text,
  `conditions` text,
  `id_membre` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `num` (`num`),
  KEY `id_membre` (`id_membre`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Contenu de la table `infosfacture`
--

INSERT INTO `infosfacture` (`id`, `num`, `numtva`, `client`, `datefacture`, `facturede`, `conditions`, `id_membre`) VALUES
(1, 'num 1', '', 'client 1', '27/03/2018', 'facture de 1', 'conditions 1', 3),
(2, 'num 2', '', 'client 2', '20/03/2018', 'facture de 2', 'conditions 2', 3),
(6, 'MOA1005036', '', 'B And B Performance\r\n57 Boulevard de Verdun\r\n94120 Fontenay Sous-bois\r\nReprésenté par M Benichou Raphy', '15/04/2018', 'Micro-Entreprise Anouchka MINKOUE OBAME\r\nRue Rétimare, Imm. Adolph. Adam, N°42, 76190 Yvetot, France\r\nImmatriculation au RCS : 794 069 997 00029 R.C.S Rouen\r\nCode APE : 6311Z', 'A verser au compte de :\r\nMlle MINKOUE OBAME Anouchka\r\nRIB : 30004 01495 00000754427 56\r\nBanque : BNP PARIBAS\r\nIBAN : FR76 3000 4014 9500 0007 5442 756\r\nBIC : BNPAFRPPROU', 3),
(5, 'TOUT100503', 'FR39831670831', '    ANASYS - SASU au capital de 10 000 Euros\r\nSiège social : 154 PROM. DU VERGER – 92130 ISSY-LES-MOULINEAUX\r\nRCS Nanterre 804 788 446\r\nReprésentée par : Hassan BOUMARSEL', '07/04/2018', 'SARL TOUTPAIE,\r\nRUE RÉTIMARE LOGT 042, IMM. ADOLPHE ADAM\r\n76190 YVETOT, Inscrite au registre du commerce et des sociétés de Rouen sous le n° 831 670 831 00013 Représentée par Anouchka MINKOUE OBAME agissant en qualité de gérante', 'A verser au compte de TOUTPAIE\r\nRIB : 30004 00125 00010111146 36\r\nBanque : BNP PARIBAS\r\nIBAN : FR7630004001250001011114636\r\nBIC : BNPAFRPPXXX', 3),
(3, 'num 3', '', 'client 3', '27/03/2018', 'facture de 3', 'conditions 3', 3),
(4, 'num 4', '', 'client 4', '27/03/2018', 'facture de 4', 'conditions 4', 3);

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE IF NOT EXISTS `membres` (
  `id_membre` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(255) DEFAULT NULL,
  `pseudo` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id_membre`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `membres`
--

INSERT INTO `membres` (`id_membre`, `Email`, `pseudo`, `password`) VALUES
(1, 'contact@allkers.com', 'riri', '$2y$10$P0.TMTEnaCRWNqI7yKFfaOP5fXOe3K0/nUzkcYuLqhZhe5ei5rB0i'),
(2, 'contact@allkers.com', 'toto', '$2y$10$5kisL7bkkni2daEY5Lh.ju6AGOFaDloCyFXsAiHK4U27bRgjugtnS'),
(3, 'minkoueobamea@yahoo.fr', 'tata', '$2y$10$jwN3PkFhOcKKPi0KfTrLCOOjZgStyXNAXzMjnmDTLy67kAWuI8RhG');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
