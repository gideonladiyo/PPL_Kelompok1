<?php
// Define the paths to the files
include __DIR__ . '/../_component/header.php';
include '../../config/connect.php';

$sql = "SELECT u.user_id,
u.nama,
u.email,
u.no_hp,
r.id,
r.tentang,
r.pesan,
r.tanggal
FROM reviews r JOIN user u WHERE r.user_id = u.user_id;";
$q = mysqli_query($conn, $sql);
$data = [];
while ($row = mysqli_fetch_array($q)) {
    $data[] = $row;
}
?>

<body class="hold-transition light-mode sidebar-mini layout-fixed">
    <?php 
    include __DIR__ . '/../_component/wrapper.php';
    ?>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Ulasan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="/Website-Warmindo-Burjo-Bintang/admin/page/page.php?mod=dashboard">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Ulasan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- HEADER -->
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="List" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="w-auto">User ID</th>
                                            <th class="w-auto">Nama</th>
                                            <th class="w-auto">Email</th>
                                            <th class="w-auto">Nomor HP</th>
                                            <th class="w-auto">Tentang</th>
                                            <th class="w-auto">Pesan</th>
                                            <th class="w-auto">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT u.user_id,
u.nama,
u.email,
u.no_hp,
r.id,
r.tentang,
r.pesan,
r.tanggal
FROM reviews r JOIN user u WHERE r.user_id = u.user_id;";
                                        $q = mysqli_query($conn, $sql);
                                        $data = [];
                                        while ($row = mysqli_fetch_array($q)) {
                                            $data[] = $row;
                                        }
                                        foreach ($data as $row):
                                        ?>
                                        <tr>
                                            <td><?= $row['user_id'] ?></td>
                                            <td><?= $row['nama'] ?></td>
                                            <td><?= $row['email'] ?></td>
                                            <td><?= $row['no_hp'] ?></td>
                                            <td><?= $row['tentang'] ?></td>
                                            <td><?= $row['pesan'] ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal"
                                                    data-target="#editDataMenu<?= $row['id'] ?>">Edit
                                                </button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#hapusDataMenu<?= $row['id'] ?>">
                                                    Hapus
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- Modal tambah -->
                                        <!-- Tutup -->
                                        <!-- MODAL EDIT -->
                                        <div class="modal fade" id="editDataMenu<?= $row['id'] ?>" tabindex="-1"
                                            aria-labelledby="editDataMenu<?= $row['user_id'] ?>Label"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5"
                                                            id="editDataMenu<?= $row['user_id'] ?>Label">
                                                            Edit <?= $row['nama'] ?>
                                                        </h1>
                                                    </div>
                                                    <form method="POST" action="page.php?mod=updateUlasan"
                                                        enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <input type="text" class="form-control" id="id"
                                                                name="user_id" value="<?= $row['id'] ?>"
                                                                hidden="true">
                                                            <div class="mb-3">
                                                                <label for="title" class="form-label">Tentang</label>
                                                                <select class="form-control" id="tentang" name="tentang"
                                                                    required>
                                                                    <option value="Pelayanan">Pelayanan</option>
                                                                    <option value="Makanan">Makanan</option>
                                                                    <option value="Fasilitas">Fasilitas</option>
                                                                    <option value="Harga">Harga</option>
                                                                    <option value="Lainnya">Lainnya</option>
                                                                    <?php
                                                                    if ($row['tentang'] == "Pelayanan") {
                                                                        echo '<option value="Pelayanan" selected>Pelayanan</option>
                                                                    <option value="Makanan">Makanan</option>
                                                                    <option value="Fasilitas">Fasilitas</option>
                                                                    <option value="Harga">Harga</option>
                                                                    <option value="Lainnya">Lainnya</option>';
                                                                    } elseif($row['tentang'] == "Makanan")  {
                                                                        echo '<option value="Pelayanan">Pelayanan</option>
                                                                    <option value="Makanan" selected>Makanan</option>
                                                                    <option value="Fasilitas">Fasilitas</option>
                                                                    <option value="Harga">Harga</option>
                                                                    <option value="Lainnya">Lainnya</option>';
                                                                    } elseif($row['tentang'] == "Fasilitas")  {
                                                                        echo '<option value="Pelayanan">Pelayanan</option>
                                                                    <option value="Makanan">Makanan</option>
                                                                    <option value="Fasilitas" selected>Fasilitas</option>
                                                                    <option value="Harga">Harga</option>
                                                                    <option value="Lainnya">Lainnya</option>';
                                                                    } elseif($row['tentang'] == "Harga")  {
                                                                        echo '<option value="Pelayanan">Pelayanan</option>
                                                                    <option value="Makanan">Makanan</option>
                                                                    <option value="Fasilitas">Fasilitas</option>
                                                                    <option value="Harga" selected>Harga</option>
                                                                    <option value="Lainnya">Lainnya</option>';
                                                                    } elseif($row['tentang'] == "Lainnya")  {
                                                                        echo '<option value="Pelayanan">Pelayanan</option>
                                                                    <option value="Makanan">Makanan</option>
                                                                    <option value="Fasilitas">Fasilitas</option>
                                                                    <option value="Harga">Harga</option>
                                                                    <option value="Lainnya" selected>Lainnya</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="title" class="form-label">Pesan</label>
                                                                <textarea class="form-control" name="pesan" id=""><?php echo $row['pesan']; ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- MODAL DELETE -->
                                        <div class="modal fade" id="hapusDataMenu<?= $row['id'] ?>" tabindex="-1"
                                            aria-labelledby="editDataMenu<?= $row['id'] ?>Label"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5"
                                                            id="editDataMenu<?= $row['id'] ?>Label">
                                                            Hapus
                                                        </h1>
                                                    </div>
                                                    <form method="POST" action="page.php?mod=deleteUlasan">
                                                        <div class="modal-body">
                                                            <input type="text" class="form-control" id="id" name="id"
                                                                value="<?= $row['id'] ?>" hidden="true">
                                                            <div class="mb-3">
                                                                <h4>Konfirmasi hapus </h4>
                                                            </div>
                                                        </div>

                                                        <div class=" modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Hapus</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
    </div>
    <?php 
    include __DIR__ . '/../_component/footer.php';
    ?>