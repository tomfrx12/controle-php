-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 20 mars 2026 à 16:55
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
-- Base de données : `ma_collection_jeux`
--

-- --------------------------------------------------------

--
-- Structure de la table `jeux`
--

CREATE TABLE `jeux` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `studio_id` int(11) NOT NULL,
  `annee_sortie` int(11) NOT NULL,
  `plateforme` varchar(100) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `note` decimal(2,1) NOT NULL,
  `description` text DEFAULT NULL,
  `date_ajout` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `jeux`
--

INSERT INTO `jeux` (`id`, `titre`, `studio_id`, `annee_sortie`, `plateforme`, `genre`, `note`, `description`, `date_ajout`) VALUES
(11, 'Zelda: Breath of the Wild', 1, 2017, 'Switch', 'Action-Aventure', 4.9, 'Un chef-d\'oeuvre de liberté en monde ouvert.', '2026-03-20 13:53:31'),
(12, 'Super Mario Odyssey', 1, 2017, 'Switch', 'Plateforme', 4.7, 'Une aventure inventive avec Cappy.', '2026-03-20 13:53:31'),
(13, 'Assassin\'s Creed Valhalla', 2, 2020, 'Multi', 'Action-RPG', 3.8, 'L\'épopée viking d\'Eivor en Angleterre.', '2026-03-20 13:53:31'),
(14, 'Rayman Legends', 2, 2013, 'Multi', 'Plateforme', 4.5, 'L\'excellence du jeu de plateforme en 2D.', '2026-03-20 13:53:31'),
(15, 'Grand Theft Auto V', 3, 2013, 'Multi', 'Action', 4.8, 'Trois destins liés dans le crime à Los Santos.', '2026-03-20 13:53:31'),
(16, 'Red Dead Redemption 2', 3, 2018, 'Multi', 'Western', 5.0, 'Une prouesse technique et narrative incroyable.', '2026-03-20 13:53:31'),
(17, 'The Witcher 3: Wild Hunt', 4, 2015, 'Multi', 'RPG', 4.9, 'La traque de Ciri par le sorceleur Geralt.', '2026-03-20 13:53:31'),
(18, 'Cyberpunk 2077', 4, 2020, 'Multi', 'Action-RPG', 3.5, 'Une immersion futuriste à Night City.', '2026-03-20 13:53:31'),
(19, 'Mario Kart 8 Deluxe', 1, 2017, 'Switch', 'Course', 4.6, 'Le jeu de course référence entre amis.', '2026-03-20 13:53:31'),
(20, 'Far Cry 6', 2, 2021, 'Multi', 'FPS', 3.2, 'Une révolution contre un dictateur sur l\'île de Yara.', '2026-03-20 13:53:31'),
(21, 'test', 1, 2021, 'Nintendo Switch', 'FPS', 1.0, '', '2026-03-20 16:33:58');

-- --------------------------------------------------------

--
-- Structure de la table `studio`
--

CREATE TABLE `studio` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `pays` varchar(100) NOT NULL,
  `annee_creation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `studio`
--

INSERT INTO `studio` (`id`, `nom`, `pays`, `annee_creation`) VALUES
(1, 'Nintendo', 'Japon', 1889),
(2, 'Ubisoft', 'France', 1986),
(3, 'Rockstar Games', 'États-Unis', 1998),
(4, 'CD Projekt Red', 'Pologne', 2002);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `jeux`
--
ALTER TABLE `jeux`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studio_id` (`studio_id`);

--
-- Index pour la table `studio`
--
ALTER TABLE `studio`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom_unique` (`nom`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `jeux`
--
ALTER TABLE `jeux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `studio`
--
ALTER TABLE `studio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `jeux`
--
ALTER TABLE `jeux`
  ADD CONSTRAINT `fk_studio` FOREIGN KEY (`studio_id`) REFERENCES `studio` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
