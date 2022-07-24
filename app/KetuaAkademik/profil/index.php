<?php
include '../../config/f_profil_pegawai.php';

session_start();
$id = $_SESSION['nip_npak'];

if (isset($_POST["editFoto"])) {
    if (editFoto($_POST) > 0) {
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
if (isset($_POST["editTTD"])) {
    if (editTTD($_POST) > 0) {
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


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil Ketua Akademik</title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <style>
        img {
            width: 400px;
            height: 500px;
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
                            <h1>Profil Koordinator Subbagian Akademik dan Kemahasiswaan</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../dashboard/index.php">Home</a></li>
                                <li class="breadcrumb-item">Profil Koordinator Subbagian Akademik dan Kemahasiswaan</li>
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


                            <?php
                            // ambil nip dari login

                            $data = mysqli_query($conn, "SELECT * FROM tb_pegawai WHERE nip_npak = '$id'");
                            while ($pgw = mysqli_fetch_array($data)) {
                            ?>

                                <div class="card card-outline">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            <a class="btn" data-toggle="modal" data-target="#modalFoto">
                                                <img class="" style="width: 100px; height: 100px; max-width: 100px; max-height: 100px; -webkit-border-radius: 50%; -moz-border-radius: 50%; border-radius: 50%; border: 2px solid rgba(255,255,255,0.5);" src="../../admin/pegawai/img/<?= $pgw['foto']; ?>" alt="User profile picture">
                                            </a>
                                            <!-- Modal Gambar-->
                                            <div class="modal fade" id="modalFoto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <center>
                                                                <img src="../../admin/pegawai/img/<?= $pgw['foto']; ?>" alt="" class="img-responsive">
                                                            </center>
                                                        </div>

                                                        <div class="modal-footer">

                                                            <!-- tombol edit foto -->
                                                            <a class="btn btn-primary" data-toggle="modal" data-target="#modalEditFoto">Edit Foto</a>

                                                            <?php include "modal_edit_foto.php"; ?>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /modal gambar -->

                                        </div>

                                        <h3 class="profile-username text-center"><?= $pgw['nama']; ?></h3>

                                        <p class="text-muted text-center"><?= $pgw['jabatan']; ?> (<?= $pgw['nip_npak']; ?>)</p>

                                        <ul class="list-group list-group-unbordered mb-3">

                                            <li class="list-group-item">
                                                <b>Email</b> <a class="float-right"><?= $pgw['email']; ?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Tahun Jabatan</b> <a class="float-right"><?= $pgw['thn_jabatan']; ?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Status</b> <a class="float-right"><?= $pgw['status']; ?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Nomor Telepon</b> <a class="float-right"><?= $pgw['no_telp']; ?></a>
                                            </li>


                                            <li class="list-group-item">
                                                <b>Tanda Tangan</b>
                                                <a class="btn float-right" data-toggle="modal" data-target="#myModal">
                                                    <img src="../../admin/pegawai/img/<?= $pgw['ttd']; ?>" alt="Tanda Tangan" class="profile-user-img img-fluid">
                                                </a>

                                                <!-- Modal Gambar TTD-->
                                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <center>
                                                                    <img src="../../admin/pegawai/img/<?= $pgw['ttd']; ?>" alt="" class="img-responsive">
                                                                </center>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <!-- tombol edit ttd -->
                                                                <a class="btn btn-primary" data-toggle="modal" data-target="#modalEditTTD">Edit TTD</a>

                                                                <?php include "modal_edit_ttd.php"; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /modal gambar TTD-->

                                            </li>


                                            <li class="list-group-item">
                                                <a class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-edit<?php echo $pgw['nip_npak']; ?>">
                                                    <i class="fa fa-edit"></i> Edit Profil
                                                </a>
                                                <!-- modal edit profil -->
                                                <div class="modal fade" id="modal-edit<?php echo $pgw['nip_npak']; ?>">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit Profil</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="window.location.reload();">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- form start -->
                                                                <form action="" method="POST">
                                                                    <?php
                                                                    $id = $pgw["nip_npak"];
                                                                    $data = mysqli_query($conn, "SELECT * FROM tb_pegawai WHERE nip_npak = '$id'");
                                                                    while ($pegawai = mysqli_fetch_array($data)) {
                                                                    ?>
                                                                        <div class="form-group">
                                                                            <label for="nip">NIP/NPAK</label>
                                                                            <input type="number" class="form-control" id="nip" name="nip" value="<?= $pegawai["nip_npak"]; ?>" readonly>
                                                                        </div>


                                                                        <div class="form-group">
                                                                            <label for="">Nama</label>
                                                                            <input type="text" class="form-control" name="nama" maxlength="50" value="<?= $pegawai["nama"]; ?>" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="">Email</label>
                                                                            <input type="email" class="form-control" name="email" maxlength="100" value="<?= $pegawai["email"]; ?>" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="">Password</label>
                                                                            <input type="password" class="form-control" name="password" minlength="4" maxlength="15" value="<?= $pegawai["password"]; ?>" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="no_telp">Nomor Telepon</label>
                                                                            <input id="no_telp" class="form-control" type="number" maxlength="13" name="no_telp" value="<?= $pegawai["no_telp"]; ?>" required="required">
                                                                        </div>
                                                                    <?php
                                                                    }
                                                                    ?>

                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <a href="data_pegawai.php" type="submit" onclick='window.location.reload();' class="btn btn-default" data-dismiss="modal">Tutup</a>

                                                                <!-- untuk submit name nya harus sama dengan function -->
                                                                <button name="edit" class="btn btn-primary">Simpan Perubahan</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                                <!-- /.modal -->


                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            <?php } ?>


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

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </div>
</body>

</html>