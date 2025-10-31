CREATE DATABASE IF NOT EXISTS futbol_persistencia DEFAULT CHARACTER
SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE futbol_persistencia;

CREATE TABLE teams (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    stadium VARCHAR(150) NOT NULL
);

CREATE TABLE matches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    team_home_id INT NOT NULL,
    team_away_id INT NOT NULL,
    jornada INT NOT NULL,
    result ENUM ('1', 'X', '2') NOT NULL,
    stadium VARCHAR(150) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_home FOREIGN KEY (team_home_id) REFERENCES teams (id) ON DELETE CASCADE,
    CONSTRAINT fk_away FOREIGN KEY (team_away_id) REFERENCES teams (id) ON DELETE CASCADE
);