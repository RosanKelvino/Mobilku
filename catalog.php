<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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

$sort_option = isset($_GET['sort']) ? $_GET['sort'] : '';
$order_by = "id DESC"; 
if ($sort_option == 'harga_rendah') $order_by = "harga_per_hari ASC";
if ($sort_option == 'harga_tinggi') $order_by = "harga_per_hari DESC";

$sql = "SELECT * FROM mobil";
if (count($where_clauses) > 0) {
    $sql .= " WHERE " . implode(" AND ", $where_clauses);
}
$sql .= " ORDER BY $order_by";

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

    <div class="glow-orb orb-1"></div>
    <div class="glow-orb orb-2"></div>

    <div class="container">
        <?php include 'navbar.php'; ?>

        <div class="main-wrapper" style="margin-top: 20px; display: flex; gap: 20px;">
            
            <aside class="filter-sidebar glass-panel" style="flex: 1; min-width: 280px; height: fit-content; padding: 20px; border-radius: 20px;">
                <form action="catalog.php" method="GET">
                    <div class="filter-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <h3><i class="fa-solid fa-filter"></i> Filter</h3>
                        <a href="catalog.php" class="reset-link" style="color: #4754e6; text-decoration: none; font-size: 14px;">Reset</a>
                    </div>

                    <div class="filter-group">
                        <h4 style="margin-bottom: 10px;">Kategori</h4>
                        <?php 
                        $categories = ['Sport Car', 'SUV Premium', 'Sedan Luxury', 'MPV Family', 'City Car'];
                        foreach($categories as $cat): 
                            $checked = (isset($_GET['kategori']) && in_array($cat, $_GET['kategori'])) ? 'checked' : '';
                        ?>
                        <label class="checkbox-container" style="display: block; margin-bottom: 8px; cursor: pointer;">
                            <input type="checkbox" name="kategori[]" value="<?php echo $cat; ?>" <?php echo $checked; ?>>
                            <?php echo $cat; ?>
                        </label>
                        <?php endforeach; ?>
                    </div>

                    <div class="divider" style="margin: 20px 0; border-top: 1px solid rgba(255,255,255,0.1);"></div>

                    <div class="filter-group">
                        <h4>Transmisi</h4>
                        <select name="transmisi" class="glass-input" style="width: 100%; padding: 10px; border-radius: 10px; background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.2);">
                            <option value="" style="color: black;">Semua</option>
                            <option value="Matic" <?php echo (isset($_GET['transmisi']) && $_GET['transmisi'] == 'Matic') ? 'selected' : ''; ?> style="color: black;">Matic</option>
                            <option value="Manual" <?php echo (isset($_GET['transmisi']) && $_GET['transmisi'] == 'Manual') ? 'selected' : ''; ?> style="color: black;">Manual</option>
                        </select>
                    </div>

                    <div class="divider" style="margin: 20px 0; border-top: 1px solid rgba(255,255,255,0.1);"></div>

                    <div class="filter-group">
                        <h4>Rentang Harga</h4>
                        <div class="price-inputs" style="display: flex; align-items: center; gap: 5px;">
                            <input type="number" name="min_harga" placeholder="Min" class="glass-input" value="<?php echo $_GET['min_harga'] ?? ''; ?>" style="width: 45%; padding: 8px; border-radius: 8px;">
                            <span style="color: white;">-</span>
                            <input type="number" name="max_harga" placeholder="Max" class="glass-input" value="<?php echo $_GET['max_harga'] ?? ''; ?>" style="width: 45%; padding: 8px; border-radius: 8px;">
                        </div>
                    </div>

                    <button type="submit" class="btn-primary" style="width: 100%; margin-top: 20px; padding: 12px; border-radius: 12px; border: none; background: #4754e6; color: white; cursor: pointer;">Terapkan Filter</button>
                </form>
            </aside>

            <main class="catalog-content" style="flex: 3;">
                <div class="catalog-header glass-panel" style="display: flex; justify-content: space-between; align-items: center; padding: 15px 20px; border-radius: 15px; margin-bottom: 20px; color: white;">
                    <span>Menampilkan <strong><?php echo $result->num_rows; ?></strong> mobil</span>
                    <div class="sort-box">
                        <form id="sortForm" method="GET">
                            <?php if(isset($_GET['kategori'])) foreach($_GET['kategori'] as $k) echo '<input type="hidden" name="kategori[]" value="'.$k.'">'; ?>
                            <label>Urutkan:</label>
                            <select name="sort" onchange="this.form.submit()" class="glass-select" style="padding: 5px 10px; border-radius: 5px; background: rgba(255,255,255,0.1); color: white;">
                                <option value="">Terbaru</option>
                                <option value="harga_rendah" <?php echo ($sort_option == 'harga_rendah') ? 'selected' : ''; ?>>Harga Terendah</option>
                                <option value="harga_tinggi" <?php echo ($sort_option == 'harga_tinggi') ? 'selected' : ''; ?>>Harga Tertinggi</option>
                            </select>
                        </form>
                    </div>
                </div>

                <div class="car-grid three-col" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): 
                            $is_available = ($row['status'] == 'Tersedia');
                        ?>
                            <div class="car-card glass-panel" style="padding: 15px; border-radius: 20px; color: white;">
                                <div class="card-top" style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                    <span class="car-tag" style="background: rgba(255,255,255,0.1); padding: 4px 10px; border-radius: 8px; font-size: 12px;"><?php echo $row['transmisi']; ?></span>
                                    <div class="status-badge <?php echo $is_available ? 'available' : 'booked'; ?>" style="font-size: 12px; color: <?php echo $is_available ? '#00ff88' : '#ff4d4d'; ?>;">
                                        ● <?php echo $row['status']; ?>
                                    </div>
                                </div>
                                <div class="car-img-container" style="text-align: center; margin: 15px 0;">
                                    <img src="gambar/<?php echo $row['gambar']; ?>" alt="Mobil" style="max-width: 100%; height: auto; transform: scale(1.1);">
                                </div>
                                <div class="car-details">
                                    <h4 style="margin-bottom: 5px;"><?php echo $row['nama_mobil']; ?></h4>
                                    <p class="price" style="color: #4754e6; font-weight: bold; font-size: 18px;">
                                        Rp <?php echo number_format($row['harga_per_hari'], 0, ',', '.'); ?> <span style="font-size: 12px; color: rgba(255,255,255,0.5);">/ hari</span>
                                    </p>
                                    <div class="specs" style="display: flex; gap: 15px; margin: 15px 0; font-size: 14px; color: rgba(255,255,255,0.7);">
                                        <span><i class="fa-solid fa-chair"></i> <?php echo $row['kapasitas']; ?></span>
                                        <span><i class="fa-solid fa-gas-pump"></i> <?php echo $row['bahan_bakar']; ?></span>
                                    </div>
                                    
                                   <?php if ($is_available): ?>
    
    <?php if (isset($_SESSION['user_id'])): ?>
        <button class="btn-rent" 
            onclick="window.location.href='booking.php?mobil_id=<?php echo $row['id']; ?>'"
            style="width: 100%; padding: 10px; border-radius: 10px; border: none; background: #4754e6; color: white; font-weight: bold; cursor: pointer;">
            Sewa Sekarang
        </button>
    <?php else: ?>
        <button class="btn-rent" 
            onclick="openLoginModal()"
            style="width: 100%; padding: 10px; border-radius: 10px; border: none; background: #4754e6; color: white; font-weight: bold; cursor: pointer;">
            Sewa Sekarang
        </button>
    <?php endif; ?>

<?php else: ?>
    <button class="btn-rent" disabled 
        style="width: 100%; padding: 10px; border-radius: 10px; border: none; background: rgba(255,255,255,0.1); color: rgba(255,255,255,0.5); font-weight: bold; cursor: not-allowed;">
        Sedang Disewa
    </button>
<?php endif; ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div style="grid-column: 1/-1; text-align: center; padding: 50px; color: white;">
                            <i class="fa-solid fa-car-on" style="font-size: 50px; opacity: 0.3; margin-bottom: 20px;"></i>
                            <p>Tidak ada mobil yang ditemukan sesuai filter.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </main>
        </div>
    </div>
    
    <?php include 'login.php'; ?>

     <script>
        // Fungsi ini dipanggil saat tombol Sewa diklik (jika belum login)
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