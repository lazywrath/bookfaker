
-- -----------------------------------------------------
-- Table `bf_sport`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bf_sport` (
  `id` SMALLINT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bf_team`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bf_team` (
  `id` MEDIUMINT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `id_sport` SMALLINT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_team_sport_idx` (`id_sport` ASC) ,
  CONSTRAINT `fk_team_sport`
    FOREIGN KEY (`id_sport` )
    REFERENCES `bf_sport` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bf_championship`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bf_championship` (
  `id` SMALLINT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bf_user`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bf_user` (
  `id` MEDIUMINT NOT NULL AUTO_INCREMENT ,
  `firstname` VARCHAR(45) NULL ,
  `lastname` VARCHAR(45) NULL ,
  `username` VARCHAR(45) NOT NULL ,
  `address` VARCHAR(45) NULL ,
  `zip` VARCHAR(20) NULL ,
  `city` VARCHAR(45) NULL ,
  `email` VARCHAR(45) NULL ,
  `password` VARCHAR(40) NOT NULL ,
  `moneybank` INT UNSIGNED NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bf_match`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bf_match` (
  `id` MEDIUMINT NOT NULL AUTO_INCREMENT ,
  `id_team_one` MEDIUMINT NOT NULL ,
  `id_team_two` MEDIUMINT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_match_team1_idx` (`id_team_one` ASC) ,
  INDEX `fk_match_team2_idx` (`id_team_two` ASC) ,
  CONSTRAINT `fk_match_team1`
    FOREIGN KEY (`id_team_one` )
    REFERENCES `bf_team` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_match_team2`
    FOREIGN KEY (`id_team_two` )
    REFERENCES `bf_team` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bf_bet`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bf_bet` (
  `id` MEDIUMINT NOT NULL AUTO_INCREMENT ,
  `id_match` MEDIUMINT NOT NULL ,
  `id_user` MEDIUMINT NOT NULL ,
  `resultat`ENUM('0','1','2') NULL DEFAULT NULL ,
  `odds` FLOAT UNSIGNED NOT NULL ,
  `stake` MEDIUMINT UNSIGNED NOT NULL ,
  `status` ENUM('0','1','2') NULL DEFAULT '0' ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_idx` (`id_match` ASC) ,
  INDEX `fk_bet_user_idx` (`id_user` ASC) ,
  CONSTRAINT `fk_bet_match`
    FOREIGN KEY (`id_match` )
    REFERENCES `bf_match` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bet_user`
    FOREIGN KEY (`id_user` )
    REFERENCES `bf_user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bf_bailout`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bf_bailout` (
  `id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `id_user` MEDIUMINT NOT NULL ,
  `amout` SMALLINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_bailout_user_idx` (`id_user` ASC) ,
  CONSTRAINT `fk_bailout_user`
    FOREIGN KEY (`id_user` )
    REFERENCES `bf_user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bf_bookmaker`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bf_bookmaker` (
  `id` SMALLINT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bf_odds`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bf_odds` (
  `id` MEDIUMINT NOT NULL AUTO_INCREMENT ,
  `id_match` MEDIUMINT NOT NULL ,
  `odds_team_one` FLOAT NULL ,
  `odds_team_two` FLOAT NULL ,
  `odds_draw` FLOAT NULL ,
  `id_bookmaker` SMALLINT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_odds_bookmaker_idx` (`id_bookmaker` ASC) ,
  INDEX `fk_odds_match_idx` (`id_match` ASC) ,
  CONSTRAINT `fk_odds_bookmaker`
    FOREIGN KEY (`id_bookmaker` )
    REFERENCES `bf_bookmaker` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_odds_match`
    FOREIGN KEY (`id_match` )
    REFERENCES `bf_match` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bf_team_championship`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bf_team_championship` (
  `id_team` MEDIUMINT NOT NULL ,
  `id_championship` SMALLINT NOT NULL ,
  PRIMARY KEY (`id_team`, `id_championship`) ,
  INDEX `fkteam_idx` (`id_team` ASC) ,
  INDEX `fkchampionship_idx` (`id_championship` ASC) ,
  CONSTRAINT `fkteam`
    FOREIGN KEY (`id_team` )
    REFERENCES `bf_team` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fkchampionship`
    FOREIGN KEY (`id_championship` )
    REFERENCES `bf_championship` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

