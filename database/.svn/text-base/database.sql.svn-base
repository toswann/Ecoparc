SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `eip_webapp` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `eip_webapp` ;

-- -----------------------------------------------------
-- Table `eip_webapp`.`planning`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eip_webapp`.`planning` (
  `id_planning` INT NOT NULL ,
  `nom` VARCHAR(100) NULL ,
  `description` VARCHAR(100) NULL ,
  PRIMARY KEY (`id_planning`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eip_webapp`.`groupe_ordinateur`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eip_webapp`.`groupe_ordinateur` (
  `id_groupe_ordinateur` INT NOT NULL ,
  `planning_id_planning` INT NOT NULL ,
  `nom` VARCHAR(100) NULL ,
  `description` VARCHAR(100) NULL ,
  PRIMARY KEY (`id_groupe_ordinateur`, `planning_id_planning`) ,
  INDEX `fk_groupe_ordinateur_planning1` (`planning_id_planning` ASC) ,
  CONSTRAINT `fk_groupe_ordinateur_planning1`
    FOREIGN KEY (`planning_id_planning` )
    REFERENCES `eip_webapp`.`planning` (`id_planning` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eip_webapp`.`ordinateur`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eip_webapp`.`ordinateur` (
  `id_ordinateur` INT NOT NULL ,
  `nom` VARCHAR(100) NULL ,
  `description` VARCHAR(100) NULL ,
  `groupe_ordinateur_id_groupe_ordinateur` INT NOT NULL ,
  `statut` ENUM('0','1') NULL ,
  `mac_address` VARCHAR(12) NULL ,
  PRIMARY KEY (`id_ordinateur`) ,
  INDEX `fk_ordinateur_groupe_ordinateur` (`groupe_ordinateur_id_groupe_ordinateur` ASC) ,
  CONSTRAINT `fk_ordinateur_groupe_ordinateur`
    FOREIGN KEY (`groupe_ordinateur_id_groupe_ordinateur` )
    REFERENCES `eip_webapp`.`groupe_ordinateur` (`id_groupe_ordinateur` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eip_webapp`.`planning_taches`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `eip_webapp`.`planning_taches` (
  `id_planning_tache` int(11) NOT NULL AUTO_INCREMENT,
  `planning_id_planning` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `jour` enum('0','1','2','3','4','5','6') DEFAULT NULL,
  `heure_debut` time DEFAULT NULL,
  `heure_fin` time DEFAULT NULL,
  `action` enum('0','1') DEFAULT NULL,
  PRIMARY KEY (`id_planning_tache`),
  KEY `fk_planning_taches_planning1` (`planning_id_planning`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

-- -----------------------------------------------------
-- Table `eip_webapp`.`reporting`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eip_webapp`.`reporting` (
  `id_reporting` INT NOT NULL ,
  `ordinateur_id_ordinateur` INT NOT NULL ,
  `date_debut` DATE NULL ,
  `date_fin` DATE NULL ,
  `statut` INT NULL ,
  `energie` INT NULL ,
  `usage_ordinateur` INT NULL ,
  PRIMARY KEY (`id_reporting`, `ordinateur_id_ordinateur`) ,
  INDEX `fk_reporting_ordinateur1` (`ordinateur_id_ordinateur` ASC) ,
  CONSTRAINT `fk_reporting_ordinateur1`
    FOREIGN KEY (`ordinateur_id_ordinateur` )
    REFERENCES `eip_webapp`.`ordinateur` (`id_ordinateur` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
