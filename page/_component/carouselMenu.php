<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel"
    style="padding-top: 20px; padding-bottom: 40px">
    <div class="carousel-inner">
        <?php
        $sql = "SELECT * FROM carousel_menu";
        $q = mysqli_query($conn, $sql);
        $data = [];
        while ($row = mysqli_fetch_array($q)) {
            $data[] = $row;
        }
        $isFirst = true; // Flag to check if it's the first item
        foreach ($data as $row):
            $gambar = $row['gambar'];
            if ($isFirst) {
                echo '<div class="carousel-item active">
                <img src="../uploads/carousel-menu/' . $gambar . '" class="d-block w-100" alt="...">
            </div>';
                $isFirst = false; // Set flag to false after the first item
            } else {
                echo '<div class="carousel-item">
                <img src="../uploads/carousel-menu/' . $gambar . '" class="d-block w-100" alt="...">
            </div>';
            }
        endforeach;
        ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>