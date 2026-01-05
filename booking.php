<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Silakan login terlebih dahulu!'); window.location.href='login.php';</script>";
    exit;
}

if (isset($_GET['mobil_id'])) {
    $mobil_id = $conn->real_escape_string($_GET['mobil_id']);
    $res = $conn->query("SELECT * FROM mobil WHERE id = '$mobil_id'");
    $mobil_data = $res->fetch_assoc();
} else {
    header("Location: catalog.php");
    exit;
}

if (isset($_POST['submit_booking'])) {
    $u_id = $_SESSION['user_id'];
    $m_id = $_POST['mobil_id'];
    $tgl_ambil = $_POST['tanggal_ambil'];
    $tgl_kembali = $_POST['tanggal_kembali'];
    $layanan = $_POST['layanan'];

    $d1 = new DateTime($tgl_ambil);
    $d2 = new DateTime($tgl_kembali);
    $durasi = $d1->diff($d2)->days ?: 1;

    $total = $mobil_data['harga_per_hari'] * $durasi;
    if ($layanan == 'Dengan Supir')
        $total += (150000 * $durasi);

    $sql = "INSERT INTO sewa (user_id, mobil_id, tgl_mulai, tgl_selesai, total_harga, status) 
            VALUES ('$u_id', '$m_id', '$tgl_ambil', '$tgl_kembali', '$total', 'Menunggu')";

    if ($conn->query($sql)) {
        $last_id = $conn->insert_id; // Mengambil ID yang baru saja dibuat
        // LANJUT KE PAYMENT DENGAN MEMBAWA ID TRANSAKSI
        header("Location: payment.php?id=$last_id");
        exit;
    } else {
        echo "Gagal menyimpan ke database: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking - MobilKu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/booking.css">
</head>

<body>

    <div class="glow-orb orb-1"></div>
    <div class="container">

        <nav class="navbar glass-panel">
            <div class="logo"><i class="fa-solid fa-car-side"></i> MobilKu</div>
            <a href="catalog.php" class="btn-transparent">Kembali</a>
        </nav>

        <div style="max-width: 600px; margin: 40px auto; text-align: center;">
            <h2>Konfirmasi Pesanan</h2>
            <p>Anda akan menyewa: <strong><?php echo $mobil_data['nama_mobil']; ?></strong></p>
        </div>

        <form action="" method="post" class="glass-panel form-booking">

            <input type="hidden" name="mobil_id" value="<?php echo $mobil_data['id']; ?>">

            <div class="form-group">
                <label>Nama Mobil</label>
                <input type="text" value="<?php echo $mobil_data['nama_mobil']; ?>" readonly style="opacity: 0.7;">
            </div>

            <div class="form-group">
                <label>Harga Per Hari</label>
                <input type="text" value="Rp <?php echo number_format($mobil_data['harga_per_hari'], 0, ',', '.'); ?>"
                    readonly style="opacity: 0.7;">
            </div>

            <div class="form-group">
                <label>Layanan</label>
                <select name="layanan" class="glass-input">
                    <option value="Lepas Kunci" style="color:white;">Lepas Kunci</option>
                    <option value="Dengan Supir" style="color:white;">Dengan Supir (+150rb/hari)</option>
                </select>
            </div>

            <div class="form-group">
                <label>Tanggal Ambil</label>
                <input type="date" name="tanggal_ambil" required class="glass-input" style="color-scheme: dark;">
            </div>

            <div class="form-group">
                <label>Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali" required class="glass-input" style="color-scheme: dark;">
            </div>

            <div class="form-group">
                <label>Pembayaran</label>
                <select name="metode_pembayaran" class="glass-input">
                    <option value="Transfer" style="color:white;">Transfer Bank</option>
                    <option value="Cash" style="color:white;">Tunai (Cash)</option>
                </select>
            </div>

            <button type="submit" name="submit_booking" class="btn-primary" style="width: 100%; margin-top: 20px;">
                Booking Sekarang
            </button>
        </form>

    </div>
</body>

</html>