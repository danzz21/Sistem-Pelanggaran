<?php
session_start();

// ================= HEADERS ================= //
header("Content-Type: application/json");

// GANTI jika frontend beda domain
header("Access-Control-Allow-Origin: http://localhost");

// hanya izinkan POST
header("Access-Control-Allow-Methods: POST");

// ================= AUTH ================= //
if (!isset($_SESSION['login'])) {

    http_response_code(401);

    echo json_encode([
        "status" => "error",
        "message" => "Unauthorized"
    ]);

    exit;
}

// ================= METHOD CHECK ================= //
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    http_response_code(405);

    echo json_encode([
        "status" => "error",
        "message" => "Method harus POST"
    ]);

    exit;
}

// ================= DATABASE ================= //
include "../../config/koneksi.php";

// ================= AMBIL INPUT ================= //
$nama  = trim($_POST['nama'] ?? '');
$kelas = trim($_POST['kelas'] ?? '');

// ================= VALIDASI ================= //

// wajib isi
if ($nama === '' || $kelas === '') {

    http_response_code(400);

    echo json_encode([
        "status" => "error",
        "message" => "Nama dan kelas wajib diisi"
    ]);

    exit;
}

// panjang maksimal
if (strlen($nama) > 50) {

    http_response_code(400);

    echo json_encode([
        "status" => "error",
        "message" => "Nama maksimal 50 karakter"
    ]);

    exit;
}

// hanya huruf & spasi
if (!preg_match("/^[a-zA-Z\s]+$/", $nama)) {

    http_response_code(400);

    echo json_encode([
        "status" => "error",
        "message" => "Nama hanya boleh huruf"
    ]);

    exit;
}

// panjang kelas
if (strlen($kelas) > 20) {

    http_response_code(400);

    echo json_encode([
        "status" => "error",
        "message" => "Kelas maksimal 20 karakter"
    ]);

    exit;
}

// ================= CEK DUPLIKAT ================= //
$cek = $conn->prepare("
    SELECT id_siswa 
    FROM siswa 
    WHERE nama_siswa = ? 
    AND kelas = ?
");

$cek->bind_param("ss", $nama, $kelas);
$cek->execute();

$resultCek = $cek->get_result();

if ($resultCek->num_rows > 0) {

    http_response_code(409);

    echo json_encode([
        "status" => "error",
        "message" => "Data sudah ada"
    ]);

    exit;
}

// ================= INSERT ================= //
$stmt = $conn->prepare("
    INSERT INTO siswa (nama_siswa, kelas)
    VALUES (?, ?)
");

$stmt->bind_param("ss", $nama, $kelas);

// ================= EKSEKUSI ================= //
if ($stmt->execute()) {

    echo json_encode([
        "status" => "success",
        "message" => "Santri berhasil ditambahkan"
    ]);

} else {

    http_response_code(500);

    echo json_encode([
        "status" => "error",
        "message" => "Gagal menambahkan data"
    ]);
}