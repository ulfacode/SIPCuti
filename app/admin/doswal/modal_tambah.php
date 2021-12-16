<div class="modal fade" id="modal-doswal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Dosen Wali</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick='window.location.reload();'>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                <form action="" method="POST">
                    <?php
                    $pgw = sql("SELECT * FROM v_tampil_doswal");
                    ?>
                    <!-- <div class="form-group">
                        <input type="hidden" class="form-control" name="id">
                    </div> -->

                    <div class="form-group">
                        <label for="nip">NIP/NPAK</label>
                        <!-- select2 tidak jadi, form control udah bisa buat search -->
                        <select name="nip" class="form-control select2" data-placeholder="Pilih Dosen Wali" style="width: 100%;" required>
                            <option value=""></option>
                            <?php
                            foreach ($pgw as $row_user) {
                            ?>
                                <option value="<?php echo $row_user['nip_npak'] ?>"><?php echo $row_user['nama']; ?> (<?php echo $row_user['nip_npak']; ?>)</option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="thn_jabatan">Tahun Jabatan</label>
                        <input id="thn_jabatan" class="form-control" type="text" name="thn_jabatan" required="required" placeholder="ex: 2019-2022">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" required="required">
                            <option></option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>

            </div>
            <div class="modal-footer justify-content-between">
                <a href="" type="button" class="btn btn-default" data-dismiss="modal" onclick='window.location.reload();'>Tutup</a>

                <!-- untuk submit name nya harus sama dengan function -->
                <button name="tambah" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->