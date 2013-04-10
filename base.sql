SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `sb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `sb` ;

-- -----------------------------------------------------
-- Table `sb`.`users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sb`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(45) NOT NULL ,
  `first_name` VARCHAR(45) NULL ,
  `last_name` VARCHAR(45) NULL ,
  `email` VARCHAR(100) NOT NULL ,
  `city` VARCHAR(45) NULL ,
  `avatar` VARCHAR(100) NULL ,
  `about` TEXT NULL ,
  `role` VARCHAR(20) NOT NULL ,
  `created` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sb`.`categories`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sb`.`categories` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NOT NULL ,
  `created` DATETIME NULL ,
  `about` TEXT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sb`.`songs`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sb`.`songs` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(100) NOT NULL ,
  `chords` TEXT NULL ,
  `tempo` INT(4) UNSIGNED NULL ,
  `lyrics` TEXT NULL ,
  `rate` INT NULL ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  `approved` TINYINT(1) NULL ,
  `fork` INT NULL ,
  `category_id` INT NOT NULL ,
  `user_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_songs_categories1_idx` (`category_id` ASC) ,
  INDEX `fk_songs_users1_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_songs_categories1`
    FOREIGN KEY (`category_id` )
    REFERENCES `sb`.`categories` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_songs_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `sb`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sb`.`groups`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sb`.`groups` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NOT NULL ,
  `about` TEXT NULL ,
  `leader_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_groups_users1_idx` (`leader_id` ASC) ,
  CONSTRAINT `fk_groups_users1`
    FOREIGN KEY (`leader_id` )
    REFERENCES `sb`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sb`.`group_members`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sb`.`group_members` (
  `users_id` INT NOT NULL ,
  `groups_id` INT NOT NULL ,
  PRIMARY KEY (`users_id`, `groups_id`) ,
  INDEX `fk_group_members_groups1_idx` (`groups_id` ASC) ,
  CONSTRAINT `fk_group_members_users1`
    FOREIGN KEY (`users_id` )
    REFERENCES `sb`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_group_members_groups1`
    FOREIGN KEY (`groups_id` )
    REFERENCES `sb`.`groups` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sb`.`group_songs`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sb`.`group_songs` (
  `groups_id` INT NOT NULL ,
  `songs_id` INT NOT NULL ,
  `video` VARCHAR(100) NOT NULL ,
  `about` TEXT NULL ,
  PRIMARY KEY (`groups_id`, `songs_id`) ,
  INDEX `fk_group_songs_songs1_idx` (`songs_id` ASC) ,
  CONSTRAINT `fk_group_songs_groups1`
    FOREIGN KEY (`groups_id` )
    REFERENCES `sb`.`groups` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_group_songs_songs1`
    FOREIGN KEY (`songs_id` )
    REFERENCES `sb`.`songs` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sb`.`tags`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sb`.`tags` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sb`.`song_tags`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sb`.`song_tags` (
  `tag_id` INT NOT NULL ,
  `song_id` INT NOT NULL ,
  PRIMARY KEY (`tag_id`, `song_id`) ,
  INDEX `fk_song_tags_songs1_idx` (`song_id` ASC) ,
  CONSTRAINT `fk_song_tags_tags1`
    FOREIGN KEY (`tag_id` )
    REFERENCES `sb`.`tags` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_song_tags_songs1`
    FOREIGN KEY (`song_id` )
    REFERENCES `sb`.`songs` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sb`.`events`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sb`.`events` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NOT NULL ,
  `place` TINYTEXT NOT NULL ,
  `event_date` DATETIME NOT NULL ,
  `about` TEXT NULL ,
  `group_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_events_groups1_idx` (`group_id` ASC) ,
  CONSTRAINT `fk_events_groups1`
    FOREIGN KEY (`group_id` )
    REFERENCES `sb`.`groups` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sb`.`event_songs`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sb`.`event_songs` (
  `events_id` INT NOT NULL ,
  `songs_id` INT NOT NULL ,
  `description` TINYTEXT NULL ,
  `order` INT NULL ,
  PRIMARY KEY (`events_id`, `songs_id`) ,
  INDEX `fk_event_songs_songs1_idx` (`songs_id` ASC) ,
  CONSTRAINT `fk_event_songs_events1`
    FOREIGN KEY (`events_id` )
    REFERENCES `sb`.`events` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_event_songs_songs1`
    FOREIGN KEY (`songs_id` )
    REFERENCES `sb`.`songs` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sb`.`favourites`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sb`.`favourites` (
  `users_id` INT NOT NULL ,
  `songs_id` INT NOT NULL ,
  PRIMARY KEY (`users_id`, `songs_id`) ,
  INDEX `fk_favourites_songs1_idx` (`songs_id` ASC) ,
  CONSTRAINT `fk_favourites_users1`
    FOREIGN KEY (`users_id` )
    REFERENCES `sb`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_favourites_songs1`
    FOREIGN KEY (`songs_id` )
    REFERENCES `sb`.`songs` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `sb` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;