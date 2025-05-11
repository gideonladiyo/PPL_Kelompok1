<?php include '_component/header.php';?>
<?php include '../../config/connect.php';?>

<?php
include '../../functions/sorting.php';
?>

<body class="hold-transition sidebar-mini">
    <?php include '_component/wrapper.php'; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Menu</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="page.php?mod=dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Menu</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- HEADER -->
                            <div class="card-header">
                                <div class="row justify-content-between">
                                    <div class="col m-1">
                                        <div class="input-group">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#tambahDataMenu">
                                                Tambah Data
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="List" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="w-auto">Gambar</th>
                                            <th class="w-auto">Nama Menu</th>
                                            <th class="w-auto">Harga</th>
                                            <th class="w-auto">Kategori</th>
                                            <th class="w-auto"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM menu";
                                        $q = mysqli_query($conn, $sql);
                                        $data = [];
                                        while ($row = mysqli_fetch_array($q)) {
                                            $data[] = $row;
                                        }
                                        insertionSortDesc($data, "kategori");
                                        foreach ($data as $row):
                                        ?>
                                        <tr>
                                            <td><img src="../../uploads/menu/<?= $row['gambar'] ?>" width="100px"></td>
                                            <td><?= $row['nama'] ?></td>
                                            <td>Rp<?= $row['harga'] ?></td>
                                            <td><?= $row['kategori'] ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal"
                                                    data-target="#editDataMenu<?= $row['id_menu'] ?>">Edit
                                                </button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#hapusDataMenu<?= $row['id_menu'] ?>">
                                                    Hapus
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- Modal tambah -->
                                        <div class="modal fade" id="tambahDataMenu" tabindex="-1"
                                            aria-labelledby="tambahDataMenuLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="tambahDataMenuLabel">
                                                            Tambah Data
                                                        </h1>
                                                    </div>
                                                    <form method="POST" action="page.php?mod=addMenu"
                                                        enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="title" class="form-label">Nama menu</label>
                                                                <input type="text" class="form-control" id="title"
                                                                    name="nama" value="">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="title" class="form-label">Harga (Rp)</label>
                                                                <input type="text" class="form-control" id="title"
                                                                    name="harga" value="">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="title" class="form-label">Kategori</label>
                                                                <input type="text" class="form-control" id="title"
                                                                    name="kategori" value="">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="image" class="form-label">Gambar</label>
                                                                <input type="file" name="file">
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
                                        <!-- Tutup -->
                                        <!-- MODAL EDIT -->
                                        <div class="modal fade" id="editDataMenu<?= $row['id_menu'] ?>" tabindex="-1"
                                            aria-labelledby="editDataMenu<?= $row['id_menu'] ?>Label"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5"
                                                            id="editDataMenu<?= $row['id_menu'] ?>Label">
                                                            Edit <?= $row['nama'] ?>
                                                        </h1>
                                                    </div>
                                                    <form method="POST" action="page.php?mod=updateMenu"
                                                        enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <input type="text" class="form-control" id="id" name="id"
                                                                value="<?= $row['id_menu'] ?>" hidden="true">
                                                            <div class="mb-3">
                                                                <label for="title" class="form-label">Nama menu</label>
                                                                <input type="text" class="form-control" id="title"
                                                                    name="nama" value="<?= $row['nama'] ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="title" class="form-label">Harga (Rp)</label>
                                                                <input type="text" class="form-control" id="title"
                                                                    name="harga" value="<?= $row['harga'] ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="title" class="form-label">Kategori</label>
                                                                <input type="text" class="form-control" id="title"
                                                                    name="kategori" value="<?= $row['kategori'] ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="image" class="form-label">Gambar</label>
                                                                <input type="file" name="file">
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
                                        <div class="modal fade" id="hapusDataMenu<?= $row['id_menu'] ?>" tabindex="-1"
                                            aria-labelledby="editDataMenu<?= $row['id_menu'] ?>Label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5"
                                                            id="editDataMenu<?= $row['id_menu'] ?>Label">
                                                            Hapus <?= $row['nama'] ?>
                                                        </h1>
                                                    </div>
                                                    <form method="POST" action="page.php?mod=deleteMenu">
                                                        <div class="modal-body">
                                                            <input type="text" class="form-control" id="id" name="id"
                                                                value="<?= $row['id_menu'] ?>" hidden="true">
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
        <!-- /.content -->

        <?php include '_component/footer.php'; ?>
</body>

</html>