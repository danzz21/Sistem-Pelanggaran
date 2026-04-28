<?php
include "../config/koneksi.php";

// AMBIL ID DARI URL
$id_siswa = $_GET['id'] ?? null;

// VALIDASI ID
if (!$id_siswa) {
    echo "<script>alert('Akses tidak valid'); window.location='dashboard.php';</script>";
    exit;
}

// CEK APAKAH ID ADA DI DATABASE
$cek = mysqli_query($conn, "SELECT * FROM siswa WHERE id_siswa='$id_siswa'");
$siswa = mysqli_fetch_assoc($cek);

if (!$siswa) {
    echo "<script>alert('Siswa tidak ditemukan'); window.location='dashboard.php';</script>";
    exit;
}

// PROSES SIMPAN
if (isset($_POST['simpan'])) {

    $id = $_POST['id_siswa'];
    $jenis = $_POST['jenis'];
    $poin = $_POST['poin'];
    $date = date("Y-m-d");

    // VALIDASI INPUT
    if (!$id || !$jenis || !$poin) {
        echo "<script>alert('Data tidak lengkap');</script>";
    } else {

        $insert = mysqli_query($conn, "
            INSERT INTO pelanggaran (id_siswa, jenis_pelanggaran, poin, date)
            VALUES ('$id', '$jenis', '$poin', '$date')
        ");

        if ($insert) {
            echo "<script>
                alert('Berhasil tambah pelanggaran');
                window.location='dashboard.php';
            </script>";
        } else {
            echo "<script>alert('Gagal simpan: ".mysqli_error($conn)."');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pelanggaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <div class="card p-4">

        <h3 class="mb-3">Tambah Pelanggaran</h3>

        <!-- INFO SISWA -->
        <div class="alert alert-info">
            <b>Nama:</b> <?= $siswa['nama_siswa']; ?> <br>
            <b>Kelas:</b> <?= $siswa['kelas']; ?>
        </div>

        <form method="POST">

            <input type="hidden" name="id_siswa" value="<?= $id_siswa ?>">

            <div class="mb-3">
                <label>Nama Pelanggaran</label>
                <input type="text" name="jenis" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Kategori</label>
                <select class="form-select" id="kategori">
                    <option value="">-- Pilih --</option>
                    <option value="1">Ringan (1)</option>
                    <option value="10">Sedang (10)</option>
                    <option value="20">Berat (20)</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Poin</label>
                <input type="number" name="poin" id="poin" class="form-control" required>
            </div>

            <button name="simpan" class="btn btn-danger">Simpan</button>
            <a href="dashboard.php" class="btn btn-secondary">Kembali</a>

        </form>

    </div>
</div>

<script>
// AUTO ISI POIN DARI KATEGORI
document.getElementById('kategori').addEventListener('change', function() {
    document.getElementById('poin').value = this.value;
});
</script>

</body>
</html>