CREATE DATABASE IF NOT EXISTS `scrabble`;
USE `scrabble`;

CREATE TABLE `user` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `username` VARCHAR(100) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NULL DEFAULT NULL,
    `role` TINYINT DEFAULT 2 COMMENT '0=developer, 1=admin, 2=user',
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `deleted_at` DATETIME DEFAULT NULL
) ENGINE=InnoDB;

CREATE TABLE `partie` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `language` VARCHAR(2) NOT NULL DEFAULT 'fr',
    `letter_bag` VARCHAR(105) NULL DEFAULT NULL,
    `state` ENUM('waiting', 'in_progress', 'finished') DEFAULT 'waiting',
    `turn_player_id` INT NULL DEFAULT NULL,
    `date_start` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `date_end` DATETIME NULL DEFAULT NULL
) ENGINE=InnoDB;

-- Intermediate table for flexible player tracking per game
CREATE TABLE `partie_player` (
    `partie_id` INT NOT NULL,
    `user_id` INT NOT NULL,
    `player_order` TINYINT NOT NULL COMMENT '1, 2, 3, or 4',
    `score` INT DEFAULT 0,
    `chevalet` VARCHAR(7) NULL DEFAULT NULL,
    PRIMARY KEY (`partie_id`, `user_id`),
    FOREIGN KEY (`partie_id`) REFERENCES `partie`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`user_id`) REFERENCES `user`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Lightweight alternative to 225 columns: Store occupied cells
CREATE TABLE `board_tile` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `partie_id` INT NOT NULL,
    `row_idx` TINYINT NOT NULL COMMENT '1 to 15',
    `col_idx` TINYINT NOT NULL COMMENT '1 to 15',
    `letter` VARCHAR(2) NOT NULL,
    FOREIGN KEY (`partie_id`) REFERENCES `partie`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `log_action_jeu` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `partie_id` INT NOT NULL,
    `player_id` INT NOT NULL,
    `word` VARCHAR(15) NULL DEFAULT NULL,
    `location_start` VARCHAR(8) NULL DEFAULT NULL,
    `location_end` VARCHAR(8) NULL DEFAULT NULL,
    `score` INT NULL DEFAULT NULL,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`partie_id`) REFERENCES `partie`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`player_id`) REFERENCES `user`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- log admin and debugging
CREATE TABLE `logs` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `data` TEXT NOT NULL,
    `user` VARCHAR(128) NULL DEFAULT NULL,
    `context` VARCHAR(255) NULL DEFAULT NULL,
    `type` VARCHAR(50) NULL DEFAULT NULL,
    `sys_datecre` DATETIME DEFAULT CURRENT_TIMESTAMP
);