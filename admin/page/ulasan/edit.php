<?php
include '../config/connect.php'; // Include your database connection file

function uploadImage($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_id = $_POST['user_id'];
            $tentang = $_POST['tentang'];
            $pesan = $_POST['pesan'];
            $sql = "UPDATE reviews SET tentang = '$tentang', pesan = '$pesan' WHERE id = $user_id";
            if ($conn->query($sql) === TRUE) {
                        echo "Record updated successfully";
                        header("location:page.php?mod=crudUlasan");
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
