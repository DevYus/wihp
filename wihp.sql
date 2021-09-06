-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 06 sep. 2021 à 18:36
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `wihp`
--

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210902213904', '2021-09-02 21:40:05', 30),
('DoctrineMigrations\\Version20210903152113', '2021-09-03 15:21:34', 55);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649AA08CB10` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `lastname`, `firstname`, `password`, `email`, `login`, `roles`, `status`) VALUES
(1, 'John', 'Doe', '$2y$13$WpJmA2pNTj559IIAC9QMR.uz4AkaD9vuwOeCq1hjum4YyrDpqrlgO', 'johndoe@toto.com', 'admin', '[\"ROLE_SUPER_ADMIN\"]', 'valide'),
(2, 'Kayser', 'Eric', '$2y$13$pQnsr9HnQwsqjZ/7H9Z82ebSX/uPArp3E/BJp1Y9f41yAJoNRco4.', 'kayser.eric@toto.com', 'KEric', '[\"ROLE_ADMIN\"]', 'valide'),
(3, 'Diorr', 'christian', '$2y$13$dLzTf9xVJNKMz3DrMIzdb.X1e9AeOuRNgM.Q.NIw2JSEeuv386uiu', 'dior.christian@toto.com', 'CDior', '[\"ROLE_CUSTOMER\"]', 'valide'),
(4, 'Gotham', 'Batman', '$2y$13$VYFOKRtWGWOxD3aGDPrMdOUgyeSwwgE9p49h/k0TRcVyby4JaHbxq', 'gohtan.batman@toto.com', 'GBatman', '[\"ROLE_ADMIN\"]', 'en attente'),
(5, 'Sarkozy', 'Nicolas', '$2y$13$6BDRaJ3U9mbR9g5Ki0rFouqYgSen7iO/0qUyl4tabw6flwJppazga', 'sarkozy.nicolas@toto.com', 'NSarkozy', '[\"ROLE_CUSTOMER\"]', 'valide'),
(6, 'Mickey', 'Mouse', '$2y$13$095oEgoht5gTC5E0JrARFelseKOLzR0P0l/lCzUSIVbGUyvSnR.5W', 'mickey.mouse@toto.com', 'MMouse', '[\"ROLE_CUSTOMER\"]', 'valide'),
(7, 'Trump', 'Donald', '$2y$13$RQvjr8aSWPFA8gip83SFQORGStUYd..rDoh0O4GQbnKUErXI5GAx2', 'donald.trump@toto.com', 'DTrump', '[\"ROLE_CUSTOMER\"]', 'en attente'),
(8, 'Belmondo', 'Jean-Paul', '$2y$13$ek3rlO82u93hLciuNdONxuAKyaWxOMkwN0JbizAM7Ko.E9CAXuqXC', 'belmondo.jeanpaul@toto.com', 'JBelmondo', '[\"ROLE_ADMIN\"]', 'en attente');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
