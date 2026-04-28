<?php
include "../../config/koneksi.php";

$nama = $_POST['nama'];
$kelas = $_POST['kelas'];

mysqli_query($conn, "INSERT INTO siswa (nama_siswa, kelas) VALUES ('$nama','$kelas')");

echo json_encode(["status" => "success"]);