<?php
session_start();
//tes push
?>


<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rutan Klass II B Padang</title>
    <link href="style/logo2.png" rel="shortcut icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="login.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row no-gutter">
            <!-- The image half -->
            <div class="col-md-4 d-none d-md-flex bg-image"></div>


            <!-- The content half -->
            <div class="col-md-8 bg-light">
                <div class="login d-flex align-items-center py-5">

                    <!-- Demo content-->
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-10 col-xl-7 mx-auto">
                                <h3 class="display-8">Rumah Tahanan Negara Klass II B Padang </h3>
                                <p class="text-muted mb-4">Jl. Anak Air, Batipuh Panjang, Kec. Koto Tangah, Kota Padang, Sumatera Barat 25586</p>
                                <form action="" method="POST">
                                    <div class="form-group mb-3 mt-5">
                                        <input id="inputEmail" type="text" placeholder="Username" required="" autofocus="" class="form-control rounded-pill border-0 shadow-sm px-4" name="username">
                                    </div>
                                    <div class="form-group mb-3">
                                        <input id="inputPassword" type="password" placeholder="Password" required="" class="form-control rounded-pill border-0 shadow-sm px-4 text-primary" name="password">
                                    </div>
                                    <div class="form-group mb-3">
                                        <center><input id="inputPassword" type="submit" class="btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm btn-block" value="login" name="login"></center>

                                    </div>



                                </form>
                            </div>
                        </div>
                    </div><!-- End -->

                </div>
            </div><!-- End -->
            <?php

            include('config/koneksi.php');

            if (isset($_POST['login'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];

                // Validasi username dan password case-sensitive
                $query = mysqli_query($konek, "SELECT * FROM tbl_user WHERE BINARY username='$username' AND BINARY password='$password'");

                // Periksa apakah ada kesalahan dalam eksekusi query
                if (!$query) {
                    echo "Error: " . mysqli_error($konek);
                }

                $row = mysqli_num_rows($query);

                if ($row > 0) {
                    $data = mysqli_fetch_assoc($query);

                    if ($data['level'] == "Admin" && $data['username'] == $username) {
                        $_SESSION['id'] = $data['id'];
                        $_SESSION['username'] = $username;
                        $_SESSION['level'] = "Admin";
                        $_SESSION['nama_lengkap'] = $data['nama_lengkap'];
                        header("location:admin/index.php");
                    } else if ($data['level'] == "Admin Blok" && $data['username'] == $username) {
                        $_SESSION['id'] = $data['id'];
                        $_SESSION['username'] = $username;
                        $_SESSION['level'] = "Admin Blok";
                        $_SESSION['nama_lengkap'] = $data['nama_lengkap'];
                        $_SESSION['id_blok'] = $data['id_blok'];
                        header("location:admin_blok/index.php");
                    } else if ($data['level'] == "Pimpinan" && $data['username'] == $username) {
                        $_SESSION['id'] = $data['id'];
                        $_SESSION['username'] = $username;
                        $_SESSION['level'] = "Pimpinan";
                        $_SESSION['nama_lengkap'] = $data['nama_lengkap'];
                        header("location:pimpinan/index.php");
                    } else {
                        echo "<script language=javascript>
                        window.alert('Username atau Password Salah!');
                        window.location='index.php';
                      </script>";
                    }
                } else {
                    echo "<script language=javascript>
                    window.alert('Username atau Password Salah!');
                    window.location='index.php';
                  </script>";
                }
            }
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>