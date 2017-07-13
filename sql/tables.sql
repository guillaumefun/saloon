-- phpMyAdmin SQL Dump
-- version 4.4.10
-- https://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Dim 23 Avril 2017 à 14:56
-- Version du serveur :  5.5.42
-- Version de PHP :  5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `saloon`
--

-- --------------------------------------------------------

--
-- Structure de la table `bets`
--

CREATE TABLE `bets` (
  `id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `user` varchar(11) NOT NULL,
  `saloon_id` varchar(11) NOT NULL,
  `deadline` varchar(50) DEFAULT NULL,
  `accomplished` varchar(11) NOT NULL DEFAULT '0',
  `nb_img` int(1) NOT NULL,
  `modification_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `creation_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) unsigned NOT NULL,
  `content` varchar(10000) NOT NULL,
  `user_id` varchar(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `bet_id` varchar(11) NOT NULL,
  `saloon_id` varchar(11) NOT NULL,
  `modification_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `creation_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `rewards`
--

CREATE TABLE `rewards` (
  `id` bigint(20) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `bet_id` varchar(11) NOT NULL,
  `user_id` varchar(11) NOT NULL,
  `saloon_id` varchar(11) NOT NULL,
  `modification_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `creation_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `rewards_detail`
--

CREATE TABLE `rewards_detail` (
  `id` bigint(20) unsigned NOT NULL,
  `reward_id` varchar(11) NOT NULL,
  `user_id` varchar(11) NOT NULL,
  `user_login` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `modification_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `creation_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `saloons`
--

CREATE TABLE `saloons` (
  `id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `members` varchar(10000) NOT NULL,
  `modification_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `creation_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `modification_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `creation_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `bets`
--
ALTER TABLE `bets`
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `rewards`
--
ALTER TABLE `rewards`
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `rewards_detail`
--
ALTER TABLE `rewards_detail`
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `saloons`
--
ALTER TABLE `saloons`
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `bets`
--
ALTER TABLE `bets`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `rewards`
--
ALTER TABLE `rewards`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `rewards_detail`
--
ALTER TABLE `rewards_detail`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `saloons`
--
ALTER TABLE `saloons`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;