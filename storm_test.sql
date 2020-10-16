-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1:3306
-- Vytvořeno: Pát 16. říj 2020, 09:54
-- Verze serveru: 5.7.31
-- Verze PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `storm_test`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `pages_page`
--

DROP TABLE IF EXISTS `pages_page`;
CREATE TABLE IF NOT EXISTS `pages_page` (
  `uuid` varchar(32) COLLATE utf8_czech_ci NOT NULL,
  `url_en` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'Page url',
  `url_cz` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'Page url',
  `type` varchar(255) COLLATE utf8_czech_ci NOT NULL COMMENT 'Page type',
  `isOffline` tinyint(1) NOT NULL DEFAULT '0',
  `params` varchar(512) COLLATE utf8_czech_ci NOT NULL COMMENT 'Parameters in name1=value1&name2=value2',
  `title_en` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'Title',
  `title_cz` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'Title',
  `description_en` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'Description',
  `description_cz` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'Description',
  `robots` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'Robots',
  `canonicalUrl_en` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'Rel canonical',
  `canonicalUrl_cz` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'Rel canonical',
  `fk_sitemap` varchar(32) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`uuid`),
  KEY `pages_page_sitemap` (`fk_sitemap`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `pages_page`
--

INSERT INTO `pages_page` (`uuid`, `url_en`, `url_cz`, `type`, `isOffline`, `params`, `title_en`, `title_cz`, `description_en`, `description_cz`, `robots`, `canonicalUrl_en`, `canonicalUrl_cz`, `fk_sitemap`) VALUES
('5f883763ce13c70643346574', 'testing-url', 'testovaci-url', 'productDetail', 0, 'product=uuid&', 'Test en', 'Test cz', NULL, NULL, NULL, NULL, NULL, '5f883763cd34a77471881559'),
('5f8850de775c274298244653', 'product-limit-1', 'produkt-limit-1', 'productDetail', 0, 'counter=1&product=uuid&', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5f883763cd34a77471881559'),
('5f89501edb3b253778214255', 'products', 'produkty', 'productsList', 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5f883763cd34a77471881559'),
('5f895c094282070290624919', 'products-3', 'produkty-3', 'productsList', 0, 'onPage=3&', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5f883763cd34a77471881559'),
('5f8968b5585e710607428217', 'products-3', 'produkty-3', 'productsList', 0, 'onePage=3&', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5f883763cd34a77471881559');

-- --------------------------------------------------------

--
-- Struktura tabulky `pages_redirect`
--

DROP TABLE IF EXISTS `pages_redirect`;
CREATE TABLE IF NOT EXISTS `pages_redirect` (
  `uuid` varchar(32) COLLATE utf8_czech_ci NOT NULL,
  `fromUrl` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `fromMutation` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `toUrl` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `toMutation` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `priority` int(11) NOT NULL,
  `createdTs` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `pages_sitemap`
--

DROP TABLE IF EXISTS `pages_sitemap`;
CREATE TABLE IF NOT EXISTS `pages_sitemap` (
  `uuid` varchar(32) COLLATE utf8_czech_ci NOT NULL,
  `lastmod` date NOT NULL,
  `changefreq` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `priority` double NOT NULL,
  PRIMARY KEY (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `pages_sitemap`
--

INSERT INTO `pages_sitemap` (`uuid`, `lastmod`, `changefreq`, `priority`) VALUES
('5f883763cd34a77471881559', '2020-10-15', 'monthly', 0.5);

-- --------------------------------------------------------

--
-- Struktura tabulky `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `uuid` varchar(32) COLLATE utf8_czech_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `name_cz` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `counter` int(11) DEFAULT NULL,
  PRIMARY KEY (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `products`
--

INSERT INTO `products` (`uuid`, `name_en`, `name_cz`, `counter`) VALUES
('5f883b39496eb86384560925', 'table', 'stul', 0),
('5f883c231002b52793364517', 'doors', 'dvere', 0),
('5f89541019c2115467162039', 'pen', 'propiska', 100),
('5f895ab44835a77300306584', 'chair', 'židle', 10),
('5f895ab44838866440513441', 'charger', 'nabijecka', 2);

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `uuid` varchar(32) COLLATE utf8_czech_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `counter` int(11) DEFAULT NULL,
  `counter2` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `fk_product` varchar(32) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `users_nxn_products`
--

DROP TABLE IF EXISTS `users_nxn_products`;
CREATE TABLE IF NOT EXISTS `users_nxn_products` (
  `fk_user` varchar(32) COLLATE utf8_czech_ci NOT NULL,
  `fk_product` varchar(32) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`fk_user`,`fk_product`),
  KEY `users_nxn_products_fk_user` (`fk_user`),
  KEY `users_nxn_products_fk_product` (`fk_product`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `pages_page`
--
ALTER TABLE `pages_page`
  ADD CONSTRAINT `pages_page_sitemap` FOREIGN KEY (`fk_sitemap`) REFERENCES `pages_sitemap` (`uuid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Omezení pro tabulku `users_nxn_products`
--
ALTER TABLE `users_nxn_products`
  ADD CONSTRAINT `users_nxn_products_source` FOREIGN KEY (`fk_user`) REFERENCES `users` (`uuid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_nxn_products_target` FOREIGN KEY (`fk_product`) REFERENCES `products` (`uuid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
