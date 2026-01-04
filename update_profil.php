<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];


if (isset($_POST['update_foto'])) {
    $namaFile   = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error      = $_FILES['foto']['error'];
    $tmpName    = $_FILES['foto']['tmp_name'];

    if ($error === 4) {
        echo "<script>alert('Pilih file gambar terlebih dahulu!'); window.location.href='profil.php';</script>";
        exit;
    }

    $ekstensiValid = ['jpg', 'jpeg', 'png'];
    $ekstensi      = explode('.', $namaFile);
    $ekstensi      = strtolower(end($ekstensi));

    if (!in_array($ekstensi, $ekstensiValid)) {
        echo "<script>alert('Format file tidak didukung! Gunakan JPG, JPEG, atau PNG.'); window.location.href='profil.php';</script>";
        exit;
    }

    if ($ukuranFile > 2000000) {
        echo "<script>alert('Ukuran file terlalu besar! Maksimal 2MB.'); window.location.href='profil.php';</script>";
        exit;
    }

    $namaFileBaru = uniqid() . '.' . $ekstensi;
    $folderTujuan = 'uploads/profile/';

    if (!is_dir($folderTujuan)) {
        mkdir($folderTujuan, 0777, true);
    }

    if (move_uploaded_file($tmpName, $folderTujuan . $namaFileBaru)) {
        
        $queryFoto = $conn->query("SELECT foto FROM users WHERE id = '$user_id'");
        $dataLama  = $queryFoto->fetch_assoc();
        
        if (!empty($dataLama['foto'])) {
            $pathFotoLama = $folderTujuan . $dataLama['foto'];
            if (file_exists($pathFotoLama)) {
                unlink($pathFotoLama);
            }
        }

        $sql = "UPDATE users SET foto = '$namaFileBaru' WHERE id = '$user_id'";
        if ($conn->query($sql)) {
            echo "<script>alert('Foto profil berhasil diperbarui!'); window.location.href='profil.php';</script>";
        }
    } else {
        echo "<script>alert('Gagal mengupload gambar.'); window.location.href='profil.php';</script>";
    }
}

if (isset($_POST['update_umum'])) {
    $nama = $conn->real_escape_string($_POST['nama']);
    $hp   = $conn->real_escape_string($_POST['hp']);

    $sql = "UPDATE users SET nama_lengkap = '$nama', no_hp = '$hp' WHERE id = '$user_id'";

    if ($conn->query($sql)) {
        $_SESSION['nama'] = $nama;
        echo "<script>alert('Data profil berhasil diperbarui!'); window.location.href='profil.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

if (isset($_POST['update_password'])) {
    $pass_lama  = $_POST['pass_lama'];
    $pass_baru  = $_POST['pass_baru'];
    $konfirmasi = $_POST['konfirmasi_baru'];

    $res  = $conn->query("SELECT password FROM users WHERE id = '$user_id'");
    $user = $res->fetch_assoc();

    if (password_verify($pass_lama, $user['password'])) {
        if ($pass_baru === $konfirmasi) {
            $hash_baru = password_hash($pass_baru, PASSWORD_DEFAULT);
            $conn->query("UPDATE users SET password = '$hash_baru' WHERE id = '$user_id'");
            echo "<script>alert('Password berhasil diubah!'); window.location.href='profil.php';</script>";
        } else {
            echo "<script>alert('Konfirmasi password baru tidak cocok!'); window.location.href='profil.php';</script>";
        }
    } else {
        echo "<script>alert('Password lama Anda salah!'); window.location.href='profil.php';</script>";
    }
}
?>