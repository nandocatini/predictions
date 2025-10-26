-- Database schema for the football predictions app

DROP TABLE IF EXISTS `predictions`;
DROP TABLE IF EXISTS `tipsters`;
DROP TABLE IF EXISTS `events`;
DROP TABLE IF EXISTS `teams`;
DROP TABLE IF EXISTS `leagues`;

CREATE TABLE IF NOT EXISTS `leagues` (
  `id` INT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `country` VARCHAR(255),
  `logo` VARCHAR(255),
  `current_season` INT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `teams` (
  `id` INT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `logo` VARCHAR(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `events` (
  `id` INT PRIMARY KEY,
  `league_id` INT NOT NULL,
  `home_team_id` INT NOT NULL,
  `away_team_id` INT NOT NULL,
  `event_date` DATETIME NOT NULL,
  `status` VARCHAR(50),
  `home_score` TINYINT,
  `away_score` TINYINT,
  FOREIGN KEY (`league_id`) REFERENCES `leagues`(`id`),
  FOREIGN KEY (`home_team_id`) REFERENCES `teams`(`id`),
  FOREIGN KEY (`away_team_id`) REFERENCES `teams`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `tipsters` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `accuracy_kpi` FLOAT DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `predictions` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `event_id` INT NOT NULL,
  `tipster_id` INT,
  `prediction_type` VARCHAR(100) NOT NULL, -- e.g., '1X2', 'Over/Under', 'GG/NG'
  `prediction_value` VARCHAR(100) NOT NULL, -- e.g., '1', 'Over 2.5', 'GG'
  `status` ENUM('pending', 'won', 'lost') DEFAULT 'pending',
  FOREIGN KEY (`event_id`) REFERENCES `events`(`id`),
  FOREIGN KEY (`tipster_id`) REFERENCES `tipsters`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
