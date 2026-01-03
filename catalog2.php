<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Mobil - MobilKu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/catalog.css">
    <link rel="stylesheet" href="css/about.css">
</head>

<body>

    <div class="glow-orb orb-1" style="top: 20%; left: -10%;"></div>
    <div class="glow-orb orb-2" style="bottom: 10%; right: -10%;"></div>
    <div class="container">

        <nav class="navbar glass-panel">
            <div class="logo">
                <a href="index.php">
                    <i class="fa-solid fa-car-side"></i> MobilKu
                </a>
            </div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="#" class="active">Katalog</a></li>
                <li><a href="services.php">Layanan</a></li>
                <li><a href="about.php">Tentang</a></li>
            </ul>
            <div class="nav-actions">
                <button class="btn-transparent">Masuk</button>
                <button class="btn-primary">Daftar</button>
            </div>
        </nav>

        <div class="container main-wrapper">

            <aside class="filter-sidebar glass-panel">
                <div class="filter-header">
                    <h3><i class="fa-solid fa-filter"></i> Filter</h3>
                    <a href="#" class="reset-link">Reset</a>
                </div>

                <div class="filter-group">
                    <h4>Kategori</h4>
                    <label class="checkbox-container">Semua
                        <input type="checkbox" checked>
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkbox-container">Sport Car
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkbox-container">SUV Premium
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkbox-container">Sedan Luxury
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkbox-container">MPV Family
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                </div>

                <div class="divider"></div>

                <div class="filter-group">
                    <h4>Transmisi</h4>
                    <div class="chip-container">
                        <button class="filter-chip active">Auto</button>
                        <button class="filter-chip">Manual</button>
                    </div>
                </div>

                <div class="divider"></div>

                <div class="filter-group">
                    <h4>Rentang Harga (per hari)</h4>
                    <div class="price-inputs">
                        <input type="number" placeholder="Min" class="glass-input">
                        <span>-</span>
                        <input type="number" placeholder="Max" class="glass-input">
                    </div>
                </div>

                <button class="btn-primary w-100 mt-20">Terapkan Filter</button>
            </aside>

            <main class="catalog-content">

                <div class="catalog-header glass-panel">
                    <span>Menampilkan <strong>9</strong> dari <strong>45</strong> mobil</span>
                    <div class="sort-box">
                        <label>Urutkan:</label>
                        <select class="glass-select">
                            <option>Paling Relevan</option>
                            <option>Harga Terendah</option>
                            <option>Harga Tertinggi</option>
                            <option>Terbaru</option>
                        </select>
                    </div>
                </div>

                <div class="car-grid three-col">

                    <div class="car-card glass-panel">
                        <div class="card-top">
                            <span class="car-tag">Matic</span>
                            <div class="status-badge available">Tersedia</div>
                        </div>
                        <div class="car-img-container">
                            <img src="gambar/919_484_0000_agya-gr-_-black-red_optimized.png-removebg-preview.png"
                                alt="Car">
                        </div>
                        <div class="car-details">
                            <h4>Toyota Agya</h4>
                            <p class="price">Rp 350.000 <span>/ hari</span></p>
                            <div class="specs">
                                <span><i class="fa-solid fa-couch"></i> 5</span>
                                <span><i class="fa-solid fa-gas-pump"></i> Bensin</span>
                            </div>
                            <button class="btn-rent" onclick="window.location.href='booking.php?mobil=Audi A8 L'">Sewa
                                Sekarang</button>
                        </div>
                    </div>

                    <div class="car-card glass-panel">
                        <div class="card-top">
                            <span class="car-tag">Manual</span>
                            <div class="status-badge available">Tersedia</div>
                        </div>
                        <div class="car-img-container">
                            <img src="gambar/254-2546334_honda-brio-rallye-red-honda-brio-removebg-preview.png"
                                alt="Car">
                        </div>
                        <div class="car-details">
                            <h4>Honda Brio</h4>
                            <p class="price">Rp 900.000 <span>/ hari</span></p>
                            <div class="specs">
                                <span><i class="fa-solid fa-couch"></i> 5</span>
                                <span><i class="fa-solid fa-gas-pump"></i> Bensin</span>
                            </div>
                            <button class="btn-rent"
                                onclick="window.location.href='booking.php?mobil=Jeep Cherokee'">Sewa Sekarang</button>
                        </div>
                    </div>

                    <div class="car-card glass-panel">
                        <div class="card-top">
                            <span class="car-tag">Matic</span>
                            <div class="status-badge available">Tersedia</div>
                        </div>
                        <div class="car-img-container">
                            <img src="gambar/R-removebg-preview.png" alt="Car">
                        </div>
                        <div class="car-details">
                            <h4>Toyota Calya</h4>
                            <p class="price">Rp 450.000 <span>/ hari</span></p>
                            <div class="specs">
                                <span><i class="fa-solid fa-couch"></i> 7</span>
                                <span><i class="fa-solid fa-gas-pump"></i> Bensin</span>
                            </div>
                            <button class="btn-rent" disabled style="opacity: 0.5; cursor: not-allowed;">Tidak
                                Tersedia</button>
                        </div>
                    </div>

                    <div class="car-card glass-panel">
                        <div class="card-top">
                            <span class="car-tag">Matic</span>
                            <div class="status-badge available">Tersedia</div>
                        </div>
                        <div class="car-img-container">
                            <img src="gambar/png-transparent-toyota-avanza-car-minivan-toyota-compact-car-van-car-removebg-preview.png" alt="Car">
                        </div>
                        <div class="car-details">
                            <h4>Toyota Avanza</h4>
                            <p class="price">Rp 500.000 <span>/ hari</span></p>
                            <div class="specs">
                                <span><i class="fa-solid fa-couch"></i> 7</span>
                                <span><i class="fa-solid fa-gas-pump"></i> Bensin</span>
                            </div>
                            <button class="btn-rent"
                                onclick="window.location.href='booking.php?mobil=Porsche Cayman'">Sewa Sekarang</button>
                        </div>
                    </div>

                    <div class="car-card glass-panel">
                        <div class="card-top">
                            <span class="car-tag">Matic</span>
                            <div class="status-badge available">Tersedia</div>
                        </div>
                        <div class="car-img-container">
                            <img src="gambar/OIP-removebg-preview.png"
                                alt="Car">
                        </div>
                        <div class="car-details">
                            <h4>Mitsubishi Xpander</h4>
                            <p class="price">Rp 700.000 <span>/ hari</span></p>
                            <div class="specs">
                                <span><i class="fa-solid fa-couch"></i> 7</span>
                                <span><i class="fa-solid fa-gas-pump"></i> Bensin</span>
                            </div>
                            <button class="btn-rent"
                                onclick="window.location.href='booking.php?mobil=Mercedes C63'">Sewa Sekarang</button>
                        </div>
                    </div>

                    <div class="car-card glass-panel">
                        <div class="card-top">
                            <span class="car-tag">Matic</span>
                            <div class="status-badge available">Tersedia</div>
                        </div>
                        <div class="car-img-container">
                            <img src="gambar/03-Grey-Metallic-1G3-removebg-preview.png" alt="Car">
                        </div>
                        <div class="car-details">
                            <h4>Toyota Innova Zenix</h4>
                            <p class="price">Rp 1.400.000 <span>/ hari</span></p>
                            <div class="specs">
                                <span><i class="fa-solid fa-couch"></i> 7</span>
                                <span><i class="fa-solid fa-gas-pump"></i> Bensin</span>
                            </div>
                            <button class="btn-rent"
                                onclick="window.location.href='booking.php?mobil=Toyota Hilux'">Sewa Sekarang</button>
                        </div>
                    </div>

                </div>

                <div class="pagination">
                    <a href="catalog.php" class="page-link"><i class="fa-solid fa-chevron-left"></i></a>
                    <a href="catalog.php" class="page-link">1</a>
                    <a href="#" class="page-link active">2</a>
                    <a href="catalog3.php" class="page-link">3</a>
                    <a href="catalog2.php" class="page-link"><i class="fa-solid fa-chevron-right"></i></a>
                </div>

            </main>
        </div>
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