<?php
include "../../config/koneksi.php";

header("Content-Type: application/json");

$nama  = trim($_POST['nama'] ?? '');
$kelas = trim($_POST['kelas'] ?? '');

// ================= VALIDASI ================= //

// 1. Tidak boleh kosong
if ($nama === '' || $kelas === '') {
    echo json_encode([
        "status" => "error",
        "message" => "Nama dan kelas wajib diisi"
    ]);
    exit;
}

// 2. Panjang maksimal
if (strlen($nama) > 50) {
    echo json_encode([
        "status" => "error",
        "message" => "Nama maksimal 50 karakter"
    ]);
    exit;
}

// 3. Hanya huruf & spasi
if (!preg_match("/^[a-zA-Z\s]+$/", $nama)) {
    echo json_encode([
        "status" => "error",
        "message" => "Nama hanya boleh huruf"
    ]);
    exit;
}

// 4. Cek duplikat
$cek = mysqli_query($conn, "
    SELECT * FROM siswa 
    WHERE nama_siswa='$nama' AND kelas='$kelas'
");

if (mysqli_num_rows($cek) > 0) {
    echo json_encode([
        "status" => "error",
        "message" => "Data sudah ada"
    ]);
    exit;
}

// ================= INSERT ================= //

$result = mysqli_query($conn, "
    INSERT INTO siswa (nama_siswa, kelas) 
    VALUES ('$nama','$kelas')
");

if ($result) {
    echo json_encode([
        "status" => "success",
        "message" => "Santri berhasil ditambahkan"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => mysqli_error($conn)
    ]);
}