<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

include "../../config/koneksi.php";

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

if (!$query) {
    die(mysqli_error($conn));
}

$data = [];

while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
}

echo json_encode($data);