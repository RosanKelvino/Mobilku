<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pemesanan Mobil - MobilKu</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="booking.css">

</head>

<body>
    <?php
    $mobilDipilih = $_GET['mobil'] ?? '';
    ?>

    <!-- <label>Pilih Mobil</label>
    <select name="mobil" required>
        <option value="">-- Pilih Mobil --</option>
        <option value="Toyota Avanza" <?= $mobilDipilih == 'Toyota Avanza' ? 'selected' : '' ?>>
            Toyota Avanza
        </option>
        <option value="Toyota Innova" <?= $mobilDipilih == 'Toyota Innova' ? 'selected' : '' ?>>
            Toyota Innova
        </option>
    </select> -->

    <div class="container">
        <h1>Pemesanan Mobil</h1>
        <p>Lengkapi data pemesanan mobil kamu</p>

        <form action="payment.php" method="post" class="glass-panel form-booking">

            <label>Nama Lengkap</label>
            <input type="text" name="nama" required>

            <label>No HP</label>
            <input type="tel" name="hp" required>

            <label>Pilih Mobil</label>
            <select name="mobil" required>
                <option value="">-- Pilih Mobil --</option>
                <option value="Avanza">Toyota Avanza</option>
                <option value="Innova">Toyota Innova</option>
                <option value="Fortuner">Toyota Fortuner</option>
            </select>

            <label>Jenis Layanan</label>
            <select name="layanan" required>
                <option value="lepas_kunci">Lepas Kunci</option>
                <option value="supir">Dengan Supir</option>
            </select>

            <label>Tanggal Mulai</label>
            <input type="date" name="tgl_mulai" required>

            <label>Tanggal Selesai</label>
            <input type="date" name="tgl_selesai" required>

            <div class="glass-panel payment-box">
                <h2>Verifikasi & Bayar</h2>
                <p>Booking Anda telah diverifikasi oleh admin</p>

                <h3>Total DP</h3>
                <h2>Rp 300.000</h2>

                <p>Silakan transfer DP untuk mengamankan unit</p>

                <ul>
                    <li>BCA: 123456789 a.n MobilKu</li>
                    <li>Mandiri: 987654321 a.n MobilKu</li>
                </ul>

                <form action="order.php" method="post">
                    <button class="btn-primary">
                        Saya Sudah Bayar DP
                    </button>
                </form>
            </div>

            <button type="submit" class="btn-primary">
                Lanjut ke Pembayaran
            </button>

        </form>
    </div>

</body>

</html>