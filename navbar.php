<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "db.php"; 

$current_page = basename($_SERVER['PHP_SELF']);

$nav_foto = 'istockphoto-1300845620-612x612.jpg'; 
if (isset($_SESSION['user_id'])) {
    $uid = $_SESSION['user_id'];
    $q_nav = $conn->query("SELECT foto FROM users WHERE id = '$uid'");
    $d_nav = $q_nav->fetch_assoc();
    if (!empty($d_nav['foto'])) {
        $nav_foto = 'uploads/profile/' . $d_nav['foto'];
    }
}
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
                <div class="nav-profil-img-container">
                    <img src="<?php echo $nav_foto; ?>" class="nav-avatar">
                </div>
                <span><?php echo htmlspecialchars($_SESSION['nama']); ?></span>
            </a>

            <a href="logout.php" class="btn-logout" onclick="return confirm('Yakin ingin keluar?');">
                <i class="fa-solid fa-right-from-bracket"></i>
            </a>

        <?php else: ?>
            <button class="btn-transparent" id="btnMasukNav">Masuk</button>
            <button class="btn-primary" id="btnDaftar">Daftar</button>
        <?php endif; ?>
    </div>
</nav>

<style>
    
    .user-profile-link {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        color: #ffffff !important; 
        transition: 0.3s;
    }

    .user-profile-link i, .user-profile-link span {
        color: #ffffff !important;
    }

    .user-profile-link:hover {
        opacity: 0.8;
    }

    .nav-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #4754e6;
    }

    .btn-logout {
        color: #ff4d4d !important; 
        font-size: 18px;
        margin-left: 10px;
        transition: 0.3s;
        text-decoration: none;
    }

    .btn-logout:hover {
        color: #ff3333 !important;
        transform: scale(1.1);
    }

    .nav-links a.active {
        color: #ffffff !important;
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
        background-color: #4754e6; 
    }

    .nav-actions {
        display: flex;
        align-items: center;
        gap: 15px;
    }
</style>

<script>
    const btnMasuk = document.getElementById('btnMasukNav');
    if (btnMasuk) {
        btnMasuk.onclick = () => { loginModal.style.display = 'flex'; };
    }
    const btnDaftar = document.getElementById('btnDaftar');
    if (btnDaftar) {
        btnDaftar.onclick = () => { registerModal.style.display = 'flex'; };
    }
    
</script>