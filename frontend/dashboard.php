<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard E-Makh</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">E-Makh</a>

        <div class="d-flex gap-2">
            <a href="atur-santri.php" 
              style="
                    text-decoration: none;
                    background: linear-gradient(135deg, #4f46e5, #6366f1);
                    color: white;
                    padding: 8px 16px;
                    border-radius: 10px;
                    font-size: 14px;
                    font-weight: 600;
                    display: inline-block;
                    transition: all 0.3s ease;
                    box-shadow: 0 4px 12px rgba(79,70,229,0.3);
              "
              onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 6px 18px rgba(79,70,229,0.5)'"
              onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 4px 12px rgba(79,70,229,0.3)'">
              ⚙️ Atur Santri
            </a>
            <a href="logout.php"
               onclick="return confirm('Yakin ingin logout?')"
               class="btn btn-danger btn-sm">
               Logout
            </a>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <h4 class="page-title">Tambah Poin Pelanggaran</h4>

    <div id="carouselSantri" class="carousel slide custom-carousel">        
      <div class="carousel-inner" id="carouselData" data-bs-ride="carousel" data-bs-interval="3000" data-bs-pause="hover">
            <!-- DATA API -->
        </div>

        

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
fetch('http://localhost/project-software/api/pelanggaran/get.php')
  .then(res => res.json())
  .then(data => {

    let html = '';

    if (data.length === 0) {
      html = `
        <div class="text-center mt-4">
          <h5>Tidak ada data siswa</h5>
        </div>
      `;
    } else {
      // Tampilkan semua santri, satu per slide, tanpa gambar profil
      data.forEach((item, index) => {
        html += `
          <div class="carousel-item${index === 0 ? ' active' : ''}">
            <div class="card santri-card text-center p-3">
              <h5>${item.nama_siswa ?? '-'}</h5>
              <p>Kelas: ${item.kelas ?? '-'}</p>
              <span class="badge bg-danger point-badge mb-3">
                Total Poin: ${item.poin ?? 0}
              </span>
              <a href="tambah-pelanggaran.php?id=${item.id_siswa}" class="btn btn-danger">
                Tambah Poin
              </a>
            </div>
          </div>
        `;
      });
    }

    document.getElementById('carouselData').innerHTML = html;
  })
  .catch(err => {
    console.error(err);
    document.getElementById('carouselData').innerHTML =
      "<h5 class='text-center'>Gagal ambil data</h5>";
  });
</script>

</body>
</html>