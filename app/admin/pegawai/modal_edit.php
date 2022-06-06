<div class="modal fade" id="myModal<?php echo $row_user['nip_npak']; ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data Pegawai</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="window.location.reload();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                <form action="" enctype="multipart/form-data" method="POST">
                    <?php
                    $id = $row_user["nip_npak"];
                    $data = mysqli_query($conn, "SELECT * FROM tb_pegawai WHERE nip_npak = '$id'");
                    while ($pgw = mysqli_fetch_array($data)) {
                    ?>
                        <div class="form-group">
                            <label for="nip">NIP/NPAK</label>
                            <input type="number" class="form-control" id="nip" name="nip_npak" value="<?= $pgw["nip_npak"]; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?= $pgw["email"]; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" value="<?= $pgw["password"]; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $pgw["nama"]; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Jabatan</label>
                            <select class="form-control" name="jabatan" required>
                                <option hidden selected><?= $pgw["jabatan"]; ?></option>
                                <option value="Administrator">Administrator</option>
                                <option value="Wakil Direktur 1">Wakil Direktur 1</option>
                                <option value="Ketua Jurusan">Ketua Jurusan</option>
                                <option value="Dosen Wali">Dosen Wali</option>
                                <option value="Ketua Akademik">Ketua Akademik</option>
                                <option value="Bagian Keuangan">Bagian Keuangan</option>
                                <option value="Bagian Perpustakaan">Bagian Perpustakaan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="thn_jabatan">Tahun Jabatan</label>
                            <input id="thn_jabatan" class="form-control" type="text" name="thn_jabatan" required="required" value="<?= $pgw["thn_jabatan"]; ?>">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" name="status" required="required">
                                <option hidden selected><?= $pgw["status"]; ?></option>
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                        </div>
                        <!-- tidak harus diisi karena data pribadi -->
                        <div class="form-group">
                            <label for="no_telp">Nomor Telepon</label>
                            <input id="no_telp" class="form-control" type="number" name="no_telp" value="<?= $pgw["no_telp"]; ?>">
                        </div>

                    <?php
                    }
                    ?>

            </div>
            <div class="modal-footer justify-content-between">
                <a href="index.php" type="submit" onclick='window.location.reload();' class="btn btn-default" data-dismiss="modal">Tutup</a>

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