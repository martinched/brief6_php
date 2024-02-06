-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 25 jan. 2024 à 10:12
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `favori`
--

-- --------------------------------------------------------

--
-- Structure de la table `cat-fav`
--

CREATE TABLE `cat-fav` (
  `id_cat` int(11) NOT NULL,
  `id_fav` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cat-fav`
--

INSERT INTO `cat-fav` (`id_cat`, `id_fav`) VALUES
(1, 1),
(1, 6),
(1, 10),
(1, 13),
(1, 18),
(1, 19),
(1, 25),
(2, 2),
(2, 3),
(2, 4),
(2, 6),
(2, 7),
(3, 2),
(3, 3),
(3, 4),
(3, 6),
(3, 8),
(4, 1),
(5, 2),
(5, 3),
(5, 4),
(5, 5),
(5, 9),
(5, 14),
(5, 15),
(5, 16),
(5, 27),
(5, 28),
(6, 4),
(6, 21),
(7, 7),
(7, 8),
(7, 11),
(7, 17),
(8, 9),
(8, 10),
(8, 11),
(9, 12),
(10, 20),
(10, 21),
(10, 22),
(10, 23),
(11, 12),
(11, 13),
(11, 14),
(11, 15),
(11, 16),
(11, 17),
(11, 18),
(11, 19),
(11, 27),
(11, 28),
(11, 29),
(12, 20),
(12, 21),
(12, 22),
(12, 23),
(12, 30),
(13, 26),
(14, 24),
(14, 29),
(14, 30),
(15, 24),
(15, 25),
(15, 26),
(15, 27),
(15, 28),
(15, 29),
(15, 30);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_cat` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_cat`, `nom`) VALUES
(1, 'E-learning'),
(2, 'HTML'),
(3, 'CSS'),
(4, 'Maquette'),
(5, 'Site/blog'),
(6, 'E-projet'),
(7, 'Cheatsheet'),
(8, 'Boostrap'),
(9, 'Support/PDF'),
(10, 'Ressources/aides'),
(11, 'JavaScript'),
(12, 'Wordpress'),
(13, 'Outil'),
(14, 'Video'),
(15, 'API');

-- --------------------------------------------------------

--
-- Structure de la table `domaine`
--

CREATE TABLE `domaine` (
  `id_dom` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `domaine`
--

INSERT INTO `domaine` (`id_dom`, `nom`) VALUES
(1, 'Maquettage/figma'),
(2, 'HTML/CSS'),
(3, 'boostrap'),
(4, 'javascript'),
(5, 'wordpress'),
(6, 'API');

-- --------------------------------------------------------

--
-- Structure de la table `favori`
--

CREATE TABLE `favori` (
  `id_fav` int(11) NOT NULL,
  `libelle` varchar(150) NOT NULL,
  `date_creation` date NOT NULL,
  `url` varchar(2000) NOT NULL,
  `id_dom` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `favori`
--

INSERT INTO `favori` (`id_fav`, `libelle`, `date_creation`, `url`, `id_dom`) VALUES
(1, 'OpenClassRoom Maquette figma', '2024-01-01', 'https://openclassrooms.com/fr/courses/8242681-integrez-une-maquette-figma-en-html-css', 1),
(2, 'MSDN Début', '2024-01-02', 'https://www.pierre-giraud.com/javascript-apprendre-coder-cours/', 2),
(3, 'MSDN Première étape CSS', '2024-01-03', 'https://developer.mozilla.org/fr/docs/Learn/CSS/First_steps', 2),
(4, 'Introduction HTML eprojet', '2024-01-04', 'https://www.eprojet.fr/cours/html_css/01-html_css-introduction-html-css', 2),
(5, 'W3Shool intro', '2024-01-05', 'https://www.w3schools.com/html/html_intro.asp', 2),
(6, 'OpenClassRoom Créer son site WEB', '2024-01-06', 'https://openclassrooms.com/fr/courses/1603881-creez-votre-site-web-avec-html5-et-css3', 2),
(7, 'htmlcheatsheet HTML', '2024-01-07', 'https://htmlcheatsheet.com', 2),
(8, 'htmlcheatsheet CSS', '2024-01-08', 'https://htmlcheatsheet.com/css/', 2),
(9, 'Bootstrap introduction', '2024-01-09', 'https://getbootstrap.com/docs/5.3/getting-started/introduction/', 3),
(10, 'OpenClassRoom Bootstrap', '2024-01-10', 'https://openclassrooms.com/fr/courses/7542506-creez-des-sites-web-responsives-avec-bootstrap-5', 3),
(11, 'Bootstrap Cheatsheet', '2024-01-11', 'https://getbootstrap.com/docs/5.0/examples/cheatsheet/', 3),
(12, 'Support Javascript Initiation', '2024-01-12', 'https://drive.google.com/file/d/1zzIx9aD4pfkR1nn2UATRo8qRs6MZbxW4/view?usp=drive_link', 4),
(13, 'OpenClassRoom Javascript', '2024-01-13', 'https://openclassrooms.com/fr/courses/7696886-apprenez-a-programmer-avec-javascript?archived-source=6175841 ', 4),
(14, 'MSDN Introduction Javascript', '2024-01-14', 'https://developer.mozilla.org/fr/docs/Web/JavaScript ', 4),
(15, 'MSDN Première étape Javascript', '2024-01-15', 'https://developer.mozilla.org/fr/docs/Learn/JavaScript/First_steps', 4),
(16, 'MSDN Les bases en Javascript', '2024-01-16', 'https://developer.mozilla.org/fr/docs/Learn/Getting_started_with_the_web/JavaScript_basics ', 4),
(17, 'htmlcheatsheet Javascript', '2024-01-17', 'https://htmlcheatsheet.com/js/', 4),
(18, 'OpenClassRoom Apprenez à développer avec JS', '2024-01-18', 'https://openclassrooms.com/fr/courses/7696886-apprenez-a-programmer-avec-javascript', 4),
(19, 'Cours complet JS Pierre-Giraud', '2024-01-19', 'ttps://www.pierre-giraud.com/javascript-apprendre-coder-cours/', 4),
(20, 'CODEX Démarrer avec WordPress', '2024-01-20', 'https://codex.wordpress.org/fr:Demarrer_avec_WordPress', 5),
(21, 'Eprojet Installer WordPress', '2024-01-21', 'https://www.eprojet.fr/cours/wordpress/01-wordpress-installation-et-configuration-de-wordpress', 5),
(22, 'Thème Enfant WordPress Developer', '2024-01-22', 'https://developer.wordpress.org/themes/advanced-topics/child-themes/', 5),
(23, 'Thème Enfant WPFormation', '2024-01-23', 'https://wpformation.com/theme-enfant-wordpress/', 5),
(24, 'API : comprendre l\'essentiel en 4 minutes', '2024-01-24', 'https://www.youtube.com/watch?v=T0DmHRdtqY0&t=5s', 6),
(25, 'OpenClassRooms API-REST', '2024-01-25', 'https://openclassrooms.com/fr/courses/6031886-debutez-avec-les-api-rest', 6),
(26, 'PostMan', '2024-01-26', 'https://www.postman.com/', 6),
(27, 'XMLHttpRequest – Doc officielle', '2024-01-27', 'https://developer.mozilla.org/fr/docs/Web/API/XMLHttpRequest#constructeur', 6),
(28, 'Fetch API  Pierre Giraud', '2024-01-28', 'https://www.pierre-giraud.com/javascript-apprendre-coder-cours/api-fetch/', 6),
(29, 'Vidéo XMLHttpRequest', '2024-01-29', 'https://www.youtube.com/watch?v=Bct585a0Hj8', 6),
(30, 'La méthode Fetch (6 min)', '2024-01-30', 'https://www.youtube.com/watch?v=sGvEqHkDyFc', 6);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cat-fav`
--
ALTER TABLE `cat-fav`
  ADD PRIMARY KEY (`id_cat`,`id_fav`),
  ADD KEY `fk_ta_id_fav` (`id_fav`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_cat`);

--
-- Index pour la table `domaine`
--
ALTER TABLE `domaine`
  ADD PRIMARY KEY (`id_dom`);

--
-- Index pour la table `favori`
--
ALTER TABLE `favori`
  ADD PRIMARY KEY (`id_fav`),
  ADD KEY `fk_id_dom` (`id_dom`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `domaine`
--
ALTER TABLE `domaine`
  MODIFY `id_dom` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `favori`
--
ALTER TABLE `favori`
  MODIFY `id_fav` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cat-fav`
--
ALTER TABLE `cat-fav`
  ADD CONSTRAINT `fk_ta_id_cat` FOREIGN KEY (`id_cat`) REFERENCES `categorie` (`id_cat`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ta_id_fav` FOREIGN KEY (`id_fav`) REFERENCES `favori` (`id_fav`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `favori`
--
ALTER TABLE `favori`
  ADD CONSTRAINT `fk_id_dom` FOREIGN KEY (`id_dom`) REFERENCES `domaine` (`id_dom`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
