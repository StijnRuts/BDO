CREATE TABLE IF NOT EXISTS `clubs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
);
INSERT INTO `clubs` (`id`, `name`) VALUES
(0, ''),

CREATE TABLE IF NOT EXISTS `contestants` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `club_id` int(10) unsigned NOT NULL,
  `discipline_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `division_id` int(10) unsigned NOT NULL,
  `startnr` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `disciplines` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
);
INSERT INTO `disciplines` (`order`, `name`) VALUES
(0, 0, ''),
(1, 1, 'Gardedans Solo'),
(2, 2, 'Gardedans Paar'),
(3, 3, 'Gardedans Polka'),
(4, 4, 'Gardedans Mars'),
(5, 5, 'Gardedans met Tilfiguren'),
(6, 6, 'Showdans Solo'),
(7, 7, 'Showdans Duo'),
(8, 8, 'Showdans Karakter'),
(9, 9, 'Showdans Freestyle'),
(10, 10, 'Showdans Modern'),
(11, 11, 'Showdans met Tilfiguren');

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
);
INSERT INTO `categories` (`id`, `order`, `name`) VALUES
(0, 0, ''),
(1, 1, 'Miniklasse'),
(2, 2, 'Juniorenklasse'),
(3, 3, 'Jeugdklasse'),
(4, 4, 'Hoofdklasse');

CREATE TABLE IF NOT EXISTS `divisions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
);
INSERT INTO `divisions` (`id`, `order`, `name`) VALUES
(0, 0, ''),
(1, 1, '1e divisie'),
(2, 2, '2e divisie'),
(3, 3, 'Eredivisie');



CREATE TABLE IF NOT EXISTS `contests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `rounds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order` int(10) unsigned NOT NULL,
  `contest_id` int(10) unsigned NOT NULL,
  `discipline_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `division_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `rounds_contestants` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `round_id` int(10) unsigned NOT NULL,
  `contestant_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
);
