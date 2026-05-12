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
$id    = $_POST['id'] ?? null;
$nama  = trim($_POST['nama'] ?? '');
$kelas = trim($_POST['kelas'] ?? '');

// ================= VALIDASI ================= //

// ID wajib ada
if (!$id) {

    http_response_code(400);

    echo json_encode([
        "status" => "error",
        "message" => "ID tidak ditemukan"
    ]);

    exit;
}

// ID harus angka
if (!is_numeric($id)) {

    http_response_code(400);

    echo json_encode([
        "status" => "error",
        "message" => "ID tidak valid"
    ]);

    exit;
}

// wajib isi
if ($nama === '' || $kelas === '') {

    http_response_code(400);

    echo json_encode([
        "status" => "error",
        "message" => "Nama dan kelas wajib diisi"
    ]);

    exit;
}

// panjang maksimal nama
if (strlen($nama) > 50) {

    http_response_code(400);

    echo json_encode([
        "status" => "error",
        "message" => "Nama maksimal 50 karakter"
    ]);

    exit;
}

// panjang maksimal kelas
if (strlen($kelas) > 20) {

    http_response_code(400);

    echo json_encode([
        "status" => "error",
        "message" => "Kelas maksimal 20 karakter"
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

// ================= CEK DATA SISWA ================= //
$cekSiswa = $conn->prepare("
    SELECT id_siswa 
    FROM siswa 
    WHERE id_siswa = ?
");

$cekSiswa->bind_param("i", $id);
$cekSiswa->execute();

$resultSiswa = $cekSiswa->get_result();

if ($resultSiswa->num_rows === 0) {

    http_response_code(404);

    echo json_encode([
        "status" => "error",
        "message" => "Siswa tidak ditemukan"
    ]);

    exit;
}

// ================= CEK DUPLIKAT ================= //
$cek = $conn->prepare("
    SELECT id_siswa
    FROM siswa
    WHERE nama_siswa = ?
    AND kelas = ?
    AND id_siswa != ?
");

$cek->bind_param("ssi", $nama, $kelas, $id);
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

// ================= UPDATE ================= //
$stmt = $conn->prepare("
    UPDATE siswa
    SET nama_siswa = ?, kelas = ?
    WHERE id_siswa = ?
");

$stmt->bind_param("ssi", $nama, $kelas, $id);

// ================= EKSEKUSI ================= //
if ($stmt->execute()) {

    if ($stmt->affected_rows > 0) {

        echo json_encode([
            "status" => "success",
            "message" => "Data berhasil diupdate"
        ]);

    } else {

        echo json_encode([
            "status" => "success",
            "message" => "Tidak ada perubahan data"
        ]);
    }

} else {

    http_response_code(500);

    echo json_encode([
        "status" => "error",
        "message" => "Gagal update data"
    ]);
}