<?php
session_start();
$user_id = $_SESSION['user_id'];
include '../config/connect.php';

function uploadImage($user_id) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $uploadOk = 1;
        $id_transaksi = $_POST['id_transaksi'];
        // Coba unggah file
        if ($uploadOk == 1) {

                // Simpan nama file ke database
                global $conn;
                $sql = "UPDATE keranjang SET status = 'batal' WHERE id_transaksi = $id_transaksi";
                $sqlTransaksi = "UPDATE transaksi SET status = 'batal' WHERE id_transaksi = $id_transaksi";
                if ($conn->query($sql) === TRUE) {
                    echo "Record updated successfully";
                    if ($conn->query($sqlTransaksi) === TRUE) {
                    echo "Record updated successfully";
                    header("Location: page.php?mod=menu");
                } else {
                    echo "Error updating record: " . $conn->error;
                }
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Sorry, your file was not uploaded.";
        }
    }

uploadImage($user_id);
echo "<br><a href='page.php?mod=pesan'>Kembali ke halaman utama</a>";

$conn->close();
?>