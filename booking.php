<?php
include 'db.php'; 

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Silakan login terlebih dahulu untuk melakukan pemesanan!'); window.location.href='login.php';</script>";
    exit();
}

$mobil_data = null;
$id_mobil = '';

if (isset($_GET['mobil_id'])) {
    $id_mobil = $_GET['mobil_id'];
    $q = $conn->query("SELECT * FROM mobil WHERE id = $id_mobil");
    if ($q->num_rows > 0) {
        $mobil_data = $q->fetch_assoc();
    } else {
        echo "<script>alert('Mobil tidak ditemukan!'); window.location.href='catalog.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('Silakan pilih mobil dari katalog terlebih dahulu.'); window.location.href='catalog.php';</script>";
    exit();
}

if (isset($_POST['submit_booking'])) {
    $user_id     = $_SESSION['user_id'];
    $mobil_id    = $_POST['mobil_id'];
    $tgl_mulai   = $_POST['tgl_mulai'];
    $tgl_selesai = $_POST['tgl_selesai'];
    $layanan     = $_POST['layanan'];
    
    if ($tgl_selesai < $tgl_mulai) {
        echo "<script>alert('Tanggal selesai tidak boleh lebih awal dari tanggal mulai!');</script>";
    } else {
        $start  = new DateTime($tgl_mulai);
        $end    = new DateTime($tgl_selesai);
        $diff   = $start->diff($end);
        $durasi = $diff->days + 1; // Hitung minimal 1 hari (misal sewa tgl 1 s/d 1 = 1 hari)
        
        $m = $conn->query("SELECT harga_per_hari FROM mobil WHERE id = $mobil_id")->fetch_assoc();
        $total_harga = $m['harga_per_hari'] * $durasi;

        if ($layanan == 'Dengan Supir') {
            $total_harga += (150000 * $durasi); 
        }

        $sql = "INSERT INTO pesanan (user_id, mobil_id, tanggal_mulai, tanggal_selesai, layanan, total_harga, status_pembayaran) 
                VALUES ('$user_id', '$mobil_id', '$tgl_mulai', '$tgl_selesai', '$layanan', '$total_harga', 'Belum Bayar')";

        if ($conn->query($sql)) {
            $last_id = $conn->insert_id;
            echo "<script>window.location.href='payment.php?id_pesanan=$last_id';</script>";
            exit();
        } else {
            echo "<script>alert('Terjadi kesalahan sistem: " . $conn->error . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Mobil - MobilKu</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/booking.css">
    <link rel="stylesheet" href="css/about.css">
</head>

<body>

    <div class="glow-orb orb-1"></div>
    <div class="glow-orb orb-2"></div>

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
            <div class="nav-actions">
                <span style="color: white; margin-right: 15px;">Hai, <?php echo $_SESSION['nama']; ?></span>
                <a href="logout.php" class="btn-primary">Logout</a>
            </div>
        </nav>

        <h1 style="text-align: center; margin-bottom: 10px; margin-top: 30px;">Konfirmasi Pesanan</h1>
        <p style="text-align: center; margin-bottom: 30px;">Lengkapi detail sewa untuk <strong><?php echo $mobil_data['nama_mobil']; ?></strong></p>

        <form action="" method="post" class="glass-panel form-booking">
            
            <input type="hidden" name="mobil_id" value="<?php echo $id_mobil; ?>">

            <div class="form-group">
                <label>Mobil yang dipilih</label>
                <input type="text" value="<?php echo $mobil_data['nama_mobil']; ?>" readonly style="background: rgba(0,0,0,0.3); color: #ddd; cursor: not-allowed;">
            </div>

            <div class="form-group">
                <label>Harga Per Hari</label>
                <input type="text" value="Rp <?php echo number_format($mobil_data['harga_per_hari'], 0, ',', '.'); ?>" readonly style="background: rgba(0,0,0,0.3); color: #ddd;">
            </div>

            <div class="form-group">
                <label>Jenis Layanan</label>
                <select name="layanan" required class="glass-input" style="background: rgba(255,255,255,0.1); color: white;">
                    <option value="Lepas Kunci" style="color: black;">Lepas Kunci (Setir Sendiri)</option>
                    <option value="Dengan Supir" style="color: black;">Dengan Supir (+Rp 150.000/hari)</option>
                </select>
            </div>

            <div class="form-group">
                <label>Tanggal Mulai Sewa</label>
                <input type="date" name="tgl_mulai" required class="glass-input" style="color-scheme: dark;">
            </div>

            <div class="form-group">
                <label>Tanggal Selesai Sewa</label>
                <input type="date" name="tgl_selesai" required class="glass-input" style="color-scheme: dark;">
            </div>

            <button type="submit" name="submit_booking" class="btn-primary" style="width: 100%; margin-top: 20px;">
                Lanjut ke Pembayaran <i class="fa-solid fa-arrow-right"></i>
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