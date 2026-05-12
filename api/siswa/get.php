<?php
session_start();

// ================= HEADERS ================= //
header("Content-Type: application/json");

// GANTI kalau frontend lu beda domain/port
header("Access-Control-Allow-Origin: http://localhost");

// hanya izinkan GET
header("Access-Control-Allow-Methods: GET");

// ================= AUTH ================= //
if (!isset($_SESSION['login'])) {

    http_response_code(401);

    echo json_encode([
        "status" => "error",
        "message" => "Unauthorized"
    ]);

    exit;
}

// ================= DATABASE ================= //
include "../../config/koneksi.php";

// ================= QUERY ================= //
$query = mysqli_query($conn, "
    SELECT 
        id_siswa,
        nama_siswa,
        kelas
    FROM siswa
");

// ================= ERROR QUERY ================= //
if (!$query) {

    http_response_code(500);

    echo json_encode([
        "status" => "error",
        "message" => "Database error"
    ]);

    exit;
}

// ================= AMBIL DATA ================= //
$data = [];

while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
}

// ================= RESPONSE ================= //
echo json_encode([
    "status" => "success",
    "data" => $data
]);