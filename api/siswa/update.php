<?php
include "../../config/koneksi.php";

$id = $_POST['id'];
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];

mysqli_query($conn, "UPDATE siswa SET nama_siswa='$nama', kelas='$kelas' WHERE id_siswa='$id'");

echo json_encode(["status" => "updated"]);