<?php
// Koneksi ke database (gantikan dengan koneksi sesuai dengan informasi database Anda)
include "../config/connect.php";

// Periksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $user_id = $_POST['user_id'];
    $tentang = $_POST['tentang'];
    $pesan = $_POST['pesan'];

    $sql = "INSERT INTO reviews (user_id, tentang, pesan) VALUES ('$user_id', '$tentang', '$pesan')";
    if ($conn->query($sql) === TRUE) {
        header('Location: page.php?mod=get_review');
        exit();
    } else {
        // Kode akan ke branch sini
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

<?php
// Koneksi ke database (gantikan dengan koneksi sesuai dengan informasi database Anda)


// Fungsi untuk menghapus ulasan
if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM reviews WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        // Jalur kode akan ke branch sini
        header("Location: {$_SERVER['PHP_SELF']}"); 
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Ambil ulasan dari database
$sql = "SELECT * FROM reviews ORDER BY tanggal DESC";
$result = $conn->query($sql);

// Periksa apakah query berhasil
if (!$result) {
    die("Error dalam eksekusi query: " . $conn->error);
}

// Buat array untuk menyimpan hasil
$reviews = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ulasan Pengguna</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <?php include '../_component/header.php'; ?>
    <div class="container get_review">
        <h2 class="text-center">Ulasan</h2>
        <?php foreach ($reviews as $review): ?>
        <div class="review">
            <div class="profile">
                <img src="https://via.placeholder.com/50" alt="Profile Picture">
                <div class="profile-info">
                    <div class="name"><?php echo htmlspecialchars($review['nama']); ?></div>
                    <div class="email"><?php echo htmlspecialchars($review['email']); ?></div>
                </div>
            </div>
            <div class="message">
                <?php echo nl2br(htmlspecialchars($review['pesan'])); ?>
            </div>
            <div class="btn-container">
                <a href="edit_review.php?id=<?php echo $review['id']; ?>" class="btn btn-edit">Edit</a>
                <a href="?action=delete&id=<?php echo $review['id']; ?>" class="btn btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus ulasan ini?')">Delete</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php include '../_component/footer.php'; ?>
</body>
</html>
