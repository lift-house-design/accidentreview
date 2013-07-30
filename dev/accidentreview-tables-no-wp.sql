SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `ar_user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ar_user` ;

CREATE  TABLE IF NOT EXISTS `ar_user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(64) NULL DEFAULT NULL ,
  `password` VARCHAR(64) NULL DEFAULT NULL ,
  `first_name` VARCHAR(32) NULL DEFAULT NULL ,
  `last_name` VARCHAR(32) NULL DEFAULT NULL ,
  `company_name` VARCHAR(45) NULL ,
  `signature` VARCHAR(64) NULL ,
  `street_address` VARCHAR(32) NULL DEFAULT NULL ,
  `city` VARCHAR(32) NULL DEFAULT NULL ,
  `state` VARCHAR(32) NULL DEFAULT NULL ,
  `zip` VARCHAR(10) NULL DEFAULT NULL ,
  `phone` VARCHAR(14) NULL DEFAULT NULL ,
  `mobile` VARCHAR(14) NULL DEFAULT NULL ,
  `fax` VARCHAR(14) NULL DEFAULT NULL ,
  `role` VARCHAR(16) NULL DEFAULT 'client' ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ar_attachments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ar_attachments` ;

CREATE  TABLE IF NOT EXISTS `ar_attachments` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `job_id` INT(11) NOT NULL ,
  `user_id` INT(11) NOT NULL ,
  `name` VARCHAR(64) NULL DEFAULT NULL ,
  `description` VARCHAR(256) NULL DEFAULT NULL ,
  `mime_type` VARCHAR(64) NULL DEFAULT NULL ,
  `url` VARCHAR(128) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_ar_attachments_ar_user1_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_ar_attachments_ar_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `ar_user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ar_job`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ar_job` ;

CREATE  TABLE IF NOT EXISTS `ar_job` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `client_user_id` INT(11) NOT NULL ,
  `tech_user_id` INT(11) NULL DEFAULT NULL ,
  `status` VARCHAR(32) NULL DEFAULT 'Pending' ,
  `type` VARCHAR(32) NULL DEFAULT NULL ,
  `created_at` DATETIME NULL DEFAULT NULL ,
  `file_number` VARCHAR(64) NULL DEFAULT NULL ,
  `date_of_loss` DATE NULL DEFAULT NULL ,
  `insured_name` VARCHAR(64) NULL DEFAULT NULL ,
  `loss_description` TEXT NULL DEFAULT NULL ,
  `services_requested` TEXT NULL DEFAULT NULL ,
  `loss_location` TEXT NULL ,
  `final_report` TEXT NULL ,
  `tos_agreement` TINYINT(1) UNSIGNED NULL DEFAULT NULL ,
  `autosave` TINYINT(1) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_ar_job_ar_user1_idx` (`client_user_id` ASC) ,
  INDEX `fk_ar_job_ar_user2_idx` (`tech_user_id` ASC) ,
  CONSTRAINT `fk_ar_job_ar_user1`
    FOREIGN KEY (`client_user_id` )
    REFERENCES `ar_user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ar_job_ar_user2`
    FOREIGN KEY (`tech_user_id` )
    REFERENCES `ar_user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 56231;


-- -----------------------------------------------------
-- Table `ar_job_answer`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ar_job_answer` ;

CREATE  TABLE IF NOT EXISTS `ar_job_answer` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `job_id` INT(10) UNSIGNED NOT NULL ,
  `question_key` VARCHAR(64) NULL DEFAULT NULL ,
  `question_type` VARCHAR(16) NULL DEFAULT NULL ,
  `question` VARCHAR(256) NULL DEFAULT NULL ,
  `possible_answers` VARCHAR(256) NULL DEFAULT NULL ,
  `answer` VARCHAR(256) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_dev_job_answers_dev_job_idx` (`job_id` ASC) ,
  CONSTRAINT `fk_dev_job_answers_dev_job`
    FOREIGN KEY (`job_id` )
    REFERENCES `ar_job` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ar_job_vehicle`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ar_job_vehicle` ;

CREATE  TABLE IF NOT EXISTS `ar_job_vehicle` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `job_id` INT(10) UNSIGNED NOT NULL ,
  `type` VARCHAR(16) NULL DEFAULT NULL ,
  `claimant_name` VARCHAR(64) NULL DEFAULT NULL ,
  `vin_number` VARCHAR(17) NULL DEFAULT NULL ,
  `year` INT(4) UNSIGNED NULL DEFAULT NULL ,
  `make` VARCHAR(32) NULL DEFAULT NULL ,
  `model` VARCHAR(32) NULL DEFAULT NULL ,
  `operator` VARCHAR(64) NULL DEFAULT NULL ,
  `color` VARCHAR(32) NULL DEFAULT NULL ,
  `registration_number` VARCHAR(64) NULL DEFAULT NULL ,
  `additional_info` TEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_dev_job_vehicle_dev_job1_idx` (`job_id` ASC) ,
  CONSTRAINT `fk_dev_job_vehicle_dev_job1`
    FOREIGN KEY (`job_id` )
    REFERENCES `ar_job` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ar_job_vehicle_answer`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ar_job_vehicle_answer` ;

