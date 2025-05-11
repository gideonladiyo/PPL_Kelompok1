<?php include '_component/header.php'; ?>
<?php include "../config/connect.php"; ?>
<?php
$userName = isset($_SESSION['nama']) ? $_SESSION['nama'] : null;
include "../functions/sorting.php";
?>
<!-- carousel -->
<?php include '_component/carouselUtama.php'; ?>
<!-- carousel end -->
<style>
  .background-content {
    color: #000000;
    width: 100%;
    margin: 20px auto;
    background-color: #FFED9E;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1);
}
</style>
<!-- content home -->
<div class="content">
    <div class="container background-content">
        <!-- about -->
        <div class="about container row">
            <div class="col-md-6 img-about">
                <div class="row">
                    <div class="item-about col-md-6">
                        <img src="../uploads/galeri/galeri1.jpg" alt="..." style="width: 200px; height: 200px">
                    </div>
                    <div class="item-about col-md-6">
                        <img src="../uploads/galeri/galeri2.jpg" alt="..." style="width: 200px; height: 200px">
                    </div>
                </div>
                <div class="row">
                    <div class="item-about col-md-6">
                        <img src="../uploads/galeri/galeri3.jpg" alt="..." style="width: 200px; height: 200px">
                    </div>
                    <div class="item-about col-md-6">
                        <img src="../uploads/galeri/galeri4.jpg" alt="..." style="width: 200px; height: 200px">
                    </div>
                </div>
            </div>
            <div class="col-md-6 isi-about">
                <div class="judul-about">
                    <h1 class="lobster-regular judul-about-1">Tentang kami</h1>
                    <?php if ($userName) : ?>
                    <span class="nav-link">Logged in as: <?php echo htmlspecialchars($userName); ?></span>
                    <?php endif; ?>
                </div>
                <div class="teks-about" style="padding-top: 20px; padding-bottom: 20px;">
                    <p class="poppins-regular teks-about-1" style="font-size: 20px; text-align: justify;"><span
                            class="tab"></span>Warmindo
                        adalah singkatan dari warung makan Indomie. Intinya, warung ini menyajikan menu mie instan
                        Indomie kepada pelanggannya.
                        Usaha ini sudah banyak ditemukan di berbagai wilayah di seluruh Indonesia, khususnya di area
                        perkotaan yang warganya memiliki gaya hidup serba praktis.</p>
                </div>
                <div class="button-about">
                    <a href="page.php?mod=tentang"><button class="btn-selengkapnya poppins-regular">Kenal lebih jauh</button></a>
                </div>
            </div>
        </div>
        <div class="menu-dashboard container">
            <div class="menu-dashboard-title">
                <img src="../assets/wallpaper/menu-vector.png" alt="">
            </div>
            <div class="menu-dashboard-content">
                <div class="menu-dashboard-1 padding-bawah">
                    <div class="isi-menu col-md-6">
                        <img class="img-menu" src="../uploads/banner-menu/banner1.jpg" alt="...">
                    </div>
                    <div class="isi-menu col-md-6">
                        <img class="img-menu" src="../uploads/banner-menu/banner2.jpg" alt="...">
                    </div>
                </div>
                <div class="menu-dashboard-2 padding-bawah">
                    <div class="button-about">
                        <a href="page.php?mod=menu"><button class="btn-selengkapnya-menu poppins-regular">Kenal lebih jauh</button></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- menu end -->
    </div>
</div>
<?php include '_component/footer.php'; ?>