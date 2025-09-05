-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 05 sep. 2025 à 21:30
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pharmaa`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_cat` int NOT NULL AUTO_INCREMENT,
  `nom_cat` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  PRIMARY KEY (`id_cat`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_cat`, `nom_cat`) VALUES
(1, 'douleurs et fièvre '),
(2, 'Sommeil et détente'),
(3, 'Bouche et dents'),
(4, 'Compléments alimentaires'),
(5, 'Visage');

-- --------------------------------------------------------

--
-- Structure de la table `pharmacien`
--

DROP TABLE IF EXISTS `pharmacien`;
CREATE TABLE IF NOT EXISTS `pharmacien` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `prenom` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `adresse` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `num_tel` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `pharmacie_activé` int NOT NULL,
  `nom_pharmacie` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `longitude` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `latitude` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `état` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Déchargement des données de la table `pharmacien`
--

INSERT INTO `pharmacien` (`id`, `username`, `password`, `nom`, `prenom`, `adresse`, `email`, `num_tel`, `pharmacie_activé`, `nom_pharmacie`, `longitude`, `latitude`, `état`) VALUES
(1, 'belil', 'belil', 'lalaoui', 'belil', '3QHF+C7M, Rte de Bir Snab, Bordj Bou Arreridj 34000', 'belil@gmail.com', '035747474', 1, 'Pharmacie Belil', '36.07860758591724', '4.773167324762697', 'validé'),
(16, 'diae', 'diae', 'diae', 'ben salem', '3QMJ+8J2, Rte de Bir Snab, Bordj Bou Arreridj 34000', 'diae@gmail.com', '036984316', 0, 'Pharmacie Diae Bensalem', '36.08493054462716', '4.781164079205015', 'validé'),
(17, 'belhattab', 'belhattab', 'belhattab', 'l', '3PGQ+F5P, Bordj Bou Arreridj', 'belhattab@gmail.com', '035874524', 1, 'Pharmacie BELHATTAB .L', '36.077480825428495', '4.738551380253556', 'validé'),
(20, 'bma ', 'bma', 'Bma', 'medical', '3QJ7+QFR, Bordj Bou Arreridj', 'bma@gmail.com', '0663136522', 0, 'Bma medical', '36.082849608335216', '4.763826279233429', 'validé'),
(21, 'zitouni', 'zitouni', 'Zitouni', 'Hamza', '10 Rue Mebarkia Smail, Coucha', 'zitouni@gmail.com', '035748686', 1, 'Pharmacie Zitouni Hamza', '36.08101697405405', '4.762143044530179', 'validé'),
(22, 'omar', 'omar', 'LAMMARI', 'Omar', 'Rue Beldjoudi Mokhtar, Bordj Bou Arreridj', 'omar@gmail.com', '035727606', 1, 'Pharmacie LAMMARI Omar', '36.06755860937846', '4.772099404909903', 'validé'),
(25, 'lyes', 'lyes', 'Lyes', 'Ouarem', 'rue fa sup 19', 'Lyes@gmail.com', '1234567890', 1, 'Pharmacie Lyes', '36.07760758591724', '4.743167324762697', 'en attente'),
(31, 'assala', 'a', 'asala', 'asala', 'rue fa sup 19', 'mbckhali@yahoo.fr', '1234567890', 1, 'Pharmacie ASALA', '36.09260758591724', '4.331167324762697', 'en attente'),
(32, 'Rami', 'e', 'Rami', 'Mansoul', 'rue fa 24', 'Rami@gmail.com', '1111111111111', 1, 'Pharmacie Rami', '36.09960758591724', '4.319167324762697', 'en attente'),
(33, 'admin', '123', 'TT', 'TT', 'TT', 'ilyasebba6@gmail.com', '0552938346', 1, 'OUAREM', '44', '55', 'en attente');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id_prod` int NOT NULL AUTO_INCREMENT,
  `id_cat` int NOT NULL,
  `nom_prod` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `prix_prod` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `description_prod` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `img` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `type_prod` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `produit_activé` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_prod`),
  KEY `test6` (`id_cat`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_prod`, `id_cat`, `nom_prod`, `prix_prod`, `description_prod`, `img`, `type_prod`, `produit_activé`) VALUES
