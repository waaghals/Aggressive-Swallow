--Maak de database aan als die nog niet bestaat.
CREATE DATABASE IF NOT EXISTS `web2`;

--De volgende code maakt alle tabellen aan.
CREATE TABLE IF NOT EXISTS `web2`.`address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `street` varchar(255) NOT NULL,
  `housenumber` varchar(10) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zipcode` varchar(15) NOT NULL,
  `neighborhood` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

CREATE TABLE IF NOT EXISTS `web2`.`location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `menuitem_id` int(11) NOT NULL,
  `energyLabel` enum('a','b','c','d') NOT NULL,
  `newbuild` tinyint(1) NOT NULL,
  `area` int(11) NOT NULL,
  `yardarea` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `address_id` (`address_id`,`menuitem_id`),
  KEY `category` (`menuitem_id`),
  KEY `category_id` (`menuitem_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

CREATE TABLE IF NOT EXISTS `web2`.`menuitem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tree_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `uri` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tree_id` (`tree_id`),
  KEY `tree_id_2` (`tree_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=79 ;

CREATE TABLE IF NOT EXISTS `web2`.`order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `completed` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

CREATE TABLE IF NOT EXISTS `web2`.`tree` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=139 ;

CREATE TABLE IF NOT EXISTS `web2`.`user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `passhash` varchar(128) NOT NULL,
  `salt` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--Hier worden er foreign keys toegevoegt aan de net gemaakte tabellen.
ALTER TABLE `web2`.`location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`menuitem_id`) REFERENCES `menuitem` (`id`),
  ADD CONSTRAINT `location_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`);

ALTER TABLE `web2`.`menuitem`
  ADD CONSTRAINT `menuitem_ibfk_1` FOREIGN KEY (`tree_id`) REFERENCES `tree` (`id`);
SET FOREIGN_KEY_CHECKS=1;

--Vanaf hier worden de tabellen gevuld.
INSERT INTO `web2`.`tree` (`id`, `lft`, `rgt`) VALUES
(134, 0, 9),
(135, 1, 2),
(136, 3, 8),
(137, 4, 7),
(138, 5, 6);

INSERT INTO `web2`.`menuitem` (`id`, `tree_id`, `name`, `uri`) VALUES
(72, 135, 'Home', '/'),
(73, 136, 'Categorien', '/'),
(74, 137, 'Huizen', '/'),
(75, 138, 'Kamer', '/'),
(78, 134, 'Navigation', '/');

INSERT INTO `web2`.`address` (`id`, `street`, `housenumber`, `city`, `zipcode`, `neighborhood`) VALUES
(24, 'Udenstraat', '5', 'Arnhem', '6844DS', 'De Laar West'),
(25, 'Bredestraat', '170', 'Nijmegen', '6543ZZ', '');

INSERT INTO `web2`.`location` (`id`, `address_id`, `description`, `price`, `menuitem_id`, `energylabel`, `newbuild`, `area`, `yardarea`, `foto`) VALUES
(9, 24, 'Mooi rijtjeshuis in de rustige wijk De Laar West', 16000000, 75, 'a', 1, 34, 13, 'http://lonestarluxuryhomes.com/wp-content/uploads/2013/02/House-of-York-Luxury-Home.png'),
(10, 25, 'Prachtige oude villa genaamt Sancta Maria in de rustige wijk Hees', 200000000, 75, 'a', 0, 0, 0, 'http://upload.wikimedia.org/wikipedia/commons/0/00/Abbotsford_House_20100923.jpg');
