<div id="carouselExample" class="carousel slide">
    <div class="carousel-inner">
        <?php
        $sql = "SELECT * FROM carousel";
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
                <img src="../uploads/carousel/' . $gambar . '" class="d-block w-100" alt="...">
            </div>';
                $isFirst = false; // Set flag to false after the first item
            } else {
                echo '<div class="carousel-item">
                <img src="../uploads/carousel/' . $gambar . '" class="d-block w-100" alt="...">
            </div>';
            }
        endforeach;
        ?>
    </div>
    <button class="carousel-control-prev margin-10" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next margin-10" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>