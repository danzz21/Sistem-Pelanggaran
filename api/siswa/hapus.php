<?php
session_start();

// ================= HEADERS ================= //
header("Content-Type: application/json");

// GANTI kalau frontend beda domain
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

// ================= AMBIL ID ================= //
$id = $_POST['id'] ?? null;

// ================= VALIDASI ================= //
if (!$id) {

    http_response_code(400);

    echo json_encode([
        "status" => "error",
        "message" => "ID tidak dikirim"
    ]);

    exit;
}

// hanya angka
if (!is_numeric($id)) {

    http_response_code(400);

    echo json_encode([
        "status" => "error",
        "message" => "ID tidak valid"
    ]);

    exit;
}

// ================= PREPARED STATEMENT ================= //
$stmt = $conn->prepare("
    DELETE FROM siswa 
    WHERE id_siswa = ?
");

$stmt->bind_param("i", $id);

// ================= EKSEKUSI ================= //
if ($stmt->execute()) {

    // cek apakah ada data terhapus
    if ($stmt->affected_rows > 0) {

        echo json_encode([
            "status" => "success",
            "message" => "Berhasil dihapus"
        ]);

    } else {

        echo json_encode([
            "status" => "error",
            "message" => "ID tidak ditemukan"
        ]);
    }

} else {

    http_response_code(500);

    echo json_encode([
        "status" => "error",
        "message" => "Gagal menghapus data"
    ]);
}