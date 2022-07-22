<div class="modal fade" id="tambahCuti">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Pengajuan Cuti</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick='window.location.reload();'>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                <form action="" enctype="multipart/form-data" method="POST">
                    <?php

                    // $tb_mhs = sql("SELECT * FROM tb_mahasiswa ORDER BY nama ASC");

                    ?>
                    <input type="hidden" name="id" value="<?php echo $_SESSION['id_mahasiswa']; ?>">
                    <div class="form-group">
                        <!-- nim berdasarkan yang login -->
                        <label for="nim">NIM</label>
                        <input type="number" class="form-control" name="nim" value="<?php echo $_SESSION['nim']; ?>" readonly>

                    </div>

                    <!-- tampilkan isi enum -->
                    <div class="form-group">
                        <label for="">Jenis Pengajuan</label>
                        <input type="text" class="form-control" name="jns_pengajuan" value="Cuti" readonly>
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="tgl_pengajuan" value="<?php echo date("Y-m-d"); ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Semester Cuti</label>
                        <input type="number" class="form-control" name="semester_cuti" placeholder="Isikan semester saat mengambil cuti! Misalkan: 5" min="1" max="5" required>
                    </div>
                    <div class="form-group">
                        <label for="">Tingkat</label>
                        <input type="number" class="form-control" name="tingkat" placeholder="Isikan tingkat kuliah saat mengambil cuti! Misalkan: 3" min="1" max="3" required>
                    </div>
                    <div class="form-group">
                        <label for="">Tahun Akademik</label>
                        <input type="text" class="form-control" name="thn_akademik" placeholder="Isikan Tahun Akademik saat mengambil cuti! Misalkan: 2020/2021" maxlength="9" required>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Prodi</label>
                        <select class="form-control" name="nm_prodi" required="required">
                            <option></option>
                            <option value="Teknik Informatika">Teknik Informatika</option>
                            <option value="Teknik Mesin">Teknik Mesin</option>
                            <option value="Teknik Elektronika">Teknik Elektronika</option>
                            <option value="Teknik Listrik">Teknik Listrik</option>
                            <option value="Teknik Pengendalian Pencemaran Lingkungan">Teknik Pengendalian Pencemaran Lingkungan</option>
                            <option value="Teknik Pengembangan Produk Agroindustri">Teknik Pengembangan Produk Agroindustri</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Alasan</label>
                        <textarea class="form-control" rows="4" name="alasan" placeholder="Isikan alasan cuti!"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Lampiran</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="lampiran">
                            <label class="custom-file-label" for="foto"></label>
                            <p style="color: red;">* Lampiran berisi: Bukti UKT, KTM, Kartu Perpus, Surat Keterangan Sakit (yang relevan) dalam bentuk PDF!</p>
                            <p style="color: red;">* Maksimal 10MB!</p>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="ttd">Tanda Tangan Orang Tua</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="ttd" name="ttd_ortu">
                            <label class="custom-file-label" for="ttd"></label>
                            <p style="color: red;">* Upload file dalam bentuk (jpg/jpeg/png) dan transparan!</p>
                            <p style="color: red;">* Maksimal 10MB!</p>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="">Nama Orang Tua</label>
                        <input type="text" class="form-control" name="nama_ortu" placeholder="Isikan salah satu!" required>
                    </div>


            </div>
            <div class="modal-footer justify-content-between">
                <a href="" type="button" class="btn btn-default" data-dismiss="modal" onclick='window.location.reload();'>Tutup</a>

                <!-- untuk submit name nya harus sama dengan function -->
                <button name="tambahCuti" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<!-- modal menambahkan pengajuan izin aktif -->
<div class="modal fade" id="tambahAktif">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Pengajuan Izin Aktif</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick='window.location.reload();'>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                <form action="" enctype="multipart/form-data" method="POST">
                    <?php

                    // $tb_mhs = sql("SELECT * FROM tb_mahasiswa ORDER BY nama ASC");

                    ?>
                    <input type="hidden" name="id" value="<?php echo $_SESSION['id_mahasiswa']; ?>">

                    <div class="form-group">
                        <!-- nim berdasarkan yang login -->
                        <label for="nim">NIM</label>
                        <input type="number" class="form-control" name="nim" value="<?php echo $_SESSION['nim']; ?>" readonly>

                    </div>

                    <!-- tampilkan isi enum -->
                    <div class="form-group">
                        <label for="">Jenis Pengajuan</label>
                        <input type="text" class="form-control" name="jns_pengajuan" value="Izin Aktif" readonly>
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="tgl_pengajuan" value="<?php echo date("Y-m-d"); ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Semester Aktif</label>
                        <input type="number" class="form-control" name="semester_cuti" placeholder="Isikan semester kuliah Anda! Misalkan: 5" min="1" max="6" required>
                    </div>
                    <div class="form-group">
                        <label for="">Tingkat</label>
                        <input type="number" class="form-control" name="tingkat" placeholder="Isikan tingkat kuliah Anda! Misalkan: 3" min="1" max="3" required>
                    </div>
                    <div class="form-group">
                        <label for="">Tahun Akademik</label>
                        <input type="text" class="form-control" name="thn_akademik" placeholder="Isikan Tahun Akademik saat aktif! Misalkan: 2020/2021" maxlength="9" required>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Prodi</label>
                        <select class="form-control" name="nm_prodi" required="required">
                            <option></option>
                            <option value="Teknik Informatika">Teknik Informatika</option>
                            <option value="Teknik Mesin">Teknik Mesin</option>
                            <option value="Teknik Elektronika">Teknik Elektronika</option>
                            <option value="Teknik Listrik">Teknik Listrik</option>
                            <option value="Teknik Pengendalian Pencemaran Lingkungan">Teknik Pengendalian Pencemaran Lingkungan</option>
                            <option value="Teknik Pengembangan Produk Agroindustri">Teknik Pengembangan Produk Agroindustri</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Lampiran</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="lampiran">
                            <label class="custom-file-label" for="foto"></label>
                            <p style="color: red;">* Lampiran berisi: Bukti UKT, KTM, Kartu Perpus, Surat Keterangan Sakit (yang relevan) dalam bentuk PDF!</p>
                            <p style="color: red;">* Maksimal 10MB!</p>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="ttd">Tanda Tangan Orang Tua</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="ttd" name="ttd_ortu">
                            <label class="custom-file-label" for="ttd"></label>
                            <p style="color: red;">* Upload file dalam bentuk (jpg/jpeg/png) dan transparan!</p>
                            <p style="color: red;">* Maksimal 10MB!</p>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="">Nama Orang Tua</label>
                        <input type="text" class="form-control" name="nama_ortu" placeholder="Isikan salah satu!" required>
                    </div>


            </div>
            <div class="modal-footer justify-content-between">
                <a href="" type="button" class="btn btn-default" data-dismiss="modal" onclick='window.location.reload();'>Tutup</a>

                <!-- untuk submit name nya harus sama dengan function -->
                <button name="tambahAktif" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->