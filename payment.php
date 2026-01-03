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
        <nav class="navbar glass-panel">
            <div class="logo">
                <a href="index.php">
                    <i class="fa-solid fa-car-side"></i> MobilKu
                </a>
            </div>
            <ul class="nav-links">
                <li><a href="index.php">Beranda</a></li>
                <li><a href="catalog.php">Katalog</a></li>
                <li><a href="services.php">Layanan</a></li>
                <li><a href="about.php">Tentang</a></li>
            </ul>
        </nav>

        <h1 style="text-align: center; margin-top: 30px;">Pembayaran</h1>
        <p style="text-align: center; margin-bottom: 20px;">Silakan lakukan pembayaran untuk menyelesaikan pesanan</p>

        <div class="glass-panel payment-box" style="max-width: 600px; margin: 0 auto;">
            <h3>Ringkasan Pesanan</h3>
            <div style="margin: 20px 0; line-height: 1.6;">
                <p><strong>Nama:</strong> <?php echo $_POST['nama'] ?? '-'; ?></p>
                <p><strong>Mobil:</strong> <?php echo $_POST['mobil']; ?></p>
                <p><strong>Layanan:</strong> <?php echo $_POST['layanan']; ?></p>
                <p><strong>Tanggal:</strong> <?php echo $_POST['tgl_mulai']; ?> s/d <?php echo $_POST['tgl_selesai']; ?>
                </p>
            </div>

            <hr style="border: 0; border-top: 1px solid rgba(255,255,255,0.2); margin: 20px 0;">

            <h3>Total Bayar (DP)</h3>
            <h2 class="text-gradient" style="font-size: 2rem;">Rp 500.000</h2>

            <div style="background: rgba(255,255,255,0.05); padding: 15px; border-radius: 10px; margin: 20px 0;">
                <p>Silakan transfer ke:</p>
                <ul style="list-style: none; padding: 0; margin-top: 10px;">
                    <li style="margin-bottom: 5px;"><i class="fa-solid fa-building-columns"></i> BCA:
                        <strong>123456789</strong> a.n MobilKu</li>
                    <li><i class="fa-solid fa-building-columns"></i> Mandiri: <strong>987654321</strong> a.n MobilKu
                    </li>
                </ul>
            </div>

            <form action="order.php" method="post">
                <button type="submit" class="btn-primary" style="width: 100%;">
                    Saya Sudah Bayar
                </button>
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