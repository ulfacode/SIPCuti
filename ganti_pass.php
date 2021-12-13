<?php
include "app/config/f_lupaPass.php";


// function query($query)
// {
//     global $conn;
//     $result = mysqli_query($conn, $query);
//     $rows = [];
//     while ($row = mysqli_fetch_assoc($result)) {
//         $rows[] = $row;
//     }
//     return $rows;
// }


$token = $_GET['token'];
$get_email = $_GET['email'];

// $sql1 = query("SELECT token FROM tb_pegawai WHERE email = '$get_email'")[0] ?? NULL;

// if (isset($sql1['token']) == NULL) {


//     $sql2 = query("SELECT token FROM tb_mahasiswa WHERE email = '$get_email'")[0] ?? NULL;

//     if (isset($sql2['token']) == NULL) {
//         echo "
//          <script>
//              alert('Token tidak ada!');
//              document.location.href = 'index.php';
//          </script>
//      ";
//     }
// }

// $data1 = mysqli_fetch_assoc($sql1);
// $data2 = mysqli_fetch_assoc($sql2);

// if ((mysqli_num_rows($sql1) < 0) or (mysqli_num_rows($sql2) < 0)) {
//     echo "
//     <script>
//         alert('Token tidak bisa digunakan!');
//         document.location.href = 'index.php';
//     </script>
// ";
// }

// if (($token != $data1['token']) OR ($token != $data2['token'])) {
//     echo "
//     <script>
//         alert('Token tidak bisa digunakan!');
//         document.location.href = 'index.php';
//     </script>
// ";
// }

if (isset($_POST["gantiPass"])) {
    // manggil function 
    ganti_password($_POST);
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
                        <input type="password" name="password" id="inputPassword3" class="form-control" placeholder="Password Baru">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="Repassword" id="inputPassword3" class="form-control" placeholder="Konfirmasi Password">
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