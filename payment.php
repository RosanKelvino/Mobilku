<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran - MobilKu</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="booking.css">
</head>
<body>

<div class="container">
    <h1>Pembayaran</h1>
    <p>Silakan lakukan pembayaran untuk menyelesaikan pesanan</p>

    <div class="glass-panel payment-box">
        <h3>Ringkasan Pesanan</h3>
        <p>Mobil: <?php echo $_POST['mobil']; ?></p>
        <p>Layanan: <?php echo $_POST['layanan']; ?></p>
        <p>Tanggal: <?php echo $_POST['tgl_mulai']; ?> - <?php echo $_POST['tgl_selesai']; ?></p>

        <hr>

        <h3>Total Bayar</h3>
        <h2>Rp 500.000</h2>

        <form action="order.php" method="post">
            <button type="submit" class="btn-primary">
                Saya Sudah Bayar
            </button>
        </form>
    </div>
</div>

</body>
</html>
