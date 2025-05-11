<?php
include '../config/connect.php'; // Include your database connection file

function uploadImage($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_FILES["file"]) && $_FILES["file"]["tmp_name"] != '') { 
            $targetDir = "../../uploads/fasilitas/";
            $targetFile = $targetDir . basename($_FILES["file"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            $id = $_POST['id'];
            $alamat = $_POST['nama'];
            $status = $_POST['status'];
            
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
                    // Update data ke database
                    $filename = basename($_FILES["file"]["name"]);
                    $sql = "UPDATE kontak SET gambar = '$filename', alamat = '$alamat', status = '$status' WHERE id_kontak = $id";
                    if ($conn->query($sql) === TRUE) {
                        echo "Record updated successfully";
                        header("location:page.php?mod=kontak");
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            } else {
                echo "Sorry, your file was not uploaded.";
            }
        } else {
            // Jika tidak ada file yang diunggah, hanya update data tanpa gambar
            $id = $_POST['id'];
            $alamat = $_POST['nama'];
            $status = $_POST['status'];
            $sql = "UPDATE kontak SET alamat = '$alamat', status = '$status' WHERE id_kontak = $id";
            if ($conn->query($sql) === TRUE) {
                echo "Record updated successfully";
                header("location:page.php?mod=kontak");
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
    } else {
        echo "Invalid request method.";
    }
}

uploadImage($conn); // Panggil fungsi dengan koneksi database sebagai argumen

$conn->close(); // Tutup koneksi database
?>
