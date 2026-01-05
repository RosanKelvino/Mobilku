<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['hapus_pesanan'])) {
    $id_sewa = $_POST['id_sewa'];
    $user_id = $_SESSION['user_id'];

    $check = $conn->query("SELECT status FROM sewa WHERE id = '$id_sewa' AND user_id = '$user_id'");
    
    if ($check->num_rows > 0) {
        $data = $check->fetch_assoc();

        if ($data['status'] == 'Menunggu') {
            $sql = "DELETE FROM sewa WHERE id = '$id_sewa'";
            if ($conn->query($sql)) {
                echo "<script>
                        alert('Pesanan berhasil dibatalkan dan dihapus dari riwayat.'); 
                        window.location.href='riwayat.php';
                      </script>";
                exit();
            } else {
                echo "<script>alert('Terjadi kesalahan database.'); window.location.href='riwayat.php';</script>";
            }
        } else {
            echo "<script>alert('Gagal! Pesanan yang sudah diproses tidak bisa dibatalkan.'); window.location.href='riwayat.php';</script>";
        }
    } else {
        echo "<script>alert('Data tidak ditemukan atau Anda tidak memiliki akses.'); window.location.href='riwayat.php';</script>";
    }
} else {
    header("Location: riwayat.php");
    exit();
}
?>