<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['user_id'];
$query = $conn->query("SELECT * FROM users WHERE id = '$id'");
$data_user = $query->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna - MobilKu</title>
    <link rel="stylesheet" href="css/style.css">
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
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .profile-sidebar {
            padding: 40px 20px;
            text-align: center;
        }

        .profile-avatar-container {
            position: relative;
            width: 120px;
            height: 120px;
            margin: 0 auto 15px;
        }

        .profile-avatar {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 3px solid #4754e6;
            overflow: hidden;
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .upload-foto {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background: #4754e6;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: 2px solid #0b0b10;
            transition: 0.3s;
            z-index: 10;
        }

        .upload-foto:hover {
            background: #3644cc;
            transform: scale(1.1);
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
            background: none;
            width: 100%;
            cursor: pointer;
            border: none;
            text-align: left;
        }

        .profile-nav-item.active,
        .profile-nav-item:hover {
            background: rgba(71, 84, 230, 0.15);
            color: white;
        }

        .profile-content {
            padding: 30px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .input-box {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .input-box label {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.5);
        }

        .input-box input {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 12px;
            border-radius: 10px;
            color: white;
            outline: none;
        }

        .input-box input:focus {
            border-color: #4754e6;
        }

        .btn-primary {
            padding: 12px 25px;
            border-radius: 10px;
            border: none;
            background: #4754e6;
            color: white;
            cursor: pointer;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background: #3644cc;
        }

        @media (max-width: 850px) {
            .profile-wrapper {
                grid-template-columns: 1fr;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="container">
    <div class="glow-orb orb-1"></div>
    <div class="glow-orb orb-2"></div>
    <?php include 'navbar.php'; ?>
    <div class="profile-wrapper">
        <aside class="profile-sidebar glass-panel">
            <div class="profile-avatar-container">
                <div class="profile-avatar">
                    <?php
                    $foto_path = !empty($data_user['foto']) ? 'uploads/profile/' . $data_user['foto'] : 'istockphoto-1300845620-612x612.jpg';
                    ?>
                    <img src="<?php echo $foto_path; ?>" id="profile-avatar-img">
                </div>

                <form action="update_profil.php" method="POST" enctype="multipart/form-data">
                    <label for="upload-photo" class="upload-foto">
                        <i class="fas fa-camera" style="font-size: 14px; color: white;"></i>
                    </label>
                    <input type="file" name="foto" id="upload-photo" style="display:none" onchange="this.form.submit()">
                    <input type="hidden" name="update_foto" value="1">
                </form>
            </div>

            <h3><?php echo htmlspecialchars($data_user['nama_lengkap']); ?></h3>
            <p style="color:rgba(255,255,255,0.4); font-size:13px;">Member MobilKu</p>

            <div class="profile-nav" style="margin-top: 20px;">
                <a href="profil.php" class="profile-nav-item active"><i class="fas fa-user"></i> Detail Profil</a>
                <a href="riwayat.php" class="profile-nav-item"><i class="fas fa-history"></i> Riwayat Sewa</a>
                <a href="logout.php" class="profile-nav-item" style="color:#ff4d4d;">
                    <i class="fas fa-sign-out-alt"></i> Keluar
                </a>
            </div>
        </aside>

        <section class="profile-content glass-panel">
            <h2>Informasi Pribadi</h2>
            <p style="color:rgba(255,255,255,0.4); margin-bottom: 30px;">Kelola informasi akun Anda agar tetap mutakhir.</p>

            <form action="update_profil.php" method="POST">
                <div class="form-row">
                    <div class="input-box">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" value="<?php echo htmlspecialchars($data_user['nama_lengkap']); ?>">
                    </div>
                    <div class="input-box">
                        <label>Email</label>
                        <input type="email" value="<?php echo htmlspecialchars($data_user['email']); ?>" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-box">
                        <label>Nomor Telepon</label>
                        <input type="text" name="hp" value="<?php echo htmlspecialchars($data_user['no_hp']); ?>">
                    </div>
                    <div class="input-box">
                        <label>Kategori Member</label>
                        <input type="text" value="Gold Member" readonly>
                    </div>
                </div>
                <button type="submit" name="update_umum" class="btn-primary">Simpan Perubahan</button>
            </form>

            <hr style="border: 0; border-top: 1px solid rgba(255,255,255,0.1); margin: 40px 0;">

            <h2>Keamanan Akun</h2>
            <p style="color:rgba(255,255,255,0.4); margin-bottom: 20px;">Ubah kata sandi Anda secara berkala untuk keamanan.</p>

            <form action="update_profil.php" method="POST">
                <div class="input-box" style="margin-bottom: 15px;">
                    <label>Password Lama</label>
                    <input type="password" name="pass_lama" required>
                </div>
                <div class="form-row">
                    <div class="input-box">
                        <label>Password Baru</label>
                        <input type="password" name="pass_baru" required>
                    </div>
                    <div class="input-box">
                        <label>Konfirmasi Password Baru</label>
                        <input type="password" name="konfirmasi_baru" required>
                    </div>
                </div>
                <button type="submit" name="update_password" class="btn-primary" style="background:#ffbb00; color:black; font-weight:bold;">
                    Perbarui Password
                </button>
            </form>
        </section>
    </div>
    </div>
</body>

</html>