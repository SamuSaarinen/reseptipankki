-- Luo reseptitaulu ENUM-kategorioilla
CREATE TABLE IF NOT EXISTS recipes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    added_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    category ENUM('aamiainen', 'paaruoka', 'valipala', 'jalkiruoka', 'muu') NOT NULL,
    ingredients TEXT NOT NULL,
    instructions TEXT NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;