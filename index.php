<?php 
session_start(); 
include "db.php"; 
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MobilKu - Sewa Mobil Premium</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/about.css">
</head>

<body>

    <div class="glow-orb orb-1"></div>
    <div class="glow-orb orb-2"></div>

    <div class="container">

        <?php include 'navbar.php'; ?>
        
        <header class="hero">
            <div class="hero-content">
                <span class="badge">🔥 Sewa Mobil Termudah</span>
                <h1>Jelajahi Kota dengan <br><span class="text-gradient">Mobil Impianmu</span></h1>
                <p>Nikmati perjalanan nyaman dengan armada premium kami. Harga transparan, asuransi lengkap, dan lepas kunci.</p>

                <div class="hero-stats">
                    <div class="stat-item">
                        <h2>50+</h2>
                        <p>Tipe Mobil</p>
                    </div>
                    <div class="stat-item">
                        <h2>24/7</h2>
                        <p>Layanan CS</p>
                    </div>
                    <div class="stat-item">
                        <h2>100%</h2>
                        <p>Aman</p>
                    </div>
                </div>
            </div>

            <div class="hero-image">
                <img src="gambar/Tohoto_mazlika_si_poridim_až_vyhraju_ve_sportce-Tesla_X_plaid-removebg-preview.png" alt="Sport Car">
            </div>
        </header>


        <section class="car-section">
            <div class="section-header">
                <h3>Armada Terpopuler</h3>
                <a href="catalog.php">Lihat Semua <i class="fa-solid fa-arrow-right-long"></i></a>
            </div>

            <div class="car-grid">

                <div class="car-card glass-panel">
                    <div class="card-top">
                        <span class="car-tag">Matic</span>
                        <i class="fa-regular fa-heart"></i>
                    </div>
                    <div class="car-img-container">
                        <img src="gambar/Audi_A8L__2025_-removebg-preview.png" alt="Car">
                    </div>
                    <div class="car-details">
                        <h4>Audi A8 L</h4>
                        <p class="price">Rp 1.500.000 <span>/ hari</span></p>
                        <div class="specs">
                            <span><i class="fa-solid fa-gas-pump"></i> Bensin</span>
                            <span><i class="fa-solid fa-couch"></i> 4 Kursi</span>
                        </div>
                        
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <button class="btn-rent" onclick="window.location.href='booking.php?mobil_id=1'">Sewa Sekarang</button>
                        <?php else: ?>
                            <button class="btn-rent" onclick="openLoginModal()">Sewa Sekarang</button>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="car-card glass-panel">
                    <div class="card-top">
                        <span class="car-tag">Manual</span>
                        <i class="fa-regular fa-heart"></i>
                    </div>
                    <div class="car-img-container">
                        <img src="gambar/89ef60bbc7ef4849edfb2bde884a10d0-removebg-preview.png" alt="Car">
                    </div>
                    <div class="car-details">
                        <h4>Jeep Cherokee</h4>
                        <p class="price">Rp 900.000 <span>/ hari</span></p>
                        <div class="specs">
                            <span><i class="fa-solid fa-gas-pump"></i> Solar</span>
                            <span><i class="fa-solid fa-couch"></i> 6 Kursi</span>
                        </div>
                        
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <button class="btn-rent" onclick="window.location.href='booking.php?mobil_id=2'">Sewa Sekarang</button>
                        <?php else: ?>
                            <button class="btn-rent" onclick="openLoginModal()">Sewa Sekarang</button>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="car-card glass-panel">
                    <div class="card-top">
                        <span class="car-tag">Matic</span>
                        <i class="fa-regular fa-heart"></i>
                    </div>
                    <div class="car-img-container">
                        <img src="gambar/BMW_X6_Car_BMW_X7_BMW_1_Series_PNG-removebg-preview.png" alt="Car">
                    </div>
                    <div class="car-details">
                        <h4>BMW X6</h4>
                        <p class="price">Rp 2.100.000 <span>/ hari</span></p>
                        <div class="specs">
                            <span><i class="fa-solid fa-gas-pump"></i> Hybrid</span>
                            <span><i class="fa-solid fa-couch"></i> 4 Kursi</span>
                        </div>
                        
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <button class="btn-rent" onclick="window.location.href='booking.php?mobil_id=3'">Sewa Sekarang</button>
                        <?php else: ?>
                            <button class="btn-rent" onclick="openLoginModal()">Sewa Sekarang</button>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </section>

        <footer class="glass-panel footer-simple">
            <div class="footer-content">
                <div class="footer-brand">
                    <h3><i class="fa-solid fa-car-side"></i> MobilKu</h3>
                    <p>Partner perjalanan terbaik Anda.</p>
                </div>
                <div class="footer-contact">
                    <p><i class="fa-solid fa-location-dot"></i> Jl. Merdeka No. 45, Jakarta Selatan</p>
                    <p><i class="fa-solid fa-phone"></i> +62 812 3456 7890</p>
                    <p><i class="fa-solid fa-envelope"></i> hello@MobilKu.com</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2023 LuxeDrive. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <?php include 'login.php'; ?>
    
    <script>
        function openLoginModal() {
            const loginModal = document.getElementById('loginModal');
            if(loginModal) {
                loginModal.style.display = 'flex';
            } else {
                console.error("Modal login tidak ditemukan! Pastikan login.php ter-include dengan benar.");
                alert("Silakan login melalui tombol Masuk di pojok kanan atas.");
            }
        }
    </script>
    
</body>
</html>