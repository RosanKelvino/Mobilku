<?php
session_start();
include 'db.php';

if (isset($_POST['id_sewa'])) {
    $id_sewa = $_POST['id_sewa'];
    // Update status di database
    $conn->query("UPDATE sewa SET status = 'Proses' WHERE id = '$id_sewa'");
} else {
    header("Location: riwayat.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil - MobilKu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/booking.css">
    <link rel="stylesheet" href="css/about.css">
    <style>
        body {
            padding-top: 80px;
        }
    </style>

</head>

<body>
    <div class="container">
        <?php include 'navbar.php'; ?>
    </div>


    <div class="container glass-panel" style="max-width: 600px; margin: 80px auto; text-align: center; padding: 40px;">
        <i class="fa-solid fa-circle-check" style="font-size: 60px; color: #00ff88;"></i>
        <h1>Pemesanan Berhasil!</h1>
        <p>ID Transaksi: #MK-<?php echo $id_sewa; ?></p>
        <p>Pesanan Anda sedang diverifikasi. Silakan cek berkala di Riwayat Sewa.</p>
        <br>
        <a href="riwayat.php" class="btn-primary" style="display:inline-block; text-decoration:none;">Buka Riwayat
            Sewa</a>
    </div>


</body>

</html>