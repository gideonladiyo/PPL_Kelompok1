<?php
// Cek apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start(); // Memulai session
    
    // Lakukan operasi pengecekan login di database
    require_once('config/connect.php');
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Query untuk memeriksa kecocokan email dan password di tabel pengguna
    // Buat query untuk mengecek apakah terdapat user dengan email X dan password Y, jika ya maka login berhasil
    $query = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        // Login berhasil, simpan data pengguna ke dalam session
        $user = $result->fetch_assoc();
        
        // Ubah X, Y, Z dengan session agar menyimpan data yang tadi berhasil login kedalam session
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
        header("Location: page/page.php?mod=dashboard");
        exit();
    } else {
        echo "Login gagal. Silakan cek kembali email dan password Anda.";
    }
    
    // Tutup koneksi database
    $conn->close();
}
?>
