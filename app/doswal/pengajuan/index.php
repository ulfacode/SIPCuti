<?php
include '../../config/f_pengajuan.php';
session_start();

$nip_npak = $_SESSION['nip_npak'];

// untuk tolak pengajuan
if (isset($_POST["simpan"])) {
    if (tolak($_POST) > 0) {
        echo "
            <script>
                alert('Data Berhasil Diverifikasi!');
                document.location.href = 'index.php';
            </script>
            ";
    } else {
        echo "
            <script> 
                alert('Data Gagal Diverifikasi!');
                document.location.href = 'index.php';
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

                                $user = mysqli_query($conn, "SELECT m.nim, m.nama, p.id_pengajuan, p.jns_pengajuan, p.tgl_pengajuan, p.semester_cuti, p.thn_akademik, p.alasan, p.lampiran, p.status, p.upload_sk FROM tb_mahasiswa AS m, tb_pengajuan AS p, tb_doswal AS d WHERE m.id_mahasiswa = p.id_mahasiswa AND m.id_doswal=d.id_doswal AND d.id_pegawai='$_SESSION[id_pegawai]' ORDER BY tgl_pengajuan ASC");
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
                                                    <td><?php echo $row_user['nim'] ?></td>
                                                    <td><?php echo $row_user['nama'] ?></td>
                                                    <td><?php echo $row_user['jns_pengajuan'] ?></td>
                                                    <td><?= tgl($row_user['tgl_pengajuan']); ?></td>
                                                    <td><?php echo $row_user['semester_cuti'] ?></td>
                                                    <td><?php echo $row_user['thn_akademik'] ?></td>
                                                    <td><?php echo $row_user['alasan'] ?></td>

                                                    <?php
                                                    // keu - doswal - kajur - wadir1 - admin - tolak
                                                    if (empty($row_user['status'])) {
                                                        if ($row_user['jns_pengajuan'] == 'Cuti') {
                                                            $stt = "Menunggu verifikasi Bagian Keuangan";
                                                            $warna = 'red';
                                                        } else {
                                                            $stt = "Silahkan verifikasi!";
                                                            $warna = 'red';
                                                        }
                                                    } else {
                                                        if ($row_user['status'] == "1") {
                                                            $stt = "Silahkan verifikasi!";
                                                            $warna = 'red';
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
                                                        <!-- tombol verifikasi -->
                                                        <?php
                                                        if (empty($row_user['status'])) {
                                                            if ($row_user['jns_pengajuan'] == 'Izin Aktif') { ?>
                                                                <a href="terima_p.php?id=<?= $row_user['id_pengajuan']; ?>&id_pegawai=<?= $_SESSION['id_pegawai']; ?>&jabatan=<?= $level; ?>" onclick="return confirm('Anda yakin menerima pengajuan ini?')" class="btn btn-outline-none"><i class="fas fa-check" style="color: green;"></i>
                                                                    ACC</a>
                                                                <!-- <a href="tolak_p.php?id=<?= $row_user['id_pengajuan']; ?>&nip_npak=<?= $_SESSION['id_pegawai']; ?>" class="btn btn-outline-none" onclick="return confirm('Anda yakin menolak pengajuan ini?')"><i class="fas fa-times" style="color: red;"></i>
                                                                    Tolak</a> -->
                                                                <a data-toggle="modal" data-target="#modal-keterangan<?php echo $row_user['id_pengajuan']; ?>">
                                                                    <i class="fas fa-times" style="color: red;"></i>
                                                                    Tolak
                                                                </a>
                                                            <?php
                                                            } else {
                                                                echo "";
                                                            }
                                                        } elseif ($row_user['status'] == '1') {
                                                            ?>
                                                            <!-- $level dari sidebar -->
                                                            <a href="terima_p.php?id=<?= $row_user['id_pengajuan']; ?>&id_pegawai=<?= $_SESSION['id_pegawai']; ?>&jabatan=<?= $level; ?>" onclick="return confirm('Anda yakin menerima pengajuan ini?')" class="btn btn-outline-none"><i class="fas fa-check" style="color: green;"></i>
                                                                ACC</a>
                                                            <a data-toggle="modal" data-target="#modal-keterangan<?php echo $row_user['id_pengajuan']; ?>"><i class="fas fa-times" style="color: red;"></i>
                                                                Tolak
                                                            </a>
                                                        <?php
                                                        } else {
                                                            echo "Terverfikasi";
                                                        }
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
                                                                                $query     = mysqli_query($conn, "SELECT p.nama, p.jabatan, v.tgl_verif, v.status, v.keterangan FROM tb_verifikasi AS v, tb_pegawai AS p WHERE v.id_pegawai=p.id_pegawai AND v.id_pengajuan='$row_user[id_pengajuan]'");
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
                                                                                                <!-- <td><?= $result['nama_jabatan']; ?></td> -->
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
                                                                if ($row_user['jns_pengajuan'] == 'Cuti') {

                                                                ?>
                                                                    <a class="dropdown-item <?php echo $tombol; ?>" href="../../admin/pengajuan/form_cuti.php?id=<?php echo $row_user['id_pengajuan']; ?>">
                                                                        <i class="fa fa-download"></i> Form Cuti
                                                                    </a>
                                                                    <a class="dropdown-item" href="../../mahasiswa/pengajuan/img/<?php echo $row_user['lampiran']; ?>">
                                                                        <i class="fa fa-download"></i> Lampiran
                                                                    </a>
                                                                <?php
                                                                } else { ?>
                                                                    <a class="dropdown-item <?php echo $tombol; ?>" href="../../admin/pengajuan/form_aktif.php?id=<?php echo $row_user['id_pengajuan']; ?>">
                                                                        <i class="fa fa-download"></i> Form Aktif
                                                                    </a>
                                                                    <a class="dropdown-item" href="../../mahasiswa/pengajuan/img/<?php echo $row_user['lampiran']; ?>">
                                                                        <i class="fa fa-download"></i> Lampiran
                                                                    </a>
                                                                <?php
                                                                }
                                                                ?>

                                                                <?php if (empty($row_user['upload_sk'])) { //cek data
                                                                ?>
                                                                    <a class="dropdown-item" onclick="alert('Oopss... SK belum terbit. Harap bersabar ya!')"><i class="fa fa-download"></i>
                                                                        <?php if ($row_user['jns_pengajuan'] == 'Cuti') { ?>
                                                                            SK Cuti
                                                                        <?php
                                                                        } else { ?>
                                                                            SK Aktif
                                                                    </a>
                                                                <?php }
                                                                    } else {
                                                                ?>
                                                                <a class="dropdown-item" href="../../admin/pengajuan/surat_keputusan/<?php echo $row_user['upload_sk'] ?>">
                                                                    <i class="fa fa-download"></i>
                                                                    <?php if ($row_user['jns_pengajuan'] == 'Cuti') { ?>
                                                                        SK Cuti
                                                                    <?php
                                                                        } else { ?>
                                                                        SK Aktif
                                                                </a>
                                                        <?php }
                                                                    } ?>
                                                            </div>
                                                        </div>


                                                    </td>
                                                </tr>
                                            <?php
                                                $i++;
                                                include "modal_ket_tolak.php";
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