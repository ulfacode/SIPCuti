<div class="modal fade" id="modal-detail<?php echo $row_user['id_mahasiswa']; ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Mahasiswa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <?php
                $id = $row_user["nim"];

                $tb_doswal = sql("SELECT tb_pegawai.nama FROM tb_doswal, tb_pegawai, tb_mahasiswa WHERE tb_mahasiswa.id_doswal = tb_doswal.id_doswal AND tb_doswal.id_pegawai = tb_pegawai.id_pegawai AND tb_mahasiswa.nim = '$id'");
                $tb_kajur = sql("SELECT tb_pegawai.nama FROM tb_kajur, tb_pegawai, tb_mahasiswa WHERE tb_mahasiswa.id_kajur = tb_kajur.id_kajur AND tb_kajur.id_pegawai = tb_pegawai.id_pegawai AND tb_mahasiswa.nim = '$id'");


                $data = mysqli_query($conn, "SELECT * FROM tb_mahasiswa WHERE nim = '$id'");
                while ($mhs = mysqli_fetch_array($data)) {
                ?>

                    <div class="card card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <!-- <img class="profile-user-img img-fluid img-circle" src="../../../public/dist/img/user4-128x128.jpg" alt="User profile picture"> -->
                                <img class="profile-user-img img-fluid img-circle" src="../mahasiswa/img/<?= $mhs['foto']; ?>" alt="User profile picture">
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
                            <b>TTL</b> <a class="float-right"><?= $mhs['tempat_lhr']; ?> , <?= tgl($mhs['tgl_lhr']); ?></a>
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
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                <?php } ?>
            </div>
            <div class="modal-footer justify-content-between">
                <!-- <a href="index.php" type="submit" onclick='window.location.reload();' class="btn btn-default" data-dismiss="modal">Tutup</a>
                <button type="edit" id="edit" name="edit" value="edit" class="btn btn-primary">Simpan Perubahan</button> -->
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->