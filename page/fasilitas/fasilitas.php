<?php include '_component/header.php'; ?>
<?php include "../config/connect.php"; ?>
<!-- content home -->
<div class="content">
    <div class="container background-content">
        <!-- about -->
        <div class="about container row">
            <div class="col-md-6 isi-about">
                <div class="judul-about">
                    <h1 class="lobster-regular judul-about-1">Fasilitas Kami</h1>
                </div>
                <!-- Kolom untuk teks -->
                <div class="teks-about" style="padding-top: 20px; padding-bottom: 20px;">
                    <p class="poppins-regular teks-about-1" style="font-size: 20px; text-align: justify;">
                        Pelayanan yang ramah dan bersahabat merupakan fasilitas utama kami. Lokasi yang
                        nyaman dan nongkrongable akan memberikan kenyamanan makanmu sehari-hari. Senyum ramah kami
                        akan menghiasi harimu.
                        <br>
                        <br>
                        <span style="font-size: 24px; font-weight: bold; color: black;">Mari Makan Bersama Warmindo
                            Burjo Bintang⭐!!!</span>
                    </p>
                </div>
            </div>
            <!-- Kolom untuk gambar -->
            <div class="col-md-6 img-about">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-12">
                        <img src="../uploads/fasilitas/burjo.jpg" alt="Burjo Bintang" class="img-fluid rounded">
                    </div>
                </div>
            </div>
        </div>
        <!-- end about -->
        <br>
        <br>
        <!-- menu start -->
        <div class="menu-dashboard container">
            <div class="menu-dashboard-content">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php
                    $sql = "SELECT * FROM fasilitas";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Pastikan path gambar benar
                            $gambarPath = "../uploads/fasilitas/" . $row['gambar'];
                    ?>
                    <div class="col">
                        <div class="card h-100 card-custom">
                            <div class="card-img-container">
                                <!-- Gunakan path yang sudah disesuaikan -->
                                <img src="<?php echo $gambarPath; ?>" class="card-img-top img-fluid" alt="...">
                            </div>
                            <div class="card-body text-center">
                                <h5 class="card-title"><?php echo $row['nama']; ?></h5>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    } else {
                        echo "0 data";
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- menu end -->
    </div>
</div>
    <!-- end content -->
    <?php include '_component/footer.php'; ?>