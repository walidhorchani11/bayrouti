-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 20 mai 2018 à 16:46
-- Version du serveur :  10.1.31-MariaDB
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bayrouti`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imageName` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `name`, `image`, `imageName`) VALUES
(2, 'client 1', '21dfc040b36abb6f95191b916faefc96.jpeg', '21dfc040b36abb6f95191b916faefc96.jpeg'),
(3, 'client 2', '0f015062f89362decab4b201ead307c0.jpeg', '0f015062f89362decab4b201ead307c0.jpeg'),
(4, 'sss', '9289ce51a0164ba30b6ed73a347309ff.jpeg', '9289ce51a0164ba30b6ed73a347309ff.jpeg'),
(5, 'ssssss', '9289ce51a0164ba30b6ed73a347309ff.jpeg', '9289ce51a0164ba30b6ed73a347309ff.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `cmd_prod`
--

CREATE TABLE `cmd_prod` (
  `commande_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qte` int(11) NOT NULL,
  `createdAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `command`
--

CREATE TABLE `command` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `page`
--

INSERT INTO `page` (`id`, `title`, `content`, `date`) VALUES
(1, 'offre', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam nulla eros, lobortis a ipsum a, auctor pellentesque leo. Nulla facilisi. Vestibulum gravida aliquet nulla, sed iaculis nisi', '0000-00-00'),
(2, 'about', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam nulla eros, lobortis a ipsum a, auctor pellentesque leo. Nulla facilisi. Vestibulum gravida aliquet nulla, sed iaculis nisi', '0000-00-00');

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `image`, `image_name`, `name`, `description`, `price`) VALUES
(1, '4f9b7830fb95e810850679d7ca19b377.jpeg', '4f9b7830fb95e810850679d7ca19b377.jpeg', 'mayo', 'zdzdz', 14),
(2, '4f9b7830fb95e810850679d7ca19b377.jpeg', '4f9b7830fb95e810850679d7ca19b377.jpeg', 'mayo', 'zdzdz', 14),
(3, '4f9b7830fb95e810850679d7ca19b377.jpeg', '4f9b7830fb95e810850679d7ca19b377.jpeg', 'mayo', 'zdzdz', 14),
(4, '4f9b7830fb95e810850679d7ca19b377.jpeg', '4f9b7830fb95e810850679d7ca19b377.jpeg', 'mayo', 'zdzdz hjfck zec zjcze czec ze cze z e ezc ze c zec ze cze  ezc ze', 14),
(5, '4f9b7830fb95e810850679d7ca19b377.jpeg', '4f9b7830fb95e810850679d7ca19b377.jpeg', 'mayo', 'zdzdz', 14),
(6, '4f9b7830fb95e810850679d7ca19b377.jpeg', '4f9b7830fb95e810850679d7ca19b377.jpeg', 'mayo', 'zdzdz', 14);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cmd_prod`
--
ALTER TABLE `cmd_prod`
  ADD PRIMARY KEY (`commande_id`,`product_id`),
  ADD KEY `IDX_6CF18EC982EA2E54` (`commande_id`),
  ADD KEY `IDX_6CF18EC94584665A` (`product_id`);

--
-- Index pour la table `command`
--
ALTER TABLE `command`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `command`
--
ALTER TABLE `command`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cmd_prod`
--
ALTER TABLE `cmd_prod`
  ADD CONSTRAINT `FK_6CF18EC94584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_6CF18EC982EA2E54` FOREIGN KEY (`commande_id`) REFERENCES `command` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
