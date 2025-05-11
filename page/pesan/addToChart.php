<?php
session_start();
include "../config/connect.php";

// Ambil data dari POST
$user_id = $_SESSION['user_id'];
$id_menu = $_POST['id_menu'];
$jumlah = $_POST['jumlah'];

// Insert a new record into the keranjang table
$sql = "INSERT INTO keranjang(user_id, id_transaksi, id_menu, jumlah, status) 
        VALUES ($user_id, 1, $id_menu, $jumlah, 'pending')";
if ($conn->query($sql) === TRUE) {
    echo "New record in keranjang created successfully";
    header("Location: page.php?mod=keranjang");
} else {
    die("Error: " . $sql . "<br>" . $conn->error);
}

?>
