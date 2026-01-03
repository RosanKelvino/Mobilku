<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Sewa - MobilKu</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .profile-wrapper {
            padding: 60px 0 80px 0;
            display: grid;
            grid-template-columns: 350px 1fr;
            gap: 30px;
        }

        .profile-sidebar {
            padding: 60px 30px;
            text-align: center;
            height: fit-content;
        }

        .profile-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 4px solid var(--primary-color);
            margin: 0 auto 20px;
            padding: 5px;
            background: var(--glass-bg);
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .profile-nav-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            color: var(--text-grey);
            text-decoration: none;
            transition: 0.3s;
            border-radius: 10px;
            margin-bottom: 5px;
        }

        .profile-nav-item:hover, .profile-nav-item.active {
            background: rgba(43, 89, 255, 0.1);
            color: var(--text-white);
        }

        .profile-nav-item i { width: 20px; color: var(--primary-color); }

        /* History Specific Styles */
        .history-content { padding: 40px; }
        
        .table-container {
            width: 100%;
            overflow-x: auto;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            color: var(--text-white);
            min-width: 600px;
        }

        th {
            text-align: left;
            padding: 15px;
            color: var(--text-grey);
            font-size: 14px;
            border-bottom: 1px solid var(--glass-border);
        }

        td {
            padding: 20px 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            font-size: 14px;
        }

        .car-info-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .car-info-cell img {
            width: 80px; /* Sedikit lebih besar agar terlihat jelas */
            border-radius: 8px;
            background: rgba(255,255,255,0.05);
        }

        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-completed { background: rgba(76, 209, 55, 0.2); color: #4cd137; }
        .status-pending { background: rgba(255, 159, 67, 0.2); color: #ff9f43; }
        .status-cancelled { background: rgba(235, 77, 75, 0.2); color: #eb4d4b; }

        .btn-detail {
            background: var(--primary-color);
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 12px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-detail:hover {
            background: var(--accent-color);
            transform: translateY(-2px);
        }

        @media (max-width: 992px) {
            .profile-wrapper { grid-template-columns: 1fr; }
        }
    </style>
</head>

<body>
    <div class="glow-orb orb-1" style="top: -100px; left: -100px;"></div>
    <div class="glow-orb orb-2" style="bottom: 10%; right: -50px;"></div>

    <div class="container">
            <?php include 'navbar.php'; ?>


        <div class="profile-wrapper">
            <aside class="profile-sidebar glass-panel">
                <div class="profile-avatar">
                    <img src="istockphoto-1300845620-612x612.jpg" alt="User">
                </div>
                <h3>John Doe</h3>
                <p style="color: var(--text-grey); font-size: 14px; margin-top: 5px;">Member Gold</p>

                <div class="profile-nav" style="margin-top: 30px; text-align: left;">
                    <a href="profil.php" class="profile-nav-item">
                        <i class="fas fa-user"></i> Detail Profil
                    </a>
                    <a href="riwayat.php" class="profile-nav-item active">
                        <i class="fas fa-history"></i> Riwayat Sewa
                    </a>
                    <a href="logout.php" class="profile-nav-item" style="color: #eb4d4b;">
                        <i class="fas fa-sign-out-alt" style="color: #eb4d4b;"></i> Keluar
                    </a>
                </div>
            </aside>

            <section class="history-content glass-panel">
                <div style="margin-bottom: 30px;">
                    <h2 class="text-gradient" style="font-size: 32px;">Riwayat Penyewaan</h2>
                    <p style="color: var(--text-grey);">Pantau status dan detail semua pesanan Anda secara real-time.</p>
                </div>

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Mobil</th>
                                <th>Tanggal Sewa</th>
                                <th>Total Bayar</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="car-info-cell">
                                        <img src="https://purepng.com/public/uploads/large/purepng.com-mercedes-benz-amg-white-carcarvehicletransportmercedes-benz-1701527448356nnyf7.png" alt="Car">
                                        <div>
                                            <p style="font-weight: 600;">Mercedes AMG GT</p>
                                            <small style="color: var(--text-grey);">Sport / Automatic</small>
                                        </div>
                                    </div>
                                </td>
                                <td>12 Jan 2024</td>
                                <td style="color: var(--accent-color); font-weight: 600;">Rp 2.500.000</td>
                                <td><span class="status-badge status-completed">Selesai</span></td>
                                <td><button class="btn-detail">Invoice</button></td>
                            </tr>
                            
                            <tr>
                                <td>
                                    <div class="car-info-cell">
                                        <img src="https://www.pngmart.com/files/10/Porsche-911-GT3-PNG-Transparent-Image.png" alt="Car">
                                        <div>
                                            <p style="font-weight: 600;">Porsche 911 GT3</p>
                                            <small style="color: var(--text-grey);">Sport / Manual</small>
                                        </div>
                                    </div>
                                </td>
                                <td>20 Jan 2024</td>
                                <td style="color: var(--accent-color); font-weight: 600;">Rp 4.200.000</td>
                                <td><span class="status-badge status-pending">Menunggu</span></td>
                                <td><button class="btn-detail">Detail</button></td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="car-info-cell">
                                        <img src="https://www.pngplay.com/wp-content/uploads/13/Audi-R8-PNG-Clipart-Background.png" alt="Car">
                                        <div>
                                            <p style="font-weight: 600;">Audi R8 V10</p>
                                            <small style="color: var(--text-grey);">Supercar / Automatic</small>
                                        </div>
                                    </div>
                                </td>
                                <td>05 Jan 2024</td>
                                <td style="color: var(--accent-color); font-weight: 600;">Rp 3.800.000</td>
                                <td><span class="status-badge status-cancelled">Dibatalkan</span></td>
                                <td><button class="btn-detail" style="background: rgba(255,255,255,0.1);">Re-book</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>

    <footer style="text-align: center; padding: 40px 0; color: var(--text-grey); font-size: 14px;">
        <p>&copy; 2024 MobilKu Rental. All rights reserved.</p>
    </footer>
</body>
</html>