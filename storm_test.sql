-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `name_cz` varchar(64) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `counter` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `products` (`id`, `name`, `name_cz`, `counter`) VALUES
(1,	'laptop',	'noťas',	4),
(2,	'computer',	'pocitac',	75),
(3,	'mobile phone',	'mobil',	45);

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `counter` int NOT NULL,
  `fk_product` int DEFAULT NULL,
  `uuid` tinytext COLLATE utf8_czech_ci,
  PRIMARY KEY (`id`),
  KEY `products.id` (`fk_product`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`fk_product`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `users` (`id`, `name`, `counter`, `fk_product`, `uuid`) VALUES
(1,	'Petr',	75,	1,	NULL),
(3,	'Jan',	15,	3,	NULL),
(4,	'Petr',	45,	NULL,	NULL),
(5,	'Jan',	78,	NULL,	NULL),
(6,	'Petr',	78,	NULL,	NULL),
(7,	'Karel',	0,	NULL,	NULL),
(8,	'Karel',	0,	NULL,	NULL),
(9,	'Karel',	0,	NULL,	NULL),
(10,	'Karel',	0,	NULL,	NULL),
(11,	'Karel',	45,	NULL,	NULL),
(12,	'Karel',	45,	NULL,	NULL),
(13,	'Karel',	45,	NULL,	NULL),
(14,	'Karel',	4,	NULL,	NULL),
(15,	'Karel',	45,	NULL,	NULL),
(16,	'Karel',	45,	NULL,	NULL),
(17,	'Karel',	5,	NULL,	NULL),
(18,	'Karel',	45,	NULL,	NULL);

DROP TABLE IF EXISTS `users_nxn_products`;
CREATE TABLE `users_nxn_products` (
  `fk_product` int NOT NULL,
  `fk_user` int NOT NULL,
  `param` tinytext COLLATE utf8_czech_ci NOT NULL,
  KEY `id_product` (`fk_product`),
  KEY `id_user` (`fk_user`),
  CONSTRAINT `users_nxn_products_ibfk_1` FOREIGN KEY (`fk_product`) REFERENCES `products` (`id`),
  CONSTRAINT `users_nxn_products_ibfk_2` FOREIGN KEY (`fk_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `users_nxn_products` (`fk_product`, `fk_user`, `param`) VALUES
(1,	1,	''),
(2,	1,	''),
(1,	1,	''),
(2,	1,	''),
(1,	1,	''),
(2,	1,	'');

-- 2020-10-14 16:39:14
