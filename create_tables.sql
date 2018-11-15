CREATE TABLE IF NOT EXISTS `mydb`.`menu` (
  `id_item` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(100) CHARACTER SET 'utf8' NULL,
  `id_parent` INT UNSIGNED NULL,
  PRIMARY KEY (`id_item`, `id_parent`),
  INDEX `id_parent_idx` (`id_parent` ASC),
  CONSTRAINT `id_parent`
    FOREIGN KEY (`id_parent`)
    REFERENCES `mydb`.`menu` (`id_item`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB

CREATE TABLE IF NOT EXISTS `mydb`.`content` (
  `id_content` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tittle` VARCHAR(500) NULL,
  `description` VARCHAR(4000) NULL,
  `id_item` INT UNSIGNED NULL,
  PRIMARY KEY (`id_content`, `id_item`),
  INDEX `id_item_idx` (`id_item` ASC),
  CONSTRAINT `id_item`
    FOREIGN KEY (`id_item`)
    REFERENCES `mydb`.`menu` (`id_item`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB

CREATE TABLE IF NOT EXISTS `mydb`.`questions` (
  `id_questions` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `question` VARCHAR(300) NULL,
  `id_content` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_questions`, `id_content`),
  INDEX `id_content_idx` (`id_content` ASC),
  CONSTRAINT `id_content`
    FOREIGN KEY (`id_content`)
    REFERENCES `mydb`.`content` (`id_content`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB

CREATE TABLE IF NOT EXISTS `mydb`.`videolist` (
  `id_videolist` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_chanel` INT UNSIGNED NULL,
  `id_content` INT UNSIGNED NULL,
  `title` VARCHAR(45) NULL,
  `description` VARCHAR(45) NULL,
  `id_youtublist` VARCHAR(50) NULL,
  PRIMARY KEY (`id_videolist`, `id_chanel`, `id_content`),
  INDEX `id_content_idx` (`id_content` ASC),
  INDEX `id_chanel_idx` (`id_chanel` ASC),
  CONSTRAINT `id_content`
    FOREIGN KEY (`id_content`)
    REFERENCES `mydb`.`content` (`id_content`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_chanel`
    FOREIGN KEY (`id_chanel`)
    REFERENCES `mydb`.`chanels` (`id_chanel`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB

CREATE TABLE IF NOT EXISTS `mydb`.`video` (
  `id_video` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NULL,
  `description` VARCHAR(45) NULL,
  `id_videolist` INT UNSIGNED NULL,
  `id_content` INT UNSIGNED NULL,
  PRIMARY KEY (`id_video`, `id_videolist`, `id_content`),
  INDEX `id_videolist_idx` (`id_videolist` ASC),
  INDEX `id_content_idx` (`id_content` ASC),
  CONSTRAINT `id_videolist`
    FOREIGN KEY (`id_videolist`)
    REFERENCES `mydb`.`videolist` (`id_videolist`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_content`
    FOREIGN KEY (`id_content`)
    REFERENCES `mydb`.`content` (`id_content`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB

CREATE TABLE IF NOT EXISTS `mydb`.`chanels` (
  `id_chanel` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NULL,
  `description` VARCHAR(45) NULL,
  `id_content` INT UNSIGNED NULL,
  `id_parent` INT UNSIGNED NULL,
  PRIMARY KEY (`id_chanel`, `id_parent`, `id_content`),
  INDEX `id_content_idx` (`id_content` ASC),
  INDEX `id_chanel_idx` (`id_parent` ASC),
  CONSTRAINT `id_content`
    FOREIGN KEY (`id_content`)
    REFERENCES `mydb`.`content` (`id_content`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_parent`
    FOREIGN KEY (`id_parent`)
    REFERENCES `mydb`.`chanels` (`id_chanel`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB