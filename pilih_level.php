<?php
session_start();
// $level_halaman = "Dosen Wali dan Ketua Jurusan";

// untuk membuat pengecekan level yang memiliki jabatan dosen wali dan kajur (dua jabatan)
// dev (default) diambil dari sidebar
// saat masuk ke salah satu akun kemudian kembali ke halaman ini, 
// dibuat isset dev agar session yg memiliki dua jabatan memiliki identitas saat kembali ke halaman multi_level.php
// if (isset($_GET['dev'])) {
//     $_SESSION['level'] = $_SESSION['dua'];
// }

// agar selain session dosen wali dan ketua jurusan tidak bisa masuk
// if ($level_halaman != $_SESSION['level']) {
//     session_destroy();
//     header("Location: index.php");
// }

if (!isset($_SESSION["nama"])) {
    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pilih Level</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="public/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="public/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="public/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="public/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="public/plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">

                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.Navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="public/dist/img/PNC.png" alt="PNC Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">SIPCUT</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <?php
                        include "app/config/koneksi.php";


                        $user = mysqli_query($conn, "SELECT * FROM tb_pegawai WHERE nip_npak = '$_SESSION[nip_npak]'");
                        $row = $user->fetch_assoc();
                        foreach ($user as $row) {
                            if (!empty($row["foto"])) { ?>

                                <img src="app/admin/pegawai/img/<?= $row['foto']; ?>" class="avatar" style="width: 100px; height: 32px; max-width: 32px; max-height: 32px; -webkit-border-radius: 50%; -moz-border-radius: 50%; border-radius: 50%; border: 2px solid rgba(255,255,255,0.5);" alt="User Image">

                            <?php } else { ?>

                                <img src="public/dist/img/user2-160x160.jpg" class="avatar" style="width: 100px; height: 32px; max-width: 32px; max-height: 32px; -webkit-border-radius: 50%; -moz-border-radius: 50%; border-radius: 50%; border: 2px solid rgba(255,255,255,0.5);" alt="User Image">

                            <?php } ?>


                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= $row['nama']; ?></a>
                    </div>
                <?php
                        }

                ?>

                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class font-awesome or any other icon font library -->

                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="logout.php" class="nav-link">
                                <i class="nav-icon fas fa-power-off"></i>
                                <p>Logout</p>
                            </a>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Pilih Hak Akses Anda</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <?php
                    $get_akses = mysqli_query($conn, "SELECT * FROM tb_hak_akses join tb_jabatan on tb_jabatan.id_jabatan=tb_hak_akses.id_jabatan where tb_hak_akses.nip_npak = '$_SESSION[nip_npak]'");
                    while ($datas = mysqli_fetch_array($get_akses)) {
                        $_SESSION['level'] = "";
                    ?>

                        <!-- Small boxes (Stat box) -->
                        <div class="row">
                            <div class="col-lg-12 col-6">
                                <!-- small box -->
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>&nbsp;</h3>
                                        <h4><?php echo $datas['nama_jabatan'] ?></h4>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-person"></i>
                                    </div>
                                    <!-- masukin ke dashboard dulu -->
                                    <!-- membuat session level menjadi Dosen Wali -->
                                    <a href="app/<?php echo $datas['nama_folder'] ?>/dashboard/index.php?lvl=<?= $datas['nama_jabatan']; ?>" class="small-box-footer">Pilih <i class="fas fa-arrow-circle-right"></i></a>

                                </div>
                            </div>
                            <!-- ./col -->
                        </div>
                        <!-- /.row -->

                    <?php
                    }
                    ?>
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0.0
            </div>
            <strong>Ulfatun Nasikhah &copy; 2021</strong> All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="public/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="public/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="public/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="public/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="public/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="public/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="public/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="public/plugins/moment/moment.min.js"></script>
    <script src="public/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="public/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="public/dist/js/adminlte.js"></script>


</body>

</html>