-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 11 juil. 2024 à 16:02
-- Version du serveur : 8.0.30
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mydb`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` smallint UNSIGNED NOT NULL,
  `content` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `moderate` tinyint(1) NOT NULL,
  `userId` tinyint UNSIGNED NOT NULL,
  `postId` smallint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `content`, `created`, `modified`, `moderate`, `userId`, `postId`) VALUES
(1, 'super site', '2024-04-15 09:32:47', NULL, 1, 4, 2),
(4, 'n\'y a t\'il pas un probleme ici?', '2024-04-26 09:31:33', '2024-04-26 09:31:33', 1, 4, 15),
(5, 'il faut peut etre le supprimer?', '2024-04-26 09:54:05', '2024-04-26 09:54:05', 1, 4, 15),
(6, 'Il faudrait sans doute modifier cet article', '2024-05-10 09:58:27', '2024-05-10 09:58:27', 1, 4, 15),
(7, 'Si j&#39;ajoute un commentaire', '2024-06-24 10:42:10', '2024-06-24 10:42:10', 1, 7, 15),
(9, 'article à supprimer', '2024-06-24 15:19:35', '2024-06-24 15:19:35', 1, 7, 24),
(10, 'Je crois qu\'il y a un problème sur cet article', '2024-06-26 09:31:37', '2024-06-26 09:31:37', 0, 4, 24),
(12, 'Super site', '2024-06-26 09:32:23', '2024-06-26 09:32:23', 1, 4, 14),
(13, 'Cet article est en doublon', '2024-06-26 09:33:14', '2024-06-26 09:33:14', 1, 7, 12),
(14, 'Hâte d\'aller au festival', '2024-06-26 09:37:41', '2024-06-26 09:37:41', 1, 7, 4);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `id` smallint UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `chapo` varchar(255) DEFAULT NULL,
  `content` varchar(1000) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `userId` tinyint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `title`, `slug`, `chapo`, `content`, `created`, `modified`, `userId`) VALUES
