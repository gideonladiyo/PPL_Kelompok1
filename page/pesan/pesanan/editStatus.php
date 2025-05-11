<?php
// Koneksi ke database
include '../../../config/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['ids']) && !empty($_POST['ids'])) {
        $ids = $_POST['ids'];
        $ids_string = implode(',', $ids);
        $user_id = $_POST['user_id'];
        // Insert a new record into the transaksi table
$sqlTransaksi = "INSERT INTO transaksi(user_id, bukti, status) 
        VALUES ($user_id, 'default', 'default')";
if ($conn->query($sqlTransaksi) === TRUE) {
    echo "New record in transaksi created successfully";
} else {
    die("Error: " . $sqlTransaksi . "<br>" . $conn->error);
}

// Retrieve the id_transaksi for the current user
$sqlSelect = "SELECT id_transaksi FROM transaksi WHERE user_id = $user_id ORDER BY id_transaksi DESC LIMIT 1";
$result = mysqli_query($conn, $sqlSelect);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $id_transaksi = $row['id_transaksi'];
    echo "id_transaksi: " . $id_transaksi;
} else {
    die("Error: Could not retrieve id_transaksi. " . $sqlSelect . "<br>" . $conn->error);
}
        // SQL query untuk update status
        $sql = "UPDATE keranjang SET status = 'checkout', id_transaksi = $id_transaksi WHERE id_keranjang IN ($ids_string)";
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
            header("Location: ../../page.php?mod=checkout");
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "No items selected";
    }
}
// Menutup koneksi
$conn->close();
?>
