<?php
include "../config/koneksi.php";

// ================= AMBIL ID ================= //
$id_siswa = $_GET['id'] ?? null;

if (!$id_siswa) {
    echo "<script>alert('Akses tidak valid'); window.location='dashboard.php';</script>";
    exit;
}

// ================= CEK SISWA ================= //
$cek = mysqli_query($conn, "SELECT * FROM siswa WHERE id_siswa='$id_siswa'");
$siswa = mysqli_fetch_assoc($cek);

if (!$siswa) {
    echo "<script>alert('Siswa tidak ditemukan'); window.location='dashboard.php';</script>";
    exit;
}

// ================= PROSES SIMPAN ================= //
if (isset($_POST['simpan'])) {

    $id    = $_POST['id_siswa'] ?? null;
    $jenis = trim($_POST['jenis'] ?? '');
    $poin  = $_POST['poin'] ?? null;
    $date  = date("Y-m-d");

    // ===== VALIDASI DASAR ===== //
    if (!$id || $jenis === '') {
        echo "<script>alert('Data tidak lengkap');</script>";
    } else {

        // ===== VALIDASI POIN ===== //

        // 1. wajib diisi
        if ($poin === null || $poin === '') {
            echo "<script>alert('Poin wajib diisi');</script>";
            exit;
        }

        // 2. harus angka
        if (!is_numeric($poin)) {
            echo "<script>alert('Poin harus angka');</script>";
            exit;
        }

        $poin = (int)$poin;

        // 3. tidak boleh <= 0
        if ($poin <= 0) {
            echo "<script>alert('Poin harus lebih dari 0');</script>";
            exit;
        }

        // 4. batas maksimal
        if ($poin > 100) {
            echo "<script>alert('Poin maksimal 100');</script>";
            exit;
        }

        // ===== INSERT ===== //
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