CREATE TABLE `cake_sessions` (
  `id` varchar(255) NOT NULL,
  `data` text,
  `expires` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
);


CREATE TABLE IF NOT EXISTS `clubs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
);
INSERT INTO `clubs` (`id`, `name`) VALUES
(1, '');

CREATE TABLE IF NOT EXISTS `contestants` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `club_id` int(10) unsigned NOT NULL,
  `discipline_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `division_id` int(10) unsigned NOT NULL,
  `startnr` varchar(10) NOT NULL,
  `startnrorder` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `disciplines` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
);
INSERT INTO `disciplines` (`id`, `order`, `name`) VALUES
(1, 0, ''),
(2, 1, 'Gardedans Solo'),
(3, 2, 'Gardedans Paar'),
(4, 3, 'Gardedans Polka'),
(5, 4, 'Gardedans Mars'),
(6, 5, 'Gardedans met Tilfiguren'),
(7, 6, 'Showdans Solo'),
(8, 7, 'Showdans Duo'),
(9, 8, 'Showdans Karakter'),
(10, 9, 'Showdans Freestyle'),
(11, 10, 'Showdans Modern'),
(12, 11, 'Showdans met Tilfiguren');

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
);
INSERT INTO `categories` (`id`, `order`, `name`) VALUES
(1, 0, ''),
(2, 1, 'Miniklasse'),
(3, 2, 'Juniorenklasse'),
(4, 3, 'Jeugdklasse'),
(5, 4, 'Hoofdklasse');

CREATE TABLE IF NOT EXISTS `divisions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
);
INSERT INTO `divisions` (`id`, `order`, `name`) VALUES
(1, 0, ''),
(2, 2, '1e divisie'),
(3, 1, '2e divisie'),
(4, 3, 'Eredivisie');



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

CREATE TABLE IF NOT EXISTS `contestants_rounds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `round_id` int(10) unsigned NOT NULL,
  `contestant_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
);



CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `number` varchar(50),
  `username` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(100),
  `role` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
);
INSERT INTO `users` (`id`, `number`, `username`, `password`, `role`) VALUES
(1, '',  'Admin',   '6d2c216b41fa66081a17f39af76d973abbd20726', 'admin'),
(2, '1', 'Alice',   '', 'jury'),
(3, '2', 'Bob',     '', 'jury'),
(4, '3', 'Charlie', '', 'jury'),
(5, '4', 'Dave',    '', 'jury'),
(6, '5', 'Erin',    '', 'jury'),
(7, '6', 'Frank',   '', 'jury'),
(8, '7', 'Grace',   '', 'jury');

CREATE TABLE IF NOT EXISTS `rounds_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `round_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `order` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
);



CREATE TABLE IF NOT EXISTS `points` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contest_id` int(10) unsigned NOT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `lft` int(10) NOT NULL,
  `rght` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `max` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `defaultpoints` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `lft` int(10) NOT NULL,
  `rght` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `max` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);
INSERT INTO `defaultpoints` (`id`, `parent_id`, `lft`, `rght`, `name`, `max`) VALUES
(1, NULL, 1, 2, 'Presentatie', 10),
(2, NULL, 3, 4, 'Houding', 10),
(3, NULL, 5, 6, 'Synchroniteit', 10),
(4, NULL, 7, 8, 'Spreiding', 10),
(5, NULL, 9, 20, 'Choreografie Gardedansen', 25),
(6, 5, 10, 11, 'Formaties', 5),
(7, 5, 12, 13, 'Danspassen', 5),
(8, 5, 14, 15, 'Formatiewissel', 5),
(9, 5, 16, 17, 'Danselementen', 5),
(10, 5, 18, 19, 'Muziekomzetting', 5),
(11, NULL, 21, 22, 'Passen en danselementen', 10),
(12, NULL, 23, 24, 'Tilfiguren', 10),
(13, NULL, 25, 26, 'Omzetten van thema en karakter', 10),
(14, NULL, 27, 28, 'Creativiteit', 10),
(15, NULL, 29, 30, 'Danstechniek', 10),
(16, NULL, 31, 32, 'Uitvoering', 10),
(17, NULL, 33, 34, 'Verplichte elementen', 15);



CREATE TABLE IF NOT EXISTS `scores` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `point_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `contestant_id` int(10) unsigned NOT NULL,
  `round_id` int(10) unsigned NOT NULL,
  `score` float unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `scores_index` (`point_id`,`user_id`,`contestant_id`,`round_id`)
);

CREATE TABLE IF NOT EXISTS `adminscores` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contestant_id` int(10) unsigned NOT NULL,
  `round_id` int(10) unsigned NOT NULL,
  `verplichtelem` float unsigned DEFAULT NULL,
  `strafpunten` float unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `contestant_id` int(10) unsigned NOT NULL,
  `round_id` int(10) unsigned NOT NULL,
  `comment` text DEFAULT NULL,
  PRIMARY KEY (`id`)
);


CREATE TABLE IF NOT EXISTS `stages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `round_id` int(10) unsigned NOT NULL,
  `contestant_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
);



CREATE TABLE IF NOT EXISTS `scoreboard_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `order` int(10) unsigned,
  PRIMARY KEY (`id`)
);
