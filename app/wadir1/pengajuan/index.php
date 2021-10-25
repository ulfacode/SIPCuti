<?php
include '../../config/f_pengajuan.php';
session_start();
$nip_npak = $_SESSION['nip_npak'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengajuan Cuti dan Izin Aktif</title>

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
        <?php
        include "../../../public/sidebar.php";
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Pengajuan Cuti dan Izin Aktif</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item">Pengajuan Cuti dan Izin Aktif</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <!-- /.card -->
                            <div class="card">
                                <!-- <div class="card-header">

                                </div> -->
                                <!-- /.card-header -->


                                <?php

                                $user = mysqli_query($conn, "SELECT * FROM v_wdpengajuan");
                                $row_user = $user->fetch_assoc();

                                ?>

                                <div class="card-body">
                                    <table id="example" class="table table-striped table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Nomor</th>
                                                <th>NIM</th>
                                                <th>Nama </th>
                                                <th>Jenis</th>
                                                <th>Tanggal Pengajuan</th>
                                                <th>Semester Cuti/Aktif</th>
                                                <th>Tahun Akademik</th>
                                                <th>Status</th>
                                                <th>Verifikasi</th>
                                            </tr>
                                        </thead>


                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($user as $row_user) {
                                                $id_pengajuan = $row_user['id_pengajuan'];
                                                $sql = mysqli_query($conn, "SELECT status FROM tb_pengajuan WHERE id_pengajuan = '$id_pengajuan'");
                                                $result = mysqli_fetch_array($sql);
                                            ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $row_user['nim'] ?></td>
                                                    <td><?php echo $row_user['nama'] ?></td>
                                                    <td><?php echo $row_user['jns_pengajuan'] ?></td>
                                                    <td><?= tgl($row_user['tgl_pengajuan']); ?></td>
                                                    <td><?php echo $row_user['semester_cuti'] ?></td>
                                                    <td><?php echo $row_user['thn_akademik'] ?></td>
                                                    <?php
                                                    if (empty($result['status'])) {
                                                        $stt = "Menunggu verifikasi dosen wali";
                                                        $warna = 'red';
                                                    } else {
                                                        if ($result['status'] == "1") {
                                                            $stt = "Telah diverikasi dosen wali";
                                                            $warna = 'cornflowerblue';
                                                        } elseif ($result['status'] == "2") {
                                                            $stt = "Silahkan verifikasi";
                                                            $warna = 'red';
                                                        } elseif ($result['status'] == "3") {
                                                            $stt = "Anda telah memverikasi";
                                                            $warna = 'darkorchid';
                                                        } elseif ($result['status'] == "4") {
                                                            $stt = "Selesai diverifikasi";
                                                            $warna = 'green';
                                                        } elseif ($result['status'] == "5") {
                                                            $stt = "Ditolak";
                                                            $warna = 'yellow';
                                                        } else {
                                                            $stt = "Status not found";
                                                            $warna = '';
                                                        }
                                                    } ?>
                                                    <td style="color: <?php echo $warna; ?>;">
                                                        <?php
                                                        echo "$stt";
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if (empty($result['status'])) {
                                                            echo "";
                                                        } elseif ($result['status'] == "2") { ?>
                                                            <!-- $level dari sidebar -->
                                                            <a href="terima_p.php?id=<?= $row_user['id_pengajuan']; ?>&nip_npak=<?= $nip_npak; ?>&jabatan=<?= $level; ?>" onclick="return confirm('Anda yakin menerima pengajuan ini?')" class="btn btn-outline-none"><i class="fas fa-check" style="color: green;"></i>
                                                                ACC &nbsp;&nbsp;</a>
                                                            <a href="tolak_p.php?id=<?= $row_user['id_pengajuan']; ?>&nip_npak=<?= $nip_npak; ?>" class="btn btn-outline-none" onclick="return confirm('Anda yakin menolak pengajuan ini?')"><i class="fas fa-times" style="color: red;"></i>
                                                                Tolak</a>
                                                        <?php } else {
                                                            echo "Terverifikasi";
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php
                                                $i++;
                                            }
                                            ?>
                                        </tbody>

                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
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

        <!-- Page specific script -->
        <script>
            $(function() {
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
            });
        </script>

        <!-- Select2 -->
        <script src="../../../public/plugins/select2/js/select2.full.min.js"></script>


        <!-- datatable -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#example').DataTable();
            });
        </script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">

    </div>
</body>

</html>