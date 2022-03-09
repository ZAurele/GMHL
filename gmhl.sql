-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 09 mars 2022 à 11:30
-- Version du serveur : 10.4.19-MariaDB-1:10.4.19+maria~bionic
-- Version de PHP : 7.2.24-0ubuntu0.18.04.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gmhl`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categorie` varchar(30) NOT NULL,
  `messages` text NOT NULL,
  `icon` varchar(30) NOT NULL DEFAULT 'question'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `categorie`, `messages`, `icon`) VALUES
(13, 'SiteWeb', '58a71a9b483af,58a71a9b4872d,58a80d4473100,58b0b3a4d4523,58b0b467386ed,58b4802196546,58b4802196546,58b7cfc37591c,58b7cfc37591c,58b7cfc37591c,58b7cfc37591c,58b85a22c8ce0,58b85a22c8ce0,58b7cfc37591c,58b7cfc37591c,58b85a22c8ce0,58b85b5181981,58b7cfc37591c,58b85a22c8ce0,592c652348647,59580f224989b,5958156e9cd1a,595815c44abc3,59581600510f9,5958162f553af,59589f1ee1eaf,5958a39886406,5958a3dab16ba,5958a79961385,5958a81dac05d,5958a966357b5,5958ac22de268,595a47937e170,595a4833dfdec,595a493194cd3,595a4ac1b5117,595a527094687,595a6c13b311e,595bbeb4c13c7,595bc02c61f72,595ca4a8da51a,595ca659d45aa,595ca7a0bf5f6,595d0813be12a,595d0fe2ce4b5,595d0fe2ce4b5', 'globe'),
(15, 'Quartier', '58af4b430d883,58af4b430daf7,58b0aa35714ae,58b0abbadb108,58b0abff026fb,58b0b4cbc2a3c,58b14aa1e3b4e,58b14c0c36110,58b2f075691a8,58b2f0e6c8526,58b2f10c65711,58b2f1af79aa6,58b303290e8f5,58b4677d4076e,58b4802196546,58b4802196546,5a22e8c29effb,5a318e5e21ac8,5affe72f1197e,5ccf377fde3c8', 'group'),
(17, 'Aide', 'Aide,58b0ae2176340,58b0b4aabc6ba,58b14a538a92c,58b14c6be36e9,58b17f4e643e1,58b2f1c5e371c,58b2f2161a467,58b2f2319f25c,58b2f30d80a16,58b2f39f7c850,58b2f3baba739,58b2f4212cc63,58b2f460dd6ca,58b2f479b5996,58b2f4a8c3f1f,58b2f4cdf40c2,58b2f4e61a468,58b2f514a1539,58b2f546c45e4,58b2f58601f01,58b2f5a32504b,58b2f6010b9fe,58b2f624c1df5,58b2f66b898af,58b2f6f877e13,58b2f74d8ab88,58b2f76065889,58b2f7a41c6b4,58b2f7dce7743,58b2f8065d940,58b2f80e323a7,58b2f82b4d941,58b2fb974c152,58b2fbb579fa0,58b2fbdc404ea,58b2fc2d1a36b,58b2fc5979dfc,58b2fc6e4271f,58b2fc930e8ed,58b2fcc6e2778,58b2fd54b6ac7,58b2fdcd5f26e,58b2fdfbe27b1,58b2fe498e7df,58b2fe6682c2d,58b2ff5935b15,58b30048688ce,58b300559f2d6,58b3006db93bb,58b300ab6b5f7,58b301927d006,58b3020c7ce7e,58b3023929eac,58b30253540ce,58b3026ec86ab,58b4802196546,58b4802196546,58b4802196546,58b4802196546,58b4802196546,58b4802196546,58b4802196546,58b4802196546,58b85096bc985,58b85096bc985,5958a2ad30672', 'handshake-o'),
(18, 'BÃ¢timent', '58b4933672f55,58b493367488d,58b49424d0e03,58b49738091fe,58b4976a24350,58b4977469be0,58b59e1a817f9,58b5b37989ba4,58b858f55ab9c,58b858f55ab9c,58b858f55ab9c,58bd12dd576a9,58bd644ab91eb,58c7c544a1e00,58e271c57cd8e,58e271c57cd8e,58fb68cec927a,59156c3b8fca8,58f72647c2k04,5957a24468993,59ad3e6b57e79,59d5c3b01fd03,5a22d9807673a,5a22d9807673a,5a22d9807673a,5a466e0f3f3b6,5a69780b22d64,5a6b877a5fd94,5a7f732919cb3,5add9fdfc177d,5b1d5237d1e56,5b1ec57e055f9,5b3d09e6e8456,5b4facb8a7dbe,5b9827d48011f,5c586cf60b415,5c7f9f94d24e2,5cc1e317ad7d8,5d45736f459d3', 'building'),
(19, 'Aucune', '58b5d4ea3c4b1,58b5d55bdf8af,58b5d5cadd4a0,58b5d688814bb,58b5d7261822b,58b84ff12bc36,58bd2e9a90efb,58cad06708b9d,58d3dd9dd4cc1,58dbecc2ce982,58de86738750d,58e273a219268,58e273ca48992,58e7d6cfb1c4d,58ef9f048a064,59555cd47cffd,59555f63a9384,5958164333dde,595816f918da6,59581eae85b9c,595c0284cc65f,595ca7fbe2703,595ca96d1eb52,595ca9bc46d5a,595caa50a4c6f,595cab7616a81,595cabad1c0b2,5c41940a4251f', 'window-minimize'),
(21, 'Informations', '58c0189096e27,58c0189099f32,58c18f5022f18,58d503a1a27db,58da22ae71fba,58da22d1502b8,58e3d24884a22,58e68b307c4e4,59555ff47c663,5955606e68dfb,5a27d64678d0b,5b2ded89eb79c,5c1638d16fee4,5c18ac8ec1f0c,5c4ed288b8ef0,5d1b7415b4189,5d1b7415b4189,5d1b7415b4189', 'info'),
(22, 'Syndic', '58ce5293408ea,58ce529345e32,58ee54b0596d0,58f726c7c2b04,5908a50be4ae0,591c88a1333d6,5942e3e57773a,594ffccad0077,5955615202118,5956a705dc000,5956b3b769121,5956b5c150f90,5956b6b560742,5956b70315295,5957a186a2075,5957a70989783,595fc135421f8,595fc58788738,5962250fb273a,59627b471b58d,5980b0143bdc7,59de786aec8d0,5a218bcfdea17,5ad0546e9e18d,5ad37ff5572e7,5add92f3738f9,5add9365adbcc,5aec1cb59fe96,5bf17a2c71215,622350218ca18', 'handshake-o'),
(24, 'SYNDIC', '5b082bceb9933,5b082bcec6c7f,5b1005c91e6f8,5b28ef898bd48,5b4fb0d25f208,5c0f9a3eefee2,5c1b595200583,5c23c8109c060,5c23c815d7c29,5d20eeacab5d9', 'question');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `unique_id` varchar(15) NOT NULL,
  `message` varchar(20) NOT NULL,
  `sender` varchar(20) NOT NULL,
  `comment` text NOT NULL,
  `creation_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modification_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cro_config`
