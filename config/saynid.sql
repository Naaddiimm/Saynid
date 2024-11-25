-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 23 nov. 2024 à 19:08
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
-- Base de données : `saynid`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('khchini.admin', '$2y$10$ibN1mba1pDPUCeXv0LvOmuuLS18NrsSEkQdzFcEvrpHKCb8GjIv0W');

-- --------------------------------------------------------

--
-- Structure de la table `blog`
--

CREATE TABLE `blog` (
  `id_B` int(11) NOT NULL,
  `titre` varchar(200) NOT NULL,
  `contenu` text NOT NULL,
  `nb_like` int(11) DEFAULT 0,
  `nb_dislike` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id_Comm` int(11) NOT NULL,
  `user` varchar(100) DEFAULT NULL,
  `contenu` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `id_cours` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `titre` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`id_cours`, `description`, `titre`) VALUES
(19, 'xxx', 'HTML/PHP'),
(20, 'xxx', 'C / C++'),
(22, 'xxx', 'JAVA');

-- --------------------------------------------------------

--
-- Structure de la table `levels`
--

CREATE TABLE `levels` (
  `id` int(11) NOT NULL,
  `titre` varchar(200) NOT NULL,
  `contenu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `p_cours`
--

CREATE TABLE `p_cours` (
  `user` varchar(100) NOT NULL,
  `id_C` int(11) NOT NULL,
  `status_C` int(11) DEFAULT 0,
  `prix` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `p_cours`
--

INSERT INTO `p_cours` (`user`, `id_C`, `status_C`, `prix`) VALUES
('AAA', 20, 1, 200),
('DRABADOB', 19, 1, 50),
('DRABADOB', 22, 1, 150),
('nadim ', 19, 1, 50),
('nadim ', 20, 1, 200),
('XXX', 19, 1, 50),
('XXX', 20, 1, 200),
('XXX', 22, 1, 150);

-- --------------------------------------------------------

--
-- Structure de la table `p_test`
--

CREATE TABLE `p_test` (
  `user` varchar(100) NOT NULL,
  `id_T` int(11) NOT NULL,
  `status_T` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE `question` (
  `id_question` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `option_1` text DEFAULT NULL,
  `option_2` text DEFAULT NULL,
  `option_3` text DEFAULT NULL,
  `correct_option` int(11) NOT NULL,
  `points` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `stage`
--

CREATE TABLE `stage` (
  `id_stage` int(11) NOT NULL,
  `titre` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `score_min` int(11) DEFAULT 0,
  `score_max` int(11) DEFAULT 100
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `stage_assignement`
--

CREATE TABLE `stage_assignement` (
  `id` int(11) NOT NULL,
  `id_assignement` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `test`
--

CREATE TABLE `test` (
  `id_test` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `test_scores`
--

CREATE TABLE `test_scores` (
  `user` varchar(100) NOT NULL,
  `test_id` int(11) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `visitor`
--

CREATE TABLE `visitor` (
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `visitor`
--

INSERT INTO `visitor` (`username`, `password`, `active`) VALUES
('AAA', '$2y$10$oMDls9gsHs/cVdArmyDVEuloETmPZuwmlYycTmArhfJtL2Mnj2vAe', 1),
('DRABADOB', '$2y$10$8Pf0R055PoNdZCVyNX7MvOAs/3Rr8SrKFF2qPq0s0v87iuqHULp1O', 1),
('nadim ', '$2y$10$Gmh7b6yUsS7WUGNitTVLT.ii39Wp5I0Ctjo.K38/gjIYxmdX8E7ni', 1),
('XXX', '$2y$10$BtP/5z4pzZFma0QDBxItmO0oceG4pfPR30hluBCyLm1kqceZk/gxC', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Index pour la table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id_B`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id_Comm`),
  ADD KEY `user` (`user`);

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id_cours`);

--
-- Index pour la table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `p_cours`
--
ALTER TABLE `p_cours`
  ADD PRIMARY KEY (`user`,`id_C`),
  ADD KEY `id_C` (`id_C`);

--
-- Index pour la table `p_test`
--
ALTER TABLE `p_test`
  ADD PRIMARY KEY (`user`,`id_T`),
  ADD KEY `id_T` (`id_T`);

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id_question`),
  ADD KEY `test_id` (`test_id`);

--
-- Index pour la table `stage`
--
ALTER TABLE `stage`
  ADD PRIMARY KEY (`id_stage`);

--
-- Index pour la table `stage_assignement`
--
ALTER TABLE `stage_assignement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id_test`);

--
-- Index pour la table `test_scores`
--
ALTER TABLE `test_scores`
  ADD KEY `user` (`user`),
  ADD KEY `test_id` (`test_id`);

--
-- Index pour la table `visitor`
--
ALTER TABLE `visitor`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `blog`
--
ALTER TABLE `blog`
  MODIFY `id_B` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id_Comm` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `id_cours` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
  MODIFY `id_question` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `stage`
--
ALTER TABLE `stage`
  MODIFY `id_stage` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `stage_assignement`
--
ALTER TABLE `stage_assignement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `test`
--
ALTER TABLE `test`
  MODIFY `id_test` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`user`) REFERENCES `visitor` (`username`);

--
-- Contraintes pour la table `p_cours`
--
ALTER TABLE `p_cours`
  ADD CONSTRAINT `p_cours_ibfk_1` FOREIGN KEY (`user`) REFERENCES `visitor` (`username`),
  ADD CONSTRAINT `p_cours_ibfk_2` FOREIGN KEY (`id_C`) REFERENCES `cours` (`id_cours`);

--
-- Contraintes pour la table `p_test`
--
ALTER TABLE `p_test`
  ADD CONSTRAINT `p_test_ibfk_1` FOREIGN KEY (`user`) REFERENCES `visitor` (`username`),
  ADD CONSTRAINT `p_test_ibfk_2` FOREIGN KEY (`id_T`) REFERENCES `test` (`id_test`);

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `test` (`id_test`) ON DELETE CASCADE;

--
-- Contraintes pour la table `test_scores`
--
ALTER TABLE `test_scores`
  ADD CONSTRAINT `test_scores_ibfk_1` FOREIGN KEY (`user`) REFERENCES `visitor` (`username`),
  ADD CONSTRAINT `test_scores_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `test` (`id_test`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
