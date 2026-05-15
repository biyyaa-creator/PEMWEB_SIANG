<?php
// pages/studies.php - CRUD Studies
requireLogin();

$db = getDB();
$action = $_GET['action'] ?? 'list';
$id = intval($_GET['id'] ?? 0);
$error = '';
$success = '';

// Fetch levels for dropdown
$levelsResult = $db->query("SELECT * FROM level ORDER BY id ASC");
$levels = [];
while ($row = $levelsResult->fetch_assoc()) { $levels[] = $row; }

// Handle POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama       = trim($_POST['nama'] ?? '');
    $idlevel    = intval($_POST['idlevel'] ?? 0);
    $keterangan = trim($_POST['keterangan'] ?? '');
    $tahun_lulus = intval($_POST['tahun_lulus'] ?? 0);
    $foto_sekolah = '';

    if (empty($nama) || $idlevel <= 0) {
        $error = 'Nama sekolah dan level wajib diisi!';
    } else {
        // Handle file upload
        if (!empty($_FILES['foto_sekolah']['name'])) {
            $allowed = ['jpg','jpeg','png','gif','webp'];
            $ext = strtolower(pathinfo($_FILES['foto_sekolah']['name'], PATHINFO_EXTENSION));
            if (!in_array($ext, $allowed)) {
                $error = 'Format foto tidak valid! Gunakan: JPG, PNG, GIF, WebP';
            } elseif ($_FILES['foto_sekolah']['size'] > 2 * 1024 * 1024) {
                $error = 'Ukuran foto maksimal 2MB!';
            } else {
               $newName = 'school_' . time() . '_' . rand(1000,9999) . '.' . $ext;
                $uploadDir = 'uploads/schools/';
                // Buat folder otomatis jika belum ada
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                $uploadPath = $uploadDir . $newName;
                if (move_uploaded_file($_FILES['foto_sekolah']['tmp_name'], $uploadPath)) {
                    $foto_sekolah = $newName;
                } else {
                    $error = 'Gagal mengupload foto!';
                }
            }
        }

        if (empty($error)) {
            if (isset($_POST['id']) && intval($_POST['id']) > 0) {
                // UPDATE
                $pid = intval($_POST['id']);
                // Get old photo
                $old = $db->prepare("SELECT foto_sekolah FROM studies WHERE id=?");
                $old->bind_param("i", $pid);
                $old->execute();
                $oldPhoto = $old->get_result()->fetch_assoc()['foto_sekolah'];
                $old->close();
                if (empty($foto_sekolah)) { $foto_sekolah = $oldPhoto; }

                $stmt = $db->prepare("UPDATE studies SET nama=?,idlevel=?,keterangan=?,tahun_lulus=?,foto_sekolah=? WHERE id=?");
                $stmt->bind_param("sisssi", $nama,$idlevel,$keterangan,$tahun_lulus,$foto_sekolah,$pid);
                $stmt->execute();
                $stmt->close();
                $success = 'Data studies berhasil diperbarui!';
            } else {
                // INSERT
                $stmt = $db->prepare("INSERT INTO studies (nama,idlevel,keterangan,tahun_lulus,foto_sekolah) VALUES (?,?,?,?,?)");
                $stmt->bind_param("sisss", $nama,$idlevel,$keterangan,$tahun_lulus,$foto_sekolah);
                $stmt->execute();
                $stmt->close();
                $success = 'Data studies berhasil ditambahkan!';
            }
            $action = 'list';
        }
    }
}

