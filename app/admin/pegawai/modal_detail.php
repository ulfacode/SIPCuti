<div class="modal fade" id="modal-detail<?php echo $row_user['nip_npak']; ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Pegawai</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $id = $row_user["nip_npak"];
                $data = mysqli_query($conn, "SELECT * FROM tb_pegawai WHERE nip_npak = '$id' ORDER BY nama ASC");
                while ($pgw = mysqli_fetch_array($data)) {
                ?>
                    <div class="card card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <!-- <img class="profile-user-img img-fluid img-circle" src="../../../public/dist/img/user4-128x128.jpg" alt="User profile picture"> -->
                                <img class="profile-user-img img-fluid img-circle" src="../pegawai/img/<?= $pgw['foto']; ?>" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"><?= $pgw['nama']; ?></h3>

                            <p class="text-muted text-center"> <?= $pgw['nip_npak']; ?></p>

                            <ul class="list-group list-group-unbordered mb-3">


                                <li class="list-group-item">
                                    <b>Jabatan</b>
                                    <a class="float-right">
                                        <?php
                                        $jabatan = mysqli_query($conn, "SELECT jb.nama_jabatan FROM tb_pegawai AS p, tb_hak_akses AS hak, tb_jabatan AS jb WHERE p.nip_npak=hak.nip_npak AND hak.id_jabatan=jb.id_jabatan AND p.nip_npak='$pgw[nip_npak]'");

                                        while ($jabatans = mysqli_fetch_array($jabatan)) {
                                            if (!($jabatans['nama_jabatan'] == 'Ketua Jurusan')) {
                                                echo $jabatans['nama_jabatan'] . "<br>";
                                            } else {
                                                echo "Ketua Jurusan/Koordinator Prodi" . "<br>";
                                            }
                                        } ?>
                                    </a>
                                </li>
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