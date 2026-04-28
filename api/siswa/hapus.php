<?php
include "../../config/koneksi.php";

$id = $_POST['id'];

mysqli_query($conn, "DELETE FROM siswa WHERE id_siswa='$id'");

echo json_encode(["status" => "deleted"]);