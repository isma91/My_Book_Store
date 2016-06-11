-- phpMyAdmin SQL Dump
-- version 4.6.2
-- https://www.phpmyadmin.net/
--
-- Client :  localhost
-- Généré le :  Sam 11 Juin 2016 à 15:50
-- Version du serveur :  5.7.12-0ubuntu1
-- Version de PHP :  7.0.4-7ubuntu2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `my_book_store`
--
CREATE DATABASE IF NOT EXISTS `my_book_store` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `my_book_store`;

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `author` text NOT NULL,
  `editor` text NOT NULL,
  `year` int(4) NOT NULL,
  `kind` text NOT NULL,
  `type` text NOT NULL,
  `cover` text,
  `resume` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `books`
--

INSERT INTO `books` (`id`, `name`, `author`, `editor`, `year`, `kind`, `type`, `cover`, `resume`) VALUES
(1, 'Artemis Fowl', 'Eoin Colfer', 'Viking Press', 2001, 'action;adventure;humour;science fiction', 'novel', 'cover_575ac662f07293.47653077.99877777.jpg', 'Artemis Fowl is a genius of twelve. He lives in Ireland and has one goal in mind: to restore the fortunes of his family. It belongs to a dynasty of famous thieves. Artemis\'s father is missing and his mother, mad with grief, lost his head. Aided by his faithful servant Butler, a colossus, Artemis plans to steal the gold fairies. They fled underground for hundreds of years and are only rare forays into the open air, equipped as cosmonauts. Artemis, helped by his uncommon intelligence and sophisticated technology, will he stronger than the people fairies?'),
(2, 'The Martian', 'Andy Weir', 'Crown', 2014, 'thriller;suspence', 'novel', 'cover_575ac680d54fa5.54103728.74197822.jpg', 'Six days ago, astronaut Mark Watney became one of the first people to walk on Mars. \r\nNow, he\'s sure he\'ll be the first person to die there.\r\nAfter a dust storm nearly kills him and forces his crew to evacuate while thinking him dead, Mark finds himself stranded and completely alone with no way to even signal Earth that heâ€™s aliveâ€”and even if he could get word out, his supplies would be gone long before a rescue could arrive.\r\nBut Mark isn\'t ready to give up yet. Drawing on his ingenuity, his engineering skills, he steadfastly confronts one seemingly insurmountable obstacle after the next.');

-- --------------------------------------------------------

--
-- Structure de la table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `adresse` text NOT NULL,
  `city` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `customers`
--

INSERT INTO `customers` (`id`, `firstname`, `lastname`, `adresse`, `city`, `email`) VALUES
(1, 'Ismail', 'Aydogmus', '8 RÃ©sidence Le Bosquet', 'Les Ulis', 'noatsuki@gmail.com'),
(2, 'Raphael', 'Bleuzet', '32 allÃ©e des amonts', 'Paris', 'raph@devraph.net');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `type` text NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_book` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `orders`
--

INSERT INTO `orders` (`id`, `type`, `id_customer`, `id_book`) VALUES
(1, 'purchase', 1, 1),
(2, 'borrowing', 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` text NOT NULL,
  `pass` text NOT NULL,
  `token` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `token`) VALUES
(1, 'admin', '$2y$10$O.Po8p9YDVwYKHoQqPcA6eqgB2EgaOyeuIcr2PYZWbahtWllHlUMK', 'cc142f6a4eada55af2db7683641b8e5c90a5e2d3');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
