<?php include '_component/header.php'; ?>
<?php include '../../config/connect.php'; ?>
<?php include '../../functions/sorting.php'; ?>

<body class="hold-transition sidebar-mini">
    <?php include '_component/wrapper.php'; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Carousel Utama</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="page.php?mod=dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Carousel Utama</li>
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
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahDataCarousel">
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
                                            <th class="w-auto"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM carousel";
                                        $q = mysqli_query($conn, $sql);
                                        $data = [];
                                        while ($row = mysqli_fetch_array($q)) {
                                            $data[] = $row;
                                        }
                                        foreach ($data as $row):
                                        ?>
                                        <tr>
                                            <td><img src="../../uploads/carousel/<?= $row['gambar'] ?>" width="100px"></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editDataMenu<?= $row['id_carousel'] ?>"> Edit </button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusDataMenu<?= $row['id_carousel'] ?>"> Hapus </button>
                                            </td>
                                        </tr>
                                        <!-- MODAL EDIT -->
                                        <div class="modal fade" id="editDataMenu<?= $row['id_carousel'] ?>" tabindex="-1" aria-labelledby="editDataMenu<?= $row['id_carousel'] ?>Label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="editDataMenu<?= $row['id_carousel'] ?>Label">Edit</h1>
                                                    </div>
                                                    <form method="POST" action="page.php?mod=updateCarouselUtama" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <input type="text" class="form-control" id="id" name="id" value="<?= $row['id_carousel'] ?>" hidden="true">
                                                            <div class="mb-3">
                                                                <label for="image" class="form-label">Gambar</label>
                                                                <input type="file" name="file">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- MODAL DELETE -->
                                        <div class="modal fade" id="hapusDataMenu<?= $row['id_carousel'] ?>" tabindex="-1" aria-labelledby="editDataMenu<?= $row['id_carousel'] ?>Label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="editDataMenu<?= $row['id_carousel'] ?>Label">Hapus</h1>
                                                    </div>
                                                    <form method="POST" action="page.php?mod=deleteCarouselMenu">
                                                        <div class="modal-body">
                                                            <input type="text" class="form-control" id="id" name="id" value="<?= $row['id_carousel'] ?>" hidden="true">
                                                            <div class="mb-3">
                                                                <h4>Konfirmasi hapus </h4>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
        <!-- Modal tambah -->
        <div class="modal fade" id="tambahDataCarousel" tabindex="-1" aria-labelledby="tambahDataMenuLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="tambahDataMenuLabel">Tambah Data</h1>
                    </div>
                    <form method="POST" action="page.php?mod=addCarouselUtama" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="image" class="form-label">Gambar</label>
                                <input type="file" name="file">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
        <!-- Tutup -->
        <?php include '_component/footer.php'; ?>
    
</body>

</html>
