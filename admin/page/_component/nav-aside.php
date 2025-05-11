<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
        <?php include 'dashboard/nav-aside-dashboard.php'; ?>

        <!-- nav-aside-tentang -->
        <?php include 'tentang/nav-aside-tentang.php'; ?>

        <!-- nav-aside-menu -->
        <?php include 'menu/nav-aside-menu.php'; ?>

        <!-- nav-aside-pesan -->
        <?php include 'pesan/nav-aside-pesan.php'; ?>

        <!-- nav-aside-berita -->
        <?php include 'berita/nav-aside-berita.php'; ?>

        <!-- nav-aside-ulasan -->
        <?php include 'ulasan/nav-aside-ulasan.php'; ?>

        <!-- nav-aside-fasilitas -->
        <?php include 'fasilitas/nav-aside-fasilitas.php'; ?>

        <!-- nav-aside-kontak -->
        <?php include 'kontak/nav-aside-kontak.php'; ?>

        <li class="nav-item">
            <a href="page.php?mod=logout" class="nav-link">
                <i class="nav-icon far fa-image"></i>
                <p>
                    Logout
                </p>
            </a>
        </li>
    </ul>
</nav>