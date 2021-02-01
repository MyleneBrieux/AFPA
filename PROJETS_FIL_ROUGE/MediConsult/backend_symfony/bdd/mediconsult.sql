-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 01 fév. 2021 à 09:47
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mediconsult`
--

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210131135755', '2021-01-31 15:00:22', 792),
('DoctrineMigrations\\Version20210131141549', '2021-01-31 15:15:58', 3201),
('DoctrineMigrations\\Version20210131160316', '2021-01-31 17:03:31', 1067),
('DoctrineMigrations\\Version20210131204402', '2021-01-31 21:44:14', 1240);

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`id`, `nom`, `prenom`, `age`, `email`, `roles`, `password`) VALUES
(12, 'BRIEUX', 'Mylène', 28, 'mylene.brieux@gmail.com', '[\"ROLE_USER\"]', '$argon2i$v=19$m=65536,t=4,p=1$b2FIaEhaa3UwaUh1QmcxUQ$6cy2fsFj+xfK89ybUjeL5kwHlWCC7/DTLiz0bod/fSY'),
(13, 'OLIVIER', 'Doniphan', 27, 'doniphan.olivier@gmail.com', '[\"ROLE_USER\"]', '$argon2i$v=19$m=65536,t=4,p=1$NDlXT2pRRTZsYkgvb2pwbA$RQoFx3S5A8sS9thrK/YggVITUcRz04lLUaWAFU/jSL4'),
(14, 'BRIEUX', 'Véronique', 56, 'v.brieux@gmail.com', '[\"ROLE_USER\"]', '$argon2i$v=19$m=65536,t=4,p=1$TE9wSHdlQVZTc2RvL2ZhOA$xADcTg0NOMGOs9QXiqd04dGQ/2UW9xUuq0MJ3arAP68'),
(15, 'BRIEUX', 'Marc', 59, 'm.brieux@gmail.com', '[\"ROLE_USER\"]', '$argon2i$v=19$m=65536,t=4,p=1$UlljSXlqTTR3U2Y5UUR6Mg$zoAKd3CYo9a36aVcfCXNC1icxXmbl5crNoLEEyu6xIk'),
(16, 'BRIEUX', 'Yoann', 32, 'yoann.brieux@gmail.com', '[\"ROLE_USER\"]', '$argon2i$v=19$m=65536,t=4,p=1$M0pJV0VhQS9aQ0FlTVpLaA$7CrPIHusWBRHdl3jKw/JcHoyAWvQqV7gH1pLyoiY9/s'),
(17, 'BRIEUX', 'Aurélie', 31, 'aurelie.brieux@gmail.com', '[\"ROLE_USER\"]', '$argon2i$v=19$m=65536,t=4,p=1$VkI4cFVqOHZqd3FKSDBzdg$MxK5hikixMt7SXAWmhO4me61PL1ImwuQ4juoIdUOLBA');

-- --------------------------------------------------------

--
-- Structure de la table `rendez_vous`
--

CREATE TABLE `rendez_vous` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `horaire` time NOT NULL,
  `specialiste_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `rendez_vous`
--

INSERT INTO `rendez_vous` (`id`, `date`, `horaire`, `specialiste_id`, `patient_id`) VALUES
(3, '2021-02-02', '16:45:00', 5, 12),
(4, '2021-01-14', '14:30:00', 5, 13),
(5, '2021-02-01', '18:30:00', 6, 14),
(6, '2021-02-01', '18:45:00', 6, 15),
(7, '2021-02-10', '19:00:00', 6, 16),
(8, '2021-02-10', '18:45:00', 6, 17),
(9, '2021-01-15', '18:45:00', 7, 12),
(10, '2021-03-01', '18:20:00', 8, 12);

-- --------------------------------------------------------

--
-- Structure de la table `specialiste`
--

