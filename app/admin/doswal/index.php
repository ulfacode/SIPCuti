<?php
include "../../config/f_doswal.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Dosen Wali</title>

    <?php
    include "../../../public/rel.php";
    ?>
</head>

<body class="hold-transition sidebar-mini">
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
                            <h1>Data Dosen Wali</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item">Data Dosen Wali</li>
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
                                    <a href="" class="btn btn-info" data-toggle="modal" data-target="#modal-doswal">Tambah Data</a>
                                </div>
                                <!-- /.card-header -->

                                <?php
                                include "modal_tambah.php";


                                $user = mysqli_query($conn, "SELECT * FROM v_data_doswal");
                                $row_user = $user->fetch_assoc();

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
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Nomor</th>
                                                <th>NIP/NPAK</th>
                                                <th>Nama</th>
                                                <th>Tahun Jabatan</th>
                                                <th>Status</th>
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
                                                    <td><?php echo $row_user['nip_npak'] ?></td>
                                                    <td><?php echo $row_user['nama'] ?></td>
                                                    <td><?php echo $row_user['thn_jabatan'] ?></td>
                                                    <td><?php echo $row_user['status'] ?></td>
                                                    <td>
                                                        <a class="btn btn-primary" data-toggle="modal" data-target="#myModal<?php echo $row_user['id_doswal']; ?>">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </a>

                                                        <a style="color: white;" class="btn btn-warning" href="hapus.php?id=<?php echo $row_user['id_doswal']; ?>" onclick="return confirm('Anda yakin mau menghapus data ini ?')">
                                                            <i class="fa fa-trash"></i> Hapus
                                                        </a>

                                                    </td>

                                                </tr>

                                            <?php
                                                include "modal_edit.php";
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

</body>

</html>