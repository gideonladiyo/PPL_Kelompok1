<?php

/**
 * A simple, clean and secure PHP Login Script / MINIMAL VERSION
 *
 * Uses PHP SESSIONS, modern password-hashing and salting and gives the basic functions a proper login system needs.
 *
 * @author Panique
 * @link https://github.com/panique/php-login-minimal/
 * @license http://opensource.org/licenses/MIT MIT License
 */

// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("libraries/password_compatibility_library.php");
}

// include the configs / constants for the database connection
require_once("../config/db.php");

// load the login class
require_once("../classes/Login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process. in consequence, you can simply ...
$login = new Login();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | Warmindo Burjo Bintang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>

<body style="height: 100%;">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg red-nav poppins-semibold">
        <div class="container-fluid" style="justify-content: flex-end;">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation" style="background-color: #fff;">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="logo-navbar">
                <a href="page.php?mod=home">
                    <img src="../assets/logo/logo.png" alt="...">
                </a>
            </div>
            <div class="collapse navbar-collapse flex-end margin-all" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="page.php?mod=home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="page.php?mod=tentang">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="page.php?mod=menu">Menu</a>
                    </li>
                    <?php
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {
    // the user is logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are logged in" view.
    echo '<a class="nav-link" aria-current="page" href="page.php?mod=pesan">Pesan</a>';
} else {
    // the user is not logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are not logged in" view.
    echo '<button type="button" class="nav-link" data-bs-toggle="modal" data-bs-target="#alertLoginModal">
    Pesan</button>';
}
?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="page.php?mod=berita">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="page.php?mod=ulasan">Ulasan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="page.php?mod=fasilitas">Fasilitas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="page.php?mod=kontak">Kontak</a>
                    </li>
                    <li class="nav-item">
                        <?php
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {
    // the user is logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are logged in" view.
    echo '<a class="nav-link" aria-current="page" href="page.php?mod=logout">Log Out</a>';
} else {
    // the user is not logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are not logged in" view.
    echo '<a class="nav-link" aria-current="page" href="page.php?mod=login">Log In</a>';
}
?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>