<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Silahkan login terlebih dahulu!'); window.location='login.php';</script>";
    exit();
}

$user_id  = $_SESSION['user_id'];
$mobil_id = $_GET['id'];
$tgl_mulai = date('Y-m-d');
$tgl_selesai = date('Y-m-d', strtotime('+1 day'));

$query_mobil = mysqli_query($conn, "SELECT harga FROM mobil WHERE id = '$mobil_id'");
$data_mobil  = mysqli_fetch_assoc($query_mobil);
$total_harga = $data_mobil['harga'];

$sql = "INSERT INTO sewa (user_id, mobil_id, tgl_mulai, tgl_selesai, total_harga, status) 
        VALUES ('$user_id', '$mobil_id', '$tgl_mulai', '$tgl_selesai', '$total_harga', 'Menunggu')";

if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Pemesanan Berhasil!'); window.location='riwayat.php';</script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>