<?php include '_component/header.php'; ?>
<?php include "../config/connect.php"; ?>
<?php
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {
} else {
    // the user is not logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are not logged in" view.
    header("location:page.php?mod=menu");
}
?>
<?php
$user_id = $_SESSION['user_id'];
include "../functions/sorting.php";
?>
<div class="content">
    <div class="container background-content">
        <div class="list-group shadow-sm mb-4">
            <div class="list-group-item bg-light text-website b">
                <div class="row">
                    <div class="col-sm-12 col-lg-1">
                    </div>
                    <div class="col-sm-12 col-lg-4">
                        Produk
                    </div>
                    <div class="col-sm-12 col-lg-3">
                        Harga Satuan
                    </div>
                    <div class="col-sm-12 col-lg-2">
                        Kuantitas
                    </div>
                    <div class="col-sm-12 col-lg-2">
                        Aksi
                    </div>
                </div>
            </div>
            <?php 
				$sql = "SELECT 
            k.id_keranjang,
            k.id_menu,
            k.user_id,
            k.jumlah,
            k.status,
            m.nama,
            m.harga,
            m.kategori,
            m.gambar
        FROM 
            keranjang k
        JOIN 
            menu m
        ON 
            k.id_menu = m.id_menu
        WHERE 
            k.user_id =" . $user_id . " AND k.status = 'pending'";
$result = $conn->query($sql);
$datas = [];
if (mysqli_num_rows($result)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $datas[] = $row;
    }
    // Urutkan makanan dengan insertion sort
    selectionSort($datas, "kategori");
} else {
    echo "No data";
}
$array_harga = [];
$array_pesanan = [];
$number = 1;
$total_array = 0;
foreach ($datas as $row):
        $id_keranjang = $row["id_keranjang"];
		$harga = $row['harga'];
		$jumlah = $row['jumlah'];
		$total_harga = $jumlah * $harga;
        $array_harga[] = $total_harga;
		$array_pesanan[] = $id_keranjang
				?>
            <div class="list-group-item">
                <div class="row my-4">
                    <div class="col-sm-12 col-lg-1 mb-3">
                        <!-- <input type="checkbox" name="pilih"> -->
                        <p><?php echo $number; 
							$number = $number + 1;
						?>
                        </p>
                    </div>
                    <div class="col-sm-12 col-lg-4 mb-3">
                        <a href="" class="hvnb">
                            <div class="media">
                                <img src="../uploads/menu/<?php echo $row["gambar"]?>" width="100" class="mr-3">
                                <div class="media-body text-dark">
                                    <?php echo $row["nama"]?>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-12 col-lg-3 mb-3">
                        <h4 class="text-website">Rp<?php echo $total_harga ?></h4>
                    </div>
                    <div class="col-sm-12 col-lg-2 mb-3">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="input-group mb-3">
                                    <p><?php echo $jumlah ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-2 mb-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#editDataModal<?php echo $id_keranjang; ?>">
                            Edit
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#hapusDataModal<?php echo $id_keranjang; ?>">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
            <!-- modal -->
            <!-- hapus data -->
            <div class="modal fade" id="hapusDataModal<?php echo $id_keranjang; ?>" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus pesanan?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?php echo $id_keranjang ?>
                            Apakah anda ingin menghapus pesanan ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a href="pesan/pesanan/hapus.php?id=<?= $id_keranjang ?>" class="btn btn-danger">Hapus</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- edit data -->
            <div class="modal fade" id="editDataModal<?php echo $id_keranjang; ?>" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Jumlah Pesanan</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="pesan/pesanan/edit.php">
                            <div class="modal-body">
                                <input type="hidden" name="id_keranjang" value="<?= $id_keranjang ?>">
                                <div class="form-group">
                                    <label for="number">Jumlah</label>
                                    <input required type="number" class="form-control" id="number" name="jumlah"
                                        value="<?= $jumlah ?>">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
				$total_array = array_sum($array_harga);
			?>
            <?php endforeach ?>
            <div class="list-group-item">
                <div class="row my-4">
                    <a href="page.php?mod=tambah-pesanan" class="btn btn-primary">Tambah Pesanan</a>
                </div>
            </div>
        </div>
        <div class="card card-body shadow-sm">
            <div class="row" style="justify-content: space-between;">
                <div class="col-sm-12 col-lg-3">
                    <h5><span class="text-muted">Total Pesanan:</span> <span
                            class="text-website">Rp<?php echo $total_array ?></span></h5>
                </div>
                <div class="col-sm-12 col-lg-3">
                    <div class="modal-body">
                        <?php
										$number = 1;
										$array_keranjang = [];
                                        $length_keranjang = 0;
										foreach($datas as $row):
                                            $length_keranjang++;
											$number++;
										endforeach;
											echo "Total: Rp" . $total_array;
										?>
                        <?php 
                                        if ($length_keranjang > 0){
                                            ?>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#checkoutModal">Checkout</button>
                        <?php
                                        } else {
                                            ?>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#alertKeranjangModal">
                            Checkout
                        </button>
                        <?php
                                        }
                                        ?>
                        <!-- modal update status -->
                        <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Pesanan</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="pesan/pesanan/editStatus.php">
                                        <div class="modal-body">
                                            <?php
										$number = 1;
										$array_keranjang = [];
										foreach($datas as $row):
											$array_keranjang[] = $row['id_keranjang'];
											$total_harga = $row['jumlah'] * $row['harga'];
											echo "Pesanan ". $number;
											echo "<li>" . $row['nama'] . "</li>";
											echo "<li>" . $row['jumlah'] . "</li>";
											echo "<li>Rp" . $total_harga . "</li>";
											echo "<br>";
											$number++;
										endforeach;
											echo "Total: Rp" . $total_array;
										?>
                                            <?php foreach($array_pesanan as $id): ?>
                                            <input type="hidden" name="ids[]" value="<?php echo $id; ?>">
                                            <?php endforeach; ?>
                                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="alertKeranjangModal" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                            Keranjang kosong:(</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Anda belum memesan menu sama sekali!
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <a href="page.php?mod=menu" class="btn btn-danger">Pesan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="pesan/script.js"></script>

<?php include '_component/footer.php'; ?>