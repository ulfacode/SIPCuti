<?php
include "app/config/f_lupaPass.php";

$token = $_GET['token'];
$get_email = $_GET['email'];

// $sql1 = mysqli_query($conn, "SELECT token FROM tb_pegawai WHERE email = '$get_email'");
// $sql2 = mysqli_query($conn, "SELECT token FROM tb_mahasiswa WHERE email = '$get_email'");
// $data1 = mysqli_fetch_assoc($sql1);
// $data2 = mysqli_fetch_assoc($sql2);

// if (($token != $data1['token']) or ($token != $data2['token'])) {
//     echo "
//     <script>
//         alert('Token tidak bisa digunakan!');
//         document.location.href = 'index.php';
//     </script>
// ";
// }

if (isset($_POST["gantiPass"])) {
    if (ganti_password($_POST) > 0) {
        echo "
            <script>
                alert('Password berhasil diganti');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script> 
                alert('Password gagal diganti');
                document.location.href = 'index.php';
            </script>
            </script>
        ";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lupa Password</title>

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

                <a class="h3"><b>Ganti Password</b> </a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Silahkan ubah kata sandi</p>
                <form action="" method="post">
                    <input type="hidden" name="token" value="<?= $token; ?>">
                    <div class="input-group mb-3">
                        <input type="email" name="email" value="<?php echo $get_email; ?>" class="form-control" readonly>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password Baru">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="Repassword" class="form-control" placeholder="Konfirmasi Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">

                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" name="gantiPass" class="btn btn-primary btn-block">Kirim</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>



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