--

CREATE TABLE `cro_config` (
  `id` tinyint(10) NOT NULL,
  `name` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `activated` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `cro_config`
--

INSERT INTO `cro_config` (`id`, `name`, `activated`) VALUES
(1, 'mail', 1),
(3, 'profilsUp', 1),
(4, 'reset', 0),
(5, 'pause', 0),
(6, 'test', 1);

-- --------------------------------------------------------

--
-- Structure de la table `habitation`
--

CREATE TABLE `habitation` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `chauffage` tinyint(4) NOT NULL,
  `eau` tinyint(4) NOT NULL,
  `elec` tinyint(4) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `ascenseur` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `habitation`
--

INSERT INTO `habitation` (`id`, `user_id`, `chauffage`, `eau`, `elec`, `date`, `ascenseur`) VALUES
(28, 155, 0, 0, 0, '2017-03-16 07:11:50', 4),
(27, 161, 0, 0, 0, '2017-03-10 10:41:06', 0),
(26, 161, 0, 0, 0, '2017-03-10 10:40:52', 0),
(25, 156, 0, 0, 0, '2017-03-06 12:13:13', 0),
(24, 111, 0, 0, 0, '2017-03-06 11:46:16', 0),
(23, 151, 0, 0, 0, '2017-03-06 11:06:46', 0),
(22, 156, 0, 4, 0, '2017-03-06 08:40:04', 0),
(21, 111, 0, 4, 0, '2017-03-06 08:27:02', 0),
(20, 111, 0, 0, 0, '2017-03-06 08:26:33', 0),
(19, 155, 0, 4, 0, '2017-03-06 07:49:53', 0),
(29, 125, 0, 0, 0, '2017-04-02 16:31:00', 0),
(30, 155, 0, 0, 0, '2017-04-03 16:13:45', 0),
(31, 111, 0, 0, 0, '2017-04-22 14:23:25', 4),
(32, 111, 0, 0, 0, '2017-04-22 21:44:54', 0),
(33, 155, 0, 0, 0, '2017-04-25 19:30:52', 4),
(34, 155, 0, 0, 0, '2017-04-26 07:23:04', 4),
(35, 155, 0, 0, 0, '2017-05-01 07:59:46', 0),
(36, 168, 0, 0, 0, '2017-07-05 09:08:32', 0),
(37, 111, 2, 0, 0, '2017-12-02 17:56:25', 0),
(38, 155, 4, 0, 0, '2017-12-03 10:58:54', 0),
(39, 160, 4, 0, 0, '2017-12-04 13:00:49', 0),
(40, 111, 0, 0, 0, '2017-12-04 19:45:05', 0),
(41, 111, 4, 0, 0, '2017-12-04 19:45:28', 0),
(42, 151, 4, 0, 0, '2017-12-05 20:01:39', 0),
(43, 111, 4, 0, 0, '2017-12-08 20:22:49', 0),
(44, 111, 2, 0, 0, '2017-12-08 21:05:15', 0),
(45, 111, 0, 0, 0, '2017-12-26 18:09:48', 0),
(46, 155, 0, 0, 0, '2018-01-22 19:56:31', 0),
(47, 151, 4, 0, 0, '2018-02-09 21:17:52', 0),
(48, 111, 2, 0, 0, '2018-02-10 22:27:31', 0),
(49, 111, 0, 0, 0, '2018-02-16 19:45:43', 0),
(50, 111, 4, 0, 0, '2018-02-27 06:24:25', 0),
(51, 111, 2, 0, 0, '2018-03-06 21:46:13', 0),
(52, 111, 0, 0, 0, '2018-03-09 20:25:48', 0),
(53, 111, 0, 0, 0, '2019-03-06 10:24:17', 0),
(54, 111, 0, 0, 0, '2019-03-06 10:24:29', 4),
(55, 111, 0, 0, 0, '2019-03-08 17:53:52', 0);

-- --------------------------------------------------------

--
-- Structure de la table `notifications_mails`
--

CREATE TABLE `notifications_mails` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `notifications_mails`
--

INSERT INTO `notifications_mails` (`id`, `name`) VALUES
(1, 'Ne jamais me notifier par mail'),
(2, 'Me notifier une fois par mois'),
(3, 'Me notifier une fois par semaine'),
(4, 'Me notifier une fois par jour');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `unique_id` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `creation_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `creation_date` varchar(10) NOT NULL,
  `modification_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `message` text NOT NULL,
  `title` text NOT NULL,
  `attached_files` text DEFAULT NULL,
  `type` text NOT NULL,
  `categorie` int(11) NOT NULL,
  `dateEvenement` varchar(10) DEFAULT NULL,
  `priority` varchar(30) NOT NULL,
  `up_vote` text NOT NULL,
  `private` int(11) NOT NULL,
  `comments` text NOT NULL,
  `images` text NOT NULL,
  `pdfs` text NOT NULL,
  `vue` tinyint(1) NOT NULL,
  `favori` text NOT NULL,
  `proposition` text NOT NULL,
  `travaux` tinyint(4) NOT NULL,
  `vues` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `profils`
--

CREATE TABLE `profils` (
  `user_id` int(11) NOT NULL,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `email` text NOT NULL,
  `email_enable` varchar(5) NOT NULL,
  `country` varchar(3) NOT NULL,
  `frequence_notifications` tinyint(4) NOT NULL,
  `profil_view` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `timeMail` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `messageMail` varchar(2) DEFAULT NULL,
  `notificationMail` varchar(2) DEFAULT NULL,
  `privateMail` varchar(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `profils`
--

INSERT INTO `profils` (`user_id`, `nom`, `prenom`, `email`, `email_enable`, `country`, `frequence_notifications`, `profil_view`, `description`, `timeMail`, `messageMail`, `notificationMail`, `privateMail`) VALUES
(4, 'Durand', '', '', '', 'fr', 1, 'nom-prenom', '', '2022-03-08 11:28:34', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `proposition`
--

CREATE TABLE `proposition` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` int(11) NOT NULL,
  `proposition` tinyint(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `proposition`
--

INSERT INTO `proposition` (`id`, `user_id`, `message`, `proposition`) VALUES
(4, 155, 197, 1),
(3, 138, 109, 1);

-- --------------------------------------------------------

--
-- Structure de la table `questionnaires`
--

CREATE TABLE `questionnaires` (
  `category` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `id` varchar(10) NOT NULL,
  `answer` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `questionnaires`
--

INSERT INTO `questionnaires` (`category`, `type`, `id`, `answer`, `user_id`) VALUES
('evaluation_generale', 'Contexte_Economique_General', 'ecoG1', 3, 1),
('evaluation_generale', 'Contexte_Economique_General', 'ecoG1', 1, 2),
('evaluation_generale', 'Contexte_Economique_General', 'ecoG1', 2, 3),
('evaluation_generale', 'Contexte_Economique_General', 'ecoG1', 1, 4),
('evaluation_generale', 'Contexte_Economique_General', 'ecoG2', 4, 1),
('evaluation_generale', 'Contexte_Economique_General', 'ecoG2', 5, 2),
('evaluation_generale', 'Contexte_Economique_General', 'ecoG2', 5, 3),
('evaluation_generale', 'Contexte_Economique_General', 'ecoG2', 5, 4),
('evaluation_generale', 'Contexte_Economique_General', 'ecoG3', 1, 1),
('evaluation_generale', 'Contexte_Economique_General', 'ecoG3', 1, 2),
('evaluation_generale', 'Contexte_Economique_General', 'ecoG3', 1, 3),
('evaluation_generale', 'Contexte_Economique_General', 'ecoG3', 2, 4),
('evaluation_generale', 'Contexte_Economique_General', 'ecoG4', 1, 1),
('evaluation_generale', 'Contexte_Economique_General', 'ecoG4', 1, 2),
('evaluation_generale', 'Contexte_Economique_General', 'ecoG4', 1, 3),
('evaluation_generale', 'Contexte_Economique_General', 'ecoG4', 2, 4),
('evaluation_generale', 'Contexte_Economique_General', 'ecoG5', 1, 1),
('evaluation_generale', 'Contexte_Economique_General', 'ecoG5', 2, 2),
('evaluation_generale', 'Contexte_Economique_General', 'ecoG5', 3, 3),
('evaluation_generale', 'Contexte_Economique_General', 'ecoG5', 3, 4),
('evaluation_generale', 'Contexte_Economique_General', 'ecoG6', 1, 1),
('evaluation_generale', 'Contexte_Economique_General', 'ecoG6', 2, 2),
('evaluation_generale', 'Contexte_Economique_General', 'ecoG6', 1, 3),
('evaluation_generale', 'Contexte_Economique_General', 'ecoG6', 2, 4),
('evaluation_generale', 'Contexte_Economique_General', 'ecoG7', 1, 1),
('evaluation_generale', 'Contexte_Economique_General', 'ecoG7', 3, 2),
('evaluation_generale', 'Contexte_Economique_General', 'ecoG7', 2, 3),
('evaluation_generale', 'Contexte_Economique_General', 'ecoG7', 3, 4),
('evaluation_generale', 'Contexte_Economique_General', 'ecoG8', 5, 1),
('evaluation_generale', 'Contexte_Economique_General', 'ecoG8', 4, 2),
('evaluation_generale', 'Contexte_Economique_General', 'ecoG8', 1, 3),
('evaluation_generale', 'Contexte_Economique_General', 'ecoG8', 3, 4),
('evaluation_generale', 'Contexte_Economique_General', 'ecoG9', 4, 1),
('evaluation_generale', 'Contexte_Economique_General', 'ecoG9', 4, 2),
('evaluation_generale', 'Contexte_Economique_General', 'ecoG9', 4, 3),
('evaluation_generale', 'Contexte_Economique_General', 'ecoG9', 3, 4),
('evaluation_generale', 'Contexte_Social_General', 'soc1', 1, 1),
('evaluation_generale', 'Contexte_Social_General', 'soc1', 1, 2),
('evaluation_generale', 'Contexte_Social_General', 'soc1', 2, 3),
('evaluation_generale', 'Contexte_Social_General', 'soc1', 3, 4),
('evaluation_generale', 'Contexte_Social_General', 'soc2', 4, 1),
('evaluation_generale', 'Contexte_Social_General', 'soc2', 4, 2),
('evaluation_generale', 'Contexte_Social_General', 'soc2', 1, 3),
('evaluation_generale', 'Contexte_Social_General', 'soc2', 2, 4),
('evaluation_generale', 'Contexte_Social_General', 'soc3', 3, 1),
('evaluation_generale', 'Contexte_Social_General', 'soc3', 3, 2),
('evaluation_generale', 'Contexte_Social_General', 'soc3', 2, 3),
('evaluation_generale', 'Contexte_Social_General', 'soc3', 3, 4),
('evaluation_generale', 'Contexte_Social_General', 'soc4', 3, 1),
('evaluation_generale', 'Contexte_Social_General', 'soc4', 2, 2),
('evaluation_generale', 'Contexte_Social_General', 'soc4', 3, 3),
('evaluation_generale', 'Contexte_Social_General', 'soc4', 1, 4),
('evaluation_generale', 'Contexte_Social_General', 'soc5', 2, 1),
('evaluation_generale', 'Contexte_Social_General', 'soc5', 4, 2),
('evaluation_generale', 'Contexte_Social_General', 'soc5', 2, 3),
('evaluation_generale', 'Contexte_Social_General', 'soc5', 1, 4),
('evaluation_generale', 'Contexte_Social_General', 'soc6', 3, 1),
('evaluation_generale', 'Contexte_Social_General', 'soc6', 2, 2),
('evaluation_generale', 'Contexte_Social_General', 'soc6', 2, 3),
('evaluation_generale', 'Contexte_Social_General', 'soc6', 1, 4),
('evaluation_generale', 'Contexte_Social_General', 'soc7', 6, 1),
('evaluation_generale', 'Contexte_Social_General', 'soc7', 3, 2),
('evaluation_generale', 'Contexte_Social_General', 'soc7', 2, 3),
('evaluation_generale', 'Contexte_Social_General', 'soc7', 2, 4),
('evaluation_generale', 'Contexte_Social_General', 'soc8', 4, 1),
('evaluation_generale', 'Contexte_Social_General', 'soc8', 2, 2),
('evaluation_generale', 'Contexte_Social_General', 'soc8', 3, 3),
('evaluation_generale', 'Contexte_Social_General', 'soc8', 2, 4),
('evaluation_generale', 'Elevage_Animaux_General', 'ani1', 4, 1),
('evaluation_generale', 'Elevage_Animaux_General', 'ani1', 3, 2),
('evaluation_generale', 'Elevage_Animaux_General', 'ani1', 3, 3),
('evaluation_generale', 'Elevage_Animaux_General', 'ani1', 1, 4),
('evaluation_generale', 'Elevage_Animaux_General', 'ani2', 2, 1),
('evaluation_generale', 'Elevage_Animaux_General', 'ani2', 1, 2),
('evaluation_generale', 'Elevage_Animaux_General', 'ani2', 2, 3),
('evaluation_generale', 'Elevage_Animaux_General', 'ani2', 1, 4),
('evaluation_generale', 'Elevage_Animaux_General', 'ani3', 3, 1),
('evaluation_generale', 'Elevage_Animaux_General', 'ani3', 3, 2),
('evaluation_generale', 'Elevage_Animaux_General', 'ani3', 4, 3),
('evaluation_generale', 'Elevage_Animaux_General', 'ani3', 2, 4),
('evaluation_generale', 'Elevage_Animaux_General', 'ani4', 2, 1),
('evaluation_generale', 'Elevage_Animaux_General', 'ani4', 2, 2),
('evaluation_generale', 'Elevage_Animaux_General', 'ani4', 2, 3),
('evaluation_generale', 'Elevage_Animaux_General', 'ani4', 2, 4),
('evaluation_generale', 'Elevage_Animaux_General', 'ani5', 2, 1),
('evaluation_generale', 'Elevage_Animaux_General', 'ani5', 1, 2),
('evaluation_generale', 'Elevage_Animaux_General', 'ani5', 1, 3),
('evaluation_generale', 'Elevage_Animaux_General', 'ani5', 2, 4),
('evaluation_generale', 'Elevage_Animaux_General', 'ani6', 2, 1),
('evaluation_generale', 'Elevage_Animaux_General', 'ani6', 1, 2),
('evaluation_generale', 'Elevage_Animaux_General', 'ani6', 4, 3),
('evaluation_generale', 'Elevage_Animaux_General', 'ani6', 1, 4),
('evaluation_generale', 'Elevage_Animaux_General', 'ani7', 4, 1),
('evaluation_generale', 'Elevage_Animaux_General', 'ani7', 1, 2),
('evaluation_generale', 'Elevage_Animaux_General', 'ani7', 4, 3),
('evaluation_generale', 'Elevage_Animaux_General', 'ani7', 1, 4),
('evaluation_generale', 'Elevage_Animaux_General', 'ani8', 1, 1),
('evaluation_generale', 'Elevage_Animaux_General', 'ani8', 2, 2),
('evaluation_generale', 'Elevage_Animaux_General', 'ani8', 2, 3),
('evaluation_generale', 'Elevage_Animaux_General', 'ani8', 5, 4),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto1', 2, 1),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto1', 2, 2),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto1', 3, 3),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto1', 1, 4),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto10', 1, 1),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto10', 2, 2),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto10', 2, 3),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto10', 1, 4),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto11', 1, 1),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto11', 2, 2),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto11', 1, 3),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto11', 2, 4),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto12', 2, 1),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto12', 2, 2),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto12', 1, 3),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto12', 2, 4),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto13', 1, 1),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto13', 2, 2),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto13', 2, 3),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto13', 2, 4),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto14', 1, 1),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto14', 1, 2),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto14', 2, 3),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto14', 3, 4),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto15', 1, 1),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto15', 2, 2),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto15', 1, 3),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto15', 2, 4),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto2', 1, 1),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto2', 1, 2),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto2', 1, 3),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto2', 1, 4),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto3', 2, 1),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto3', 2, 2),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto3', 1, 3),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto3', 2, 4),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto4', 1, 1),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto4', 5, 2),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto4', 3, 3),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto4', 4, 4),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto5', 4, 1),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto5', 2, 2),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto5', 4, 3),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto5', 2, 4),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto6', 2, 1),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto6', 3, 2),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto6', 3, 3),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto6', 1, 4),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto7', 1, 1),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto7', 4, 2),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto7', 3, 3),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto7', 5, 4),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto8', 3, 1),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto8', 1, 2),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto8', 2, 3),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto8', 4, 4),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto9', 1, 1),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto9', 2, 2),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto9', 2, 3),
('evaluation_generale', 'Elevage_Pasto_General', 'pasto9', 2, 4),
('evaluation_generale', 'Environnement_Biologie_General', 'bio1', 2, 1),
('evaluation_generale', 'Environnement_Biologie_General', 'bio1', 2, 2),
('evaluation_generale', 'Environnement_Biologie_General', 'bio1', 1, 3),
('evaluation_generale', 'Environnement_Biologie_General', 'bio1', 5, 4),
('evaluation_generale', 'Environnement_Biologie_General', 'bio2', 4, 1),
('evaluation_generale', 'Environnement_Biologie_General', 'bio2', 1, 2),
('evaluation_generale', 'Environnement_Biologie_General', 'bio2', 3, 3),
('evaluation_generale', 'Environnement_Biologie_General', 'bio2', 2, 4),
('evaluation_generale', 'Environnement_Biologie_General', 'bio3', 3, 1),
('evaluation_generale', 'Environnement_Biologie_General', 'bio3', 4, 2),
('evaluation_generale', 'Environnement_Biologie_General', 'bio3', 2, 3),
('evaluation_generale', 'Environnement_Biologie_General', 'bio3', 2, 4),
('evaluation_generale', 'Environnement_Biologie_General', 'bio4', 2, 1),
('evaluation_generale', 'Environnement_Biologie_General', 'bio4', 2, 2),
('evaluation_generale', 'Environnement_Biologie_General', 'bio4', 1, 3),
('evaluation_generale', 'Environnement_Biologie_General', 'bio4', 2, 4),
('evaluation_generale', 'Environnement_Biologie_General', 'bio5', 5, 1),
('evaluation_generale', 'Environnement_Biologie_General', 'bio5', 4, 2),
('evaluation_generale', 'Environnement_Biologie_General', 'bio5', 5, 3),
('evaluation_generale', 'Environnement_Biologie_General', 'bio5', 4, 4),
('evaluation_generale', 'Environnement_Biologie_General', 'bio6', 2, 1),
('evaluation_generale', 'Environnement_Biologie_General', 'bio6', 2, 2),
('evaluation_generale', 'Environnement_Biologie_General', 'bio6', 4, 3),
('evaluation_generale', 'Environnement_Biologie_General', 'bio6', 3, 4),
('evaluation_generale', 'Environnement_Biologie_General', 'bio7', 2, 1),
('evaluation_generale', 'Environnement_Biologie_General', 'bio7', 1, 2),
('evaluation_generale', 'Environnement_Biologie_General', 'bio7', 3, 3),
('evaluation_generale', 'Environnement_Biologie_General', 'bio7', 2, 4),
('evaluation_generale', 'Environnement_Milieu_General', 'mil1', 1, 1),
('evaluation_generale', 'Environnement_Milieu_General', 'mil1', 2, 2),
('evaluation_generale', 'Environnement_Milieu_General', 'mil1', 2, 3),
('evaluation_generale', 'Environnement_Milieu_General', 'mil1', 1, 4),
('evaluation_generale', 'Environnement_Milieu_General', 'mil2', 4, 1),
('evaluation_generale', 'Environnement_Milieu_General', 'mil2', 1, 2),
('evaluation_generale', 'Environnement_Milieu_General', 'mil2', 4, 3),
('evaluation_generale', 'Environnement_Milieu_General', 'mil2', 4, 4),
('evaluation_generale', 'Protection_Structurelle_General', 'stru1', 4, 1),
('evaluation_generale', 'Protection_Structurelle_General', 'stru1', 5, 2),
('evaluation_generale', 'Protection_Structurelle_General', 'stru1', 3, 3),
('evaluation_generale', 'Protection_Structurelle_General', 'stru1', 3, 4),
('evaluation_generale', 'Protection_Structurelle_General', 'stru2', 3, 1),
('evaluation_generale', 'Protection_Structurelle_General', 'stru2', 2, 2),
('evaluation_generale', 'Protection_Structurelle_General', 'stru2', 2, 3),
('evaluation_generale', 'Protection_Structurelle_General', 'stru2', 1, 4),
('evaluation_generale', 'Protection_Structurelle_General', 'stru3', 1, 1),
('evaluation_generale', 'Protection_Structurelle_General', 'stru3', 2, 2),
('evaluation_generale', 'Protection_Structurelle_General', 'stru3', 2, 3),
('evaluation_generale', 'Protection_Structurelle_General', 'stru3', 1, 4),
('evaluation_generale', 'Protection_Structurelle_General', 'stru4', 2, 1),
('evaluation_generale', 'Protection_Structurelle_General', 'stru4', 3, 2),
('evaluation_generale', 'Protection_Structurelle_General', 'stru4', 3, 3),
('evaluation_generale', 'Protection_Structurelle_General', 'stru4', 3, 4),
('evaluation_generale', 'Protection_Structurelle_General', 'stru5', 2, 1),
('evaluation_generale', 'Protection_Structurelle_General', 'stru5', 2, 2),
('evaluation_generale', 'Protection_Structurelle_General', 'stru5', 2, 3),
('evaluation_generale', 'Protection_Structurelle_General', 'stru5', 1, 4),
('evaluation_generale', 'Protection_Structurelle_General', 'stru6', 1, 1),
('evaluation_generale', 'Protection_Structurelle_General', 'stru6', 1, 2),
('evaluation_generale', 'Protection_Structurelle_General', 'stru6', 2, 3),
('evaluation_generale', 'Protection_Structurelle_General', 'stru6', 3, 4),
('evaluation_generale', 'Protection_Vivante_General', 'viv1', 4, 1),
('evaluation_generale', 'Protection_Vivante_General', 'viv1', 3, 2),
('evaluation_generale', 'Protection_Vivante_General', 'viv1', 2, 3),
('evaluation_generale', 'Protection_Vivante_General', 'viv1', 3, 4),
('evaluation_generale', 'Protection_Vivante_General', 'viv10', 2, 1),
('evaluation_generale', 'Protection_Vivante_General', 'viv10', 2, 2),
('evaluation_generale', 'Protection_Vivante_General', 'viv10', 1, 3),
('evaluation_generale', 'Protection_Vivante_General', 'viv10', 1, 4),
('evaluation_generale', 'Protection_Vivante_General', 'viv11', 3, 1),
('evaluation_generale', 'Protection_Vivante_General', 'viv11', 1, 2),
('evaluation_generale', 'Protection_Vivante_General', 'viv11', 1, 3),
('evaluation_generale', 'Protection_Vivante_General', 'viv11', 3, 4),
('evaluation_generale', 'Protection_Vivante_General', 'viv12', 1, 1),
('evaluation_generale', 'Protection_Vivante_General', 'viv12', 3, 2),
('evaluation_generale', 'Protection_Vivante_General', 'viv12', 4, 3),
('evaluation_generale', 'Protection_Vivante_General', 'viv12', 4, 4),
('evaluation_generale', 'Protection_Vivante_General', 'viv13', 4, 1),
('evaluation_generale', 'Protection_Vivante_General', 'viv13', 3, 2),
('evaluation_generale', 'Protection_Vivante_General', 'viv13', 4, 3),
('evaluation_generale', 'Protection_Vivante_General', 'viv13', 4, 4),
('evaluation_generale', 'Protection_Vivante_General', 'viv14', 3, 1),
('evaluation_generale', 'Protection_Vivante_General', 'viv14', 3, 2),
('evaluation_generale', 'Protection_Vivante_General', 'viv14', 2, 3),
('evaluation_generale', 'Protection_Vivante_General', 'viv14', 4, 4),
('evaluation_generale', 'Protection_Vivante_General', 'viv15', 2, 1),
('evaluation_generale', 'Protection_Vivante_General', 'viv15', 2, 2),
('evaluation_generale', 'Protection_Vivante_General', 'viv15', 1, 3),
('evaluation_generale', 'Protection_Vivante_General', 'viv15', 2, 4),
('evaluation_generale', 'Protection_Vivante_General', 'viv16', 4, 1),
('evaluation_generale', 'Protection_Vivante_General', 'viv16', 3, 2),
('evaluation_generale', 'Protection_Vivante_General', 'viv16', 1, 3),
('evaluation_generale', 'Protection_Vivante_General', 'viv16', 2, 4),
('evaluation_generale', 'Protection_Vivante_General', 'viv17', 2, 1),
('evaluation_generale', 'Protection_Vivante_General', 'viv17', 1, 2),
('evaluation_generale', 'Protection_Vivante_General', 'viv17', 1, 3),
('evaluation_generale', 'Protection_Vivante_General', 'viv17', 1, 4),
('evaluation_generale', 'Protection_Vivante_General', 'viv18', 2, 1),
('evaluation_generale', 'Protection_Vivante_General', 'viv18', 2, 2),
('evaluation_generale', 'Protection_Vivante_General', 'viv18', 3, 3),
('evaluation_generale', 'Protection_Vivante_General', 'viv18', 4, 4),
('evaluation_generale', 'Protection_Vivante_General', 'viv19', 1, 1),
('evaluation_generale', 'Protection_Vivante_General', 'viv19', 2, 2),
('evaluation_generale', 'Protection_Vivante_General', 'viv19', 1, 3),
('evaluation_generale', 'Protection_Vivante_General', 'viv19', 2, 4),
('evaluation_generale', 'Protection_Vivante_General', 'viv2', 4, 1),
('evaluation_generale', 'Protection_Vivante_General', 'viv2', 4, 2),
('evaluation_generale', 'Protection_Vivante_General', 'viv2', 1, 3),
('evaluation_generale', 'Protection_Vivante_General', 'viv2', 2, 4),
('evaluation_generale', 'Protection_Vivante_General', 'viv20', 3, 1),
('evaluation_generale', 'Protection_Vivante_General', 'viv20', 3, 2),
('evaluation_generale', 'Protection_Vivante_General', 'viv20', 1, 3),
('evaluation_generale', 'Protection_Vivante_General', 'viv20', 1, 4),
('evaluation_generale', 'Protection_Vivante_General', 'viv21', 5, 1),
('evaluation_generale', 'Protection_Vivante_General', 'viv21', 5, 2),
('evaluation_generale', 'Protection_Vivante_General', 'viv21', 5, 3),
('evaluation_generale', 'Protection_Vivante_General', 'viv21', 2, 4),
('evaluation_generale', 'Protection_Vivante_General', 'viv22', 2, 1),
('evaluation_generale', 'Protection_Vivante_General', 'viv22', 1, 2),
('evaluation_generale', 'Protection_Vivante_General', 'viv22', 2, 3),
('evaluation_generale', 'Protection_Vivante_General', 'viv22', 3, 4),
('evaluation_generale', 'Protection_Vivante_General', 'viv3', 2, 1),
('evaluation_generale', 'Protection_Vivante_General', 'viv3', 1, 2),
('evaluation_generale', 'Protection_Vivante_General', 'viv3', 2, 3),
('evaluation_generale', 'Protection_Vivante_General', 'viv3', 2, 4),
('evaluation_generale', 'Protection_Vivante_General', 'viv4', 2, 1),
('evaluation_generale', 'Protection_Vivante_General', 'viv4', 2, 2),
('evaluation_generale', 'Protection_Vivante_General', 'viv4', 3, 3),
('evaluation_generale', 'Protection_Vivante_General', 'viv4', 1, 4),
('evaluation_generale', 'Protection_Vivante_General', 'viv5', 3, 1),
('evaluation_generale', 'Protection_Vivante_General', 'viv5', 1, 2),
('evaluation_generale', 'Protection_Vivante_General', 'viv5', 3, 3),
('evaluation_generale', 'Protection_Vivante_General', 'viv5', 2, 4),
('evaluation_generale', 'Protection_Vivante_General', 'viv6', 2, 1),
('evaluation_generale', 'Protection_Vivante_General', 'viv6', 2, 2),
('evaluation_generale', 'Protection_Vivante_General', 'viv6', 2, 3),
('evaluation_generale', 'Protection_Vivante_General', 'viv6', 2, 4),
('evaluation_generale', 'Protection_Vivante_General', 'viv7', 6, 1),
('evaluation_generale', 'Protection_Vivante_General', 'viv7', 1, 2),
('evaluation_generale', 'Protection_Vivante_General', 'viv7', 3, 3),
('evaluation_generale', 'Protection_Vivante_General', 'viv7', 4, 4),
('evaluation_generale', 'Protection_Vivante_General', 'viv8', 1, 1),
('evaluation_generale', 'Protection_Vivante_General', 'viv8', 1, 2),
('evaluation_generale', 'Protection_Vivante_General', 'viv8', 4, 3),
('evaluation_generale', 'Protection_Vivante_General', 'viv8', 5, 4),
('evaluation_generale', 'Protection_Vivante_General', 'viv9', 1, 1),
('evaluation_generale', 'Protection_Vivante_General', 'viv9', 2, 2),
('evaluation_generale', 'Protection_Vivante_General', 'viv9', 3, 3),
('evaluation_generale', 'Protection_Vivante_General', 'viv9', 2, 4),
('evaluation_parcelle', 'Contexte_Socioeco_Parcelle', 'ecop1', 3, 1),
('evaluation_parcelle', 'Contexte_Socioeco_Parcelle', 'ecop1', 4, 2),
('evaluation_parcelle', 'Contexte_Socioeco_Parcelle', 'ecop1', 2, 3),
('evaluation_parcelle', 'Contexte_Socioeco_Parcelle', 'ecop1', 3, 4),
('evaluation_parcelle', 'Contexte_Socioeco_Parcelle', 'ecop2', 1, 1),
('evaluation_parcelle', 'Contexte_Socioeco_Parcelle', 'ecop2', 4, 2),
('evaluation_parcelle', 'Contexte_Socioeco_Parcelle', 'ecop2', 1, 3),
('evaluation_parcelle', 'Contexte_Socioeco_Parcelle', 'ecop2', 4, 4),
('evaluation_parcelle', 'Elevage_Parcelle', 'elep1', 2, 1),
('evaluation_parcelle', 'Elevage_Parcelle', 'elep1', 1, 2),
('evaluation_parcelle', 'Elevage_Parcelle', 'elep1', 1, 3),
('evaluation_parcelle', 'Elevage_Parcelle', 'elep1', 1, 4),
('evaluation_parcelle', 'Elevage_Parcelle', 'elep2', 5, 1),
('evaluation_parcelle', 'Elevage_Parcelle', 'elep2', 4, 2),
('evaluation_parcelle', 'Elevage_Parcelle', 'elep2', 5, 3),
('evaluation_parcelle', 'Elevage_Parcelle', 'elep2', 4, 4),
('evaluation_parcelle', 'Elevage_Parcelle', 'elep3', 1, 1),
('evaluation_parcelle', 'Elevage_Parcelle', 'elep3', 1, 2),
('evaluation_parcelle', 'Elevage_Parcelle', 'elep3', 2, 3),
('evaluation_parcelle', 'Elevage_Parcelle', 'elep3', 1, 4),
('evaluation_parcelle', 'Elevage_Parcelle', 'elep4', 1, 1),
('evaluation_parcelle', 'Elevage_Parcelle', 'elep4', 2, 2),
('evaluation_parcelle', 'Elevage_Parcelle', 'elep4', 2, 3),
('evaluation_parcelle', 'Elevage_Parcelle', 'elep4', 1, 4),
('evaluation_parcelle', 'Elevage_Parcelle', 'elep5', 1, 1),
('evaluation_parcelle', 'Elevage_Parcelle', 'elep5', 1, 2),
('evaluation_parcelle', 'Elevage_Parcelle', 'elep5', 1, 3),
('evaluation_parcelle', 'Elevage_Parcelle', 'elep5', 1, 4),
('evaluation_parcelle', 'Elevage_Parcelle', 'elep6', 4, 1),
('evaluation_parcelle', 'Elevage_Parcelle', 'elep6', 2, 2),
('evaluation_parcelle', 'Elevage_Parcelle', 'elep6', 4, 3),
('evaluation_parcelle', 'Elevage_Parcelle', 'elep6', 4, 4),
('evaluation_parcelle', 'Elevage_Parcelle', 'elep7', 2, 1),
('evaluation_parcelle', 'Elevage_Parcelle', 'elep7', 2, 2),
('evaluation_parcelle', 'Elevage_Parcelle', 'elep7', 3, 3),
('evaluation_parcelle', 'Elevage_Parcelle', 'elep7', 4, 4),
('evaluation_parcelle', 'Elevage_Parcelle', 'elep8', 3, 1),
('evaluation_parcelle', 'Elevage_Parcelle', 'elep8', 1, 2),
('evaluation_parcelle', 'Elevage_Parcelle', 'elep8', 4, 3),
('evaluation_parcelle', 'Elevage_Parcelle', 'elep8', 5, 4),
('evaluation_parcelle', 'Environnement_Parcelle', 'envp1', 1, 1),
('evaluation_parcelle', 'Environnement_Parcelle', 'envp1', 2, 2),
('evaluation_parcelle', 'Environnement_Parcelle', 'envp1', 1, 3),
('evaluation_parcelle', 'Environnement_Parcelle', 'envp1', 1, 4),
('evaluation_parcelle', 'Environnement_Parcelle', 'envp2', 1, 1),
('evaluation_parcelle', 'Environnement_Parcelle', 'envp2', 3, 2),
('evaluation_parcelle', 'Environnement_Parcelle', 'envp2', 1, 3),
('evaluation_parcelle', 'Environnement_Parcelle', 'envp2', 2, 4),
('evaluation_parcelle', 'Environnement_Parcelle', 'envp3', 4, 1),
('evaluation_parcelle', 'Environnement_Parcelle', 'envp3', 3, 2),
('evaluation_parcelle', 'Environnement_Parcelle', 'envp3', 2, 3),
('evaluation_parcelle', 'Environnement_Parcelle', 'envp3', 3, 4),
('evaluation_parcelle', 'Environnement_Parcelle', 'envp4', 1, 1),
('evaluation_parcelle', 'Environnement_Parcelle', 'envp4', 1, 2),
('evaluation_parcelle', 'Environnement_Parcelle', 'envp4', 2, 3),
('evaluation_parcelle', 'Environnement_Parcelle', 'envp4', 2, 4),
('evaluation_parcelle', 'Environnement_Parcelle', 'envp5', 1, 1),
('evaluation_parcelle', 'Environnement_Parcelle', 'envp5', 1, 2),
('evaluation_parcelle', 'Environnement_Parcelle', 'envp5', 2, 3),
('evaluation_parcelle', 'Environnement_Parcelle', 'envp5', 2, 4),
('evaluation_parcelle', 'Environnement_Parcelle', 'envp6', 1, 1),
('evaluation_parcelle', 'Environnement_Parcelle', 'envp6', 2, 2),
('evaluation_parcelle', 'Environnement_Parcelle', 'envp6', 3, 3),
('evaluation_parcelle', 'Environnement_Parcelle', 'envp6', 2, 4),
('evaluation_parcelle', 'Environnement_Parcelle', 'envp7', 1, 1),
('evaluation_parcelle', 'Environnement_Parcelle', 'envp7', 1, 2),
('evaluation_parcelle', 'Environnement_Parcelle', 'envp7', 2, 3),
('evaluation_parcelle', 'Environnement_Parcelle', 'envp7', 2, 4),
('evaluation_parcelle', 'Environnement_Parcelle', 'envp8', 3, 1),
('evaluation_parcelle', 'Environnement_Parcelle', 'envp8', 5, 2),
('evaluation_parcelle', 'Environnement_Parcelle', 'envp8', 2, 3),
('evaluation_parcelle', 'Environnement_Parcelle', 'envp8', 4, 4),
('evaluation_parcelle', 'Environnement_Parcelle', 'envp9', 4, 1),
('evaluation_parcelle', 'Environnement_Parcelle', 'envp9', 3, 2),
('evaluation_parcelle', 'Environnement_Parcelle', 'envp9', 2, 3),
('evaluation_parcelle', 'Environnement_Parcelle', 'envp9', 1, 4),
('evaluation_parcelle', 'Protection_Parcelle', 'protecp1', 3, 1),
('evaluation_parcelle', 'Protection_Parcelle', 'protecp1', 6, 2),
('evaluation_parcelle', 'Protection_Parcelle', 'protecp1', 6, 3),
('evaluation_parcelle', 'Protection_Parcelle', 'protecp1', 3, 4),
('evaluation_parcelle', 'Protection_Parcelle', 'protecp2', 1, 1),
('evaluation_parcelle', 'Protection_Parcelle', 'protecp2', 6, 2),
('evaluation_parcelle', 'Protection_Parcelle', 'protecp2', 7, 3),
('evaluation_parcelle', 'Protection_Parcelle', 'protecp2', 7, 4),
('evaluation_parcelle', 'Protection_Parcelle', 'protecp3', 1, 1),
('evaluation_parcelle', 'Protection_Parcelle', 'protecp3', 3, 2),
('evaluation_parcelle', 'Protection_Parcelle', 'protecp3', 4, 3),
('evaluation_parcelle', 'Protection_Parcelle', 'protecp3', 1, 4),
('evaluation_parcelle', 'Protection_Parcelle', 'protecp4', 1, 1),
('evaluation_parcelle', 'Protection_Parcelle', 'protecp4', 2, 2),
('evaluation_parcelle', 'Protection_Parcelle', 'protecp4', 2, 3),
('evaluation_parcelle', 'Protection_Parcelle', 'protecp4', 1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `test`
--

INSERT INTO `test` (`id`, `time`) VALUES
(148, '2017-10-01 19:00:00'),
(147, '2017-10-01 19:00:00'),
(146, '2017-10-01 19:00:00'),
(145, '2017-10-01 19:00:00'),
(144, '2017-10-01 19:00:00'),
(143, '2017-10-01 19:00:00'),
(142, '2017-10-01 19:00:00'),
(141, '2017-10-01 19:00:00'),
(140, '2017-10-01 19:00:00'),
(139, '2017-10-01 19:00:00'),
(138, '2017-10-01 19:00:00'),
(137, '2017-10-01 19:00:00'),
(136, '2017-10-01 19:00:00'),
(135, '2017-10-01 19:00:00'),
(134, '2017-10-01 19:00:00'),
(133, '2017-10-01 19:00:00'),
(132, '2017-10-01 19:00:00'),
(131, '2017-10-01 19:00:00'),
(130, '2017-10-01 19:00:00'),
(129, '2017-10-01 19:00:00'),
(128, '2017-10-01 19:00:00'),
(127, '2017-10-01 19:00:00'),
(126, '2017-10-01 19:00:00'),
(125, '2017-10-01 19:00:00'),
(124, '2017-10-01 19:00:00'),
(123, '2017-10-01 19:00:00'),
(122, '2017-10-01 19:00:00'),
(121, '2017-10-01 19:00:00'),
(120, '2017-10-01 19:00:00'),
(119, '2017-10-01 19:00:00'),
(118, '2017-10-01 19:00:00'),
(117, '2017-10-01 19:00:00'),
(116, '2017-10-01 19:00:00'),
(115, '2017-10-01 19:00:00'),
(114, '2017-10-01 19:00:00'),
(113, '2017-10-01 19:00:00'),
(112, '2017-10-01 19:00:00'),
(111, '2017-07-02 12:00:36'),
(110, '2017-07-02 12:00:08'),
(109, '2017-07-02 11:35:30'),
(108, '2017-07-02 11:35:20'),
(107, '2017-07-02 11:34:32'),
(106, '2017-07-02 11:33:11'),
(105, '2017-07-02 11:32:47'),
(104, '2017-07-02 11:32:39'),
(103, '2017-07-02 11:31:10'),
(102, '2017-07-02 11:29:46');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `appartement` int(11) NOT NULL,
  `startTime` datetime NOT NULL,
  `modificationTime` datetime NOT NULL,
  `connexions` text NOT NULL,
  `rMessages` text NOT NULL,
  `rComments` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `appartement`, `startTime`, `modificationTime`, `connexions`, `rMessages`, `rComments`) VALUES
(1, 'Cofae', '6b0c653eceb9194fca965355603080728b2aa8a952776addbf16fbfa9cf7a2a533b7a3c65c938abad28d2b4eef3bafbb0a925ebd9d910c6487ee13c4e3b32640', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '240', ''),
(2, 'Fecol', '6b0c653eceb9194fca965355603080728b2aa8a952776addbf16fbfa9cf7a2a533b7a3c65c938abad28d2b4eef3bafbb0a925ebd9d910c6487ee13c4e3b32640', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '240', ''),
(3, 'Zeige', '6b0c653eceb9194fca965355603080728b2aa8a952776addbf16fbfa9cf7a2a533b7a3c65c938abad28d2b4eef3bafbb0a925ebd9d910c6487ee13c4e3b32640', 0, '2022-03-05 12:00:34', '2022-03-05 12:00:34', '2022-03-05', '', ''),
(4, 'Cozie', '6b0c653eceb9194fca965355603080728b2aa8a952776addbf16fbfa9cf7a2a533b7a3c65c938abad28d2b4eef3bafbb0a925ebd9d910c6487ee13c4e3b32640', 0, '2022-03-05 18:43:20', '2022-03-08 10:05:34', '2022-03-05,2022-03-05,2022-03-05,2022-03-05,2022-03-05,2022-03-05,2022-03-06,2022-03-06,2022-03-06,2022-03-06,2022-03-06,2022-03-06,2022-03-06,2022-03-06,2022-03-06,2022-03-06,2022-03-06,2022-03-06,2022-03-07,2022-03-08,2022-03-09', '', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cro_config`
--
ALTER TABLE `cro_config`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `all_activated_2` (`id`),
  ADD KEY `all_activated` (`id`);

--
-- Index pour la table `habitation`
--
ALTER TABLE `habitation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notifications_mails`
--
ALTER TABLE `notifications_mails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `profils`
--
ALTER TABLE `profils`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `proposition`
--
ALTER TABLE `proposition`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `questionnaires`
--
ALTER TABLE `questionnaires`
  ADD PRIMARY KEY (`category`,`type`,`id`,`user_id`);

--
-- Index pour la table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `cro_config`
--
ALTER TABLE `cro_config`
  MODIFY `id` tinyint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `habitation`
--
ALTER TABLE `habitation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `proposition`
--
ALTER TABLE `proposition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
