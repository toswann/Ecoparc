 -- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Sam 14 Janvier 2012 à 18:47
-- Version du serveur: 5.5.9
-- Version de PHP: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `eip_webapp`
--

-- --------------------------------------------------------

--
-- Structure de la table `groupe_ordinateur`
--

CREATE TABLE `groupe_ordinateur` (
  `id_groupe_ordinateur` int(11) NOT NULL AUTO_INCREMENT,
  `planning_id_planning` int(11) NOT NULL,
  `nom_groupe` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_groupe_ordinateur`,`planning_id_planning`),
  KEY `fk_groupe_ordinateur_planning1` (`planning_id_planning`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `groupe_ordinateur`
--

INSERT INTO `groupe_ordinateur` VALUES(1, 1, 'Defaut', 'Groupe par defaut');
INSERT INTO `groupe_ordinateur` VALUES(2, 3, 'Devellopeurs', 'Groupe de dÃ©veloppeurs');
INSERT INTO `groupe_ordinateur` VALUES(3, 4, 'Marketing', 'Groupe de marketing');

-- --------------------------------------------------------

--
-- Structure de la table `ordinateur`
--

CREATE TABLE `ordinateur` (
  `id_ordinateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `groupe_ordinateur_id_groupe_ordinateur` int(11) NOT NULL,
  `statut` enum('0','1') DEFAULT NULL,
  `mac_address` varchar(17) DEFAULT NULL,
  `id_ordinateur_type` int(11) NOT NULL,
  PRIMARY KEY (`id_ordinateur`),
  KEY `fk_ordinateur_groupe_ordinateur` (`groupe_ordinateur_id_groupe_ordinateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `ordinateur`
--

INSERT INTO `ordinateur` VALUES(1, 'Ordinateur A', 'description', 1, '1', '00:11:18:5b:3a:1f', 1);
INSERT INTO `ordinateur` VALUES(2, 'Ordinateur B', 'description', 2, '1', '00:11:13:6z:4g:1e', 1);
INSERT INTO `ordinateur` VALUES(3, 'Ordinateur C', 'description', 2, '1', '00:12:24:8h:3a:9q', 1);
INSERT INTO `ordinateur` VALUES(4, 'Ordinateur D', 'description', 3, NULL, NULL, 1);
INSERT INTO `ordinateur` VALUES(5, 'Ordinateur E', 'description', 3, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `ordinateur_type`
--

CREATE TABLE `ordinateur_type` (
  `id_ordinateur_type` int(11) NOT NULL AUTO_INCREMENT,
  `nom_type` varchar(100) NOT NULL,
  `conso` int(11) NOT NULL,
  PRIMARY KEY (`id_ordinateur_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `ordinateur_type`
--

INSERT INTO `ordinateur_type` VALUES(1, 'defaultType', 150);
INSERT INTO `ordinateur_type` VALUES(2, 'type de test', 120);

-- --------------------------------------------------------

--
-- Structure de la table `planning`
--

CREATE TABLE `planning` (
  `id_planning` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_planning`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `planning`
--

INSERT INTO `planning` VALUES(1, 'Defaut', 'Planning par defaut');
INSERT INTO `planning` VALUES(2, '35h', 'Planning 35h');
INSERT INTO `planning` VALUES(3, 'Vacances', 'Planning vacances');
INSERT INTO `planning` VALUES(4, 'Economie', 'Economie');
INSERT INTO `planning` VALUES(6, 'Soutenance', 'Planning de démonstration');

-- --------------------------------------------------------

--
-- Structure de la table `planning_taches`
--

CREATE TABLE `planning_taches` (
  `id_planning_tache` int(11) NOT NULL AUTO_INCREMENT,
  `planning_id_planning` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `jour` enum('0','1','2','3','4','5','6') DEFAULT NULL,
  `heure_debut` time DEFAULT NULL,
  `heure_fin` time DEFAULT NULL,
  `action` enum('0','1','2') DEFAULT NULL,
  PRIMARY KEY (`id_planning_tache`),
  KEY `fk_planning_taches_planning1` (`planning_id_planning`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=108 ;

--
-- Contenu de la table `planning_taches`
--

INSERT INTO `planning_taches` VALUES(74, 4, 'Soir', '1', '17:15:00', '22:30:00', '1');
INSERT INTO `planning_taches` VALUES(80, 6, 'nuit', '2', '00:00:00', '09:00:00', '0');
INSERT INTO `planning_taches` VALUES(81, 6, 'nuit', '3', '00:00:00', '09:00:00', '0');
INSERT INTO `planning_taches` VALUES(82, 6, 'nuit', '1', '00:00:00', '09:00:00', '0');
INSERT INTO `planning_taches` VALUES(83, 6, 'Nuit', '4', '00:00:00', '09:00:00', '0');
INSERT INTO `planning_taches` VALUES(84, 6, 'Nuit', '5', '00:00:00', '09:00:00', '0');
INSERT INTO `planning_taches` VALUES(86, 6, 'weekend', '0', '00:00:00', '23:45:00', '0');
INSERT INTO `planning_taches` VALUES(87, 6, 'soir', '1', '18:00:00', '23:45:00', '0');
INSERT INTO `planning_taches` VALUES(88, 6, 'soir', '2', '18:00:00', '23:45:00', '0');
INSERT INTO `planning_taches` VALUES(89, 6, 'soir', '3', '18:00:00', '23:45:00', '0');
INSERT INTO `planning_taches` VALUES(90, 6, 'soir', '4', '18:00:00', '23:45:00', '1');
INSERT INTO `planning_taches` VALUES(91, 6, 'soir', '5', '18:00:00', '23:45:00', '0');
INSERT INTO `planning_taches` VALUES(92, 6, 'dejeuner', '1', '12:15:00', '13:45:00', '2');
INSERT INTO `planning_taches` VALUES(93, 6, 'dejeuner', '2', '12:15:00', '13:45:00', '2');
INSERT INTO `planning_taches` VALUES(94, 6, 'dejeuner', '3', '12:15:00', '13:45:00', '2');
INSERT INTO `planning_taches` VALUES(95, 6, 'dejeuner', '4', '12:15:00', '13:45:00', '2');
INSERT INTO `planning_taches` VALUES(96, 6, 'dejeuner', '5', '12:15:00', '13:45:00', '2');
INSERT INTO `planning_taches` VALUES(97, 6, 'work', '1', '09:00:00', '12:15:00', '1');
INSERT INTO `planning_taches` VALUES(98, 6, 'work', '2', '09:00:00', '12:15:00', '1');
INSERT INTO `planning_taches` VALUES(99, 6, 'work', '3', '09:00:00', '12:15:00', '1');
INSERT INTO `planning_taches` VALUES(100, 6, 'work', '4', '09:00:00', '12:15:00', '1');
INSERT INTO `planning_taches` VALUES(101, 6, 'work', '5', '09:00:00', '12:15:00', '1');
INSERT INTO `planning_taches` VALUES(102, 6, 'work', '1', '13:45:00', '18:00:00', '1');
INSERT INTO `planning_taches` VALUES(103, 6, 'work', '2', '13:45:00', '18:00:00', '1');
INSERT INTO `planning_taches` VALUES(104, 6, 'work', '3', '13:45:00', '18:00:00', '1');
INSERT INTO `planning_taches` VALUES(105, 6, 'work', '4', '13:45:00', '18:00:00', '1');
INSERT INTO `planning_taches` VALUES(106, 6, 'work', '5', '13:45:00', '18:00:00', '1');
INSERT INTO `planning_taches` VALUES(107, 4, '', '2', '01:00:00', '01:15:00', '0');

-- --------------------------------------------------------

--
-- Structure de la table `reporting`
--

CREATE TABLE `reporting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ordinateur` int(11) NOT NULL,
  `is_audit` enum('0','1') NOT NULL,
  `date` date NOT NULL,
  `last_received` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `temps` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=501 ;

--
-- Contenu de la table `reporting`
--

INSERT INTO `reporting` VALUES(1, 1, '1', '2011-11-01', '2011-11-01 00:00:00', 414);
INSERT INTO `reporting` VALUES(2, 2, '1', '2011-11-01', '2011-11-01 00:00:00', 404);
INSERT INTO `reporting` VALUES(3, 3, '1', '2011-11-01', '2011-11-01 00:00:00', 468);
INSERT INTO `reporting` VALUES(4, 4, '1', '2011-11-01', '2011-11-01 00:00:00', 422);
INSERT INTO `reporting` VALUES(5, 5, '1', '2011-11-01', '2011-11-01 00:00:00', 440);
INSERT INTO `reporting` VALUES(6, 1, '1', '2011-11-02', '2011-11-02 00:00:00', 451);
INSERT INTO `reporting` VALUES(7, 2, '1', '2011-11-02', '2011-11-02 00:00:00', 367);
INSERT INTO `reporting` VALUES(8, 3, '1', '2011-11-02', '2011-11-02 00:00:00', 478);
INSERT INTO `reporting` VALUES(9, 4, '1', '2011-11-02', '2011-11-02 00:00:00', 469);
INSERT INTO `reporting` VALUES(10, 5, '1', '2011-11-02', '2011-11-02 00:00:00', 397);
INSERT INTO `reporting` VALUES(11, 1, '1', '2011-11-03', '2011-11-03 00:00:00', 517);
INSERT INTO `reporting` VALUES(12, 2, '1', '2011-11-03', '2011-11-03 00:00:00', 503);
INSERT INTO `reporting` VALUES(13, 3, '1', '2011-11-03', '2011-11-03 00:00:00', 491);
INSERT INTO `reporting` VALUES(14, 4, '1', '2011-11-03', '2011-11-03 00:00:00', 364);
INSERT INTO `reporting` VALUES(15, 5, '1', '2011-11-03', '2011-11-03 00:00:00', 520);
INSERT INTO `reporting` VALUES(16, 1, '1', '2011-11-04', '2011-11-04 00:00:00', 437);
INSERT INTO `reporting` VALUES(17, 2, '1', '2011-11-04', '2011-11-04 00:00:00', 465);
INSERT INTO `reporting` VALUES(18, 3, '1', '2011-11-04', '2011-11-04 00:00:00', 385);
INSERT INTO `reporting` VALUES(19, 4, '1', '2011-11-04', '2011-11-04 00:00:00', 491);
INSERT INTO `reporting` VALUES(20, 5, '1', '2011-11-04', '2011-11-04 00:00:00', 481);
INSERT INTO `reporting` VALUES(21, 1, '1', '2011-11-05', '2011-11-05 00:00:00', 432);
INSERT INTO `reporting` VALUES(22, 2, '1', '2011-11-05', '2011-11-05 00:00:00', 470);
INSERT INTO `reporting` VALUES(23, 3, '1', '2011-11-05', '2011-11-05 00:00:00', 440);
INSERT INTO `reporting` VALUES(24, 4, '1', '2011-11-05', '2011-11-05 00:00:00', 509);
INSERT INTO `reporting` VALUES(25, 5, '1', '2011-11-05', '2011-11-05 00:00:00', 489);
INSERT INTO `reporting` VALUES(26, 1, '1', '2011-11-06', '2011-11-06 00:00:00', 397);
INSERT INTO `reporting` VALUES(27, 2, '1', '2011-11-06', '2011-11-06 00:00:00', 0);
INSERT INTO `reporting` VALUES(28, 3, '1', '2011-11-06', '2011-11-06 00:00:00', 449);
INSERT INTO `reporting` VALUES(29, 4, '1', '2011-11-06', '2011-11-06 00:00:00', 0);
INSERT INTO `reporting` VALUES(30, 5, '1', '2011-11-06', '2011-11-06 00:00:00', 402);
INSERT INTO `reporting` VALUES(31, 1, '1', '2011-11-07', '2011-11-07 00:00:00', 367);
INSERT INTO `reporting` VALUES(32, 2, '1', '2011-11-07', '2011-11-07 00:00:00', 0);
INSERT INTO `reporting` VALUES(33, 3, '1', '2011-11-07', '2011-11-07 00:00:00', 453);
INSERT INTO `reporting` VALUES(34, 4, '1', '2011-11-07', '2011-11-07 00:00:00', 0);
INSERT INTO `reporting` VALUES(35, 5, '1', '2011-11-07', '2011-11-07 00:00:00', 393);
INSERT INTO `reporting` VALUES(36, 1, '1', '2011-11-08', '2011-11-08 00:00:00', 422);
INSERT INTO `reporting` VALUES(37, 2, '1', '2011-11-08', '2011-11-08 00:00:00', 498);
INSERT INTO `reporting` VALUES(38, 3, '1', '2011-11-08', '2011-11-08 00:00:00', 502);
INSERT INTO `reporting` VALUES(39, 4, '1', '2011-11-08', '2011-11-08 00:00:00', 485);
INSERT INTO `reporting` VALUES(40, 5, '1', '2011-11-08', '2011-11-08 00:00:00', 417);
INSERT INTO `reporting` VALUES(41, 1, '1', '2011-11-09', '2011-11-09 00:00:00', 432);
INSERT INTO `reporting` VALUES(42, 2, '1', '2011-11-09', '2011-11-09 00:00:00', 492);
INSERT INTO `reporting` VALUES(43, 3, '1', '2011-11-09', '2011-11-09 00:00:00', 374);
INSERT INTO `reporting` VALUES(44, 4, '1', '2011-11-09', '2011-11-09 00:00:00', 381);
INSERT INTO `reporting` VALUES(45, 5, '1', '2011-11-09', '2011-11-09 00:00:00', 369);
INSERT INTO `reporting` VALUES(46, 1, '1', '2011-11-10', '2011-11-10 00:00:00', 371);
INSERT INTO `reporting` VALUES(47, 2, '1', '2011-11-10', '2011-11-10 00:00:00', 363);
INSERT INTO `reporting` VALUES(48, 3, '1', '2011-11-10', '2011-11-10 00:00:00', 500);
INSERT INTO `reporting` VALUES(49, 4, '1', '2011-11-10', '2011-11-10 00:00:00', 376);
INSERT INTO `reporting` VALUES(50, 5, '1', '2011-11-10', '2011-11-10 00:00:00', 363);
INSERT INTO `reporting` VALUES(51, 1, '1', '2011-11-11', '2011-11-11 00:00:00', 416);
INSERT INTO `reporting` VALUES(52, 2, '1', '2011-11-11', '2011-11-11 00:00:00', 481);
INSERT INTO `reporting` VALUES(53, 3, '1', '2011-11-11', '2011-11-11 00:00:00', 389);
INSERT INTO `reporting` VALUES(54, 4, '1', '2011-11-11', '2011-11-11 00:00:00', 386);
INSERT INTO `reporting` VALUES(55, 5, '1', '2011-11-11', '2011-11-11 00:00:00', 441);
INSERT INTO `reporting` VALUES(56, 1, '1', '2011-11-12', '2011-11-12 00:00:00', 462);
INSERT INTO `reporting` VALUES(57, 2, '1', '2011-11-12', '2011-11-12 00:00:00', 496);
INSERT INTO `reporting` VALUES(58, 3, '1', '2011-11-12', '2011-11-12 00:00:00', 360);
INSERT INTO `reporting` VALUES(59, 4, '1', '2011-11-12', '2011-11-12 00:00:00', 450);
INSERT INTO `reporting` VALUES(60, 5, '1', '2011-11-12', '2011-11-12 00:00:00', 465);
INSERT INTO `reporting` VALUES(61, 1, '1', '2011-11-13', '2011-11-13 00:00:00', 398);
INSERT INTO `reporting` VALUES(62, 2, '1', '2011-11-13', '2011-11-13 00:00:00', 0);
INSERT INTO `reporting` VALUES(63, 3, '1', '2011-11-13', '2011-11-13 00:00:00', 379);
INSERT INTO `reporting` VALUES(64, 4, '1', '2011-11-13', '2011-11-13 00:00:00', 0);
INSERT INTO `reporting` VALUES(65, 5, '1', '2011-11-13', '2011-11-13 00:00:00', 507);
INSERT INTO `reporting` VALUES(66, 1, '1', '2011-11-14', '2011-11-14 00:00:00', 405);
INSERT INTO `reporting` VALUES(67, 2, '1', '2011-11-14', '2011-11-14 00:00:00', 0);
INSERT INTO `reporting` VALUES(68, 3, '1', '2011-11-14', '2011-11-14 00:00:00', 472);
INSERT INTO `reporting` VALUES(69, 4, '1', '2011-11-14', '2011-11-14 00:00:00', 0);
INSERT INTO `reporting` VALUES(70, 5, '1', '2011-11-14', '2011-11-14 00:00:00', 380);
INSERT INTO `reporting` VALUES(71, 1, '1', '2011-11-15', '2011-11-15 00:00:00', 468);
INSERT INTO `reporting` VALUES(72, 2, '1', '2011-11-15', '2011-11-15 00:00:00', 449);
INSERT INTO `reporting` VALUES(73, 3, '1', '2011-11-15', '2011-11-15 00:00:00', 361);
INSERT INTO `reporting` VALUES(74, 4, '1', '2011-11-15', '2011-11-15 00:00:00', 432);
INSERT INTO `reporting` VALUES(75, 5, '1', '2011-11-15', '2011-11-15 00:00:00', 506);
INSERT INTO `reporting` VALUES(76, 1, '1', '2011-11-16', '2011-11-16 00:00:00', 433);
INSERT INTO `reporting` VALUES(77, 2, '1', '2011-11-16', '2011-11-16 00:00:00', 404);
INSERT INTO `reporting` VALUES(78, 3, '1', '2011-11-16', '2011-11-16 00:00:00', 360);
INSERT INTO `reporting` VALUES(79, 4, '1', '2011-11-16', '2011-11-16 00:00:00', 455);
INSERT INTO `reporting` VALUES(80, 5, '1', '2011-11-16', '2011-11-16 00:00:00', 413);
INSERT INTO `reporting` VALUES(81, 1, '1', '2011-11-17', '2011-11-17 00:00:00', 372);
INSERT INTO `reporting` VALUES(82, 2, '1', '2011-11-17', '2011-11-17 00:00:00', 459);
INSERT INTO `reporting` VALUES(83, 3, '1', '2011-11-17', '2011-11-17 00:00:00', 392);
INSERT INTO `reporting` VALUES(84, 4, '1', '2011-11-17', '2011-11-17 00:00:00', 388);
INSERT INTO `reporting` VALUES(85, 5, '1', '2011-11-17', '2011-11-17 00:00:00', 462);
INSERT INTO `reporting` VALUES(86, 1, '1', '2011-11-18', '2011-11-18 00:00:00', 449);
INSERT INTO `reporting` VALUES(87, 2, '1', '2011-11-18', '2011-11-18 00:00:00', 509);
INSERT INTO `reporting` VALUES(88, 3, '1', '2011-11-18', '2011-11-18 00:00:00', 492);
INSERT INTO `reporting` VALUES(89, 4, '1', '2011-11-18', '2011-11-18 00:00:00', 475);
INSERT INTO `reporting` VALUES(90, 5, '1', '2011-11-18', '2011-11-18 00:00:00', 429);
INSERT INTO `reporting` VALUES(91, 1, '1', '2011-11-19', '2011-11-19 00:00:00', 433);
INSERT INTO `reporting` VALUES(92, 2, '1', '2011-11-19', '2011-11-19 00:00:00', 451);
INSERT INTO `reporting` VALUES(93, 3, '1', '2011-11-19', '2011-11-19 00:00:00', 430);
INSERT INTO `reporting` VALUES(94, 4, '1', '2011-11-19', '2011-11-19 00:00:00', 363);
INSERT INTO `reporting` VALUES(95, 5, '1', '2011-11-19', '2011-11-19 00:00:00', 395);
INSERT INTO `reporting` VALUES(96, 1, '1', '2011-11-20', '2011-11-20 00:00:00', 468);
INSERT INTO `reporting` VALUES(97, 2, '1', '2011-11-20', '2011-11-20 00:00:00', 0);
INSERT INTO `reporting` VALUES(98, 3, '1', '2011-11-20', '2011-11-20 00:00:00', 382);
INSERT INTO `reporting` VALUES(99, 4, '1', '2011-11-20', '2011-11-20 00:00:00', 0);
INSERT INTO `reporting` VALUES(100, 5, '1', '2011-11-20', '2011-11-20 00:00:00', 381);
INSERT INTO `reporting` VALUES(101, 1, '1', '2011-11-21', '2011-11-21 00:00:00', 514);
INSERT INTO `reporting` VALUES(102, 2, '1', '2011-11-21', '2011-11-21 00:00:00', 0);
INSERT INTO `reporting` VALUES(103, 3, '1', '2011-11-21', '2011-11-21 00:00:00', 494);
INSERT INTO `reporting` VALUES(104, 4, '1', '2011-11-21', '2011-11-21 00:00:00', 0);
INSERT INTO `reporting` VALUES(105, 5, '1', '2011-11-21', '2011-11-21 00:00:00', 401);
INSERT INTO `reporting` VALUES(106, 1, '1', '2011-11-22', '2011-11-22 00:00:00', 461);
INSERT INTO `reporting` VALUES(107, 2, '1', '2011-11-22', '2011-11-22 00:00:00', 423);
INSERT INTO `reporting` VALUES(108, 3, '1', '2011-11-22', '2011-11-22 00:00:00', 403);
INSERT INTO `reporting` VALUES(109, 4, '1', '2011-11-22', '2011-11-22 00:00:00', 373);
INSERT INTO `reporting` VALUES(110, 5, '1', '2011-11-22', '2011-11-22 00:00:00', 408);
INSERT INTO `reporting` VALUES(111, 1, '1', '2011-11-23', '2011-11-23 00:00:00', 476);
INSERT INTO `reporting` VALUES(112, 2, '1', '2011-11-23', '2011-11-23 00:00:00', 417);
INSERT INTO `reporting` VALUES(113, 3, '1', '2011-11-23', '2011-11-23 00:00:00', 409);
INSERT INTO `reporting` VALUES(114, 4, '1', '2011-11-23', '2011-11-23 00:00:00', 411);
INSERT INTO `reporting` VALUES(115, 5, '1', '2011-11-23', '2011-11-23 00:00:00', 470);
INSERT INTO `reporting` VALUES(116, 1, '1', '2011-11-24', '2011-11-24 00:00:00', 422);
INSERT INTO `reporting` VALUES(117, 2, '1', '2011-11-24', '2011-11-24 00:00:00', 510);
INSERT INTO `reporting` VALUES(118, 3, '1', '2011-11-24', '2011-11-24 00:00:00', 503);
INSERT INTO `reporting` VALUES(119, 4, '1', '2011-11-24', '2011-11-24 00:00:00', 450);
INSERT INTO `reporting` VALUES(120, 5, '1', '2011-11-24', '2011-11-24 00:00:00', 452);
INSERT INTO `reporting` VALUES(121, 1, '1', '2011-11-25', '2011-11-25 00:00:00', 431);
INSERT INTO `reporting` VALUES(122, 2, '1', '2011-11-25', '2011-11-25 00:00:00', 439);
INSERT INTO `reporting` VALUES(123, 3, '1', '2011-11-25', '2011-11-25 00:00:00', 423);
INSERT INTO `reporting` VALUES(124, 4, '1', '2011-11-25', '2011-11-25 00:00:00', 386);
INSERT INTO `reporting` VALUES(125, 5, '1', '2011-11-25', '2011-11-25 00:00:00', 508);
INSERT INTO `reporting` VALUES(126, 1, '1', '2011-11-26', '2011-11-26 00:00:00', 497);
INSERT INTO `reporting` VALUES(127, 2, '1', '2011-11-26', '2011-11-26 00:00:00', 477);
INSERT INTO `reporting` VALUES(128, 3, '1', '2011-11-26', '2011-11-26 00:00:00', 418);
INSERT INTO `reporting` VALUES(129, 4, '1', '2011-11-26', '2011-11-26 00:00:00', 500);
INSERT INTO `reporting` VALUES(130, 5, '1', '2011-11-26', '2011-11-26 00:00:00', 512);
INSERT INTO `reporting` VALUES(131, 1, '1', '2011-11-27', '2011-11-27 00:00:00', 366);
INSERT INTO `reporting` VALUES(132, 2, '1', '2011-11-27', '2011-11-27 00:00:00', 0);
INSERT INTO `reporting` VALUES(133, 3, '1', '2011-11-27', '2011-11-27 00:00:00', 361);
INSERT INTO `reporting` VALUES(134, 4, '1', '2011-11-27', '2011-11-27 00:00:00', 0);
INSERT INTO `reporting` VALUES(135, 5, '1', '2011-11-27', '2011-11-27 00:00:00', 373);
INSERT INTO `reporting` VALUES(136, 1, '1', '2011-11-28', '2011-11-28 00:00:00', 520);
INSERT INTO `reporting` VALUES(137, 2, '1', '2011-11-28', '2011-11-28 00:00:00', 0);
INSERT INTO `reporting` VALUES(138, 3, '1', '2011-11-28', '2011-11-28 00:00:00', 496);
INSERT INTO `reporting` VALUES(139, 4, '1', '2011-11-28', '2011-11-28 00:00:00', 0);
INSERT INTO `reporting` VALUES(140, 5, '1', '2011-11-28', '2011-11-28 00:00:00', 415);
INSERT INTO `reporting` VALUES(141, 1, '1', '2011-11-29', '2011-11-29 00:00:00', 461);
INSERT INTO `reporting` VALUES(142, 2, '1', '2011-11-29', '2011-11-29 00:00:00', 398);
INSERT INTO `reporting` VALUES(143, 3, '1', '2011-11-29', '2011-11-29 00:00:00', 458);
INSERT INTO `reporting` VALUES(144, 4, '1', '2011-11-29', '2011-11-29 00:00:00', 474);
INSERT INTO `reporting` VALUES(145, 5, '1', '2011-11-29', '2011-11-29 00:00:00', 447);
INSERT INTO `reporting` VALUES(146, 1, '1', '2011-11-30', '2011-11-30 00:00:00', 414);
INSERT INTO `reporting` VALUES(147, 2, '1', '2011-11-30', '2011-11-30 00:00:00', 370);
INSERT INTO `reporting` VALUES(148, 3, '1', '2011-11-30', '2011-11-30 00:00:00', 497);
INSERT INTO `reporting` VALUES(149, 4, '1', '2011-11-30', '2011-11-30 00:00:00', 466);
INSERT INTO `reporting` VALUES(150, 5, '1', '2011-11-30', '2011-11-30 00:00:00', 481);
INSERT INTO `reporting` VALUES(151, 1, '0', '2011-12-01', '2011-12-01 00:00:00', 390);
INSERT INTO `reporting` VALUES(152, 2, '0', '2011-12-01', '2011-12-01 00:00:00', 399);
INSERT INTO `reporting` VALUES(153, 3, '0', '2011-12-01', '2011-12-01 00:00:00', 413);
INSERT INTO `reporting` VALUES(154, 4, '0', '2011-12-01', '2011-12-01 00:00:00', 383);
INSERT INTO `reporting` VALUES(155, 5, '0', '2011-12-01', '2011-12-01 00:00:00', 424);
INSERT INTO `reporting` VALUES(156, 1, '0', '2011-12-02', '2011-12-02 00:00:00', 383);
INSERT INTO `reporting` VALUES(157, 2, '0', '2011-12-02', '2011-12-02 00:00:00', 436);
INSERT INTO `reporting` VALUES(158, 3, '0', '2011-12-02', '2011-12-02 00:00:00', 425);
INSERT INTO `reporting` VALUES(159, 4, '0', '2011-12-02', '2011-12-02 00:00:00', 415);
INSERT INTO `reporting` VALUES(160, 5, '0', '2011-12-02', '2011-12-02 00:00:00', 430);
INSERT INTO `reporting` VALUES(161, 1, '0', '2011-12-03', '2011-12-03 00:00:00', 423);
INSERT INTO `reporting` VALUES(162, 2, '0', '2011-12-03', '2011-12-03 00:00:00', 406);
INSERT INTO `reporting` VALUES(163, 3, '0', '2011-12-03', '2011-12-03 00:00:00', 380);
INSERT INTO `reporting` VALUES(164, 4, '0', '2011-12-03', '2011-12-03 00:00:00', 390);
INSERT INTO `reporting` VALUES(165, 5, '0', '2011-12-03', '2011-12-03 00:00:00', 465);
INSERT INTO `reporting` VALUES(166, 1, '0', '2011-12-04', '2011-12-04 00:00:00', 0);
INSERT INTO `reporting` VALUES(167, 2, '0', '2011-12-04', '2011-12-04 00:00:00', 0);
INSERT INTO `reporting` VALUES(168, 3, '0', '2011-12-04', '2011-12-04 00:00:00', 0);
INSERT INTO `reporting` VALUES(169, 4, '0', '2011-12-04', '2011-12-04 00:00:00', 0);
INSERT INTO `reporting` VALUES(170, 5, '0', '2011-12-04', '2011-12-04 00:00:00', 0);
INSERT INTO `reporting` VALUES(171, 1, '0', '2011-12-05', '2011-12-05 00:00:00', 0);
INSERT INTO `reporting` VALUES(172, 2, '0', '2011-12-05', '2011-12-05 00:00:00', 0);
INSERT INTO `reporting` VALUES(173, 3, '0', '2011-12-05', '2011-12-05 00:00:00', 0);
INSERT INTO `reporting` VALUES(174, 4, '0', '2011-12-05', '2011-12-05 00:00:00', 0);
INSERT INTO `reporting` VALUES(175, 5, '0', '2011-12-05', '2011-12-05 00:00:00', 0);
INSERT INTO `reporting` VALUES(176, 1, '0', '2011-12-06', '2011-12-06 00:00:00', 419);
INSERT INTO `reporting` VALUES(177, 2, '0', '2011-12-06', '2011-12-06 00:00:00', 441);
INSERT INTO `reporting` VALUES(178, 3, '0', '2011-12-06', '2011-12-06 00:00:00', 445);
INSERT INTO `reporting` VALUES(179, 4, '0', '2011-12-06', '2011-12-06 00:00:00', 450);
INSERT INTO `reporting` VALUES(180, 5, '0', '2011-12-06', '2011-12-06 00:00:00', 422);
INSERT INTO `reporting` VALUES(181, 1, '0', '2011-12-07', '2011-12-07 00:00:00', 365);
INSERT INTO `reporting` VALUES(182, 2, '0', '2011-12-07', '2011-12-07 00:00:00', 379);
INSERT INTO `reporting` VALUES(183, 3, '0', '2011-12-07', '2011-12-07 00:00:00', 437);
INSERT INTO `reporting` VALUES(184, 4, '0', '2011-12-07', '2011-12-07 00:00:00', 394);
INSERT INTO `reporting` VALUES(185, 5, '0', '2011-12-07', '2011-12-07 00:00:00', 354);
INSERT INTO `reporting` VALUES(186, 1, '0', '2011-12-08', '2011-12-08 00:00:00', 391);
INSERT INTO `reporting` VALUES(187, 2, '0', '2011-12-08', '2011-12-08 00:00:00', 400);
INSERT INTO `reporting` VALUES(188, 3, '0', '2011-12-08', '2011-12-08 00:00:00', 448);
INSERT INTO `reporting` VALUES(189, 4, '0', '2011-12-08', '2011-12-08 00:00:00', 440);
INSERT INTO `reporting` VALUES(190, 5, '0', '2011-12-08', '2011-12-08 00:00:00', 386);
INSERT INTO `reporting` VALUES(191, 1, '0', '2011-12-09', '2011-12-09 00:00:00', 342);
INSERT INTO `reporting` VALUES(192, 2, '0', '2011-12-09', '2011-12-09 00:00:00', 349);
INSERT INTO `reporting` VALUES(193, 3, '0', '2011-12-09', '2011-12-09 00:00:00', 445);
INSERT INTO `reporting` VALUES(194, 4, '0', '2011-12-09', '2011-12-09 00:00:00', 415);
INSERT INTO `reporting` VALUES(195, 5, '0', '2011-12-09', '2011-12-09 00:00:00', 393);
INSERT INTO `reporting` VALUES(196, 1, '0', '2011-12-10', '2011-12-10 00:00:00', 389);
INSERT INTO `reporting` VALUES(197, 2, '0', '2011-12-10', '2011-12-10 00:00:00', 458);
INSERT INTO `reporting` VALUES(198, 3, '0', '2011-12-10', '2011-12-10 00:00:00', 348);
INSERT INTO `reporting` VALUES(199, 4, '0', '2011-12-10', '2011-12-10 00:00:00', 475);
INSERT INTO `reporting` VALUES(200, 5, '0', '2011-12-10', '2011-12-10 00:00:00', 393);
INSERT INTO `reporting` VALUES(201, 1, '0', '2011-12-11', '2011-12-11 00:00:00', 0);
INSERT INTO `reporting` VALUES(202, 2, '0', '2011-12-11', '2011-12-11 00:00:00', 0);
INSERT INTO `reporting` VALUES(203, 3, '0', '2011-12-11', '2011-12-11 00:00:00', 0);
INSERT INTO `reporting` VALUES(204, 4, '0', '2011-12-11', '2011-12-11 00:00:00', 0);
INSERT INTO `reporting` VALUES(205, 5, '0', '2011-12-11', '2011-12-11 00:00:00', 0);
INSERT INTO `reporting` VALUES(206, 1, '0', '2011-12-12', '2011-12-12 00:00:00', 0);
INSERT INTO `reporting` VALUES(207, 2, '0', '2011-12-12', '2011-12-12 00:00:00', 0);
INSERT INTO `reporting` VALUES(208, 3, '0', '2011-12-12', '2011-12-12 00:00:00', 0);
INSERT INTO `reporting` VALUES(209, 4, '0', '2011-12-12', '2011-12-12 00:00:00', 0);
INSERT INTO `reporting` VALUES(210, 5, '0', '2011-12-12', '2011-12-12 00:00:00', 0);
INSERT INTO `reporting` VALUES(211, 1, '0', '2011-12-13', '2011-12-13 00:00:00', 439);
INSERT INTO `reporting` VALUES(212, 2, '0', '2011-12-13', '2011-12-13 00:00:00', 417);
INSERT INTO `reporting` VALUES(213, 3, '0', '2011-12-13', '2011-12-13 00:00:00', 459);
INSERT INTO `reporting` VALUES(214, 4, '0', '2011-12-13', '2011-12-13 00:00:00', 479);
INSERT INTO `reporting` VALUES(215, 5, '0', '2011-12-13', '2011-12-13 00:00:00', 468);
INSERT INTO `reporting` VALUES(216, 1, '0', '2011-12-14', '2011-12-14 00:00:00', 444);
INSERT INTO `reporting` VALUES(217, 2, '0', '2011-12-14', '2011-12-14 00:00:00', 418);
INSERT INTO `reporting` VALUES(218, 3, '0', '2011-12-14', '2011-12-14 00:00:00', 429);
INSERT INTO `reporting` VALUES(219, 4, '0', '2011-12-14', '2011-12-14 00:00:00', 409);
INSERT INTO `reporting` VALUES(220, 5, '0', '2011-12-14', '2011-12-14 00:00:00', 388);
INSERT INTO `reporting` VALUES(221, 1, '0', '2011-12-15', '2011-12-15 00:00:00', 371);
INSERT INTO `reporting` VALUES(222, 2, '0', '2011-12-15', '2011-12-15 00:00:00', 434);
INSERT INTO `reporting` VALUES(223, 3, '0', '2011-12-15', '2011-12-15 00:00:00', 428);
INSERT INTO `reporting` VALUES(224, 4, '0', '2011-12-15', '2011-12-15 00:00:00', 468);
INSERT INTO `reporting` VALUES(225, 5, '0', '2011-12-15', '2011-12-15 00:00:00', 347);
INSERT INTO `reporting` VALUES(226, 1, '0', '2011-12-16', '2011-12-16 00:00:00', 442);
INSERT INTO `reporting` VALUES(227, 2, '0', '2011-12-16', '2011-12-16 00:00:00', 379);
INSERT INTO `reporting` VALUES(228, 3, '0', '2011-12-16', '2011-12-16 00:00:00', 408);
INSERT INTO `reporting` VALUES(229, 4, '0', '2011-12-16', '2011-12-16 00:00:00', 409);
INSERT INTO `reporting` VALUES(230, 5, '0', '2011-12-16', '2011-12-16 00:00:00', 479);
INSERT INTO `reporting` VALUES(231, 1, '0', '2011-12-17', '2011-12-17 00:00:00', 454);
INSERT INTO `reporting` VALUES(232, 2, '0', '2011-12-17', '2011-12-17 00:00:00', 411);
INSERT INTO `reporting` VALUES(233, 3, '0', '2011-12-17', '2011-12-17 00:00:00', 348);
INSERT INTO `reporting` VALUES(234, 4, '0', '2011-12-17', '2011-12-17 00:00:00', 419);
INSERT INTO `reporting` VALUES(235, 5, '0', '2011-12-17', '2011-12-17 00:00:00', 345);
INSERT INTO `reporting` VALUES(236, 1, '0', '2011-12-18', '2011-12-18 00:00:00', 0);
INSERT INTO `reporting` VALUES(237, 2, '0', '2011-12-18', '2011-12-18 00:00:00', 0);
INSERT INTO `reporting` VALUES(238, 3, '0', '2011-12-18', '2011-12-18 00:00:00', 0);
INSERT INTO `reporting` VALUES(239, 4, '0', '2011-12-18', '2011-12-18 00:00:00', 0);
INSERT INTO `reporting` VALUES(240, 5, '0', '2011-12-18', '2011-12-18 00:00:00', 0);
INSERT INTO `reporting` VALUES(241, 1, '0', '2011-12-19', '2011-12-19 00:00:00', 0);
INSERT INTO `reporting` VALUES(242, 2, '0', '2011-12-19', '2011-12-19 00:00:00', 0);
INSERT INTO `reporting` VALUES(243, 3, '0', '2011-12-19', '2011-12-19 00:00:00', 0);
INSERT INTO `reporting` VALUES(244, 4, '0', '2011-12-19', '2011-12-19 00:00:00', 0);
INSERT INTO `reporting` VALUES(245, 5, '0', '2011-12-19', '2011-12-19 00:00:00', 0);
INSERT INTO `reporting` VALUES(246, 1, '0', '2011-12-20', '2011-12-20 00:00:00', 401);
INSERT INTO `reporting` VALUES(247, 2, '0', '2011-12-20', '2011-12-20 00:00:00', 468);
INSERT INTO `reporting` VALUES(248, 3, '0', '2011-12-20', '2011-12-20 00:00:00', 464);
INSERT INTO `reporting` VALUES(249, 4, '0', '2011-12-20', '2011-12-20 00:00:00', 410);
INSERT INTO `reporting` VALUES(250, 5, '0', '2011-12-20', '2011-12-20 00:00:00', 462);
INSERT INTO `reporting` VALUES(251, 1, '0', '2011-12-21', '2011-12-21 00:00:00', 376);
INSERT INTO `reporting` VALUES(252, 2, '0', '2011-12-21', '2011-12-21 00:00:00', 369);
INSERT INTO `reporting` VALUES(253, 3, '0', '2011-12-21', '2011-12-21 00:00:00', 399);
INSERT INTO `reporting` VALUES(254, 4, '0', '2011-12-21', '2011-12-21 00:00:00', 354);
INSERT INTO `reporting` VALUES(255, 5, '0', '2011-12-21', '2011-12-21 00:00:00', 368);
INSERT INTO `reporting` VALUES(256, 1, '0', '2011-12-22', '2011-12-22 00:00:00', 387);
INSERT INTO `reporting` VALUES(257, 2, '0', '2011-12-22', '2011-12-22 00:00:00', 459);
INSERT INTO `reporting` VALUES(258, 3, '0', '2011-12-22', '2011-12-22 00:00:00', 446);
INSERT INTO `reporting` VALUES(259, 4, '0', '2011-12-22', '2011-12-22 00:00:00', 476);
INSERT INTO `reporting` VALUES(260, 5, '0', '2011-12-22', '2011-12-22 00:00:00', 387);
INSERT INTO `reporting` VALUES(261, 1, '0', '2011-12-23', '2011-12-23 00:00:00', 353);
INSERT INTO `reporting` VALUES(262, 2, '0', '2011-12-23', '2011-12-23 00:00:00', 366);
INSERT INTO `reporting` VALUES(263, 3, '0', '2011-12-23', '2011-12-23 00:00:00', 340);
INSERT INTO `reporting` VALUES(264, 4, '0', '2011-12-23', '2011-12-23 00:00:00', 441);
INSERT INTO `reporting` VALUES(265, 5, '0', '2011-12-23', '2011-12-23 00:00:00', 354);
INSERT INTO `reporting` VALUES(266, 1, '0', '2011-12-24', '2011-12-24 00:00:00', 348);
INSERT INTO `reporting` VALUES(267, 2, '0', '2011-12-24', '2011-12-24 00:00:00', 402);
INSERT INTO `reporting` VALUES(268, 3, '0', '2011-12-24', '2011-12-24 00:00:00', 393);
INSERT INTO `reporting` VALUES(269, 4, '0', '2011-12-24', '2011-12-24 00:00:00', 417);
INSERT INTO `reporting` VALUES(270, 5, '0', '2011-12-24', '2011-12-24 00:00:00', 472);
INSERT INTO `reporting` VALUES(271, 1, '0', '2011-12-25', '2011-12-25 00:00:00', 0);
INSERT INTO `reporting` VALUES(272, 2, '0', '2011-12-25', '2011-12-25 00:00:00', 0);
INSERT INTO `reporting` VALUES(273, 3, '0', '2011-12-25', '2011-12-25 00:00:00', 0);
INSERT INTO `reporting` VALUES(274, 4, '0', '2011-12-25', '2011-12-25 00:00:00', 0);
INSERT INTO `reporting` VALUES(275, 5, '0', '2011-12-25', '2011-12-25 00:00:00', 0);
INSERT INTO `reporting` VALUES(276, 1, '0', '2011-12-26', '2011-12-26 00:00:00', 0);
INSERT INTO `reporting` VALUES(277, 2, '0', '2011-12-26', '2011-12-26 00:00:00', 0);
INSERT INTO `reporting` VALUES(278, 3, '0', '2011-12-26', '2011-12-26 00:00:00', 0);
INSERT INTO `reporting` VALUES(279, 4, '0', '2011-12-26', '2011-12-26 00:00:00', 0);
INSERT INTO `reporting` VALUES(280, 5, '0', '2011-12-26', '2011-12-26 00:00:00', 0);
INSERT INTO `reporting` VALUES(281, 1, '0', '2011-12-27', '2011-12-27 00:00:00', 391);
INSERT INTO `reporting` VALUES(282, 2, '0', '2011-12-27', '2011-12-27 00:00:00', 390);
INSERT INTO `reporting` VALUES(283, 3, '0', '2011-12-27', '2011-12-27 00:00:00', 402);
INSERT INTO `reporting` VALUES(284, 4, '0', '2011-12-27', '2011-12-27 00:00:00', 399);
INSERT INTO `reporting` VALUES(285, 5, '0', '2011-12-27', '2011-12-27 00:00:00', 470);
INSERT INTO `reporting` VALUES(286, 1, '0', '2011-12-28', '2011-12-28 00:00:00', 408);
INSERT INTO `reporting` VALUES(287, 2, '0', '2011-12-28', '2011-12-28 00:00:00', 461);
INSERT INTO `reporting` VALUES(288, 3, '0', '2011-12-28', '2011-12-28 00:00:00', 457);
INSERT INTO `reporting` VALUES(289, 4, '0', '2011-12-28', '2011-12-28 00:00:00', 391);
INSERT INTO `reporting` VALUES(290, 5, '0', '2011-12-28', '2011-12-28 00:00:00', 391);
INSERT INTO `reporting` VALUES(291, 1, '0', '2011-12-29', '2011-12-29 00:00:00', 439);
INSERT INTO `reporting` VALUES(292, 2, '0', '2011-12-29', '2011-12-29 00:00:00', 427);
INSERT INTO `reporting` VALUES(293, 3, '0', '2011-12-29', '2011-12-29 00:00:00', 420);
INSERT INTO `reporting` VALUES(294, 4, '0', '2011-12-29', '2011-12-29 00:00:00', 357);
INSERT INTO `reporting` VALUES(295, 5, '0', '2011-12-29', '2011-12-29 00:00:00', 442);
INSERT INTO `reporting` VALUES(296, 1, '0', '2011-12-30', '2011-12-30 00:00:00', 449);
INSERT INTO `reporting` VALUES(297, 2, '0', '2011-12-30', '2011-12-30 00:00:00', 404);
INSERT INTO `reporting` VALUES(298, 3, '0', '2011-12-30', '2011-12-30 00:00:00', 420);
INSERT INTO `reporting` VALUES(299, 4, '0', '2011-12-30', '2011-12-30 00:00:00', 414);
INSERT INTO `reporting` VALUES(300, 5, '0', '2011-12-30', '2011-12-30 00:00:00', 400);
INSERT INTO `reporting` VALUES(301, 1, '0', '2011-12-31', '2011-12-31 00:00:00', 468);
INSERT INTO `reporting` VALUES(302, 2, '0', '2011-12-31', '2011-12-31 00:00:00', 428);
INSERT INTO `reporting` VALUES(303, 3, '0', '2011-12-31', '2011-12-31 00:00:00', 426);
INSERT INTO `reporting` VALUES(304, 4, '0', '2011-12-31', '2011-12-31 00:00:00', 469);
INSERT INTO `reporting` VALUES(305, 5, '0', '2011-12-31', '2011-12-31 00:00:00', 389);
INSERT INTO `reporting` VALUES(306, 1, '0', '2012-01-01', '2012-01-01 00:00:00', 0);
INSERT INTO `reporting` VALUES(307, 2, '0', '2012-01-01', '2012-01-01 00:00:00', 0);
INSERT INTO `reporting` VALUES(308, 3, '0', '2012-01-01', '2012-01-01 00:00:00', 0);
INSERT INTO `reporting` VALUES(309, 4, '0', '2012-01-01', '2012-01-01 00:00:00', 0);
INSERT INTO `reporting` VALUES(310, 5, '0', '2012-01-01', '2012-01-01 00:00:00', 0);
INSERT INTO `reporting` VALUES(311, 1, '0', '2012-01-02', '2012-01-02 00:00:00', 0);
INSERT INTO `reporting` VALUES(312, 2, '0', '2012-01-02', '2012-01-02 00:00:00', 0);
INSERT INTO `reporting` VALUES(313, 3, '0', '2012-01-02', '2012-01-02 00:00:00', 0);
INSERT INTO `reporting` VALUES(314, 4, '0', '2012-01-02', '2012-01-02 00:00:00', 0);
INSERT INTO `reporting` VALUES(315, 5, '0', '2012-01-02', '2012-01-02 00:00:00', 0);
INSERT INTO `reporting` VALUES(316, 1, '0', '2012-01-03', '2012-01-03 00:00:00', 440);
INSERT INTO `reporting` VALUES(317, 2, '0', '2012-01-03', '2012-01-03 00:00:00', 477);
INSERT INTO `reporting` VALUES(318, 3, '0', '2012-01-03', '2012-01-03 00:00:00', 452);
INSERT INTO `reporting` VALUES(319, 4, '0', '2012-01-03', '2012-01-03 00:00:00', 352);
INSERT INTO `reporting` VALUES(320, 5, '0', '2012-01-03', '2012-01-03 00:00:00', 413);
INSERT INTO `reporting` VALUES(321, 1, '0', '2012-01-04', '2012-01-04 00:00:00', 443);
INSERT INTO `reporting` VALUES(322, 2, '0', '2012-01-04', '2012-01-04 00:00:00', 404);
INSERT INTO `reporting` VALUES(323, 3, '0', '2012-01-04', '2012-01-04 00:00:00', 464);
INSERT INTO `reporting` VALUES(324, 4, '0', '2012-01-04', '2012-01-04 00:00:00', 364);
INSERT INTO `reporting` VALUES(325, 5, '0', '2012-01-04', '2012-01-04 00:00:00', 464);
INSERT INTO `reporting` VALUES(326, 1, '0', '2012-01-05', '2012-01-05 00:00:00', 453);
INSERT INTO `reporting` VALUES(327, 2, '0', '2012-01-05', '2012-01-05 00:00:00', 432);
INSERT INTO `reporting` VALUES(328, 3, '0', '2012-01-05', '2012-01-05 00:00:00', 444);
INSERT INTO `reporting` VALUES(329, 4, '0', '2012-01-05', '2012-01-05 00:00:00', 430);
INSERT INTO `reporting` VALUES(330, 5, '0', '2012-01-05', '2012-01-05 00:00:00', 342);
INSERT INTO `reporting` VALUES(331, 1, '0', '2012-01-06', '2012-01-06 00:00:00', 355);
INSERT INTO `reporting` VALUES(332, 2, '0', '2012-01-06', '2012-01-06 00:00:00', 388);
INSERT INTO `reporting` VALUES(333, 3, '0', '2012-01-06', '2012-01-06 00:00:00', 430);
INSERT INTO `reporting` VALUES(334, 4, '0', '2012-01-06', '2012-01-06 00:00:00', 435);
INSERT INTO `reporting` VALUES(335, 5, '0', '2012-01-06', '2012-01-06 00:00:00', 406);
INSERT INTO `reporting` VALUES(336, 1, '0', '2012-01-07', '2012-01-07 00:00:00', 392);
INSERT INTO `reporting` VALUES(337, 2, '0', '2012-01-07', '2012-01-07 00:00:00', 403);
INSERT INTO `reporting` VALUES(338, 3, '0', '2012-01-07', '2012-01-07 00:00:00', 471);
INSERT INTO `reporting` VALUES(339, 4, '0', '2012-01-07', '2012-01-07 00:00:00', 473);
INSERT INTO `reporting` VALUES(340, 5, '0', '2012-01-07', '2012-01-07 00:00:00', 478);
INSERT INTO `reporting` VALUES(341, 1, '0', '2012-01-08', '2012-01-08 00:00:00', 0);
INSERT INTO `reporting` VALUES(342, 2, '0', '2012-01-08', '2012-01-08 00:00:00', 0);
INSERT INTO `reporting` VALUES(343, 3, '0', '2012-01-08', '2012-01-08 00:00:00', 0);
INSERT INTO `reporting` VALUES(344, 4, '0', '2012-01-08', '2012-01-08 00:00:00', 0);
INSERT INTO `reporting` VALUES(345, 5, '0', '2012-01-08', '2012-01-08 00:00:00', 0);
INSERT INTO `reporting` VALUES(346, 1, '0', '2012-01-09', '2012-01-09 00:00:00', 0);
INSERT INTO `reporting` VALUES(347, 2, '0', '2012-01-09', '2012-01-09 00:00:00', 0);
INSERT INTO `reporting` VALUES(348, 3, '0', '2012-01-09', '2012-01-09 00:00:00', 0);
INSERT INTO `reporting` VALUES(349, 4, '0', '2012-01-09', '2012-01-09 00:00:00', 0);
INSERT INTO `reporting` VALUES(350, 5, '0', '2012-01-09', '2012-01-09 00:00:00', 0);
INSERT INTO `reporting` VALUES(351, 1, '0', '2012-01-10', '2012-01-10 00:00:00', 390);
INSERT INTO `reporting` VALUES(352, 2, '0', '2012-01-10', '2012-01-10 00:00:00', 460);
INSERT INTO `reporting` VALUES(353, 3, '0', '2012-01-10', '2012-01-10 00:00:00', 425);
INSERT INTO `reporting` VALUES(354, 4, '0', '2012-01-10', '2012-01-10 00:00:00', 477);
INSERT INTO `reporting` VALUES(355, 5, '0', '2012-01-10', '2012-01-10 00:00:00', 448);
INSERT INTO `reporting` VALUES(356, 1, '0', '2012-01-11', '2012-01-11 00:00:00', 475);
INSERT INTO `reporting` VALUES(357, 2, '0', '2012-01-11', '2012-01-11 00:00:00', 437);
INSERT INTO `reporting` VALUES(358, 3, '0', '2012-01-11', '2012-01-11 00:00:00', 445);
INSERT INTO `reporting` VALUES(359, 4, '0', '2012-01-11', '2012-01-11 00:00:00', 446);
INSERT INTO `reporting` VALUES(360, 5, '0', '2012-01-11', '2012-01-11 00:00:00', 450);
INSERT INTO `reporting` VALUES(361, 1, '0', '2012-01-12', '2012-01-12 00:00:00', 377);
INSERT INTO `reporting` VALUES(362, 2, '0', '2012-01-12', '2012-01-12 00:00:00', 408);
INSERT INTO `reporting` VALUES(363, 3, '0', '2012-01-12', '2012-01-12 00:00:00', 373);
INSERT INTO `reporting` VALUES(364, 4, '0', '2012-01-12', '2012-01-12 00:00:00', 361);
INSERT INTO `reporting` VALUES(365, 5, '0', '2012-01-12', '2012-01-12 00:00:00', 433);
INSERT INTO `reporting` VALUES(366, 1, '0', '2012-01-13', '2012-01-13 00:00:00', 356);
INSERT INTO `reporting` VALUES(367, 2, '0', '2012-01-13', '2012-01-13 00:00:00', 474);
INSERT INTO `reporting` VALUES(368, 3, '0', '2012-01-13', '2012-01-13 00:00:00', 385);
INSERT INTO `reporting` VALUES(369, 4, '0', '2012-01-13', '2012-01-13 00:00:00', 461);
INSERT INTO `reporting` VALUES(370, 5, '0', '2012-01-13', '2012-01-13 00:00:00', 423);
INSERT INTO `reporting` VALUES(371, 1, '0', '2012-01-14', '2012-01-14 00:00:00', 388);
INSERT INTO `reporting` VALUES(372, 2, '0', '2012-01-14', '2012-01-14 00:00:00', 476);
INSERT INTO `reporting` VALUES(373, 3, '0', '2012-01-14', '2012-01-14 00:00:00', 472);
INSERT INTO `reporting` VALUES(374, 4, '0', '2012-01-14', '2012-01-14 00:00:00', 478);
INSERT INTO `reporting` VALUES(375, 5, '0', '2012-01-14', '2012-01-14 00:00:00', 430);
INSERT INTO `reporting` VALUES(376, 1, '0', '2012-01-15', '2012-01-15 00:00:00', 0);
INSERT INTO `reporting` VALUES(377, 2, '0', '2012-01-15', '2012-01-15 00:00:00', 0);
INSERT INTO `reporting` VALUES(378, 3, '0', '2012-01-15', '2012-01-15 00:00:00', 0);
INSERT INTO `reporting` VALUES(379, 4, '0', '2012-01-15', '2012-01-15 00:00:00', 0);
INSERT INTO `reporting` VALUES(380, 5, '0', '2012-01-15', '2012-01-15 00:00:00', 0);
INSERT INTO `reporting` VALUES(381, 1, '0', '2012-01-16', '2012-01-16 00:00:00', 0);
INSERT INTO `reporting` VALUES(382, 2, '0', '2012-01-16', '2012-01-16 00:00:00', 0);
INSERT INTO `reporting` VALUES(383, 3, '0', '2012-01-16', '2012-01-16 00:00:00', 0);
INSERT INTO `reporting` VALUES(384, 4, '0', '2012-01-16', '2012-01-16 00:00:00', 0);
INSERT INTO `reporting` VALUES(385, 5, '0', '2012-01-16', '2012-01-16 00:00:00', 0);
INSERT INTO `reporting` VALUES(386, 1, '0', '2012-01-17', '2012-01-17 00:00:00', 398);
INSERT INTO `reporting` VALUES(387, 2, '0', '2012-01-17', '2012-01-17 00:00:00', 390);
INSERT INTO `reporting` VALUES(388, 3, '0', '2012-01-17', '2012-01-17 00:00:00', 353);
INSERT INTO `reporting` VALUES(389, 4, '0', '2012-01-17', '2012-01-17 00:00:00', 388);
INSERT INTO `reporting` VALUES(390, 5, '0', '2012-01-17', '2012-01-17 00:00:00', 382);
INSERT INTO `reporting` VALUES(391, 1, '0', '2012-01-18', '2012-01-18 00:00:00', 351);
INSERT INTO `reporting` VALUES(392, 2, '0', '2012-01-18', '2012-01-18 00:00:00', 439);
INSERT INTO `reporting` VALUES(393, 3, '0', '2012-01-18', '2012-01-18 00:00:00', 361);
INSERT INTO `reporting` VALUES(394, 4, '0', '2012-01-18', '2012-01-18 00:00:00', 437);
INSERT INTO `reporting` VALUES(395, 5, '0', '2012-01-18', '2012-01-18 00:00:00', 436);
INSERT INTO `reporting` VALUES(396, 1, '0', '2012-01-19', '2012-01-19 00:00:00', 470);
INSERT INTO `reporting` VALUES(397, 2, '0', '2012-01-19', '2012-01-19 00:00:00', 431);
INSERT INTO `reporting` VALUES(398, 3, '0', '2012-01-19', '2012-01-19 00:00:00', 392);
INSERT INTO `reporting` VALUES(399, 4, '0', '2012-01-19', '2012-01-19 00:00:00', 434);
INSERT INTO `reporting` VALUES(400, 5, '0', '2012-01-19', '2012-01-19 00:00:00', 396);
INSERT INTO `reporting` VALUES(401, 1, '0', '2012-01-20', '2012-01-20 00:00:00', 361);
INSERT INTO `reporting` VALUES(402, 2, '0', '2012-01-20', '2012-01-20 00:00:00', 472);
INSERT INTO `reporting` VALUES(403, 3, '0', '2012-01-20', '2012-01-20 00:00:00', 465);
INSERT INTO `reporting` VALUES(404, 4, '0', '2012-01-20', '2012-01-20 00:00:00', 394);
INSERT INTO `reporting` VALUES(405, 5, '0', '2012-01-20', '2012-01-20 00:00:00', 352);
INSERT INTO `reporting` VALUES(406, 1, '0', '2012-01-21', '2012-01-21 00:00:00', 418);
INSERT INTO `reporting` VALUES(407, 2, '0', '2012-01-21', '2012-01-21 00:00:00', 411);
INSERT INTO `reporting` VALUES(408, 3, '0', '2012-01-21', '2012-01-21 00:00:00', 345);
INSERT INTO `reporting` VALUES(409, 4, '0', '2012-01-21', '2012-01-21 00:00:00', 463);
INSERT INTO `reporting` VALUES(410, 5, '0', '2012-01-21', '2012-01-21 00:00:00', 391);
INSERT INTO `reporting` VALUES(411, 1, '0', '2012-01-22', '2012-01-22 00:00:00', 0);
INSERT INTO `reporting` VALUES(412, 2, '0', '2012-01-22', '2012-01-22 00:00:00', 0);
INSERT INTO `reporting` VALUES(413, 3, '0', '2012-01-22', '2012-01-22 00:00:00', 0);
INSERT INTO `reporting` VALUES(414, 4, '0', '2012-01-22', '2012-01-22 00:00:00', 0);
INSERT INTO `reporting` VALUES(415, 5, '0', '2012-01-22', '2012-01-22 00:00:00', 0);
INSERT INTO `reporting` VALUES(416, 1, '0', '2012-01-23', '2012-01-23 00:00:00', 0);
INSERT INTO `reporting` VALUES(417, 2, '0', '2012-01-23', '2012-01-23 00:00:00', 0);
INSERT INTO `reporting` VALUES(418, 3, '0', '2012-01-23', '2012-01-23 00:00:00', 0);
INSERT INTO `reporting` VALUES(419, 4, '0', '2012-01-23', '2012-01-23 00:00:00', 0);
INSERT INTO `reporting` VALUES(420, 5, '0', '2012-01-23', '2012-01-23 00:00:00', 0);
INSERT INTO `reporting` VALUES(421, 1, '0', '2012-01-24', '2012-01-24 00:00:00', 429);
INSERT INTO `reporting` VALUES(422, 2, '0', '2012-01-24', '2012-01-24 00:00:00', 370);
INSERT INTO `reporting` VALUES(423, 3, '0', '2012-01-24', '2012-01-24 00:00:00', 386);
INSERT INTO `reporting` VALUES(424, 4, '0', '2012-01-24', '2012-01-24 00:00:00', 420);
INSERT INTO `reporting` VALUES(425, 5, '0', '2012-01-24', '2012-01-24 00:00:00', 368);
INSERT INTO `reporting` VALUES(426, 1, '0', '2012-01-25', '2012-01-25 00:00:00', 477);
INSERT INTO `reporting` VALUES(427, 2, '0', '2012-01-25', '2012-01-25 00:00:00', 479);
INSERT INTO `reporting` VALUES(428, 3, '0', '2012-01-25', '2012-01-25 00:00:00', 418);
INSERT INTO `reporting` VALUES(429, 4, '0', '2012-01-25', '2012-01-25 00:00:00', 350);
INSERT INTO `reporting` VALUES(430, 5, '0', '2012-01-25', '2012-01-25 00:00:00', 387);
INSERT INTO `reporting` VALUES(431, 1, '0', '2012-01-26', '2012-01-26 00:00:00', 460);
INSERT INTO `reporting` VALUES(432, 2, '0', '2012-01-26', '2012-01-26 00:00:00', 361);
INSERT INTO `reporting` VALUES(433, 3, '0', '2012-01-26', '2012-01-26 00:00:00', 345);
INSERT INTO `reporting` VALUES(434, 4, '0', '2012-01-26', '2012-01-26 00:00:00', 341);
INSERT INTO `reporting` VALUES(435, 5, '0', '2012-01-26', '2012-01-26 00:00:00', 458);
INSERT INTO `reporting` VALUES(436, 1, '0', '2012-01-27', '2012-01-27 00:00:00', 442);
INSERT INTO `reporting` VALUES(437, 2, '0', '2012-01-27', '2012-01-27 00:00:00', 471);
INSERT INTO `reporting` VALUES(438, 3, '0', '2012-01-27', '2012-01-27 00:00:00', 408);
INSERT INTO `reporting` VALUES(439, 4, '0', '2012-01-27', '2012-01-27 00:00:00', 353);
INSERT INTO `reporting` VALUES(440, 5, '0', '2012-01-27', '2012-01-27 00:00:00', 424);
INSERT INTO `reporting` VALUES(441, 1, '0', '2012-01-28', '2012-01-28 00:00:00', 465);
INSERT INTO `reporting` VALUES(442, 2, '0', '2012-01-28', '2012-01-28 00:00:00', 375);
INSERT INTO `reporting` VALUES(443, 3, '0', '2012-01-28', '2012-01-28 00:00:00', 415);
INSERT INTO `reporting` VALUES(444, 4, '0', '2012-01-28', '2012-01-28 00:00:00', 450);
INSERT INTO `reporting` VALUES(445, 5, '0', '2012-01-28', '2012-01-28 00:00:00', 430);
INSERT INTO `reporting` VALUES(446, 1, '0', '2012-01-29', '2012-01-29 00:00:00', 0);
INSERT INTO `reporting` VALUES(447, 2, '0', '2012-01-29', '2012-01-29 00:00:00', 0);
INSERT INTO `reporting` VALUES(448, 3, '0', '2012-01-29', '2012-01-29 00:00:00', 0);
INSERT INTO `reporting` VALUES(449, 4, '0', '2012-01-29', '2012-01-29 00:00:00', 0);
INSERT INTO `reporting` VALUES(450, 5, '0', '2012-01-29', '2012-01-29 00:00:00', 0);
INSERT INTO `reporting` VALUES(451, 1, '0', '2012-01-30', '2012-01-30 00:00:00', 0);
INSERT INTO `reporting` VALUES(452, 2, '0', '2012-01-30', '2012-01-30 00:00:00', 0);
INSERT INTO `reporting` VALUES(453, 3, '0', '2012-01-30', '2012-01-30 00:00:00', 0);
INSERT INTO `reporting` VALUES(454, 4, '0', '2012-01-30', '2012-01-30 00:00:00', 0);
INSERT INTO `reporting` VALUES(455, 5, '0', '2012-01-30', '2012-01-30 00:00:00', 0);
INSERT INTO `reporting` VALUES(456, 1, '0', '2012-01-31', '2012-01-31 00:00:00', 427);
INSERT INTO `reporting` VALUES(457, 2, '0', '2012-01-31', '2012-01-31 00:00:00', 387);
INSERT INTO `reporting` VALUES(458, 3, '0', '2012-01-31', '2012-01-31 00:00:00', 360);
INSERT INTO `reporting` VALUES(459, 4, '0', '2012-01-31', '2012-01-31 00:00:00', 433);
INSERT INTO `reporting` VALUES(460, 5, '0', '2012-01-31', '2012-01-31 00:00:00', 369);
INSERT INTO `reporting` VALUES(461, 1, '0', '2012-02-01', '2012-02-01 00:00:00', 412);
INSERT INTO `reporting` VALUES(462, 2, '0', '2012-02-01', '2012-02-01 00:00:00', 381);
INSERT INTO `reporting` VALUES(463, 3, '0', '2012-02-01', '2012-02-01 00:00:00', 400);
INSERT INTO `reporting` VALUES(464, 4, '0', '2012-02-01', '2012-02-01 00:00:00', 459);
INSERT INTO `reporting` VALUES(465, 5, '0', '2012-02-01', '2012-02-01 00:00:00', 462);
INSERT INTO `reporting` VALUES(466, 1, '0', '2012-02-02', '2012-02-02 00:00:00', 428);
INSERT INTO `reporting` VALUES(467, 2, '0', '2012-02-02', '2012-02-02 00:00:00', 455);
INSERT INTO `reporting` VALUES(468, 3, '0', '2012-02-02', '2012-02-02 00:00:00', 460);
INSERT INTO `reporting` VALUES(469, 4, '0', '2012-02-02', '2012-02-02 00:00:00', 365);
INSERT INTO `reporting` VALUES(470, 5, '0', '2012-02-02', '2012-02-02 00:00:00', 466);
INSERT INTO `reporting` VALUES(471, 1, '0', '2012-02-03', '2012-02-03 00:00:00', 366);
INSERT INTO `reporting` VALUES(472, 2, '0', '2012-02-03', '2012-02-03 00:00:00', 345);
INSERT INTO `reporting` VALUES(473, 3, '0', '2012-02-03', '2012-02-03 00:00:00', 346);
INSERT INTO `reporting` VALUES(474, 4, '0', '2012-02-03', '2012-02-03 00:00:00', 372);
INSERT INTO `reporting` VALUES(475, 5, '0', '2012-02-03', '2012-02-03 00:00:00', 346);
INSERT INTO `reporting` VALUES(476, 1, '0', '2012-02-04', '2012-02-04 00:00:00', 465);
INSERT INTO `reporting` VALUES(477, 2, '0', '2012-02-04', '2012-02-04 00:00:00', 475);
INSERT INTO `reporting` VALUES(478, 3, '0', '2012-02-04', '2012-02-04 00:00:00', 477);
INSERT INTO `reporting` VALUES(479, 4, '0', '2012-02-04', '2012-02-04 00:00:00', 393);
INSERT INTO `reporting` VALUES(480, 5, '0', '2012-02-04', '2012-02-04 00:00:00', 347);
INSERT INTO `reporting` VALUES(481, 1, '0', '2012-02-05', '2012-02-05 00:00:00', 0);
INSERT INTO `reporting` VALUES(482, 2, '0', '2012-02-05', '2012-02-05 00:00:00', 0);
INSERT INTO `reporting` VALUES(483, 3, '0', '2012-02-05', '2012-02-05 00:00:00', 0);
INSERT INTO `reporting` VALUES(484, 4, '0', '2012-02-05', '2012-02-05 00:00:00', 0);
INSERT INTO `reporting` VALUES(485, 5, '0', '2012-02-05', '2012-02-05 00:00:00', 0);
INSERT INTO `reporting` VALUES(486, 1, '0', '2012-02-06', '2012-02-06 00:00:00', 0);
INSERT INTO `reporting` VALUES(487, 2, '0', '2012-02-06', '2012-02-06 00:00:00', 0);
INSERT INTO `reporting` VALUES(488, 3, '0', '2012-02-06', '2012-02-06 00:00:00', 0);
INSERT INTO `reporting` VALUES(489, 4, '0', '2012-02-06', '2012-02-06 00:00:00', 0);
INSERT INTO `reporting` VALUES(490, 5, '0', '2012-02-06', '2012-02-06 00:00:00', 0);
INSERT INTO `reporting` VALUES(491, 1, '0', '2012-02-07', '2012-02-07 00:00:00', 421);
INSERT INTO `reporting` VALUES(492, 2, '0', '2012-02-07', '2012-02-07 00:00:00', 378);
INSERT INTO `reporting` VALUES(493, 3, '0', '2012-02-07', '2012-02-07 00:00:00', 382);
INSERT INTO `reporting` VALUES(494, 4, '0', '2012-02-07', '2012-02-07 00:00:00', 356);
INSERT INTO `reporting` VALUES(495, 5, '0', '2012-02-07', '2012-02-07 00:00:00', 347);
INSERT INTO `reporting` VALUES(496, 1, '0', '2012-02-08', '2012-02-08 00:00:00', 473);
INSERT INTO `reporting` VALUES(497, 2, '0', '2012-02-08', '2012-02-08 00:00:00', 443);
INSERT INTO `reporting` VALUES(498, 3, '0', '2012-02-08', '2012-02-08 00:00:00', 395);
INSERT INTO `reporting` VALUES(499, 4, '0', '2012-02-08', '2012-02-08 00:00:00', 352);
INSERT INTO `reporting` VALUES(500, 5, '0', '2012-02-08', '2012-02-08 00:00:00', 396);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(65) DEFAULT NULL,
  `type` enum('0','1','2') DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` VALUES(7, 'Clement', 'bb8b20c99f94d079cbd72677168255b7', '0');
INSERT INTO `users` VALUES(16, 'admin', '21232f297a57a5a743894a0e4a801fc3', '2');
INSERT INTO `users` VALUES(6, 'Julien', 'b8df4a540960f5b8c388864c61f1dce8', '0');
INSERT INTO `users` VALUES(8, 'Cyril', '4abd06d9b49d0556e5d974a79b7b3f01', '2');
INSERT INTO `users` VALUES(9, 'Gordan', '936571152c8407da77dc2224e8842c5f', '0');
INSERT INTO `users` VALUES(10, 'Axel', '3d7c02a4626f82838c29d340046234ff', '0');
INSERT INTO `users` VALUES(11, 'Arnaud', '187c7bed2c7d4b31ded1e032ad2f4821', '0');
INSERT INTO `users` VALUES(12, 'Swann', 'abf52aa54ba6d909e8852b2f638b54f9', '0');
INSERT INTO `users` VALUES(13, 'Denis', '40b493a50ff330acc98b3bbfafcc40f2', '0');
INSERT INTO `users` VALUES(14, 'Gaspard', 'b4c522498452ed2be7b6781b8cadf937', '0');
INSERT INTO `users` VALUES(15, 'Xavier', 'd15ced66c1d28b310ea14eec0159df2b', '0');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `groupe_ordinateur`
--
ALTER TABLE `groupe_ordinateur`
  ADD CONSTRAINT `fk_groupe_ordinateur_planning1` FOREIGN KEY (`planning_id_planning`) REFERENCES `planning` (`id_planning`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `ordinateur`
--
ALTER TABLE `ordinateur`
  ADD CONSTRAINT `fk_ordinateur_groupe_ordinateur` FOREIGN KEY (`groupe_ordinateur_id_groupe_ordinateur`) REFERENCES `groupe_ordinateur` (`id_groupe_ordinateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `planning_taches`
--
ALTER TABLE `planning_taches`
  ADD CONSTRAINT `fk_planning_taches_planning1` FOREIGN KEY (`planning_id_planning`) REFERENCES `planning` (`id_planning`) ON DELETE NO ACTION ON UPDATE NO ACTION;
