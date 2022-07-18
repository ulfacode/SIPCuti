<?php
include '../../config/f_pengajuan.php';
session_start();
$id = $_SESSION['nim'];
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
                                <div class="card-header">

                                    <button href="" class="btn btn-info" data-toggle="modal" data-target="#tambahCuti">Ajukan Cuti</button>
                                    <button href="" class="btn btn-success" data-toggle="modal" data-target="#tambahAktif">Ajukan Izin Aktif</button>

                                    <?php
                                    include "modal_tambah.php";

                                    $user = mysqli_query($conn, "SELECT * FROM tb_pengajuan WHERE nim = '$id' ORDER BY tgl_pengajuan ASC");
                                    $row_user = $user->fetch_assoc();

                                    if (isset($_POST["editP"])) {
                                        if (editP($_POST) > 0) {
                                            echo "
                                                <script>
                                                    alert('Data Berhasil Diedit!');
                                                    document.location.href = 'index.php';
                                                </script>
                                            ";
                                        } else {
                                            echo "
                                                <script>
                                                    alert('Data Gagal Diedit!');
                                                    document.location.href = 'index.php';
                                                </script>
                                            ";
                                        }
                                    }

                                    if (isset($_POST["editLampiran"])) {
                                        if (editLampiran($_POST) > 0) {
                                            echo "
                                                <script>
                                                    alert('Lampiran Berhasil Diedit!');
                                                    document.location.href = 'index.php';
                                                </script>
                                            ";
                                        } else {
                                            echo "
                                                <script>
                                                    alert('Lampiran Gagal2 Diedit!');
                                                    document.location.href = 'index.php';
                                                </script>
                                            ";
                                        }
                                    }


                                    if (isset($_POST["editTTD"])) {
                                        if (editTTD($_POST) > 0) {
                                            echo "
                                                <script>
                                                    alert('Tanda Tangan Berhasil Diedit!');
                                                    document.location.href = 'index.php';
                                                </script>
                                            ";
                                        } else {
                                            echo "
                                                <script>
                                                    alert('Tanda Tangan Gagal Diedit!');
                                                    document.location.href = 'index.php';
                                                </script>
                                            ";
                                        }
                                    }


                                    if (isset($_POST["tambahCuti"])) {
                                        if (tambahCuti($_POST) > 0) {
                                            echo "
                                                <script>
                                                    alert('Data Berhasil Ditambahkan!');
                                                    document.location.href = 'index.php';
                                                </script>
                                            ";
                                        } else {
                                            echo "
                                                <script> 
                                                    alert('Data Gagal Ditambahkan!');
                                                    document.location.href = 'index.php';
                                                </script>
                                            ";
                                        }
                                    }

                                    if (isset($_POST["tambahAktif"])) {
                                        if (tambahAktif($_POST) > 0) {
                                            echo "
                                                <script>
                                                    alert('Data Berhasil Ditambahkan!');
                                                    document.location.href = 'index.php';
                                                </script>
                                            ";
                                        }
                                    }

                                    ?>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example" class="table table-striped table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Nomor</th>
                                                <th>Jenis</th>
                                                <th>Tanggal Pengajuan</th>
                                                <th>Semester Cuti/Aktif</th>
                                                <th>Tahun Akademik</th>
                                                <th>Alasan</th>
                                                <th>Nama Orang Tua</th>
                                                <th>Status</th>
                                                <th>Detail Status</th>
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
                                                    <td><?php echo $row_user['jns_pengajuan'] ?></td>
                                                    <!-- <td><a href="../../admin/pengajuan/surat_keputusan/<?php echo $row_user['upload_sk'] ?>" alt="">Klik</td> -->
                                                    <td><?= tgl($row_user['tgl_pengajuan']); ?></td>
                                                    <td><?php echo $row_user['semester_cuti'] ?></td>
                                                    <td><?php echo $row_user['thn_akademik'] ?></td>
                                                    <td><?php echo $row_user['alasan'] ?></td>
                                                    <td><?php echo $row_user['nama_ortu'] ?></td>
                                                    <?php
                                                    // keu - doswal - kajur - wadir1 - admin - tolak
                                                    if (empty($row_user['status'])) {
                                                        $stt = "Menunggu verifikasi Bagian Keuangan";
                                                        $warna = 'red';
                                                    } else {
                                                        if ($row_user['status'] == "1") {
                                                            $stt = "Menunggu verifikasi Dosen Wali";
                                                            $warna = 'cornflowerblue';
                                                        } elseif ($row_user['status'] == "2") {
                                                            $stt = "Menunggu verifikasi Ketua Jurusan/Kaprodi";
                                                            $warna = 'brown';
                                                        } elseif ($row_user['status'] == "3") {
                                                            if ($row_user['jns_pengajuan'] == 'Cuti') {
                                                                $stt = "Menunggu verifikasi Admin";
                                                                $warna = 'blue';
                                                            } else {
                                                                $stt = "Menunggu verifikasi Wakil Direktur I";
                                                                $warna = 'blue';
                                                            }
                                                        } elseif ($row_user['status'] == "4") {
                                                            $stt = "Menunggu verifikasi Admin";
                                                            $warna = 'darkorchid';
                                                        } elseif ($row_user['status'] == "5") {
                                                            $stt = "Selesai diverifikasi";
                                                            $warna = 'green';
                                                        } elseif ($row_user['status'] == "6") {
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
                                                        <a class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#cekStatus<?php echo $row_user['id_pengajuan'] ?>">
                                                            Cek Status
                                                        </a>
                                                        <!-- modal cek status -->
                                                        <div class="modal fade" id="cekStatus<?php echo $row_user['id_pengajuan'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Detail Pengajuan</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick='window.location.reload();'>
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                        <form action="" enctype="" method="">
                                                                            <div class="card-body">
                                                                                <?php
                                                                                // $query     = mysqli_query($conn, "SELECT p.nama, p.jabatan, v.tgl_verif, v.status, v.keterangan FROM tb_verifikasi AS v, tb_pegawai AS p WHERE v.nip_npak=p.nip_npak AND v.id_pengajuan='$row_user[id_pengajuan]'");
                                                                                $query     = mysqli_query($conn, "SELECT p.nama, v.tgl_verif, v.status, v.keterangan FROM tb_verifikasi AS v, tb_pegawai AS p WHERE v.nip_npak=p.nip_npak AND v.id_pengajuan='$row_user[id_pengajuan]'");
                                                                                $result = $query->fetch_assoc();
                                                                                ?>

                                                                                <table class="table table-bordered">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th style="width: 10px">#</th>
                                                                                            <th>Nama</th>
                                                                                            <!-- <th>Jabatan</th> -->
                                                                                            <th>Tanggal</th>
                                                                                            <th>Keterangan</th>
                                                                                            <th style="width: 40px">Status</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <?php
                                                                                        $a = 1;
                                                                                        foreach ($query as $result) {
                                                                                            if ($result['status'] == "Diterima") {
                                                                                                $color = "success";
                                                                                            } else {
                                                                                                $color = "danger";
                                                                                            }
                                                                                        ?>
                                                                                            <tr>
                                                                                                <td><?= $a; ?></td>
                                                                                                <td><?= $result['nama']; ?></td>
                                                                                                <!-- <td><?= $result['jabatan']; ?></td> -->
                                                                                                <td><?= tgl($result['tgl_verif']); ?></td>
                                                                                                <td><?= $result['keterangan']; ?></td>
                                                                                                <td><span class="badge bg-<?php echo $color; ?>"><?= $result['status']; ?></span></td>
                                                                                            </tr>
                                                                                        <?php

                                                                                            $a++;
                                                                                        }
                                                                                        ?>

                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                            <!-- /.card-body -->

                                                                    </div>
                                                                    <div class="modal-footer">

                                                                        <!-- untuk submit name nya harus sama dengan isset -->
                                                                        <button onclick="window.location.reload();" class="btn btn-primary">Tutup</button>

                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- ./modal cek status -->
                                                    </td>

                                                    <td>
                                                        <!-- button dropdown aksi -->
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-success">
                                                                <i class="fa fa-tools"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                                                <span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <div class="dropdown-menu" role="menu">
                                                                <!-- <a class="btn btn-primary dropdown-item" data-toggle="modal" data-target="#modalEdit<?php echo $row_user['id_pengajuan']; ?>">
                                                                        <i class="fa fa-edit"></i>
                                                                        Edit
                                                                    </a> -->
                                                                <a style="color: red;" class="dropdown-item" href="hapus.php?id=<?php echo $row_user['id_pengajuan']; ?>" onclick="return confirm('Anda yakin mau menghapus data ini ?')">
                                                                    <i class="fa fa-trash"></i>
                                                                    Hapus
                                                                </a>
                                                                <a style="color: blue;" class="dropdown-item" data-toggle="modal" data-target="#modalEdit<?php echo $row_user['id_pengajuan']; ?>">
                                                                    <i class="fa fa-edit"></i>
                                                                    Edit
                                                                </a>
                                                                <!-- <?php if ($row_user['status'] == '3') { ?>
                                                                    <a style="color: blueviolet;" class="dropdown-item" href="form_cuti.php?id=<?php echo $row_user['id_pengajuan']; ?>">
                                                                        <i class="fa fa-download"></i>
                                                                        Formulir
                                                                    </a>
                                                                <?php } else { ?>
                                                                    <a class="dropdown-item disabled" href="form_cuti.php?id=<?php echo $row_user['id_pengajuan']; ?>">
                                                                        <i class="fa fa-download"></i>
                                                                        Formulir
                                                                    </a>
                                                                <?php } ?> -->

                                                                <?php if (empty($row_user['upload_sk'])) { //cek data
                                                                ?>
                                                                    <!-- warna akan hitam jika tidak ada data -->
                                                                    <a class="dropdown-item" onclick="alert('Oopss... SK belum terbit. Harap bersabar ya!')"><i class="fa fa-download"></i> SK</a>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <!-- warna akan ungu jika ada data -->
                                                                    <a style="color: blueviolet;" class="dropdown-item" href="../../admin/pengajuan/surat_keputusan/<?php echo $row_user['upload_sk'] ?>">
                                                                        <i class="fa fa-download"></i>
                                                                        SK
                                                                    </a>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                                $i++;
                                                include "modal_edit.php";
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