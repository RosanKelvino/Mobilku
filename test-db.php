<?php
$conn = new mysqli("127.0.0.1", "root", "nasilemak1", "mobilku");

if ($conn->connect_error) {
    die("❌ Gagal: " . $conn->connect_error);
}

echo "🔥 MySQL TERHUBUNG!";
