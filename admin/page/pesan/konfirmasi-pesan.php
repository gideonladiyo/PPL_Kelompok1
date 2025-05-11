<?php include '_component/header.php'; ?>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <?php include '_component/wrapper.php'; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <?php
        include '../config/connect.php';
        $sql = "
            SELECT 
                u.user_id, 
                u.nama, 
                k.id_keranjang, 
                k.id_menu, 
                k.jumlah, 
                m.nama AS nama_menu,
                m.harga, 
                t.bukti, 
                t.tanggal, 
                t.status AS status_transaksi
            FROM user u
            JOIN keranjang k ON u.user_id = k.user_id
            JOIN menu m ON k.id_menu = m.id_menu
            JOIN transaksi t ON u.user_id = t.user_id
            WHERE k.status = 'selesai' AND t.status = 'selesai'";
        $result = $conn->query($sql);
        if ($result === false) {
            die("Error: " . $conn->error);
        }
        // Mengelompokkan data berdasarkan user_id
        $orders = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $user_id = $row["user_id"];
                if (!isset($orders[$user_id])) {
                    $orders[$user_id] = [
                        "nama" => $row["nama"],
                        "bukti" => $row["bukti"],
                        "tanggal" => $row["tanggal"],
                        "status_transaksi" => $row["status_transaksi"],
                        "pesanan" => [],
                        "total" => 0,
                        "id_keranjang" => []
                    ];
                }
                $orders[$user_id]["pesanan"][] = [
                    "nama_menu" => $row["nama_menu"],
                    "jumlah" => $row["jumlah"]
                ];
                $orders[$user_id]["total"] += $row["harga"] * $row["jumlah"];
                $orders[$user_id]["id_keranjang"][] = $row["id_keranjang"];
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
                                <h3 class="card-title">Pesanan Selesai</h3>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($orders)) {
                                            foreach ($orders as $user_id => $order) {
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
                                        </tr>
                                        <?php
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
    <div class="content-wrapper">
        <!-- Main content -->
        <?php
        $sql = "
            SELECT 
                u.user_id, 
                u.nama, 
                k.id_keranjang, 
                k.id_menu, 
                k.jumlah, 
                m.nama AS nama_menu,
                m.harga, 
                t.bukti, 
                t.tanggal, 
                t.status AS status_transaksi
            FROM user u
            JOIN keranjang k ON u.user_id = k.user_id
            JOIN menu m ON k.id_menu = m.id_menu
            JOIN transaksi t ON u.user_id = t.user_id
            WHERE k.status = 'ditolak' AND t.status = 'ditolak'";
        $result = $conn->query($sql);
        if ($result === false) {
            die("Error: " . $conn->error);
        }
        // Mengelompokkan data berdasarkan user_id
        $orders = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $user_id = $row["user_id"];
                if (!isset($orders[$user_id])) {
                    $orders[$user_id] = [
                        "nama" => $row["nama"],
                        "bukti" => $row["bukti"],
                        "tanggal" => $row["tanggal"],
                        "status_transaksi" => $row["status_transaksi"],
                        "pesanan" => [],
                        "total" => 0,
                        "id_keranjang" => []
                    ];
                }
                $orders[$user_id]["pesanan"][] = [
                    "nama_menu" => $row["nama_menu"],
                    "jumlah" => $row["jumlah"]
                ];
                $orders[$user_id]["total"] += $row["harga"] * $row["jumlah"];
                $orders[$user_id]["id_keranjang"][] = $row["id_keranjang"];
            }
        }
    ?>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Pesanan Dibatalkan</h3>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($orders)) {
                                            foreach ($orders as $user_id => $order) {
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
                                        </tr>
                                        <?php
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

    <?php include '_component/footer.php'; ?>