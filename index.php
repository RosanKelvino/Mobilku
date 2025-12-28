<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MobilKu - Sewa Mobil Premium</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="glow-orb orb-1"></div>
    <div class="glow-orb orb-2"></div>

    <div class="container">
        
        <nav class="navbar glass-panel">
            <div class="logo">
                
                <i class="fa-solid fa-car-side"></i> MobilKu 
            </div>
            
            <ul class="nav-links">
                <li><a href="#" class="active">Beranda</a></li>
                <li><a href="catalog.php">Katalog</a></li>
                <li><a href="services.php">Layanan</a></li>
                <li><a href="about.php">Tentang</a></li>
            </ul>
            <div class="nav-actions">
                <button class="btn-transparent">Masuk</button>
                <button class="btn-primary">Daftar</button>
            </div>
        </nav>

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
                <img src="Tohoto_mazlika_si_poridim_až_vyhraju_ve_sportce-Tesla_X_plaid-removebg-preview.png" alt="Sport Car">
                
            
            </div>
        </header>
        
        <div class="search-widget glass-panel">
            <div class="input-group">
                <label><i class=""></i> Lokasi Ambil</label>
                <input type="text" placeholder="Pilih kota...">
            </div>
            <div class="divider"></div>
            <div class="input-group">
                <label><i class=""></i> Tanggal Ambil</label>
                <input type="date">
            </div>
            <div class="divider"></div>
            <div class="input-group">
                <label><i class=""></i> Tanggal Kembali</label>
                <input type="date">
            </div>
            <button class="btn-search"><i class="fa-solid fa-magnifying-glass"></i> Cari Mobil</button>
        </div>

        <section class="car-section">
            <div class="section-header">
                <h3>Armada Terpopuler</h3>
                <a href="catalog.php">Lihat Semua   <i class="fa-solid fa-arrow-right-long"></i></a>
            </div>

            <div class="car-grid">
                
                <div class="car-card glass-panel">
                    <div class="card-top">
                        <span class="car-tag">Matic</span>
                        <i class=""></i>
                    </div>
                    <div class="car-img-container">
                        <img src="Audi_A8L__2025_-removebg-preview.png" alt="Car">
                    </div>
                    <div class="car-details">
                        <h4>Audi A8 L</h4>
                        <p class="price">Rp 1.500.000 <span>/ hari</span></p>
                        <div class="specs">
                            <span><i class=""></i> Bensin</span>
                            <span><i class=""></i> 4 Kursi</span>
                        </div>
                        <button class="btn-rent" onclick="window.location.href='booking.php'">Sewa Sekarang</button>
                    </div>
                </div>

                <div class="car-card glass-panel">
                    <div class="card-top">
                        <span class="car-tag">Manual</span>
                        <i class=""></i>
                    </div>
                    <div class="car-img-container">
                        <img src="89ef60bbc7ef4849edfb2bde884a10d0-removebg-preview.png" alt="Car">
                    </div>
                    <div class="car-details">
                        <h4>Jeep Cherokee</h4>
                        <p class="price">Rp 900.000 <span>/ hari</span></p>
                        <div class="specs">
                            <span><i class=""></i> Solar</span>
                            <span><i class=""></i> 6 Kursi</span>
                        </div>
                       <button class="btn-rent" onclick="window.location.href='booking.php'">Sewa Sekarang</button>
                    </div>
                </div>

                <div class="car-card glass-panel">
                    <div class="card-top">
                        <span class="car-tag">Matic</span>
                        <i class=""></i>
                    </div>
                    <div class="car-img-container">
                        <img src="BMW_X6_Car_BMW_X7_BMW_1_Series_PNG-removebg-preview.png" alt="Car">
                    </div>
                    <div class="car-details">
                        <h4>BMW X6</h4>
                        <p class="price">Rp 2.100.000 <span>/ hari</span></p>
                        <div class="specs">
                            <span><i class=""></i> Hybrid</span>
                            <span><i class=""></i> 4 Kursi</span>
                        </div>
                        <button class="btn-rent" onclick="window.location.href='booking.php'">Sewa Sekarang</button>
                    </div>
                </div>

            </div>
        </section>
    </div>


<?php include 'login.php'; ?>
</body>
</html>