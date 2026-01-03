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

    <nav class="container">
        <nav class="navbar glass-panel">
            <div class="logo">
                <a href="index.php">
                    <i class="fa-solid fa-car-side"></i> MobilKu
                </a>
            </div>

            <ul class="nav-links">
                <li><a href="#" class="active">Beranda</a></li>
                <li><a href="catalog.php">Katalog</a></li>
                <li><a href="services.php">Layanan</a></li>
                <li><a href="about.php">Tentang</a></li>
            </ul>
            <div class="nav-actions">
                <div class="nav-profil">
                    <img src="istockphoto-1300845620-612x612.jpg" class="nav-profil-img">
                </div>
            </div>
        </nav>

        <main class="container">
            <div class="profile-wrapper">

                <aside class="profile-sidebar glass-panel">
                    <div class="profile-avatar">
                        <img src="istockphoto-1300845620-612x612.jpg" id="profile-avatar-img">

                          <label for="upload-photo" class="upload-foto" >
                            <i class="fas fa-camera" style="font-size: 14px; color: white;"></i>
                        </label>
                      
                        <input type="file" id="upload-photo" accept="image/*" style="display: none;">
                    </div>
                    <h3>John Doe</h3>
                    <p style="color: var(--text-grey); font-size: 14px; margin-top: 5px;">Member Gold</p>

                    <div class="profile-nav">
                        <a href="#" class="profile-nav-item active">
                            <i class="fas fa-user"></i> Detail Profil
                        </a>
                        <a href="#" class="profile-nav-item">
                            <i class="fas fa-history"></i> Riwayat Sewa
                        </a>
                        <a href="#" class="profile-nav-item">
                            <i class="fas fa-wallet"></i> Metode Pembayaran
                        </a>
                        <a href="#" class="profile-nav-item">
                            <i class="fas fa-cog"></i> Pengaturan
                        </a>
                    </div>
                </aside>

                <section class="profile-content glass-panel">
                    <div style="margin-bottom: 30px;">
                        <h2 class="text-gradient">Informasi Pribadi</h2>
                        <p style="color: var(--text-grey);">Kelola informasi akun dan pengaturan keamanan Anda.</p>
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
                            <button type="button" class="btn-transparent"
                                style="border: 1px solid var(--glass-border); padding: 10px 25px; border-radius: 50px;">Batal</button>
                        </div>
                    </form>
                </section>

            </div>
        </main>
        <script>
            // Memastikan DOM sudah dimuat sepenuhnya
            window.addEventListener('DOMContentLoaded', (event) => {
                // Mengambil elemen berdasarkan ID dan Class yang baru saja kita buat
                const mainImg = document.getElementById('profile-avatar-img');
                const navImg = document.querySelector('.nav-profil-img');

                // Validasi jika kedua elemen ditemukan, maka samakan sumber gambarnya
                if (mainImg && navImg) {
                    navImg.src = mainImg.src;
                }
            });
            const uploadInput = document.getElementById('upload-photo');
            const mainImg = document.getElementById('profile-avatar-img');
            const navImg = document.querySelector('.nav-profil-img');

            uploadInput.addEventListener('change', function () {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        // Ganti sumber gambar di sidebar
                        mainImg.src = e.target.result;
                        // Ganti sumber gambar di navbar secara otomatis
                        navImg.src = e.target.result;
                    }

                    reader.readAsDataURL(file);
                }
            });
        </script>
</body>

</html>