<?php
include 'db.php';


$where_clauses = [];

if (isset($_GET['kategori']) && !empty($_GET['kategori'])) {
    $kategori_filter = $_GET['kategori'];
    $kategori_list = array_map(function($item) use ($conn) {
        return "'" . $conn->real_escape_string($item) . "'";
    }, $kategori_filter);
    $where_clauses[] = "kategori IN (" . implode(",", $kategori_list) . ")";
}

if (isset($_GET['transmisi']) && $_GET['transmisi'] != '') {
    $transmisi = $conn->real_escape_string($_GET['transmisi']);
    $where_clauses[] = "transmisi = '$transmisi'";
}

if (isset($_GET['min_harga']) && $_GET['min_harga'] != '') {
    $min = (int)$_GET['min_harga'];
    $where_clauses[] = "harga_per_hari >= $min";
}
if (isset($_GET['max_harga']) && $_GET['max_harga'] != '') {
    $max = (int)$_GET['max_harga'];
    $where_clauses[] = "harga_per_hari <= $max";
}

$sql = "SELECT * FROM mobil";
if (count($where_clauses) > 0) {
    $sql .= " WHERE " . implode(" AND ", $where_clauses);
}

$result = $conn->query($sql);
?>

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
                <?php if(isset($_SESSION['user_id'])): ?>
                    <span style="color: white; margin-right: 15px;">Hai, <?php echo $_SESSION['nama']; ?></span>
                    <a href="logout.php" class="btn-primary">Logout</a>
                <?php else: ?>
                    <button class="btn-transparent">Masuk</button>
                    <button class="btn-primary">Daftar</button>
                <?php endif; ?>
            </div>
        </nav>

        <div class="container main-wrapper">

            <aside class="filter-sidebar glass-panel">
                <form action="catalog.php" method="GET">
                    <div class="filter-header">
                        <h3><i class="fa-solid fa-filter"></i> Filter</h3>
                        <a href="catalog.php" class="reset-link">Reset</a>
                    </div>

                    <div class="filter-group">
                        <h4>Kategori</h4>
                        <label class="checkbox-container">Sport Car
                            <input type="checkbox" name="kategori[]" value="Sport Car">
                            <span class="checkmark"></span>
                        </label>
                        <label class="checkbox-container">SUV Premium
                            <input type="checkbox" name="kategori[]" value="SUV Premium">
                            <span class="checkmark"></span>
                        </label>
                        <label class="checkbox-container">Sedan Luxury
                            <input type="checkbox" name="kategori[]" value="Sedan Luxury">
                            <span class="checkmark"></span>
                        </label>
                        <label class="checkbox-container">MPV Family
                            <input type="checkbox" name="kategori[]" value="MPV Family">
                            <span class="checkmark"></span>
                        </label>
                    </div>

                    <div class="divider"></div>

                    <div class="filter-group">
                        <h4>Transmisi</h4>
                        <select name="transmisi" class="glass-input" style="width: 100%; color: white; background: rgba(255,255,255,0.1);">
                            <option value="" style="color: black;">Semua</option>
                            <option value="Matic" style="color: black;">Matic</option>
                            <option value="Manual" style="color: black;">Manual</option>
                        </select>
                    </div>

                    <div class="divider"></div>

                    <div class="filter-group">
                        <h4>Rentang Harga (per hari)</h4>
                        <div class="price-inputs">
                            <input type="number" name="min_harga" placeholder="Min" class="glass-input">
                            <span>-</span>
                            <input type="number" name="max_harga" placeholder="Max" class="glass-input">
                        </div>
                    </div>

                    <button type="submit" class="btn-primary w-100 mt-20">Terapkan Filter</button>
                </form>
            </aside>

            <main class="catalog-content">

                <div class="catalog-header glass-panel">
                    <span>Menampilkan <strong><?php echo $result->num_rows; ?></strong> mobil</span>
                    <div class="sort-box">
                        <label>Urutkan:</label>
                        <select class="glass-select">
                            <option>Paling Relevan</option>
                            <option>Harga Terendah</option>
                            <option>Harga Tertinggi</option>
                        </select>
                    </div>
                </div>

                <div class="car-grid three-col">

                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            // Cek status untuk styling
                            $is_available = ($row['status'] == 'Tersedia');
                            $status_class = $is_available ? 'available' : 'booked';
                            $btn_state    = $is_available ? '' : 'disabled style="opacity: 0.5; cursor: not-allowed;"';
                            $btn_text     = $is_available ? 'Sewa Sekarang' : 'Tidak Tersedia';
                            // Link hanya aktif jika tersedia
                            $btn_action   = $is_available ? "onclick=\"window.location.href='booking.php?mobil_id=" . $row['id'] . "'\"" : "";
                            ?>
                            
                            <div class="car-card glass-panel">
                                <div class="card-top">
                                    <span class="car-tag"><?php echo $row['transmisi']; ?></span>
                                    <div class="status-badge <?php echo $status_class; ?>"><?php echo $row['status']; ?></div>
                                </div>
                                <div class="car-img-container">
                                    <img src="gambar/<?php echo $row['gambar']; ?>" alt="<?php echo $row['nama_mobil']; ?>">
                                </div>
                                <div class="car-details">
                                    <h4><?php echo $row['nama_mobil']; ?></h4>
                                    <p class="price">Rp <?php echo number_format($row['harga_per_hari'], 0, ',', '.'); ?> <span>/ hari</span></p>
                                    <div class="specs">
                                        <span><i class="fa-solid fa-chair"></i> <?php echo $row['kapasitas']; ?></span>
                                        <span><i class="fa-solid fa-gas-pump"></i> <?php echo $row['bahan_bakar']; ?></span>
                                    </div>
                                    <button class="btn-rent" <?php echo $btn_state; ?> <?php echo $btn_action; ?>>
                                        <?php echo $btn_text; ?>
                                    </button>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "<p style='color: white; grid-column: 1/-1; text-align: center;'>Tidak ada mobil yang ditemukan sesuai filter.</p>";
                    }
                    ?>

                </div>

                <div class="pagination">
                    <a href="#" class="page-link"><i class="fa-solid fa-chevron-left"></i></a>
                    <a href="#" class="page-link active">1</a>
                    <a href="#" class="page-link">2</a>
                    <a href="#" class="page-link"><i class="fa-solid fa-chevron-right"></i></a>
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