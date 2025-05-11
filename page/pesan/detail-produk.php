<?php include '_component/header.php'; ?>
<?php include "../config/connect.php"; ?>

<div class="content">
    <div class="container background-content">
        <?php
    if (isset($_GET['id'])) {
        $id_menu = mysqli_real_escape_string($conn, $_GET['id']);

        $sql = "SELECT * FROM menu WHERE id_menu = $id_menu";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            ?>
        <div class="nav-scroller mb-4">
            <div class="container-fluid pt-2 pb-2">
                <a href="page.php?mod=home" class="btn btn-danger">Halaman Utama</a> > <a href="page.php?mod=pesan"
                    class="btn btn-danger">Menu</a> > <a href="#" class="btn btn-danger"><?php echo $row["nama"] ?></a>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-sm-12 col-lg-5">
                <img src="../uploads/menu/<?php echo $row["gambar"]?>" class="img-fluid">
            </div>
            <div class="col-sm-12 col-lg-7">
                <!-- copian di bawah -->
                <form action="page.php?mod=addToChart" method="POST">
                    <div class="card card-body shadow-sm">
                        <h4 class="text-website">
                            <?php echo $row["nama"] ?>
                        </h4>
                        <input class="invisible" type="text" name="id_menu" value="<?php echo $id_menu; ?>">
                        <h4 class="text-website">
                            Rp<?php echo $row["harga"] ?>
                        </h4>
                        <hr>
                        <p class="b text-muted">Kuantitas</p>
                        <div class="row">
                            <div class="col-sm-12 col-lg-4">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button type="button" class="input-group-text" id="decrement">-</button>
                                    </div>
                                    <input type="text" class="form-control" value="1" id="input-number" name="jumlah">
                                    <div class="input-group-append">
                                        <button type="button" class="input-group-text" id="increment">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script src="pesan/script.js"></script>
                        <div class="my-2">
                            <div class="row">
                                <div class="col-sm-12 col-lg-5">
                                    <?php
if ($login->isUserLoggedIn() == true) {
    echo '<input class="btn btn-danger" type="submit" name="insert" value="Masukkan ke keranjang"/>';
} else {
    echo '<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#alertLoginModal">
    Masukkan ke keranjang</button>';
}
?>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </form>
            </div>
        </div>
        <?php
                        }
                    } else {
                        echo "No data";
                    }
                ?>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="alertLoginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Peringatan Login</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Login atau Registrasi akun sebelum memesan makanan yawww!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="page.php?mod=login" class="btn btn-danger">Login/Register</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="pesan/addToChart.js"></script>
<?php include '_component/footer.php'; ?>