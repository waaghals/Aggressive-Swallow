
-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Genereertijd: 25 mrt 2014 om 17:35
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

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `street` varchar(255) NOT NULL,
  `housenumber` varchar(10) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zipcode` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Tabel leegmaken voor invoegen `address`
--

TRUNCATE TABLE `address`;
--
-- Gegevens worden uitgevoerd voor tabel `address`
--

INSERT INTO `address` (`id`, `street`, `housenumber`, `city`, `zipcode`) VALUES
(17, 'Street', '13a', 'Nijmegen', '6543ZZ'),
(18, 'Street', '13b', 'Nijmegen', '6543ZZ'),
(19, 'Street', '13b', 'Nijmegen', '6543ZZ'),
(20, 'Street', '13b', 'Nijmegen', '6543ZZ'),
(21, 'Street', '13b', 'Nijmegen', '6543ZZ'),
(22, 'Street', '13b', 'Nijmegen', '6543ZZ'),
(23, 'Street', '13b', 'Nijmegen', '6543ZZ');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Tabel leegmaken voor invoegen `category`
--

TRUNCATE TABLE `category`;
--
-- Gegevens worden uitgevoerd voor tabel `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(10, 'Blaat'),
(1, 'FamilyHouse'),
(7, 'Garage'),
(8, 'ParkingSpace'),
(6, 'Room'),
(11, 'Test');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `address_id` (`address_id`,`category_id`),
  KEY `category` (`category_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Tabel leegmaken voor invoegen `location`
--

TRUNCATE TABLE `location`;
--
-- Gegevens worden uitgevoerd voor tabel `location`
--

INSERT INTO `location` (`id`, `address_id`, `description`, `price`, `category_id`) VALUES
(2, 17, 'Other House', 2435, 1),
(4, 19, 'Other House', 2435, 6),
(5, 20, 'Other House', 2435, 7),
(6, 21, 'Other House', 2435, 8),
(7, 22, 'Other House', 2435, 10),
(8, 23, 'Other House', 2435, 11);

--
-- Beperkingen voor gedumpte tabellen
--

--
-- Beperkingen voor tabel `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
