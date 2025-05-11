<?php include '_component/header.php'; ?>

<style>
    .judul-about {
        text-decoration: underline;
    }
    .teks-about iframe {
        width: 100%; /* Perlebar peta menjadi 100% dari elemen parent */
        height: 450px;
        border-radius: 15px; /* Menambahkan border radius */
        border: none; /* Menghilangkan border default */
    }   

    .badge-success {
        background-color: green;
        color: white;
    }

    .badge-danger {
        background-color: red;
        color: white;
    }

    .contact {
        background-color: #4CAF50; /* Warna latar belakang */
        color: white; /* Warna teks */
        padding: 15px 32px; /* Padding untuk tombol */
        text-align: center; /* Pusatkan teks */
        text-decoration: none; /* Hilangkan garis bawah */
        display: inline-block; /* Untuk membuat elemen sebaris */
        font-size: 16px; /* Ukuran font */
        margin: 4px 2px; /* Margin */
        cursor: pointer; /* Ganti kursor saat dihover */
        border: none; /* Hilangkan border default */
        border-radius: 12px; /* Membuat sudut membulat */
        transition: background-color 0.3s, box-shadow 0.3s; /* Tambahkan transisi untuk efek hover */
    }

    .contact:hover {
        background-color: #45a049; /* Warna latar belakang saat dihover */
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3); /* Tambahkan efek bayangan */
    }

    /* CSS untuk pop-up */
    .popup {
        display: none;
        position: fixed;
        z-index: 9;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5); /* Warna latar belakang transparan */
    }

    .popup-content {
        background-color: white;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 400px;
        border-radius: 10px;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<!-- Tambahkan pustaka jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- content home -->
<div class="content">
    <div class="container background-content">
        <!-- about -->
        <div class="about container row text d-flex align-items-center">
            <div class="img-about">
                <div class="row">
                </div>
            </div>
            <div class="isi-about text-center d-flex flex-column justify-content-center">
                <div class="judul-about">
                    <h1 class="lobster-regular judul-about-">Lokasi</h1>
                </div>
                <div class="teks-about" style="padding-top: 20px; padding-bottom: 20px;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.2341575390683!2d109.24622147404385!3d-7.439323473297427!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655c27c999b60b%3A0x70ac6566d973f69d!2sJl.%20Hos.%20Notosuwiryo%20No.4%2C%20Kruwet%2C%20Teluk%2C%20Kec.%20Purwokerto%20Sel.%2C%20Kabupaten%20Banyumas%2C%20Jawa%20Tengah%2053145!5e0!3m2!1sid!2sid!4v1718072245189!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                    <?php
                    include '../config/connect.php';

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT id_kontak, gambar, alamat, status FROM kontak";
                    $result = $conn->query($sql);

                    if ($result === false) {
                        echo "Error: " . $conn->error;
                    } else {
                    ?>

                    <style>
                        .img-about {
                            border-radius: 15px; /* Mengatur border radius gambar */
                        
                        }
                    </style>

                    <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<div class='item-about col-md-6 mx-auto'>
                                        <img src='../uploads/kontak/" . $row["gambar"] . "' alt='...' class='img-fluid img-about'>
                                      </div>";
                                echo  "<h5>      Burjo Bintang<h5> <br>";                            
                                echo "<p>Alamat <br>" . $row["alamat"] . "</p>";
                                echo  "<p> Jam operasional <br> 08.00 - 23.00 ";                            
                                echo "<p>Status: <span class='badge badge-" . ($row["status"] == "Buka" ? "success" : "danger") . "'>" . $row["status"] . "</span></p>";
                            }
                        } else {
                            echo "0 results";
                        }
                        $result->free();
                    }

                    $conn->close();
                    ?>

                </div>
                <div class="button-about">
                    <a href="#"><button class="poppins-regular contact">Contact us</button></a>
                </div>
            </div>
        </div>
<!-- end about -->

    </div>
</div>
<!-- end content -->

<!-- Pop-up HTML -->
<div id="popup" class="popup">
    <div class="popup-content">
        <span class="close">&times;</span>
        <p>Nomor Telepon : +62 812-3456-7890 <br><a href="https://wa.me/62895606433582">Chat WhatsApp</a></p>
    </div>
</div>

<?php include '_component/footer.php'; ?>

<!-- JavaScript untuk pop-up -->

<script>
    $(document).ready(function() {
        // Ketika tombol "Contact us" diklik
        $(".contact").click(function(event) {
            event.preventDefault(); // Mencegah link default
            $("#popup").show(); // Menampilkan pop-up
        });

        // Ketika tombol close (x) diklik
        $(".close").click(function() {
            $("#popup").hide(); // Menyembunyikan pop-up
        });

        // Ketika area di luar pop-up diklik
        $(window).click(function(event) {
            if ($(event.target).is("#popup")) {
                $("#popup").hide(); // Menyembunyikan pop-up
            }
        });
    });
</script>