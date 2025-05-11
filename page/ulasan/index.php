<?php include '_component/header.php'; 
?>
<link rel="stylesheet" href=".../style.css">
<link rel="stylesheet" href="ulasan/style.css">

<?php
if ($login->isUserLoggedIn() == true) {
    $user_id = $_SESSION['user_id'];
}
?>
<div class="container">
    <h2 class="text-center lobster-regular">Berikan Ulasan</h2>
    <p class="text-center poppins-regular">Sampaikan kritik, saran, pertanyaan, bagi cerita / pengalaman Anda dengan
        Burjo Bintang. Masukan Anda sangat berarti untuk meningkatkan pelayanan kami.</p>
    <form id="reviewForm" action="page.php?mod=submitReview" method="POST">
        <input type="hidden" class="form-control" id="nama" name="user_id" value="<?php echo $user_id ?>">
        <div class="mb-3">
            <label for="tentang" class="form-label">Tentang:</label>
            <select class="form-select" id="tentang" name="tentang" required>
                <option value="Pelayanan">Pelayanan</option>
                <option value="Makanan">Makanan</option>
                <option value="Fasilitas">Fasilitas</option>
                <option value="Harga">Harga</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="pesan" class="form-label">Pesan:</label>
            <textarea class="form-control" id="pesan" name="pesan" rows="4" required></textarea>
        </div>
        <?php
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {
    $user_id = $_SESSION['user_id'];
    // the user is logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are logged in" view.
    echo '<button type="submit" class="btn btn-primary">Kirim</button>';
    echo '<a style="margin-left: 20px;" href="page.php?mod=get_review" class="btn btn-success">Lihat Ulasan lainnya</a>';
} else {
    // the user is not logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are not logged in" view.
    echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#alertLoginModal">
    Kirim</button>';
    echo '<a style="margin-left: 20px;" href="page.php?mod=get_review" class="btn btn-success">Lihat Ulasan lainnya</a>';
}

?>
    </form>
    <div class="modal fade" id="alertLoginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Peringatan Login</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Login atau Registrasi akun sebelum melakukan tindakan ini yaa!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="page.php?mod=login" class="btn btn-danger text-white">Login/Register</a>
            </div>
        </div>
    </div>
</div>
    <div id="reviews">
        <!-- Ulasan akan dimuat di sini oleh JavaScript -->
    </div>
</div>

<?php include '_component/footer.php'; ?>