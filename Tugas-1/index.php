<?php
// index.php - Main Router & Layout
require_once 'includes/auth.php';
require_once 'includes/db.php';

// Handle logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header('Location: index.php?page=home&msg=logged_out');
    exit;
}

$page = $_GET['page'] ?? 'home';
$allowedPages = ['home', 'about', 'contact', 'login', 'level', 'studies'];
if (!in_array($page, $allowedPages)) {
    $page = 'home';
}

// ✅ TAMBAHAN: Cek halaman yang butuh login SEBELUM output HTML
$protectedPages = ['level', 'studies']; // sesuaikan halaman yang perlu login
if (in_array($page, $protectedPages) && !isLoggedIn()) {
    header('Location: index.php?page=login&msg=auth_required');
    exit;
}

$loginError = '';
$loginSuccess = '';

if ($page === 'login') {
    if (isLoggedIn()) {
        header('Location: index.php?page=home');
        exit;
    }

    if (isset($_GET['msg']) && $_GET['msg'] === 'auth_required') {
        $loginError = 'Anda harus login terlebih dahulu untuk mengakses halaman tersebut.';
    }
    if (isset($_GET['msg']) && $_GET['msg'] === 'logged_out') {
        $loginSuccess = 'Anda telah berhasil logout. Sampai jumpa! 👋';
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($password)) {
            $loginError = 'Username dan password wajib diisi!';
        } else {
            $db = getDB();
            $stmt = $db->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            $stmt->close();
            $db->close();

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id']   = $user['id'];
                $_SESSION['username']  = $user['username'];
                $_SESSION['full_name'] = $user['full_name'];
                $_SESSION['role']      = $user['role'];
                header('Location: index.php?page=home');
                exit;
            } else {
                $loginError = 'Username atau password salah!';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MyPersonal Page 🌸</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.2/dist/minty/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Dancing+Script:wght@600;700&display=swap" rel="stylesheet">

  <style>
    :root {
      --pink-primary: #c2185b;
      --pink-light: #fce4ec;
      --pink-medium: #e91e63;
      --pink-soft: #f8bbd9;
    }
    body {
      font-family: 'Nunito', sans-serif;
      background: #fff5f8;
      min-height: 100vh;
    }
    .navbar-brand {
      font-family: 'Dancing Script', cursive !important;
      font-size: 1.6rem !important;
    }
    .nav-link.active, .nav-link.active.fw-bold {
      color: #fff !important;
      background: rgba(255,255,255,0.2);
      border-radius: 8px;
      padding-left: 12px !important;
      padding-right: 12px !important;
    }
    .accordion-button:not(.collapsed) {
      background: linear-gradient(135deg, #fce4ec, #f8bbd9) !important;
      color: #c2185b !important;
      box-shadow: none !important;
    }
    .accordion-button:focus {
      box-shadow: 0 0 0 0.2rem rgba(233, 30, 99, 0.25) !important;
    }
    .form-control:focus, .form-select:focus {
      border-color: #e91e63 !important;
      box-shadow: 0 0 0 0.2rem rgba(233, 30, 99, 0.15) !important;
    }
    .table > :not(caption) > * > * {
      padding: 0.85rem 1rem;
      vertical-align: middle;
    }
    .table-hover tbody tr:hover {
      background: #fff0f5 !important;
    }
    .dropdown-item:hover {
      background: #fce4ec !important;
      color: #c2185b !important;
    }
    .card {
      transition: box-shadow 0.2s ease;
    }
  </style>
</head>
<body>

<div class="container-fluid px-0">
  <div class="row g-0">
    <div class="col-12">
      <?php include 'includes/header.php'; ?>
    </div>
  </div>
</div>

<div class="container-fluid px-0">
  <div class="row g-0">
    <div class="col-12">
      <?php include 'includes/menu.php'; ?>
    </div>
  </div>
</div>

<div class="container py-4">
  <div class="row g-4">

    <div class="col-lg-3 col-md-4">
      <?php include 'includes/sidebar.php'; ?>
    </div>

    <div class="col-lg-9 col-md-8">
      <?php
      $pageFile = 'pages/' . $page . '.php';
      if (file_exists($pageFile)) {
          include $pageFile;
      } else {
          echo '<div class="alert alert-warning">Halaman tidak ditemukan.</div>';
      }
      ?>
    </div>

  </div>
</div>

<div class="container-fluid px-0">
  <div class="row g-0">
    <div class="col-12">
      <?php include 'includes/footer.php'; ?>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.querySelectorAll('.alert').forEach(function(alert) {
    setTimeout(function() {
        if (alert && alert.parentNode) {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }
    }, 4000);
});
</script>

</body>
</html>