-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour e_tady
CREATE DATABASE IF NOT EXISTS `e_tady` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `e_tady`;

-- Listage de la structure de table e_tady. images
CREATE TABLE IF NOT EXISTS `images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `publication_id` int DEFAULT NULL,
  `path` text NOT NULL,
  `creation` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `publication_id` (`publication_id`),
  CONSTRAINT `images_ibfk_1` FOREIGN KEY (`publication_id`) REFERENCES `publications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Listage des données de la table e_tady.images : ~5 rows (environ)
INSERT INTO `images` (`id`, `publication_id`, `path`, `creation`) VALUES
	(1, NULL, '\\assets\\uploads\\1729711239_9d15b0116a71c804a8a2.jpg', '2024-10-20 16:00:55'),
	(4, NULL, '\\assets\\uploads\\1729492871_a01777d4834da4529596.png', '2024-10-21 06:40:23'),
	(6, 3, '\\assets\\uploads\\1729666002_4e514cac91103141c51b.jpg', '2024-10-23 06:46:42'),
	(7, 5, '\\assets\\uploads\\1729693438_9364c321c26c35b0543b.png', '2024-10-23 14:23:58'),
	(9, 7, '\\assets\\uploads\\1729694822_ea14f5bcdf42bd80ba9a.jpg', '2024-10-23 14:47:02'),
	(10, 9, '\\assets\\uploads\\1729711052_ec2e175f983b34c9bb22.jpg', '2024-10-23 19:17:32');

-- Listage de la structure de table e_tady. publications
CREATE TABLE IF NOT EXISTS `publications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `id_utilisateur` int NOT NULL,
  `date_creation` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `categorie` varchar(50) DEFAULT 'autre',
  PRIMARY KEY (`id`),
  KEY `id_utilisateur` (`id_utilisateur`),
  CONSTRAINT `publications_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Listage des données de la table e_tady.publications : ~4 rows (environ)
INSERT INTO `publications` (`id`, `titre`, `description`, `id_utilisateur`, `date_creation`, `categorie`) VALUES
	(3, 'Solomaso', 'Tsy hita tany soma', 2, '2024-10-23 06:46:42', 'vetements_accessoires'),
	(4, 'Bague perdue', '                                                                                            Un bague a été retrouvée à ... ce lundi à 17h, Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt velit impedit omnis enim voluptate fuga voluptatibus animi sequi architecto accusantium doloribus ab, aut suscipit expedita numquam quasi ea. Officiis, eum.Porro dolorem, nobis sequi ex dolore blanditiis quia eos. Autem a, labore expedita officia sed ipsa consectetur nihil eum dicta totam praesentium quis, libero doloribus dignissimos esse eius doloremque sunt?Ratione sit velit blanditiis molestiae labore? Saepe, quibusdam. Eligendi temporibus voluptate, voluptatibus molestiae doloribus fugiat, autem odit similique voluptas aspernatur quis adipisci inventore delectus quo quos nemo ducimus id nesciunt.Culpa deserunt nesciunt dolores ratione fugiat perspiciatis aliquam voluptates tenetur, alias, temporibus repellat harum at, voluptatum dolore! Iusto consequatur corrupti perferendis veniam vero quam aut? Sunt enim modi quidem pariatur.Veritatis omnis totam animi explicabo odit, aspernatur facilis cum doloribus facere modi eaque commodi, eius quo id cupiditate ipsa maxime nulla tempore, non iure perspiciatis minus ipsum natus. Cum, recusandae.                                                                                    ', 1, '2024-10-23 14:11:49', 'vetements_accessoires'),
	(5, 'Smartphone perdu', 'Monsmartphone de marque... du modèle... a été perdu dans les environs de... hier. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ducimus fuga saepe consequuntur dolorum at. Rem suscipit expedita repudiandae qui iure cupiditate vitae cumque. Commodi, itaque pariatur? Corrupti consectetur possimus iste.                        Corrupti esse minus, voluptatem, minima excepturi ab aut unde facilis natus numquam velit aliquid sapiente. Saepe incidunt amet quidem ducimus tempore vero vitae voluptatibus reiciendis, atque obcaecati modi, velit voluptatem.                        Quos quas quisquam consequatur provident, eius explicabo itaque veritatis, officia autem quod maiores eos cupiditate neque nulla quia, possimus unde voluptatibus dolore ullam! Placeat doloremque, possimus dolor labore mollitia temporibus.', 1, '2024-10-23 14:23:57', 'electronique'),
	(7, 'Marquage', 'Marquage atao test', 1, '2024-10-23 14:47:02', 'autre'),
	(9, 'Test final', 'Ceci est un test', 1, '2024-10-23 19:17:32', 'autre');

-- Listage de la structure de table e_tady. utilisateurs
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(60) NOT NULL,
  `telephone` int NOT NULL,
  `image_id` int NOT NULL,
  `created_ad` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `image_id` (`image_id`),
  CONSTRAINT `utilisateurs_ibfk_1` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Listage des données de la table e_tady.utilisateurs : ~0 rows (environ)
INSERT INTO `utilisateurs` (`id`, `username`, `password`, `email`, `telephone`, `image_id`, `created_ad`) VALUES
	(1, 'john doe', '$2y$10$JGX0jOaEcAhY2n6BStYE.uSTPdiicGk8jk7tq1vV.MUTiZZ9Dg0ZG', 'fanmetsoaina2@gmail.com', 348044274, 1, '2024-10-20 16:00:55'),
	(2, 'a', '$2y$10$cLBBgHKQLJUAapmFMj6mP.fX/J8wmiZLa.21P5CJxSoI1P4YPbkEy', 'a@gmail.com', 1111, 4, '2024-10-21 06:40:23');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
