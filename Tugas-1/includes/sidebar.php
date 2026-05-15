<?php
// sidebar.php - List Group Bootstrap (3 grid)
$currentPage = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<div class="card border-0 shadow-sm" style="border-radius:16px; overflow:hidden;">
  <div class="card-header text-white fw-bold" style="background:linear-gradient(135deg,#e91e63,#f48fb1);">
    <i class="bi bi-list-ul me-2"></i>Menu
  </div>
  <div class="list-group list-group-flush">
    <a href="index.php?page=home"
       class="list-group-item list-group-item-action <?= $currentPage=='home'?'active':'' ?>"
       style="<?= $currentPage=='home'?'background:#fce4ec;color:#c2185b;font-weight:600;border-left:4px solid #e91e63;':'' ?>">
      Home
    </a>
    <a href="index.php?page=about"
       class="list-group-item list-group-item-action <?= $currentPage=='about'?'active':'' ?>"
       style="<?= $currentPage=='about'?'background:#fce4ec;color:#c2185b;font-weight:600;border-left:4px solid #e91e63;':'' ?>">
      About Me
    </a>
    <a href="index.php?page=contact"
       class="list-group-item list-group-item-action <?= $currentPage=='contact'?'active':'' ?>"
       style="<?= $currentPage=='contact'?'background:#fce4ec;color:#c2185b;font-weight:600;border-left:4px solid #e91e63;':'' ?>">
      Contact Me
    </a>
    <a href="index.php?page=level"
       class="list-group-item list-group-item-action <?= $currentPage=='level'?'active':'' ?>"
       style="<?= $currentPage=='level'?'background:#fce4ec;color:#c2185b;font-weight:600;border-left:4px solid #e91e63;':'' ?>">
Education level
    </a>
    <a href="index.php?page=studies"
       class="list-group-item list-group-item-action <?= $currentPage=='studies'?'active':'' ?>"
       style="<?= $currentPage=='studies'?'background:#fce4ec;color:#c2185b;font-weight:600;border-left:4px solid #e91e63;':'' ?>">
      My Studies
    </a>
  </div>
</div>

<!-- Info Card -->
<div class="card border-0 shadow-sm mt-3" style="border-radius:16px; background:linear-gradient(135deg,#fce4ec,#fff);">
  <div class="card-body text-center py-4">
    <img src="/php_project/img/bila5.jpeg"
     class="rounded-circle"
     style="width:85px;height: 85px;px;object-fit:cover;">
    <h6 class="fw-bold" style="color:#c2185b;">Nabila F Andina Lubis</h6>
    <p class="text-muted small mb-0">Mahasiswi Aktif</p>
    <p class="text-muted small">STT NURUl FIKRI</p>
    <div class="d-flex justify-content-center gap-2 mt-2">
      <a href="#" class="btn btn-sm" style="background:#e91e63;color:#fff;border-radius:20px;">Learn more</a>
    </div>
  </div>
</div>
