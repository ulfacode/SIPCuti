<?php
$angkatan = mysqli_query($conn, "SELECT thn_angkatan FROM tb_mahasiswa WHERE id_mahasiswa = '$_SESSION[id_mahasiswa]'");
$result = mysqli_fetch_array($angkatan);
$yearNow = date('Y');
$monthNow = date('m');
if (($yearNow - $result['thn_angkatan']) == 0) {
    $semester = 1;
} elseif (($yearNow - $result['thn_angkatan']) == 1) {
    if ($monthNow <= 2) {
        $semester = 1;
        $tingkat = 1;
    } elseif ($monthNow <= 8) {
        $semester = 2;
        $tingkat = 1;
    } else {
        $semester = 3;
        $tingkat = 2;
    }
} elseif (($yearNow - $result['thn_angkatan']) == 2) {
    if ($monthNow <= 2) {
        $semester = 3;
        $tingkat = 2;
    } elseif ($monthNow <= 8) {
        $semester = 4;
        $tingkat = 2;
    } else {
        $semester = 5;
        $tingkat = 3;
    }
} elseif (($yearNow - $result['thn_angkatan']) == 3) {
    if ($monthNow <= 2) {
        $semester = 3;
    } elseif ($monthNow <= 8) {
        $semester = 'Anda sudah tidak bisa mengajukan';
        $tingkat = 'Anda sudah tidak bisa mengajukan';
    } else {
        $semester = 'Anda sudah lulus';
        $tingkat = 'Anda sudah lulus';
    }
} else {
    $semester = 'Anda sudah lulus';
    $tingkat = 'Anda sudah lulus';
}

if ($monthNow <= 8) {
    $thn_akademik1 = $yearNow - 1;
    $thn_akademik2 = $thn_akademik1 + 1;
    $thn_akademik = $thn_akademik1 . "/" . $thn_akademik2;
} else {
    $thn_akademik1 = $yearNow;
    $thn_akademik2 = $thn_akademik1 + 1;
    $thn_akademik = $thn_akademik1 . "/" . $thn_akademik2;
}
?>

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
                        <input type="text" class="form-control" name="semester_cuti" value="<?= $semester; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Tingkat</label>
                        <input type="text" class="form-control" name="tingkat" value="<?= $tingkat; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Tahun Akademik</label>
                        <input type="text" class="form-control" name="thn_akademik" value="<?= $thn_akademik; ?>" readonly>
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
                            <input type="file" class="custom-file-input" name="lampiran" accept=".pdf">
                            <label class="custom-file-label" for="foto"></label>
                            <p style="color: red;">* Lampiran berisi: Bukti Pembayaran UKT terakhir, KTM, Kartu Perpus, Surat Keterangan Sakit (yang relevan) dalam bentuk PDF!</p>
                            <p style="color: red;">* Maksimal 10MB!</p>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="ttd">Tanda Tangan Orang Tua</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="ttd" name="ttd_ortu" accept=".png, .jpg, .jpeg">
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
                        <input type="number" class="form-control" name="semester_cuti" value="<?= $semester; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Tingkat</label>
                        <input type="number" class="form-control" name="tingkat" value="<?= $tingkat; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Tahun Akademik</label>
                        <input type="text" class="form-control" name="thn_akademik" value="<?= $thn_akademik; ?>" readonly>
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
                            <input type="file" class="custom-file-input" name="lampiran" accept=".pdf">
                            <label class="custom-file-label" for="foto"></label>
                            <p style="color: red;">* Lampiran berisi: Bukti UKT, KTM, Kartu Perpus, Surat Keterangan Sakit (yang relevan) dalam bentuk PDF!</p>
                            <p style="color: red;">* Maksimal 10MB!</p>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="ttd">Tanda Tangan Orang Tua</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="ttd" name="ttd_ortu" accept=".png, .jpg, .jpeg">
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