<?php
session_start();
include 'db.php';

// --- 1. CEK LOGIN ---
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Silakan login terlebih dahulu!'); window.location.href='login.php';</script>";
    exit;
}

// Ambil data user dari session
$user_id = $_SESSION['user_id'];
$nama    = isset($_SESSION['nama']) ? $_SESSION['nama'] : 'Tamu';
$alamat  = isset($_SESSION['alamat']) ? $_SESSION['alamat'] : '-';
$telepon = isset($_SESSION['telepon']) ? $_SESSION['telepon'] : '-';

// --- 2. AMBIL DATA MOBIL ---
// Jika ada ID mobil di URL, ambil datanya
if (isset($_GET['mobil_id'])) {
    $mobil_id = $_GET['mobil_id'];
    $query_mobil = $conn->query("SELECT * FROM mobil WHERE id = '$mobil_id'");
    
    if ($query_mobil->num_rows > 0) {
        $mobil_data = $query_mobil->fetch_assoc();
    } else {
        echo "<script>alert('Mobil tidak ditemukan!'); window.location.href='catalog.php';</script>";
        exit;
    }
} 
// Jika form disubmit tapi mobil_id hilang dari URL, ambil dari input hidden
elseif (isset($_POST['mobil_id'])) {
    $mobil_id = $_POST['mobil_id'];
    $query_mobil = $conn->query("SELECT * FROM mobil WHERE id = '$mobil_id'");
    $mobil_data = $query_mobil->fetch_assoc();
} 
else {
    // Jika dibuka langsung tanpa pilih mobil
    header("Location: catalog.php");
    exit;
}

// --- 3. PROSES SUBMIT FORM ---
if (isset($_POST['submit_booking'])) {
    
    // Ambil data (Gunakan null coalescing operator ?? agar tidak error Undefined)
    $m_id        = $_POST['mobil_id'] ?? '';
    $tgl_ambil   = $_POST['tanggal_ambil'] ?? '';
    $tgl_kembali = $_POST['tanggal_kembali'] ?? '';
    $layanan     = $_POST['layanan'] ?? 'Lepas Kunci';
    $pembayaran  = $_POST['metode_pembayaran'] ?? 'Transfer';
    
    // Validasi input tidak boleh kosong
    if (empty($tgl_ambil) || empty($tgl_kembali)) {
        echo "<script>alert('Harap isi tanggal sewa!');</script>";
    } else {
        // Hitung Durasi
        $date1 = new DateTime($tgl_ambil);
        $date2 = new DateTime($tgl_kembali);
        $diff  = $date1->diff($date2);
        $durasi = $diff->days;
        if ($durasi == 0) { $durasi = 1; } // Minimal 1 hari

        // Hitung Harga
        $harga_per_hari = $mobil_data['harga_per_hari'];
        $total_harga = $harga_per_hari * $durasi;

        // Biaya tambahan supir
        if ($layanan == 'Dengan Supir') {
            $total_harga += (150000 * $durasi);
        }

        // Query Insert (Pastikan nama kolom SAMA PERSIS dengan database Langkah 1)
        $sql = "INSERT INTO pesanan (
                    user_id, mobil_id, nama_pemesan, alamat_penjemputan, no_telepon, 
                    tanggal_ambil, tanggal_kembali, durasi, total_harga, 
                    metode_pembayaran, status_pembayaran, layanan, status
                ) VALUES (
                    '$user_id', '$m_id', '$nama', '$alamat', '$telepon', 
                    '$tgl_ambil', '$tgl_kembali', '$durasi', '$total_harga', 
                    '$pembayaran', 'Belum Dibayar', '$layanan', 'Pending'
                )";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Booking Berhasil! Silakan lakukan pembayaran.'); window.location.href='index.php';</script>";
        } else {
            echo "Error Database: " . $conn->error;
        }
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
                <input type="text" value="Rp <?php echo number_format($mobil_data['harga_per_hari'], 0, ',', '.'); ?>" readonly style="opacity: 0.7;">
            </div>

            <div class="form-group">
                <label>Layanan</label>
                <select name="layanan" class="glass-input">
                    <option value="Lepas Kunci" style="color:black;">Lepas Kunci</option>
                    <option value="Dengan Supir" style="color:black;">Dengan Supir (+150rb/hari)</option>
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
                    <option value="Transfer" style="color:black;">Transfer Bank</option>
                    <option value="Cash" style="color:black;">Tunai (Cash)</option>
                </select>
            </div>

            <button type="submit" name="submit_booking" class="btn-primary" style="width: 100%; margin-top: 20px;">
                Booking Sekarang
            </button>
        </form>

    </div>
</body>
</html>