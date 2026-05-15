<?php
// menu.php - Navbar Bootstrap (12 grid)
$currentPage = isset($_GET['page']) ? $_GET['page'] : 'home';
$user = getCurrentUser();
?>
<nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background: linear-gradient(90deg,#c2185b,#e91e63,#f06292); box-shadow:0 3px 15px rgba(194,24,91,0.35);">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php" style="color:#fff; font-size:1.4rem; letter-spacing:1px;">
      <span style="font-style:italic;">MyPage</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?= $currentPage=='home'?'active fw-bold':'' ?>" href="index.php?page=home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $currentPage=='about'?'active fw-bold':'' ?>" href="index.php?page=about">About Me</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $currentPage=='contact'?'active fw-bold':'' ?>" href="index.php?page=contact">Contact Me</a>
        </li>
        <!-- My Studies Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?= in_array($currentPage,['level','level_add','level_edit','studies','studies_add','studies_edit'])?'active fw-bold':'' ?>"
             href="#" id="studiesDropdown" role="button" data-bs-toggle="dropdown">
            My Studies
          </a>
          <ul class="dropdown-menu" style="border-top:3px solid #e91e63;">
            <li>
              <a class="dropdown-item" href="index.php?page=level">
                <i class="bi bi-layers me-2" style="color:#e91e63;"></i>Level
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="index.php?page=studies">
                <i class="bi bi-book me-2" style="color:#e91e63;"></i>Studies
              </a>
            </li>
          </ul>
        </li>
      </ul>

      <!-- Auth Section -->
      <ul class="navbar-nav ms-auto">
        <?php if (!$user): ?>
        <!-- Show Login if NOT logged in -->
        <li class="nav-item">
          <a class="nav-link <?= $currentPage=='login'?'active fw-bold':'' ?>" href="index.php?page=login">
            <i class="bi bi-box-arrow-in-right me-1"></i>Login
          </a>
        </li>
        <?php else: ?>
        <!-- Show user info and logout if logged in -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle fw-bold" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
            <i class="bi bi-person-circle me-1"></i>
            <?= htmlspecialchars($user['full_name']) ?>
            <span class="badge ms-1" style="background:#fff; color:#c2185b; font-size:0.7rem;"><?= htmlspecialchars($user['role']) ?></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" style="border-top:3px solid #e91e63;">
            <li><h6 class="dropdown-header">Logged in as <strong><?= htmlspecialchars($user['username']) ?></strong></h6></li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <a class="dropdown-item text-danger" href="index.php?action=logout">
                <i class="bi bi-box-arrow-right me-2"></i>Logout
              </a>
            </li>
          </ul>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
