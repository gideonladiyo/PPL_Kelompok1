<?php

$host = 'localhost'; // Nama host database
$username = 'root'; // Username database
$password = ''; // Password database
$database = 'project'; // Nama database
// Buat koneksi
$conn = new mysqli($host, $username, $password, $database);
// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
else {
    // echo "berhasil";
}
?>