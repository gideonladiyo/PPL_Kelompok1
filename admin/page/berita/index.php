<?php
include '../../config/connect.php';

$id = $judul = $konten = $thumbnail = $tanggal = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST["judul"];
    $konten = $_POST["konten"];
    $tanggal = $_POST["tanggal"];
    $thumbnail = "";

    if (isset($_POST["id"]) && $_POST["id"] != "") {
        $id = $_POST["id"];
        if (isset($_FILES["file"]["name"]) && $_FILES["file"]["name"] != "") {
            $targetDir = "../../uploads/berita/";
            $targetFile = $targetDir . basename($_FILES["file"]["name"]);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            $uploadOk = 1;

            $check = getimagesize($_FILES["file"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            if (file_exists($targetFile)) {
                unlink($targetFile);
            }

            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            if ($uploadOk == 1) {
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
                    $thumbnail = basename($_FILES["file"]["name"]);
                    $sql = "UPDATE berita SET judul='$judul', konten='$konten', gambar='$thumbnail', tanggal='$tanggal' WHERE id_berita=$id";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        } else {
            $sql = "UPDATE berita SET judul='$judul', konten='$konten', tanggal='$tanggal' WHERE id_berita=$id";
        }
    } else {
        $targetDir = "../../uploads/berita/";
        $targetFile = $targetDir . basename($_FILES["file"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $uploadOk = 1;

        $check = getimagesize($_FILES["file"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        if (file_exists($targetFile)) {
            unlink($targetFile);
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
                $thumbnail = basename($_FILES["file"]["name"]);
                $sql = "INSERT INTO berita (judul, konten, tanggal, gambar) VALUES ('$judul', '$konten', '$tanggal', '$thumbnail')";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: page.php?mod=beritaCoba");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET["edit"])) {
    $id = $_GET["edit"];
    $result = $conn->query("SELECT * FROM berita WHERE id_berita=$id");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $judul = $row["judul"];
        $konten = $row["konten"];
        $thumbnail = $row["gambar"];
        $tanggal = $row["tanggal"];
    }
}

if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $sql = "DELETE FROM berita WHERE id_berita=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: page.php?mod=beritaCoba");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$result = $conn->query("SELECT * FROM berita");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Halaman Berita Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
</head>

<body>

    <div class="container mt-5">
        <h2>Form Berita</h2>
        <form method="post" action="page.php?mod=beritaCoba" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="judul">Judul:</label>
                <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $judul; ?>" required>
            </div>
            <div class="form-group">
                <label for="konten">Konten:</label>
                <textarea class="form-control" id="summernote" name="konten" required><?php echo $konten; ?></textarea>
            </div>
            <div class="form-group">
                <label for="title" class="form-label">Tanggal: </label>
                <input type="date" class="form-control" id="title" name="tanggal" value="<?php echo $tanggal; ?>">
            </div>
            <div class="form-group">
                <?php if ($thumbnail != ""): ?>
                    <img src="../../uploads/berita/<?php echo $thumbnail; ?>" width="100px" alt="...">
                <?php endif; ?>
                <input type="file" class="form-control" id="thumbnail" name="file">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <h2 class="mt-5">Daftar Berita</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Konten</th>
                    <th>Thumbnail</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id_berita']; ?></td>
                    <td><?php echo $row['judul']; ?></td>
                    <td><?php echo $row['konten']; ?></td>
                    <td><img src="../../uploads/berita/<?php echo $row['gambar']; ?>" width="100px" alt="..."></td>
                    <td>
                        <a href="page.php?mod=beritaCoba&edit=<?php echo $row['id_berita']; ?>" class="btn btn-info btn-sm">Edit</a>
                        <a href="page.php?mod=beritaCoba&delete=<?php echo $row['id_berita']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <script>
    $('#summernote').summernote({
        placeholder: 'Hello stand alone ui',
        tabsize: 2,
        height: 120,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
    </script>

</body>

</html>

<?php
$conn->close();
?>
