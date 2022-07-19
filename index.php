<?php

include 'app/config/koneksi.php';

if (isset($_POST['login'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);


    $loginM = mysqli_query($conn, "SELECT *
                                    FROM tb_mahasiswa 
                                    WHERE email = '$email'");
    $cekM = mysqli_num_rows($loginM);


    $loginP = mysqli_query($conn, "SELECT *
                                    FROM tb_pegawai 
                                    WHERE email = '$email'");
    $cekP = mysqli_num_rows($loginP);



    //jika user terdaftar sbg mahasiswa
    if ($cekM > 0) {
        $data = mysqli_fetch_assoc($loginM);

        if ($data['password'] == $password) {
            // buat session
            session_start();

            $_SESSION['level'] = "Mahasiswa";
            $_SESSION['id_mahasiswa'] = $data['id_mahasiswa'];
            $_SESSION['nim'] = $data['nim'];
            $_SESSION['nama'] = $data['nama'];


            // login sukses, alihkan ke halaman utama (dashboard)
            header("location: app/mahasiswa/dashboard/");
        } else {
            echo "<script>
                alert('Masukkan password dengan benar!')
                </script>";
        }
    } elseif ($cekP > 0) { //jika user terdaftar sbg pegawai
        $data = mysqli_fetch_assoc($loginP);

        if ($data['password'] == $password) {
            if ($data['status'] == "Aktif") {
                session_start();

                $_SESSION['nip_npak'] = $data['nip_npak'];
                $_SESSION['id_pegawai'] = $data['id_pegawai'];
                $_SESSION['nama'] = $data['nama'];
                $_SESSION['level'] = "";

                header("location: pilih_level.php");
            } else {
                echo "<script>
                alert('Akun Anda tidak aktif. Silahkan menghubungi BAAK!')
                </script>";
            }
        } else {
            echo "<script>
                alert('Masukkan password dengan benar!')
                </script>";
        }
    } else {
        echo "<script>
            alert('Masukkan email dengan benar!')
            </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Sistem Cuti</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="public/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="public/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <br>
                <img src="public/dist/img/PNC.png" alt="Logo PNC" style="height: 60px; width: 60px;">
                <br>
                <a class="h3"><b>Sistem Pengajuan Cuti</b> </a>
            </div>
            <div class="card-body">
                <!-- <p class="login-box-msg">Login untuk memulai</p> -->
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" id="inputPassword3" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <!-- <div class="icheck-primary">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div> -->
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" name="login" class="btn btn-primary btn-block">Log In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center mt-2 mb-3">
                    <!-- <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a> -->
                </div>
                <!-- /.social-auth-links -->

                <!-- CARI NO TELP ADMIN -->
                <?php
                $telp_admin = mysqli_fetch_array(mysqli_query($conn, "SELECT no_telp 
                                                        FROM tb_pegawai AS p, tb_hak_akses AS hak, tb_jabatan AS jb 
                                                        WHERE p.id_pegawai=hak.id_pegawai 
                                                            AND hak.id_jabatan=jb.id_jabatan 
                                                            AND jb.nama_jabatan = 'Administrator' 
                                                            AND p.status='Aktif'"));
                ?>
                <p class="mb-1">
                    <a href="https://wa.me/<?= (string) $telp_admin['no_telp']; ?>?text=Halo! Saya lupa password akun sistem pengajuan cuti. Tolong bantu saya mereset password.">Lupa password</a>
                </p>
                <!-- <p class="mb-0">
                    <a href="register.html" class="text-center">Register a new membership</a>
                </p> -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="public/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="public/dist/js/adminlte.min.js"></script>
</body>

</html>