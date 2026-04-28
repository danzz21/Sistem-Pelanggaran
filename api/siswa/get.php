<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

include "../../config/koneksi.php";

$query = mysqli_query($conn, "SELECT * FROM siswa");

$data = [];

while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
}

echo json_encode($data);