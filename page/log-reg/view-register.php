<?php include '_component/header.php'; ?>
<?php include "../config/connect.php"; ?>

<?php
// show potential errors / feedback (from registration object)
if (isset($registration)) {
    if ($registration->errors) {
        foreach ($registration->errors as $error) {
            echo $error;
        }
    }
?>

<?php
    if ($registration->messages) {
        foreach ($registration->messages as $message) {
            echo $message;
        }
    }
}
?>
<!-- content home -->
<div class="content">
    <div class="container background-content" style="width: 50%">
        <!-- menu -->
        <!-- makanan -->
        <div class="judul text-center">
            <h1 class="lobster-regular" style="font-size: 60px">Register</h1>
        </div>
        <?php
// show potential errors / feedback (from registration object)
if (isset($registration)) {
    if ($registration->errors) {
        foreach ($registration->errors as $error) {
            echo '<p style="color: red;">' . $error . '</p>';
        }
    }
?>

<?php
    if ($registration->messages) {
        foreach ($registration->messages as $message) {
            echo '<p style="color: green;">' . $message . '</p>';
        }
    }
}
?>
        <div class="register">
            <form action="page.php?mod=register" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nama</label>
                <input type="text" class="form-control" aria-describedby="emailHelp" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">No Handphone</label>
                <input type="text" class="form-control" name="no_hp" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
            </div>
            <div class="mb-5">
                <label for="exampleInputPassword1" class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="confirm_password" required>
            </div>
            <input class="btn btn-danger" type="submit"  name="register" value="Register" />
        </form>
        <a href="page.php?mod=login">Back to Login Page</a>
        </div>

    </div>
</div>

<!-- end content -->
<?php include '_component/footer.php'; ?>