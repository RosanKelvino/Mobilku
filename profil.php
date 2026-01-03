<?php
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
    <title>Profil Pengguna - Rental Mobil</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .profile-wrapper {
            padding: 60px 0 80px 0;
            display: grid;
            grid-template-columns: 350px 1fr;
            gap: 30px;
        }

        .profile-sidebar {
            padding: 40px 30px;
            text-align: center;
            height: fit-content;
        }

        .nav-profil {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 0.5px solid var(--primary-color);
            background: var(--glass-bg);
        }

        .nav-profil img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .profile-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 4px solid var(--primary-color);
            margin: 0 auto 20px;
            padding: 5px;
            background: var(--glass-bg);
            position: relative;
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .upload-foto{
             position: absolute; 
                                    bottom: 5%; 
                                    right: 5%; 
                                    background: var(--primary-color); 
                                    width: 38px; 
                                    height: 38px; 
                                    border-radius: 50%; 
                                    display: flex; 
                                    align-items: center; 
                                    justify-content: center; 
                                    cursor: pointer;
                                    border: 3px solid var(--bg-dark);
                                    z-index: 10;
                                    transition: 0.3s
        }

        .profile-nav {
            margin-top: 30px;
            text-align: left;
        }

        .profile-nav-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            color: var(--text-grey);
            text-decoration: none;
            transition: 0.3s;
            border-radius: 10px;
            margin-bottom: 5px;
        }

        .profile-nav-item:hover,
        .profile-nav-item.active {
            background: rgba(43, 89, 255, 0.1);
            color: var(--text-white);
        }

        .profile-nav-item i {
            width: 20px;
            color: var(--primary-color);
        }

        .profile-content {
            padding: 40px;
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
            gap: 10px;
        }

        .input-box label {
            font-size: 14px;
            color: var(--text-grey);
        }

        .input-box input {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            padding: 12px 15px;
            border-radius: 10px;
            color: white;
            outline: none;
            transition: 0.3s;
        }

        .input-box input:focus {
            border-color: var(--primary-color);
        }

        @media (max-width: 992px) {
            .profile-wrapper {
                grid-template-columns: 1fr;
            }

            .profile-sidebar {
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="glow-orb orb-1"></div>
    <div class="glow-orb orb-2"></div>

    <div class="container">
                   <?php include 'navbar.php'; ?>
    </div>

        

    <main class="container">
        <div class="profile-wrapper">
            <aside class="profile-sidebar glass-panel">
                <div class="profile-avatar">
                    <img src="istockphoto-1300845620-612x612.jpg" id="profile-avatar-img">
                    <label for="upload-photo" class="upload-foto">
                        <i class="fas fa-camera" style="font-size: 14px; color: white;"></i>
                    </label>
                    <input type="file" id="upload-photo" accept="image/*" style="display: none;">
                </div>
                <h3>John Doe</h3>
                <p style="color: var(--text-grey); font-size: 14px; margin-top: 5px;">Member Gold</p>

                <div class="profile-nav">
                    <button class="profile-nav-item active" onclick="showTab('detail')">
                        <i class="fas fa-user"></i> Detail Profil
                    </button>
                    <button class="profile-nav-item" onclick="showTab('history')">
                        <i class="fas fa-history"></i> Riwayat Sewa
                    </button>
                </div>
            </aside>

            <section class="profile-content glass-panel">
                
                <div id="tab-detail" class="tab-content">
                    <div style="margin-bottom: 30px;">
                        <h2 class="text-gradient">Informasi Pribadi</h2>
                        <p style="color: var(--text-grey);">Kelola informasi akun dan profil Anda.</p>
                    </div>
                    <form>
                        <div class="form-row">
                            <div class="input-box">
                                <label>Nama Lengkap</label>
                                <input type="text" value="John Doe">
                            </div>
                            <div class="input-box">
                                <label>Email</label>
                                <input type="email" value="johndoe@example.com">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-box">
                                <label>Nomor Telepon</label>
                                <input type="text" value="+62 812 3456 7890">
                            </div>
                            <div class="input-box">
                                <label>Tanggal Lahir</label>
                                <input type="date" value="1995-05-15">
                            </div>
                        </div>
                        <div class="input-box" style="margin-bottom: 30px;">
                            <label>Alamat Lengkap</label>
                            <input type="text" value="Jl. Sudirman No. 123, Jakarta Pusat">
                        </div>
                        <div style="display: flex; gap: 15px;">
                            <button type="submit" class="btn-primary">Simpan Perubahan</button>
                            <button type="button" class="btn-transparent" style="border: 1px solid var(--glass-border); padding: 10px 25px; border-radius: 50px;">Batal</button>
                        </div>
                    </form>
                </div>

                <div id="tab-history" class="tab-content" style="display: none;">
                    <div style="margin-bottom: 30px;">
                        <h2 class="text-gradient">Riwayat Sewa</h2>
                        <p style="color: var(--text-grey);">Daftar riwayat penyewaan kendaraan Anda.</p>
                    </div>

                    <div class="history-list" id="history-container">
                        <div class="history-card" id="history-1">
                            <div class="history-info">
                                <img src="gambar/Porsche-Cayman-PNG-Photo.png" class="car-thumb">
                                <div>
                                    <h4 style="margin-bottom: 5px;">Porsche Cayman </h4>
                                    <p style="font-size: 12px; color: var(--text-grey);">
                                        <i class="far fa-calendar-alt"></i> 12 Des 2025 - 15 Des 2025
                                    </p>
                                </div>
                            </div>
                            <div class="history-actions">
                                <div style="text-align: right;">
                                    <span class="status-badge completed">Selesai</span>
                                    <p style="font-weight: 700; margin-top: 8px;">Rp 3.500.000</p>
                                </div>
                                <button class="btn-delete" onclick="removeHistory('history-1')" title="Hapus Riwayat">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>

                        <div class="history-card" id="history-2">
                            <div class="history-info">
                                <img src="gambar/BMW_X6_Car_BMW_X7_BMW_1_Series_PNG-removebg-preview.png" class="car-thumb">
                                <div>
                                    <h4 style="margin-bottom: 5px;">BMW X6</h4>
                                    <p style="font-size: 12px; color: var(--text-grey);">
                                        <i class="far fa-calendar-alt"></i> 01 Jan 2026 - 03 Jan 2026
                                    </p>
                                </div>
                            </div>
                            <div class="history-actions">
                                <div style="text-align: right;">
                                    <span class="status-badge ongoing">Berlangsung</span>
                                    <p style="font-weight: 700; margin-top: 8px;">Rp 2.100.00</p>
                                </div>
                                <button class="btn-delete" onclick="removeHistory('history-2')" title="Hapus Riwayat">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </div>
    </main>

    <script>
        // Fungsi untuk Perpindahan Tab
        function showTab(tabName) {
            document.querySelectorAll('.tab-content').forEach(tab => tab.style.display = 'none');
            document.querySelectorAll('.profile-nav-item').forEach(btn => btn.classList.remove('active'));

            if (tabName === 'detail') {
                document.getElementById('tab-detail').style.display = 'block';
                document.querySelector('[onclick="showTab(\'detail\')"]').classList.add('active');
            } else {
                document.getElementById('tab-history').style.display = 'block';
                document.querySelector('[onclick="showTab(\'history\')"]').classList.add('active');
            }
        }

        // Fungsi Hapus Riwayat dengan Animasi
        function removeHistory(id) {
            if (confirm("Apakah Anda yakin ingin menghapus riwayat ini?")) {
                const element = document.getElementById(id);
                element.style.transform = "translateX(50px)";
                element.style.opacity = "0";
                
                setTimeout(() => {
                    element.remove();
                    
                    // Tampilkan pesan jika riwayat kosong
                    const container = document.getElementById('history-container');
                    if (container.children.length === 0) {
                        container.innerHTML = `<div style="text-align:center; padding: 40px; color: var(--text-grey);">
                            <i class="fas fa-folder-open" style="font-size: 40px; margin-bottom: 15px; opacity: 0.3;"></i>
                            <p>Tidak ada riwayat penyewaan.</p>
                        </div>`;
                    }
                }, 400);
            }
        }

        // Script Preview Foto Profil (Sinkron ke Navbar)
        const uploadInput = document.getElementById('upload-photo');
        const mainImg = document.getElementById('profile-avatar-img');
        const navImg = document.querySelector('.nav-profil-img');

        uploadInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    mainImg.src = e.target.result;
                    if (navImg) navImg.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>