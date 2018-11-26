CREATE TABLE IF NOT EXISTS `simpleedu`.`menu` (
  `id_item` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(100) CHARACTER SET 'utf8' NULL,
  `id_parent` INT UNSIGNED NULL,
  PRIMARY KEY (`id_item`),
  INDEX (`id_parent` ASC),
    FOREIGN KEY (`id_parent`)
    REFERENCES `simpleedu`.`menu` (`id_item`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB CHARACTER SET=UTF8;

CREATE TABLE IF NOT EXISTS `simpleedu`.`content` (
  `id_content` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tittle` VARCHAR(500) NULL,
  `description` VARCHAR(4000) NULL,
  `id_item` INT UNSIGNED NULL,
  PRIMARY KEY (`id_content`),
  INDEX (`id_item` ASC),
    FOREIGN KEY (`id_item`)
    REFERENCES `simpleedu`.`menu` (`id_item`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB CHARACTER SET=UTF8;

CREATE TABLE IF NOT EXISTS `simpleedu`.`questions` (
  `id_questions` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `question` VARCHAR(300) NULL,
  `id_content` INT UNSIGNED NULL,
  PRIMARY KEY (`id_questions`),
  INDEX `id_content_idx` (`id_content` ASC),
    FOREIGN KEY (`id_content`)
    REFERENCES `simpleedu`.`content` (`id_content`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB CHARACTER SET=UTF8;

CREATE TABLE IF NOT EXISTS `simpleedu`.`chanels` (
  `id_chanel` VARCHAR(100) NOT NULL,
  `title` VARCHAR(45) NULL,
  `description` VARCHAR(45) NULL,
  `id_content` INT UNSIGNED NULL,
  `statistics` VARCHAR(4000) NULL DEFAULT NULL,
  PRIMARY KEY (`id_chanel`),
  INDEX `id_content_idx` (`id_content` ASC),
    FOREIGN KEY (`id_content`)
    REFERENCES `simpleedu`.`content` (`id_content`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB CHARACTER SET=UTF8;

CREATE TABLE IF NOT EXISTS `simpleedu`.`playlist` (
  `id_playlist` VARCHAR(100) NOT NULL,
  `id_chanel` VARCHAR(100) NULL,
  `id_content` INT UNSIGNED NULL,
  `title` VARCHAR(45) NULL,
  `description` VARCHAR(45) NULL,
  `statistics` VARCHAR(4000) NULL DEFAULT NULL,
  PRIMARY KEY (`id_playlist`),
  INDEX `id_content_idx` (`id_content` ASC),
  INDEX `id_chanel_idx` (`id_chanel` ASC),
    FOREIGN KEY (`id_content`)
    REFERENCES `simpleedu`.`content` (`id_content`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION,
    FOREIGN KEY (`id_chanel`)
    REFERENCES `simpleedu`.`chanels` (`id_chanel`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB CHARACTER SET=UTF8;

CREATE TABLE IF NOT EXISTS `simpleedu`.`video` (
  `id_video` VARCHAR(100) NOT NULL,
  `title` VARCHAR(45) NULL,
  `description` VARCHAR(45) NULL,
  `id_playlist` VARCHAR(100) NULL,
  `id_content` INT UNSIGNED NULL,
  `statistics` VARCHAR(4000) NULL DEFAULT NULL,
  PRIMARY KEY (`id_video`),
  INDEX `id_videolist_idx` (`id_playlist` ASC),
  INDEX `id_content_idx` (`id_content` ASC),
    FOREIGN KEY (`id_playlist`)
    REFERENCES `simpleedu`.`playlist` (`id_playlist`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
    FOREIGN KEY (`id_content`)
    REFERENCES `simpleedu`.`content` (`id_content`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB CHARACTER SET=UTF8;