<!-- header.php - Carousel Bootstrap dengan Background Foto -->
<div id="headerCarousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#headerCarousel" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#headerCarousel" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#headerCarousel" data-bs-slide-to="2"></button>
  </div>

  <div class="carousel-inner">

    <!-- Slide 1 -->
    <div class="carousel-item active">
      <img src="img/meong1.jpeg" class="d-block w-100" alt="Slide 1"
           style="height: 280px; object-fit:cover; object-position:center;">
      <div class="carousel-caption d-flex align-items-center justify-content-center"
           style="inset:0; background:rgba(233,30,140,0.35);">
        <div class="text-center">
          <h1 class="display-4 fw-bold text-white"
              style="text-shadow:2px 2px 8px rgba(0,0,0,0.4);">Welcome to My World</h1>
        </div>
      </div>
    </div>

    <!-- Slide 2 -->
    <div class="carousel-item">
      <img src="img/bunga3.jpeg" class="d-block w-100" alt="Slide 2"
           style="height:280px; object-fit:cover; object-position:center top;">
      <div class="carousel-caption d-flex align-items-center justify-content-center"
           style="inset:0; background:rgba(136,14,79,0.35);">
        <div class="text-center">
          <h2 class="display-5 fw-bold text-white"
              style="text-shadow:2px 2px 6px rgba(0,0,0,0.4);">Dream Big, Start Small</h2>
          <p class="lead text-white">Perjalanan seribu mil dimulai dari satu langkah</p>
        </div>
      </div>
    </div>

    <!-- Slide 3 -->
    <div class="carousel-item">
      <img src="img/sunset.jpeg" class="d-block w-100" alt="Slide 3"
           style="height:300px; object-fit:cover; object-position:center;">
      <div class="carousel-caption d-flex align-items-center justify-content-center"
           style="inset:0; background:rgba(240,98,146,0.35);">
        <div class="text-center">
          <h2 class="display-5 fw-bold text-white"
              style="text-shadow:2px 2px 8px rgba(0,0,0,0.4);">Always Learning, Always Growing</h2>
          <p class="lead text-white">Setiap hari adalah kesempatan untuk berkembang</p>
        </div>
      </div>
    </div>

  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#headerCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#headerCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>