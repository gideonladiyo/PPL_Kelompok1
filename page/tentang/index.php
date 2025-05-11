<?php include '_component/header.php'; ?>
<?php include "../config/connect.php"; ?>
<?php
$userName = isset($_SESSION['nama']) ? $_SESSION['nama'] : null;
include "../functions/sorting.php";
?>
<!-- carousel -->
<!-- carousel end -->
<style>
.content {
    margin-top: 120px;
}

.judul-about1 {
    margin-left: 39px;
}

.row-about {
    display: flex;
    justify-content: center;
}

.text-about {
    padding-top: 20px;
    padding-bottom: 20px;
    padding-left: 40px;
}

@media (max-width: 992px) {
    .text-about {
        padding-top: 0px;
        padding-bottom: 0px;
        padding-left: 20px;
    }
}
</style>
<!-- content home -->
<div class="content">
    <div class="container background-content">
        <!-- about -->
        <div class="about container row">
            <div class="col-md-6 img-about">
                <?php
                                                        $sql = "SELECT * FROM img_tentang WHERE kategori = 'tentang kami'";
                                                        $q = mysqli_query($conn, $sql);
                                                        $data = [];
                                                        while ($row = mysqli_fetch_array($q)) {
                                                            $data[] = $row;
                                                        }
                                                        ?>
                <div class="row">
                    <?php
                    $number = 0;
                    foreach ($data as $row):
                        ?>
                    <div class="item-about col-md-6">
                        <img src="../uploads/galeri/<?php echo $row['gambar'];?>" alt="..."
                            style="width: 200px; height: 200px">
                    </div>
                    <?php 
                    $number++;
                    if ($number == 2) break;
                    endforeach
                    ?>
                </div>
                <div class="row">
                    <?php
                    $number = 0;
                    foreach ($data as $row):
                        if ($number > 1){
                        ?>
                    <div class="item-about col-md-6">
                        <img src="../uploads/galeri/<?php echo $row['gambar'];?>" alt="..."
                            style="width: 200px; height: 200px">
                    </div>
                    <?php 
                        }
                    $number++;
                    if ($number == 5) break;
                    endforeach
                    ?>
                </div>
            </div>
            <div class="col-md-6 isi-about">
                <div class="judul-about">
                    <h1 class="lobster-regular judul-about-1">Tentang kami</h1>
                </div>
                <div class="teks-about" style="padding-top: 20px; padding-bottom: 20px;">
                    <?php
                                                        $sql = "SELECT * FROM teks_tentang WHERE kategori = 'tentang kami'";
                                                        $q = mysqli_query($conn, $sql);
                                                        $data = [];
                                                        while ($row = mysqli_fetch_array($q)) {
                                                            $data[] = $row;
                                                        }
                                                        foreach ($data as $row):
                                                        ?>
                    <p class="poppins-regular teks-about-1" style="font-size: 20px; text-align: justify;"><span
                            class="tab"></span><?php echo $row['teks'] ?></p>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
        <div class="about2 row">
            <div class="col-md-6">
                <div class="judul-about1">
                    <h1 class="lobster-regular judul-about-2">Visi kami</h1>
                </div>
                <div class="text-about">
                    <?php
                                                        $sql = "SELECT * FROM teks_tentang WHERE kategori = 'tentang kami'";
                                                        $q = mysqli_query($conn, $sql);
                                                        $data = [];
                                                        while ($row = mysqli_fetch_array($q)) {
                                                            $data[] = $row;
                                                        }
                                                        foreach ($data as $row):
                                                        ?>
                    <p class="poppins-regular teks-about-1" style="font-size: 20px; text-align: justify;"><span
                            class="tab"></span><?php echo $row['teks'] ?></p>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="col-md-6" style="padding: 40px;">
                <div class="row ">
                    <div class="row-about" style="flex-wrap: wrap;">
                        <?php
                                                        $sql = "SELECT * FROM img_tentang WHERE kategori = 'misi kami'";
                                                        $q = mysqli_query($conn, $sql);
                                                        $data = [];
                                                        while ($row = mysqli_fetch_array($q)) {
                                                            $data[] = $row;
                                                        }
                                                        ?>
                        <div class="row">
                            <?php
                    $number = 0;
                    foreach ($data as $row):
                        ?>
                            <div class="item-about col-md-6">
                                <img src="../uploads/galeri/<?php echo $row['gambar'];?>" alt="..."
                                    style="width: 200px; height: 200px">
                            </div>
                            <?php 
                    $number++;
                    if ($number == 2) break;
                    endforeach
                    ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="about container row">
            <div class="col-md-6 img-about">
                <?php
                                                        $sql = "SELECT * FROM img_tentang WHERE kategori = 'produk kami'";
                                                        $q = mysqli_query($conn, $sql);
                                                        $data = [];
                                                        while ($row = mysqli_fetch_array($q)) {
                                                            $data[] = $row;
                                                        }
                                                        ?>
                <div class="row">
                    <?php
                    $number = 0;
                    foreach ($data as $row):
                        ?>
                    <div class="item-about col-md-6">
                        <img src="../uploads/galeri/<?php echo $row['gambar'];?>" alt="..."
                            style="width: 200px; height: 200px">
                    </div>
                    <?php 
                    $number++;
                    if ($number == 2) break;
                    endforeach
                    ?>
                </div>
                <div class="row">
                    <?php
                    $number = 0;
                    foreach ($data as $row):
                        if ($number > 1){
                        ?>
                    <div class="item-about col-md-6">
                        <img src="../uploads/galeri/<?php echo $row['gambar'];?>" alt="..."
                            style="width: 200px; height: 200px">
                    </div>
                    <?php 
                        }
                    $number++;
                    if ($number == 5) break;
                    endforeach
                    ?>
                </div>
            </div>
            <div class="col-md-6 isi-about">
                <div class="judul-about">
                    <h1 class="lobster-regular judul-about-1">Tentang kami</h1>
                </div>
                <div class="teks-about" style="padding-top: 20px; padding-bottom: 20px;">
                    <?php
                                                        $sql = "SELECT * FROM teks_tentang WHERE kategori = 'produk kami'";
                                                        $q = mysqli_query($conn, $sql);
                                                        $data = [];
                                                        while ($row = mysqli_fetch_array($q)) {
                                                            $data[] = $row;
                                                        }
                                                        foreach ($data as $row):
                                                        ?>
                    <p class="poppins-regular teks-about-1" style="font-size: 20px; text-align: justify;"><span
                            class="tab"></span><?php echo $row['teks'] ?></p>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
    <!-- menu end -->
</div>
</div>
<?php include '_component/footer.php'; ?>