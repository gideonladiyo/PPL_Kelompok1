<?php
session_start();
$user_id = $_SESSION['user_id'];
include '../config/connect.php';

function uploadImage($user_id) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
        echo $user_id;
        $targetDir = "../uploads/bukti_pembayaran/";
        $targetFile = $targetDir . basename($_FILES["file"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $id_transaksi = $_POST['id_transaksi'];
        echo $id_transaksi;

        // Periksa apakah file adalah gambar
        $check = getimagesize($_FILES["file"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        // Periksa apakah file sudah ada
        if (file_exists($targetFile)) {
            // Menghapus file yang ada jika file baru diunggah
            unlink($targetFile);
        }
        // Batasi format file
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Coba unggah file
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
                echo "The file " . basename($_FILES["file"]["name"]) . " has been uploaded.";
                echo "<br><img src='$targetFile' alt='Uploaded Image'>";
                // Simpan nama file ke database
                global $conn;
                $filename = basename($_FILES["file"]["name"]);
                $sql = "UPDATE transaksi SET bukti = '$filename', status = 'pending' WHERE id_transaksi = $id_transaksi";
                if ($conn->query($sql) === TRUE) {
                    echo "Record updated successfully";
                    if (isset($_POST['ids']) && !empty($_POST['ids'])) {
                        $ids = $_POST['ids'];
                        $ids_string = implode(',', $ids);
                        $sql = "UPDATE keranjang SET status = 'dibayar' WHERE id_keranjang IN ($ids_string) AND id_transaksi = $id_transaksi";
                        if ($conn->query($sql) === TRUE) {
                            echo "Record updated successfully";
                            header("Location: page.php?mod=menu");
                        } else {
                            echo "Error updating record: " . $conn->error;
                        }
                    } else {
                        echo "No items selected";
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
}
uploadImage($user_id);
echo "<br><a href='page.php?mod=pesan'>Kembali ke halaman utama</a>";

$conn->close();
?>