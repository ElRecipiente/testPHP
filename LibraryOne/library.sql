-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 06 mars 2023 à 09:53
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
-- Base de données : `library`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `FullName` varchar(100) DEFAULT NULL,
  `AdminEmail` varchar(120) DEFAULT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `FullName`, `AdminEmail`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'Administrateur', 'admin@gmail.com', 'admin', 'f925916e2754e5e03f75dd58a5733251', '2021-07-20 16:25:47');

-- --------------------------------------------------------

--
-- Structure de la table `tblauthors`
--

DROP TABLE IF EXISTS `tblauthors`;
CREATE TABLE IF NOT EXISTS `tblauthors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `AuthorName` varchar(159) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tblauthors`
--

INSERT INTO `tblauthors` (`id`, `AuthorName`, `creationDate`, `UpdationDate`) VALUES
(1, 'Guillaume Musso', '2017-07-08 12:49:09', '2021-07-23 08:41:21'),
(2, 'Michel Bussi', '2017-07-08 14:30:23', '2021-07-23 08:43:21'),
(3, 'Marc Levy', '2017-07-08 14:35:08', '2021-07-23 08:43:40'),
(4, 'Françoise Bourdin', '2017-07-08 14:35:21', '2021-07-23 08:44:00'),
(5, 'Gilles Legardinier', '2017-07-08 14:35:36', '2021-07-23 08:44:25'),
(9, 'Agnès Martin', '2017-07-08 15:22:03', '2021-07-23 08:44:50'),
(10, 'Annie Ernaux', '2021-06-23 12:39:10', '2021-07-23 08:46:20'),
(11, 'Alice Coffin', '2023-03-06 09:49:08', NULL),
(12, 'Simone de Beauvoir', '2023-03-06 09:49:08', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tblbooks`
--

DROP TABLE IF EXISTS `tblbooks`;
CREATE TABLE IF NOT EXISTS `tblbooks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `BookName` varchar(255) DEFAULT NULL,
  `CatId` int(11) DEFAULT NULL,
  `AuthorId` int(11) DEFAULT NULL,
  `ISBNNumber` int(11) DEFAULT NULL,
  `BookPrice` int(11) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tblbooks`
--

INSERT INTO `tblbooks` (`id`, `BookName`, `CatId`, `AuthorId`, `ISBNNumber`, `BookPrice`, `RegDate`, `UpdationDate`) VALUES
(1, 'La jeune fille et la nuit', 4, 1, 222333, 21, '2017-07-08 20:04:55', '2021-08-06 15:37:08'),
(3, 'Quelqu un de bien', 4, 4, 111123, 6, '2017-07-08 20:17:31', '2021-07-26 09:12:22'),
(4, 'Le Génie Lesbien', 9, 11, 123456789, 20, '2023-03-06 09:50:42', '2023-03-06 09:50:42'),
(5, 'Le Deuxième Sexe', 9, 12, 123456788, 20, '2023-03-06 09:50:42', '2023-03-06 09:50:42');

-- --------------------------------------------------------

--
-- Structure de la table `tblcategory`
--

DROP TABLE IF EXISTS `tblcategory`;
CREATE TABLE IF NOT EXISTS `tblcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `CategoryName` varchar(150) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `CategoryName`, `Status`, `CreationDate`, `UpdationDate`) VALUES
(4, 'Romantique', 1, '2017-07-04 18:35:25', '2021-07-15 09:37:02'),
(5, 'Technologie', 0, '2017-07-04 18:35:39', '2021-08-06 15:31:23'),
(6, 'Science', 1, '2017-07-04 18:35:55', '2021-08-06 15:31:10'),
(7, 'Management', 1, '2017-07-04 18:36:16', '2021-06-23 12:45:41'),
(8, 'Thriller', 1, '2021-07-26 09:08:35', '0000-00-00 00:00:00'),
(9, 'Société', NULL, '2023-03-06 09:50:13', '2023-03-06 09:50:13');

-- --------------------------------------------------------

--
-- Structure de la table `tblissuedbookdetails`
--

