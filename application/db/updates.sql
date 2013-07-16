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