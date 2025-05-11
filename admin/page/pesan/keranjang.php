<?php include '_component/header.php'; ?>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <?php include '_component/wrapper.php'; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <?php
        include '../../config/connect.php';
        $sql = "
            SELECT 
                u.user_id, 
                u.nama, 
                k.id_keranjang, 
                k.id_menu, 
                k.jumlah,
                k.status, 
                m.nama AS nama_menu
            FROM user u
            JOIN keranjang k ON u.user_id = k.user_id
            JOIN menu m ON k.id_menu = m.id_menu";
        $q = mysqli_query($conn, $sql);
                                        $data = [];
                                        while ($row = mysqli_fetch_array($q)) {
                                            $data[] = $row;
                                        }
    ?>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Keranjang</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Keranjang</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Keranjang</h3>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right"
                                            placeholder="Search">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0" style="height: 600px;">
                                <table class="table table-head-fixed text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>Nama</th>
                                            <th>Menu</th>
                                            <th>Jumlah</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($data as $row):
                                                ?>
                                        <tr>
                                            <td><?php echo $row['user_id']; ?></td>
                                            <td><?php echo $row['nama']; ?></td>
                                            <td>
                                                <?php echo $row['nama_menu']; ?>
                                            </td>
                                            <td><?php echo $row['jumlah']; ?></td>
                                            <td><?php echo $row['status']; ?></td>
                                        </tr>
                                        <?php
                                        endforeach
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php include '_component/footer.php'; ?>