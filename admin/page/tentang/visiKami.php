<?php include '_component/header.php';?>
<?php include '../../config/connect.php';?>

<?php
include '../../functions/sorting.php';
?>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <?php include '_component/wrapper.php'; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Visi Kami</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="page.php?mod=dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Visi Kami</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Image Visi</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0" style="height: 600px;">
                                        <table class="table table-head-fixed text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Gambar</th>
                                                    <th>Operasi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                        $sql = "SELECT * FROM img_tentang WHERE kategori = 'misi kami'";
                                                        $q = mysqli_query($conn, $sql);
                                                        $data = [];
                                                        while ($row = mysqli_fetch_array($q)) {
                                                            $data[] = $row;
                                                        }
                                                        foreach ($data as $row):
                                                        ?>
                                                <tr>
                                                    <td><img src="../../uploads/galeri/<?php echo $row['gambar'] ?>"
                                                            alt="..." style="width:300px; height: 300px;"></td>
                                                    <td>
                                                        <button type="button" class="btn btn-warning"
                                                            data-toggle="modal"
                                                            data-target="#editDataMenu<?= $row['id_img'] ?>"> Edit
                                                        </button>
                                                    </td>
                                                </tr>
                                                <!-- MODAL EDIT -->
                                                <div class="modal fade" id="editDataMenu<?= $row['id_img'] ?>" tabindex="-1" aria-labelledby="editDataMenu<?= $row['id_img'] ?>Label" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5"
                                                                    id="editDataMenu<?= $row['id_img'] ?>Label">
                                                                    Edit</h1>
                                                            </div>
                                                            <form method="POST"
                                                                action="page.php?mod=editImgTentangKami"
                                                                enctype="multipart/form-data">
                                                                <div class="modal-body">
                                                                    <input type="text" class="form-control" id="id"
                                                                        name="id" value="<?= $row['id_img'] ?>"
                                                                        hidden="true">
                                                                    <div class="mb-3">
                                                                        <label for="image"
                                                                            class="form-label">Gambar</label>
                                                                        <input type="file" name="file" class="form-control">
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
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                        <section class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <!-- left column -->
                                    <div class="col-md-10">
                                        <!-- general form elements -->
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h3 class="card-title">Misi Kami</h3>
                                            </div>
                                            <form method="POST" action="page.php?mod=editTeksTentangKami">
                                                <?php
                                                        $sql = "SELECT * FROM teks_tentang WHERE kategori = 'misi kami'";
                                                        $q = mysqli_query($conn, $sql);
                                                        $data = [];
                                                        while ($row = mysqli_fetch_array($q)) {
                                                            $data[] = $row;
                                                        }
                                                        foreach ($data as $row):
                                                        ?>
                                                <div class="card-body">
                                                    <input type="text" class="form-control" id="id" name="id"
                                                        value="<?= $row['id_tentang'] ?>" hidden="true">
                                                    <div class="form-group">
                                                        <label for="nama">Isi konten</label>
                                                        <textarea type="text" class="form-control" id="nama"
                                                            placeholder="Enter Username"
                                                            name="konten"><?php echo $row['teks'] ?></textarea>
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->
                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                                <?php endforeach ?>
                                            </form>
                                        </div>
                                        <!-- /.card -->
                                        <!--/.col (right) -->
                                    </div>
                                    <!-- /.row -->
                                </div><!-- /.container-fluid -->
                            </div>
                        </section>
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