<?php
include "../../config/koneksi.php";
session_start();
$id = $_SESSION['nim'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Pengajuan</title>

    <?php
    include "../../../public/rel.php";
    ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?php
        include "../../../public/header.php";
        ?>
        <!-- /.Navbar -->

        <!-- Main Sidebar Container -->
        <?php include "../../../public/sidebar.php"; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Detail Pengajuan</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item">Detail Pengajuan</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">



                        <!-- Left col -->
                        <div class="col-md-12">
                            <div class="row">

                                <!-- Status Pengajuan Cuti -->
                                <div class="col-md-7">

                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Status Pengajuan Cuti</h3>

                                            <div class="card-tools">
                                                <!-- <span class="badge badge-danger">3 New Members</span> -->
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body p-0">
                                            <ul class="users-list ">
                                                <li>
                                                    <img src="../../../public/dist/img/user1-128x128.jpg" alt="User Image">
                                                    <a class="users-list-name" href="#">Dosen Wali</a>
                                                    <span class="users-list-date">Today</span>
                                                </li>
                                                <li>
                                                    <img src="../../../public/dist/img/user8-128x128.jpg" alt="User Image">
                                                    <a class="users-list-name" href="#">Ketua Jurusan</a>
                                                    <span class="users-list-date">Yesterday</span>
                                                </li>
                                                <li>
                                                    <img src="../../../public/dist/img/user7-128x128.jpg" alt="User Image">
                                                    <a class="users-list-name" href="#">BAAK</a>
                                                    <span class="users-list-date">12 Jan</span>
                                                </li>
                                            </ul>
                                            <!-- /.users-list -->
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer text-center">
                                            <!-- Menunggu Persetujuan, Selesai, Ditolak -->
                                            <a href="javascript:">Selesai</a>
                                        </div>
                                        <!-- /.card-footer -->
                                    </div>
                                    <!--/.card -->

                                </div>
                                <!-- /.col -->

                                <!-- Surat Keputusan -->

                            </div>
                            <!-- /.card -->








                        </div>
                    </div>
                    <!-- /.col -->



                    <!-- Left col -->
                    <div class="col-md-12">
                        <div class="row">
                            <!-- Status Pengajuan Aktif -->
                            <div class="col-md-7">

                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Status Pengajuan Aktif</h3>

                                        <div class="card-tools">
                                            <!-- <span class="badge badge-danger">4 New Members</span> -->
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body p-0">
                                        <ul class="users-list clearfix">
                                            <li>
                                                <img src="../../../public/dist/img/user1-128x128.jpg" alt="User Image">
                                                <a class="users-list-name" href="#">Dosen Wali</a>
                                                <span class="users-list-date">Today</span>
                                            </li>
                                            <li>
                                                <img src="../../../public/dist/img/user8-128x128.jpg" alt="User Image">
                                                <a class="users-list-name" href="#">Ketua Jurusan</a>
                                                <span class="users-list-date">Yesterday</span>
                                            </li>
                                            <li>
                                                <img src="../../../public/dist/img/user7-128x128.jpg" alt="User Image">
                                                <a class="users-list-name" href="#">Wakil Direktur 1</a>
                                                <span class="users-list-date">12 Jan</span>
                                            </li>
                                            <li>
                                                <img src="../../../public/dist/img/user6-128x128.jpg" alt="User Image">
                                                <a class="users-list-name" href="#">BAAK</a>
                                                <span class="users-list-date">12 Jan</span>
                                            </li>
                                        </ul>
                                        <!-- /.users-list -->
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer text-center">
                                        <!-- Menunggu Persetujuan, Selesai, Ditolak -->
                                        <a href="javascript:">Selesai</a>
                                    </div>
                                    <!-- /.card-footer -->
                                </div>
                                <!--/.card -->

                            </div>
                            <!-- /.col -->
                        </div>
                    </div>



                </div>
                <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <!-- footer -->
    <?php include "../../../public/footer.php"; ?>
    <!-- script -->
    <?php include "../../../public/script.php"; ?>

    </div>
</body>

</html>