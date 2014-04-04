-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Genereertijd: 04 apr 2014 om 14:12
-- Serverversie: 5.6.14
-- PHP-versie: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `web2`
--

--
-- Gegevens worden uitgevoerd voor tabel `address`
--

INSERT INTO `address` (`id`, `street`, `housenumber`, `city`, `zipcode`, `neighborhood`) VALUES
(24, 'Udenstraat', '5', 'Arnhem', '6844DS', 'De Laar West'),
(25, 'Bredestraat', '170', 'Nijmegen', '6543ZZ', '');

--
-- Gegevens worden uitgevoerd voor tabel `location`
--

INSERT INTO `location` (`id`, `address_id`, `description`, `price`, `menuitem_id`, `energyLabel`, `newbuild`, `area`, `yardarea`, `order_id`) VALUES
(9, 24, 'Mooi rijtjeshuis in de rustige wijk De Laar West', 16000000, 75, 'a', 1, 34, 13, 8),
(10, 25, 'Prachtige oude villa genaamt Sancta Maria in de rustige wijk Hees', 200000000, 75, 'a', 0, 0, 0, 8);

--
-- Gegevens worden uitgevoerd voor tabel `menuitem`
--

INSERT INTO `menuitem` (`id`, `tree_id`, `name`, `uri`) VALUES
(72, 135, 'Home', '/'),
(73, 136, 'Categorien', '/overzicht/producten/categorie=huizen/'),
(74, 137, 'Huizen', '/overzicht/producten/categorie=huizen/'),
(75, 138, 'Kamer', '/overzicht/bekijken/categorie=kamer/'),
(78, 134, 'Navigation', '/');

--
-- Gegevens worden uitgevoerd voor tabel `order`
--

INSERT INTO `order` (`id`, `user_id`, `completed`) VALUES
(1, 1, 0),
(2, 1, 0),
(3, 1, 0),
(4, 1, 0),
(5, 1, 0),
(6, 1, 0),
(7, 1, 0),
(8, 1, 0);

--
-- Gegevens worden uitgevoerd voor tabel `tree`
--

INSERT INTO `tree` (`id`, `lft`, `rgt`) VALUES
(134, 0, 9),
(135, 1, 2),
(136, 3, 8),
(137, 4, 7),
(138, 5, 6);

--
-- Gegevens worden uitgevoerd voor tabel `user`
--

INSERT INTO `user` (`id`, `name`, `passhash`, `salt`) VALUES
(1, 'Patrick', '', 'fdgsFtfRD45DSe#S%$ÃŽFGVHJVSsdfgd');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
