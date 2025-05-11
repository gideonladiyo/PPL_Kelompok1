<?php
include '_component/header.php'; ?>
<?php include "../config/connect.php"; ?>

<?php
// show potential errors / feedback (from login object)
if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
            echo $error;
        }
    }
    if ($login->messages) {
        foreach ($login->messages as $message) {
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
            <h1 class="lobster-regular" style="font-size: 60px">Login</h1>
        </div>
        <?php
// show potential errors / feedback (from login object)
if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
            echo '<p style="color: red;">' . $error . '</p>';
        }
    }
    if ($login->messages) {
        foreach ($login->messages as $message) {
            echo '<p style="color: green;">' . $error . '</p>';
        }
    }
}
?>
        <div class="register">
            <form action="page.php?mod=login" method="POST">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="email" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
                </div>
                <input class="btn btn-danger" type="submit"  name="login" value="Log in" />
            </form>
            <a href="page.php?mod=register">Register new account</a>
        </div>

    </div>
</div>

<!-- end content -->
<?php include '_component/footer.php'; ?>