<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id_sewa = $_GET['id'] ?? '';
$user_id = $_SESSION['user_id'];

$conn->query("UPDATE sewa SET status = 'Selesai' 
              WHERE user_id = '$user_id' 
              AND status = 'Proses' 
              AND id != '$id_sewa'");

$query = $conn->query("SELECT sewa.*, mobil.nama_mobil, mobil.gambar, mobil.harga_per_hari 
                       FROM sewa 
                       JOIN mobil ON sewa.mobil_id = mobil.id 
                       WHERE sewa.id = '$id_sewa' AND sewa.user_id = '$user_id'");
$data = $query->fetch_assoc();

if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location.href='riwayat.php';</script>";
    exit();
}

if (isset($_POST['update_tgl'])) {
    $tgl_mulai = $_POST['tgl_mulai'];
    $tgl_selesai = $_POST['tgl_selesai'];

    $durasi = (strtotime($tgl_selesai) - strtotime($tgl_mulai)) / (60 * 60 * 24);
    if ($durasi <= 0)
        $durasi = 1;
    $total_baru = $durasi * $data['harga_per_hari'];

    $conn->query("UPDATE sewa SET tgl_mulai='$tgl_mulai', tgl_selesai='$tgl_selesai', total_harga='$total_baru' 
                  WHERE id='$id_sewa' AND status='Menunggu'");
    echo "<script>alert('Jadwal diperbarui!'); window.location.href='riwayat.php';</script>";
}

if (isset($_POST['cancel_order'])) {
    $conn->query("DELETE FROM sewa WHERE id='$id_sewa' AND status='Menunggu'");
    echo "<script>alert('Pesanan dibatalkan'); window.location.href='riwayat.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail & Kelola Pesanan</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .detail-card {
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
        }

        .status-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            color: rgba(255, 255, 255, 0.5);
            margin-bottom: 5px;
            font-size: 14px;
        }

        .input-group input {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
        }

        .btn-zone {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .btn-save {
            background: #4754e6;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 10px;
            flex: 2;
            cursor: pointer;
        }

        .btn-cancel {
            background: rgba(255, 77, 77, 0.1);
            color: #ff4d4d;
            border: 1px solid #ff4d4d;
            padding: 12px;
            border-radius: 10px;
            flex: 1;
            cursor: pointer;
        }
    </style>
</head>

<body style="background:#0b0b10; color:white;">
    <div class="container"><?php include 'navbar.php'; ?></div>

    <div class="detail-card glass-panel">
        <div class="status-header">
            <h3>Detail Pesanan #<?php echo $data['id']; ?></h3>
            <span
                style="background: rgba(71,84,230,0.2); color: #4754e6; padding: 5px 15px; border-radius: 20px; font-size: 12px;">
                <?php echo $data['status']; ?>
            </span>
        </div>

        <img src="gambar/<?php echo $data['gambar']; ?>" style="width:100%; border-radius:15px; margin-bottom:20px;">

        <form method="POST">
            <div class="input-group">
                <label>Nama Mobil</label>
                <input type="text" value="<?php echo $data['nama_mobil']; ?>" readonly>
            </div>

            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:15px;">
                <div class="input-group">
                    <label>Tanggal Mulai</label>
                    <input type="date" name="tgl_mulai" value="<?php echo $data['tgl_mulai']; ?>" <?php echo $data['status'] != 'Menunggu' ? 'readonly' : ''; ?>>
                </div>
                <div class="input-group">
                    <label>Tanggal Selesai</label>
                    <input type="date" name="tgl_selesai" value="<?php echo $data['tgl_selesai']; ?>" <?php echo $data['status'] != 'Menunggu' ? 'readonly' : ''; ?>>
                </div>
            </div>

            <div class="input-group">
                <label>Total Harga</label>
                <input type="text" value="Rp <?php echo number_format($data['total_harga'], 0, ',', '.'); ?>" readonly>
            </div>

            <?php if ($data['status'] == 'Menunggu'): ?>
                <div class="btn-zone">
                    <button type="submit" name="update_tgl" class="btn-save">Simpan Perubahan</button>
                    <button type="submit" name="cancel_order" class="btn-cancel"
                        onclick="return confirm('Batalkan pesanan ini?')">Batalkan</button>
                </div>
            <?php else: ?>
                <p style="text-align:center; color:rgba(255,255,255,0.3); font-size:12px; margin-top:20px;">
                    *Pesanan berstatus <strong><?php echo $data['status']; ?></strong> tidak dapat diubah lagi.
                </p>
            <?php endif; ?>
        </form>
    </div>
</body>

</html>