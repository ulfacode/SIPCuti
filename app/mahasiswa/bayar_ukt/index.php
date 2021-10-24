<?php
include '../../config/f_bayar.php';
session_start();
$id = $_SESSION['nim'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pembayaran UKT</title>

    <style>
        img {
            width: 400px;
            height: 400px;
        }
    </style>

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
                            <h1>Pembayaran Uang Kuliah Tunggal</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item">Pembayaran Uang Kuliah Tunggal</li>
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
                                    <button href="" class="btn btn-info" data-toggle="modal" data-target="#tambahBayar">Tambah Data</button>

                                </div>
                                <!-- /.card-header -->

                                <?php
                                include "modal_tambah.php";

                                $user = mysqli_query($conn, "SELECT * FROM tb_bayar WHERE nim = '$id' ORDER BY tgl_bayar ASC");
                                $row_user = $user->fetch_assoc();

                                if (isset($_POST["edit"])) {
                                    if (edit($_POST) > 0) {
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
                                if (isset($_POST["editBukti"])) {
                                    if (editBukti($_POST) > 0) {
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


                                if (isset($_POST["tambah"])) {
                                    if (tambah($_POST) > 0) {
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

                                ?>

                                <div class="card-body">
                                    <table id="example" class="table table-striped table-striped" style="width:100%">
                                        <thead>

                                            <tr>
                                                <th>Nomor</th>
                                                <th>UKT Semester</th>
                                                <th>Jumlah</th>
                                                <th>Tanggal Bayar</th>
                                                <th>Bukti</th>
                                                <th>Validasi</th>
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
                                                    <td><?php echo $row_user['ukt_smt'] ?></td>
                                                    <td><?php echo $row_user['jumlah'] ?></td>
                                                    <td><?= tgl($row_user['tgl_bayar']); ?></td>

                                                    <td>
                                                        <a class="btn" data-toggle="modal" data-target="#modalBukti">
                                                            <img class="custom-file" src="img/<?= $row_user['bukti']; ?>" alt="Bukti bayar">
                                                        </a>

                                                        <!-- Modal Bukti-->
                                                        <div class="modal fade" id="modalBukti" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <center>
                                                                            <img src="img/<?= $row_user['bukti']; ?>" alt="" class="img-responsive">
                                                                        </center>
                                                                    </div>


                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- /modal Bukti -->


                                                    </td>
                                                    <td>
                                                        <?php
                                                        if (($row_user['validasi']) == "Valid") {
                                                            $check = "fas fa-check";
                                                        } elseif (($row_user['validasi']) == "Invalid") {
                                                            $check = "fas fa-times";
                                                        } else {
                                                            $check = "";
                                                        }
                                                        ?>

                                                        <i class="<?php echo $check ?>"></i>

                                                    </td>
                                                    <td>
                                                        <a class="btn btn-primary" data-toggle="modal" data-target="#myModal<?php echo $row_user['id_bayar']; ?>">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </a>


                                                        <a style="color: white;" class="btn btn-warning" href="hapus.php?id_bayar=<?php echo $row_user['id_bayar']; ?>" onclick="return confirm('Anda yakin mau menghapus data ini ?')">
                                                            <i class="fa fa-trash"></i> Hapus
                                                        </a>
                                                        <?php include "modal_edit.php" ?>
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