(1, 1, 'DAFALGAN 1000 mg', '320.00', 'Ce médicament contient du paracétamol : un antalgique (il calme la douleur) et un antipyrétique (il fait baisser la fièvre).\r\n\r\nIl est indiqué en cas de douleur et/ou fièvre telles que maux de tête, états grippaux, douleurs dentaires, courbatures, règles douloureuses.\r\nCette présentation est réservée à l\'adulte et à l\'enfant à partir de 50 kg (à partir d\'environ 15 ans) : lire attentivement la rubrique Posologie.\r\n\r\nPour les enfants ayant un poids différent, il existe d\'autres présentations de paracétamol : demandez conseil à votre médecin ou à votre pharmacien.\r\n\r\nVous devez vous adresser à votre médecin si vous ne ressentez aucune amélioration ou si vous vous sentez moins bien après 3 jours, en cas de fièvre ou 5 jours en cas de douleur.', 'dafalgan.jpg', 'Médicament', 0),
(2, 1, 'DOLIPRANE 1000 mg', '320.00', 'DOLIPRANE 1000 mg, comprimé contient du paracétamol. Le paracétamol est un antalgique (calme la douleur) et un antipyrétique (fait baisser la fièvre).\r\n\r\nCe médicament est indiqué chez l\'adulte et l\'enfant à partir de 50 kg (environ 15 ans) pour faire baisser la fièvre et/ou soulager les douleurs légères à modérées (par exemple : maux de tête, états grippaux, douleurs dentaires, courbatures, règles douloureuses, poussées douloureuses de l\'arthrose).\r\n\r\nLire attentivement le paragraphe « Posologie » de la rubrique 3.\r\n\r\nPour les enfants de moins de 50 kg, il existe d\'autres présentations de paracétamol : demandez conseil à votre médecin ou à votre pharmacien.', 'dolipran.jpg', 'Médicament', 0),
(3, 1, 'PARACETAMOL 1000 mg', '320.00', 'PARACETAMOL 1000 mg, comprimé sécable contient du paracétamol. Le paracétamol est un antalgique (calme la douleur) et un antipyrétique (fait baisser la fièvre).\r\n\r\nCe médicament est indiqué chez l\'adulte et l\'enfant à partir de 50 kg (environ 15 ans) pour faire baisser la fièvre et/ou soulager les douleurs légères à modérées (par exemple : maux de tête, états grippaux, douleurs dentaires, courbatures, règles douloureuses, poussées douloureuses de l\'arthrose).\r\n\r\nLire attentivement le paragraphe « Posologie » de la rubrique 3.\r\n\r\nPour les enfants de moins de 50 kg, il existe d\'autres présentations de paracétamol : demandez conseil à votre médecin ou à votre pharmacien.', 'paracetamol-mylan.jpg', 'Médicament', 1),
(4, 2, 'DONORMYL 15 mg', '415.00', 'Ce médicament est préconisé dans l’insomnie occasionnelle chez l’adulte.', 'donormyl.jpg', 'Médicament', 1),
(5, 2, 'SPASMINE', '1230.00', 'Médicament traditionnel à base de plantes utilisé pour soulager les symptômes légers du stress et favoriser le sommeil chez les adultes et les adolescents de plus de 12 ans.Son usage est réservé aux indications spécifiées sur la base exclusive de l’ancienneté de l’usage.Vous devez vous adresser à votre médecin si vous ne ressentez aucune amélioration ou si vous vous sentez moins bien après 14 jours d’utilisation.', 'spasmine.jpeg', 'Médicament', 1),
(6, 2, 'ZENALIA', '892.00', 'ZÉNALIA, comprimé sublingual est un médicament homéopathique traditionnellement utilisé en cas de trac, d’appréhension, d’anxiété (tremblements, diarrhée, sommeil agité, palpitations émotionnelles).', 'zenalia.jpg', 'Médicament', 1),
(7, 3, 'ARTHRODONT 1%', '740.00', 'Ce médicament est préconisé pour soulager les douleurs dues à certaines maladies des gencives et aux blessures par prothèse.', 'arthrodont.jpg', 'Médicament', 1),
(8, 3, 'ELUDRILPRO', '1400.00', 'Ce médicament est une association de 2 antiseptiques (le digluconate de chlorhexidine et le chlorobutanol hémihydraté) qui agit en luttant contre les bactéries présentes sur les dents (plaque dentaire) et dans la bouche.\r\n\r\nEn limitant le développement de la plaque bactérienne, il permet aussi de réduire l\'inflammation gingivale.\r\n\r\nCe médicament est utilisé comme traitement local d\'appoint des infections de la bouche (gingivites, légers saignements) ainsi que lors de soins post-opératoires en odontostomatologie.\r\n\r\nCette situation se produit :\r\n\r\n· si vous souffrez d\'une pathologie buccale,\r\n\r\n· après une opération bucco-dentaire.\r\n\r\nCe médicament est réservé aux adultes et enfants de plus de 6 ans.\r\n\r\nVous devez vous adresser à votre médecin si vous ne ressentez aucune amélioration ou si vous vous sentez moins bien après 5 jours.', 'eludrilpro.png', 'Médicament', 1),
(9, 3, 'PANSORAL', '965,00', 'Ce médicament est préconisé pour le traitement d\'appoint de courte durée des douleurs liées aux états inflammatoires et ulcéreux de la muqueuse buccale (petites blessures buccales) chez l\'adulte.\r\n\r\nVous devez vous adresser à votre médecin si vous ne ressentez aucune amélioration ou si vous vous sentez moins bien', 'pansoral.jpeg', 'Médicament ', 1),
(10, 4, 'Aurantea Vitamines', '2434.00', 'Contribue au fonctionnement normal du système immunitaire et à la réduction de la fatigue.', 'aurantea.jpg', 'Biopharma', 1),
(11, 4, 'Cyalea Draineur', '2441.00', 'Concentré de plantes aux 5 actions : minceur (artichaut), élimination (pissenlit), détoxification (artichaut et pissenlit), digestion (genévrier) et circulation (vigne rouge).', 'cyalea.jpg', 'Biopharma', 1),
(12, 4, 'Favea Mémoire', '2526.00', 'Contribue au bon fonctionnement du système nerveux, de la mémoire. Aide à l’apprentissage, la concentration et favorise la résistance au stress et à la fatigue', 'favea.jpg', 'Biopharma', 1);

