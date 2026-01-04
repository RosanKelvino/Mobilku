<?php
session_start();
include 'db.php';

$id_sewa = $_GET['id'] ?? '';
$query = $conn->query("SELECT sewa.*, mobil.nama_mobil FROM sewa 
                       JOIN mobil ON sewa.mobil_id = mobil.id 
                       WHERE sewa.id = '$id_sewa'");
$data = $query->fetch_assoc();

if (!$data) {
    echo "Data tidak ditemukan";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - MobilKu</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/booking.css">
    <link rel="stylesheet" href="css/about.css">
</head>

<body>

    <div class="container">
        <?php include 'navbar.php'; ?>


        <div class="container glass-panel"
            style="max-width: 500px; margin: 50px auto; padding: 30px; text-align:center;">
            <h2>Konfirmasi Pembayaran</h2>
            <p>Mobil: <strong><?php echo $data['nama_mobil']; ?></strong></p>
            <h1 style="color: #4754e6;">Rp <?php echo number_format($data['total_harga'], 0, ',', '.'); ?></h1>
            <div style="background: rgba(255,255,255,0.05); padding: 15px; border-radius: 10px; margin: 20px 0;">
                <p>Transfer ke <strong>BCA: 123456789</strong></p>
            </div>
            <form action="order.php" method="POST">
                <input type="hidden" name="id_sewa" value="<?php echo $id_sewa; ?>">
                <button type="submit" name="konfirmasi_bayar" class="btn-primary" style="width:100%;">Saya Sudah
                    Bayar</button>
            </form>
        </div>
        <footer class="glass-panel footer-simple">
            <div class="footer-content">
                <div class="footer-brand">
                    <h3><i class="fa-solid fa-car-side"></i> MobilKu</h3>
                    <p>Partner perjalanan terbaik Anda.</p>
                </div>
                <div class="footer-contact">
                    <p><i class="fa-solid fa-location-dot"></i> Jl. Merdeka No. 45, Jakarta Selatan</p>
                    <p><i class="fa-solid fa-phone"></i> +62 812 3456 7890</p>
                    <p><i class="fa-solid fa-envelope"></i> hello@luxedrive.com</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2023 LuxeDrive. All rights reserved.</p>
            </div>
        </footer>
    </div>

</body>

</html>