CREATE  TABLE IF NOT EXISTS `ar_job_vehicle_answer` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `vehicle_id` INT(10) UNSIGNED NOT NULL ,
  `question_key` VARCHAR(64) NULL DEFAULT NULL ,
  `question_type` VARCHAR(16) NULL DEFAULT NULL ,
  `question` VARCHAR(256) NULL DEFAULT NULL ,
  `possible_answers` VARCHAR(256) NULL DEFAULT NULL ,
  `answer` VARCHAR(256) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_ar_job_vehicle_answer_ar_job_vehicle1_idx` (`vehicle_id` ASC) ,
  CONSTRAINT `fk_ar_job_vehicle_answer_ar_job_vehicle1`
    FOREIGN KEY (`vehicle_id` )
    REFERENCES `ar_job_vehicle` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ar_correspondence`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ar_correspondence` ;

CREATE  TABLE IF NOT EXISTS `ar_correspondence` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `from_user_id` INT(11) NOT NULL ,
  `job_id` INT(10) UNSIGNED NOT NULL ,
  `message` TEXT NOT NULL ,
  `created_at` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_ar_correspondence_ar_user1_idx` (`from_user_id` ASC) ,
  INDEX `fk_ar_correspondence_ar_job1_idx` (`job_id` ASC) ,
  CONSTRAINT `fk_ar_correspondence_ar_user1`
    FOREIGN KEY (`from_user_id` )
    REFERENCES `ar_user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ar_correspondence_ar_job1`
    FOREIGN KEY (`job_id` )
    REFERENCES `ar_job` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ar_update`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ar_update` ;

CREATE  TABLE IF NOT EXISTS `ar_update` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT(11) NOT NULL ,
  `job_id` INT(10) UNSIGNED NOT NULL ,
  `message` VARCHAR(256) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_ar_update_ar_user1_idx` (`user_id` ASC) ,
  INDEX `fk_ar_update_ar_job1_idx` (`job_id` ASC) ,
  CONSTRAINT `fk_ar_update_ar_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `ar_user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ar_update_ar_job1`
    FOREIGN KEY (`job_id` )
    REFERENCES `ar_job` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ar_admin_clients`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ar_admin_clients` ;

