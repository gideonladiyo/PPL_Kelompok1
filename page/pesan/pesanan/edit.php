<?php
session_start();
include '../../../config/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari inputan user
    $id_keranjang = $_POST['id_keranjang'];
    echo $id_keranjang;
    $jumlah = $_POST['jumlah'];

    // Mengubah data menggunakan query SQL
    $query = "UPDATE keranjang SET jumlah = $jumlah WHERE id_keranjang = $id_keranjang";

    // Jika berhasil maka dialihkan ke halaman produk
    if ($conn->query($query)) {
        header("Location: ../../page.php?mod=keranjang");
        exit;
    } else {
        echo "Error executing query: " . $conn->error;
    }
}
?>
