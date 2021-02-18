-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  jeu. 02 juil. 2020 à 11:07
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP :  7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `enginnova`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `passadmin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`id`, `nom`, `passadmin`) VALUES
(3, 'marc', 'marc'),
(5, 'severin', 'severin');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nom_categorie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom_categorie`) VALUES
(11, 'business'),
(12, 'developpement personnel'),
(13, 'design'),
(14, 'photographie'),
(15, 'marketing'),
(16, 'developpement web'),
(17, 'informatiques et logiciels'),
(21, 'developpement informatique');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `numero` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `nom`, `numero`, `pass`) VALUES
(1, 'ferdi', '96269025', 'ferdi'),
(3, 'parfait', '98617125', 'paf'),
(4, 'fabrice', '98524762', 'fab'),
(8, 'charles', '98821761', 'charlo'),
(16, 'mum', '90106759', 'mum'),
(18, 'momo', '99941081', 'momo'),
(20, 'dan', '98457812', 'dan'),
(27, 'ry', '45781236', 'ri'),
(33, 'beau', '585858', 'bg'),
(34, 'daniel', '99567845', 'daniel');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_commande` int(11) NOT NULL,
  `id_formationc` int(11) NOT NULL,
  `id_clientc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `id_formationc`, `id_clientc`) VALUES
(1, 46, 33),
(23, 31, 1),
(25, 30, 16),
(26, 42, 16),
(27, 50, 1),
(28, 51, 34);

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

CREATE TABLE `formation` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `categories` varchar(255) NOT NULL,
  `prix` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`id`, `titre`, `description`, `categories`, `prix`) VALUES
(30, 'Comment entreprendre', 'Decouvrez dans ce cours plein de boones choses pour votre developpement personnel et votre reussite\'.', 'developpement personnel', '10000'),
(31, 'Java Entreprise Edition', 'Developpez vos \' applications web avec le langage java ', 'developpement web', '50000'),
(32, 'laravel a votre portée', 'devenez un developpeur web tout simplement grace a laravel un framework php plaisant', 'developpement web', '4800'),
(33, 'Logiciel enginnova', 'Achetez maintenant ce cours pour beneficier et apprendre beaucoup plus sur le locgiciel enginnova', 'informatiques et logiciels', '10000'),
(34, 'Devenez business man', 'Cette formation vous apprend comment devenir business man ', 'business', '15000'),
(35, 'Business plan', 'Apprenez ce que c\'est qu\'un business plan avec enginnova', 'business', '2000'),
(36, 'Apprenez a vous connaitre', 'Apprenez beaucoup sur vous meme et ainsi s\'imissez dans le monde professionnel', 'developpement personnel', '66000'),
(37, 'Photoshop', 'Photoshop est un puissant logiciel reconnu de part le monde par sa qualité et ses  performances elle offre beaucoup de fonctionnalités et surtout un peu difficile a manipuler pour ceux qui souhaitent s\'y aventurer', 'photographie', '45000'),
(39, 'La  3d avec Blender', 'Devennez createur de toute piece 3d avec blender un logiciel puissant et gratuit', 'design', '45000'),
(40, 'Devenez designer', 'Un designer rien de mieux que votre passion? Alors vous etes au bon endroit c\'est la formation qu\'il vous faut.', 'design', '45000'),
(41, 'Le marketing sur le web', 'Et bien vous vous demandez surement comment cela se passe sur le web , la publicité et autre? vous etes au bon endroit', 'marketing', '15000'),
(42, 'Enginnova AddMobs', 'Devenez web marketeur grâce a la formation que propose enginnova', 'marketing', '5000'),
(43, 'HTML ,CSS ,PHP', 'le developpement web pour vous si vous etes debutent', 'developpement web', '5000'),
(45, 'Android', 'Devennez developpeur android grace a cette formation . Sont inclus plein d\'autres choses', 'informatiques et logiciels', '50000'),
(46, 'JavaScript', 'Commencez la programmation avec javascript', 'developpement informatique', '5000'),
(49, 'test', 'test', 'photographie', '45555'),
(50, 'Devenez programmeur', 'programmation', 'developpement informatique', '1200'),
(51, 'Devenez Hacker', 'Devenez un expert en securité informatique avec enginnova', 'informatiques et logiciels', '60000');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_formation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id`, `id_client`, `id_formation`) VALUES
(35, 16, 42),
(39, 16, 30),
(47, 1, 45),
(63, 1, 31),
(66, 1, 36),
(76, 34, 49),
(77, 34, 49),
(78, 34, 51);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commande`),
  ADD KEY `id_formationc` (`id_formationc`),
  ADD KEY `id_clientc` (`id_clientc`);

--
-- Index pour la table `formation`
--
ALTER TABLE `formation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_formation` (`id_formation`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `administrateur`
--
ALTER TABLE `administrateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `formation`
--
ALTER TABLE `formation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`id_formationc`) REFERENCES `formation` (`id`),
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`id_clientc`) REFERENCES `client` (`id`);

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `panier_ibfk_2` FOREIGN KEY (`id_formation`) REFERENCES `formation` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
