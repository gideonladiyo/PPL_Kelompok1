<?php
include "../config/connect.php";
// Koneksi ke database (gantikan dengan koneksi sesuai dengan informasi database Anda)


// Fungsi untuk menghapus ulasan
if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM reviews WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        // Redirect kembali ke halaman utama setelah berhasil menghapus
        header("Location: page.php?mod=get_review");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Ambil ulasan dari database
$sql = "SELECT u.user_id,
u.nama,
u.email,
u.no_hp,
r.id,
r.tentang,
r.pesan,
r.tanggal
FROM reviews r JOIN user u WHERE r.user_id = u.user_id;";
$result = $conn->query($sql);

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
<?php include '_component/header.php'; 
if ($login->isUserLoggedIn() == true) {
    $user_id = $_SESSION['user_id'];
}?>
<style>
.container.get_review {
    flex: 1;
    width: 65%;
    margin: 120px auto 20px auto;
    /* Adds top margin to avoid overlapping with header */
    padding: 25px;
    background-color: #FFF176;
    /* Sama dengan warna container lainnya */
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

.review {
    border-bottom: 1px solid #000000;
    padding: 20px;
    background-color: white;
    margin: 20px 0px 20px 0px;
    border-radius: 10px;
}

.profile {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.profile img {
    border-radius: 50%;
    margin-right: 10px;
}

.profile-info {
    font-size: 14px;
}

.profile-info .name {
    font-weight: bold;
}

.message {
    font-size: 16px;
    margin-top: 5px;
}
</style>
<div class="container get_review">
    <h2 class="text-center">Ulasan</h2>
    <?php foreach ($reviews as $review): ?>
    <div class="review">
        <div class="profile">
            <div class="profile-info">
                <div class="name"><?php echo htmlspecialchars($review['nama']); ?></div>
                <div class="email"><?php echo htmlspecialchars($review['email']); ?></div>
            </div>
        </div>
        <div class="message">
            <p><?php echo $review['pesan']; ?></p>
        </div>
        <div class="btn-container">
            <?php if ($login->isUserLoggedIn() == true) {
                $user_id = $_SESSION['user_id'];
                if($review['user_id'] == $user_id){
                        ?>
                <button type="submit" class="btn btn-primary"
                onclick="location.href='page.php?mod=get_review&action=delete&id=<?php echo $review['id']; ?>'">delete</button>
                <?php
                }
            } 
            ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<script>
function confirmDelete(reviewId) {
    if (confirm('Apakah Anda yakin ingin menghapus ulasan ini?')) {
        window.location.href = '?mod=get_review&action=delete&id=' + reviewId;
    }
}
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php include '_component/footer.php'; ?>