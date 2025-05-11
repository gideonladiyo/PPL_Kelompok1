<?php
include "../config/connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'];

    $query = "DELETE FROM carousel_menu WHERE id_carousel = $id";

    if ($conn->query($query)) {
        ?>
        <script>
            window.location = "page.php?mod=carousel-menu";
        </script>
        <?php
        exit;
    } else {
        echo "Error executing query: " . $conn->error;
    }
}
?>
