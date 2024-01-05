-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 05 jan. 2024 à 10:57
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `numeritalk`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `cat_name`) VALUES
(1, 'php'),
(2, 'java'),
(29, 'ruby');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `mes_contenu` varchar(70) NOT NULL,
  `sujet` int(11) NOT NULL,
  `utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `mes_contenu`, `sujet`, `utilisateur`) VALUES
(3, 'je suis quantin', 1, 33),
(6, 'bonjour', 2, 33),
(7, 'test', 2, 33),
(8, 'oui php est bien', 2, 33),
(9, 'test', 2, 33),
(10, 'autre test', 1, 33),
(11, 'c\'est bien php oui', 2, 33),
(12, 'j\'aime php', 2, 33),
(13, 'j\'aime beaucoup php', 2, 33),
(18, 'test', 19, 35),
(22, 'coucou', 19, 35),
(23, 'testons', 20, 35),
(24, 'yo', 20, 35),
(25, 'j\'ai déjà fait du php', 20, 35),
(26, 'bonjour j\'aimerais biens tester les 2 ensembles', 21, 35),
(28, 'Bonjour je suis disponible pour aider des personnes', 22, 34),
(29, 'Bonjour je voudrais savoir pourquoi faire du java ?', 23, 34),
(30, 'ah c\'est bon plus besoin de réponse', 23, 34),
(31, 'Bonne question', 23, 33),
(32, 'ouais c\'est pas mal', 21, 34),
(33, 'arrete de te parler tout seul', 20, 34),
(34, 'Bonjour tout est dans le titre', 24, 34),
(35, 'Bonjour je voudrais savoir c\'est quoi J2EE ?', 25, 34),
(36, 'Encore un autre message sur java', 26, 34),
(37, 'Encore un autre message sur php', 27, 34);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `rol_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `rol_name`) VALUES
(1, 'utilisateur'),
(2, 'administrateur'),
(3, 'moderateur');

-- --------------------------------------------------------

--
-- Structure de la table `sujet`
--

CREATE TABLE `sujet` (
  `id` int(11) NOT NULL,
  `suj_name` varchar(40) NOT NULL,
  `categorie` int(11) NOT NULL,
  `utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `sujet`
--

INSERT INTO `sujet` (`id`, `suj_name`, `categorie`, `utilisateur`) VALUES
(1, 'comment creer une appli java', 2, 35),
(2, 'php est tres bien', 1, 34),
(19, 'j\'aimerais java', 2, 35),
(20, 'j\'aimais php', 1, 35),
(21, 'php avec symfony c\'est bien ?', 1, 35),
(22, 'qui a besoin d\'aide pour java ?', 2, 34),
(23, 'pourquoi faire du java ?', 2, 34),
(24, 'pourquoi faire du symfony ?', 1, 34),
(25, 'C\'est quoi J2EE ?', 2, 34),
(26, 'Encore un autre sujet sur java', 2, 34),
(27, 'Encore un autre sujet sur php', 1, 34);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `uti_name` varchar(50) NOT NULL,
  `uti_password` varchar(100) NOT NULL,
  `role` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pays` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `uti_name`, `uti_password`, `role`, `nom`, `prenom`, `date_naissance`, `email`, `pays`) VALUES
(33, 'quantin', '$2y$10$zDyGhGSqA5SkpK5LdAYF4em50ptmykXkV84HH8YT63qDGzMO99ox6', 2, 'massias', 'quantin', '2001-02-17', 'quantin.massias@gmail.com', 'france'),
(34, 'kev', '$2y$10$v7x6eD2AaOa8jEguxA65HuML6v4o0obKGc42sEInpns0Zmq/JzRTm', 1, 'Lordinot', 'Kévin', '2000-02-04', 'kev@gmail.com', 'france'),
(35, 'georges', '$2y$10$4krTM4Gt/ZiEuWNle9GkDeFzXQw91dDY8GTpJeez5GIqf5hL35I4q', 1, 'buccho', 'georges', '2000-06-08', 'georges@gmail.com', 'france');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sujet` (`sujet`),
  ADD KEY `utilisateur` (`utilisateur`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sujet`
--
ALTER TABLE `sujet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorie` (`categorie`),
  ADD KEY `utilisateur` (`utilisateur`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `sujet`
--
ALTER TABLE `sujet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`sujet`) REFERENCES `sujet` (`id`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`utilisateur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `sujet`
--
ALTER TABLE `sujet`
  ADD CONSTRAINT `sujet_ibfk_1` FOREIGN KEY (`categorie`) REFERENCES `categorie` (`id`),
  ADD CONSTRAINT `sujet_ibfk_2` FOREIGN KEY (`utilisateur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
