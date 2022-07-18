<div class="modal fade" id="myModal<?php echo $row_user['id_kajur']; ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data Ketua Jurusan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="window.location.reload();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                <form action="" method="POST">
                    <?php
                    $id = $row_user["id_kajur"];
                    $data = mysqli_query($conn, "SELECT tb_kajur.*, tb_pegawai.nama, tb_pegawai.nip_npak FROM tb_kajur, tb_pegawai WHERE tb_kajur.nip_npak = tb_pegawai.nip_npak AND id_kajur = '$id'");
                    while ($kajur = mysqli_fetch_array($data)) {
                    ?>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $kajur["id_kajur"]; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Nama (NIP/NPAK)</label>
                            <input type="text" class="form-control" id="nip" name="nip" value="<?php echo $kajur['nama']; ?> (<?php echo $kajur['nip_npak']; ?>)" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Jurusan</label>
                            <select class="form-control" name="nm_jurusan" required="required">
                                <option hidden selected><?= $kajur["nm_jurusan"]; ?></option>
                                <option value="Teknik Informatika">Teknik Informatika</option>
                                <option value="Teknik Mesin">Teknik Mesin</option>
                                <option value="Teknik Elektronika">Teknik Elektronika</option>
                                <option value="Teknik Pengendalian Pencemaran Lingkungan">Teknik Pengendalian Pencemaran Lingkungan</option>
                                <option value="Teknik Pengembangan Produk Agroindustri">Teknik Pengembangan Produk Agroindustri</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="thn_jabatan">Tahun Jabatan</label>
                            <input id="thn_jabatan" class="form-control" type="text" name="thn_jabatan" required="required" value="<?= $kajur["thn_jabatan"]; ?>">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" name="status" required="required">
                                <option hidden selected><?= $kajur["status"]; ?></option>
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
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