CREATE TABLE `specialiste` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specialite` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `specialiste`
--

INSERT INTO `specialiste` (`id`, `nom`, `prenom`, `adresse`, `specialite`, `email`, `roles`, `password`) VALUES
(5, 'BALLOIS', 'Fanny', '4 avenue Jussieu 59170 CROIX', 'Médecin généraliste', 'fanny.ballois@gmail.com', '[\"ROLE_USER\"]', '$argon2i$v=19$m=65536,t=4,p=1$cGpoaGtEL09qd0dhTm1tbA$XQjjoonPE6oEvwY2sjl7CNk6tXKI1wILahnTISoAIao'),
(6, 'SEMAILLE', 'Eric', '20 zac de la Brasserie Espagnole 59194 RÂCHES', 'Médecin généraliste', 'eric.semaille@gmail.com', '[\"ROLE_USER\"]', '$argon2i$v=19$m=65536,t=4,p=1$eXFPbWZQODNNUU5jWlhsUA$muCiS2QAdjBv6BEvnBGwieFxnqgb3boBnUWkeOWINBc'),
(7, 'LANDY', 'Pauline', '11 rue Ghesquière 59170 CROIX', 'Infirmier', 'pauline.landy@gmail.com', '[\"ROLE_USER\"]', '$argon2i$v=19$m=65536,t=4,p=1$ekZhd3p2R1JFVHpGaXVJUQ$B/7ArddNnoqOFF6EjRIv5699scDPg6w0QXdWCHaMOeE'),
(8, 'CARPENTIER', 'Olivier', '11 boulevard Lacordaire 59100 ROUBAIX', 'Dermatologue', 'olivier.carpentier@gmail.com', '[\"ROLE_USER\"]', '$argon2i$v=19$m=65536,t=4,p=1$Rm1YTXcvdGo1WEhFbUU2eQ$UEr9rkzU2p8Khdr39hY+pFq2y+68eKoZ4d/va2tMnLI'),
(9, 'BALLOIS', 'Fanny', '4 avenue Jussieu 59170 CROIX', 'Médecin généraliste', 'fanny.ballois@gmail.com', '[\"ROLE_USER\"]', '$argon2i$v=19$m=65536,t=4,p=1$QUhOR3lnYXRtQUllcWtGZw$TN89gcBY9l4uSiOPrgzN73AyiSH7n+fyoqo9ggxL7I8'),
(10, 'LANDY', 'Pauline', '11 rue Ghesquière 59170 CROIX', 'Infirmier', 'pauline.landy@gmail.com', '[\"ROLE_USER\"]', '$argon2i$v=19$m=65536,t=4,p=1$VndBajAvWjdmVkNwU29XQw$g4G3EikIeuO2Zmx2RqgB0XYn/i0i9nuPfDx8wT/N+Hs'),
(11, 'SEMAILLE', 'Eric', '20 zac de la Brasserie Espagnole 59194 RÂCHES', 'Médecin généraliste', 'eric.semaille@gmail.com', '[\"ROLE_USER\"]', '$argon2i$v=19$m=65536,t=4,p=1$S3dVbnI0TGRJU0RlZzRuWQ$Bjjg+jbK+oKSoH8xjwYjLXH4TQe42AuJaW/ssmW4XZk'),
(12, 'CARPENTIER', 'Olivier', '11 boulevard Lacordaire 59100 ROUBAIX', 'Dermatologue', 'olivier.carpentier@gmail.com', '[\"ROLE_USER\"]', '$argon2i$v=19$m=65536,t=4,p=1$L2hvcXgxUnJsUi9ONTRJRw$sUu2UB3/9AAoJtsUFbaRI8WLjnm5yrsSARtbVvuG+Ss');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_65E8AA0A6F1A5C10` (`specialiste_id`),
  ADD KEY `IDX_65E8AA0A6B899279` (`patient_id`);

--
-- Index pour la table `specialiste`
--
ALTER TABLE `specialiste`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `specialiste`
--
ALTER TABLE `specialiste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  ADD CONSTRAINT `FK_65E8AA0A6B899279` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`),
  ADD CONSTRAINT `FK_65E8AA0A6F1A5C10` FOREIGN KEY (`specialiste_id`) REFERENCES `specialiste` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
