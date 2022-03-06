-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 24 Février 2017 à 19:20
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `up`
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
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `categorie`, `messages`, `icon`) VALUES
(13, 'SiteWeb', '58a71a9b483af,58a71a9b4872d,58a80d4473100', 'globe'),
(15, 'Quartier', '58af4b430d883,58af4b430daf7', 'building'),
(17, 'aide', 'Aide', 'handshake-o');

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
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `habitation`
--

INSERT INTO `habitation` (`id`, `user_id`, `chauffage`, `eau`, `elec`, `date`) VALUES
(9, 1, 2, 4, 4, '2017-02-23 21:27:28'),
(10, 1, 0, 2, 4, '2017-02-23 21:27:43'),
(11, 1, 0, 2, 4, '2017-02-23 21:28:22'),
(12, 1, 0, 4, 0, '2017-02-23 21:45:33'),
(13, 1, 0, 4, 0, '2017-02-23 21:46:17');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `who` varchar(20) NOT NULL,
  `sender` varchar(20) NOT NULL,
  `message` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `unique_id` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `creation_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `creation_date` varchar(10) NOT NULL,
  `modification_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message` text NOT NULL,
  `title` text NOT NULL,
  `attached_files` text,
  `type` text NOT NULL,
  `categorie` int(11) NOT NULL,
  `dateEvenement` varchar(10) DEFAULT NULL,
  `priority` varchar(30) NOT NULL,
  `up_vote` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `posts`
--

INSERT INTO `posts` (`id`, `unique_id`, `user_id`, `creation_time`, `creation_date`, `modification_time`, `message`, `title`, `attached_files`, `type`, `categorie`, `dateEvenement`, `priority`, `up_vote`) VALUES
(19, '58a80d4473100', 1, '2017-02-18 09:00:52', '18/02/2017', '2017-02-18 09:00:52', 'mensis itaque difficultatibus multis et nive obrutis callibus plurimis ubi prope Rauracum ventum est ad supercilia fluminis Rheni, resistente multitudine Alamanna pontem suspendere navium conpage Romani vi nimia vetabantur ritu grandinis undique convolantibus telis, et cum id inpossibile videretur, imperator cogitationibus magnis attonitus, quid capesseret ambigebat.', 'test 2', '', 'nouvelles', 13, '2017-02-18', 'faible', ''),
(18, '58a71a9b4872d', 81, '2017-02-17 15:45:31', '17/02/2017', '2017-02-17 15:45:31', 'Ceci est un test', 'Test', '', 'nouvelles', 13, '2017-02-17', 'faible', '1'),
(21, '58af4b430daf7', 1, '2017-02-23 20:51:15', '23/02/2017', '2017-02-23 20:51:15', 'blabla', 'Ceci est un test', '', 'evenement', 15, '2017-02-28', 'faible', '');

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
  `frequence_notifications` tinyint(4) NOT NULL,
  `profil_view` varchar(20) NOT NULL,
  `proprietaire` tinyint(1) NOT NULL,
  `description` text NOT NULL,
  `etage` tinyint(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `profils`
--

INSERT INTO `profils` (`user_id`, `nom`, `prenom`, `email`, `email_enable`, `frequence_notifications`, `profil_view`, `proprietaire`, `description`, `etage`) VALUES
(1, 'Durand', 'Aurele', 'durand.aurele@gmail.com', '', 1, 'nom-prenom', 1, 'test', 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `appartement` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `appartement`) VALUES
(1, 'aurele', 'Adama14u$7', 81),
(2, 'Chacha', 'aureleismygod', 81);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `habitation`
--
ALTER TABLE `habitation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `profils`
--
ALTER TABLE `profils`
  ADD PRIMARY KEY (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `habitation`
--
ALTER TABLE `habitation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
