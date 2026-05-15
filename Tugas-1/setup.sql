-- Personal Homepage Database Setup
-- Run this SQL in your MySQL/MariaDB server

CREATE DATABASE IF NOT EXISTS personal_homepage CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE personal_homepage;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    role VARCHAR(50) DEFAULT 'Admin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Level table (jenjang pendidikan)
CREATE TABLE IF NOT EXISTS level (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL
);

-- Studies table
CREATE TABLE IF NOT EXISTS studies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(150) NOT NULL,
    idlevel INT NOT NULL,
    keterangan TEXT,
    tahun_lulus YEAR,
    foto_sekolah VARCHAR(255),
    FOREIGN KEY (idlevel) REFERENCES level(id) ON DELETE RESTRICT
);

-- Insert default user (password: admin123)
INSERT INTO users (username, password, full_name, role) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', 'Admin')
ON DUPLICATE KEY UPDATE id=id;

-- Insert sample education levels
INSERT INTO level (nama) VALUES
('TK (Taman Kanak-Kanak)'),
('SD (Sekolah Dasar)'),
('SMP (Sekolah Menengah Pertama)'),
('SMA/SMK (Sekolah Menengah Atas)'),
('D3 (Diploma 3)'),
('S1 (Sarjana)'),
('S2 (Magister)'),
('S3 (Doktor)')
ON DUPLICATE KEY UPDATE id=id;

-- Note: Default password for admin is "password" (Laravel's Hash::make default)
-- To set password "admin123", use PHP: password_hash('admin123', PASSWORD_DEFAULT)
-- Update with: UPDATE users SET password = PASSWORD_HASH_HERE WHERE username = 'admin';
