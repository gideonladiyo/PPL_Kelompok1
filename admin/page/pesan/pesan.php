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
                m.nama AS nama_menu,
                m.harga,
                k.id_keranjang,
                k.user_id AS user_keranjang,
                k.jumlah,
                t.id_transaksi,
                t.bukti,
                t.tanggal,
                t.status AS status_transaksi
            FROM user u
            JOIN keranjang k ON u.user_id = k.user_id
            JOIN menu m ON k.id_menu = m.id_menu
            JOIN transaksi t ON k.id_transaksi = t.id_transaksi
            WHERE k.status = 'dibayar' AND t.status = 'pending'";
        $result = $conn->query($sql);
        if ($result === false) {
            die("Error: " . $conn->error);
        }
        // Mengelompokkan data berdasarkan user_id
        $orders = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $user_id = $row["user_id"];
                $id_transaksi = $row["id_transaksi"];
                if (!isset($orders[$user_id])) {
                    $orders[$user_id] = [];
                }
                if (!isset($orders[$user_id][$id_transaksi])) {
                    $orders[$user_id][$id_transaksi] = [
                        "nama" => $row["nama"],
                        "bukti" => $row["bukti"],
                        "tanggal" => $row["tanggal"],
                        "status_transaksi" => $row["status_transaksi"],
                        "pesanan" => [],
                        "total" => 0,
                        "id_keranjang" => []
                    ];
                }
                $orders[$user_id][$id_transaksi]["pesanan"][] = [
                    "nama_menu" => $row["nama_menu"],
                    "jumlah" => $row["jumlah"],
                    "harga" => $row["harga"]
                ];
                $orders[$user_id][$id_transaksi]["total"] += $row["harga"] * $row["jumlah"];
                $orders[$user_id][$id_transaksi]["id_keranjang"][] = $row["user_keranjang"];
            }
        }
        ?>

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Pesanan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Pesan</li>
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
                                <h3 class="card-title">Daftar pesanan</h3>
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
                                            <th>Daftar pesanan</th>
                                            <th>Total</th>
                                            <th>Bukti pembayaran</th>
                                            <th>Tanggal pesanan</th>
                                            <th>Status</th>
                                            <th>Operasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($orders)) {
                                            foreach ($orders as $user_id => $user_orders) {
                                                foreach ($user_orders as $id_transaksi => $order) {
                                                ?>
                                        <tr>
                                            <td><?php echo $id_transaksi; ?></td>
                                            <td><?php echo $order["nama"]; ?></td>
                                            <td>
                                                <?php
                                                        foreach ($order["pesanan"] as $pesanan) {
                                                            echo "- Menu: " . $pesanan['nama_menu'] . ", Jumlah: " . $pesanan['jumlah'] . "<br>";
                                                        }
                                                        ?>
                                            </td>
                                            <td><?php echo $order["total"]; ?></td>
                                            <td><img style="width: 300px; height: 300px;"
                                                    src="../../uploads/bukti_pembayaran/<?php echo $order["bukti"]; ?>"
                                                    alt=""></td>
                                            <td><?php echo $order["tanggal"]; ?></td>
                                            <td><span
                                                    class="tag tag-success"><?php echo $order["status_transaksi"]; ?></span>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#modalKonfirmasi<?php echo $id_transaksi; ?>"
                                                    data-user_id="<?php echo $user_id; ?>"
                                                    data-id_keranjang="<?php echo implode(",", $order["id_keranjang"]); ?>">
                                                    Konfirmasi
                                                </button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#modalTolak<?php echo $id_transaksi; ?>"
                                                    data-user_id="<?php echo $user_id; ?>"
                                                    data-id_keranjang="<?php echo implode(",", $order["id_keranjang"]); ?>">
                                                    Tolak
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- modal edit -->
                                        <div class="modal fade" id="modalKonfirmasi<?php echo $id_transaksi; ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi
                                                            Pembayaran</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body upload-form-container">
                                                        <form action="page.php?mod=updatePesanan" method="post">
                                                            <div class="modal-body">
                                                                <input class="form-control" type="hidden" name="id_transaksi" value="<?php echo $id_transaksi; ?>">
                                                                <label for="text" class="form-text">Apakah anda yakin untuk mengonfirmasi?</label>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger">KOnfirmasi</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="modalTolak<?php echo $id_transaksi; ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tolak
                                                            Pembayaran?</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body upload-form-container">
                                                        <form action="page.php?mod=reject-pesan" method="post">
                                                            <div class="modal-body">
                                                                <input class="form-control" type="hidden" name="id_transaksi" value="<?php echo $id_transaksi; ?>">
                                                                <label for="text" class="form-text">Apakah anda yakin untuk Menolak pesanan ini?</label>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger">Tolak</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                                }
                                            }
                                        } else {
                                            
                                        }
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
        <?php
        $sql = "
            SELECT 
                u.user_id,
                u.nama,
                m.nama AS nama_menu,
                m.harga,
                k.id_keranjang,
                k.user_id AS user_keranjang,
                k.jumlah,
                t.id_transaksi,
                t.bukti,
                t.tanggal,
                t.status AS status_transaksi
            FROM user u
            JOIN keranjang k ON u.user_id = k.user_id
            JOIN menu m ON k.id_menu = m.id_menu
            JOIN transaksi t ON k.id_transaksi = t.id_transaksi
            WHERE k.status = 'proses' AND t.status = 'konfirmasi'";
        $result = $conn->query($sql);
        if ($result === false) {
            die("Error: " . $conn->error);
        }
        // Mengelompokkan data berdasarkan user_id
        $orders = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $user_id = $row["user_id"];
                $id_transaksi = $row["id_transaksi"];
                if (!isset($orders[$user_id])) {
                    $orders[$user_id] = [];
                }
                if (!isset($orders[$user_id][$id_transaksi])) {
                    $orders[$user_id][$id_transaksi] = [
                        "nama" => $row["nama"],
                        "bukti" => $row["bukti"],
                        "tanggal" => $row["tanggal"],
                        "status_transaksi" => $row["status_transaksi"],
                        "pesanan" => [],
                        "total" => 0,
                        "id_keranjang" => []
                    ];
                }
                $orders[$user_id][$id_transaksi]["pesanan"][] = [
                    "nama_menu" => $row["nama_menu"],
                    "jumlah" => $row["jumlah"],
                    "harga" => $row["harga"]
                ];
                $orders[$user_id][$id_transaksi]["total"] += $row["harga"] * $row["jumlah"];
                $orders[$user_id][$id_transaksi]["id_keranjang"][] = $row["user_keranjang"];
            }
        }
        ?>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Daftar pesanan</h3>
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
                                            <th>Daftar pesanan</th>
                                            <th>Total</th>
                                            <th>Bukti pembayaran</th>
                                            <th>Tanggal pesanan</th>
                                            <th>Status</th>
                                            <th>Operasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($orders)) {
                                            foreach ($orders as $user_id => $user_orders) {
                                                foreach ($user_orders as $id_transaksi => $order) {
                                                ?>
                                        <tr>
                                            <td><?php echo $user_id; ?></td>
                                            <td><?php echo $order["nama"]; ?></td>
                                            <td>
                                                <?php
                                                        foreach ($order["pesanan"] as $pesanan) {
                                                            echo "- Menu: " . $pesanan['nama_menu'] . ", Jumlah: " . $pesanan['jumlah'] . "<br>";
                                                        }
                                                        ?>
                                            </td>
                                            <td><?php echo $order["total"]; ?></td>
                                            <td><img style="width: 300px; height: 300px;"
                                                    src="../../uploads/bukti_pembayaran/<?php echo $order["bukti"]; ?>"
                                                    alt=""></td>
                                            <td><?php echo $order["tanggal"]; ?></td>
                                            <td><span
                                                    class="tag tag-success"><?php echo $order["status_transaksi"]; ?></span>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-success" data-toggle="modal"
                                                    data-target="#modalSelesai<?php echo $id_transaksi; ?>"
                                                    data-user_id="<?php echo $user_id; ?>"
                                                    data-id_keranjang="<?php echo implode(",", $order["id_keranjang"]); ?>">
                                                    Selesai
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- modal edit -->
                                        <div class="modal fade" id="modalSelesai<?php echo $id_transaksi; ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi
                                                            Pembayaran</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body upload-form-container">
                                                        <form action="page.php?mod=updateSelesai" method="post">
                                                            <div class="modal-body">
                                                                <input class="form-control" type="" name="id_transaksi" value="<?php echo $id_transaksi; ?>">
                                                                <label for="text" class="form-text">Apakah anda yakin untuk mengonfirmasi?</label>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                                }
                                            }
                                        } else {
                                            
                                        }
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

    <!-- Modal Konfirmasi -->
    <div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Pembayaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body upload-form-container">
                    <form action="page.php?mod=upload" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="file" name="file">
                            <?php foreach($array_keranjang   as $id): ?>
                            <input type="" name="ids[]" value="<?php echo $id; ?>">
                            <?php endforeach; ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include '_component/footer.php'; ?>