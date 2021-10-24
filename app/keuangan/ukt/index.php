<?php
include '../../config/f_bayar.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pembayaran Uang Kuliah Tunggal</title>

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
                                <!-- <div class="card-header">

                                </div> -->
                                <!-- /.card-header -->


                                <?php


                                if (isset($_POST["tombol_validasi"])) {
                                    if (validasi($_POST) > 0) {
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

                                $user = mysqli_query($conn, "SELECT * FROM v_bayar");
                                $row_user = $user->fetch_assoc();

                                ?>

                                <div class="card-body">
                                    <table id="example" class="table table-striped table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Nomor</th>
                                                <th>NIM</th>
                                                <th>Nama </th>
                                                <th>Semester</th>
                                                <th>Jumlah</th>
                                                <th>Tanggal Bayar</th>
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
                                                    <td><?php echo $row_user['nim'] ?></td>
                                                    <td><?php echo $row_user['nama'] ?></td>
                                                    <td><?php echo $row_user['ukt_smt'] ?></td>
                                                    <td><?php echo $row_user['jumlah'] ?></td>
                                                    <td><?= tgl($row_user['tgl_bayar']); ?></td>
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

                                                        <a href="../../mahasiswa/bayar_ukt/img/<?= $row_user['bukti'] ?>" class="btn">
                                                            <i class="fa fa-eye" style="color: magenta;"></i> Bukti
                                                        </a>

                                                        <a class="btn" data-toggle="modal" data-target="#validasi">
                                                            <i class="fa fa-edit" style="color: mediumblue;"></i> Validasi
                                                        </a>

                                                    </td>
                                                </tr>

                                                <!-- Modal Validasi-->
                                                <div class="modal fade" id="validasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Validasi Pembayaran</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick='window.location.reload();'>
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="" method="POST" enctype="multipart/form-data">
                                                                <div class="modal-body">

                                                                    <input type="hidden" name="id_bayar" value="<?= $row_user['id_bayar']; ?>">

                                                                    <div class="form-group">
                                                                        <label for="">Validasi</label>
                                                                        <select name="validasi" id="validasi" class="form-control">
                                                                            <option hidden selected></option>
                                                                            <option value="Valid">Valid</option>
                                                                            <option value="Invalid">Invalid</option>
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <!-- untuk submit name nya harus sama dengan function -->
                                                                    <button name="tombol_validasi" class="btn btn-primary">Simpan</button>
                                                                </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- /modal Validasi -->

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