<div class="modal fade" id="modal-pegawai">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Pegawai</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick='window.location.reload();'>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                <form action="" enctype="multipart/form-data" method="POST">

                    <div class="form-group">
                        <label for="nip">NIP/NPAK</label>
                        <input type="number" class="form-control" id="nip" name="nip" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <!-- <div class="form-group">
                        <label>Jabatan</label>
                        <select class="form-control" name="jabatan">
                            <option></option>
                            <option value="Administrator">Administrator</option>
                            <option value="Wakil Direktur 1">Wakil Direktur 1</option>
                            <option value="Ketua Jurusan">Ketua Jurusan</option>
                            <option value="Dosen Wali">Dosen Wali</option>
                            <option value="Dosen Wali dan Ketua Jurusan">Dosen Wali dan Ketua Jurusan</option>
                            <option value="Ketua Akademik">Ketua Akademik</option>
                            <option value="Bagian Keuangan">Bagian Keuangan</option>
                            <option value="Bagian Perpustakaan">Bagian Perpustakaan</option>
                        </select>
                    </div> -->

                    <div class="form-group">
                        <label>Jabatan</label>
                        <div class="select2-purple">
                            <select class="select2" name="id_jabatan[]" multiple="multiple" data-placeholder="Pilih Jabatan/Hak Akses (bisa satu atau lebih)" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                <?php
                                $data_jabatan = mysqli_query($conn, "SELECT * FROM tb_jabatan");
                                while ($datas = mysqli_fetch_array($data_jabatan)) { ?>
                                    <option value="<?= $datas['id_jabatan'] ?>">

                                        <?php
                                        if (!($datas['nama_jabatan'] == 'Ketua Jurusan')) {
                                            echo $datas['nama_jabatan'];
                                        } else {
                                            echo "Ketua Jurusan/Koordinator Prodi";
                                        }
                                        ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <!-- /.form-group -->


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
                    <!-- tidak harus diisi karena data pribadi -->
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