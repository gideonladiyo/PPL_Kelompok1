<?php
include "../config/connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'];

    $query = "DELETE FROM berita WHERE id_berita = $id";

    if ($conn->query($query)) {
        ?>
        <script>
            window.location = "page.php?mod=berita";
        </script>
        <?php
        exit;
    } else {
        echo "Error executing query: " . $conn->error;
    }
}
?>
