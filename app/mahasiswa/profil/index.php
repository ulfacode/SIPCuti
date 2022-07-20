<?php
include '../../config/f_profil_mahasiswa.php';
session_start();
$id = $_SESSION['nim'];


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
    <title>Profil Mahasiswa</title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
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
                            <h1>Halaman Profil <?php echo $_SESSION['nama']; ?></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item">Profil User</li>
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
                            $tb_doswal = sql("SELECT tb_pegawai.nama FROM tb_doswal, tb_pegawai, tb_mahasiswa WHERE tb_mahasiswa.id_doswal = tb_doswal.id_doswal AND tb_doswal.id_pegawai = tb_pegawai.id_pegawai AND tb_mahasiswa.id_mahasiswa = '$_SESSION[id_mahasiswa]'");
                            $tb_kajur = sql("SELECT tb_pegawai.nama FROM tb_kajur, tb_pegawai, tb_mahasiswa WHERE tb_mahasiswa.id_kajur = tb_kajur.id_kajur AND tb_kajur.id_pegawai = tb_pegawai.id_pegawai AND tb_mahasiswa.id_mahasiswa = '$_SESSION[id_mahasiswa]'");


                            $data = mysqli_query($conn, "SELECT * FROM tb_mahasiswa WHERE id_mahasiswa = '$_SESSION[id_mahasiswa]'");
                            while ($mhs = mysqli_fetch_array($data)) {
                            ?>

                                <div class="card card-outline">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            <!-- <img class="profile-user-img img-fluid img-circle" src="../../../public/dist/img/user4-128x128.jpg" alt="User profile picture"> -->
                                            <a class="btn" data-toggle="modal" data-target="#modalFoto">
                                                <img class="" style="width: 100px; height: 100px; max-width: 100px; max-height: 100px; -webkit-border-radius: 50%; -moz-border-radius: 50%; border-radius: 50%; border: 2px solid rgba(255,255,255,0.5);" src="../../admin/mahasiswa/img/<?= $mhs['foto']; ?>" alt="User profile picture">
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
                                                                <img src="../../admin/mahasiswa/img/<?= $mhs['foto']; ?>" alt="" class="img-responsive">
                                                            </center>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <!-- tombol edit foto -->
                                                            <a class="btn btn-primary" data-toggle="modal" data-target="#modalEditFoto">Edit Foto</a>

                                                            <?php
                                                            include "modal_edit_foto.php";
                                                            ?>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /modal gambar -->

                                        </div>

                                        <h3 class="profile-username text-center"><?= $mhs['nama']; ?></h3>

                                        <p class="text-muted text-center"> <?= $mhs['nim']; ?></p>

                                        <ul class="list-group list-group-unbordered mb-3">
                                            <li class="list-group-item">
                                                <?php
                                                foreach ($tb_doswal as $dw) {
                                                ?>
                                                    <b>Dosen Wali</b> <a class="float-right"><?= $dw['nama']; ?></a>
                                            </li>
                                        <?php
                                                }
                                        ?>
                                        <li class="list-group-item">
                                            <?php
                                            foreach ($tb_kajur as $kj) {
                                            ?>
                                                <b>Ketua Jurusan</b> <a class="float-right"><?= $kj['nama']; ?></a>
                                        </li>
                                    <?php
                                            }
                                    ?>
                                    <li class="list-group-item">
                                        <b>Email</b> <a class="float-right"><?= $mhs['email']; ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Tahun Angkatan</b> <a class="float-right"><?= $mhs['thn_angkatan']; ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Kelas</b> <a class="float-right"><?= $mhs['kelas']; ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Tempat Tanggal Lahir</b> <a class="float-right"><?= $mhs['tempat_lhr']; ?> , <?= tgl($mhs['tgl_lhr']); ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Jenis Kelamin</b> <a class="float-right"><?= $mhs['jk']; ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Alamat</b> <a class="float-right"><?= $mhs['alamat']; ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Nomor Telepon</b> <a class="float-right"><?= $mhs['no_telp']; ?></a>
                                    </li>


                                    <li class="list-group-item">
                                        <b>Tanda Tangan</b>
                                        <a class="btn float-right" data-toggle="modal" data-target="#myModal">
                                            <img src="../../admin/mahasiswa/img/<?= $mhs['ttd']; ?>" alt="Tanda Tangan" class="profile-user-img img-fluid">
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
                                                            <img src="../../admin/mahasiswa/img/<?= $mhs['ttd']; ?>" alt="" class="img-responsive">
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
                                        <a class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-edit<?php echo $mhs['nim']; ?>">
                                            <i class="fa fa-edit"></i> Edit Profil
                                        </a>
                                        <!-- modal edit profil -->
                                        <div class="modal fade" id="modal-edit<?php echo $mhs['nim']; ?>">
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
                                                            $id = $mhs["nim"];
                                                            $data = mysqli_query($conn, "SELECT * FROM tb_mahasiswa WHERE nim = '$id'");
                                                            while ($mahasiswa = mysqli_fetch_array($data)) {
                                                            ?>
                                                                <div class="form-group">
                                                                    <label for="nim">NIM</label>
                                                                    <input type="number" class="form-control" id="nim" name="nim" value="<?= $mahasiswa["nim"]; ?>" readonly>
                                                                </div>


                                                                <div class="form-group">
                                                                    <label for="">Nama</label>
                                                                    <input type="text" class="form-control" name="nama" maxlength="50" value="<?= $mahasiswa["nama"]; ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Email</label>
                                                                    <input type="text" class="form-control" name="email" maxlength="100" value="<?= $mahasiswa["email"]; ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Password</label>
                                                                    <input type="password" class="form-control" name="password" minlength="4" maxlength="15" value="<?= $mahasiswa["password"]; ?>" required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">Tempat Lahir</label>
                                                                    <input type="text" class="form-control" name="tempat_lhr" required value="<?= $mahasiswa["tempat_lhr"]; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Tanggal Lahir</label>
                                                                    <input type="date" class="form-control" name="tgl_lhr" required value="<?= $mahasiswa["tgl_lhr"]; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Jenis Kelamin</label>
                                                                    <select class="form-control" name="jk">
                                                                        <option hidden selected><?= $mahasiswa["jk"]; ?></option>
                                                                        <option value="Laki-laki">Laki-laki</option>
                                                                        <option value="Perempuan">Perempuan</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="alamat">Alamat</label>
                                                                    <textarea class="form-control" rows="4" name="alamat"><?= $mahasiswa["alamat"]; ?></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="no_telp">Nomor Telepon</label>
                                                                    <input id="no_telp" class="form-control" type="number" name="no_telp" value="<?= $mahasiswa["no_telp"]; ?>" required="required">
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