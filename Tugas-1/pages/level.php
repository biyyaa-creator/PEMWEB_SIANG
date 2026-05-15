<?php
// pages/level.php - CRUD Level Pendidikan
requireLogin();

$db = getDB();
$action = $_GET['action'] ?? 'list';
$id = intval($_GET['id'] ?? 0);
$error = '';
$success = '';

// Handle POST (Create / Update)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    if (empty($nama)) {
        $error = 'Nama level tidak boleh kosong!';
    } else {
        if (isset($_POST['id']) && intval($_POST['id']) > 0) {
            // UPDATE
            $pid = intval($_POST['id']);
            $stmt = $db->prepare("UPDATE level SET nama=? WHERE id=?");
            $stmt->bind_param("si", $nama, $pid);
            $stmt->execute();
            $stmt->close();
            $success = 'Level berhasil diperbarui!';
            $action = 'list';
        } else {
            // INSERT
            $stmt = $db->prepare("INSERT INTO level (nama) VALUES (?)");
            $stmt->bind_param("s", $nama);
            $stmt->execute();
            $stmt->close();
            $success = 'Level berhasil ditambahkan!';
            $action = 'list';
        }
    }
}

// Handle DELETE
if ($action === 'delete' && $id > 0) {
    // Check if used in studies
    $check = $db->prepare("SELECT COUNT(*) as cnt FROM studies WHERE idlevel=?");
    $check->bind_param("i", $id);
    $check->execute();
    $cnt = $check->get_result()->fetch_assoc()['cnt'];
    $check->close();
    if ($cnt > 0) {
        $error = 'Level tidak dapat dihapus karena sudah digunakan pada data Studies!';
    } else {
        $stmt = $db->prepare("DELETE FROM level WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        $success = 'Level berhasil dihapus!';
    }
    $action = 'list';
}

// Fetch for edit
$editData = null;
if ($action === 'edit' && $id > 0) {
    $stmt = $db->prepare("SELECT * FROM level WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $editData = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}

// Fetch all
$levels = $db->query("SELECT * FROM level ORDER BY id ASC");
$db->close();
?>

<h4 class="fw-bold mb-4" style="color:#c2185b; border-bottom:3px solid #f48fb1; padding-bottom:10px;">
Education level</h4>

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
    <?= $editData ? 'Edit Level' : 'Tambah Level Baru' ?>
  </div>
  <div class="card-body p-4" style="background:#fff9fb;">
    <form method="POST">
      <?php if ($editData): ?>
        <input type="hidden" name="id" value="<?= $editData['id'] ?>">
      <?php endif; ?>
      <div class="row g-3 align-items-end">
        <div class="col-md-8">
          <label class="form-label fw-semibold" style="color:#c2185b;">Nama Level Pendidikan</label>
          <input type="text" name="nama" class="form-control"
                 style="border-color:#f48fb1; border-radius:10px; padding:10px 14px;"
                 placeholder="Contoh: SD (Sekolah Dasar)"
                 value="<?= htmlspecialchars($editData['nama'] ?? '') ?>" required>
        </div>
        <div class="col-md-4 d-flex gap-2">
          <button type="submit" class="btn flex-fill py-2 fw-bold"
                  style="background:linear-gradient(135deg,#e91e63,#f06292);color:#fff;border-radius:10px;border:none;">
            <i class="bi bi-<?= $editData ? 'check-lg' : 'plus-lg' ?> me-1"></i>
            <?= $editData ? 'Update' : 'Simpan' ?>
          </button>
          <?php if ($editData): ?>
            <a href="index.php?page=level" class="btn py-2 fw-bold"
               style="background:#f8d7da;color:#c2185b;border-radius:10px;border:none;">Batal</a>
          <?php endif; ?>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Tabel Data -->
<div class="card border-0 shadow-sm" style="border-radius:16px; overflow:hidden;">
  <div class="card-header fw-bold border-0 py-3"
       style="background:linear-gradient(135deg,#fce4ec,#f8bbd9); color:#c2185b;">
    <i class="bi bi-table me-2"></i>Daftar Level Pendidikan
  </div>
  <div class="table-responsive">
    <table class="table table-hover mb-0">
      <thead style="background:#fce4ec;">
        <tr>
          <th style="color:#c2185b; width:60px;">No</th>
          <th style="color:#c2185b;">Nama Level</th>
          <th style="color:#c2185b; width:150px; text-align:center;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        while ($row = $levels->fetch_assoc()):
        ?>
        <tr>
          <td><span class="badge" style="background:#fce4ec;color:#c2185b;"><?= $no++ ?></span></td>
          <td class="fw-semibold"><?= htmlspecialchars($row['nama']) ?></td>
          <td class="text-center">
            <a href="index.php?page=level&action=edit&id=<?= $row['id'] ?>"
               class="btn btn-sm me-1"
               style="background:#fce4ec;color:#c2185b;border-radius:8px;border:1px solid #f48fb1;">
              <i class="bi bi-pencil"></i>
            </a>
            <a href="index.php?page=level&action=delete&id=<?= $row['id'] ?>"
               class="btn btn-sm"
               style="background:#fde8e8;color:#dc3545;border-radius:8px;border:1px solid #f5c6cb;"
               onclick="return confirm('Yakin ingin menghapus level ini?')">
              <i class="bi bi-trash"></i>
            </a>
          </td>
        </tr>
        <?php endwhile; ?>
        <?php if ($no === 1): ?>
        <tr>
          <td colspan="3" class="text-center text-muted py-4">
            <i class="bi bi-inbox" style="font-size:2rem;color:#f48fb1;"></i><br>
            Belum ada data level. Tambahkan yang pertama!
          </td>
        </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
