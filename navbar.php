<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "db.php"; 

$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar glass-panel">
    <div class="logo">
        <a href="index.php" style="text-decoration: none; color: inherit;">
            <i class="fa-solid fa-car-side"></i> MobilKu
        </a>
    </div>

    <ul class="nav-links">
        <li>
            <a href="index.php" class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">Beranda</a>
        </li>
        <li>
            <a href="catalog.php" class="<?php echo ($current_page == 'catalog.php') ? 'active' : ''; ?>">Katalog</a>
        </li>
        <li>
            <a href="services.php" class="<?php echo ($current_page == 'services.php') ? 'active' : ''; ?>">Layanan</a>
        </li>
        <li>
            <a href="about.php" class="<?php echo ($current_page == 'about.php') ? 'active' : ''; ?>">Tentang</a>
        </li>
    </ul>

    <div class="nav-actions">
        <?php if (isset($_SESSION['user_id'])): ?>
        <a href="profil.php" class="user-profile-link">
            <i class="fa-solid fa-user"></i> 
            <span><?php echo htmlspecialchars($_SESSION['nama']); ?></span>
        </a>
        
        <a href="logout.php" class="btn-logout" onclick="return confirm('Yakin ingin keluar?');">
            <i class="fa-solid fa-right-from-bracket"></i>
        </a>

    <?php else: ?>
        <button class="btn-transparent" id="btnMasukNav">Masuk</button>
        <button class="btn-primary" id="btnDaftarNav">Daftar</button>
    <?php endif; ?>
    </div>
</nav>

<style>
    .nav-links a.active {
        color: #ffffffff !important; /* Sesuaikan warna tema Anda */
        font-weight: bold;
        position: relative;
        text-decoration: none;
    }
    .nav-links a.active::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 2px;
    }
</style>
<script>
    const btnMasuk = document.getElementById('btnMasukNav');
if(btnMasuk) {
    btnMasuk.onclick = () => { loginModal.style.display = 'flex'; };
}
</script>