// DELETE
if ($action === 'delete' && $id > 0) {
    $stmt = $db->prepare("SELECT foto_sekolah FROM studies WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    if ($row && $row['foto_sekolah'] && file_exists('uploads/schools/' . $row['foto_sekolah'])) {
        unlink('uploads/schools/' . $row['foto_sekolah']);
    }
    $stmt = $db->prepare("DELETE FROM studies WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    $success = 'Data studies berhasil dihapus!';
    $action = 'list';
}

// Fetch for edit
$editData = null;
if ($action === 'edit' && $id > 0) {
    $stmt = $db->prepare("SELECT * FROM studies WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $editData = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}

// Fetch all studies with level name
$studiesResult = $db->query("
    SELECT s.*, l.nama as level_nama
    FROM studies s
    LEFT JOIN level l ON s.idlevel = l.id
    ORDER BY s.tahun_lulus ASC, s.id ASC
");
$db->close();
?>

<h4 class="fw-bold mb-4" style="color:#c2185b; border-bottom:3px solid #f48fb1; padding-bottom:10px;">
Riwayat Pendidikan
</h4>

<?php if ($error): ?>
  <div class="alert alert-danger rounded-3"><i class="bi bi-x-circle me-2"></i><?= htmlspecialchars($error) ?></div>
<?php endif; ?>
<?php if ($success): ?>
  <div class="alert alert-success rounded-3"><i class="bi bi-check-circle me-2"></i><?= htmlspecialchars($success) ?></div>
<?php endif; ?>

<!-- Form Tambah / Edit -->
<div class="card border-0 shadow-sm mb-4" style="border-radius:16px;">
  <div class="card-header fw-bold border-0 py-3"
       style="background:linear-gradient(135deg,#fce4ec,#f8bbd9); color:#c2185b; border-radius:16px 16px 0 0;">
    <i class="bi bi-<?= $editData ? 'pencil' : 'plus-circle' ?> me-2"></i>
    <?= $editData ? 'Edit Data Studies' : 'Tambah Data Studies Baru' ?>
  </div>
  <div class="card-body p-4" style="background:#fff9fb;">
    <form method="POST" enctype="multipart/form-data">
      <?php if ($editData): ?>
        <input type="hidden" name="id" value="<?= $editData['id'] ?>">
      <?php endif; ?>
      <div class="row g-3">
        <div class="col-md-8">
          <label class="form-label fw-semibold" style="color:#c2185b;">Nama Sekolah/Institusi <span class="text-danger">*</span></label>
          <input type="text" name="nama" class="form-control"
                 style="border-color:#f48fb1; border-radius:10px;"
                 placeholder="Contoh: SD Negeri 1 Jakarta"
                 value="<?= htmlspecialchars($editData['nama'] ?? '') ?>" required>
        </div>
        <div class="col-md-4">
          <label class="form-label fw-semibold" style="color:#c2185b;">Level Pendidikan <span class="text-danger">*</span></label>
          <select name="idlevel" class="form-select" style="border-color:#f48fb1; border-radius:10px;" required>
            <option value="">-- Pilih Level --</option>
            <?php foreach ($levels as $lv): ?>
              <option value="<?= $lv['id'] ?>"
                <?= ($editData && $editData['idlevel'] == $lv['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($lv['nama']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label fw-semibold" style="color:#c2185b;">Tahun Lulus</label>
          <input type="number" name="tahun_lulus" class="form-control"
                 style="border-color:#f48fb1; border-radius:10px;"
                 placeholder="Contoh: 2010" min="1990" max="<?= date('Y') + 5 ?>"
                 value="<?= htmlspecialchars($editData['tahun_lulus'] ?? '') ?>">
        </div>
        <div class="col-md-8">
          <label class="form-label fw-semibold" style="color:#c2185b;">Foto Sekolah</label>
          <input type="file" name="foto_sekolah" class="form-control"
                 style="border-color:#f48fb1; border-radius:10px;"
                 accept="image/*">
          <?php if ($editData && $editData['foto_sekolah']): ?>
            <small class="text-muted">File saat ini: <strong><?= htmlspecialchars($editData['foto_sekolah']) ?></strong> (biarkan kosong jika tidak ingin mengganti)</small>
          <?php endif; ?>
        </div>
        <div class="col-12">
          <label class="form-label fw-semibold" style="color:#c2185b;">Keterangan</label>
          <textarea name="keterangan" class="form-control" rows="3"
                    style="border-color:#f48fb1; border-radius:10px;"
                    placeholder="Ceritakan pengalaman belajar, prestasi, kegiatan, dll."><?= htmlspecialchars($editData['keterangan'] ?? '') ?></textarea>
        </div>
        <div class="col-12 d-flex gap-2">
          <button type="submit" class="btn px-4 py-2 fw-bold"
                  style="background:linear-gradient(135deg,#e91e63,#f06292);color:#fff;border-radius:10px;border:none;">
            <i class="bi bi-<?= $editData ? 'check-lg' : 'plus-lg' ?> me-1"></i>
            <?= $editData ? 'Update Data' : 'Simpan Data' ?>
          </button>
          <?php if ($editData): ?>
            <a href="index.php?page=studies" class="btn py-2 px-4 fw-bold"
               style="background:#f8d7da;color:#c2185b;border-radius:10px;border:none;">Batal</a>
          <?php endif; ?>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Tabel Data Studies -->
<div class="card border-0 shadow-sm" style="border-radius:16px; overflow:hidden;">
  <div class="card-header fw-bold border-0 py-3"
       style="background:linear-gradient(135deg,#fce4ec,#f8bbd9); color:#c2185b;">
    <i class="bi bi-table me-2"></i>Daftar Riwayat Pendidikan
  </div>
  <div class="table-responsive">
    <table class="table table-hover mb-0">
      <thead style="background:#fce4ec;">
        <tr>
          <th style="color:#c2185b;">No</th>
          <th style="color:#c2185b;">Foto</th>
          <th style="color:#c2185b;">Nama Sekolah</th>
          <th style="color:#c2185b;">Level</th>
          <th style="color:#c2185b;">Tahun Lulus</th>
          <th style="color:#c2185b;">Keterangan</th>
          <th style="color:#c2185b; text-align:center;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        while ($row = $studiesResult->fetch_assoc()):
        ?>
        <tr>
          <td><span class="badge" style="background:#fce4ec;color:#c2185b;"><?= $no++ ?></span></td>
          <td>
            <?php if ($row['foto_sekolah'] && file_exists('uploads/schools/'.$row['foto_sekolah'])): ?>
              <img src="uploads/schools/<?= htmlspecialchars($row['foto_sekolah']) ?>"
                   style="width:50px;height:50px;object-fit:cover;border-radius:10px;border:2px solid #f48fb1;"
                   alt="Foto Sekolah">
            <?php else: ?>
              <div style="width:50px;height:50px;background:#fce4ec;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;">🏫</div>
            <?php endif; ?>
          </td>
          <td class="fw-semibold"><?= htmlspecialchars($row['nama']) ?></td>
          <td>
            <span class="badge px-2 py-1" style="background:#fce4ec;color:#c2185b;font-size:0.75rem;">
              <?= htmlspecialchars($row['level_nama'] ?? 'N/A') ?>
            </span>
          </td>
          <td><?= $row['tahun_lulus'] ?: '-' ?></td>
          <td>
            <small class="text-muted">
              <?= $row['keterangan'] ? htmlspecialchars(substr($row['keterangan'], 0, 60)) . (strlen($row['keterangan']) > 60 ? '...' : '') : '-' ?>
            </small>
          </td>
          <td class="text-center">
            <a href="index.php?page=studies&action=edit&id=<?= $row['id'] ?>"
               class="btn btn-sm me-1"
               style="background:#fce4ec;color:#c2185b;border-radius:8px;border:1px solid #f48fb1;">
              <i class="bi bi-pencil"></i>
            </a>
            <a href="index.php?page=studies&action=delete&id=<?= $row['id'] ?>"
               class="btn btn-sm"
               style="background:#fde8e8;color:#dc3545;border-radius:8px;border:1px solid #f5c6cb;"
               onclick="return confirm('Yakin ingin menghapus data ini?')">
              <i class="bi bi-trash"></i>
            </a>
          </td>
        </tr>
        <?php endwhile; ?>
        <?php if ($no === 1): ?>
        <tr>
          <td colspan="7" class="text-center text-muted py-4">
            <i class="bi bi-inbox" style="font-size:2rem;color:#f48fb1;"></i><br>
            Belum ada data studies. Tambahkan riwayat pendidikan Anda!
          </td>
        </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
