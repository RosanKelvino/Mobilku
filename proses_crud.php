<?php

if (isset($_POST['hapus_pesanan'])) {
    $id_sewa = $_POST['id_sewa'];
    $user_id = $_SESSION['user_id'];

    $check = $conn->query("SELECT status FROM sewa WHERE id = '$id_sewa' AND user_id = '$user_id'");
    $data = $check->fetch_assoc();

    if ($data && $data['status'] == 'Menunggu') {
        $sql = "DELETE FROM sewa WHERE id = '$id_sewa'";
        if ($conn->query($sql)) {
            echo "<script>alert('Pesanan berhasil dibatalkan!'); window.location.href='riwayat.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Gagal! Pesanan sudah diproses atau bukan milik Anda.'); window.location.href='riwayat.php';</script>";
        exit();
    }
}
?>