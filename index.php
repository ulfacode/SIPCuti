<?php

include 'app/config/koneksi.php';

if (isset($_POST['login'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);


    // $login = mysqli_query($conn, "SELECT * FROM tb_mahasiswa AS m, tb_pegawai AS p  WHERE (m.username = '$username' AND m.password= '$password') OR (p.username = '$username' AND p.password= '$password')");
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
            $_SESSION['nim'] = $data['nim'];
            $_SESSION['nama'] = $data['nama'];


            // login sukses, alihkan ke halaman utama (dashboard)
            header("location: app/mahasiswa/dashboard/");
        } else {
            echo "<script>
                alert('Password salah!')
                </script>";
        }
    } elseif ($cekP > 0) { //jika user terdaftar sbg pegawai
        $data = mysqli_fetch_assoc($loginP);

        if ($data['password'] == $password) {
            if ($data['status'] == "Aktif") {
                if ($data['jabatan'] == "Administrator") {
                    // buat session
                    session_start();

                    $_SESSION['level'] = $data['jabatan'];
                    $_SESSION['nip_npak'] = $data['nip_npak'];
                    $_SESSION['nama'] = $data['nama'];

                    // login sukses, alihkan ke halaman utama (dashboard)
                    header("location: app/admin/dashboard");
                } elseif ($data['jabatan'] == "Wakil Direktur 1") {
                    // buat session
                    session_start();

                    $_SESSION['level'] = $data['jabatan'];
                    $_SESSION['nip_npak'] = $data['nip_npak'];
                    $_SESSION['nama'] = $data['nama'];

                    // login sukses, alihkan ke halaman utama (dashboard)
                    header("location: app/wadir1/dashboard/");
                } elseif ($data['jabatan'] == "Ketua Jurusan") {
                    // buat session
                    session_start();

                    $_SESSION['level'] = $data['jabatan'];
                    $_SESSION['nip_npak'] = $data['nip_npak'];
                    $_SESSION['nama'] = $data['nama'];

                    // login sukses, alihkan ke halaman utama (dashboard)
                    header("location: app/kajur/dashboard/");
                } elseif ($data['jabatan'] == "Dosen Wali") {
                    // buat session
                    session_start();

                    $_SESSION['level'] = $data['jabatan'];
                    $_SESSION['nip_npak'] = $data['nip_npak'];
                    $_SESSION['nama'] = $data['nama'];

                    // login sukses, alihkan ke halaman utama (dashboard)
                    header("location: app/doswal/dashboard/");
                } elseif ($data['jabatan'] == "Ketua Akademik") {
                    // buat session
                    session_start();

                    $_SESSION['level'] = $data['jabatan'];
                    $_SESSION['nip_npak'] = $data['nip_npak'];
                    $_SESSION['nama'] = $data['nama'];

                    // login sukses, alihkan ke halaman utama (dashboard)
                    header("location: app/KetuaAkademik/dashboard/");
                } elseif ($data['jabatan'] == "Bagian Keuangan") {
                    // buat session
                    session_start();

                    $_SESSION['level'] = $data['jabatan'];
                    $_SESSION['nip_npak'] = $data['nip_npak'];
                    $_SESSION['nama'] = $data['nama'];

                    // login sukses, alihkan ke halaman utama (dashboard)
                    header("location: app/keuangan/dashboard/");
                } elseif ($data['jabatan'] == "Bagian Perpustakaan") {
                    // buat session
                    session_start();

                    $_SESSION['level'] = $data['jabatan'];
                    $_SESSION['nip_npak'] = $data['nip_npak'];
                    $_SESSION['nama'] = $data['nama'];

                    // login sukses, alihkan ke halaman utama (dashboard)
                    header("location: app/perpus/dashboard/");
                } elseif ($data['jabatan'] == "Dosen Wali dan Ketua Jurusan") {
                    // buat session
                    session_start();


                    $_SESSION['level'] = $data['jabatan'];
                    $_SESSION['nip_npak'] = $data['nip_npak'];
                    $_SESSION['nama'] = $data['nama'];

                    // login sukses, alihkan ke halaman utama (dashboard)
                    header("location: multi_level.php");
                } else {
                    echo "<script>
                    alert('Tidak ada level yang sesuai')
                    </script>";
                }
            }else{
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

                <p class="mb-1">
                    <a href="lupa_password.php">Lupa password</a>
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