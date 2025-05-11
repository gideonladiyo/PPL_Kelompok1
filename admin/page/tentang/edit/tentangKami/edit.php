<?php
include '../config/connect.php'; // Include your database connection file

function uploadImage($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Jika tidak ada file yang diunggah, hanya update data tanpa gambar
            $id = $_POST['id'];
            $konten = $_POST['konten'];
            $sql = "UPDATE teks_tentang SET teks = '$konten' WHERE id_tentang = $id";
            if ($conn->query($sql) === TRUE) {
                echo "Record updated successfully";
                header("location:page.php?mod=tentangKami");
            } else {
                echo "Error updating record: " . $conn->error;
            }
    } else {
        echo "Invalid request method.";
    }
}

uploadImage($conn); // Panggil fungsi dengan koneksi database sebagai argumen

$conn->close(); // Tutup koneksi database
?>
