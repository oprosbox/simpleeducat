CREATE TABLE IF NOT EXISTS `menu` (
  `id_item` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(1000) NULL,
  `description` VARCHAR(10000) NULL,
  `id_parent` INT UNSIGNED NULL,
  PRIMARY KEY (`id_item`),
  INDEX (`id_parent` ASC),
    FOREIGN KEY (`id_parent`)
    REFERENCES `menu` (`id_item`)
    ON DELETE SET NULL)
ENGINE = InnoDB CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS `content` (
  `id_content` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tittle` VARCHAR(1000) NULL,
  `description` VARCHAR(10000) NULL,
  `id_item` INT UNSIGNED NULL,
  PRIMARY KEY (`id_content`),
  INDEX (`id_item` ASC),
    FOREIGN KEY (`id_item`)
    REFERENCES `menu` (`id_item`)
    ON DELETE SET NULL)
ENGINE = InnoDB CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS `questions` (
  `id_question` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_quest` VARCHAR(300) NULL,
  `question` VARCHAR(1000) NULL,
  `title` VARCHAR(1000) NULL,
  `description` VARCHAR(10000) NULL,
  `id_content` INT UNSIGNED NULL,
  PRIMARY KEY (`id_question`),
  INDEX `id_content_idx` (`id_content` ASC),
    FOREIGN KEY (`id_content`)
    REFERENCES `content` (`id_content`)
    ON DELETE SET NULL)
ENGINE = InnoDB CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS `sources` (
  `id` VARCHAR(100) NOT NULL,
  `id_parent` VARCHAR(100) NULL,
  `id_content` INT UNSIGNED NULL,
  `type_source` VARCHAR(100) NULL,
  `title` VARCHAR(1000) NULL,
  `description` VARCHAR(10000) NULL,
  `thumbnails` VARCHAR(4000) NULL DEFAULT NULL,
  `statistics` VARCHAR(4000) NULL DEFAULT NULL,
  `time_update` DATETIME,
  PRIMARY KEY (`id`),
  UNIQUE KEY(`id`),
  INDEX `id_idx` (`id` ASC),
  INDEX `id_parent_idx` (`id_parent` ASC),
    FOREIGN KEY (`id_parent`)
    REFERENCES `sources` (`id`)
    ON DELETE CASCADE,
    FOREIGN KEY (`id_content`)
    REFERENCES `content` (`id_content`)
    ON DELETE SET NULL)
ENGINE = InnoDB CHARACTER SET utf8;
