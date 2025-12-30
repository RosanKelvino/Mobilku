<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Mobil - MobilKu</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="booking.css">
    <link rel="stylesheet" href="about.css">

</head>

<body>

    <div class="glow-orb orb-1"></div>
    <div class="glow-orb orb-2"></div>

    <div class="container">

        <nav class="navbar glass-panel">
            <div class="logo">
                <i class="fa-solid fa-car-side"></i> MobilKu
            </div>
            <ul class="nav-links">
                <li><a href="index.php">Beranda</a></li>
                <li><a href="catalog.php">Katalog</a></li>
                <li><a href="services.php">Layanan</a></li>
                <li><a href="about.php">Tentang</a></li>
            </ul>
            <div class="nav-actions">
                <button class="btn-transparent">Masuk</button>
                <button class="btn-primary">Daftar</button>
            </div>
        </nav>

        <?php
        $mobilDipilih = isset($_GET['mobil']) ? $_GET['mobil'] : '';
        ?>

        <h1 style="text-align: center; margin-bottom: 10px; margin-top: 30px;">Pemesanan Mobil</h1>
        <p style="text-align: center; margin-bottom: 30px;">Lengkapi data pemesanan mobil kamu</p>

        <form action="payment.php" method="post" class="glass-panel form-booking">

            <label>Nama Lengkap</label>
            <input type="text" name="nama" required placeholder="Masukkan nama lengkap">

            <label>No HP</label>
            <input type="tel" name="hp" required placeholder="08xxxxxxxxxx">

            <label>Pilih Mobil</label>
            <select name="mobil" required>
                <option value="">-- Pilih Mobil --</option>
                <option value="Audi A8 L" <?= $mobilDipilih == 'Audi A8 L' ? 'selected' : '' ?>>Audi A8 L</option>
                <option value="Jeep Cherokee" <?= $mobilDipilih == 'Jeep Cherokee' ? 'selected' : '' ?>>Jeep Cherokee</option>
                <option value="BMW X6" <?= $mobilDipilih == 'BMW X6' ? 'selected' : '' ?>>BMW X6</option>
                <option value="Porsche Cayman" <?= $mobilDipilih == 'Porsche Cayman' ? 'selected' : '' ?>>Porsche Cayman</option>
                <option value="Mercedes C63" <?= $mobilDipilih == 'Mercedes C63' ? 'selected' : '' ?>>Mercedes C63</option>
                <option value="Toyota Hilux" <?= $mobilDipilih == 'Toyota Hilux' ? 'selected' : '' ?>>Toyota Hilux</option>
            </select>

            <label>Jenis Layanan</label>
            <select name="layanan" required>
                <option value="Lepas Kunci">Lepas Kunci</option>
                <option value="Dengan Supir">Dengan Supir (+Rp 150.000)</option>
            </select>

            <label>Tanggal Mulai</label>
            <input type="date" name="tgl_mulai" required>

            <label>Tanggal Selesai</label>
            <input type="date" name="tgl_selesai" required>

            <button type="submit" class="btn-primary" style="width: 100%; margin-top: 20px;">
                Lanjut ke Pembayaran
            </button>
        </form>


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
    <?php include 'login.php'; ?>
</body>

</html>