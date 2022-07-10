<div class="modal fade" id="myModal<?php echo $row_user['id_hak_akses']; ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Hak Akses Pegawai</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="window.location.reload();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <!-- form start -->
                <form action="" enctype="multipart/form-data" method="POST">
                    <?php
                    $id =  $row_user['id_hak_akses'];
                    ?>
                    <input type="hidden" value="<?= $id; ?>" name="id">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" name="nama" value="<?= $row_user["nama"]; ?> (<?= $row_user["nip_npak"]; ?>)" readonly>
                    </div>

                    <div class="form-group">
                        <label>Jabatan</label>
                        <select class="form-control select2bs4" name="id_jabatan" style="width: 100%;">
                            <option value="<?= $row_user["id_jabatan"]; ?>" selected> <?= $row_user["nama_jabatan"]; ?></option>
                            <?php
                            $data_jabatan = mysqli_query($conn, "SELECT * FROM tb_jabatan");
                            while ($datas = mysqli_fetch_array($data_jabatan)) { ?>
                                <option value="<?= $datas['id_jabatan'] ?>"><?= $datas['nama_jabatan'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

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