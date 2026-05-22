<?php
// pages/login.php
// Semua logika sudah dihandle di index.php
$error   = $loginError   ?? '';
$success = $loginSuccess ?? '';
?>

<div class="row justify-content-center py-4">
  <div class="col-md-5 col-lg-4">
    <div class="card border-0 shadow-lg" style="border-radius:24px; overflow:hidden;">
      <div class="card-header text-center py-4 border-0"
           style="background:linear-gradient(135deg,#c2185b,#e91e63,#f06292);">
        <div style="font-size:3rem; margin-bottom:8px;">🔐</div>
        <h4 class="fw-bold text-white mb-0">Login</h4>
        <p class="text-white-50 mb-0 small">Masukkan kredensial Anda</p>
      </div>
      <div class="card-body p-4" style="background:#fff9fb;">
        <?php if ($error): ?>
          <div class="alert alert-danger rounded-3" style="border-left:4px solid #dc3545;">
            <i class="bi bi-exclamation-triangle me-2"></i><?= htmlspecialchars($error) ?>
          </div>
        <?php endif; ?>
        <?php if ($success): ?>
          <div class="alert alert-success rounded-3" style="border-left:4px solid #198754;">
            <i class="bi bi-check-circle me-2"></i><?= htmlspecialchars($success) ?>
          </div>
        <?php endif; ?>

        <form method="POST">
          <div class="mb-3">
            <label class="form-label fw-semibold" style="color:#c2185b;">
              <i class="bi bi-person me-1"></i>Username
            </label>
            <input type="text" name="username" class="form-control"
                   style="border-color:#f48fb1; border-radius:12px; padding:10px 14px;"
                   placeholder="Masukkan username"
                   value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required>
          </div>
          <div class="mb-4">
            <label class="form-label fw-semibold" style="color:#c2185b;">
              <i class="bi bi-lock me-1"></i>Password
            </label>
            <input type="password" name="password" class="form-control"
                   style="border-color:#f48fb1; border-radius:12px; padding:10px 14px;"
                   placeholder="Masukkan password" required>
          </div>
          <button type="submit" class="btn w-100 py-2 fw-bold"
                  style="background:linear-gradient(135deg,#c2185b,#e91e63);color:#fff;border-radius:12px;border:none;font-size:1rem;">
            <i class="bi bi-box-arrow-in-right me-2"></i>Login
          </button>
        </form>

        <div class="text-center mt-4 p-3" style="background:#fce4ec; border-radius:12px;">
          <small class="text-muted"><strong>Demo Account:</strong><br>
          Username: <code>nabila</code> | Password: <code>Nabilaputri13</code></small>
        </div>
      </div>
    </div>
  </div>
</div>