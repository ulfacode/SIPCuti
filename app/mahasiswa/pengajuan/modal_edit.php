<div class="modal fade" id="modalEdit<?php echo $row_user['id_pengajuan']; ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Edit Pengajuan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="window.location.reload();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <?php
            $id = $row_user["id_pengajuan"];
            $data = mysqli_query($conn, "SELECT * FROM tb_pengajuan, tb_mahasiswa WHERE tb_pengajuan.id_mahasiswa = tb_mahasiswa.id_mahasiswa AND id_pengajuan = '$id'");
            while ($pj = mysqli_fetch_array($data)) {
            ?>
                <!-- form start -->
                <form action="" method="POST">
                    <div class="modal-body">

                        <input type="hidden" class="form-control" name="id_pengajuan" value="<?= $pj["id_pengajuan"]; ?>">
                        <input type="hidden" class="form-control" name="jns_pengajuan" value="<?= $pj["jns_pengajuan"]; ?>">

                        <div class="form-group">
                            <label for="nim">NIM</label>
                            <input type="number" class="form-control" id="nim" name="nim" value="<?= $pj["nim"]; ?>" readonly>
                        </div>


                        <div class="form-group">
                            <label for="">Semester Cuti/Aktif</label>
                            <input type="number" class="form-control" name="semester_cuti" min="1" max="5" value="<?= $pj["semester_cuti"]; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="">Tingkat</label>
                            <input type="number" class="form-control" name="tingkat" min="1" max="3" value="<?= $pj["tingkat"]; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="">Tahun Akademik</label>
                            <input type="text" class="form-control" name="thn_akademik" maxlength="9" value="<?= $pj["thn_akademik"]; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Prodi</label>
                            <select class="form-control" name="nm_prodi" required="required">
                                <option hidden selected value="<?= $pj["nm_prodi"]; ?>"><?= $pj["nm_prodi"]; ?></option>
                                <option value="Teknik Informatika">Teknik Informatika</option>
                                <option value="Teknik Mesin">Teknik Mesin</option>
                                <option value="Teknik Elektronika">Teknik Elektronika</option>
                                <option value="Teknik Listrik">Teknik Listrik</option>
                                <option value="Teknik Pengendalian Pencemaran Lingkungan">Teknik Pengendalian Pencemaran Lingkungan</option>
                                <option value="Teknik Pengembangan Produk Agroindustri">Teknik Pengembangan Produk Agroindustri</option>
                            </select>
                        </div>
                        <?php
                        if ($pj['jns_pengajuan'] == "Cuti") { ?>
                            <div class="form-group">
                                <label>Alasan</label>
                                <textarea class="form-control" rows="4" name="alasan" value="" required><?= $pj["alasan"]; ?></textarea>
                            </div>
                        <?php
                        }
                        ?>


                        <div class="form-group">
                            <label for="">Lampiran</label>
                            <div class="custom-file">
                                <a class="btn btn-light" href="img/<?= $pj['lampiran'] ?>">
                                    <i class="fa fa-download" style="color: blue;"></i> Cek Berkas
                                </a>

                                <a class="btn btn-light" data-toggle="modal" data-target="#modal_lampiran">
                                    <i class="fa fa-edit" style="color: green;"></i> Edit
                                </a>

                            </div>
                        </div>


                        <div class="form-group">
                            <label for="ttd">Tanda Tangan Orang Tua</label>
                            <div class="custom-file">
                                <a class="btn btn-light" href="img/<?= $row_user['ttd_ortu'] ?>">
                                    <i class="fa fa-download" style="color: blue;"></i> Cek Berkas
                                </a>

                                <a class="btn btn-light" data-toggle="modal" data-target="#edit_ttd">
                                    <i class="fa fa-edit" style="color: green;"></i> Edit
                                </a>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Orang Tua</label>
                            <input type="text" class="form-control" name="nama_ortu" required value="<?= $pj["nama_ortu"]; ?>">
                        </div>


                    </div>
                    <div class="modal-footer">
                        <!-- untuk submit name nya harus sama dengan function -->
                        <button name="editP" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            <?php
                include "modal_ttd.php";
                include "modal_lampiran.php";
            }
            ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->