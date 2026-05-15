<?php
// pages/about.php - Accordion Bootstrap
?>
<h4 class="fw-bold mb-4" style="color:#c2185b; border-bottom:3px solid #f48fb1; padding-bottom:10px;">
About Me
</h4>

<!-- Accordion Bootstrap -->
<div class="accordion" id="aboutAccordion">

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Hobby & Minat Saya</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'Nunito', sans-serif; background: #fff5f9; padding: 24px; }
    .wrap {  padding: 1rem 0 1.5rem; }
 
    .header {
      background: #fff0f7;
      border-radius: 20px;
      padding: 18px 24px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      border: 1.5px solid #fbc8df;
    }
    .header-title { font-size: 22px; font-weight: 800; color: #c2185b; letter-spacing: -.3px; }
    .badge {
      background: #fce4ec; color: #c2185b; font-size: 11px; font-weight: 700;
      padding: 4px 12px; border-radius: 20px; border: 1px solid #f8bbd0;
    }
 
    .grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
    }
 
    .hcard {
      background: #fff;
      border-radius: 24px;
      border: 1.5px solid #fde0ef;
      padding: 24px 20px 20px;   
      cursor: pointer;
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      gap: 16px;
      transition: transform .22s, box-shadow .22s;
    }
    .hcard:hover { transform: translateY(-4px); box-shadow: 0 10px 26px rgba(194,24,91,.12); border-color: #f9b8d4; }
 
    .hcard-row { display: flex; align-items: center; gap: 16px; }
 
    .icon-shell {
      width: 64px; height: 64px; border-radius: 18px;
      display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
 
    .card-label { font-size: 18px; font-weight: 800; color: #c2185b; margin-bottom: 5px; }
    .card-desc { font-size: 13px; color: #e880a8; line-height: 1.5; font-weight: 600; }
 
    .stat { display: flex; gap: 8px; flex-wrap: wrap; }
    .pip {
      background: #fce4ec; color: #c2185b; font-size: 11px; font-weight: 700;
      padding: 4px 12px; border-radius: 20px;
    }
  </style>
</head>
<body>
<div class="wrap">
 
  <div class="header">
    <span class="header-title">✦ Hobby &amp; Minat Saya</span>
    <span class="badge">6 Minat</span>
  </div>
 
  <div class="grid">
 
    <!-- TRAVELLING -->
    <div class="hcard">
      <div class="hcard-row">
        <div class="icon-shell" style="background:linear-gradient(145deg,#dbeafe,#bfdbfe);">
          <svg width="36" height="36" viewBox="0 0 80 80" fill="none">
            <path d="M40 14 C28 14 18 24 18 36 C18 52 40 66 40 66 C40 66 62 52 62 36 C62 24 52 14 40 14Z" fill="#3b82f6"/>
            <path d="M40 14 C34 14 28 24 28 36 C28 50 40 66 40 66 C40 66 52 50 52 36 C52 24 46 14 40 14Z" fill="#60a5fa"/>
            <path d="M18 36 H62" stroke="#bfdbfe" stroke-width="1.8"/>
            <path d="M20 28 H60" stroke="#93c5fd" stroke-width="1.5"/>
            <path d="M20 44 H60" stroke="#93c5fd" stroke-width="1.5"/>
            <circle cx="40" cy="36" r="6" fill="#fff" opacity=".9"/>
            <circle cx="40" cy="36" r="3" fill="#1d4ed8"/>
            <path d="M26 16 L20 10 L32 14Z" fill="#fbbf24"/>
            <path d="M20 10 L24 6 L32 14Z" fill="#f59e0b"/>
            <rect x="19" y="4" width="2.5" height="8" rx="1" fill="#6b7280"/>
          </svg>
        </div>
        <div>
          <div class="card-label">Travelling</div>
          <div class="card-desc">Jelajahi dunia &amp; budaya baru</div>
        </div>
      </div>
      <div class="stat">
        <span class="pip">Petualangan</span>
        <span class="pip">Wisata</span>
      </div>
    </div>
 
    <!-- MEMASAK -->
    <div class="hcard">
      <div class="hcard-row">
        <div class="icon-shell" style="background:linear-gradient(145deg,#ffedd5,#fed7aa);">
          <svg width="36" height="36" viewBox="0 0 80 80" fill="none">
            <rect x="16" y="46" width="48" height="18" rx="6" fill="#fdba74"/>
            <rect x="16" y="46" width="48" height="8" rx="4" fill="#f97316"/>
            <path d="M22 46 C22 34 30 28 40 28 C50 28 58 34 58 46" fill="#fff7ed" stroke="#f97316" stroke-width="2"/>
            <ellipse cx="40" cy="37" rx="10" ry="6" fill="#fed7aa" stroke="#fb923c" stroke-width="1.5"/>
            <path d="M32 22 C32 16 36 12 36 8" stroke="#ef4444" stroke-width="2.5" stroke-linecap="round"/>
            <path d="M40 20 C40 15 40 11 40 8" stroke="#f97316" stroke-width="2.5" stroke-linecap="round"/>
            <path d="M48 22 C48 16 44 12 44 8" stroke="#ef4444" stroke-width="2.5" stroke-linecap="round"/>
            <circle cx="32" cy="6" r="3" fill="#fca5a5"/>
            <circle cx="40" cy="6" r="3" fill="#fdba74"/>
            <circle cx="48" cy="6" r="3" fill="#fca5a5"/>
          </svg>
        </div>
        <div>
          <div class="card-label">Memasak</div>
          <div class="card-desc">Kreasi resep lezat di dapur</div>
        </div>
      </div>
      <div class="stat">
        <span class="pip">Kuliner</span>
        <span class="pip">Baking</span>
      </div>
    </div>
 
    <!-- MENONTON -->
    <div class="hcard">
      <div class="hcard-row">
        <div class="icon-shell" style="background:linear-gradient(145deg,#ede9fe,#ddd6fe);">
          <svg width="36" height="36" viewBox="0 0 80 80" fill="none">
            <rect x="8" y="16" width="64" height="40" rx="8" fill="#4c1d95"/>
            <rect x="12" y="20" width="56" height="32" rx="5" fill="#1e1b4b"/>
            <circle cx="40" cy="36" r="13" fill="#7c3aed" opacity=".9"/>
            <circle cx="40" cy="36" r="10" fill="#6d28d9"/>
            <polygon points="37,30 37,42 50,36" fill="#fff"/>
            <rect x="28" y="56" width="24" height="4" rx="2" fill="#7c3aed"/>
            <rect x="22" y="60" width="36" height="7" rx="3" fill="#4c1d95"/>
            <circle cx="18" cy="24" r="3" fill="#ef4444"/>
            <circle cx="26" cy="24" r="3" fill="#fbbf24"/>
            <circle cx="34" cy="24" r="3" fill="#4ade80"/>
          </svg>
        </div>
        <div>
          <div class="card-label">Menonton</div>
          <div class="card-desc">Film, series &amp; anime favorit</div>
        </div>
      </div>
      <div class="stat">
        <span class="pip">Hiburan</span>
        <span class="pip">Anime</span>
      </div>
    </div>
 
    <!-- OLAHRAGA -->
    <div class="hcard">
      <div class="hcard-row">
        <div class="icon-shell" style="background:linear-gradient(145deg,#dcfce7,#bbf7d0);">
          <svg width="36" height="36" viewBox="0 0 80 80" fill="none">
            <rect x="6" y="34" width="14" height="12" rx="5" fill="#15803d"/>
            <rect x="60" y="34" width="14" height="12" rx="5" fill="#15803d"/>
            <rect x="10" y="30" width="10" height="20" rx="3" fill="#22c55e" stroke="#15803d" stroke-width="1.5"/>
            <rect x="60" y="30" width="10" height="20" rx="3" fill="#22c55e" stroke="#15803d" stroke-width="1.5"/>
            <rect x="20" y="35" width="40" height="10" rx="5" fill="#4ade80"/>
            <path d="M34 14 L40 10 L46 14 L44 22 L36 22 Z" fill="#facc15" stroke="#ca8a04" stroke-width="1.5" stroke-linejoin="round"/>
            <circle cx="40" cy="8" r="4" fill="#fde047" stroke="#ca8a04" stroke-width="1.5"/>
            <path d="M36 22 L34 30" stroke="#ca8a04" stroke-width="1.5" stroke-linecap="round"/>
            <path d="M44 22 L46 30" stroke="#ca8a04" stroke-width="1.5" stroke-linecap="round"/>
            <path d="M34 30 L28 36" stroke="#15803d" stroke-width="2" stroke-linecap="round"/>
            <path d="M46 30 L52 36" stroke="#15803d" stroke-width="2" stroke-linecap="round"/>
            <path d="M34 30 L36 44" stroke="#15803d" stroke-width="2" stroke-linecap="round"/>
            <path d="M46 30 L44 44" stroke="#15803d" stroke-width="2" stroke-linecap="round"/>
            <path d="M36 44 L32 56" stroke="#374151" stroke-width="2" stroke-linecap="round"/>
            <path d="M44 44 L48 56" stroke="#374151" stroke-width="2" stroke-linecap="round"/>
            <ellipse cx="31" cy="58" rx="5" ry="3" fill="#1f2937"/>
            <ellipse cx="49" cy="58" rx="5" ry="3" fill="#1f2937"/>
          </svg>
        </div>
        <div>
          <div class="card-label">Olahraga</div>
          <div class="card-desc">Aktif &amp; sehat setiap hari</div>
        </div>
      </div>
      <div class="stat">
        <span class="pip">Fitness</span>
        <span class="pip">Aktif</span>
      </div>
    </div>
 
    <!-- PINKY LOVERS -->
    <div class="hcard">
      <div class="hcard-row">
        <div class="icon-shell" style="background:linear-gradient(145deg,#fce7f3,#fbcfe8);">
          <svg width="36" height="36" viewBox="0 0 80 80" fill="none">
            <path d="M40 66 C40 66 14 50 14 30 C14 20 22 12 32 12 C36 12 40 14 40 18 C40 14 44 12 48 12 C58 12 66 20 66 30 C66 50 40 66 40 66Z" fill="#f472b6"/>
            <path d="M40 66 C40 66 20 52 18 34 C22 42 30 48 40 50 C50 48 58 42 62 34 C60 52 40 66 40 66Z" fill="#ec4899" opacity=".5"/>
            <path d="M24 26 C24 20 30 17 34 18" stroke="#fce7f3" stroke-width="3" stroke-linecap="round" opacity=".8"/>
            <path d="M50 10 L51.5 14 L56 15.5 L51.5 17 L50 21 L48.5 17 L44 15.5 L48.5 14 Z" fill="#f472b6"/>
            <path d="M14 20 L15 23 L18 24 L15 25 L14 28 L13 25 L10 24 L13 23 Z" fill="#fda4af"/>
          </svg>
        </div>
        <div>
          <div class="card-label">Pinky Lovers</div>
          <div class="card-desc">Segala hal pink &amp; aesthetic</div>
        </div>
      </div>
      <div class="stat">
        <span class="pip">Pink Vibes</span>
        <span class="pip">Girly</span>
      </div>
    </div>
 
    <!-- FOTOGRAFI -->
    <div class="hcard">
      <div class="hcard-row">
        <div class="icon-shell" style="background:linear-gradient(145deg,#fef9c3,#fef08a);">
          <svg width="36" height="36" viewBox="0 0 80 80" fill="none">
            <rect x="8" y="26" width="64" height="42" rx="9" fill="#1c1917"/>
            <rect x="8" y="26" width="64" height="16" rx="8" fill="#292524"/>
            <path d="M28 26 C28 18 52 18 52 26" fill="#44403c" stroke="#292524" stroke-width="1.5"/>
            <circle cx="40" cy="48" r="16" fill="#374151"/>
            <circle cx="40" cy="48" r="13" fill="#1e293b"/>
            <circle cx="40" cy="48" r="9" fill="#334155"/>
            <circle cx="40" cy="48" r="6" fill="#7dd3fc"/>
            <circle cx="40" cy="48" r="3" fill="#0ea5e9"/>
            <circle cx="40" cy="48" r="1.5" fill="#0c4a6e"/>
            <circle cx="37" cy="44" r="2" fill="#fff" opacity=".35"/>
            <rect x="54" y="30" width="10" height="7" rx="2.5" fill="#fbbf24" stroke="#d97706" stroke-width="1"/>
            <circle cx="17" cy="34" r="4.5" fill="#374151" stroke="#4b5563" stroke-width="1.5"/>
            <circle cx="17" cy="34" r="2" fill="#6b7280"/>
            <circle cx="63" cy="34" r="3" fill="#4ade80" opacity=".8"/>
          </svg>
        </div>
        <div>
          <div class="card-label">Fotografi</div>
          <div class="card-desc">Abadikan momen &amp; karya visual</div>
        </div>
      </div>
      <div class="stat">
        <span class="pip">Portrait</span>
        <span class="pip">Candid</span>
      </div>
    </div>
 
  </div>
</div>
</body>
</html>

<!-- Favorite Menu & Kuliner -->
<div class="accordion-item border-0 mb-3 shadow-sm" style="border-radius:16px; overflow:hidden;">
  <h2 class="accordion-header" id="headingFood">
    <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseFood"
            style="background:linear-gradient(135deg,#fce4ec,#f8bbd9); color:#c2185b;">
      <i class="bi bi-stars me-2"></i> Favorite Menu & Kuliner
    </button>
  </h2>
  <div id="collapseFood" class="accordion-collapse collapse show" data-bs-parent="#aboutAccordion">
    <div class="accordion-body" style="background:#fff9fb;">

      <!-- Banner dekoratif -->
      <div class="text-center mb-4 py-2 px-3 d-flex align-items-center justify-content-center gap-2" style="background:linear-gradient(135deg,#fce4ec,#fff0f5);border-radius:12px;">
        <span class="fw-semibold" style="color:#c2185b;">Best choice untuk mood yang lebih baik!!</span>
        <i class="bi bi-magic" style="color:#e91e63;font-size:1.3rem;"></i>
      </div>
      <div class="row g-3">

        <!-- Makanan Favorit -->
        <div class="col-md-6">
          <div class="p-3 h-100" style="background:linear-gradient(135deg,#fff,#fff5f8);border-radius:14px;border:1.5px solid #f8bbd9;">
            <h6 class="fw-bold mb-3 d-flex align-items-center gap-2"
                style="color:#c2185b; font-size:22px; letter-spacing:-.3px;">
              <span style="width:32px;height:32px;background:linear-gradient(135deg,#e91e63,#f06292);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-egg-fried text-white" style="font-size:1rem;"></i>
              </span>
              Makanan Favorit
            </h6>

            <div class="d-flex flex-column gap-2">
              <div class="d-flex align-items-center gap-2 px-3 py-2" style="background:#fff;border-radius:10px;border:1px solid #fce4ec;">
                <span style="font-size:1.3rem;">🍪</span>
                <div>
                  <div class="fw-semibold small" style="color:#880e4f;">Dubai Chewy Cookie</div>
                  <div class="text-muted" style="font-size:0.72rem;">Cookies viral yang chewy & lumer</div>
                </div>
              </div>

              <div class="d-flex align-items-center gap-2 px-3 py-2" style="background:#fff;border-radius:10px;border:1px solid #fce4ec;">
                <span style="font-size:1.3rem;">🍡</span>
                <div>
                  <div class="fw-semibold small" style="color:#880e4f;">Mochi Strawberry Chocolate</div>
                  <div class="text-muted" style="font-size:0.72rem;">Kenyal, manis, dan bikin ketagihan</div>
                </div>
              </div>

              <div class="d-flex align-items-center gap-2 px-3 py-2" style="background:#fff;border-radius:10px;border:1px solid #fce4ec;">
                <span style="font-size:1.3rem;">🎂</span>
                <div>
                  <div class="fw-semibold small" style="color:#880e4f;">Klapertart</div>
                  <div class="text-muted" style="font-size:0.72rem;">Dessert khas Manado yang creamy</div>
                </div>
              </div>

              <div class="d-flex align-items-center gap-2 px-3 py-2" style="background:#fff;border-radius:10px;border:1px solid #fce4ec;">
                <span style="font-size:1.3rem;">🥟</span>
                <div>
                  <div class="fw-semibold small" style="color:#880e4f;">Dimsum Mentai</div>
                  <div class="text-muted" style="font-size:0.72rem;">Gurih, creamy, dan selalu nagih</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Minuman Favorit -->
        <div class="col-md-6">
          <div class="p-3 h-100" style="background:linear-gradient(135deg,#fff,#fff5f8);border-radius:14px;border:1.5px solid #f8bbd9;">
            <h6 class="fw-bold mb-3 d-flex align-items-center gap-2"
                style="color:#c2185b; font-size:22px; letter-spacing:-.3px;">
              <span style="width:32px;height:32px;background:linear-gradient(135deg,#f48fb1,#e91e63);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-cup-straw text-white" style="font-size:1rem;"></i>
              </span>
              Minuman Favorit
            </h6>

            <div class="d-flex flex-column gap-2">
              <div class="d-flex align-items-center gap-2 px-3 py-2" style="background:#fff;border-radius:10px;border:1px solid #fce4ec;">
                <span style="font-size:1.3rem;">🍵</span>
                <div>
                  <div class="fw-semibold small" style="color:#880e4f;">Matcha</div>
                  <div class="text-muted" style="font-size:0.72rem;">Earthy, bitter, dan menenangkan</div>
                </div>
              </div>

              <div class="d-flex align-items-center gap-2 px-3 py-2" style="background:#fff;border-radius:10px;border:1px solid #fce4ec;">
                <span style="font-size:1.3rem;">🍦</span>
                <div>
                  <div class="fw-semibold small" style="color:#880e4f;">Ice Cream Vanilla & Strawberry</div>
                  <div class="text-muted" style="font-size:0.72rem;">Dingin, creamy, dan mood booster</div>
                </div>
              </div>

              <div class="d-flex align-items-center gap-2 px-3 py-2" style="background:#fff;border-radius:10px;border:1px solid #fce4ec;">
                <span style="font-size:1.3rem;">🥛</span>
                <div>
                  <div class="fw-semibold small" style="color:#880e4f;">Yogurt Lychee</div>
                  <div class="text-muted" style="font-size:0.72rem;">Segar, asam manis, dan sehat</div>
                </div>
              </div>

              <div class="d-flex align-items-center gap-2 px-3 py-2" style="background:#fff;border-radius:10px;border:1px solid #fce4ec;">
                <span style="font-size:1.3rem;">☕</span>
                <div>
                  <div class="fw-semibold small" style="color:#880e4f;">Kopi Susu</div>
                  <div class="text-muted" style="font-size:0.72rem;">Teman setia belajar & ngerjain tugas</div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- Pengalaman Organisasi -->
<div class="accordion-item border-0 mb-3 shadow-sm" style="border-radius:16px; overflow:hidden;">
  <h2 class="accordion-header" id="headingOrg">
    <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseOrg"
            style="background:linear-gradient(135deg,#fce4ec,#f8bbd9); color:#c2185b;">
      <i class="bi bi-buildings me-2"></i> Pengalaman Organisasi
    </button>
  </h2>
  <div id="collapseOrg" class="accordion-collapse collapse" data-bs-parent="#aboutAccordion">
    <div class="accordion-body" style="background:#fff9fb;">
      <div class="position-relative">

        <!-- Divisi Sekretaris -->
        <div class="mb-4 ps-4" style="border-left:3px solid #f48fb1;">
          <div class="d-flex align-items-center mb-2">
            <div style="width:42px;height:42px;background:linear-gradient(135deg,#e91e63,#f06292);border-radius:50%;display:flex;align-items:center;justify-content:center;margin-left:-22px;margin-right:12px;flex-shrink:0;box-shadow:0 3px 10px rgba(233,30,99,0.3);">
              <i class="bi bi-journal-text" style="color:#fff;font-size:1.1rem;"></i>
            </div>
            <div>
              <h6 class="fw-bold mb-0" style="color:#c2185b;">Divisi Sekretaris — Himpunan Mahasiswa Teknik Informatika</h6>
              <small class="text-muted"><i class="bi bi-calendar3 me-1"></i>2026</small>
            </div>
          </div>
          <p class="text-muted mb-0 small">
            Pengelolaan surat, pencatatan hasil rapat, pengarsipan dokumen, serta membantu koordinasi dan kelancaran kegiatan.
          </p>
        </div>

        <!-- Panitia Musyawarah Besar - Humas -->
        <div class="mb-4 ps-4" style="border-left:3px solid #f48fb1;">
          <div class="d-flex align-items-center mb-2">
            <div style="width:42px;height:42px;background:linear-gradient(135deg,#f48fb1,#f06292);border-radius:50%;display:flex;align-items:center;justify-content:center;margin-left:-22px;margin-right:12px;flex-shrink:0;box-shadow:0 3px 10px rgba(244,143,177,0.4);">
              <i class="bi bi-megaphone-fill" style="color:#fff;font-size:1.1rem;"></i>
            </div>
            <div>
              <h6 class="fw-bold mb-0" style="color:#c2185b;">Panitia Musyawarah Besar — Humas</h6>
              <small class="text-muted"><i class="bi bi-calendar3 me-1"></i>2026</small>
            </div>
          </div>
          <p class="text-muted mb-0 small">
            Menjalin komunikasi dan membangun hubungan baik antara organisasi dengan pihak internal maupun eksternal.
            Tugasnya meliputi menyebarkan informasi, publikasi kegiatan, mengelola media sosial, menjalin kerja sama, serta menjaga citra positif organisasi.
          </p>
        </div>

        <!-- Panitia Pemilihan Ketua Angkatan -->
        <div class="ps-4" style="border-left:3px solid #f48fb1;">
          <div class="d-flex align-items-center mb-2">
            <div style="width:42px;height:42px;background:linear-gradient(135deg,#fce4ec,#f8bbd9);border-radius:50%;display:flex;align-items:center;justify-content:center;margin-left:-22px;margin-right:12px;flex-shrink:0;box-shadow:0 3px 10px rgba(233,30,99,0.15);border:2px solid #e91e63;">
              <i class="bi bi-person-check-fill" style="color:#c2185b;font-size:1.1rem;"></i>
            </div>
            <div>
              <h6 class="fw-bold mb-0" style="color:#c2185b;">Panitia Pemilihan Ketua Angkatan — Sekretaris</h6>
              <small class="text-muted"><i class="bi bi-calendar3 me-1"></i>2026</small>
            </div>
          </div>
          <p class="text-muted mb-0 small">
            Menyusun administrasi pemilihan, mencatat notulen rapat, mengelola data peserta & kandidat, membuat surat dan pengumuman, mendokumentasikan hasil pemilihan, dan mengarsipkan dokumen.
          </p>
        </div>

      </div>
    </div>
  </div>
</div>