DROP TABLE IF EXISTS `tblissuedbookdetails`;
CREATE TABLE IF NOT EXISTS `tblissuedbookdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `BookId` int(11) DEFAULT NULL,
  `ReaderID` varchar(150) DEFAULT NULL,
  `IssuesDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ReturnDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `ReturnStatus` int(11) DEFAULT NULL,
  `fine` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tblissuedbookdetails`
--

INSERT INTO `tblissuedbookdetails` (`id`, `BookId`, `ReaderID`, `IssuesDate`, `ReturnDate`, `ReturnStatus`, `fine`) VALUES
(1, 1, 'SID002', '2017-07-15 06:09:47', '2017-07-15 11:15:20', 1, 0),
(2, 1, 'SID002', '2017-07-15 06:12:27', '2017-07-15 11:15:23', 1, 5),
(3, 3, 'SID002', '2017-07-15 06:13:40', NULL, 0, NULL),
(4, 3, 'SID002', '2017-07-15 06:23:23', '2017-07-15 11:22:29', 1, 2),
(5, 1, 'SID009', '2017-07-15 10:59:26', NULL, 0, NULL),
(6, 3, 'SID011', '2017-07-15 18:02:55', NULL, 0, NULL),
(7, 1, 'SID011', '2021-07-16 13:59:23', NULL, 0, NULL),
(8, 1, 'SID010', '2021-07-20 08:41:34', NULL, 0, NULL),
(9, 3, 'SID012', '2021-07-20 08:44:53', NULL, 0, NULL),
(10, 1, 'SID012', '2021-07-20 08:47:07', NULL, 0, NULL),
(11, 222333, 'SID009', '2021-07-20 08:51:15', NULL, 0, NULL),
(12, 222333, 'SID009', '2021-07-20 09:53:27', NULL, 0, NULL),
(13, 222333, 'SID014', '2021-07-21 14:49:46', '2021-07-21 22:00:00', 1, NULL),
(14, 222333, 'SID017', '2021-07-29 14:14:15', '2021-08-04 22:00:00', 1, NULL),
(15, 222333, 'SID022', '2021-07-30 07:40:06', NULL, 0, NULL),
(16, 222333, 'SID001', '2021-08-06 15:20:20', NULL, 0, NULL),
(17, 222333, 'SID021', '2021-08-06 15:22:22', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tblreaders`
--

DROP TABLE IF EXISTS `tblreaders`;
CREATE TABLE IF NOT EXISTS `tblreaders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ReaderId` varchar(100) DEFAULT NULL,
  `FullName` varchar(120) DEFAULT NULL,
  `EmailId` varchar(120) DEFAULT NULL,
  `MobileNumber` char(11) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdateDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tblreaders`
--

INSERT INTO `tblreaders` (`id`, `ReaderId`, `FullName`, `EmailId`, `MobileNumber`, `Password`, `Status`, `RegDate`, `UpdateDate`) VALUES
(1, 'SID017', 'Eric Perkins', 'eperkins0@cnbc.com', '06060606', '29988429c481f219b8c5ba8c071440e1', 2, '2021-07-23 12:38:53', '2021-07-26 09:01:39'),
(2, 'SID018', 'Daniel Flores', 'dflores1@so-net.ne.jp', '07070707', 'aa47f8215c6f30a0dcdb2a36a9f4168e', 0, '2021-07-23 12:40:07', '2021-07-26 09:01:55'),
(3, 'SID019', 'Gregory Hayes', 'ghayes2@w3.org', '006080808', 'e73d1f05badaf94997bb3e886144f5f9', 1, '2021-07-23 12:41:18', NULL),
(4, 'SID020', 'Michelle Dunn', 'mdunnc@twitter.com', '06123456', '2345f10bb948c5665ef91f6773b3e455', 1, '2021-07-23 12:42:20', NULL),
(5, 'SID021', 'Test Hello', 'test@gmail.com', '06060606', 'f925916e2754e5e03f75dd58a5733251', 1, '2021-07-28 14:12:04', '2023-02-22 13:19:23'),
(6, 'SID999', 'camille', 'camille@fite.fr', '0699887766', '5f4dcc3b5aa765d61d8327deb882cf99', 1, '2023-02-20 14:41:54', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
