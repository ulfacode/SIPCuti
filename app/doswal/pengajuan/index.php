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
        <?php include "../../../public/sidebar.php"; ?>

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

                                $user = mysqli_query($conn, "SELECT m.nim, m.nama, p.id_pengajuan, p.jns_pengajuan, p.tgl_pengajuan, p.semester_cuti, p.thn_akademik, p.alasan, p.status, p.upload_sk FROM tb_mahasiswa AS m, tb_pengajuan AS p, tb_doswal AS d WHERE m.nim = p.nim AND m.id_doswal=d.id_doswal AND d.nip_npak='$nip_npak' ORDER BY tgl_pengajuan ASC");
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
                                                <th>Alasan</th>
                                                <th>Status</th>
                                                <th>Verifikasi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>


                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($user as $row_user) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $row_user['nim'] ?></td>
                                                    <td><?php echo $row_user['nama'] ?></td>
                                                    <td><?php echo $row_user['jns_pengajuan'] ?></td>
                                                    <td><?= tgl($row_user['tgl_pengajuan']); ?></td>
                                                    <td><?php echo $row_user['semester_cuti'] ?></td>
                                                    <td><?php echo $row_user['thn_akademik'] ?></td>
                                                    <td><?php echo $row_user['alasan'] ?></td>
                                                    <?php
                                                    if (empty($row_user['status'])) {
                                                        $stt = "Silahkan verifikasi";
                                                        $warna = 'red';
                                                    } else {
                                                        if ($row_user['status'] == "1") {
                                                            $stt = "Anda telah memverifikasi";
                                                            $warna = 'cornflowerblue';
                                                        } elseif ($row_user['status'] == "2") {
                                                            $stt = "Telah diverifikasi ketua jurusan";
                                                            $warna = 'brown';
                                                        } elseif ($row_user['status'] == "3") {
                                                            $stt = "Telah diverifikasi wakil direktur 1";
                                                            $warna = 'darkorchid';
                                                        } elseif ($row_user['status'] == "4") {
                                                            $stt = "Selesai diverifikasi";
                                                            $warna = 'green';
                                                        } elseif ($row_user['status'] == "5") {
                                                            $stt = "Ditolak";
                                                            $warna = 'orange';
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
                                                        <!-- tombol verifikasi -->
                                                        <?php
                                                        if (empty($row_user['status'])) { ?>
                                                            <!-- $level dari sidebar -->
                                                            <a href="terima_p.php?id=<?= $row_user['id_pengajuan']; ?>&nip_npak=<?= $nip_npak; ?>&jabatan=<?= $level; ?>" onclick="return confirm('Anda yakin menerima pengajuan ini?')" class="btn btn-outline-none"><i class="fas fa-check" style="color: green;"></i>
                                                                ACC &nbsp;&nbsp;</a>
                                                            <a href="tolak_p.php?id=<?= $row_user['id_pengajuan']; ?>&nip_npak=<?= $nip_npak; ?>" class="btn btn-outline-none" onclick="return confirm('Anda yakin menolak pengajuan ini?')"><i class="fas fa-times" style="color: red;"></i>
                                                                Tolak</a>
                                                        <?php } else {
                                                            echo "Terverfikasi";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>

                                                        <!-- references: https://www.rajaputramedia.com/artikel/membuat-script-download-file-dengan-php-mysql.php -->
                                                        <!-- <a class="btn" href="download_sk.php?filename=<?= $row_user['lampiran'] ?>">
                                                            <i class="fa fa-download"></i> SK
                                                        </a> -->

                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-success">
                                                                <!-- <i class="fa fa-file-alt"></i>  -->
                                                                <i class="fa fa-tools"></i>
                                                                <!-- Aksi -->
                                                            </button>
                                                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                                                <span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <div class="dropdown-menu" role="menu">
                                                                <!-- <a class="btn btn-primary dropdown-item" data-toggle="modal" data-target="#modalEdit<?php echo $row_user['id_pengajuan']; ?>">
                                                                        <i class="fa fa-edit"></i>
                                                                        Edit
                                                                    </a> -->
                                                                <?php
                                                                if ($row_user['jns_pengajuan'] == 'Cuti') { ?>
                                                                    <a class="dropdown-item" href="../../mahasiswa/pengajuan/img/<?php echo $row_user['upload_sk']; ?>">
                                                                        <i class="fa fa-download"></i> SK Cuti
                                                                    </a>
                                                                <?php
                                                                } else { ?>
                                                                    <a class="dropdown-item" href="../../mahasiswa/pengajuan/img/<?php echo $row_user['upload_sk']; ?>">
                                                                        <i class="fa fa-download"></i> SK Aktif
                                                                    </a>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
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