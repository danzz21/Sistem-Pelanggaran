<?php
include "../../config/koneksi.php";

header("Content-Type: application/json");

$id = $_POST['id'] ?? null;

// VALIDASI
if (!$id) {
    echo json_encode([
        "status" => "error",
        "message" => "ID tidak dikirim"
    ]);
    exit;
}

// QUERY DELETE
$result = mysqli_query($conn, "DELETE FROM siswa WHERE id_siswa='$id'");

// CEK HASIL
if ($result && mysqli_affected_rows($conn) > 0) {
    echo json_encode([
        "status" => "success",
        "message" => "Berhasil dihapus"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Gagal hapus / ID tidak ditemukan"
    ]);
}