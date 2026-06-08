-- ============================================================
--  Personal Homepage Database
--  Dibuat untuk tugas PHP + Bootstrap
--  Jalankan file ini di phpMyAdmin atau MySQL CLI
-- ============================================================

-- Buat dan pilih database
CREATE DATABASE IF NOT EXISTS personal_homepage
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE personal_homepage;

-- ============================================================
-- TABEL: users
-- Menyimpan data akun login
-- ============================================================
DROP TABLE IF EXISTS studies;
DROP TABLE IF EXISTS level;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id         INT          NOT NULL AUTO_INCREMENT,
    username   VARCHAR(50)  NOT NULL,
    password   VARCHAR(255) NOT NULL COMMENT 'bcrypt hash via PHP password_hash()',
    full_name  VARCHAR(100) NOT NULL,
    role       VARCHAR(50)  NOT NULL DEFAULT 'Admin',
    created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABEL: level
-- Menyimpan jenjang/level pendidikan
-- Field: id, nama
-- ============================================================
CREATE TABLE level (
    id   INT          NOT NULL AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABEL: studies
-- Menyimpan riwayat pendidikan
-- Field: id, nama, idlevel (FK), keterangan, tahun_lulus, foto_sekolah
-- ============================================================
CREATE TABLE studies (
    id           INT          NOT NULL AUTO_INCREMENT,
    nama         VARCHAR(150) NOT NULL COMMENT 'Nama sekolah/institusi',
    idlevel      INT          NOT NULL COMMENT 'FK ke tabel level',
    keterangan   TEXT                  COMMENT 'Keterangan / cerita singkat',
    tahun_lulus  YEAR                  COMMENT 'Tahun kelulusan',
    foto_sekolah VARCHAR(255)          COMMENT 'Nama file foto (disimpan di uploads/schools/)',
    PRIMARY KEY (id),
    CONSTRAINT fk_studies_level
        FOREIGN KEY (idlevel) REFERENCES level (id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- DATA: level
-- ============================================================
INSERT INTO level (id, nama) VALUES
(1,  'TK (Taman Kanak-Kanak)'),
(2,  'SD (Sekolah Dasar)'),
(3,  'SMP (Sekolah Menengah Pertama)'),
(4,  'SMA (Sekolah Menengah Atas)'),
(5,  'SMK (Sekolah Menengah Kejuruan)'),
(6,  'D1 (Diploma 1)'),
(7,  'D2 (Diploma 2)'),
(8,  'D3 (Diploma 3)'),
(9,  'D4 (Diploma 4)'),
(10, 'S1 (Sarjana / Strata 1)'),
(11, 'S2 (Magister / Strata 2)'),
(12, 'S3 (Doktor / Strata 3)');

-- ============================================================
-- DATA: studies (contoh riwayat pendidikan)
-- ============================================================
INSERT INTO studies (nama, idlevel, keterangan, tahun_lulus, foto_sekolah) VALUES
(
    'TK Pertiwi 01 Jakarta',
    1,
    'Masa pertama mengenal dunia pendidikan. Belajar bernyanyi, menggambar, dan bermain bersama teman-teman.',
    2008,
    NULL
),
(
    'SDN 05 Pagi Jakarta Pusat',
    2,
    'Menempuh pendidikan dasar selama 6 tahun. Aktif dalam kegiatan pramuka dan sering menjadi juara kelas.',
    2014,
    NULL
),
(
    'SMPN 1 Jakarta',
    3,
    'Mulai mengenal teknologi komputer dan internet. Bergabung dengan ekskul komputer dan memenangkan lomba sains tingkat kota.',
    2017,
    NULL
),
(
    'SMAN 8 Jakarta',
    4,
    'Mengambil jurusan IPA. Aktif di OSIS dan ekskul robotika. Meraih nilai UN tertinggi di jurusan.',
    2020,
    NULL
),
(
    'Universitas Indonesia — Teknik Informatika',
    10,
    'Saat ini sedang menempuh pendidikan S1. IPK saat ini 3.85. Aktif dalam penelitian AI dan pengembangan web.',
    NULL,
    NULL
);

-- ============================================================
-- DATA: users
--
-- PENTING: Password di bawah adalah placeholder.
-- Ikuti langkah berikut untuk set password 'admin123':
--
--   LANGKAH 1: Letakkan project di web server
--   LANGKAH 2: Buka http://localhost/php_project/generate_password.php
--   LANGKAH 3: Copy query UPDATE yang ditampilkan
--   LANGKAH 4: Jalankan query tersebut di sini (phpMyAdmin)
--   LANGKAH 5: Hapus file generate_password.php
--
-- ATAU jalankan query UPDATE di bawah setelah mendapat hash-nya.
-- ============================================================
INSERT INTO users (username, password, full_name, role) VALUES
(
    'admin',
    'GANTI_DENGAN_HASH_DARI_generate_password.php',
    'Administrator',
    'Admin'
),
(
    'user',
    'GANTI_DENGAN_HASH_DARI_generate_password.php',
    'User Biasa',
    'User'
);

-- ============================================================
-- SETELAH menjalankan generate_password.php, update password:
--
-- UPDATE users SET password = 'HASH_YANG_DIDAPAT' WHERE username = 'admin';
-- UPDATE users SET password = 'HASH_YANG_DIDAPAT' WHERE username = 'user';
--
-- Atau jalankan query di bawah ini langsung jika hash sudah diketahui.
-- ============================================================


-- ============================================================
-- VERIFIKASI: Cek struktur tabel
-- ============================================================
-- SELECT * FROM users;
-- SELECT * FROM level;
-- SELECT * FROM studies;
-- DESCRIBE level;
-- DESCRIBE studies;
-- DESCRIBE users;
-- SHOW CREATE TABLE studies;
