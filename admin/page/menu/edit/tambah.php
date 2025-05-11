<?php
include '../config/connect.php'; // Include your database connection file

function uploadImage($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_FILES["file"]) && $_FILES["file"]["tmp_name"] != '') { // Check if file is uploaded and not empty
            $targetDir = "../../uploads/menu/";
            $targetFile = $targetDir . basename($_FILES["file"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            $nama = $_POST['nama'];
            $harga = $_POST['harga'];
            $kategori = $_POST['kategori'];
            
            // Periksa apakah file adalah gambar
            $check = getimagesize($_FILES["file"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
            // Periksa apakah file sudah ada, jika iya hapus file yang ada
            if (file_exists($targetFile)) {
                unlink($targetFile);
            }

            // Batasi format file
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            // Coba unggah file jika semua validasi berhasil
            if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
                echo "The file " . basename($_FILES["file"]["name"]) . " has been uploaded.";
                echo "<br><img src='$targetFile' alt='Uploaded Image'>";
                // Simpan nama file ke database
                global $conn;
                $filename = basename($_FILES["file"]["name"]);
                $sql = "INSERT INTO menu (nama, harga, kategori, gambar) VALUES ('$nama', $harga, '$kategori', '$filename')";
                if ($conn->query($sql) === TRUE) {
                    echo "Record updated successfully";
                    header("Location: page.php?mod=menu");
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
    } else {
        echo "Invalid request method.";
    }
}

uploadImage($conn); // Panggil fungsi dengan koneksi database sebagai argumen

$conn->close(); // Tutup koneksi database
?>
