<?php
include '../../config/koneksi.php';

session_start();
$nip_npak = $_SESSION['nip_npak'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>

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
                            <h1>Dashboard</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <?php
                                    $sql = mysqli_query($conn, "SELECT count(*) AS jml FROM tb_mahasiswa AS m, tb_pengajuan AS p, tb_kajur AS k WHERE m.nim = p.nim AND m.id_kajur=k.id_kajur AND k.nip_npak='$nip_npak'");
                                    $hasil = mysqli_fetch_array($sql);
                                    ?>
                                    <h3><?php echo $hasil['jml']; ?></h3>

                                    <p>Data Pengajuan</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="../pengajuan/" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-6 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <?php
                                    $sql = mysqli_query($conn, "SELECT count(*) AS jml_belum FROM tb_mahasiswa AS m, tb_pengajuan AS p, tb_kajur AS k WHERE m.nim = p.nim AND m.id_kajur=k.id_kajur AND k.nip_npak='$nip_npak' AND (p.status < '3' OR p.status IS NULL)");
                                    $hasil = mysqli_fetch_array($sql);
                                    ?>
                                    <h3><?php echo $hasil['jml_belum']; ?></h3>

                                    <p>Pengajuan Belum Selesai Diverifikasi</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="../pengajuan/" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
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