<?php
session_start();
include 'db.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - MobilKu</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/about.css">
    
    <style>
        .story-img img {
            width: 100%;
            height: 100%;
            object-fit: cover; 
            border-radius: 15px; 
        }

        .member-img {
            width: 120px;      
            height: 120px;     
            margin: 0 auto 15px; 
            overflow: hidden;   
            border-radius: 50%;  
            border: 3px solid #4754e6; 
        }

        .member-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;   
            object-position: top;
        }
    </style>
</head>

<body>

    <div class="glow-orb orb-1"></div>
    <div class="glow-orb orb-2"></div>

    <div class="container">
         <?php include 'navbar.php'; ?>


        <div class="container">

            <header class="about-header">
                <h1>Mengubah Cara Anda <span class="text-gradient">Bergerak</span></h1>
                <p>Didirikan pada 2023, Mobilku hadir untuk memberikan pengalaman berkendara premium yang aman,
                    nyaman, dan transparan bagi semua orang.</p>
            </header>

            <section class="story-section glass-panel">
                <div class="story-img">
                    <img src="gambar/Garage MobilKu.png" alt="Office Garage">
                </div>
                <div class="story-content">
                    <span class="sub-title">CERITA KAMI</span>
                    <h2>Lebih Dari Sekadar <br>Rental Mobil</h2>
                    <p>Mobilku hadir untuk memberikan pengalaman berkendara yang berbeda. Sejak mulai beroperasi dengan 3 unit berbeda, misi kami tidak pernah berubah:<strong> Menyediakan kendaraan yang bersih, prima, dan proses sewa yang transparan.</strong></p>
                    <p>Itulah mengapa di  <strong>Mobilku</strong>, setiap unit diperlakukan layaknya kendaraan pribadi. Kami melakukan inspeksi menyeluruh pada mesin dan memastikan kebersihan kabin yang higienis sebelum kunci beralih ke tangan Anda. Karena bagi kami, Anda bukan sekedar penyewa, melainkan tamu kehormatan dalam setiap perjalanan</p>

                    <div class="stats-row">
                        <div class="stat">
                            <h3>3</h3>
                            <span>Tahun</span>
                        </div>
                        <div class="stat">
                            <h3>20+</h3>
                            <span>Armada</span>
                        </div>
                        <div class="stat">
                            <h3>5k+</h3>
                            <span>Pelanggan Puas</span>
                        </div>
                    </div>
                </div>
            </section>

            <section class="values-section">
                <h2 class="section-heading">Kenapa Memilih Kami?</h2>
                <div class="values-grid">
                    <div class="value-card glass-panel">
                        <div class="value-icon"><i class="fa-solid fa-shield-halved"></i></div>
                        <h4>Keamanan Prioritas</h4>
                        <p>Setiap mobil dilengkapi asuransi All-Risk dan GPS tracker 24 jam untuk ketenangan pikiran Anda.</p>
                    </div>
                    <div class="value-card glass-panel">
                        <div class="value-icon"><i class="fa-solid fa-screwdriver-wrench"></i></div>
                        <h4>Perawatan Rutin</h4>
                        <p>Mobil kami masuk bengkel resmi setiap 5.000 KM. Tidak ada cerita mogok di jalan.</p>
                    </div>
                    <div class="value-card glass-panel">
                        <div class="value-icon"><i class="fa-solid fa-clock"></i></div>
                        <h4>Layanan 24 Jam</h4>
                        <p>Tim support kami siap membantu kapanpun Anda butuhkan, bahkan di tengah malam.</p>
                    </div>
                </div>
            </section>

            <section class="team-section">
                <h2 class="section-heading">Tim Dibalik Layar</h2>
                <div class="team-grid">

                    <div class="team-card glass-panel">
                        <div class="member-img">
                            <img src="gambar/CEO_Arefcy.png" alt="CEO">
                        </div>
                        <h4>Arefcy Saban</h4>
                        <span>Founder & CEO</span>
                    </div>

                    <div class="team-card glass-panel">
                        <div class="member-img">
                            <img src="gambar/Manager_Rian.png" alt="Head Manager">
                        </div>
                        <h4>Zecharian</h4>
                        <span>Head Manager</span>
                    </div>

                    <div class="team-card glass-panel">
                        <div class="member-img">
                            <img src="gambar/CS_Obi.png" alt="Customer Services">
                        </div>
                        <h4>Made Obi</h4>
                        <span>Customer Services</span>
                    </div>

                    <div class="team-card glass-panel">
                        <div class="member-img">
                            <img src="gambar/Mechanic_Rosan.png" alt="Head Mechanic">
                        </div>
                        <h4>Rosan Kelvino</h4>
                        <span>Chief Mechanic</span>
                    </div>

                    <div class="team-card glass-panel">
                        <div class="member-img">
                            <img src="gambar/Investor_Gabriel.png" alt="Investor">
                        </div>
                        <h4>Gabriel Jehuda</h4>
                        <span>Major Investor and Largest Shareholder</span>
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
                        <p><i class="fa-solid fa-location-dot"></i> Jl. Bedugul No. 39, Denpasar Selatan</p>
                        <p><i class="fa-solid fa-phone"></i> +62 812 3456 7890</p>
                        <p><i class="fa-solid fa-envelope"></i> Mobilku@gmail.com</p>
                    </div>
                </div>
                <div class="footer-bottom">
                    <p>&copy; 2026 Mobilku. All rights reserved.</p>
                </div>
            </footer>

        </div>
    </div>
    <?php include 'login.php'; ?>

</body>
</html>