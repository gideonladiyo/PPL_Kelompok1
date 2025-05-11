<?php include '_component/header.php'; ?>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <?php include '_component/wrapper.php'; ?>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data User</li>
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
                        <div class="card-header">
                            <!-- <h3 class="card-title">DataTable with minimal features & hover style</h3> -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Email</th>
                                        <th>Nama</th>
                                        <th>No. Whatapps</th>
                                        <th>Password</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../config/connect.php';
                                    // using SQL query to display user data
                                    $query = "SELECT * FROM user";
                                    $datas = $conn->query($query);
                                    foreach ($datas as $data):
                                        ?>
                                    <tr>
                                        <td><?= $data['email'] ?></td>
                                        <td><?= $data['nama'] ?></td>
                                        <td><?= $data['no_hp'] ?></td>
                                        <td><?= $data['password'] ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm">Edit</button>
                                            <button type="button" class="btn btn-danger btn-sm">Hapus</button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
    </section>
    <!-- /.content -->
</div>

    <?php include '_component/footer.php'; ?>