<div class="modal fade" id="modal-hak-akses">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Hak Akses Pegawai</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick='window.location.reload();'>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                <form action="" method="POST">
                    <?php
                    $user = mysqli_query($conn, "SELECT p.nama, p.nip_npak, p.id_pegawai FROM tb_pegawai AS p");
                    ?>

                    <div class="form-group">
                        <label for="nip">Nama Pegawai</label>
                        <select name="id" class="form-control select2bs4" style="width: 100%;" required>
                            <option value=""></option>
                            <?php
                            foreach ($user as $datas) {
                            ?>
                                <option value="<?php echo $datas['id_pegawai'] ?>"><?php echo $datas['nama']; ?> (<?php echo $datas['nip_npak']; ?>)</option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Jabatan</label>
                        <div class="select2-purple">
                            <select class="select2" name="id_jabatan[]" multiple="multiple" data-placeholder="Pilih Jabatan/Hak Akses (bisa satu atau lebih)" data-dropdown-css-class="select2-purple" style="width: 100%;">
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
                    <!-- /.form-group -->

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