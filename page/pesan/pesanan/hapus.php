<?php
session_start();
include '../../../config/connect.php';

if (isset($_GET['id'])) {
    // Mengambil data dari parameter URL
    $id = $_GET['id'];

    // Menghapus data menggunakan query SQL
    $query = "DELETE FROM keranjang WHERE id_keranjang = $id";

    // Jika berhasil maka dialihkan ke halaman produk
    if ($conn->query($query)) {
        header("Location: ../../page.php?mod=keranjang");
        exit;
    } else {
        echo "Error executing query: " . $conn->error;
    }
}
?>
