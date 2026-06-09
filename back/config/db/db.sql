-- db.sql
CREATE DATABASE `scrabble`;
USE `scrabble`;
CREATE TABLE `user` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `username` VARCHAR(100) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NULL DEFAULT NULL,
    `role` TINYINT(2) DEFAULT 2 COMMENT '0=developer, 1=admin, 2=user',
    `sys_datecre` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `sys_datesup` DATETIME DEFAULT NULL,
);

CREATE TABLE `logs` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `data` TEXT NOT NULL,
    `user` VARCHAR(100) NULL DEFAULT NULL,
    `context` VARCHAR(255) NULL DEFAULT NULL,
    `type` VARCHAR(50) NULL DEFAULT NULL,
    `sys_datecre` DATETIME DEFAULT CURRENT_TIMESTAMP
);

/*
CREATE TABLE `game` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `score` INT NOT NULL,
    `sys_date
*/