<?php
session_start();
include '../../../config/connect.php';

if (isset($_POST['email'], $_POST['nama'], $_POST['no_hp'], $_POST['password'])) {

    // Mengambil data dari inputan user
    $email = $_POST['email'];
    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];
    $password = $_POST['password'];

    // Memasukan data menggunakan query SQL
    $query = "INSERT INTO user (role_id, nama, email, no_hp, password) VALUES (3, '$nama', '$email', '$no_hp', '$password')";

    // Jika berhasil maka dialihkan ke halaman produk
    if ($conn->query($query)) {
        header("Location: ../../page.php?mod=dashboard");
        exit;
    } else {
        echo "Error executing query: " . $conn->error;
    }
}
?>