-- --------------------------------------------------------

--
-- Structure de la table `produit_dans_pharmacie`
--

DROP TABLE IF EXISTS `produit_dans_pharmacie`;
CREATE TABLE IF NOT EXISTS `produit_dans_pharmacie` (
  `id_produit_dans_pharm` int NOT NULL AUTO_INCREMENT,
  `id` int NOT NULL,
  `id_prod` int NOT NULL,
  `quantite` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  PRIMARY KEY (`id_produit_dans_pharm`),
  KEY `test4` (`id`),
  KEY `test5` (`id_prod`)
) ENGINE=InnoDB AUTO_INCREMENT=185 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Déchargement des données de la table `produit_dans_pharmacie`
--

INSERT INTO `produit_dans_pharmacie` (`id_produit_dans_pharm`, `id`, `id_prod`, `quantite`) VALUES
(81, 16, 1, '34'),
(82, 16, 2, '44'),
(83, 16, 3, '78'),
(84, 16, 4, '0'),
(85, 16, 5, '0'),
(86, 16, 6, '765'),
(87, 16, 7, '8'),
(88, 16, 8, '9'),
(89, 16, 9, '0'),
(90, 16, 10, '7'),
(91, 16, 11, '0'),
(92, 16, 12, '6'),
(93, 17, 1, '56'),
(94, 17, 2, '7'),
(95, 17, 3, '55'),
(96, 17, 4, '77'),
(97, 17, 5, '9'),
(98, 17, 6, '0'),
(99, 17, 7, '7'),
(100, 17, 8, '3'),
(101, 17, 9, '2'),
(102, 17, 10, '9'),
(103, 17, 11, '0'),
(104, 17, 12, '45'),
(105, 20, 1, '67'),
(106, 20, 2, '77'),
(107, 20, 3, '6'),
(108, 20, 4, '6'),
(109, 20, 5, '4'),
(110, 20, 6, '3'),
(111, 20, 7, '0'),
(112, 20, 8, '9'),
(113, 20, 9, '0'),
(114, 20, 10, '0'),
(115, 20, 11, '0'),
(116, 20, 12, '0'),
(117, 21, 1, '56'),
(118, 21, 2, '56'),
(119, 21, 3, '56'),
(120, 21, 4, '4'),
(121, 21, 5, '3'),
(122, 21, 6, '2'),
(123, 21, 7, '0'),
(124, 21, 8, '0'),
(125, 21, 9, '0'),
(126, 21, 10, '0'),
(127, 21, 11, '8'),
(128, 21, 12, '6'),
(129, 22, 1, '0'),
(130, 22, 2, '87'),
(131, 22, 3, '0'),
(132, 22, 4, '0'),
(133, 22, 5, '98'),
(134, 22, 6, '0'),
(135, 22, 7, '87'),
(136, 22, 8, '4'),
(137, 22, 9, '0'),
(138, 22, 10, '75'),
(139, 22, 11, '3'),
(140, 22, 12, '6'),
(174, 1, 1, '1'),
(175, 1, 3, '12'),
(176, 1, 4, '2'),
(177, 1, 5, '2'),
(178, 1, 6, '22'),
(179, 1, 7, '2'),
(180, 1, 8, '2'),
(181, 1, 9, '2'),
(182, 1, 10, '2'),
(183, 1, 11, '0'),
(184, 1, 12, '2');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `test6` FOREIGN KEY (`id_cat`) REFERENCES `categorie` (`id_cat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `produit_dans_pharmacie`
--
ALTER TABLE `produit_dans_pharmacie`
  ADD CONSTRAINT `test4` FOREIGN KEY (`id`) REFERENCES `pharmacien` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `test5` FOREIGN KEY (`id_prod`) REFERENCES `produit` (`id_prod`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
