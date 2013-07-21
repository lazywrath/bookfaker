-- 17/07/2013 --
ALTER TABLE `bf_match` ADD COLUMN `date` DATETIME NULL DEFAULT NULL  AFTER `id_team_two` ;

CREATE  TABLE IF NOT EXISTS `bf_sport_championship` (
  `id_sport` SMALLINT(6) NOT NULL ,
  `id_championship` SMALLINT(6) NOT NULL ,
  PRIMARY KEY (`id_sport`, `id_championship`) ,
  INDEX `fkchampionship_idx` (`id_championship` ASC) ,
  INDEX `fkteam0_idx` (`id_sport` ASC) ,
  CONSTRAINT `fkteam0`
    FOREIGN KEY (`id_sport` )
    REFERENCES `bf`.`bf_sport` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fkchampionship0`
    FOREIGN KEY (`id_championship` )
    REFERENCES `bf`.`bf_championship` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- 18/07/2013 --
ALTER TABLE `bf_match` ADD COLUMN `id_championnat` SMALLINT(6) NOT NULL  AFTER `date` ;
ALTER TABLE `bf_match` ADD COLUMN `resultat` ENUM('0','1','2') NULL DEFAULT Null AFTER `id_championnat` ;

-- 19/07/2013 --
ALTER TABLE  `bf_user` ADD  `isAdmin` TINYINT( 2 ) NOT NULL DEFAULT  '0'
CREATE  TABLE IF NOT EXISTS `bf_combination` (
  `id` SMALLINT(6) NOT NULL ,
  `bet` MEDIUMINT NOT NULL ,
  `combination` integer NOT NULL ,
  `checkbet` integer NOT NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fkcombination`
    FOREIGN KEY (`bet` )
    REFERENCES `bf`.`bf_bet` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `bf_gift` (
  `id` SMALLINT(6) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL ,
  `bookies` SMALLINT(6) NOT NULL ,
  `image` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;