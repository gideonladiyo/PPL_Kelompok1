<?php

include '../../config/connect.php';

if (isset($_POST['user_id'], $_POST['tentang'], $_POST['pesan'])) {

    // Mengambil data dari inputan user
    $user_id = $_POST['user_id'];
    $tentang = $_POST['tentang'];
    $pesan = $_POST['pesan'];

    // Memasukan data menggunakan query SQL
    $query = "INSERT INTO reviews (user_id, tentang, pesan) VALUES ($user_id, '$tentang', '$pesan')";

    // Jika berhasil maka dialihkan ke halaman produk
    if ($conn->query($query)) {
        header("Location: ../../page.php?mod=ulasan");
        exit;
    } else {
        echo "Error executing query: " . $conn->error;
    }
}
?>