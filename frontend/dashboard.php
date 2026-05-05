<!DOCTYPE html>
<html>
<head>
    <title>Dashboard E-Makh</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

/* ================= GLOBAL ================= */
body {
    background: linear-gradient(120deg, #eef2ff, #f8fafc);
}

/* ================= NAVBAR ================= */
.navbar {
    background: linear-gradient(90deg, #4f46e5, #6366f1);
    box-shadow: 0 6px 20px rgba(79,70,229,0.2);
}

/* ================= TITLE ================= */
.page-title {
    text-align: center;
    font-weight: 800;
    font-size: 28px;
    color: #3730a3;
    margin-bottom: 30px;
}

/* ================= CAROUSEL ================= */
.custom-carousel {
    max-width: 420px;
    margin: auto;
    position: relative;
}

/* ================= CARD (PORTRAIT) ================= */
.santri-card {
    background: linear-gradient(145deg, #ffffff, #eef2ff);
    border-radius: 28px;
    padding: 30px 20px 50px;
    text-align: center;
    height: 420px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    box-shadow: 0 20px 60px rgba(15,23,42,0.15);
}
.santri-card {
    padding: 50px 20px 40px;
    height: 440px;
    justify-content: space-between;
}

/* BAGIAN ATAS */
.santri-card h5 {
    margin-top: 20px; /* turun dikit */
    margin-bottom: 4px;
}

.santri-card p {
    margin-bottom: 20px;
}

/* TEXT */
.santri-card h5 {
    font-weight: 800;
    color: #3730a3;
}
.santri-card > div:first-child {
    margin-top: 30px;
}
.point-badge {
    background: linear-gradient(90deg, #6366f1, #818cf8);
    color: white;
    border-radius: 50px;
    padding: 6px 18px;
}

/* BUTTON */
.btn-danger {
    background: linear-gradient(135deg, #ef4444, #b91c1c);
    border: none;
    border-radius: 999px;
}

/* ================= SLIDE INDICATOR (BAWAH) ================= */
.slide-indicator-bottom {
    margin-top: 15px;
    font-size: 13px;
    font-weight: 600;
    color: #555;
}

/* ================= ARROW ================= */
.carousel-control-prev,
.carousel-control-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 50px;
    height: 50px;
}

/* POSISI */
.carousel-control-prev { left: -80px; }
.carousel-control-next { right: -80px; }

/* SQUARE STYLE */
.carousel-control-prev-icon,
.carousel-control-next-icon {
    background: linear-gradient(135deg, #4f46e5, #6366f1);
    width: 50px;
    height: 50px;
    border-radius: 12px; /* ini bikin kotak rounded, bukan bulat */
    display: flex;
    align-items: center;
    justify-content: center;
}

/* ICON */
.carousel-control-prev-icon::after {
    content: '‹';
    color: white;
    font-size: 26px;
    font-weight: bold;
}

.carousel-control-next-icon::after {
    content: '›';
    color: white;
    font-size: 26px;
    font-weight: bold;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .carousel-control-prev { left: 5px; }
    .carousel-control-next { right: 5px; }
}

</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <span class="navbar-brand fw-bold">E-Makh</span>

        <div class="d-flex gap-2">
            <a href="atur-santri.php" class="btn btn-light btn-sm fw-semibold">
                ⚙️ Atur Santri
            </a>
            <a href="logout.php" class="btn btn-danger btn-sm">
                Logout
            </a>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <h4 class="page-title">Tambah Poin Pelanggaran</h4>

    <div class="custom-carousel">
      <div id="carouselSantri" class="carousel slide">        
        <div class="carousel-inner" id="carouselData"></div>

        <button class="carousel-control-prev" type="button"
            data-bs-target="#carouselSantri" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>

        <button class="carousel-control-next" type="button"
            data-bs-target="#carouselSantri" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
      </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

// MANUAL CAROUSEL (NO AUTO SLIDE)
new bootstrap.Carousel('#carouselSantri', {
  interval: false,
  ride: false,
  wrap: false
});

fetch('http://localhost/project-software/api/pelanggaran/get.php')
  .then(res => res.json())
  .then(data => {

    let html = '';

    data.forEach((item, index) => {
      html += `
        <div class="carousel-item ${index === 0 ? 'active' : ''}">
          <div class="santri-card">

            <div>
              <h5>${item.nama_siswa}</h5>
              <p>Kelas: ${item.kelas}</p>
            </div>

            <div>
              <span class="badge point-badge">
                Total Poin: ${item.poin}
              </span>
            </div>

            <div>
              <a href="tambah-pelanggaran.php?id=${item.id_siswa}" class="btn btn-danger w-100">
                Tambah Poin
              </a>

              <div class="slide-indicator-bottom">
                ${index + 1} / ${data.length}
              </div>
            </div>

          </div>
        </div>
      `;
    });

    document.getElementById('carouselData').innerHTML = html;
  });

</script>

</body>
</html>