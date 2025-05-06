-- Luo tietokanta (jos ei ole olemassa)
CREATE DATABASE IF NOT EXISTS reseptipankki CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Käytä tietokantaa
USE reseptipankki;

-- Luo käyttäjätaulu
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    birth_year INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;