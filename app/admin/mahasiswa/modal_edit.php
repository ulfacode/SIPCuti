<div class="modal fade" id="myModal<?php echo $row_user['nim']; ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data Mahasiswa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="window.location.reload();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                <form action="" enctype="multipart/form-data" method="POST">
                    <?php
                    $tb_doswal = sql("SELECT * FROM tb_doswal, tb_pegawai WHERE tb_doswal.nip_npak = tb_pegawai.nip_npak ORDER BY tb_pegawai.nama ASC");
                    $tb_kajur = sql("SELECT * FROM tb_kajur, tb_pegawai WHERE tb_kajur.nip_npak = tb_pegawai.nip_npak ORDER BY tb_pegawai.nama ASC");

                    $id = $row_user["nim"];

                    $nama_doswal = sql("SELECT tb_pegawai.nama, tb_doswal.id_doswal FROM tb_pegawai, tb_doswal, tb_mahasiswa WHERE tb_mahasiswa.nim = '$id' AND tb_pegawai.nip_npak = tb_doswal.nip_npak AND tb_doswal.id_doswal=tb_mahasiswa.id_doswal;");
                    $nama_kajur = sql("SELECT tb_pegawai.nama, tb_kajur.id_kajur FROM tb_pegawai, tb_kajur, tb_mahasiswa WHERE tb_mahasiswa.nim = '$id' AND tb_pegawai.nip_npak = tb_kajur.nip_npak AND tb_kajur.id_kajur=tb_mahasiswa.id_kajur;");

                    $data = mysqli_query($conn, "SELECT * FROM tb_mahasiswa WHERE nim = '$id'");
                    while ($mhs = mysqli_fetch_array($data)) {
                    ?>
                        <div class="form-group">
                            <label for="nim">NIM</label>
                            <input type="number" class="form-control" id="nim" name="nim" value="<?= $mhs["nim"]; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="doswal">Dosen Wali</label>
                            <select name="id_doswal" class="form-control select2bs4" style="width: 100%;">

                                <?php
                                foreach ($nama_doswal as $nm) {
                                ?>
                                    <option hidden selected value="<?php echo $nm['id_doswal'] ?>"><?= $nm["nama"]; ?></option>
                                <?php
                                }
                                ?>


                                <?php
                                foreach ($tb_doswal as $row_user) {
                                ?>
                                    <option value="<?php echo $row_user['id_doswal'] ?>"><?php echo $row_user['nama']; ?> (<?php echo $row_user['nip_npak']; ?>)</option>
                                <?php
                                }
                                ?>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="kajur">Ketua Jurusan</label>
                            <select name="id_kajur" class="form-control select2bs4" style="width: 100%;">

                                <?php
                                foreach ($nama_kajur as $nm) {
                                ?>
                                    <option hidden selected value="<?php echo $nm['id_kajur'] ?>"><?= $nm["nama"]; ?></option>
                                <?php
                                }
                                ?>


                                <?php
                                foreach ($tb_kajur as $row_user) {
                                ?>
                                    <option value="<?php echo $row_user['id_kajur'] ?>"><?php echo $row_user['nama']; ?> (<?php echo $row_user['nip_npak']; ?>)</option>
                                <?php
                                }
                                ?>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= $mhs["username"]; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" value="<?= $mhs["password"]; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $mhs["nama"]; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="thn_angkatan">Tahun Angkatan</label>
                            <select class="form-control" id="thn_angkatan" name="thn_angkatan">
                                <option hidden selected><?= $mhs["thn_angkatan"]; ?></option>
                                <?php
                                for ($i = date('Y'); $i >= date('Y') - 45; $i -= 1) {
                                    echo "<option value='$i'> $i </option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <input id="kelas" class="form-control" type="text" name="kelas" required="required" value="<?= $mhs["kelas"]; ?>">
                        </div>
                        <div class="form-group">
                            <label for="tempat_lhr">Tempat Lahir</label>
                            <input id="tempat_lhr" class="form-control" type="text" name="tempat_lhr" required="required" value="<?= $mhs["tempat_lhr"]; ?>">
                        </div>
                        <div class="form-group">
                            <label for="tgl_lhr">Tanggal Lahir</label>
                            <input id="tgl_lhr" class="form-control" type="text" name="tgl_lhr" required="required" value="<?= $mhs["tgl_lhr"]; ?>">
                        </div>
                        <div class="form-group">
                            <label for="jk">Jenis Kelamin</label>
                            <select class="form-control" name="jk">
                                <option hidden selected><?= $mhs["jk"]; ?></option>
                                <option value="Laki-laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" rows="4" name="alamat"><?= $mhs["alamat"]; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="no_telp">Nomor Telepon</label>
                            <input id="no_telp" class="form-control" type="number" name="no_telp" value="<?= $mhs["no_telp"]; ?>" required="required">
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