<?php
// Koneksi ke database
include('../../../config/connect.php');
// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil data dari permintaan POST
$user_id = $_POST['id_transaksi'];

// Update status transaksi menjadi 'konfirmasi'
$sql_transaksi = "UPDATE transaksi SET status = 'konfirmasi' WHERE id_transaksi = ?";
$stmt_transaksi = $conn->prepare($sql_transaksi);
$stmt_transaksi->bind_param("i", $user_id);
$stmt_transaksi->execute();

// Update status keranjang menjadi 'proses'
$sql_keranjang = "UPDATE keranjang SET status = 'proses' WHERE id_transaksi = ?";
$stmt_keranjang = $conn->prepare($sql_keranjang);
$stmt_keranjang->bind_param("i", $user_id);
$stmt_keranjang->execute();

$stmt_transaksi->close();
$stmt_keranjang->close();
$conn->close();

header("Location: page.php?mod=pesan");
exit;
?>
