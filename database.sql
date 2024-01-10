-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 10 jan. 2024 à 16:31
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
  `mes_contenu` varchar(2000) NOT NULL,
  `sujet` int(11) NOT NULL,
  `utilisateur` int(11) NOT NULL,
  `date_publication` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `mes_contenu`, `sujet`, `utilisateur`, `date_publication`) VALUES
(3, 'je suis quantin', 1, 33, '2024-01-10 16:21:46'),
(6, 'bonjour', 2, 33, '2024-01-10 16:21:57'),
(23, 'testons', 20, 35, '2024-01-10 16:22:06'),
(28, 'Bonjour je suis disponible pour aider des personnes', 22, 34, '2024-01-10 16:22:13'),
(31, 'Bonne question', 23, 33, '2024-01-10 16:22:19'),
(32, 'ouais c\'est pas mal', 21, 34, '2024-01-10 16:22:26'),
(40, 'bonjour, quel est ta question ?', 2, 35, '2024-01-10 16:27:06');

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
  `suj_name` varchar(80) NOT NULL,
  `categorie` int(11) NOT NULL,
  `utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `sujet`
--

INSERT INTO `sujet` (`id`, `suj_name`, `categorie`, `utilisateur`) VALUES
(1, 'comment creer une appli java', 2, 35),
(2, 'php est tres bien', 1, 34),
(20, 'j\'aimais php', 1, 35),
(21, 'php avec symfony c\'est bien ?', 1, 35),
(22, 'qui a besoin d\'aide pour java ?', 2, 34),
(23, 'pourquoi faire du java ?', 2, 34);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `sujet`
--
ALTER TABLE `sujet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
