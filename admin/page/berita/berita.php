<?php include '_component/header.php';?>
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
        header("Location: page.php?mod=berita");
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
        header("Location: page.php?mod=berita");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$result = $conn->query("SELECT * FROM berita");
?>

<?php
include '../../functions/sorting.php';
?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <?php include '_component/wrapper.php'; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Berita</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="page.php?mod=dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Berita</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-8">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Berita</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="col-md-8" method="post" action="page.php?mod=berita"
                                enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <div class="form-group">
                                    <label for="judul">Judul:</label>
                                    <input type="text" class="form-control" id="judul" name="judul"
                                        value="<?php echo $judul; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="konten">Konten:</label>
                                    <textarea class="form-control" id="summernote" name="konten"
                                        required><?php echo $konten; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="title" class="form-label">Tanggal: </label>
                                    <input type="date" class="form-control" id="title" name="tanggal"
                                        value="<?php echo $tanggal; ?>">
                                </div>
                                <div class="form-group">
                                    <?php if ($thumbnail != ""): ?>
                                    <img src="../../uploads/berita/<?php echo $thumbnail; ?>" width="100px" alt="...">
                                    <?php endif; ?>
                                    <input type="file" class="form-control" id="thumbnail" name="file">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        <!-- /.card -->
                        <!--/.col (right) -->
                    </div>
                    <!-- /.row -->
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- HEADER -->
                            <!-- /.card-header -->
                            <div class="card-body">
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
                                            <td><img src="../../uploads/berita/<?php echo $row['gambar']; ?>"
                                                    width="100px" alt="..."></td>
                                            <td>
                                                <a href="page.php?mod=berita&edit=<?php echo $row['id_berita']; ?>"
                                                    class="btn btn-info btn-sm">Edit</a>
                                                <a href="page.php?mod=berita&delete=<?php echo $row['id_berita']; ?>"
                                                    class="btn btn-danger btn-sm">Hapus</a>
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
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <?php include '_component/footer.php'; ?>