<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'db.php';


$where_clauses = [];

if (isset($_GET['kategori']) && !empty($_GET['kategori'])) {
    $kategori_filter = $_GET['kategori'];
    if(is_array($kategori_filter)){
        $kategori_list = array_map(function($item) use ($conn) {
            return "'" . $conn->real_escape_string($item) . "'";
        }, $kategori_filter);
        $where_clauses[] = "kategori IN (" . implode(",", $kategori_list) . ")";
    }
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

$sort_option = isset($_GET['sort']) ? $_GET['sort'] : 'default';
$order_sql = "ORDER BY id DESC";

if ($sort_option == 'harga_rendah') {
    $order_sql = "ORDER BY harga_per_hari ASC";
} elseif ($sort_option == 'harga_tinggi') {
    $order_sql = "ORDER BY harga_per_hari DESC";
}

$sql = "SELECT * FROM mobil";
if (count($where_clauses) > 0) {
    $sql .= " WHERE " . implode(" AND ", $where_clauses);
}
$sql .= " $order_sql";

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
    
    <style>
        .status-badge {
            font-size: 11px;
            padding: 5px 12px;
            border-radius: 6px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .bg-available { 
            background: rgba(0, 255, 136, 0.1); 
            color: #00ff88; 
            border: 1px solid rgba(0, 255, 136, 0.2); 
        }

        .bg-rented { 
            background: rgba(255, 77, 77, 0.1); 
            color: #ff4d4d; 
            border: 1px solid rgba(255, 77, 77, 0.2); 
        }

        .bg-repair { 
            background: rgba(160, 160, 176, 0.1); 
            color: #a0a0b0; 
            border: 1px solid rgba(160, 160, 176, 0.2); 
        }

       
    </style>
</head>
<body>

    <div class="glow-orb orb-1"></div>
    <div class="glow-orb orb-2"></div>

    <div class="container">
        <?php include 'navbar.php'; ?>

        <div class="main-wrapper">
            
            <aside class="filter-sidebar glass-panel">
                <form action="catalog.php" method="GET">
                    <div class="filter-header">
                        <h3><i class="fa-solid fa-filter"></i> Filter</h3>
                        <a href="catalog.php" class="reset-link">Reset</a>
                    </div>

                    <div class="filter-group">
                        <h4>Kategori</h4>
                        <?php 
                        $categories = ['Sport Car', 'SUV Premium', 'Sedan Luxury', 'MPV Family', 'City Car'];
                        foreach($categories as $cat): 
                            $checked = (isset($_GET['kategori']) && in_array($cat, $_GET['kategori'])) ? 'checked' : '';
                        ?>
                        <label class="checkbox-container">
                            <?php echo $cat; ?>
                            <input type="checkbox" name="kategori[]" value="<?php echo $cat; ?>" <?php echo $checked; ?> onchange="this.form.submit()">
                            <span class="checkmark"></span>
                        </label>
                        <?php endforeach; ?>
                    </div>
                    

                    <div class="filter-group">
                        <h4>Transmisi</h4>
                        <select name="transmisi" class="glass-input" onchange="this.form.submit()">
                            <option value="" style="color:black;">Semua</option>
                            <option value="Matic" <?php echo (isset($_GET['transmisi']) && $_GET['transmisi'] == 'Matic') ? 'selected' : ''; ?> style="color:black;">Matic</option>
                            <option value="Manual" <?php echo (isset($_GET['transmisi']) && $_GET['transmisi'] == 'Manual') ? 'selected' : ''; ?> style="color:black;">Manual</option>
                        </select>
                    </div>


                    <div class="filter-group">
                        <h4>Rentang Harga</h4>
                        <div class="price-inputs">
                            <input type="number" name="min_harga" placeholder="Min" class="glass-input" value="<?php echo $_GET['min_harga'] ?? ''; ?>">
                            <span style="color:white;">-</span>
                            <input type="number" name="max_harga" placeholder="Max" class="glass-input" value="<?php echo $_GET['max_harga'] ?? ''; ?>">
                        </div>
                    </div>

                    <button type="submit" class="btn-primary w-100 mt-20">Terapkan Filter</button>
                    
                    <?php if(isset($_GET['sort'])): ?>
                        <input type="hidden" name="sort" value="<?php echo htmlspecialchars($_GET['sort']); ?>">
                    <?php endif; ?>
                </form>
            </aside>

            <main class="catalog-content">
                <div class="catalog-header glass-panel">
                    <span>Menampilkan <strong><?php echo $result->num_rows; ?></strong> mobil</span>
                    
                    <form method="GET" style="display:inline;">
                        <?php 
                        if(isset($_GET['kategori'])) foreach($_GET['kategori'] as $k) echo "<input type='hidden' name='kategori[]' value='$k'>";
                        if(isset($_GET['transmisi'])) echo "<input type='hidden' name='transmisi' value='".$_GET['transmisi']."'>";
                        ?>
                        
                        <div class="sort-box">
                            <label>Urutkan:</label>
                            <select name="sort" onchange="this.form.submit()" class="glass-select">
                                <option value="" style="color:white;">Terbaru</option>
                                <option value="harga_rendah" <?php echo ($sort_option == 'harga_rendah') ? 'selected' : ''; ?> style="color:white;">Harga Terendah</option>
                                <option value="harga_tinggi" <?php echo ($sort_option == 'harga_tinggi') ? 'selected' : ''; ?> style="color:white;">Harga Tertinggi</option>
                            </select>
                        </div>
                    </form>
                </div>

                <div class="car-grid three-col">
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): 
                            
                            $status = $row['status']; 
                            
                            if ($status == 'Tersedia') {
                                $badgeClass = 'bg-available';
                                $badgeLabel = '● Tersedia';
                                $isBookable = true;
                            } elseif ($status == 'Disewa' || $status == 'Sedang Disewa') {
                                $badgeClass = 'bg-rented';
                                $badgeLabel = '● Sedang Disewa';
                                $isBookable = false;
                            } else {
                                $badgeClass = 'bg-repair';
                                $badgeLabel = '● Perbaikan';
                                $isBookable = false;
                            }
                        ?>
                            <div class="car-card glass-panel">
                                <div class="card-top">
                                    <span class="car-tag"><?php echo $row['transmisi']; ?></span>
                                    
                                    <div class="status-badge <?php echo $badgeClass; ?>">
                                        <?php echo $badgeLabel; ?>
                                    </div>
                                </div>
                                
                                <div class="car-img-container">
                                    <img src="gambar/<?php echo $row['gambar']; ?>" alt="<?php echo $row['nama_mobil']; ?>">
                                </div>
                                
                                <div class="car-details">
                                    <h4><?php echo $row['nama_mobil']; ?></h4>
                                    <p class="price">
                                        Rp <?php echo number_format($row['harga_per_hari'], 0, ',', '.'); ?> <span>/ hari</span>
                                    </p>
                                    
                                    <div class="specs">
                                        <span><i class="fa-solid fa-chair"></i> <?php echo $row['kapasitas']; ?></span>
                                        <span><i class="fa-solid fa-gas-pump"></i> <?php echo $row['bahan_bakar']; ?></span>
                                    </div>

                                    <?php if ($isBookable): ?>
                                        <?php if (isset($_SESSION['user_id'])): ?>
                                            <button class="btn-rent" onclick="window.location.href='booking.php?mobil_id=<?php echo $row['id']; ?>'">
                                                Sewa Sekarang
                                            </button>
                                        <?php else: ?>
                                            <button class="btn-rent" onclick="openLoginModal()">
                                                Sewa Sekarang
                                            </button>
                                        <?php endif; ?>

                                    <?php else: ?>
                                        <button class="btn-rent" disabled 
                                            style="background:rgba(255,255,255,0.05); color:rgba(255,255,255,0.3); border:1px solid rgba(255,255,255,0.1); cursor:not-allowed;">
                                            <?php echo ($status == 'Perbaikan') ? 'Sedang Perbaikan' : 'Tidak Tersedia'; ?>
                                        </button>
                                    <?php endif; ?>
                                    
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div style="grid-column: 1/-1; text-align: center; padding: 50px;">
                            <i class="fa-solid fa-car-on" style="font-size: 50px; opacity: 0.3; margin-bottom: 20px;"></i>
                            <p>Tidak ada mobil yang ditemukan.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </main>
        </div>
    </div>

    <?php include 'login.php'; ?>

    <script>
        function openLoginModal() {
            const loginModal = document.getElementById('loginModal');
            if (loginModal) {
                loginModal.style.display = 'flex';
            } else {
                alert("Silakan login melalui tombol Masuk di pojok kanan atas.");
            }
        }
    </script>
</body>
</html>