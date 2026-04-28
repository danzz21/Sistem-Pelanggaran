<?php
session_start();
include "../config/koneksi.php";

$nama = $_POST['username']; // input tetap "username" gapapa
$password = $_POST['password'];

// ambil data dari tabel admin (pakai kolom nama)
$query = mysqli_query($conn, "SELECT * FROM admin WHERE nama='$nama'");
$data = mysqli_fetch_assoc($query);

if ($data) {

    if ($password == $data['password']) {

        $_SESSION['login'] = true;
        $_SESSION['nama'] = $data['nama'];

        header("Location: dashboard.php");
        exit;

    } else {
        echo "<script>alert('Password salah'); window.location='index.php';</script>";
    }

} else {
    echo "<script>alert('User tidak ditemukan'); window.location='index.php';</script>";
}
?>