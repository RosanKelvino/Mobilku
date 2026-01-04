<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query_user = $conn->query("SELECT nama_lengkap, foto FROM users WHERE id = '$user_id'");
$data_user = $query_user->fetch_assoc();

$foto_path = !empty($data_user['foto']) ? 'uploads/profile/' . $data_user['foto'] : 'istockphoto-1300845620-612x612.jpg';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Sewa - MobilKu</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #0b0b10;
            color: white;
            margin: 0;
        }

        .profile-wrapper {
            max-width: 1100px;
            margin: 40px auto;
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 30px;
            padding: 0 20px;
            align-items: start;
        }

        .glass-panel {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
        }

        .profile-sidebar {
            padding: 40px 20px;
            text-align: center;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 3px solid #4754e6;
            margin: 0 auto 15px;
            overflow: hidden;
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            color: rgba(255, 255, 255, 0.5);
            text-decoration: none;
            font-size: 14px;
            border-radius: 12px;
            transition: 0.3s;
            margin-bottom: 5px;
        }

        .profile-nav-item.active,
        .profile-nav-item:hover {
            background: rgba(71, 84, 230, 0.15);
            color: white;
        }

        .profile-content {
            padding: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            color: white;
        }

        th {
            text-align: left;
            padding: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.5);
            font-size: 13px;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            font-size: 14px;
        }

        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-menunggu {
            background: rgba(255, 187, 0, 0.1);
            color: #ffbb00;
        }
    </style>
</head>

<body>
    <div class="container"><?php include 'navbar.php'; ?></div>
    <div class="glow-orb orb-1"></div>
    <div class="glow-orb orb-2"></div>
    <div class="profile-wrapper">
        <aside class="profile-sidebar glass-panel">
            <div class="profile-avatar">
                <img src="<?php echo $foto_path; ?>" alt="User Avatar">
            </div>
            <h3><?php echo htmlspecialchars($data_user['nama_lengkap']); ?></h3>
            <p style="color:rgba(255,255,255,0.4); font-size:13px;">Member MobilKu</p>
            <div class="profile-nav" style="margin-top: 20px;">
                <a href="profil.php" class="profile-nav-item"><i class="fas fa-user"></i> Detail Profil</a>
                <a href="riwayat.php" class="profile-nav-item active"><i class="fas fa-history"></i> Riwayat Sewa</a>
                <a href="logout.php" class="profile-nav-item" style="color:#ff4d4d;"><i class="fas fa-sign-out-alt"></i>
                    Keluar</a>
            </div>
        </aside>

        <section class="profile-content glass-panel">
            <h2>Riwayat Penyewaan</h2>
            <div style="overflow-x: auto;">
                <table>
                    <thead>
                        <tr>
                            <th>Mobil</th>
                            <th>Tgl Sewa</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT sewa.*, mobil.nama_mobil FROM sewa 
                                JOIN mobil ON sewa.mobil_id = mobil.id 
                                WHERE sewa.user_id = '$user_id' ORDER BY sewa.id DESC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <td><strong><?php echo $row['nama_mobil']; ?></strong></td>
                                    <td><?php echo date('d M Y', strtotime($row['tgl_mulai'])); ?></td>
                                    <td>Rp <?php echo number_format($row['total_harga'], 0, ',', '.'); ?></td>
                                    <td><span class="status-badge status-menunggu"><?php echo $row['status']; ?></span></td>
                                    <td>
                                        <div style="display: flex; gap: 5px; align-items: center;">
                                            <a href="detail_sewa.php?id=<?php echo $row['id']; ?>" class="btn-detail"
                                                style="text-decoration:none; border:1px solid #4754e6; color:white; padding:5px 12px; border-radius:5px; font-size:12px;">Detail</a>

                                            <?php if ($row['status'] == 'Menunggu'): ?>
                                                <form action="proses_crud.php" method="POST"
                                                    onsubmit="return confirm('Yakin ingin membatalkan?')">
                                                    <input type="hidden" name="id_sewa" value="<?php echo $row['id']; ?>">
                                                    <button type="submit" name="hapus_pesanan"
                                                        style="background:none; border:1px solid #ff4d4d; color:#ff4d4d; padding:5px 10px; border-radius:5px; cursor:pointer;">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php }
                        } else {
                            echo "<tr><td colspan='5' style='text-align:center; padding:50px;'>Belum ada transaksi.</td></tr>";
                        } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</body>

</html>