(2, 'Site Wordpress Chalets & Caviar', 'site-wordpress_chalets-caviar', 'Découvrez notre dernier projet de développement WordPress', 'Plongez dans l\'univers de nos projets de développement WordPress. Explorez nos dernières réalisations, notamment notre projet phare, Chalet et Caviar. Découvrez comment nous avons créé une expérience en ligne immersive pour cette agence de luxe, alliant élégance et fonctionnalité pour mettre en valeur leur collection exclusive de chalets de montagne.', '2024-03-01 13:38:28', '2024-03-01 13:38:28', 7),
(4, 'Festival de films en plein air', 'festival-de-films-en-plein-air', 'Découvrez comment notre expertise en HTML et CSS a permis de créer un site web immersif, offrant une expérience cinématographique unique à notre public', 'Notre site web dédié au festival de films en plein air offre une expérience immersive conçue pour captiver les passionnés de cinéma. Doté d&#39;un design élégant et convivial, notre plateforme permet aux visiteurs de découvrir facilement la programmation, les horaires des projections et les détails sur les films présentés. Grâce à notre expertise en HTML et CSS, nous avons créé une interface intuitive qui offre une navigation fluide sur tous les appareils, que ce soit sur ordinateur, tablette ou smartphone.', '2024-03-15 14:15:38', '2024-04-12 11:19:26', 7),
(11, 'Savourer la Simplicité: Concevoir une Base de Données pour l\'Application Expressfood', 'application-expressfood-base-donnees', 'Explorez les coulisses de l\'application Expressfood et découvrez comment notre expertise en conception de base de données a permis de créer une plateforme fluide pour la livraison de plats et la gestion des stocks.', 'Notre base de données pour l\'application Expressfood est le fondement sur lequel repose toute l\'efficacité et la fluidité de notre service de livraison de plats. Conçue avec précision pour répondre aux exigences dynamiques d\'une entreprise de restauration en constante évolution, notre base de données offre une architecture robuste et évolutive. Elle permet une gestion efficace des stocks, assurant que les produits sont toujours disponibles pour répondre à la demande des clients. Grâce à une conception optimisée, notre base de données garantit des temps de chargement rapides et une navigation fluide à travers l\'application, offrant ainsi une expérience utilisateur optimale. Avec notre base de données à la pointe de la technologie, Expressfood offre une expérience de commande et de livraison de repas simple, rapide et fiable pour satisfaire les appétits les plus exigeants.', '2024-03-18 10:48:46', '2024-03-21 14:45:46', 7),
(12, 'Savourer la Simplicité: Concevoir une Base de Données pour l&#39;Application Expressfood', 'savourer-la-simplicite-concevoir-une-base-de-donnees-pour-l-39-application-expressfood', 'Explorez les coulisses de l&#39;application Expressfood et découvrez comment notre expertise en conception de base de données a permis de créer une plateforme fluide pour la livraison de plats et la gestion des stocks.', 'Notre base de données pour l&#39;application Expressfood est le fondement sur lequel repose toute l&#39;efficacité et la fluidité de notre service de livraison de plats. Conçue avec précision pour répondre aux exigences dynamiques d&#39;une entreprise de restauration en constante évolution, notre base de données offre une architecture robuste et évolutive. Elle permet une gestion efficace des stocks, assurant que les produits sont toujours disponibles pour répondre à la demande des clients. Grâce à une conception optimisée, notre base de données garantit des temps de chargement rapides et une navigation fluide à travers l&#39;application, offrant ainsi une expérience utilisateur optimale. Avec notre base de données à la pointe de la technologie, Expressfood offre une expérience de commande et de livraison de repas simple, rapide et fiable pour satisfaire les appétits les plus exigeants.', '2024-03-18 10:48:46', '2024-04-12 11:32:27', 7),
(14, 'Site Blog PHP', 'site-blog-php', 'Site qui recense l&#39;ensemble des projets créés dans le cadre de la formation de développeur PHP Symfony', 'Ce projet est représenter sur notre super blog', '2024-03-29 09:45:04', '2024-05-10 17:44:59', 7),
(15, 'Ceci est un Article ', 'ceci-est-un-article', 'Ceci est le Chapo de l\'article', 'Voici le contenu de l\'article', '2024-03-29 09:52:34', '2024-06-24 11:23:31', 7),
(24, 'ceci est un test', 'ceci-est-un-test', 'juste pour pouvoir le supprimer', 'tadam ', '2024-06-24 15:18:46', '2024-07-11 17:51:39', 7);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` tinyint UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('member','admin') DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `first_name`, `last_name`, `password`, `role`, `created`, `modified`) VALUES
(4, 'gestionappartsp@gmail.com', 'Marie', 'Dubois', '$2y$10$K0lsYvoJPZcBvkvvphLrPOzPXA3ZbOpimAMCHtqU9U7H51U8iSnxe', 'member', '0000-00-00 00:00:00', NULL),
(7, 'spadacinisandra@gmail.com', 'Sandra', 'Spadacini', '$2y$10$j2E2vqcUTMqArNPmZaqDoeKX7T7DlMHxHtu6IZLUAnSVNbV.0eIs.', 'admin', '2024-05-07 14:31:30', NULL),
(8, 'spadacinipatrick@gmail.com', 'PATRICK', 'SPADACINI', '$2y$10$14Hkki332Pd3msDmVA6A6.wSQKcR2KFan0cxJKLqneXX9EBZAPenm', 'member', '2024-07-01 16:40:24', NULL),
(12, 'mathieu.loisy@gmail.com', 'Mathieu', 'Loisy', '$2y$10$OTBHN9w0UNrjf3BQiqYXWelZGPRmWOUonW.JWWLLe1iTXwzsI5/ki', 'member', '2024-07-03 09:17:54', NULL),
(13, 'admin@mail.com', 'Admin', 'ADMIN', '$2y$10$smOJg8AjFISuo2jLEon.LuqF/cwDi8//rBujkUDULcNi0LY3ongvO', 'member', '2024-07-11 17:53:53', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`,`userId`,`postId`),
  ADD UNIQUE KEY `idComment_UNIQUE` (`id`),
  ADD KEY `fk_comment_user_idx` (`userId`),
  ADD KEY `fk_comment_post1_idx` (`postId`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`,`userId`),
  ADD UNIQUE KEY `idPost_UNIQUE` (`id`),
  ADD KEY `fk_post_user1_idx` (`userId`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idUser_UNIQUE` (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` smallint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id` smallint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_comment_post1` FOREIGN KEY (`postId`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_comment_user` FOREIGN KEY (`userId`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk_post_user1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
