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

CREATE TABLE IF NOT EXISTS `contestants_rounds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `round_id` int(10) unsigned NOT NULL,
  `contestant_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
);



CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
);
INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'Admin', '61af2f3b7eeaa23e10b06b8da319d910728abf88', 'admin'),
(2, 'Jurylid1', 'd6f0de8070d6f89891727d2fa887b43bd0d8327c', 'jury'),
(3, 'Jurylid2', '84752f57921402f37fe9745c82d3b59870ce6363', 'jury'),
(4, 'Jurylid3', 'ebcc6897181de391f18b44d813a4fcc898a7780f', 'jury'),
(5, 'Jurylid4', 'fa24910cb71d2f407364e475f42765a2bf2856c6', 'jury'),
(6, 'Jurylid5', 'f31ed7e128a3b0a53ea842caa9d5cbe123e15e96', 'jury'),
(7, 'Jurylid6', '5faf4830f979c309b7564f9de08c3f11986311ba', 'jury'),
(8, 'Jurylid7', 'a3ab51535d6c153a168ef52bd99f01c68e908acf', 'jury');



CREATE TABLE IF NOT EXISTS `defaultpoints` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `lft` int(10) NOT NULL,
  `rght` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `min` int(11) NOT NULL,
  `max` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);
INSERT INTO `defaultpoints` (`id`, `parent_id`, `lft`, `rght`, `name`, `min`, `max`) VALUES
(1, NULL, 1, 2, 'Presentatie', 0, 0),
(2, NULL, 3, 4, 'Houding', 0, 10),
(3, NULL, 5, 6, 'Synchroniteit', 0, 10),
(4, NULL, 7, 8, 'Spreiding', 0, 10),
(5, NULL, 9, 20, 'Choreografie Gardedansen', 0, 25),
(6, 5, 10, 11, 'Formaties', 0, 5),
(7, 5, 12, 13, 'Danspassen', 0, 5),
(8, 5, 14, 15, 'Formatiewissel', 0, 5),
(9, 5, 16, 17, 'Danselementen', 0, 5),
(10, 5, 18, 19, 'Muziekomzetting', 0, 5),
(11, NULL, 21, 22, 'Passen en danselementen', 0, 10),
(12, NULL, 23, 24, 'Tilfiguren', 0, 10),
(13, NULL, 25, 26, 'Omzetten van thema en karakter', 0, 10),
(14, NULL, 27, 28, 'Creativiteit', 0, 10),
(15, NULL, 29, 30, 'Danstechniek', 0, 10),
(16, NULL, 31, 32, 'Uitvoering', 0, 10);
