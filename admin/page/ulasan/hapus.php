<?php
include "../config/connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'];

    $query = "DELETE FROM reviews WHERE id = $id";

    if ($conn->query($query)) {
        ?>
        <script>
            window.location = "page.php?mod=crudUlasan";
        </script>
        <?php
        exit;
    } else {
        echo "Error executing query: " . $conn->error;
    }
}
?>
