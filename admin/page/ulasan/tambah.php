<?php
// Include wrapper file
include __DIR__ . '/../_component/header.php';
include '../../config/connect.php';
?>

<!-- Aside -->
<body class="hold-transition light-mode sidebar-mini layout-fixed">
    <?php 
        // Include wrapper file
        $wrapper_file = '_component/wrapper.php';
        if (file_exists($wrapper_file)) {
            include $wrapper_file;
        } else {
            echo "Wrapper file not found.";
        }
    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Ulasan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/Website-Warmindo-Burjo-Bintang/admin/page/page.php?mod=dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Ulasan</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tambah Ulasan</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="reviewForm" action="page.php?mod=addUlasan" method="POST">
                    <div class="card-body">
                        <?php
                            $sql = "SELECT * FROM user";
                            $q = mysqli_query($conn, $sql);
                            $data = [];
                            while ($row = mysqli_fetch_array($q)) {
                                $data[] = $row;
                                        }
                                        ?>
                        <div class="form-group">
                            <label for="nama">User ID</label>
                            <select class="form-control" id="tentang" name="user_id" required>
                                <?php foreach ($data as $row): ?>
                                <option value="<?php echo $row['user_id']; ?>">
                                    <?php echo $row['user_id']; ?> - <?php echo $row['nama']; ?> - <?php echo $row['email']; ?> - <?php echo $row['no_hp']; ?>
                                </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tentang" class="form-label">Tentang:</label>
                            <select class="form-control" id="tentang" name="tentang" required>
                                <option value="Pelayanan">Pelayanan</option>
                                <option value="Makanan">Makanan</option>
                                <option value="Fasilitas">Fasilitas</option>
                                <option value="Harga">Harga</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pesan">Pesan</label>
                            <textarea class="form-control" id="summernote" placeholder="Pesan" name="pesan" required></textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
    </section>
    </div>
    <?php 
        include __DIR__ . '/../_component/footer.php';
    ?>