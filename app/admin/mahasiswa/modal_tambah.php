<div class="modal fade" id="modal-info">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Mahasiswa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick='window.location.reload();'>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                <form action="" enctype="multipart/form-data" method="POST">
                    <?php

                    $tb_doswal = sql("SELECT * FROM tb_doswal, tb_pegawai WHERE tb_doswal.nip_npak = tb_pegawai.nip_npak ORDER BY tb_pegawai.nama ASC");
                    $tb_kajur = sql("SELECT * FROM tb_kajur, tb_pegawai WHERE tb_kajur.nip_npak = tb_pegawai.nip_npak ORDER BY tb_pegawai.nama ASC");

                    ?>
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="number" class="form-control" id="nim" name="nim" required>
                    </div>

                    <div class="form-group">
                        <label for="doswal">Dosen Wali</label>
                        <select name="doswal" class="form-control select2bs4" style="width: 100%;" required>
                            <option value=""></option>
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
                        <select class="form-control select2bs4" style="width: 100%;" id="kajur" name="kajur" required> 
                            <option value=""></option>
                            <?php foreach ($tb_kajur as $row) {
                            ?>
                                <option value="<?= $row['id_kajur'] ?>"><?php echo $row['nama']; ?> (<?php echo $row_user['nip_npak']; ?>)</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="thn_angkatan">Tahun Angkatan</label>
                        <select class="form-control" id="thn_angkatan" name="thn_angkatan">
                            <option value=""></option>
                            <?php
                            for ($i = date('Y'); $i >= date('Y') - 45; $i -= 1) {
                                echo "<option value='$i'> $i </option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input id="kelas" class="form-control" type="text" name="kelas" required="required">
                    </div>
                    <div class="form-group">
                        <label for="tempat_lhr">Tempat Lahir</label>
                        <input id="tempat_lhr" class="form-control" type="text" name="tempat_lhr" required="required">
                    </div>
                    <div class="form-group">
                        <label for="tgl_lhr">Tanggal Lahir</label>
                        <input id="tgl_lhr" class="form-control" type="date" name="tgl_lhr" required="required">
                    </div>
                    <div class="form-group">
                        <label for="jk">Jenis Kelamin</label>
                        <div class="custom-control custom-radio">
                            <input class="form-control custom-control-input" type="radio" id="Laki-Laki" name="jk" value="Laki-laki">
                            <label for="Laki-Laki" class="custom-control-label">Laki-Laki</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="form-control custom-control-input" type="radio" id="Perempuan" name="jk" value="Perempuan">
                            <label for="Perempuan" class="custom-control-label">Perempuan</label>
                        </div>
                    </div>
                    <!-- tidak harus diisi karena data pribadi -->
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" rows="4" name="alamat" placeholder="Enter ..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="no_telp">Nomor Telepon</label>
                        <input id="no_telp" class="form-control" type="number" name="no_telp">
                    </div>
                    <!-- <div class="form-group">
                        <label for="foto">Foto</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="foto" name="foto">
                            <label class="custom-file-label" for="foto"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ttd">Tanda Tangan</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="ttd" name="ttd">
                                <label class="custom-file-label" for="ttd"></label>
                            </div>
                        </div>
                    </div> -->

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