CREATE  TABLE IF NOT EXISTS `ar_admin_clients` (
  `client_admin_id` INT(11) NOT NULL ,
  `client_rep_id` INT(11) NOT NULL ,
  INDEX `fk_ar_admin_clients_ar_user1_idx` (`client_admin_id` ASC) ,
  PRIMARY KEY (`client_admin_id`, `client_rep_id`) ,
  INDEX `fk_ar_admin_clients_ar_user2_idx` (`client_rep_id` ASC) ,
  CONSTRAINT `fk_ar_admin_clients_ar_user1`
    FOREIGN KEY (`client_admin_id` )
    REFERENCES `ar_user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ar_admin_clients_ar_user2`
    FOREIGN KEY (`client_rep_id` )
    REFERENCES `ar_user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ar_final_report_archive`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ar_final_report_archive` ;

CREATE  TABLE IF NOT EXISTS `ar_final_report_archive` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT(11) NOT NULL ,
  `job_id` INT(10) UNSIGNED NOT NULL ,
  `created_at` DATETIME NOT NULL ,
  `final_report` TEXT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_ar_final_report_archive_ar_user1_idx` (`user_id` ASC) ,
  INDEX `fk_ar_final_report_archive_ar_job1_idx` (`job_id` ASC) ,
  CONSTRAINT `fk_ar_final_report_archive_ar_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `ar_user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ar_final_report_archive_ar_job1`
    FOREIGN KEY (`job_id` )
    REFERENCES `ar_job` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `ar_user`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `ar_user` (`id`, `email`, `password`, `first_name`, `last_name`, `company_name`, `signature`, `street_address`, `city`, `state`, `zip`, `phone`, `mobile`, `fax`, `role`) VALUES (1, 'nickniebaum@gmail.com', '4f1f8def85fc3bf2dc58f04a667c8273b37a8b4c', 'Nick', 'Niebaum', 'MVBeattie', NULL, '4009 Banister Ln', 'Austin', 'TX', '78704', '(304) 871-6066', NULL, NULL, 'admin');
INSERT INTO `ar_user` (`id`, `email`, `password`, `first_name`, `last_name`, `company_name`, `signature`, `street_address`, `city`, `state`, `zip`, `phone`, `mobile`, `fax`, `role`) VALUES (2, 'mike@mvbeattie.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Mike', 'Beattie', 'MVBeattie', NULL, '4009 Banister Ln', 'Austin', 'TX', '78704', NULL, NULL, NULL, 'admin');
INSERT INTO `ar_user` (`id`, `email`, `password`, `first_name`, `last_name`, `company_name`, `signature`, `street_address`, `city`, `state`, `zip`, `phone`, `mobile`, `fax`, `role`) VALUES (3, 'paul@accidentreview.com', '72da99125c2b89a8302c52573bad7aa8f70ad7fb', 'Paul', 'Lyons', 'AccidentReview', NULL, '218 Evergreen Pkwy', 'Palm Beach Gardens', 'FL', '33410', '(401) 529-3666', NULL, NULL, 'admin');
INSERT INTO `ar_user` (`id`, `email`, `password`, `first_name`, `last_name`, `company_name`, `signature`, `street_address`, `city`, `state`, `zip`, `phone`, `mobile`, `fax`, `role`) VALUES (4, 'lyonscars@mac.com', '72da99125c2b89a8302c52573bad7aa8f70ad7fb', 'Bali', 'Lyons', 'AccidentReview', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'client');
INSERT INTO `ar_user` (`id`, `email`, `password`, `first_name`, `last_name`, `company_name`, `signature`, `street_address`, `city`, `state`, `zip`, `phone`, `mobile`, `fax`, `role`) VALUES (5, 'nick@lifthousedesign.com', '4f1f8def85fc3bf2dc58f04a667c8273b37a8b4c', 'Nicks', 'Client', 'MVBeattie', NULL, '4009 Banister Ln', 'Austin', 'TX', '78704', '(304) 871-6066', NULL, NULL, 'client');
INSERT INTO `ar_user` (`id`, `email`, `password`, `first_name`, `last_name`, `company_name`, `signature`, `street_address`, `city`, `state`, `zip`, `phone`, `mobile`, `fax`, `role`) VALUES (6, 'nick@mvbeattie.com', '4f1f8def85fc3bf2dc58f04a667c8273b37a8b4c', 'Nicks', 'ClientAdmin', 'MVBeattie', NULL, '4009 Banister Ln', 'Austin', 'TX', '78704', '(304) 871-6066', NULL, NULL, 'client_admin');
INSERT INTO `ar_user` (`id`, `email`, `password`, `first_name`, `last_name`, `company_name`, `signature`, `street_address`, `city`, `state`, `zip`, `phone`, `mobile`, `fax`, `role`) VALUES (7, 'nniebaum@gmail.com', '4f1f8def85fc3bf2dc58f04a667c8273b37a8b4c', 'Nicks', 'Tech', 'MVBeattie', NULL, '4009 Banister Ln', 'Austin', 'TX', '78704', '(304) 871-6066', NULL, NULL, 'tech');

COMMIT;

-- -----------------------------------------------------
-- Data for table `ar_admin_clients`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `ar_admin_clients` (`client_admin_id`, `client_rep_id`) VALUES (6, 5);

COMMIT;
