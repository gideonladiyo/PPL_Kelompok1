<?php
// Menangkap data yang dikirimkan melalui formulir
$nama = $_POST['nama'];
$email = $_POST['email'];
$telepon = $_POST['telepon'];
$tentang = $_POST['tentang'];
$pesan = $_POST['pesan'];

// Simpan data ulasan ke database atau file, disini kita hanya mencetaknya sebagai contoh
echo "Ulasan berhasil ditambahkan dari $nama ($email): $pesan";
?>
