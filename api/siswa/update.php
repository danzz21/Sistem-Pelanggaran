<?php
include "../../config/koneksi.php";

header("Content-Type: application/json");

$id    = $_POST['id'] ?? null;
$nama  = trim($_POST['nama'] ?? '');
$kelas = trim($_POST['kelas'] ?? '');

// ================= VALIDASI ================= //

// 1. ID wajib ada
if (!$id) {
    echo json_encode([
        "status" => "error",
        "message" => "ID tidak ditemukan"
    ]);
    exit;
}

// 2. Tidak boleh kosong
if ($nama === '' || $kelas === '') {
    echo json_encode([
        "status" => "error",
        "message" => "Nama dan kelas wajib diisi"
    ]);
    exit;
}

// 3. Panjang maksimal
if (strlen($nama) > 50) {
    echo json_encode([
        "status" => "error",
        "message" => "Nama maksimal 50 karakter"
    ]);
    exit;
}

// 4. Karakter valid
if (!preg_match("/^[a-zA-Z\s]+$/", $nama)) {
    echo json_encode([
        "status" => "error",
        "message" => "Nama hanya boleh huruf"
    ]);
    exit;
}

// 5. Cek duplikat (kecuali dirinya sendiri)
$cek = mysqli_query($conn, "
    SELECT * FROM siswa 
    WHERE nama_siswa='$nama' 
    AND kelas='$kelas'
    AND id_siswa != '$id'
");

if (mysqli_num_rows($cek) > 0) {
    echo json_encode([
        "status" => "error",
        "message" => "Data sudah ada"
    ]);
    exit;
}

// ================= UPDATE ================= //

$result = mysqli_query($conn, "
    UPDATE siswa 
    SET nama_siswa='$nama', kelas='$kelas' 
    WHERE id_siswa='$id'
");

if ($result && mysqli_affected_rows($conn) > 0) {
    echo json_encode([
        "status" => "success",
        "message" => "Data berhasil diupdate"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Tidak ada perubahan atau gagal update"
    ]);
}