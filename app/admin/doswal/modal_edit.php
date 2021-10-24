<div class="modal fade" id="myModal<?php echo $row_user['id_doswal']; ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data Dosen Wali</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="window.location.reload();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                <form action="" method="POST">
                    <?php
                    $id = $row_user["id_doswal"];
                    $data = mysqli_query($conn, "SELECT * FROM tb_doswal WHERE id_doswal = '$id'");
                    while ($doswal = mysqli_fetch_array($data)) {
                    ?>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $doswal["id_doswal"]; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nip">NIP/NPAK</label>
                            <input type="number" class="form-control" id="nip" name="nip" value="<?= $doswal["nip_npak"]; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="thn_jabatan">Tahun Jabatan</label>
                            <input id="thn_jabatan" class="form-control" type="text" name="thn_jabatan" required="required" value="<?= $doswal["thn_jabatan"]; ?>">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" name="status" required="required">
                                <option hidden selected><?= $doswal["status"]; ?></option>
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