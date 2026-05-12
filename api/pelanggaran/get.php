<?php
session_start();

// ================= SECURITY HEADERS ================= //
header("Content-Type: application/json");

// GANTI dengan domain frontend asli lu
header("Access-Control-Allow-Origin: http://localhost");

// hanya izinkan method GET
header("Access-Control-Allow-Methods: GET");

// ================= AUTH CHECK ================= //
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
        siswa.id_siswa,
        siswa.nama_siswa,
        siswa.kelas,
        COALESCE(SUM(pelanggaran.poin), 0) as poin
    FROM siswa
    LEFT JOIN pelanggaran 
        ON siswa.id_siswa = pelanggaran.id_siswa
    GROUP BY siswa.id_siswa
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