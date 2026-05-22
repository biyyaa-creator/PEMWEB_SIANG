<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Database Installer — Personal Homepage</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.2/dist/minty/bootstrap.min.css">
<style>
  body { background: #fff5f8; font-family: 'Segoe UI', sans-serif; }
  .log-box { background: #1a1a2e; color: #e0e0e0; border-radius: 12px; padding: 20px; font-family: monospace; font-size: 0.88rem; max-height: 400px; overflow-y: auto; }
  .log-ok   { color: #69f0ae; }
  .log-err  { color: #ff5252; }
  .log-info { color: #80d8ff; }
  .log-warn { color: #ffd740; }
</style>
</head>
<body>
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">

      <div class="text-center mb-4">
        <div style="font-size:3rem;">🌸</div>
        <h3 class="fw-bold" style="color:#c2185b;">Database Installer</h3>
        <p class="text-muted">Personal Homepage — Setup Otomatis</p>
      </div>

<?php
// ============================================================
// KONFIGURASI — Sesuaikan dengan server Anda
// ============================================================
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';          // Kosongkan jika tidak ada password
$DB_NAME = 'personal_homepage';
$ADMIN_PASSWORD = 'admin123';   // Password akun admin
$USER_PASSWORD  = 'user123';    // Password akun user biasa
// ============================================================

$logs = [];

function logMsg($type, $msg) {
    global $logs;
    $logs[] = ['type' => $type, 'msg' => $msg];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $host = trim($_POST['db_host'] ?? $DB_HOST);
    $user = trim($_POST['db_user'] ?? $DB_USER);
    $pass = $_POST['db_pass'] ?? $DB_PASS;
    $name = trim($_POST['db_name'] ?? $DB_NAME);
    $adminPw = $_POST['admin_pw'] ?? $ADMIN_PASSWORD;
    $userPw  = $_POST['user_pw']  ?? $USER_PASSWORD;

    // Connect without DB first
    $conn = @new mysqli($host, $user, $pass);
    if ($conn->connect_error) {
        logMsg('err', '❌ Gagal koneksi ke MySQL: ' . $conn->connect_error);
    } else {
        logMsg('ok', '✅ Koneksi MySQL berhasil!');

        // Create database
        $conn->query("CREATE DATABASE IF NOT EXISTS `$name` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        logMsg('ok', "✅ Database '$name' siap.");

        $conn->select_db($name);

        // Drop old tables (urutan: studies dulu karena ada FK)
        $conn->query("SET FOREIGN_KEY_CHECKS = 0");
        $conn->query("DROP TABLE IF EXISTS studies");
        $conn->query("DROP TABLE IF EXISTS level");
        $conn->query("DROP TABLE IF EXISTS users");
        $conn->query("SET FOREIGN_KEY_CHECKS = 1");
        logMsg('info', 'ℹ️  Tabel lama dihapus (jika ada).');

        // Create users
        $sql = "CREATE TABLE users (
            id         INT          NOT NULL AUTO_INCREMENT,
            username   VARCHAR(50)  NOT NULL,
            password   VARCHAR(255) NOT NULL,
            full_name  VARCHAR(100) NOT NULL,
            role       VARCHAR(50)  NOT NULL DEFAULT 'Admin',
            created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            UNIQUE KEY uq_username (username)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
        if ($conn->query($sql)) logMsg('ok', '✅ Tabel users dibuat.');
        else logMsg('err', '❌ Gagal buat tabel users: ' . $conn->error);

        // Create level
        $sql = "CREATE TABLE level (
            id   INT          NOT NULL AUTO_INCREMENT,
            nama VARCHAR(100) NOT NULL,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
        if ($conn->query($sql)) logMsg('ok', '✅ Tabel level dibuat.');
        else logMsg('err', '❌ Gagal buat tabel level: ' . $conn->error);

        // Create studies
        $sql = "CREATE TABLE studies (
            id           INT          NOT NULL AUTO_INCREMENT,
            nama         VARCHAR(150) NOT NULL,
            idlevel      INT          NOT NULL,
            keterangan   TEXT,
            tahun_lulus  YEAR,
            foto_sekolah VARCHAR(255),
            PRIMARY KEY (id),
            CONSTRAINT fk_studies_level
                FOREIGN KEY (idlevel) REFERENCES level(id)
                ON DELETE RESTRICT ON UPDATE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
        if ($conn->query($sql)) logMsg('ok', '✅ Tabel studies dibuat (dengan FK ke level).');
        else logMsg('err', '❌ Gagal buat tabel studies: ' . $conn->error);

        // Insert levels
        $levelData = [
            'TK (Taman Kanak-Kanak)',
            'SD (Sekolah Dasar)',
            'SMP (Sekolah Menengah Pertama)',
            'SMA (Sekolah Menengah Atas)',
            'SMK (Sekolah Menengah Kejuruan)',
            'D1 (Diploma 1)',
            'D2 (Diploma 2)',
            'D3 (Diploma 3)',
            'D4 (Diploma 4)',
            'S1 (Sarjana / Strata 1)',
            'S2 (Magister / Strata 2)',
            'S3 (Doktor / Strata 3)',
        ];
        $stmt = $conn->prepare("INSERT INTO level (nama) VALUES (?)");
        foreach ($levelData as $lv) {
            $stmt->bind_param("s", $lv);
            $stmt->execute();
        }
        $stmt->close();
        logMsg('ok', '✅ Data level pendidikan (' . count($levelData) . ' jenjang) berhasil dimasukkan.');

        // Insert sample studies
        $studiesData = [
            ['TK Pertiwi 01 Jakarta', 1, 'Masa pertama mengenal dunia pendidikan. Belajar bernyanyi, menggambar, dan bermain bersama teman-teman.', 2008],
            ['SDN 05 Pagi Jakarta Pusat', 2, 'Menempuh pendidikan dasar selama 6 tahun. Aktif dalam kegiatan pramuka dan sering menjadi juara kelas.', 2014],
            ['SMPN 1 Jakarta', 3, 'Mulai mengenal teknologi komputer dan internet. Bergabung dengan ekskul komputer dan memenangkan lomba sains tingkat kota.', 2017],
            ['SMAN 8 Jakarta', 4, 'Mengambil jurusan IPA. Aktif di OSIS dan ekskul robotika. Meraih nilai UN tertinggi di jurusan.', 2020],
            ['Universitas Indonesia — Teknik Informatika', 10, 'Saat ini sedang menempuh pendidikan S1. IPK saat ini 3.85. Aktif dalam penelitian AI dan pengembangan web.', null],
        ];
        $stmt = $conn->prepare("INSERT INTO studies (nama, idlevel, keterangan, tahun_lulus) VALUES (?, ?, ?, ?)");
        foreach ($studiesData as $s) {
            $stmt->bind_param("sisi", $s[0], $s[1], $s[2], $s[3]);
            $stmt->execute();
        }
        $stmt->close();
        logMsg('ok', '✅ Data contoh studies (' . count($studiesData) . ' entri) berhasil dimasukkan.');

        // Insert users with proper bcrypt hash
        $hashAdmin = password_hash($adminPw, PASSWORD_DEFAULT);
        $hashUser  = password_hash($userPw,  PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (username, password, full_name, role) VALUES (?, ?, ?, ?)");

        $u1 = 'admin'; $fn1 = 'Administrator'; $r1 = 'Admin';
        $stmt->bind_param("ssss", $u1, $hashAdmin, $fn1, $r1);
        if ($stmt->execute()) logMsg('ok', "✅ User 'admin' berhasil dibuat (password: $adminPw)");
        else logMsg('err', '❌ Gagal insert user admin: ' . $conn->error);

        $u2 = 'user'; $fn2 = 'User Biasa'; $r2 = 'User';
        $stmt->bind_param("ssss", $u2, $hashUser, $fn2, $r2);
        if ($stmt->execute()) logMsg('ok', "✅ User 'user' berhasil dibuat (password: $userPw)");
        else logMsg('err', '❌ Gagal insert user biasa: ' . $conn->error);

        $stmt->close();

        // Create upload dir
        $uploadDir = __DIR__ . '/uploads/schools/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
            logMsg('ok', '✅ Folder uploads/schools/ berhasil dibuat.');
        } else {
            logMsg('info', 'ℹ️  Folder uploads/schools/ sudah ada.');
        }

        // Update db.php
        $dbConfig = "<?php\ndefine('DB_HOST', '$host');\ndefine('DB_USER', '$user');\ndefine('DB_PASS', '$pass');\ndefine('DB_NAME', '$name');\n\nfunction getDB() {\n    \$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);\n    if (\$conn->connect_error) {\n        die('Connection failed: ' . \$conn->connect_error);\n    }\n    \$conn->set_charset('utf8mb4');\n    return \$conn;\n}\n?>";
        file_put_contents(__DIR__ . '/includes/db.php', $dbConfig);
        logMsg('ok', '✅ File includes/db.php diperbarui otomatis.');

        $conn->close();
        logMsg('ok', '🎉 INSTALASI SELESAI! Database siap digunakan.');
    }
}
?>

      <!-- Form -->
      <?php if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($logs)): ?>
      <div class="card border-0 shadow-sm" style="border-radius:20px; overflow:hidden;">
        <div class="card-header py-3 fw-bold border-0"
             style="background:linear-gradient(135deg,#fce4ec,#f8bbd9);color:#c2185b;">
          ⚙️ Konfigurasi Database
        </div>
        <div class="card-body p-4" style="background:#fff9fb;">
          <form method="POST">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label fw-semibold" style="color:#c2185b;">Host Database</label>
                <input type="text" name="db_host" class="form-control" value="localhost"
                       style="border-color:#f48fb1;border-radius:10px;" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold" style="color:#c2185b;">Nama Database</label>
                <input type="text" name="db_name" class="form-control" value="personal_homepage"
                       style="border-color:#f48fb1;border-radius:10px;" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold" style="color:#c2185b;">Username MySQL</label>
                <input type="text" name="db_user" class="form-control" value="root"
                       style="border-color:#f48fb1;border-radius:10px;" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold" style="color:#c2185b;">Password MySQL</label>
                <input type="password" name="db_pass" class="form-control" value=""
                       placeholder="Kosongkan jika tidak ada"
                       style="border-color:#f48fb1;border-radius:10px;">
              </div>
              <div class="col-12"><hr style="border-color:#f8bbd9;"></div>
              <div class="col-md-6">
                <label class="form-label fw-semibold" style="color:#c2185b;">Password Akun Admin</label>
                <input type="text" name="admin_pw" class="form-control" value="admin123"
                       style="border-color:#f48fb1;border-radius:10px;" required>
                <small class="text-muted">Username: <code>admin</code></small>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold" style="color:#c2185b;">Password Akun User</label>
                <input type="text" name="user_pw" class="form-control" value="user123"
                       style="border-color:#f48fb1;border-radius:10px;" required>
                <small class="text-muted">Username: <code>user</code></small>
              </div>
              <div class="col-12">
                <div class="alert" style="background:#fce4ec;border:none;border-radius:12px;color:#c2185b;">
                  ⚠️ <strong>Perhatian:</strong> Script ini akan membuat database baru dan menghapus tabel lama (jika ada).
                  Data lama akan hilang! Gunakan hanya saat instalasi pertama kali.
                </div>
              </div>
              <div class="col-12">
                <button type="submit" class="btn px-5 py-2 fw-bold"
                        style="background:linear-gradient(135deg,#c2185b,#e91e63);color:#fff;border-radius:12px;border:none;font-size:1.05rem;">
                  🚀 Mulai Instalasi Database
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <?php endif; ?>

      <!-- Log output -->
      <?php if (!empty($logs)): ?>
      <div class="card border-0 shadow-sm mt-4" style="border-radius:20px; overflow:hidden;">
        <div class="card-header py-3 fw-bold border-0" style="background:#1a1a2e;color:#80d8ff;">
          📋 Log Instalasi
        </div>
        <div class="card-body p-0">
          <div class="log-box" style="border-radius:0 0 20px 20px; max-height:350px;">
            <?php foreach ($logs as $log): ?>
              <div class="log-<?= $log['type'] ?>"><?= htmlspecialchars($log['msg']) ?></div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <?php
      $hasError = array_filter($logs, fn($l) => $l['type'] === 'err');
      $isDone   = !empty(array_filter($logs, fn($l) => str_contains($l['msg'], 'SELESAI')));
      ?>

      <?php if ($isDone && empty($hasError)): ?>
      <div class="alert mt-4 border-0 shadow-sm" style="background:linear-gradient(135deg,#e8f5e9,#c8e6c9);border-radius:16px;color:#1b5e20;">
        <h5 class="fw-bold">✅ Instalasi Berhasil!</h5>
        <p class="mb-2">Database sudah siap. Sekarang Anda bisa:</p>
        <a href="index.php" class="btn me-2" style="background:#e91e63;color:#fff;border-radius:10px;border:none;">
          🏠 Buka Homepage
        </a>
        <a href="index.php?page=login" class="btn" style="background:#fce4ec;color:#c2185b;border-radius:10px;border:1px solid #f48fb1;">
          🔐 Login
        </a>
        <hr style="border-color:#a5d6a7;">
        <p class="mb-0 small">
          ⚠️ <strong>Hapus file ini setelah instalasi!</strong><br>
          <code>delete install_db.php</code> atau rename menjadi sesuatu yang tidak bisa diakses publik.
        </p>
      </div>
      <?php elseif (!empty($hasError)): ?>
      <div class="alert mt-4 border-0 shadow-sm" style="background:#fde8e8;border-radius:16px;color:#b71c1c;">
        <h5 class="fw-bold">❌ Ada Error!</h5>
        <p>Periksa konfigurasi database Anda dan coba lagi.</p>
        <a href="install_db.php" class="btn" style="background:#c2185b;color:#fff;border-radius:10px;border:none;">
          🔄 Coba Lagi
        </a>
      </div>
      <?php endif; ?>
      <?php endif; ?>

    </div>
  </div>
</div>
</body>
</html>
