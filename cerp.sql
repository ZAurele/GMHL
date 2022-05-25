-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 21, 2022 at 08:42 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gmhl`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categorie` varchar(30) NOT NULL,
  `messages` text NOT NULL,
  `icon` varchar(30) NOT NULL DEFAULT 'question'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `unique_id` varchar(15) NOT NULL,
  `message` varchar(20) NOT NULL,
  `sender` varchar(20) NOT NULL,
  `comment` text NOT NULL,
  `creation_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modification_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cro_config`
--

CREATE TABLE `cro_config` (
  `id` tinyint(10) NOT NULL,
  `name` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `activated` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `habitation`
--

CREATE TABLE `habitation` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `chauffage` tinyint(4) NOT NULL,
  `eau` tinyint(4) NOT NULL,
  `elec` tinyint(4) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ascenseur` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifications_mails`
--

CREATE TABLE `notifications_mails` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `unique_id` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `creation_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `creation_date` varchar(10) NOT NULL,
  `modification_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `message` text NOT NULL,
  `title` text NOT NULL,
  `attached_files` text,
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
-- Table structure for table `profils`
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
  `timeMail` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `messageMail` varchar(2) DEFAULT NULL,
  `notificationMail` varchar(2) DEFAULT NULL,
  `privateMail` varchar(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `proposition`
--

CREATE TABLE `proposition` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` int(11) NOT NULL,
  `proposition` tinyint(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questionnaires`
--

CREATE TABLE `questionnaires` (
  `env` varchar(10) NOT NULL DEFAULT 'fr',
  `category` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `number` int(11) NOT NULL DEFAULT '1',
  `version` int(11) NOT NULL,
  `id` varchar(10) NOT NULL,
  `answer` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `questionnaires_names`
--

CREATE TABLE `questionnaires_names` (
  `category` varchar(100) NOT NULL,
  `number` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `startTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modificationTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `connexions` text,
  `rMessages` text,
  `rComments` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cro_config`
--
ALTER TABLE `cro_config`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `all_activated_2` (`id`),
  ADD KEY `all_activated` (`id`);

--
-- Indexes for table `habitation`
--
ALTER TABLE `habitation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications_mails`
--
ALTER TABLE `notifications_mails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profils`
--
ALTER TABLE `profils`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `proposition`
--
ALTER TABLE `proposition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questionnaires`
--
ALTER TABLE `questionnaires`
  ADD PRIMARY KEY (`env`,`category`,`type`,`number`,`version`,`id`,`user_id`);

--
-- Indexes for table `questionnaires_names`
--
ALTER TABLE `questionnaires_names`
  ADD PRIMARY KEY (`category`,`number`,`user_id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cro_config`
--
ALTER TABLE `cro_config`
  MODIFY `id` tinyint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `habitation`
--
ALTER TABLE `habitation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proposition`
--
ALTER TABLE `proposition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
