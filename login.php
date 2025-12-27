<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .modal-overlay {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(15px);
    display: none; 
    justify-content: center;
    align-items: center;
    z-index: 99999; 
}

.auth-card {
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.2);
    width: 90%;
    max-width: 400px;
    padding: 40px;
    border-radius: 25px;
    position: relative;
    box-shadow: 0 20px 40px rgba(0,0,0,0.4);
    color: white;
    text-align: center;
    animation: modalPop 0.4s ease-out;
}

@keyframes modalPop {
    from { transform: scale(0.85); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}

.auth-logo { font-size: 40px; margin-bottom: 15px; color: #4754e6ff; }
.auth-header h2 { font-size: 28px; margin-bottom: 5px; }
.auth-header p { color: rgba(255,255,255,0.6); margin-bottom: 25px; font-size: 14px; }

.floating-group { position: relative; margin-bottom: 15px; }
.floating-group i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: rgba(255,255,255,0.7); }
.floating-group input {
    width: 100%; padding: 12px 15px 12px 45px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px; color: white; outline: none;
}

.btn-gradient-auth {
    width: 100%; padding: 12px; margin-top: 15px;
    border: none; border-radius: 12px;
    background: linear-gradient(45deg, #161bbcff, #3203f1ff);
    color: white; font-weight: 600; cursor: pointer;
}

.close-modal { position: absolute; top: 15px; right: 20px; font-size: 25px; cursor: pointer; opacity: 0.6; }
.close-modal:hover { opacity: 1; }
.auth-footer { margin-top: 20px; font-size: 14px; }
.auth-footer a { color: #110edcff; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    <div id="loginModal" class="modal-overlay">
    <div class="auth-card">
        <span class="close-modal" id="closeLoginBtn">&times;</span>
        <div class="auth-header">
            <div class="auth-logo"><i class="fa-solid fa-car-side"></i></div>
            <h2>Selamat Datang</h2>
            <p>Masuk untuk akses armada MobilKu</p>
        </div>
        <form class="auth-form">
            <div class="floating-group">
                <i class='bx bxs-user'></i>
                <input type="text" placeholder="Username" required>
            </div>
            <div class="floating-group">
                <i class='bx bxs-lock-alt'></i>
                <input type="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn-gradient-auth">Masuk Sekarang</button>
        </form>
        <div class="auth-footer">
            <p>Belum punya akun? <a href="#" id="switchRegister">Daftar Gratis</a></p>
        </div>
    </div>
</div>

<div id="registerModal" class="modal-overlay">
    <div class="auth-card">
        <span class="close-modal" id="closeRegisterBtn">&times;</span>
        <div class="auth-header">
            <div class="auth-logo"><i class="fa-solid fa-user-plus"></i></div>
            <h2>Buat Akun</h2>
            <p>Daftar sekarang untuk mulai menyewa</p>
        </div>
        <form class="auth-form">
            <div class="floating-group">
                <i class='bx bxs-user-detail'></i>
                <input type="text" placeholder="Nama Lengkap" required>
            </div>
            <div class="floating-group">
                <i class='bx bxs-envelope'></i>
                <input type="email" placeholder="Email Aktif" required>
            </div>
            <div class="floating-group">
                <i class='bx bxs-lock-alt'></i>
                <input type="password" placeholder="Buat Password" required>
            </div>
            <button type="submit" class="btn-gradient-auth">Daftar Sekarang</button>
        </form>
        <div class="auth-footer">
            <p>Sudah punya akun? <a href="#" id="switchLogin">Masuk di sini</a></p>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
    const loginModal = document.getElementById('loginModal');
    const registerModal = document.getElementById('registerModal');
    const btnMasuk = document.querySelector('.btn-transparent'); 
    const btnDaftar = document.querySelector('.nav-actions .btn-primary');
    const closeLogin = document.getElementById('closeLoginBtn');
    const closeRegister = document.getElementById('closeRegisterBtn');
    const switchRegister = document.getElementById('switchRegister');
    const switchLogin = document.getElementById('switchLogin');

    if(btnMasuk) btnMasuk.onclick = (e) => { e.preventDefault(); loginModal.style.display = 'flex'; };
    if(btnDaftar) btnDaftar.onclick = (e) => { e.preventDefault(); registerModal.style.display = 'flex'; };

    if(closeLogin) closeLogin.onclick = () => loginModal.style.display = 'none';
    if(closeRegister) closeRegister.onclick = () => registerModal.style.display = 'none';

    if(switchRegister) switchRegister.onclick = (e) => {
        e.preventDefault();
        loginModal.style.display = 'none';
        registerModal.style.display = 'flex';
    };
    if(switchLogin) switchLogin.onclick = (e) => {
        e.preventDefault();
        registerModal.style.display = 'none';
        loginModal.style.display = 'flex';
    };

    window.onclick = (event) => {
        if (event.target === loginModal) loginModal.style.display = 'none';
        if (event.target === registerModal) registerModal.style.display = 'none';
    };
});
</script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>

</body>
</html>