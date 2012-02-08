-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Jeu 24 Mars 2011 à 10:19
-- Version du serveur: 5.1.53
-- Version de PHP: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `eip_webapp`
--

-- --------------------------------------------------------

--
-- Structure de la table `groupe_ordinateur`
--

CREATE TABLE IF NOT EXISTS `groupe_ordinateur` (
  `id_groupe_ordinateur` int(11) NOT NULL AUTO_INCREMENT,
  `planning_id_planning` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_groupe_ordinateur`,`planning_id_planning`),
  KEY `fk_groupe_ordinateur_planning1` (`planning_id_planning`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `groupe_ordinateur`
--

INSERT INTO `groupe_ordinateur` (`id_groupe_ordinateur`, `planning_id_planning`, `nom`, `description`) VALUES
(1, 1, 'Defaut', 'Groupe par defaut'),
(2, 1, 'Devellopeurs', 'contient les employes devellopeur'),
(3, 1, 'Marketing', 'contient les employes marketing');

-- --------------------------------------------------------

--
-- Structure de la table `ordinateur`
--

CREATE TABLE IF NOT EXISTS `ordinateur` (
  `id_ordinateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `groupe_ordinateur_id_groupe_ordinateur` int(11) NOT NULL,
  `statut` enum('0','1') DEFAULT NULL,
  `mac_address` varchar(17) DEFAULT NULL,
  PRIMARY KEY (`id_ordinateur`),
  KEY `fk_ordinateur_groupe_ordinateur` (`groupe_ordinateur_id_groupe_ordinateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `ordinateur`
--

INSERT INTO `ordinateur` (`id_ordinateur`, `nom`, `description`, `groupe_ordinateur_id_groupe_ordinateur`, `statut`, `mac_address`) VALUES
(1, '192.168.1.1', '', 1, '0', '00:11:18:5b:3a:1f'),
(2, '192.168.2.2', '', 1, '0', '00:11:13:6z:4g:1e'),
(3, '192.168.5.1', NULL, 2, '0', '00:12:24:8h:3a:9q');

-- --------------------------------------------------------

--
-- Structure de la table `planning`
--

CREATE TABLE IF NOT EXISTS `planning` (
  `id_planning` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_planning`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `planning`
--

INSERT INTO `planning` (`id_planning`, `nom`, `description`) VALUES
(1, 'Defaut', 'Planning par defaut'),
(2, 'Plannig weekend', 'weekend'),
(3, 'Planning Vacance', 'vacances'),
(4, 'test', 'test');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Contenu de la table `planning_taches`
--

INSERT INTO `planning_taches` VALUES(2, 1, 'asdsa', '', '00:00:00', '00:00:00', '0');
INSERT INTO `planning_taches` VALUES(3, 1, 'asdsa', '', '00:00:00', '00:00:00', '0');
INSERT INTO `planning_taches` VALUES(4, 1, 'asdsa', '', '02:30:00', '03:45:00', '0');
INSERT INTO `planning_taches` VALUES(5, 1, 'test1', '', '02:00:00', '03:30:00', '0');
INSERT INTO `planning_taches` VALUES(6, 1, 'test2', '', '04:30:00', '06:30:00', '1');
INSERT INTO `planning_taches` VALUES(7, 1, 'test3', '', '08:15:00', '08:30:00', '1');
INSERT INTO `planning_taches` VALUES(8, 1, 'adskjdaslk', '', '04:00:00', '05:30:00', '1');
INSERT INTO `planning_taches` VALUES(9, 1, '', '', '07:30:00', '07:45:00', '1');
INSERT INTO `planning_taches` VALUES(10, 1, '', '', '07:15:00', '07:30:00', '1');
INSERT INTO `planning_taches` VALUES(11, 1, '', '', '11:00:00', '11:15:00', '1');
INSERT INTO `planning_taches` VALUES(12, 1, '', '', '09:15:00', '11:00:00', '1');
INSERT INTO `planning_taches` VALUES(29, 1, 'dsjfhjlds', '', '01:30:00', '03:00:00', '0');
INSERT INTO `planning_taches` VALUES(30, 1, '', '', '21:00:00', '21:15:00', '0');
INSERT INTO `planning_taches` VALUES(31, 1, 'kjkjhkj', '', '14:30:00', '00:00:00', '0');
INSERT INTO `planning_taches` VALUES(36, 4, 'vendredi', '5', '02:30:00', '05:15:00', '0');
INSERT INTO `planning_taches` VALUES(37, 4, 'dimanche', '0', '01:30:00', '03:30:00', '1');
INSERT INTO `planning_taches` VALUES(39, 4, 'samedi', '6', '03:30:00', '05:15:00', '2');
INSERT INTO `planning_taches` VALUES(40, 4, 'lundi', '1', '00:30:00', '03:00:00', '0');

-- --------------------------------------------------------

--
-- Structure de la table `reporting`
--

CREATE TABLE IF NOT EXISTS `reporting` (
  `id_reporting` int(11) NOT NULL AUTO_INCREMENT,
  `ordinateur_id_ordinateur` int(11) NOT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `statut` int(11) DEFAULT NULL,
  `energie` int(11) DEFAULT NULL,
  `usage_ordinateur` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_reporting`,`ordinateur_id_ordinateur`),
  KEY `fk_reporting_ordinateur1` (`ordinateur_id_ordinateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `reporting`
--

INSERT INTO `reporting` (`id_reporting`, `ordinateur_id_ordinateur`, `date_debut`, `date_fin`, `statut`, `energie`, `usage_ordinateur`) VALUES
(1, 1, '2011-01-01', '2011-01-31', 1, 63, 1),
(2, 2, '2011-01-01', '2011-01-31', 1, 70, 0),
(3, 1, '2011-02-01', '2011-02-28', 1, 45, 0),
(4, 1, '2011-03-01', '2011-03-31', 1, 74, 0),
(7, 1, '2011-04-01', '2011-04-30', 0, 82, 1),
(8, 1, '2011-05-01', '2011-05-31', 1, 57, 0),
(9, 1, '2011-06-01', '2011-06-30', 1, 36, 1),
(10, 2, '2011-02-01', '2011-02-28', 1, 42, 0),
(11, 2, '2011-03-01', '2011-03-31', 0, 69, 1),
(12, 2, '2011-04-01', '2011-04-30', 1, 72, 0),
(13, 2, '2011-05-01', '2011-05-31', 0, 52, 1),
(14, 2, '2011-06-01', '2011-06-30', 0, 26, 1),
(15, 3, '2011-01-01', '2011-01-31', 1, 47, 0),
(16, 3, '2011-02-01', '2011-02-28', 0, 57, 0),
(17, 3, '2011-03-01', '2011-03-31', 0, 74, 1),
(18, 3, '2011-04-01', '2011-04-30', 1, 32, 1),
(19, 3, '2011-05-01', '2011-05-31', 0, 85, 1),
(20, 3, '2011-06-01', '2011-06-30', 0, 29, 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(65) DEFAULT NULL,
  `type` enum('0','1','2') DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `type`) VALUES
(1, 'toto', 'f71dbe52628a3f83a77ab494817525c6', '2'),
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', '2'),
(3, 'reporting', 'c576a841fd4f333a6f074d68e76a1d37', '1');

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

--
-- Contraintes pour la table `reporting`
--
ALTER TABLE `reporting`
  ADD CONSTRAINT `fk_reporting_ordinateur1` FOREIGN KEY (`ordinateur_id_ordinateur`) REFERENCES `ordinateur` (`id_ordinateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;
